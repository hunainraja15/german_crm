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
                    <form action="{{route('visa.applicastion')}}" method="post" class="form" enctype="multipart/form-data">
                        @csrf

                        <h3>Candidate Information</h3>
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name (As per Passport)</label>
                            <input value="{{ old('first_name') }}" id="first_name" type="text" class="form-control" name="first_name">
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name (As per Passport)</label>
                            <input value="{{ old('last_name') }}" id="last_name" type="text" class="form-control" name="last_name">
                        </div>

                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth (DD/MM/YYYY)</label>
                            <input value="{{ old('date_of_birth') }}" id="date_of_birth" type="date" class="form-control"
                                name="date_of_birth">
                            </div>

                        <div class="mb-3">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input value="{{ old('nationality') }}" id="nationality" type="text" class="form-control" name="nationality">
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" class="form-control" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="passport_number" class="form-label">Passport Number</label>
                            <input value="{{ old('passport_number') }}" id="passport_number" type="text" class="form-control"
                                name="passport_number">
                            </div>

                        <div class="mb-3">
                            <label for="passport_issue_date" class="form-label">Passport Issue Date</label>
                            <input value="{{ old('passport_issue_date') }}" id="passport_issue_date" type="date" class="form-control"
                                name="passport_issue_date">
                            </div>

                        <div class="mb-3">
                            <label for="passport_expiry_date" class="form-label">Passport Expiry Date</label>
                            <input value="{{ old('passport_expiry_date') }}" id="passport_expiry_date" type="date" class="form-control"
                                name="passport_expiry_date">
                            </div>

                        <div class="mb-3">
                            <label for="email_address" class="form-label">Email Address (Candidate's email)</label>
                            <input value="{{ old('email_address') }}" id="email_address" type="date" class="form-control"
                                name="email_address">
                            </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number (Candidate's contact number)</label>
                            <input value="{{ old('phone_number') }}" id="phone_number" type="tel" class="form-control" name="phone_number">
                        </div>

                        <h3>Job Information</h3>

                        <div class="mb-3">
                            <label for="job_title" class="form-label">Job Title</label>
                            <input value="{{ old('job_title') }}" id="job_title" type="text" class="form-control" name="job_title">
                        </div>

                        <div class="mb-3">
                            <label for="job_role" class="form-label">Job Role Description (Brief description of the job role)</label>
                            <input value="{{ old('job_role') }}" id="job_role" type="text" class="form-control" name="job_role">
                        </div>

                        <div class="mb-3">
                            <label for="industry" class="form-label">Industry</label>
                            <select id="industry" class="form-control" name="industry">
                                <option value="it">IT</option>
                                <option value="healthcare">Healthcare</option>
                                <option value="manufacturing">Manufacturing</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="start_date_of_employment" class="form-label">Start Date of Employment (DD/MM/YYYY)</label>
                            <input value="{{ old('start_date_of_employment') }}" id="start_date_of_employment" type="date" class="form-control"
                                name="start_date_of_employment">
                            </div>

                        <div class="mb-3">
                            <label for="employment_contract_type" class="form-label">Employment Contract Type</label>
                            <select id="employment_contract_type" class="form-control" name="employment_contract_type">
                                <option value="permanent">Permanent</option>
                                <option value="temporary">Temporary</option>
                                <option value="fixed_term">Fixed-Term</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="salary_offered" class="form-label">Salary Offered</label>
                            <input value="{{ old('salary_offered') }}" id="salary_offered" type="number" class="form-control"
                                name="salary_offered">
                            </div>

                        <div class="mb-3">
                            <label for="working_hours" class="form-label">Working Hours (e.g., 40 hours per week)</label>
                            <input value="{{ old('working_hours') }}" id="working_hours" type="number" class="form-control"
                                name="working_hours">
                            </div>

                        <div class="mb-3">
                            <label for="work_location" class="form-label">Work Location (City, Country)</label>
                            <input value="{{ old('work_location') }}" id="work_location" type="text" class="form-control"
                                name="work_location">
                            </div>
                        <h3> Employer Information</h3>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input value="{{ old('company_name') }}" id="company_name" type="text" class="form-control"
                                name="company_name">
                            </div>

                        <div class="mb-3">
                            <label for="company_registration_number" class="form-label">Company Registration Number</label>
                            <input value="{{ old('company_registration_number') }}" id="company_registration_number" type="text" class="form-control"
                                name="company_registration_number">
                            </div>

                        <div class="mb-3">
                            <label for="company_address" class="form-label">Company Address</label>
                            <input value="{{ old('company_address') }}" id="company_address" type="text" class="form-control"
                                name="company_address">
                            </div>

                        <div class="mb-3">
                            <label for="company_phone_number" class="form-label">Company Phone Number</label>
                            <input value="{{ old('company_phone_number') }}" id="company_phone_number" type="tel" class="form-control"
                                name="company_phone_number">
                            </div>

                        <div class="mb-3">
                            <label for="_address" class="form-label">Company Email Address</label>
                            <input value="{{ old('_address') }}" id="_address" type="email" class="form-control"
                                name="_address">
                            </div>

                        <h3>Visa Type and Process</h3>

                        <div class="mb-3">
                            <label for="visa_type_requested" class="form-label">Visa Type Requested</label>
                            <select id="visa_type_requested" class="form-control" name="visa_type_requested">
                                <option value="general_work_visa">General Work Visa</option>
                                <option value="eu_blue_card">EU Blue Card</option>
                                <option value="defizitbescheid_process_visa">Defizitbescheid Process Visa</option>
                                <option value="accelerated_visa">Accelerated Visa (Beschleunigtes Verfahren)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="visa_process_type" class="form-label">Visa Process Type</label>
                            <select id="visa_process_type" class="form-control" name="visa_process_type">
                                <option value="normal_visa_process">Normal Visa Process</option>
                                <option value="recognition_process">Recognition Process</option>
                                <option value="accelerated_visa_procedure">Accelerated Visa Procedure</option>
                            </select>
                        </div>
                        <h3>Qualifications and Certifications</h3>
                        <div class="mb-3">
                            <labellabel for="degree_name" class="form-label">Degree Name (Bachelor’s, Master’s, or
                                equivalent)</labellabel>
                            <input value="{{ old('') }}label" id="degree_name" type="text" class="form-control"
                                name="degree_name">
                            </div>

                        <div class="mb-3">
                            <label for="qualification_files" class="form-label">Qualifications Required for the Role
                                (Job-specific qualifications required for the visa application)</label>
                            <input value="{{ old('') }}"qualifications id="qualification_files" type="file" class="form-control"
                                name="qualification_files[]" multiple>
                            </div>

                        <div class="mb-3">
                            <label for="field_of_study" class="form-label">Field of Study</label>
                            <input value="{{ old('field_of_study') }}" id="field_of_study" type="text" class="form-control"
                                name="field_of_study">
                            </div>

                        <div class="mb-3">
                            <label for="language_proficiency" class="form-label">Language Proficiency Required (e.g., B2 Level in German)</label>
                            <input value="{{ old('language_proficiency') }}" id="language_proficiency" type="text" class="form-control"
                                name="language_proficiency">
                            </div>

                        <div class="mb-3">
                            <label for="additional_certifications" class="form-label">Additional Certifications (e.g., professional licenses, language certificates)</label>
                            <input value="{{ old('additional_certifications') }}" id="additional_certifications" type="file" class="form-control"
                                name="additional_certifications[]" multiple>
                            </div>

                        <h3> Work Permit Details</h3>

                        <div class="mb-3">
                            <label for="work_permit_required" class="form-label">Work Permit Required</label>
                            <select id="work_permit_required" class="form-control" name="work_permit_required">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="job_offer_signed_date" class="form-label">Job Offer Signed Date</label>
                            <input value="{{ old('job_offer_signed_date') }}" id="job_offer_signed_date" type="date" class="form-control"
                                name="job_offer_signed_date">
                            </div>

                        <div class="mb-3">
                            <label for="offer_letter" class="form-label">Offer Letter Upload (Attachment of the signed employment contract)</label>
                            <input value="{{ old('offer_letter') }}" id="offer_letter" type="file" class="form-control"
                                name="offer_letter">
                            </div>

                        <h3>Visa Fees and Payment Information</h3>


                        <div class="mb-3">
                            <label for="aisa_application_fee_payment_confirmation" class="form-label">Visa Application Fee Payment Confirmation</label>
                            <select id="aisa_application_fee_payment_confirmation" type="date"
                                class="form-control" name="aisa_application_fee_payment_confirmation">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method (Credit Card, Bank Transfer)</label>
                            <input value="{{ old('payment_method') }}" id="payment_method" type="text" class="form-control"
                                name="payment_method">
                            </div>

                        <div class="mb-3">
                            <label for="fee_waiver" class="form-label">Fee Waiver Request (If applicable)</label>
                            <input value="{{ old('fee_waiver') }}" id="fee_waiver" type="text" class="form-control"
                                name="fee_waiver">
                            </div>

                        <h3>Document Attachments</h3>
                        
                        <div class="mb-3">
                            <label for="employment_contract" class="form-label">Employment Contract (Signed contract in PDF format)</label>
                            <input value="{{ old('employment_contract') }}" id="employment_contract" type="file" class="form-control"
                                name="employment_contract">
                            </div>

                        <div class="mb-3">
                            <label for="job_description" class="form-label">Job Description (Detailed description of the job in PDF format)</label>
                            <input value="{{ old('job_description') }}" id="job_description" type="file" class="form-control"
                                name="job_description">
                            </div>

                        <div class="mb-3">
                            <label for="company_financials" class="form-label">Company Financials (if required) (Company financial statements, if required)</label>
                            <input value="{{ old('company_financials') }}" id="company_financials" type="file" class="form-control"
                                name="company_financials">
                            </div>

                        <div class="mb-3">
                            <label for="passport_copy" class="form-label">Passport Copy (Scan of the candidate's passport)</label>
                            <input value="{{ old('passport_copy') }}" id="passport_copy" type="file" class="form-control"
                                name="passport_copy">
                            </div>

                        <div class="mb-3">
                            <label for="candidate_qualifications" class="form-label">Candidate's Qualifications (Degree certificates, language certificates)</label>
                            <input value="{{ old('candidate_qualifications') }}" id="candidate_qualifications" type="file" class="form-control"
                                name="candidate_qualifications">
                            </div>

                        <div class="mb-3">
                            <label for="recognition_certificate" class="form-label">Recognition Certificate (if applicable) (Certificate of recognition for foreign qualifications)</label>
                            <input value="{{ old('recognition_certificate') }}" id="recognition_certificate" type="file" class="form-control"
                                name="recognition_certificate">
                            </div>

                        <div class="mb-3">
                            <label for="health_insurance" class="form-label">Health Insurance Confirmation (Proof of health insurance enrollment)</label>
                            <input value="{{ old('health_insurance') }}" id="health_insurance" type="file" class="form-control"
                                name="health_insurance">
                            </div>

                        <h3>Additional Information</h3>

                        <div class="mb-3">
                            <label for="special_instructions" class="form-label">Special Instructions or Notes (Any additional instructions or relevant information)</label>
                            <input value="{{ old('special_instructions') }}" id="special_instructions" type="file" class="form-control"
                                name="special_instructions">
                            </div>

                        <div class="mb-3">
                            <label for="expected_visa_approval_date" class="form-label">Expected Visa Approval Date (If required for internal purposes)</label>
                            <input value="{{ old('expected_visa_approval_date') }}" id="expected_visa_approval_date" type="file" class="form-control"
                                name="expected_visa_approval_date">
                            </div>


                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
