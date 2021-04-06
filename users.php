<?php
include("_common/header.php");
?>

        <!-- page content -->
        <div class="right_col" role="main" id="main_display" style="display: ;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3 id="user_count"></h3>
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
                    <button type="button" class="btn btn-success" id="add">Add User</button>
                    
                    
                  </div>
                </div>
              </div>
            </div>

            <div id="user_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Employee.ng Account <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" class="form-control col-md-7 col-xs-12 required" placeholder="E-mail">
                        </div>

                        
                      </div>


                      <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Connect Account to... <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="employee_pr" class="form-control col-md-7 col-xs-12 required" placeholder="Enter Employee Code e.g. E14">
                        </div>

                        
                      </div> -->

                    

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
                          <button type="button" class="btn btn-success" id="add_user">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="user_loader"></i>
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
                            
                            <th class="column-title">S/N </th>
                            <th class="column-title">&nbsp;</th>
                            <th class="column-title">Name </th>
                            <th class="column-title">Email </th>
                            <th class="column-title">Employee Profile </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="2">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                         <tr id="loading">
                          <td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" ></i></td>
                        </tr>
                        
                       <tbody  id="userData">
                          
                        
                          
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
        <div class="modal fade" id="modal_ess_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


         <div class="modal fade" id="modal_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Connected Profile
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>
                
              </div>
              <div class="modal-body">

                <div class="table-responsive">

                  <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                      <div class="input-group">
                        <input type="text" class="form-control" id="employee_code" placeholder="Enter employee code">
                        <input type="hidden" id="currentviewdpsn" value="">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button" id="search">Go!</button>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div id="table_profile">
                    <table class="table">  
                      <tr id="loading_profile">
                        <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="opop_loader" ></i></td>
                      </tr>
                      <tbody id="profileData">
                        
                      </tbody>
                    </table>
                  </div>

                  <div id="change_profile" style="display: none;">
                    <table class="table">  
                      <tr id="loading_change">
                        <td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" ></i></td>
                      </tr>
                      <tbody id="changeData">
                        
                      </tbody>
                    </table>
                  </div>

                  <div id="change_success" style="display: none;">
                    <table class="table">       
                      <tbody>
                        <tr>
                          <td colspan="3"><strong><h4>Update Successful!</h4></strong></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <!-- <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Ok</button>  -->
                </div>
              
              </div>
              <!-- <div class="modal-footer"> -->
                
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>

        <script type="text/javascript">
          $(document).ready(function(){
              // var warehouse_id; 
              // fetch_modules_count();
              page_ess_access();
              list_of_ess_users('');
          
              // list_of_company_warehouse();
              
              $('#add').on('click', user);
              $('#add_user').on('click', add_ess_user);

              $(document).on('click', '.delete_user', function(){
                var row_id = $(this).attr('id').replace(/usr_/,''); 
                delete_user(row_id);
              });
              
              $(document).on('click', '.connect', function(){
                  var user_id = $(this).attr('id').replace(/user_/,'');
                  $("#loading_profile").show();
                  fetch_employee_status(user_id)
                  //connect_user(user_id)

              });

              $(document).on('click', '.delete_user_connection', function(){
                  var user_id = $(this).attr('id').replace(/usercon_/,'');
                  delete_user_connection(user_id);

              });

              $(document).on('click', '#search', function(){
                  search_user();

              });

              $(document).on('click', '.change_user_connection', function(){
                  var employee_code = $(this).attr('id').replace(/chan_/,'');
                  change_user_connection(employee_code);

              });

              // $('#modal_status #search').on('click', search_user);

          })


          function search_user(){
            

            var employee_code = $('#modal_status #employee_code').val();
            var company_id = localStorage.getItem('company_id');

          
          

            $('#table_profile').hide();
            $('#modal_status #change_profile').show();

            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"ess/ess_search",
                data: {"employee_code": employee_code, "company_id" : company_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                  $('#loading_change').hide();
                    // $('#loader_row_'+user_id).hide();
                    // $('#row_'+user_id).show();

                    alert('connection error');
                },

                success: function(response) {

                    $('#loading_change').hide(); 
                    console.log(response);

                    var strTable = "";
                    if(response.status == '200'){

                        strTable += '<tr><br>';
                        strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+window.location.origin+'/files/images/employee_images/sml_'+response.data.pics+'" alt="..." width="50"></div></td>';
                        strTable += '<td valign="top">'+response.data.lastname+ ' ' +response.data.firstname+'</td>';
                        // strTable += '<td valign="top">'+response['data'][i]['email']+'</td>';
                        strTable += '<td valign="top"><a class="change_user_connection  btn btn-success btn-xs pull-right" style="cursor: pointer;" id="chan_'+response.data.employee_profile_id+'" dir=""><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" title="Delete User"></i> Chnage</a>'; 

                        strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="load_'+response.data.employee_profile_id+'"></i></td>';
                        strTable += '</tr>';


         
                    }else if(response.status == '401'){
                            
                      strTable += '<tr><br>';
                      strTable += '<td width="25%" valign="top">'+response.msg+'</td>';
                      strTable += '<td valign="top">&nbsp;</td>';
                      
                      strTable += '</tr>';           
                    }else if(response.status == '400'){

                      strTable += '<tr><br>';
                      strTable += '<td width="25%" valign="top">'+response.msg+'</td>';
                      strTable += '<td valign="top">&nbsp;</td>';
                      
                      strTable += '</tr>';  

                    }

                    $('#modal_status #changeData').html(strTable);

                    $('#modal_status').on('hidden.bs.modal', function () {
                        $('#modal_status #employee_code').val("");
                        $('#modal_status #changeData').html("");
                        //$('#modal_status #profileData').html("");
                    });
                    // $('#loader_row_'+user_id).hide();

                    // window.location.reload();
                }
            });
        }
          
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
          
      function connect_user(user_id){
          
          // var company_id = localStorage.getItem('company_id');
          
          var ans;

          if ($('#user_'+user_id).hasClass('label label-success')){

            ans = confirm("Are you sure you want to disconnect this user from employee.ng?");

          }else if ($('#user_'+user_id).hasClass('label label-danger')){

            ans = confirm("Are you sure you want to connect this user to employee.ng?");

          }

          

          if(!ans){
              return;
          }
          

          $('#user_'+user_id).hide();
          $('#loader_'+user_id).show();
          $.ajax({ 
              type: "POST",
              dataType: "json",
              url: api_path+"ess/user_connect",
              data: {"user_id" : user_id},
              timeout: 60000, // sets timeout to one minute
              // objAJAXRequest, strError

              error: function(response){
                  
                  $('#loader_'+user_id).hide();
                  $('#user_'+user_id).show();

                  alert('connection error');
              },

              success: function(response) {  
                  // console.log(response);
                  if(response.status == '200'){
                      
                      $('#loader_'+user_id).hide();

                      if ($('#user_'+user_id).hasClass('label label-success')){


                          $('#user_'+user_id).removeClass('label label-success'); 
                          $('#user_'+user_id).addClass("label label-danger");
                          $('#user_'+user_id).html("Not Connected");
                          $('#user_'+user_id).show(); 

                      }else if ($('#user_'+user_id).hasClass('label label-danger')){


                        $('#user_'+user_id).removeClass("label label-danger");
                        $('#user_'+user_id).addClass("label label-success");
                        $('#user_'+user_id).html("Connected");
                        $('#user_'+user_id).show();
                          
                      }
       
                  }else if(response.status == '401'){
                          
                              
                  }

              }
          });
      }

        function delete_user_connection(employee_profile_id){
          
          // var company_id = localStorage.getItem('company_id');

        
          var ans = confirm("Are you sure you want to delete this user?");
          if(!ans){
              return;
          }
          

          $('#row_'+employee_profile_id).hide();
          $('#loader_row_'+employee_profile_id).show();

          $.ajax({ 
              type: "POST",
              dataType: "json",
              url: api_path+"ess/delete_ess_connect",
              data: { "employee_profile_id": employee_profile_id },
              timeout: 60000, // sets timeout to one minute
              // objAJAXRequest, strError

              error: function(response){
                  $('#loader_row_'+employee_profile_id).hide();
                  $('#row_'+employee_profile_id).show();

                  alert('connection error');
              },

              success: function(response) {  
                  console.log(response);
                  if(response.status == '200'){
                      // $('#row_'+user_id).hide();

       
                  }else if(response.status == '401'){
                          
                              
                  }

                  $('#loader_row_'+employee_profile_id).hide();

                  $('#modal_status').on('hidden.bs.modal', function () {
                      window.location.reload();
                  });
                  
              }
          });
      }


        function change_user_connection(employee_profile_id){
          
          // var company_id = localStorage.getItem('company_id');

          var user_id = $("#currentviewdpsn").val();


        
          var ans = confirm("Are you sure you want to connect this user to employee.ng?");
          if(!ans){
              return;
          }
          

          $('#chan_'+employee_profile_id).hide();
          $('#load_'+employee_profile_id).show();

          $.ajax({
           
              type: "POST",
              dataType: "json",
              url: api_path+"ess/change_connection",
              data: { "employee_profile_id": employee_profile_id , "user_id" : user_id },
              timeout: 60000, // sets timeout to one minute

              error: function(response){
                  $('#load_'+employee_profile_id).hide();
                  $('#chan_'+employee_profile_id).show();
                  alert('connection error.');
              },

              success: function(response) {  
                  
                  console.log(response);
                  $('#load_'+employee_profile_id).hide();
                  
                  if(response.status == '200'){
                      
                      // $('#row_'+user_id).hide();
                      $('#modal_status #table_profile').hide();
                      $('#modal_status #change_profile').hide();
                      $('#modal_status #change_success').show();

                      

                      $('#modal_status').on('hidden.bs.modal', function () {
                          window.location.reload();
                      });
       
                  }else if(response.status == '401'){
                          
                              
                  }

                  
                  
              }
          });
      }
      function fetch_employee_status(user_id){
       

        $('#modal_status').modal('show');
        $('#modal_status #table_profile').show();
        // $('#modal_status #change_profile').show();
        $("#currentviewdpsn").val(user_id);
        $("#profileData").html('');
         
      $.ajax({

        type: "POST",
        dataType: "json",
        cache: false,
        url: api_path+"ess/fetch_ess_profile",
        data: { "user_id" : user_id , "company_id" : localStorage.getItem('company_id') },

        success: function(response) {

          console.log(response);
          var strTable = "";

          $('#loading_profile').hide();

          if (response.status == '200') {

              if(response.data.connect_status == "Connected"){

                strTable += '<tr id="row_'+response.data.employee_id+'"><br>';
                strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+window.location.origin+'/files/images/employee_images/sml_'+response.data.pics+'" alt="..." width="50"></div></td>';
                strTable += '<td valign="top">'+response.data.lastname+ ' ' +response.data.firstname+'</td>';
                // strTable += '<td valign="top">'+response['data'][i]['email']+'</td>';
                strTable += '<td valign="top"><a class="delete_user_connection  btn btn-danger btn-xs pull-right" style="cursor: pointer;" id="usercon_'+response.data.employee_id+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" title="Delete User"></i> Delete</a></td>'; 
                strTable += '</tr>';


                strTable += '<tr style="display: none;" id="loader_row_'+response.data.employee_id+'">';
                strTable += '<td colspan="3"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                strTable +=  '</td>';
                strTable += '</tr>';

              }else{


                strTable += '<tr><br>';
                strTable += '<td width="25%" valign="top">Not Connected</td>';
                strTable += '<td valign="top">&nbsp;</td>';
                
                strTable += '</tr>';

                // $('#modal_status #profileData').html("Not Connected!");


              }

              


              $('#modal_status #profileData').html(strTable);


              $('#modal_status').on('hidden.bs.modal', function () {
                  $('#modal_status #employee_code').val("");
                  //$('#modal_status #changeData').html("");
                  //$('#modal_status #profileData').html("");
              });
                     
          }


        },

        error: function(response){
          
          console.log(response);
          alert("Connection Error.");

        }

        });
      }

          function delete_user(row_id){
            
            var company_id = localStorage.getItem('company_id');

          
            var ans = confirm("Are you sure you want to delete this user?");
            if(!ans){
                return;
            }
            

            $('#row_'+row_id).hide();
            $('#loader_row_'+row_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"modules/delete_module_user",
                data: {"company_id": company_id, "row_id" : row_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+row_id).hide();
                    $('#row_'+row_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+row_id).hide();
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

          
          
        // ess/fetch_ess_profile
          function add_ess_user(){
            var company_id = localStorage.getItem('company_id');
            var module_id = 3;
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
                $('#modal_ess_user').modal('show');

                $('#modal_ess_user').on('hidden.bs.modal', function () {
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

          function list_of_ess_users(){

            var company_id = localStorage.getItem('company_id');
            var module_id = 3; 

            if(page == ""){
              var page = 1;
            }
            var limit = 10;

            $("#loading").show();
            $("#userData").html('');

            $.ajax({
                  
              type: "POST",
              dataType: "json",
              url: api_path+"ess/list_module_users",
              data: { "company_id": company_id, "module_id": module_id, "page": page, "limit": limit},
              timeout: 60000,

              success: function(response) {
                  
                  console.log(response);
                  $('#loading').hide();
                  var strTable = "";
                  
                  if (response.status == '200'){

                      if(response.data.length > 0){



                        $('#user_count').html('Users ('+response.total_rows+')');

                          var k = 1;
                          $.each(response['data'], function (i, v) {
                             

                              function status(string) {
                                  return string.charAt(0).toUpperCase() + string.slice(1);
                              }
                              
                              
                              if(response['data'][i]['is_mod_admin'] == "yes"){

                                strTable += '<tr>';
                                strTable += '<td valign="top">'+k+'</td>';
                                strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+window.location.origin+'/files/images/employee_images/sml_'+response['data'][i]['pics']+'" alt="..." width="50"></div></td>';
                                strTable += '<td valign="top">'+response['data'][i]['lastname']+ ' ' +response['data'][i]['firstname']+'</td>';
                                strTable += '<td valign="top">'+response['data'][i]['email']+'</td>';

                                if(response['data'][i]['connect_status'] == "Connected"){

                                  strTable += '<td valign="top"><span class="label label-success connect" id="user_'+response['data'][i]['user_id']+'" style="cursor: pointer">Connected</span>'; 

                                  strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader_'+response['data'][i]['user_id']+'"></i></td>';

                                }else if(response['data'][i]['connect_status'] == "Not connected"){

                                  strTable += '<td valign="top"><span class="label label-danger connect" id="user_'+response['data'][i]['user_id']+'" style="cursor: pointer">Not Connected</span>';

                                  strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader_'+response['data'][i]['user_id']+'"></i></td>';

                                }

                                strTable +=  '<td valign="top"><a href="'+base_url+'user_logs?id='+response['data'][i]['user_id']+'"><i  class="fa fa-clock-o"  data-toggle="tooltip" data-placement="top" style="color: #000; font-size: 20px;" title="User Logs"></i></a></td>';
                                
                                strTable += '</tr>';


                              }else if(response['data'][i]['is_mod_admin'] == "no"){

                                strTable += '<tr id="row_'+response['data'][i]['row_id']+'">';
                                strTable += '<td valign="top">'+k+'</td>';
                                strTable += '<td width="8%" valign="top"><div class="profile_pic"><img src="'+window.location.origin+'/files/images/employee_images/sml_'+response['data'][i]['pics']+'" alt="..." width="50"></div></td>';
                                strTable += '<td valign="top">'+response['data'][i]['lastname']+ ' ' +response['data'][i]['firstname']+'</td>';
                                strTable += '<td valign="top">'+response['data'][i]['email']+'</td>';

                                if(response['data'][i]['connect_status'] == "Connected"){

                                  strTable += '<td valign="top"><span class="label label-success connect" id="user_'+response['data'][i]['user_id']+'" style="cursor: pointer">Connected</span>'; 

                                  strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader_'+response['data'][i]['user_id']+'"></i></td>';

                                }else if(response['data'][i]['connect_status'] == "Not connected"){

                                  strTable += '<td valign="top"><span class="label label-danger connect" id="user_'+response['data'][i]['user_id']+'" style="cursor: pointer">Not Connected</span>';

                                  strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader_'+response['data'][i]['user_id']+'"></i></td>';

                                }
                                
                                

                                strTable +=  '<td valign="top"><a href="'+base_url+'user_logs?id='+response['data'][i]['user_id']+'"><i  class="fa fa-clock-o"  data-toggle="tooltip" data-placement="top" style="color: #000; font-size: 20px;" title="User Logs"></i></a>&nbsp;&nbsp;';

                                // strTable += '<a href="'+base_url+'user_permissions?id='+response['data'][i]['user_id']+'"><i  class="fa fa-lock"  data-toggle="tooltip" data-placement="top" title="User Permissions" style="font-size : 24px; cursor : pointer;"></i></a>&nbsp;&nbsp;';
                                
                                strTable += '<a class="delete_user  btn btn-danger btn-xs" style="cursor: pointer;" id="usr_'+response['data'][i]['row_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" title="Delete User"></i> Delete</a></td>'; 
                                
                                strTable += '</tr>';



                                strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['row_id']+'">';
                                strTable += '<td colspan="6"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                                strTable +=  '</td>';
                                strTable += '</tr>';

                              }
                              


                              k++;
                               
                          });

                      }else{

                          strTable = '<tr><td colspan="6">No record.</td></tr>';

                      }

                      $('#pagination').twbsPagination({
                          totalPages: Math.ceil(response.total_rows/limit),
                          visiblePages: 10,
                          onPageClick: function (event, page) {
                             list_of_warehouse_users(page);
                          }
                      });
                     
                                 
                      $("#userData").html(strTable);
                      $("#userData").show();

                  }else if(response.status == '400'){
                      
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="6">No result</td>';
                      strTable += '</tr>';

                      
                      $("#userData").html(strTable);
                      $("#userData").show();
                      

                  }else if(response.status == "401"){
                      //missing parameters
                      var strTable = "";
                      $('#loading').hide();
                      strTable += '<tr>';
                      strTable += '<td colspan="6">'+response.msg+'</td>';
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
                strTable += '<td colspan="6"><strong class="text-danger">Connection error!</strong></td>';
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