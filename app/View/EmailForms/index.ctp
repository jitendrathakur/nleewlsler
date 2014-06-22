

<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="maincontent">
        <div class="maintitle"></div>
        <div class="contentarea">
	<!--- tab code-->
         <div id="horizontalTab">
               
        <div id="">
     
		<div class="users index">
		<?php echo $this->Html->link(__('Create New Email Form'), array('action' => 'add'), array('class' => 'btn btn-warning')); ?>
			<h2><?php echo __('Email Form'); ?></h2>
			<?php echo $this->element('subtopnav'); ?>
			
			<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
				<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('elist_id'); ?></th>
			<th><?php echo $this->Paginator->sort('template_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('from_email'); ?></th>
			<th><?php echo $this->Paginator->sort('from_email_name'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('sch_date'); ?></th>
			<th><?php echo $this->Paginator->sort('sch_time'); ?></th>
			<th><?php echo $this->Paginator->sort('time_zone'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('published'); ?></th>
			<th><?php echo $this->Paginator->sort('sent'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($emailForms as $emailForm): ?>
	<tr>
		<td><?php echo h($emailForm['EmailForm']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($emailForm['Elist']['name'], array('controller' => 'elists', 'action' => 'view', $emailForm['Elist']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($emailForm['Template']['template_html'], array('controller' => 'templates', 'action' => 'view', $emailForm['Template']['id'])); ?>
		</td>
		<td><?php echo h($emailForm['EmailForm']['name']); ?>&nbsp;</td>
		<td><?php echo h($emailForm['EmailForm']['from_email']); ?>&nbsp;</td>
		<td><?php echo h($emailForm['EmailForm']['from_email_name']); ?>&nbsp;</td>
		<td><?php echo h($emailForm['EmailForm']['subject']); ?>&nbsp;</td>
		<td><?php echo h($emailForm['EmailForm']['sch_date']); ?>&nbsp;</td>
		<td><?php echo h($emailForm['EmailForm']['sch_time']); ?>&nbsp;</td>
		<td><?php echo h($emailForm['EmailForm']['time_zone']); ?>&nbsp;</td>
		<td><?php echo h($emailForm['EmailForm']['created']); ?>&nbsp;</td>
		<td><?php echo h($emailForm['EmailForm']['modified']); ?>&nbsp;</td>
		<td><?php echo h($emailForm['EmailForm']['published']); ?>&nbsp;</td>
		<td><?php echo h($emailForm['EmailForm']['sent']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $emailForm['EmailForm']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $emailForm['EmailForm']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $emailForm['EmailForm']['id']), array(), __('Are you sure you want to delete # %s?', $emailForm['EmailForm']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
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
</div></div>

