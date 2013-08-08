<?php
App::uses('AppController', 'Controller');
App::import('Xml');
/**
 * Branches Controller
 *
 * @property Branch $Branch
 */
class BranchesController extends AppController {

	public $components = array('RequestHandler');
	public $helpers = array('Html', 'Javascript', 'Form', 'Ajax');


	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'search', 'viewp', 'searchStatue');
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->RequestHandler->isXml()) {
			$this->Branch->recursive = 2;
			$br = $this->Branch->find('all',  array('conditions' => array('city' => 'Addis Ababa')));			
			$branches = array();
			$i = 0;
			foreach($br as $b) {
				if($b) {
					$branch = array();
					$branch['name'] = $b['Branch']['name'];
					$branch['company'] = $b['User']['company'];
					$branch['services'] = '';
					foreach ($b['Service'] as $service)
						$branch['services'] .= $service['name'].', ';
					$branch['branchUrl'] = 'http://miheretab.alwaysdata.net/branches/viewp/'.$b['Branch']['id'];
					$branch['address'] = $b['Branch']['specific_place'].', '.$b['Branch']['city'].', Ethiopia';
					$branch['website'] = $b['User']['website'];
					$branch['photoUrl'] = 'http://miheretab.alwaysdata.net/img/'.$b['User']['photo'];
					$branch['description'] = $b['Branch']['description'];	
					$branches[$i++] = $branch;
				}
			}
			
			return $this->set('branches', $branches);			
		}
		$this->Branch->recursive = 0;
		$this->paginate = array('conditions' => array('user_id' => $this->Auth->user('id')));
		$this->set('branches', $this->paginate());
	}

/**
 * search method
 *
 * @param string $place
 * @return void
 */
	public function search($place = null) {
		$this->Branch->recursive = 2;
		$b = $this->Branch->find('first', array('conditions' => array('Branch.name' => $place)));
		$branch = array();
		if($b) {
			$branch['name'] = $b['Branch']['name'];
			$branch['company'] = $b['User']['company'];
			$branch['services'] = '';
			foreach ($b['Service'] as $service)
				$branch['services'] .= $service['name'].', ';
			$branch['branchUrl'] = 'http://miheretab.alwaysdata.net/branches/viewp/'.$b['Branch']['id'];
			$branch['address'] = $b['Branch']['specific_place'].', '.$b['Branch']['city'].', Ethiopia';
			$branch['website'] = $b['User']['website'];
			$branch['photoUrl'] = 'http://miheretab.alwaysdata.net/img/'.$b['User']['photo'];			
			$branch['description'] = $b['Branch']['description'];	
		}
		
		return $this->set('branch', $branch);
	}
	
/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Branch->id = $id;
		if (!$this->Branch->exists()) {
			throw new NotFoundException(__('Invalid branch'));
		}
		$this->Branch->recursive = 2;
		$branch = $this->Branch->read(null, $id);
		if($branch['Branch']['user_id'] != $this->Auth->user('id'))
			throw new NotFoundException(__('Invalid branch'));
		$this->set('branch', $branch);
	}
	
/**
 * viewp method
 *
 * @param string $id
 * @return void
 */
	public function viewp($id = null) {
		$this->Branch->id = $id;
		if (!$this->Branch->exists()) {
			throw new NotFoundException(__('Invalid branch'));
		}
		$this->Branch->recursive = 2;
		$branch = $this->Branch->read(null, $id);
		$this->set('branch', $branch);
	}	

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {			
			$this->request->data['Branch']['user_id'] = $this->Auth->user('id');						
			$this->Branch->create();			
			if ($this->Branch->save($this->request->data)) {
				$this->Session->setFlash(__('The branch has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The branch could not be saved. Please, try again.'));
			}
		}
		$services = $this->Branch->Service->find('list', array('conditions' => array('user_id' => $this->Auth->user('id'))));
		$this->set(compact('services'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Branch->id = $id;
		if (!$this->Branch->exists()) {
			throw new NotFoundException(__('Invalid branch'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {			
			if ($this->Branch->save($this->request->data)) {
				$this->Session->setFlash(__('The branch has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The branch could not be saved. Please, try again.'));
			}
		} else {
			$branch = $this->Branch->read(null, $id);
			if($branch['Branch']['user_id'] != $this->Auth->user('id'))
				throw new NotFoundException(__('Invalid branch'));
			$this->request->data = $branch;
		}
		$services = $this->Branch->Service->find('list', array('conditions' => array('user_id' => $this->Auth->user('id'))));
		$this->set(compact('services'));
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
		$this->Branch->id = $id;
		if (!$this->Branch->exists()) {
			throw new NotFoundException(__('Invalid branch'));
		}
		if ($this->Branch->delete()) {
			$this->Session->setFlash(__('Branch deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Branch was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function autoComplete() {   
		$this->set('places', $this->Branch->Place->find('all', array('conditions' => array(
							'Place.name LIKE' => '%%'), 'fields' => array('name'))));
		$this->layout = 'ajax';
	}
	
	public function searchStatue($name = null) {   
		$s = $this->Branch->Statue->find('first', array('conditions' => array('name' => $name)));
		$statue = array();
		if(!$statue) {
			$statue['name'] = $s['Statue']['name'];
			$statue['description'] = $s['Statue']['description'];
		}
		return $this->set('statue', $statue);		
	}
}
