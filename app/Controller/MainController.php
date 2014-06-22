<?php
App::uses('AppController', 'Controller');
App::uses('Security', 'Utility'); 
/**
 * Main Controller
 *
 */
class MainController extends AppController {

	public $uses = array('User');
	public $helpers = array('Form', 'Html', 'Js', 'Time');
		
	public function landingpage()
	{
		if ($this->request->is('post')) {
			$user_name = NULL;
			$user_password = NULL;
			$logins = array();
			$validationError = false;
			//create server side validation
			//empty field validation for username
			if(empty($this->request->data['User']['username']))
			{
				$this->User->invalidate('username', 'Please enter username');
				$validationError = true;				
			}
			//empty field validation for password
			if(empty($this->request->data['User']['password']))
			{
				$this->User->invalidate('password', 'Please enter password.');
				$validationError = true;				
			}
			
			//if all validation are corrects
			if( !$validationError ){
				//fetch posted values
				if(!empty($this->request->data['User']['username'])){
					$user_name = $this->request->data['User']['username'];
				}
				if(!empty($this->request->data['User']['password'])){
					$user_password = $this->request->data['User']['password'];
					$user_password_encrypt = Security::hash($user_password);
				}
				if(!empty($this->request->data['User']['email'])){
					$user_email = $this->request->data['User']['email'];
				}
				if(!empty($user_name) && !empty($user_password)){
					$logins = $this->User->find('first', array('conditions'=>array('User.username' => $user_name,'User.user_pass' => $user_password_encrypt))); //, 'User.role_id' => true
				}
			
				if(!empty($logins)){
					$user_id = $logins['User']['id'];
					$userfullname = $logins['User']['full_name'];
					
					// write session values for logged in user
					$this->Session->write('User.userName',$user_name );
					$this->Session->write('User.userPassword',$user_password );
					$this->Session->write('User.userId',$user_id );
					$this->Session->write('User.name',$userfullname );
					$this->Session->write('User.email',$logins['User']['contact_email'] );
					$this->Session->write('User.role_id',$logins['User']['role_id'] );

					$this->Session->setFlash('Login success.');
					//redirect to user on landingpage page
					$this->redirect(array('action' => 'landingpage'));
				}else{
					$this->Session->setFlash('Please enter correct Username and Password.');
				}
			}			
		}
	}

}
