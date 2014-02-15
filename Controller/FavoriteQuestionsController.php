<?php
class FavoriteQuestionsController extends AnswersAppController {

	var $name = 'FavoriteQuestions';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');	
	}
	
	function index() {
		$this->FavoriteQuestion->Behaviors->attach('Containable');
		$this->set('questions', $this->FavoriteQuestion->find('all', array(
			'conditions' => array('FavoriteQuestion.user_id' => $this->Auth->user('id')),
			'contain' => array(
				'Question' => array(
					'Category.id',
					'Category.name',
					'User.id',
					'User.username',
					'User.first_name' 
				),
			)
		)));
		$this->render('Elements/Questions/questions');
	}
	
	function add($id = null) {
		if ($id) {
			if (!$this->FavoriteQuestion->isUnderLimit($this->Auth->user('id'))) {
				$this->Session->setFlash(__('You have reached the maximum number of favorite questions.', true));
				$this->redirect(array('controller'=>'questions','action'=>'index'));
			}
	
		
			$this->FavoriteQuestion->create();
			$this->request->data['FavoriteQuestion']['question_id'] = $id;
			$this->request->data['FavoriteQuestion']['user_id'] = $this->Auth->user('id');
			if ($this->FavoriteQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('The Question has been starred', true));
				//$this->flash('The Question has been starred', $this->referer());
			}
		}
		$this->redirect($this->referer());
	}
	
	function delete($questionId = null) {
		if ($questionId) {
			$data = $this->FavoriteQuestion->find('first', array('fields' => array('id'),'conditions'=>array(
				'FavoriteQuestion.question_id' => $questionId,
				'FavoriteQuestion.user_id' => $this->Auth->user('id')
			),'recursive' => -1));
			$id = $data['FavoriteQuestion']['id'];
			if ($this->FavoriteQuestion->delete($id)) {
				$this->Session->setFlash(__('The Question has been unstarred', true));
			}
		}
		$this->redirect($this->referer());
	}	
}
?>