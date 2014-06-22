	<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="col-md-9">
		<div class="maildomains form">
		<h2><?php echo __('Add Maildomain'); ?></h2>
		<?php echo $this->element('subtopnav'); ?>
		<?php echo $this->Form->create('Maildomain', array('class' => 'form-signin')); ?>
			<?php
				echo $this->Form->input('mail_server_ip', array('class' => 'form-control'));
				echo $this->Form->input('pop3_address', array('class' => 'form-control'));
				echo $this->Form->input('pop3_port', array('class' => 'form-control'));
				echo $this->Form->input('smtp_address', array('class' => 'form-control'));
				echo $this->Form->input('smtp_port', array('class' => 'form-control'));
				echo $this->Form->input('newsletter_mail_id', array('class' => 'form-control'));
				echo $this->Form->input('mail_password', array('class' => 'form-control'));
				echo $this->Form->input('webmail_url', array('class' => 'form-control'));
				echo $this->Form->input('email_footer', array('class' => 'form-control'));
				echo $this->Form->input('user_id', array('class' => 'form-control'));
				echo $this->Form->input('status');
			?>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>
	</div>