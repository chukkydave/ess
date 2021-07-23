<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Expense Claim</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <!-- <button type="button" class="btn btn-default" id="incoming_filter">Filter</button> -->
                        <!-- <button type="button" class="btn btn-success" id="apply">Add</button> -->

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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leave_type">Leave Type
                                        <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12 required" id="leave_type">
                                            <option value="">-- Select --</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leave_start">Leave
                                        Start <span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon"><i
                                                    class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                            <input type="text" id="leave_start" required="required"
                                                class="form-control col-md-7 col-xs-12 required">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="resumption_date">Resumption Date<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon"><i
                                                    class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                            <input type="text" id="resumption_date" required="required"
                                                class="form-control col-md-7 col-xs-12 required">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="comment">Comment<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea cols="3" id="comment" class="form-control col-md-7 col-xs-12">

                            </textarea>
                                    </div>
                                </div>





                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_leave">

                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!-- <button class="btn btn-primary" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button> -->
                                        <button type="button" class="btn btn-success" id="add_leave">Add</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="loading_app"></i>
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
                                        <th class="column-title">Leave Type</th>


                                        <th class="column-title">Start Date</th>
                                        <th class="column-title">Resumption Date</th>
                                        <th class="column-title no-link last"><span class="nobr">Actions</span>
                                        </th>
                                        <th class="bulk-actions" colspan="6">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>


                                <tbody id="leaveData">
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




<div class="modal fade" id="modal_edit_leave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Leave
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div id="edit_form">
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leave_type">Leave Type
                                <span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 required1" id="leave_type">
                                    <option value="">-- Select --</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_date">Start
                                Date<span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="start_date" class="form-control col-md-7 col-xs-12 required1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="resumption_date">Resumption
                                Date<span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="resumption_date"
                                    class="form-control col-md-7 col-xs-12 required1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                for="comment1">Comment<span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea cols="3" class="form-control col-md-7 col-xs-12" id="comment1">

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
                                <button type="submit" class="btn btn-success" id="edit_leave">Update</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="edit_leave_loader"></i>
                                <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                            </div>
                        </div>

                    </span>
                </div>

                <div id="edit_msg" style="display: none;">
                    <h4>Leave Updated Successfully!</h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                    </div>
                </div>

            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>



<div class="modal fade" id="modal_view_leave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Leave Info
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">


                <div id="container4">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Leave Type:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="leave_type"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Start Date:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="start_date"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Resumption Date:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="resumption_date"></p>
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
                            <p><strong>Comment:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="comment"></p>
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



<!-- modal -->
<div class="modal fade" id="modal_leave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4>Leave Request Added Successfully!</h4>
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
    // var leave_id;
    // load_leave_type();

    // $('input#leave_start').datepicker({
    //   dateFormat: "yy-mm-dd"
    // });
    // $('input#resumption_date').datepicker({
    //   dateFormat: "yy-mm-dd"
    // });

    // $('#apply').on('click', display_apply);
    // $('#add_leave').on('click', add_employee_leave);

    // list_of_leaves('');

    // // $(document).on('click', '#filter', function(){
    // //     $('#pagination').twbsPagination('destroy');
    // //      list_of_incoming_items('');
    // // });

    // // $('#incoming_filter').on('click', display_filter);

    // // $('input#date_range').daterangepicker({
    // //   autoUpdateInput: false
    // // });

    // // $('input#date_range').on('apply.daterangepicker', function(ev, picker) {
    // //    $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));

    // // });

    // $(document).on('click', '.leave_info', function(){
    //     leave_id = $(this).attr('id').replace(/lv_/,''); 
    //     fetch_leave_info(leave_id);

    //   });

    //  $(document).on('click', '.delete_leave', function(){
    //     var leave_id = $(this).attr('id').replace(/lev_/,''); 
    //     delete_leave(leave_id);
    //   });

    //  $(document).on('click', '.edit_leave_icon', function(){
    //    leave_id = $(this).attr('id').replace(/leav_/,''); 
    //    fetch_leave_details(leave_id);

    //  });

    //  $(document).on('click', '#edit_leave', function(){
    //    // var warehouse_id = $(this).attr('id').replace(/edt_/,''); 
    //    edit_employee_leave(leave_id);
    //    // alert(warehouse_id);
    //  });


})


