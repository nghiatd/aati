<?php
class Admin_Model_Admin extends Zend_Db_Table_Abstract{

    public function getAllAdmin(){
        $db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_all_admin()"); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['username'] = $row['username'];
				$data['password'] = $row['password'];
				$data['fullname'] = $row['fullname'];
				$data['gender'] = $row['gender'];
				$data['birthday'] = $row['birthday'];
				$data['address'] = $row['address'];
				$data['email'] = $row['email'];
				$data['phone'] = $row['phone'];
				$data['perID'] = $row['perID'];
				$data['date'] = $row['date'];
				$data['status'] = $row['status'];
				$data['perName'] = $row['perName'];
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
    public function getAdminByID($ID){
        $db = Zend_Registry::get('connectDB');
        $spParams = array($ID);
        try{
			$stmt = $db->query("CALL select_admin(?)", $spParams); 
			$results=$stmt->fetchAll(); 		  
			$datas = array();
			foreach($results as $row){
				$data['id'] = $row['id'];
				$data['username'] = $row['username'];
				$data['password'] = $row['password'];
				$data['fullname'] = $row['fullname'];
				$data['gender'] = $row['gender'];
				$data['birthday'] = $row['birthday'];
				$data['address'] = $row['address'];
				$data['email'] = $row['email'];
				$data['phone'] = $row['phone'];
				$data['perID'] = $row['perID'];
				$data['date'] = $row['date'];
				$data['status'] = $row['status'];
				$data['perName'] = $row['perName'];
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
    public function insertAdmin($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['username'],$arr['password'],$arr['fullname'],$arr['gender'],$arr['birthday'],$arr['address'],$arr['email'],$arr['phone'],$arr['perID'],$arr['date'],$arr['status']);
		try{
			$stmt = $db->query("CALL insert_admin(?,?,?,?,?,?,?,?,?,?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert Admin successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteAdmin($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_admin(?)", $spParams);  		  
			$stmt->closeCursor();
			echo "true";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
		
    }
    public function deleteMultiAdmin($arr,$root_base){
    	$db = Zend_Registry::get('connectDB');
    	$arrID=array();
    	$index=0;
    	for($i=0;$i<count($arr);$i++){
    		$spParams = array($arr[$i]);
			try{
				$stmt = $db->query("CALL delete_admin(?)", $spParams);  		  
				$stmt->closeCursor();
				$arrID[$index++]=$arr[$i];
			}catch(Exception $ex){
				echo $ex->getMessage();
				return $arrID;
			}
    	}
    	return $arrID;
    }
    public function updateInfoAdmin($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_info_admin(?,?,?,?,?,?,?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['fullname']);
			$stmt->bindParam(3,$arr['gender']);
			$stmt->bindParam(4,$arr['birthday']);
			$stmt->bindParam(5,$arr['address']);
			$stmt->bindParam(6,$arr['email']);
			$stmt->bindParam(7,$arr['phone']);
			$stmt->bindParam(8,$arr['perID']);
			$stmt->bindParam(9,$arr['status']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update information Admin successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function updatePassAdmin($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_pass_admin(?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['password']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update Password admin successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function getAllPermission(){
    	$db = Zend_Registry::get('connectDB');
        try{
			$stmt = $db->query("CALL select_all_permission()"); 
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
    public function insertPermission($arr){
    	$db = Zend_Registry::get('connectDB');
		$spParams = array($arr['name'],$arr['order']);
		try{
			$stmt = $db->query("CALL insert_permission(?,?)", $spParams);  		  
			$stmt->closeCursor();  
			echo "Insert Permission successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function deletePermission($id){
    	$db = Zend_Registry::get('connectDB');
    	//Get hinh anh tu co so du lieu
		$spParams = array($id);
		try{
			$stmt = $db->query("CALL delete_permission(?)", $spParams);  		  
			$stmt->closeCursor();
			echo "Delete Permission successfull";
			
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function updatePermission($arr){
    	$db = Zend_Registry::get('connectDB');
		try{
			$stmt = $db->prepare("CALL update_permission(?,?,?)");
			$stmt->bindParam(1,$arr['id']);
			$stmt->bindParam(2,$arr['name']);
			$stmt->bindParam(3,$arr['order']);
			$stmt->execute();
			$stmt->closeCursor();  
			echo "Update Permission successfull";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
    }
    public function checkpass($id,$pass){
    	$db = Zend_Registry::get('connectDB');
    	$spParams = array($id,$pass);
		try{
			$stmt = $db->query("CALL check_pass_admin(?,?)",$spParams);
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