<?php
class PointEventsController extends AnswersAppController {

	var $name = 'PointEvents';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');	
	}
	
	function index() {
		$this->_index();
	}

	function admin_index() {
		//$this->_index();
		$this->set('pointEvents', $this->paginate());
	}
	
	function admin_view($id = null) {
		$this->_view($id);
	}
	
	function admin_add() {
		//$this->_add();
		if (!empty($this->data)) {
			$this->PointEvent->create();
			//$this->data['Question']['user_id'] = $this->Auth->user('id');
			if ($this->PointEvent->save($this->data)) {
				$this->Session->setFlash(__('The Point event has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('. The Point event could not be saved. Please, try again.', true).implode(',',$this->PointEvent->validationErrors));
			}
		}
	}
	
	function admin_edit($id = null) {
		$this->_edit($id);
	}
	
	function admin_delete($id = null) {
		$this->_delete($id);
	}
	
}
?>