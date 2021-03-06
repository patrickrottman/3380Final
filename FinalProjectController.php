<?php
	require('FinalProjectModel.php');
	require('FinalProjectViews.php');
    require('header.php');

	class FinalProjectController {
		private $model;
		private $views;
		
		private $view = '';
		private $action = '';
		private $message = '';
		private $data = array();
		private $id = null;
	
		public function __construct() {
			$this->model = new FinalProjectModel();
			$this->views = new FinalProjectViews();
			
			$this->view = $_GET['view'] ? $_GET['view'] : 'childrenview';
			$this->action = $_POST['action'];
		}
		
		public function __destruct() {
			$this->model = null;
			$this->views = null;
		}
		
		public function run() {
			if ($error = $this->model->getError()) {
				print $views->errorView($error);
				exit;
			}
			
			// Note: given order of handling and given processOrderBy doesn't require user to be logged in
			//...orderBy can be changed without being logged in
			
			switch($this->action) { 
				case 'login':
					$this->handleLogin();
					break;
				case 'logout':
					$this->handleLogout();
					break;
                case 'showchild':
					$this->handleShowChildDocuments();
					break;
				case 'addchild':
					$this->handleAddChild();
					break;
				case 'editchild':
					$this->handleEditChild();
					break;
				case 'updatechild':
					$this->handleUpdateChild();
					break;
				case 'adddocument':
					$this->handleAddDocument();
					break;
				case 'editDocument':
					$this->handleEditDocument();
					break;
				case 'updateDocument':
					$this->handleUpdateDocument();
					break;
				case 'deletedocument':
					$this->handleDeleteDocument();
					break;
				default:
					$this->verifyLogin();
			}
			
			switch($this->view) {
				case 'loginform': 
					print $this->views->loginFormView($this->data, $this->message);
					break;
					
					
				case 'addchildform':
					list($caseWorkers, $errorCaseWorker) = $this->model->getWorkers('case worker');
					if($errorCaseWorker){
						$this->message = $errorCaseWorker;
					}
					
					list($therapists, $errorTherapist) = $this->model->getWorkers('therapist');
					if($errorTherapist){
						$this->message = $errorTherapist;
					}
					
					list($psychiatrists, $errorPsychiatrist) = $this->model->getWorkers('psychiatrist');
					if($errorPsychiatrist){
						$this->message = $errorPsychiatrist;
					}
						
					list($doctors, $errorDoctor) = $this->model->getWorkers('doctor');
					if($errorDoctor){
						$this->message = $errorDoctor;
					}
					
					list($fosterParents, $errorFosterParent) = $this->model->getWorkers('foster parent');
					if($errorFosterParent){
						$this->message = $errorFosterParent;
					}
					
					list($biologicalParents, $errorBiologicalParent) = $this->model->getWorkers('biological parent');
					if($errorBiologicalParent){
						$this->message = $errorBiologicalParent;
					}
					
					print $this->views->addChildView($this->model->getUser(), 
								$caseWorkers,
								$therapists,
								$psychiatrists,
								$doctors,
								$fosterParents,
								$biologicalParents,
								$this->data, $this->message);
					break;
					
					
				case 'adddocumentform':
                    if($this->id)
                    {
                    list($child, $error) = $this->model->getChild($this->id);
                    if($error) {
                        $this->view = 'childrenview';
                        break;
                    }
					print $this->views->addDocumentForm($this->model->getUser(), $this->data, $child, $this->message);
                    }else{
                        list($child, $error) = $this->model->getChild($_GET['childid']);
                        if($error) {
                        $this->view = 'childrenview';
                        break;
                        }
                        print $this->views->addDocumentForm($this->model->getUser(), null, $child, $this->message);
                    }
					break;
					
					
				case 'childview':
                    list($child, $error) = $this->model->getChild($this->id);
                    if($error) {
                        $this->view = 'childrenview';
                        break;
                    }
                        
					print $this->views->childView($this->model->getUser(), $this->data, $child,  $this->message);
					break;
					
					
				default: // 'childrenview'
					list($children, $error) = $this->model->readChildren();
					if ($error) {
						$this->message = $error;
					}
					print $this->views->childrenView($this->model->getUser(), $children, $this->message);
			}
		
		}
		
		private function verifyLogin() {
			if (! $this->model->getUser()) {
				$this->view = 'loginform';
				return false;
			} else {
				return true;
			}
		}
		
		private function handleLogout() {
            
			if ($_POST['action'] == 'logout') {
				$this->model->logout();
			}
            $this->view = 'loginform';
		}
		
		private function handleLogin() {
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			list($success, $message) = $this->model->login($username, $password);
			if ($success) {
				$this->view = 'childrenview';
			} else {
				$this->message = $message;
				$this->view = 'loginform';
				$this->data = $_POST;
			}
		}
		
		private function handleAddChild() {
			if (!$this->verifyLogin()) 
            {
                return;
            }
			
			if ($_POST['cancel']) {
				header('Location: index.php');
				return;
			}
            
			$error = $this->model->addChild($_POST);
			if ($error) {
				$this->message = $error;
				$this->view = 'addchildform';
				$this->data = $_POST;
			}else{
                header('Location: index.php');
                //$this->view = 'childrenview';
            }
		}
		
		private function handleAddDocument() {
			if (!$this->verifyLogin()) return;
			
			if ($_POST['cancel']) {
				$this->view = 'childview';
                $this->id = $_POST['childID'];
                list($this->data, $error) = $this->model->readDocuments($_POST['childID']);
                if($error) {
				    $this->message = $error;
				    $this->view = 'childrenview';
                    return;
                }
				return;
			}
            
			$error = $this->model->addDocument($_POST);
			if ($error) {
                echo $error . '----<error';
				$this->message = $error;
				$this->view = 'adddocumentform';
				$this->data = $_POST;
                return;
			}
            
            $this->id = $_POST['childID'];
            list($this->data, $error) = $this->model->readDocuments($_POST['childID']);
            if($error) {
				$this->message = $error;
				$this->view = 'childrenview';
                return;
			}
            $this->view = 'childview';
            
		}
		
		private function handleEditChild() {	
			if (!$this->verifyLogin())
            {
                return;
            }
			list($child, $error) = $this->model->getChild($_POST['id']);
			if ($error) {
				$this->message = $error;
				$this->view = 'childrenview';
				return;
			}
            
			$this->data = $child;
			$this->view = 'addchildform';
		}
		
		private function handleEditDocument() {				
			if (!$this->verifyLogin()) return;
			list($document, $error) = $this->model->getDocumentForEdit($_POST['docid']);
            
			if ($error) {
				$this->message = $error;
				$this->view = 'childview';
				return;
			}
			$this->data = $document;
            $this->id = $_POST['childID'];
			$this->view = 'adddocumentform';
		}
		
		private function handleUpdateChild() {
			if (!$this->verifyLogin()) return;
			
			if ($_POST['cancel']) {
				$this->view = 'childview';
				return;
			}
			
			if ($error = $this->model->updateChild($_POST)) {
				$this->message = $error;
				$this->view = 'addchildform';
				$this->data = $_POST;
				return;
			}
			
			$this->view = 'childview';
		}
	
		
		private function handleUpdateDocument() {
			if (!$this->verifyLogin()) return;
			
			if ($_POST['cancel']) {
				$this->view = 'childview';
                $this->id = $_POST['childID'];
                list($this->data, $error) = $this->model->readDocuments($_POST['childID']);
                if($error) {
				    $this->message = $error;
				    $this->view = 'childrenview';
                    return;
                }
				return;
			}
			
			if ($error = $this->model->updateDocument($_POST)) {
				$this->message = $error;
				$this->view = 'adddocumentform';
				$this->data = $_POST;
				return;
			}
            
            $this->id = $_POST['childID'];
            
            list($documents, $error) = $this->model->readDocuments($_POST['childID']);
			if($error) {
				$this->message = $error;
				$this->view = 'childrenview';
                return;
			}

            $this->data = $documents;
			$this->view = 'childview';
		}
		
		private function handleDeleteDocument() {
			if (!$this->verifyLogin()) return;
			
            list($child, $error) = $this->model->deleteDocument($_POST['docid']);
			if ($error) {
				$this->message = $error;
				$this->view = 'childview';
				$this->data = $_POST;
				return;
			}
			
			list($documents, $error) = $this->model->readDocuments($_POST['childID']);
			if($error) {
				$this->message = $error;
				$this->view = 'childrenview';
			}
			
            $this->id = $_POST['childID'];
            $this->data = $documents;
			$this->view = 'childview';
		}
			
		
		private function handleShowChildDocuments() {
			if (!$this->verifyLogin()) return;
            
			$this->id = $_POST['id'];
            
			list($child, $error) = $this->model->getChild($_POST['id']);
			if($error) {
				$this->message = $error;
				$this->view = 'childrenview';
			}
			
			list($this->data, $error) = $this->model->readDocuments($_POST['id']);
            if($error) {
				$this->message = $error;
				$this->view = 'childrenview';
			}
            
			$this->view = 'childview';
		}	
			
	}
?>