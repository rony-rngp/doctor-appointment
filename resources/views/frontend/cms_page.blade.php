@extends('layouts.frontend.app')

@section('title', $cms->title)

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
                            <li class="breadcrumb-item active" aria-current="page">{{ $cms->title }}</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">{{ $cms->title }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content" style="min-height: 205px;">
        <div class="container">

            <div class="card">
                <div class="card-header">{{ $cms->title }}</div>
                <div class="card-body">
                    <p>{!! $cms->description !!}</p>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('js')

@endpush
