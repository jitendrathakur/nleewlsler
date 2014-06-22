<div class="emailForms view">
<h2><?php echo __('Email Form'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Elist'); ?></dt>
		<dd>
			<?php echo $this->Html->link($emailForm['Elist']['name'], array('controller' => 'elists', 'action' => 'view', $emailForm['Elist']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Template'); ?></dt>
		<dd>
			<?php echo $this->Html->link($emailForm['Template']['template_html'], array('controller' => 'templates', 'action' => 'view', $emailForm['Template']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From Email'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['from_email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From Email Name'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['from_email_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sch Date'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['sch_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sch Time'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['sch_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time Zone'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['time_zone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['published']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sent'); ?></dt>
		<dd>
			<?php echo h($emailForm['EmailForm']['sent']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Email Form'), array('action' => 'edit', $emailForm['EmailForm']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Email Form'), array('action' => 'delete', $emailForm['EmailForm']['id']), array(), __('Are you sure you want to delete # %s?', $emailForm['EmailForm']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Email Forms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Form'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Elists'), array('controller' => 'elists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Elist'), array('controller' => 'elists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Templates'), array('controller' => 'templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Template'), array('controller' => 'templates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Emails Stats'), array('controller' => 'emails_stats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emails Stat'), array('controller' => 'emails_stats', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Emails Stats'); ?></h3>
	<?php if (!empty($emailForm['EmailsStat'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Email Form Id'); ?></th>
		<th><?php echo __('Email Id'); ?></th>
		<th><?php echo __('Sent'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($emailForm['EmailsStat'] as $emailsStat): ?>
		<tr>
			<td><?php echo $emailsStat['id']; ?></td>
			<td><?php echo $emailsStat['email_form_id']; ?></td>
			<td><?php echo $emailsStat['email_id']; ?></td>
			<td><?php echo $emailsStat['sent']; ?></td>
			<td><?php echo $emailsStat['created']; ?></td>
			<td><?php echo $emailsStat['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'emails_stats', 'action' => 'view', $emailsStat['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'emails_stats', 'action' => 'edit', $emailsStat['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'emails_stats', 'action' => 'delete', $emailsStat['id']), array(), __('Are you sure you want to delete # %s?', $emailsStat['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Emails Stat'), array('controller' => 'emails_stats', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
