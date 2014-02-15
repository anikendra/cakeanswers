<div class="categories form">
<?php echo $this->Form->create('Answerscategory');?>
	<fieldset>
 		<legend><?php __('Add Category');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('parent_id', array('empty'=>' - No Parent - ', 'escape' => false));
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>