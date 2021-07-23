<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>

<!-- page content -->
<div class="right_col" role="main" id="main_display" style="display: ;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User Permissions</h3>
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
                        <a href="users" class="btn btn-primary">Back</a>


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

                        <h2 id="user_name"></h2>



                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">

                                        <th class="column-title">Sections</th>
                                        <th class="column-title">Status </th>

                                    </tr>
                                </thead>

                                <tr id="loading">
                                    <td colspan="2"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"></i>
                                    </td>
                                </tr>

                                <tbody id="permData">



                                </tbody>
                            </table>

                            <button type="button" class="btn btn-success" id="update_perm">Update</button>
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="perm_loader"></i>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- modal -->
<div class="modal fade" id="modal_warehouse_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4>User Added Successfully!</h4>
            </div>
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<!-- modal -->

<!-- modal -->
<div class="modal fade" id="modal_perm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <h4 id="modal_msg">User permission updated successfully!</h4>
            </div>
            <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="yes_delete_position" data-dismiss="modal">Yes</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                </div> -->
        </div>
    </div>
</div>


<div id="error_display" style="display: none;">

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">

            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-info alert-dimissible fade-in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true"></span>
                        </button>
                        <strong>Sorry you don't have access to this page!</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    page_ess_access();
    // page_warehouse_access();
    // list_of_warehouse_sections();

    // $('#update_perm').on('click', check_sections);


})

function page_ess_access() {

    var company_id = localStorage.getItem('company_id');

    var user_id = localStorage.getItem('user_id');
    var module_id = 3;


    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "accesscontrol/check_if_admin",
        data: {
            "company_id": company_id,
            "user_id": user_id,
            "module_id": module_id
        },
        timeout: 60000,

        success: function(response) {

            console.log(response);


            if (response.status == '200') {

                $('#user_page').show();

            } else if (response.status == '400') {



            } else if (response.status == "401") {
                //missing parameters
                $('#main_display').hide();
                $('#error_display').show();


            }


        },

        error: function(response) {




        }

    });
}

$.urlParam = function(name) {

    var results = new RegExp('[\?&]' + name + '=([^]*)').exec(window.location.href);
    if (results == null) {
        return null;
    } else {
        return results[1] || 0;
    }
}


function check_sections() {

    var company_id = localStorage.getItem('company_id');
    var user_id = $.urlParam('id');

    var row_array = new Array();

    $('.section_perms').each(function() {
        var row_id = $(this).attr('id').replace(/wms_/, '');

        if ($('#wms_' + row_id).is(':checked')) {

            var row = row_id;

        } else {

            var row = "";
        }


        row_array.push(row);

    })


    console.log(row_array);



    var ans = confirm("Are you sure you want to update this user permission?");


    if (!ans) {
        return;
    }

    $('#update_perm').hide();
    $('#perm_loader').show();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "wms/add_permissions",
        data: {
            "company_id": company_id,
            "row_id": row_array,
            "user_id": user_id,
        },
        timeout: 60000, // sets timeout to one minute
        // objAJAXRequest, strError

        error: function(response) {
            $('#perm_loader').hide();
            $('#update_perm').show();


            alert('connection error');
        },

        success: function(response) {
            console.log(response);

            $('#update_perm').show();
            $('#perm_loader').hide();
            if (response.status == '200') {

                $('#modal_perm').modal('show');

                // $('#modal_perm').on('hidden.bs.modal', function () {
                //     // do something…
                //     window.location.reload();
                //     //window.location.href = base_url+"/erp/hrm/employees";
                // })

            } else if (response.status == '401') {


            }
        }
    });
}


