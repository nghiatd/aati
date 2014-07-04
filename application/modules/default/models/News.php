<?php
class Default_Model_News extends Zend_Db_Table_Abstract{

	public function getAllActiveNews(){
		$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_allactive_news()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['image'] = $row['image'];
				$data['idType'] = $row['idType'];
				$data['link'] = $row['link'];
				$data['author'] = $row['author'];
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
	public function getOldActiveNews($id){
		$db = Zend_Registry::get('connectDB');
		$spParams = array($id);
        try{
			$stmt = $db->query("CALL select_oldactive_news(?)",$spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['image'] = $row['image'];
				$data['idType'] = $row['idType'];
				$data['link'] = $row['link'];
				$data['author'] = $row['author'];
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
    public function getNewsByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_news(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['image'] = $row['image'];
				$data['idType'] = $row['idType'];
				$data['link'] = $row['link'];
				$data['author'] = $row['author'];
				$data['order'] = $row['order'];
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
    public function getWelcomeNews($number){
    	$db = Zend_Registry::get('connectDB');
        $spParams = array($number);
        try{
			//$stmt = $db->query("CALL select_welcome_news(?)", $spParams); 
			$stmt = $db->query("SELECT n.*,t.`name` AS `typeName` FROM `news` AS n INNER JOIN `typenews` AS t ON n.`idType`=t.`id` WHERE t.`id`=3 ORDER BY n.`id` DESC LIMIT 0,1 ", $spParams);  
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['image'] = $row['image'];
				$data['idType'] = $row['idType'];
				$data['link'] = $row['link'];
				$data['author'] = $row['author'];
				$data['order'] = $row['order'];
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
    public function getLastEventNews($number){
    	$db = Zend_Registry::get('connectDB');
        $spParams = array($number);
        try{
			//$stmt = $db->query("CALL select_lastevent_news(?)", $spParams); 
			$stmt = $db->query("SELECT n.*,t.`name` AS `typeName` FROM `news` AS n INNER JOIN `typenews` AS t ON n.`idType`=t.`id` WHERE t.`id`=1 ORDER BY n.`id` DESC LIMIT 0,5", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['image'] = $row['image'];
				$data['idType'] = $row['idType'];
				$data['link'] = $row['link'];
				$data['author'] = $row['author'];
				$data['order'] = $row['order'];
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
    public function getNewsNormal($number){
    	$db = Zend_Registry::get('connectDB');
        $spParams = array($number);
        try{
			//$stmt = $db->query("CALL select_normal_news(?)", $spParams); 
			$stmt = $db->query("SELECT n.*,t.`name` AS `typeName` FROM `news` AS n INNER JOIN `typenews` AS t ON n.`idType`=t.`id` WHERE t.`id`=2 ORDER BY n.`id` DESC LIMIT 0,4", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['image'] = $row['image'];
				$data['idType'] = $row['idType'];
				$data['link'] = $row['link'];
				$data['author'] = $row['author'];
				$data['order'] = $row['order'];
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
    public function getTopNews($number){
    	$db = Zend_Registry::get('connectDB');
    	$spParams = array($number);
        try{
			$stmt = $db->query("CALL select_top_news(?)",$spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['image'] = $row['image'];
				$data['idType'] = $row['idType'];
				$data['link'] = $row['link'];
				$data['author'] = $row['author'];
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
    public function getLastEventNewsByID($id){
    	$db = Zend_Registry::get('connectDB');
        $spParams = array($id);
        try{
			$stmt = $db->query("CALL select_lastevent_byID_news(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['image'] = $row['image'];
				$data['idType'] = $row['idType'];
				$data['link'] = $row['link'];
				$data['author'] = $row['author'];
				$data['order'] = $row['order'];
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
    public function getNormalNewsByID($id){
    	$db = Zend_Registry::get('connectDB');
        $spParams = array($id);
        try{
			$stmt = $db->query("CALL select_normal_byID_news(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['title'] = $row['title'];
				$data['description'] = $row['description'];
				$data['content'] = $row['content'];
				$data['date'] = $row['date'];
				$data['image'] = $row['image'];
				$data['idType'] = $row['idType'];
				$data['link'] = $row['link'];
				$data['author'] = $row['author'];
				$data['order'] = $row['order'];
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






    public function insertNews($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['title'],$arr['description'],$arr['content'],$arr['date'],$arr['image'],$arr['idType'],$arr['link'],$arr['author'],$arr['order'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_news(?,?,?,?,?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert news successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteNews($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
    	$data=$this->getNewsByID($id);
    	$image=ROOT_CONFIG.$data[0]['image'];
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_news(?)", $spParams);  		  
			$stmt->closeCursor();
			$this->deleteImageNews($image);
			echo "true";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiNews($arr,$root_base){
    	$db = Zend_Registry::get('connectDB');
    	$arrID=array();
    	$index=0;
    	for($i=0;$i<count($arr);$i++){
    		$data=$this->getNewsByID($arr[$i]);
    		$image=$root_base.$data[0]['image'];
    		$spParams = array($arr[$i]);  
			try{
				$stmt = $db->query("CALL delete_news(?)", $spParams);  		  
				$stmt->closeCursor();
				deleteImageNews();
				$arrID[$index++]=$arr[$i];
			}catch(Exception $ex){
				echo $ex->getMessage();
				return $arrID;
			}
    	}
    	return $arrID;
    }
    public function deleteImageNews($image){
    	if(file_exists($image)){
    		unlink($image);
    	}
    		
    	//echo $images;		
    }
    public function updateNews($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_news(?,?,?,?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['title']);
			$stmt->bindParam(3,$arr['description']);
			$stmt->bindParam(4,$arr['content']);
			$stmt->bindParam(5,$arr['image']);
			$stmt->bindParam(6,$arr['idType']);
			$stmt->bindParam(7,$arr['link']);
			$stmt->bindParam(8,$arr['author']);
			$stmt->bindParam(9,$arr['order']);
			$stmt->bindParam(10,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update news successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function getAllTypeNews(){
    	$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_all_typenews()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['name'] = $row['name'];
				$data['order'] = $row['order'];
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
    public function insertTypeNews($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['name'],$arr['order']);
		try{
			$stmt = $db->query("CALL insert_typenews(?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert Type News successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function deleteTypeNews($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_typenews(?)", $spParams);  		  
			$stmt->closeCursor();
			echo "Delete Type News successfull";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function updateTypeNews($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_typenews(?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['name']);
			$stmt->bindParam(3,$arr['order']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update type news successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}

    }
    
}