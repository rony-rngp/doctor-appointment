@extends('layouts.frontend.app')

@section('title', 'Doctors')

@push('css')

@endpush

@section('content')

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Search</li>
                        </ol>
                    </nav>
                    @if(@$q_specialist || @$query)
                    <h2 class="breadcrumb-title">{{ $doctors->count() }} result found</h2>
                    @endif
                </div>

            </div>
        </div>
    </div>



    <div class="content" style="transform: none; min-height: 212px;">
        <div class="container-fluid" style="transform: none;">
            <div class="row" style="transform: none;">
                <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                        <div class="card search-filter">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Search Filter</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('search.doctors') }}" method="get">
                                    <div class="filter-widget">
                                        <div class="">
                                            <input type="text" name="search" value="{{ @$query }}" autocomplete="off" class="form-control" placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="filter-widget">
                                        <h4>Select Specialist</h4>
                                        @foreach($specialists as $specialist)
                                            <div>
                                                <label class="custom_check">
                                                    <input type="radio" name="select_specialist" {{ @$q_specialist == $specialist->id ? 'checked' : '' }} value="{{ $specialist->id }}">
                                                    <span class="checkmark"></span> {{ $specialist->name }}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="btn-search">
                                        <button type="submit" class="btn btn-block">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="resize-sensor" style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 340px; height: 1707px;">

                                </div>
                            </div>
                            <div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 col-xl-9">
                    @forelse($doctors as $doctor)

                    <div class="card">
                        <div class="card-body">
                            <div class="doctor-widget">
                                <div class="doc-info-left">
                                    <div class="doctor-img">
                                        <a href="{{ route('doctor.profile', $doctor->id) }}">
                                            <img src="{{ url($doctor->image) }}" style="width: 150px; height: 150px" class="img-fluid" alt="User Image">
                                        </a>
                                    </div>
                                    <div class="doc-info-cont">
                                        <h4 class="doc-name"><a href="{{ route('doctor.profile', $doctor->id) }}">{{ $doctor->name }}</a></h4>
                                        <p class="doc-speciality">{{ $doctor->degree }}</p>


                                        <h5 class="doc-department"><img src="{{ url($doctor->specialist->image) }}" class="img-fluid" alt="Speciality">{{ $doctor->specialist->name }}</h5>
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
                                        <span class="doc-speciality"><i class="fa fa-money-bill"></i>  &nbsp;&nbsp;{{ $doctor->fees }} BDT</span>

                                    </div>
                                </div>
                                <div class="doc-info-right">
                                    <div class="clinic-booking">
                                        <a class="view-pro-btn" href="{{ route('doctor.profile', $doctor->id) }}">View Profile</a>
                                        <a class="apt-btn" href="{{ route('doctor.booking', $doctor->id) }}">Book Appointment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty

                        <h2 class="text-center">Data not found</h2>

                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush
