@extends('home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h2>Job Creation</h2>
                </div>
                <form 
                action="{{ Route::is('job.create') ? route('job.store') : route('job.update', $job->id) }}" 
                method="POST"
            >
                @csrf
                @if(Route::is('job.edit'))
                    @method('POST')
                @endif
            
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="job_title" class="form-label">Job Title</label>
                            <input id="job_title" type="text" class="form-control"
                                name="job_title" value="{{ old('job_title', @$job->job_title) }}">
                            @error('job_title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="job_description" class="form-label">Job Description</label>
                            <input id="job_description" type="text" class="form-control"
                                name="job_description" value="{{ old('job_description', @$job->job_description) }}">
                            @error('job_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="job_location" class="form-label">Job Location</label>
                            <input id="job_location" type="text" class="form-control"
                                name="job_location" value="{{ old('job_location', @$job->job_location) }}">
                            @error('job_location')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="employment_type" class="form-label">Employment Type</label>
                            <input id="employment_type" type="text" class="form-control"
                                name="employment_type" value="{{ old('employment_type', @$job->employment_type) }}">
                            @error('employment_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="industry" class="form-label">Industry</label>
                            <input id="industry" type="text" class="form-control"
                                name="industry" value="{{ old('industry', @$job->industry) }}">
                            @error('industry')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="salary_range" class="form-label">Salary Range</label>
                            <input value="{{ old('salary_range_min', @$job->salary_range_min) }}" id="salary_range_min" name="salary_range_min" type="number" class="form-control mb-2" placeholder="Min Salary" min="0" step="1000">
                            @error('salary_range_min')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input value="{{ old('salary_range_max', @$job->salary_range_max) }}" id="salary_range_max" type="number" class="form-control" placeholder="Max Salary" name="salary_range_max" min="0" step="1000">
                            @error('salary_range_max')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input id="salary_range" type="range" min="0" max="100000" step="1000" value="{{ old('salary_range_max', @$job->salary_range_max) }}" class="form-control mt-2">
                            <span id="salary_range_display" class="form-text">{{ old('salary_range_min', @$job->salary_range_min) }} - {{ old('salary_range_max', @$job->salary_range_max) }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="application_deadline" class="form-label">Application Deadline</label>
                            <input id="application_deadline" type="date" class="form-control"
                                name="application_deadline" value="{{ old('application_deadline', @$job->application_deadline) }}">
                            @error('application_deadline')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="required_qualifications" class="form-label">Required Qualifications</label>
                            <input id="required_qualifications" type="text" class="form-control"
                                name="required_qualifications" value="{{ old('required_qualifications', @$job->required_qualifications) }}">
                            @error('required_qualifications')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="preferred_qualifications" class="form-label">Preferred Qualifications</label>
                            <input id="preferred_qualifications" type="text" class="form-control"
                                name="preferred_qualifications" value="{{ old('preferred_qualifications', @$job->preferred_qualifications) }}">
                            @error('preferred_qualifications')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="education_level" class="form-label">Education Level</label>
                            <input id="education_level" type="text" class="form-control"
                                name="education_level" value="{{ old('education_level', @$job->education_level) }}">
                            @error('education_level')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="experience_required" class="form-label">Experience Required</label>
                            <input id="experience_required" type="text" class="form-control"
                                name="experience_required" value="{{ old('experience_required', @$job->experience_required) }}">
                            @error('experience_required')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input id="company_name" type="text" class="form-control"
                                name="company_name" value="{{ old('company_name', @$job->company_name) }}">
                            @error('company_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="company_website" class="form-label">Company Website</label>
                            <input id="company_website" type="url" class="form-control"
                                name="company_website" value="{{ old('company_website', @$job->company_website) }}">
                            @error('company_website')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="visibility" class="form-label">Visibility</label>
                            <select name="visibility" id="visibility" class="form-control">
                               
                                <option value="private" {{ old('visibility', @$job->visibility) == 'private' ? 'selected' : '' }}>Save</option>
                                <option value="public" {{ old('visibility', @$job->visibility) == 'public' ? 'selected' : '' }}>Submit</option>
                            </select>
                            @error('visibility')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ Route::is('job.create') ? 'Create Job' : 'Update Job' }}</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const rangeInput = document.getElementById('salary_range');
        const minInput = document.getElementById('salary_range_min');
        const maxInput = document.getElementById('salary_range_max');
        const display = document.getElementById('salary_range_display');
    
        function updateDisplay() {
            const minValue = minInput.value || 0;
            const maxValue = maxInput.value || 100000;
            display.textContent = `${minValue} - ${maxValue}`;
        }
    
        rangeInput.addEventListener('input', (event) => {
            minInput.value = event.target.value;
            updateDisplay();
        });
    
        minInput.addEventListener('input', updateDisplay);
        maxInput.addEventListener('input', updateDisplay);
    </script>
@endsection
