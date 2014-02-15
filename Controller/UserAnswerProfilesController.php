<?php
class UserAnswerProfilesController extends AnswersAppController {

	var $name = 'UserAnswerProfiles';

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('index');
		//$this->Auth->allow('*');
	}	
	
	/*function index(){
		//$this->UserAnswerProfile->User->recursive=2;
		$id = $this->Auth->user('id');	
		$this->set('userAnswerProfile', $this->UserAnswerProfile->User->read(null, $id));
	}*/
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__("Invalid User", true));
			$this->redirect(array('action'=>'index'));
		}
		$profile = $this->UserAnswerProfile->find('first', array(
			'conditions' => array('user_id' => $id)
		));
		$this->set('userAnswerProfile', $profile);
		$recentActivities = $this->UserAnswerProfile->getRecentActivities($id);
		$this->set(compact('id','recentActivities'));
		$this->set('title_for_layout',"Asnwers User Profile of ".$profile['UserAnswerProfile']['alias']);
	}
	
	function edit() {
		$id = $this->Auth->user('id');
		if (!empty($this->data)) {
			if ($this->{$this->modelClass}->save($this->data)) {
				$this->Session->setFlash(__("The {$this->modelClass} has been saved", true));
				$this->redirect(array('controller'=>'questions','action'=>'index'));
			} else {
				$this->Session->setFlash(__("The {$this->modelClass} could not be saved. Please, try again.", true));
			}
		}
		if (empty($this->data)) {
			//$this->data = $this->UserAnswerProfile->User->read(null, $id);
			$this->data = $this->UserAnswerProfile->findByUserId($id);
		}
		$this->set('title_for_layout',"My Preferences");
	}
	
	function delete(){
		//$id = $this->Auth->user('id');
	}
	
	function admin_init(){
		$query = "SELECT id,first_name,last_name FROM users";
		$result = $this->UserAnswerProfile->query($query);
		foreach($result AS $user){
			$data = array();
			$data['user_id'] = $user['users']['id'];
			$data['alias'] = $user['users']['first_name'].' '.substr($user['users']['last_name'], 0, 1);
			$this->UserAnswerProfile->create();
			$this->UserAnswerProfile->save($data);
		}
		//print_r($profiles);		
	}
}
?>