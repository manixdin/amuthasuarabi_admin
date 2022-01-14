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
                                                    <button style="border-radius: 17px;" class="btn btn-success" id="New_Category"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Category</button>
                                                </div>
                                                <h4 class="page-title">Main Category</h4>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">                                        
                                        <table id="Main_Category" class="table w-100 dt-responsive">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th> 
                                                    <th>Department Name</th> 
                                                    <th>visibility</th>
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
                                                    <form class="form-horizontal" name="Main_Department_Form" id="Main_Department_Form">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Main Category</h4>
                                                            <div class="form-group row">
                                                                <label for="fname" class="col-sm-3 text-left control-label col-form-label">Main Category Name</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="mc_name" name="mc_name" placeholder="Main Category Name Here">
                                                                </div>
                                                                <p class="error mc_name"></p>
                                                            </div>
                                                       
                                                    </div>
                                                    <div class="border-top">
                                                        <div class="card-body" style="float:right;">
                                                            <button type="button" class="btn btn-primary" id="Main_Department_Button">Submit</button>
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
                    <script src="<?php echo base_url();?>custom/main_category.js"></script>
                </body>
            </html>