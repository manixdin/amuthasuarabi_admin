<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<!DOCTYPE html>
<html lang="en">
   <?php require("component/head.php"); ?>
   <!--<link rel="shortcut icon" href="https://coderthemes.com/ubold/layouts/assets/images/favicon.ico">-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/css/selectize.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/css/selectize.min.css" />
   <script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
   <style type="text/css">
      .modal-md {
      max-width: 950px !important;
      }
      .error
      {
      color: red;
      margin-left: 10px;
      margin-bottom: 0px;
      }
      .dataTables_length
      {
      float: left !important;
      margin-top: 7px !important;
      margin-right: 30px !important;
      }
      /*#Product_wrapper .flex-wrap
      {
      float: left !important;
      }*/
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
                           <div class="page-title-right" style="margin-left: 20px;"> 
                           </div> 
                           <div class="page-title-right" >
                              <button class="btn btn-success" id="New_Category"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;New Product</button>
                           </div>
                           <h4 class="page-title">Products List</h4>
                        </div>
                     </div>
                  </div>
                  <!-- end page title -->
                  <div class="card-body">
                     <!-- div align="center">
                        <form method="post" action="<?php echo base_url(); ?>YallaBasketCon/action">
                         <input type="submit" name="export" class="btn btn-success" value="Export" />
                        </form>
                        </div> -->
                     <table id="Product" class="table w-100 dt-responsive">
                        <thead>
                           <tr>
                              <th>MainCategory</th>
                              <th>SubCategory</th> 
                              <th>ProductName</th>
                              <th>ProductImage</th>
                              <th>Images</th> 
                              <th>ProductStock</th>
                              <th>Visibility</th>
                              <th>Edit</th>
                           </tr>
                        </thead>
                        <tbody></tbody>
                     </table>
                  </div>
                  <!-- end card body-->
               </div>
               <!-- end card -->
            </div>
            <!-- end col-->
         </div>
         <!-- end row-->
         <!-- Large Size -->
         <div class="modal fade" id="addImageForm" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content modal-col-green card">
                  <div class="modal-body body" style="background-color:white;">
                     <div class="card">
                        <form class="form-horizontal" name="product_image_form" id="product_image_form">
                           <div class="card-body">
                              <h4 class="card-title">Product Thumbnail Images</h4>
                              <input type="hidden" name="hidden_id" id="hidden_id">
                              <div class="form-group">
                                 <label for="">Images</label>
                                 <input type="file" name="userfile[]" required id="image_file" accept=".png,.jpg,.jpeg,.gif" multiple>
                              </div>
                              <div class="border-top">
                                 <div class="card-body" style="float:right;">
                                    <button type="button" class="btn btn-primary" id="upload_image">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 </div>
                              </div>
                        </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="imageEditForm" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content modal-col-green card">
                  <div class="modal-body body" style="background-color:white;">
                     <div class="card">
                        <form class="form-horizontal" name="" id="">
                           <div class="card-body">
                              <h4 class="card-title">Product Thumbnail Images</h4>
                              <input type="hidden" name="hidden_id1" id="hidden_id1">
                              <div class="form-group">
                                 <label for="">Images</label>
                                 <div id="user_uploaded_image1">
                                 </div>
                              </div> 
                        </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
               <div class="modal-content modal-col-green card">
                  <div class="modal-body body" style="background-color:white;">
                     <div class="card">
                        <form class="form-material form-horizontal" name="Product_Form" id="Product_Form">
                           <div class="card-body">
                              <h4 class="card-title">Product Details</h4> 
                              <div class="form-group row">
                                 <div class="col-sm-6">
                                    <label for="fname" class="col-sm-12 text-left control-label col-form-label">Main Category</label>
                                    <div class="col-sm-12">  
                                       <select class="form-control" name="mc_id" id="mc_id">
                                            <?php 
                                                echo "<option value=''>Please Select Category</option>";
                                                foreach($main_category as $value)
                                                {
                                                   echo "<option value=".$value['main_category_id']."> ".$value['mc_name']." ( ".$value["main_category_id"]." )</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="error mc_id"></p>
                                 </div>
                                 <div class="col-sm-6">
                                    <label for="fname" class="col-sm-12 text-left control-label col-form-label">Sub Category</label>
                                    <div class="col-sm-12">
                                       <select id="sc_id" name="sc_id" class="form-control">
                                          <option value=''>Please Select Subcategory</option>
                                       </select>
                                    </div>
                                    <p class="error sc_id"></p>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-6">
                                    <label for="cono1" class="col-sm-12 text-left control-label col-form-label">Product Name</label>
                                    <div class="col-sm-12">
                                       <input class="form-control" name="prod_name" id="prod_name" placeholder="Enter Product Name">
                                    </div>
                                    <p class="error prod_name"></p>
                                 </div>  
                                 <div class="col-sm-6">
                                    <label for="cono1" class="col-sm-12 text-left control-label col-form-label">Product Price</label>
                                    <div class="col-sm-12">
                                       <input class="form-control" name="prod_price" id="prod_price" placeholder="Enter Product Price">
                                    </div>
                                    <p class="error prod_price"></p>
                                 </div>  
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-6">
                                    <label for="cono1" class="col-sm-12 text-left control-label col-form-label">Product Image</label>
                                    <div class="col-sm-12" style="margin-left: 12px !important;">
                                       <input type="file" class="form-control custom-file-input" id="prod_imgurl" name="prod_imgurl" required="">
                                       <label class="custom-file-label" for="prod_imgurl" style="right: 25px !important;">Choose file...</label>
                                       <div class="invalid-feedback">Upload Valid File Format</div>
                                    </div>
                                    <p class="error prod_imgurl"></p>
                                 </div>
                                 <div class="col-sm-3">
                                    <label for="cono1" class="col-sm-12 text-left control-label col-form-label">Units</label>
                                    <div class="col-sm-12">
                                       <select id="unit_id" name="unit_id" class="form-control">
                                          <option value=''>Please Select Unit</option>
                                          <?php
                                             foreach($unit as $value)
                                             {
                                                echo "<option value=".$value['unit_name'].">".$value['unit_name']." ( ".$value['unit'].") </option>";
                                             }
                                             ?>
                                       </select>
                                    </div>
                                    <p class="error unit_id"></p>
                                 </div>
                                 <div class="col-sm-3">
                                    <label for="cono1" class="col-sm-12 text-left control-label col-form-label">Quantity</label>
                                    <div class="col-sm-12">
                                       <input class="form-control" name="prod_quantity" id="prod_quantity" placeholder="Enter Quantity">
                                    </div>
                                    <p class="error prod_quantity"></p>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-12">
                                    <label for="cono1" class="col-sm-12 text-left control-label col-form-label">Product Info</label> 
                                    <div class="col-sm-12"><br>
                                       <textarea  class="size_chart_details" id="editor1" rows="10" cols="80">
                                       </textarea>
                                    </div>
                                    <p class="error prod_info"></p>
                                 </div> 
                              </div> 
                           </div>
                           <div class="border-top">
                              <div class="card-body" style="float:right;">
                                 <button type="button" class="btn btn-primary" id="Product_Button">Submit</button>
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
         <!-- Price Size --> 
      </div>
      <div id="page-wrapper">
      <div class="rightbar-overlay"></div>
      <?php require("component/footer.php"); ?>
      <script src="<?php echo base_url();?>custom/product.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/js/standalone/selectize.js"></script>
      <ckeditor
      [config]="ckeConfig"
      #ckeditor
      debounce="500">
      </ckeditor>
      <script>
         // Replace the <textarea id="editor1"> with a CKEditor
         // instance, using default configuration.
         CKEDITOR.replace( 'editor1' );
      </script>
      <script type="text/javascript">
         $('#diet_type_id').selectize();
         // $('#langOpt').selectize({
         //     columns: 1,
         //     placeholder: 'Select Languages'
         // });
         CKEDITOR.plugins.add( 'my_plugin', {
         });
         CKEDITOR.on( 'dialogDefinition', function( ev ) {
         // Take the dialog name and its definition from the event data.
         var dialogName = ev.data.name;
         var dialogDefinition = ev.data.definition;
         // Check if the definition is from the dialog we're
         // interested on (the "Table" dialog).
         if ( dialogName == 'table' ) {
         // Get a reference to the "Table Info" tab.
         var infoTab = dialogDefinition.getContents( 'info' );
         txtWidth = infoTab.get( 'txtWidth' );
         txtWidth['default'] = 300;
         }
         });
      </script>
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