<?php
/**
 * FormHelperTest file
 *
 * PHP 5
 *
 * CakePHP(tm) Tests <http://book.cakephp.org/2.0/en/development/testing.html>
 * Copyright 2005-2012, Cake Software Foundation, Inc.
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc.
 * @link          http://book.cakephp.org/2.0/en/development/testing.html CakePHP(tm) Tests
 * @package       Cake.Test.Case.View.Helper
 * @since         CakePHP(tm) v 1.2.0.4206
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('ClassRegistry', 'Utility');
App::uses('Controller', 'Controller');
App::uses('View', 'View');
App::uses('Model', 'Model');
App::uses('Security', 'Utility');
App::uses('CakeRequest', 'Network');
App::uses('HtmlHelper', 'View/Helper');
App::uses('FormHelper', 'View/Helper');
App::uses('Router', 'Routing');

/**
 * ContactTestController class
 *
 * @package	   cake
 * @package       Cake.Test.Case.View.Helper
 */
class ContactTestController extends Controller {

/**
 * name property
 *
 * @var string 'ContactTest'
 */
	public $name = 'ContactTest';

/**
 * uses property
 *
 * @var mixed null
 */
	public $uses = null;
}

/**
 * Contact class
 *
 * @package	   cake
 * @package       Cake.Test.Case.View.Helper
 */
class Contact extends CakeTestModel {

/**
 * primaryKey property
 *
 * @var string 'id'
 */
	public $primaryKey = 'id';

/**
 * useTable property
 *
 * @var bool false
 */
	public $useTable = false;

/**
 * name property
 *
 * @var string 'Contact'
 */
	public $name = 'Contact';

/**
 * Default schema
 *
 * @var array
 */
	protected $_schema = array(
		'id' => array('type' => 'integer', 'null' => '', 'default' => '', 'length' => '8'),
		'name' => array('type' => 'string', 'null' => '', 'default' => '', 'length' => '255'),
		'email' => array('type' => 'string', 'null' => '', 'default' => '', 'length' => '255'),
		'phone' => array('type' => 'string', 'null' => '', 'default' => '', 'length' => '255'),
		'password' => array('type' => 'string', 'null' => '', 'default' => '', 'length' => '255'),
		'published' => array('type' => 'date', 'null' => true, 'default' => null, 'length' => null),
		'created' => array('type' => 'date', 'null' => '1', 'default' => '', 'length' => ''),
		'updated' => array('type' => 'datetime', 'null' => '1', 'default' => '', 'length' => null),
		'age' => array('type' => 'integer', 'null' => '', 'default' => '', 'length' => null)
	);

/**
 * validate property
 *
 * @var array
 */
	public $validate = array(
		'non_existing' => array(),
		'idontexist' => array(),
		'imrequired' => array('rule' => array('between', 5, 30), 'allowEmpty' => false),
		'imrequiredonupdate' => array('notEmpty' => array('rule' => 'alphaNumeric', 'on' => 'update')),
		'imrequiredoncreate' => array('required' => array('rule' => 'alphaNumeric', 'on' => 'create')),
		'imrequiredonboth' => array(
			'required' => array('rule' => 'alphaNumeric'),
		),
		'string_required' => 'notEmpty',
		'imalsorequired' => array('rule' => 'alphaNumeric', 'allowEmpty' => false),
		'imrequiredtoo' => array('rule' => 'notEmpty'),
		'required_one' => array('required' => array('rule' => array('notEmpty'))),
		'imnotrequired' => array('required' => false, 'rule' => 'alphaNumeric', 'allowEmpty' => true),
		'imalsonotrequired' => array(
			'alpha' => array('rule' => 'alphaNumeric', 'allowEmpty' => true),
			'between' => array('rule' => array('between', 5, 30), 'allowEmpty' => true),
		),
		'imnotrequiredeither' => array('required' => true, 'rule' => array('between', 5, 30), 'allowEmpty' => true),
	);

/**
 * schema method
 *
 * @return void
 */
	public function setSchema($schema) {
		$this->_schema = $schema;
	}

/**
 * hasAndBelongsToMany property
 *
 * @var array
 */
	public $hasAndBelongsToMany = array('ContactTag' => array('with' => 'ContactTagsContact'));

/**
 * hasAndBelongsToMany property
 *
 * @var array
 */
	public $belongsTo = array('User' => array('className' => 'UserForm'));
}

/**
 * ContactTagsContact class
 *
 * @package	   cake
 * @package       Cake.Test.Case.View.Helper
 */
class ContactTagsContact extends CakeTestModel {

/**
 * useTable property
 *
 * @var bool false
 */
	public $useTable = false;

/**
 * name property
 *
 * @var string 'Contact'
 */
	public $name = 'ContactTagsContact';

/**
 * Default schema
 *
 * @var array
 */
	protected $_schema = array(
		'contact_id' => array('type' => 'integer', 'null' => '', 'default' => '', 'length' => '8'),
		'contact_tag_id' => array(
			'type' => 'integer', 'null' => '', 'default' => '', 'length' => '8'
		)
	);

/**
 * schema method
 *
 * @return void
 */
	public function setSchema($schema) {
		$this->_schema = $schema;
	}

}

/**
 * ContactNonStandardPk class
 *
 * @package	   cake
 * @package       Cake.Test.Case.View.Helper
 */
class ContactNonStandardPk extends Contact {

/**
 * primaryKey property
 *
 * @var string 'pk'
 */
	public $primaryKey = 'pk';

/**
 * name property
 *
 * @var string 'ContactNonStandardPk'
 */
	public $name = 'ContactNonStandardPk';

/**
 * schema method
 *
 * @return void
 */
	public function schema($field = false) {
		$this->_schema = parent::schema();
		$this->_schema['pk'] = $this->_schema['id'];
		unset($this->_schema['id']);
		return $this->_schema;
	}

}

/**
 * ContactTag class
 *
 * @package	   cake
 * @package       Cake.Test.Case.View.Helper
 */
class ContactTag extends Model {

/**
 * useTable property
 *
 * @var bool false
 */
	public $useTable = false;

/**
 * schema definition
 *
 * @var array
 */
	protected $_schema = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => '', 'length' => '8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => '', 'length' => '255'),
		'created' => array('type' => 'date', 'null' => true, 'default' => '', 'length' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => '', 'length' => null)
	);
}

/**
 * UserForm class
 *
 * @package	   cake
 * @package       Cake.Test.Case.View.Helper
 */
class UserForm extends CakeTestModel {

/**
 * useTable property
 *
 * @var bool false
 */
	public $useTable = false;

/**
 * primaryKey property
 *
 * @var string 'id'
 */
	public $primaryKey = 'id';

/**
 * name property
 *
 * @var string 'UserForm'
 */
	public $name = 'UserForm';

/**
 * hasMany property
 *
 * @var array
 */
	public $hasMany = array(
		'OpenidUrl' => array('className' => 'OpenidUrl', 'foreignKey' => 'user_form_id'
	));

/**
 * schema definition
 *
 * @var array
 */
	protected $_schema = array(
		'id' => array('type' => 'integer', 'null' => '', 'default' => '', 'length' => '8'),
		'published' => array('type' => 'date', 'null' => true, 'default' => null, 'length' => null),
		'other' => array('type' => 'text', 'null' => true, 'default' => null, 'length' => null),
		'stuff' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10),
		'something' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 255),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => false),
		'created' => array('type' => 'date', 'null' => '1', 'default' => '', 'length' => ''),
		'updated' => array('type' => 'datetime', 'null' => '1', 'default' => '', 'length' => null)
	);
}

