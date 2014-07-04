<?php
class Default_Model_User extends Zend_Db_Table_Abstract{

    public function getAllUser(){
        $db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_all_user()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['username'] = $row['username'];
				$data['password'] = $row['password'];
				$data['company'] = $row['company'];
				$data['logo'] = $row['logo'];
				$data['address'] = $row['address'];
				$data['description'] = $row['description'];
				$data['email'] = $row['email'];
				$data['phone'] = $row['phone'];
				$data['fax'] = $row['fax'];
				$data['website'] = $row['website'];
				$data['date'] = $row['date'];
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
    public function getAllActiveUser(){
        $db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_allactive_user()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['username'] = $row['username'];
				$data['password'] = $row['password'];
				$data['company'] = $row['company'];
				$data['logo'] = $row['logo'];
				$data['address'] = $row['address'];
				$data['description'] = $row['description'];
				$data['email'] = $row['email'];
				$data['phone'] = $row['phone'];
				$data['fax'] = $row['fax'];
				$data['website'] = $row['website'];
				$data['date'] = $row['date'];
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
    public function getUserByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_user(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['username'] = $row['username'];
				$data['password'] = $row['password'];
				$data['company'] = $row['company'];
				$data['logo'] = $row['logo'];
				$data['address'] = $row['address'];
				$data['description'] = $row['description'];
				$data['email'] = $row['email'];
				$data['phone'] = $row['phone'];
				$data['fax'] = $row['fax'];
				$data['website'] = $row['website'];
				$data['date'] = $row['date'];
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
    public function getUserByEmail($Email){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($Email);
        try{
			$stmt = $db->query("CALL select_user_by_email(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['username'] = $row['username'];
				$data['password'] = $row['password'];
				$data['company'] = $row['company'];
				$data['logo'] = $row['logo'];
				$data['address'] = $row['address'];
				$data['description'] = $row['description'];
				$data['email'] = $row['email'];
				$data['phone'] = $row['phone'];
				$data['fax'] = $row['fax'];
				$data['website'] = $row['website'];
				$data['date'] = $row['date'];
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
    public function checklogin($username,$password){
    	$db = Zend_Registry::get('connectDB');
        $spParams = array($username,$password);
        try{
			$stmt = $db->query("CALL select_login(?,?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['username'] = $row['username'];
				$data['password'] = $row['password'];
				$data['company'] = $row['company'];
				$data['logo'] = $row['logo'];
				$data['address'] = $row['address'];
				$data['description'] = $row['description'];
				$data['email'] = $row['email'];
				$data['phone'] = $row['phone'];
				$data['fax'] = $row['fax'];
				$data['website'] = $row['website'];
				$data['date'] = $row['date'];
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
    public function insertUser($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['username'],$arr['password'],$arr['company'],$arr['logo'],$arr['address'],$arr['description'],$arr['email'],$arr['phone'],$arr['fax'],$arr['website'],$arr['date'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_user(?,?,?,?,?,?,?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert User successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteUser($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_user(?)", $spParams);  		  
			$stmt->closeCursor();
			echo "true";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiUser($arr,$root_base){
    	$db = Zend_Registry::get('connectDB');
    	$arrID=array();
    	$index=0;
    	for($i=0;$i<count($arr);$i++){
    		$spParams = array($arr[$i]);
			try{
				$stmt = $db->query("CALL delete_user(?)", $spParams);  		  
				$stmt->closeCursor();
				$arrID[$index++]=$arr[$i];
			}catch(Exception $ex){
				echo $ex->getMessage();
				return $arrID;
			}
    	}
    	return $arrID;
    }
    public function updateInfoUser($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_info_user(?,?,?,?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['company']);
			$stmt->bindParam(3,$arr['logo']);
			$stmt->bindParam(4,$arr['address']);
			$stmt->bindParam(5,$arr['description']);
			$stmt->bindParam(6,$arr['email']);
			$stmt->bindParam(7,$arr['phone']);
			$stmt->bindParam(8,$arr['fax']);
			$stmt->bindParam(9,$arr['website']);
			$stmt->bindParam(10,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			return true;
		}catch(Exception $ex){
			echo $ex->getMessage();
			return false;
		}
    }
    public function updatePassUser($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_pass_user(?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['password']);
			$stmt->execute();
			$stmt->closeCursor();  
			return true;
		}catch(Exception $ex){
			echo $ex->getMessage();
			return false;
		}
    }
    public function updatePassUserForgot($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_pass_user_forgot(?,?)");
			$stmt->bindParam(1,$arr['email']);
			$stmt->bindParam(2,$arr['password']);
			$stmt->execute();
			$stmt->closeCursor();  
			return true;
		}catch(Exception $ex){
			echo $ex->getMessage();
			return false;
		}
    }
    public function checkpass($id,$pass){
    	$db = Zend_Registry::get('connectDB');
    	$spParams = array($id,$pass);
		try{
			$stmt = $db->query("CALL check_pass_user(?,?)",$spParams);
			$result=$stmt->fetchAll(); 
			$stmt->closeCursor(); 
			if(count($result)>0){
				echo "true";
			}else{
				echo "false";
			}
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
}