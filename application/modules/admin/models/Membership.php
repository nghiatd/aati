<?php
class Admin_Model_Membership extends Zend_Db_Table_Abstract{

	public function getAllMembership(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_all_membership()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['typeid'] = $row['typeid'];
				$data['typeName'] = $row['typeName'];
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
    public function getMembershipByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_membership(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['typeid'] = $row['typeid'];
				$data['typeName'] = $row['typeName'];
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
    public function insertMembership($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['title'],$arr['content'],$arr['date'],$arr['typeid'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_membership(?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert membership successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMembership($id){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_membership(?)", $spParams);  		  
			$stmt->closeCursor();
			echo "true";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiMembership($arr,$root_base){
    	$db = Zend_Registry::get('connectDB');
    	$arrID=array();
    	$index=0;
    	for($i=0;$i<count($arr);$i++){
    		$data=$this->getAboutByID($arr[$i]);
    		$image=$root_base.$data[0]['image'];
    		$spParams = array($arr[$i]);  
			try{
				$stmt = $db->query("CALL delete_membership(?)", $spParams);  		  
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
    public function deleteImageMembership($image){
    	if(file_exists($image))
    		unlink($image);
    	//echo $images;		
    }
    public function updateMembership($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_membership(?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['title']);
			$stmt->bindParam(3,$arr['content']);
			$stmt->bindParam(4,$arr['typeid']);
			$stmt->bindParam(5,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update membership successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }


    public function insertTypeMembership($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['name'],$arr['seo'],$arr['order'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_type_membership(?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert type membership successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}		
    }
    public function deleteTypeMembership($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_type_membership(?)", $spParams);  		  
			$stmt->closeCursor();
			echo "Delete type membership successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function updateTypeMembership($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_type_membership(?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['name']);
			$stmt->bindParam(3,$arr['seo']);
			$stmt->bindParam(4,$arr['order']);
			$stmt->bindParam(5,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update type membership successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function getAllTypeMembership(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_alltype_membership()"); 
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
	public function getAllActiveTypeMembership(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_active_type_membership()"); 
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
    public function getTypeMembershipByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_type_membership(?)", $spParams); 
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