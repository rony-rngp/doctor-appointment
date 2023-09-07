@extends('layouts.backend.app')

@section('title', 'Doctor List')

@push('css')

@endpush

@section('content')

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                            Doctor List ({{ $doctors->count() }})
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('admin.doctor.add') }}"><i class="fa fa-plus-square"></i> Add Doctor</a></p>
                        </div>
                        <div class="card-body">
                            <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Email </th>
                                        <th>Specialist </th>
                                        <th>Fees </th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($doctors as $key => $doctor)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td class="sorting_1">
                                            <p class="table-avatar">
                                                <img class="avatar-img" src="{{ url($doctor->image) }}" width="20%" alt="User Image">
                                                {{ $doctor->name }}
                                            </p>
                                        </td>
                                        <td>{{ $doctor->email }}</td>
                                        <td>{{ $doctor->specialist->name }}</td>
                                        <td>{{ $doctor->fees }}</td>
                                        <td>
                                            <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="Active"  data-offstyle="danger" data-off="Inactive" id="status" data-id="{{ $doctor->id }}"  {{ $doctor->status == 1 ? 'checked' : '' }}  >
                                        </td>

                                        <td>
                                            <a href="javascript:void(0)" data-id="{{ $doctor->id }}" title="Details" class="btn btn-sm btn-success show_data_ajax"> <i class="fa fa-eye"></i></a>

                                            <a href="{{ route('admin.doctor.schedule',$doctor->id) }}" title="Schedule" class="btn btn-sm btn-primary"> <i class="fa fa-list-alt"></i></a>

                                            <a href="{{ route('admin.doctor.edit',$doctor->id ) }}" class="btn btn-sm btn-info"> <i class="fa fa-edit"></i></a>
                                            <!--Delete Data-->
                                            <button class="btn btn-sm btn-danger waves-effect" id="delete" type="button" onclick="deleteData({{ $doctor->id }})">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                            <form id="delete-form-{{ $doctor->id }}" action="{{ route('admin.doctor.destroy', $doctor->id) }}" method="post" style="display: none">
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


        <!-- Long Content Scroll Modal -->
        <div class="modal fade" id="scrollable-modal" tabindex="-1" role="dialog"
             aria-labelledby="scrollableModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="details"></div>
            </div>
        </div><!-- /.modal -->



@endsection

@push('js')

    <script>
        $(document).ready(function () {
            $('.show_data_ajax').on('click', function () {
                var id = $(this).attr('data-id');
                $(this).attr('disabled',true);
                $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing');
                $.ajax({
                    url: "{{ route('admin.doctor.details') }}",
                    type: "GET",
                    data: {id : id},
                    success: function (result) {
                        $('#scrollable-modal').modal('show');
                        $(".details").html(result);

                        $(".show_data_ajax").attr('disabled',false);
                        $(".show_data_ajax").html('<i class="fa fa-eye" aria-hidden="true"></i>');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).on('change', '#status', function () {
            var id = $(this).attr('data-id');
            if(this.checked){
                var status = 1;
            }else{
                var status = 0;
            }

            $.ajax({
                url: "{{ route('admin.doctor.status') }}",
                type: "GET",
                data: {id : id, status : status},
                success: function (result) {
                    console.log(result);
                }
            })
        });
    </script>
@endpush
