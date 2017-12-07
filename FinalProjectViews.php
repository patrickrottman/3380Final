<?php
	class TasksViews {
		private $stylesheet = 'FinalProjectStyle.css';
		private $pageTitle = 'Permanency Team';
		
		public function __construct() {

		}
		
		public function __destruct() {

		}
		
		public function childrenView($user, $children, $message = '') {
			$body = "<h1>Tasks for {$user->firstName} {$user->lastName}</h1>\n";
		
			if ($message) {
				$body .= "<p class='message'>$message</p>\n";
			}
		
			$body .= "<p><a class='taskButton' href='index.php?view=taskform'>+ Add Task</a> <a class='taskButton' href='index.php?logout=1'>Logout</a></p>\n";
	
			if (count($children) < 1) {
				$body .= "<p>No tasks to display!</p>\n";
				return $this->page($body);
			}
	
			$body .= "<table>\n";
			$body .= "<tr><th>Edit</th>";
		
			$columns = array(array('name' => 'firstName', 'label' => 'First Name'), 
							 array('name' => 'middleName', 'label' => 'Middle Name'), 
							 array('name' => 'lastName', 'label' => 'lastName'), 
							 array('name' => 'dateOfBirth', 'label' => 'Date Of Birth'));
		
			// geometric shapes in unicode
			// http://jrgraphix.net/r/Unicode/25A0-25FF
			//foreach ($columns as $column) {
				//$name = $column['name'];
				//$label = $column['label'];
                
				//$body .= "<th><a class='order' href='index.php?orderby=$name'>$label</a></th>";
			//}
	
			foreach ($children as $child) {
				$id = $child['id'];
                $firstName = $child['firstName'];
                $middleName = $child['middleName'];
                $lastName = $child['lastName'];
                $dateOfBirth = $child['dateOfBirth'];
			
				$body .= "<tr>";
				$body .= "<td><form action='index.php' method='post'><input type='hidden' name='action' value='edit' /><input type='hidden' name='id' value='$id' /><input type='submit' value='Edit'></form></td>";
				$body .= "<td>$firstName</td><td>$middleName</td><td>$lastName</td><td>$dateOfBirth</td>;
				$body .= "</tr>\n";
			}
			$body .= "</table>\n";
	
			return $this->page($body);
		}
		
		public function addChildView($user, $data = null, $message = '') {
			$firstName = '';
            $middleName = '';
            $lastName = '';
            $dateOfBirth = '';
            $caseManagerID = '';
            $caseWorkerID = '';
            $therapistID = '';
            $psychiatristID = '';
            $doctorID = '';
            $fosterParent1ID = '';
            $fosterParent2ID = '';
            $biologicalParent1ID = '';
            $biologicalParent2ID = '';
            
			if ($data) {
                $firstName = $data['firstName'];
                $middleName = $data['middleName'];
                $lastName = $data['lastName'];
                $dateOfBirth = $data['dateOfBirth'];
                $caseManagerID = $data['caseManagerID'];
                $caseWorkerID = $data['caseWorkerID'];
                $therapistID = $data['therapistID'];
                $psychiatristID = $data['psychiatristID'];
                $doctorID = $data['doctorID'];
                $fosterParent1ID = $data['fosterParent1ID'];
                $fosterParent2ID = $data['fosterParent2ID'];
                $biologicalParent1ID = $data['biologicalParent1ID'];
                $biologicalParent2ID = $data['biologicalParent2ID'];
			}
	       if($data)
           {
                $body = "<h1>Edit child for {$user->firstName} {$user->lastName}</h1>\n";
           }else{
                $body = "<h1>Add child for {$user->firstName} {$user->lastName}</h1>\n";
           }

			if ($message) {
				$body .= "<p class='message'>$message</p>\n";
			}
		
			$body .= "<form action='index.php' method='post'>";
		
			if ($data['id']) {
				$body .= "<input type='hidden' name='action' value='update' />";
				$body .= "<input type='hidden' name='id' value='{$data['id']}' />";
			} else {
				$body .= "<input type='hidden' name='action' value='add' />";
			}
		
			$body .= <<<EOT2
  <p>Title<br />
  <input type="text" name="firstName" value="$firstName" placeholder="First Name" maxlength="255" size="80"></p>
  
  <p>Title<br />
  <input type="text" name="middleName" value="$middleName" placeholder="Middle Name" maxlength="255" size="80"></p>
  
  <p>Title<br />
  <input type="text" name="lastName" value="$lastName" placeholder="Last Name" maxlength="255" size="80"></p>
  
  <p>Title<br />
  <input type="text" name="dateOfBirth" value="$dateOfBirth" placeholder="Date Of Birth" maxlength="255" size="80"></p>
  
  <p>Title<br />
  <input type="text" name="caseManagerID" value="$caseManagerID" placeholder="Case Manager ID" maxlength="255" size="80"></p>
  
  <p>Title<br />
  <input type="text" name="caseWorkerID" value="$caseWorkerID" placeholder="Case Worker ID" maxlength="255" size="80"></p>
  
  <p>Title<br />
  <input type="text" name="therapistID" value="$therapistID" placeholder="Therapist ID" maxlength="255" size="80"></p>
  
  <p>Title<br />
  <input type="text" name="psychiatristID" value="$psychiatristID" placeholder="Psychiatrist ID" maxlength="255" size="80"></p>
  
  <p>Title<br />
  <input type="text" name="doctorID" value="$doctorID" placeholder="Doctor ID" maxlength="255" size="80"></p>
  
   <p>Title<br />
  <input type="text" name="fosterParent1ID" value="$fosterParent1ID" placeholder="Foster Parent1 ID" maxlength="255" size="80"></p>
  
   <p>Title<br />
  <input type="text" name="fosterParent2ID" value="$fosterParent2ID" placeholder="Foster Parent2 ID" maxlength="255" size="80"></p>
  
  <p>Title<br />
  <input type="text" name="biologicalParent1ID" value="$biologicalParent1ID" placeholder="Biological Parent1 ID" maxlength="255" size="80"></p>
  
  <p>Title<br />
  <input type="text" name="biologicalParent2ID" value="$biologicalParent2ID" placeholder="Biological Parent2 ID" maxlength="255" size="80"></p>
  
  <input type="submit" name='submit' value="Submit"> <input type="submit" name='cancel' value="Cancel">
</form>
EOT2;

			return $this->page($body);
		}
		
		
		public function loginFormView($data = null, $message = '') {
			$loginID = '';
			if ($data) {
				$loginID = $data['loginid'];
			}
		
			$body = "<h1>Tasks</h1>\n";
			
			if ($message) {
				$body .= "<p class='message'>$message</p>\n";
			}
			
			$body .= <<<EOT
<form action='index.php' method='post'>
<input type='hidden' name='action' value='login' />
<p>Username<br />
  <input type="text" name="loginid" value="$loginID" placeholder="login id" maxlength="255" size="80"></p>
<p>Password<br />
  <input type="password" name="password" value="" placeholder="password" maxlength="255" size="80"></p>
  <input type="submit" name='submit' value="Login">
</form>	
EOT;
			
			return $this->page($body);
		}
		
		public function errorView($message) {	
			$body = "<h1>Permanency Team</h1>\n";
			$body .= "<p>$message</p>\n";
			
			return $this->page($body);
		}
		
		private function page($body) {
			$html = <<<EOT
<!DOCTYPE html>
<html>
<head>
<title>{$this->pageTitle}</title>
<link rel="stylesheet" type="text/css" href="{$this->stylesheet}">
</head>
<body>
$body
<p>&copy; 2017 Permanency Team. All rights reserved.</p>
</body>
</html>
EOT;
			return $html;
		}

}
