@extends('layouts.frontend.app')

@section('title', 'Home')

@push('css')

@endpush

@section('content')

    <section class="section section-search">
        <div class="container-fluid">
            <div class="banner-wrapper">
                <div class="banner-header text-center">
                    <h1>Search Doctor, Make an Appointment</h1>
                    <p>Discover the best doctors, clinic & hospital the city nearest to you.</p>
                </div>

                <div class="search-box">
                    <form action="{{ route('search.doctors') }}" method="get">
                        <div class="form-group search-info">
                            <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc">
                            <span class="form-text">Ex : Dental or Sugar Check up etc</span>
                        </div>
                        <button type="submit" class="btn btn-primary search-btn mt-0"><i class="fas fa-search"></i> <span>Search</span></button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <section class="section section-specialities">
        <div class="container-fluid">
            <div class="section-header text-center">
                <h2>Clinic and Specialities</h2>
                <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9">

                    <div class="specialities-slider slider">
                        @foreach($specialists as $specialist)
                        <div class="speicality-item text-center">
                            <div class="speicality-img">
                                <img src="{{ url($specialist->image) }}" class="img-fluid" alt="Speciality">
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            </div>
                            <p>{{ $specialist->name }}</p>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="section section-doctor">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="doctor-slider slider">
                        @foreach($doctors as $doctor)
                        <div class="profile-widget">
                            <div class="doc-img">
                                <a href="#">
                                    <img class="img-fluid" alt="User Image" src="{{ url($doctor->image) }}">
                                </a>
                                <a href="javascript:void(0)" class="fav-btn">
                                    <i class="far fa-bookmark"></i>
                                </a>
                            </div>
                            <div class="pro-content">
                                <h3 class="title">
                                    <a href="#">{{ $doctor->name }}</a>
                                    <i class="fas fa-check-circle verified"></i>
                                </h3>
                                <p class="speciality">{{ $doctor->degree }}</p>
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
                                <ul class="available-info">
                                    <li>
                                        <p class="doc-department"><img src="{{ url($doctor->specialist->image) }}" class="img-fluid" alt="Speciality">{{ $doctor->specialist->name }}</p>
                                    </li>
                                    <li>
                                        @if($doctor->schedule->where('status', 1)->count() != 0)
                                            <?php
                                                $day = date('l', strtotime(Carbon\Carbon::today()));
                                                $get_main_day = \App\Models\Day::where('name', $day)->first()->id;
                                                $check_schedule = \App\Models\Schedule::where(['doctor_id' => $doctor->id, 'day_id' => $get_main_day])->where('status', 1)->get();
                                                ?>

                                               <p class="speciality"><i class="far fa-clock speciality"></i>

                                                @if($check_schedule->count() != 0)
                                                    Available on {{ $day }}, {{ date('d M', strtotime(Carbon\Carbon::today())) }}
                                                    <i></i>
                                                @else
                                                    Not Available on {{ $day }}, {{ date('d M', strtotime(Carbon\Carbon::today())) }}
                                                @endif
                                               </p>

                                        @else
                                            <i class="far fa-clock"></i>
                                            Schedule Not Found
                                        @endif


                                    </li>
                                    <li>
                                        <i class="far fa-money-bill-alt"></i> {{ $doctor->fees }} BDT

                                    </li>
                                </ul>
                                <div class="row row-sm">
                                    <div class="col-6">
                                        <a href="{{ route('doctor.profile', $doctor->id) }}" class="btn view-btn">View Profile</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('doctor.booking', $doctor->id) }}" class="btn book-btn">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--    <section class="section section-blogs">--}}
{{--        <div class="container-fluid">--}}

