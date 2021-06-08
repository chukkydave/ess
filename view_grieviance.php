<?php
include("_common/header.php");
?>
<style>
blockquote {
    background: #f9f9f9;
    border-left: 10px solid #ccc;
    margin: 1.5em 10px;
    padding: 0.5em 10px;
    quotes: "\201C""\201D""\2018""\2019";
}

/* blockquote:before {
    color: #ccc;
    content: open-quote;
    font-size: 4em;
    line-height: 0.1em;
    margin-right: 0.25em;
    vertical-align: -0.4em;
} */

blockquote p {
    display: inline;
    font-size: 0.7em;
}
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Grievance</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <!-- <button type="button" class="btn btn-default" id="incoming_filter">Filter</button> -->
                        <a href="grievances"><button type="button" class="btn btn-danger">Back</button></a>

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
                            Grievance Report
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
                                    <p><strong>Code:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="griev_code">...</p>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Type:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="griev_type">...</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>From:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="griev_from">...</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Aganist:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="griev_aganist">...</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Incident Date:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="griev_date">...</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Incident Report:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="griev_report">...</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Branch:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="griev_branch">...</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <p><strong>Document:</strong></p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p id="griev_doc">...</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="grievDetails_error">

                                </div>
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
                            Proceedings
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
                        <div class="col-md-9 col-sm-9  ">

                            <div>
                                <h2><strong>State your sides of the story<strong></h2>

                                <ul class="messages">
                                    <li>

                                        <div class="message_wrapper">
                                            <h4 class="heading">Desmond Davison</h4>
                                            <blockquote>
                                                <p>Raw denim you probably haven't heard
                                                    of them jean shorts Austin. Nesciunt tofu stumptown aliqua
                                                    butcher retro keffiyeh dreamcatcher synth.</p>
                                            </blockquote>
                                            <br />
                                            <p class="url">
                                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                <a href="#"><i class="fa fa-paperclip"></i> User Acceptance
                                                    Test.doc </a>
                                            </p>
                                        </div>
                                    </li>
                                    <li>

                                        <div class="message_wrapper">
                                            <h4 class="heading">Brian Michaels</h4>
                                            <blockquote>
                                                <p>Raw denim you probably haven't heard
                                                    of them jean shorts Austin. Nesciunt tofu stumptown aliqua
                                                    butcher retro keffiyeh dreamcatcher
                                                    synth.hffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
                                                </p>
                                            </blockquote>
                                            <br />
                                            <p class="url">
                                                <span class="fs1" aria-hidden="true" data-icon=""></span>
                                                <a href="#" data-original-title="">Download</a>
                                            </p>
                                        </div>
                                    </li>
                                    <li>

                                        <div class="message_wrapper">
                                            <h4 class="heading">Desmond Davison</h4>
                                            <blockquote>
                                                <p>Raw denim you probably haven't heard
                                                    of them jean shorts Austin. Nesciunt tofu stumptown aliqua
                                                    butcher retro keffiyeh dreamcatcher synth.</p>
                                            </blockquote>
                                            <br />
                                            <p class="url">
                                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                <a href="#"><i class="fa fa-paperclip"></i> User Acceptance
                                                    Test.doc </a>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                <!-- <div class="col-md-8"> -->
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i>
                                        Comment</button>
                                </div>
                                <!-- </div> -->
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
                                    <input type="text" id="incident_date"
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
                            <p id="incident_date"></p>
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

<script type="text/javascript" src="js-files/view_grievances.js"></script>



<?php
include("_common/footer.php");
?>