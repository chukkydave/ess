<?php
include("_common/header.php");
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Attendance</h3>
              </div>

              <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right">

                    <!-- button type="button" class="btn btn-primary" id="filter_attendence">Filter</button>
                    
                    <button type="button" class="btn btn-success" id="add_attendence">Add</button>
                    
                    <button type="button" class="btn btn-success" id="upload_attendence">Upload</button>
 -->
                    
                  </div>
                </div>
              </div>

            </div>


            <div id="upload_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dot">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <p class="col-md-7 col-xs-12"><span>*</span>Upload a CSV file</p>
                          <!-- <input type="file" id="dot" required="required" class="form-control col-md-7 col-xs-12 required"> -->
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dot">Choose File <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="dot" required="required" class="form-control col-md-7 col-xs-12 required">
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
                          <button type="button" class="btn btn-success" id="add_terminate">Upload</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="termination_loader"></i>
                        </div>
                      </div>

                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>


            <div id="add_attendence_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_id">Employee <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 required" id="employee_id" name="employee_id">
                            <option value="">-- Select --</option>
                            
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="date" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clock_in">Clock In Time <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="clock_in" required="required" class="form-control col-md-7 col-xs-12 required">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clock_out">Clock Out Time
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="clock_out" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error_att">
                          
                        </div>
                      </div>
                          
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="button" class="btn btn-success" id="add">Add</button>
                          <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="attendance_loader"></i>
                        </div>
                      </div>

                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

            <div id="filter_attendence_display" style="display: none;">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />
                    

                    <div class="form-row">
                      
                      <div class="col-sm-4 col-xs-4">
                        <select class="form-control col-md-7 col-xs-12 required" id="employee_name">
                            <option value="">-- Select Employee--</option>
                            
                          </select>
                      </div>
                    

                      <div class="col-sm-4 col-xs-4">
                        <input type="text" class="form-control" placeholder="Date Range" id="date_range">
                      </div>

                      

                      <button type="button" class="btn btn-success" id="filter">Search</button>
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
                            <th class="column-title">Date</th>
                            <!-- <th class="column-title">Employee</th> -->
                            <th class="column-title">Clock In Time</th>
                            <th class="column-title">Clock Out Time</th>
                            <th class="column-title">Work Hours</th>
                            
                          </tr>
                        </thead>
                        
                        <tr id="loading">
                            <td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"></i></td>
                          </tr>
                        <tbody id="attendanceData">
                          

                          <!-- <tr>
                            <td colspan="7">No record.</td>
                          </tr> -->   
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
        <div class="modal fade" id="modal_attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h4>Employee Attendance Added Successfully!</h4>
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

            list_of_timesheet('');
            

          })


           

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

          

          function list_of_timesheet(page){
            var company_id = localStorage.getItem('company_id');
            var employee_id = localStorage.getItem('user_id');
             if(page == ""){
                var page = 1;
              }
              var limit = 10;


            $("#loading").show();
            $("#attendanceData").html('');

            $.ajax({
                
                type: "POST",
                dataType: "json",
                url: api_path+"ess/single_employee_attendances",
                data: { "company_id": company_id, "page": page, "limit": limit, "employee_id": employee_id },
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

                             var d = new Date(response['data'][i]['date']);
                             var clock_in = new Date(response['data'][i]['clock_in']);
                             var clock_out = new Date(response['data'][i]['clock_out']);
                             var monthIndex = d.getMonth();
                             var start = d.getDate()  + "/" +  monthNames[monthIndex] + "/" + d.getFullYear();

                             
                              
                             function formatAMPM(date) {

                               var hours = date.getHours();
                               var minutes = date.getMinutes();
                               var ampm = hours >= 12 ? 'pm' : 'am';
                               hours = hours % 12;
                               hours = hours ? hours : 12; // the hour '0' should be '12'
                               minutes = minutes < 10 ? '0'+minutes : minutes;
                               var strTime = hours + ':' + minutes + ' ' + ampm;
                               return strTime;

                             }

                              strTable += '<tr>';
                              strTable += '<td>'+k+'</td>';
                              strTable += '<td>'+start+'</td>';
                              strTable += '<td>'+response['data'][i]['clock_in']+'</td>';
                              strTable += '<td>'+response['data'][i]['clock_out']+'</td>';
                              strTable += '<td>'+response['data'][i]['work_hours']+'hrs'+'</td>';
                              

                              strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_'+response['data'][i]['id']+'"></i>&nbsp;&nbsp;';


                              strTable += '<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader12_'+response['data'][i]['id']+'"></i>&nbsp;&nbsp;'; 
                    
                              
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
                              list_of_leaves(page);
                            }
                        });

                                   
                        $("#attendanceData").html(strTable);
                        $("#attendanceData").show();

                    }else if(response.data <= 0){
                      $('#loading').hide();
                      
                      strTable = '<tr><td colspan="5">'+response.msg+'</td></tr>';

                      $("#attendanceData").html(strTable);
                      $("#attendanceData").show();

                    }else if(response.status == '400'){
                        var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="5">'+response.msg+'</td>';
                        strTable += '</tr>';

                        
                        $("#attendanceData").html(strTable);
                        $("#attendanceData").show();
                        

                    }    
                
                },

                error: function(response){
                     var strTable = "";
                        $('#loading').hide();
                        // alert(response.msg);
                        strTable += '<tr>';
                        strTable += '<td colspan="6"><strong class="text-danger">Connection error</strong></td>';
                        strTable += '</tr>';

                        
                        $("#attendanceData").html(strTable);
                        $("#attendanceData").show();

                }        

            });
          }
        </script>

<?php
include("_common/footer.php");
?>