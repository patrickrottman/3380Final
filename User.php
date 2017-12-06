<?php

class User {
	public $firstName = '';
	public $middleName = '';
	public $lastName = '';
	public $username = '';
	public $workerID = 0;
	public $hashedPassword = '';
	public $role = '';
	
	public function load($username, $mysqli) {
		$this->clear();
	
		if (! $mysqli) {
			return false;
		}
		
		//$usernameEscaped = $mysqli->real_escape_string($username);
	
		$stmt = $mysqli->prepare("SELECT * FROM workers WHERE username = ?");
		
		if (! ($stmt->bind_param("s", $username)) ) {
				return false;
			}
		if (! $stmt->execute() ) {
			return false;
		}
		
		if (! ($result = $stmt->get_result()) ) {
			return false;
		}
		
		if ($result->num_rows > 0) {
			$user = $result->fetch_assoc();
			$this->firstName = $user['firstName'];
			$this->middleName = $user['middleName'];
			$this->lastName = $user['lastName'];
			$this->username = $user['username'];
			$this->workerID = $user['id'];
			$this->hashedPassword = $user['password'];
			$this->role = $user['role'];
		}
			
		$stmt->close();
		
		return true;
	
		//$sql = "SELECT * FROM workers WHERE username = '$usernameEscaped'";
		
		/*if ($result = $mysqli->query($sql)) {
			if ($result->num_rows > 0) {
				$user = $result->fetch_assoc();
				$this->firstName = $user['firstName'];
				$this->lastName = $user['lastName'];
				$this->username = $user['username'];
				$this->workerID = $user['id'];
				$this->hashedPassword = $user['password'];
				$this->role = $user['role'];
			}
			$result->close();
			return true;
		} else {
			return false;
		}*/
	}
	
	private function clear() {
		$firstName = '';
		$middleName = '';
		$lastName = '';
		$loginID = '';
		$userID = 0;
		$hashedPassword = '';
		$role = '';
	}
}

?>