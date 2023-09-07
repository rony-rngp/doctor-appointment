@extends('layouts.backend.app')

@section('title', 'Withdrawal Method List')

@push('css')

@endpush

@section('content')

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                            Withdrawal Method List ({{ $withdrawal_methods->count() }})
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('admin.withdrawal-method.add') }}"><i class="fa fa-plus-square"></i> Add Method</a></p>
                        </div>
                        <div class="card-body">
                            <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Account Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($withdrawal_methods as $key => $withdrawal_method)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $withdrawal_method->name }}</td>
                                        <td>{{ $withdrawal_method->account_type }}</td>
                                        <td>
                                            <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="Active"  data-offstyle="danger" data-off="Inactive" id="status" data-id="{{ $withdrawal_method->id }}"  {{ $withdrawal_method->status == 1 ? 'checked' : '' }}  >
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.withdrawal-method.edit',$withdrawal_method->id ) }}" class="btn btn-sm btn-info"> <i class="fa fa-edit"></i></a>
                                            <!--Delete Data-->
                                            <button class="btn btn-sm btn-danger waves-effect" id="delete" type="button" onclick="deleteData({{ $withdrawal_method->id }})">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                            <form id="delete-form-{{ $withdrawal_method->id }}" action="{{ route('admin.withdrawal-method.destroy', $withdrawal_method->id) }}" method="post" style="display: none">
                                                @csrf
                                                @method('post')
                                            </form>
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



@endsection

@push('js')
    <script>
        $(document).on('change', '#status', function () {
            var id = $(this).attr('data-id');
            if(this.checked){
                var status = 1;
            }else{
                var status = 0;
            }

            $.ajax({
                url: "{{ route('admin.withdrawal-method.status') }}",
                type: "GET",
                data: {id : id, status : status},
                success: function (result) {
                    console.log(result);
                }
            })
        });
    </script>
@endpush
