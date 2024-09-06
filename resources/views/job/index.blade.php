@extends('home')
@section('content')
    <div class="container">
        <div class="row">
            <div class="my-3 text-end">
                @if (Auth::user()->role != 'User')
                    
                
                <a class="btn btn-primary" href="{{ route('job.create') }}"><i class='bx bx-plus'></i> Add Job</a>
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th><i class='bx bx-hash'></i></th>
                                <th>Job Title</th>
                                <th>Job Location</th>
                                <th>Employment Type</th>
                                <th>Industry</th>
                                <th>Salary Range</th>
                                <th>Application Deadline</th>
                                <th>Visibility</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jobs as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>{{ $job->job_title }}</td>
                                <td>{{ $job->job_location }}</td>
                                <td>{{ $job->employment_type }}</td>
                                <td>{{ $job->industry }}</td>
                                <td>{{ $job->salary_range }}</td>
                                <td>{{ $job->application_deadline }}</td>
                                <td>{{ $job->visibility }}</td>
                                @if (Auth::user()->role == 'User')
                                <td>
                                    <a class="h3 btn btn-primary d-flex" href="{{ route('job.apply', $job) }}">Apply<i class='bx bx-user-pin'></i></a>
                                </td>
                                    @else
                                    <td class="d-flex justify-content-around">
                                        {{-- <a class="h3 text-warning" href="{{ route('job.view', $job) }}"><i class='bx bx-show'></i></a> --}}
                                        <a class="h3 text-primary" href="{{ route('job.edit', $job) }}"><i class='bx bx-edit'></i></a>
                                        <a href="{{ route('job.delete', $job) }}" class="h3 text-danger"><i class='bx bxs-trash'></i></a>
    
                                    </td>
                                @endif
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No jobs available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
