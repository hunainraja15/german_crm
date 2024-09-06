@extends('home')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filteredProfiles as $profile)
                            <tr>
                                <td>{{ $profile->id }}</td>
                                <td>{{ $profile->name }}</td>
                                <td>{{ $profile->email }}</td>
                                <td>{{ $profile->location }}</td>
                                <td>{{ ucfirst($profile->status) }}</td>
                                <td>
                                    <!-- Action buttons (for example, Edit or Delete) -->
                                    <a href="{{ route('visa.submit', $profile->id) }}" class="btn btn-sm btn-primary">Send visa</a>
                                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Show message if no profiles are available -->
                @if ($filteredProfiles->isEmpty())
                    <p>No profiles found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
