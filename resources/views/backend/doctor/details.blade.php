
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="scrollableModalTitle">Doctor Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

                <div class="">

                    <div class=" box-profile">
                        <div class="text-center">
                            <img class="avatar-img " src="{{ url($doctor->image) }}" width="30%" alt="User Image">
                        </div>
                        <h3 class="profile-username text-center">{{ $doctor->name }}</h3>

                        <table class="table  table-bordered">
                            <tbody>

                            <tr>
                                <td>Name</td>
                                <td>{{ $doctor->name }}</td>
                            </tr>

                            <tr>
                                <td>Specialist</td>
                                <td>{{ $doctor->specialist->name }}</td>
                            </tr>

                            <tr>
                                <td>Fee</td>
                                <td>{{ $doctor->fees }}</td>
                            </tr>

                            <tr>
                                <td>Degree</td>
                                <td>{{ $doctor->degree }}</td>
                            </tr>


                            <tr>
                                <td>E-Mail</td>
                                <td>{{ $doctor->email }}</td>
                            </tr>

                            <tr>
                                <td>Phone</td>
                                <td>{{ $doctor->phone }}</td>
                            </tr>

                            <tr>
                                <td>Gender</td>
                                <td>{{ $doctor->gender }}</td>
                            </tr>

                            <tr>
                                <td>Date of Birth</td>
                                <td>{{ $doctor->dob }}</td>
                            </tr>

                            <tr>
                                <td>Clinic or Hospital</td>
                                <td>{{ $doctor->clinic }}</td>
                            </tr>

                            <tr>
                                <td>Clinic or Hospital Address</td>
                                <td>{{ $doctor->clinic_address }}</td>
                            </tr>

                            <tr>
                                <td>Password</td>
                                <td>{{ $doctor->show_password }}</td>
                            </tr>

                            </tbody>
                        </table>

                        <p><u>About {{ $doctor->name }} :</u></p>
                        <i>{{ $doctor->about }}</i>

                        <br>

                    </div>
                </div>
            </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
    </div><!-- /.modal-content -->
