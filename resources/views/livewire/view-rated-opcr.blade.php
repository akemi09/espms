<div>
    <div class="row">

        <div class="col-md-12">
            <a href="{{ route('generate.report', ['type' => 'opcr', 'user' => $user->id]) }}" target="_blank"
                class="btn btn-link float-end"><i class="menu-icon tf-icons bx bx-download"></i>Download as PDF</a>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <p class="fw-bold">
            OFFICE PERFORMACE COMMITMENT AND REVIEW (OPCR)
        </p>
    </div>

    <div class="col-md-12">
        <p>
            I, <u>{{ Str::upper($user->name) }}</u>, faculty of the College of {{ Str::upper($user->office->name) }},
            commits to deliver and agree to be rated on the attainment of the following targets in accordance with the
            indicated measures for the period <u>January to June 2023.</u>
        </p>
    </div>

    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>Reviewed by:</th>
                    <th>Approved by:</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p class="text-center mt-3 fw-bold">
                                <u>TERESITA B. SALAZAR, PhD</u>
                            </p>
                            <p class="lh-1 text-center">
                                Vice President for Research, <br>
                                Extension, <br>
                                Production and Entrepreneurial Development
                            </p>
                        </td>
                        <td>
                            <p class="text-center mt-3 fw-bold">
                                <u>DULCE F. ATIAN, PhD</u>
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
                        <th rowspan="2">Alloted budget</th>
                        <th rowspan="2">
                            Unit/Section/
                            Individual/Accountable
                        </th>
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
                            <td colspan="10" class="text-dark bg-warning">{{ Str::upper($targetFunction) }}</td>
                        </tr>
                        @foreach ($mfoPaps as $mfoPap => $targets)
                            <tr>
                                <td rowspan="{{ count($targets) + 1 }}">{{ $mfoPap }}</td>
                            </tr>
                            @foreach ($targets as $target)
                                <tr>
                                    <td>{{ $target->targets }}</td>
                                    <td>{{ $target->alloted_budget }}</td>
                                    <td>{{ $target->accountable }}</td>
                                    <td>{{ $target->actual_accomplishments }}</td>
                                    <td>{{ ($target->q1 == null or $target->q1 == 0) ? 'x' : $target->q1 }}</td>
                                    <td>{{ ($target->e2 == null or $target->e2 == 0) ? 'x' : $target->e2 }}</td>
                                    <td>{{ ($target->t3 == null or $target->t3 == 0) ? 'x' : $target->t3 }}</td>
                                    <td>{{ $target->a4 }}</td>
                                    <td>{{ $target->remarks }}</td>
                                </tr>
                            @endforeach
                        @endforeach

                    @empty
                        <tr>
                            <td colspan="10">No results</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="8">STRATEGIC FUNCTION (45%)</td>
                        <td colspan="2">{{ number_format($strategic, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="8">COR FUNCTION (45%)</td>
                        <td colspan="2">{{ number_format($core, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="8">SUPPORT FUNCTION (10%)</td>
                        <td colspan="2">{{ number_format($support, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="8">TOTAL OVERALL RATING</td>
                        <td colspan="2">{{ number_format($strategic + $core + $support, 2) }}</td>
                    </tr>

                    <tr>
                        <td colspan="10">Comments and Recommendation for Development Purposes</td>
                    </tr>


                    <tr>
                        <td colspan="3">
                            <p class="text-center mt-3 fw-bold">
                                <u>DULCE F. ATIAN, PhD</u>
                            </p>
                            <p class="lh-1 text-center">Officer-in-Charge</p>
                        </td>
                        <td colspan="2" class="text-center">Performance management team</td>
                        <td colspan="5">
                            <p class="text-center mt-3 fw-bold">
                                <u>DULCE F. ATIAN, PhD</u>
                            </p>
                            <p class="lh-1 text-center">Officer-in-Charge</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">Date:</td>
                        <td colspan="2">&nbsp;</td>
                        <td colspan="5">Date:</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            <strong>Legend:</strong> 1 - Quantity, 2 - Efficiency, 3 - Timeliness, 4 - Average
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10">
                            <strong>Rating Scale:</strong> 5 - Outstanding, 4 - Very Satisfactory, 3 - Satisfactory, 2 -
                            Unsatisfactory, 1 - Poor
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
