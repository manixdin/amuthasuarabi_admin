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
                        
                        <!-- end page title -->
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="card">
                                    
                                    <div class="row">
                                        
                                        <div class="col-12">
                                            
                                            <div class="page-title-box"> 
                                                <h4 class="page-title">Customer List</h4>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">                                        
                                        <table id="Main_Category" class="table w-100 dt-responsive">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th> 
                                                    <th>User Name</th> 
                                                    <th>Email</th>
                                                    <th>Mobile No</th>
                                                    <th>Nationality</th>
                                                    <th>Active Status</th> 
                                                </tr>
                                                </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div> <!-- end card body-->
                                    </div> <!-- end card -->
                                    </div><!-- end col-->
                                </div>
                                <!-- end row--> 
                            </div>
                            <!--End of Model -->
                        </div>
                    </div>
                </div>
                <div id="page-wrapper">
                    <?php require("component/footer.php"); ?>
                    <script src="<?php echo base_url();?>custom/customer_list.js"></script>
                </body>
            </html>