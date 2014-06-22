<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Company $Company
 * @property Maildomain $Maildomain
 */
class User extends AppModel {

//var $name = 'Myfile';
 
 /**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter username.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minlength' => array(
				'rule' => array('minlength', 5),
				'message' => 'Username must be atleast 5 characters.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength', 10),
				'message' => 'Username can not exceed 10 characters.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'Only Alphabets and numbers are allowed for username.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'full_name' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 20),
				'message' => 'Full name can not exceed 20 characters.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter full name of the user.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'designation' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter designation of user.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)/* ,
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'Only alphabets and numbers are allowed for designation.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			), */
		),
		'contact_email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter email address.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please enter valid email address.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'company_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Maildomain' => array(
			'className' => 'Maildomain',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	public $hasOne = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	
	
	function check_unique_email( $email, $id = NULL )
	{	
		## Return false in case of error
		## In case of registration return false if already exist for any user
		## In case of Edit return false if already exist for different user

		$userData   = $this->find( 'first', array('conditions' =>  array( 'User.contact_email' => $email, 'User.status' => false )) );
	
		if( isset( $userData['User']['id'] ) )
		{
			if( $userData['User']['id'] == $id ) 
				return true;
			else
				return false;
		}	
		else 
			return true;
	}
	
	function check_unique_username( $username, $id = NULL )
	{	
		## Return false in case of error
		## In case of registration return false if already exist for any user
		## In case of Edit return false if already exist for different user

		$userData   = $this->find( 'first', array('conditions' =>  array( 'User.username' => $username, 'User.status' => false )) );
	
		if( isset( $userData['User']['id'] ) )
		{
			if( $userData['User']['id'] == $id ) 
				return true;
			else
				return false;
		}	
		else 
			return true;
	}

}
