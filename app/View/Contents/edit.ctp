	<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="col-md-9">
		<div class="contents form">
		<h2><?php echo __('Edit Content'); ?></h2>
		<?php echo $this->element('subtopnav'); ?>
		<?php echo $this->Form->create('Content', array('class' => 'form-signin')); ?>
			<?php
				echo $this->Form->input('id');
				/* echo $this->Form->input('content_type', array('readonly' => 'readonly', 'class' => 'form-control')); */
				echo $this->Form->input('content_data', array('class' => 'form-control'));
				/* echo $this->Form->input('created_on'); */
			?>
			<?php echo $this->Form->submit('Update', array('class' => 'btn btn-lg btn-primary'));?>
		<?php echo $this->Form->end(); ?>
		</div>
	</div>