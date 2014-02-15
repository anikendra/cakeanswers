<?php

class AnswersAppController extends AppController {
	
	var $helpers = array('Html', 'Form', 'Time');

	function beforeFilter() {
		// Ensures that all models joined with Authenticated users use the right table.
		if (isset($this->{$this->modelClass}->belongsTo['User'])) {
			$this->{$this->modelClass}->belongsTo['User'] = array('className' => $this->Auth->userModel);
		}
		if (isset($this->{$this->modelClass}->hasMany['User'])) {
			$this->{$this->modelClass}->hasMany['User'] = array('className' => $this->Auth->userModel);
		}
		if (isset($this->{$this->modelClass}->hasOne['User'])) {
			$this->{$this->modelClass}->hasOne['User'] = array('className' => $this->Auth->userModel);
		}
		if (isset($this->{$this->modelClass}->hasManyAndBelongsTo['User'])) {
			$this->{$this->modelClass}->hasManyAndBelongsTo['User'] = array('className' => $this->Auth->userModel);
		}
		parent::beforeFilter();
	}
	
	function _owner($id, $relatedModel = null) {
		if ($relatedModel) {
			$userId = $this->{$this->modelClass}->{$relatedModel}->field('user_id', array($relatedModel.'.id' => $id));
		} else {
			$userId = $this->{$this->modelClass}->field('user_id', array($this->modelClass.'.id' => $id));	
		}
		if ($userId == $this->Auth->user('id')) {
			$result = true;
		} else {
			$result = false;
		}
		return $result;
	}
	
	function _author($id, $relatedModel = null) {
		if ($relatedModel) {
			$userId = $this->{$this->modelClass}->{$relatedModel}->field('user_id', array($relatedModel.'.id' => $id));
		} else {
			$userId = $this->{$this->modelClass}->field('user_id', array($this->modelClass.'.id' => $id));	
		}		
		return $userId;
	}
}
?>