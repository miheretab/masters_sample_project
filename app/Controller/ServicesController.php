<?php
App::uses('AppController', 'Controller');
/**
 * Services Controller
 *
 * @property Service $Service
 */
class ServicesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('menu');
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Service->recursive = 0;
		$this->paginate = array('conditions' => array('user_id' => $this->Auth->user('id')));		
		$this->set('services', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Service->id = $id;
		if (!$this->Service->exists()) {
			throw new NotFoundException(__('Invalid service'));
		}
		$service = $this->Service->read(null, $id);
		if($service['Service']['user_id'] != $this->Auth->user('id'))
			throw new NotFoundException(__('Invalid service'));		
		$this->set('service', $service);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Service']['user_id'] = $this->Auth->user('id');
			$this->Service->create();
			if ($this->Service->save($this->request->data)) {
				$this->Session->setFlash(__('The service has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}
		}
		$serviceTypes = $this->Service->ServiceType->find('list');
		$this->set(compact('serviceTypes'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Service->id = $id;
		if (!$this->Service->exists()) {
			throw new NotFoundException(__('Invalid service'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Service->save($this->request->data)) {
				$this->Session->setFlash(__('The service has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The service could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = 
			$service = $this->Service->read(null, $id);
			if($service['Service']['user_id'] != $this->Auth->user('id'))
				throw new NotFoundException(__('Invalid service'));
			$this->request->data = $service;			
		}
		$serviceTypes = $this->Service->ServiceType->find('list');
		$this->set(compact('serviceTypes'));
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
		$this->Service->id = $id;
		if (!$this->Service->exists()) {
			throw new NotFoundException(__('Invalid service'));
		}
		if ($this->Service->delete()) {
			$this->Session->setFlash(__('Service deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Service was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * menu method
 *
 * @return void
 */
	public function menu($id = null) {
		$this->Service->recursive = 2;
		$this->paginate = array('conditions' => array('service_type_id' => 1));		
		$this->set('services', $this->paginate());
		$this->set('branchId', $id);
	}
	

}
