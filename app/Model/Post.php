<?php
App::uses('AppModel', 'Model');
/**
 * Inqury Model
 *
 */
class Post extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	//public $displayField = 'name';
	public $useTable = 'tbl_mail_user';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'staff_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter your name.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'age' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter your company name.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'gender' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter email.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
		'prefecture' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter phone number.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			/* 'phone' => array(
				'rule' => array('phone'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			), */
		),
		'pc_email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter inquiry type.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'mobile_email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter inquiry details.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
	);
}
