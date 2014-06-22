<?php
App::uses('AppModel', 'Model');
/**
 * Maildomain Model
 *
 * @property User $User
 * @property Users $User
 */
class Maildomain extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'mail_server_ip' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter mail server ip.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'ip' => array(
				'rule' => array('ip'),
				'message' => 'Please enter valid mail server ip.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'pop3_address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter POP3 address',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'pop3_port' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter POP3 port.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please enter valid POP3 Port number.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'smtp_address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter SMTP address.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'smtp_port' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter SMTP port number',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please enter valid SMTP port number',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'newsletter_mail_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter newsletter mail.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please enter valid newsletter mail.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mail_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter mail password.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'webmail_url' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter webmail url.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_footer' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter email footer.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength', 400),
				'message' => 'Email footer can not exceed 400 characters.',
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'Users',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
