<?php
class UserAnswerProfile extends AnswersAppModel {

	var $name = 'UserAnswerProfile';
	var $displayField = 'alias';
	var $validate = array(
		'alias' => array('notEmpty'),
		'avatar_option' => array('numeric'),
		'show_link_profile' => array('boolean'),
		'allow_contact' => array('boolean'),
		'allow_fans' => array('boolean'),
		'notify_question_answered' => array('boolean'),
		'notify_friend_asks' => array('boolean'),
		'notify_new_fan' => array('boolean'),
		'subscribe_newsletter' => array('boolean'),
		'is_public' => array('boolean')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $genders = array(
		'Male' => 'Male',
		'Female' => 'Female'
	);

	function getRecentActivities($id){
		$return = array();
		$query = "SELECT id,subject,created FROM questions WHERE user_id = $id ORDER BY id DESC LIMIT 5";
		$questions = $this->query($query);
		if(sizeof($questions)){
			foreach($questions AS $question){
				$return[$question['questions']['created']] = array('type'=>'question','id'=>$question['questions']['id'],'question'=>$question['questions']['subject']);
			}
		}
		$query = "SELECT q.id,subject,a.created FROM questions q JOIN answers a ON q.id = a.question_id WHERE a.user_id = $id ORDER BY a.id DESC LIMIT 5";
		$answers = $this->query($query);
		if(sizeof($answers)){
			foreach($answers AS $question){
				$return[$question['a']['created']] = array('type'=>'answer','id'=>$question['q']['id'],'question'=>$question['q']['subject']);
			}
		}
		$query = "SELECT ba.question_id,q.subject,ba.created FROM questions q JOIN best_answers ba ON q.id = ba.question_id WHERE ba.user_id = $id ORDER BY ba.id DESC LIMIT 5";
		$bestAnswers = $this->query($query);
		if(sizeof($bestAnswers)){
			foreach($bestAnswers AS $question){
				$return[$question['ba']['created']] = array('type'=>'bestanswer','id'=>$question['ba']['question_id'],'question'=>$question['q']['subject']);
			}
		}
		krsort($return);
		return $return;
	}
}
?>