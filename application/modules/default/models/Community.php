<?php
class Default_Model_Community extends Zend_Db_Table_Abstract{

	public function getAllCommunity(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_all_community()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['link'] = $row['link'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['author'] = $row['author'];
				$data['typeid'] = $row['typeid'];
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
    public function getCommunityByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_community(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['link'] = $row['link'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['author'] = $row['author'];
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
    public function getCommunityByTypeCommunity($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_community_by_typecommunity(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['link'] = $row['link'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['author'] = $row['author'];
				$data['typeid'] = $row['typeid'];
				$data['status'] = $row['status'];
				$data['typeName'] = $row['typeName'];
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
    public function getCommunityByAuthor($Author){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($Author);
        try{
			$stmt = $db->query("CALL select_community_by_author(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['link'] = $row['link'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['author'] = $row['author'];
				$data['typeid'] = $row['typeid'];
				$data['status'] = $row['status'];
				$data['typeName'] = $row['typeName'];
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
    public function insertCommunity($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['title'],$arr['link'],$arr['description'],$arr['content'],$arr['date'],$arr['author'],$arr['typeid'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_community(?,?,?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert community successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteCommunity($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
    	$data=$this->getAboutByID($id);
    	$image=ROOT_CONFIG.$data[0]['image'];
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_community(?)", $spParams);  		  
			$stmt->closeCursor();
			if(file_exists($image) && $data[0]['image']!=""){
				unlink($image);
			}
			echo "true";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiCommunity($arr,$root_base){
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
    public function deleteImageCommunity($image){
    	if(file_exists($image))
    		unlink($image);
    	//echo $images;		
    }
    public function updateCommunity($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_community(?,?,?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['title']);
			$stmt->bindParam(3,$arr['link']);
			$stmt->bindParam(4,$arr['description']);
			$stmt->bindParam(5,$arr['content']);
			$stmt->bindParam(6,$arr['date']);
			$stmt->bindParam(7,$arr['author']);
			$stmt->bindParam(8,$arr['typeid']);
			$stmt->bindParam(9,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update community successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }


    public function insertTypeCommunity($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['name'],$arr['seo'],$arr['order'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_type_community(?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert type commnunity successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}		
    }
    public function deleteTypeCommunity($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_type_community(?)", $spParams);  		  
			$stmt->closeCursor();
			echo "Delete type commnunity successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function updateTypeCommunity($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_type_community(?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['name']);
			$stmt->bindParam(3,$arr['seo']);
			$stmt->bindParam(4,$arr['order']);
			$stmt->bindParam(5,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update type commnunity successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function getAllTypeCommunity(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_alltype_community()"); 
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
	public function getAllActiveTypeCommunity(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_active_alltype_community()"); 
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
    public function getTypeCommunityByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_type_community(?)", $spParams); 
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
    public function getOldActiveCommunity($gid,$id){
		$db = Zend_Registry::get('connectDB');
		$spParams = array($gid,$id);
        try{
			$stmt = $db->query("CALL select_oldactive_community(?,?)",$spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['link'] = $row['link'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['author'] = $row['author'];
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
}