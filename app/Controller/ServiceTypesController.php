<?php
App::uses('AppController', 'Controller');
/**
 * ServiceTypes Controller
 *
 * @property ServiceType $ServiceType
 */
class ServiceTypesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ServiceType->recursive = 0;
		$this->set('serviceTypes', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ServiceType->id = $id;
		if (!$this->ServiceType->exists()) {
			throw new NotFoundException(__('Invalid service type'));
		}
		$this->set('serviceType', $this->ServiceType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ServiceType->create();
			if ($this->ServiceType->save($this->request->data)) {
				$this->Session->setFlash(__('The service type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service type could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ServiceType->id = $id;
		if (!$this->ServiceType->exists()) {
			throw new NotFoundException(__('Invalid service type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ServiceType->save($this->request->data)) {
				$this->Session->setFlash(__('The service type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service type could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ServiceType->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->ServiceType->id = $id;
		if (!$this->ServiceType->exists()) {
			throw new NotFoundException(__('Invalid service type'));
		}
		if ($this->ServiceType->delete()) {
			$this->Session->setFlash(__('Service type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Service type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
