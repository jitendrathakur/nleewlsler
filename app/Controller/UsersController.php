<?php
App::uses('AppController', 'Controller');
App::uses('Security', 'Utility'); 
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public $uses = array('User', 'Role', 'Client');
	//public $name = 'Pages';
/**
 * index method
 *
 * @return void
 */
 
 public function index() {
		$image = '0';
		$this->User->recursive = 0;
		$this->paginate = array(
					'User' => array(
							'limit' => Configure::read('Paginationlimit') ? Configure::read('Paginationlimit') : 20,
							'conditions' => array('User.role_id !=' => Configure::read('superAdminRoleId')),
							'order' => array(
									'User.created' => 'DESC',
							),
							'recursion' =>'0'
					),
				);
		
		 /*
		 if ($this->request->is('post')) {
           $filename = "app/webroot/files/".$this->data['upload']['file']['name']; 
           /* copy uploaded file
           
          if (move_uploaded_file($this->data['upload']['file']['tmp_name'],$filename)) {
            /* save message to session 
            $this->Session->setFlash('File uploaded successfuly. You can view it <a href="/app/webroot/files/'.$this->data['upload']['file']['name'].'">here</a>.');
            /* redirect 
            $this->redirect(array('action' => 'index'));
          } else {
            /* save message to session 
            $this->Session->setFlash('There was a problem uploading file. Please try again.');
          }
     }*/
    //$this->render('users');
    //$this->set('users', $this->paginate());
	if ($this->request->is('post')) {
            if ($this->data['Post']) {
                $image = $this->data['Post']['filename'];
                //allowed image types
                $imageTypes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
                //upload folder - make sure to create one in webroot
                $uploadFolder = "files";
                //full path to upload folder
                $uploadPath = WWW_ROOT . $uploadFolder;
               
			   	/*echo "<pre>";
					print_r($this->data['Post']['filename']);
				echo "</pre>";*/
				
                //check if image type fits one of allowed types
                foreach ($imageTypes as $type) {
                    if ($type == $image['type']) {
                      //check if there wasn't errors uploading file on serwer
                        if ($image['error'] == 0) {
                             //image file name
                            $imageName = $image['name'];
                            //check if file exists in upload folder
                            if (file_exists($uploadPath . '/' . $imageName)) {
  							                //create full filename with timestamp
                                $imageName = date('His') . $imageName;
                            }
                            //create full path with image name
                            $full_image_path = $uploadPath . '/' . $imageName;
                            //upload image to upload folder
                            if (move_uploaded_file($image['tmp_name'], $full_image_path)) {
                                $this->Session->setFlash('File saved successfully'.$imageName);
                                
								$this->set('imageName',$imageName);
								
								$this->redirect(array('controller'=>'post', 'action'=>'csvimport',$imageName));
								echo $imageName;
                            } else {
                                $this->Session->setFlash('There was a problem uploading file. Please try again.');
                            }
                        } else {
                            $this->Session->setFlash('Error uploading file.');
                        }
                        break;
                    } else {
                        $this->Session->setFlash('Unacceptable file type');
                    }
                }
            }
        }
		//$this->render('home');
		$this->set('users', $this->paginate());
	}
 /**
  * handle uploaded csv file
  */
 
	function import() {
		var_dump($imageName);
		$messages = $this->Post->import($imageName);
                $this->set('messages', $messages);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			$validationError = false;
			
			if(!$this->User->check_unique_email($this->request->data['User']['contact_email']))
			{
				$this->User->invalidate('contact_email', 'Another user already registered with this email.');
				$validationError = true;
			}
			
			if(!$this->User->check_unique_username($this->request->data['User']['username']))
			{
				$this->User->invalidate('username','Username already taken.');
				$validationError = true;
			}
			
			if(!$validationError)
			{
				$userpassword = $this->request->data['User']['user_pass'];
				$password_encrypt = Security::hash($userpassword);
				if(!empty($password_encrypt)){
					$this->request->data['User']['user_pass'] = $password_encrypt;
				}
			
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
		}

		$this->request->data['User']['user_pass'] = '';

		$clients = $this->Client->find('list');
		$this->set(compact('clients'));
		$roles = $this->Role->find('list', array('fields' => array('id', 'role_name'), 'conditions' => array('Role.id !=' => Configure::read('superAdminRoleId'))));
		$this->set(compact('roles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$this->request->data['User']['user_pass'] = '';

		$clients = $this->Client->find('list');
		$this->set(compact('clients'));
		$roles = $this->Role->find('list', array('fields' => array('id', 'role_name')));
		$this->set(compact('roles'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function logout()
	{
		//delete all session data
		$this->Session->delete('User.userName');
		$this->Session->delete('User.password');
		$this->Session->delete('User.userId'); 
		$this->Session->delete('User.userRole');
		$this->Session->destroy();
		/* $this->redirect(array('controller' => 'Main' ,'action' => 'landingpage')); */
		$this->redirect('/');
	}
	public function upload(){
		/* form submitted? */
		  if ($this->request->is('post')) {
           $filename = "app/webroot/files/".$this->data['Pages']['file']['name']; 
           /* copy uploaded file */
           
          if (move_uploaded_file($this->data['Pages']['file']['tmp_name'],$filename)) {
            /* save message to session */
            $this->Session->setFlash('File uploaded successfuly. You can view it <a href="/app/webroot/files/'.$this->data['Pages']['file']['name'].'">here</a>.');
            /* redirect */
            $this->redirect(array('action' => 'index'));
          } else {
            /* save message to session */
            $this->Session->setFlash('There was a problem uploading file. Please try again.');
          }
     }
    //$this->render('users');
	}
		
	
}
