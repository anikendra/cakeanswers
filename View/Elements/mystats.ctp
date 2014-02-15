<?php if(isset($logged_user)):?>
	<?php $mystats = $this->requestAction('answers/user_statistics/mine'); ?>
	<div class="mystats well">
		<div>Hellow <a href="<?php echo $base_url;?>answers/questions/mine" title="View <?php echo $logged_user['User']['first_name'];?>'s asked questions"><?php echo $logged_user['User']['first_name'];?></a></div>
		<div>You have <?php echo $mystats['UserStatistic']['points'];?> points (Level <?php echo $mystats['UserStatistic']['user_level_id'];?>)</div>
	</div>
<?php endif;?>