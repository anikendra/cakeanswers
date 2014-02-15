<?php
$actions = array();
if ($this->Session->read('Auth.User.id') == $question['Question']['user_id'] && $question['Question']['status']=='open'){
	$actions['Edit Question'] 		= array('action'=>'edit', 'id'=>$question['Question']['id']);
	$actions['Delete Question'] 	= array('action'=>'delete', 'id'=>$question['Question']['id']);
}
?>
<div class="row">
	<div class="questions view col-md-9">
		<div id="sadan-question">
			<div id="askedby">
				<!-- <span class="sad-username"><?php //echo $question['User']['first_name'];?></span> -->
			</div>
			<div id="sadan-qa-container">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- 728x15, created 4/11/08 -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:728px;height:15px"
             data-ad-client="ca-pub-2954202814689324"
             data-ad-slot="2134047977"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
</script>
				<div class="hd">
					<h2><?php echo ucfirst($question['Question']['status']);?> Question</h2>
				</div>
				<h1 class="sadan-subject"><?php echo $question['Question']['subject']; ?></h1>
				<div class="sadan-content"><?php echo $question['Question']['message']; ?></div>
			</div>
			<ul class="list-inline">
				<li><?php echo $this->Time->timeAgoInWords($question['Question']['created']); ?></li> | 
				<?php if(time()-strtotime($question['Question']['created'])<=7*86400):?>
				<li><?php echo $this->Time->timeAgoInWords(7*86400+strtotime($question['Question']['created']));?> to answer</li>
				<?php endif;?>
			</ul>
			<?php echo $this->element('Questions/actions', array('actions'=>$actions)); ?>
		</div>
		
	<?php if (!$this->Session->read('Auth.User.id') || $this->Session->read('Auth.User.id') != $question['Question']['user_id']){
		$actions['Answer'] = array('plugin'=>'answers','controller'=>'answers','action'=>'add', 'id'=>$question['Question']['id']); ?>
		<?php echo $this->element('Answers/add', array('questionId' => $question['Question']['id'])); ?>
		<?php $owner = false; ?>
	<?php }else{ ?>
		<?php $owner = true; ?>
	<?php } ?>
		<?php echo $this->element('Answers/answers', array('answers'=>$answers,'question'=>$question)); ?>
	</div>

	<div class="stats ads col-md-3">
		<?php echo $this->element('mystats');?>
		<?php echo $this->element('rightads');?>
		<?php echo $this->element('leaderboard');?>	
		<?php echo $this->element('aboutanswers');?>
	</div>
</div>
<div class="clearfix mb15"></div>
<script>
	$(document).ready(function(){
		$('.quetion-actions').find('li',1).find('a',0).live('click',function(event) {
			//event.preventDefault();		
			return confirm('Really Delete?');
		});	
	});
</script>
