@extends('layouts.doctor.app')

@section('title', 'Schedule List')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Schedule List ({{ $schedules->count() }})
                        <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('doctor.schedule.add') }}"><i class="fa fa-plus-square"></i> Add Schedule</a></p>
                    </div>
                    <div class="card-body">
                        <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Clinic Name</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Maximum Patient</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($schedules as $key => $schedule)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $schedule->clinic_name }}</td>
                                    <td>{{ $schedule->day->name }}</td>
                                    <td>{{ $schedule->start_time .' - '. $schedule->end_time }}</td>
                                    <td>{{ $schedule->maximum_patient }}</td>
                                    <td>
                                        <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="Active"  data-offstyle="danger" data-off="Inactive" id="status" data-id="{{ $schedule->id }}"  {{ $schedule->status == 1 ? 'checked' : '' }}  >
                                    </td>
                                    <td>

                                        <a href="javascript:void(0)" data-id="{{ $schedule->id }}" title="Details" class="btn btn-sm btn-success show_data_ajax"> <i class="fa fa-eye"></i></a>

                                        <a href="{{ route('doctor.schedule.edit',$schedule->id ) }}" class="btn btn-sm btn-info"> <i class="fa fa-edit"></i></a>
                                        <!--Delete Data-->
                                        <button class="btn btn-sm btn-danger waves-effect" id="delete" type="button" onclick="deleteData({{ $schedule->id }})">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                        <form id="delete-form-{{ $schedule->id }}" action="{{ route('doctor.schedule.destroy', $schedule->id) }}" method="post" style="display: none">
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
        //---ajax show data
        $('.show_data_ajax').on('click', function () {
            var id = $(this).attr('data-id');
            $(this).attr('disabled',true);
            $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing');
            $.ajax({
                url: "{{ route('doctor.schedule.details') }}",
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

        //----status
        $(document).on('change', '#status', function () {
            var id = $(this).attr('data-id');
            if(this.checked){
                var status = 1;
            }else{
                var status = 0;
            }

            $.ajax({
                url: "{{ route('doctor.schedule.status') }}",
                type: "GET",
                data: {id : id, status : status},
                success: function (result) {
                    console.log(result);
                }
            })
        });
    </script>
@endpush
