<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<!DOCTYPE html>
<html lang="en">
   <?php require("component/head.php"); ?>
   <style type="text/css">
      .modal-md {
      max-width: 950px !important;
      }      
      .min-hig_300
      {
      min-height: 255px !important;
      }
      /*   #largeModal .modal-md {
      max-width: 600px !important;
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
                        <div class="row">
                           <div class="col-12">
                              <div class="page-title-box">
                                 <div class="page-title-right"> 
                                 </div>
                                 <h4 class="page-title">Order Confirm Details</h4>
                              </div>
                           </div>
                        </div>
                        <div class="card-body">
                            
                           <div id="maintable_div_show">
                              <table id="Main_Category" class="table dt-responsive nowrap w-100">
                                 <thead>
                                    <tr>
                                       <th>Date & Time</th>
                                       <th>Order code</th>
                                       <th>Order id</th>
                                       <th>User Name</th>
                                       <th>Mobile Number</th>
                                       <th>Orders</th>
                                       <th>Total Amount</th>
                                       <th>Order Status</th>
                                       <th>Payment Type</th>
                                       <th>Action</th> 
                                    </tr>
                                 </thead>
                                 <tbody></tbody>
                              </table>
                           </div>
                           <div id="filter_result_tbl_show_div" style="display: none;">
                              <div class="form-group row" style="width: 100%;" >
                                 <div class="col-4" style="float: right;display: flex; border: 1px solid;padding: 11px;">
                                    <div class="form-group col-8">
                                       <label>Next Order Status</label>
                                       <div class="input-group">
                                          <input type="text" name="nextorderstatus_change" id="nextorderstatus_change" class="form-control" readonly>
                                          <!-- <select id="nextorderstatus_change" name="nextorderstatus_change" class="form-control" >
                                             <option value="">Select Order status</option>
                                             <option value="order_placed">Order Placed</option>
                                             <option value="order_inprogress">In Progress</option>
                                             <option value="order_outofdelivery">Out for Delivery</option>
                                             <option value="order_delivered">Delivered </option>
                                             <option value="order_cancelled"> Cancelled</option>
                                             </select> -->
                                       </div>
                                    </div>
                                    <div class="form-group searchapply" style="width: 33%;margin-top: 1.8rem;text-align: center;">
                                       <button type="button" class="btn btn-primary" id="updatebtn_fltr_ordrcnfm">Update Status</button>
                                    </div>
                                 </div>
                              </div>
                              <table id="filter_result_tbl" class="table dt-responsive nowrap w-100">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="checkbox checkbox-blue">
                                             <input id="checkbox2" type="checkbox"  name="selectAllcheck">
                                             <label for="checkbox2">
                                             Select
                                             </label>
                                          </div>
                                       </th>
                                       <th>Date & Time</th>
                                       <th>Order code</th>
                                       <th>Delivery Date</th>
                                       <th>User Name</th>
                                       <th>Mobile Number</th>
                                       <!-- <th>Address</th> -->
                                       <th>Orders</th>
                                       <th>Total Amount</th>
                                       <!-- <th>Payment Type</th> -->
                                       <th>Order Status</th>
                                       <!-- <th>Action</th>
                                          <th>Print </th> -->
                                    </tr>
                                 </thead>
                                 <tbody></tbody>
                              </table>
                           </div>
                        </div>
                        <!-- end card body-->
                     </div>
                     <!-- end card -->
                  </div>
                  <!-- end col-->
               </div>
               <!-- end row-->
               <!-- Large Size -->
               <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-md" role="document">
                     <div class="modal-content modal-col-green card">
                        <div class="modal-body body" style="background-color:white;">
                           <div class="card">
                              <div class="row">
                                 <div class="col-5">
                                    <div class="card-body">
                                       <!-- <h4 class="header-title mb-3">Track Order</h4> -->
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <div class="mb-2">
                                                <h4 class="card-title">Current Order Status</h4>
                                             </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="mb-4">
                                                <h5 class="mt-0 order_st_code"> </h5>
                                                <h5 class="mt-0 order_cur_status"> </h5>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="track-order-list">
                                          <ul class="list-unstyled">
                                             <span id="placeorder_11">
                                             </span>
                                             <span id="placeorder_12">
                                             </span>
                                             <span id="placeorder_13">
                                             </span>
                                             <span id="placeorder_14">
                                             </span>
                                             <span id="placeorder_15">
                                             </span>
                                             <!-- <span class="active-dot dot"></span> -->
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-7">
                                    <form class="form-horizontal" name="order_form" id="order_form">
                                       <div class="card-body">
                                          <h4 class="card-title">Update Order Status</h4>
                                          <div class="form-group row">
                                             <div class="col-sm-10">
                                                <label for="fname" class="col-sm-12 text-left control-label col-form-label">Order Stauts</label>
                                                <div class="col-sm-12">
                                                   <select id="Orderstatus_change" name="Orderstatus_change" class="form-control">
                                                      <option value="">Select Order status</option>
                                                      <option value="order_placed">Order placed</option>
                                                      <option value="order_inprogress">In Progress</option>
                                                      <option value="order_outofdelivery">Out for Delivery</option>
                                                      <option value="order_delivered">Delivered </option>
                                                      <option value="order_cancelled"> Cancelled</option>
                                                   </select>
                                                </div>
                                                <p class="error Orderstatus_change"></p>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="border-top">
                                          <div class="card-body" style="float:right;">
                                             <button type="button" class="btn btn-primary" id="orderformsubmit_sms" >Submit</button>
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
               </div>
               <!--End of Model -->
               <!-- Large Size -->
               <div class="modal fade" id="productmodel" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-md" role="document">
                     <div class="modal-content modal-col-green">
                        <div class="modal-body body">
                           <!-- <div class="card"> -->
                           <form class="form-horizontal">
                              <div class="card-body">
                                 <h4 class="card-title">Order Details</h4>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="card" style="background-color: #aab3b321">
                                          <div class="card-body">
                                             <h4 class="header-title mb-3">Order Info</h4>
                                             <ul class="list-unstyled mb-0">
                                                <li class="appendorderinfobox">
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-lg-6">
                                       <div class="card"  style="background-color: #aab3b321">
                                          <div class="card-body min-hig_300">
                                             <h4 class="header-title mb-1">Shipping Info</h4>
                                             <div class=" appendaddress" style="display: inline-grid;margin: 7px">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- end col -->
                                 </div>
                                 <div class="form-group row " style="display: inline-grid;margin: 7px;width: 100%">
                                    <div class="product-info">
                                       <div class="table-responsive">
                                          <table class="table table-bordered table-centered mb-0">
                                             <thead class="thead-light">
                                                <tr>
                                                   <th>Product name</th>
                                                   <th>Product</th>
                                                   <th>Quantity</th>
                                                   <th>Price</th>
                                                   <th>Total</th>
                                                </tr>
                                             </thead>
                                             <tbody class="appendproductinfotr">
                                             </tbody>
                                             <tfoot class="appendproductfooter">
                                             </tfoot>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="border-top">
                                 <div class="card-body" style="float:right;">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </form>
                           <!-- </div>                           -->
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
      <script src="<?php echo base_url();?>custom/order.js"></script>
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