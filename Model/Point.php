<?php
class Point extends AnswersAppModel {

	var $name = 'Point';
	var $validate = array(
		'point_event_id' => array('numeric'),
		'user_answer_profile_id' => array('numeric'),
		//'model' => array('notempty'),
		//'foreign_key' => array('numeric'),
		'points' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(		
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PointEvent' => array(
			'className' => 'PointEvent',
			'foreignKey' => 'point_event_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function afterSave($created, $options = array()) {	
		echo 'die';die;	
		if ($created) {		
			$this->User->UserStatistic->updateAll(
				array('UserStatistic.points' => 'UserStatistic.points + '.$this->data['Point']['points']), 
				array('UserStatistic.user_id' => $this->data['Point']['user_id'])
			);
		}
	}
			
	function beforeDelete() {
	}

}
?>