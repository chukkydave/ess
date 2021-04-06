<?php
include("_common/header.php");
?>     
      <div id="page_loader" style="display: none;">

          <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <i class="fa fa-spinner fa-spin fa-fw fa-4x"  ></i>
              </div>
            </div>
          </div>
        </div>   
      </div>

        <!-- page content -->
        <div id="employee_details_display" style="display: ;">
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3 id="profile_name">Work Profile</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group" style="float: right" id="button_link">
                    
                    
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Personal Profile <!-- <small>Activity report</small> --></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-4 col-sm-4 col-xs-12 profile_left">
                      <div class="profile_img" id="picture">
                        
                      </div>
                      <!-- <h3>Samuel Doe</h3> -->
                      <br>
                      <ul class="list-unstyled user_data" id="profile_links">
                        
                      </ul>

                      <!-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> -->
                      <br />

                      

                    </div>


                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <div class="row">
                        <h3>Biography</h3>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                          <p><strong>Firstname</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <p id="firstname"></p>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                          <p><strong>Lastname</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <p id="lastname"></p>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                          <p><strong>Middlename</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <p id="middlename"></p>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                          <p><strong>Gender</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <p id="gender"></p>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                          <p><strong>Date of Birth</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <p id="dob"></p>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                          <p><strong>Marital Status</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <p id="marital_status"></p>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                          <p><strong>Religion</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <p id="religion"></p>
                        </div>
                      </div>
                      
  
                    <br><br>
                    <!-- <div class="col-md-9 col-sm-9 col-xs-12"> -->

                      <div class="row">
                        <h3>Contact Details</h3>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                          <p><strong>Phone</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <p id="phone"></p>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                          <p><strong>Address</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <p id="residential_address"></p>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                          <p><strong>Email</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <p id="email"></p>
                        </div>
                      </div>


                      <br><br>
                    <!-- <div class="col-md-9 col-sm-9 col-xs-12"> -->

                      <div class="row">
                        <h3>Next of Kin</h3>
                      </div>

                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <p id="next_of_kin"></p>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <!-- /page content -->

        <div id="employee_error_display" style="display: none;">

          <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="alert alert-danger alert-dimissible fade-in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true"></span>
                  </button>
                  <strong>Connection error</strong>
                </div>
              </div>
            </div>
          </div>
        </div>   
      </div>

      <div id="employee_data_display" style="display: none;">

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
                  <strong>No Employee Info Found</strong>
                </div>
              </div>
            </div>
          </div>
        </div>   
      </div>

        <script type="text/javascript">
          $(document).ready(function(){
            
            fetch_employee_detail();
          })

          function fetch_employee_detail(){
              
              var company_id = localStorage.getItem('company_id');
              // var pathArray = window.location.pathname.split( '/' );
              var email = localStorage.getItem('email'); //pathArray[4].replace(/%20/g,' ');
              var user_id = localStorage.getItem('user_id');
              
              // $('#page_loader').hide();
              $.ajax({
                  
                  type: "POST",
                  dataType: "json",
                  url: api_path+"ess/employee_work_profile",
                  data: {"company_id": company_id, "email": email, "user_id":user_id},
                  timeout: 60000,

                  success: function(response) {
                    console.log(response);
                      // $('#page_loader').hide();
                      // $('#employee_details_display').show();
                      var str = "";
                      var str2 = "";
                      var str3 = "";

                      if (response.status == '200'){

                        var monthNames = [
                          "Jan", "Feb", "Mar",
                          "Apr", "May", "Jun", "Jul",
                          "August", "Sep", "Oct",
                          "Nov", "Dec"
                        ];

                         var d = new Date(response.data.birthday);
                         var monthIndex = d.getMonth();
                         var datestring = d.getDate()  + "/" +  monthNames[monthIndex] + "/" + d.getFullYear();

                        $('#firstname').html(response.data.firstname);
                        $('#lastname').html(response.data.lastname);
                        $('#gender').html(response.data.gender);
                        $('#middlename').html(response.data.middlename);
                        $('#dob').html(datestring);
                        $('#marital_status').html(response.data.status);
                        $('#phone').html(response.data.mobile);
                        $('#residential_address').html(response.data.address);
                        $('#email').html(response.data.email);
                        $('#religion').html(response.data.religion);
                        $('#next_of_kin').html(response.data.nxt_kin);

                        $('#profile_name').html('<b>' +response.data.firstname+' ' +response.data.lastname+ '</b>'); 

                          
                          str3 += '<div id="crop-avatar">';
                            
                          str3 += '<img src="'+site_url+'/files/images/employee_images/mid_'+response.data.picture+'" alt="...">';
                          str3 += '</div>';
                          
                          

                        // $("#button_link").html(str2);
                        $("#picture").html(str3);
                        // $("#profile_links").html(str);
                        // $("#profile_links").show();            

                      }else if(response.status == '400'){
                        $('#page_loader').hide();
                          $('#employee_details_display').hide();
                          $('#employee_data_display').show();
                      }    
                      
                  },
                  // objAJAXRequest, strError
                  error: function(response){
                    $('#page_loader').hide();
                      $('#employee_details_display').hide();
                      $('#employee_error_display').show();
                      
                  }        

              });
          }
          
        </script>
<?php
include("_common/footer.php");
?> 