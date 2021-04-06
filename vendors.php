<?php
include("_common/header.php");
?>


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Vendors</h3>
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
                     <button type="button" class="btn btn-default" id="vendor_filter">Filter</button>
                    <button type="button" class="btn btn-success" id="add_vendor">Add Vendor</button>
                    
                    
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
                      
                      <div class="col-sm-2 col-xs-4">
                        <input type="text" class="form-control required" placeholder="Vendor Name" id="vendor_name">
                      </div>
                    

                      <div class="col-sm-2 col-xs-4">
                        <input type="number" class="form-control" placeholder="Phone" id="phone">
                      </div>

                     
                      <div class="col-sm-2 col-xs-4">
                        <input type="text" class="form-control" placeholder="email">
                      </div>


                      <div class="col-sm-2 col-xs-4">
                        <input type="text" class="form-control" placeholder="Code" id="vendor_code">
                      </div>

                     <div class="col-sm-2 col-xs-4">
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

            <div id="vendor_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="add_vendor_name">Vendor Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="add_vendor_name" class="form-control col-md-7 col-xs-12 add_vendor_required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="add_vendor_email">Vendor Email<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="add_vendor_email" class="form-control col-md-7 col-xs-12 add_vendor_required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="add_vendor_phone">Phone<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="add_vendor_phone" class="form-control col-md-7 col-xs-12 add_vendor_required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="add_vendor_address">Vendor Address<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12 add_vendor_required" id="add_vendor_address">
                            
                          </textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="add_vendor_comment">Comment
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12" id="add_vendor_comment">
                            
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
                          <button type="button" class="btn btn-success" id="add_ven">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="ven_loader"></i>
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
                            <th class="column-title">Vendor Name </th>
                            <th class="column-title">Address </th>
                            <th class="column-title">Phone </th>
                            <th class="column-title">Email </th>
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
                        <tbody id="vendorData">

                         


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
        <div class="modal fade" id="modal_vendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Vendor Added Successfully!</h4>
              </div>
              <!-- <div class="modal-footer"> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>


          <!-- modal -->
        <div class="modal fade" id="modal_edit_vendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Vendor
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>
                
              </div>
              <div class="modal-body">

                <div id="edit_form">
                <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_name">Vendor Name<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="vendor_name" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_email">Vendor Email<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="vendor_email" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_phone">Phone<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="vendor_phone" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_address">Vendor Address<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12 required" id="vendor_address">
                            
                          </textarea>
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

                  
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" id="form_footer">
                      <button type="submit" class="btn btn-success" id="edit_ven">Update</button>
                      <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_ven_loader"></i>
                      <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                    </div>
                  </div>

                </span>
              </div>

                <div id="edit_msg" style="display: none;">
                <h4>Vendor Updated Successfully!</h4>
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


          <!-- modal -->
        <div class="modal fade" id="modal_view_vendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Vendor Info
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>
                
              </div>
              <div class="modal-body">

                
                  <div id="container4" >
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Vendor Name:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="name1"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Phone Number:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="phone1"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Email Address:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="email_address1"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Vendor Address:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="address1"></p>
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
          $(document).ready(function(){
            
            var vendor_id;

            list_of_company_vendor('');

            $(document).on('click', '#filter', function(){
                 $('#pagination').twbsPagination('destroy');
                list_of_company_vendor('');
            });

            $('#add_vendor').on('click', vendor);
            $('#add_ven').on('click', add_company_vendor);
            $('#vendor_filter').on('click', display);

             $(document).on('click', '.delete_vendor', function(){
                var vendor_id = $(this).attr('id').replace(/ven_/,''); 
                delete_vendor(vendor_id);
              });

             $(document).on('click', '.vendor_info', function(){
                vendor_id = $(this).attr('id').replace(/venIn_/,''); 
                fetch_vendor_info(vendor_id);
                
              });


             $(document).on('click', '.edit_vendor_icon', function(){
                vendor_id = $(this).attr('id').replace(/vend_/,''); 
                fetch_vendor_details(vendor_id);
                
              });

             $(document).on('click', '#edit_ven', function(){
                // var warehouse_id = $(this).attr('id').replace(/edt_/,''); 
                edit_company_vendor(vendor_id);
                // alert(warehouse_id);
              });


          })


           function display(){

            $('#filter_display').toggle();
            $('#vendor_display').hide();
            $('#vendor_name').val("");
            $('#email').val("");
            $('#phone').val("");
            $('#code').val("");          
          }

          function fetch_vendor_info(vendor_id){
             
            var company_id = localStorage.getItem('company_id');

            $('#venIn_'+vendor_id).hide();
            $('#loader11_'+vendor_id).show();
             
          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/fetch_vendor",
            data: { "vendor_id" : vendor_id, "company_id" : company_id},

            success: function(response) {

              var str = "";
              console.log(response);
        
                
              $('#loader11_'+vendor_id).hide();
              $('#venIn_'+vendor_id).show();

              if (response.status == '200') {

                $("#modal_view_vendor #name1").html( response.data.vendor_name); 
                $("#modal_view_vendor #address1").html( response.data.vendor_address);
                $("#modal_view_vendor #phone1").html( response.data.vendor_phone);
                $("#modal_view_vendor #email_address1").html( response.data.vendor_email);
                // $("#modal_view_vendor #comment").val( response.data.comment);


                
                $('#modal_view_vendor').modal('show');          
              }


            },

            error: function(response){
              $('#loader11_'+vendor_id).hide();
              $('#venIn_'+vendor_id).show();
              alert("Connection Error.");

            }

            });
          }

           function edit_company_vendor(vendor_id){
            var vendor_name = $("#modal_edit_vendor #vendor_name").val();                 
            var vendor_address =  $("#modal_edit_vendor #vendor_address").val();
            var vendor_phone =  $("#modal_edit_vendor #vendor_phone").val();
            var vendor_email =  $("#modal_edit_vendor #vendor_email").val();
            var comment =  $("#modal_edit_vendor #comment").val();
            var company_id = $.session.get('id');
            
            var blank;

            
            // alert(warehouse_id);

            $("#modal_edit_vendor .required").each(function(){

              var the_val = $.trim($(this).val());

              if(the_val == "" || the_val == "0"){

                $(this).addClass('has-error');

                blank = "yes";

              }else{

                $(this).removeClass("has-error");

              }

            });

            if(blank == "yes"){
    
              $("#modal_edit_vendor #error").html("You have a blank field");

              return; 

            }

            if(!validateEmail(vendor_email)){
            
              $('#error').show();
              $('#error').html('invalid Email');
                  
              return;
          }            
           // $("#modal_edit_warehouse #error").html("");

          $("#modal_edit_vendor #edit_ven").hide();
          $("#modal_edit_vendor #edit_ven_loader").show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/edit_vendor",
            data: { "vendor_name" : vendor_name, "vendor_address" : vendor_address, "company_id" : company_id, "vendor_id" : vendor_id, "vendor_email" : vendor_email, "vendor_phone" : vendor_phone, "comment" : comment},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {
                $("#modal_edit_vendor #error").html("");
                $("#modal_edit_vendor #edit_ven_loader").hide();   
                $("#modal_edit_vendor #edit_ven").show();

                
                $('#modal_edit_vendor #edit_form').hide();

                $('#modal_edit_vendor #edit_msg').show();

                // $('#modal_department_edit').on('hidden.bs.modal', function () {
                //     $('#department_name').val();
                //     $('#department_description').val();
                //     // window.location.reload();
                //     window.location.href = base_url+"/erp/hrm/departments";
                // })
                
                
              }else if(response.status == '400'){ // coder error message

                $("#modal_edit_vendor #edit_ven_loader").hide(); 
                 $("#modal_edit_vendor #edit_ven").show();
                 $("#modal_edit_vendor #error").html(response.msg);

              }else if(response.status == '401'){ //user error message

                $("#modal_edit_vendor #edit_ven_loader").hide(); 
                 $("#modal_edit_vendor #edit_ven").show();
                 $("#modal_edit_vendor #error").html(response.msg);

              }

               
           
          


            },

            error: function(response){

                  console.log(response);
                 $("#modal_edit_vendor #edit_ven_loader").hide(); 
                 $("#modal_edit_vendor #edit_ven").show();
                 $("#modal_edit_vendor #error").html("Connection Error.");

            }

          });

          }

          function fetch_vendor_details(vendor_id){
            // var pathArray = window.location.pathname.split( '/' );
            // var warehouse_id = $.urlParam('id');  

            var company_id = localStorage.getItem('company_id');

            $('#vend_'+vendor_id).hide();
            $('#loader_'+vendor_id).show();
             
          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/fetch_vendor",
            data: { "vendor_id" : vendor_id, "company_id" : company_id},

            success: function(response) {

              var str = "";
              console.log(response);
               $("#modal_edit_vendor #error").html("");

                $("#modal_edit_vendor .required").each(function(){

                  var the_val = $.trim($(this).val());

                  $(this).removeClass("has-error");

                });
              $('#loader_'+vendor_id).hide();
              $('#vend_'+vendor_id).show();
              if (response.status == '200') {

                $("#modal_edit_vendor #vendor_name").val( response.data.vendor_name); 
                $("#modal_edit_vendor #vendor_address").val( response.data.vendor_address);
                $("#modal_edit_vendor #vendor_phone").val( response.data.vendor_phone);
                $("#modal_edit_vendor #vendor_email").val( response.data.vendor_email);
                $("#modal_edit_vendor #comment").val( response.data.comment);

                // str += '<button type="submit" class="btn btn-success" id="edt_'+response.data.warehouse_id+'" class="update_ware">Update</button>';
                // str += '<i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_ware_loader"></i>';   

                // $("#modal_edit_warehouse #form_footer").html(str);
                $('#modal_edit_vendor').modal('show');          
              }


            },

            error: function(response){
              $('#loader_'+vendor_id).hide();
              $('#vend_'+vendor_id).show();
              alert("Connection Error.");

            }

            });
          }

          function delete_vendor(vendor_id){
            
            var company_id = localStorage.getItem('company_id');

          
            var ans = confirm("Are you sure you want to delete this vendor?");
            if(!ans){
                return;
            }
            

            $('#row_'+vendor_id).hide();
            $('#loader_row_'+vendor_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"wms/delete_vendor",
                data: {"company_id": company_id, "vendor_id" : vendor_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+vendor_id).hide();
                    $('#row_'+vendor_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+vendor_id).hide();
                }
            });
        }

          function add_company_vendor(){
            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');
            var vendor_name = $('#add_vendor_name').val();
            var vendor_address = $('#add_vendor_address').val();
            var vendor_phone = $('#add_vendor_phone').val();
            var vendor_email = $('#add_vendor_email').val();
            var comment = $('#add_vendor_comment').val();
            // alert(employee_id);
            var blank;

            


            $(".add_vendor_required").each(function(){

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
          
          if(!validateEmail(vendor_email)){
            
              $('#error').show();
              $('#error').html('invalid Email');
                  
              return;
          }

          if(vendor_phone.length < 11){
            
              $('#error').show();
              $('#error').html('invalid phone number');
                  
              return;
          }
          
          $('#add_ven').hide();
          $('#ven_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/create_vendor",
            data: { "company_id" : company_id, "user_id" : user_id, "vendor_name" : vendor_name, "vendor_address" : vendor_address, "vendor_phone" : vendor_phone, "vendor_email" : vendor_email, "comment" : comment },

            success: function(response) {

              // console.log(response);

              if (response.status == '200') {

                $('#error').html('');
                $('#modal_vendor').modal('show');

                $('#modal_vendor').on('hidden.bs.modal', function () {
                    // do something…
                    $('#vendor_display').hide();
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error').html(response.msg);

              }else if(response.status == '401'){ //user error message

                
                $('#error').html(response.msg);

              }

               
              $('#add_ven').show();
              $('#ven_loader').hide();

            },

            error: function(response){

              $('#add_ven').show();
              $('#ven_loader').hide();
              $('#error').html("Connection Error.");

            }

          });

          }

          function list_of_company_vendor(page){

            var company_id = localStorage.getItem('company_id');
            
            if(page == ""){
              var page = 1;
            }
            var limit = 5;

            var vendor_name = $('#vendor_name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var code = $('#code').val();
            
            // alert(company_id);

            $("#loading").show();
            $("#vendorData").html('');

            $.ajax({
                  
              type: "POST",
              dataType: "json",
              url: api_path+"wms/list_vendors",
              data: { "company_id": company_id,  "page": page, "limit": limit, "email" : email, "name" : vendor_name, "phone" : phone, "code" : code},
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

                              function status(string) {
                                  return string.charAt(0).toUpperCase() + string.slice(1);
                              }
                              strTable += '<tr id="row_'+response['data'][i]['vendor_id']+'">';
                              strTable += '<td valign="top">'+response['data'][i]['vendor_code']+'</td>';
                              strTable += '<td valign="top">'+status(response['data'][i]['vendor_name'])+'</td>';
                              strTable += '<td valign="top">'+response['data'][i]['vendor_address']+'</td>';
                              strTable += '<td valign="top">'+response['data'][i]['vendor_phone']+'</td>';
                              strTable += '<td valign="top">'+response['data'][i]['vendor_email']+'</td>';
                              
                              strTable += '<td valign="top"><a class="vendor_info btn btn-primary btn-xs"  id="venIn_'+response['data'][i]['vendor_id']+'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title="View Vendor info"></i> View</a>';

                              strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_'+response['data'][i]['vendor_id']+'"></i>&nbsp;&nbsp;';

                              strTable += '<a class="edit_vendor_icon btn btn-info btn-xs" id="vend_'+response['data'][i]['vendor_id']+'" style="cursor: pointer;"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" title="Edit Vendor"></i> Edit</a>';

                              strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader_'+response['data'][i]['vendor_id']+'"></i>&nbsp;&nbsp;'; 

                              strTable +=  '<a class="delete_vendor btn btn-danger btn-xs" style="cursor: pointer;" id="ven_'+response['data'][i]['vendor_id']+'"><i  class="fa fa-trash-o"  data-toggle="tooltip" data-placement="top" title="Delete Vendor"></i> Delete</a></td>';
                              
                              strTable += '</tr>';



                              strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['vendor_id']+'">';
                              strTable += '<td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
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
                            list_of_company_vendor(page);
                          }
                      });
                                 
                      $("#vendorData").html(strTable);
                      $("#vendorData").show();

                  }else if(response.status == '400'){
                      
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="6">No result</td>';
                      strTable += '</tr>';

                      
                      $("#vendorData").html(strTable);
                      $("#vendorData").show();
                      

                  }else if(response.status == "401"){
                      //missing parameters
                      var strTable = "";
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="6">'+response.msg+'</td>';
                      strTable += '</tr>';

                      
                      $("#vendorData").html(strTable);
                      $("#vendorData").show();

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

                
                $("#vendorData").html(strTable);
                $("#vendorData").show();
                $("#loading").hide();

              }        

          });
          }

          function vendor(){
            $('#vendor_display').toggle();
             $('#filter_display').hide();
            $('#add_vendor_name').val('');
            $('#add_vendor_address').val('');
            $('#add_vendor_phone').val('');
            $('#add_vendor_email').val('');
            $('#add_vendor_comment').val('');

            $('#error').html('');

            $(".required").each(function(){

              var the_val = $.trim($(this).val());

              $(this).removeClass("has-error");

            });
          }

          function validateEmail(emailaddress){  

             var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  

             if(!emailReg.test(emailaddress)) {  

                  return false

             }else{

                  return true;
              }
          }

        </script>

<?php
include("_common/footer.php");
?>