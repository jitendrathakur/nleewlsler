<?php
App::uses('AppModel', 'Model');
/**
 * EmailsStat Model
 *
 * @property EmailForm $EmailForm
 * @property Email $Email
 */
class EmailsStat extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'email_form_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email_form_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sent' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
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
		'EmailForm' => array(
			'className' => 'EmailForm',
			'foreignKey' => 'email_form_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Email' => array(
			'className' => 'Email',
			'foreignKey' => 'email_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
