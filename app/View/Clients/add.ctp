	<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="maincontent">
        <div class="maintitle"></div>
        <div class="contentarea">
       
        <h2><?php echo __('Clients'); ?></h2>
	
		<div class="clients form">
			<h2><?php echo __('Add Client'); ?></h2>
		<?php echo $this->element('subtopnav'); ?>
		<?php echo $this->Form->create('Client', array('class' => 'form-signin')); ?>
			<?php
				echo $this->Form->input('company_name', array('class' => 'form-control'));
				echo $this->Form->input('address_one', array('class' => 'form-control'));
				echo $this->Form->input('address_two', array('class' => 'form-control'));
				echo $this->Form->input('contact_number', array('class' => 'form-control'));
				echo $this->Form->input('corporate_email', array('class' => 'form-control'));
				echo $this->Form->input('no_of_users', array('class' => 'form-control'));
				echo $this->Form->input('start_date', array('type' => 'text', 'class' => 'form-control'));
				echo $this->Form->input('end_date', array('type' => 'text', 'class' => 'form-control'));
				echo $this->Form->input('status');
				/* echo $this->Form->input('created_on', array('class' => 'form-control')); */
			?>
			<?php echo $this->Form->submit('Add', array('class' => 'btn btn-lg btn-primary'));?>
		<?php echo $this->Form->end(); ?>
		</div>
	</div>
	</div>
