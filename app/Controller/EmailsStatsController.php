<?php
App::uses('AppController', 'Controller');
/**
 * EmailsStats Controller
 *
 * @property EmailsStat $EmailsStat
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EmailsStatsController extends AppController {

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
		$this->EmailsStat->recursive = 0;
		$this->set('emailsStats', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EmailsStat->exists($id)) {
			throw new NotFoundException(__('Invalid emails stat'));
		}
		$options = array('conditions' => array('EmailsStat.' . $this->EmailsStat->primaryKey => $id));
		$this->set('emailsStat', $this->EmailsStat->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EmailsStat->create();
			if ($this->EmailsStat->save($this->request->data)) {
				$this->Session->setFlash(__('The emails stat has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emails stat could not be saved. Please, try again.'));
			}
		}
		$emailForms = $this->EmailsStat->EmailForm->find('list');
		$emails = $this->EmailsStat->Email->find('list');
		$this->set(compact('emailForms', 'emails'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->EmailsStat->exists($id)) {
			throw new NotFoundException(__('Invalid emails stat'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EmailsStat->save($this->request->data)) {
				$this->Session->setFlash(__('The emails stat has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emails stat could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EmailsStat.' . $this->EmailsStat->primaryKey => $id));
			$this->request->data = $this->EmailsStat->find('first', $options);
		}
		$emailForms = $this->EmailsStat->EmailForm->find('list');
		$emails = $this->EmailsStat->Email->find('list');
		$this->set(compact('emailForms', 'emails'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EmailsStat->id = $id;
		if (!$this->EmailsStat->exists()) {
			throw new NotFoundException(__('Invalid emails stat'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EmailsStat->delete()) {
			$this->Session->setFlash(__('The emails stat has been deleted.'));
		} else {
			$this->Session->setFlash(__('The emails stat could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->EmailsStat->recursive = 0;
		$this->set('emailsStats', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->EmailsStat->exists($id)) {
			throw new NotFoundException(__('Invalid emails stat'));
		}
		$options = array('conditions' => array('EmailsStat.' . $this->EmailsStat->primaryKey => $id));
		$this->set('emailsStat', $this->EmailsStat->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->EmailsStat->create();
			if ($this->EmailsStat->save($this->request->data)) {
				$this->Session->setFlash(__('The emails stat has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emails stat could not be saved. Please, try again.'));
			}
		}
		$emailForms = $this->EmailsStat->EmailForm->find('list');
		$emails = $this->EmailsStat->Email->find('list');
		$this->set(compact('emailForms', 'emails'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->EmailsStat->exists($id)) {
			throw new NotFoundException(__('Invalid emails stat'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EmailsStat->save($this->request->data)) {
				$this->Session->setFlash(__('The emails stat has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emails stat could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EmailsStat.' . $this->EmailsStat->primaryKey => $id));
			$this->request->data = $this->EmailsStat->find('first', $options);
		}
		$emailForms = $this->EmailsStat->EmailForm->find('list');
		$emails = $this->EmailsStat->Email->find('list');
		$this->set(compact('emailForms', 'emails'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->EmailsStat->id = $id;
		if (!$this->EmailsStat->exists()) {
			throw new NotFoundException(__('Invalid emails stat'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EmailsStat->delete()) {
			$this->Session->setFlash(__('The emails stat has been deleted.'));
		} else {
			$this->Session->setFlash(__('The emails stat could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
