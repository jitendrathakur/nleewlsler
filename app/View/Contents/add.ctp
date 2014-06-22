	<div class="col-sm-4">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="col-md-7">
		<div class="contents form">
		<?php echo $this->Form->create('Content'); ?>
			<fieldset>
				<legend><?php echo __('Add Content'); ?></legend>
			<?php
				echo $this->Form->input('content_type');
				echo $this->Form->input('content_data');
				echo $this->Form->input('created_on');
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>
	</div>