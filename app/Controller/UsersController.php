<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public $components = array(
        'RequestHandler',
        'Rest.Rest' => array(
            'catchredir' => true, // Recommended unless you implement something yourself
            'debug' => 0,
        ),
    );

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('signup', 'login', 'logout', 'initDB', 'login_r');
    }
	
	public function initDB() {
		$group = $this->User->Group;
		//Allow admins to everything
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');

		//allow members to 
		$group->id = 2;
		$this->Acl->allow($group, 'controllers');
		$this->Acl->deny($group, 'controllers/Users/index');
		$this->Acl->deny($group, 'controllers/Users/delete');
		$this->Acl->deny($group, 'controllers/ServiceTypes');
		$this->Acl->deny($group, 'controllers/Comments/delete');

		//we add an exit to avoid an ugly "missing views" error message
		echo "all done";
		exit;
	}
/**
 * Log in
 *
 * @return void
 */	
	public function login() {
		/*if($this->Auth->user('id') != null) {
			$this->redirect($this->referer());
		}*/
		// Try to login user via REST
		if ($this->Rest->isActive()) {
			$credentials = $this->Rest->credentials();
			$this->Auth->autoRedirect = false;
			$this->request->data = array(
				'User' => array(
					'username' => $credentials['username'],
					'password' => $credentials['password'],
				),
			);
			if (!$this->Auth->login()) {
				$msg = sprintf('Unable to log you in with the supplied credentials. ');
				return $this->Rest->abort(array('status' => '403', 'error' => $msg));
			}
		}
		if ($this->request->is('post')) {			
			if($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}

	//test login with rest
	public function login_r()	{
		if ($this->request->is('post')) {
			$uri = 'http://localhost/dev.tourguide.com/Users/login.xml';
			$ch = curl_init($uri);
			curl_setopt_array($ch, array(
				CURLOPT_HTTPHEADER  => array('Authorization: TRUEREST username='. $this->request->data['User']['username'] . '&password='. $this->request->data['User']['password'] . '&apikey=247b5a2f72df375279573f2746686daa'),
				CURLOPT_RETURNTRANSFER  => true,
				CURLOPT_VERBOSE     => 1
			));
			$out = curl_exec($ch);
			curl_close($ch);
			// echo response output
			echo $out;
		}
	}

/**
 * Log out
 *
 * @return void
 */	
	public function logout() {		
		$this->redirect($this->Auth->logout());
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * signup method
 *
 * @return void
 */
	public function signup() {
		if ($this->request->is('post')) {
			if(is_uploaded_file($this->request->data['User']['pic']['tmp_name'])) {
				new Folder('img', true, 0777);
				$filename = $this->request->data['User']['pic']['name'];
				move_uploaded_file($this->request->data['User']['pic']['tmp_name'], 'img' . DS. $filename);								
				$this->request->data['User']['photo'] = $filename;
			}		
			$this->User->create();
			$this->request->data['User']['group_id'] = 2;
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('You have been registered'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('You could not register. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @return void
 */
	public function edit() {
		$id = $this->Auth->user('id');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if(is_uploaded_file($this->request->data['User']['pic']['tmp_name'])) {
				new Folder('img' , true, 0777);
				$filename = $this->request->data['User']['pic']['name'];
				move_uploaded_file($this->request->data['User']['pic']['tmp_name'], 'img' .DS. $filename);								
				$this->request->data['User']['photo'] = $filename;
			}		
			if ($this->User->save($this->request->data, false)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
			$this->set('user', $this->request->data['User']);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
