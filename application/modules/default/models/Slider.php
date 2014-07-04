<?php
class Default_Model_Slider extends Zend_Db_Table_Abstract{

	public function getAllSlider(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_allactive_slider()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['image'] = $row['image'];
				$data['url'] = $row['url'];
				$data['status'] = $row['status'];
				$data['order'] = $row['order'];
				$data['dateAdd'] = $row['dateAdd'];
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
    public function getSliderByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_slider(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['image'] = $row['image'];
				$data['url'] = $row['url'];
				$data['status'] = $row['status'];
				$data['order'] = $row['order'];
				$data['dateAdd'] = $row['dateAdd'];
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
    public function insertSlider($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['name'],$arr['image'],$arr['url'],$arr['status'],$arr['order'],$arr['dateAdd']);
		try{
			$stmt = $db->query("CALL insert_slider(?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert slider successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteSlider($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu

    	$data=$this->getSliderByID($id);
    	$image=ROOT_CONFIG.$data[0]['image'];

		$spParams = array($id);  
		try{
			$stmt = $db->query("CALL delete_slider(?)", $spParams);  		  
			$stmt->closeCursor();
			if(file_exists($image)){
				unlink($image);
			}
			echo "true";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiSlider($arr,$root_base){
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
    public function updateSlider($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_slider(?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['name']);
			$stmt->bindParam(3,$arr['image']);
			$stmt->bindParam(4,$arr['url']);
			$stmt->bindParam(5,$arr['status']);
			$stmt->bindParam(6,$arr['order']);
			$stmt->bindParam(7,$arr['dateAdd']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "true";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    
}