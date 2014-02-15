<div class="categories index">
	<h1><?php echo __('Browse Categories');?></h1>
	<ul class="list-unstyled">
	<?php
	$i = 0;
	foreach ($categories as $category):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
		<li <?php echo $class;?>>
			<a href="<?php echo $base_url;?>answers/questions/category/<?php echo $category['Answerscategory']['id']; ?>/<?php echo Inflector::slug($category['Answerscategory']['name']); ?>" title="Open questions of category - <?php echo $category['Answerscategory']['name']; ?>"><?php echo $category['Answerscategory']['name']; ?></a>				
		</li>
				
	<?php endforeach; ?>
	</ul>
</div>
