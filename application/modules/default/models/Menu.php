<?php
class Default_Model_Menu extends Zend_Db_Table_Abstract{

	public function getAllMenu(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_allactive_menu()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['link'] = $row['link'];
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
    public function getMenuByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_menu(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['link'] = $row['link'];
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
    public function insertMenu($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['name'],$arr['link'],$arr['order'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_menu(?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert menu successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMenu($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu

		$spParams = array($id);  
		try{
			$stmt = $db->query("CALL delete_menu(?)", $spParams);  		  
			$stmt->closeCursor();
			echo "Delete menu successfull";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiMenu($arr,$root_base){
    	$db = Zend_Registry::get('connectDB');
    	$arrID=array();
    	$index=0;
    	for($i=0;$i<count($arr);$i++){
    		$data=$this->getBannerByID($arr[$i]);
    		$image=$root_base.$data[0]['image'];
    		$spParams = array($arr[$i]);  
			try{
				$stmt = $db->query("CALL delete_slider(?)", $spParams);  		  
				$stmt->closeCursor();
				deleteImageSlider();
				$arrID[$index++]=$arr[$i];
			}catch(Exception $ex){
				echo $ex->getMessage();
				return $arrID;
			}
    	}
    	return $arrID;
    }
    public function deleteImageSlider($image){
    	if(file_exists($image))
    		unlink($image);
    	//echo $images;		
    }
    public function updateMenu($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_menu(?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['name']);
			$stmt->bindParam(3,$arr['link']);
			$stmt->bindParam(4,$arr['order']);
			$stmt->bindParam(5,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update menu successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    
}