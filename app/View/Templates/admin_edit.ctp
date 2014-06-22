<div class="templates form">
<?php echo $this->Form->create('Template'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Template'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('template_title');
		echo $this->Form->input('template_html');
		echo $this->Form->input('footer_text');
		echo $this->Form->input('published');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Template.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Template.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Templates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Email Forms'), array('controller' => 'email_forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Form'), array('controller' => 'email_forms', 'action' => 'add')); ?> </li>
	</ul>
</div>
