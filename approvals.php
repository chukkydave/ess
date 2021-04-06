<?php
include("_common/header.php");
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Approvals</h3>
            </div>

            <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">

                        <!-- button type="button" class="btn btn-primary" id="filter_attendence">Filter</button>
                    
                    <button type="button" class="btn btn-success" id="add_attendence">Add</button>
                    
                    <button type="button" class="btn btn-success" id="upload_attendence">Upload</button>
 -->

                    </div>
                </div>
            </div>

        </div>


        <div id="upload_display" style="display: none;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dot">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p class="col-md-7 col-xs-12"><span>*</span>Upload a CSV file</p>
                                        <!-- <input type="file" id="dot" required="required" class="form-control col-md-7 col-xs-12 required"> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dot">Choose File
                                        <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" id="dot" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error">

                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                                        <button type="button" class="btn btn-success" id="add_terminate">Upload</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="termination_loader"></i>
                                    </div>
                                </div>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="add_attendence_display" style="display: none;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_id">Employee
                                        <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12 required" id="employee_id"
                                            name="employee_id">
                                            <option value="">-- Select --</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date
                                        <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="date" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clock_in">Clock In
                                        Time <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="clock_in" required="required"
                                            class="form-control col-md-7 col-xs-12 required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clock_out">Clock Out
                                        Time
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="clock_out" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_att">

                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                                        <button type="button" class="btn btn-success" id="add">Add</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="attendance_loader"></i>
                                    </div>
                                </div>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="filter_attendence_display" style="display: none;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />


                            <div class="form-row">

                                <div class="col-sm-4 col-xs-4">
                                    <select class="form-control col-md-7 col-xs-12 required" id="employee_name">
                                        <option value="">-- Select Employee--</option>

                                    </select>
                                </div>


                                <div class="col-sm-4 col-xs-4">
                                    <input type="text" class="form-control" placeholder="Date Range" id="date_range">
                                </div>



                                <button type="button" class="btn btn-success" id="filter">Search</button>
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

                                        <th class="column-title">ID</th>
                                        <th class="column-title">Application Date</th>
                                        <th class="column-title">Type</th>
                                        <th class="column-title">Decision</th>
                                        <!-- <th class="column-title">Clock Out Time</th> -->
                                        <!-- <th class="column-title">Work Hours</th> -->
                                        <!-- <th class="column-title">Over Time/Late By</th> -->

                                        <th class="column-title no-link last"><span class="nobr">Actions</span>
                                        </th>
                                        <th class="bulk-actions" colspan="5">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>

                                <tr id="loading">
                                    <td colspan="4">
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"></i>
                                    </td>
                                </tr>
                                <tbody id="approvalData">

                                </tbody>
                            </table>
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





<div class="modal fade" id="view_approval_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Application Details
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">


                <div style="display: ; text-align: center" id="loader_for_dtls">
                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ; text-align: center"></i>
                </div>



                <div class="table-responsive dtl_of_app" style="display: none">

                    <table class="table">
                        <thead>
                            <tr class="headings">


                                <th class="column-title" style="30%">Name </th>
                                <th class="column-title" style="70%">Value </th>

                            </tr>
                        </thead>
                        <tbody id="unitData">
                            <tr>
                                <td>Application Type</td>
                                <td class="dtl_vl" id="applc_type"></td>
                            </tr>
                            <tr>
                                <td>Application Code</td>
                                <td class="dtl_vl" id="applc_code"></td>
                            </tr>
                            <tr>
                                <td>Date of Application</td>
                                <td class="dtl_vl" id="applc_date"></td>
                            </tr>
                            <tr>
                                <td>Application By</td>
                                <td class="dtl_vl" id="applc_by"></td>
                            </tr>
                            <tr>
                                <td>Leave Start </td>
                                <td class="dtl_vl" id="applc_leave_start"></td>
                            </tr>
                            <tr>
                                <td>Leave End</td>
                                <td class="dtl_vl" id="applc_leave_end"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>

                    <!-- <div id="apprrv_btns" style="display: none">
                    <button type="button" class="btn btn-success approve_this" id="yes">Approve</button>
                    <button type="button" class="btn btn-danger approve_this" id="declined">Decline</button>
                  </div>
                  
                  <i class="fa fa-check-square fa-3x" style="display: none; text-align: center; color: #2fa877" id="checkdgood" ></i>

                  <i class="fa fa-times-circle fa-3x" style="display: none; text-align: center; color: #db5e55" id="checkdx" ></i>

                  <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none; text-align: center" id="lda_apprva" ></i> -->


                </div>




            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>











