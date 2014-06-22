<?php
App::uses('AppController', 'Controller');
/**
 * Inquries Controller
 *
 * @property Inqury $Inqury
 */
class InquriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/* $this->Inqury->recursive = 0; */
		$this->paginate = array(
					'Inqury' => array(
							'limit' => Configure::read('Paginationlimit') ? Configure::read('Paginationlimit') : 20,
							'order' => array(
									'Inqury.created' => 'DESC',
							),
							'recursion' =>'0'
					),
				);
		$this->set('inquries', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Inqury->id = $id;
		if (!$this->Inqury->exists()) {
			throw new NotFoundException(__('Invalid inqury'));
		}
		$this->set('inqury', $this->Inqury->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->request->data['Inqury']['ip_address'] = $this->request->clientIp();
			$this->Inqury->create();
			if ($this->Inqury->save($this->request->data)) {
				$this->Session->setFlash(__('The inqury has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inqury could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Inqury->id = $id;
		if (!$this->Inqury->exists()) {
			throw new NotFoundException(__('Invalid inqury'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Inqury->save($this->request->data)) {
				$this->Session->setFlash(__('The inqury has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inqury could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Inqury->read(null, $id);
		}
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
		$this->Inqury->id = $id;
		if (!$this->Inqury->exists()) {
			throw new NotFoundException(__('Invalid inqury'));
		}
		if ($this->Inqury->delete()) {
			$this->Session->setFlash(__('Inqury deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Inqury was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
