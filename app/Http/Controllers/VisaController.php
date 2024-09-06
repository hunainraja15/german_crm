<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Validator;
use App\Models\PersonalDetail;
use App\Models\EmploymentDetail;
use App\Models\CompanyDetail;
use App\Models\VisaDetail;
use App\Models\Document;
use App\Models\EducationDetail;

class VisaController extends Controller
{
    //
    public function index()
    {
        // Get profiles where the associated user's role is 'Employer'
        $profiles = Profile::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'Employer');
            })
            ->get();
        
        // Filter profiles that do not contain 'Germany' in their location
        $filteredProfiles = $profiles->filter(function ($profile) {
            return stripos($profile->location, 'Germany') === false;
        });
    
        // If there are any profiles that do not contain 'Germany', show the view
        if ($filteredProfiles->isNotEmpty()) {
            return view('visa.index', compact('filteredProfiles'));
        }
    
        // Optionally, handle the case where all profiles contain 'Germany'
        return view('visa.index', compact('filteredProfiles'));
    }
    
    public function submit($id)
    {
        dd($id);
    }
    public function apply()
    {
        return view('visa.apply');
    }


    public function applicastion(Request $request)
    {
        // Dump all form data for debugging (optional)
    // dd($request->all());
// Validate form data
$request->validate([
    // Personal Details
    'first_name' => 'required|string|max:255',
    'last_name' => 'required|string|max:255',
    'date_of_birth' => 'required|date',
    'nationality' => 'required|string|max:100',
    'gender' => 'required|in:male,female,other',
    'passport_number' => 'required|string|max:50',
    'passport_issue_date' => 'required|date',
    'passport_expiry_date' => 'required|date|after:passport_issue_date',
    'email_address' => 'required|email|max:255',
    'phone_number' => 'required|numeric|min:10',

    // Employment Details
    'job_title' => 'required|string|max:255',
    'job_role' => 'nullable|string|max:500',
    'industry' => 'required|string|max:100',
    'start_date_of_employment' => 'required|date',
    'employment_contract_type' => 'required|string|max:50',
    'salary_offered' => 'required|numeric|min:0',
    'working_hours' => 'required|integer|min:1',
    'work_location' => 'required|string|max:255',

    // Company Details
    'company_name' => 'required|string|max:255',
    'company_registration_number' => 'nullable|string|max:100',
    'company_address' => 'required|string|max:500',
    'company_phone_number' => 'required|numeric|min:10',
    'company_email_address' => 'required|email|max:255',

    // Visa Details
    'visa_type_requested' => 'required|string|max:100',
    'visa_process_type' => 'required|string|max:100',
    'work_permit_required' => 'required|boolean',
    'job_offer_signed_date' => 'required|date',
    'aisa_application_fee_payment_confirmation' => 'required|boolean',
    'payment_method' => 'required|string|max:100',
    'fee_waiver' => 'nullable|string|max:255',

    // Education Details
    'degree_name' => 'required|string|max:255',
    'field_of_study' => 'nullable|string|max:255',
    'language_proficiency' => 'nullable|string|max:255',

    // Document Uploads
    'offer_letter' => 'nullable|file|mimes:pdf|max:2048',
    'employment_contract' => 'nullable|file|mimes:pdf|max:2048',
    'job_description' => 'nullable|file|mimes:pdf|max:2048',
    'company_financials' => 'nullable|file|mimes:pdf|max:2048',
    'passport_copy' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    'candidate_qualifications' => 'nullable|file|mimes:pdf|max:2048',
    'recognition_certificate' => 'nullable|file|mimes:pdf|max:2048',
    'health_insurance' => 'nullable|file|mimes:pdf|max:2048',
]);

// Save Personal Details
$personalDetail = PersonalDetail::create([
    'user_id' => auth()->user()->id,  // Assuming user is logged in
    'first_name' => $request->first_name,
    'last_name' => $request->last_name,
    'date_of_birth' => $request->date_of_birth,
    'nationality' => $request->nationality,
    'gender' => $request->gender,
    'passport_number' => $request->passport_number,
    'passport_issue_date' => $request->passport_issue_date,
    'passport_expiry_date' => $request->passport_expiry_date,
    'email_address' => $request->email_address,
    'phone_number' => $request->phone_number,
]);

// Save Employment Details
$employmentDetail = EmploymentDetail::create([
    'job_title' => $request->job_title,
    'job_role' => $request->job_role,
    'industry' => $request->industry,
    'start_date_of_employment' => $request->start_date_of_employment,
    'employment_contract_type' => $request->employment_contract_type,
    'salary_offered' => $request->salary_offered,
    'working_hours' => $request->working_hours,
    'work_location' => $request->work_location,
]);

// Save Company Details
$companyDetail = CompanyDetail::create([
    'company_name' => $request->company_name,
    'company_registration_number' => $request->company_registration_number,
    'company_address' => $request->company_address,
    'company_phone_number' => $request->company_phone_number,
    'company_email_address' => $request->company_email_address,
]);

// Save Visa Details
$visaDetail = VisaDetail::create([
    'visa_type_requested' => $request->visa_type_requested,
    'visa_process_type' => $request->visa_process_type,
    'work_permit_required' => $request->work_permit_required,
    'job_offer_signed_date' => $request->job_offer_signed_date,
    'aisa_application_fee_payment_confirmation' => $request->aisa_application_fee_payment_confirmation,
    'payment_method' => $request->payment_method,
    'fee_waiver' => $request->fee_waiver,
]);

// Save Education Details
$educationDetail = EducationDetail::create([
    'degree_name' => $request->degree_name,
    'field_of_study' => $request->field_of_study,
    'language_proficiency' => $request->language_proficiency,
]);

// Save Document Attachments
$document = Document::create([
    'personal_detail_id' => $personalDetail->id,
    'employment_detail_id' => $employmentDetail->id,
    'company_detail_id' => $companyDetail->id,
    'visa_detail_id' => $visaDetail->id,
    'education_detail_id' => $educationDetail->id,
]);

// Helper function to store file and return the path
function storeFile($file, $folder) {
    $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
    $path = $file->storeAs('public/documents/' . $folder, $fileName);
    return $path;
}

// Handle single file uploads for each document type and store their paths in the Document model
if ($request->hasFile('offer_letter')) {
    $document->offer_letter = storeFile($request->file('offer_letter'), 'offer_letters');
}

if ($request->hasFile('employment_contract')) {
    $document->employment_contract = storeFile($request->file('employment_contract'), 'employment_contracts');
}

if ($request->hasFile('job_description')) {
    $document->job_description = storeFile($request->file('job_description'), 'job_descriptions');
}

if ($request->hasFile('company_financials')) {
    $document->company_financials = storeFile($request->file('company_financials'), 'company_financials');
}

if ($request->hasFile('passport_copy')) {
    $document->passport_copy = storeFile($request->file('passport_copy'), 'passport_copies');
}

if ($request->hasFile('candidate_qualifications')) {
    $document->candidate_qualifications = storeFile($request->file('candidate_qualifications'), 'candidate_qualifications');
}

if ($request->hasFile('recognition_certificate')) {
    $document->recognition_certificate = storeFile($request->file('recognition_certificate'), 'recognition_certificates');
}

if ($request->hasFile('health_insurance')) {
    $document->health_insurance = storeFile($request->file('health_insurance'), 'health_insurance');
}

// Save the document model with file paths
$document->save();


    // Redirect after successful save
    return redirect()->back()->with('success', 'Visa application has been successfully submitted.');
}

}
