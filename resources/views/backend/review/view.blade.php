@extends('layouts.backend.app')

@section('title', 'Review List')

@push('css')

@endpush

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(255,255,255); border: 1px solid #DEE2E6">
                        Review List ({{ $reviews->count() }})
                    </div>
                    <div class="card-body">
                        <table id="basic-datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Appointment</th>
                                    <th>Doctor</th>
                                    <th>Appointment Date</th>
                                    <th>Ratting</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($reviews as $key => $review)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><a href="{{ route('admin.appointment.details', $review->appointment->id) }}"><u>Click Here</u></a></td>
                                    <td>
                                        <p class="table-avatar">
                                            <a href="{{ route('doctor.profile', $review->appointment->doctor->id) }}" class="avatar avatar-sm mr-2">
                                                <img width="20%" class="avatar-img" src="{{ file_exists($review->appointment->doctor->image) ? url($review->appointment->doctor->image) : '' }}" alt="{{ $review->appointment->doctor->name }}">
                                            </a>
                                            <a href="{{ route('doctor.profile', $review->appointment->doctor->id) }}">{{ $review->appointment->doctor->name }} <span>{{ $review->appointment->doctor->specialist->name }}</span></a>
                                        </p>
                                    </td>
                                    <td>{{ $review->appointment->appointment_date }} <span class="d-block text-info">{{ $review->appointment->day->name }}</span></td>

                                    <td>
                                        <div class="rating">
                                            <?php
                                            for ($x = 1; $x <= $review->ratting; $x++) {
                                                echo '<i class="fas fa-star filled"></i>';
                                            }
                                            ?>

                                        </div>
                                    </td>

                                    <td>
                                        <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="Active"  data-offstyle="danger" data-off="Inactive" id="status" data-id="{{ $review->id }}"  {{ $review->status == 1 ? 'checked' : '' }}  >
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-id="{{ $review->id }}" class="btn btn-info btn-sm detail_btn"><i class="fa fa-eye"></i></a>
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
        <div class="modal-dialog modal-dialog" role="document">
            <div class="details"></div>
        </div>
    </div><!-- /.modal -->


@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('.detail_btn').on('click', function () {
            var id = $(this).attr('data-id');
            $(this).attr('disabled',true);
            $(this).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing');
            $.ajax({
                url: "{{ route('admin.review.details') }}",
                type: "GET",
                data: {id : id},
                success: function (result) {
                    $('#scrollable-modal').modal('show');
                    $(".details").html(result);

                    $(".detail_btn").attr('disabled',false);
                    $(".detail_btn").html('<i class="fa fa-eye" aria-hidden="true"></i>');
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
            url: "{{ route('admin.review.status') }}",
            type: "GET",
            data: {id : id, status : status},
            success: function (result) {
                console.log(result);
            }
        })
    });
</script>
@endpush
