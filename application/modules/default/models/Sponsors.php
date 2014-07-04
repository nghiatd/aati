<?php
class Default_Model_Sponsors extends Zend_Db_Table_Abstract{

	public function getAllSponsors(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_allactive_sponsors()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['image'] = $row['image'];
				$data['link'] = $row['link'];
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
    public function getSponsorsByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("SELECT * FROM sponsors WHERE `status`=1 AND `id`=?", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['image'] = $row['image'];
				$data['link'] = $row['link'];
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
    public function insertSponsors($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['name'],$arr['image'],$arr['link'],$arr['date'],$arr['order'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_sponsors(?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert sponsors successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteImage($image){
    	if(file_exists($image)){
    		unlink($image);
    	}
    }
    public function deleteSponsors($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
    	$data=$this->getSponsorsByID($id);
    	$image=ROOT_CONFIG.$data[0]['image'];
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_sponsors(?)", $spParams);  		  
			$stmt->closeCursor();
			if(file_exists($image)){
				unlink($image);
			}
			echo "true";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiSponsors($arr,$root_base){
    	$db = Zend_Registry::get('connectDB');
    	$arrID=array();
    	$index=0;
    	for($i=0;$i<count($arr);$i++){
    		$spParams = array($arr[$i]);
    		$data=$this->getAboutByID($arr[$i]);
    		$image=$root_base.$data[0]['image'];  
			try{
				$stmt = $db->query("CALL delete_sponsors(?)", $spParams);  		  
				$stmt->closeCursor();
				deleteImage($image);
				$arrID[$index++]=$arr[$i];
			}catch(Exception $ex){
				echo $ex->getMessage();
				return $arrID;
			}
    	}
    	return $arrID;
    }
    
    public function updateSponsors($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_sponsors(?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['name']);
			$stmt->bindParam(3,$arr['image']);
			$stmt->bindParam(4,$arr['link']);
			$stmt->bindParam(5,$arr['date']);
			$stmt->bindParam(6,$arr['order']);
			$stmt->bindParam(7,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "true";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    
}