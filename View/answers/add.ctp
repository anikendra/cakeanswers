<div class="answers form">
	<h2><?php echo $question['Question']['subject']; ?></h2>
	<p><?php echo $question['Question']['message']; ?></p>
	<?php echo $form->create('Answer');?>
		<fieldset>
			<legend><?php __('Add Answer');?></legend>
		<?php
			echo $form->error('user_id');
			echo $form->input('answer');
			echo $form->input('question_id', array('type'=>'hidden'));
		?>
		</fieldset>
	<?php echo $form->end('Submit');?>
</div>