function page_warehouse_access() {

    var company_id = localStorage.getItem('company_id');

    var user_id = localStorage.getItem('user_id');
    var module_id = 6;


    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "wms/list_user_wms_sections",
        data: {
            "company_id": company_id,
            "user_id": user_id,
            "module_id": module_id
        },
        timeout: 60000,

        success: function(response) {

            console.log(response);

            var strTable = "";

            if (response.status == '200') {

                if (response.is_admin == 'no') {
                    $('#main_display').hide();
                    $('#error_display').show();
                    var k = 1;
                    $.each(response['data'], function(i, v) {


                        if (response['data'][i]['section_name'] == "Incoming" && response['data'][i]
                            ['section_exist'] == "yes") {

                            $('#incoming').show();


                        } else if (response['data'][i]['section_name'] == "Incoming" && response[
                                'data'][i]['section_exist'] == "no") {

                            $('#incoming').hide();


                        } else if (response['data'][i]['section_name'] == "Outgoing" && response[
                                'data'][i]['section_exist'] == "yes") {

                            $('#outgoing').show();


                        } else if (response['data'][i]['section_name'] == "Outgoing" && response[
                                'data'][i]['section_exist'] == "no") {

                            $('#outgoing').hide();

                        } else if (response['data'][i]['section_name'] == "Sales/Receipts" &&
                            response['data'][i]['section_exist'] == "yes") {

                            $('#receipts').show();


                        } else if (response['data'][i]['section_name'] == "Sales/Receipts" &&
                            response['data'][i]['section_exist'] == "no") {

                            $('#receipts').hide();

                        }


                        k++;

                    });



                } else if (response.is_admin == 'yes') {

                    $('#incoming').show();
                    $('#outgoing').show();
                    $('#receipts').show();
                    $('#user_page').show();
                }


            } else if (response.status == '400') {



            } else if (response.status == "401") {
                //missing parameters


            }


        },

        error: function(response) {




        }

    });
}

function list_of_warehouse_sections() {

    var company_id = localStorage.getItem('company_id');

    var user_id = $.urlParam('id');

    var module_id = 6;

    $("#loading").show();
    $("#permData").html('');

    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "wms/list_user_wms_sections",
        data: {
            "company_id": company_id,
            "user_id": user_id,
            "module_id": module_id
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

                        var section_id = response['data'][i]['section_id'];

                        strTable += '<tr id="row_' + response['data'][i]['row_id'] + '">';



                        if (response['data'][i]['section_exist'] == "yes") {

                            strTable += '<td valign="top">' + response['data'][i]['section_name'] +
                                '</td>';

                            strTable += '<td valign="top"><input class="section_perms" id="wms_' +
                                response['data'][i]['row_id'] + '" type="checkbox" checked></td>';

                            // strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader_'+response['data'][i]['row_id']+'"></i></td>';

                        } else if (response['data'][i]['section_exist'] == "no") {

                            strTable += '<td valign="top">' + response['data'][i]['section_name'] +
                                '</td>';

                            strTable += '<td valign="top"><input class="section_perms" id="wms_' +
                                response['data'][i]['row_id'] + '" type="checkbox"></td>';

                            // strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader_'+response['data'][i]['row_id']+'"></i></td>';
                        }


                        strTable += '</tr>';


                        k++;

                    });

                } else {

                    strTable = '<tr><td colspan="2">No record.</td></tr>';

                }

                $("#user_name").html(response.fullname);
                $("#permData").html(strTable);
                $("#permData").show();

            } else if (response.status == '400') {

                $('#loading').hide();
                strTable += '<tr>';
                strTable += '<td colspan="2">No result</td>';
                strTable += '</tr>';


                $("#permData").html(strTable);
                $("#permData").show();


            } else if (response.status == "401") {
                //missing parameters
                var strTable = "";
                $('#loading').hide();
                strTable += '<tr>';
                strTable += '<td colspan="2">' + response.msg + '</td>';
                strTable += '</tr>';


                $("#permData").html(strTable);
                $("#userData").show();

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


            $("#permData").html(strTable);
            $("#permData").show();
            $("#loading").hide();

        }

    });
}

function validateEmail(emailaddress) {

    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    if (!emailReg.test(emailaddress)) {

        return false

    } else {

        return true;

    }

}
</script>



<?php
include_once("../gen/_common/footer.php");
?>