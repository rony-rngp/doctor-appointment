
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="scrollableModalTitle">Schedule Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="">

            <div class=" box-profile">
                <div class="text-center">
                    <img class="avatar-img " src="{{ url($schedule->doctor->image) }}" width="30%" alt="User Image">
                </div>
                <h3 class="profile-username text-center">{{ $schedule->doctor->name }}</h3>

                <table class="table  table-bordered">
                    <tbody>

                    <tr>
                        <td>Clinic Name</td>
                        <td>{{ $schedule->clinic_name }}</td>
                    </tr>

                    <tr>
                        <td>Clinic Address</td>
                        <td>{{ $schedule->clinic_address }}</td>
                    </tr>

                    <tr>
                        <td>Day</td>
                        <td>{{ $schedule->day->name }}</td>
                    </tr>

                    <tr>
                        <td>Start Time</td>
                        <td>{{ $schedule->start_time }}</td>
                    </tr>

                    <tr>
                        <td>End Time</td>
                        <td>{{ $schedule->end_time }}</td>
                    </tr>

                    <tr>
                        <td>Maximum Patient</td>
                        <td>{{ $schedule->maximum_patient }}</td>
                    </tr>


                    </tbody>
                </table>
                <br>

            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

    </div>
</div><!-- /.modal-content -->
