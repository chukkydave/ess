<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Warehouses</h3>
            </div>

            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->

            <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <!--span class="input-group-btn"-->
                        <button type="button" class="btn btn-success" id="add_warehouse">Add Warehouse</button>


                    </div>
                </div>
            </div>
        </div>

        <div id="warehouse_display" style="display: none;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />
                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="add_warehouse_name">Warehouse Name<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="add_warehouse_name"
                                            class="form-control col-md-7 col-xs-12 required1">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="add_warehouse_address">Warehouse Address<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea cols="3" class="form-control col-md-7 col-xs-12 required1"
                                            id="add_warehouse_address">

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
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                                        <button type="button" class="btn btn-success" id="add_ware">Add</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="ware_loader"></i>
                                    </div>
                                </div>

                            </span>
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


                                        <th class="column-title">Name </th>
                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="2">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>

                                <tr id="loading">
                                    <td colspan="2"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"></i>
                                    </td>
                                </tr>

                                <tbody id="warehouseData">



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
<div class="modal fade" id="modal_warehouse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4>Warehouse Added Successfully!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="modal_view_warehouse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Warehouse Info
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">


                <div id="container4">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Warehouse Name:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="name"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Warehouse Address:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="address"></p>
                        </div>
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



<div class="modal fade" id="modal_edit_warehouse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Warehouse
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div id="edit_form">
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse_name">Warehouse
                                Name<span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="warehouse_name" required="required"
                                    class="form-control col-md-7 col-xs-12 required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse_address">Warehouse
                                Address<span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea cols="3" class="form-control col-md-7 col-xs-12 required"
                                    id="warehouse_address">

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
                                <button type="submit" class="btn btn-success" id="edit_ware">Update</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="edit_ware_loader"></i>
                                <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                            </div>
                        </div>

                    </span>
                </div>

                <div id="edit_msg" style="display: none;">
                    <h4>Warehouse Updated Successfully!</h4>
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


<script type="text/javascript">
$(document).ready(function() {
    var warehouse_id;

    list_of_company_warehouse();

    $('#add_warehouse').on('click', warehouse);
    $('#add_ware').on('click', add_company_warehouse);

    $(document).on('click', '.delete_warehouse', function() {
        var warehouse_id = $(this).attr('id').replace(/war_/, '');
        delete_warehouse(warehouse_id);
    });

    $(document).on('click', '.warehouse_info', function() {
        warehouse_id = $(this).attr('id').replace(/wareIn_/, '');
        fetch_warehouse_info(warehouse_id);

    });

    $(document).on('click', '.edit_warehouse_icon', function() {
        warehouse_id = $(this).attr('id').replace(/warh_/, '');
        fetch_warehouse_details(warehouse_id);

    });

    $(document).on('click', '#edit_ware', function() {
        // var warehouse_id = $(this).attr('id').replace(/edt_/,''); 
        edit_company_warehouse(warehouse_id);
        // alert(warehouse_id);
    });



})



function edit_company_warehouse(warehouse_id) {
    var warehouse_name = $("#modal_edit_warehouse #warehouse_name").val();
    var warehouse_address = $("#modal_edit_warehouse #warehouse_address").val();
    var company_id = localStorage.getItem('company_id');

    var blank;


    // alert(warehouse_id);

    $("#modal_edit_warehouse .required").each(function() {

        var the_val = $.trim($(this).val());

        if (the_val == "" || the_val == "0") {

            $(this).addClass('has-error');

            blank = "yes";

        } else {

            $(this).removeClass("has-error");

        }

    });

    if (blank == "yes") {

        $("#modal_edit_warehouse #error").html("You have a blank field");

        return;

    }


    // $("#modal_edit_warehouse #error").html("");

    $("#modal_edit_warehouse #edit_ware").hide();
    $("#modal_edit_warehouse #edit_ware_loader").show();



    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "wms/edit_warehouse",
        data: {
            "warehouse_name": warehouse_name,
            "warehouse_address": warehouse_address,
            "company_id": company_id,
            "warehouse_id": warehouse_id
        },

        success: function(response) {

            console.log(response);

            if (response.status == '200') {
                $("#modal_edit_warehouse #error").html("");
                $("#modal_edit_warehouse #edit_ware_loader").hide();
                $("#modal_edit_warehouse #edit_ware").show();


                $('#modal_edit_warehouse #edit_form').hide();
                $('#modal_edit_warehouse #edit_msg').show();

                // $('#modal_department_edit').on('hidden.bs.modal', function () {
                //     $('#department_name').val();
                //     $('#department_description').val();
                //     // window.location.reload();
                //     window.location.href = base_url+"/erp/hrm/departments";
                // })


            } else if (response.status == '400') { // coder error message


                $("#modal_edit_warehouse #error").html('Technical Error. Please try again later.');

            } else if (response.status == '401') { //user error message


                $("#modal_edit_warehouse #error").html(response.msg);

            }






        },

        error: function(response) {

            console.log(response);
            $("#modal_edit_warehouse #edit_ware_loader").hide();
            $("#modal_edit_warehouse #edit_ware").show();
            $("#modal_edit_warehouse #error").html("Connection Error.");

        }

    });

}

