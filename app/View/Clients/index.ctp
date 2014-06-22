	<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="maincontent">
        <div class="maintitle"></div>
        <div class="contentarea">
       
        <h2><?php echo __('Clients'); ?></h2>
	<!--- tab code-->
         <div id="horizontalTab">
        <ul>
            <li><a href="#tab-1">CSV</a></li>
            <li><a href="#tab-2">API</a></li>
            <li><a href="#tab-3">Search list</a></li>
            <li><a href="#tab-4">edit list</a></li>
            
        </ul>

        <div id="tab-1">
            <p>CSV upload </p>
        </div>
        <div id="tab-2">
            <p>Porter api</p>
        </div>
        <div id="tab-3">
            <p>List</p>
            
		<div id="content">
				<h2><?php echo __('Clients'); ?></h2>
				<?php echo $this->element('subtopnav'); ?>
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed" width="100%" >
				<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('company_name'); ?></th>
						<!--th><?php /* echo $this->Paginator->sort('address_one'); */ ?></th>
						<th><?php /* echo $this->Paginator->sort('address_two'); */ ?></th-->
						<th><?php echo $this->Paginator->sort('contact_number'); ?></th>
						<th><?php echo $this->Paginator->sort('corporate_email'); ?></th>
						<th><?php echo $this->Paginator->sort('no_of_users'); ?></th>
						<!--th><?php /* echo $this->Paginator->sort('start_date'); */ ?></th>
						<th><?php /* echo $this->Paginator->sort('end_date'); */ ?></th-->
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				<?php
				foreach ($clients as $client): ?>
				<tr>
					<td><?php echo h($client['Client']['id']); ?>&nbsp;</td>
					<td><?php echo h($client['Client']['company_name']); ?>&nbsp;</td>
					<!--td><?php /* echo h($client['Client']['address_one']); */ ?>&nbsp;</td>
					<td><?php /* echo h($client['Client']['address_two']); */ ?>&nbsp;</td-->
					<td><?php echo h($client['Client']['contact_number']); ?>&nbsp;</td>
					<td><?php echo h($client['Client']['corporate_email']); ?>&nbsp;</td>
					<td><?php echo h($client['Client']['no_of_users']); ?>&nbsp;</td>
					<!--td><?php /* echo h($client['Client']['start_date']); */ ?>&nbsp;</td>
					<td><?php /* echo h($client['Client']['end_date']); */ ?>&nbsp;</td-->
					<td><?php echo (h($client['Client']['status']))?'Active':'Inactive'; ?>&nbsp;</td>
					<td><?php echo h($client['Client']['created']); ?>&nbsp;</td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $client['Client']['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $client['Client']['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $client['Client']['id']), null, __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?>
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
        <div id="tab-4">
            <p>Edit</p>
        </div>
        
</div>
        <!-- tab code ends here-->
      </div><//div></div>
	