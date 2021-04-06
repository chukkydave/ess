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
                    <a href="outgoing"><button type="button" class="btn btn-primary">Back</button></a>
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

                    

                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_name">Item Name <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <span id="selct_itn_text"></span><input type="hidden" value="" id="sltd_item_id">
                          <input type="text" name="item_name" id="item_name" class="form-control col-md-7 col-xs-12">
                        </div>

                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unit_type">Unit Type <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 required" id="unit_type" disabled="disabled">
                            <option value="">-- Select --</option>
                            
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantity">Quantity <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="quantity" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_recieved">Outgoing Date<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="input-prepend input-group">
                              <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                             <input type="text" id="date_recieved" required="required" class="form-control col-md-7 col-xs-12 required">
                          </div>
                        </div>
                      </div>



                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="issued_to">Issued to<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <input type="text" name="issued_to" id="issued_to" class="form-control col-md-7 col-xs-12 required">
                        </div>

                      </div>

                      
                    

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse">Releasing Warehouse <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 required" id="warehouse">
                            <option value="">-- Select --</option>
                            
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warehouse_selection">Releasing Section <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 required" id="warehouse_selection">
                            <option>-- Select --</option>
                            
                          </select>
                        </div>
                      </div>

      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comment">Comment
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12" id="comment">
                            
                          </textarea>
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
                          <button type="submit" class="btn btn-success" id="add_item">Add Item</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="loader"></i>
                          <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                        </div>
                      </div>

                    </span>
							
						
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- modal -->
        <div class="modal fade" id="modal_outgoing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Item Added Successfully!</h4>
              </div>
              <!-- <div class="modal-footer"> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>

        <script type="text/javascript">

          $(document).ready(function(){
            load_unit_type(); 
            load_warehouse();  

            $('input#date_recieved').datepicker({
              dateFormat: "yy-mm-dd"
            });
            $('input#expiry_date').datepicker({
              dateFormat: "yy-mm-dd"
            });

            $('#add_item').on('click', add_company_outgoing_item);
            
            $( "#item_name" ).autocomplete({

              source: function( request, response ) {
               // Fetch data
               $.ajax({

                  url: api_path+"wms/items_autocomplete",
                  type: 'post',
                  dataType: "json",
                  data: {
                   term: request.term,
                   company_id:localStorage.getItem('company_id')
                  },
                  success: function( data ) {
                   response( data );
                   console.log(data);
                  }

               });
              },
              minLength: 2,
              select: function (event, ui) {

                console.log(ui.item.id);
                // Set selection
                $('#item_name').val(''); // display the selected text
                $('#sltd_item_id').val(ui.item.id); // save selected id to input
                $('#selct_itn_text').html(ui.item.label); // save selected id to input
                $("#unit_type").val(ui.item.unit).trigger("change");
                return false;

              }

            });

          })


          function add_company_outgoing_item(){
            var item_name = $("#sltd_item_id").val();                
            var unit_type =  $("#unit_type").val();
            var quantity =  $("#quantity").val();
            var outgoing_date =  $("#date_recieved").val();
            var issued_to =  $("#issued_to").val();
            var warehouse =  $("#warehouse").val();
            var warehouse_section =  "";
            var comment =  $("#comment").val();
            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');
            
            var blank;

            
            // alert(warehouse_id);

            $(".required").each(function(){

              var the_val = $.trim($(this).val());

              if(the_val == "" || the_val == "0"){

                $(this).addClass('has-error');

                blank = "yes";

              }else{

                $(this).removeClass("has-error");

              }

            });

            if(blank == "yes"){
    
              $("#error").html("You have a blank field");

              return; 

            }


            


            if($("#sltd_item_id").val() == ""){
              $(".item_name").addClass('has-error');
              $("#error").html("You have a blank field");
              return; 
            }

                        
           // $("#modal_edit_warehouse #error").html("");

          $("#add_item").hide();
          $("#loader").show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/add_outgoing_item",
            data: { "item_name" : item_name, "company_id" : company_id, "user_id" : user_id, "quantity" : quantity, "unit_type" : unit_type, "warehouse" : warehouse, "warehouse_section" : warehouse_section, "comment" : comment, "outgoing_date" : outgoing_date, "issued_to" : issued_to},

            success: function(response) {

              console.log(response);

              $("#error").html("");
              $("#loader").hide();   
              $("#add_item").show();

              if (response.status == '200') {
                
                $('#modal_outgoing').modal('show');

                $('#modal_outgoing').on('hidden.bs.modal', function () {
                    
                    // window.location.reload();
                    window.location.href = base_url+"outgoing";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                 $("#error").html(response.msg);

              }else if(response.status == '401'){ //user error message

                
                 $("#error").html(response.msg);

              }           
          


            },

            error: function(response){

                  console.log(response);
                 $("#loader").hide(); 
                 $("#add_item").show();
                 $("#error").html("Connection Error.");

            }

          });

          }

          function load_warehouse(){

            var company_id = localStorage.getItem('company_id');
            var page = -1;
            var limit = 0;

             $.ajax({
                url: api_path+"wms/list_warehouse",
                type: "POST",
                data: {"company_id" : company_id, "page" : page, "limit" : limit},
                dataType: "json",
                
                
                success: function (response) {
                    
                    // $('#page_loader').hide();
                    // $('#employee_details_display').show();
                    
                    console.log(response);
                    var options = '';

                    $.each(response['data'], function (i, v) {
                        options += '<option value="'+ response['data'][i]['warehouse_id'] +'">' + response['data'][i]['warehouse_name'] +'</option>';

                        // emp_type = response['data'][i]['type_id'];
                    });
                    $('#warehouse').append(options);
                },
                // jqXHR, textStatus, errorThrown
                error(response) {
                  alert('Connection error');
                    // $('#page_loader').hide();
                    // $('#employee_details_display').hide();
                    // $('#employee_error_display').show();
                }
            });

          }

           function load_unit_type(){

            var company_id = localStorage.getItem('company_id');

             $.ajax({
                url: api_path+"wms/list_unit",
                type: "POST",
                data: {"company_id" : company_id},
                dataType: "json",
                
                
                success: function (response) {
                    
                    // $('#page_loader').hide();
                    // $('#employee_details_display').show();
                    
                    console.log(response);
                    var options = '';

                    $.each(response['data'], function (i, v) {
                        options += '<option value="'+ response['data'][i]['id'] +'">' + response['data'][i]['unit_name'] +'</option>';

                        // emp_type = response['data'][i]['type_id'];
                    });
                    $('#unit_type').append(options);
                },
                // jqXHR, textStatus, errorThrown
                error(response) {
                  alert('Connection error');
                    // $('#page_loader').hide();
                    // $('#employee_details_display').hide();
                    // $('#employee_error_display').show();
                }
            });

          }
          
        </script>



<?php
include("_common/footer.php");
?>