<div class="modal fade" id="approve_or_decline_decision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Act on Application
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">


                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none; text-align: center"></i>

                <div id="apprrv_btns" style="display: ; text-align: center">

                    <button class="btn btn-success approve_this" id="yes">Approve</button> | <button
                        class="btn btn-danger approve_this" id="declined">Decline</button>

                </div>

                <i class="fa fa-check-square fa-3x" style="display: none; text-align: center; color: #2fa877"
                    id="checkdgood"></i>

                <i class="fa fa-times-circle fa-3x" style="display: none; text-align: center; color: #db5e55"
                    id="checkdx"></i>

                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none; text-align: center"
                    id="lda_apprva"></i>




            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>




<script type="text/javascript">
$(document).ready(function() {
    pending_approvals_list('');
    $(document).on('click', '.approval_info_details', function() {
        var id = $(this).attr("id").replace(/apprv_id_/, '');
        view_approval_details(id);
    });
    $(document).on('click', '.approve_or_decline', function() {
        var id = $(this).attr("id").replace(/apprv_id_/, '');
        var idt = $(this).attr('data')
        $('#approve_or_decline_decision').modal('show')
        $('.approve_this').attr('data', idt)
        // approve_or_decline(id);
    });

    $(document).on('click', '.approve_this', function() {
        var decision = $(this).attr("id");
        let app_id = $(this).attr("data")
        do_the_action(decision, app_id);
    });
});


function do_the_action(decision, app_id) {

    $("#apprrv_btns").hide();
    $("#lda_apprva").show();

    var company_id = localStorage.getItem('company_id');
    var email = localStorage.getItem('email');
    var user_id = localStorage.getItem('user_id');
    var date_acted = "";

    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "ess/ess_approval_or_decline",
        data: {
            "company_id": company_id,
            "email": email,
            'user_id': user_id,
            "decision": decision,
            "app_id": app_id
        },
        timeout: 60000,
        success: function(response) {

            if (response.status == "200") {

                if (decision == "yes") {
                    $("#checkdgood").show();
                    setTimeout(() => {
                        window.location.reload()
                    }, 2000);

                } else if (decision == "declined") {
                    $("#checkdx").show();
                    setTimeout(() => {
                        window.location.reload()
                    }, 2000);
                }

            } else if (response.status == "400") {

                alert(response.msg)
            }

            $("#lda_apprva").hide();
            console.log(response);

        },
        error: function(response) {
            console.log(response);
            $("#lda_apprva").hide();
            $("#apprrv_btns").show();
            alert("Error");
        }
    });

}


function view_approval_details(id) {

    $(".dtl_of_app").hide();
    $("#loader_for_dtls").show();
    $(".dtl_vl").html('');

    $("#apprrv_btns").show(); //reset the apprv button to show
    $("#lda_apprva").hide(); //reset loader to hidden


    $('#view_approval_details').modal('show');
    var company_id = localStorage.getItem('company_id');


    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "ess/view_ess_approval",
        data: {
            "company_id": company_id,
            "app_id": id
        },
        timeout: 60000,
        success: function(response) {

            if (response.status == "200") {

                $(".dtl_of_app").show();
                $("#applc_type").html(response.data.app_type);
                $("#applc_code").html(response.data.code);
                $("#applc_date").html(response.data.request_date);
                $("#applc_by").html(response.data.firstname + ' ' + response.data.lastname);
                $("#applc_leave_start").html(format_a_date(response.data.start_date));
                $("#applc_leave_end").html(format_a_date(response.data.resume_date));

                // if(response.data.decision == "pending"){
                //   $("#apprrv_btns").show();
                // }else{
                //   $("#apprrv_btns").hide();
                // }


            } else if (response.status == "400") {



            }
            $("#loader_for_dtls").hide();
            console.log(response);
        },
        error: function(response) {
            console.log(response);
            alert("Error");
        }
    });
}



