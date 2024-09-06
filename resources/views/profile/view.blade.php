@extends('home')
@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Profile Image Section -->
                <div class="col-md-4 text-center">
                    <img style="width: 200px;" src="https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o=" class="rounded-circle img-fluid" alt="User Image">
                    <h2 class="mt-3">{{$profile->name ?? 'Name not found'}}</h2>
                    <p class="text-muted">{{$profile->email ?? 'Email not found'}}</p>
                </div>

                <!-- Profile Information Section -->
                <div class="col-md-8">
                    <h3 class="card-title">Profile Information</h3>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Profile Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$profile->name ?? 'Profile name not found'}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Profile Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$profile->email ?? 'Profile email not found'}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Contact Information</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$profile->contact_information ??'Profile Contact Information not found'}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Skills & Experience</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$profile->skills_and_experience ?? 'Profile Skills & Experience not found'}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0"></h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            
                        </div>
                    </div>
                    
                </div>
                <hr>
            </div>

           
            <div class="row mt-4">
                <div class="col-md-12">
                    <h3 class="card-title">Profile Details</h3>
                   <div class="row">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ @$profile->name }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ @$profile->email }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="Contact" class="form-label">Contact Information</label>
                        <input id="Contact" type="text" class="form-control" name="contact_information" value="{{ @$profile->contact_information }}" readonly>
                    </div>
                    
                    <!-- Removed file inputs as requested -->
                    
                    <div class="mb-3">
                        <label for="skills_and_experience" class="form-label">Skills and Experience</label>
                        <textarea id="skills_and_experience" class="form-control" rows="10" name="skills_and_experience" placeholder="Enter details about your skills, work experience, and education" readonly>{{ @$profile->skills_and_experience }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="job_type" class="form-label">Job Types</label>
                        <input id="job_type" type="text" class="form-control" name="job_type" value="{{ @$profile->job_type }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input id="location" type="text" class="form-control" name="location" value="{{ @$profile->location }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="desired_salary" class="form-label">Desired Salary</label>
                        <input id="desired_salary" type="text" class="form-control" name="desired_salary" value="{{ @$profile->desired_salary }}" readonly>
                    </div>
                    
                   </div>
                </div>
            </div>

             <!-- Profile Details Section -->
             @if($profile && $profile->profileFiles && $profile->profileFiles->isNotEmpty())
             <div class="row">
                 @foreach($profile->profileFiles as $file)
                     {{-- Card for upload video interview --}}
                     @if (!empty($file->upload_videointerview))
                         <div class="col-4 mb-3">
                             <div class="card">
                                 <div class="card-header">
                                     Upload Video Interview
                                 </div>
                                 <div class="card-body">
                                     <a href="{{ $file->upload_videointerview }}" class="btn btn-primary" download>Download Upload Video Interview</a>
                                 </div>
                             </div>
                         </div>
                     @endif
         
                     {{-- Card for resume --}}
                     @if (!empty($file->resume))
                         <div class="col-4 mb-3">
                             <div class="card">
                                 <div class="card-header">
                                     Resume
                                 </div>
                                 <div class="card-body">
                                     <a href="{{ $file->resume }}" class="btn btn-primary" download>Download Resume</a>
                                 </div>
                             </div>
                         </div>
                     @endif
         
                     {{-- Card for cover letter --}}
                     @if (!empty($file->cover_letter))
                         <div class="col-4 mb-3">
                             <div class="card">
                                 <div class="card-header">
                                     Cover Letter
                                 </div>
                                 <div class="card-body">
                                     <a href="{{ $file->cover_letter }}" class="btn btn-primary" download>Download Cover Letter</a>
                                 </div>
                             </div>
                         </div>
                     @endif
         
                     {{-- Card for qualification documents --}}
                     @if (!empty($file->qualification_documents))
                         <div class="col-4 mb-3">
                             <div class="card">
                                 <div class="card-header">
                                     Qualification Documents
                                 </div>
                                 <div class="card-body">
                                     <a href="{{ $file->qualification_documents }}" class="btn btn-primary" download>Download Qualification Documents</a>
                                 </div>
                             </div>
                         </div>
                     @endif
         
                     {{-- Card for language certificates --}}
                     @if (!empty($file->language_certificates))
                         <div class="col-4 mb-3">
                             <div class="card">
                                 <div class="card-header">
                                     Language Certificates
                                 </div>
                                 <div class="card-body">
                                     <a href="{{ $file->language_certificates }}" class="btn btn-primary" download>Download Language Certificates</a>
                                 </div>
                             </div>
                         </div>
                     @endif
                 @endforeach
             </div>
         @else
             <p>No profile or profile files available.</p>
         @endif
         
            
        </div>
    </div>
</div>

@endsection
