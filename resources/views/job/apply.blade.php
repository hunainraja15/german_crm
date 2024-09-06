@extends('home')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Job Application Form</h3>
                </div>
                <div class="card-body">
                    {{-- @dd($job) --}}
                    <form action="{{ route('job.application.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h4>Select Job</h4>
                        <div class="mb-3">
                            <label for="job" class="form-label">Job Title</label>
                            <!-- Select dropdown with conditionally applied disabled attribute -->
                            <select name="job" id="job" class="form-control" {{ isset($job) ? 'disabled' : '' }}>
                                @if (isset($job) && $job instanceof \App\Models\NewJob)
                                    <!-- If $job is a single job instance -->
                                    <option value="{{ $job->id }}" selected>{{ $job->job_title }}</option>
                                @else
                                    <!-- If $jobs is a collection of job instances -->
                                    @foreach ($jobs as $value)
                                        <option value="{{ $value->id }}">{{ $value->job_title }}</option>
                                    @endforeach
                                @endif
                            </select>

                            <!-- Hidden input field to ensure job ID is submitted -->
                            @if (isset($job) && $job instanceof \App\Models\NewJob)
                                <input type="hidden" name="job" value="{{ $job->id }}">
                            @endif


                        </div>
                    
                        <div class="mb-3">
                            <label for="salary_demand" class="form-label">Salary Demand ({{@$job->salary_range}})</label>
                            <input id="fullName" type="number" class="form-control" name="salary_demand"
                                value="{{ old('salary_demand') }}">
                            @error('salary_demand')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Personal Information -->
                        <h4>Personal Information</h4>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input id="fullName" type="text" class="form-control" name="full_name"
                                value="{{ old('full_name') }}">
                            @error('full_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input id="phoneNumber" type="text" class="form-control" name="phone_number"
                                value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input id="dob" type="date" class="form-control" name="date_of_birth"
                                value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <div>
                                <input type="radio" id="male" name="gender" value="Male"
                                    {{ old('gender') == 'Male' ? 'checked' : '' }}>
                                <label for="male">Male</label>
                            </div>
                            <div>
                                <input type="radio" id="female" name="gender" value="Female"
                                    {{ old('gender') == 'Female' ? 'checked' : '' }}>
                                <label for="female">Female</label>
                            </div>
                            <div>
                                <input type="radio" id="other" name="gender" value="Other"
                                    {{ old('gender') == 'Other' ? 'checked' : '' }}>
                                <label for="other">Other</label>
                            </div>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input id="address" type="text" class="form-control" name="street_address"
                                placeholder="Street Address" value="{{ old('street_address') }}">
                            <input type="text" class="form-control mt-2" name="city" placeholder="City"
                                value="{{ old('city') }}">
                            <input type="text" class="form-control mt-2" name="state" placeholder="State/Province"
                                value="{{ old('state') }}">
                            <input type="number" class="form-control mt-2" min="10" name="postal_code" placeholder="Postal Code"
                                value="{{
                                 old('postal_code') }}">
                            <input type="text" class="form-control mt-2" name="country" placeholder="Country Name"
                                value="{{ old('country') }}">

                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Professional Information -->
                        <h4>Professional Information</h4>
                        <div class="mb-3">
                            <label for="resume" class="form-label">Resume/CV Upload</label>
                            <input id="resume" type="file" class="form-control" name="resume"
                                accept=".pdf,.docx">
                            @error('resume')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="coverLetter" class="form-label">Cover Letter Upload (Optional)</label>
                            <input id="coverLetter" type="file" class="form-control" name="cover_letter"
                                accept=".pdf,.docx">
                            @error('cover_letter')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="linkedinProfile" class="form-label">LinkedIn Profile</label>
                            <input id="linkedinProfile" type="url" class="form-control" name="linkedin_profile"
                                value="{{ old('linkedin_profile') }}">
                            @error('linkedin_profile')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="portfolio" class="form-label">Portfolio Website (Optional)</label>
                            <input id="portfolio" type="url" class="form-control" name="portfolio_website"
                                value="{{ old('portfolio_website') }}">
                            @error('portfolio_website')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="professionalSummary" class="form-label">Professional Summary</label>
                            <textarea id="professionalSummary" class="form-control" name="professional_summary">{{ old('professional_summary') }}</textarea>
                            @error('professional_summary')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Education -->
                        <h4>Education</h4>
                        <div class="mb-3">
                            <label for="educationLevel" class="form-label">Highest Level of Education</label>
                            <select id="educationLevel" class="form-control" name="education_level">
                                <option value="">Select Level</option>
                                <option value="High School"
                                    {{ old('education_level') == 'High School' ? 'selected' : '' }}>High School</option>
                                <option value="Associate’s Degree"
                                    {{ old('education_level') == 'Associate’s Degree' ? 'selected' : '' }}>Associate’s
                                    Degree</option>
                                <option value="Bachelor’s Degree"
                                    {{ old('education_level') == 'Bachelor’s Degree' ? 'selected' : '' }}>Bachelor’s Degree
                                </option>
                                <option value="Master’s Degree"
                                    {{ old('education_level') == 'Master’s Degree' ? 'selected' : '' }}>Master’s Degree
                                </option>
                                <option value="Doctorate" {{ old('education_level') == 'Doctorate' ? 'selected' : '' }}>
                                    Doctorate</option>
                            </select>
                            @error('education_level')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="institutionName" class="form-label">Institution Name</label>
                            <input id="institutionName" type="text" class="form-control" name="institution_name"
                                value="{{ old('institution_name') }}">
                            @error('institution_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fieldOfStudy" class="form-label">Field of Study</label>
                            <input id="fieldOfStudy" type="text" class="form-control" name="field_of_study"
                                value="{{ old('field_of_study') }}">
                            @error('field_of_study')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="graduationDate" class="form-label">Graduation Date</label>
                            <input id="graduationDate" type="date" class="form-control" name="graduation_date"
                                value="{{ old('graduation_date') }}">
                            @error('graduation_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Work Experience -->
                        <h4>Work Experience</h4>
                        <div id="workExperienceContainer">
                            <div class="mb-3 work-experience">
                                <label for="jobTitle" class="form-label">Current/Most Recent Job Title</label>
                                <input id="jobTitle" type="text" class="form-control" name="job_title"
                                    value="{{ old('job_title') }}">
                                @error('job_title.*')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="companyName" class="form-label">Company Name</label>
                                <input id="companyName" type="text" class="form-control" name="company_name"
                                    value="{{ old('company_name') }}">
                                @error('company_name.*')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input id="startDate" type="date" class="form-control" name="start_date"
                                    value="{{ old('start_date') }}">
                                @error('start_date.*')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="endDate" class="form-label">End Date</label>
                                <input id="endDate" type="date" class="form-control" name="end_date"
                                    value="{{ old('end_date') }}">
                                @error('end_date.*')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="responsibilities" class="form-label">Responsibilities</label>
                                <textarea id="responsibilities" class="form-control" name="responsibilities">{{ old('responsibilities') }}</textarea>
                                @error('responsibilities.*')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <!-- Skills -->
                        <h4>Skills</h4>
                        <div class="mb-3">
                            <label for="keySkills" class="form-label">Key Skills</label>
                            <textarea id="keySkills" class="form-control" name="key_skills">{{ old('key_skills') }}</textarea>
                            @error('key_skills')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="certifications" class="form-label">Certifications and Licenses</label>
                            <input id="certifications" type="text" class="form-control" name="certifications"
                                value="{{ old('certifications') }}">
                            @error('certifications')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Job Preferences -->
                        <h4>Job Preferences</h4>
                        <div class="mb-3">
                            <label for="jobType" class="form-label">Job Type</label>
                            <select id="jobType" class="form-control" name="job_type">
                                <option value="">Select Job Type</option>
                                <option value="Full-time" {{ old('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time
                                </option>
                                <option value="Part-time" {{ old('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time
                                </option>
                                <option value="Contract" {{ old('job_type') == 'Contract' ? 'selected' : '' }}>Contract
                                </option>
                                <option value="Internship" {{ old('job_type') == 'Internship' ? 'selected' : '' }}>
                                    Internship</option>
                            </select>
                            @error('job_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="preferredLocation" class="form-label">Preferred Job Location</label>
                            <input id="preferredLocation" type="text" class="form-control" name="preferred_location"
                                value="{{ old('preferred_location') }}">
                            @error('preferred_location')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="desiredSalary" class="form-label">Desired Salary</label>
                            <input id="desiredSalary" type="number" class="form-control" name="desired_salary"
                                value="{{ old('desired_salary') }}">
                            @error('desired_salary')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Language Proficiency -->
                        <h4>Language Proficiency</h4>
                        <div class="mb-3">
                            <label for="languagesSpoken" class="form-label">Languages Spoken</label>
                            <select id="languagesSpoken" class="form-control" name="languages_spoken">
                                <option value="English" {{ old('languages_spoken') ? 'selected' : '' }}>English</option>
                                <option value="Spanish" {{ old('languages_spoken') ? 'selected' : '' }}>Spanish</option>
                                <!-- Add more languages here -->
                            </select>
                            @error('languages_spoken')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="proficiencyLevel" class="form-label">Proficiency Level</label>
                            <select id="proficiencyLevel" class="form-control" name="proficiency_level">
                                <option value="">Select Level</option>
                                <option value="Basic" {{ old('proficiency_level') == 'Basic' ? 'selected' : '' }}>Basic
                                </option>
                                <option value="Intermediate"
                                    {{ old('proficiency_level') == 'Intermediate' ? 'selected' : '' }}>Intermediate
                                </option>
                                <option value="Fluent" {{ old('proficiency_level') == 'Fluent' ? 'selected' : '' }}>Fluent
                                </option>
                                <option value="Native" {{ old('proficiency_level') == 'Native' ? 'selected' : '' }}>Native
                                </option>
                            </select>
                            @error('proficiency_level')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Additional Information -->
                        <h4>Additional Information</h4>
                        <div class="mb-3">
                            <label for="whyThisJob" class="form-label">Why Do You Want This Job?</label>
                            <textarea id="whyThisJob" class="form-control" name="why_this_job">{{ old('why_this_job') }}</textarea>
                            @error('why_this_job')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Are You Willing to Relocate?</label>
                            <div>
                                <input type="radio" id="relocateYes" name="willing_to_relocate" value="Yes"
                                    {{ old('willing_to_relocate') == 'Yes' ? 'checked' : '' }}>
                                <label for="relocateYes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" id="relocateNo" name="willing_to_relocate" value="No"
                                    {{ old('willing_to_relocate') == 'No' ? 'checked' : '' }}>
                                <label for="relocateNo">No</label>
                            </div>
                            @error('willing_to_relocate')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="availability" class="form-label">Availability to Start</label>
                            <input id="availability" type="date" class="form-control" name="availability_to_start"
                                value="{{ old('availability_to_start') }}">
                            @error('availability_to_start')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                           
                        
                        <!-- Agreement and Submission -->
                        <h4>Agreement and Submission</h4>
                        <div class="mb-3">
                            <input type="checkbox" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}>
                            <label for="terms">I agree to the <a href="#">Terms and Conditions</a></label>
                            @error('terms')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" id="privacy" name="privacy" {{ old('privacy') ? 'checked' : '' }}>
                            <label for="privacy">I agree to the <a href="#">Privacy Policy</a></label>
                            @error('privacy')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <!-- Implement CAPTCHA here -->
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </form>
                </div>
            </div>
        </div>

        
    @endsection
