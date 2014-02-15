<?php
class QuestionsController extends AnswersAppController {

	public $components = array('Paginator','RequestHandler');
	public $uses = array('Answers.Question');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('category','resolved','open');
		//$this->Auth->deny('mine','favorites');
	}
	
	function home() {
		$this->set('questions', $this->Question->find('all', array(
			'contain' => array(
				'User' => array(
					'conditions' => array(
						'Question.user_id' => 'User.id'
					)),
					'Category', 'FavoriteQuestion' => array(
					'conditions' => array(
						'FavoriteQuestion.user_id' => $this->Auth->user('id')
					)
				)
			)
		)));
		$this->set('consultants', $this->Question->User->Member->Consultant->find('all'));
		$this->set('title_for_layout',"Trending Questions");
	}

	function index() {		
		$paginatesettings = array();
		$paginatesettings['contain'] = array(
			'User' => array('conditions' => array(
						 "User.id = user_id" 
						 )			        
					)
			,'Category', 'FavoriteQuestion' => array(
				'conditions' => array(
					'FavoriteQuestion.user_id' => $this->Auth->user('id')
				),
			)
		);
		$fields = array('Question.subject','Question.answer_count','Question.created','Category.id','Category.name','User.id','User.username','User.first_name');
		$order = array('Question.answer_count' => 'DESC');
		$paginatesettings['fields'] = $fields;
		$paginatesettings['order'] = $order;
		$paginatesettings['conditions'] = array('Question.status NOT'=> 'deleted');
		$this->Paginator->settings = $paginatesettings;
		$questions = $this->paginate();
		$this->set('questions', $questions);
		$this->set('title_for_layout',"Bhojpuri Swala Jawab, Charcha, Questions and Asnwers, Bhojpuri Community");
	}
	
	function open() {	
		$this->Question->Behaviors->attach('Containable');	
		$paginatesettings['contain'] = array(
			'User'=>array('conditions' => array(
						 "User.id = user_id" 
						 )			        
					), 'Category', 'FavoriteQuestion' => array(
				'conditions' => array(
					'FavoriteQuestion.user_id' => $this->Auth->user('id')
				),
			)
		);
		$fields = array('Question.subject','Question.answer_count','Question.created','Category.id','Category.name','User.id','User.username','User.first_name');
		$order = array('Question.id' => 'DESC');
		$paginatesettings['fields'] = $fields;
		$paginatesettings['order'] = $order;
		$this->Paginator->settings = $paginatesettings;
		$this->set('questions', $this->paginate(null,array('Question.status'=>'open')));
		$this->set('title_for_layout',"Open Questions");
		$this->render('index');		
	}
	
	function resolved() {		
		$this->Question->Behaviors->attach('Containable');	
		$paginatesettings['contain'] = array(
			'User'=>array('conditions' => array(
						 "User.id = user_id" 
						 )			        
					), 'Category', 'FavoriteQuestion' => array(
				'conditions' => array(
					'FavoriteQuestion.user_id' => $this->Auth->user('id')
				),
			)
		);
		$fields = array('Question.subject','Question.answer_count','Question.created','Category.id','Category.name','User.id','User.username','User.first_name');
		$order = array('Question.id' => 'DESC');
		$paginatesettings['fields'] = $fields;
		$paginatesettings['order'] = $order;
		$this->Paginator->settings = $paginatesettings;
		$this->set('questions', $this->paginate(null,array('Question.status'=>'resolved')));
		$this->set('title_for_layout',"Resolved Questions");
		$this->render('index');		
	}

	function category($id=null) {		
		$this->Question->Behaviors->attach('Containable');	
		if(!$id){
			$this->Session->setFlash(__('Invalid Category.', true));
			$this->redirect(array('action'=>'index'));
		}
		$paginatesettings = array();
		$paginatesettings['contain'] = array(
			'User'=>array('conditions' => array(
						 "User.id = user_id" 
						 )			        
					), 'Category', 'FavoriteQuestion' => array(
				'conditions' => array(
					'FavoriteQuestion.user_id' => $this->Auth->user('id')
				),
			)
		);
		$fields = array('Question.subject','Question.answer_count','Question.created','Category.id','Category.name','User.id','User.username','User.first_name');
		$order = array('Question.id' => 'DESC');
		$paginatesettings['fields'] = $fields;
		$paginatesettings['order'] = $order;
		$this->Paginator->settings = $paginatesettings;
		$this->set('questions', $this->paginate(null,array('Question.category_id'=>$id)));		
		$this->set('title_for_layout',"Questions under ".Inflector::humanize($this->params['pass'][1])." category");
		$this->render('index');		
	}
	
	function mine() {
		// $this->Question->recursive = 0;
		$fields = array('Question.subject','Question.answer_count','Question.created','Category.id','Category.name','User.id','User.username','User.first_name');
		$order = array('Question.id' => 'DESC');
		$paginatesettings['fields'] = $fields;
		$paginatesettings['order'] = $order;
		$paginatesettings['contain'] = array(
			'User' => array('conditions' => array(
						 "User.id = user_id" 
						 )			        
					)
			,'Category', 'FavoriteQuestion' => array(
				'conditions' => array(
					'FavoriteQuestion.user_id' => $this->Auth->user('id')
				),
			)
		);
		$paginatesettings['conditions'] = array(
			'Question.user_id' => $this->Auth->user('id')
		);
		$this->Paginator->settings = $paginatesettings;
		$this->set('questions', $this->paginate('Question'));
		$this->set('title_for_layout',"Questions asked by me");
		$this->render('index');		
	}
	
	function by($userId,$name) {
		// $this->Question->recursive = 0;
		$fields = array('Question.subject','Question.answer_count','Question.created','Category.id','Category.name','User.id','User.username','User.first_name');
		$order = array('Question.id' => 'DESC');
		$paginatesettings['fields'] = $fields;
		$paginatesettings['order'] = $order;
		$paginatesettings['contain'] = array(
			'User' => array('conditions' => array(
						 "User.id = user_id" 
						 )			        
					)
			,'Category', 'FavoriteQuestion' => array(
				'conditions' => array(
					'FavoriteQuestion.user_id' => $userId
				),
			)
		);
		$paginatesettings['conditions'] = array(
			'Question.user_id' => $userId
		);
		$this->Paginator->settings = $paginatesettings;
		$this->set('questions', $this->paginate('Question'));
		$this->set('title_for_layout',"Questions asked by ".$name);
		$this->render('index');		
	}

	function answeredbyme() {
		$this->Question->recursive = -1;
		$fields = array('Question.id','Question.subject','Question.answer_count','Question.created','Category.id','Category.name','User.id','User.username','User.first_name');
		$order = array('Question.id' => 'DESC');
		$paginatesettings['fields'] = $fields;
		$paginatesettings['order'] = $order;

		$paginatesettings['joins'] = array(
				array('table' => 'answers',
					'alias' => 'Answer',
					'type' => 'INNER',
					'conditions' => array(
						'Question.id = Answer.question_id',
					)
				),array(
					'table' => 'users',
					'alias' => 'User',
					'type'	=> 'INNER',
					'conditions'	=> array(
						'Question.user_id = User.id', 
					)
				),array(
					'table' => 'answerscategories',
					'alias' => 'Category',
					'type'	=> 'INNER',
					'conditions'	=> array(
						'Question.category_id = Category.id', 
					)
				)							
			);
			
		$paginatesettings['contain'] = array('FavoriteQuestion' => array(
				'conditions' => array(
					'FavoriteQuestion.user_id' => $this->Auth->user('id')
				)));
		$paginatesettings['group'] = array('Question.id');
		$paginatesettings['conditions'] = array(
			'Answer.user_id' => $this->Auth->user('id')
		);
		$this->Paginator->settings = $paginatesettings;
		$this->set('questions', $this->paginate());
		$this->set('title_for_layout',"Questions answered by me");
		$this->render('index');		
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Question.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Question->Behaviors->attach('Containable');
		$question = $this->Question->find('first', array(
			'fields' => array('Question.subject','Question.id','Question.message','Question.created','Question.status','Question.user_id','User.username','User.first_name','Category.name','BestAnswer.answer_id','BestAnswer.id'),
			'conditions' => array('Question.id' => $id),			
			'contain' => array('User', 'Category', 'BestAnswer')
		));
		$this->set('question', $question);
		$this->set('answers', $this->Question->Answer->find('all', array(
			'fields' => array('Answer.id','Answer.answer','Answer.source','Answer.user_id','User.username','User.first_name','Answer.created','User.id','Answer.question_id'),
			'conditions' => array('Answer.question_id' => $id),
			/*'joins' => array(
				array('table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => array(
						"User.id = Answer.user_id",
					)
				)
			)*/
		)));
		$this->set('title_for_layout',"Question - ".$question['Question']['subject']);
	}

	function add() {
		if (!$this->Question->isUnderLimit($this->Auth->user('id'))) {
			$this->Session->setFlash(__('You have reached the maximum number of questions allowed today.', true));
			//$this->redirect(array('action'=>'index'));
		}	
		if (!empty($this->request->data)) {					
			$this->Question->create();
			$this->request->data['Question']['user_id'] = $this->Auth->user('id');
			if ($this->Question->save($this->request->data)) {
				$this->Session->setFlash(__('The Question has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				// debug($this->Question->validationErrors);die;
				$this->Session->setFlash(__('. The Question could not be saved. Please, try again.', true));
			}
		}
		//$tags = $this->Question->Tag->find('list');
		//$topics = $this->Question->Topic->find('list');
		$conditions = array('Category.parent_id !=' => 0);
		$categories = $this->Question->Category->find('list',array('conditions'=>$conditions));
		$this->set(compact('tags', 'topics', 'users', 'categories'));
		$this->set('title_for_layout',"Ask a Question");
	}

	function edit($id = null) {
		if (!$this->_owner($id) || !$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Question', true));
			$this->redirect(array('action'=>'mine'));
		}
		if($this->_author($id) != $this->Auth->User('id')){
			$this->Session->setFlash(__('You are not authorized to edit this question', true));
			$this->redirect(array('action'=>'mine'));
		}
		if (!empty($this->request->data)) {
			$this->request->data['Question']['user_id'] = $this->Auth->user('id');
			if ($this->Question->save($this->request->data)) {
				$this->Session->setFlash(__('The Question has been saved', true));
				$this->redirect(array('action'=>'mine'));
			} else {
				$this->Session->setFlash(__('The Question could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Question->read(null, $id);
		}
		$categories = $this->Question->Category->find('list',array('conditions'=>array('Category.parent_id !='=>0)));
		$this->set(compact('categories'));
	}

	function delete($id = null) {
		if (!$id || !$this->_owner($id)) {
			$this->Session->setFlash(__('Invalid id', true));
			$this->redirect(array('action'=>'mine'));
		}
		if($this->_author($id) != $this->Auth->User('id')){
			$this->Session->setFlash(__('You are not authorized to edit this question', true));
			$this->redirect(array('action'=>'mine'));
		}
		if ($this->Question->remove($id,$this->_author($id))) {
			$this->Session->setFlash(__('Question deleted', true));
			$this->redirect(array('action'=>'mine'));
		}
	}

	function admin_index() {
		$this->Question->recursive = 0;
		$this->set('questions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Question.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('question', $this->Question->read(null, $id));
	}

	/*function admin_add() {
		if (!empty($this->data)) {
			$this->Question->create();
			if ($this->Question->save($this->data)) {
				$this->Session->setFlash(__('The Question has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Question could not be saved. Please, try again.', true));
			}
		}
		$tags = $this->Question->Tag->find('list');
		$topics = $this->Question->Topic->find('list');
		$users = $this->Question->User->find('list');
		$categories = $this->Question->Category->find('list');
		$this->set(compact('tags', 'topics', 'users', 'categories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Question', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Question->save($this->data)) {
				$this->Session->setFlash(__('The Question has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Question could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Question->read(null, $id);
		}
		$tags = $this->Question->Tag->find('list');
		$topics = $this->Question->Topic->find('list');
		$users = $this->Question->User->find('list');
		$categories = $this->Question->Category->find('list');
		$this->set(compact('tags','topics','users','categories'));
	}*/

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Question', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Question->del($id)) {
			$this->Session->setFlash(__('Question deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
