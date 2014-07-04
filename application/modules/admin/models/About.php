<?php
class Admin_Model_About extends Zend_Db_Table_Abstract{

	public function getAllAbout(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_all_about()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['image'] = $row['image'];
				$data['address'] = $row['address'];
				$data['email'] = $row['email'];
				$data['introductions'] = $row['introductions'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['order'] = $row['order'];
				$data['status'] = $row['status'];
				$datas[] = $data;
				unset($data);
			}
			$stmt->closeCursor();  
			return $datas;

		}catch(Exception $ex){
			echo "<script>";
			echo "alert('". $ex->getMessage()."')";
			echo "</script>";
		}
	}
    public function getAboutByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_about(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['link'] = $row['link'];
				$data['image'] = $row['image'];
				$data['address'] = $row['address'];
				$data['email'] = $row['email'];
				$data['introductions'] = $row['introductions'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['typeid'] = $row['typeid'];
				$data['order'] = $row['order'];
				$data['status'] = $row['status'];
				$datas[] = $data;
				unset($data);
			}
			$stmt->closeCursor();  
			return $datas;

		}catch(Exception $ex){
			echo "<script>";
			echo "alert('". $ex->getMessage()."')";
			echo "</script>";
		}
    }
    public function insertAbout($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['name'],$arr['link'],$arr['image'],$arr['address'],$arr['email'],$arr['introductions'],$arr['content'],$arr['date'],$arr['typeid'],$arr['order'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_about(?,?,?,?,?,?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert about successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteAbout($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
    	$data=$this->getAboutByID($id);
    	$image=ROOT_CONFIG.$data[0]['image'];
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_about(?)", $spParams);  		  
			$stmt->closeCursor();
			if(file_exists($image) && $data[0]['image']!=""){
				unlink($image);
			}
			echo "true";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiAbout($arr,$root_base){
    	$db = Zend_Registry::get('connectDB');
    	$arrID=array();
    	$index=0;
    	for($i=0;$i<count($arr);$i++){
    		$data=$this->getAboutByID($arr[$i]);
    		$image=$root_base.$data[0]['image'];
    		$spParams = array($arr[$i]);  
			try{
				$stmt = $db->query("CALL delete_about(?)", $spParams);  		  
				$stmt->closeCursor();
				deleteImageNews($image);
				$arrID[$index++]=$arr[$i];
			}catch(Exception $ex){
				echo $ex->getMessage();
				return $arrID;
			}
    	}
    	return $arrID;
    }
    public function deleteImageAbout($image){
    	if(file_exists($image))
    		unlink($image);
    	//echo $images;		
    }
    public function updateAbout($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_about(?,?,?,?,?,?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['name']);
			$stmt->bindParam(3,$arr['link']);
			$stmt->bindParam(4,$arr['image']);
			$stmt->bindParam(5,$arr['address']);
			$stmt->bindParam(6,$arr['email']);
			$stmt->bindParam(7,$arr['introductions']);
			$stmt->bindParam(8,$arr['content']);
			$stmt->bindParam(9,$arr['date']);
			$stmt->bindParam(10,$arr['typeid']);
			$stmt->bindParam(11,$arr['order']);
			$stmt->bindParam(12,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update about successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }


    public function insertTypeAbout($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['name'],$arr['seo'],$arr['order'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_type_about(?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert type about successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}		
    }
    public function deleteTypeAbout($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_type_about(?)", $spParams);  		  
			$stmt->closeCursor();
			echo "Delete type about successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function updateTypeAbout($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_type_about(?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['name']);
			$stmt->bindParam(3,$arr['seo']);
			$stmt->bindParam(4,$arr['order']);
			$stmt->bindParam(5,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update type about successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function getAllTypeAbout(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_alltype_about()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['seo'] = $row['seo'];
				$data['order'] = $row['order'];
				$data['status'] = $row['status'];
				$datas[] = $data;
				unset($data);
			}
			$stmt->closeCursor();  
			return $datas;

		}catch(Exception $ex){
			echo "<script>";
			echo "alert('". $ex->getMessage()."')";
			echo "</script>";
		}
	}
	public function getAllActiveTypeAbout(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_active_alltype_about()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['seo'] = $row['seo'];
				$data['order'] = $row['order'];
				$data['status'] = $row['status'];
				$datas[] = $data;
				unset($data);
			}
			$stmt->closeCursor();  
			return $datas;

		}catch(Exception $ex){
			echo "<script>";
			echo "alert('". $ex->getMessage()."')";
			echo "</script>";
		}
	}
    public function getTypeAboutByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_type_about(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['seo'] = $row['seo'];
				$data['order'] = $row['order'];
				$data['status'] = $row['status'];
				$datas[] = $data;
				unset($data);
			}
			$stmt->closeCursor();  
			return $datas;

		}catch(Exception $ex){
			echo "<script>";
			echo "alert('". $ex->getMessage()."')";
			echo "</script>";
		}
    }
}