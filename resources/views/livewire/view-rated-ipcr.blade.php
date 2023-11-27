<div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('generate.report', ['type' => 'ipcr', 'user' => $user->id]) }}" target="_blank" class="btn btn-link float-end"><i class="menu-icon tf-icons bx bx-download"></i>Download as PDF</a>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <p class="fw-bold">
            INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR)
        </p>
    </div>

    <div class="col-md-12">
        <p>
            I, <u>{{ Str::upper($user->name) }}</u>, faculty of the College of {{ Str::upper($user->office->name) }},
            commits to deliver and agree to be rated on the attainment of the following targets in accordance with the
            indicated measures for the period January to June 2023.</u>
        </p>
    </div>

    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>Noted by:</th>
                    <th>Verified by:</th>
                    <th>Approved by:</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p class="text-center mt-3">
                                CHALLIZ D. OMOROG, DIT
                            </p>
                            <p class="lh-1 text-center">Dean</p>
                        </td>
                        <td>
                            <p class="text-center mt-3">
                                ESTELITO R. CLEMENTE, PhD
                            </p>
                            <p class="lh-1 text-center">VP for Academic Affairs</p>
                        </td>
                        <td>
                            <p class="text-center mt-3">
                                DULCE F. ATIAN, PhD
                            </p>
                            <p class="lh-1 text-center">Officer-in-Charge</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2">MFO/PAP</th>
                        <th rowspan="2">SUCCESS INDICATORS
                            (TARGETS + MEASURES)</th>
                        <th rowspan="2">Actual Accomplishments</th>
                        <th colspan="4">Rating</th>
                        <th rowspan='2'>Remarks</th>
                    </tr>
                    <tr>
                        <th>Q1</th>
                        <th>E2</th>
                        <th>T3</th>
                        <th>A4</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ipcr as $targetFunction => $mfoPaps)
                        <tr>
                            <td colspan="8" class="text-dark bg-warning">{{ Str::upper($targetFunction) }}</td>
                        </tr>
                        @foreach ($mfoPaps as $mfoPap => $targets)
                            <tr>
                                <td rowspan="{{ count($targets) + 1 }}">{{ $mfoPap }}</td>
                            </tr>
                            @foreach ($targets as $target)
                                <tr>
                                    <td>{{ $target->targets }}</td>
                                    <td>{{ $target->actual_accomplishments }}</td>
                                    <td>{{ $target->q1 }}</td>
                                    <td>{{ $target->e2 }}</td>
                                    <td>{{ $target->t3 }}</td>
                                    <td>{{ $target->a4 }}</td>
                                    <td>{{ $target->remarks }}</td>
                                </tr>
                            @endforeach
                        @endforeach

                    @empty
                        <tr>
                            <td colspan="8">No results</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="7">STRATEGIC FUNCTION (45%)</td>
                        <td colspan="1">{{ number_format($strategic, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="7">COR FUNCTION (45%)</td>
                        <td colspan="1">{{ number_format($core, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="7">SUPPORT FUNCTION (10%)</td>
                        <td colspan="1">{{ number_format($support, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="7">TOTAL OVERALL RATING</td>
                        <td colspan="1">{{ number_format($strategic + $core + $support, 2) }}</td>
                    </tr>

                    <tr>
                        <td colspan="8">Comments and Recommendation for Development Purposes</td>
                    </tr>


                    <tr class="text-center">
                        <td>Discuss with:</td>
                        <td>Assessed by:</td>
                        <td>Noted by:</td>
                        <td colspan="4">Approved by:</td>
                        <td>Date:</td>
                    </tr>

                    <tr>
                        <td rowspan="2">
                            @if ($signed != '')
                                <img src="{{ asset('/storage/' . $signed) }}" alt="signature" width="150px" height="100px">
                            @else
                                <form wire:submit="save">
                                    <input type="file" wire:model="esign">

                                    <button type="submit" class="btn btn-primary btn-sm mt-1">Save eSign</button>
                                    @error('esign')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                    <div wire:loading wire:target="esign">Uploading...</div>
                                </form>
                            @endif
                        </td>
                        <td>I certify that I discussed my assessment of the performance with the employee</td>
                        <td rowspan="2">&nbsp;</td>
                        <td colspan="4" rowspan="2">&nbsp;</td>
                        <td rowspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                    </tr>

                    <tr class="text-center">
                        <td>{{ auth()->user()->name }}</td>
                        <td>CHALLIZ DELIMA-OMOROG, DIT</td>
                        <td>ESTELITO R. CLEMENTE, PhD</td>
                        <td colspan="4">DULCE F. ATIAN, PhD</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr class="text-center">
                        <td>{{ auth()->user()->designation }}</td>
                        <td>Dean</td>
                        <td>VPAA</td>
                        <td colspan="4">Officer-in-charge</td>
                        <td>&nbsp;</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
