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
	
	$subfolder = 'g4b';
	
	$sessArr = $this->Session->read('User');
	
	//$client_img = $this->Html->image('links-news_06.png', array('alt' => 'CakePHP'));
	//print_r($sessArr);
?>

<!--<div class="list-group">--><div class="sidepanel list-group" id="sidepanel">
	<?php /* echo $this->Html->link(__('Register Newsletter User'), array('controller' => 'users', 'action' => 'register_newsletter_user'), array('class' => 'list-group-item')); ?>
	<?php echo $this->Html->link(__('Register Client'), array('controller' => 'clients', 'action' => 'register_clients'), array('class' => 'list-group-item')); ?>
	<?php echo $this->Html->link(__('Edit/Delete User Info'), array('controller' => 'users', 'action' => 'manage_user_info'), array('class' => 'list-group-item')); ?>
	<?php echo $this->Html->link(__('Edit/Delete Client Info'), array('controller' => 'clients', 'action' => 'manage_client_info'), array('class' => 'list-group-item')); ?>
	<?php echo $this->Html->link(__('Staff Registration'), array('controller' => 'users', 'action' => 'staff_register'), array('class' => 'list-group-item')); ?>
	<?php echo $this->Html->link(__('Generate Report'), array('controller' => 'users', 'action' => 'generate_report'), array('class' => 'list-group-item')); ?>
	<?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'list-group-item')); */ ?>
	
	
	<?php echo $this->Html->link(__('Dashboard'), '/', array('class' => 'list-group-item actlink')); ?>
	<?php if(!empty($sessArr)) { ?>
	
			<?php echo $this->Html->link(__('Templates'), array('controller' => 'templates', 'action' => 'index'), array('class' => 'list-group-item')); ?>
			<?php echo $this->Html->link(__('Email Lists'), array('controller' => 'elists', 'action' => 'index'), array('class' => 'list-group-item')); ?>
			<?php echo $this->Html->link(__('Email Form'), array('controller' => 'email_forms', 'action' => 'index'), array('class' => 'list-group-item')); ?>
			


		<?php  if($sessArr['role_id']==1) {  ?>
			
			
			
			<?php echo $this->Html->link(__('Clients'), array('controller' => 'clients', 'action' => 'index'), array('class' => 'list-group-item link')); ?>
			
			<?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index'), array('class' => 'list-group-item link')); ?>
			<?php echo $this->Html->link(__('Mail Domains'), array('controller' => 'maildomains', 'action' => 'index'), array('class' => 'list-group-item link')); ?>
			<?php echo $this->Html->link(__('Content'), array('controller' => 'contents', 'action' => 'index'), array('class' => 'list-group-item link')); ?>
			<?php echo $this->Html->link(__('Inquries'), array('controller' => 'Inquries', 'action' => 'index'), array('class' => 'list-group-item link')); ?>
	
		<?php  } else {  ?>
		
			<?php echo $this->Html->image("links-news_06.png", array(
    "alt" => "Users",
    'url' => array('controller' => 'users', 'action' => 'index'), 
    'class'=> 'list-group-item link'
));?>
			<!--<?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index'), array('class' => 'list-group-item link')); ?>-->
			
			<?php echo $this->Html->image("links-news_09.png", array(
    "alt" => "Sent mail contents",
    'url' => array('controller' => 'contents', 'action' => 'index'), 
    'class'=> 'list-group-item link'
));?>

<?php echo $this->Html->image("links-news_11.png", array(
    "alt" => "History",
    'url' => array('controller' => 'contents', 'action' => 'index'), 
    'class'=> 'list-group-item link'
));?>

<?php echo $this->Html->image("links-news_14.png", array(
    "alt" => "Reports",
    'url' => array('controller' => 'reports', 'action' => 'index'), 
    'class'=> 'list-group-item link'
));?>
			<!--<?php echo $this->Html->link(__('Sent Mail contents'), array('controller' => 'maildomains', 'action' => 'index'), array('class' => 'list-group-item link')); ?>
			<?php echo $this->Html->link(__('History'), array('controller' => 'contents', 'action' => 'index'), array('class' => 'list-group-item link')); ?>
			<?php echo $this->Html->link(__('Reports'), array('controller' => 'reports', 'action' => 'index'), array('class' => 'list-group-item link')); ?>-->
		
		<?php } ?>
		<?php if($request_uri == $subfolder.'/clients') { ?>
			<?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index'), array('class' => 'list-group-item')); ?>
			<?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add'), array('class' => 'list-group-item')); ?>
		<?php } ?>

		<?php if($request_uri == $subfolder.'/users') { ?>
			<?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('class' => 'list-group-item')); ?>
			<?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('class' => 'list-group-item')); ?>
		<?php } ?>

		<?php if($request_uri == $subfolder.'/maildomains') { ?>
			<?php echo $this->Html->link(__('List Mail Domains'), array('controller' => 'maildomains', 'action' => 'index'), array('class' => 'list-group-item')); ?>
			<?php echo $this->Html->link(__('New Mail Domain'), array('controller' => 'maildomains', 'action' => 'add'), array('class' => 'list-group-item')); ?>
		<?php } ?>
		
		<?php if($request_uri == $subfolder.'/contents') { ?>
			<?php echo $this->Html->link(__('List Content'), array('action' => 'index'), array('class' => 'list-group-item')); ?>
		<?php } ?>
		
		<?php if($request_uri == $subfolder.'/inquries') { ?>
			<?php echo $this->Html->link(__('List Inquries'), array('action' => 'index'), array('class' => 'list-group-item')); ?>
			<?php echo $this->Html->link(__('New Inqury'), array('action' => 'add'), array('class' => 'list-group-item')); ?>
		<?php } ?>

	
	<?php } ?>
	<?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'list-group-item')); ?>
</div>