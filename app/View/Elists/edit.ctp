<div class="elists form">
<?php echo $this->Form->create('Elist'); ?>
	<fieldset>
		<legend><?php echo __('Edit Elist'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('published', array('type' => 'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Elist.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Elist.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Elists'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Email Forms'), array('controller' => 'email_forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Form'), array('controller' => 'email_forms', 'action' => 'add')); ?> </li>
	</ul>
</div>
