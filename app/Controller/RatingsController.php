<?php
App::uses('AppController', 'Controller');
/**
 * Ratings Controller
 *
 * @property Rating $Rating
 */
class RatingsController extends AppController {

	public $components = array('RequestHandler');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'view');
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rating->recursive = 0;
		$this->set('ratings', $this->paginate());
	}

/**
 * view method
 *
 * @param string $branchName
 * @return void
 */
	public function view($branchName = null) {
		$branch = $this->Rating->Branch->find('first', array('conditions' => array('Branch.name' => $branchName)));	
		$rating = $this->Rating->find('all', array('conditions' => array('branch_id' => $branch['Branch']['id'])));		
		$ratings =  array('NotBad' => 0, 'Fair' => 0, 'Good' => 0, 'Good' => 0, 'VeryGood' => 0, 'Excelent' => 0);
		foreach($rating as $r) {
			if($r['Rating']['value'] == 1)
				$ratings['NotBad'] += 1;
			if($r['Rating']['value'] == 2)
				$ratings['Fair'] += 1;
			if($r['Rating']['value'] == 3)
				$ratings['Good'] += 1;
			if($r['Rating']['value'] == 4)
				$ratings['VeryGood'] += 1;	
			if($r['Rating']['value'] == 5)
				$ratings['Excelent'] += 1;					
		}
		return $this->set('ratings', $ratings);
	}

/**
 * add method
 *
 * @return void
 */
	public function add($values = "") {
		$values = split('-', $values);
		if (count($values) == 2) {
			$branch = $this->Rating->Branch->find('first', array('conditions' => array('Branch.name' => $values[0])));
			$this->request->data['Rating']['branch_id'] = $branch['Branch']['id'];
			$this->request->data['Rating']['value'] = $values[1];
			$this->Rating->create();
			if ($this->Rating->save($this->request->data)) {
				return $this->set('result', 'The rating has been saved');
			} else {
				return $this->set('result', 'The rating could not be saved. Please, try again.');
			}
		} else {
				return $this->set('result', 'No values given.');
		}
	}

}
