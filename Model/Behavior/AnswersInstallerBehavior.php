<?php
class AnswersInstallerBehavior extends ModelBehavior {

/**
 * Errors
 *
 * @var array
 */
	var $errors = array();
/**
 * Defaults
 *
 * @var array
 * @access protected
 */
	var $_defaults = array();
/**
 * User Model
 *
 * @var array
 * @access protected
 */
	var $userModel = false;
	
/**
 * User Model
 *
 * @var array
 * @access protected
 */
	var $triggers = array();

/**
 * User Model
 *
 * @var array
 * @access protected
 */	
	var $relationships = array(
		'hasMany'=> array(
			'Answer' => array('className' => 'Answers.Answer'),				
			'Question'=> array('className' => 'Answers.Question'),
			'Report'=> array(
				'className' => 'Answers.Report',
				'dependent' => true
			),
			'Point'=> array(
				'className' => 'Answers.Point',
				'dependent' => true
			),
			'FavoriteQuestion'=> array(
				'className' => 'Answers.FavoriteQuestion',
				'dependent' => true
			)
		),
		'hasOne' => array(
			'UserAnswerProfile'=> array(
				'className' => 'Answers.UserAnswerProfile',
				'dependent' => true
			),
			'UserStatistic'=> array(
				'className' => 'Answers.UserStatistic',
				'dependent' => true
			)
		)
	);

/**
 * Initiate Tree behavior
 *
 * @param object $Model instance of model
 * @param array $fields array of configuration settings.
 * @return void
 * @access public
 */
	function setup(Model $Model, $settings = array()) {
		if ($Model->alias == 'User') {
			$this->userModel = true;
			$this->_bindUserRelationships($Model);
		}
		if (isset($settings['triggers']) && $settings['triggers']) {
			$this->triggers = $settings['triggers'];
		}
	}
	
/**
 * Initiate Tree behavior
 *
 * @param object $Model instance of model
 * @param array $fields array of configuration settings.
 * @return void
 * @access public
 */
 
 /*  moving this check and update points to the user_controller where it'll evaluate if the user
     has a UserAnswerProfile and UserStatistic profile, just incase users from other sites
	 are atempting to migrate from other websites.
	 
	function afterSave(&$Model, $created) {	
		if ($Model->alias == 'User' && $created) {	
			// If a new user registered, create related profiles
			if (!isset($this->data['UserAnswerProfile']) || empty($this->data['UserAnswerProfile'])) {
				$data['UserAnswerProfile']['user_id'] = $Model->id;
				$data['UserAnswerProfile']['alias'] = $this->data['Member']['first_name']. ' '.substr($this->data['Member']['last_name'], 0, 1);
				$Model->UserAnswerProfile->save($data);
			}
			if (!isset($this->data['UserStatistic']) || empty($this->data['UserStatistic'])) {
				$data['UserStatistic']['user_id'] = $Model->id;
				$Model->UserStatistic->save($data);
			}
		}
	}
*/
	
/**
 * Check the limits of the target user to see if they are allowed to post more content
 *
 * Action checks (login once per day, 50 thumb up max, register) should be performed in the controller actions only
 *
 * @param object $Model instance of model
 * @param array $fields array of configuration settings.
 * @return boolean
 * @access public
 */
	function isUnderLimit(&$Model, $data) {
		$userId = (is_array($data)) ? $data['user_id'] : $data;
		$joins = array(
		    array('table' => 'user_levels',
		        'alias' => 'UserLevel',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'UserLevel.id = UserStatistic.user_level_id',
		        )
		    )
		);
		$userLevel = $Model->User->UserStatistic->find('first', array(
			'fields'=>array('UserLevel.name','UserLevel.from_points','UserLevel.question_limit','UserLevel.answer_limit','UserLevel.favorite_question_limit'),
			'conditions'=>array(
				'UserStatistic.user_id' => $userId,
			),'joins' => $joins
		));
		$count = $Model->find('count', array('conditions'=>array(
			$Model->alias.'.user_id' => $userId,
			$Model->alias.'.created > ' => date('Y-m-d g:i:s', strtotime('-1 day'))
		),'recursive'=>-1));
		return ($count < $userLevel['UserLevel'][Inflector::underscore($Model->alias).'_limit']);
	}
	
/**
 * Add points from the point event to the target user
 *
 * model_foreign_key is used in conjunction to show which record from the related model caused the points
 *
 * @param object $Model instance of model
 * @param array $fields array of configuration settings.
 * @return void
 * @access public
 */
	function assignPoints(&$Model, $code, $userId, $foreignKey = null) {
		// If the current model is a user model, displace the loaded model instance so following code works
		if ($Model->alias == 'User') {
			$Model = $Model->Point;
		}
		
		$query = "SELECT PointEvent.id,PointEvent.points FROM point_events PointEvent WHERE PointEvent.code = '$code' LIMIT 1";
		$event = $Model->query($query);
		if(!$event) {
			return false;
		}
		$data['Point'] = array(
			'point_event_id' => $event[0]['PointEvent']['id'],
			'user_id' => $userId,
			'points' => $event[0]['PointEvent']['points'],
		);
		
		$data['Point']['model_foreign_key'] = $foreignKey;

		$Model->User->Point->create();
		$success = $Model->User->Point->save($data);
		if($success){
			$Model->User->UserStatistic->updateAll(
				array('UserStatistic.points' => 'UserStatistic.points + '.$event[0]['PointEvent']['points']), 
				array('UserStatistic.user_id' => $userId)
			);
		}
		return $success;
	}

/**
 * Remove points from the point event to the target user
 *
 * model_foreign_key is used in conjunction to show which record from the related model caused the points
 *
 * @param object $Model instance of model
 * @param array $fields array of configuration settings.
 * @return void
 * @access public
 */
	function removePoints(&$Model, $code, $foreignKey) {
		$query = "SELECT PointEvent.id FROM point_events PointEvent WHERE PointEvent.code = '$code' LIMIT 1";
		$event = $Model->query($query);
		if (!$event) {
			return false;
		}
		
		$success = $Model->User->Point->deleteAll(array(
			'point_event_id' => $event[0]['PointEvent']['id'],
			'model_foreign_key' => $foreignKey,
		));
		return $success;
	}
	
/**
 * Bind all related models in the plugin to the User model
 *
 * @return boolean success
 * @access public
 */
	function _bindUserRelationships(&$Model) {
		$success = $Model->bindModel($this->relationships, false);
		
		return $success;
	}
	
}
?>
