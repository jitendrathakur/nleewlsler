<?php
App::uses('AppController', 'Controller');
/**
 * Templates Controller
 *
 * @property Template $Template
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TemplatesController extends AppController {

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
		$this->Template->recursive = 0;
		$this->set('templates', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		$options = array('conditions' => array('Template.' . $this->Template->primaryKey => $id));
		$this->set('template', $this->Template->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Template->create();
			if ($this->Template->save($this->request->data)) {
				$this->Session->setFlash(__('The template has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again.'));
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
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Template->save($this->request->data)) {
				$this->Session->setFlash(__('The template has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Template.' . $this->Template->primaryKey => $id));
			$this->request->data = $this->Template->find('first', $options);
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
		$this->Template->id = $id;
		if (!$this->Template->exists()) {
			throw new NotFoundException(__('Invalid template'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Template->delete()) {
			$this->Session->setFlash(__('The template has been deleted.'));
		} else {
			$this->Session->setFlash(__('The template could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Template->recursive = 0;
		$this->set('templates', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		$options = array('conditions' => array('Template.' . $this->Template->primaryKey => $id));
		$this->set('template', $this->Template->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Template->create();
			if ($this->Template->save($this->request->data)) {
				$this->Session->setFlash(__('The template has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again.'));
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
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Template->save($this->request->data)) {
				$this->Session->setFlash(__('The template has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Template.' . $this->Template->primaryKey => $id));
			$this->request->data = $this->Template->find('first', $options);
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
		$this->Template->id = $id;
		if (!$this->Template->exists()) {
			throw new NotFoundException(__('Invalid template'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Template->delete()) {
			$this->Session->setFlash(__('The template has been deleted.'));
		} else {
			$this->Session->setFlash(__('The template could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
