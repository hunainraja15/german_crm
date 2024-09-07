@extends('home')
@section('content')
    <style>
        #sig-canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }

        #sig-canvas,
        #sig-image {
            width: 100%;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th><i class='bx bx-hash'></i></th>
                                <th>Interview Type</th>
                                <th>Interview Date</th>
                                <th>Interview Time Start</th>
                                <th>Interview Time End</th>
                                <th>Duration</th>
                                @if (Auth::user()->role == 'Admin')
                                    <th>Status</th>
                                @else
                                    <th>Accept/Reject</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($interviews as $interview)
                                <tr>
                                    <td>{{ $interview->id }}</td>
                                    <td>{{ $interview->interview_type }}</td>
                                    <td>{{ $interview->interview_date }}</td>
                                    <td>{{ $interview->interview_time_start }}</td>
                                    <td>{{ $interview->interview_time_end }}</td>
                                    <td>{{ $interview->duration }}</td>
                                    @if (Auth::user()->role == 'Admin')
                                        <td>{{ $interview->status }}</td>
                                    @else
                                        <td>
                                            <form action="{{ route('job.interview.status') }}" method="POST" id="actionForm">
                                                @csrf
                                                <input type="hidden" name="interview_status_id"
                                                    value="{{ $interview->id }}">
                                                <div class="m-3">
                                                    <select class="form-select" id="actionSelect" name="selectedAction"
                                                        onchange="this.form.submit()">
                                                        <option disabled
                                                            {{ $interview->status == 'panding' ? 'selected' : '' }}
                                                            value="panding"> Panding</option>
                                                        <option {{ $interview->status == 'reject' ? 'selected' : '' }}
                                                            value="reject">Reject</option>
                                                        <option {{ $interview->status == 'approve' ? 'selected' : '' }}
                                                            value="approve">Approve</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </td>
                                    @endif
                                    
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $interview->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Submit Signature</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('job.signature.file', $interview) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="modal-body">
                                                    <p>Sign in the canvas below and save your signature as an image!</p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <canvas id="sig-canvas" width="620" height="160">
                                                                Get a better browser, bro.
                                                            </canvas>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn btn-primary"
                                                                id="view-signature-btn">View Signature</button>
                                                        </div>
                                                    </div>
                                                    <textarea id="sig-dataUrl" class="form-control d-none" rows="5" readonly>Data URL for your signature will go here!</textarea>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <img id="sig-image" src=""
                                                                alt="Your signature will go here!"
                                                                style="max-width: 100%; height: auto;" />
                                                        </div>
                                                    </div>
                                                    <!-- Hidden file input -->
                                                    <input type="file" id="sig-file" name="signature_file"
                                                        style="display: none;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" id="sig-clearBtn">Clear
                                                        Signature</button>
                                                    <button type="submit" class="btn btn-primary" id="sig-submitBtn">Save
                                                        changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- View Modal -->
                                <div class="modal fade" id="exampleModal2{{ $interview->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">View Signature</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="border m-2 p-5 rounded">
                                                    <img class="w-100" src="{{url('storage/app').'/' . $interview->signature_file}}" alt="">
                                                </div>
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
    </div>



    
@endsection
