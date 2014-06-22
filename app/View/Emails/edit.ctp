<div class="emails form">
<?php echo $this->Form->create('Email'); ?>
	<fieldset>
		<legend><?php echo __('Edit Email'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('elist_id');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Email.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Email.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Emails'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Elists'), array('controller' => 'elists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Elist'), array('controller' => 'elists', 'action' => 'add')); ?> </li>
	</ul>
</div>
