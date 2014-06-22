<div class="col-sm-3">
	<?php echo $this->element('leftnav'); ?>
</div>
<div class="col-md-9">
	<div class="inquries index">
		<h2><?php echo __('Inquries'); ?></h2>
		<?php echo $this->element('subtopnav'); ?>
		<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed" width="100%" >
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('company'); ?></th>
				<th><?php echo $this->Paginator->sort('email'); ?></th>
				<th><?php echo $this->Paginator->sort('phone'); ?></th>
				<th><?php echo $this->Paginator->sort('inquiry_type'); ?></th>
				<th><?php echo $this->Paginator->sort('details'); ?></th>
				<th><?php echo $this->Paginator->sort('ip_address'); ?></th>
				<th><?php echo $this->Paginator->sort('created_on'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php
		foreach ($inquries as $inqury): ?>
		<tr>
			<td><?php echo h($inqury['Inqury']['id']); ?>&nbsp;</td>
			<td><?php echo h($inqury['Inqury']['name']); ?>&nbsp;</td>
			<td><?php echo h($inqury['Inqury']['company']); ?>&nbsp;</td>
			<td><?php echo h($inqury['Inqury']['email']); ?>&nbsp;</td>
			<td><?php echo h($inqury['Inqury']['phone']); ?>&nbsp;</td>
			<td><?php echo h($inqury['Inqury']['inquiry_type']); ?>&nbsp;</td>
			<td><?php echo h($inqury['Inqury']['details']); ?>&nbsp;</td>
			<td><?php echo h($inqury['Inqury']['ip_address']); ?>&nbsp;</td>
			<td><?php echo h($inqury['Inqury']['created']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $inqury['Inqury']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $inqury['Inqury']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $inqury['Inqury']['id']), null, __('Are you sure you want to delete # %s?', $inqury['Inqury']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>	</p>

		<div class="paging">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
		</div>
	</div>
</div>