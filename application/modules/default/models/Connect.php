<?php
class Default_Model_Connect extends Zend_Db_Table_Abstract{

	public function getAllConnect(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_allactive_connect()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['icon'] = $row['icon'];
				$data['title'] = $row['title'];
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
    public function getConnectByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_connect(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['icon'] = $row['icon'];
				$data['title'] = $row['title'];
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
    public function insertConnect($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['icon'],$arr['title'],$arr['link'],$arr['date'],$arr['order'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_connect(?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert Connect successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteConnect($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
    	$data=$this->getConnectByID($id);
    	$image=ROOT_CONFIG.$data[0]['icon'];
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_connect(?)", $spParams);  		  
			$stmt->closeCursor();
			if(file_exists($image)){
				unlink($image);
			}
			echo "Delete Connect successfull";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiConnect($arr,$root_base){
    	$db = Zend_Registry::get('connectDB');
    	$arrID=array();
    	$index=0;
    	for($i=0;$i<count($arr);$i++){
    		$spParams = array($arr[$i]);
    		$data=$this->getConnectByID($arr[$i]);
    		$image=$root_base.$data[0]['image'];  
			try{
				$stmt = $db->query("CALL delete_connect(?)", $spParams);  		  
				$stmt->closeCursor();
				deleteImageConnect($image);
				$arrID[$index++]=$arr[$i];
			}catch(Exception $ex){
				echo $ex->getMessage();
				return $arrID;
			}
    	}
    	return $arrID;
    }
    public function deleteImageConnect($image){
    	if(file_exists($image))
    		unlink($image);
    	//echo $images;		
    }
    public function updateConnect($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_connect(?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['icon']);
			$stmt->bindParam(3,$arr['title']);
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