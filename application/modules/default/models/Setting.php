<?php
class Default_Model_Setting extends Zend_Db_Table_Abstract{

	
    public function getSetting(){
        $db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_setting()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data=array();
				$data['company'] = $row['company'];
				$data['description'] = $row['description'];
				$data['logo'] = $row['logo'];
				$data['address'] = $row['address'];
				$data['email'] = $row['email'];
				$data['telephone'] = $row['telephone'];
				$data['fax'] = $row['fax'];
				$data['website'] = $row['website'];
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
    public function insertSetting($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['company'],$arr['description'],$arr['logo'],$arr['address'],$arr['email'],$arr['telephone'],$arr['fax'],$arr['website']);
		try{
			$stmt = $db->query("CALL insert_setting(?,?,?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert setting successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    
    public function deleteImageLogo($image){
    	if(file_exists($image))
    		unlink($image);
    	//echo $images;		
    }
    public function updateSetting($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_setting(?,?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['company']);
			$stmt->bindParam(2,$arr['description']);
			$stmt->bindParam(3,$arr['logo']);
			$stmt->bindParam(4,$arr['address']);
			$stmt->bindParam(5,$arr['email']);
			$stmt->bindParam(6,$arr['telephone']);
			$stmt->bindParam(7,$arr['fax']);
			$stmt->bindParam(8,$arr['website']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update setting successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    
}