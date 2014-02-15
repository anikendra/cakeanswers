<div class="userAnswerProfiles form">
<h1>My Preferences</h1>
<?php echo $form->create('UserAnswerProfile');?>
	<fieldset>
 		<legend><?php __('My Profile Settings');?></legend>
	<?php
		echo $form->input('alias', array('label'=>'Display Alias'));
		//echo $form->input('show_link_profile');
		echo $form->input('allow_contact', array('label'=>'Allow other users to contact me'));
		echo $form->input('allow_fans');
		echo $form->input('notify_question_answered', array('label'=>'Notify me if my question is answerred'));
		echo $form->input('notify_friend_asks', array('label'=>'Notify me if my friends ask a question'));
		echo $form->input('notify_new_fan', array('label'=>'Notify me if anyone becomes my fan'));
		echo $form->input('subscribe_newsletter', array('label'=>'Subscribe to our newsletter'));		
		//echo $form->input('gender',array('type'=>'select','options'=>$options));
		//echo $form->input('dob', array('label'=>'Date of Birth'));
		echo $form->input('is_public', array('label'=>'Set my profile to be publicly viewable'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
