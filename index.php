<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css">


<div class="right_col" role="main" id="main_display_loader_page" style="display: ;">

    <div class="page-title">
        <!-- <div class="title_left"> -->
        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ; margin-top: 20px;" id="ldnuy"></i>
        <div id="loader_mssg" style="display:none;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br>
                        <div class="bs-example" data-example-id="simple-jumbotron">
                            <div class="jumbotron">
                                <div style="font-size: 30px; font-weight: bold">Hello, <span
                                        class="hi_user_name">newyear</span>!</div>
                                <p>Welcome to NaHere Human Resource Management Software (HRM).
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            </div>
        </div>
    </div>



</div>
<!-- /loader page content -->
<!-- page content -->
<div class="right_col" role="main" id="main_display" style="display: none;">
    <div class="">


        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <!-- <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div> -->
                </div>
            </div>
        </div>

        <div class="clearfix"></div>


        <div class="row top_tiles">

            <a href="approvals">
                <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-file"></i></div>
                        <div class="count" id="pnd_appv">
                            <i class="fa fa-spinner fa-spin fa-fw" style="display: "></i>
                        </div>
                        <h3>Approvals</h3>
                        <p>Pending Approval Request</p>
                    </div>
                </div>
            </a>

            <a href="leaves">
                <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-exclamation-triangle"></i></div>
                        <div class="count" id="low_itms">
                            <i class="fa fa-spinner fa-spin fa-fw" style="display: "></i>
                        </div>
                        <h3>My Leaves</h3>
                        <p>My Pending Leave Requests</p>
                    </div>
                </div>
            </a>
            <!-- <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-long-arrow-up"></i></div>
                  <div class="count">₦50,320</div>
                  <h3>Bills</h3>
                  <p>Pending.</p>
                </div>
              </div> -->
            <!-- <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-line-chart"></i></div>
                    <div class="count" id="kpi_rcdd">
                        <i class="fa fa-spinner fa-spin fa-fw" style="display: "></i>
                    </div>
                    <h3>KPI</h3>
                    <p>Performance</p>
                </div>
            </div> -->
        </div>




        <div class="row">



            <div class="col-md-4 col-sm-4 col-xs-12">

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Notice Board</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <!-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li> -->
                            <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li> -->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="height:350px;">

                        <div>
                            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                id="notice_board_loading"></i>
                            <ul class="list-unstyled timeline" id="notice_board">

                            </ul>
                        </div>

                    </div>
                </div>
            </div>




            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Calendar</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <!-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li> -->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="height:350px !important;">

                        <div id="calendarly"></div>

                    </div>
                </div>
            </div>





        </div>

        <!-- <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Transaction Summary</h2>
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

                    <div id="echart_line" style="height:350px;"></div>

                  </div>
                </div>
              </div>
              </div> -->

        <div class="row">

            <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Gender</h2>
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

                      <div id="echart_pie2" style="height:350px;"></div>

                    </div>
                  </div>
                </div> -->



        </div>
    </div>
</div>
</div>
<!-- /page content -->


<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js"></script>
<script type="text/javascript" src="js-files/indexes.js"></script>




<?php
include_once("../gen/_common/footer.php");
?>