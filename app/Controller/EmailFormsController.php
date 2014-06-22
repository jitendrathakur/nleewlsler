<?php
App::uses('AppController', 'Controller');
/**
 * EmailForms Controller
 *
 * @property EmailForm $EmailForm
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EmailFormsController extends AppController {

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
		$this->EmailForm->recursive = 0;
		$this->set('emailForms', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EmailForm->exists($id)) {
			throw new NotFoundException(__('Invalid email form'));
		}
		$options = array('conditions' => array('EmailForm.' . $this->EmailForm->primaryKey => $id));
		$this->set('emailForm', $this->EmailForm->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EmailForm->create();
			if ($this->EmailForm->save($this->request->data)) {
				$this->Session->setFlash(__('The email form has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email form could not be saved. Please, try again.'));
			}
		}
		$elists = $this->EmailForm->Elist->find('list');
		$templates = $this->EmailForm->Template->find('list', array('fields' => array('id', 'template_title')));
		$this->set(compact('elists', 'templates'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->EmailForm->exists($id)) {
			throw new NotFoundException(__('Invalid email form'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EmailForm->save($this->request->data)) {
				$this->Session->setFlash(__('The email form has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email form could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EmailForm.' . $this->EmailForm->primaryKey => $id));
			$this->request->data = $this->EmailForm->find('first', $options);
		}
		$elists = $this->EmailForm->Elist->find('list');
		$templates = $this->EmailForm->Template->find('list');
		$this->set(compact('elists', 'templates'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EmailForm->id = $id;
		if (!$this->EmailForm->exists()) {
			throw new NotFoundException(__('Invalid email form'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EmailForm->delete()) {
			$this->Session->setFlash(__('The email form has been deleted.'));
		} else {
			$this->Session->setFlash(__('The email form could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->EmailForm->recursive = 0;
		$this->set('emailForms', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->EmailForm->exists($id)) {
			throw new NotFoundException(__('Invalid email form'));
		}
		$options = array('conditions' => array('EmailForm.' . $this->EmailForm->primaryKey => $id));
		$this->set('emailForm', $this->EmailForm->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->EmailForm->create();
			if ($this->EmailForm->save($this->request->data)) {
				$this->Session->setFlash(__('The email form has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email form could not be saved. Please, try again.'));
			}
		}
		$elists = $this->EmailForm->Elist->find('list');
		$templates = $this->EmailForm->Template->find('list');
		$this->set(compact('elists', 'templates'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->EmailForm->exists($id)) {
			throw new NotFoundException(__('Invalid email form'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EmailForm->save($this->request->data)) {
				$this->Session->setFlash(__('The email form has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email form could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EmailForm.' . $this->EmailForm->primaryKey => $id));
			$this->request->data = $this->EmailForm->find('first', $options);
		}
		$elists = $this->EmailForm->Elist->find('list');
		$templates = $this->EmailForm->Template->find('list');
		$this->set(compact('elists', 'templates'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->EmailForm->id = $id;
		if (!$this->EmailForm->exists()) {
			throw new NotFoundException(__('Invalid email form'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EmailForm->delete()) {
			$this->Session->setFlash(__('The email form has been deleted.'));
		} else {
			$this->Session->setFlash(__('The email form could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
