<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Payslips</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <!-- <button type="button" class="btn btn-default" id="incoming_filter">Filter</button> -->
                        <!-- <button type="button" class="btn btn-success" id="apply">Download</button> -->

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


                                        <th class="column-title">S/N</th>
                                        <th class="column-title">Payment Date</th>
                                        <th class="column-title">Amount</th>

                                        <th class="column-title no-link last"><span class="nobr">Actions</span>
                                        </th>
                                        <th class="bulk-actions" colspan="5">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>

                                <tr id="loading">
                                    <td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"></i>
                                    </td>
                                </tr>

                                <tbody id="payData">



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


<div class="modal fade" id="modal_view_payslip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Payslip Info
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">


                <div id="container4">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Name:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="name"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong>Payment Type:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="pay_type"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong> Payment Date</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="pay_date"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p><strong> Paid Amount</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="pay_amount"></p>
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



<script type="text/javascript">
$(document).ready(function() {

    list_of_payslips('');


    $(document).on('click', '.payslip_info', function() {
        var pay_id = $(this).attr('id').replace(/pay_/, '');
        fetch_payslip_info(pay_id);

    });




})





function fetch_payslip_info(pay_id) {

    var company_id = localStorage.getItem('company_id');

    $('#pay_' + pay_id).hide();
    $('#loader_' + pay_id).show();

    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "ess/single_employee_payslip",
        data: {
            "pay_id": pay_id,
            "company_id": company_id
        },

        success: function(response) {

            console.log(response);


            $('#loader_' + pay_id).hide();
            $('#pay_' + pay_id).show();

            if (response.status == '200') {

                var monthNames = [
                    "Jan", "Feb", "Mar",
                    "Apr", "May", "Jun", "Jul",
                    "August", "Sep", "Oct",
                    "Nov", "Dec"
                ];

                var d = new Date(response.data.payment_date);
                var monthIndex = d.getMonth();
                var datestring = d.getDate() + "/" + monthNames[monthIndex] + "/" + d.getFullYear();

                $("#modal_view_payslip #name").html(response.data.fullname);
                $("#modal_view_payslip #pay_amount").html(response.data.paid_amount);
                $("#modal_view_payslip #pay_date").html(datestring);
                $("#modal_view_payslip #pay_type").html(response.data.sum_one);




                $('#modal_view_payslip').modal('show');
            }


        },

        error: function(response) {
            $('#loader_' + pay_id).hide();
            $('#pay_' + pay_id).show();
            alert("Connection Error.");

        }

    });
}



function list_of_payslips(page) {
    var company_id = localStorage.getItem('company_id');
    var employee_id = localStorage.getItem('email');
    if (page == "") {
        var page = 1;
    }
    var limit = 10;


    $("#loading").show();
    $("#payData").html('');

    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "ess/employee_pay_slips",
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

                        var d = new Date(response['data'][i]['paid_date']);
                        var monthIndex = d.getMonth();
                        var start = d.getDate() + "/" + monthNames[monthIndex] + "/" + d
                            .getFullYear();


                        strTable += '<tr>';
                        strTable += '<td>' + k + '</td>';

                        strTable += '<td>' + start + '</td>';

                        strTable += '<td>' + response['data'][i]['salary'] + '</td>';

                        strTable +=
                            '<td valign="top"><a class="payslip_info btn btn-primary btn-xs"  id="pay_' +
                            response['data'][i]['pay_id'] +
                            '"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title="View Payslip info"></i> View</a>';

                        strTable +=
                            '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader_' +
                            response['data'][i]['pay_id'] + '"></i>&nbsp;&nbsp;';



                        strTable += '</tr>';



                        k++;

                    });


                } else {

                    strTable = '<tr><td colspan="4">' + response.msg + '</td></tr>';

                }

                $('#pagination').twbsPagination({
                    totalPages: Math.ceil(response.total_rows / limit),
                    visiblePages: 10,
                    onPageClick: function(event, page) {
                        list_of_payslips(page);
                    }
                });


                $("#payData").html(strTable);
                $("#payData").show();

            } else if (response.data <= 0) {
                $('#loading').hide();

                strTable = '<tr><td colspan="4">' + response.msg + '</td></tr>';

                $("#payData").html(strTable);
                $("#payData").show();

            } else if (response.status == '400') {
                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="4">' + response.msg + '</td>';
                strTable += '</tr>';


                $("#payData").html(strTable);
                $("#payData").show();


            }

        },

        error: function(response) {
            var strTable = "";
            $('#loading').hide();
            // alert(response.msg);
            strTable += '<tr>';
            strTable += '<td colspan="4"><strong class="text-danger">Connection error</strong></td>';
            strTable += '</tr>';


            $("#payData").html(strTable);
            $("#payData").show();

        }

    });
}
</script>



<?php
include_once("../gen/_common/footer.php");
?>