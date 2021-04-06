<?php
include("_common/header.php");
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Grievance Request</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">
                    <!-- <button type="button" class="btn btn-default" id="incoming_filter">Filter</button> -->
                    <button type="button" class="btn btn-success" id="apply">Add</button>
                    
                  </div>
                </div>
              </div>
            </div>

            <div id="apply_display" style="display: none;">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    
                    <div class="x_content">
                      <br />
                      <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="g_type">Grievance Type <span>*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12 required1" id="g_type">
                              <option value="">-- Select --</option>
                              <option value="misconduct">Misconduct</option>
                              <option value="assualt">Assualt</option>
                              <option value="molestation">Molestation</option>
                              
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="incident_date">Incident Date <span>*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                               <input type="text" id="incident_date" class="form-control col-md-7 col-xs-12 required1">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="incident">Incident Report<span>*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea cols="3" id="incident" class="form-control col-md-7 col-xs-12 required1">
                              
                            </textarea>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch">Branch <span>*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12 required1" id="branch">
                              <option value="">-- Select --</option>
                              
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="g_against">Grievance Against <span>*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12 required1" id="g_against">
                              <option value="">-- Select --</option>
                              
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emp_response">Response<span>*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea cols="3" id="emp_response" class="form-control col-md-7 col-xs-12 required1">
                              
                            </textarea>
                          </div>
                        </div>

                        
                          
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_g">
                            
                          </div>
                        </div>
                      
                            
                      
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <!-- <button class="btn btn-primary" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button> -->
                            <button type="button" class="btn btn-success" id="add_g">Add</button>
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="loading_g"></i>
                          </div>
                        </div>

                      </span>
                    </div>
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
                        <input type="text"  id="item_name" class="form-control">
                      </div>


                      <div class="col-sm-3 col-xs-4">
                        <label>Vendor Name</label>
                         <input type="text"  id="vendor_name" class="form-control">
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
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            
                            <th class="column-title">Code</th>
                            <th class="column-title">Against</th>
                            <th class="column-title">Complaint</th>
                            <th class="column-title">Disciplinary</th>
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            </th>
                            <th class="bulk-actions" colspan="6">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                          
                        <tbody id="grievanceData">
                          <tr id="loading">
                            <td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;"></i></td>
                          </tr>   
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
        <div class="modal fade" id="modal_g" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Grievance Report Added Successfully!</h4>
              </div>
              <!-- <div class="modal-footer"> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>


      <div class="modal fade" id="modal_edit_g" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Grievance
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>
                
              </div>
              <div class="modal-body">
                <div id="edit_form">
                <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="g_type">Grievance Type
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control col-md-7 col-xs-12 required" id="g_type">
                        <option value="">-- Select --</option>
                        <option value="misconduct">Misconduct</option>
                        <option value="assualt">Assualt</option>
                        <option value="molestation">Molestation</option>
                        
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="incident_date">Incident Date
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="input-prepend input-group">
                          <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                         <input type="text" id="incident_date" class="form-control col-md-7 col-xs-12 required">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="incident">Incident Report
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea cols="3" id="incident" class="form-control col-md-7 col-xs-12">
                        
                      </textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch">Branch
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control col-md-7 col-xs-12 required" id="branch">
                        <option value="">-- Select --</option>
                        
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="g_against">Grievance Against
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control col-md-7 col-xs-12 required" id="g_against">
                        <option value="">-- Select --</option>
                        
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emp_response">Response
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea cols="3" id="emp_response" class="form-control col-md-7 col-xs-12">
                        
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
                      <button type="submit" class="btn btn-success" id="edit_g">Update</button>
                      <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_g_loader"></i>
                    </div>
                  </div>

                </span>
              </div>

              <div id="edit_msg" style="display: none;">
                <h4>Grievance Report Updated Successfully!</h4>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
              </div>

              </div>
              <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div> -->
            </div>
          </div>
        </div>



        <div class="modal fade" id="modal_view_g" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Grievance Info
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </h3>
                
              </div>
              <div class="modal-body">

                
                  <div id="container4" >
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Grievance Type:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="g_type"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Incident Date:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="incident_date"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Report:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="report"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Branch:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="branch"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Approval Status:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="approval"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Response:</strong></p>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="report"></p>
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
       </div> 

        <script type="text/javascript">
          $(document).ready(function(){
            var grievance_id;

            load_employee();
            load_branch();
            list_of_grievances('');
            // load_leave_type();

            $('input#incident_date').datepicker({
              dateFormat: "yy-mm-dd"
            });
            // $('input#resumption_date').datepicker({
            //   dateFormat: "yy-mm-dd"
            // });

            $('#apply').on('click', display_apply);
            $("#add_g").on('click', add_grievance_report);
            // $('#add_leave').on('click', add_employee_leave);
            
            // list_of_leaves('');

            // $(document).on('click', '#filter', function(){
            //     $('#pagination').twbsPagination('destroy');
            //      list_of_incoming_items('');
            // });

            // $('#incoming_filter').on('click', display_filter);

            // $('input#date_range').daterangepicker({
            //   autoUpdateInput: false
            // });

            // $('input#date_range').on('apply.daterangepicker', function(ev, picker) {
            //    $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));

            // });

            $(document).on('click', '.g_info', function(){
                var grievance_id = $(this).attr('id').replace(/gr_/,''); 
                fetch_grievance_info(grievance_id);
                
              });

             $(document).on('click', '.delete_g', function(){
                var grievance_id = $(this).attr('id').replace(/grie_/,''); 
                delete_grievance(grievance_id);
              });

             $(document).on('click', '.edit_g_icon', function(){
               grievance_id = $(this).attr('id').replace(/gri_/,''); 
               fetch_grievance_details(grievance_id);
               
             });

             $(document).on('click', '#edit_g', function(){
               // var warehouse_id = $(this).attr('id').replace(/edt_/,''); 
               edit_employee_grievance(grievance_id);
               alert(grievance_id);
             });


          })

          function load_branch(){

            var company_id = localStorage.getItem('company_id');
          
             $.ajax({
                url: api_path+"hrm/list_of_company_branches",
                type: "POST",
                data: {"company_id" : company_id},
                dataType: "json",
                
                
                success: function (response) {
                                    
                    
                    var options = '';

                    $.each(response['data'], function (i, v) {
                        options += '<option value="'+ response['data'][i]['branch_id'] +'">' + response['data'][i]['branch_name'] +'</option>';

                    });
                    $('#branch').append(options);
                    $('#modal_edit_g #branch').append(options);
                },
                // jqXHR, textStatus, errorThrown
                error(response) {
                    alert('Connection error');
                }
            });

          }

           function load_employee(){

            var company_id = localStorage.getItem('company_id');
            var page = -1;
            var limit = 0;

             $.ajax({
                url: api_path+"hrm/list_of_company_employees",
                type: "POST",
                data: {"company_id" : company_id, "page" : page, "limit" : limit},
                dataType: "json",
                
                
                success: function (response) {
                    console.log(response);
                    
                    var options = '';

                    $.each(response['data'], function (i, v) {
                        options += '<option value="'+ response['data'][i]['employee_id'] +'">' + response['data'][i]['firstname'] + " " + response['data'][i]['lastname'] + '</option>';
                    });

                    $('#g_against').append(options);
                    $('#modal_edit_g #g_against').append(options);
                },
                // jqXHR, textStatus, errorThrown
                error(response) {
                    alert('Connection error');
                }
            });

          }

           


          function edit_employee_grievance(grievance_id){

            var g_type = $("#modal_edit_g #g_type").val();

            var incident_date = $("#modal_edit_g #incident_date").val();
            var emp_response = $("#modal_edit_g #emp_response").val();
            var incident = $("#modal_edit_g #incident").val();                 
            var approval =  $("#modal_edit_g #approval").val();
            var branch =  $("#modal_edit_g #branch").val();
            var against =  $("#modal_edit_g #against").val();
            var company_id = localStorage.getItem('company_id');
            var g_by = localStorage.getItem('email');
            
            
            var blank;

            
            // alert(warehouse_id);

            $("#modal_edit_g .required").each(function(){

              var the_val = $.trim($(this).val());

              if(the_val == "" || the_val == "0"){

                $(this).addClass('has-error');

                blank = "yes";

              }else{

                $(this).removeClass("has-error");

              }

            });

            if(blank == "yes"){
          
              $("#modal_edit_g #error").html("You have a blank field");

              return; 

            }

                        
           // $("#modal_edit_warehouse #error").html("");

          $("#modal_edit_g #edit_g").hide();
          $("#modal_edit_g #edit_g_loader").show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"ess/edit_grievance",
            data: { "g_by" : g_by, "g_against" : g_against, "company_id" : company_id, "grievance_id" : grievance_id, "incident" : incident, "incident_date" : incident_date, "emp_response" : emp_response},

            success: function(response) {

              console.log(response);

              if (response.status == '200') {
                $("#modal_edit_g #error").html("");
                $("#modal_edit_g #edit_g_loader").hide();   
                $("#modal_edit_g #edit_g").show();

                
                $('#modal_edit_g #edit_form').hide();
                $('#modal_edit_g #edit_msg').show();

                // $('#modal_department_edit').on('hidden.bs.modal', function () {
                //     $('#department_name').val();
                //     $('#department_description').val();
                    window.location.reload();
                //     window.location.href = base_url+"/erp/hrm/departments";
                // })
                
                
              }else if(response.status == '400'){ // coder error message

                
                 $("#modal_edit_g #error").html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                 $("#modal_edit_g #error").html(response.msg);

              }

               
           
          


            },

            error: function(response){

                  console.log(response);
                 $("#modal_edit_g #edit_g_loader").hide(); 
                 $("#modal_edit_g #edit_g").show();
                 $("#modal_edit_g #error").html("Connection Error.");

            }

          });

          }


          function fetch_grievance_details(grievance_id){
             
            var company_id = localStorage.getItem('company_id');
      
            $('#gri_'+grievance_id).hide();
            $('#loader12_'+grievance_id).show();
             
          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"ess/view_single_grievance",
            data: { "grievance_id" : grievance_id, "company_id" : company_id},

            success: function(response) {

              var str = "";
              console.log(response);

              $("#modal_edit_g #error").html("");

               $("#modal_edit_g .required").each(function(){

                 var the_val = $.trim($(this).val());

                 $(this).removeClass("has-error");

               });
          
                
              $('#loader12_'+grievance_id).hide();
              $('#gri_'+grievance_id).show();

              if (response.status == '200') {

                $("#modal_edit_g #g_type").val( response.data.gri_type); 
                $("#modal_edit_g #incident_date").val( response.data.incident_date);
                $("#modal_edit_g #incident").val( response.data.incident);
                $("#modal_edit_g #approval").val( response.data.approval);
                $("#modal_edit_g #branch").val( response.data.branch);


                
                $('#modal_edit_g').modal('show');          
              }


            },

            error: function(response){
              $('#loader12_'+grievance_id).hide();
              $('#gri_'+grievance_id).show();
              alert("Connection Error.");

            }

            });
          }

          
           function add_grievance_report(){
            
            var company_id = localStorage.getItem('company_id');
            var g_by = localStorage.getItem('user_id');
            var g_type = $('#g_type').val();
            var incident_date = $("#incident_date").val();                 
            var incident =  $("#incident").val();
            var g_against =  $("#g_against").val();
            var branch =  $("#branch").val();
            var emp_response = $("#emp_response").val();

            
            
            var blank;

            
            // alert(warehouse_id);

            $(".required1").each(function(){

              var the_val = $.trim($(this).val());

              if(the_val == "" || the_val == "0"){

                $(this).addClass('has-error');

                blank = "yes";

              }else{

                $(this).removeClass("has-error");

              }

            });

            if(blank == "yes"){
          
              $("#error_g").html("You have a blank field");

              return; 

            }

            
                        
           // $("#modal_edit_warehouse #error").html("");

          $("#add_g").hide();
          $("#loading_g").show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"ess/report_grievance",
            data: { "g_type" : g_type, "incident_date" : incident_date, "incident" : incident, "company_id" : company_id, "g_by" : g_by, "g_against" : g_against, "branch" : branch, "emp_response" : emp_response},

            success: function(response) {

              console.log(response);

              $("#error_g").html("");
              $("#loading_g").hide();   
              $("#add_g").show();

              if (response.status == '200') {
                
                $('#modal_g').modal('show');

                $('#modal_g').on('hidden.bs.modal', function () {
                    
                    window.location.reload();
                    // window.location.href = base_url+"incoming";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                 $("#error_g").html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                 $("#error_g").html(response.msg);

              }           
          


            },

            error: function(response){

                  console.log(response);
                 $("#loading_g").hide(); 
                 $("#add_g").show();
                 $("#error_g").html("Connection Error.");

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

           function display_apply(){

            $('#apply_display').toggle();
            $('#leave_start').val("");
            $('#resumption_date').val("");
            $('#comment').val(""); 
            $('#leave_type').val(""); 
          }

          function fetch_grievance_info(grievance_id){
             
            var company_id = localStorage.getItem('company_id');

            $('#gr_'+grievance_id).hide();
            $('#loader11_'+grievance_id).show();
             
          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"ess/view_single_grievance",
            data: {"company_id" : company_id, "grievance_id" : grievance_id},

            success: function(response) {

              console.log(response);
        
                
              $('#loader11_'+grievance_id).hide();
              $('#gr_'+grievance_id).show();

              if (response.status == '200') {

                var monthNames = [
                  "Jan", "Feb", "Mar",
                  "Apr", "May", "Jun", "Jul",
                  "August", "Sep", "Oct",
                  "Nov", "Dec"
                ];

                 
                 var s = new Date(response.data.incident_date);
                 var month = s.getMonth();
                 var datestring = s.getDate()  + "/" +  monthNames[month] + "/" + s.getFullYear();

                $("#modal_view_g #g_type").html( response.data.gri_type); 
                $("#modal_view_g #incident_date").html(datestring);
                $("#modal_view_g #approval").html();
                $("#modal_view_g #report").html( response.data.incident);
                $("#modal_view_g #response").html();
                $("#modal_view_g #branch").html();


                $('#modal_view_g').modal('show');          
              }


            },

            error: function(response){
              $('#loader11_'+grievance_id).hide();
              $('#gr_'+grievance_id).show();
              alert("Connection Error.");

            }

            });
          }

          function delete_grievance(grievance_id){
            
            var company_id = localStorage.getItem('company_id');
            var g_by = localStorage.getItem('user_id');

          
            var ans = confirm("Are you sure you want to delete this report?");
            if(!ans){
                return;
            }
            

            $('#row_'+grievance_id).hide();
            $('#loader_row_'+grievance_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"ess/delete_grievance",
                data: {"company_id": company_id, "g_by": g_by, "grievance_id" : grievance_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+grievance_id).hide();
                    $('#row_'+grievance_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+grievance_id).hide();
                }
            });
        }

          function list_of_grievances(page){
            var company_id = localStorage.getItem('company_id');
            var user_id = localStorage.getItem('user_id');
             if(page == ""){
                var page = 1;
              }
              var limit = 10;


            $("#loading").show();
            $("#grievanceData").html('');

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"ess/all_reported_grievance",
                data: { "company_id": company_id, "page": page, "limit": limit, "user_id": user_id },
                timeout: 60000,

                success: function(response) {
                    console.log(response);

                    var strTable = "";
                    
                    if (response.status == '200'){
                        $('#loading').hide();
                        if(response.data.length > 0){

                            var k = 1;
                            $.each(response['data'], function (i, v) {

                            

                              strTable += '<tr id="row_'+response['data'][i]['id']+'">';
                              strTable += '<td>'+response['data'][i]['code']+'</td>';
                              strTable += '<td>'+response['data'][i]['against']+'</td>';
                              strTable += '<td>'+response['data'][i]['complaint']+'</td>';
                              strTable += '<td>'+response['data'][i]['disciplinary']+'</td>';
                              
                              
                              strTable += '<td valign="top"><a class="g_info btn btn-primary btn-xs"  id="gr_'+response['data'][i]['id']+'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title="View Grievance info"></i> View</a>';

                              strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_'+response['data'][i]['id']+'"></i>&nbsp;&nbsp;';


                              strTable += '<a class="edit_g_icon btn btn-info btn-xs"id="gri_'+response['data'][i]['id']+'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" title="Edit Grievance"></i> Edit</a>&nbsp;&nbsp;';

                              strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader12_'+response['data'][i]['id']+'"></i>&nbsp;&nbsp;'; 

                              strTable +=  '<a class="delete_g btn btn-danger btn-xs" style="cursor: pointer;" id="grie_'+response['data'][i]['id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" title="Delete Grievance"></i> Delete</a></td>';
                              
                              strTable += '</tr>';  

                              strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['id']+'">';
                              strTable += '<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                              strTable +=  '</td>';
                              strTable += '</tr>';

                                


                                k++;
                                 
                            });

                            
                        }else{

                            strTable = '<tr><td colspan="5">'+response.msg+'</td></tr>';

                        }
                        
                        $('#pagination').twbsPagination({
                            totalPages: Math.ceil(response.total_rows/limit),
                            visiblePages: 10,
                            onPageClick: function (event, page) {
                              list_of_grievances(page);
                            }
                        });

                                   
                        $("#grievanceData").html(strTable);
                        $("#grievanceData").show();

                    }else if(response.data <= 0){
                      $('#loading').hide();
                      
                      strTable = '<tr><td colspan="5">'+response.msg+'</td></tr>';

                      $("#grievanceData").html(strTable);
                      $("#grievanceData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="5">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#grievanceData").html(strTable);
                        $("#grievanceData").show();
                        

                    }    
                
                },

                error: function(response){
                     var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="5"><strong class="text-danger">Connection error</strong></td>';
                        strTable += '</tr>';

                        
                        $("#grievanceData").html(strTable);
                        $("#grievanceData").show();

                }        

            });
          }
        </script>



<?php
include("_common/footer.php");
?>      