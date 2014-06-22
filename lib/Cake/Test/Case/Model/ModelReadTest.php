<?php
/**
 * ModelReadTest file
 *
 * PHP 5
 *
 * CakePHP(tm) Tests <http://book.cakephp.org/2.0/en/development/testing.html>
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://book.cakephp.org/2.0/en/development/testing.html CakePHP(tm) Tests
 * @package       Cake.Test.Case.Model
 * @since         CakePHP(tm) v 1.2.0.4206
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
require_once dirname(__FILE__) . DS . 'ModelTestBase.php';
/**
 * ModelReadTest
 *
 * @package       Cake.Test.Case.Model
 */
class ModelReadTest extends BaseModelTest {

/**
 * testExists function
 * @retun void
 */
	public function testExists() {
		$this->loadFixtures('User');
		$TestModel = new User();

		$this->assertTrue($TestModel->exists(1));

		$TestModel->id = 2;
		$this->assertTrue($TestModel->exists());

		$TestModel->delete();
		$this->assertFalse($TestModel->exists());

		$this->assertFalse($TestModel->exists(2));
	}

/**
 * testFetchingNonUniqueFKJoinTableRecords()
 *
 * Tests if the results are properly returned in the case there are non-unique FK's
 * in the join table but another fields value is different. For example:
 * something_id | something_else_id | doomed = 1
 * something_id | something_else_id | doomed = 0
 * Should return both records and not just one.
 *
 * @return void
 */
	public function testFetchingNonUniqueFKJoinTableRecords() {
		$this->loadFixtures('Something', 'SomethingElse', 'JoinThing');
		$Something = new Something();

		$joinThingData = array(
			'JoinThing' => array(
				'something_id' => 1,
				'something_else_id' => 2,
				'doomed' => '0',
				'created' => '2007-03-18 10:39:23',
				'updated' => '2007-03-18 10:41:31'
			)
		);

		$Something->JoinThing->create($joinThingData);
		$Something->JoinThing->save();

		$result = $Something->JoinThing->find('all', array('conditions' => array('something_else_id' => 2)));

		$this->assertEquals(true, $result[0]['JoinThing']['doomed']);
		$this->assertEquals(false, $result[1]['JoinThing']['doomed']);

		$result = $Something->find('first');

		$this->assertEquals(2, count($result['SomethingElse']));

		$doomed = Hash::extract($result['SomethingElse'], '{n}.JoinThing.doomed');
		$this->assertTrue(in_array(true, $doomed));
		$this->assertTrue(in_array(false, $doomed));
	}

/**
 * testGroupBy method
 *
 * These tests will never pass with Postgres or Oracle as all fields in a select must be
 * part of an aggregate function or in the GROUP BY statement.
 *
 * @return void
 */
	public function testGroupBy() {
		$isStrictGroupBy = $this->db instanceof Postgres || $this->db instanceof Sqlite || $this->db instanceof Oracle || $this->db instanceof Sqlserver;
		$message = 'Postgres, Oracle, SQLite and SQL Server have strict GROUP BY and are incompatible with this test.';

		$this->skipIf($isStrictGroupBy, $message);

		$this->loadFixtures('Project', 'Product', 'Thread', 'Message', 'Bid');
		$Thread = new Thread();
		$Product = new Product();

		$result = $Thread->find('all', array(
			'group' => 'Thread.project_id',
			'order' => 'Thread.id ASC'
		));

		$expected = array(
			array(
				'Thread' => array(
					'id' => 1,
					'project_id' => 1,
					'name' => 'Project 1, Thread 1'
				),
				'Project' => array(
					'id' => 1,
					'name' => 'Project 1'
				),
				'Message' => array(
					array(
						'id' => 1,
						'thread_id' => 1,
						'name' => 'Thread 1, Message 1'
			))),
			array(
				'Thread' => array(
					'id' => 3,
					'project_id' => 2,
					'name' => 'Project 2, Thread 1'
				),
				'Project' => array(
					'id' => 2,
					'name' => 'Project 2'
				),
				'Message' => array(
					array(
						'id' => 3,
						'thread_id' => 3,
						'name' => 'Thread 3, Message 1'
		))));
		$this->assertEquals($expected, $result);

		$rows = $Thread->find('all', array(
			'group' => 'Thread.project_id',
			'fields' => array('Thread.project_id', 'COUNT(*) AS total')
		));
		$result = array();
		foreach ($rows as $row) {
			$result[$row['Thread']['project_id']] = $row[0]['total'];
		}
		$expected = array(
			1 => 2,
			2 => 1
		);
		$this->assertEquals($expected, $result);

		$rows = $Thread->find('all', array(
			'group' => 'Thread.project_id',
			'fields' => array('Thread.project_id', 'COUNT(*) AS total'),
			'order' => 'Thread.project_id'
		));
		$result = array();
		foreach ($rows as $row) {
			$result[$row['Thread']['project_id']] = $row[0]['total'];
		}
		$expected = array(
			1 => 2,
			2 => 1
		);
		$this->assertEquals($expected, $result);

		$result = $Thread->find('all', array(
			'conditions' => array('Thread.project_id' => 1),
			'group' => 'Thread.project_id'
		));
		$expected = array(
			array(
				'Thread' => array(
					'id' => 1,
					'project_id' => 1,
					'name' => 'Project 1, Thread 1'
				),
				'Project' => array(
					'id' => 1,
					'name' => 'Project 1'
				),
				'Message' => array(
					array(
						'id' => 1,
						'thread_id' => 1,
						'name' => 'Thread 1, Message 1'
		))));
		$this->assertEquals($expected, $result);

		$result = $Thread->find('all', array(
			'conditions' => array('Thread.project_id' => 1),
			'group' => 'Thread.project_id, Project.id'
		));
		$this->assertEquals($expected, $result);

		$result = $Thread->find('all', array(
			'conditions' => array('Thread.project_id' => 1),
			'group' => 'project_id'
		));
		$this->assertEquals($expected, $result);

		$result = $Thread->find('all', array(
			'conditions' => array('Thread.project_id' => 1),
			'group' => array('project_id')
		));
		$this->assertEquals($expected, $result);

		$result = $Thread->find('all', array(
			'conditions' => array('Thread.project_id' => 1),
			'group' => array('project_id', 'Project.id')
		));
		$this->assertEquals($expected, $result);

		$result = $Thread->find('all', array(
			'conditions' => array('Thread.project_id' => 1),
			'group' => array('Thread.project_id', 'Project.id')
		));
		$this->assertEquals($expected, $result);

		$expected = array(
			array('Product' => array('type' => 'Clothing'), array('price' => 32)),
			array('Product' => array('type' => 'Food'), array('price' => 9)),
			array('Product' => array('type' => 'Music'), array('price' => 4)),
			array('Product' => array('type' => 'Toy'), array('price' => 3))
		);
		$result = $Product->find('all',array(
			'fields' => array('Product.type', 'MIN(Product.price) as price'),
			'group' => 'Product.type',
			'order' => 'Product.type ASC'
			));
		$this->assertEquals($expected, $result);

		$result = $Product->find('all', array(
			'fields' => array('Product.type', 'MIN(Product.price) as price'),
			'group' => array('Product.type'),
			'order' => 'Product.type ASC'));
		$this->assertEquals($expected, $result);
	}

/**
 * testOldQuery method
 *
 * @return void
 */
	public function testOldQuery() {
		$this->loadFixtures('Article', 'User', 'Tag', 'ArticlesTag', 'Comment', 'Attachment');
		$Article = new Article();

		$query  = 'SELECT title FROM ';
		$query .= $this->db->fullTableName('articles');
		$query .= ' WHERE ' . $this->db->fullTableName('articles') . '.id IN (1,2)';

		$results = $Article->query($query);
		$this->assertTrue(is_array($results));
		$this->assertEquals(2, count($results));

		$query  = 'SELECT title, body FROM ';
		$query .= $this->db->fullTableName('articles');
		$query .= ' WHERE ' . $this->db->fullTableName('articles') . '.id = 1';

		$results = $Article->query($query, false);
		$this->assertFalse($this->db->getQueryCache($query));
		$this->assertTrue(is_array($results));

		$query  = 'SELECT title, id FROM ';
		$query .= $this->db->fullTableName('articles');
		$query .= ' WHERE ' . $this->db->fullTableName('articles');
		$query .= '.published = ' . $this->db->value('Y');

		$results = $Article->query($query, true);
		$result = $this->db->getQueryCache($query);
		$this->assertFalse(empty($result));
		$this->assertTrue(is_array($results));
	}

/**
 * testPreparedQuery method
 *
 * @return void
 */
	public function testPreparedQuery() {
		$this->loadFixtures('Article', 'User', 'Tag', 'ArticlesTag');
		$Article = new Article();

		$query = 'SELECT title, published FROM ';
		$query .= $this->db->fullTableName('articles');
		$query .= ' WHERE ' . $this->db->fullTableName('articles');
		$query .= '.id = ? AND ' . $this->db->fullTableName('articles') . '.published = ?';

		$params = array(1, 'Y');
		$result = $Article->query($query, $params);
		$expected = array(
			'0' => array(
				$this->db->fullTableName('articles', false, false) => array(
					'title' => 'First Article', 'published' => 'Y')
		));

		if (isset($result[0][0])) {
			$expected[0][0] = $expected[0][$this->db->fullTableName('articles', false, false)];
			unset($expected[0][$this->db->fullTableName('articles', false, false)]);
		}

		$this->assertEquals($expected, $result);
		$result = $this->db->getQueryCache($query, $params);
		$this->assertFalse(empty($result));

		$query  = 'SELECT id, created FROM ';
		$query .= $this->db->fullTableName('articles');
		$query .= '  WHERE ' . $this->db->fullTableName('articles') . '.title = ?';

		$params = array('First Article');
		$result = $Article->query($query, $params, false);
		$this->assertTrue(is_array($result));
		$this->assertTrue(
			isset($result[0][$this->db->fullTableName('articles', false, false)]) ||
			isset($result[0][0])
		);
		$result = $this->db->getQueryCache($query, $params);
		$this->assertTrue(empty($result));

		$query  = 'SELECT title FROM ';
		$query .= $this->db->fullTableName('articles');
		$query .= ' WHERE ' . $this->db->fullTableName('articles') . '.title LIKE ?';

		$params = array('%First%');
		$result = $Article->query($query, $params);
		$this->assertTrue(is_array($result));
		$this->assertTrue(
			isset($result[0][$this->db->fullTableName('articles', false, false)]['title']) ||
			isset($result[0][0]['title'])
		);

		//related to ticket #5035
		$query  = 'SELECT title FROM ';
		$query .= $this->db->fullTableName('articles') . ' WHERE title = ? AND published = ?';
		$params = array('First? Article', 'Y');
		$Article->query($query, $params);

		$result = $this->db->getQueryCache($query, $params);
		$this->assertFalse($result === false);
	}

/**
 * testParameterMismatch method
 *
 * @expectedException PDOException
 * @return void
 */
	public function testParameterMismatch() {
		$this->skipIf($this->db instanceof Sqlite, 'Sqlite does not accept real prepared statements, no way to check this');
		$this->loadFixtures('Article', 'User', 'Tag', 'ArticlesTag');
		$Article = new Article();

		$query  = 'SELECT * FROM ' . $this->db->fullTableName('articles');
		$query .= ' WHERE ' . $this->db->fullTableName('articles');
		$query .= '.published = ? AND ' . $this->db->fullTableName('articles') . '.user_id = ?';
		$params = array('Y');

		$result = $Article->query($query, $params);
	}

/**
 * testVeryStrangeUseCase method
 *
 * @expectedException PDOException
 * @return void
 */
	public function testVeryStrangeUseCase() {
		$this->loadFixtures('Article', 'User', 'Tag', 'ArticlesTag');
		$Article = new Article();

		$query = 'SELECT * FROM ? WHERE ? = ? AND ? = ?';
		$param = array(
			$this->db->fullTableName('articles'),
			$this->db->fullTableName('articles') . '.user_id', '3',
			$this->db->fullTableName('articles') . '.published', 'Y'
		);

		$result = $Article->query($query, $param);
	}

/**
 * testRecursiveUnbind method
 *
 * @return void
 */
	public function testRecursiveUnbind() {
		$this->skipIf($this->db instanceof Sqlserver, 'The test of testRecursiveUnbind test is not compatible with SQL Server, because it check for time columns.');

		$this->loadFixtures('Apple', 'Sample');
		$TestModel = new Apple();
		$TestModel->recursive = 2;

		$result = $TestModel->find('all');
		$expected = array(
			array(
				'Apple' => array(
					'id' => 1,
					'apple_id' => 2,
					'color' => 'Red 1',
					'name' => 'Red Apple 1',
					'created' => '2006-11-22 10:38:58',
					'date' => '1951-01-04',
					'modified' => '2006-12-01 13:31:26',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 2,
					'apple_id' => 1,
					'color' => 'Bright Red 1',
					'name' => 'Bright Red Apple',
					'created' => '2006-11-22 10:43:13',
					'date' => '2014-01-01',
					'modified' => '2006-11-30 18:38:10',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 1,
						'apple_id' => 2,
						'color' => 'Red 1',
						'name' => 'Red Apple 1',
						'created' => '2006-11-22 10:38:58',
						'date' => '1951-01-04',
						'modified' => '2006-12-01 13:31:26',
						'mytime' => '22:57:17'
					),
					'Sample' => array(
						'id' => 2,
						'apple_id' => 2,
						'name' => 'sample2'
					),
					'Child' => array(
						array(
							'id' => 1,
							'apple_id' => 2,
							'color' => 'Red 1',
							'name' => 'Red Apple 1',
							'created' => '2006-11-22 10:38:58',
							'date' => '1951-01-04',
							'modified' => '2006-12-01 13:31:26',
							'mytime' => '22:57:17'
						),
						array(
							'id' => 3,
							'apple_id' => 2,
							'color' => 'blue green',
							'name' => 'green blue',
							'created' => '2006-12-25 05:13:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:24',
							'mytime' => '22:57:17'
						),
						array(
							'id' => 4,
							'apple_id' => 2,
							'color' => 'Blue Green',
							'name' => 'Test Name',
							'created' => '2006-12-25 05:23:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:36',
							'mytime' => '22:57:17'
					))),
					'Sample' => array(
						'id' => '',
						'apple_id' => '',
						'name' => ''
					),
					'Child' => array(
						array(
							'id' => 2,
							'apple_id' => 1,
							'color' => 'Bright Red 1',
							'name' => 'Bright Red Apple',
							'created' => '2006-11-22 10:43:13',
							'date' => '2014-01-01',
							'modified' => '2006-11-30 18:38:10',
							'mytime' => '22:57:17',
							'Parent' => array(
								'id' => 1,
								'apple_id' => 2,
								'color' => 'Red 1',
								'name' => 'Red Apple 1',
								'created' => '2006-11-22 10:38:58',
								'date' => '1951-01-04',
								'modified' => '2006-12-01 13:31:26',
								'mytime' => '22:57:17'
							),
							'Sample' => array(
								'id' => 2,
								'apple_id' => 2,
								'name' => 'sample2'
							),
							'Child' => array(
								array(
									'id' => 1,
									'apple_id' => 2,
									'color' => 'Red 1',
									'name' => 'Red Apple 1',
									'created' => '2006-11-22 10:38:58',
									'date' => '1951-01-04',
									'modified' => '2006-12-01 13:31:26',
									'mytime' => '22:57:17'
								),
								array(
									'id' => 3,
									'apple_id' => 2,
									'color' => 'blue green',
									'name' => 'green blue',
									'created' => '2006-12-25 05:13:36',
									'date' => '2006-12-25',
									'modified' => '2006-12-25 05:23:24',
									'mytime' => '22:57:17'
								),
								array(
									'id' => 4,
									'apple_id' => 2,
									'color' => 'Blue Green',
									'name' => 'Test Name',
									'created' => '2006-12-25 05:23:36',
									'date' => '2006-12-25',
									'modified' => '2006-12-25 05:23:36',
									'mytime' => '22:57:17'
			))))),
			array(
				'Apple' => array(
					'id' => 2,
					'apple_id' => 1,
					'color' => 'Bright Red 1',
					'name' => 'Bright Red Apple',
					'created' => '2006-11-22 10:43:13',
					'date' => '2014-01-01',
					'modified' => '2006-11-30 18:38:10',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
						'id' => 1,
						'apple_id' => 2,
						'color' => 'Red 1',
						'name' => 'Red Apple 1',
						'created' => '2006-11-22 10:38:58',
						'date' => '1951-01-04',
						'modified' => '2006-12-01 13:31:26',
						'mytime' => '22:57:17',
						'Parent' => array(
							'id' => 2,
							'apple_id' => 1,
							'color' => 'Bright Red 1',
							'name' => 'Bright Red Apple',
							'created' => '2006-11-22 10:43:13',
							'date' => '2014-01-01',
							'modified' => '2006-11-30 18:38:10',
							'mytime' => '22:57:17'
						),
						'Sample' => array(),
						'Child' => array(
							array(
								'id' => 2,
								'apple_id' => 1,
								'color' => 'Bright Red 1',
								'name' => 'Bright Red Apple',
								'created' => '2006-11-22 10:43:13',
								'date' => '2014-01-01',
								'modified' => '2006-11-30 18:38:10',
								'mytime' => '22:57:17'
					))),
					'Sample' => array(
						'id' => 2,
						'apple_id' => 2,
						'name' => 'sample2',
						'Apple' => array(
							'id' => 2,
							'apple_id' => 1,
							'color' => 'Bright Red 1',
							'name' => 'Bright Red Apple',
							'created' => '2006-11-22 10:43:13',
							'date' => '2014-01-01',
							'modified' => '2006-11-30 18:38:10',
							'mytime' => '22:57:17'
					)),
					'Child' => array(
						array(
							'id' => 1,
							'apple_id' => 2,
							'color' => 'Red 1',
							'name' => 'Red Apple 1',
							'created' => '2006-11-22 10:38:58',
							'date' => '1951-01-04',
							'modified' => '2006-12-01 13:31:26',
							'mytime' => '22:57:17',
							'Parent' => array(
								'id' => 2,
								'apple_id' => 1,
								'color' => 'Bright Red 1',
								'name' => 'Bright Red Apple',
								'created' => '2006-11-22 10:43:13',
								'date' => '2014-01-01',
								'modified' => '2006-11-30 18:38:10',
								'mytime' => '22:57:17'
							),
							'Sample' => array(),
							'Child' => array(
								array(
									'id' => 2,
									'apple_id' => 1,
									'color' => 'Bright Red 1',
									'name' => 'Bright Red Apple',
									'created' => '2006-11-22 10:43:13',
									'date' => '2014-01-01',
									'modified' => '2006-11-30 18:38:10',
									'mytime' => '22:57:17'
						))),
						array(
							'id' => 3,
							'apple_id' => 2,
							'color' => 'blue green',
							'name' => 'green blue',
							'created' => '2006-12-25 05:13:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:24',
							'mytime' => '22:57:17',
							'Parent' => array(
								'id' => 2,
								'apple_id' => 1,
								'color' => 'Bright Red 1',
								'name' => 'Bright Red Apple',
								'created' => '2006-11-22 10:43:13',
								'date' => '2014-01-01',
								'modified' => '2006-11-30 18:38:10',
								'mytime' => '22:57:17'
							),
							'Sample' => array(
								'id' => 1,
								'apple_id' => 3,
								'name' => 'sample1'
						)),
						array(
							'id' => 4,
							'apple_id' => 2,
							'color' => 'Blue Green',
							'name' => 'Test Name',
							'created' => '2006-12-25 05:23:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:36',
							'mytime' => '22:57:17',
							'Parent' => array(
								'id' => 2,
								'apple_id' => 1,
								'color' => 'Bright Red 1',
								'name' => 'Bright Red Apple',
								'created' => '2006-11-22 10:43:13',
								'date' => '2014-01-01',
								'modified' => '2006-11-30 18:38:10',
								'mytime' => '22:57:17'
							),
							'Sample' => array(
								'id' => 3,
								'apple_id' => 4,
								'name' => 'sample3'
							),
							'Child' => array(
								array(
									'id' => 6,
									'apple_id' => 4,
									'color' => 'My new appleOrange',
									'name' => 'My new apple',
									'created' => '2006-12-25 05:29:39',
									'date' => '2006-12-25',
									'modified' => '2006-12-25 05:29:39',
									'mytime' => '22:57:17'
			))))),
			array(
				'Apple' => array(
					'id' => 3,
					'apple_id' => 2,
					'color' => 'blue green',
					'name' => 'green blue',
					'created' => '2006-12-25 05:13:36',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:23:24',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 2,
					'apple_id' => 1,
					'color' => 'Bright Red 1',
					'name' => 'Bright Red Apple',
					'created' => '2006-11-22 10:43:13',
					'date' => '2014-01-01',
					'modified' => '2006-11-30 18:38:10',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 1,
						'apple_id' => 2,
						'color' => 'Red 1',
						'name' => 'Red Apple 1',
						'created' => '2006-11-22 10:38:58',
						'date' => '1951-01-04',
						'modified' => '2006-12-01 13:31:26',
						'mytime' => '22:57:17'
					),
					'Sample' => array(
						'id' => 2,
						'apple_id' => 2,
						'name' => 'sample2'
					),
					'Child' => array(
						array(
							'id' => 1,
							'apple_id' => 2,
							'color' => 'Red 1',
							'name' => 'Red Apple 1',
							'created' => '2006-11-22 10:38:58',
							'date' => '1951-01-04',
							'modified' => '2006-12-01 13:31:26',
							'mytime' => '22:57:17'
						),
						array(
							'id' => 3,
							'apple_id' => 2,
							'color' => 'blue green',
							'name' => 'green blue',
							'created' => '2006-12-25 05:13:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:24',
							'mytime' => '22:57:17'
						),
						array(
							'id' => 4,
							'apple_id' => 2,
							'color' => 'Blue Green',
							'name' => 'Test Name',
							'created' => '2006-12-25 05:23:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:36',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => 1,
					'apple_id' => 3,
					'name' => 'sample1',
					'Apple' => array(
						'id' => 3,
						'apple_id' => 2,
						'color' => 'blue green',
						'name' => 'green blue',
						'created' => '2006-12-25 05:13:36',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:23:24',
						'mytime' => '22:57:17'
				)),
				'Child' => array()
			),
			array(
				'Apple' => array(
					'id' => 4,
					'apple_id' => 2,
					'color' => 'Blue Green',
					'name' => 'Test Name',
					'created' => '2006-12-25 05:23:36',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:23:36',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 2,
					'apple_id' => 1,
					'color' => 'Bright Red 1',
					'name' => 'Bright Red Apple',
					'created' => '2006-11-22 10:43:13',
					'date' => '2014-01-01',
					'modified' => '2006-11-30 18:38:10',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 1,
						'apple_id' => 2,
						'color' => 'Red 1',
						'name' => 'Red Apple 1',
						'created' => '2006-11-22 10:38:58',
						'date' => '1951-01-04',
						'modified' => '2006-12-01 13:31:26', 'mytime' => '22:57:17'),
						'Sample' => array('id' => 2, 'apple_id' => 2, 'name' => 'sample2'),
						'Child' => array(
							array(
								'id' => 1,
								'apple_id' => 2,
								'color' => 'Red 1',
								'name' => 'Red Apple 1',
								'created' => '2006-11-22 10:38:58',
								'date' => '1951-01-04',
								'modified' => '2006-12-01 13:31:26',
								'mytime' => '22:57:17'
							),
							array(
								'id' => 3,
								'apple_id' => 2,
								'color' => 'blue green',
								'name' => 'green blue',
								'created' => '2006-12-25 05:13:36',
								'date' => '2006-12-25',
								'modified' => '2006-12-25 05:23:24',
								'mytime' => '22:57:17'
							),
							array(
								'id' => 4,
								'apple_id' => 2,
								'color' => 'Blue Green',
								'name' => 'Test Name',
								'created' => '2006-12-25 05:23:36',
								'date' => '2006-12-25',
								'modified' => '2006-12-25 05:23:36',
								'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => 3,
					'apple_id' => 4,
					'name' => 'sample3',
					'Apple' => array(
						'id' => 4,
						'apple_id' => 2,
						'color' => 'Blue Green',
						'name' => 'Test Name',
						'created' => '2006-12-25 05:23:36',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:23:36',
						'mytime' => '22:57:17'
				)),
				'Child' => array(
					array(
						'id' => 6,
						'apple_id' => 4,
						'color' => 'My new appleOrange',
						'name' => 'My new apple',
						'created' => '2006-12-25 05:29:39',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:29:39',
						'mytime' => '22:57:17',
						'Parent' => array(
							'id' => 4,
							'apple_id' => 2,
							'color' => 'Blue Green',
							'name' => 'Test Name',
							'created' => '2006-12-25 05:23:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:36',
							'mytime' => '22:57:17'
						),
						'Sample' => array(),
						'Child' => array(
							array(
								'id' => 7,
								'apple_id' => 6,
								'color' => 'Some wierd color',
								'name' => 'Some odd color',
								'created' => '2006-12-25 05:34:21',
								'date' => '2006-12-25',
								'modified' => '2006-12-25 05:34:21',
								'mytime' => '22:57:17'
			))))),
			array(
				'Apple' => array(
					'id' => 5,
					'apple_id' => 5,
					'color' => 'Green',
					'name' => 'Blue Green',
					'created' => '2006-12-25 05:24:06',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:29:16',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 5,
					'apple_id' => 5,
					'color' => 'Green',
					'name' => 'Blue Green',
					'created' => '2006-12-25 05:24:06',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:29:16',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 5,
						'apple_id' => 5,
						'color' => 'Green',
						'name' => 'Blue Green',
						'created' => '2006-12-25 05:24:06',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:29:16',
						'mytime' => '22:57:17'
					),
					'Sample' => array(
						'id' => 4,
						'apple_id' => 5,
						'name' => 'sample4'
					),
					'Child' => array(
						array(
							'id' => 5,
							'apple_id' => 5,
							'color' => 'Green',
							'name' => 'Blue Green',
							'created' => '2006-12-25 05:24:06',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:29:16',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => 4,
					'apple_id' => 5,
					'name' => 'sample4',
					'Apple' => array(
						'id' => 5,
						'apple_id' => 5,
						'color' => 'Green',
						'name' => 'Blue Green',
						'created' => '2006-12-25 05:24:06',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:29:16',
						'mytime' => '22:57:17'
					)),
					'Child' => array(
						array(
							'id' => 5,
							'apple_id' => 5,
							'color' => 'Green',
							'name' => 'Blue Green',
							'created' => '2006-12-25 05:24:06',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:29:16',
							'mytime' => '22:57:17',
							'Parent' => array(
								'id' => 5,
								'apple_id' => 5,
								'color' => 'Green',
								'name' => 'Blue Green',
								'created' => '2006-12-25 05:24:06',
								'date' => '2006-12-25',
								'modified' => '2006-12-25 05:29:16',
								'mytime' => '22:57:17'
							),
							'Sample' => array(
								'id' => 4,
								'apple_id' => 5,
								'name' => 'sample4'
							),
							'Child' => array(
								array(
									'id' => 5,
									'apple_id' => 5,
									'color' => 'Green',
									'name' => 'Blue Green',
									'created' => '2006-12-25 05:24:06',
									'date' => '2006-12-25',
									'modified' => '2006-12-25 05:29:16',
									'mytime' => '22:57:17'
			))))),
			array(
				'Apple' => array(
					'id' => 6,
					'apple_id' => 4,
					'color' => 'My new appleOrange',
					'name' => 'My new apple',
					'created' => '2006-12-25 05:29:39',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:29:39',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 4,
					'apple_id' => 2,
					'color' => 'Blue Green',
					'name' => 'Test Name',
					'created' => '2006-12-25 05:23:36',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:23:36',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 2,
						'apple_id' => 1,
						'color' => 'Bright Red 1',
						'name' => 'Bright Red Apple',
						'created' => '2006-11-22 10:43:13',
						'date' => '2014-01-01',
						'modified' => '2006-11-30 18:38:10',
						'mytime' => '22:57:17'
					),
					'Sample' => array(
						'id' => 3,
						'apple_id' => 4,
						'name' => 'sample3'
					),
					'Child' => array(
						array(
							'id' => 6,
							'apple_id' => 4,
							'color' => 'My new appleOrange',
							'name' => 'My new apple',
							'created' => '2006-12-25 05:29:39',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:29:39',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => '',
					'apple_id' => '',
					'name' => ''
				),
				'Child' => array(
					array(
						'id' => 7,
						'apple_id' => 6,
						'color' => 'Some wierd color',
						'name' => 'Some odd color',
						'created' => '2006-12-25 05:34:21',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:34:21',
						'mytime' => '22:57:17',
						'Parent' => array(
							'id' => 6,
							'apple_id' => 4,
							'color' => 'My new appleOrange',
							'name' => 'My new apple',
							'created' => '2006-12-25 05:29:39',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:29:39',
							'mytime' => '22:57:17'
						),
						'Sample' => array()
			))),
			array(
				'Apple' => array(
					'id' => 7,
					'apple_id' => 6,
					'color' =>
					'Some wierd color',
					'name' => 'Some odd color',
					'created' => '2006-12-25 05:34:21',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:34:21',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 6,
					'apple_id' => 4,
					'color' => 'My new appleOrange',
					'name' => 'My new apple',
					'created' => '2006-12-25 05:29:39',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:29:39',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 4,
						'apple_id' => 2,
						'color' => 'Blue Green',
						'name' => 'Test Name',
						'created' => '2006-12-25 05:23:36',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:23:36',
						'mytime' => '22:57:17'
					),
					'Sample' => array(),
					'Child' => array(
						array(
							'id' => 7,
							'apple_id' => 6,
							'color' => 'Some wierd color',
							'name' => 'Some odd color',
							'created' => '2006-12-25 05:34:21',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:34:21',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => '',
					'apple_id' => '',
					'name' => ''
				),
				'Child' => array()));
		$this->assertEquals($expected, $result);

		$result = $TestModel->Parent->unbindModel(array('hasOne' => array('Sample')));
		$this->assertTrue($result);

		$result = $TestModel->find('all');
		$expected = array(
			array(
				'Apple' => array(
					'id' => 1,
					'apple_id' => 2,
					'color' => 'Red 1',
					'name' => 'Red Apple 1',
					'created' => '2006-11-22 10:38:58',
					'date' => '1951-01-04',
					'modified' => '2006-12-01 13:31:26',
					'mytime' => '22:57:17'),
					'Parent' => array(
						'id' => 2,
						'apple_id' => 1,
						'color' => 'Bright Red 1',
						'name' => 'Bright Red Apple',
						'created' => '2006-11-22 10:43:13',
						'date' => '2014-01-01',
						'modified' => '2006-11-30 18:38:10',
						'mytime' => '22:57:17',
						'Parent' => array(
							'id' => 1,
							'apple_id' => 2,
							'color' => 'Red 1',
							'name' => 'Red Apple 1',
							'created' => '2006-11-22 10:38:58',
							'date' => '1951-01-04',
							'modified' => '2006-12-01 13:31:26',
							'mytime' => '22:57:17'
						),
						'Child' => array(
							array(
								'id' => 1,
								'apple_id' => 2,
								'color' => 'Red 1',
								'name' => 'Red Apple 1',
								'created' => '2006-11-22 10:38:58',
								'date' => '1951-01-04',
								'modified' => '2006-12-01 13:31:26',
								'mytime' => '22:57:17'
							),
							array(
								'id' => 3,
								'apple_id' => 2,
								'color' => 'blue green',
								'name' => 'green blue',
								'created' => '2006-12-25 05:13:36',
								'date' => '2006-12-25',
								'modified' => '2006-12-25 05:23:24',
								'mytime' => '22:57:17'
							),
							array(
								'id' => 4,
								'apple_id' => 2,
								'color' => 'Blue Green',
								'name' => 'Test Name',
								'created' => '2006-12-25 05:23:36',
								'date' => '2006-12-25',
								'modified' => '2006-12-25 05:23:36',
								'mytime' => '22:57:17'
					))),
					'Sample' => array(
						'id' => '',
						'apple_id' => '',
						'name' => ''
					),
					'Child' => array(
						array(
							'id' => 2,
							'apple_id' => 1,
							'color' => 'Bright Red 1',
							'name' => 'Bright Red Apple',
							'created' => '2006-11-22 10:43:13',
							'date' => '2014-01-01',
							'modified' => '2006-11-30 18:38:10',
							'mytime' => '22:57:17',
							'Parent' => array(
								'id' => 1,
								'apple_id' => 2,
								'color' => 'Red 1',
								'name' => 'Red Apple 1',
								'created' => '2006-11-22 10:38:58',
								'date' => '1951-01-04',
								'modified' => '2006-12-01 13:31:26',
								'mytime' => '22:57:17'
							),
							'Sample' => array(
								'id' => 2,
								'apple_id' => 2,
								'name' => 'sample2'
							),
							'Child' => array(
								array(
									'id' => 1,
									'apple_id' => 2,
									'color' => 'Red 1',
									'name' => 'Red Apple 1',
									'created' => '2006-11-22 10:38:58',
									'date' => '1951-01-04',
									'modified' => '2006-12-01 13:31:26',
									'mytime' => '22:57:17'
								),
								array(
									'id' => 3,
									'apple_id' => 2,
									'color' => 'blue green',
									'name' => 'green blue',
									'created' => '2006-12-25 05:13:36',
									'date' => '2006-12-25',
									'modified' => '2006-12-25 05:23:24',
									'mytime' => '22:57:17'
								),
								array(
									'id' => 4,
									'apple_id' => 2,
									'color' => 'Blue Green',
									'name' => 'Test Name',
									'created' => '2006-12-25 05:23:36',
									'date' => '2006-12-25',
									'modified' => '2006-12-25 05:23:36',
									'mytime' => '22:57:17'
			))))),
			array(
				'Apple' => array(
					'id' => 2,
					'apple_id' => 1,
					'color' => 'Bright Red 1',
					'name' => 'Bright Red Apple',
					'created' => '2006-11-22 10:43:13',
					'date' => '2014-01-01',
					'modified' => '2006-11-30 18:38:10',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 1,
					'apple_id' => 2,
					'color' => 'Red 1',
					'name' => 'Red Apple 1',
					'created' => '2006-11-22 10:38:58',
					'date' => '1951-01-04',
					'modified' => '2006-12-01 13:31:26',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 2,
						'apple_id' => 1,
						'color' => 'Bright Red 1',
						'name' => 'Bright Red Apple',
						'created' => '2006-11-22 10:43:13',
						'date' => '2014-01-01',
						'modified' => '2006-11-30 18:38:10',
						'mytime' => '22:57:17'
					),
					'Child' => array(
						array(
							'id' => 2,
							'apple_id' => 1,
							'color' => 'Bright Red 1',
							'name' => 'Bright Red Apple',
							'created' => '2006-11-22 10:43:13',
							'date' => '2014-01-01',
							'modified' => '2006-11-30 18:38:10',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => 2,
					'apple_id' => 2,
					'name' => 'sample2',
					'Apple' => array(
						'id' => 2,
						'apple_id' => 1,
						'color' => 'Bright Red 1',
						'name' => 'Bright Red Apple',
						'created' => '2006-11-22 10:43:13',
						'date' => '2014-01-01',
						'modified' => '2006-11-30 18:38:10',
						'mytime' => '22:57:17'
				)),
				'Child' => array(
					array(
						'id' => 1,
						'apple_id' => 2,
						'color' => 'Red 1',
						'name' => 'Red Apple 1',
						'created' => '2006-11-22 10:38:58',
						'date' => '1951-01-04',
						'modified' => '2006-12-01 13:31:26',
						'mytime' => '22:57:17',
						'Parent' => array(
							'id' => 2,
							'apple_id' => 1,
							'color' => 'Bright Red 1',
							'name' => 'Bright Red Apple',
							'created' => '2006-11-22 10:43:13',
							'date' => '2014-01-01',
							'modified' => '2006-11-30 18:38:10',
							'mytime' => '22:57:17'
						),
						'Sample' => array(),
						'Child' => array(
							array(
								'id' => 2,
								'apple_id' => 1,
								'color' => 'Bright Red 1',
								'name' => 'Bright Red Apple',
								'created' => '2006-11-22 10:43:13',
								'date' => '2014-01-01', 'modified' =>
								'2006-11-30 18:38:10',
								'mytime' => '22:57:17'
					))),
					array(
						'id' => 3,
						'apple_id' => 2,
						'color' => 'blue green',
						'name' => 'green blue',
						'created' => '2006-12-25 05:13:36',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:23:24',
						'mytime' => '22:57:17',
						'Parent' => array(
							'id' => 2,
							'apple_id' => 1,
							'color' => 'Bright Red 1',
							'name' => 'Bright Red Apple',
							'created' => '2006-11-22 10:43:13',
							'date' => '2014-01-01',
							'modified' => '2006-11-30 18:38:10',
							'mytime' => '22:57:17'
						),
						'Sample' => array(
							'id' => 1,
							'apple_id' => 3,
							'name' => 'sample1'
					)),
					array(
						'id' => 4,
						'apple_id' => 2,
						'color' => 'Blue Green',
						'name' => 'Test Name',
						'created' => '2006-12-25 05:23:36',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:23:36',
						'mytime' => '22:57:17',
						'Parent' => array(
							'id' => 2,
							'apple_id' => 1,
							'color' => 'Bright Red 1',
							'name' => 'Bright Red Apple',
							'created' => '2006-11-22 10:43:13',
							'date' => '2014-01-01',
							'modified' => '2006-11-30 18:38:10',
							'mytime' => '22:57:17'
						),
						'Sample' => array(
							'id' => 3,
							'apple_id' => 4,
							'name' => 'sample3'
						),
						'Child' => array(
							array(
								'id' => 6,
								'apple_id' => 4,
								'color' => 'My new appleOrange',
								'name' => 'My new apple',
								'created' => '2006-12-25 05:29:39',
								'date' => '2006-12-25',
								'modified' => '2006-12-25 05:29:39',
								'mytime' => '22:57:17'
			))))),
			array(
				'Apple' => array(
					'id' => 3,
					'apple_id' => 2,
					'color' => 'blue green',
					'name' => 'green blue',
					'created' => '2006-12-25 05:13:36',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:23:24',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 2,
					'apple_id' => 1,
					'color' => 'Bright Red 1',
					'name' => 'Bright Red Apple',
					'created' => '2006-11-22 10:43:13',
					'date' => '2014-01-01',
					'modified' => '2006-11-30 18:38:10',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 1,
						'apple_id' => 2,
						'color' => 'Red 1',
						'name' => 'Red Apple 1',
						'created' => '2006-11-22 10:38:58',
						'date' => '1951-01-04',
						'modified' => '2006-12-01 13:31:26',
						'mytime' => '22:57:17'
					),
					'Child' => array(
						array(
							'id' => 1,
							'apple_id' => 2,
							'color' => 'Red 1',
							'name' => 'Red Apple 1',
							'created' => '2006-11-22 10:38:58',
							'date' => '1951-01-04',
							'modified' => '2006-12-01 13:31:26',
							'mytime' => '22:57:17'
						),
						array(
							'id' => 3,
							'apple_id' => 2,
							'color' => 'blue green',
							'name' => 'green blue',
							'created' => '2006-12-25 05:13:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:24',
							'mytime' => '22:57:17'
						),
						array(
							'id' => 4,
							'apple_id' => 2,
							'color' => 'Blue Green',
							'name' => 'Test Name',
							'created' => '2006-12-25 05:23:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:36',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => 1,
					'apple_id' => 3,
					'name' => 'sample1',
					'Apple' => array(
						'id' => 3,
						'apple_id' => 2,
						'color' => 'blue green',
						'name' => 'green blue',
						'created' => '2006-12-25 05:13:36',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:23:24',
						'mytime' => '22:57:17'
				)),
				'Child' => array()
			),
			array(
				'Apple' => array(
					'id' => 4,
					'apple_id' => 2,
					'color' => 'Blue Green',
					'name' => 'Test Name',
					'created' => '2006-12-25 05:23:36',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:23:36',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 2,
					'apple_id' => 1,
					'color' => 'Bright Red 1',
					'name' => 'Bright Red Apple',
					'created' => '2006-11-22 10:43:13',
					'date' => '2014-01-01',
					'modified' => '2006-11-30 18:38:10',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 1,
						'apple_id' => 2,
						'color' => 'Red 1',
						'name' => 'Red Apple 1',
						'created' => '2006-11-22 10:38:58',
						'date' => '1951-01-04',
						'modified' => '2006-12-01 13:31:26',
						'mytime' => '22:57:17'
					),
					'Child' => array(
						array(
							'id' => 1,
							'apple_id' => 2,
							'color' => 'Red 1',
							'name' => 'Red Apple 1',
							'created' => '2006-11-22 10:38:58',
							'date' => '1951-01-04',
							'modified' => '2006-12-01 13:31:26',
							'mytime' => '22:57:17'
						),
						array(
							'id' => 3,
							'apple_id' => 2,
							'color' => 'blue green',
							'name' => 'green blue',
							'created' => '2006-12-25 05:13:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:24',
							'mytime' => '22:57:17'
						),
						array(
							'id' => 4,
							'apple_id' => 2,
							'color' => 'Blue Green',
							'name' => 'Test Name',
							'created' => '2006-12-25 05:23:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:36',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => 3,
					'apple_id' => 4,
					'name' => 'sample3',
					'Apple' => array(
						'id' => 4,
						'apple_id' => 2,
						'color' => 'Blue Green',
						'name' => 'Test Name',
						'created' => '2006-12-25 05:23:36',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:23:36',
						'mytime' => '22:57:17'
				)),
				'Child' => array(
					array(
						'id' => 6,
						'apple_id' => 4,
						'color' => 'My new appleOrange',
						'name' => 'My new apple',
						'created' => '2006-12-25 05:29:39',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:29:39',
						'mytime' => '22:57:17',
						'Parent' => array(
							'id' => 4,
							'apple_id' => 2,
							'color' => 'Blue Green',
							'name' => 'Test Name',
							'created' => '2006-12-25 05:23:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:36',
							'mytime' => '22:57:17'
						),
						'Sample' => array(),
							'Child' => array(
								array(
									'id' => 7,
									'apple_id' => 6,
									'color' => 'Some wierd color',
									'name' => 'Some odd color',
									'created' => '2006-12-25 05:34:21',
									'date' => '2006-12-25',
									'modified' => '2006-12-25 05:34:21',
									'mytime' => '22:57:17'
			))))),
			array(
				'Apple' => array(
					'id' => 5,
					'apple_id' => 5,
					'color' => 'Green',
					'name' => 'Blue Green',
					'created' => '2006-12-25 05:24:06',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:29:16',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 5,
					'apple_id' => 5,
					'color' => 'Green',
					'name' => 'Blue Green',
					'created' => '2006-12-25 05:24:06',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:29:16',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 5,
						'apple_id' => 5,
						'color' => 'Green',
						'name' => 'Blue Green',
						'created' => '2006-12-25 05:24:06',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:29:16',
						'mytime' => '22:57:17'
					),
					'Child' => array(
						array(
							'id' => 5,
							'apple_id' => 5,
							'color' => 'Green',
							'name' => 'Blue Green',
							'created' => '2006-12-25 05:24:06',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:29:16',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => 4,
					'apple_id' => 5,
					'name' => 'sample4',
					'Apple' => array(
						'id' => 5,
						'apple_id' => 5,
						'color' => 'Green',
						'name' => 'Blue Green',
						'created' => '2006-12-25 05:24:06',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:29:16',
						'mytime' => '22:57:17'
				)),
				'Child' => array(
					array(
						'id' => 5,
						'apple_id' => 5,
						'color' => 'Green',
						'name' => 'Blue Green',
						'created' => '2006-12-25 05:24:06',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:29:16',
						'mytime' => '22:57:17',
						'Parent' => array(
							'id' => 5,
							'apple_id' => 5,
							'color' => 'Green',
							'name' => 'Blue Green',
							'created' => '2006-12-25 05:24:06',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:29:16',
							'mytime' => '22:57:17'
						),
						'Sample' => array(
							'id' => 4,
							'apple_id' => 5,
							'name' => 'sample4'
						),
						'Child' => array(
							array(
								'id' => 5,
								'apple_id' => 5,
								'color' => 'Green',
								'name' => 'Blue Green',
								'created' => '2006-12-25 05:24:06',
								'date' => '2006-12-25',
								'modified' => '2006-12-25 05:29:16',
								'mytime' => '22:57:17'
			))))),
			array(
				'Apple' => array(
					'id' => 6,
					'apple_id' => 4,
					'color' => 'My new appleOrange',
					'name' => 'My new apple',
					'created' => '2006-12-25 05:29:39',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:29:39',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 4,
					'apple_id' => 2,
					'color' => 'Blue Green',
					'name' => 'Test Name',
					'created' => '2006-12-25 05:23:36',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:23:36',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 2,
						'apple_id' => 1,
						'color' => 'Bright Red 1',
						'name' => 'Bright Red Apple',
						'created' => '2006-11-22 10:43:13',
						'date' => '2014-01-01',
						'modified' => '2006-11-30 18:38:10',
						'mytime' => '22:57:17'
					),
					'Child' => array(
						array(
							'id' => 6,
							'apple_id' => 4,
							'color' => 'My new appleOrange',
							'name' => 'My new apple',
							'created' => '2006-12-25 05:29:39',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:29:39',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => '',
					'apple_id' => '',
					'name' => ''
				),
				'Child' => array(
					array(
						'id' => 7,
						'apple_id' => 6,
						'color' => 'Some wierd color',
						'name' => 'Some odd color',
						'created' => '2006-12-25 05:34:21',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:34:21',
						'mytime' => '22:57:17',
						'Parent' => array(
							'id' => 6,
							'apple_id' => 4,
							'color' => 'My new appleOrange',
							'name' => 'My new apple',
							'created' => '2006-12-25 05:29:39',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:29:39',
							'mytime' => '22:57:17'
						),
						'Sample' => array()
			))),
			array(
				'Apple' => array(
					'id' => 7,
					'apple_id' => 6,
					'color' => 'Some wierd color',
					'name' => 'Some odd color',
					'created' => '2006-12-25 05:34:21',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:34:21',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 6,
					'apple_id' => 4,
					'color' => 'My new appleOrange',
					'name' => 'My new apple',
					'created' => '2006-12-25 05:29:39',
					'date' => '2006-12-25',
					'modified' => '2006-12-25 05:29:39',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 4,
						'apple_id' => 2,
						'color' => 'Blue Green',
						'name' => 'Test Name',
						'created' => '2006-12-25 05:23:36',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:23:36',
						'mytime' => '22:57:17'
					),
					'Child' => array(
						array(
							'id' => 7,
							'apple_id' => 6,
							'color' => 'Some wierd color',
							'name' => 'Some odd color',
							'created' => '2006-12-25 05:34:21',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:34:21',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => '',
					'apple_id' => '',
					'name' => ''
				),
				'Child' => array()
		));

		$this->assertEquals($expected, $result);

		$result = $TestModel->Parent->unbindModel(array('hasOne' => array('Sample')));
		$this->assertTrue($result);

		$result = $TestModel->unbindModel(array('hasMany' => array('Child')));
		$this->assertTrue($result);

		$result = $TestModel->find('all');
		$expected = array(
			array(
				'Apple' => array(
					'id' => 1,
					'apple_id' => 2,
					'color' => 'Red 1',
					'name' => 'Red Apple 1',
					'created' => '2006-11-22 10:38:58',
					'date' => '1951-01-04',
					'modified' => '2006-12-01 13:31:26',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 2,
					'apple_id' => 1,
					'color' => 'Bright Red 1',
					'name' => 'Bright Red Apple',
					'created' => '2006-11-22 10:43:13',
					'date' => '2014-01-01',
					'modified' => '2006-11-30 18:38:10',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 1,
						'apple_id' => 2,
						'color' => 'Red 1',
						'name' => 'Red Apple 1',
						'created' => '2006-11-22 10:38:58',
						'date' => '1951-01-04',
						'modified' => '2006-12-01 13:31:26',
						'mytime' => '22:57:17'
					),
					'Child' => array(
						array(
							'id' => 1,
							'apple_id' => 2,
							'color' => 'Red 1',
							'name' => 'Red Apple 1',
							'created' => '2006-11-22 10:38:58',
							'date' => '1951-01-04',
							'modified' => '2006-12-01 13:31:26',
							'mytime' => '22:57:17'
						),
						array(
							'id' => 3,
							'apple_id' => 2,
							'color' => 'blue green',
							'name' => 'green blue',
							'created' => '2006-12-25 05:13:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:24',
							'mytime' => '22:57:17'
						),
						array(
							'id' => 4,
							'apple_id' => 2,
							'color' => 'Blue Green',
							'name' => 'Test Name',
							'created' => '2006-12-25 05:23:36',
							'date' => '2006-12-25',
							'modified' => '2006-12-25 05:23:36',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => '',
					'apple_id' => '',
					'name' => ''
			)),
			array(
				'Apple' => array(
					'id' => 2,
					'apple_id' => 1,
					'color' => 'Bright Red 1',
					'name' => 'Bright Red Apple',
					'created' => '2006-11-22 10:43:13',
					'date' => '2014-01-01',
					'modified' => '2006-11-30 18:38:10',
					'mytime' => '22:57:17'
				),
				'Parent' => array(
					'id' => 1,
					'apple_id' => 2,
					'color' => 'Red 1',
					'name' => 'Red Apple 1',
					'created' => '2006-11-22 10:38:58',
					'date' => '1951-01-04',
					'modified' => '2006-12-01 13:31:26',
					'mytime' => '22:57:17',
					'Parent' => array(
						'id' => 2,
						'apple_id' => 1,
						'color' => 'Bright Red 1',
						'name' => 'Bright Red Apple',
						'created' => '2006-11-22 10:43:13',
						'date' => '2014-01-01',
						'modified' => '2006-11-30 18:38:10',
						'mytime' => '22:57:17'
					),
					'Child' => array(
						array(
							'id' => 2,
							'apple_id' => 1,
							'color' => 'Bright Red 1',
							'name' => 'Bright Red Apple',
							'created' => '2006-11-22 10:43:13',
							'date' => '2014-01-01',
							'modified' => '2006-11-30 18:38:10',
							'mytime' => '22:57:17'
				))),
				'Sample' => array(
					'id' => 2,
					'apple_id' => 2,
					'name' => 'sample2',
					'Apple' => array(
						'id' => 2,
						'apple_id' => 1,
						'color' => 'Bright Red 1',
						'name' => 'Bright Red Apple',
						'created' => '2006-11-22 10:43:13',
						'date' => '2014-01-01',
						'modified' => '2006-11-30 18:38:10',
						'mytime' => '22:57:17'
			))),
			array(
				'Apple' => array(
				'id' => 3,
				'apple_id' => 2,
				'color' => 'blue green',
				'name' => 'green blue',
				'created' => '2006-12-25 05:13:36',
				'date' => '2006-12-25',
				'modified' => '2006-12-25 05:23:24',
				'mytime' => '22:57:17'
			),
			'Parent' => array(
				'id' => 2,
				'apple_id' => 1,
				'color' => 'Bright Red 1',
				'name' => 'Bright Red Apple',
				'created' => '2006-11-22 10:43:13',
				'date' => '2014-01-01',
				'modified' => '2006-11-30 18:38:10',
				'mytime' => '22:57:17',
				'Parent' => array(
					'id' => 1,
					'apple_id' => 2,
					'color' => 'Red 1',
					'name' => 'Red Apple 1',
					'created' => '2006-11-22 10:38:58',
					'date' => '1951-01-04',
					'modified' => '2006-12-01 13:31:26',
					'mytime' => '22:57:17'
				),
				'Child' => array(
					array(
						'id' => 1,
						'apple_id' => 2,
						'color' => 'Red 1',
						'name' => 'Red Apple 1',
						'created' => '2006-11-22 10:38:58',
						'date' => '1951-01-04',
						'modified' => '2006-12-01 13:31:26',
						'mytime' => '22:57:17'
					),
					array(
						'id' => 3,
						'apple_id' => 2,
						'color' => 'blue green',
						'name' => 'green blue',
						'created' => '2006-12-25 05:13:36',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:23:24',
						'mytime' => '22:57:17'
					),
					array(
						'id' => 4,
						'apple_id' => 2,
						'color' => 'Blue Green',
						'name' => 'Test Name',
						'created' => '2006-12-25 05:23:36',
						'date' => '2006-12-25',
						'modified' => '2006-12-25 05:23:36',
						'mytime' => '22:57:17'
			))),
			'Sample' => array(
				'id' => 1,
				'apple_id' =