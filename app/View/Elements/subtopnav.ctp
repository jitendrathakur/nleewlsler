<?php


	/* Active Linking Starts here */
 	$siteURL = ROUTER::URL('/', true);
	$request_uri = NULL;
	$request_uri_get = $_SERVER['REQUEST_URI'];
	$request_uri_get_explode = explode("/", $request_uri_get);

	$request_uri_get_explode_count = count($request_uri_get_explode);
	if ($request_uri_get_explode_count > 2) {
		  $request_uri = $request_uri_get_explode[1] . "/" . $request_uri_get_explode[2];
	} else {
		  $request_uri = $request_uri_get_explode[1];
	}
	$request_uri = strtolower($request_uri);
	//Active linking ends here
	
	$subfolder = 'newsletter';
	
	$sessArr = $this->Session->read('User');
?>

<div id="horizontalTab" class="r-tabs">
	<ul class="r-tabs-nav">
		<?php if(!empty($sessArr)) { ?>
			<?php if($request_uri == $subfolder.'/clients') { ?>
				<li class="r-tabs-tab r-tabs-state-default"><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index'), array('class' => 'r-tabs-anchor')); ?></li>
				<li class="r-tabs-tab r-tabs-state-default"><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add'), array('class' => 'r-tabs-anchor')); ?></li>
			<?php } ?>

			<?php if($request_uri == $subfolder.'/users') { ?>
				<li class="r-tabs-tab r-tabs-state-default"><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('class' => 'r-tabs-anchor')); ?></li>
				<li class="r-tabs-tab r-tabs-state-default"><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('class' => 'r-tabs-anchor')); ?></li>
			<?php } ?>

			<?php if($request_uri == $subfolder.'/maildomains') { ?>
				<li class="r-tabs-tab r-tabs-state-default"><?php echo $this->Html->link(__('List Mail Domains'), array('controller' => 'maildomains', 'action' => 'index'), array('class' => 'r-tabs-anchor')); ?></li>
				<li class="r-tabs-tab r-tabs-state-default"><?php echo $this->Html->link(__('New Mail Domain'), array('controller' => 'maildomains', 'action' => 'add'), array('class' => 'r-tabs-anchor')); ?></li>
			<?php } ?>
			
			<?php if($request_uri == $subfolder.'/contents') { ?>
				<li class="r-tabs-tab r-tabs-state-default"><?php echo $this->Html->link(__('List Content'), array('action' => 'index'), array('class' => 'r-tabs-anchor')); ?></li>
			<?php } ?>
			
			<?php if($request_uri == $subfolder.'/inquries') { ?>
				<li class="r-tabs-tab r-tabs-state-default"><?php echo $this->Html->link(__('List Inquries'), array('action' => 'index'), array('class' => 'r-tabs-anchor')); ?></li>
				<li class="r-tabs-tab r-tabs-state-default"><?php echo $this->Html->link(__('New Inqury'), array('action' => 'add'), array('class' => 'r-tabs-anchor')); ?></li>
			<?php } ?>
		<?php } ?>
	</ul>
</div>