function pending_approvals_list(page) {

    var company_id = localStorage.getItem('company_id');
    var user_id = localStorage.getItem('user_id');
    var email = localStorage.getItem('email');

    if (page == "") {
        var page = 1;
    }
    var limit = 20;

    $("#loading").show();
    $("#leaveData").html('');

    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "ess/list_employee_approvals",
        data: {
            "user_id": user_id,
            "company_id": company_id,
            "page": page,
            "limit": limit,
            "email": email
        },
        timeout: 60000,

        success: function(response) {

            console.log(response);

            var strTable = "";


            if (response.status == '200') {

                $('#loading').hide();

                if (response.data.length > 0) {

                    var k = 1;

                    $.each(response.data, function(i, v) {

                        var aprvv_status = "";

                        if (v.decision == "pending") {
                            aprvv_status =
                                '<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>';
                            strTable += '<tr> <td>' + v.app_id + '</td> <td>' + format_a_date_time(v
                                    .request_time) + '</td><td>' + v.app_type + '</td><td>' +
                                aprvv_status +
                                '</td><td><a class="approval_info_details btn btn-primary btn-xs"  id="apprv_id_' +
                                v.app_id +
                                '"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a>  <a class="approve_or_decline btn btn-success btn-xs" data="' +
                                v.app_id + '"  id="venIn_' +
                                v.app_id +
                                '"><i  class="fa fa-align-justify"  data-toggle="tooltip" data-placement="top" title="Act"></i> Act</a> </td></tr>';
                        } else if (v.decision == "yes") {
                            aprvv_status = '<i class="fa fa-check fa-2x" style="color: green"></i>';
                            strTable += '<tr> <td>' + v.app_id + '</td> <td>' + format_a_date_time(v
                                    .request_time) + '</td><td>' + v.app_type + '</td><td>' +
                                aprvv_status +
                                '</td><td><a class="approval_info_details btn btn-primary btn-xs"  id="apprv_id_' +
                                v.app_id +
                                '"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a>   </td></tr>';
                        } else if (v.decision == "declined") {
                            aprvv_status = '<i class="fa fa-times fa-2x" style="color: red"></i>';
                            strTable += '<tr> <td>' + v.app_id + '</td> <td>' + format_a_date_time(v
                                    .request_time) + '</td><td>' + v.app_type + '</td><td>' +
                                aprvv_status +
                                '</td><td><a class="approval_info_details btn btn-primary btn-xs"  id="apprv_id_' +
                                v.app_id +
                                '"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a> </td></tr>';
                        }


                        k++;

                    });

                    $("#approvalData").html(strTable);

                    $('#pagination').twbsPagination({
                        totalPages: Math.ceil(response.total_rows / limit),
                        visiblePages: 10,
                        onPageClick: function(event, page) {
                            pending_approvals_list(page);
                        }
                    });

                } else {

                    strTable = '<tr><td colspan="5">' + response.msg + '</td></tr>';

                }


                $("#approvalData").html(strTable);
                $("#approvalData").show();

            } else if (response.status == 400) {

                console.log(response.status);
                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="5">' + response.msg + '</td>';
                strTable += '</tr>';

                alert(strTable);
                $("#approvalData").html(strTable);
                $("#approvalData").show();

            }

        },

        error: function(response) {
            var strTable = "";
            $('#loading').hide();
            // alert(response.msg);
            strTable += '<tr>';
            strTable += '<td colspan="5"><strong class="text-danger">Connection error</strong></td>';
            strTable += '</tr>';


            $("#approvalData").html(strTable);
            $("#approvalData").show();

        }

    });

}
</script>

<?php
include("_common/footer.php");
?>