/**
 * OpenidUrl class
 *
 * @package	   cake
 * @package       Cake.Test.Case.View.Helper
 */
class OpenidUrl extends CakeTestModel {

/**
 * useTable property
 *
 * @var bool false
 */
	public $useTable = false;

/**
 * primaryKey property
 *
 * @var string 'id'
 */
	public $primaryKey = 'id';

/**
 * name property
 *
 * @var string 'OpenidUrl'
 */
	public $name = 'OpenidUrl';

/**
 * belongsTo property
 *
 * @var array
 */
	public $belongsTo = array('UserForm' => array(
		'className' => 'UserForm', 'foreignKey' => 'user_form_id'
	));

/**
 * validate property
 *
 * @var array
 */
	public $validate = array('openid_not_registered' => array());

/**
 * schema method
 *
 * @var array
 */
	protected $_schema = array(
		'id' => array('type' => 'integer', 'null' => '', 'default' => '', 'length' => '8'),
		'user_form_id' => array(
			'type' => 'user_form_id', 'null' => '', 'default' => '', 'length' => '8'
		),
		'url' => array('type' => 'string', 'null' => '', 'default' => '', 'length' => '255'),
	);

/**
 * beforeValidate method
 *
 * @return void
 */
	public function beforeValidate($options = array()) {
		$this->invalidate('openid_not_registered');
		return true;
	}

}

/**
 * ValidateUser class
 *
 * @package	   cake
 * @package       Cake.Test.Case.View.Helper
 */
class ValidateUser extends CakeTestModel {

/**
 * primaryKey property
 *
 * @var string 'id'
 */
	public $primaryKey = 'id';

/**
 * useTable property
 *
 * @var bool false
 */
	public $useTable = false;

/**
 * name property
 *
 * @var string 'ValidateUser'
 */
	public $name = 'ValidateUser';

/**
 * hasOne property
 *
 * @var array
 */
	public $hasOne = array('ValidateProfile' => array(
		'className' => 'ValidateProfile', 'foreignKey' => 'user_id'
	));

/**
 * schema method
 *
 * @var array
 */
	protected $_schema = array(
		'id' => array('type' => 'integer', 'null' => '', 'default' => '', 'length' => '8'),
		'name' => array('type' => 'string', 'null' => '', 'default' => '', 'length' => '255'),
		'email' => array('type' => 'string', 'null' => '', 'default' => '', 'length' => '255'),
		'balance' => array('type' => 'float', 'null' => false, 'length' => '5,2'),
		'created' => array('type' => 'date', 'null' => '1', 'default' => '', 'length' => ''),
		'updated' => array('type' => 'datetime', 'null' => '1', 'default' => '', 'length' => null)
	);

/**
 * beforeValidate method
 *
 * @return void
 */
	public function beforeValidate($options = array()) {
		$this->invalidate('email');
		return false;
	}

}

/**
 * ValidateProfile class
 *
 * @package	   cake
 * @package       Cake.Test.Case.View.Helper
 */
class ValidateProfile extends CakeTestModel {

/**
 * primaryKey property
 *
 * @var string 'id'
 */
	public $primaryKey = 'id';

/**
 * useTable property
 *
 * @var bool false
 */
	public $useTable = false;

/**
 * schema property
 *
 * @var array
 */
	protected $_schema = array(
		'id' => array('type' => 'integer', 'null' => '', 'default' => '', 'length' => '8'),
		'user_id' => array('type' => 'integer', 'null' => '', 'default' => '', 'length' => '8'),
		'full_name' => array('type' => 'string', 'null' => '', 'default' => '', 'length' => '255'),
		'city' => array('type' => 'string', 'null' => '', 'default' => '', 'length' => '255'),
		'created' => array('type' => 'date', 'null' => '1', 'default' => '', 'length' => ''),
		'updated' => array('type' => 'datetime', 'null' => '1', 'default' => '', 'length' => null)
	);

/**
 * name property
 *
 * @var string 'ValidateProfile'
 */
	public $name = 'ValidateProfile';

/**
 * hasOne property
 *
 * @var array
 */
	public $hasOne = array('ValidateItem' => array(
		'className' => 'ValidateItem', 'foreignKey' => 'profile_id'
	));

/**
 * belongsTo property
 *
 * @var array
 */
	public $belongsTo = array('ValidateUser' => array(
		'className' => 'ValidateUser', 'foreignKey' => 'user_id'
	));

/**
 * beforeValidate method
 *
 * @return void
 */
	public function beforeValidate($options = array()) {
		$this->invalidate('full_name');
		$this->invalidate('city');
		return false;
	}

}

/**
 * ValidateItem class
 *
 * @package	   cake
 * @package       Cake.Test.Case.View.Helper
 */
class ValidateItem extends CakeTestModel {

/**
 * primaryKey property
 *
 * @var string 'id'
 */
	public $primaryKey = 'id';

/**
 * useTable property
 *
 * @var bool false
 */
	public $useTable = false;

/**
 * name property
 *
 * @var string 'ValidateItem'
 */
	public $name = 'ValidateItem';

/**
 * schema property
 *
 * @var array
 */
	protected $_schema = array(
		'id' => array('type' => 'integer', 'null' => '', 'default' => '', 'length' => '8'),
		'profile_id' => array('type' => 'integer', 'null' => '', 'default' => '', 'length' => '8'),
		'name' => array('type' => 'text', 'null' => '', 'default' => '', 'length' => '255'),
		'description' => array(
			'type' => 'string', 'null' => '', 'default' => '', 'length' => '255'
		),
		'created' => array('type' => 'date', 'null' => '1', 'default' => '', 'length' => ''),
		'updated' => array('type' => 'datetime', 'null' => '1', 'default' => '', 'length' => null)
	);

/**
 * belongsTo property
 *
 * @var array
 */
	public $belongsTo = array('ValidateProfile' => array('foreignKey' => 'profile_id'));

/**
 * beforeValidate method
 *
 * @return void
 */
	public function beforeValidate($options = array()) {
		$this->invalidate('description');
		return false;
	}

}

/**
 * TestMail class
 *
 * @package	   cake
 * @package       Cake.Test.Case.View.Helper
 */
class TestMail extends CakeTestModel {

/**
 * primaryKey property
 *
 * @var string 'id'
 */
	public $primaryKey = 'id';

/**
 * useTable property
 *
 * @var bool false
 */
	public $useTable = false;

/**
 * name property
 *
 * @var string 'TestMail'
 */
	public $name = 'TestMail';
}

/**
 * FormHelperTest class
 *
 * @package	   cake
 * @subpackage       Cake.Test.Case.View.Helper
 * @property FormHelper $Form
 */
class FormHelperTest extends CakeTestCase {

/**
 * Fixtures to be used
 *
 * @var array
 */
	public $fixtures = array('core.post');

/**
 * Do not load the fixtures by default
 *
 * @var boolean
 */
	public $autoFixtures = false;

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		Configure::write('App.base', '');
		$this->Controller = new ContactTestController();
		$this->View = new View($this->Controller);

