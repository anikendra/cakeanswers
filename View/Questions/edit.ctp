<style>
fieldset div{text-align:left;}
input,textarea{width:550px;height:20px;}
textarea{height:60px;}
</style>
<div class="questions form">
	<?php echo $this->Form->create('Question');?>
		<fieldset>
			<legend><?php __('Edit Question');?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('subject',array('class'=>'form-control input-sm'));
			echo $this->Form->input('message',array('class'=>'form-control'));
			echo $this->Form->input('category_id',array('class'=>'form-control'));			
		?>
		</fieldset>
		<div class="clearfix mb15"></div>
		<button class="btn btn-primary" type="submit">Edit</button>	
		<?php echo $this->Form->end();?>
</div>