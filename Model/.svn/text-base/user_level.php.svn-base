<?php
class UserLevel extends AppModel {

	var $name = 'UserLevel';
	var $validate = array(
		'name' => array('notempty'),
		'from_points' => array('numeric')
	);
	
	var $hasMany = array(
		'UserStatistic' => array(
			'className' => 'UserStatistic',
			'foreignKey' => 'user_level_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
?>