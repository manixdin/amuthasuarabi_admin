<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <?php require("component/head.php"); ?>

        <style type="text/css">
        .selectize-control::before {
            -moz-transition: opacity 0.2s;
            -webkit-transition: opacity 0.2s;
            transition: opacity 0.2s;
            content: ' ';
            z-index: 2;
            position: absolute;
            display: block;
            top: 12px;
            right: 34px;
            width: 16px;
            height: 16px;
            background: url(images/spinner.gif);
            background-size: 16px 16px;
            opacity: 0;
        }
        .selectize-control.loading::before {
            opacity: 0.4;
        }
        .modal-md {
            max-width: 700px !important;
        }
        </style>

    <body class="fix-sidebar">
        <div id="wrapper">
            <div class="loading" id="loadder" ></div>
            <?php require("component/menu.php"); ?>
            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="card">
                                    
                                    <!-- start page title -->
                                    <div class="row">
                                        
                                        <div class="col-12">
                                            
                                            <div class="page-title-box">
                                                <div class="page-title-right">
                                                    <button class="btn btn-success" id="New_Category"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Sub Category</button>
                                                </div>
                                                <h4 class="page-title">Sub Category</h4>
                                            </div>


                                            
                                        </div>
                                    </div>
                                    <!-- end page title -->
                                    <div class="card-body">
                                        
                                        <table id="Main_Category" class="table w-100 dt-responsive">
                                            <thead>
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Main Category </th>
                                                    <th>Sub Category</th>
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
                                                    <form class="form-horizontal" name="Sub_Department_Form" id="Sub_Department_Form">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Sub Department</h4>
                                                            <div class="form-group row">
                                                                <label for="fname" class="col-sm-3 text-left control-label col-form-label">Main Department</label>
                                                                <div class="col-sm-9">
                                                                        <div class="control-group">
                                                                            <select name="main_category_id" id="main_category_id">
                                                                                <?php 
                                                                                    echo "<option value=''>Please Select Category</option>";
                                                                                    foreach($main_category as $value)
                                                                                    {
                                                                                       echo "<option value=".$value['main_category_id']."> ".$value['mc_name']." ( ".$value["main_category_id"]." )</option>";
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                                <p class="error main_category_id"></p>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="fname" class="col-sm-3 text-left control-label col-form-label">Sub Department</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="sub_category_name" name="sub_category_name" placeholder="Sub category Name Here">
                                                                </div>
                                                                <p class="error sub_category_name"></p>
                                                            </div>
                                                    </div>
                                                    <div class="border-top">
                                                        <div class="card-body" style="float:right;">
                                                            <button type="button" class="btn btn-primary" id="Sub_Department_Button">Submit</button>
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
                    <script src="<?php echo base_url();?>custom/sub_category.js"></script>

                    <script >
                        $select_state = $('#main_category_id').selectize({});

                    </script>



                </body>
            </html>