function load_leave_type() {

    var company_id = localStorage.getItem('company_id');

    $.ajax({
        url: api_path + "ess/fetch_leave_type",
        type: "POST",
        data: {
            "company_id": company_id
        },
        dataType: "json",


        success: function(response) {
            console.log(response);

            var options = '';

            $.each(response['data'], function(i, v) {
                options += '<option value="' + response['data'][i]['id'] + '">' + response['data'][
                    i
                ]['type'] + '</option>';

            });
            $('#leave_type').append(options);
            $('#modal_edit_leave #leave_type').append(options);
        },
        // jqXHR, textStatus, errorThrown
        error(response) {
            alert('Connection error');
        }
    });

}


function edit_employee_leave(leave_id) {
    var leave_type = $("#modal_edit_leave #leave_type").val();

    var leave_start = $("#modal_edit_leave #start_date").val();

    var resumption_date = $("#modal_edit_leave #resumption_date").val();
    var comment = $("#modal_edit_leave #comment1").val();
    var company_id = localStorage.getItem('company_id');
    var employee_id = localStorage.getItem('user_id');

    var blank;


    // alert(warehouse_id);

    $("#modal_edit_leave .required1").each(function() {

        var the_val = $.trim($(this).val());

        if (the_val == "" || the_val == "0") {

            $(this).addClass('has-error');

            blank = "yes";

        } else {

            $(this).removeClass("has-error");

        }

    });

    if (blank == "yes") {

        $("#modal_edit_leave #error").html("You have a blank field");

        return;

    }


    // $("#modal_edit_warehouse #error").html("");

    $("#modal_edit_leave #edit_leave").hide();
    $("#modal_edit_leave #edit_leave_loader").show();



    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "ess/edit_leave_request",
        data: {
            "leave_type": leave_type,
            "comment": comment,
            "company_id": company_id,
            "leave_id": leave_id,
            "employee_id": employee_id,
            "leave_start": leave_start,
            "resumption_date": resumption_date
        },

        success: function(response) {

            console.log(response);

            if (response.status == '200') {
                $("#modal_edit_leave #error").html("");
                $("#modal_edit_leave #edit_leave_loader").hide();
                $("#modal_edit_leave #edit_leave").show();


                $('#modal_edit_leave #edit_form').hide();
                $('#modal_edit_leave #edit_msg').show();

                // $('#modal_department_edit').on('hidden.bs.modal', function () {
                //     $('#department_name').val();
                //     $('#department_description').val();
                window.location.reload();
                //     window.location.href = base_url+"/erp/hrm/departments";
                // })


            } else if (response.status == '400') { // coder error message


                $("#modal_edit_leave #error").html('Technical Error. Please try again later.');

            } else if (response.status == '401') { //user error message


                $("#modal_edit_leave #error").html(response.msg);

            }






        },

        error: function(response) {

            console.log(response);
            $("#modal_edit_leave #edit_leave_loader").hide();
            $("#modal_edit_leave #edit_leave").show();
            $("#modal_edit_leave #error").html("Connection Error.");

        }

    });

}


function fetch_leave_details(leave_id) {

    var company_id = localStorage.getItem('company_id');
    var employee_id = localStorage.getItem('user_id');

    $('#leav_' + leave_id).hide();
    $('#loader12_' + leave_id).show();

    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "ess/view_leave_status",
        data: {
            "leave_id": leave_id,
            "employee_id": employee_id,
            "company_id": company_id
        },

        success: function(response) {

            var str = "";
            console.log(response);

            $("#modal_edit_leave #error").html("");

            $("#modal_edit_leave .required").each(function() {

                var the_val = $.trim($(this).val());

                $(this).removeClass("has-error");

            });


            $('#loader12_' + leave_id).hide();
            $('#leav_' + leave_id).show();

            if (response.status == '200') {

                $("#modal_edit_leave #leave_type").val(response.data.leave_type);
                $("#modal_edit_leave #start_date").val(response.data.start_date);
                $("#modal_edit_leave #resumption_date").val(response.data.resume);
                // $("#modal_edit_leave #approval").val( response.data.approval);
                $("#modal_edit_leave #comment").val(response.data.comment);



                $('#modal_edit_leave').modal('show');
            }


        },

        error: function(response) {
            $('#loader12_' + leave_id).hide();
            $('#leav_' + leave_id).show();
            alert("Connection Error.");

        }

    });
}


