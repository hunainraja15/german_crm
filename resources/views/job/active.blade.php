@extends('home')
@section('content')
    <style>
        .close {
            cur
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Job Title</th>
                                <th>User Name</th>
                                <th>Salary Demand</th>
                                <th>Job Status</th>
                                <th>Interview</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                                {{-- @dd($application->interview) --}}
                                <tr>
                                    <td>{{ $application->id }}</td>
                                    <td>{{ $application->newjob->job_title ?? 'N/A' }}</td>
                                    <!-- Assuming 'title' is a field in the 'newjob' model -->
                                    <td>{{ $application->user->name ?? 'N/A' }}</td>
                                    <!-- Assuming 'user' is a relationship and 'name' is a field in the 'user' model -->
                                    <td>{{ $application->salary_demand ?? 'N/A' }}</td>
                                    <!-- Assuming 'salary_demand' is a field in the 'application' model -->
                                    <td>{{ $application->status }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal1">
                                            Interview
                                        </button>
                                    </td>
                                    <td>
                                        <form action="{{ route('application.status.update') }}" method="POST"
                                            class="form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $application->id }}">
                                            <input type="hidden" name="status" value="{{ $application->status }}">
                                            <button type="submit"
                                                class="badge {{ $application->status == 'disapprove' ? 'bg-danger' : 'bg-success' }} text-white">
                                                {{ ucfirst($application->status) }}
                                            </button>
                                        </form>

                                    </td>
                                </tr>


                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Interview Scheduling</h5>

                                            </div>
                                            <form action="{{ route('job.interview.store') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="application_id" value="{{$application->id}}" id="">
                                                    <div class="row m-2">
                                                        <label for="interview_type">Interview Type</label>
                                                        <select required name="interview_type" id="interview_type"
                                                            class="form-control">
                                                            <option value="virtual" {{ @$application->interview->interview_type == 'virtual' ? 'selected' : '' }}>Virtual</option>
                                                            <option value="in_person" {{ @$application->interview->interview_type == 'in_person' ? 'selected' : '' }}>In-Person</option>


                                                        </select>
                                                    </div>
                                                    <div class="row m-2">
                                                        <label for="interview_date">Interview Date</label>
                                                        <input type="date" value="{{ @$application->interview->interview_date}}" name="interview_date" id="interview_date"
                                                            required class="form-control">
                                                    </div>

                                                    <div class="row m-2">
                                                        <label for="interview_time_start">Interview Start Time</label>
                                                        <input type="time"  value="{{ @$application->interview->interview_time_start}}" name="interview_time_start"
                                                            id="interview_time_start" required class="form-control">
                                                    </div>

                                                    <div class="row m-2">
                                                        <label for="interview_time_end">Interview End Time</label>
                                                        <input type="time" name="interview_time_end"  value="{{ @$application->interview->interview_time_end}}"
                                                            id="interview_time_end" required class="form-control">
                                                    </div>

                                                    <div class="row m-2">
                                                        <label for="duration">Duration (HH:MM)</label>
                                                        <input type="text"  value="{{ @$application->interview->duration}}" name="duration" id="duration"
                                                            class="form-control" readonly>
                                                    </div>
                                                    
                                                    <div class="row m-2">
                                                        <label for="special_request">Special Requests</label>
                                                        <textarea type="text" name="special_request" id="special_request"
                                                            class="form-control"> {{ @$application->interview->special_request}}</textarea>
                                                    </div>
                                                    


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary sibmitBtn">Save changes</button>
                                                </div>
                                                <form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- Custom JS -->
<script>
    // Function to calculate duration and control submit button
    function calculateDuration() {
      var startTime = document.getElementById("interview_time_start").value;
      var endTime = document.getElementById("interview_time_end").value;
      var submitButton = document.querySelector(".submitBtn");
  
      if (startTime && endTime) {
        var start = new Date("01/01/2021 " + startTime);
        var end = new Date("01/01/2021 " + endTime);
  
        var diff = (end - start) / 1000 / 60; // difference in minutes
        var hours = Math.floor(diff / 60);
        var minutes = diff % 60;
  
        // If the duration is negative (end time before start time), reset duration, show alert and disable submit button
        if (diff < 0) {
          document.getElementById("duration").value = "Invalid Time";
          alert("End time cannot be earlier than start time.");
          submitButton.disabled = true; // Disable the submit button
        } else {
          document.getElementById("duration").value = `${hours}:${minutes < 10 ? '0' + minutes : minutes}`;
          submitButton.disabled = false; // Enable the submit button
        }
      } else {
        // If either start time or end time is not selected, disable the submit button
        submitButton.disabled = true;
      }
    }
  
    // When the start time is selected, enable the end time field and set the minimum time
    document.getElementById("interview_time_start").addEventListener("input", function() {
      var startTime = this.value;
      var endTimeField = document.getElementById("interview_time_end");
  
      if (startTime) {
        // Enable end time field
        endTimeField.disabled = false;
  
        // Set the minimum value of end time based on start time
        endTimeField.min = startTime;
  
        // Automatically calculate the duration when start time changes
        calculateDuration();
      }
    });
  
    // Automatically calculate duration when the end time changes
    document.getElementById("interview_time_end").addEventListener("input", calculateDuration);
  </script>
  
@endsection
