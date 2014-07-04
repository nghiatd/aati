<?php
class Admin_Model_Banner extends Zend_Db_Table_Abstract{

    public function getBannerByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_banner(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['ID_banner'] = $row['ID_banner'];
				$data['name'] = $row['name'];
				$data['images'] = $row['images'];
				$data['link'] = $row['link'];
				$data['status'] = $row['status'];
				$data['dateAdd'] = $row['dateAdd'];
				$data['dateModified'] = $row['dateModified'];
				$data['orderby'] = $row['orderby'];
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
    public function insertBanner($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['name'],$arr['images'],$arr['link'],$arr['status'],$arr['dateAdd'],$arr['orderby']);
		try{
			$stmt = $db->query("CALL insert_banner(?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert banner thành công";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteBanner($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu

    	$data=$this->getBannerByID($id);
    	$image=ROOT_CONFIG.$data[0]['images'];

		$spParams = array($id);  
		try{
			$stmt = $db->query("CALL delete_banner(?)", $spParams);  		  
			$stmt->closeCursor();
			$check =$this->deleteImageBanner($image);
			if($check){
				echo "Xóa banner thành công";
			}
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiBanner($arr,$root_base){
    	$db = Zend_Registry::get('connectDB');
    	$arrID=array();
    	$index=0;
    	for($i=0;$i<count($arr);$i++){
    		$data=$this->getBannerByID($arr[$i]);
    		$image=$root_base.$data[0]['images'];
    		$spParams = array($arr[$i]);  
			try{
				$stmt = $db->query("CALL delete_banner(?)", $spParams);  		  
				$stmt->closeCursor();
				$check=unlink($image);
				$arrID[$index++]=$arr[$i];
			}catch(Exception $ex){
				echo $ex->getMessage();
				return $arrID;
			}
    	}
    	return $arrID;
    }
    public function deleteImageBanner($images){
    	return unlink($images);
    	//echo $images;		
    }
    public function updateBanner($arr){
    	$db = Zend_Registry::get('connectDB');
		//echo ('CALL update_banner('.$arr['ID_banner'].','.$arr['name'].','.$arr['images'].','.$arr['link'].','.$arr['status'].','.$arr['dateModified'].','.$arr['orderby'].')');
		try{
			$stmt = $db->prepare("CALL update_banner(?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['ID_banner']);
			$stmt->bindParam(2,$arr['name']);
			$stmt->bindParam(3,$arr['images']);
			$stmt->bindParam(4,$arr['link']);
			$stmt->bindParam(5,$arr['status']);
			$stmt->bindParam(6,$arr['dateModified']);
			$stmt->bindParam(7,$arr['orderby']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Sửa banner thành công";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    
}