<?php echo $this->Html->css('menu_style');?>
<?php echo $this->Html->css('answers');?>
<div id="nav">
	<ul class="nav nav-pills">
		<li>
			<a href="<?php echo $base_url;?>sawaljawab" title="Questions and Answers Home"><span>Home</span></a>
		</li>
		<li>
			<a href="<?php echo $base_url;?>answers/categories/index" title="Questions and Answers Categories"><span>Browse Categories</span></a>
		</li>
		<?php if(isset($logged_user)):?>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $base_url;?>answers/questions/mine" title="Questions asked by me"><span>My Activity</span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="<?php echo $base_url;?>answers/questions/mine" title="Questions asked by me"><span>My Questions</span></a></li>
				<li><a href="<?php echo $base_url;?>answers/favorite_questions/" title="Questions asked by me"><span>My Favourite Questions</span></a></li>
				<li><a href="<?php echo $base_url;?>answers/questions/answeredbyme" title="Answers given by me"><span>My Answers</span></a></li>
				<!-- <li><a href="<?php echo $base_url;?>answers/user_answer_profiles/edit" title="My settings"><span>My Preferences</span></a></li> -->
			</ul>
		</li>
		<?php endif;?>
		<!-- <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">About</a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="<?php echo $base_url;?>answers/about/index" title="Questions and Answers About">How it works?</a></li>
				<li><a href="<?php echo $base_url;?>answers/about/pointsystem" title="Questions and Answers Points System"><span>Points System</span></a></li>
			</ul>
		</li> -->
	</ul>
</div>
<div id="questionanav">
	<ul class="nav nav-pills row">
		<li class="col-md-5">
			<div>
				<h3>Ask</h3>
				<form id="questionaskform" action="<?php echo $base_url;?>answers/questions/add" method="POST">
					<input value="5" type="hidden" name="data[Question][category_id]"/>
					<input class="form-control input-lg" type="text" name="data[Question][subject]" placeholder="What would you like to ask?"/>
					<div class="clearfix mb15"></div>
					<?php if(isset($logged_user)):?>
					<a href="javascript:document.getElementById('questionaskform').submit();" class="answersbutton"><button type="button" class="btn btn-primary">Submit</button></a>
					<?php else:?>
					<a href="<?php echo $base_url;?>users/login?next=<?php echo $this->Html->here;?>" class="answersbutton"><button type="button" class="btn btn-primary">Login to Ask</button></a>
					<?php endif;?>
				</form>
			</div>
		</li>
		<li class="col-md-3">
			<div>
				<h3>Answer</h3>
				<div class="answerslabel"><b>Share</b> your knowledge, <b>Help</b> others and be an <b>Expert</b></div>
				<a href="<?php echo $base_url;?>answers/questions/open" class="answersbutton" title="Browse Open Questions"><button type="button" class="btn btn-info">Browse Open Questions</button></a>
			</div>
		</li>
		<li class="col-md-3">
			<div>
				<h3>Discover</h3>
				<div class="answerslabel">The Best Answers chosen by the <b>Community</b></div>
				<a href="<?php echo $base_url;?>answers/questions/resolved" class="answersbutton" title="Browse Resolved Questions"><button type="button" class="btn btn-warning">Browse Resolved Questions</button></a>
			</div>
		</li>
	</ul>
</div>
<div class="clearfix mb15"></div>