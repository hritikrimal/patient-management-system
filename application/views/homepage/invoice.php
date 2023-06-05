<!-- css for this page  -->


<link rel="stylesheet" type="text/css" href="http://localhost/first_project/assets/css/invoicecss.css">


<!-- datatable cdn css -->
<link rel="stylesheet" type="text/css" href="http://localhost/first_project/assets/datatable/data_tables.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Patient Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="<?php echo base_url() . 'Home_con' ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Billing</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h4>Billing Details</h4>
            </div>

        </div>
        <hr>
        <div class="table-responsive">
            <table class="table  table-striped table-hover responsive" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">SN</th>
                        <th scope="col">Date Time</th>
                        <th scope="col">Bill No</th>
                        <th scope="col">Discount Percentage</th>
                        <th scope="col">Net Total</th>
                        <th scope="col">grand Total</th>
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
        <div class="modal fade" id="bill_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Invoice</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row g-3 ">
                                        <div class="sample col-md-3">

                                        </div>
                                        <div class="date col-md-9 " style="text-align: right;">
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">

                                    <div class="table-responsive-sm">
                                        <form id="form" class="row g-3">

                                            <div class="col-md-6">
                                                <div class="Patient_name"></div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="Patient_id"></div>

                                            </div>
                                            <hr>
                                        </form>
                                        <table class="item_table table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="center">#</th>
                                                    <th>Test Item</th>
                                                    <th class="right">Unit Cost</th>
                                                    <th class="center">Qty</th>
                                                    <th class="right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="invoive_table">
                                                <tr>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">


                                        <div class="col-lg-4 col-sm-5 ml-auto">

                                            <table class="table table-clear" style="margin-left: 200%;">
                                                <tbody>
                                                    <tr>
                                                        <td class="left">
                                                            Subtotal
                                                        </td>
                                                        <td class="right">
                                                            <div class="subtotal"></div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            Discount %
                                                        </td>
                                                        <td class="right">
                                                            <div class="discountper"></div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            Discount Amount
                                                        </td>
                                                        <td class="right">
                                                            <div class="discountamt"></div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left">
                                                            Grand Total
                                                        <td class="right">

                                                            <div class="grandtotal"></div>


                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </div>

    <script src="http://localhost/first_project/assets/datatable/data_tables.js"></script>
    <script src="http://localhost/first_project/assets/js/invoice.js"></script>
</body>

</html>