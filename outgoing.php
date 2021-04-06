<?php
include("_common/header.php");
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Outgoing Items</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    <button type="button" class="btn btn-default" id="outgoing_filter">Filter</button>
                    <a href="add_outgoing_items"><button type="button" class="btn btn-success">Add</button></a>
                   
                    
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
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="filter_loader"></i>
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

                      <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                          <div class="input-group" style="float: right">
                            <button type="button" class="btn btn-primary" id="gen_invoice" data-toggle="modal" data-target="#modal_invoice" disabled>Generate Receipt</button>
                           
                           
                            
                          </div>
                        </div>
                      </div>

                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title"><input type="checkbox" name="checkbox"></th>

                            <th class="column-title">Code</th>
                            <th class="column-title">Item</th>
                            <th class="column-title">Date Released</th>
                            <th class="column-title">Recipient</th>
                            <th class="column-title">Quantity</th>
                            <th class="column-title">Unit</th>
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            </th>
                            <th class="bulk-actions" colspan="8">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                          <tr id="loading">
                            <td colspan="8"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" ></i></td>
                          </tr> 
                        <tbody id="outgoingData">
                            
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

         <div class="modal fade" id="modal_view_outgoing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Item Info
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>
                
              </div>
              <div class="modal-body">

                
                  <div id="container4" >
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Item Name:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="item_name"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Vendor Name:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="vendor_name"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Date Recieved:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="date_recieved"></p>
                      </div>
                    </div>

                    

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Quantity:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="quantity"></p>
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



        <!-- modal -->
        <div class="modal fade" id="modal_succ_create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Invoice Created Successfully!</h4>
              </div>
              <!-- <div class="modal-footer"> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>




         <div class="modal fade" id="modal_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;"><i class="fa fa-globe"></i> Receipt
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>
                
              </div>
              <div class="modal-body">
                <div class="row">
                <div class="table-responsive">
                 <table class="table">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">#</th>
                            <th class="column-title">Item</th>
                            <th class="column-title">Quantity</th>
                            <th class="column-title">Unit Cost</th>
                            <th class="column-title">Description</th>
                            <th class="column-title">Total</th>
                            
                            <th class="bulk-actions" colspan="4">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                          <tr id="loading" style="display: none">
                            <td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" ></i></td>
                          </tr> 
                        <tbody id="generateData">
                            
                        </tbody>
                      </table>
                    </div>

                    <div class="row">

                      <div class="col-md-4 col-sm-4 col-xs-12" style="padding: 30px">
                        Invoice From
                        <textarea id="invoice_from" required="required" class="form-control not_empty" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100"></textarea>
                      </div>

                      <div class="col-md-4 col-sm-4 col-xs-12" style="padding: 30px">
                        Invoice To
                        <textarea id="invoice_to" required="required" class="form-control not_empty" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100"></textarea>
                      </div>

                      <div class="col-md-4 col-sm-4 col-xs-12" style="padding: 30px">
                        Date
                        <div class="control-group">
                          
                          <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="invoice_date" placeholder="" aria-describedby="inputSuccess2Status4">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                          </div>
                          
                        </div>
                        

                      </div>

                    </div>

                  </div>

                 <!--  <div class="row">
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i>Generate</button>
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                  </div> -->
                        <!-- /.col -->

               
              </div>
              <div style="color: red; padding-left: 20px " id="msg_r"></div>
              <div class="modal-footer">

                <button class="btn btn-primary" id="create_invoice" >Ok</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="invd_loader"></i>
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>


        <script type="text/javascript">
          $(document).ready(function(){

            var list_id;
            list_of_outgoing_items('');

            // $('input#invoice_date').datepicker({
            //   dateFormat: "yy-mm-dd"
            // });

            // $(document).on('click', '#invoice_date', function(){
            //     alert("ddd");
            //     $('#invoice_date').datepicker({
            //       dateFormat: "yy-mm-dd"
            //     });
            // });

            // $("#invoice_date").datepicker({
            //     beforeShow: function(input, inst) {
            //       $(document).off("focusin.bs.modal");
            //     },
            //     onClose:function(){
            //       $(document).on("focusin.bs.modal");
            //     },
            //     changeMonth: true,
            //     changeYear: true
            // });


            $('#invoice_date').daterangepicker({
              drops: 'up',
              singleDatePicker: true,
              singleClasses: "picker_4",
              locale: {
                  format: 'YYYY-MM-DD'
              }
            }, function(start, end, label) {
              console.log(start.toISOString(), end.toISOString(), label);
            });


            $(document).on('click', '#filter', function(){
                $('#pagination').twbsPagination('destroy');
                list_of_outgoing_items('');
            });

            $('#outgoing_filter').on('click', display_filter);

            $('input#date_range').daterangepicker({
              autoUpdateInput: false
            });

            $('input#date_range').on('apply.daterangepicker', function(ev, picker) {
               $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));

            });

            $(document).on('click', '.outgoing_info', function(){
                list_id = $(this).attr('id').replace(/ou_/,''); 
                fetch_outgoing_info(list_id);
                
              });

            $(document).on('click', '.delete_outgoing', function(){
                var list_id = $(this).attr('id').replace(/out_/,''); 
                delete_outgoing_item(list_id);
            });

            $(document).on('click', '.sel_invoice', function(){

              if (this.checked) {
                $("#gen_invoice").removeAttr("disabled");
              }else{
                 // $("#gen_invoice").attr("disabled");
                $("#gen_invoice").attr("disabled", !this.checked);
              }
            });

            $(document).on('show.bs.modal', '#modal_invoice', function () {
                // run your validation... ( or shown.bs.modal )
                show_invoice_for_edit();
            });

            $(document).on('click', '#add_to_sub_total', function (){
              var rnd_id = Math.floor(Math.random() * 14564300451);
              // alert(rnd_id);
              $("#plus_tr").before('<tr id="rm_tr_'+rnd_id+'" class="vat_line"> <td></td> <td colspan="4" style="text-align: right"><i class="fa fa-minus fa-fw fa-1x remv_from_sub_total"  id="rmv_id_'+rnd_id+'"></i><div class="col-xs-3"  style="text-align: right; float: right"><input type="text" class="form-control not_empty" id="vat_name_'+rnd_id+'"></div></td> <td id="sub_total" style="text-align: right; background-color: #f4f5f7"><div class="col-xs-4" style="text-align: right; float: right; margin-right: 0px"><input type="text" onkeypress="return isNumber(event)" class="form-control to_get_grand not_empty" id="to_b_minus_fig_'+rnd_id+'"></div></td> </tr>');

            });
            

            $(document).on('click', '.remv_from_sub_total', function(){
              
              var id = $(this).attr("id").replace(/rmv_id_/,'');
              var sub_fig = $("#to_b_minus_fig_"+id).val();
              if(sub_fig != "" && sub_fig != 0){
                var grand_total = $("#grand_total").html();
                var new_grand_total = parseFloat(grand_total) - parseFloat(sub_fig);
              }

              $("#rm_tr_"+id).remove();
              $("#grand_total").html(new_grand_total);

            });

            $(document).on('keyup', '.untcst', function(){

                var unit_cost = parseFloat($(this).val());
                var id = $(this).attr("id").replace(/unit_cost_entrd_/,'');
                var qty = parseFloat($("#qty_only_id_"+id).html());

                if(isNaN(unit_cost)){ unit_cost = 0.00; }

                var total = unit_cost * qty;

                $("#cal_lin_total_"+id).html(total); //.toLocaleString()

                //summ up all line totals
                //a_line_total

                var sum_line_totals = 0;
                $(".a_line_total").each(function(){
                    sum_line_totals = sum_line_totals + parseFloat($(this).html());
                });
                $("#sub_total").html(sum_line_totals); //.toLocaleString()


                //Do a calculation for the grand total
                var add_sub_total = 0;
                $(".to_get_grand").each(function(){
                    add_sub_total = parseFloat($(this).val()) + add_sub_total;
                    
                });
                $("#grand_total").html(parseFloat($("#sub_total").html()) + add_sub_total);

            });



            $(document).on('keyup', '.to_get_grand', function (){

                var add_sub_total = 0;
                $(".to_get_grand").each(function(){
                    add_sub_total = parseFloat($(this).val()) + add_sub_total;
                    
                });
                $("#grand_total").html(parseFloat($("#sub_total").html()) + add_sub_total);

            });

            $(document).on('click', '#create_invoice', function(){

              $("#msg_r").html('');

                //not empty shouldn't be empty
                var blank = "";
                $(".not_empty").each(function(){

                  var the_val = $.trim($(this).val());

                  if(the_val == "" || the_val == "0"){

                    $(this).addClass('has-error');

                    blank = "yes";

                  }else{

                    $(this).removeClass("has-error");

                  }

                });


                if(blank == "yes"){
                  return;
                }

                
                var from = $("#invoice_from").val();
                var to = $("#invoice_to").val();
                var invoice_date = $("#invoice_date").val();
                var grand_total = $("#grand_total").html();
                var inv_items = [];
                var con_fees = [];
                var vat_items = [];

                //for each invoice line item
                $('.itm_tr').each(function(){

                  var id = $(this).attr("id").replace(/itm_tr_/,'');
                  var qty = $("#qty_only_id_"+id).html();
                  var unit_cost = $("#unit_cost_entrd_"+id).val();
                  var description = $("#descr_"+id).val();

                  inv_items.push({
                      trans_id: id,
                      item_qty: qty,
                      item_desc: description,
                      unit_cost: unit_cost
                  });

                });


                //vat_lines
                $('.vat_line').each(function(){

                  var id = $(this).attr("id").replace(/rm_tr_/,'');
                  var vat_name = $("#vat_name_"+id).val();
                  var vat_cost = $("#to_b_minus_fig_"+id).val();

                  vat_items.push({
                      name: vat_name,
                      amount: vat_cost
                  });

                });


                

                var arr2 = new Array();
                arr2['added_by'] = localStorage.getItem('user_id');
                arr2['company_id'] = localStorage.getItem('company_id');
                arr2['inv_items'] = inv_items;
                arr2['grand_total'] = grand_total;
                arr2['inv_date'] = invoice_date;
                arr2['inv_to'] = to;
                arr2['inv_from'] = from;
                arr2['con_fees'] = vat_items;
                console.log(arr2);

                // return;

                $("#invd_loader").show();
                $("#create_invoice").hide();

                $.ajax({
        
                  type: "POST",
                  dataType: "json",
                  url: api_path+"wms/generate_invoice",
                  data: {"added_by": localStorage.getItem('user_id') , "company_id" : localStorage.getItem('company_id') , "inv_items" : inv_items , "grand_total" : grand_total , "inv_date" : invoice_date , "inv_to" : to , "inv_frm" : from , "con_fees" : vat_items },
                  timeout: 60000,

                  success: function(response) {

                      console.log(response);
                      
                      if (response.status == '200'){

                        $('#modal_succ_create').modal('show');
                        $('#modal_invoice').modal('hide');
                        
                      }else if(response.status == '400'){

                        $("#msg_r").html(response.msg);

                      }

                      $("#invd_loader").hide();
                      $("#create_invoice").show();    
                      
                  },

                  error: function(objAJAXRequest, strError){
                      
                      $("#invd_loader").hide();
                      $("#create_invoice").show(); 
                      console.log(strError);
                  }        

              });

            });



          });

               
        function isNumber(evt) {

            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ( (charCode > 31 && charCode < 48) || charCode > 57) {
                return false;
            }
            return true;

        }



          function show_invoice_for_edit(){

              var k = 1;
              var invoice_items_list = "";
              $(".sel_invoice:checked").each(function(){

                  var id = $(this).attr("id").replace(/sel_invoice_/,'');
                  var item_nnn = $("#item_name_lz_"+id).html();
                  var item_qttyy = $("#qtyyty_"+id).html();
                  var item_unniitt = $("#item_unniitt_"+id).html();
                  invoice_items_list += '<tr class="itm_tr" id="itm_tr_'+id+'"><td>'+k+'</td> <td>'+item_nnn+'</td> <td><span id="qty_only_id_'+id+'">'+item_qttyy+'</span> '+item_unniitt+'</td> <td><input type="text" class="untcst form-control not_empty" onkeypress="return isNumber(event)" id="unit_cost_entrd_'+id+'" ></td>  <td><input type="text" class="form-control" id="descr_'+id+'" ></td>  <td id="cal_lin_total_'+id+'" class="a_line_total" style="text-align: right; padding-right: 20px">0.00</td> </tr>';
                  k++;
              });
              invoice_items_list += '<tr><td colspan="5" style="text-align: right"><b>SUB-TOTAL</b></td> <td id="sub_total" style="text-align: right; padding-right: 20px">0.00</td> </tr>';
              invoice_items_list += '<tr id="plus_tr"> <td colspan="6" style="text-align: right"><i class="fa fa-plus fa-fw fa-1x"  id="add_to_sub_total"></i></td> </tr>';
              invoice_items_list += '<tr><td colspan="5" style="text-align: right"><b>GRAND TOTAL</b></td> <td id="grand_total" style="text-align: right; padding-right: 20px">0.00</td> </tr>';
              $("#generateData").html(invoice_items_list);

          }

          function list_of_invoice(invoice_id){
            var company_id = localStorage.getItem('company_id');
             
            $("#loading").show();
            $("#invoiceData").html('');


            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"wms/list_item_invoices",
                data: { "company_id": company_id, "invoice_id": invoice_id},
                timeout: 60000,

                success: function(response) {
                    console.log(response);

                    var strTable = "";
                    
                    if (response.status == '200'){
                        $('#loading').hide();
                        if(response.data.length > 0){

                            var k = 1;
                            $.each(response['data'], function (i, v) {

                              var monthNames = [
                                "Jan", "Feb", "Mar",
                                "Apr", "May", "Jun", "Jul",
                                "August", "Sep", "Oct",
                                "Nov", "Dec"
                              ];

                              var d = new Date(response['data'][i]['inv_date']);

                              var monthIndex = d.getMonth();
                              var datestring = d.getDate()  + "/" +  monthNames[monthIndex] + "/" + d.getFullYear();

                              strTable += '<tr id="row_'+response['data'][i]['inv_id']+'">';
                              strTable += '<td>'+response['data'][i]['inv_code']+'</td>';
                              strTable += '<td>'+datestring+'</td>';
                              strTable += '<td>'+response['data'][i]['inv_total']+'</td>';
                              strTable += '<td>&nbsp;</td>';
                              
                              
                              strTable += '</tr>';  

                              strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['inv_id']+'">';
                              strTable += '<td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              strTable +=  '</td>';
                              strTable += '</tr>';

                                


                                k++;
                                 
                            });

                            
                        }else{

                            strTable = '<tr><td colspan="4">'+response.msg+'</td></tr>';

                        }
                        
                        $('#pagination').twbsPagination({
                            totalPages: Math.ceil(response.total_rows/limit),
                            visiblePages: 10,
                            onPageClick: function (event, page) {
                               list_of_invoice(page);
                            }
                        });

                                   
                        $("#invoiceData").html(strTable);
                        $("#invoiceData").show();

                    }else if(response.data <= 0){
                      $('#loading').hide();
                      
                      strTable = '<tr><td colspan="4">'+response.msg+'</td></tr>';

                      $("#invoiceData").html(strTable);
                      $("#invoiceData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="4">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#invoiceData").html(strTable);
                        $("#invoiceData").show();
                        

                    }    
                
                },

                error: function(response){
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

          function fetch_outgoing_info(list_id){
             
            var company_id = localStorage.getItem('company_id');

            $('#ou_'+list_id).hide();
            $('#loader11_'+list_id).show();
             
          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/fetch_outgoing_item",
            data: { "list_id" : list_id, "company_id" : company_id},

            success: function(response) {

              var str = "";
              console.log(response);
        
                
              $('#loader11_'+list_id).hide();
              $('#ou_'+list_id).show();

              if (response.status == '200') {

                var monthNames = [
                  "Jan", "Feb", "Mar",
                  "Apr", "May", "Jun", "Jul",
                  "August", "Sep", "Oct",
                  "Nov", "Dec"
                ];

                 var d = new Date(response.data.date_recieved);
                 var monthIndex = d.getMonth();
                 var datestring11 = d.getDate()  + "/" +  monthNames[monthIndex] + "/" + d.getFullYear();

                $("#modal_view_outgoing #item_name").html( response.data.item_name); 
                $("#modal_view_outgoing #vendor_name").html( response.data.vendor_name);
                $("#modal_view_outgoing #date_recieved").html( datestring11);
                $("#modal_view_outgoing #quantity").html( response.data.qty);
                // $("#modal_view_vendor #comment").val( response.data.comment);


                
                $('#modal_view_outgoing').modal('show');          
              }


            },

            error: function(response){
              $('#loader11_'+list_id).hide();
              $('#ou_'+list_id).show();
              alert("Connection Error.");

            }

            });
          }

          function delete_outgoing_item(list_id){
            
            var company_id = localStorage.getItem('company_id');

          
            var ans = confirm("Are you sure you want to delete this item?");
            if(!ans){
                return;
            }
            

            $('#row_'+list_id).hide();
            $('#loader_row_'+list_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"wms/del_outgoing_item",
                data: {"company_id": company_id, "list_id" : list_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+list_id).hide();
                    $('#row_'+list_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+list_id).hide();
                }
            });
        }

           function display_filter(){

            $('#filter_display').toggle();
            $('#item_name').val("");
            $('#vendor_name').val("");
            $('#item_code').val(""); 
            $('#date_range').val(""); 
          }

          function list_of_outgoing_items(page){

            var company_id = localStorage.getItem('company_id');
             if(page == ""){
                var page = 1;
              }
              var limit = 10;

            var item_name = $('#item_name').val();
            var item_code = $('#item_code').val();
            var vendor_name = $('#vendor_name').val();
            var date_range = $('#date_range').val();

            $("#loading").show();
            $("#outgoingData").html('');


            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"wms/list_outgoing_items",
                data: { "company_id": company_id, "page": page, "limit": limit, "item_name": item_name, "vendor_name": vendor_name, "item_code": item_code, "date_range": date_range },
                timeout: 60000,

                success: function(response) {
                    console.log(response);

                    var strTable = "";
                    
                    if (response.status == '200'){
                        
                        if(response.data.length > 0){

                            var k = 1;
                            $.each(response['data'], function (i, v) {

                              var monthNames = [
                                "Jan", "Feb", "Mar",
                                "Apr", "May", "Jun", "Jul",
                                "August", "Sep", "Oct",
                                "Nov", "Dec"
                              ];

                              var d = new Date(response['data'][i]['outgoing_date']);

                              var monthIndex = d.getMonth();
                              var datestring = d.getDate()  + "/" +  monthNames[monthIndex] + "/" + d.getFullYear();

                              strTable += '<tr id="row_'+response['data'][i]['list_id']+'">';
                              if(response['data'][i]['has_inv'] == "no"){

                                strTable += '<td><input type="checkbox" name="sel_invoice" class="sel_invoice" id="sel_invoice_'+response['data'][i]['list_id']+'"></td>';

                              }else{

                                strTable += '<td></td>';
                              }
                              
                              strTable += '<td>'+response['data'][i]['code']+'</td>';
                              strTable += '<td id="item_name_lz_'+response['data'][i]['list_id']+'">'+response['data'][i]['item_name']+'</td>';
                              strTable += '<td>'+datestring+'</td>';
                              strTable += '<td>'+response['data'][i]['issued_to']+'</td>';
                              // +response['data'][i]['Vendor']+
                              strTable += '<td id="qtyyty_'+response['data'][i]['list_id']+'">'+parseInt(response['data'][i]['qty']).toLocaleString()+'</td>';
                              strTable += '<td id="item_unniitt_'+response['data'][i]['list_id']+'">'+response['data'][i]['unit_name']+'</td>';
                              // strTable += '<td>Pending</td>';
                             strTable += '<td valign="top"><a class="outgoing_info btn btn-primary btn-xs"  id="ou_'+response['data'][i]['list_id']+'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title="View Incoming info"></i> View</a>';

                              strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_'+response['data'][i]['list_id']+'"></i>&nbsp;&nbsp;';

                               // strTable += '<a href="'+base_url+'edit_outgoing_items?id='+response['data'][i]['list_id']+'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="cursor: pointer;font-style: italic; font-size: 20px;" title="Edit Outgoing Item"></i></a>&nbsp;&nbsp;';

                              // strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader_'+response['data'][i]['warehouse_id']+'"></i>&nbsp;&nbsp;'; 

                              // strTable +=  '<a class="delete_outgoing" style="cursor: pointer;" id="out_'+response['data'][i]['list_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Outgoing Item"></i></a></td>';
                              
                              strTable += '</tr>';  

                              strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['list_id']+'">';
                              strTable += '<td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              strTable +=  '</td>';
                              strTable += '</tr>';

                                


                                k++;
                                 
                            });

                            
                        }else{

                            strTable = '<tr><td colspan="8">'+response.msg+'</td></tr>';

                        }
                        
                        $('#pagination').twbsPagination({
                            totalPages: Math.ceil(response.total_rows/limit),
                            visiblePages: 10,
                            onPageClick: function (event, page) {
                              list_of_outgoing_items(page);
                            }
                        });

                                   
                        $("#outgoingData").html(strTable);
                        $("#outgoingData").show();
                        $('#loading').hide();

                    }else if(response.data <= 0){
                      $('#loading').hide();
                      
                      strTable = '<tr><td colspan="8">'+response.msg+'</td></tr>';

                      $("#outgoingData").html(strTable);
                      $("#outgoingData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="8">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#outgoingData").html(strTable);
                        $("#outgoingData").show();
                        

                    }    
                
                },

                error: function(response){
                     var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="8"><strong class="text-danger">Connection error</strong></td>';
                        strTable += '</tr>';

                        
                        $("#outgoingData").html(strTable);
                        $("#outgoingData").show();

                }        

            });
          }
        </script>



<?php
include("_common/footer.php");
?>