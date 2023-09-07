@extends('layouts.backend.app')

@section('title', 'Withdraw List')

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
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($withdraws as $key => $withdraw)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $withdraw->payment_method }}</td>
                                    <td>{{ $withdraw->account_type }}</td>
                                    <td>{{ $withdraw->amount }}</td>
                                    <td>{{ $withdraw->account_number }}</td>
                                    <td>
                                        @if($withdraw->status == 0)
                                            <p class="badge badge-danger">Pending</p>
                                        @else
                                            <p class="badge badge-success">Confirmed</p>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm checkStatus" data-id="{{ $withdraw->id }}" data-toggle="modal" data-target="#checkStatus">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </button>
                                        <!--End Delete Data-->
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


    <!-- Modal check status-->
    <div class="modal fade" id="checkStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Withdraw</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.withdraw.status') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Withdraw Status</label>
                            <select name="status" class="form-control">
                                <option value="0">Pending</option>
                                <option value="1">Confirmed</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" id="withdraw_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('js')
<script>
    $(document).on('click', '.checkStatus', function () {
        var id = $(this).attr("data-id");
        $('#withdraw_id').val(id);

    });
</script>
@endpush
