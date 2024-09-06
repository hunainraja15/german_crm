<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfileFile;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class ProfileController extends Controller
{
    //
    public function index(){
        $profiles = Profile::get();
        // dd($profiles);
        return view('profile.index' , compact('profiles'));
    }

    public function create(){
        return view('profile.create' );
    }

    public function edit($profile){
        $profile = Profile::find($profile);
        return view('profile.create' , compact('profile'));
    }

    public function view($profile = null)
{
    // Check the initial value of the $profile
    if ($profile == null) {
        // Retrieve the profile for the authenticated user
        $profile = Profile::with('profileFiles')->where('user_id', Auth::user()->id)->first();
        
        if (!$profile) {
            // Handle the case where the authenticated user has no profile
            return redirect()->route('profile.create')->with('error', 'No profile found for the authenticated user. Please create one.');
        }
    } else {
        // Retrieve the profile with related profile_files using the primary key
        $profile = Profile::with('profileFiles')->find($profile);
       
    }

    // Pass the profile to the view
    return view('profile.view', compact('profile'));
}



    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'contact_information' => 'nullable|string|max:255',
            'Upload_videointerview' => 'nullable|array',
            'Upload_videointerview.*' => 'nullable|mimes:mp4,avi,mov|max:10240',
            'resume' => 'nullable|array',
            'resume.*' => 'nullable|max:10240',
            'cover_letter' => 'nullable|array',
            'cover_letter.*' => 'nullable|max:10240',
            'qualification_documents' => 'nullable|array',
            'qualification_documents.*' => 'nullable|max:10240',
            'language_certificates' => 'nullable|array',
            'language_certificates.*' => 'nullable|max:10240',
            'skills_and_experience' => 'nullable|string|max:5000',
            'job_type' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'desired_salary' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors with your submission.');
        }
      // Retrieve or create a profile
$profile = Profile::updateOrCreate(
    ['user_id' => Auth::user()->id], // Unique key to find or create a profile
    [
        'name' => $request->name,
        'email' => $request->email,
        'contact_information' => $request->contact_information,
        'skills_and_experience' => $request->skills_and_experience,
        'job_types' => $request->job_type,
        'location' => $request->location,
        'desired_salary' => $request->desired_salary,
    ]
);

$profileFileData = [];

// Define a function to handle file upload and storage
function handleFileUpload($request, $fileKey, $folder)
{
    $fileData = [];
    if ($request->hasFile($fileKey)) {
        foreach ($request->file($fileKey) as $i => $file) {
            if ($file->isValid()) {
                $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs($folder, $fileName);
                $fileData[$i][$fileKey] = url('storage/' . $folder . '/' . $fileName);
            }
        }
    }
    return $fileData;
}

// Process and save each type of file
$profileFileData = array_merge(
    handleFileUpload($request, 'Upload_videointerview', 'public/profile_docs'),
    handleFileUpload($request, 'resume', 'public/profile_docs'),
    handleFileUpload($request, 'cover_letter', 'public/profile_docs'),
    handleFileUpload($request, 'qualification_documents', 'public/profile_docs'),
    handleFileUpload($request, 'language_certificates', 'public/profile_docs')
);

// Delete existing profile files if they are being replaced
$existingFiles = ProfileFile::where('profile_id', $profile->id)->get();
foreach ($existingFiles as $existingFile) {
    // Delete file from storage
    if (file_exists(public_path('storage/app/public/profile_docs/' . basename($existingFile->Upload_videointerview)))) {
        unlink(public_path('storage/app/public/profile_docs/' . basename($existingFile->Upload_videointerview)));
    }
    if (file_exists(public_path('storage/app/public/profile_docs/' . basename($existingFile->resume)))) {
        unlink(public_path('storage/app/public/profile_docs/' . basename($existingFile->resume)));
    }
    if (file_exists(public_path('storage/app/public/profile_docs/' . basename($existingFile->cover_letter)))) {
        unlink(public_path('storage/app/public/profile_docs/' . basename($existingFile->cover_letter)));
    }
    if (file_exists(public_path('storage/app/public/profile_docs/' . basename($existingFile->qualification_documents)))) {
        unlink(public_path('storage/app/public/profile_docs/' . basename($existingFile->qualification_documents)));
    }
    if (file_exists(public_path('storage/app/public/profile_docs/' . basename($existingFile->language_certificates)))) {
        unlink(public_path('storage/app/public/profile_docs/' . basename($existingFile->language_certificates)));
    }
    // Delete record from database
    $existingFile->delete();
}

// Save or update each profile file
foreach ($profileFileData as $i => $data) {
    $profileFile = ProfileFile::updateOrCreate(
        ['profile_id' => $profile->id, 'id' => $i],
        $data
    );
}

