<?php
include("_common/header.php");
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

.has-errors {
    color: red;
}
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Exit</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right; display:flex;">
                        <!-- <button type="button" class="btn btn-default" id="incoming_filter">Filter</button> -->
                        <button type="button" class="btn btn-success" id="view_policy_btn">View Exit Policy</button>
                        <button type="button" class="btn btn-danger" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                            id="intiating_btn">Initiate Exit</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="collapse" id="collapseExample" style="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                Employment Info
                                <!-- <small>Activity report</small> -->
                            </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <!-- <li data-toggle="modal" id="edit_emp_info" data-target="#edit_employment_info_modal"
                                    title="Edit Employment Info">
                                    <a class=""><i class="fa fa-pencil"></i></a>
                                </li> -->

                            </ul>
                            <div class="clearfix"></div>
                        </div>



                        <div class="x_content">
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="view_exit_loader"></i>
                            <div class="col-md-12 col-sm-12 col-xs-12" id="view_exit_div">

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Name:</strong></p>
                                        <p hidden id="employee_idr"></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="name"></p>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Current Department:</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="department"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Job Title:</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="job_title"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Date of Joining:</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p id="date_of_joining"></p>
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom:10px;">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Supervisor:</strong><span class="asterix">*</span></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <select class="form-control add_exit_fields" id="supervisor"
                                            style="padding:5px; width:70%;">
                                            <option>--Select Supervisor--</option>
                                        </select>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-2x" style="display: none;"
                                            id="edit_visor_loader"></i>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong></strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p style="color:red;" id="view_exit_error"></p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                Exit Details
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

                                <div class="row" style="margin-bottom:10px;">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Exit Type:</strong><span class="asterix">*</span></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <select class="form-control add_exit_fields" id="exit_type"
                                            style="padding:5px; width:70%;">
                                            <option>--Select--</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom:10px;">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Comment:</strong><span class="asterix">*</span></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <textarea cols="3" id="comment" class="form-control add_exit_fields"
                                            style="width:70%;">

                                        </textarea>
                                    </div>
                                </div>

                                <div class="row" style="margin-bottom:10px;">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <p><strong>Upload Document:</strong></p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <input type="file" id="file" style="border:none; width:70%"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-sm-8 col-md-8 col-xs-8">

                                        <p class="text-danger" id="exit_error"></p>

                                    </div>

                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <button type="button" class="btn btn-sm btn-success"
                                        id="add_exit_btn">Initiate</button>
                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                        id="add_exit_loader"></i>
                                </div>


                            </div>
                        </div>
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




                        <!-- <select class="form-select no-border" id="sort_type" aria-label="Default select example">
                                <option value="all">All</option>
                                <option value="grievance">Grievance</option>
                                <option value="third_party">Third party</option>
                            </select> -->

                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_exit_loader"></i>
                        <div class="table-responsive" id="list_exit_table">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">

                                        <th class="column-title">Exit Type</th>
                                        <th class="column-title">Date Initiated</th>
                                        <th class="column-title">Employment Status</th>
                                        <th class="column-title">Exit Status</th>
                                        <th class="column-title no-link last" width="10%"><span class="nobr"></span>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody id="list_exit_body">

                                </tbody>
                            </table>
                            <div class="container">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination" id="pagination"></ul>
                                </nav>
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
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
            <div class="modal-body" id="mod_bodi">
                <h4>Grievance Report Added Successfully!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>


<div class="modal fade" id="view_policy_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">View Exit Policy
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <!-- <div class="x_content">
                    <div class="col-md-9 col-sm-12 col-xs-12"> -->
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_policy_loader"></i>
                <div class="" id="policy_list">
                    <!-- <ul class="to_do" id="policy_list" style="">

                                </ul> -->
                </div>

                <!-- </div>
                </div> -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="single_view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">View Exit Details
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
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

            </div>
            <div class="modal-footer">
                <button type="button" id="single_view_btn" class="btn btn-default" data-dismiss="modal">Ok</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="single_view_loader"></i>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js-files/exit.js"></script>



<?php
include("_common/footer.php");
?>