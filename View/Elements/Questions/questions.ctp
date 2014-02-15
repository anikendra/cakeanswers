<div class="questionList">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- 728x15, created 4/11/08 -->
	<ins class="adsbygoogle"
	     style="display:inline-block;width:728px;height:15px"
	     data-ad-client="ca-pub-2954202814689324"
	     data-ad-slot="2134047977"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
</script>
	<ul class="list-unstyled">
	<?php if(sizeof($questions)):
	$i = 0;
	foreach ($questions as $question):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
		<li<?php echo $class;?>>
			<?php				
				if (isset($size)) {
					$options['size'] =  $size;
				}
				$options['question'] = (isset($question['Question'])) ? array_merge($question['Question'], $question) : $question;
				$options['plugin'] = 'answers';
				echo $this->element('Questions/question', $options); 
			?>
		</li>
	<?php endforeach; ?>
	<?php endif;?>
	</ul>

<?php if (isset($paginator)): ?>
	<div class="paging">
		<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $paginator->numbers();?>
		<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
	</div>
<?php endif; ?>
</div>
