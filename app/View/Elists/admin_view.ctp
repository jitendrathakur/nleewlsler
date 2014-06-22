<div class="elists view">
<h2><?php echo __('Elist'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($elist['Elist']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($elist['Elist']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published'); ?></dt>
		<dd>
			<?php echo h($elist['Elist']['published']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($elist['Elist']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($elist['Elist']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Elist'), array('action' => 'edit', $elist['Elist']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Elist'), array('action' => 'delete', $elist['Elist']['id']), array(), __('Are you sure you want to delete # %s?', $elist['Elist']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Elists'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Elist'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Email Forms'), array('controller' => 'email_forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Form'), array('controller' => 'email_forms', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Email Forms'); ?></h3>
	<?php if (!empty($elist['EmailForm'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Elist Id'); ?></th>
		<th><?php echo __('Template Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('From Email'); ?></th>
		<th><?php echo __('From Email Name'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Sch Date'); ?></th>
		<th><?php echo __('Sch Time'); ?></th>
		<th><?php echo __('Time Zone'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Published'); ?></th>
		<th><?php echo __('Created By Id'); ?></th>
		<th><?php echo __('Sent'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($elist['EmailForm'] as $emailForm): ?>
		<tr>
			<td><?php echo $emailForm['id']; ?></td>
			<td><?php echo $emailForm['elist_id']; ?></td>
			<td><?php echo $emailForm['template_id']; ?></td>
			<td><?php echo $emailForm['name']; ?></td>
			<td><?php echo $emailForm['from_email']; ?></td>
			<td><?php echo $emailForm['from_email_name']; ?></td>
			<td><?php echo $emailForm['subject']; ?></td>
			<td><?php echo $emailForm['sch_date']; ?></td>
			<td><?php echo $emailForm['sch_time']; ?></td>
			<td><?php echo $emailForm['time_zone']; ?></td>
			<td><?php echo $emailForm['created']; ?></td>
			<td><?php echo $emailForm['modified']; ?></td>
			<td><?php echo $emailForm['published']; ?></td>
			<td><?php echo $emailForm['created_by_id']; ?></td>
			<td><?php echo $emailForm['sent']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'email_forms', 'action' => 'view', $emailForm['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'email_forms', 'action' => 'edit', $emailForm['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'email_forms', 'action' => 'delete', $emailForm['id']), array(), __('Are you sure you want to delete # %s?', $emailForm['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Email Form'), array('controller' => 'email_forms', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