function add_employee_leave() {

    var leave_type = $('#leave_type').val();
    var leave_start = $("#leave_start").val();
    var resumption_date = $("#resumption_date").val();
    var comment = $("#comment").val();
    var company_id = localStorage.getItem('company_id');
    var employee_id = localStorage.getItem('user_id');



    var blank;


    // alert(warehouse_id);

    $(".required").each(function() {

        var the_val = $.trim($(this).val());

        if (the_val == "" || the_val == "0") {

            $(this).addClass('has-error');

            blank = "yes";

        } else {

            $(this).removeClass("has-error");

        }

    });

    if (blank == "yes") {

        $("#error_leave").html("You have a blank field");

        return;

    }



    // $("#modal_edit_warehouse #error").html("");

    $("#add_leave").hide();
    $("#loading_app").show();



    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "ess/request_leave",
        data: {
            "leave_type": leave_type,
            "leave_start": leave_start,
            "company_id": company_id,
            "employee_id": employee_id,
            "resumption_date": resumption_date,
            "comment": comment
        },

        success: function(response) {

            console.log(response);

            $("#error_leave").html("");
            $("#loading_app").hide();
            $("#add_leave").show();

            if (response.status == '200') {

                $('#modal_leave').modal('show');

                $('#modal_leave').on('hidden.bs.modal', function() {

                    window.location.reload();
                    // window.location.href = base_url+"incoming";
                })


            } else if (response.status == '400') { // coder error message


                $("#error_leave").html('Technical Error. Please try again later.');

            } else if (response.status == '401') { //user error message


                $("#error_leave").html(response.msg);

            }



        },

        error: function(response) {

            console.log(response);
            $("#loading_app").hide();
            $("#add_leave").show();
            $("#error_leave").html("Connection Error.");

        }

    });

}

function display_filter() {

    $('#filter_display').toggle();
    $('#item_name').val("");
    $('#vendor_name').val("");
    $('#item_code').val("");
    $('#date_range').val("");
}

function display_apply() {

    $('#apply_display').toggle();
    $('#leave_start').val("");
    $('#resumption_date').val("");
    $('#comment').val("");
    $('#leave_type').val("");
}

function fetch_leave_info(leave_id) {

    var company_id = localStorage.getItem('company_id');
    var employee_id = localStorage.getItem('user_id');

    $('#lv_' + leave_id).hide();
    $('#loader11_' + leave_id).show();

    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "ess/view_leave_status",
        data: {
            "leave_id": leave_id,
            "company_id": company_id,
            "employee_id": employee_id
        },

        success: function(response) {

            console.log(response);


            $('#loader11_' + leave_id).hide();
            $('#lv_' + leave_id).show();

            if (response.status == '200') {

                var monthNames = [
                    "Jan", "Feb", "Mar",
                    "Apr", "May", "Jun", "Jul",
                    "August", "Sep", "Oct",
                    "Nov", "Dec"
                ];

                var d = new Date(response.data.resume);
                var monthIndex = d.getMonth();
                var datestring12 = d.getDate() + "/" + monthNames[monthIndex] + "/" + d.getFullYear();

                var s = new Date(response.data.start_date);
                var month = s.getMonth();
                var datestring = s.getDate() + "/" + monthNames[month] + "/" + s.getFullYear();

                $("#modal_view_leave #leave_type").html(response.data.leave_type);
                $("#modal_view_leave #start_date").html(datestring);
                $("#modal_view_leave #resumption_date").html(datestring12);
                $("#modal_view_leave #approval").html(response.data.approval);
                $("#modal_view_leave #comment").html(response.data.comment);



                $('#modal_view_leave').modal('show');
            }


        },

        error: function(response) {
            $('#loader11_' + leave_id).hide();
            $('#lv_' + leave_id).show();
            alert("Connection Error.");

        }

    });
}

function delete_leave(leave_id) {

    var company_id = localStorage.getItem('company_id');
    var employee_id = localStorage.getItem('user_id');


    var ans = confirm("Are you sure you want to delete this leave?");
    if (!ans) {
        return;
    }


    $('#row_' + leave_id).hide();
    $('#loader_row_' + leave_id).show();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "ess/delete_leave_request",
        data: {
            "company_id": company_id,
            "employee_id": employee_id,
            "leave_id": leave_id
        },
        timeout: 60000, // sets timeout to one minute
        // objAJAXRequest, strError

        error: function(response) {
            $('#loader_row_' + leave_id).hide();
            $('#row_' + leave_id).show();

            alert('connection error');
        },

        success: function(response) {
            // console.log(response);
            if (response.status == '200') {
                // $('#row_'+user_id).hide();


            } else if (response.status == '401') {


            }

            $('#loader_row_' + leave_id).hide();
        }
    });
}

