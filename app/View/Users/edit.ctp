	<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="col-md-9">
		<div class="users form">
		<h2><?php echo __('Edit User'); ?></h2>
		<?php echo $this->element('subtopnav'); ?>
		<?php echo $this->Form->create('User', array('class' => 'form-signin')); ?>
			<?php
				echo $this->Form->input('id', array('class' => 'form-control'));
				echo $this->Form->input('username', array('class' => 'form-control'));
				echo $this->Form->input('user_pass', array('type' => 'password', 'class' => 'form-control'));
				echo $this->Form->input('full_name', array('class' => 'form-control'));
				echo $this->Form->input('designation', array('class' => 'form-control'));
				echo $this->Form->input('company_id', array('options' => $clients, 'class' => 'form-control'));
				echo $this->Form->input('contact_email', array('class' => 'form-control'));
				echo $this->Form->input('role_id', array('options' => $roles, 'class' => 'form-control'));
				echo $this->Form->input('is_admin');
				echo $this->Form->input('status');
			?>
			<?php echo $this->Form->submit('Update', array('class' => 'btn btn-lg btn-primary'));?>
		<?php echo $this->Form->end(); ?>
		</div>
	</div>