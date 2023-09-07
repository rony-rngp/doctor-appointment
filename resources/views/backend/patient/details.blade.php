
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="scrollableModalTitle">Patient Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="">

            <div class=" box-profile">
                <div class="text-center">
                    <img class="avatar-img " src="{{ file_exists($patient->image) ? url($patient->image) : asset('public/backend/upload/avatar.png') }}" width="30%" alt="User Image">
                </div>
                <h3 class="profile-username text-center">{{ $patient->name }}</h3>

                <table class="table  table-bordered">
                    <tbody>

                    <tr>
                        <td>Name</td>
                        <td>{{ $patient->name }}</td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>{{ $patient->email }}</td>
                    </tr>

                    <tr>
                        <td>Phone</td>
                        <td>{{ $patient->phone }}</td>
                    </tr>

                    <tr>
                        <td>Gender</td>
                        <td>{{ $patient->gender }}</td>
                    </tr>


                    <tr>
                        <td>Date of Birth</td>
                        <td>{{ $patient->dob }}</td>
                    </tr>

                    <tr>
                        <td>Address</td>
                        <td>{{ $patient->address }}</td>
                    </tr>

                    <tr>
                        <td>Blood Group</td>
                        <td>{{ $patient->address }}</td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>{{ $patient->status == 1 ? 'Active' : 'Inactive' }}</td>
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
