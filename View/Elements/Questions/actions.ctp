<div class="quetion-actions">	
	<?php if(!empty($actions)):?>
	<ul class="list-inline">
	<?php foreach($actions AS $name => $action):?>
		<li><?php echo $this->Html->link(__($name, true), array('action'=>$action['action'], $action['id']));?>
	<?php endforeach;?>
	</ul>
	<?php endif;?>
</div>