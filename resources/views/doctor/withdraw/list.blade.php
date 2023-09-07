@extends('layouts.doctor.app')

@section('title', 'My Withdraw List')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Withdraw List ({{ $withdraws->count() }})
                    </div>
                    <div class="card-body">
                        <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Payment Method</th>
                                <th>Account Type</th>
                                <th>Amount</th>
                                <th>Account Number</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($withdraws as $key => $withdraw)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $withdraw->payment_method }}</td>
                                    <td>{{ $withdraw->account_type }}</td>
                                    <td>{{ $withdraw->amount }} BDT</td>
                                    <td>{{ $withdraw->account_number }}</td>
                                    <td>
                                        @if($withdraw->status == 0)
                                            <p class="badge badge-danger">Pending</p>
                                        @else
                                            <p class="badge badge-success">Confirmed</p>
                                        @endif
                                    </td>
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
