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
                                    @if (Auth::user()->role == 'Admin' && $interview->status == 'approve')
                                        <td>
                                            @if ($interview->signature == false)
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('job.signature.update', $interview) }}">Assign
                                                    Signature</a>
                                            @endif
                                        </td>

                                        @if ($interview->signature_file == null)
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $interview->id }}">
                                                    Signature
                                                </button>
                                            </td>
                                        @else
                                           <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal2{{ $interview->id }}">
                                            View Signature
                                        </button>
                                           </td>
                                        @endif
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



    <script>
        (function() {
    window.requestAnimFrame = (function(callback) {
        return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function(callback) {
                window.setTimeout(callback, 1000 / 60);
            };
    })();

    var canvas = document.getElementById("sig-canvas");
    var ctx = canvas.getContext("2d");
    ctx.strokeStyle = "#222222";
    ctx.lineWidth = 4;

    var drawing = false;
    var mousePos = {
        x: 0,
        y: 0
    };
    var lastPos = mousePos;

    canvas.addEventListener("mousedown", function(e) {
        drawing = true;
        lastPos = getMousePos(canvas, e);
    }, false);

    canvas.addEventListener("mouseup", function(e) {
        drawing = false;
    }, false);

    canvas.addEventListener("mousemove", function(e) {
        if (drawing) {
            mousePos = getMousePos(canvas, e);
            renderCanvas();
        }
    }, false);

    canvas.addEventListener("touchstart", function(e) {
        mousePos = getTouchPos(canvas, e);
        drawing = true;
    }, false);

    canvas.addEventListener("touchend", function(e) {
        drawing = false;
    }, false);

    canvas.addEventListener("touchmove", function(e) {
        var touch = e.touches[0];
        var me = new MouseEvent("mousemove", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(me);
    }, false);

    function getMousePos(canvasDom, mouseEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: mouseEvent.clientX - rect.left,
            y: mouseEvent.clientY - rect.top
        }
    }

    function getTouchPos(canvasDom, touchEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: touchEvent.touches[0].clientX - rect.left,
            y: touchEvent.touches[0].clientY - rect.top
        }
    }

    function renderCanvas() {
        if (drawing) {
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(mousePos.x, mousePos.y);
            ctx.stroke();
            lastPos = mousePos;
        }
    }

    document.body.addEventListener("touchstart", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);

    document.body.addEventListener("touchend", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);

    document.body.addEventListener("touchmove", function(e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);

    (function drawLoop() {
        requestAnimFrame(drawLoop);
        renderCanvas();
    })();

    function clearCanvas() {
        canvas.width = canvas.width;
    }

    function dataURLtoFile(dataURL, filename) {
        var arr = dataURL.split(','), mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], filename, {type: mime});
    }

    var sigText = document.getElementById("sig-dataUrl");
    var sigImage = document.getElementById("sig-image");
    var clearBtn = document.getElementById("sig-clearBtn");
    var viewSignatureBtn = document.getElementById("view-signature-btn");
    var hiddenFileInput = document.getElementById("sig-file");

    clearBtn.addEventListener("click", function(e) {
        clearCanvas();
        sigText.value = "Data URL for your signature will go here!";
        sigImage.setAttribute("src", "");
        hiddenFileInput.files = []; // Clear the hidden file input
    }, false);

    viewSignatureBtn.addEventListener("click", function(e) {
        var dataUrl = canvas.toDataURL();
        sigText.value = dataUrl;
        sigImage.setAttribute("src", dataUrl);

        // Convert data URL to file and attach it to the hidden file input
        var file = dataURLtoFile(dataUrl, 'signature.png');
        var dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        hiddenFileInput.files = dataTransfer.files;
    }, false);

})();

    </script>
@endsection