		$this->Form = new FormHelper($this->View);
		$this->Form->Html = new HtmlHelper($this->View);
		$this->Form->request = new CakeRequest('contacts/add', false);
		$this->Form->request->here = '/contacts/add';
		$this->Form->request['action'] = 'add';
		$this->Form->request->webroot = '';
		$this->Form->request->base = '';

		ClassRegistry::addObject('Contact', new Contact());
		ClassRegistry::addObject('ContactNonStandardPk', new ContactNonStandardPk());
		ClassRegistry::addObject('OpenidUrl', new OpenidUrl());
		ClassRegistry::addObject('User', new UserForm());
		ClassRegistry::addObject('ValidateItem', new ValidateItem());
		ClassRegistry::addObject('ValidateUser', new ValidateUser());
		ClassRegistry::addObject('ValidateProfile', new ValidateProfile());

		$this->oldSalt = Configure::read('Security.salt');

		$this->dateRegex = array(
			'daysRegex' => 'preg:/(?:<option value="0?([\d]+)">\\1<\/option>[\r\n]*)*/',
			'monthsRegex' => 'preg:/(?:<option value="[\d]+">[\w]+<\/option>[\r\n]*)*/',
			'yearsRegex' => 'preg:/(?:<option value="([\d]+)">\\1<\/option>[\r\n]*)*/',
			'hoursRegex' => 'preg:/(?:<option value="0?([\d]+)">\\1<\/option>[\r\n]*)*/',
			'minutesRegex' => 'preg:/(?:<option value="([\d]+)">0?\\1<\/option>[\r\n]*)*/',
			'meridianRegex' => 'preg:/(?:<option value="(am|pm)">\\1<\/option>[\r\n]*)*/',
		);

		Configure::write('Security.salt', 'foo!');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->Form->Html, $this->Form, $this->Controller, $this->View);
		Configure::write('Security.salt', $this->oldSalt);
	}

/**
 * testFormCreateWithSecurity method
 *
 * Test form->create() with security key.
 *
 * @return void
 */
	public function testCreateWithSecurity() {
		$this->Form->request['_Token'] = array('key' => 'testKey');
		$encoding = strtolower(Configure::read('App.encoding'));
		$result = $this->Form->create('Contact', array('url' => '/contacts/add'));
		$expected = array(
			'form' => array('method' => 'post', 'action' => '/contacts/add', 'accept-charset' => $encoding, 'id' => 'ContactAddForm'),
			'div' => array('style' => 'display:none;'),
			array('input' => array('type' => 'hidden', 'name' => '_method', 'value' => 'POST')),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][key]', 'value' => 'testKey', 'id'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->create('Contact', array('url' => '/contacts/add', 'id' => 'MyForm'));
		$expected['form']['id'] = 'MyForm';
		$this->assertTags($result, $expected);
	}

/**
 * test that create() clears the fields property so it starts fresh
 *
 * @return void
 */
	public function testCreateClearingFields() {
		$this->Form->fields = array('model_id');
		$this->Form->create('Contact');
		$this->assertEquals(array(), $this->Form->fields);
	}

/**
 * Tests form hash generation with model-less data
 *
 * @return void
 */
	public function testValidateHashNoModel() {
		$this->Form->request['_Token'] = array('key' => 'foo');
		$result = $this->Form->secure(array('anything'));
		$this->assertRegExp('/540ac9c60d323c22bafe997b72c0790f39a8bdef/', $result);
	}

/**
 * Tests that models with identical field names get resolved properly
 *
 * @return void
 */
	public function testDuplicateFieldNameResolution() {
		$result = $this->Form->create('ValidateUser');
		$this->assertEquals(array('ValidateUser'), $this->Form->entity());

		$result = $this->Form->input('ValidateItem.name');
		$this->assertEquals(array('ValidateItem', 'name'), $this->Form->entity());

		$result = $this->Form->input('ValidateUser.name');
		$this->assertEquals(array('ValidateUser', 'name'), $this->Form->entity());
		$this->assertRegExp('/name="data\[ValidateUser\]\[name\]"/', $result);
		$this->assertRegExp('/type="text"/', $result);

		$result = $this->Form->input('ValidateItem.name');
		$this->assertEquals(array('ValidateItem', 'name'), $this->Form->entity());
		$this->assertRegExp('/name="data\[ValidateItem\]\[name\]"/', $result);
		$this->assertRegExp('/<textarea/', $result);

		$result = $this->Form->input('name');
		$this->assertEquals(array('ValidateUser', 'name'), $this->Form->entity());
		$this->assertRegExp('/name="data\[ValidateUser\]\[name\]"/', $result);
		$this->assertRegExp('/type="text"/', $result);
	}

/**
 * Tests that hidden fields generated for checkboxes don't get locked
 *
 * @return void
 */
	public function testNoCheckboxLocking() {
		$this->Form->request['_Token'] = array('key' => 'foo');
		$this->assertSame(array(), $this->Form->fields);

		$this->Form->checkbox('check', array('value' => '1'));
		$this->assertSame($this->Form->fields, array('check'));
	}

