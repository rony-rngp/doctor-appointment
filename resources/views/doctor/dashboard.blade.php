@extends('layouts.doctor.app')

@section('title', 'Doctor')

@push('css')

@endpush

@section('content')



    <!-- Start Content-->
    <div class="container-fluid">



        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-sm bg-success rounded">
                                <i class="fe-list avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $total_appointment_count }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Complete Appointment</p>
                            </div>
                        </div>
                    </div>

                </div> <!-- end card-box-->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3">
                <div class="card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-sm bg-danger rounded">
                                <i class="fe-list avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $pending_appointment_count }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Pending Appointment</p>
                            </div>
                        </div>
                    </div>

                </div> <!-- end card-box-->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3">
                <div class="card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-sm bg-blue rounded">
                                <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark my-1">৳ <span data-plugin="counterup">{{ $doctor->total_amount }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Amount</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3">
                <div class="card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-sm bg-blue rounded">
                                <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark my-1">৳ <span data-plugin="counterup">{{ $doctor->amount }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Current Amount</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3">
                <div class="card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-sm bg-success rounded">
                                <i class="fe-dollar-sign avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark my-1">৳ <span data-plugin="counterup">{{ $total_withdraw }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Withdraw</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-3">
                <div class="card-box">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-sm bg-danger rounded">
                                <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark my-1">৳ <span data-plugin="counterup">{{ $pending_withdraw }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Pending Withdraw</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col -->

            <div class="col-md-12">
                <br>
                <div>
                    <label for="cars">Select Chart Style</label>
                    <select name="chart" onchange="myFunction2()"  class="form-control" id="charts">
                        <option value="column">Column</option>
                        <option value="pie">Pie</option>
                        <option value="pyramid">Pyramid</option>
                        <option value="bar">Bar</option>
                    </select>
                </div><br>
                <div id="monthly" style="height: 300px; width: 100%;"></div>
            </div>

        </div>
        <!-- end row -->

    </div> <!-- container -->



@endsection

@push('js')
    <script>
        $(document).ready(function () {;
            myFunction2();
        });

        //----monthly report-----
        function myFunction2() {
            var chartType = document.getElementById("charts").value;

            var chart = new CanvasJS.Chart("monthly", {
                animationEnabled: true,
                title: {
                    text: "Monthly Appointment Report"
                },
                subtitles: [{
                    text: ""
                }],
                data: [{
                    type: chartType, //"column",  type: "pie",
                    yValueFormatString: "#,##0.\"\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($chart, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
    <script src="{{ asset('public/backend/canvasjs.min.js') }}"></script>
@endpush
