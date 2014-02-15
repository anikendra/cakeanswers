<div class="categories index">
<h2><?php __('Categories');?></h2>
<p>
<?php
// echo $this->Paginator->counter(array(
// 'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
// ));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('created');?></th>
	<th><?php echo $this->Paginator->sort('modified');?></th>
	<th><?php echo $this->Paginator->sort('name');?></th>
	<th><?php echo $this->Paginator->sort('parent_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($categories as $category):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $category['Answerscategory']['id']; ?>
		</td>
		<td>
			<?php echo $category['Answerscategory']['created']; ?>
		</td>
		<td>
			<?php echo $category['Answerscategory']['modified']; ?>
		</td>
		<td>
			<?php echo $category['Answerscategory']['name']; ?>
		</td>
		<td>
			<?php echo $category['Answerscategory']['parent_id']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action'=>'view', $category['Answerscategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action'=>'edit', $category['Answerscategory']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action'=>'delete', $category['Answerscategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $category['Answerscategory']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('New Category', true), array('action'=>'add')); ?></li>
	</ul>
</div>