function list_of_leaves(page) {
    var company_id = localStorage.getItem('company_id');
    var employee_id = localStorage.getItem('user_id');
    if (page == "") {
        var page = 1;
    }
    var limit = 10;


    $("#loading").show();
    $("#leaveData").html('');

    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "ess/list_leave_status",
        data: {
            "company_id": company_id,
            "page": page,
            "limit": limit,
            "employee_id": employee_id
        },
        timeout: 60000,

        success: function(response) {
            console.log(response);

            var strTable = "";

            if (response.status == '200') {
                $('#loading').hide();
                if (response.data.length > 0) {

                    var k = 1;
                    $.each(response['data'], function(i, v) {

                        var monthNames = [
                            "Jan", "Feb", "Mar",
                            "Apr", "May", "Jun", "Jul",
                            "August", "Sep", "Oct",
                            "Nov", "Dec"
                        ];

                        var d = new Date(response['data'][i]['start']);
                        var monthIndex = d.getMonth();
                        var start = d.getDate() + "/" + monthNames[monthIndex] + "/" + d
                            .getFullYear();

                        var f = new Date(response['data'][i]['finish']);
                        var month = f.getMonth();
                        var finish = f.getDate() + "/" + monthNames[month] + "/" + f.getFullYear();




                        strTable += '<tr id="row_' + response['data'][i]['id'] + '">';
                        strTable += '<td>' + response['data'][i]['code'] + '</td>';
                        strTable += '<td>' + response['data'][i]['type'] + '</td>';

                        // strTable += '<td>'+datestring+'</td>';
                        strTable += '<td>' + start + '</td>';
                        // +response['data'][i]['Vendor']+
                        // strTable += '<td>'+parseInt(response['data'][i]['qty']).toLocaleString()+'</td>';
                        strTable += '<td>' + finish + '</td>';
                        // strTable += '<td>Pending</td>';

                        strTable +=
                            '<td valign="top"><a class="leave_info btn btn-primary btn-xs"  id="lv_' +
                            response['data'][i]['id'] +
                            '"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title="View Leave info"></i> View</a>';

                        strTable +=
                            '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_' +
                            response['data'][i]['id'] + '"></i>&nbsp;&nbsp;';


                        strTable += '<a class="edit_leave_icon btn btn-info btn-xs"id="leav_' +
                            response['data'][i]['id'] +
                            '"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" title="Edit Leave Type"></i> Edit</a>&nbsp;&nbsp;';

                        strTable +=
                            '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader12_' +
                            response['data'][i]['id'] + '"></i>&nbsp;&nbsp;';

                        strTable +=
                            '<a class="delete_leave btn btn-danger btn-xs" style="cursor: pointer;" id="lev_' +
                            response['data'][i]['id'] +
                            '"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" title="Delete Leave Type"></i> Delete</a></td>';

                        strTable += '</tr>';

                        strTable += '<tr style="display: none;" id="loader_row_' + response['data'][
                            i
                        ]['id'] + '">';
                        strTable +=
                            '<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                        strTable += '</td>';
                        strTable += '</tr>';




                        k++;

                    });


                } else {

                    strTable = '<tr><td colspan="5">' + response.msg + '</td></tr>';

                }

                $('#pagination').twbsPagination({
                    totalPages: Math.ceil(response.total_rows / limit),
                    visiblePages: 10,
                    onPageClick: function(event, page) {
                        list_of_leaves(page);
                    }
                });


                $("#leaveData").html(strTable);
                $("#leaveData").show();

            } else if (response.data <= 0) {
                $('#loading').hide();

                strTable = '<tr><td colspan="5">' + response.msg + '</td></tr>';

                $("#leaveData").html(strTable);
                $("#leaveData").show();

            } else if (response.status == '400') {
                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="5">' + response.msg + '</td>';
                strTable += '</tr>';


                $("#leaveData").html(strTable);
                $("#leaveData").show();


            }

        },

        error: function(response) {
            var strTable = "";
            $('#loading').hide();
            // alert(response.msg);
            strTable += '<tr>';
            strTable += '<td colspan="5"><strong class="text-danger">Connection error</strong></td>';
            strTable += '</tr>';


            $("#leaveData").html(strTable);
            $("#leaveData").show();

        }

    });
}
</script>



<?php
include_once("../gen/_common/footer.php");
?>