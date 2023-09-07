
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="scrollableModalTitle">Review Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="">

            <div class=" box-profile">
{{--                <div class="text-center">--}}
{{--                    <img class="avatar-img " src="{{ url($doctor->image) }}" width="30%" alt="User Image">--}}
{{--                </div>--}}
{{--                <h3 class="profile-username text-center">{{ $doctor->name }}</h3>--}}

                <table class="table  table-bordered">
                    <tbody>

                    <tr>
                        <td>Patient Name</td>
                        <td>{{ $review->patient->name }} ( ID : {{ $review->patient->id }} )</td>
                    </tr>

                    <tr>
                        <td>Review Title</td>
                        <td>{{ $review->title }}</td>
                    </tr>

                    <tr>
                        <td>Review Description</td>
                        <td>{{ $review->review }}</td>
                    </tr>

                    <tr>
                        <td>Ratting</td>
                        <td class="rating">
                            <?php
                            for ($x = 1; $x <= $review->ratting; $x++) {
                                echo '<i class="fas fa-star"></i>';
                            }
                            ?>
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div><!-- /.modal-content -->
