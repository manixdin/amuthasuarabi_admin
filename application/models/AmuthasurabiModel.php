<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AmuthasurabiModel extends CI_Model {

  // <<<======= used function ============>>> //
	public function __construct()  
	{   
		parent::__construct();  
		$this->load->database('default');
	} 
	// ====== check login start ======
	public function CheckLogin($data)  
	{		 
		$this->db->where('username', $data["name"]);
		$this->db->where('password', $data["password"]);
		$query = $this->db->get('tbl_admin');
		$userdetails = $query->result_array();		
		if($query->num_rows()>0)
		{
			$result["status"]="success";
			$result["user_id"]=$userdetails[0]["admin_id"];
			$result["username"]=$userdetails[0]["username"];
			return $result;
		}
		else
		{
			$result["status"]="fail";
			$result["user_id"]='';
		}
	}
	// ====== check login end ======
	// ====== Dashboard start ======
	public function getdashboardcountt()  
	{	 	
		$query = $this->db->query("SELECT * FROM `tbl_main_category` WHERE flag=1");
		$main_category = $query->result_array();
		$result["main_category"] = sizeof($main_category); 

		$query = $this->db->query("SELECT * FROM `tbl_sub_category` WHERE flag=1");
		$sub_category = $query->result_array();
		$result["sub_category"] = sizeof($sub_category); 

		$query = $this->db->query("SELECT * FROM `tbl_product` WHERE flag=1");
		$product = $query->result_array();
		$result["product"] = sizeof($product); 

		$query = $this->db->query("SELECT * FROM `tbl_user` WHERE flag=1");
		$user = $query->result_array();
		$result["user"] = sizeof($user); 

		$query = $this->db->query("SELECT * FROM `tbl_user_orders` WHERE flag=1");
		$user_order = $query->result_array();
		$result["user_order"] = sizeof($user_order); 

		return $result;
	}
	// ====== Dashboard end ======
	public function getMainCategoryy()  
		{  
			$sql="SELECT * from `tbl_main_category` WHERE flag=1";
			$query = $this->db->query($sql);
			return $query->result_array();
		} 
		public function insertMainCategoryy($data)  
		{  
			$this->db->insert('tbl_main_category', $data);
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}
		public function updateMainCategoryy($data)  
		{  
			$id=$data["id"];
			unset($data["id"]);
			$this->db->where('main_category_id', $id);
			$this->db->update('tbl_main_category', $data);
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}

		public function RestoreMainCategoryDataa($data)  
		{	
			$main_category_id=$data["main_category_id"];
			$flag=$data["flag"];
			unset($data["main_category_id"]);
			$this->db->where('main_category_id', $main_category_id);
			$this->db->update('tbl_main_category', array("active_flag"=>$flag)	);
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}

		public function getSubCategoryy()  
		{ 
			$sql = "SELECT a.*,b.mc_name FROM tbl_sub_category as a 
			inner join tbl_main_category as b on a.main_category_id =b.main_category_id and b.flag=1 where a.flag=1";
			$query = $this->db->query($sql);
			$details = $query->result_array();			 
			 return $details;
		}
		public function insertSubCategoryy($data)  
		{  
			$this->db->insert('tbl_sub_category', $data);
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}
		public function updateSubCategoryy($data)  
		{  
			$sub_category_id=$data["sub_category_id"];
			unset($data["sub_category_id"]);
			$this->db->where('sub_category_id', $sub_category_id);
			$this->db->update('tbl_sub_category', $data);
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}
		public function RestoreSubCategoryDataa($data)  
		{	
			$sub_category_id=$data["sub_category_id"];
			$flag=$data["flag"];
			unset($data["sub_category_id"]);
			$this->db->where('sub_category_id', $sub_category_id);
			$this->db->update('tbl_sub_category', array("active_flag"=>$flag)	);
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}
		public function deleteMainCategoryy($data)  
		{	
			$main_category_id=$data["main_category_id"]; 
			unset($data["main_category_id"]);
			$this->db->where('main_category_id', $main_category_id);
			$this->db->update('tbl_main_category', array("flag"=>0)	);
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}
		public function deleteSubCategoryy($data)  
		{	
			$sub_category_id=$data["sub_category_id"]; 
			unset($data["sub_category_id"]);
			$this->db->where('sub_category_id', $sub_category_id);
			$this->db->update('tbl_sub_category', array("flag"=>0)	);
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}

		public function getProductt()  
		{  
			$sql="SELECT *, a.flag as product_flag FROM `tbl_product` as a
					INNER join tbl_main_category as b on a.mc_id = b.main_category_id
					INNER JOIN tbl_sub_category as c on a.mc_id = c.main_category_id and a.sc_id = c.sub_category_id 
					GROUP by a.prod_id  ORDER BY a.prod_id DESC";
			$query = $this->db->query($sql);
			$result = $query->result(); 
			return $result;
		} 
		public function getCustomSubCategoryy($data)  
		{ 
			$sql = "SELECT a.*,b.mc_name FROM tbl_sub_category as a 
			inner join tbl_main_category as b on a.main_category_id =b.main_category_id and b.flag=1 
			where a.flag=1 and a.main_category_id ='".$data['main_category_id']."'";
			$query = $this->db->query($sql);
			$details = $query->result_array();			 
			 return $details;
		}
		public function getUnitt()  
		{ 
			$sql = "SELECT * FROM tbl_unit where flag=1";
			$query = $this->db->query($sql);
			$details = $query->result_array();			 
			 return $details;
		}
		public function insertProductsDataa($data)  
		{  
			$this->db->insert('tbl_product', $data);
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}

		public function InsertProductThumbnailImagee($data,$filename)
    {
        $prod_id = $data["hidden_id"];
        if($filename!='' ) {
            $filename1 = explode(',',$filename);
            foreach($filename1 as $file) {
            $file_data = array(
            'product_image_url' => $file,
            'prod_id' =>$prod_id
            );
            $this->db->insert('tbl_product_images', $file_data);
            }
        }
        	if ($this->db->affected_rows() == '1')
          {
          	$data["result"] = "success";
          	return $data;
          }
          else
          {
          	$data["result"] = "imgerror";
          	return $data;
         }
    }
    public function getProductImagess($data)  
		{  
		    $prod_id = $data["prod_id"];
			$this->db->select('ifnull(group_concat(pi.product_image_url),"") as product_image_url,  ifnull(group_concat(pi.product_image_id),"") as product_image_id');
			$this->db->from('tbl_product as Prod');
			$this->db->where('pi.prod_id', $prod_id);
			$this->db->join('tbl_product_images as pi','pi.prod_id=Prod.prod_id');
			$query = $this->db->get();
			return $query->result();
		}
		public function deleteThumbnaiImagee($data)  
		{	  
			$product_image_id =$data["product_image_id"];
			unset($data["product_image_id"]);
			$this->db->where('product_image_id', $product_image_id);
			$this->db->delete('tbl_product_images');
		}
		public function getCustomSubCategoryDataa($data)
		{
			$mc_id=$data["mc_id"];
			unset($data["mc_id"]);
			$sql = "select * FROM tbl_sub_category where flag=1 and main_category_id=$mc_id";
			$query = $this->db->query($sql);
			$details= $query->result_array();
			return $details;
		}
		public function updateProductDataa($data)  
		{  
			$prod_id=$data["prod_id"];			
			unset($data["prod_id"]);
			$this->db->where('prod_id', $prod_id);
			$this->db->update('tbl_product', $data);
			$sqlupdate = "UPDATE tbl_product SET out_of_stack=0 WHERE `prod_price`=0.00";
			$query = $this->db->query($sqlupdate);
			$data["result"] = "success";
			return $data;
		}
		public function RestoreProductDataa($data)  
		{	  
			$prod_id=$data["prod_id"];
			$flag=$data["flag"];
			unset($data["prod_id"]);
			$this->db->where('prod_id', $prod_id);
			$this->db->update('tbl_product',array("flag"=>$flag));
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}

		public function RestoreProductStockDataa($data)  
		{	  
			$prod_id=$data["prod_id"];
			$flag=$data["flag"];
			unset($data["prod_id"]);
			$this->db->where('prod_id', $prod_id);
			$this->db->update('tbl_product',array("out_of_stack"=>$flag));
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}
		public function CustomerListt()  
		{  
			$sql="SELECT * from tbl_user";
			$query = $this->db->query($sql);
			$userList = $query->result_array(); 
			return $userList;
		} 
		public function RestoreUserListDataa($data)  
		{	  
			$user_id=$data["user_id"];
			$flag=$data["flag"];
			unset($data["user_id"]);
			$this->db->where('user_id', $user_id);
			$this->db->update('tbl_user',array("flag"=>$flag));
			if ($this->db->affected_rows() == '1')
			{
				$result["result"] = "success";
				return $result;
			}
			else
			{
				$result["result"] = "fail";
				return $result;
			}
		}

		public function getOrderss()  
	{  	
		$sql = "SELECT a.*,b.* FROM `tbl_user_orders` as a 
			left join tbl_user as b on a.user_unique_id=b.user_unique_id  ORDER by a.log DESC ";			
			// inner join tbl_user_address as c on a.address_id=c.address_id ORDER by a.log DESC ";			
		$query = $this->db->query($sql);
		$details = $query->result_array();	 
		return $details;		
	} 




	public function getorderedproductt($data)  
	{  	
		$sql = "SELECT * FROM `tbl_user_orders` where order_id='".$data["order_id"]."'";			
		$query = $this->db->query($sql);
		$details = $query->result_array();	

    $prod_id_cust = explode(",",$details[0]["prod_id"]);
		$price = explode(",",$details[0]["price"]);
		$quantity = explode(",",$details[0]["quantity"]);
		$prod_total_price = explode(",",$details[0]["prod_total_price"]); 

		for ($i=0; $i <sizeof($details); $i++) 
		{ 
      $Productss=[];
      for ($p=0; $p < sizeof($prod_id_cust) ; $p++) 
      { 
          if ($prod_id_cust[$p]!='' && $prod_id_cust[$p]!=null) 
          {
          	$sql = "SELECT *,a.unit_id as unit, a.flag as product_flag FROM `tbl_product` as a
                  INNER join tbl_main_category as b on a.mc_id = b.main_category_id
                  INNER JOIN tbl_sub_category as c on a.mc_id = c.main_category_id and a.sc_id = c.sub_category_id 
                  where prod_id=".$prod_id_cust[$p]." ";            
          	$query = $this->db->query($sql);
						$Prcts = $query->result_array();
						if (sizeof($Prcts)>0) {
			            $Prcts[0]["prod_unit"]="".$Prcts[0]["prod_quantity"]." ".$Prcts[0]["unit"]."";
		             	array_push($Productss,$Prcts[0]);
		            }
	        }
      } 
			for ($j=0; $j < sizeof($Productss); $j++) 
			{ 
				$Productss[$j]["prod_total_price"] = $prod_total_price[$j];
				$Productss[$j]["quantity"] = $quantity[$j];
				$Productss[$j]["price_pt"] = $price[$j]; 
			} 
			$sql = "SELECT a.*,b.username,b.email,b.mobile_no FROM `tbl_user_address` as a inner join tbl_user as b on a.user_unique_id = b.user_unique_id 
			where a.address_id='".$details[$i]["address_id"]."'";			
			$query = $this->db->query($sql);
			$address = $query->result_array();
			$details[$i]["address_info"] = $address; 
			$details[$i]["produc_info"] = $Productss;
		}		

		$result["status"] = "success";
		$result["status_code"] = "200";
		$result["order_details_count"] = sizeof($details);
		$result["order_details"] = $details;
		return $result;		
	}   
		public function updateorderstatusmsgg($data)  
		{   
			$sqlupdate = "UPDATE tbl_user_orders SET `order_current_status`='".$data['order_status']."' WHERE `order_code`='".$data['order_code']."'";
			$query = $this->db->query($sqlupdate);
			$data["result"] = "success";
			return $data;
		}


  // ======= used function ============

}

