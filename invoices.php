<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Receipts</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <button type="button" class="btn btn-default" id="invoice_filter">Filter</button>

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

                                <!-- <div class="col-sm-3 col-xs-4">
                        <label>Item Name</label>
                        <input type="text" name="item_name" id="autocomplete-append" class="form-control">
                      </div>


                      <div class="col-sm-3 col-xs-4">
                        <label>Vendor Name</label>
                         <input type="text" name="vendor_name" id="autocomplete-append" class="form-control">
                      </div>

                      <div class="col-sm-3 col-xs-4">
                        <label>Date Range</label>
                        <input type="text" class="form-control" id="date_range">
                      </div>
 -->
                                <div class="col-sm-3 col-xs-4">
                                    <label>Code</label>
                                    <input type="text" class="form-control" id="code">
                                </div>

                                <div class="col-sm-3 col-xs-4">
                                    <br>
                                    <button type="button" class="btn btn-success" id="filter">Go</button>
                                    <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                        id="filter_loader"></i>
                                </div>

                            </div>
                            <br><br>

                            <!-- <div class="form-row"></div>  -->

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
                                        <th class="column-title">Date</th>
                                        <th class="column-title">Total Value</th>
                                        <th class="column-title no-link last"><span class="nobr">Actions</span>
                                        </th>
                                        <th class="bulk-actions" colspan="4">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>

                                <tr id="loading">
                                    <td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"></i>
                                    </td>
                                </tr>
                                <tbody id="invoiceData">

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

<div class="modal fade" id="modal_invoice_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;"><i class="fa fa-globe"></i> Receipts
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <b>From</b>
                        <address id="ivvv_fff">

                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>To</b>
                        <address id="ivvv_ttoo">

                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col" id="ivvv_ddtt">

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="headings">

                                    <th class="column-title">Item</th>
                                    <th class="column-title">Quantity</th>
                                    <th class="column-title">Unit Cost</th>
                                    <th class="column-title" style="text-align: right">Total</th>

                                </tr>
                            </thead>

                            <tr id="loading">
                                <td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"></i>
                                </td>
                            </tr>
                            <tbody id="generateData">

                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <!-- <button class="btn btn-primary">Generate</button> -->
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    list_of_invoice('');

    $(document).on('click', '.view_invoice_icon', function() {
        var invoice_id = $(this).attr('id').replace(/inv_/, '');
        fetch_invoice_info(invoice_id);

    });

    $('#invoice_filter').on('click', display_filter);


})

function display_filter() {

    $('#filter_display').toggle();
    $('#code').val("");

}

function fetch_invoice_info(invoice_id) {

    var company_id = localStorage.getItem('company_id');

    $('#inv_' + invoice_id).hide();
    $('#loader11_' + invoice_id).show();

    $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path + "wms/list_invoice_items",
        data: {
            "invoice_id": invoice_id,
            "company_id": company_id
        },

        success: function(response) {

            var str = "";
            console.log(response);


            $('#loader11_' + invoice_id).hide();
            $('#inv_' + invoice_id).show();

            if (response.status == '200') {

                // $("#modal_view_warehouse #name").html( response.data.warehouse_name); 
                // $("#modal_view_warehouse #address").html( response.data.warehouse_address);


                $('#modal_invoice_info').modal('show');

                // var list_of_names = [];
                // var list_of_values = [];

                $("#ivvv_fff").html(response.data.inv_from);
                $("#ivvv_ttoo").html(response.data.inv_to);
                $("#ivvv_ddtt").html('<b>Date:</b><br>' + response.data.inv_date);

                var the_list = "";
                $(response.data.list).each(function(index, value) {

                    var id = "chief o";
                    the_list += '<tr class="itm_tr"><td>' + value.item_name + '</td> <td>' + value
                        .item_qty + '</td> <td>' + parseFloat(value.unit_cost).toLocaleString() +
                        '</td> <td style="text-align: right">' + parseFloat(value.line_total)
                        .toLocaleString() + '</td>  </tr>';

                });

                $(response.data.com_fees).each(function(index, value) {

                    var id = "chief o";
                    the_list += '<tr class="itm_tr"><td></td> <td></td> <td>' + value.name +
                        '</td> <td style="text-align: right">' + parseFloat(value.amount)
                        .toLocaleString() + '</td>   </tr>';

                });

                the_list +=
                    '<tr class="itm_tr" style="background-color: #f4f5f7"><td></td> <td></td> <td><b>GRAND TOTAL</b></td> <td style="text-align: right">' +
                    parseFloat(response.data.inv_grand_total).toLocaleString() + '</td>  </tr>';


                if (the_list != "") {
                    $("#generateData").html(the_list);
                }


            }


        },

        error: function(response) {
            $('#loader11_' + invoice_id).hide();
            $('#inv_' + invoice_id).show();
            alert("Connection Error.");

        }

    });
}

function list_of_invoice(page) {
    var company_id = localStorage.getItem('company_id');
    if (page == "") {
        var page = 1;
    }
    var limit = 10;

    var item_name = $('#item_name').val();


    $("#loading").show();
    $("#invoiceData").html('');


    $.ajax({

        type: "POST",
        dataType: "json",
        url: api_path + "wms/list_invoices",
        data: {
            "company_id": company_id,
            "page": page,
            "limit": limit
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

                        var d = new Date(response['data'][i]['inv_date']);

                        var monthIndex = d.getMonth();
                        var datestring = d.getDate() + "/" + monthNames[monthIndex] + "/" + d
                            .getFullYear();

                        strTable += '<tr id="row_' + response['data'][i]['inv_id'] + '">';
                        strTable += '<td>' + response['data'][i]['inv_code'] + '</td>';
                        strTable += '<td>' + datestring + '</td>';
                        strTable += '<td>' + response['data'][i]['inv_grand_total'] + '</td>';

                        strTable += '<td valign="top"><a class="view_invoice_icon" id="inv_' +
                            response['data'][i]['inv_id'] +
                            '"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style="cursor: pointer; font-style: italic; color: #add8e6; font-size: 20px;" title="View Incoming Item info"></i></a>';

                        strTable +=
                            '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_' +
                            response['data'][i]['inv_id'] + '"></i>';

                        strTable += '<a class="delete_incoming" style="cursor: pointer;" id="inc_' +
                            response['data'][i]['item_id'] +
                            '"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Incoming Item"></i></a></td>';

                        strTable += '</tr>';

                        strTable += '<tr style="display: none;" id="loader_row_' + response['data'][
                            i
                        ]['inv_id'] + '">';
                        strTable +=
                            '<td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                        strTable += '</td>';
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
                        list_of_invoice(page);
                    }
                });


                $("#invoiceData").html(strTable);
                $("#invoiceData").show();

            } else if (response.status == '401') {
                $('#loading').hide();

                strTable = '<tr><td colspan="4">' + response.msg + '</td></tr>';

                $("#invoiceData").html(strTable);
                $("#invoiceData").show();

            } else if (response.status == '400') {
                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="4">' + response.msg + '</td>';
                strTable += '</tr>';


                $("#invoiceData").html(strTable);
                $("#invoiceData").show();


            }

        },

        error: function(response) {
            var strTable = "";
            $('#loading').hide();
            // alert(response.msg);
            strTable += '<tr>';
            strTable += '<td colspan="4"><strong class="text-danger">Connection error</strong></td>';
            strTable += '</tr>';


            $("#invoiceData").html(strTable);
            $("#invoiceData").show();

        }

    });
}
</script>



<?php
include_once("../gen/_common/footer.php");
?>