<?php
class UserStatisticsController extends AnswersAppController {

	var $name = 'UserStatistics';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('leaderboard','user');	
	}
	
	function index() {
		$this->_index();
	}

	function admin_index() {
		$this->_index();
	}
	
	function admin_view($id = null) {
		$this->_view($id);
	}
	
	function admin_add() {
		$this->_add();
	}
	
	function admin_edit($id = null) {
		$this->_edit($id);
	}
	
	function admin_delete($id = null) {
		$this->_delete($id);
	}
	
	function admin_init(){
		$query = "SELECT id FROM users";
		$result = $this->UserStatistic->query($query);
		foreach($result AS $user){
			$data[]['user_id'] = $user['users']['id'];
		}
		$this->UserStatistic->saveAll($data);
	}
	
	function mine(){
		return $this->UserStatistic->findByUserId($this->Auth->User('id'));
	}
	
	function user($userId){
		return $this->UserStatistic->findByUserId($userId);
	}
	
	function leaderboard(){
		$order = array('UserStatistic.points' => 'DESC');
		$limit = 10;
		$fields = array('User.id','User.username','User.first_name','UserStatistic.points','UserStatistic.user_level_id');
		$joins = array(
					array('table' => 'users',
						'alias' => 'User',
						'type' => 'INNER',
						'conditions' => array(
							'UserStatistic.user_id = User.id',
						)
					)
				);
		return $this->UserStatistic->find('all',array('fields'=>$fields,'order'=>$order,'limit'=>$limit,'joins'=>$joins,'recursive'=>-1));
	}
}
?>