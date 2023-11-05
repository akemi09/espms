<div>
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $user->name }} - {{ $user->designation }}</h2>
            <p>{{ $user->office->name }}</p>
        </div>

        <div class="col-md-12">
            @include('layouts.flash')
            <div class="accordion mt-3" id="accordionExample">
                @foreach ($target_functions as $key => $target_function)
                    <div class="card accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#accordion{{ $key }}" aria-expanded="false"
                                aria-controls="accordion{{ $key }}">
                                {{ $target_function->name }}
                            </button>
                        </h2>

                        <div id="accordion{{ $key }}" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-response mt-3">
                                    <table class="table mb-3">
                                        <thead>
                                            <tr>
                                                <th>MFO/PAP</th>
                                                <th>Targets</th>
                                                @if ($isAcknowledge == 'no')
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pcrs as $pcr)
                                                @if ($pcr->mfo_pap->target_function_id == $target_function->id)
                                                    <tr>
                                                        <td width="40%">
                                                            {{ $pcr->mfo_pap->title }}
                                                        </td>

                                                        <td width="40%">
                                                            {{ $pcr->targets }}
                                                            @include('components.status', [
                                                                'badgeColor' => $pcr::BADGE_COLOR[$pcr->status],
                                                                'status' => $pcr::STATUS[$pcr->status],
                                                            ])
                                                        </td>

                                                        @if ($isAcknowledge == 'no')
                                                            <td width="20%">
                                                                <button
                                                                    wire:click.prevent="approve({{ $pcr->id }})"
                                                                    title="Approve" type="button"
                                                                    class="btn rounded-pill btn-icon btn-outline-primary btn-sm">
                                                                    <span class="tf-icons bx bx-like"></span>
                                                                </button>
                                                                <button
                                                                    wire:click.prevent="disapprove({{ $pcr->id }})"
                                                                    title="Disapprove" type="button"
                                                                    class="btn rounded-pill btn-icon btn-outline-danger btn-sm">
                                                                    <span class="tf-icons bx bx-dislike"></span>
                                                                </button>
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($isAcknowledge == 'yes')
                <div class="col-md-12 mt-5">
                    <h2>Acknowledged</h2>
                    <p>By: {{ $target_acknowledgement->user->name }}</p>
                    <p>Date/Time: {{ $target_acknowledgement->date_time }}</p>
                    {{-- <p>Remarks: {{ $target_acknowledgement->remarks ?? 'N/A' }}</p> --}}
                    <p>Sign: </p>
                    <img
                        src="{{ asset('storage/' . $target_acknowledgement->sign_url) }}" alt="Sign" width="200" height="150">
                </div>
            @else
                <div class="col-md-12 mt-5">
                    <h2>Confirmation</h2>
                </div>
                <form wire:submit="save">

                    {{-- <div class="form-group col-md-12">
                        <label class="col-form-label font-weight-bold" for="remarks">{{ __('Remarks (optional)') }}
                        </label>
                        <div class="controls">
                            <input name="remarks" class="form-control" id="remarks" type="text" value="">
                        </div>
                        @error('remarks')
                            <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div> --}}
                    <div class="form-group col-md-12">
                        <label class="col-form-label font-weight-bold" for="signatureImage">{{ __('Upload eSign') }}
                            <span class="font-weight-bold">*</span></label>
                        <div class="controls">
                            <input type="file" id="signatureImage" wire:model="signatureImage" class="form-control @error('signatureImage') is-invalid @enderror">
                            {{-- <canvas id="signatureImage" name="signatureImage" class="border"></canvas> --}}
                            {{-- <textarea id="signatureDataUrl" name="signatureDataUrl" class="form-control" rows="5" style="display: none;"></textarea> --}}
                            @error('signatureImage')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                            <div wire:loading wire:target="signatureImage">Uploading...</div>
                        </div>

                    </div>
                    <div class="form-group col-md-12 text-end mt-3">
                        <button id="submitBtn" class="btn btn-primary fw-bold px-3" type="submit">
                            Confirm
                        </button>
                    </div>
                </form>
            @endif


        </div>
    </div>

    @push('scripts')
        <script>
            (function() {
            //     window.requestAnimFrame = (function(callback) {
            //         return window.requestAnimationFrame ||
            //             window.webkitRequestAnimationFrame ||
            //             window.mozRequestAnimationFrame ||
            //             window.oRequestAnimationFrame ||
            //             window.msRequestAnimaitonFrame ||
            //             function(callback) {
            //                 window.setTimeout(callback, 1000 / 60);
            //             };
            //     })();

            //     function fitToContainer(canvas) {
            //         canvas.style.width = '100%';
            //         canvas.style.height = '100%';
            //         canvas.width = canvas.offsetWidth;
            //         canvas.height = canvas.offsetHeight;
            //     }

            //     var canvas = document.getElementById("signatureImage");
            //     var ctx = canvas.getContext("2d");
            //     fitToContainer(canvas);
            //     ctx.strokeStyle = "#222222";
            //     ctx.fillStyle = "#ffffff";
            //     ctx.fillRect(0, 0, canvas.width, canvas.height);
            //     ctx.lineWidth = 4;

            //     var isPristine = true;
            //     var drawing = false;
            //     var mousePos = {
            //         x: 0,
            //         y: 0
            //     };
            //     var lastPos = mousePos;

            //     canvas.onwheel = function(event) {
            //         event.preventDefault();
            //     }

            //     canvas.onmousewheel = function(event) {
            //         event.preventDefault();
            //     }

            //     canvas.addEventListener("mousedown", function(e) {
            //         drawing = true;
            //         lastPos = getMousePos(canvas, e);
            //     }, {
            //         passive: false
            //     });

            //     canvas.addEventListener("mouseup", function(e) {
            //         drawing = false;
            //     }, {
            //         passive: false
            //     });

            //     canvas.addEventListener("mousemove", function(e) {
            //         if (drawing) {
            //             isPristine = false;
            //         }
            //         mousePos = getMousePos(canvas, e);
            //     }, {
            //         passive: false
            //     });

            //     canvas.addEventListener("touchstart", function(e) {
            //         isPristine = false;
            //         mousePos = getTouchPos(canvas, e);
            //         var touch = e.touches[0];
            //         var me = new MouseEvent("mousedown", {
            //             clientX: touch.clientX,
            //             clientY: touch.clientY
            //         });
            //         canvas.dispatchEvent(me);
            //     }, {
            //         passive: false
            //     });

            //     canvas.addEventListener("touchend", function(e) {
            //         var me = new MouseEvent("mouseup", {});
            //         canvas.dispatchEvent(me);
            //     }, {
            //         passive: false
            //     });

            //     canvas.addEventListener("touchmove", function(e) {
            //         var touch = e.touches[0];
            //         var me = new MouseEvent("mousemove", {
            //             clientX: touch.clientX,
            //             clientY: touch.clientY
            //         });
            //         canvas.dispatchEvent(me);
            //     }, {
            //         passive: false
            //     });

            //     function getMousePos(canvasDom, mouseEvent) {
            //         var rect = canvasDom.getBoundingClientRect();
            //         return {
            //             x: mouseEvent.clientX - rect.left,
            //             y: mouseEvent.clientY - rect.top
            //         }
            //     }

            //     function getTouchPos(canvasDom, touchEvent) {
            //         var rect = canvasDom.getBoundingClientRect();
            //         return {
            //             x: touchEvent.touches[0].clientX - rect.left,
            //             y: touchEvent.touches[0].clientY - rect.top
            //         }
            //     }

            //     function renderCanvas() {
            //         if (drawing) {
            //             ctx.moveTo(lastPos.x, lastPos.y);
            //             ctx.lineTo(mousePos.x, mousePos.y);
            //             ctx.stroke();
            //             lastPos = mousePos;
            //         }
            //     }

            //     // Prevent scrolling when touching the canvas
            //     document.body.addEventListener("touchstart", function(e) {
            //         if (e.target == canvas) {
            //             e.preventDefault();
            //         }
            //     }, {
            //         passive: false
            //     });
            //     document.body.addEventListener("touchend", function(e) {
            //         if (e.target == canvas) {
            //             e.preventDefault();
            //         }
            //     }, {
            //         passive: false
            //     });
            //     document.body.addEventListener("touchmove", function(e) {
            //         if (e.target == canvas) {
            //             e.preventDefault();
            //         }
            //     }, {
            //         passive: false
            //     });

            //     (function drawLoop() {
            //         requestAnimFrame(drawLoop);
            //         renderCanvas();
            //     })();


                $('#targetConfirmationForm').submit(function(e) {
                    var sigData = $('#signatureDataUrl');
                    if (!isPristine) {
                        sigData.val(canvas.toDataURL('image/png', 0.30));

                    } else {
                        sigData.val('');
                    }
                });

                $('#isAcknowledged').change(function() {
                    $('#submitBtn').prop('disabled', !this.checked);
                });

                $('#targetConfirmationForm').submit(function(event) {
                    $(this).find(':submit').prop('disabled', true);
                })
            })();
        </script>

        <script>
            function clearCanvas() {
                var canvas = document.getElementById("signatureImage");
                canvas.width = canvas.offsetWidth;
                canvas.height = canvas.offsetHeight;
            }
        </script>
    @endpush
</div>
