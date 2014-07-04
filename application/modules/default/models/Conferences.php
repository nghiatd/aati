<?php
class Default_Model_Conferences extends Zend_Db_Table_Abstract{

	public function getAllConferences(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_all_conferences()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['image'] = $row['image'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['start_date'] = $row['start_date'];
				$data['end_date'] = $row['end_date'];
				$data['location'] = $row['location'];
				$data['contact'] = $row['contact'];
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
    public function getConferencesByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_conferences(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['image'] = $row['image'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['start_date'] = $row['start_date'];
				$data['end_date'] = $row['end_date'];
				$data['location'] = $row['location'];
				$data['contact'] = $row['contact'];
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
    public function getAllConferencesActive(){
        $db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_active_conferences()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['image'] = $row['image'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['start_date'] = $row['start_date'];
				$data['end_date'] = $row['end_date'];
				$data['location'] = $row['location'];
				$data['contact'] = $row['contact'];
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
    public function getAllConferencesActiveByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_active_conferences_byID(?)",$spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['image'] = $row['image'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['start_date'] = $row['start_date'];
				$data['end_date'] = $row['end_date'];
				$data['location'] = $row['location'];
				$data['contact'] = $row['contact'];
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
    public function insertConferences($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['title'],$arr['image'],$arr['description'],$arr['content'],$arr['date'],$arr['start_date'],$arr['end_date'],$arr['location'],$arr['contact'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_conferences(?,?,?,?,?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert conferences successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function deleteConferences($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
    	$data=$this->getConferencesByID($id);
    	$image=ROOT_CONFIG.$data[0]['image'];
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_conferences(?)", $spParams);  		  
			$stmt->closeCursor();
			if(file_exists($image) && $data[0]['image']!=""){
				unlink($image);
			}
			echo "true";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiConferences($arr,$root_base){
    	$db = Zend_Registry::get('connectDB');
    	$arrID=array();
    	$index=0;
    	for($i=0;$i<count($arr);$i++){
    		$data=$this->getConferencesByID($arr[$i]);
    		$image=ROOT_CONFIG.$data[0]['image'];
    		$spParams = array($arr[$i]);  
			try{
				$stmt = $db->query("CALL delete_conferences(?)", $spParams);  		  
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
    public function deleteImageConferences($image){
    	if(file_exists($image))
    		unlink($image);
    	//echo $images;		
    }
    public function updateConferences($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_conferences(?,?,?,?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['title']);
			$stmt->bindParam(3,$arr['image']);
			$stmt->bindParam(4,$arr['description']);
			$stmt->bindParam(5,$arr['content']);
			$stmt->bindParam(6,$arr['start_date']);
			$stmt->bindParam(7,$arr['end_date']);
			$stmt->bindParam(8,$arr['location']);
			$stmt->bindParam(9,$arr['contact']);
			$stmt->bindParam(10,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update conferences successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }

}