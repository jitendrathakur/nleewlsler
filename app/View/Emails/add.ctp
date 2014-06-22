<div class="emails form">
<?php echo $this->Form->create('Email'); ?>
	<fieldset>
		<legend><?php echo __('Add Email'); ?></legend>
	<?php
		echo $this->Form->input('elist_id');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Emails'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Elists'), array('controller' => 'elists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Elist'), array('controller' => 'elists', 'action' => 'add')); ?> </li>
	</ul>
</div>
