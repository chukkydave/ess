<?php
include("_common/header.php");
?> 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Resignation </h3>
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
                    
                    <button type="button" class="btn btn-success" id="add_resignation">Apply</button>
                    
                    
                  </div>
                </div>
              </div>
            </div>

            <div id="resignation_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                     <!--  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_id">Employee id<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 required" id="sel_employee" name="sel_employee">
                            <option>-- Select --</option>
                            
                          </select>
                        </div>
                      </div> -->

                     <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notified">Notified Date<span>*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                               <input type="text" id="notified" required="required" class="form-control col-md-7 col-xs-12 required">
                            </div>
                          </div>
                        </div>


                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastday">Last day<span>*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                               <input type="text" id="lastday" required="required" class="form-control col-md-7 col-xs-12 required">
                            </div>
                          </div>
                        </div>


                      <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_id">Company id<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 required" id="sel_employee" name="sel_employee">
                            <option>-- Select --</option>
                            
                          </select>
                        </div>
                      </div> -->


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reason">Reason<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea cols="3" class="form-control col-md-7 col-xs-12 required" id="reason">
                            
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
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="button" class="btn btn-success" id="add_r">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="loader_r"></i>
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
                            
                            <th class="column-title">ID</th>
                            <th class="column-title">Name </th>
                            <th class="column-title">Reason </th>
                            <th class="column-title">Inserted By </th>
                            <th class="column-title">Inserted</th>
                            <th class="column-title">Termination Date</th>
                            <th class="column-title">Approvals</th>
                            
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="8">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        
                          <tr id="loading">
                            <td colspan="8"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" ></i></td>
                          </tr>
                        <tbody id="resignationData">
                        
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

         <div class="modal fade" id="modal_view_resignation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
               <div class="modal-header ">
                 <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Resignation Info
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
                 </h3>
                 
               </div>
               <div class="modal-body">

                 
                   <div id="container4" >
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
                         <p><strong>Notice Date:</strong></p>
                       </div>

                       <div class="col-md-6 col-sm-6 col-xs-6">
                         <p id="notice_date"></p>
                       </div>
                     </div>

                     <div class="row">
                       <div class="col-md-6 col-sm-6 col-xs-6">
                         <p><strong>Termination Date:</strong></p>
                       </div>

                       <div class="col-md-6 col-sm-6 col-xs-6">
                         <p id="terminate_date"></p>
                       </div>
                     </div>

                     <div class="row">
                       <div class="col-md-6 col-sm-6 col-xs-6">
                         <p><strong>Approved:</strong></p>
                       </div>

                       <div class="col-md-6 col-sm-6 col-xs-6">
                         <p id="approve"></p>
                       </div>
                     </div>

                     <div class="row">
                       <div class="col-md-6 col-sm-6 col-xs-6">
                         <p><strong>Reason:</strong></p>
                       </div>

                       <div class="col-md-6 col-sm-6 col-xs-6">
                         <p id="reason"></p>
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

         <!-- modal -->
        <div class="modal fade" id="modal_resignation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Resignation Added Successfully!</h4>
              </div>
              <!-- <div class="modal-footer"> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              <!-- </div> -->
            </div>
          </div>
        </div>

        <div class="modal fade" id="modal_edit_resign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header ">
                  <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Resignation
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </h3>
                  
                </div>
                <div class="modal-body">
                  <div id="edit_form">
                  <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notice_date">Notified Date<span>*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="notice_date" class="form-control col-md-7 col-xs-12 required1">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_day">Last Day<span>*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="last_day" class="form-control col-md-7 col-xs-12 required1">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comment1">Reason<span>*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea cols="3" class="form-control col-md-7 col-xs-12" id="comment1">
                          
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
                        <button type="submit" class="btn btn-success" id="edit_resign">Update</button>
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_resign_loader"></i>
                        <!-- <div id="add_user_loading" style="display:  none">Loading...</div> -->
                      </div>
                    </div>

                  </span>
                </div>

                <div id="edit_msg" style="display: none;">
                  <h4>Resignation Updated Successfully!</h4>
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
            var resign_id;
            list_of_resignations('');
            $('#add_r').on('click', add_employee_resignation);
            $('#add_resignation').on('click', resignation);

            $('input#notified').datepicker({
              dateFormat: "yy-mm-dd"
            });

            $('input#lastday').datepicker({
              dateFormat: "yy-mm-dd"
            });

            $('input#notice_date').datepicker({
              dateFormat: "yy-mm-dd"
            });

            $('input#last_day').datepicker({
              dateFormat: "yy-mm-dd"
            });


            $(document).on('click', '.edit_resign_icon', function(){
              resign_id = $(this).attr('id').replace(/res_/,''); 
              fetch_resign_details(resign_id);
              
            });

            // $(document).on('click', '#edit_resin', function(){
            //   edit_employee_resignation(resign_id);
            // });
        
            // $('#add_terminate').on('click', add_company_resignation);  

            // $(document).on('click', '.delete_resignation', function(){
            //     var resignation_id = $(this).attr('id').replace(/ter_/,''); // table row ID 
            //     delete_resignation(resignation_id);
            // });

            $(document).on('click', '.resign_info', function(){
                resign_id = $(this).attr('id').replace(/rs_/,''); 
                fetch_resignation_info(resign_id);
                
              });
                      
          })


          function fetch_resign_details(resign_id){
             
            var company_id = localStorage.getItem('company_id');
            //var employee_id = localStorage.getItem('user_id');

            $('#res_'+resign_id).hide();
            $('#loader12_'+resign_id).show();
             
          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"ess/view_resignation",
            data: { "resign_id" : resign_id, "company_id" : company_id},

            success: function(response) {

              var str = "";
              console.log(response);

              $("#modal_edit_resign #error").html("");

               $("#modal_edit_resign .required").each(function(){

                 var the_val = $.trim($(this).val());

                 $(this).removeClass("has-error");

               });
          
                
              $('#loader12_'+resign_id).hide();
              $('#res_'+resign_id).show();

              if (response.status == '200') {

                var monthNames = [
                  "Jan", "Feb", "Mar",
                  "Apr", "May", "Jun", "Jul",
                  "August", "Sep", "Oct",
                  "Nov", "Dec"
                ];

                 var d = new Date(response.data.notice_date);
                 var monthIndex = d.getMonth();
                 var datestring12 = d.getDate()  + "/" +  monthNames[monthIndex] + "/" + d.getFullYear();

                 var s = new Date(response.data.termination_date);
                 var month = s.getMonth();
                 var datestring = s.getDate()  + "/" +  monthNames[month] + "/" + s.getFullYear();


                $("#modal_edit_resign #notice_date").val(datestring12);
                $("#modal_edit_resign #last_day").val(datestring);
                $("#modal_edit_resign #comment1").val( response.data.reason);


                
                $('#modal_edit_resign').modal('show');          
              }


            },

            error: function(response){
              $('#loader12_'+resign_id).hide();
              $('#res_'+resign_id).show();
              alert("Connection Error.");

            }

            });
          }

          function fetch_resignation_info(resign_id){
             
            var company_id = localStorage.getItem('company_id');
            // var employee_id = localStorage.getItem('email');

            $('#rs_'+resign_id).hide();
            $('#loader11_'+resign_id).show();
             
          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"ess/view_resignation",
            data: {"company_id" : company_id, "resign_id" : resign_id},

            success: function(response) {

              console.log(response);
          
                
              $('#loader11_'+resign_id).hide();
              $('#rs_'+resign_id).show();

              if (response.status == '200') {

                var monthNames = [
                  "Jan", "Feb", "Mar",
                  "Apr", "May", "Jun", "Jul",
                  "August", "Sep", "Oct",
                  "Nov", "Dec"
                ];

                 var d = new Date(response.data.notice_date);
                 var monthIndex = d.getMonth();
                 var datestring12 = d.getDate()  + "/" +  monthNames[monthIndex] + "/" + d.getFullYear();

                 var s = new Date(response.data.termination_date);
                 var month = s.getMonth();
                 var datestring = s.getDate()  + "/" +  monthNames[month] + "/" + s.getFullYear();

                $("#modal_view_resignation #name").html( response.data.name); 

                if(response.data.notice_date == "0000-00-00 00:00:00"){

                  $("#modal_view_resignation #notice_date").html("");

                }else{

                  $("#modal_view_resignation #notice_date").html( datestring12);
                }

                if(response.data.termination_date == "0000-00-00 00:00:00"){

                  $("#modal_view_resignation #terminate_date").html("");

                }else{
                  
                  $("#modal_view_resignation #terminate_date").html( datestring);
                }
                
                
                $("#modal_view_resignation #approve").html( response.data.approval);
                $("#modal_view_resignation #reason").html( response.data.reason);


                
                $('#modal_view_resignation').modal('show');          
              }


            },

            error: function(response){
              $('#loader11_'+resign_id).hide();
              $('#rs_'+resign_id).show();
              alert("Connection Error.");

            }

            });
          }

          function list_of_resignations(page){
            var company_id = localStorage.getItem('company_id');
            var email = localStorage.getItem('email');
            if(page == ""){
                var page = 1;
              }
              var limit = 5;


            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"ess/employee_resign_list",
                data: { "company_id": company_id, "page": page, "limit": limit, "email" : email},
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

                                 var d = new Date(response['data'][i]['insert']);
                                 var td = new Date(response['data'][i]['termination_date']);
                                 
                                 var monthIndex = d.getMonth();
                                 var insert = d.getDate()  + "/" +  monthNames[monthIndex] + "/" + d.getFullYear();

                                 var monthIndex1 = td.getMonth();
                                 var terminate = td.getDate()  + "/" +  monthNames[monthIndex1] + "/" + td.getFullYear();

                                strTable += '<tr id="row_'+response['data'][i]['id']+'">';
                                strTable += '<td valign="top">'+response['data'][i]['id']+'</td>';
                                
                                strTable += '<td width="20%" valign="top"><b>'+response['data'][i]['fullname']+'</td>';
                                strTable += '<td valign="top">'+response['data'][i]['reason']+'</td>';
                                strTable += '<td valign="top">'+response['data'][i]['insertby']+'</td>';

                                if(response['data'][i]['insert'] == "0000-00-00 00:00:00"){

                                  strTable += '<td valign="top">&nbsp;</td>';

                                }else{

                                  strTable += '<td valign="top">'+insert+'</td>';
                                }
                                
                                if(response['data'][i]['termination_date'] == "0000-00-00 00:00:00"){

                                  strTable += '<td valign="top">&nbsp;</td>';

                                }else{

                                  strTable += '<td valign="top">'+terminate+'</td>';
                                }

                                
                                strTable += '<td valign="top">'+response['data'][i]['approve']+'</td>';

                                strTable += '<td valign="top"><a class="resign_info btn btn-primary btn-xs"  id="rs_'+response['data'][i]['id']+'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title="View Resignation info"></i> View</a>';

                                strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_'+response['data'][i]['id']+'"></i>&nbsp;&nbsp;';


                                strTable += '<a class="edit_resign_icon btn btn-info btn-xs"id="res_'+response['data'][i]['id']+'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" title="Edit Resignation"></i> Edit</a>&nbsp;&nbsp;';

                                strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader12_'+response['data'][i]['id']+'"></i>&nbsp;&nbsp;'; 

                                strTable +=  '<a class="delete_resign btn btn-danger btn-xs" style="cursor: pointer;" id="resg_'+response['data'][i]['id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" title="Delete Resignation"></i> Delete</a></td>';


                                // strTable += '<td valign="top">'+response['data'][i]['total_pending_resignation_approvals']+"/"+response['data'][i]['total_resignation_sent_for_approvals']+'</td>';
                                // strTable += '<td valign="top"><a href="'+base_url+'view_employee_resignation_details?id='+response['data'][i]['resignation_id']+'"><i  class="fa fa-list"  data-toggle="tooltip" data-placement="top" style=" color: gray; font-size: 20px;" title="View Employee Leave Details"></i></a> &nbsp;&nbsp;<a  class="delete_resignation" style="cursor: pointer;" id="ter_'+response['data'][i]['resignation_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Employee Termination"></i></a></td>';
                                strTable += '</tr>';

                                strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['id']+'">';
                                strTable += '<td colspan="8"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
                                strTable +=  '</td>';
                                strTable += '</tr>';


                                k++;
                                 
                            });

                            // <a href="'+base_url+'/erp/hrm/employee_info"><i  class="fa fa-info-circle"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #add8e6; font-size: 20px;" title="View Employee info"></i></a> &nbsp;&nbsp;<a href="'+base_url+'/erp/hrm/edit_employee"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" style="font-style: italic; font-size: 20px;" title="Edit Employee"></i></a>&nbsp;&nbsp; 

                        }else{

                            strTable = '<tr><td colspan="8">No result</td></tr>';

                        }

                        // alert(response.total_rows);
                        // alert(limit);

                        $('#pagination').twbsPagination({
                          totalPages: Math.ceil(response.total_rows/limit),
                          visiblePages: 10,
                          onPageClick: function (event, page) {
                            list_of_resignations(page);
                          }
                        });
                        
                                  
                        $("#resignationData").html(strTable);
                        $("#resignationData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="8">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#resignationData").html(strTable);
                        $("#resignationData").show();
                        

                    }    
                
                },

                error: function(response){
                   var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="8"><strong class="text-danger">Connection error</strong></td>';
                        strTable += '</tr>';

                        
                        $("#resignationData").html(strTable);
                        $("#resignationData").show();
                }        

            });
          }

           function add_employee_resignation(){
            var email = localStorage.getItem('email');
            var company_id = localStorage.getItem('company_id');
            var lastday = $('#notified').val();
            var notified = $('#notified').val();
            var reason = $.trim($('#reason').val());

            // alert(employee_id);
            var blank;

            


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
    
              $('#error').html("You have a blank field");

              return; 

            }
         
          
          $('#add_r').hide();
          $('#loader_r').show();



          $.ajax({

            type: "POST",
            dataType: "json",
            cache: false,
            url: api_path+"ess/self_resign",
            data: { "email" : email, "company_id" : company_id, "notified" : notified, "lastday" : lastday, "reason" : reason},

            success: function(response) {

              // console.log(response);

              if (response.status == '200') {


                $('#modal_resignation').modal('show');

                $('#modal_resignation').on('hidden.bs.modal', function () {
                    // do something…
                    window.location.reload();
                    //window.location.href = base_url+"/erp/hrm/employees";
                })
                
                
              }else if(response.status == '400'){ // coder error message

                
                $('#error').html('Technical Error. Please try again later.');

              }else if(response.status == '401'){ //user error message

                
                $('#error').html("No result");

              }

               
              $('#add_r').show();
              $('#loader_r').hide();

            },

            error: function(response){

              $('#add_r').show();
              $('#loader_r').hide();
              $('#error').html("Connection Error.");

            }

          });

          }

          function delete_resignation(resignation_id) {
             // alert('user deleted');
            // var email = $.session.get('email'); 
            var company_id = localStorage.getItem('company_id');
            // alert(employee_id);
            

            var ans = confirm("Are you sure you want to delete this user");
            if(!ans){
                return;
            }
            

            $('#row_'+resignation_id).hide();
            $('#loader_row_'+resignation_id).show();
            $.ajax({ 
                type: "POST",
                dataType: "json",
                url: api_path+"hrm/delete_employee_resignation",
                data: {"company_id": company_id, "resignation_id" : resignation_id},
                timeout: 60000, // sets timeout to one minute
                // objAJAXRequest, strError

                error: function(response){
                    $('#loader_row_'+resignation_id).hide();
                    $('#row_'+resignation_id).show();

                    alert('connection error');
                },

                success: function(response) {  
                    // console.log(response);
                    if(response.status == '200'){
                        // $('#row_'+user_id).hide();

         
                    }else if(response.status == '401'){
                            
                                
                    }

                    $('#loader_row_'+resignation_id).hide();
                }
            });
          }

          function resignation(){
            $('#resignation_display').toggle();
            $('#notified').val('');
            $('#lastday').val('');
            $('#reason').val('');
            $('#error').html('');

            $(".required").each(function(){

              var the_val = $.trim($(this).val());

              $(this).removeClass("has-error");

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
                    // console.log(response);
                    
                    var options = '';

                    $.each(response['data'], function (i, v) {
                        options += '<option value="'+ response['data'][i]['employee_id'] +'">' + response['data'][i]['firstname'] + " " + response['data'][i]['lastname'] + '</option>';
                    });
                    $('#sel_employee').append(options);
                },
                // jqXHR, textStatus, errorThrown
                error(response) {
                    // alert('Connection error');
                }
            });

          }

        
         
        </script>
<?php
include("_common/footer.php");
?>         