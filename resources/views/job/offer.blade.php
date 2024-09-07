@extends('home')
@section('content')
<style>
    .bxs-file-pdf{
        font-size: 20px;
    }
</style>
    <div class="container mt-5">
        <div class="row">
            <div class="my-3 text-end">
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th><i class='bx bx-hash'></i></th>
                                <th>Employee</th>
                                <th>Job</th>
                                <th>Salary</th>
                                <th>Benefits</th>
                                <th>contractual terms</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($interviews as $interview)
                            {{-- @dd($interview) --}}
                            @if($interview->application && $interview->application->user)
                                <tr>
                                    <td></td>
                                    <td>{{ @$interview->application->user->name }}</td>
                                    <td>{{ @$interview->application->newjob->job_title }}</td>
                                    <td>{{ @$interview->offerCreation->salary }}</td>
                                    <td>{{ @$interview->offerCreation->benefits }}</td>
                                    <td>{{ @$interview->offerCreation->contractual_terms }}</td>
                                    <td>
                                        {{-- @if ( Auth::user()->role != 'Employer') --}}
                                            
                                        
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        {{-- @endif --}}
                                        @if ($interview->offerCreation)
                                        <a href="{{route('interview.pdf', $interview)}}">
                                            <i class='bx bxs-file-pdf'></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Offer Creation</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form action="{{ route('job.offer.update') }}" method="POST" class="form" enctype="multipart/form-data">
                                              @csrf
                                              
                                              <input type="hidden" name="interview_id" value="{{ $interview->id }}">
                                              <div class="modal-body">
                                                  <div class="row mb-2">
                                                      <label for="">Employee</label>
                                                      <input type="text" value="{{ $interview->application->user->name }}" readonly class="form-control">
                                                  </div>
                                                  <div class="row mb-2">
                                                      <label for="">Job</label>
                                                      <input type="text" value="{{ $interview->application->newjob->job_title }}" readonly class="form-control">
                                                  </div>
                                                  <div class="row mb-2">
                                                    <label for="">Salary</label>
                                                    <input 
                                                        type="number" 
                                                        name="salary" 
                                                        class="form-control" 
                                                        value="{{ old('salary', @$interview->offerCreation->salary) }}"
                                                        @if(Auth::user()->role == 'Employer') readonly @endif
                                                    >
                                                    @error('salary')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="row mb-2">
                                                    <label for="">Contractual Terms</label>
                                                    <input 
                                                        type="text" 
                                                        name="contractual_terms" 
                                                        class="form-control" 
                                                        value="{{ old('contractual_terms', @$interview->offerCreation->contractual_terms) }}"
                                                        @if(Auth::user()->role == 'Employer') readonly @endif
                                                    >
                                                    @error('contractual_terms')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="row mb-2">
                                                    <label for="">Benefits</label>
                                                    <textarea 
                                                        name="benefits" 
                                                        class="form-control"
                                                        @if(Auth::user()->role == 'Employer') readonly @endif
                                                    >{{ old('benefits', @$interview->offerCreation->benefits) }}</textarea>
                                                    @error('benefits')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>  

                                                  <div class="row">
                                                    <label for="sig-canvas" class="mt-3 mb-2">
                                                        Signature (submit after viewing)
                                                      </label>
                                                    <div class="col-md-12">
                                                        <canvas id="sig-canvas" class="border border-primary" height="160">
                                                            Get a better browser, bro.
                                                        </canvas>
                                                    </div>
                                                    <div class="col-md-12 mt-2">
                                                        <button id="reset-canvas" type="button" class="btn btn-warning">Reset</button>
                                                    </div>
                                                </div>
                                            
                                                
                                                    <textarea id="sig-dataUrl" class="form-control d-none" rows="5" readonly>Data URL for your signature will go here!</textarea>
                                            
                                                    @if(Auth::user()->role == 'Employer' )
                                                    <!-- Hidden file input -->
                                                    <input type="file" id="sig-file" name="employer_signature" style="display: none;" />
                                                    @else
                                                    <!-- Hidden file input -->
                                                    <input type="file" id="sig-file" name="signature" style="display: none;" />
                                                    @endif
                                            
                                                    <!-- Button to view signature -->
                                                    <button type="button" id="view-signature-btn" class="btn btn-primary mt-2">View Signature</button>
                                            
                                 
                                            
                                                <img id="sig-image" class="mt-2" alt="Your signature will appear here" style="display: none;" />
                                            
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                                </div>

                                @endif
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          @if ($errors->any())
              var exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                  keyboard: false
              });
              exampleModal.show();
          @endif
      });
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
      (function () {
          window.requestAnimFrame = (function (callback) {
              return window.requestAnimationFrame ||
                  window.webkitRequestAnimationFrame ||
                  window.mozRequestAnimationFrame ||
                  window.oRequestAnimationFrame ||
                  window.msRequestAnimationFrame ||
                  function (callback) {
                      window.setTimeout(callback, 1000 / 60);
                  };
          })();

          var canvas = document.getElementById("sig-canvas");
          var ctx = canvas.getContext("2d");
          ctx.strokeStyle = "#222222";
          ctx.lineWidth = 2;

          var drawing = false;
          var mousePos = { x: 0, y: 0 };
          var lastPos = mousePos;

          // Start drawing on click
          $(canvas).on('click', function () {
              console.log("Canvas clicked, start drawing");

              canvas.addEventListener("mousedown", function (e) {
                  drawing = true;
                  lastPos = getMousePos(canvas, e);
              }, false);

              canvas.addEventListener("mouseup", function () {
                  drawing = false;
              }, false);

              canvas.addEventListener("mousemove", function (e) {
                  if (drawing) {
                      mousePos = getMousePos(canvas, e);
                      renderCanvas();
                  }
              }, false);
          });

          function getMousePos(canvasDom, mouseEvent) {
              var rect = canvasDom.getBoundingClientRect();
              return {
                  x: mouseEvent.clientX - rect.left,
                  y: mouseEvent.clientY - rect.top
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

          // Clear the canvas
          function clearCanvas() {
              canvas.width = canvas.width;
          }

          document.getElementById("reset-canvas").addEventListener("click", function () {
              clearCanvas();
          });

          function dataURLtoFile(dataURL, filename) {
              var arr = dataURL.split(','), mime = arr[0].match(/:(.*?);/)[1],
                  bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
              while (n--) {
                  u8arr[n] = bstr.charCodeAt(n);
              }
              return new File([u8arr], filename, { type: mime });
          }

          var sigText = document.getElementById("sig-dataUrl");
          var sigImage = document.getElementById("sig-image");
          var hiddenFileInput = document.getElementById("sig-file");

          // View signature
          document.getElementById("view-signature-btn").addEventListener("click", function () {
              var dataUrl = canvas.toDataURL();
              sigText.value = dataUrl;
              sigImage.setAttribute("src", dataUrl);
              sigImage.style.display = "block"; // Show the image

              var file = dataURLtoFile(dataUrl, 'signature.png');
              var dataTransfer = new DataTransfer();
              dataTransfer.items.add(file);
              hiddenFileInput.files = dataTransfer.files;
          });

          // Handle form submission
          document.getElementById("signature-form").addEventListener("submit", function (event) {
              event.preventDefault(); // Prevent default form submission

              var canvas = document.getElementById("sig-canvas");
              var dataUrl = canvas.toDataURL("image/png"); // Get canvas content as data URL

              // Convert the data URL to a file
              var signatureFile = dataURLtoFile(dataUrl, 'signature.png');

              // Create a new DataTransfer object to assign the file to the hidden file input
              var dataTransfer = new DataTransfer();
              dataTransfer.items.add(signatureFile);

              // Attach the file to the hidden input field
              var hiddenFileInput = document.getElementById("sig-file");
              hiddenFileInput.files = dataTransfer.files;

              // Submit the form after attaching the file
              document.getElementById("signature-form").submit();
          });
      })();
  </script>
@endsection