/**
 * testFormSecurityFields method
 *
 * Test generation of secure form hash generation.
 *
 * @return void
 */
	public function testFormSecurityFields() {
		$key = 'testKey';
		$fields = array('Model.password', 'Model.username', 'Model.valid' => '0');

		$this->Form->request['_Token'] = array('key' => $key);
		$result = $this->Form->secure($fields);

		$expected = Security::hash(serialize($fields) . Configure::read('Security.salt'));
		$expected .= ':' . 'Model.valid';

		$expected = array(
			'div' => array('style' => 'display:none;'),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][fields]',
				'value' => urlencode($expected), 'id' => 'preg:/TokenFields\d+/'
			)),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][unlocked]',
				'value' => '', 'id' => 'preg:/TokenUnlocked\d+/'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * Tests correct generation of number fields for double and float fields
 *
 * @return void
 */
	public function testTextFieldGenerationForFloats() {
		$model = ClassRegistry::getObject('Contact');
		$model->setSchema(array('foo' => array(
			'type' => 'float',
			'null' => false,
			'default' => null,
			'length' => null
		)));

		$this->Form->create('Contact');
		$result = $this->Form->input('foo');
		$expected = array(
			'div' => array('class' => 'input number'),
			'label' => array('for' => 'ContactFoo'),
			'Foo',
			'/label',
			array('input' => array(
				'type' => 'number',
				'name' => 'data[Contact][foo]',
				'id' => 'ContactFoo',
				'step' => 'any'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('foo', array('step' => 0.5));
		$expected = array(
			'div' => array('class' => 'input number'),
			'label' => array('for' => 'ContactFoo'),
			'Foo',
			'/label',
			array('input' => array(
				'type' => 'number',
				'name' => 'data[Contact][foo]',
				'id' => 'ContactFoo',
				'step' => '0.5'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * Tests correct generation of number fields for integer fields
 *
 * @access public
 * @return void
 */
	public function testTextFieldTypeNumberGenerationForIntegers() {
		$model = ClassRegistry::getObject('Contact');
		$model->setSchema(array('foo' => array(
			'type' => 'integer',
			'null' => false,
			'default' => null,
			'length' => null
		)));

		$this->Form->create('Contact');
		$result = $this->Form->input('foo');
		$expected = array(
			'div' => array('class' => 'input number'),
			'label' => array('for' => 'ContactFoo'),
			'Foo',
			'/label',
			array('input' => array(
				'type' => 'number', 'name' => 'data[Contact][foo]',
				'id' => 'ContactFoo'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * testFormSecurityMultipleFields method
 *
 * Test secure() with multiple row form. Ensure hash is correct.
 *
 * @return void
 */
	public function testFormSecurityMultipleFields() {
		$key = 'testKey';

		$fields = array(
			'Model.0.password', 'Model.0.username', 'Model.0.hidden' => 'value',
			'Model.0.valid' => '0', 'Model.1.password', 'Model.1.username',
			'Model.1.hidden' => 'value', 'Model.1.valid' => '0'
		);
		$this->Form->request['_Token'] = array('key' => $key);
		$result = $this->Form->secure($fields);

		$hash  = '51e3b55a6edd82020b3f29c9ae200e14bbeb7ee5%3AModel.0.hidden%7CModel.0.valid';
		$hash .= '%7CModel.1.hidden%7CModel.1.valid';

		$expected = array(
			'div' => array('style' => 'display:none;'),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][fields]',
				'value' => $hash, 'id' => 'preg:/TokenFields\d+/'
			)),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][unlocked]',
				'value' => '', 'id' => 'preg:/TokenUnlocked\d+/'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * testFormSecurityMultipleSubmitButtons
 *
 * test form submit generation and ensure that _Token is only created on end()
 *
 * @return void
 */
	public function testFormSecurityMultipleSubmitButtons() {
		$key = 'testKey';
		$this->Form->request['_Token'] = array('key' => $key);

		$this->Form->create('Addresses');
		$this->Form->input('Address.title');
		$this->Form->input('Address.first_name');

		$result = $this->Form->submit('Save', array('name' => 'save'));
		$expected = array(
			'div' => array('class' => 'submit'),
			'input' => array('type' => 'submit', 'name' => 'save', 'value' => 'Save'),
			'/div',
		);
		$this->assertTags($result, $expected);
		$result = $this->Form->submit('Cancel', array('name' => 'cancel'));
		$expected = array(
			'div' => array('class' => 'submit'),
			'input' => array('type' => 'submit', 'name' => 'cancel', 'value' => 'Cancel'),
			'/div',
		);
		$this->assertTags($result, $expected);
		$result = $this->Form->end(null);

		$expected = array(
			'div' => array('style' => 'display:none;'),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][fields]',
				'value' => 'preg:/.+/', 'id' => 'preg:/TokenFields\d+/'
			)),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][unlocked]',
				'value' => 'cancel%7Csave', 'id' => 'preg:/TokenUnlocked\d+/'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * Test that buttons created with foo[bar] name attributes are unlocked correctly.
 *
 * @return void
 */
	public function testSecurityButtonNestedNamed() {
		$key = 'testKey';
		$this->Form->request['_Token'] = array('key' => $key);

		$this->Form->create('Addresses');
		$this->Form->button('Test', array('type' => 'submit', 'name' => 'Address[button]'));
		$result = $this->Form->unlockField();
		$this->assertEquals(array('Address.button'), $result);
	}

/**
 * Test that submit inputs created with foo[bar] name attributes are unlocked correctly.
 *
 * @return void
 */
	public function testSecuritySubmitNestedNamed() {
		$key = 'testKey';
		$this->Form->request['_Token'] = array('key' => $key);

		$this->Form->create('Addresses');
		$this->Form->submit('Test', array('type' => 'submit', 'name' => 'Address[button]'));
		$result = $this->Form->unlockField();
		$this->assertEquals(array('Address.button'), $result);
	}

/**
 * Test that the correct fields are unlocked for image submits with no names.
 *
 * @return void
 */
	public function testSecuritySubmitImageNoName() {
		$key = 'testKey';
		$this->Form->request['_Token'] = array('key' => $key);

		$this->Form->create('User');
		$result = $this->Form->submit('save.png');
		$expected = array(
			'div' => array('class' => 'submit'),
			'input' => array('type' => 'image', 'src' => 'img/save.png'),
			'/div'
		);
		$this->assertTags($result, $expected);
		$this->assertEquals(array('x', 'y'), $this->Form->unlockField());
	}

/**
 * Test that the correct fields are unlocked for image submits with names.
 *
 * @return void
 */
	public function testSecuritySubmitImageName() {
		$key = 'testKey';
		$this->Form->request['_Token'] = array('key' => $key);

		$this->Form->create('User');
		$result = $this->Form->submit('save.png', array('name' => 'test'));
		$expected = array(
			'div' => array('class' => 'submit'),
			'input' => array('type' => 'image', 'name' => 'test', 'src' => 'img/save.png'),
			'/div'
		);
		$this->assertTags($result, $expected);
		$this->assertEquals(array('test', 'test_x', 'test_y'), $this->Form->unlockField());
	}

/**
 * testFormSecurityMultipleInputFields method
 *
 * Test secure form creation with multiple row creation.  Checks hidden, text, checkbox field types
 *
 * @return void
 */
	public function testFormSecurityMultipleInputFields() {
		$key = 'testKey';

		$this->Form->request['_Token'] = array('key' => $key);
		$this->Form->create('Addresses');

		$this->Form->hidden('Addresses.0.id', array('value' => '123456'));
		$this->Form->input('Addresses.0.title');
		$this->Form->input('Addresses.0.first_name');
		$this->Form->input('Addresses.0.last_name');
		$this->Form->input('Addresses.0.address');
		$this->Form->input('Addresses.0.city');
		$this->Form->input('Addresses.0.phone');
		$this->Form->input('Addresses.0.primary', array('type' => 'checkbox'));

		$this->Form->hidden('Addresses.1.id', array('value' => '654321'));
		$this->Form->input('Addresses.1.title');
		$this->Form->input('Addresses.1.first_name');
		$this->Form->input('Addresses.1.last_name');
		$this->Form->input('Addresses.1.address');
		$this->Form->input('Addresses.1.city');
		$this->Form->input('Addresses.1.phone');
		$this->Form->input('Addresses.1.primary', array('type' => 'checkbox'));

		$result = $this->Form->secure($this->Form->fields);

		$hash = 'c9118120e680a7201b543f562e5301006ccfcbe2%3AAddresses.0.id%7CAddresses.1.id';

		$expected = array(
			'div' => array('style' => 'display:none;'),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][fields]',
				'value' => $hash, 'id' => 'preg:/TokenFields\d+/'
			)),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][unlocked]',
				'value' => '', 'id' => 'preg:/TokenUnlocked\d+/'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * Test form security with Model.field.0 style inputs
 *
 * @return void
 */
	public function testFormSecurityArrayFields() {
		$key = 'testKey';

		$this->Form->request->params['_Token']['key'] = $key;
		$this->Form->create('Address');
		$this->Form->input('Address.primary.1');
		$this->assertEquals('Address.primary', $this->Form->fields[0]);

		$this->Form->input('Address.secondary.1.0');
		$this->assertEquals('Address.secondary', $this->Form->fields[1]);
	}

/**
 * testFormSecurityMultipleInputDisabledFields method
 *
 * test secure form generation with multiple records and disabled fields.
 *
 * @return void
 */
	public function testFormSecurityMultipleInputDisabledFields() {
		$key = 'testKey';
		$this->Form->request->params['_Token'] = array(
			'key' => $key,
			'unlockedFields' => array('first_name', 'address')
		);
		$this->Form->create();

		$this->Form->hidden('Addresses.0.id', array('value' => '123456'));
		$this->Form->input('Addresses.0.title');
		$this->Form->input('Addresses.0.first_name');
		$this->Form->input('Addresses.0.last_name');
		$this->Form->input('Addresses.0.address');
		$this->Form->input('Addresses.0.city');
		$this->Form->input('Addresses.0.phone');
		$this->Form->hidden('Addresses.1.id', array('value' => '654321'));
		$this->Form->input('Addresses.1.title');
		$this->Form->input('Addresses.1.first_name');
		$this->Form->input('Addresses.1.last_name');
		$this->Form->input('Addresses.1.address');
		$this->Form->input('Addresses.1.city');
		$this->Form->input('Addresses.1.phone');

		$result = $this->Form->secure($this->Form->fields);
		$hash = '629b6536dcece48aa41a117045628ce602ccbbb2%3AAddresses.0.id%7CAddresses.1.id';

		$expected = array(
			'div' => array('style' => 'display:none;'),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][fields]',
				'value' => $hash, 'id' => 'preg:/TokenFields\d+/'
			)),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][unlocked]',
				'value' => 'address%7Cfirst_name', 'id' => 'preg:/TokenUnlocked\d+/'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * testFormSecurityInputDisabledFields method
 *
 * Test single record form with disabled fields.
 *
 * @return void
 */
	public function testFormSecurityInputUnlockedFields() {
		$key = 'testKey';
		$this->Form->request['_Token'] = array(
			'key' => $key,
			'unlockedFields' => array('first_name', 'address')
		);
		$this->Form->create();
		$this->assertEquals($this->Form->request['_Token']['unlockedFields'], $this->Form->unlockField());

		$this->Form->hidden('Addresses.id', array('value' => '123456'));
		$this->Form->input('Addresses.title');
		$this->Form->input('Addresses.first_name');
		$this->Form->input('Addresses.last_name');
		$this->Form->input('Addresses.address');
		$this->Form->input('Addresses.city');
		$this->Form->input('Addresses.phone');

		$result = $this->Form->fields;
		$expected = array(
			'Addresses.id' => '123456', 'Addresses.title', 'Addresses.last_name',
			'Addresses.city', 'Addresses.phone'
		);
		$this->assertEquals($expected, $result);

		$result = $this->Form->secure($expected);

		$hash = '2981c38990f3f6ba935e6561dc77277966fabd6d%3AAddresses.id';
		$expected = array(
			'div' => array('style' => 'display:none;'),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][fields]',
				'value' => $hash, 'id' => 'preg:/TokenFields\d+/'
			)),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][unlocked]',
				'value' => 'address%7Cfirst_name', 'id' => 'preg:/TokenUnlocked\d+/'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * test securing inputs with custom name attributes.
 *
 * @return void
 */
	public function testFormSecureWithCustomNameAttribute() {
		$this->Form->request->params['_Token']['key'] = 'testKey';

		$this->Form->text('UserForm.published', array('name' => 'data[User][custom]'));
		$this->assertEquals('User.custom', $this->Form->fields[0]);

		$this->Form->text('UserForm.published', array('name' => 'data[User][custom][another][value]'));
		$this->assertEquals('User.custom.another.value', $this->Form->fields[1]);
	}

/**
 * testFormSecuredInput method
 *
 * Test generation of entire secure form, assertions made on input() output.
 *
 * @return void
 */
	public function testFormSecuredInput() {
		$this->Form->request['_Token'] = array('key' => 'testKey');

		$result = $this->Form->create('Contact', array('url' => '/contacts/add'));
		$encoding = strtolower(Configure::read('App.encoding'));
		$expected = array(
			'form' => array('method' => 'post', 'action' => '/contacts/add', 'accept-charset' => $encoding, 'id' => 'ContactAddForm'),
			'div' => array('style' => 'display:none;'),
			array('input' => array('type' => 'hidden', 'name' => '_method', 'value' => 'POST')),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][key]',
				'value' => 'testKey', 'id' => 'preg:/Token\d+/'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('UserForm.published', array('type' => 'text'));
		$expected = array(
			'div' => array('class' => 'input text'),
			'label' => array('for' => 'UserFormPublished'),
			'Published',
			'/label',
			array('input' => array(
				'type' => 'text', 'name' => 'data[UserForm][published]',
				'id' => 'UserFormPublished'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('UserForm.other', array('type' => 'text'));
		$expected = array(
			'div' => array('class' => 'input text'),
			'label' => array('for' => 'UserFormOther'),
			'Other',
			'/label',
			array('input' => array(
				'type' => 'text', 'name' => 'data[UserForm][other]',
				'id' => 'UserFormOther'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->hidden('UserForm.stuff');
		$expected = array('input' => array(
				'type' => 'hidden', 'name' => 'data[UserForm][stuff]',
				'id' => 'UserFormStuff'
		));
		$this->assertTags($result, $expected);

		$result = $this->Form->hidden('UserForm.hidden', array('value' => '0'));
		$expected = array('input' => array(
			'type' => 'hidden', 'name' => 'data[UserForm][hidden]',
			'value' => '0', 'id' => 'UserFormHidden'
		));
		$this->assertTags($result, $expected);

		$result = $this->Form->input('UserForm.something', array('type' => 'checkbox'));
		$expected = array(
			'div' => array('class' => 'input checkbox'),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[UserForm][something]',
				'value' => '0', 'id' => 'UserFormSomething_'
			)),
			array('input' => array(
				'type' => 'checkbox', 'name' => 'data[UserForm][something]',
				'value' => '1', 'id' => 'UserFormSomething'
			)),
			'label' => array('for' => 'UserFormSomething'),
			'Something',
			'/label',
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->fields;
		$expected = array(
			'UserForm.published', 'UserForm.other', 'UserForm.stuff' => '',
			'UserForm.hidden' => '0', 'UserForm.something'
		);
		$this->assertEquals($expected, $result);

		$hash = 'bd7c4a654e5361f9a433a43f488ff9a1065d0aaf%3AUserForm.hidden%7CUserForm.stuff';

		$result = $this->Form->secure($this->Form->fields);
		$expected = array(
			'div' => array('style' => 'display:none;'),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][fields]',
				'value' => $hash, 'id' => 'preg:/TokenFields\d+/'
			)),
			array('input' => array(
				'type' => 'hidden', 'name' => 'data[_Token][unlocked]',
				'value' => '', 'id' => 'preg:/TokenUnlocked\d+/'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * Tests that the correct keys are added to the field hash index
 *
 * @return void
 */
	public function testFormSecuredFileInput() {
		$this->Form->request['_Token'] = array('key' => 'testKey');
		$this->assertEquals(array(), $this->Form->fields);

		$result = $this->Form->file('Attachment.file');
		$expected = array(
			'Attachment.file.name', 'Attachment.file.type', 'Attachment.file.tmp_name',
			'Attachment.file.error', 'Attachment.file.size'
		);
		$this->assertEquals($expected, $this->Form->fields);
	}

/**
 * test that multiple selects keys are added to field hash
 *
 * @return void
 */
	public function testFormSecuredMultipleSelect() {
		$this->Form->request['_Token'] = array('key' => 'testKey');
		$this->assertEquals(array(), $this->Form->fields);
		$options = array('1' => 'one', '2' => 'two');

		$this->Form->select('Model.select', $options);
		$expected = array('Model.select');
		$this->assertEquals($expected, $this->Form->fields);

		$this->Form->fields = array();
		$this->Form->select('Model.select', $options, array('multiple' => true));
		$this->assertEquals($expected, $this->Form->fields);
	}

/**
 * testFormSecuredRadio method
 *
 * @return void
 */
	public function testFormSecuredRadio() {
		$this->Form->request['_Token'] = array('key' => 'testKey');
		$this->assertEquals(array(), $this->Form->fields);
		$options = array('1' => 'option1', '2' => 'option2');

		$this->Form->radio('Test.test', $options);
		$expected = array('Test.test');
		$this->assertEquals($expected, $this->Form->fields);
	}

/**
 * test that forms with disabled inputs + secured forms leave off the inputs from the form
 * hashing.
 *
 * @return void
 */
	public function testFormSecuredAndDisabled() {
		$this->Form->request['_Token'] = array('key' => 'testKey');

		$this->Form->checkbox('Model.checkbox', array('disabled' => true));
		$this->Form->text('Model.text', array('disabled' => true));
		$this->Form->password('Model.text', array('disabled' => true));
		$this->Form->textarea('Model.textarea', array('disabled' => true));
		$this->Form->select('Model.select', array(1, 2), array('disabled' => true));
		$this->Form->radio('Model.radio', array(1, 2), array('disabled' => array(1, 2)));
		$this->Form->year('Model.year', null, null, array('disabled' => true));
		$this->Form->month('Model.month', array('disabled' => true));
		$this->Form->day('Model.day', array('disabled' => true));
		$this->Form->hour('Model.hour', false, array('disabled' => true));
		$this->Form->minute('Model.minute', array('disabled' => true));
		$this->Form->meridian('Model.meridian', array('disabled' => true));

		$expected = array(
			'Model.radio' => ''
		);
		$this->assertEquals($expected, $this->Form->fields);
	}

/**
 * testDisableSecurityUsingForm method
 *
 * @return void
 */
	public function testDisableSecurityUsingForm() {
		$this->Form->request['_Token'] = array(
			'key' => 'testKey',
			'disabledFields' => array()
		);
		$this->Form->create();

		$this->Form->hidden('Addresses.id', array('value' => '123456'));
		$this->Form->input('Addresses.title');
		$this->Form->input('Addresses.first_name', array('secure' => false));
		$this->Form->input('Addresses.city', array('type' => 'textarea', 'secure' => false));
		$this->Form->input('Addresses.zip', array(
			'type' => 'select', 'options' => array(1,2), 'secure' => false
		));

		$result = $this->Form->fields;
		$expected = array(
			'Addresses.id' => '123456', 'Addresses.title',
		);
		$this->assertEquals($expected, $result);
	}

/**
 * test disableField
 *
 * @return void
 */
	public function testUnlockFieldAddsToList() {
		$this->Form->request['_Token'] = array(
			'key' => 'testKey',
			'unlockedFields' => array()
		);
		$this->Form->create('Contact');
		$this->Form->unlockField('Contact.name');
		$this->Form->text('Contact.name');

		$this->assertEquals(array('Contact.name'), $this->Form->unlockField());
		$this->assertEquals(array(), $this->Form->fields);
	}

/**
 * test unlockField removing from fields array.
 *
 * @return void
 */
	public function testUnlockFieldRemovingFromFields() {
		$this->Form->request['_Token'] = array(
			'key' => 'testKey',
			'unlockedFields' => array()
		);
		$this->Form->create('Contact');
		$this->Form->hidden('Contact.id', array('value' => 1));
		$this->Form->text('Contact.name');

		$this->assertEquals(1, $this->Form->fields['Contact.id'], 'Hidden input should be secured.');
		$this->assertTrue(in_array('Contact.name', $this->Form->fields), 'Field should be secured.');

		$this->Form->unlockField('Contact.name');
		$this->Form->unlockField('Contact.id');
		$this->assertEquals(array(), $this->Form->fields);
	}

/**
 * testTagIsInvalid method
 *
 * @return void
 */
	public function testTagIsInvalid() {
		$Contact = ClassRegistry::getObject('Contact');
		$Contact->validationErrors[0]['email'] = array('Please provide an email');

		$this->Form->setEntity('Contact.0.email');
		$result = $this->Form->tagIsInvalid();
		$expected = array('Please provide an email');
		$this->assertEquals($expected, $result);

		$this->Form->setEntity('Contact.1.email');
		$result = $this->Form->tagIsInvalid();
		$expected = false;
		$this->assertSame($expected, $result);

		$this->Form->setEntity('Contact.0.name');
		$result = $this->Form->tagIsInvalid();
		$expected = false;
		$this->assertSame($expected, $result);
	}

/**
 * testPasswordValidation method
 *
 * test validation errors on password input.
 *
 * @return void
 */
	public function testPasswordValidation() {
		$Contact = ClassRegistry::getObject('Contact');
		$Contact->validationErrors['password'] = array('Please provide a password');

		$result = $this->Form->input('Contact.password');
		$expected = array(
			'div' => array('class' => 'input password error'),
			'label' => array('for' => 'ContactPassword'),
			'Password',
			'/label',
			'input' => array(
				'type' => 'password', 'name' => 'data[Contact][password]',
				'id' => 'ContactPassword', 'class' => 'form-error'
			),
			array('div' => array('class' => 'error-message')),
			'Please provide a password',
			'/div',
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * testEmptyErrorValidation method
 *
 * test validation error div when validation message is an empty string
 *
 * @access public
 * @return void
 */
	public function testEmptyErrorValidation() {
		$this->Form->validationErrors['Contact']['password'] = '';
		$result = $this->Form->input('Contact.password');
		$expected = array(
			'div' => array('class' => 'input password error'),
			'label' => array('for' => 'ContactPassword'),
			'Password',
			'/label',
			'input' => array(
				'type' => 'password', 'name' => 'data[Contact][password]',
				'id' => 'ContactPassword', 'class' => 'form-error'
			),
			array('div' => array('class' => 'error-message')),
			array(),
			'/div',
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * testEmptyInputErrorValidation method
 *
 * test validation error div when validation message is overridden by an empty string when calling input()
 *
 * @access public
 * @return void
 */
	public function testEmptyInputErrorValidation() {
		$this->Form->validationErrors['Contact']['password'] = 'Please provide a password';
		$result = $this->Form->input('Contact.password', array('error' => ''));
		$expected = array(
			'div' => array('class' => 'input password error'),
			'label' => array('for' => 'ContactPassword'),
			'Password',
			'/label',
			'input' => array(
				'type' => 'password', 'name' => 'data[Contact][password]',
				'id' => 'ContactPassword', 'class' => 'form-error'
			),
			array('div' => array('class' => 'error-message')),
			array(),
			'/div',
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * testFormValidationAssociated method
 *
 * test display of form errors in conjunction with model::validates.
 *
 * @return void
 */
	public function testFormValidationAssociated() {
		$this->UserForm = ClassRegistry::getObject('UserForm');
		$this->UserForm->OpenidUrl = ClassRegistry::getObject('OpenidUrl');

		$data = array(
			'UserForm' => array('name' => 'user'),
			'OpenidUrl' => array('url' => 'http://www.cakephp.org')
		);

		$result = $this->UserForm->OpenidUrl->create($data);
		$this->assertFalse(empty($result));
		$this->assertFalse($this->UserForm->OpenidUrl->validates());

		$result = $this->Form->create('UserForm', array('type' => 'post', 'action' => 'login'));
		$encoding = strtolower(Configure::read('App.encoding'));
		$expected = array(
			'form' => array(
				'method' => 'post', 'action' => '/user_forms/login', 'id' => 'UserFormLoginForm',
				'accept-charset' => $encoding
			),
			'div' => array('style' => 'display:none;'),
			'input' => array('type' => 'hidden', 'name' => '_method', 'value' => 'POST'),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->error(
			'OpenidUrl.openid_not_registered', 'Error, not registered', array('wrap' => false)
		);
		$this->assertEquals('Error, not registered', $result);

		unset($this->UserForm->OpenidUrl, $this->UserForm);
	}

/**
 * testFormValidationAssociatedFirstLevel method
 *
 * test form error display with associated model.
 *
 * @return void
 */
	public function testFormValidationAssociatedFirstLevel() {
		$this->ValidateUser = ClassRegistry::getObject('ValidateUser');
		$this->ValidateUser->ValidateProfile = ClassRegistry::getObject('ValidateProfile');

		$data = array(
			'ValidateUser' => array('name' => 'mariano'),
			'ValidateProfile' => array('full_name' => 'Mariano Iglesias')
		);

		$result = $this->ValidateUser->create($data);
		$this->assertFalse(empty($result));
		$this->assertFalse($this->ValidateUser->validates());
		$this->assertFalse($this->ValidateUser->ValidateProfile->validates());

		$result = $this->Form->create('ValidateUser', array('type' => 'post', 'action' => 'add'));
		$encoding = strtolower(Configure::read('App.encoding'));
		$expected = array(
			'form' => array('method' => 'post', 'action' => '/validate_users/add', 'id','accept-charset' => $encoding),
			'div' => array('style' => 'display:none;'),
			'input' => array('type' => 'hidden', 'name' => '_method', 'value' => 'POST'),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->error(
			'ValidateUser.email', 'Invalid email', array('wrap' => false)
		);
		$this->assertEquals('Invalid email', $result);

		$result = $this->Form->error(
			'ValidateProfile.full_name', 'Invalid name', array('wrap' => false)
		);
		$this->assertEquals('Invalid name', $result);

		$result = $this->Form->error(
			'ValidateProfile.city', 'Invalid city', array('wrap' => false)
		);
		$this->assertEquals('Invalid city', $result);

		unset($this->ValidateUser->ValidateProfile);
		unset($this->ValidateUser);
	}

/**
 * testFormValidationAssociatedSecondLevel method
 *
 * test form error display with associated model.
 *
 * @return void
 */
	public function testFormValidationAssociatedSecondLevel() {
		$this->ValidateUser = ClassRegistry::getObject('ValidateUser');
		$this->ValidateUser->ValidateProfile = ClassRegistry::getObject('ValidateProfile');
		$this->ValidateUser->ValidateProfile->ValidateItem = ClassRegistry::getObject('ValidateItem');

		$data = array(
			'ValidateUser' => array('name' => 'mariano'),
			'ValidateProfile' => array('full_name' => 'Mariano Iglesias'),
			'ValidateItem' => array('name' => 'Item')
		);

		$result = $this->ValidateUser->create($data);
		$this->assertFalse(empty($result));
		$this->assertFalse($this->ValidateUser->validates());
		$this->assertFalse($this->ValidateUser->ValidateProfile->validates());
		$this->assertFalse($this->ValidateUser->ValidateProfile->ValidateItem->validates());

		$result = $this->Form->create('ValidateUser', array('type' => 'post', 'action' => 'add'));
		$encoding = strtolower(Configure::read('App.encoding'));
		$expected = array(
			'form' => array('method' => 'post', 'action' => '/validate_users/add', 'id','accept-charset' => $encoding),
			'div' => array('style' => 'display:none;'),
			'input' => array('type' => 'hidden', 'name' => '_method', 'value' => 'POST'),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->error(
			'ValidateUser.email', 'Invalid email', array('wrap' => false)
		);
		$this->assertEquals('Invalid email', $result);

		$result = $this->Form->error(
			'ValidateProfile.full_name', 'Invalid name', array('wrap' => false)
		);
		$this->assertEquals('Invalid name', $result);

		$result = $this->Form->error(
			'ValidateProfile.city', 'Invalid city', array('wrap' => false)
		);

		$result = $this->Form->error(
			'ValidateItem.description', 'Invalid description', array('wrap' => false)
		);
		$this->assertEquals('Invalid description', $result);

		unset($this->ValidateUser->ValidateProfile->ValidateItem);
		unset($this->ValidateUser->ValidateProfile);
		unset($this->ValidateUser);
	}

/**
 * testFormValidationMultiRecord method
 *
 * test form error display with multiple records.
 *
 * @return void
 */
	public function testFormValidationMultiRecord() {
		$Contact = ClassRegistry::getObject('Contact');
		$Contact->validationErrors[2] = array(
			'name' => array('This field cannot be left blank')
		);
		$result = $this->Form->input('Contact.2.name');
		$expected = array(
			'div' => array('class' => 'input text error'),
			'label' => array('for' => 'Contact2Name'),
			'Name',
			'/label',
			'input' => array(
				'type' => 'text', 'name' => 'data[Contact][2][name]', 'id' => 'Contact2Name',
				'class' => 'form-error', 'maxlength' => 255
			),
			array('div' => array('class' => 'error-message')),
			'This field cannot be left blank',
			'/div',
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * testMultipleInputValidation method
 *
 * test multiple record form validation error display.
 *
 * @return void
 */
	public function testMultipleInputValidation() {
		$Address = ClassRegistry::init(array('class' => 'Address', 'table' => false, 'ds' => 'test'));
		$Address->validationErrors[0] = array(
			'title' => array('This field cannot be empty'),
			'first_name' => array('This field cannot be empty')
		);
		$Address->validationErrors[1] = array(
			'last_name' => array('You must have a last name')
		);
		$this->Form->create();

		$result = $this->Form->input('Address.0.title');
		$expected = array(
			'div' => array('class'),
			'label' => array('for'),
			'preg:/[^<]+/',
			'/label',
			'input' => array(
				'type' => 'text', 'name', 'id', 'class' => 'form-error'
			),
			array('div' => array('class' => 'error-message')),
			'This field cannot be empty',
			'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Address.0.first_name');
		$expected = array(
			'div' => array('class'),
			'label' => array('for'),
			'preg:/[^<]+/',
			'/label',
			'input' => array('type' => 'text', 'name', 'id', 'class' => 'form-error'),
			array('div' => array('class' => 'error-message')),
			'This field cannot be empty',
			'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Address.0.last_name');
		$expected = array(
			'div' => array('class'),
			'label' => array('for'),
			'preg:/[^<]+/',
			'/label',
			'input' => array('type' => 'text', 'name', 'id'),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Address.1.last_name');
		$expected = array(
			'div' => array('class'),
			'label' => array('for'),
			'preg:/[^<]+/',
			'/label',
			'input' => array(
				'type' => 'text', 'name' => 'preg:/[^<]+/',
				'id' => 'preg:/[^<]+/', 'class' => 'form-error'
			),
			array('div' => array('class' => 'error-message')),
			'You must have a last name',
			'/div',
			'/div'
		);
		$this->assertTags($result, $expected);
	}

/**
 * testInput method
 *
 * Test various incarnations of input().
 *
 * @return void
 */
	public function testInput() {
		$result = $this->Form->input('ValidateUser.balance');
		$expected = array(
			'div' => array('class'),
			'label' => array('for'),
			'Balance',
			'/label',
			'input' => array('name', 'type' => 'number', 'maxlength' => 8, 'id'),
			'/div',
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Contact.email', array('id' => 'custom'));
		$expected = array(
			'div' => array('class' => 'input text'),
			'label' => array('for' => 'custom'),
			'Email',
			'/label',
			array('input' => array(
				'type' => 'text', 'name' => 'data[Contact][email]',
				'id' => 'custom', 'maxlength' => 255
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Contact.email', array('div' => array('class' => false)));
		$expected = array(
			'<div',
			'label' => array('for' => 'ContactEmail'),
			'Email',
			'/label',
			array('input' => array(
				'type' => 'text', 'name' => 'data[Contact][email]',
				'id' => 'ContactEmail', 'maxlength' => 255
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->hidden('Contact.idontexist');
		$expected = array('input' => array(
				'type' => 'hidden', 'name' => 'data[Contact][idontexist]',
				'id' => 'ContactIdontexist'
		));
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Contact.email', array('type' => 'text'));
		$expected = array(
			'div' => array('class' => 'input text'),
			'label' => array('for' => 'ContactEmail'),
			'Email',
			'/label',
			array('input' => array(
				'type' => 'text', 'name' => 'data[Contact][email]',
				'id' => 'ContactEmail'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Contact.5.email', array('type' => 'text'));
		$expected = array(
			'div' => array('class' => 'input text'),
			'label' => array('for' => 'Contact5Email'),
			'Email',
			'/label',
			array('input' => array(
				'type' => 'text', 'name' => 'data[Contact][5][email]',
				'id' => 'Contact5Email'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Contact.password');
		$expected = array(
			'div' => array('class' => 'input password'),
			'label' => array('for' => 'ContactPassword'),
			'Password',
			'/label',
			array('input' => array(
				'type' => 'password', 'name' => 'data[Contact][password]',
				'id' => 'ContactPassword'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Contact.email', array(
			'type' => 'file', 'class' => 'textbox'
		));
		$expected = array(
			'div' => array('class' => 'input file'),
			'label' => array('for' => 'ContactEmail'),
			'Email',
			'/label',
			array('input' => array(
				'type' => 'file', 'name' => 'data[Contact][email]', 'class' => 'textbox',
				'id' => 'ContactEmail'
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$this->Form->request->data = array('Contact' => array('phone' => 'Hello & World > weird chars'));
		$result = $this->Form->input('Contact.phone');
		$expected = array(
			'div' => array('class' => 'input text'),
			'label' => array('for' => 'ContactPhone'),
			'Phone',
			'/label',
			array('input' => array(
				'type' => 'text', 'name' => 'data[Contact][phone]',
				'value' => 'Hello &amp; World &gt; weird chars',
				'id' => 'ContactPhone', 'maxlength' => 255
			)),
			'/div'
		);
		$this->assertTags($result, $expected);

		$this->Form->request->data['Model']['0']['OtherModel']['field'] = 'My value';
		$result = $this->Form->input('Model.0.OtherModel.field', array('id' => 'myId'));
		$expected = array(
			'div' => array('class' => 'input text'),
			'label' => array('for' => 'myId'),
			'Field',
			'/label',
			'input' => array(
				'type' => 'text', 'name' => 'data[Model][0][OtherModel][field]',
				'value' => 'My value', 'id' => 'myId'
			),
			'/div'
		);
		$this->assertTags($result, $expected);

		unset($this->Form->request->data);

		$Contact = ClassRegistry::getObject('Contact');
		$Contact->validationErrors['field'] = array('Badness!');
		$result = $this->Form->input('Contact.field');
		$expected = array(
			'div' => array('class' => 'input text error'),
			'label' => array('for' => 'ContactField'),
			'Field',
			'/label',
			'input' => array(
				'type' => 'text', 'name' => 'data[Contact][field]',
				'id' => 'ContactField', 'class' => 'form-error'
			),
			array('div' => array('class' => 'error-message')),
			'Badness!',
			'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Contact.field', array(
			'div' => false, 'error' => array('attributes' => array('wrap' => 'span'))
		));
		$expected = array(
			'label' => array('for' => 'ContactField'),
			'Field',
			'/label',
			'input' => array(
				'type' => 'text', 'name' => 'data[Contact][field]',
				'id' => 'ContactField', 'class' => 'form-error'
			),
			array('span' => array('class' => 'error-message')),
			'Badness!',
			'/span'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Contact.field', array(
			'type' => 'text', 'error' => array('attributes' => array('class' => 'error'))
		));
		$expected = array(
			'div' => array('class' => 'input text error'),
			'label' => array('for' => 'ContactField'),
			'Field',
			'/label',
			'input' => array(
				'type' => 'text', 'name' => 'data[Contact][field]',
				'id' => 'ContactField', 'class' => 'form-error'
			),
			array('div' => array('class' => 'error')),
			'Badness!',
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Contact.field', array(
			'div' => array('tag' => 'span'), 'error' => array('attributes' => array('wrap' => false))
		));
		$expected = array(
			'span' => array('class' => 'input text error'),
			'label' => array('for' => 'ContactField'),
			'Field',
			'/label',
			'input' => array(
				'type' => 'text', 'name' => 'data[Contact][field]',
				'id' => 'ContactField', 'class' => 'form-error'
			),
			'Badness!',
			'/span'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Contact.field', array('after' => 'A message to you, Rudy'));
		$expected = array(
			'div' => array('class' => 'input text error'),
			'label' => array('for' => 'ContactField'),
			'Field',
			'/label',
			'input' => array(
				'type' => 'text', 'name' => 'data[Contact][field]',
				'id' => 'ContactField', 'class' => 'form-error'
			),
			'A message to you, Rudy',
			array('div' => array('class' => 'error-message')),
			'Badness!',
			'/div',
			'/div'
		);
		$this->assertTags($result, $expected);

		$this->Form->setEntity(null);
		$this->Form->setEntity('Contact.field');
		$result = $this->Form->input('Contact.field', array(
			'after' => 'A message to you, Rudy', 'error' => false
		));
		$expected = array(
			'div' => array('class' => 'input text'),
			'label' => array('for' => 'ContactField'),
			'Field',
			'/label',
			'input' => array('type' => 'text', 'name' => 'data[Contact][field]', 'id' => 'ContactField', 'class' => 'form-error'),
			'A message to you, Rudy',
			'/div'
		);
		$this->assertTags($result, $expected);

		$result = $this->Form->input('Object.field', array('after' => 'A message to you, Rudy'));
		$expected = array(
			'div