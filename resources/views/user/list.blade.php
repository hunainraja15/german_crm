@extends('home')

@section('content')
    <div class="row">
        <div class="my-3 text-end">
            <a class="btn btn-primary text-white" data-toggle="modal" data-target="#addModal"><i class='bx bx-plus'></i> Add
                New</a>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    </div>
                    <form action="{{ route('save.user') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row m-2">
                                <label for="">Name</label>
                                <input type="text" name="name" required class="form-control">
                            </div>

                            <div class="row m-2">
                                <label for="">Email</label>
                                <input type="email" name="email" required class="form-control">
                            </div>

                            <div class="row m-2">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="row m-2">
                                <label for="">Role</label>
                                <select name="role" class="form-control">
                                    <option value="Admin">Admin</option>
                                    <option value="Manager">Manager</option>
                                    <option value="User">User</option>
                                </select>
                            </div>

                            <div class="row m-2">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value="Active">Active</option>
                                    <option value="Deactive">Deactive</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>

                                    <form action="{{ route('user.status.update') }}" method="POST" class="form">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <input type="hidden" name="status" value="{{ $user->status }}">
                                        <button type="submit"
                                            class="badge {{ $user->status == 'deactive' ? 'bg-danger' : 'bg-success' }} text-white">
                                            {{ ucfirst($user->status) }}
                                        </button>
                                    </form>

                                </td>
                                <td>
                                    <!-- Action buttons -->
                                    <a class="h3 p-2" data-toggle="modal" data-target="#addModal{{ $user->id }}"><i
                                            class='bx bx-edit'></i></a>
                                    <a href="{{ route('user.delete', $user) }}" class="h3 p-2"><i
                                            class='bx bxs-trash'></i></a>
                                </td>
                            </tr>

                            <!-- update Modal -->
                            <div class="modal fade" id="addModal{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                                        </div>
                                        <form action="{{ route('update.user') }}" method="post">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <div class="modal-body">
                                                <div class="row m-2">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name"
                                                        value="{{ old('name', $user->name) }}" class="form-control">
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="row m-2">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email"
                                                        value="{{ old('email', $user->email) }}" class="form-control">
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="row m-2">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class="form-control">
                                                    @error('password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="row m-2">
                                                    <label for="role">Role</label>
                                                    <select name="role" class="form-control">
                                                        <option {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}
                                                            value="Admin">Admin</option>
                                                        <option
                                                            {{ old('role', $user->role) == 'Manager' ? 'selected' : '' }}
                                                            value="Manager">Manager</option>
                                                        <option {{ old('role', $user->role) == '    ' ? 'selected' : '' }}
                                                            value="User">User</option>
                                                        <option
                                                            {{ old('role', $user->role) == 'Employer' ? 'selected' : '' }}
                                                            value="Employer">Employer</option>
                                                    </select>
                                                    @error('role')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="row m-2">
                                                    <label for="status">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option
                                                            {{ old('status', $user->status) == 'Active' ? 'selected' : '' }}
                                                            value="Active">Active</option>
                                                        <option
                                                            {{ old('status', $user->status) == 'Deactive' ? 'selected' : '' }}
                                                            value="Deactive">Deactive</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add User</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        @if ($errors->any())
            $(document).ready(function() {
                $('#addModal{{ $user->id }}').modal('show');
            });
        @endif
    </script>
@endsection
