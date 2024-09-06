@extends('home')
@section('content')
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                            {{-- @dd($application->newjob) --}}
                                <tr>
                                    <td>{{ $application->id }}</td>
                                    <td>{{ $application->newjob->job_title ?? 'N/A' }}</td> <!-- Assuming 'title' is a field in the 'newjob' model -->
                                    <td>{{ $application->user->name ?? 'N/A' }}</td> <!-- Assuming 'user' is a relationship and 'name' is a field in the 'user' model -->
                                    <td>{{ $application->salary_demand ?? 'N/A' }}</td> <!-- Assuming 'salary_demand' is a field in the 'application' model -->
                                    <td>{{ $application->status }}</td>
                                   
                                    <td>
                                        <form action="{{ route('application.status.update') }}" method="POST" class="form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $application->id }}">
                                            <input type="hidden" name="status" value="{{ $application->status }}">
                                            <button type="submit" class="badge {{ $application->status == 'disapprove' ? 'bg-danger' : 'bg-success' }} text-white">
                                                {{ ucfirst($application->status) }}
                                            </button>
                                        </form>
                                    </td>
                                    
                               </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
@endsection