<?php
class AboutController extends AnswersAppController {

	var $name = 'About';
	var $uses = array();
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*');	
	}
	
	function index() {		
	}
	
	function pointsystem() {	
	}
}