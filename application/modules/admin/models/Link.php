<?php
class Admin_Model_Link extends Zend_Db_Table_Abstract{

	public function getAllLink(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_all_link()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
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
    public function getLinkByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_link(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
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
    public function insertLink($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['name'],$arr['title'],$arr['link'],$arr['date'],$arr['order'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_link(?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert link successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteLink($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_link(?)", $spParams);  		  
			$stmt->closeCursor();
			echo "true";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiLink($arr,$root_base){
    	$db = Zend_Registry::get('connectDB');
    	$arrID=array();
    	$index=0;
    	for($i=0;$i<count($arr);$i++){
    		$spParams = array($arr[$i]);  
			try{
				$stmt = $db->query("CALL delete_link(?)", $spParams);  		  
				$stmt->closeCursor();
				$arrID[$index++]=$arr[$i];
			}catch(Exception $ex){
				echo $ex->getMessage();
				return $arrID;
			}
    	}
    	return $arrID;
    }
    public function deleteImageLink($image){
    	if(file_exists($image))
    		unlink($image);
    	//echo $images;		
    }
    public function updateLink($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_link(?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['name']);
			$stmt->bindParam(3,$arr['title']);
			$stmt->bindParam(4,$arr['link']);
			$stmt->bindParam(5,$arr['date']);
			$stmt->bindParam(6,$arr['order']);
			$stmt->bindParam(7,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update link successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    
}