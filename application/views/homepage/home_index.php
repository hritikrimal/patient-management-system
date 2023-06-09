<!-- css for this page  -->
<link rel="stylesheet" type="text/css" href="assets/css/home.css">
<!-- datatable cdn css -->
<link rel="stylesheet" type="text/css" href="assets/datatable/data_tables.css">







</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand"><strong>Patient Management</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url() . 'Register/View_invoice' ?>">Billing</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-5">
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

                        <div id="flash-messages1"></div>


                        <form id="form" class="row g-3">

                            <div class="col-md-6">
                                <label for="name" class="form-label bold">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="name" required>

                            </div>
                            <div class="col-md-6">
                                <label for="age" class="form-label bold">Age</label>
                                <input type="number" class="form-control" id="age" placeholder="age" required required min="10" max="99">
                                <small class="text-muted">Please insert age between 0 and 100</small>

                            </div>
                            <div class="col-md-6">
                                <label for="p_number" class="form-label bold">Mobile Number</label>
                                <input type="number" class="form-control" id="p_number" placeholder="9*********" required>
                                <small class="text-muted">Please enter a 10-digit mobile number.</small>

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
                        <h5 class="modal-title" id="new-modalLabel">Information View</h5>
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
                                <input type="number" class="form-control" id="new-p_number" disabled name="new-p_number" placeholder="Mobile Number" required>
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Generate Bill</h5>
                        <button type="button" id="billing_modal_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row g-3 ">
                                        <div class="p_id col-md-3">

                                        </div>
                                        <div class="bill_date col-md-9 " style="text-align: right;">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="table-responsive-sm">

                                        <div class="row">
                                            <div id="flash-messages2"></div>

                                            <div class="col-md-12 newbill">
                                                <table class="table table-bordered" id="item-list">
                                                    <!-- <colgroup>
                                                        <col width="40%">
                                                        <col width="10%">
                                                        <col width="10">
                                                        <col width="15%">
                                                        <col width="15%"> -->
                                                    <!-- <col width="5%"> -->
                                                    <!-- </colgroup> -->
                                                    <thead>
                                                        <tr>
                                                            <!-- <th class="text-center">SN</th> -->
                                                            <th class="text-center">TEST NAME</th>

                                                            <th class="text-center">QUANTITY</th>
                                                            <th class="text-center">UNIT</th>
                                                            <!-- <th class="text-center">Cost</th> -->
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="items_list">

                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td> <input type="text" class="form-control" id="test_name" required name="test_name">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" id="t_qty" required name="t_qty">


                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" id="t_unit" required name="t_unit">

                                                            </td>
                                                            <td>
                                                                <div class="t_price text-right mt-2"></div>
                                                                <!-- <input type="number" class="form-control" id="t_price" disabled required name="t_price"> -->

                                                            </td>
                                                            <td>
                                                                <button id="but_add" type="button" class="btn btn-primary  ">Submit</button>

                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                    <tfoot>

                                                        <tr>
                                                            <th class="text-right" colspan="3">Sub Total</th>
                                                            <th>
                                                                <div class="sub_total text-right mt-2 form-control">0</div>
                                                            </th>
                                                            <!-- <th><input type="number" disabled class="form-control" id="sub_total" name="sub_total" value="0"></th> -->
                                                        </tr>
                                                        <tr>
                                                            <th class="text-right" colspan="3">Discount %</th>
                                                            <th><input type="number" class="form-control" id="dis_per" name="dis_per" value=""></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-right" colspan="3">Discount Amount</th>
                                                            <!-- <th><input type="number" disabled class="form-control" id="dis_amnt" name="dis_amnt" value="0"></th> -->
                                                            <th>
                                                                <div class="dis_amnt text-right mt-2 form-control">0</div>

                                                            </th>
                                                        </tr>

                                                        <tr>
                                                            <th class="text-right" colspan="3">Grand Total</th>
                                                            <th>
                                                                <div class="grand_total text-right mt-2 form-control">0</div>
                                                            </th>
                                                            <!-- <th><input type="number" disabled class="form-control" id="grand_total" name="grand_total" value="0"></th> -->
                                                        </tr>

                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" id="modal_close_btn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="regbill_btn">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="assets/datatable/data_tables.js"></script>
    <script src="assets/js/homejs.js"></script>


</body>



</html>