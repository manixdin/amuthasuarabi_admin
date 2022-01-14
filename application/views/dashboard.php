<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<?php require("component/head.php"); ?>

<style type="text/css">
    
.viewmorectyl-warn
{
  padding: 13px;
  border: 1px solid;
  border-radius: 21px;
  padding-top: 3px;
  padding-bottom: 2px;
}
.viewmorectyl-prim
{
  padding: 13px;
  border: 1px solid;
  border-radius: 21px;
  padding-top: 3px;
  padding-bottom: 2px;
}
.viewmorectyl-succ
{
  padding: 13px;
  border: 1px solid;
  border-radius: 21px;
  padding-top: 3px;
  padding-bottom: 2px;
}
.viewmorectyl-dang
{
  padding: 13px;
  border: 1px solid;
  border-radius: 21px;
  padding-top: 3px;
  padding-bottom: 2px;
}
.viewmorectyl-info
{
  padding: 13px;
  border: 1px solid;
  border-radius: 21px;
  padding-top: 3px;
  padding-bottom: 2px;
}
.viewmorectyl-dark
{
  padding: 13px;
  border: 1px solid;
  border-radius: 21px;
  padding-top: 3px;
  padding-bottom: 2px;
}


.card-box {
    background-color: #fff;
    padding: 1.5rem;
    box-shadow: 0 0.75rem 6rem rgb(56 65 74 / 36%);
    margin-bottom: 24px;
    /*border-radius: 1.25rem;*/
}

</style>

<body class="fix-sidebar">
<div id="wrapper">
	<?php require("component/menu.php"); ?>
	 <div class="content-page">
                <div class="content">

                    
                    <div class="container-fluid">
                        
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <form class="form-inline">
                                            <div class="form-group">
                                                <div class="input-group input-group-sm">
                                                   
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <h4 class="page-title text-center mb-2 mt-3">Dashboard Details</h4>
                                </div>
                            </div>
                        </div>     
                        

                        <div class="row">
                            
                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <a href="<?php echo base_url();?>Amuthasurabi/MainCategory">
                                      <div class="row">
                                            <div class="col-4">
                                                <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                    <i class="fa fa-th-large font-22 avatar-title text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $count_result["main_category"]; ?></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Main Category</p>
                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </a>
                                </div> 
                            </div> 


                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <a href="<?php echo base_url();?>Amuthasurabi/SubCategory">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                    <i class="fa fa-th font-22 avatar-title text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $count_result["sub_category"]; ?></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Sub Category</p> 
                                                </div>
                                            </div>
                                        </div> 
                                    </a>
                                </div> 
                            </div> 

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <a href="<?php echo base_url();?>Amuthasurabi/Product">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                                    <i class="fa fa-pagelines font-22 avatar-title text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $count_result["product"]; ?></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Product</p>
                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </a>
                                </div> 
                            </div> 

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <a href="<?php echo base_url();?>Amuthasurabi/CustomerList">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                                                <i class="fa fa-users font-22 avatar-title text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="text-right">
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $count_result["user"]; ?></span></h3>
                                                <p class="text-muted mb-1 text-danger">Customer List</p> 
                                            </div>
                                        </div>
                                    </div> 
                                    </a>
                                </div> 
                            </div> 


 


                             <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <a href="<?php echo base_url();?>Amuthasurabi/Order">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                                    <i class="fa fa-shopping-bag font-22 avatar-title text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="text-right">
                                                    <h3 class="mt-1"><span data-plugin="counterup"><?php echo $count_result["user_order"]; ?></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">User Order</p> 
                                                </div>
                                            </div>
                                        </div> 
                                    </a>
                                </div> 
                            </div> 



                          <!--  <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card-box">
                                    <a href="<?php echo base_url();?>Amuthasurabi/viewnotification">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="avatar-lg rounded-circle bg-soft-dark border-dark border">
                                                    <i class="fa fa-bell font-22 avatar-title text-dark"></i>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $count_result["user_count"]; ?></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">Orders Notification</p> 
                                                </div>
                                            </div>
                                        </div> 
                                    </a>
                                </div> 
                            </div>  -->

                        


                        </div>
                        

                        
                        
                    </div> 

                </div> 
                

            </div>
<div id="page-wrapper">

<?php require("component/footer.php"); ?>
<script src="<?php echo base_url();?>custom/Main_Category1.js"></script>
</body>
</html>