<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amuthasurabi extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->helper('url');
		$this->load->model('AmuthasurabiModel');
		$this->load->database('default');
	}

  // <<<======= used function ============>>> //

	public function index()
	{
		$this->load->view('login');
	}

	public function listview()
	{	
		if(!isset($_SERVER['HTTP_REFERER'])){
			echo "you directly access the url";
		}
		else
		{
			$this->load->view('Products_list');
		}
	}
	
	public function logout()  
	{  
		$this->session->unset_userdata('username');  
		$this->session->unset_userdata('user_id');  
		redirect(base_url());  
	} 

	public function homeView()  
    {  
	    if (!$this->session->userdata('username') && !$this->session->userdata('user_id')) 
	    {
	    	redirect('Amuthasurabilogin');
	    }
	    else
	    {
	        header('Access-Control-Allow-Origin: *');
	        $data["count_result"] =$this->AmuthasurabiModel->getdashboardcountt();	
	        $this->load->view('dashboard',$data);	
	    }
    } 

    public function MainCategory()
	{
		header('Access-Control-Allow-Origin: *');
		$this->load->view('main_category');
	}
	public function getMainCategory()
	{
		header('Access-Control-Allow-Origin: *');
		$success=$this->AmuthasurabiModel->getMainCategoryy();
		echo json_encode($success);
	}
	public function insertMainCategory()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->insertMainCategoryy($data);
		echo json_encode($success);
	}
	public function updateMainCategory()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->updateMainCategoryy($data);
		echo json_encode($success);
	}
	public function deleteMainCategory()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->deleteMainCategoryy($data);
		echo json_encode($success);
	}
	public function deleteSubCategory()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->deleteSubCategoryy($data);
		echo json_encode($success);
	}
	public function RestoreMainCategoryData()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->RestoreMainCategoryDataa($data);
		echo json_encode($success);
	}
	public function SubCategory()
	{
		header('Access-Control-Allow-Origin: *');
		$data['main_category']=$this->AmuthasurabiModel->getMainCategoryy(); 
		$this->load->view('sub_category',$data);
	}
	public function getSubCategory()
	{
		header('Access-Control-Allow-Origin: *');
		$success=$this->AmuthasurabiModel->getSubCategoryy();
		echo json_encode($success);
	}
	public function insertSubCategory()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->insertSubCategoryy($data);
		echo json_encode($success);
	}
	public function updateSubCategory()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->updateSubCategoryy($data);
		echo json_encode($success);
	}
	public function RestoreSubCategoryData()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->RestoreSubCategoryDataa($data);
		echo json_encode($success);
	}
	public function Product()
	{
		header('Access-Control-Allow-Origin: *');
		$data['main_category']=$this->AmuthasurabiModel->getMainCategoryy(); 
		$data['unit']=$this->AmuthasurabiModel->getUnitt(); 
		$this->load->view('product',$data);
	}
	public function getProduct()
	{
		header('Access-Control-Allow-Origin: *');
		$success=$this->AmuthasurabiModel->getProductt();
		echo json_encode($success);
	}
	public function getCustomSubCategory()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->getCustomSubCategoryy($data);
		echo json_encode($success);
	}

	public function insertProductsData()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$foldername_cust=''.$data["mc_id"].''.$data["sc_id"].'';
		$pathurll = 'uploads/Products/'.$foldername_cust.'_img';
		if (!is_dir($pathurll)) 
		{
			$old = umask(0);
			mkdir($pathurll, 0777);
			umask($old); 
		}
		$config['upload_path']          = $pathurll.'/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 2048;
		//$this->load->library('upload');
		$this->upload->initialize($config);	
		if($this->upload->do_upload('prod_imgurl'))
		{
			unset($data["prod_imgurl"]);
			$data["prod_imgurl"] = base_url().$pathurll.'/'.$this->upload->data('file_name');			
			$data["prod_id"]="null";
			$success=$this->AmuthasurabiModel->insertProductsDataa($data);
			echo json_encode($success);
		}
		else
		{
			$result["result"]=$this->upload->display_errors();
			echo json_encode($result);
		}	
	} 
	
	public function InsertProductThumbnailImage()
	{

         $data = $this->input->post();
         $files = $_FILES;
         $count = count($_FILES['userfile']['name']);

         for($i=0; $i<$count; $i++)
         {
           $_FILES['userfile']['name']= time().$files['userfile']['name'][$i];
           $_FILES['userfile']['type']= $files['userfile']['type'][$i];
           $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
           $_FILES['userfile']['error']= $files['userfile']['error'][$i];
           $_FILES['userfile']['size']= $files['userfile']['size'][$i];
           $config['upload_path'] = './uploads/ProductDetails/';
           $config['allowed_types'] = 'gif|jpg|png|jpeg';
           $config['max_size'] = '2000000';
           $config['remove_spaces'] = true;
           $config['overwrite'] = false;
           $config['max_width'] = '';
           $config['max_height'] = '';
           $this->upload->initialize($config);
           $fileName = $_FILES['userfile']['name'];
           $this->upload->do_upload();
           $images[] = base_url() ."uploads/ProductDetails/" .$fileName;
         } 
            $fileName = implode(',',$images);
           	$success=$this->AmuthasurabiModel->InsertProductThumbnailImagee($data,$fileName);
            echo json_encode($success);
	}
	public function getProductImages()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();		
		$success=$this->AmuthasurabiModel->getProductImagess($data);
		echo json_encode($success);
	}
	public function deleteThumbnaiImage()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();		
		$success=$this->AmuthasurabiModel->deleteThumbnaiImagee($data);
		echo json_encode($success);
	}
	public function getCustomSubCategoryData()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();		
		$success=$this->AmuthasurabiModel->getCustomSubCategoryDataa($data);
		echo json_encode($success);
	}
	public function updateProductsData()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if (empty($_FILES['prod_imgurl']['name'])) {
				header('Access-Control-Allow-Origin: *');
				$data = $this->input->post();
				$success=$this->AmuthasurabiModel->updateProductDataa($data);	
				if($success)
				{
					$res["result"] = "success";
					echo json_encode($res);
				}
				else
				{
					$res["result"] = "fail";
					echo json_encode($res);		
				}		
			}
			else
			{
				header('Access-Control-Allow-Origin: *');
				$data = $this->input->post();	
				$foldername_cust=''.$data["mc_id"].''.$data["sc_id"].'';
				$pathurll = 'uploads/Products/'.$foldername_cust.'_img';
				if (!is_dir($pathurll)) 
				{
					$old = umask(0);
					mkdir($pathurll, 0777);
					umask($old); 
				}
				$config['upload_path']          = $pathurll.'/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 2048;
				$this->upload->initialize($config);		
				if($this->upload->do_upload('prod_imgurl'))
				{
					unset($data["prod_imgurl"]);
					
					$data["prod_imgurl"] = base_url().$pathurll.'/'.$this->upload->data('file_name');			
					$success=$this->AmuthasurabiModel->updateProductDataa($data);	
					if($success["result"] =="success")
					{
						$result["result"]="success";
						echo json_encode($result);	
					}	
					else
					{
						$result["result"]="fail";
						echo json_encode($result);				
					}	
				}
				else
				{
						$result["result"]=$this->upload->display_errors();
						echo json_encode($result);
				}
			}
		}
		else
		{
				$result["result"]="fail";
				echo json_encode($result);
		}
	}
	public function RestoreProductData()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->RestoreProductDataa($data);
		echo json_encode($success);
	}
	public function RestoreProductStockData()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->RestoreProductStockDataa($data);
		echo json_encode($success);
	}

	public function CustomerList()
	{
		header('Access-Control-Allow-Origin: *');
		$this->load->view('customer_list');
	}
	public function getCustomerList()
	{
		header('Access-Control-Allow-Origin: *');
		$success=$this->AmuthasurabiModel->CustomerListt();
		echo json_encode($success);
	}
	public function RestoreUserListData()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->RestoreUserListDataa($data);
		echo json_encode($success);
	}
	public function Order()
	{
		header('Access-Control-Allow-Origin: *');
		$this->load->view('order');
	}

	public function getOrders()
	{
		header('Access-Control-Allow-Origin: *');
		$success=$this->AmuthasurabiModel->getOrderss();
		echo json_encode($success);
	}

	public function getorderedproduct()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->getorderedproductt($data);
		echo json_encode($success);
	}
	
	public function updateorderstatusmsg()
	{
		header('Access-Control-Allow-Origin: *');
		$data = $this->input->post();
		$success=$this->AmuthasurabiModel->updateorderstatusmsgg($data);
		echo json_encode($success);
	}

  // <<<======= used function ============>>> //

}


