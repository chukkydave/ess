<?php
include("_common/header.php");
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>View Exit</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <!-- <button type="button" class="btn btn-default" id="incoming_filter">Add</button> -->
                        <a href="approvals"><button type="button" class="btn btn-danger">Back</button></a>
                    </div>
                </div>
            </div>
        </div>



        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Employee Details
                            <!-- <small>Activity report</small> -->
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Firstname:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="firstname"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Lastname:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="lastname"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Middlename:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="middlename"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Gender:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="gender"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Date of Birth:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="dob"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Marital Status:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="marital_status"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Religion:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="religion"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Phone:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="phone"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Address:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="residential_address"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Email:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="email"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Status:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="status"></p>
                                </div>
                            </div>
                            <!-- <div>
                                <a id="view_prf_btn"><button class="btn btn-sm btn-primary">View Full
                                        Profile</button></a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Exit Details
                            <!-- <small>Activity report</small> -->
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <!-- <li data-toggle="modal" id="edit_bank_details" data-target="#edit_bank_details_modal"
                                title="Edit Bank Details">
                                <a class=""><i class="fa fa-pencil"></i></a>
                            </li> -->

                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Name:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="single_view_name"></p>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Current Department:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="single_view_dept"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Job Title:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="single_view_JT"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Date Of Joining:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="single_view_DOJ"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Supervisor:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="single_view_supervisor"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Exit Type:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="single_view_exitType"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Comment:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="single_view_comment"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Document:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="single_view_doc"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Status:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="single_view_status"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Date Of Exit:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="single_view_exitDate">...</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="single_view_error">

                                </div>
                            </div>
                            <div style="display:none;" id="btnGroup">
                                <button class="btn btn-sm btn-success" id="approve_btn">Approve</button>
                                <button class="btn btn-sm btn-danger" id="decline_btn">Decline</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="decline_loader"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            Approvers
                            <!-- <small>Activity report</small> -->
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <!-- <li id="add_header_details" data-toggle="collapse" data-target="#collapseExample"
                                aria-expanded="false" aria-controls="collapseExample">
                                <a class=""><span data-toggle="tooltip" title="Add Exit Approvers"><i
                                            class="fa fa-plus"></i><span></a>
                            </li> -->

                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <div class="collapse" id="collapseExample" style="">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">

                                        <div class="x_content">
                                            <br />
                                            <span id="demo-form2" data-parsley-validate
                                                class="form-horizontal form-label-left">

                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                        for="name">Employee
                                                        Name<span>*</span>
                                                    </label>

                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="form-control js-example-basic-single"
                                                            id="empo_name" multiple="multiple"
                                                            style="width:100% !important;max-width:800px !important; border-radius:30px !important; "></select>
                                                    </div>
                                                </div>






                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                                        <button type="button" class="btn btn-success"
                                                            id="add_apprvoer">Add</button>
                                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                            style="display: none;" id="add_apprvoer_loader"></i>
                                                    </div>
                                                </div>


                                            </span>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" id="list_appv_table">
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="appv_loader"></i>


                            <table class="table table-striped" id="appv_table">
                                <!-- <thead>
                                                                        <tr>

                                                                            <th class="column-title">&nbsp; </th>
                                                                            <th class="column-title">&nbsp; </th>
                                                                            <th class="column-title">Approval
                                                                                Status </th>
                                                                            <th class="column-title">Date of Action
                                                                            </th>
                                                                            <th class="column-title">Action</th>


                                                                        </tr>
                                                                    </thead> -->


                                <tbody id="appv_body">

                                </tbody>
                            </table>

                        </div>

                        <div class="col-md-9 col-sm-9 " id="proceeding_section">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- modal -->

<div class="modal fade" id="exit_date_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Input Comment
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                    <span id="" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exit_comment">Comment
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea type="date" id="exit_comment" required="required" style="margin-bottom:5px;"
                                    class="form-control col-md-7 col-xs-12 required"></textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="exit_date_error">

                            </div>
                        </div>



                    </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="approve_btnn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="approvee_loader"></i>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exit_date_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Input Comment
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                    <span id="" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exit_comment2">Comment
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea type="date" id="exit_comment2" required="required" style="margin-bottom:5px;"
                                    class="form-control col-md-7 col-xs-12 required"></textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="exit_date_error2">

                            </div>
                        </div>



                    </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="decline_btnn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="declinee_loader"></i>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript" src="js-files/view_exit.js"></script>



<?php
include("_common/footer.php");
?>