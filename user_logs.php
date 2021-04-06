<?php
include("_common/header.php");
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Activities</h3>
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

                    <!-- <h2 id="user_name">Ugochukwu Nwagba</h2> -->

                    

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            
                            <th class="column-title">S/N </th>
                            <th class="column-title">Fullname </th>
                            <th class="column-title">Activities </th>
                      
                          </tr>
                        </thead>

                         <!-- <tr id="loading">
                          <td colspan="2"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" ></i></td>
                        </tr> -->
                        
                       <tbody  id="logData">


                        
                          
                        
                          
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
        <div class="modal fade" id="modal_warehouse_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        


        <script type="text/javascript">
          $(document).ready(function(){

              page_ess_access();
              // var warehouse_id; 
              // fetch_modules_count();
              // list_of_warehouse_users();
          
              // // list_of_company_warehouse();
              
              // $('#add').on('click', user);
              // $('#add_user').on('click', add_warehouse_user);
              // $('#add_ware').on('click', add_company_warehouse);

              // $(document).on('click', '.delete_warehouse', function(){
              //   var warehouse_id = $(this).attr('id').replace(/war_/,''); 
              //   delete_warehouse(warehouse_id);
              // });

              // $(document).on('click', '.warehouse_info', function(){
              //   warehouse_id = $(this).attr('id').replace(/wareIn_/,''); 
              //   fetch_warehouse_info(warehouse_id);
                
              // });

              // $(document).on('click', '.edit_warehouse_icon', function(){
              //   warehouse_id = $(this).attr('id').replace(/warh_/,''); 
              //   fetch_warehouse_details(warehouse_id);
                
              // });

              // $(document).on('click', '#edit_ware', function(){
              //   // var warehouse_id = $(this).attr('id').replace(/edt_/,''); 
              //   edit_company_warehouse(warehouse_id);
              //   // alert(warehouse_id);
              // });

              

          })

            function page_ess_access(){

            var company_id = localStorage.getItem('company_id');

            var user_id = localStorage.getItem('user_id');
            var module_id = 3;
            

            $.ajax({
                  
              type: "POST",
              dataType: "json",
              url: api_path+"accesscontrol/check_if_admin",
              data: { "company_id": company_id,  "user_id": user_id, "module_id": module_id},
              timeout: 60000,

              success: function(response) {
                  
                  console.log(response);
            
                  
                  if (response.status == '200'){

                      $('#user_page').show();

                  }else if(response.status == '400'){
                      
                      

                  }else if(response.status == "401"){
                      //missing parameters
                      $('#main_display').hide();
                      $('#error_display').show();
                      

                  }

              
              },

              error: function(response){
                

                

              }        

          });
          }

          function fetch_modules_count(){
            
            var company_id = localStorage.getItem('company_id');
            var module_id = 6;
 
          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/module_user_counts",
            data: { "module_id" : module_id, "company_id" : company_id},

            success: function(response) {

              console.log(response);
              $('#user_count').html('Users ('+response.data.module_user_counts+')');
               


            },

            error: function(response){
              
              alert("Connection Error.");

            }

            });
          }



          function edit_company_warehouse(warehouse_id){
            var warehouse_name = $("#modal_edit_warehouse #warehouse_name").val();                 
            var warehouse_address =  $("#modal_edit_warehouse #warehouse_address").val();
            var company_id = localStorage.getItem('company_id');
            
            var blank;

            
            // alert(warehouse_id);

            $("#modal_edit_warehouse .required").each(function(){

              var the_val = $.trim($(this).val());

              if(the_val == "" || the_val == "0"){

                $(this).addClass('has-error');

                blank = "yes";

              }else{

                $(this).removeClass("has-error");

              }

            });

            if(blank == "yes"){
    
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
            url: api_path+"wms/edit_warehouse",
            data: { "warehouse_name" : warehouse_name, "warehouse_address" : warehouse_address, "company_id" : company_id, "warehouse_id" : warehouse_id},

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
                
                
              }else if(response.status == '400'){ // coder error message

                
                 $("#modal_edit_warehouse #error").html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                 $("#modal_edit_warehouse #error").html(response.msg);

              }

               
           
          


            },

            error: function(response){

                  console.log(response);
                 $("#modal_edit_warehouse #edit_ware_loader").hide(); 
                 $("#modal_edit_warehouse #edit_ware").show();
                 $("#modal_edit_warehouse #error").html("Connection Error.");

            }

          });

          }

          function fetch_warehouse_info(warehouse_id){
             
            var company_id = localStorage.getItem('company_id');

            $('#wareIn_'+warehouse_id).hide();
            $('#loader11_'+warehouse_id).show();
             
          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/get_warehouse_details",
            data: { "warehouse_id" : warehouse_id, "company_id" : company_id},

            success: function(response) {

              var str = "";
              console.log(response);
        
                
              $('#loader11_'+warehouse_id).hide();
              $('#wareIn_'+warehouse_id).show();

              if (response.status == '200') {

                $("#modal_view_warehouse #name").html( response.data.warehouse_name); 
                $("#modal_view_warehouse #address").html( response.data.warehouse_address);

                
                $('#modal_view_warehouse').modal('show');          
              }


            },

            error: function(response){
              $('#loader11_'+warehouse_id).hide();
              $('#wareIn_'+warehouse_id).show();
              alert("Connection Error.");

            }

            });
          }

          function fetch_warehouse_details(warehouse_id){
            // var pathArray = window.location.pathname.split( '/' );
            // var warehouse_id = $.urlParam('id');  

            var company_id = localStorage.getItem('company_id');

            $('#warh_'+warehouse_id).hide();
            $('#loader_'+warehouse_id).show();
             
          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"wms/get_warehouse_details",
            data: { "warehouse_id" : warehouse_id, "company_id" : company_id},

            success: function(response) {

              var str = "";
              console.log(response);
               $("#modal_edit_warehouse #error").html("");

                $("#modal_edit_warehouse .required").each(function(){

                  var the_val = $.trim($(this).val());

                  $(this).removeClass("has-error");

                });
              $('#loader_'+warehouse_id).hide();
              $('#warh_'+warehouse_id).show();
              if (response.status == '200') {

                $("#modal_edit_warehouse #warehouse_name").val( response.data.warehouse_name); 
                $("#modal_edit_warehouse #warehouse_address").val( response.data.warehouse_address);

                // str += '<button type="submit" class="btn btn-success" id="edt_'+response.data.warehouse_id+'" class="update_ware">Update</button>';
                // str += '<i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_ware_loader"></i>';   

                // $("#modal_edit_warehouse #form_footer").html(str);
                $('#modal_edit_warehouse').modal('show');          
              }


            },

            error: function(response){
              $('#loader_'+warehouse_id).hide();
              $('#warh_'+warehouse_id).show();
              alert("Connection Error.");

            }

            });
          }

          function delete_warehouse(warehouse_id){
            
            var company_id = localStorage.getItem('company_id');

          
            var ans = confirm("Are you sure you want to delete this warehouse?");
            if(!ans){
                return;
            }
            

            $('#row_'+warehouse_id).hide();
            $('#loader_row_'+warehouse_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"wms/delete_warehouse",
                data: {"company_id": company_id, "warehouse_id" : warehouse_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+warehouse_id).hide();
                    $('#row_'+warehouse_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+warehouse_id).hide();
                }
            });
        }

          function add_warehouse_user(){
            var company_id = localStorage.getItem('company_id');
            var module_id = 6;
            var email = $('#email').val();

            // alert(employee_id);
            var blank;

            // alert('welcome');


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
  
              return; 

            }
            if(!validateEmail(email)){
            
              // $('#error-email').show();
              $('#error').html('invalid Email');
                  
              return;
            }
         
          // alert('success');
          $('#add_user').hide();
          $('#user_loader').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"accesscontrol/add_module_user",
            data: { "company_id" : company_id, "module_id" : module_id, "email" : email },

            success: function(response) {

              console.log(response);

              if (response.status == '200') {

                $('#error').html('');
                $('#modal_warehouse_user').modal('show');

                $('#modal_warehouse_user').on('hidden.bs.modal', function () {
                    // do something…
                    $('#user_display').hide();
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error').html(response.msg);

              }else if(response.status == '401'){ //user error message

                
                $('#error').html(response.msg);

              }

               
              $('#add_user').show();
              $('#user_loader').hide();

            },

            error: function(response){

              $('#add_user').show();
              $('#user_loader').hide();
              $('#error').html("Connection Error.");

            }

          });

          }

          function user(){
            $('#user_display').toggle();
            $('#email').val('');
      

            $('#error').html('');

            $(".required").each(function(){

              var the_val = $.trim($(this).val());

              $(this).removeClass("has-error");

            });
          }

          function list_of_warehouse_users(){

            var company_id = localStorage.getItem('company_id');
            var module_id = 6; 

            $("#loading").show();
            $("#userData").html('');

            $.ajax({
                  
              type: "POST",
              dataType: "json",
              url: api_path+"wms/list_module_users",
              data: { "company_id": company_id, "module_id": module_id},
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
                              strTable += '<tr id="row_'+response['data'][i]['user_id']+'">';
                              strTable += '<td valign="top">'+k+'</td>';
                              

                              strTable += '<td valign="top">'+response['data'][i]['lastname']+ ' ' +response['data'][i]['firstname']+'</td>';
                              strTable += '<td valign="top">'+response['data'][i]['email']+'</td>';
                              
                              // strTable += '<td valign="top"><a class="user_edit btn btn-info btn-xs" id="usr_'+response['data'][i]['user_id']+'" style="cursor: pointer;"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" title="Edit User"></i> Edit</a>';

                              // strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_'+response['data'][i]['user_id']+'"></i>&nbsp;&nbsp;';


                              strTable +=  '<td valign="top"><a class="delete_user  btn btn-danger btn-xs" style="cursor: pointer;" id="user_'+response['data'][i]['user_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" title="Delete User"></i> Delete</a>&nbsp;&nbsp;';

                              strTable += '<ahref="'+base_url+'user_permissions?id='+response['data'][i]['user_id']+'"><i  class="fa fa-lock"  data-toggle="tooltip" data-placement="top" title="User Permissions" style="font-size : 24px;"></i></a>&nbsp;&nbsp;';
 
                              strTable += '<a href="'+base_url+'user_logs?id='+response['data'][i]['user_id']+'"><i  class="fa fa-clock-o"  data-toggle="tooltip" data-placement="top" style="color: #000; font-size: 20px;" title="User Logs"></i></a></td>'; 
                              
                              strTable += '</tr>';



                              strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['user_id']+'">';
                              strTable += '<td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              strTable +=  '</td>';
                              strTable += '</tr>';


                              k++;
                               
                          });

                      }else{

                          strTable = '<tr><td colspan="4">No record.</td></tr>';

                      }


                     
                                 
                      $("#userData").html(strTable);
                      $("#userData").show();

                  }else if(response.status == '400'){
                      
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="4">No result</td>';
                      strTable += '</tr>';

                      
                      $("#userData").html(strTable);
                      $("#userData").show();
                      

                  }else if(response.status == "401"){
                      //missing parameters
                      var strTable = "";
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="4">'+response.msg+'</td>';
                      strTable += '</tr>';

                      
                      $("#userData").html(strTable);
                      $("#userData").show();

                  }


                  $("#loading").hide();
              
              },

              error: function(response){
                

                var strTable = "";
                $('#loading').hide();
                // alert(response.msg);
                strTable += '<tr>';
                strTable += '<td colspan="4"><strong class="text-danger">Connection error!</strong></td>';
                strTable += '</tr>';

                
                $("#userData").html(strTable);
                $("#userData").show();
                $("#loading").hide();

              }        

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