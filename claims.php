<?php
include_once("_common/menu.php"); // menu list
include_once("../gen/_common/header.php"); // header contents
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">
<style>
.no-border {
    border: none;
    outline: none;
    background-color: #f5f6f8;
    border-radius: 5px;
    padding: 5px;
    margin-bottom: 2em;
}

#gallery,
#gallery_view {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
}

#gallery a img,
#gallery_view a img {
    object-fit: cover;
    width: 100px;
    height: 100px;
    border-radius: 1em;
}

#gallery a .fa-file-alt,
#gallery_view a .fa-file-alt {
    /* object-fit: cover; */
    font-size: 7.5em;
    border-radius: 1em;
}

.image-area {
    position: relative;
    padding-right: 1em;
    margin-bottom: 1em;
    /* width: 50%; */
    /* background: #333; */
}

.image-area img {
    /* max-width: 100%; */
    /* height: auto; */
}

.remove-image {
    display: none;
    position: absolute;
    top: -5px;
    right: 7px;
    border-radius: 10em;
    padding: 2px 0;
    /* text-decoration: none; */
    /* font: 700 21px/20px sans-serif; */
    /* background: #555; */
    /* border: 3px solid #fff; */
    color: red;
    /* box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3); */
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
    -webkit-transition: background 0.5s;
    transition: background 0.5s;
}

.remove-image:hover {
    background: white;
    color: red;
    padding: 3px 7px 5px;
    top: -7px;
    /* right: -11px; */
}

.remove-image:active {
    background: white;
    color: red;
    top: -7px;
    /* right: -11px; */
}
</style>
<!-- loader page -->

<div class="right_col" role="main" id="main_display_loader_page" style="display: ;">

    <div class="page-title">
        <div class="title_left">
            <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ; margin-top: 20px;" id="ldnuy"></i>
            <div id="loader_mssg" style="color: red; font-size: 14px; margin-top: 30px; background-color: ;"></div>
        </div>
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
                <h3>Employee Claim</h3>
            </div>

            <div class="title_right" style="text-align: right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group" style="float: right">
                        <!--span class="input-group-btn"-->
                        <button type="button" class="btn btn-primary" data-toggle="collapse"
                            data-target="#collapseExample22" aria-expanded="false"
                            aria-controls="collapseExample">Filter</button>
                        <button type="button" class="btn btn-success" data-toggle="collapse"
                            data-target="#collapseExample23" aria-expanded="false" aria-controls="collapseExample">Add
                            Claim</button>

                        <!-- </span> -->

                    </div>
                </div>
            </div>


        </div>


        <div class="collapse" id="collapseExample22" style="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />


                            <div class="form-row">

                                <!-- <div class="col-sm-4 col-xs-4">
                                    
                                    <select class="form-control js-example-basic-single" id="claimant_filter"
                                        style="width:100% !important;max-width:800px !important; border-radius:30px !important; "></select>

                                </div> -->



                                <div class="col-sm-4 col-xs-4">
                                    <select class="form-control" id="status_filter">
                                        <option vaue=''>--Status--</option>
                                        <option value="Draft">Draft</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>

                                    </select>
                                </div>

                                <button type="button" class="btn btn-success" id="filter_claim">Search</button>
                                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                    id="filter_claim_loader"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="collapse" id="collapseExample23" style="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <br />

                            <span id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="claimant">Claimant<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control js-example-basic-single claim_require" id="claimant"
                                            style="width:100% !important;max-width:800px !important; border-radius:30px !important; "></select>

                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="claim_name">Claim
                                        Name<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="claim_name"
                                            class="form-control col-md-7 col-xs-12 claim_require">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="reason">Reason<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control col-md-7 col-xs-12 claim_require" id="reason">

                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                        for="amount">Amount<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="amount"
                                            class="form-control col-md-7 col-xs-12 claim_require"
                                            pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upload_doc">Upload
                                        Document(s)<span>*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" multiple id="upload_doc"
                                            class="form-control col-md-7 col-xs-12 claim_require">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="error"></div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">

                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="button" class="btn btn-primary" id="add_draft_btn">Save as
                                            Draft</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="add_draft_loader"></i>
                                        <button type="button" class="btn btn-success" id="add_claim_btn">Save</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="add_claim_loader"></i>
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

                        <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="list_claim_loader"></i>
                        <div class="table-responsive" id="list_claim_table">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">ID</th>
                                        <!-- <th class="column-title">Claimant</th> -->
                                        <th class="column-title">Amount</th>
                                        <th class="column-title">Status</th>
                                        <th class="column-title" width="10%"><span class="nobr">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="list_claim_body">

                                </tbody>
                            </table>
                            <div class="container">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination" id="pagination"></ul>
                                </nav>
                            </div>
                        </div>
                        <!-- </div> -->




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_claim_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">Edit Claim
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <div style="margin-top:2em">
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->


                    <span data-parsley-validate class="form-horizontal form-label-left">

                        <!-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                for="claimant">Claimant<span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control  claim_edit_require" id="edit_claimant"
                                    style="width:100% !important;max-width:800px !important; border-radius:30px !important; "></select>

                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="claim_name">Claim
                                Name<span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_claim_name"
                                    class="form-control col-md-7 col-xs-12 claim_edit_require">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reason">Reason<span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control col-md-7 col-xs-12 claim_edit_require" id="edit_reason">

                                        </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">Amount<span>*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="edit_amount"
                                    class="form-control col-md-7 col-xs-12 claim_edit_require"
                                    pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency">


                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upload_doc">Upload
                                Document(s)
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" multiple id="edit_upload_doc"
                                    class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="gallery">

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="edit_claim_error"></div>
                        </div>



                    </span>
                    <!-- </div> -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="edit_draft_btn">Save as Draft</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_draft_loader"></i>
                <button type="button" class="btn btn-success" id="edit_claim_btn">Save</button>
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="edit_claim_loader"></i>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view_claim_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h3 class="modal-title" id="exampleModalLabel" style="color: #fff;">View Claim
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>

            </div>
            <div class="modal-body">
                <!-- <div style="margin-top:2em"> -->
                <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->

                <!-- <div class="x_content"> -->
                <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;" id="view_claim_loader"></i>
                <div id="view_claim_div">

                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <p><strong>Claim Name:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="view_claim_name"></p>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <p><strong>Claimant:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="view_claimant"></p>
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <p><strong>Reason:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="view_reason"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <p><strong>Amount:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="view_amount"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <p><strong>Status:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="view_status"></p>
                        </div>
                    </div>

                    <div class="row" id="paid_div" style="display:none;">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <p><strong>Date Paid:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p id="view_date_paid"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <p><strong>Document:</strong></p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="gallery_view">

                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-danger" id="view_claim_error">

                        </div>
                    </div>


                </div>
                <!-- </div> -->

                <!-- </div> -->
                <!-- </div> -->

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- </div> -->
<!-- /page content -->



<script src="https://kit.fontawesome.com/bcb3edd6a7.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script src="js-files/claims.js"></script>
<?php
include_once("../gen/_common/footer.php");
?>