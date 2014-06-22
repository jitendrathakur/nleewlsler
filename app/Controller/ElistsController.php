<?php
App::uses('AppController', 'Controller');
/**
 * Elists Controller
 *
 * @property Elist $Elist
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ElistsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Elist->recursive = 0;
		$this->set('elists', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Elist->exists($id)) {
			throw new NotFoundException(__('Invalid elist'));
		}
		$options = array('conditions' => array('Elist.' . $this->Elist->primaryKey => $id));
		$this->set('elist', $this->Elist->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Elist->create();
			if ($this->Elist->save($this->request->data)) {
				$this->Session->setFlash(__('The elist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The elist could not be saved. Please, try again.'));
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
		if (!$this->Elist->exists($id)) {
			throw new NotFoundException(__('Invalid elist'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Elist->save($this->request->data)) {
				$this->Session->setFlash(__('The elist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The elist could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Elist.' . $this->Elist->primaryKey => $id));
			$this->request->data = $this->Elist->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Elist->id = $id;
		if (!$this->Elist->exists()) {
			throw new NotFoundException(__('Invalid elist'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Elist->delete()) {
			$this->Session->setFlash(__('The elist has been deleted.'));
		} else {
			$this->Session->setFlash(__('The elist could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Elist->recursive = 0;
		$this->set('elists', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Elist->exists($id)) {
			throw new NotFoundException(__('Invalid elist'));
		}
		$options = array('conditions' => array('Elist.' . $this->Elist->primaryKey => $id));
		$this->set('elist', $this->Elist->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Elist->create();
			if ($this->Elist->save($this->request->data)) {
				$this->Session->setFlash(__('The elist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The elist could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Elist->exists($id)) {
			throw new NotFoundException(__('Invalid elist'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Elist->save($this->request->data)) {
				$this->Session->setFlash(__('The elist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The elist could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Elist.' . $this->Elist->primaryKey => $id));
			$this->request->data = $this->Elist->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Elist->id = $id;
		if (!$this->Elist->exists()) {
			throw new NotFoundException(__('Invalid elist'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Elist->delete()) {
			$this->Session->setFlash(__('The elist has been deleted.'));
		} else {
			$this->Session->setFlash(__('The elist could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
