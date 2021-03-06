<?php
	class FinalProjectViews {
		private $stylesheet = 'finalProjectStyle.css';
		private $pageTitle = 'Permanency Team';
		
		public function __construct() {

		}
		
		public function __destruct() {

		}
		
		public function childrenView($user, $children, $message = '') {
			$body = "<h2>Children for {$user->firstName} {$user->lastName}</h2>\n";
		
			if ($message) {
				$body .= "<p class='message'>$message</p>\n";
			}
		
			if($user->role == 'case manager'){
                $body .= "<p><a href='index.php?view=addchildform'>+ Add Child</a><hr>";

            }
            
	
			if (count($children) < 1) {
				$body .= "<p>No children to display!</p>\n";
				return $this->page($body);
			}
	
			$body .= "<table>\n";
			$body .= "<tr><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Date of Birth</th><th>See More</th>";
	
			foreach ($children as $child) {
				$id = $child['id'];
                $firstName = $child['firstName'];
                $middleName = $child['middleName'];
                $lastName = $child['lastName'];
                $dateOfBirth = $child['dateOfBirth'];
			
				$body .= "<tr>";
				$body .= "<td>$firstName</td><td>$middleName</td><td>$lastName</td><td>$dateOfBirth</td>";
                $body .= "<td><form action='index.php' method='post'><input type='hidden' name='action' value='showchild' /><input type='hidden' name='id' value='$id' /><input type='submit' name='submit' value='Documents'></form></td>";
				$body .= "</tr>\n";
			}
			$body .= "</table>\n";
	
			return $this->page($body);
		}
        
        public function childView($user, $documents, $child, $message = '') {
            $body = "<p><a href='index.php?view=adddocumentform&childid={$child['id']}'>+ Add Document</a><hr>";
            $body .= "<h1>Documents for {$child['firstName']} {$child['lastName']}</h1>\n";
            if (count($documents) < 1) {
				$body .= "<p>No documents to display!</p>\n";
				return $this->page($body);
			}
            
            $body .= "<table>\n";
            $body .= "<tr><th>Document Text</th><th>Uploader Name</th><th>Upload Time</th><th>Edit</th><th>Delete</th>";
            
            foreach ($documents as $document) {
				$documentText = $document['documentText'];
                $uploadTime = $document['uploadTime'];
                $docid = $document['docid']; //docid is correct
                $childID = $document['childID'];
                $fullName = $document['firstName'] . ' ' . $document['lastName'];
				$body .= "<tr>";
				$body .= "<td>$documentText</td><td>$fullName</td><td>$uploadTime</td>";
                if($user->workerID == $document['uploaderID']){
                    $body .= "<td><form action='index.php' method='post'><input type='hidden' name='action' value='editDocument' /><input type='hidden' name='docid' value='$docid' /><input type='hidden' name='childID' value='$childID' /><input type='submit' value='Edit'></form></td>";
                    $body .= "<td><form action='index.php' method='post'><input type='hidden' name='action' value='deletedocument' /><input type='hidden' name='docid' value='$docid' /><input type='hidden' value='$childID' name='childID'><input type='submit' value='Delete'></form></td>";
                }
                
                
				$body .= "</tr>\n";
			}
			$body .= "</table>\n";
            
            return $this->page($body);
            
        }
		
		public function addChildView($user, $caseWorkers = null, $therapists = null, $psychiatrists = null, $doctors = null, $fosterParents = null, $biologicalParents = null, $data = null, $message = '') {
			$firstName = '';
            $middleName = '';
            $lastName = '';
            $dateOfBirth = '';
            
            $caseManagerID = $user->workerID;
            //user logged in is always the caseManagerID
            
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
				$body .= "<input type='hidden' name='action' value='updatechild ' />";
				$body .= "<input type='hidden' name='id' value='{$data['id']}' />";
			} else {
				$body .= "<input type='hidden' name='action' value='addchild' />";
			}
		
			$body .= '
  <p>First Name*<br />
  <input type="text" name="firstName" value="' . $firstName . '" placeholder="" maxlength="255" size="80"></p>
  
  <p>Middle Name<br />
  <input type="text" name="middleName" value="' . $middleName . '" placeholder="" maxlength="255" size="80"></p>
  
  <p>Last Name*<br />
  <input type="text" name="lastName" value="' . $lastName . '" placeholder="" maxlength="255" size="80"></p>
  
  <p>Date Of Birth<br />
  <input type="text" name="dateOfBirth" value="' . $dateOfBirth . '" placeholder="" maxlength="255" size="80"></p>
  
  <input type="hidden" name="caseManagerID" value="' . $caseManagerID . '" placeholder="" maxlength="255" size="80"></p>';
            
            
  $body .= "<p>Case Worker<br /><select name='caseWorkerID'>";
  $body.= '<option> </option>';
        foreach($caseWorkers as $caseworker) {
            $body .='<option value="'.$caseworker['id'].'">'. $caseworker['firstName'] . ' ' . $caseworker['lastName'] . '</option>';
  }
            
  $body .= "</select>";
  
            
            
  $body .= "<p>Therapist<br /><select name='therapistID'>";
  $body.= '<option> </option>';
        foreach($therapists as $therapist) {
            $body .='<option value="'.$therapist['id'].'">' . $therapist['firstName'] . ' ' . $therapist['lastName'] . '</option>';
  }
            
  $body .= "</select>";
            
  $body .= "<p>Psychiatrist<br /><select name='psychiatristID'>";
  $body.= '<option> </option>';
        foreach($psychiatrists as $psychiatrist) {
            $body .='<option value="'.$psychiatrist['id'].'">Dr. ' . $psychiatrist['firstName'] . ' ' . $psychiatrist['lastName'] . '</option>';
  }
            
  $body .= "</select>";
            
  $body .= "<p>Doctor<br /><select name='doctorID'>";
  $body.= '<option> </option>';
        foreach($doctors as $doctor) {
            $body .='<option value="'.$doctor['id'].'">Dr. ' . $doctor['firstName'] . ' ' . $doctor['lastName'] . '</option>';
  }
            
  $body .= "</select>";
            
  $body .= "<p>Foster Parent 1<br /><select name='fosterParent1ID'>";
  $body.= '<option> </option>';
        foreach($fosterParents as $fosterParent) {
            $body .='<option value="'.$fosterParent['id'].'">' . $fosterParent['firstName'] . ' ' . $fosterParent['lastName'] . '</option>';
  }
            
  $body .= "</select>";
            
  $body .= "<p>Foster Parent 2<br /><select name='fosterParent2ID'>";
  $body.= '<option> </option>';
        foreach($fosterParents as $fosterParent) {
            $body .='<option value="'.$fosterParent['id'].'">' . $fosterParent['firstName'] . ' ' . $fosterParent['lastName'] . '</option>';
  }
            
  $body .= "</select>";
            
  $body .= "<p>Biological Parent 1<br /><select name='biologicalParent1ID'>";
  $body.= '<option> </option>';
        foreach($biologicalParents as $biologicalParent) {
            $body .='<option value="'.$biologicalParent['id'].'">' . $biologicalParent['firstName'] . ' ' . $biologicalParent['lastName'] . '</option>';
  }
            
  $body .= "</select>";
            
  $body .= "<p>Biological Parent 2<br /><select name='biologicalParent2ID'>";
  $body.= '<option> </option>';
        foreach($biologicalParents as $biologicalParent) {
            $body .='<option value="'.$biologicalParent['id'].'">' . $biologicalParent['firstName'] . ' ' . $biologicalParent['lastName'] . '</option>';
  }
            
  $body .= "</select>";
            
            

            
            
            
  
  
  //<input type="text" name="caseWorkerID" value="$caseWorkerID" placeholder="" maxlength="255" size="80"></p>
            
  $body .= "<hr><input type='submit' name='submit' value='Submit'> <input type='submit' name='cancel' value='Cancel'></form>";
			return $this->page($body);
		}
        
        
        public function addDocumentForm($user, $data = null, $child, $message = '') {
			$docID = '';
            $childID = $child['id'];
            $uploaderID = '';
            $documentText = '';
            $uploadTime = '';
			
			if ($data) {
				$docID = $data['id'];
				$childID = $data['childID'];
				$uploaderID = $data['uploadID'];
				$documentText = $data['documentText'];
                $uploadTime = $data['uploadTime'];
			}
            
	        if($data)
            {
                $body = "<h1>Edit Document for {$child['firstName']} {$child['lastName']}</h1>\n";
            }else{
                $body = "<h1>Add Document for {$child['firstName']} {$child['lastName']}</h1>\n";
            }

			if ($message) {
				$body .= "<p class='message'>$message</p>\n";
			}
		
			$body .= "<form action='index.php' method='post'>";
		
			if ($data['id']) {
				$body .= "<input type='hidden' name='action' value='updateDocument' />";
				$body .= "<input type='hidden' name='id' value='{$data['id']}' />";
			} else {
				$body .= "<input type='hidden' name='action' value='adddocument' />";
			}
		
			$body .= <<<EOT2
            
  <p>Description<br />
  <input type="hidden" value="$docID" name="docID">
  <input type="hidden" value="$childID" name="childID">
  <textarea name="documentText" rows="6" cols="80">$documentText</textarea></p>
  <input type="submit" name='submit' value="Submit"> <input type="submit" name='cancel' value="Cancel">
</form>
EOT2;

			return $this->page($body);
		}
		
		
		public function loginFormView($data = null, $message = '') {
			$username = '';
			if ($data) {
				$username = $data['username'];
			}
		
			$body = "<h1>Permanency Team</h1>\n";
			
			if ($message) {
				$body .= "<p class='message'>$message</p>\n";
			}
			
			$body .= <<<EOT
<form action='index.php' method='post'>
<input type='hidden' name='action' value='login' />
<p>Username<br />
  <input type="text" name="username" value="$username" placeholder="Username" maxlength="255" size="80"></p>
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
<div class="col-md-10 offset-md-1">
$body
<hr>
<p>&copy; 2017 Permanency Team. All rights reserved.</p>
</div>
</body>
</html>
EOT;
			return $html;
		}

}