function fetch_warehouse_info(warehouse_id) {

    var company_id = localStorage.getItem('company_id');

    $('#wareIn_' + warehouse_id).hide();
    $('#loader11_' + warehouse_id).show();

    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "wms/get_warehouse_details",
        data: {
            "warehouse_id": warehouse_id,
            "company_id": company_id
        },

        success: function(response) {

            var str = "";
            console.log(response);


            $('#loader11_' + warehouse_id).hide();
            $('#wareIn_' + warehouse_id).show();

            if (response.status == '200') {

                $("#modal_view_warehouse #name").html(response.data.warehouse_name);
                $("#modal_view_warehouse #address").html(response.data.warehouse_address);


                $('#modal_view_warehouse').modal('show');
            }


        },

        error: function(response) {
            $('#loader11_' + warehouse_id).hide();
            $('#wareIn_' + warehouse_id).show();
            alert("Connection Error.");

        }

    });
}

function fetch_warehouse_details(warehouse_id) {
    // var pathArray = window.location.pathname.split( '/' );
    // var warehouse_id = $.urlParam('id');  

    var company_id = localStorage.getItem('company_id');

    $('#warh_' + warehouse_id).hide();
    $('#loader_' + warehouse_id).show();

    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "wms/get_warehouse_details",
        data: {
            "warehouse_id": warehouse_id,
            "company_id": company_id
        },

        success: function(response) {

            var str = "";
            console.log(response);
            $("#modal_edit_warehouse #error").html("");

            $("#modal_edit_warehouse .required").each(function() {

                var the_val = $.trim($(this).val());

                $(this).removeClass("has-error");

            });
            $('#loader_' + warehouse_id).hide();
            $('#warh_' + warehouse_id).show();
            if (response.status == '200') {

                $("#modal_edit_warehouse #warehouse_name").val(response.data.warehouse_name);
                $("#modal_edit_warehouse #warehouse_address").val(response.data.warehouse_address);

                // str += '<button type="submit" class="btn btn-success" id="edt_'+response.data.warehouse_id+'" class="update_ware">Update</button>';
                // str += '<i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_ware_loader"></i>';   

                // $("#modal_edit_warehouse #form_footer").html(str);
                $('#modal_edit_warehouse').modal('show');
            }


        },

        error: function(response) {
            $('#loader_' + warehouse_id).hide();
            $('#warh_' + warehouse_id).show();
            alert("Connection Error.");

        }

    });
}

function delete_warehouse(warehouse_id) {

    var company_id = localStorage.getItem('company_id');


    var ans = confirm("Are you sure you want to delete this warehouse?");
    if (!ans) {
        return;
    }


    $('#row_' + warehouse_id).hide();
    $('#loader_row_' + warehouse_id).show();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "wms/delete_warehouse",
        data: {
            "company_id": company_id,
            "warehouse_id": warehouse_id
        },
        timeout: 60000, // sets timeout to one minute
        // objAJAXRequest, strError

        error: function(response) {
            $('#loader_row_' + warehouse_id).hide();
            $('#row_' + warehouse_id).show();

            alert('connection error');
        },

        success: function(response) {
            // console.log(response);
            if (response.status == '200') {
                // $('#row_'+user_id).hide();


            } else if (response.status == '401') {


            }

            $('#loader_row_' + warehouse_id).hide();
        }
    });
}

function add_company_warehouse() {
    var company_id = localStorage.getItem('company_id');
    var warehouse_name = $('#add_warehouse_name').val();
    var warehouse_address = $('#add_warehouse_address').val();

    // alert(employee_id);
    var blank;




    $(".required1").each(function() {

        var the_val = $.trim($(this).val());

        if (the_val == "" || the_val == "0") {

            $(this).addClass('has-error');

            blank = "yes";

        } else {

            $(this).removeClass("has-error");

        }

    });

    if (blank == "yes") {

        $('#error').html("You have a blank field");

        return;

    }


    $('#add_ware').hide();
    $('#ware_loader').show();



    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "wms/create",
        data: {
            "company_id": company_id,
            "warehouse_name": warehouse_name,
            "warehouse_address": warehouse_address
        },

        success: function(response) {

            // console.log(response);

            if (response.status == '200') {

                $('#error').html('');
                $('#modal_warehouse').modal('show');

                $('#modal_warehouse').on('hidden.bs.modal', function() {
                    // do something…
                    $('#warehouse_display').hide();
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })


            } else if (response.status == '400') { // coder error message


                $('#error').html('Technical Error. Please try again later.');

            } else if (response.status == '401') { //user error message


                $('#error').html("No result");

            }


            $('#add_ware').show();
            $('#ware_loader').hide();

        },

        error: function(response) {

            $('#add_ware').show();
            $('#ware_loader').hide();
            $('#error').html("Connection Error.");

        }

    });

}

