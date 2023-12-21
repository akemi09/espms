<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        /* footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            color: black;
            line-height: 1.5cm;
        } */
        @page {
            margin-top: 200px;
            margin-bottom: 120px;
        }

        header {
            position: fixed;
            left: 0px;
            right: 0px;
            height: 150px;
            margin-top: -150px;
        }

        footer {
            position: fixed;
            left: 0px;
            right: 0px;
            height: 20px;
            bottom: 0px;
            margin-bottom: -10px;
        }

        table.customTable {
            width: 100%;
            background-color: #FFFFFF;
            border-collapse: collapse;
            border-width: 1px;
            border-color: #A6A6A6;
            border-style: solid;
            color: #4F4F4F;
        }

        table.customTable td,
        table.customTable th {
            border-width: 1px;
            border-color: #A6A6A6;
            border-style: solid;
            padding: 2px;
        }

        table.customTable thead {
            background-color: #FFFFFF;
        }
    </style>
</head>

<body>

    <header>
        <div class="row">
            <table>
                <tbody>
                    <tr>
                        <td width="10%">
                            <img src="{{ public_path('assets/img/logo.png') }}" width="80px;" height="80px;"
                                alt="CSPC logo">
                        </td>
                        <td>
                            Republic of the Philippines <br>
                            <strong>CAMARINES SUR POLYTECHNIC COLLEGES</strong> <br>
                            Nabua, Camarines Sur
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr style="border: 5px; solid;">
        </div>
    </header>

    <main>
        <div class="col-md-12 text-center">
            <p class="fw-bold">
                OFFICE PERFORMANCE COMMITMENT AND REVIEW (OPCR)
            </p>
        </div>

        <div class="col-md-12">
            <p>
                I, <u>{{ Str::upper($user->name) }}</u>, faculty of the College of
                {{ Str::upper($user->office->name) }},
                commits to deliver and agree to be rated on the attainment of the following targets in accordance with
                the
                indicated measures for the period January to June 2023.</u>
            </p>
        </div>

        <div class="col-md-12">
            <div class="table-responsive">
                <table class="customTable">
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
                <table class="customTable">
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
                        @forelse ($opcr as $targetFunction => $mfoPaps)
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
                                <strong>Rating Scale:</strong> 5 - Outstanding, 4 - Very Satisfactory, 3 - Satisfactory,
                                2 - Unsatisfactory, 1 - Poor
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </main>

    <footer>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered" style="border: 1px;">
                    <tr>
                        <td style="text-align: left;" width="50%">Effectivity date: January {{ now()->format('Y') }}
                        </td>
                        <td style="text-align: left;">Rev 0</td>
                    </tr>
                </table>
            </div>
        </div>
    </footer>
</body>

</html>