return redirect()->route('profile.view')->with('success', 'Profile updated successfully!');


    }

    public function update(Request $request, $profile)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'contact_information' => 'nullable|string|max:255',
            'Upload_videointerview' => 'nullable|array',
            'Upload_videointerview.*' => 'nullable|mimes:mp4,avi,mov|max:10240',
            'resume' => 'nullable|array',
            'resume.*' => 'nullable|max:10240',
            'cover_letter' => 'nullable|array',
            'cover_letter.*' => 'nullable|max:10240',
            'qualification_documents' => 'nullable|array',
            'qualification_documents.*' => 'nullable|max:10240',
            'language_certificates' => 'nullable|array',
            'language_certificates.*' => 'nullable|max:10240',
            'skills_and_experience' => 'nullable|string|max:5000',
            'job_type' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'desired_salary' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors with your submission.');
        }
        // Find the profile by ID
        $profile = Profile::find($profile);
    
        // Update profile details
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->contact_information = $request->contact_information;
        $profile->skills_and_experience = $request->skills_and_experience;
        $profile->job_types = $request->job_type;
        $profile->location = $request->location;
        $profile->desired_salary = $request->desired_salary;
    
        $profile->save();
    
        // Ensure that a ProfileFile exists for the profile
$profileFile = ProfileFile::firstOrCreate(
    ['profile_id' => $profile->id], // Condition to check if it exists
    ['profile_id' => $profile->id]  // Values to insert if it doesn't exist
);

// Process video interview files
foreach ($request->file('Upload_videointerview', []) as $upload) {
    if ($upload->isValid()) {
        if ($profileFile->Upload_videointerview) {
            Storage::delete(str_replace(url('storage'), 'public', $profileFile->Upload_videointerview));
        }
        $fileName = uniqid() . '_' . time() . '.' . $upload->getClientOriginalExtension();
        $filePath = $upload->storeAs('public/profile_docs', $fileName);
        $profileFile->Upload_videointerview = url('storage/app/public/' . $fileName);
        $profileFile->save();
    }
}

// Process resume files
foreach ($request->file('resume', []) as $resume) {
    if ($resume->isValid()) {
        if ($profileFile->resume) {
            Storage::delete(str_replace(url('storage'), 'public', $profileFile->resume));
        }
        $fileName2 = uniqid() . '_' . time() . '.' . $resume->getClientOriginalExtension();
        $filePath2 = $resume->storeAs('public/profile_docs', $fileName2);
        $profileFile->resume = url('storage/app/public/' . $fileName2);
        $profileFile->save();
    }
}

// Process cover letter files
foreach ($request->file('cover_letter', []) as $coverLetter) {
    if ($coverLetter->isValid()) {
        if ($profileFile->cover_letter) {
            Storage::delete(str_replace(url('storage'), 'public', $profileFile->cover_letter));
        }
        $fileName3 = uniqid() . '_' . time() . '.' . $coverLetter->getClientOriginalExtension();
        $filePath3 = $coverLetter->storeAs('public/profile_docs', $fileName3);
        $profileFile->cover_letter = url('storage/app/public/' . $fileName3);
        $profileFile->save();
    }
}

// Process qualification documents files
foreach ($request->file('qualification_documents', []) as $qualificationDocuments) {
    if ($qualificationDocuments->isValid()) {
        if ($profileFile->qualification_documents) {
            Storage::delete(str_replace(url('storage'), 'public', $profileFile->qualification_documents));
        }
        $fileName4 = uniqid() . '_' . time() . '.' . $qualificationDocuments->getClientOriginalExtension();
        $filePath4 = $qualificationDocuments->storeAs('public/profile_docs', $fileName4);
        $profileFile->qualification_documents = url('storage/app/public/' . $fileName4);
        $profileFile->save();
    }
}

// Process language certificates files
foreach ($request->file('language_certificates', []) as $languageCertificates) {
    if ($languageCertificates->isValid()) {
        if ($profileFile->language_certificates) {
            Storage::delete(str_replace(url('storage'), 'public', $profileFile->language_certificates));
        }
        $fileName5 = uniqid() . '_' . time() . '.' . $languageCertificates->getClientOriginalExtension();
        $filePath5 = $languageCertificates->storeAs('public/profile_docs', $fileName5);
        $profileFile->language_certificates = url('storage/app/public/' . $fileName5);
        $profileFile->save();
    }
}

    // return redirect()->route('profile.show', $profile->id)->with('success', 'Profile updated successfully!');
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
    
    public function delete($profile){

        ProfileFile::where('profile_id', $profile)->delete();
        Profile::find($profile)->delete();
        return redirect()->route('profile.index')->with('success', 'Profile delete successfully!');
    }
    public function status_update(Request $request){

    //    dd($request->all());
       $profile = Profile::find($request->id);
       if($profile->status == 'panding'){
        $profile->status = 'active';
    }else{
           $profile->status = 'panding';

       }
       $profile->save();
       return back()->with('success', 'Profile status ' . $profile->status . ' updated successfully');

    }

    public function profile_employee(){

        $applications = Application::with('user')->where('status' , 'approve')->get();
        return view('profile.employee' , compact('applications'));
    }
}
