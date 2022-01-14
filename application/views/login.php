<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/ubold/layouts/default/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Aug 2020 04:27:43 GMT -->
<head>
        <meta charset="utf-8" />
        <title>:: Amuthasurabi ::</title>
        <link rel="icon" href="<?php echo base_url(); ?>assets/img/fav.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        

	    <!-- App css -->
	    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
	    <link href="<?php echo base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

	    <link href="<?php echo base_url(); ?>assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
	    <link href="<?php echo base_url(); ?>assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

	    <!-- icons -->
	    
		
		<!-- third party css -->
        <link href="<?php echo base_url(); ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
		
				
		 <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
    </head>

    <body class="loading authentication-bg">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a  class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="<?php echo base_url();?>assets/img/logo.png" alt="" width="80%">
                                            </span>
                                        </a>
                    
                                       
                                    </div>
                                    
                                </div>

                                <form method="post" id="loginform" action="<?php echo base_url();?>Amuthasurabilogin/login">

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Username</label>
                                        <input class="form-control" name="name" type="text" id="Username" required="" placeholder="Enter Username">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" class="form-control" placeholder="Enter your password" required="" name="password">
                                            <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                  <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>
                                    <br>
                        <?php if(isset($title)){?>
                        <div class="alert alert-danger"><?php if(isset($title)){ echo $message;} ?></div>
                        <?php }?>
                                </form>                              

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="<?php echo base_url();?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url();?>assets/js/app.min.js"></script>
        
    </body>

<!-- Mirrored from coderthemes.com/ubold/layouts/default/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Aug 2020 04:27:43 GMT -->
</html>