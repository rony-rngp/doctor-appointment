@extends('layouts.backend.app')

@section('title', 'Doctor Schedule')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Doctor Schedule
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th width="30%">Clinic Name</th>
                                    <th width="30%">Address</th>
                                    <th width="30%">Time</th>
                                    <th width="10%">Pasent</th>
                                </tr>

                                @foreach($schedules as $schedule)
                                    <tr style="background: #e5e9e2; border-bottom: 1px solid #eee;" height="45">
                                        <td colspan="6" style="text-align: center">
                                            {{ $schedule[0]->day->name }}
                                        </td>
                                    </tr>

                                    @foreach($schedule as $sdl)
                                        <tr>
                                            <td width="20%">{{ $sdl->clinic_name }}</td>
                                            <td width="30%">{{ $sdl->clinic_address }}</td>
                                            <td width="40%">{{ $sdl->start_time .' - '. $sdl->end_time}}</td>
                                            <td width="10%">{{ $sdl->maximum_patient	 }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </table>
                        </div>
                    </div> <!-- end card-body-->

                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->

@endsection

@push('js')

@endpush
