<!-- css for this page  -->
<link rel="stylesheet" type="text/css" href="assets/css/home.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">




</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <hr>

            <div class="col-md-6">
                <h4>Patient Details</h4>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" id="modalbutton">
                    Register here!
                </button>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table  table-striped table-hover responsive" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">SN</th>
                        <th scope="col">Patient Id</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Age </th>
                        <th scope="col">Gender</th>
                        <th scope="col">District</th>
                        <th scope="col">Address</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>


                <tbody id="tbody">
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="infomodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Basic Informations</h5>
                        <button type="button" id="cross_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="m_body" class="modal-body">
                        <div id="flash-messages"></div>


                        <form id="form" class="row g-3">

                            <div class="col-md-6">
                                <label for="name" class="form-label bold">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="name" required>

                            </div>
                            <div class="col-md-6">
                                <label for="age" class="form-label bold">Age</label>
                                <input type="text" class="form-control" id="age" placeholder="age" required>

                            </div>
                            <div class="col-md-6">
                                <label for="p_number" class="form-label bold">Mobile Number</label>
                                <input type="text" class="form-control" id="p_number" placeholder="contact number" required>

                            </div>


                            <div class="col-md-6">
                                <label for="country" class="form-label bold">country</label>
                                <select class="form-select" id="country" required>
                                    <option selected disabled>Choose...</option>

                                </select>

                            </div>
                            <div class="col-md-6">
                                <label for="province" class="form-label bold">Province</label>
                                <select class="form-select" id="province" required>
                                    <option selected disabled>Choose...</option>



                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="district" class="form-label bold">District</label>
                                <select class="form-select" id="district" required>
                                    <option selected disabled>Choose...</option>
                                </select>

                            </div>
                            <div class="col-md-6">
                                <label for="municipality" class="form-label bold">Municipality</label>
                                <select class="form-select" id="municipality" required>
                                    <option selected disabled>Choose...</option>
                                </select>

                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label bold">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="address" required>

                            </div>

                            <div class="col-md-6 ">
                                <label for="male" class="form-label bold">Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="male" checked>
                                    <label class="form-check-label" for="male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="female">
                                    <label class="form-check-label" for="female">
                                        Female
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="other">
                                    <label class="form-check-label" for="other">
                                        Other
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 text-left">
                                <label class="form-label bold">Language</label>
                                <div>
                                    <input type="checkbox" id="nepali" name="language[]" value="nepali">
                                    <label for="nepali">Nepali</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="english" name="language[]" value="english">
                                    <label for="english">English</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="others" name="language[]" value="other">
                                    <label for="others">Other</label>
                                </div>
                            </div>



                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close_button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="save_button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- view  -->
        <div class="modal fade" id="new-infomodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="new-staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="new-modalLabel">Basic Information</h5>
                        <button type="button" id="new-cross_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="new-m_body" class="modal-body">
                        <div id="new-flash-messages"></div>

                        <form id="new-form" class="row g-3">
                            <div class="col-md-6">
                                <label for="new-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="new-name" disabled name="new-name" placeholder="Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="new-age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="new-age" disabled name="new-age" placeholder="Age" required>
                            </div>
                            <div class="col-md-6">
                                <label for="new-p_number" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="new-p_number" disabled name="new-p_number" placeholder="Mobile Number" required>
                            </div>

                            <div class="col-md-6">
                                <label for="new-country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="new-country" disabled name="new-country" placeholder="Country" required>
                            </div>

                            <div class="col-md-6">
                                <label for="new-province" class="form-label">Province</label>
                                <input type="text" class="form-control" id="new-province" disabled name="new-province" placeholder="province" required>
                            </div>

                            <div class="col-md-6">
                                <label for="new-district" class="form-label">District</label>
                                <input type="text" class="form-control" id="new-district" disabled name="new-district" placeholder="district" required>
                            </div>


                            <div class="col-md-6">
                                <label for="new-municipality" class="form-label">Municipality</label>
                                <input type="text" class="form-control" id="new-municipality" disabled name="new-municipality" placeholder="municipality" required>
                            </div>



                            <div class="col-md-6">
                                <label for="new-address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="new-address" disabled name="new-address" placeholder="Address" required>
                            </div>

                            <div class="col-md-6">
                                <label for="new-gender" class="form-label">Gender</label>
                                <input type="text" class="form-control" id="new-gender" disabled name="new-gender" placeholder="gender" required>
                            </div>


                            <div class="col-md-6">
                                <label for="new-language" class="form-label">Language</label>
                                <input type="text" class="form-control" id="new-language" disabled name="new-language" placeholder="Language" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="new-close_button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- reg & billing modal -->
        <div class="modal fade" id="billing-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- script for this page -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <script src="assets/js/homejs.js"></script>
    <!-- <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script> -->




</body>



</html>