{{--            <div class="section-header text-center">--}}
{{--                <h2>Blogs and News</h2>--}}
{{--                <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
{{--            </div>--}}

{{--            <div class="row blog-grid-row">--}}
{{--                <div class="col-md-6 col-lg-3 col-sm-12">--}}

{{--                    <div class="blog grid-blog">--}}
{{--                        <div class="blog-image">--}}
{{--                            <a href="javascript:void(0)"><img class="img-fluid" src="{{ asset('public/frontend') }}/assets/img/blog/blog-01.jpg" alt="Post Image"></a>--}}
{{--                        </div>--}}
{{--                        <div class="blog-content">--}}
{{--                            <ul class="entry-meta meta-item">--}}
{{--                                <li>--}}
{{--                                    <div class="post-author">--}}
{{--                                        <a href="javascript:void(0)"><img src="{{ asset('public/frontend') }}/assets/img/doctors/doctor-thumb-01.jpg" alt="Post Author"> <span>Dr. Ruby Perrin</span></a>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li><i class="far fa-clock"></i> 4 Dec 2019</li>--}}
{{--                            </ul>--}}
{{--                            <h3 class="blog-title"><a href="javascript:void(0)">Doccure – Making your clinic painless visit?</a></h3>--}}
{{--                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-3 col-sm-12">--}}

{{--                    <div class="blog grid-blog">--}}
{{--                        <div class="blog-image">--}}
{{--                            <a href="javascript:void(0)"><img class="img-fluid" src="{{ asset('public/frontend') }}/assets/img/blog/blog-02.jpg" alt="Post Image"></a>--}}
{{--                        </div>--}}
{{--                        <div class="blog-content">--}}
{{--                            <ul class="entry-meta meta-item">--}}
{{--                                <li>--}}
{{--                                    <div class="post-author">--}}
{{--                                        <a href="javascript:void(0)"><img src="{{ asset('public/frontend') }}/assets/img/doctors/doctor-thumb-02.jpg" alt="Post Author"> <span>Dr. Darren Elder</span></a>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li><i class="far fa-clock"></i> 3 Dec 2019</li>--}}
{{--                            </ul>--}}
{{--                            <h3 class="blog-title"><a href="javascript:void(0)">What are the benefits of Online Doctor Booking?</a></h3>--}}
{{--                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-3 col-sm-12">--}}

{{--                    <div class="blog grid-blog">--}}
{{--                        <div class="blog-image">--}}
{{--                            <a href="javascript:void(0)"><img class="img-fluid" src="{{ asset('public/frontend') }}/assets/img/blog/blog-03.jpg" alt="Post Image"></a>--}}
{{--                        </div>--}}
{{--                        <div class="blog-content">--}}
{{--                            <ul class="entry-meta meta-item">--}}
{{--                                <li>--}}
{{--                                    <div class="post-author">--}}
{{--                                        <a href="javascript:void(0)"><img src="{{ asset('public/frontend') }}/assets/img/doctors/doctor-thumb-03.jpg" alt="Post Author"> <span>Dr. Deborah Angel</span></a>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li><i class="far fa-clock"></i> 3 Dec 2019</li>--}}
{{--                            </ul>--}}
{{--                            <h3 class="blog-title"><a href="javascript:void(0)">Benefits of consulting with an Online Doctor</a></h3>--}}
{{--                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-3 col-sm-12">--}}

{{--                    <div class="blog grid-blog">--}}
{{--                        <div class="blog-image">--}}
{{--                            <a href="javascript:void(0)"><img class="img-fluid" src="{{ asset('public/frontend') }}/assets/img/blog/blog-04.jpg" alt="Post Image"></a>--}}
{{--                        </div>--}}
{{--                        <div class="blog-content">--}}
{{--                            <ul class="entry-meta meta-item">--}}
{{--                                <li>--}}
{{--                                    <div class="post-author">--}}
{{--                                        <a href="javascript:void(0)"><img src="{{ asset('public/frontend') }}/assets/img/doctors/doctor-thumb-04.jpg" alt="Post Author"> <span>Dr. Sofia Brient</span></a>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li><i class="far fa-clock"></i> 2 Dec 2019</li>--}}
{{--                            </ul>--}}
{{--                            <h3 class="blog-title"><a href="javascript:void(0)">5 Great reasons to use an Online Doctor</a></h3>--}}
{{--                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="view-all text-center">--}}
{{--                <a href="javascript:void(0)" class="btn btn-primary">View All</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

@endsection

@push('js')

@endpush