function warehouse() {
    $('#warehouse_display').toggle();
    $('#add_warehouse_name').val('');
    $('#add_warehouse_address').val('');

    $('#error').html('');

    $(".required").each(function() {

        var the_val = $.trim($(this).val());

        $(this).removeClass("has-error");

    });
}

function list_of_company_warehouse() {

    var company_id = localStorage.getItem('company_id');


    $("#loading").show();
    $("#employeeData").html('');

    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "wms/list_warehouse",
        data: {
            "company_id": company_id
        },
        timeout: 60000,

        success: function(response) {

            console.log(response);
            $('#loading').hide();
            var strTable = "";

            if (response.status == '200') {

                if (response.data.length > 0) {

                    var k = 1;
                    $.each(response['data'], function(i, v) {
                        // strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+base_url+'/erp/assets/admin_template/production/images/img.jpg" alt="..." width="50"></div></td>';

                        function status(string) {
                            return string.charAt(0).toUpperCase() + string.slice(1);
                        }
                        strTable += '<tr id="row_' + response['data'][i]['warehouse_id'] + '">';

                        strTable += '<td width="75%" valign="top">' + status(response['data'][i][
                            'warehouse_name'
                        ]) + '</td>';

                        strTable +=
                            '<td valign="top"><a class="warehouse_info btn btn-primary btn-xs" id="wareIn_' +
                            response['data'][i]['warehouse_id'] +
                            '"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title="View Warehouse info"></i> View</a>';

                        strTable +=
                            '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_' +
                            response['data'][i]['warehouse_id'] + '"></i>&nbsp;&nbsp;';

                        strTable += '<a class="edit_warehouse_icon btn btn-info btn-xs" id="warh_' +
                            response['data'][i]['warehouse_id'] +
                            '" style="cursor: pointer;"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" title="Edit Warehouses"></i> Edit</a>';

                        strTable +=
                            '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader_' +
                            response['data'][i]['warehouse_id'] + '"></i>&nbsp;&nbsp;';


                        strTable +=
                            '<a class="delete_warehouse btn btn-danger btn-xs" style="cursor: pointer;" id="war_' +
                            response['data'][i]['warehouse_id'] +
                            '"><i  class="fa fa-trash-o"  data-toggle="tooltip" data-placement="top" title="Delete Warehouse"></i> Delete</a>&nbsp;&nbsp;';

                        strTable += '<a href="' + base_url + 'warehouse_activities?id=' + response[
                                'data'][i]['warehouse_id'] +
                            '"><i  class="fa fa-clock-o"  data-toggle="tooltip" data-placement="top" style="color: #000; font-size: 20px;" title="View Warehouse info"></i></a></td>';

                        strTable += '</tr>';



                        strTable += '<tr style="display: none;" id="loader_row_' + response['data'][
                            i
                        ]['warehouse_id'] + '">';
                        strTable +=
                            '<td colspan="2"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                        strTable += '</td>';
                        strTable += '</tr>';


                        k++;

                    });

                } else {

                    strTable = '<tr><td colspan="2">No record.</td></tr>';

                }




                $("#warehouseData").html(strTable);
                $("#warehouseData").show();

            } else if (response.status == '400') {

                $('#loading').hide();
                strTable += '<tr>';
                strTable += '<td colspan="2">No result</td>';
                strTable += '</tr>';


                $("#warehouseData").html(strTable);
                $("#warehouseData").show();


            } else if (response.status == "401") {
                //missing parameters
                var strTable = "";
                $('#loading').hide();
                strTable += '<tr>';
                strTable += '<td colspan="2">' + response.msg + '</td>';
                strTable += '</tr>';


                $("#warehouseData").html(strTable);
                $("#warehouseData").show();

            }


            $("#loading").hide();

        },

        error: function(response) {


            var strTable = "";
            $('#loading').hide();
            // alert(response.msg);
            strTable += '<tr>';
            strTable += '<td colspan="2"><strong class="text-danger">Connection error!</strong></td>';
            strTable += '</tr>';


            $("#warehouseData").html(strTable);
            $("#warehouseData").show();
            $("#loading").hide();

        }

    });
}
</script>



<?php
include_once("../gen/_common/footer.php");
?>