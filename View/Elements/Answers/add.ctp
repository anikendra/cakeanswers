<div id="sadan-answeraddform" class="col-md-12 hidden">
	<h3>What's Your Answer?</h3>
	<?php echo $this->Form->create('Answer', array('class'=>'form','action'=>'add'));?>
		<fieldset>
			<legend><?php //echo $this->Html->link('Answer Question', array('plugin'=>'answers','controller'=>'answers','action'=>'add', $questionId));?></legend>
		<?php
			echo $this->Form->input('answer',array('label'=>'Your Answer:','class'=>'form-control'));
			echo $this->Form->input('source',array('type'=>'textarea','rows'=>3,'placeholder'=>"Share the sites you referenced in your research and give credit.",'label'=>"What's your source?",'class'=>'form-control'));
			echo $this->Form->input('question_id', array('type'=>'hidden', 'value'=>$questionId,'class'=>'form-control'));
			echo $this->Form->inout('user_id',array('type'=>'hidden','value'=>$this->Session->read('Auth.User.id')));
		?>
		<p>Answering earns you 2 points.</p>
		<?php if(isset($logged_user)):?>
		<a href="javascript:document.getElementById('AnswerAddForm').submit();" class="answersbutton"><button type="button" class="btn btn-primary">Submit</button></a>
		<?php else:?>
		<a href="<?php echo $base_url;?>users/login?next=<?php echo $this->Html->here;?>" class="answersbutton"><button type="button" class="btn btn-primary">Login to post answer</button></a>
		<?php endif;?>
		</fieldset>
	<?php echo $this->Form->end();?>	
</div>
<button type="button" class="btn-warning" id="answerbtn"><?php echo __('Answer');?></button>
<div class="clearfix seperator">&nbsp;</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#answerbtn').click(function(e){
		$(this).toggle();
		$('#sadan-answeraddform').removeClass('hidden');
	})
});
</script>