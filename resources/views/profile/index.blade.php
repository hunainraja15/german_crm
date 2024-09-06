@extends('home')

@section('content')
    <div class="row">
        {{-- <div class="my-3 text-end">
            <a href="{{route('profile.create')}}" class="btn btn-primary text-white" ><i class='bx bx-plus'></i> Add Profile</a>
        </div> --}}
    </div>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px;"><i class='bx bx-hash'></i></th>
                            <th style="width: 10px;">Name</th>
                            <th style="width: 10px;">Email</th>
                            <th style="width: 10px;">Contact Information</th>
                            <th style="width: 10px;">Skills & Experience</th>
                            <th style="width: 10px;">Srarus</th>
                            <th style="width: 10px;">Action</th>
                        </tr>
                    </thead>
                    <thead>
                        {{-- @dd($profiles) --}}
                        @foreach ($profiles as $i => $profile)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$profile->name}}</td>
                                <td>{{$profile->email}}</td>
                                <td>{{$profile->contact_information}}</td>
                                <td>{{$profile->skills_and_experience}}</td>
                                
                               <td>
                                <form action="{{ route('profile.status.update') }}" method="POST" class="form">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $profile->id }}">
                                    <input type="hidden" name="status" value="{{ $profile->status }}">
                                    <button type="submit" class="badge {{ $profile->status == 'deactive' ? 'bg-danger' : 'bg-success' }} text-white">
                                        {{ ucfirst($profile->status) }}
                                    </button>
                                </form>
                               </td>

                                <td class="d-flex justify-content-around">
                                    <!-- Action buttons -->
                                <a class="h3 text-warning" href="{{route('profile.view',$profile)}}"><i class='bx bx-show'></i></a>
                                <a class="h3 text-primary" href="{{route('profile.edit',$profile)}}"><i class='bx bx-edit'></i></a>
                                <a href="{{route('profile.delete', $profile)}}" class="h3 text-danger"><i class='bx bxs-trash'></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
