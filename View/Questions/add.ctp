<style>
fieldset div{text-align:left;}
input,textarea{width:550px;height:20px;}
textarea{height:60px;}
</style>
<div class="questions form">
<?php echo $this->Form->create('Question');?>
	<fieldset>
 		<legend><?php __('Add Question');?></legend>
	<?php
		if(isset($_REQUEST['question'])){
			echo $this->Form->input('subject',array('value'=>$_REQUEST['question'],'label'=>'Question'));
		}else{
			echo $this->Form->input('subject',array('label'=>'Question','class'=>'form-control'));
		}
		echo $this->Form->input('message',array('label'=>'Details','placeholder'=>"Please add more details about your question to help others to better answer it.",'class'=>'form-control'));
		echo $this->Form->input('category_id',array('class'=>'form-control'));
		//echo $form->input('Tag');
		//echo $form->input('Topic', array('multiple' => 'checkbox'));
	?>
	<?php if(isset($logged_user)):?>
	<a href="javascript:document.getElementById('QuestionAddForm').submit();" class="answersbutton"><button type="button" class="btn btn-primary">Ask</button></a>
	<?php else:?>
	<a href="<?php echo $base_url;?>users/login?next=<?php echo $this->Html->here;?>&question=<?php echo urlencode($_POST['question']);?>" class="answersbutton"><button type="button" class="btn btn-primary">Login to Ask</button></a>
	<?php endif;?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>