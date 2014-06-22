
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
		<?php echo $this->Html->link(__('Create New Template'), array('action' => 'add'), array('class' => 'btn btn-warning')); ?>
			<h2><?php echo __('Templates'); ?></h2>
			<?php echo $this->element('subtopnav'); ?>
			
			<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
				<thead>
				<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('template_title'); ?></th>
						
						<th><?php echo $this->Paginator->sort('published'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($templates as $template): ?>
				<tr>
					<td><?php echo h($template['Template']['id']); ?>&nbsp;</td>
					<td><?php echo h($template['Template']['template_title']); ?>&nbsp;</td>
					
					<td><?php echo h($template['Template']['published']); ?>&nbsp;</td>
					<td><?php echo h($template['Template']['created']); ?>&nbsp;</td>
					<td><?php echo h($template['Template']['modified']); ?>&nbsp;</td>
					
					<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $template['Template']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $template['Template']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $template['Template']['id']), null, __('Are you sure you want to delete # %s?', $template['Template']['id'])); ?>
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
