<div class="clear"></div>
<ul class="answers list-unstyled">
<?php 
$i = 0;
foreach ($answers as $answer):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
		<div class="sadan-answerer">
			<div class="sadan-user">
				<?php echo $this->Html->link($answer['User']['first_name'], array('plugin'=>'answers', 'controller'=> 'questions', 'action'=>'by', $answer['User']['id'],$answer['User']['first_name'])); ?> <span class="text-muted">answered <?php echo $this->Time->timeAgoInWords($answer['Answer']['created']); ?></span>
					<?php //echo $answer['User']['first_name']; ?>
				</div>		
		<?php if ($question['Question']['user_id'] == $this->Session->read('Auth.User.id') && empty($question['BestAnswer']['id'])): ?>
			<div class="sadan-makebestanswer"><?php echo $this->Html->link('Best Answer', array('plugin'=>'answers','controller'=>'best_answers','action'=>'add',$answer['Answer']['question_id'],$answer['Answer']['id']), array('class'=>'best')); ?></div>
		<?php endif; ?>
		<?php if ($question['BestAnswer']['answer_id'] == $answer['Answer']['id']): ?>
			<div class="sadan-best"></div>
		<?php endif; ?>
			<div class="sadan-answer"><?php echo $answer['Answer']['answer']; ?></div>
			<?php if(!empty($answer['Answer']['source'])): ?><div class="sadan-source text-muted">Source : <?php echo $answer['Answer']['source']; ?></div><?php endif;?>
		</div>
		<div class="clear"></div>
		<!-- <p class="sadan-answer-meta">					 
			<?php //echo $this->Time->timeAgoInWords($answer['Answer']['created']); ?>
		</p>-->		
	</li>
<?php endforeach; ?>
</ul>