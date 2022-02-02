    <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <?php require("component/head.php"); ?>
    <body class="fix-sidebar">
        <div id="wrapper">
            <div class="loading" id="loadder" ></div>
            <?php require("component/menu.php"); ?>
            <div class="content-page">
                <!-- <div class="spinner-border avatar-lg text-primary m-2" role="status"></div> -->
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        
                        <!-- end page title -->
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="card">
                                    
                                    <div class="row">
                                        
                                        <div class="col-12">
                                            
                                            <div class="page-title-box">
                                                <div class="page-title-right">
                                                    <button style="border-radius: 17px;" class="btn btn-success" id="New_Category"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New State</button>
                                                </div>
                                                <h4 class="page-title">State List</h4>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">                                        
                                        <table id="Main_Category" class="table w-100 dt-responsive">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th> 
                                                    <th>Country</th> 
                                                    <th>State</th> 
                                                    <th>Edit</th>
                                                </tr>
                                                </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div> <!-- end card body-->
                                    </div> <!-- end card -->
                                    </div><!-- end col-->
                                </div>
                                <!-- end row-->
                                <!-- Large Size -->
                                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content modal-col-green card">
                                            <div class="modal-body body" style="background-color:white;">
                                                <div class="card">


                        <form class="form-material form-horizontal" name="state_form" id="state_form">
                           <div class="card-body">
                              <h4 class="card-title">State</h4> 
                              <div class="form-group row">

                                 <div class="col-sm-12">
                                    <label for="cono1" class="col-sm-12 text-left control-label col-form-label">Country Name</label>
                                    <div class="col-sm-12">
                                       <select class="form-control" name="country" id="country">
                                            <option value="india">INDIA</option>
                                       </select>
                                    </div>
                                    <p class="error country"></p>
                                 </div>   

                                 <div class="col-sm-12">
                                    <label for="cono1" class="col-sm-12 text-left control-label col-form-label">State Name</label>
                                    <div class="col-sm-12">
                                       <input class="form-control" name="state_name" id="state_name" placeholder="Enter State Name">
                                    </div>
                                    <p class="error state_name"></p>
                                 </div>   

                              </div>
                           </div>
                           <div class="border-top">
                              <div class="card-body" style="float:right;">
                                 <button type="button" class="btn btn-primary" id="state_button">Submit</button>
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </form>


                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End of Model -->
                        </div>
                    </div>
                </div>
                <div id="page-wrapper">
                    <?php require("component/footer.php"); ?>
                    <script src="<?php echo base_url();?>custom/state.js"></script>
                    
      <style>
         .image-display {
         display: inline-block;
         margin-right: 25px;
         }
         .image-delete-icon {
         margin-top: 20px;
         text-align: center;
         }
         .image-delete-icon>i {
         font-size: 16px;
         }
         ul.pro-img-overlay-1 {
         text-decoration: none;
         display: inline-block;
         text-transform: uppercase;
         color: #fff;
         background-color: transparent;
         filter: alpha(opacity=0);
         -webkit-transition: all .2s ease-in-out;
         -o-transition: all .2s ease-in-out;
         transition: all .2s ease-in-out;
         padding: 0;
         margin: auto;
         position: absolute;
         top: 50%;
         left: 0;
         right: 0;
         transform: translateY(-50%) translateZ(0);
         -webkit-transform: translateY(-50%) translateZ(0);
         -ms-transform: translateY(-50%) translateZ(0);
         }
         .pro-im {
         width: 100%;
         overflow: hidden;
         position: relative;
         cursor: default;
         }
         .pro-img-overlay {
         width: 100px;
         height: 100%;
         position: absolute;
         overflow: hidden;
         top: 0;
         left: 0;
         opacity: 0;
         background-color: rgba(0, 0, 0, 0.7);
         -webkit-transition: all .4s ease-in-out;
         -o-transition: all .4s ease-in-out;
         transition: all .4s ease-in-out;
         }
         .pro-im:hover .pro-img-overlay {
         opacity: 1;
         filter: alpha(opacity=100);
         -webkit-transform: translateZ(0);
         -ms-transform: translateZ(0);
         transform: translateZ(0);
         text-align:center;
         }
         a.btn.default.btn-outline.image-popup-vertical-fit.el-link {
         border-color: #fff;
         color: #fff;
         padding: 12px 15px 10px;
         }
         li.el-item {
         list-style: none;
         display: inline-block;
         margin: 0 3px;
         }
      </style>
                </body>
            </html>