<?php
class Question extends AnswersAppModel {

	var $name = 'Question';
	var $validate = array(
		'subject' => array('notempty'),
		//'message' => array('alphanumeric'),
		'answer_count' => array('numeric'),
		'user_id' => array(
			'You have reached the maximum number of answers allowed per day' => 'isUnderLimit'
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasOne = array(
		'BestAnswer' => array(
			'className' => 'Answers.BestAnswer',
		),
	);
	
	var $belongsTo = array(
		'User'  => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => 'User.id = Question.user_id',
		),
		'Category' => array(
			'className' => 'Answers.Answerscategory',
			'foreignKey' => 'category_id',
		)
	);

	var $hasMany = array(
		'Answer' => array(
			'className' => 'Answers.Answer',
			'dependent' => true,
		),
		'FavoriteQuestion' => array(
			'className' => 'Answers.FavoriteQuestion',
			'dependent' => true,
		),
	);

	var $actsAs = array(
		'Containable',
		'Answers.AnswersInstaller' /*=> array(
			//'userModel' => true,
			// Triggers is used to install automatic point calculations
			'triggers' => array(
				'addquestion' => array(
					// Action refers to which CRUD action should trigger
					// default action is set to create
					'action' => 'create',
					// Perform a limit check in the before(Save, Delete, Find) trigger
					'check' => true,
				),
				
			),
		)*/
	);
	
	function remove($id,$userId){		
		$data = array();
		//$data['id'] = $id;
		$data['Question.status'] = "'deleted'";
		if($this->updateAll($data,array('Question.id'=>$id))){
			$this->assignPoints('askquestion', $userId, $id);
			return true;
		}
	}
	
	function afterSave($created, $options = array()) {
		if($created) {
			$this->assignPoints('askquestion', $this->data['Question']['user_id'], $this->id);
			// $this->removePoints('askquestion', $this->data['Question']['user_id'], $this->id);			
		}
	}
	
	function beforeDelete($cascade = true) {
		$this->removePoints('askquestion', $this->data['Question']['user_id'], $this->id);			
		// $this->assignPoints('askquestion', $this->data['Question']['user_id'], $this->id);
	}
}
?>