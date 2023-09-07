@extends('layouts.frontend.app')

@section('title', $doctor->name)

@push('css')

@endpush

@section('content')

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Doctor Profile</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content" style="min-height: 205px;">
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <img src="{{ url($doctor->image) }}" style="width: 150px; height: 150px" class="img-fluid" alt="User Image">
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name">{{ $doctor->name }}</h4>
                                <p class="doc-speciality">{{ $doctor->degree }}</p>
                                <p class="doc-department"><img src="{{ url($doctor->specialist->image) }}" class="img-fluid" alt="Speciality">{{ $doctor->specialist->name }}</p>
                                <div class="rating">
                                    <?php
                                    if ($doctor->reviews()->avg('ratting') < 1){
                                        for ($i=1; $i<=5;$i++){
                                            echo '<i class="fas fa-star "></i>';
                                        }

                                    }else{
//                                                    for ($x = 1; $x <= $doctor->reviews()->avg('ratting'); $x++) {
//                                                        echo '<i class="fas fa-star filled"></i>';
//                                                    }
                                        $avarege = $doctor->reviews()->avg('ratting');

                                        if ($avarege >= 1 && $avarege< 2){
                                            echo '<i class="fas fa-star filled"></i>';

                                            for ($i=1; $i<=4;$i++){
                                                echo '<i class="fas fa-star "></i>';
                                            }
                                        }

                                        elseif ($avarege >= 2 && $avarege<3){
                                            for ($i=1; $i<=2;$i++){
                                                echo '<i class="fas fa-star filled"></i>';
                                            }

                                            for ($i=1; $i<=3;$i++){
                                                echo '<i class="fas fa-star "></i>';
                                            }
                                        }

                                        elseif ($avarege >= 3 && $avarege<4){
                                            for ($i=1; $i<=3;$i++){
                                                echo '<i class="fas fa-star filled"></i>';
                                            }

                                            for ($i=1; $i<=2;$i++){
                                                echo '<i class="fas fa-star "></i>';
                                            }
                                        }

                                        elseif ($avarege >= 4 && $avarege < 5){
                                            for ($i=1; $i<=4;$i++){
                                                echo '<i class="fas fa-star filled"></i>';
                                            }

                                            for ($i=1; $i<=1;$i++){
                                                echo '<i class="fas fa-star "></i>';
                                            }
                                        }

                                        elseif ($avarege == 5){
                                            for ($i=1; $i<=5;$i++){
                                                echo '<i class="fas fa-star filled"></i>';
                                            }

                                        }


                                    }

                                    ?>


                                    <span class="d-inline-block average-rating">({{ $doctor->reviews()->avg('ratting') >= 1 ?  $doctor->reviews()->avg('ratting') : 0 }})</span>
                                </div>

                            </div>
                        </div>
                        <div class="doc-info-right">
                            <div class="clini-infos">
                                <ul>
                                    <li><i class="fas fa-hospital-alt"></i> {{ $doctor->clinic }}</li>
                                    <li><i class="fas fa-map-marker-alt"></i> {{ $doctor->clinic_address }}</li>
                                    <li><i class="fa fa-user"></i> {{ $doctor->gender }} </li>
                                    <li><i class="far fa-money-bill-alt"></i> {{ $doctor->fees }} BDT</li>
                                </ul>
                            </div>
                            <div class="clinic-booking">
                                <a class="apt-btn" href="{{ route('doctor.booking', $doctor->id) }}">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body pt-0">

                    <nav class="user-tabs mb-4">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">

                            <li class="nav-item">
                                <a class="nav-link active" href="#doc_overview" data-toggle="tab">Schedule</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " href="#doc_locations" data-toggle="tab">Overview</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " href="#doc_review" data-toggle="tab">Review</a>
                            </li>

                        </ul>
                    </nav>


                    <div class="tab-content pt-0">

                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">

                            <div class="card booking-schedule schedule-widget">
                                <div class="schedule-header">
                                    <div class="row">

                                        <div class="table-responsive" style="overflow-x:auto;">
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

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div role="tabpanel" id="doc_locations" class="tab-pane fade  ">
                            <div class="row">
                                <div class="col-md-12 col-lg-9">

                                    <div class="widget about-widget">
                                        <h4 class="widget-title">About Me</h4>
                                        <p>{{ $doctor->about }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div role="tabpanel" id="doc_review" class="tab-pane fade  ">
                            <div class="row">
                                <div class="col-md-12 ">

                                    <div class="widget review-listing">
                                        <ul class="comments-list">
                                            @foreach($doctor->reviews as $review)
                                            <li>
                                                <div class="comment">
                                                    <img class="avatar avatar-sm rounded-circle" alt="User Image" src="{{ file_exists($review->patient->image) ? url($review->patient->image) : asset('public/backend/upload/avatar.png') }}">
                                                    <div class="comment-body">
                                                        <div class="meta-data">
                                                            <span class="comment-author">{{ $review->patient->name }}</span>
                                                            <span class="comment-date">{{ $review->created_at->diffForHumans() }}</span>
                                                            <div class="rating review-count">
                                                                <?php
                                                                for ($x = 1; $x <= $review->ratting; $x++) {
                                                                    echo '<i class="fas fa-star filled"></i>';
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                        <p><i>{{ $review->title }}</i></p>
                                                        <p class="comment-content">
                                                            {{ $review->review }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('js')

@endpush
