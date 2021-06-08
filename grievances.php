<?php
include("_common/header.php");
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Grievance Request</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <!-- <button type="button" class="btn btn-default" id="incoming_filter">Filter</button> -->
                        <button type="button" class="btn btn-success" id="apply">Report</button>

                    </div>
                </div>
            </div>
        </div>

        <div id="apply_display" style="display: none;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="g_type">Grievance Type
                                        <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12 required1" id="g_type">
                                            <option value="">-- Select --</option>
                                            <option value="assualt">Assualt</option>
                                            <option value="molestation">Molestation</option>
                                            <option value="Employe Conduct">Employee Conduct</option>
                                            <option value="Employee Capability">Employee Capability</option>
                                            <option value="Working Conditions">Working Conditions</option>
                                            <option value="Management Policy">Management Policy</option>
                                            <option value="Others">Others</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="incident_date">Incident Date <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon"><i
                                                    class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                            <input type="text" id="incident_date"
                                                class="form-control col-md-7 col-xs-12 required1">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="incident">Incident
                                        Report<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea cols="3" id="incident"
                                            class="form-control col-md-7 col-xs-12 required1">

                            </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch">Branch
                                        <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12 required1" id="branch">
                                            <option value="">-- Select --</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="g_against_select">Grievance
                                        Against <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12 required1" id="g_against">
                                            <option value="">-- Select --</option>
                                            <option value="Employee">Employee</option>
                                            <option value="Employer">Employer</option>
                                            <option value="Other">Other</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" id="selct_empl" style="display:none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="g_against_select">Select
                                        Employee
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12" id="g_against_select">
                                            <option value="">-- Select --</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="prior_action">Action(s) Prior to Reporting<br><span
                                            style="font-size:0.8em;">(If any)</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="prior_action" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upload_doc">Upload
                                        Document<br><span style="font-size:0.8em;">(If any)</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="upload_doc" type="file" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_g">

                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!-- <button class="btn btn-primary" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button> -->
                                        <button type="button" class="btn btn-success" id="add_g">Report</button>
                                        <button type="button" class="btn btn-primary" id="add_d">Save as Draft</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="loading_g"></i>
                                    </div>
                                </div>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="filter_display" style="display: none;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />


                            <div class="form-row">

                                <div class="col-sm-3 col-xs-4">
                                    <label>Item Name</label>
                                    <input type="text" id="item_name" class="form-control">
                                </div>


                                <div class="col-sm-3 col-xs-4">
                                    <label>Vendor Name</label>
                                    <input type="text" id="vendor_name" class="form-control">
                                </div>

                                <div class="col-sm-3 col-xs-4">
                                    <label>Date Range</label>
                                    <input type="text" class="form-control" id="date_range">
                                </div>

                                <div class="col-sm-3 col-xs-4">
                                    <label>Item Code</label>
                                    <input type="text" class="form-control" id="item_code">
                                </div>

                            </div>
                            <br><br>

                            <div class="form-row">

                                <div class="col-sm-3 col-xs-4">
                                    <br>
                                    <button type="button" class="btn btn-success" id="filter">Go</button>
                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                        id="filter_loader"></i>
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



                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">

                                        <th class="column-title">Code</th>
                                        <th class="column-title">Against</th>
                                        <th class="column-title">Grievance Type</th>
                                        <th class="column-title">Proceedings</th>
                                        <th class="column-title no-link last"><span class="nobr">Actions</span>
                                        </th>
                                        <th class="bulk-actions" colspan="6">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>


                                <tbody id="grievanceData">
                                    <tr id="loading">
                                        <td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-3x"
                                                style="display: ;"></i></td>
                                    </tr>
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
<div class="modal fade" id="modal_g" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Grievance Report Added Successfully!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>


<div class="modal fade" id="modal_edit_g" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Grievance
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div id="edit_form">
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="g_type">Grievance Type
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 required" id="g_type">
                                    <option value="">-- Select --</option>
                                    <option value="misconduct">Misconduct</option>
                                    <option value="assualt">Assualt</option>
                                    <option value="molestation">Molestation</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="incident_date">Incident Date
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i
                                            class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" id="incident_dateE"
                                        class="form-control col-md-7 col-xs-12 required">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="incident">Incident Report
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea cols="3" id="incident" class="form-control col-md-7 col-xs-12">

                      </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch">Branch
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 required" id="branch">
                                    <option value="">-- Select --</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="g_against">Grievance Against
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 required" id="g_against">
                                    <option value="">-- Select --</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emp_response">Response
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea cols="3" id="emp_response" class="form-control col-md-7 col-xs-12">

                      </textarea>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error">


                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" id="form_footer">
                                <button type="submit" class="btn btn-success" id="edit_g">Update</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="edit_g_loader"></i>
                            </div>
                        </div>

                    </span>
                </div>

                <div id="edit_msg" style="display: none;">
                    <h4>Grievance Report Updated Successfully!</h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                    </div>
                </div>

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div> -->
        </div>
    </div>
</div>



<div class="modal fade" id="modal_view_g" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Grievance Info
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">


                <div id="container4">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Grievance Type:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="g_type"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Incident Date:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="incident_datem"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Report:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="report"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Branch:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="branch"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Approval Status:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="approval"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Response:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="report"></p>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js-files/grievances.js"></script>



<?php
include("_common/footer.php");
?>