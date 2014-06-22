<div class="col-sm-3">
	<?php echo $this->element('leftnav'); ?>
</div>
<div class="col-md-9">
	<div class="inquries form">
	<h2><?php echo __('Edit Inqury'); ?></h2>
	<?php echo $this->element('subtopnav'); ?>
	<?php echo $this->Form->create('Inqury'); ?>
		<?php
			echo $this->Form->input('id', array('class' => 'form-control'));
			echo $this->Form->input('name', array('class' => 'form-control'));
			echo $this->Form->input('company', array('class' => 'form-control'));
			echo $this->Form->input('email', array('class' => 'form-control'));
			echo $this->Form->input('phone', array('class' => 'form-control'));
			echo $this->Form->input('inquiry_type', array('class' => 'form-control'));
			echo $this->Form->input('details', array('class' => 'form-control'));
			/* echo $this->Form->input('ip_address', array('class' => 'form-control'));
			echo $this->Form->input('created_on'); */
		?>
		<?php echo $this->Form->submit('Update', array('class' => 'btn btn-lg btn-primary'));?>
	<?php echo $this->Form->end(); ?>
	</div>
</div>