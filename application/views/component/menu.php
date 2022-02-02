<div class="navbar-custom">
   <div class="container-fluid titlebar">
      <ul class="list-unstyled topnav-menu float-right mb-0">
         <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle rounded-circle-cust mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
               <i data-feather="more-vertical"></i>
               <span class="pro-user-name ml-1">
               <i class="mdi mdi-chevron-down"></i> 
               </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
               <a href="<?php echo base_url();?>Amuthasurabi/logout" class="dropdown-item notify-item">
               <i style="width: 22px; height: 17px;margin-right: 4px" data-feather="power"></i>
               <span> Logout</span>
               </a>
            </div>
         </li>
      </ul>
      <!-- LOGO -->
      <div class="logo-box">
         <a href="index.html" class=" logo-dark text-center">
            <span class="logo-sm">
               <img src="<?php echo base_url()?>assets/img/logo.png" alt="" width="50%">
               <!-- <span class="logo-lg-text-light">UBold</span> -->
            </span>
            <span class="logo-lg">
               <img src="<?php echo base_url()?>assets/img/logo.png" alt="" width="50%">
               <!-- <span class="logo-lg-text-light">U</span> -->
            </span>
         </a>
         <a href="#" class="logo logo-light text-center">
         <span class="logo-sm">
         <img src="<?php echo base_url()?>assets/img/logo.png" alt="" width="50%">
         </span>
         <span class="logo-lg">
         <img src="<?php echo base_url()?>assets/img/logo.png" alt="" width="50%">
         </span>
         </a>
      </div>
      <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
         <li>
            <button class="button-menu-mobile waves-effect waves-light">
               <!-- <i class="fa fa-bars"></i> -->
            </button>
         </li>
         <li>
            <!-- Mobile menu toggle (Horizontal Layout)-->
            <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
               <div class="lines">
                  <span></span>
                  <span></span>
                  <span></span>
               </div>
            </a>
            <!-- End mobile menu toggle-->
         </li>
      </ul>
      <div class="clearfix"></div>
   </div>
</div>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu titlebar">
   <div class="h-100" data-simplebar>
      <!-- User box -->
      <div class="user-box text-center">
         <img src="../assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
            class="rounded-circle avatar-md">
         <div class="dropdown">
            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
               data-toggle="dropdown"></a>
            <div class="dropdown-menu user-pro-dropdown">
               <!-- item-->
               <a href="javascript:void(0);" class="dropdown-item notify-item">
               <i class="fe-user mr-1"></i>
               <span>My Account</span>
               </a>
               <!-- item-->
               <a href="javascript:void(0);" class="dropdown-item notify-item">
               <i class="fe-settings mr-1"></i>
               <span>Settings</span>
               </a>
               <!-- item-->
               <a href="javascript:void(0);" class="dropdown-item notify-item">
               <i class="fe-lock mr-1"></i>
               <span>Lock Screen</span>
               </a>
               <!-- item-->
               <a href="<?php echo base_url();?>MyCon/logout" class="dropdown-item notify-item">
               <i class="fe-log-out mr-1"></i>
               <span>Logout</span>
               </a>
            </div>
         </div>
         <p class="text-muted">Admin Head</p>
      </div>
      <!--- Sidemenu -->
      <div id="sidebar-menu">
         <ul id="side-menus"> 
            <!-- <li  class="menuitem-active"> -->
            <li class='<?php if($this->uri->segment(2)=="homeView"){echo "active_link";}?>' >
               <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="<?php echo base_url() ?>Amuthasurabi/homeView" aria-expanded="false">
               <i class="fa fa-tachometer font-15 avatar-title"></i>
               <span> Dashboard </span>
               </a>
            </li>
            <li class='<?php if($this->uri->segment(2)=="MainCategory"){echo "active_link";}?>' >
               <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="<?php echo base_url() ?>Amuthasurabi/MainCategory" aria-expanded="false">
               <i class="fa fa-th-large font-15 avatar-title"></i>
               <span> Main Category </span>
               </a>
            </li>
             <li class='<?php if($this->uri->segment(2)=="SubCategory"){echo "active_link";}?>' >
               <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="<?php echo base_url() ?>Amuthasurabi/SubCategory" aria-expanded="false">
               <i class="fa fa-th font-15 avatar-title"></i>
               <span> Sub Category </span>
               </a>
            </li>
            <li class='<?php if($this->uri->segment(2)=="Product"){echo "active_link";}?>' >
               <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="<?php echo base_url() ?>Amuthasurabi/Product" aria-expanded="false">
               <i class="fa fa-pagelines font-15 avatar-title"></i>
               <span> Product </span>
               </a>
            </li>
            <li class='<?php if($this->uri->segment(2)=="CustomerList"){echo "active_link";}?>' >
               <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="<?php echo base_url() ?>Amuthasurabi/CustomerList" aria-expanded="false">
               <i class="fa fa-users font-15 avatar-title"></i>
               <span> Customer List </span>
               </a>
            </li>
            <li class='<?php if($this->uri->segment(2)=="Order"){echo "active_link";}?>' >
               <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="<?php echo base_url() ?>Amuthasurabi/Order" aria-expanded="false">
               <i class="fa fa-shopping-bag font-15 avatar-title"></i>
               <span> User Order </span>
               </a>
            </li>
            <!-- <li class='<?php if($this->uri->segment(2)=="State"){echo "active_link";}?>' >
               <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="<?php echo base_url() ?>Amuthasurabi/State" aria-expanded="false">
               <i class="fa fa-shopping-bag font-15 avatar-title"></i>
               <span> State Master </span>
               </a>
            </li>
            <li class='<?php if($this->uri->segment(2)=="City"){echo "active_link";}?>' >
               <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="<?php echo base_url() ?>Amuthasurabi/City" aria-expanded="false">
               <i class="fa fa-shopping-bag font-15 avatar-title"></i>
               <span> City Master </span>
               </a>
            </li> -->

            <li class='<?php if($this->uri->segment(2)=="City" || $this->uri->segment(2)=="State"){echo "active_link";}?>' >
               <a href="#masterlist" data-toggle="collapse" class="collapsed" aria-expanded="false">
                  <i class="fa fa-pie-chart font-15 avatar-title"></i><span> Master </span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down" style="float:right;">
                     <polyline points="6 9 12 15 18 9"></polyline>
                  </svg>
               </a>
               <div class="collapse" id="masterlist" style="">
                  <ul class="nav-second-level">
                     <li id="subdept1"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>Amuthasurabi/State" aria-expanded="false">State Master</a> </li> 
                     <li id="subdept1"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>Amuthasurabi/City" aria-expanded="false">City Master</a> </li> 
                  </ul>
               </div>
            </li>


         </ul>
      </div>
      <!-- End Sidebar -->
      <div class="clearfix"></div>
   </div>
   <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->           
<div class="modal fade" id="notificationmodel" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-md" role="document">
      <div class="modal-content modal-col-green card">
         <div class="modal-body body" style="background-color:white;">
            <div class="card">
               <form class="form-horizontal" name="Main_Department_Form" id="Main_Department_Form">
                  <div class="card-body">
                     <h4 class="card-title">Notification </h4>
                     <p id="notificationcontentmsg"></p>
                  </div>
                  <div class="border-top">
                     <div class="card-body" style="float:right;">
                        <!-- <button type="button" class="btn btn-primary" id="Main_Department_Button">Submit</button> -->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>