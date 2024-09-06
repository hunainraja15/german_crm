<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewJob; // Ensure you're using the correct model
use App\Models\Application; // Ensure you're using the correct model
use App\Models\Interview;
use App\Models\OfferCreation; // Ensure you have the Offer model    
use Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use HelloSign\Client;
use HelloSign\SignatureRequest;
use HelloSign\Signer;


class NewJobController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
       
        if(Auth::user()->role == 'User'){
            $id = Auth::user()->id;
            
            // Get the IDs of the jobs the user has applied for
            $appliedJobIds = Application::where('user_id', $id)->pluck('job_id')->toArray();
            
            // Get the public jobs that the user hasn't applied for
            $jobs = NewJob::where('visibility', 'public')
                          ->whereNotIn('id', $appliedJobIds)
                          ->get();
        } else {
            $jobs = NewJob::all();
        }

        return view('job.index', compact('jobs'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('job.create');
    }

    public function signature_file(Request $request , $interview){
        // dd($request->all());

        $fileName = uniqid() . '_' . time() . '.' . $request->signature_file->getClientOriginalExtension();

// Store the file in the 'public' directory
$path = $request->signature_file->storeAs('public', $fileName);

        $interview = Interview::find($interview);
        $interview->signature_file = $path;
        $interview->signature = true;
        $interview->save();
        return back();
    }
    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'nullable|string',
            'job_location' => 'required|string|max:255',
            'employment_type' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'salary_range_min' => 'nullable|numeric|min:0',
            'salary_range_max' => 'nullable|numeric|min:0|gte:salary_range_min',
            'application_deadline' => 'required|date',
            'required_qualifications' => 'nullable|string',
            'preferred_qualifications' => 'nullable|string',
            'education_level' => 'nullable|string',
            'experience_required' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'company_website' => 'nullable|url',
            'visibility' => 'required|in:default,private,public',
        ]);

        // Combine and format salary range
        $validated['salary_range'] = $validated['salary_range_min'] . '-' . $validated['salary_range_max'];

        // Remove unnecessary fields
        unset($validated['salary_range_min'], $validated['salary_range_max']);

        NewJob::create($validated);

        return redirect()->route('job.index')->with('success', 'Job created successfully.');
    }

    // Display the specified resource
    public function show(NewJob $job)
    {
        return view('job.show', compact('job'));
    }

    // Show the form for editing the specified resource
    public function edit(NewJob $job)
    {
        return view('job.create', compact('job'));
    }

    // Update the specified resource in storage
    public function update(Request $request, NewJob $job)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'nullable|string',
            'job_location' => 'required|string|max:255',
            'employment_type' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'salary_range_min' => 'nullable|numeric|min:0',
            'salary_range_max' => 'nullable|numeric|min:0|gte:salary_range_min',
            'application_deadline' => 'required|date',
            'required_qualifications' => 'nullable|string',
            'preferred_qualifications' => 'nullable|string',
            'education_level' => 'nullable|string',
            'experience_required' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'company_website' => 'nullable|url',
            'visibility' => 'required|in:default,private,public',
        ]);
    
        // Retrieve old values if new values are not provided
        $salary_range_min = $validated['salary_range_min'] ?? $job->salary_range_min;
        $salary_range_max = $validated['salary_range_max'] ?? $job->salary_range_max;
        $validated['salary_range'] = $salary_range_min . '-' . $salary_range_max;
    
        // Remove unnecessary fields
        unset($validated['salary_range_min'], $validated['salary_range_max']);
    
        $job->update($validated);
    
        return redirect()->route('job.index')->with('success', 'Job updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(NewJob $job)
    {
        $job->delete();

        return redirect()->route('job.index')->with('success', 'Job deleted successfully.');
    }
    //
    public function apply($jobId = null)
{
    if (Auth::check()) {
        $userId = Auth::user()->id;
    
        if (isset($jobId)) {
            // Fetch the specific job by ID, ensure it is public and not applied by the user
            $job = NewJob::where('id', $jobId)
                         ->where('visibility', 'public')
                         ->whereDoesntHave('applications', function ($query) use ($userId) {
                             $query->where('user_id', $userId);
                         })
                         ->first();
    
            if ($job) {
                return view('job.apply', compact('job'));
            } else {
                // Handle case where job is not found or not available to the user
                abort(404, 'Job not found or not available');
            }
        } else {
            // Fetch all public jobs that the user hasn't applied for
            $jobs = NewJob::where('visibility', 'public')
                          ->whereDoesntHave('applications', function ($query) use ($userId) {
                              $query->where('user_id', $userId);
                          })
                          ->get();
            return view('job.apply', compact('jobs'));
        }
    } else {
        // If the user is not authenticated, you may handle it accordingly or redirect to login
        return redirect()->route('login');
    }
}


    //
    public function application_submit(Request $request)
    {
        // dd( $request->all());
        
       // Define validation rules
    $validator = Validator::make($request->all(), [
        'job' => 'required|exists:new_jobs,id',
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_number' => 'required|string|max:15',
        'date_of_birth' => 'required|date',
        'gender' => 'required|string|in:Male,Female,Other',
        'street_address' => 'required|string|max:255',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'postal_code' => 'required|string|max:10',
        'country' => 'required|string|max:100',
        'linkedin_profile' => 'nullable|url',
        'portfolio_website' => 'nullable|url',
        'professional_summary' => 'nullable|string|max:1000',
        'education_level' => 'required|string|max:100',
        'institution_name' => 'required|string|max:255',
        'field_of_study' => 'required|string|max:255',
        'graduation_date' => 'required|date',
        'job_title' => 'nullable|string|max:255',
        'company_name' => 'nullable|string|max:255',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'responsibilities' => 'nullable|string|max:1000',
        'key_skills' => 'nullable|string|max:1000',
        'certifications' => 'nullable|string|max:1000',
        'job_type' => 'required|string|max:100',
        'preferred_location' => 'nullable|string|max:255',
        'desired_salary' => 'nullable|numeric',
        'languages_spoken' => 'nullable|string|max:255',
        'proficiency_level' => 'nullable|string|max:100',
        'why_this_job' => 'nullable|string|max:1000',
        'willing_to_relocate' => 'required',
        'salary_demand' => 'nullable|numeric',
        'availability_to_start' => 'nullable|date',
        'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        'cover_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
        // Generate unique identifiers
        $uniqueId = uniqid();
        $timestamp = time();

        // Initialize paths
        $resumePath = null;
        $coverLetterPath = null;

        // Store resume if available
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->storeAs(
                'public/applications',
                $uniqueId . '_' . $timestamp . '_resume.' . $request->file('resume')->getClientOriginalExtension()
            );
        }

        // Store cover letter if available
        if ($request->hasFile('cover_letter')) {
            $coverLetterPath = $request->file('cover_letter')->storeAs(
                'public/applications',
                $uniqueId . '_' . $timestamp . '_cover_letter.' . $request->file('cover_letter')->getClientOriginalExtension()
            );
        }

// dd( $request->all());
        // Create application record in the database
        Application::create([
            'job_id' => $request->input('job'),
            'user_id' => Auth::user()->id,
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
            'street_address' => $request->input('street_address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'postal_code' => $request->input('postal_code'),
            'country' => $request->input('country'),
            'linkedin_profile' => $request->input('linkedin_profile'),
            'portfolio_website' => $request->input('portfolio_website'),
            'professional_summary' => $request->input('professional_summary'),
            'education_level' => $request->input('education_level'),
            'institution_name' => $request->input('institution_name'),
            'field_of_study' => $request->input('field_of_study'),
            'graduation_date' => $request->input('graduation_date'),
            'job_title' => $request->input('job_title'),
            'company_name' => $request->input('company_name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'responsibilities' => $request->input('responsibilities'),
            'key_skills' => $request->input('key_skills'),
            'certifications' => $request->input('certifications'),
            'job_type' => $request->input('job_type'),
            'preferred_location' => $request->input('preferred_location'),
            'desired_salary' => $request->input('desired_salary'),
            'languages_spoken' => $request->input('languages_spoken'),
            'proficiency_level' => $request->input('proficiency_level'),
            'why_this_job' => $request->input('why_this_job'),
            'willing_to_relocate' => $request->input('willing_to_relocate'),
            'salary_demand' => $request->input('salary_demand'),
            'availability_to_start' => $request->input('availability_to_start'),
            'resume' => $resumePath ? url('storage/app/'.$resumePath) : null,
            'cover_letter' => $coverLetterPath ? url('storage/app/'.$coverLetterPath) : null,
        ]);

        return redirect()->route('job.index')->with('success' , 'Application submitted successfully.');

    }
    //
    public function view()
    {

       return view('job.view'); 
    }
    //
    public function application()
    {
        $applications = Application::with('newjob', 'user')->where('status', 'disapprove')->get();
        // dd($applications);
        
return view('job.application', compact('applications'));

    }
    //
    public function job_interview()
    {
        $interviews = Interview::get();

        
return view('job.interview', compact('interviews'));

    }
    public function interview_status(Request $request)
    {
            // Find the interview by ID
    $interview = Interview::find($request->interview_status_id);

    // Check if the interview exists
    if (!$interview) {
        return back()->with('error', 'Interview not found.');
    }

    // Update the status with the selected action from the form
    $interview->status = $request->input('selectedAction');
    $interview->save();

    // Return back with a success message
    return back()->with('success', 'Interview status updated successfully.');

    }
    public function signature_update($interview){
        $interview = Interview::find($interview);
        $interview->signature = true;
        $interview->save();
        return back();
    }
    public function updateStatus(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|exists:applications,id',
            'status' => 'required|in:approve,disapprove', // Modify these based on your actual status values
        ]);

        // Find the application by ID
        $application = Application::findOrFail($request->id);

        // Update the status
        $application->status = $request->status == 'approve' ? 'disapprove' : 'approve';
        $application->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Application status updated successfully.');
    }

    public function active()
    {
        $applications = Application::with('interview')->where('status' , 'approve')->get();
        return view('job.active' , compact('applications'));
    }
    public function interview_store(Request $request)
    {
         // Create or update the record based on application_id
    Interview::updateOrCreate(
        ['application_id' => $request->input('application_id')],
        [
            'interview_type' => $request->input('interview_type'),
            'interview_date' => $request->input('interview_date'),
            'interview_time_start' => $request->input('interview_time_start'),
            'interview_time_end' => $request->input('interview_time_end'),
            'duration' => $request->input('duration'),
            'special_request' => $request->input('special_request'),
        ]
    );

        return back();

    }

    public function offer_creation(){
        $interviews = Interview::with(['application.user' => function($query) {
            $query->where('role', 'Employer');
        }, 'application.newjob', 'offerCreation']) // Make sure the relationship is defined
        ->where('status', 'approve')
        ->get();
        
    
        return view('job.offer', compact('interviews'));
    }

    public function offer_update(Request $request)
    {
// dd($request->all());
       // Validate incoming request data
    $validator = Validator::make($request->all(), [
        'salary' => 'required|numeric|min:0',
        'contractual_terms' => 'required|string',
        'benefits' => 'required|string',
        'signature' => 'required',
        'interview_id' => 'required|exists:interviews,id',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $uniqueId = uniqid();
    $timestamp = time();

    // Store signature if available
    if ($request->hasFile('signature')) {
        $signaturePath = $request->file('signature')->storeAs(
            'public/signatures',
            $uniqueId . '_' . $timestamp . '.' . $request->file('signature')->getClientOriginalExtension()
        );
    }
// dd($signaturePath);
    // Check if the offer already exists
    $offer = OfferCreation::updateOrCreate(
        ['interview_id' => $request->input('interview_id')],
        [
            'salary' => $request->input('salary'),
            'contractual_terms' => $request->input('contractual_terms'),
            'benefits' => $request->input('benefits'),
            'signature' => $signaturePath,
        ]
    );

    return redirect()->back()->with('success', 'Offer updated successfully!');
}

private function base64EncodeImage($path) {
    $imageData = file_get_contents($path);
    $base64 = base64_encode($imageData);
    return 'data:image/png;base64,' . $base64;
}

public function interview_pdf($interview)
{
    // Load the interview details with necessary relationships
    $interview = Interview::with([
        'application.user' => function ($query) {
            $query->where('role', 'Employer');
        },
        'application.newjob',
        'offerCreation'
    ])
    ->where('status', 'approve')
    ->find($interview);

    // Ensure that the interview exists
    if (!$interview) {
        return redirect()->back()->with('error', 'Interview not found.');
    }

    // Convert the signature image to Base64
    $signaturePath = storage_path('app/' . $interview->offerCreation->signature);
    $signatureBase64 = $this->base64EncodeImage($signaturePath);

    // Prepare the data for the PDF
    $data = [
        'employee_name' => $interview->application->user->name,
        'job_title' => $interview->application->newjob->job_title,
        'salary' => $interview->offerCreation->salary,
        'benefits' => $interview->offerCreation->benefits,
        'contractual_terms' => $interview->offerCreation->contractual_terms,
        'signature' => $signatureBase64, // Use Base64 encoded image
        'company_name' => 'Your Company Name',
    ];

    // Prepare the HTML for the PDF
    $html = view('job.pdf', $data)->render();

    // Initialize DomPDF
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Create a response to download the PDF
    $pdfContent = $dompdf->output();
    $pdfName = 'employment_contract.pdf';

    return response()->stream(
        function () use ($pdfContent) {
            echo $pdfContent;
        },
        200,
        [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $pdfName . '"',
        ]
    );
}    
}
