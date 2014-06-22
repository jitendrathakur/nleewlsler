<?php
App::uses('AppController', 'Controller');
/**
 * Maildomains Controller
 *
 * @property Maildomain $Maildomain
 * @property sComponent $s
 */
class MaildomainsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	/* public $components = array('S'); */

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/* $this->Maildomain->recursive = 0; */
		$this->paginate = array(
					'Maildomain' => array(
							'limit' => Configure::read('Paginationlimit') ? Configure::read('Paginationlimit') : 20,
							'order' => array(
									'Maildomain.created' => 'DESC',
							),
							'recursion' =>'0'
					),
				);
		$this->set('maildomains', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Maildomain->id = $id;
		if (!$this->Maildomain->exists()) {
			throw new NotFoundException(__('Invalid maildomain'));
		}
		$this->set('maildomain', $this->Maildomain->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Maildomain->create();
			if ($this->Maildomain->save($this->request->data)) {
				$this->Session->setFlash(__('The maildomain has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The maildomain could not be saved. Please, try again.'));
			}
		}
		$users = $this->Maildomain->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Maildomain->id = $id;
		if (!$this->Maildomain->exists()) {
			throw new NotFoundException(__('Invalid maildomain'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Maildomain->save($this->request->data)) {
				$this->Session->setFlash(__('The maildomain has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The maildomain could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Maildomain->read(null, $id);
		}
		$users = $this->Maildomain->User->find('list');
		$this->set(compact('users'));
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
		$this->Maildomain->id = $id;
		if (!$this->Maildomain->exists()) {
			throw new NotFoundException(__('Invalid maildomain'));
		}
		if ($this->Maildomain->delete()) {
			$this->Session->setFlash(__('Maildomain deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Maildomain was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
