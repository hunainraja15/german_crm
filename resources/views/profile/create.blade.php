@extends('home')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Profile Creation</h3>
    </div>
    <div class="card-body">
        <div class="tab-content" id="profileTabContent">
            <!-- Tab 1: Personal Information -->
            <div class="tab-pane fade show active" id="personal">
                <form action="{{ @$profile ? route('profile.update',$profile) :route('profile.store') }}" method="post" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input value="{{@$profile->name}}" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input value="{{@$profile->email}}" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Contact" class="form-label">Contact Information</label>
                        <input value="{{@$profile->contact_information}}" id="Contact" type="text" class="form-control" name="contact_information" value="{{ old('contact_information') }}">
                        @error('contact_information')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Upload_videointerview" class="form-label">Upload Videointerview</label>
                        <input id="Upload_videointerview" type="file" class="form-control" name="Upload_videointerview[]" multiple>
                        @error('Upload_videointerview.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <h5>Upload Documents</h5>
                    </div>
                    <div class="mb-3">
                        <label for="resume" class="form-label">Resume/CV</label>
                        <input id="resume" type="file" class="form-control" name="resume[]" multiple>
                        @error('resume.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cover_letter" class="form-label">Cover Letter</label>
                        <input id="cover_letter" type="file" class="form-control" name="cover_letter[]" multiple>
                        @error('cover_letter.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="qualification_documents" class="form-label">Qualification Documents</label>
                        <input id="qualification_documents" type="file" class="form-control" name="qualification_documents[]" multiple>
                        @error('qualification_documents.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="language_certificates" class="form-label">Language Certificates</label>
                        <input  id="language_certificates" type="file" class="form-control" name="language_certificates[]" multiple>
                        @error('language_certificates.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="skills_and_experience" class="form-label">Skills and Experience</label>
                        <textarea id="skills_and_experience" class="form-control" rows="10" name="skills_and_experience" placeholder="Enter details about your skills, work experience, and education">{{ old('skills_and_experience') }} {{@$profile->skills_and_experience}}</textarea>
                        @error('skills_and_experience')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="job_type" class="form-label">Job Types</label>
                        <input value="{{@$profile->job_type}}" id="job_type" type="text" class="form-control" name="job_type" value="{{ old('job_type') }}">
                        @error('job_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input value="{{@$profile->location}}" id="location" type="text" class="form-control" name="location" value="{{ old('location') }}">
                        @error('location')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="desired_salary" class="form-label">Desired Salary</label>
                        <input value="{{@$profile->desired_salary}}" id="desired_salary" type="text" class="form-control" name="desired_salary" value="{{ old('desired_salary') }}">
                        @error('desired_salary')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                
            </div>

        </div>
    </div>
</div>


@endsection
