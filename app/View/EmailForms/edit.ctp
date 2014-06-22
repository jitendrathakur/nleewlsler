<div class="emailForms form">
<?php echo $this->Form->create('EmailForm'); ?>
	<fieldset>
		<legend><?php echo __('Edit Email Form'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('elist_id');
		echo $this->Form->input('template_id');
		echo $this->Form->input('name');
		echo $this->Form->input('from_email');
		echo $this->Form->input('from_email_name');
		echo $this->Form->input('subject');
		echo $this->Form->input('sch_date');
		echo $this->Form->input('sch_time');
		echo $this->Form->input('time_zone');
		echo $this->Form->input('published');
		echo $this->Form->input('sent');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('EmailForm.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('EmailForm.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Email Forms'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Elists'), array('controller' => 'elists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Elist'), array('controller' => 'elists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Templates'), array('controller' => 'templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Template'), array('controller' => 'templates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Emails Stats'), array('controller' => 'emails_stats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emails Stat'), array('controller' => 'emails_stats', 'action' => 'add')); ?> </li>
	</ul>
</div>
