<div class="userAnswerProfiles view">
	<div class="sadan-userprofile">
		<div class="sadan-avtar">				
			<!--avatar here -->
		</div>
		<h1><span class="sadan-username"><?php echo $userAnswerProfile['UserAnswerProfile']['alias']; ?></span></h1>
		<?php echo $this->element('stats',array('id'=>$id));?>
	</div>
	<div class="sadan-recent-activity">
		<h2>Recent Activities</h2>		
		<?php if(sizeof($recentActivities)):?>
		<ul>	
			<?php foreach($recentActivities AS $activity):?>
			<?php 
				switch($activity['type']){
					case 'question':
			?>
						<li>Asked a question <a href="<?php echo $base_url;?>answers/questions/view/<?php echo $activity['id'];?>/<?php echo Inflector::slug($activity['question']);?>"><?php echo (strlen($activity['question'])>140)? substr($activity['question'],0,30)."...": $activity['question'];?></a></li>
			<?php 
				break;
				case 'answer':
			?>
						<li>Answered a question <a href="<?php echo $base_url;?>answers/questions/view/<?php echo $activity['id'];?>/<?php echo Inflector::slug($activity['question']);?>"><?php echo (strlen($activity['question'])>140)? substr($activity['question'],0,30)."...": $activity['question'];?></a></li>
			<?php
				break;
				case 'bestanswer':
			?>
						<li>Was voted as best answer for <a href="<?php echo $base_url;?>answers/questions/view/<?php echo $activity['id'];?>/<?php echo Inflector::slug($activity['question']);?>"><?php echo (strlen($activity['question'])>125)? substr($activity['question'],0,30)."...": $activity['question'];?></a></li>
			<?php
				break;
			}
			?>
			<?php endforeach;?>
		</ul>
		<?php else:?>
			No recent activity
		<?php endif;?>
	</div>
	<!--<div class="sadan-user-questions">
		<h2>Questions asked by <?php echo $userAnswerProfile['UserAnswerProfile']['alias']; ?></h2>
		<ul>
			<li></li>
		</ul>
	</div>
	<div class="sadan-user-questions">
		<h2>Questions answered by <?php echo $userAnswerProfile['UserAnswerProfile']['alias']; ?></h2>
		<ul>
			<li></li>
		</ul>
	</div>-->
</div>