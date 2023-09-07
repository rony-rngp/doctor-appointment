@extends('layouts.backend.app')

@section('title', 'Day List')

@push('css')

@endpush

@section('content')

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                            Day List ({{ $days->count() }})
                        </div>
                        <div class="card-body">
                            <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($days as $key => $day)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $day->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>

        </div> <!-- container -->



@endsection

@push('js')

@endpush
