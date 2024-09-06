@extends('home')

@section('content')
    <div class="row">
        {{-- <div class="my-3 text-end">
            <a class="btn btn-primary text-white" data-toggle="modal" data-target="#addModal"><i class='bx bx-plus'></i> Add
                New</a>
        </div> --}}

        <!-- Create Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    </div>
                    <!-- Add form content here -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $index => $application)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $application->user->name }}</td>
        <td>{{ $application->user->email }}</td>
        <td>
            <form action="{{ route('user.role.update') }}" method="POST" class="form">
                @csrf
                <input type="hidden" name="id" value="{{ $application->user->id }}">
                <input type="hidden" name="role" value="{{ $application->user->role == 'User' ? 'Employer' : 'User' }}">
                <button type="submit" class="badge {{ $application->user->role == 'Employer' ? 'bg-success' : 'bg-danger' }} text-white">
                    {{ ucfirst($application->user->role) }}
                </button>
            </form>
        </td>
    </tr>
@endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
