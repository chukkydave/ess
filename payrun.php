<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<style>
.no-border {
    border: none;
    outline: none;
    background-color: #f5f6f8;
    border-radius: 5px;
    padding: 5px;
    margin-bottom: 2em;
}
</style>
<link type="text/css" rel="stylesheet" href="assets/css/style.css" />
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Payrun</h3>
            </div>

            <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">

                        <!-- button type="button" class="btn btn-primary" id="filter_attendence">Filter</button>
                    
                    
                    
                    <button type="button" class="btn btn-success" id="upload_attendence">Upload</button>
 -->
                        <a href="approvals"><button type="button" class="btn btn-danger"
                                id="add_attendence">Back</button></a>
                    </div>
                </div>
            </div>

        </div>




        <div class="clearfix"></div>

        <div class="row">


            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <br>

                    <div class="x_content">

                        <div class="form-inline" style="margin-bottom:2em;" id="payrunDetails">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Payrun Name: </strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="payrun_name">...</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Pay Period: </strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="payperiod">...</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Pay Date: </strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="paydate">...</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="list_payrun_loader3"></i>
                            <div class="table-responsive" id="list_payrun_table3">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">

                                            <th class="column-title">Employee</th>
                                            <th class="column-title">Department</th>
                                            <th class="column-title">Gross Pay</th>
                                            <th class="column-title">Deductions</th>
                                            <th class="column-title">Tax</th>
                                            <th class="column-title">Net Pay</th>
                                            <!-- <th class="column-title">Tax</th> -->
                                            <th class="column-title" width="10%">Pay Slip
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody id="list_payrun_body3">

                                    </tbody>
                                </table>
                                <div class="container">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination" id="pagination"></ul>
                                    </nav>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12" id="buttons_section" style="display:none;">

                            <div class="form-row" id="approve_decline_buttons">
                                <div class="col-md-2 col-sm-2 col-xs-6">
                                    <button type="submit" class="btn btn-success" id="approve_btnn">Approve</button>
                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                        id="approvee_loader"></i>

                                </div>

                                <div class="col-md-2 col-sm-2 col-xs-6">
                                    <button type="submit" class="btn btn-danger" id="decline_btnn">Decline</button>
                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                        id="declinee_loader"></i>
                                    <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->


<!-- modal -->
<div class="modal fade" id="modal_attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Success
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <h4>Employee Attendance Added Successfully!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="view_payslip_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">View Payslip
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div class="col-md-12" style="margin-top:2em;">
                    <!-- <div class="card"> -->
                    <!-- <div class="card-body"> -->
                    <h3 class="payslip-title title_center" id="com_name">NaHere Limited</h3>
                    <!-- <h5 class="subtitle">8/10 Ilupeju Byepass, Lagos State, Nigeria</h5> -->

                    <div class="row" style="background:#17a2b8;color:white;">
                        <div class="col-sm-6 m-b-20">
                            <ul class="list-unstyled">
                                <li>
                                    <h3 class="text-uppercase" id="emy_name"><strong>John Doe</strong></h3>
                                </li>
                                <li><span id="depy_name">IT </span> - <span id="joby_name">Computer Programming</span>
                                </li>
                                <li>Bank Name: <span id="banky_name">First Bank</span></li>
                                <li>Account Number: <span id="banky_no">1234567890</span></li>
                            </ul>
                        </div>

                        <div class="col-sm-6 m-b-20">
                            <!-- <div class="invoice-details"> -->

                            <ul class="list-unstyled">
                                <li>
                                    <h3 class="text-uppercase">&#8203;</h3>
                                </li>
                                <li>Pay Period: <span id="pay_period_datey">March 15th 2019 - March 28th 2019</span>
                                </li>
                                <li>Payment Date: <span id="pay_datey">March 15th 2019</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- </div> -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <h4 class="m-b-10"><strong>Earnings</strong></h4>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="credit_loader2"></i>
                                <table class="table table-bordered" id="credit_body2">
                                    <tbody id="credit_table2">
                                        <!-- <tr>
                                                <td><strong>Basic Salary</strong> <span class="float-right">$6500</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>House Rent Allowance (H.R.A.)</strong> <span
                                                        class="float-right">$55</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Conveyance</strong> <span class="float-right">$55</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Other Allowance</strong> <span
                                                        class="float-right">$55</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Earnings</strong> <span
                                                        class="float-right"><strong>$55</strong></span></td>
                                            </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div>
                                <h4 class="m-b-10"><strong>Deductions</strong></h4>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="debit_loader2"></i>
                                <table class="table table-bordered" id="debit_body2">
                                    <tbody id="debit_table2">
                                        <!-- <tr>
                                                <td><strong>Tax Deducted at Source (T.D.S.)</strong> <span
                                                        class="float-right">$0</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Provident Fund</strong> <span class="float-right">$0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>ESI</strong> <span class="float-right">$0</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Loan</strong> <span class="float-right">$300</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Deductions</strong> <span
                                                        class="float-right"><strong>$59698</strong></span></td>
                                            </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p><strong>Gross Pay: <span id="gpay">$59698</span></strong></p>
                            <p><strong>Net Salary: <span id="npay">$59698</span></strong></p>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-success" id="edit_nok_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_nok_loader"></i> -->
            </div>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/bcb3edd6a7.js" crossorigin="anonymous"></script>
<script src="js-files/payrun.js"></script>


<?php
include_once("../gen/_common/footer.php");
?>