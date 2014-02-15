<h4>
<?php echo (empty($question['FavoriteQuestion'])) 
	? $this->Html->link('[Star]', array('plugin'=>'answers','controller'=>'favorite_questions','action'=>'add', $question['id']), array('class'=>'star','title'=>'Star')) 
	: $this->Html->link('[UnStar]', array('plugin'=>'answers','controller'=>'favorite_questions','action'=>'delete', $question['id']), array('class'=>'unstar','title'=>'Unstar'));
?>
	<?php echo $this->Html->link($question['subject'], array(
'plugin'=>'answers',
'controller'=>'questions',
'action'=>'view', 
$question['id'],
Inflector::slug($question['subject'])
)); ?>
</h4>

<p>In <?php echo $this->Html->link($question['Category']['name'], array('plugin'=>'answers','controller'=> 'questions', 'action'=>'category', $question['Category']['id'], Inflector::slug($question['Category']['name']))); ?> 
- Asked by 
<?php 
if (!empty($question['User']['first_name'])){
	echo $this->Html->link($question['User']['first_name'], array('controller'=> 'questions', 'action'=>'by', $question['User']['id'],$question['User']['first_name'])); 
}else{
	echo 'anonymous';
}
?>
 - <?php echo $question['answer_count']; ?> answers 
- <?php echo $this->Time->timeAgoInWords($question['created']); ?></p>