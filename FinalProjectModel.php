<?php


	require('User.php');

	class FinalProjectModel {
		private $error = '';
		private $mysqli;
		private $user;
		
		public function __construct() {
			session_start();
			$this->initDatabaseConnection();
			$this->restoreUser();
		}
		
		public function __destruct() {
			if ($this->mysqli) {
				$this->mysqli->close();
			}
		}
		
		public function getError() {
			return $this->error;
		}
		
		private function initDatabaseConnection() {
			require('db_credentials.php');
			$this->mysqli = new mysqli($servername, $username, $password, $dbname);
			if ($this->mysqli->connect_error) {
				$this->error = $mysqli->connect_error;
			}
		}
		
		
		
		private function restoreUser() {
			if ($username = $_SESSION['username']) {
				$this->user = new User();
				if (!$this->user->load($username, $this->mysqli)) {
					$this->user = null;
				}
			}
		}
		
		public function getUser() {
			return $this->user;
		}
		
		public function getUserRole() {
			return $this->user->role;
		}
		
		//checks if provided password and stored password match
		//and logs user in if it does
		public function login($username, $password) {
			
			$user = new User();
			if ($user->load($username, $this->mysqli) && password_verify($password, $user->hashedPassword)) {
				$this->user = $user;
				$_SESSION['username'] = $username;
				return array(true, "");
			} else {
				$this->user = null;
				$_SESSION['username'] = '';
				return array(false, "Invalid login information.  Please try again.");
			}
		}
		
		//logs out user
		public function logout() {
			$this->user = null;
			$_SESSION['username'] = '';
		}
	
		
		//gets list of documents for selected child to display for user
		public function readDocuments($id) { //$id comes from POST when child is clicked, id is childID
			$this->error = '';
			$documents = array();
			
			if (!$this->user) {
				$this->error = "User not specified. Unable to get document.";
				return array($documents, $this->error);
			}
		
			if (! $this->mysqli) {
				$this->error = "No connection to database.";
				return array($documents, $this->error);
			}

			//I think this SQL statement gets us what we need
			$stmt = $this->mysqli->prepare("SELECT * FROM documents INNER JOIN workers ON documents.uploaderID = workers.workerID WHERE childID = ? ORDER BY uploadTime DESC");
			if (! ($stmt->bind_param("i", $id)) ) {
				$this->error = "Prepare failed: " . $this->mysqli->error;
				return array($documents, $this->error);
			}		
			
			if (! $stmt->execute() ) {
				$this->error = "Execute of statement failed: " . $stmt->error;
				return array($documents, $this->error);
			}
			if (! ($result = $stmt->get_result()) ) {
				$this->error = "Getting result failed: " . $stmt->error;
				return array($documents, $this->error);
			}
			
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					array_push($documents, $row);
				}
			}
			
			$stmt->close();
			
			return array($documents, $this->error);
		}
		
		
		//gets table of children to display for user once they log in
		public function readChildren() { //no parameters, get worker id from user object
			$this->error = '';
			$children = array();
			$role = $this->user->role;
			
			if (!$this->user) {
				$this->error = "User not specified. Unable to get children.";
				return array($children, $this->error);
			}
		
			if (! $this->mysqli) {
				$this->error = "No connection to database.";
				return array($children, $this->error);
			}
			
			if (!$role) {
				$this->error = "No user role specified. Unable to get children.";
				return array($children, $this->error);
			}

			//make a switch with every role, sql statement would change based on role 
			switch ($role){
				case 'case manager':
					$stmt = $this->mysqli->prepare("SELECT * FROM children WHERE caseManagerID = ?");
					if (! ($stmt->bind_param("i", $this->user->workerID)) ) {
						$this->error = "Prepare failed: " . $this->mysqli->error;
						return array($children, $this->error);
					}
					break;
				case 'case worker':
					$stmt = $this->mysqli->prepare("SELECT * FROM children WHERE caseWorkerID = ?");
					if (! ($stmt->bind_param("i", $this->user->workerID)) ) {
						$this->error = "Prepare failed: " . $this->mysqli->error;
						return array($children, $this->error);
					}
					break;
				case 'therapist':
					$stmt = $this->mysqli->prepare("SELECT * FROM children WHERE therapistID = ?");
					if (! ($stmt->bind_param("i", $this->user->workerID)) ) {
						$this->error = "Prepare failed: " . $this->mysqli->error;
						return array($children, $this->error);
					}
					break;
				case 'psychiatrist':
					$stmt = $this->mysqli->prepare("SELECT * FROM children WHERE psychiatristID = ?");
					if (! ($stmt->bind_param("i", $this->user->workerID)) ) {
						$this->error = "Prepare failed: " . $this->mysqli->error;
						return array($children, $this->error);
					}
					break;
				case 'doctor':
					$stmt = $this->mysqli->prepare("SELECT * FROM children WHERE doctorID = ?");
					if (! ($stmt->bind_param("i", $this->user->workerID)) ) {
						$this->error = "Prepare failed: " . $this->mysqli->error;
						return array($children, $this->error);
					}
					break;
				case 'foster parent':
					$stmt = $this->mysqli->prepare("SELECT * FROM children WHERE fosterParent1ID = ? OR fosterParent2ID = ?");
					if (! ($stmt->bind_param("ii", $this->user->workerID, $this->user->workerID)) ) {
						$this->error = "Prepare failed: " . $this->mysqli->error;
						return array($children, $this->error);
					}
					break;
				case 'biological parent':
					$stmt = $this->mysqli->prepare("SELECT * FROM children WHERE biologicalParent1ID = ? OR biologicalParent2ID = ?");
					if (! ($stmt->bind_param("ii", $this->user->workerID, $this->user->workerID)) ) {
						$this->error = "Prepare failed: " . $this->mysqli->error;
						return array($children, $this->error);
					}
					break;
				default:
					$this->error = "Could not find role. Unable to get children";
					return array($children, $this->error);
					break;
			}
				
			if (! ($stmt->bind_param("i", $this->user->workerID)) ) {
				$this->error = "Prepare failed: " . $this->mysqli->error;
				return array($children, $this->error);
			}		
			
			if (! $stmt->execute() ) {
				$this->error = "Execute of statement failed: " . $stmt->error;
				return array($children, $this->error);
			}
			if (! ($result = $stmt->get_result()) ) {
				$this->error = "Getting result failed: " . $stmt->error;
				return array($children, $this->error);
			}
			
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					array_push($children, $row);
				}
			}
			
			$stmt->close();
			
			return array($children, $this->error);
		}
		
		//selects all the workers for a specific role
		public function getWorkers($role) {
			$this->error = '';
			$workers = array();
			
			if (!$this->user) {
				$this->error = "User not specified. Unable to get workers.";
				return array($workers, $this->error);
			}
		
			if (! $this->mysqli) {
				$this->error = "No connection to database.";
				return array($workers, $this->error);
			}
			
			$stmt = $this->mysqli->prepare("SELECT * FROM workers WHERE role = ?");
			if (! ($stmt->bind_param("s", $role)) ) {
				$this->error = "Prepare failed: " . $this->mysqli->error;
				return array($workers, $this->error);
			}		
			
			if (! $stmt->execute() ) {
				$this->error = "Execute of statement failed: " . $stmt->error;
				return array($workers, $this->error);
			}
			if (! ($result = $stmt->get_result()) ) {
				$this->error = "Getting result failed: " . $stmt->error;
				return array($workers, $this->error);
			}
			
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					array_push($workers, $row);
				}
			}
			
			$stmt->close();
			
			return array($workers, $this->error);
		}	
		
		//gets the info for the selected child so it can be loaded for editing
		public function getChild($id) { //$id comes from POST when child is clicked
			$this->error = '';
			$child = null;
			
			if (!$this->user) {
				$this->error = "User not specified. Unable to get child.";
				return $this->error;
			}
		
			if (! $this->mysqli) {
				$this->error = "No connection to database.";
				return array($child, $this->error);
			}
			
			if (! $id) {
				$this->error = "No id specified for child to retrieve.";
				return array($child, $this->error);
			}
			
			
			$stmt = $this->mysqli->prepare("SELECT * FROM children WHERE id = ?");
			
			if (! ($stmt->bind_param("i", $id)) ) {
				$this->error = "Prepare failed: " . $this->mysqli->error;
				return array($child, $this->error);
			}
			if (! $stmt->execute() ) {
				$this->error = "Execute of statement failed: " . $stmt->error;
				return array($child, $this->error);
			}
			if (! ($result = $stmt->get_result()) ) {
				$this->error = "Getting result failed: " . $stmt->error;
				return array($child, $this->error);
			}
			
			if ($result->num_rows > 0) {
				$child = $result->fetch_assoc();
			}
			
			$stmt->close();
			
			return array($child, $this->error);		
		}
		
		//gets the info for the selected child so it can be loaded for editing
		public function getDocumentForEdit($id) { //$id comes from POST when edit document button pressed
			$this->error = '';
			$document = null;
			
			if (!$this->user) {
				$this->error = "User not specified. Unable to get document.";
				return $this->error;
			}
		
			if (! $this->mysqli) {
				$this->error = "No connection to database.";
				return array($document, $this->error);
			}
			
			if (! $id) {
				$this->error = "No id specified for document to retrieve.";
				return array($document, $this->error);
			}
			
			
			$stmt = $this->mysqli->prepare("SELECT * FROM documents WHERE id = ?");
			
			if (! ($stmt->bind_param("i", $id)) ) {
				$this->error = "Prepare failed: " . $this->mysqli->error;
				return array($document, $this->error);
			}
			if (! $stmt->execute() ) {
				$this->error = "Execute of statement failed: " . $stmt->error;
				return array($document, $this->error);
			}
			if (! ($result = $stmt->get_result()) ) {
				$this->error = "Getting result failed: " . $stmt->error;
				return array($document, $this->error);
			}
			
			if ($result->num_rows > 0) {
				$document = $result->fetch_assoc();
			}
			
			$stmt->close();
			
			return array($document, $this->error);		
		}
		
		//adds a child to the children table
		public function addChild($data) { //input is entire POST array
			$this->error = '';
			
			if (!$this->user) {
				$this->error = "User not specified. Unable to add child.";
                echo $this->error;
				return $this->error;
			}
			
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
			
			if (! $firstName) {
				$this->error = "No first name found for child to add. A first name is required.";
                echo $this->error;
				return $this->error;			
			}
			
			if (! $lastName) {
				$this->error = "No last name found for child to add. A last name is required.";
                echo $this->error;
				return $this->error;			
			}
				
			
			$stmt = $this->mysqli->prepare("INSERT INTO children (firstName, middleName, lastName, dateOfBirth, caseManagerID, caseWorkerID, therapistID, psychiatristID, doctorID, fosterParent1ID, fosterParent2ID, biologicalParent1ID, biologicalParent2ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			
			if (! ($stmt->bind_param("ssssiiiiiiiii", $firstName, $middleName, $lastName, $dateOfBirth, $caseManagerID, $caseWorkerID, $therapistID, $psychiatristID, $doctorID, $fosterParent1ID, $fosterParent2ID, $biologicalParent1ID, $biologicalParent2ID)) ) {
				$this->error = "Prepare failed: " . $this->mysqli->error;
                echo $this->error;
				return $this->error;
				
			}
			if (! $stmt->execute() ) {
				$this->error = "Execute of statement failed: " . $stmt->error;
                echo $this->error;
				return $this->error;
			}
			
			$stmt->close();
            
			echo $this->error;
			return $this->error;
		}
		
		//add notes to the document table
		public function addDocument($data) { //POST data
			$this->error = '';
			
			if (!$this->user) {
				$this->error = "User not specified. Unable to add note.";
				return $this->error;
			}
			
			$childID = $data['childID'];
			$documentText = $data['documentText'];
			
			
			if (! $childID) {
				$this->error = "No child id found for note to add. A child id is required.";
				return $this->error;			
			}
			
			if (! $documentText) {
				$this->error = "No text found for note to add. Text is required.";
				return $this->error;			
			}
				
			
			$stmt = $this->mysqli->prepare("INSERT INTO documents (childID, uploaderID, documentText, uploadTime) values (?, ?, ?, NOW()");
			
			if (! ($stmt->bind_param("iis", $childID, $this->user->workerID, $documentText)) ) {
				$this->error = "Prepare failed: " . $this->mysqli->error;
				return $this->error;
				
			}
			
			if (! $stmt->execute() ) {
				$this->error = "Execute of statement failed: " . $stmt->error;
				return $this->error;
			}
			
			$stmt->close();
			
			
			return $this->error;
		}

		
		//takes data from post array from edit form and updates child in the children table
		public function updateChild($data) { //data comes from POST array from form
			$this->error = '';
			
			if (!$this->user) {
				$this->error = "User not specified. Unable to update child.";
				return $this->error;
			}
			
			if (! $this->mysqli) {
				$this->error = "No connection to database. Unable to update child.";
				return $this->error;
			}
			
			if ($this->user->role != 'case manager'){
				$this->error = "User do not have permission to update. Unable to update child.";
			}
			
			$id = $data['id'];
			$firstName = $data['firstName'];
			$middleName = $data['middleName'];
			$lastName = $data['lastName'];
			$dateOfBirth = $data['dateOfBirth'];
			$caseWorkerID = $data['caseWorkerID'];
			$therapistID = $data['therapistID'];
			$psychiatristID = $data['psychiatristID'];
			$doctorID = $data['doctorID'];
			$fosterParent1ID = $data['fosterParent1ID'];
			$fosterParent2ID = $data['fosterParent2ID'];
			$biologicalParent1ID = $data['biologicalParent1ID'];
			$biologicalParent2ID = $data['biologicalParent2ID'];
			
			if (! $id) {
				$this->error = "No id specified for child to update.";
				return $this->error;			
			}
			
			if (! $firstName) {
				$this->error = "No first name found for child to add. A first name is required.";
				return $this->error;			
			}
			
			if (! $lastName) {
				$this->error = "No last name found for child to add. A last name is required.";
				return $this->error;			
			}		
			
		
			//change sql statement		
			$stmt = $this->mysqli->prepare("UPDATE children SET firstName=?, middleName=?, lastName=?, dateOfBirth=?, caseManagerID=?, caseWorkerID=?, therapistID=?, psychiatristID=?, doctorID=?, fosterParent1ID=?, fosterParent2ID=?, biologicalParent1ID=?, biologicalParent2ID=? WHERE id = ?");
			
			if (! ($stmt->bind_param("ssssiiiiiiiii", $firstName, $middleName, $lastName, $dateOfBirth, $this->user->workerID, $caseWorkerID, $therapistID, $psychiatristID, $doctorID, $fosterParent1ID, $fosterParent2ID, $biologicalParent1ID, $biologicalParent2ID)) ) {
				$this->error = "Prepare failed: " . $this->mysqli->error;
				return $this->error;
			}
			if (! $stmt->execute() ) {
				$this->error = "Execute of statement failed: " . $stmt->error;
				return $this->error;
			}
			
			$stmt->close();
			
			return $this->error;
		}
		
		//takes data from post array from edit form and updates child in the children table
		public function updateDocument($data) { //data comes from POST array from form
			$this->error = '';
			
			if (!$this->user) {
				$this->error = "User not specified. Unable to update document.";
				return $this->error;
			}
			
			if (! $this->mysqli) {
				$this->error = "No connection to database. Unable to update document.";
				return $this->error;
			}
		
			
			$id = $data['id'];
			$documentText = $data['documentText'];
			
			
			
			if (! $id) {
				$this->error = "No id specified for note to update.";
				return $this->error;			
			}
			
			
			if (! $documentText) {
				$this->error = "No note text found for note to update. A note text is required.";
				return $this->error;			
			}

			
		
					
			$stmt = $this->mysqli->prepare("UPDATE documents SET documentText=?, uploadTime = NOW() WHERE id = ?");
			
			if (! ($stmt->bind_param("si", $documentText, $id)) ) {
				$this->error = "Prepare failed: " . $this->mysqli->error;
				return $this->error;
			}
			if (! $stmt->execute() ) {
				$this->error = "Execute of statement failed: " . $stmt->error;
				return $this->error;
			}
			
			$stmt->close();
			
			return $this->error;
		}
		
		//deletes document with provided document id from documents table
		public function deleteDocument($id) { //id comes from POST when button is clicked
			$this->error = '';
			
			if (!$this->user) {
				$this->error = "User not specified. Unable to delete document.";
				return $this->error;
			}
			
			if (! $this->mysqli) {
				$this->error = "No connection to database. Unable to delete document.";
				return $this->error;
			}
			
			if (! $id) {
				$this->error = "No id specified for document to delete.";
				return $this->error;			
			}			
			
			//only users who uploaded document can delete the document
			$stmt = $this->mysqli->prepare("DELETE FROM documents WHERE uploaderID = ? AND id = ?");
			
			if (! ($stmt->bind_param("ii", $this->user->workerID, $id)) ) {
				$this->error = "Prepare failed: " . $this->mysqli->error;
				return $this->error;
			}
			if (! $stmt->execute() ) {
				$this->error = "Execute of statement failed: " . $stmt->error;
				return $this->error;
			}
			
			$stmt->close();
			
			return $this->error;
		}

	
	}

?>