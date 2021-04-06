<?php
include("_common/header.php");
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Items</h3>
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
                    <button type="button" class="btn btn-default" id="item_filter">Filter</button>
                    <button type="button" class="btn btn-success" id="add_item">Add Item</button>
                    
                    
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
                        <input type="text" name="item_name" id="autocomplete-append" class="form-control required">
                      </div>


                      <div class="col-sm-3 col-xs-4">
                        <label>Unit Type</label>
                        <select class="form-control col-sm-3 col-xs-4 required" id="unit_type1">
                            <option value="">-- Select --</option>
                            
                          </select>
                      </div>


                      <div class="col-sm-3 col-xs-4">
                        <label>Item Code</label>
                        <input type="text" class="form-control" id="item_code">
                      </div>
                      <br>

                     <div class="col-sm-3 col-xs-4">
                        <button type="button" class="btn btn-success" id="filter">Go</button>
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="filter_loader"></i>
                      </div> 
                      
                    </div>                                  

                    <!-- <div class="form-row"></div> -->

                  </div>
                </div>
              </div>
            </div>
          </div>

            <div id="item_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="add_item_name">Item Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="add_item_name"  class="form-control col-md-7 col-xs-12 add_item_required">
                        </div>
                      </div>

                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="add_description">Description<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12" id="add_description">
                            
                          </textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Unit Type<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-sm-2 col-xs-2 add_item_required" id="add_unit_type">
                                <option value="">----</option>
                                
                            </select>
                        </div>
                      </div>  

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="add_min_alert">Low Qty Alert<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="add_min_alert"  class="form-control col-md-7 col-xs-12">
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
                          <button type="button" class="btn btn-success" id="add">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="item_loader"></i>
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
                            
                            <th class="column-title">Code </th>
                            <th class="column-title">Item Name </th>
                            <th class="column-title">Unit of Measurement </th>
                            <th class="column-title">Current Unit Cost </th>
                            <th class="column-title">Available Qty </th>
                            
                            
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="6">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tr id="loading">
                          <td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" ></i></td>
                        </tr>
                        <tbody id="itemsData">
                          
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
        <div class="modal fade" id="modal_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

         <div class="modal fade" id="modal_edit_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Product
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>
                
              </div>
              <div class="modal-body">
                <div id="edit_form">
                <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="item_name">Name<span>*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="item_name" required="required" class="form-control col-md-7 col-xs-12 required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Description<span>*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea cols="3" class="form-control col-md-7 col-xs-12" id="description">
                        
                      </textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Unit Type<span>*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control col-sm-2 col-xs-2" id="unit_type">
                            <!-- <option value="">----</option> -->
                            
                        </select>
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="low_qty">Low Qty Alert<span>*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="low_qty" required="required" class="form-control col-md-7 col-xs-12">
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
                      <button type="submit" class="btn btn-success" id="upd_item">Update</button>
                      <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_item_loader"></i>
                      <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                    </div>
                  </div>
                </span>
              </div>

              <div id="edit_msg" style="display: none;">
                <h4>Item Updated Successfully!</h4>
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
          $(document).ready(function(){
            var item_id;
            load_unit_type();
            load_modal_unit_type();
            list_of_comapany_items('');

             $(document).on('click', '#filter', function(){
                $('#pagination').twbsPagination('destroy');
                list_of_comapany_items('');
            });

            $('#add_item').on('click', item);
            $('#add').on('click', add_company_item);
            $('#item_filter').on('click', display_filter);

            $(document).on('click', '.delete_item', function(){
                var item_id = $(this).attr('id').replace(/itm_/,''); 
                delete_item(item_id);
              });

            $(document).on('click', '.edit_item_icon', function(){
                item_id = $(this).attr('id').replace(/item_/,''); 
                fetch_item_details(item_id);
                
              });

            $(document).on('click', '#upd_item', function(){
                
                edit_company_item(item_id);
          
              });
          })



           function display_filter(){

            $('#filter_display').toggle();
            $('#item_display').hide();
            $('#item_name').val("");
            $('#unit_type').val("");
            $('#item_code').val("");          
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
                    $('#add_unit_type').append(options);
                    $('#unit_type1').append(options);
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

          function load_modal_unit_type(){

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
                    });
                    
                    $('#modal_edit_item #unit_type').append(options);
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

          function item(){
            $('#item_display').toggle();
            $('#filter_display').hide();
            $('#add_item_name').val('');
            $('#add_description').val('');
            $('#add_unit_type').val('');

            $('#error').html('');

            $(".required").each(function(){

              var the_val = $.trim($(this).val());

              $(this).removeClass("has-error");

            });
          }

          function fetch_item_details(item_id){
            // var pathArray = window.location.pathname.split( '/' );
            // var warehouse_id = $.urlParam('id');  

            var company_id = localStorage.getItem('company_id');

            $('#item_'+item_id).hide();
            $('#loader_'+item_id).show();
             
          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/get_item_details",
            data: { "item_id" : item_id, "company_id" : company_id},

            success: function(response) {

              var str = "";
              console.log(response);
               $("#modal_edit_item #error").html("");

                $("#modal_edit_item .required").each(function(){

                  var the_val = $.trim($(this).val());

                  $(this).removeClass("has-error");

                });
              $('#loader_'+item_id).hide();
              $('#item_'+item_id).show();
              if (response.status == '200') {

                $("#modal_edit_item #item_name").val( response.data.item_name); 
                $("#modal_edit_item #description").val( response.data.item_description);
                $("#modal_edit_item #low_qty").val( response.data.item_lowQty);
                $("#modal_edit_item #unit_type").val( response.data.unit_id);



                // str += '<button type="submit" class="btn btn-success" id="edt_'+response.data.warehouse_id+'" class="update_ware">Update</button>';
                // str += '<i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_ware_loader"></i>';   

                // $("#modal_edit_warehouse #form_footer").html(str);
                $('#modal_edit_item').modal('show');          
              }


            },

            error: function(response){
              $('#loader_'+item_id).hide();
              $('#item_'+item_id).show();
              alert("Connection Error.");

            }

            });
          }


          function add_company_item(){
            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');
            var item_name = $('#add_item_name').val();
            var description = $('#add_description').val();
            var unit_type = $('#add_unit_type').val();
            var barcode = "1234";
            var min_alert = $('#add_min_alert').val();
            // alert(employee_id);
            var blank;

            


            $(".add_item_required").each(function(){

              var the_val = $.trim($(this).val());

              if(the_val == "" || the_val == "0"){

                $(this).addClass('has-error');

                blank = "yes";

              }else{

                $(this).removeClass("has-error");

              }

            });

            if(blank == "yes"){
    
              $('#error').html("You have a blank field");

              return; 

            }
         
          
          $('#add').hide();
          $('#item_loader').show();


          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/create_item",
            data: { "company_id" : company_id, "user_id" : user_id, "item_name" : item_name, "description" : description, "barcode" : barcode, "min_alert" : min_alert, "unit_type" : unit_type},

            success: function(response) {

              // console.log(response);

              if (response.status == '200') {

                $('#error').html('');
                $('#modal_item').modal('show');

                $('#modal_item').on('hidden.bs.modal', function () {
                    // do something…
                    $('#item_display').hide();
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error').html("No result");

              }

               
              $('#add').show();
              $('#item_loader').hide();

            },

            error: function(response){

              $('#add').show();
              $('#item_loader').hide();
              $('#error').html("Connection Error.");

            }

          });

          }


          function delete_item(item_id){
            
            var company_id = localStorage.getItem('company_id');

          
            var ans = confirm("Are you sure you want to delete this item?");
            if(!ans){
                return;
            }
            

            $('#row_'+item_id).hide();
            $('#loader_row_'+item_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"wms/delete_item",
                data: {"company_id": company_id, "item_id" : item_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+item_id).hide();
                    $('#row_'+item_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+item_id).hide();
                }
            });
        }


        function edit_company_item(item_id){
            var item_name = $("#modal_edit_item #item_name").val();                 
            var description =  $("#modal_edit_item #description").val();
            var unit_type =  $("#modal_edit_item #unit_type").val();
            var min_alert =  $("#modal_edit_item #low_qty").val();;
            var company_id = localStorage.getItem('company_id');
            
            var blank;

            
            // alert(warehouse_id);

            $("#modal_edit_item .required").each(function(){

              var the_val = $.trim($(this).val());

              if(the_val == "" || the_val == "0"){

                $(this).addClass('has-error');

                blank = "yes";

              }else{

                $(this).removeClass("has-error");

              }

            });

            if(blank == "yes"){
    
              $("#modal_edit_item #error").html("You have a blank field");

              return; 

            }

                        
           // $("#modal_edit_warehouse #error").html("");

          $("#modal_edit_item #upd_item").hide();
          $("#modal_edit_item #edit_item_loader").show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/edit_item",
            data: { "item_name" : item_name, "description" : description, "company_id" : company_id, "item_id" : item_id, "min_alert" : min_alert, "unit_type" : unit_type},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {
                $("#modal_edit_item #error").html("");
                $("#modal_edit_item #edit_item_loader").hide();   
                $("#modal_edit_item #upd_item").show();

              
                $('#modal_edit_item #edit_form').hide();

                $('#modal_edit_item #edit_msg').show();

                // $('#modal_department_edit').on('hidden.bs.modal', function () {
                //     $('#department_name').val();
                //     $('#department_description').val();
                //     // window.location.reload();
                //     window.location.href = base_url+"/erp/hrm/departments";
                // })
                
                
              }else if(response.status == '400'){ // coder error message

                $("#modal_edit_item #edit_item_loader").hide(); 
                 $("#modal_edit_item #upd_item").show();
                 $("#modal_edit_item #error").html('Technical Error. Please try again later.');
                 

              }else if(response.status == '401'){ //user error message

                $("#modal_edit_item #edit_item_loader").hide(); 
                 $("#modal_edit_item #upd_item").show();
                 $("#modal_edit_item #error").html(response.msg);

              }

               
           
          


            },

            error: function(response){

                  console.log(response);
                 $("#modal_edit_item #edit_item_loader").hide(); 
                 $("#modal_edit_item #upd_item").show();
                 $("#modal_edit_item #error").html("Connection Error.");

            }

          });

          }


           function list_of_comapany_items(page){

            var company_id = localStorage.getItem('company_id');

            var item_name = $('#item_name').val();
            var item_code = $('#item_code').val();
            var unit_type = $('#unit_type1').val();

            if(page == ""){
              var page = 1;
            }
            var limit = 10;

            

            $("#loading").show();
            $("#itemsData").html('');

            $.ajax({
                  
              type: "POST",
              dataType: "json",
              url: api_path+"wms/list_store_items",
              data: { "company_id": company_id, "page": page, "limit": limit, "item_name": item_name, "item_code": item_code, "unit_type": unit_type},
              timeout: 60000,

              success: function(response) {
                  
                  console.log(response);
                  $('#loading').hide();
                  var strTable = "";
                  
                  if (response.status == '200'){

                      if(response.data.length > 0){

                          var k = 1;
                          $.each(response['data'], function (i, v) {
                              // strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+base_url+'/erp/assets/admin_template/production/images/img.jpg" alt="..." width="50"></div></td>';

                              // function status(string) {
                              //     return string.charAt(0).toUpperCase() + string.slice(1);
                              // }
                              strTable += '<tr id="row_'+response['data'][i]['item_id']+'">';
                              
                              strTable += '<td valign="top">'+response['data'][i]['item_code']+'</td>';
                              
                              strTable += '<td valign="top">'+response['data'][i]['item_name']+'</td>';
                              strTable += '<td valign="top">'+response['data'][i]['item_unit']+'</td>';
                              strTable += '<td valign="top"></td>';

                              strTable += '<td valign="top">'+response['data'][i]['qty_left']+'</td>';

                             
                              strTable += '<td valign="top"><a class="edit_item_icon btn btn-info btn-xs" id="item_'+response['data'][i]['item_id']+'" style="cursor: pointer;"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" title="Edit Item"></i> Edit</a>&nbsp;';

                              strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader_'+response['data'][i]['item_id']+'"></i>&nbsp;&nbsp;';  

                              strTable += '<a class="delete_item btn btn-danger btn-xs" style="cursor: pointer;" id="itm_'+response['data'][i]['item_id']+'"><i  class="fa fa-trash-o"  data-toggle="tooltip" data-placement="top" title="Delete Item"></i> Delete</a>&nbsp;&nbsp;';

                               strTable += '<a href="'+base_url+'items_activities?id='+response['data'][i]['item_id']+'"><i  class="fa fa-clock-o"  data-toggle="tooltip" data-placement="top" style="color: #000; font-size: 20px;" title="View Item info"></i></a></td>';
                              
                              strTable += '</tr>';

                              strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['item_id']+'">';
                              strTable += '<td colspan="2"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              strTable +=  '</td>';
                              strTable += '</tr>';




                              k++;
                               
                          });

                      }else{

                          strTable = '<tr><td colspan="6">No record.</td></tr>';

                      }


                      $('#pagination').twbsPagination({
                          totalPages: Math.ceil(response.total_rows/limit),
                          visiblePages: 10,
                          onPageClick: function (event, page) {
                             list_of_comapany_items(page);
                          }
                      });
                      
                                 
                      $("#itemsData").html(strTable);
                      $("#itemsInfoData").show();

                  }else if(response.status == '400'){
                      
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="6">'+response.msg+'</td>';
                      strTable += '</tr>';

                      
                      $("#itemsData").html(strTable);
                      $("#itemsData").show();
                      

                  }else if(response.status == "401"){
                      //missing parameters
                      var strTable = "";
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="6">'+response.msg+'</td>';
                      strTable += '</tr>';

                      
                      $("#itemsData").html(strTable);
                      $("#itemsData").show();

                  }


                  $("#loading").hide();
              
              },

              error: function(response){
                

                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="6"><strong class="text-danger">Connection error!</strong></td>';
                strTable += '</tr>';

                
                $("#itemsData").html(strTable);
                $("#itemsData").show();
                $("#loading").hide();

              }        

          });
          }
        </script>



<?php
include("_common/footer.php");
?>