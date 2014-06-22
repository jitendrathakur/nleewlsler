	<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="col-md-9">
		<div class="clients view">
			<h2><?php  echo __('Client'); ?></h2>
			<?php echo $this->element('subtopnav'); ?>
			<table class="table table-striped table-bordered table-condensed">
				<tr>
					<th><?php echo __('Company Name'); ?></th>
					<td>
						<?php echo h($client['Client']['company_name']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Address One'); ?></th>
					<td>
						<?php echo h($client['Client']['address_one']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Address Two'); ?></th>
					<td>
						<?php echo h($client['Client']['address_two']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Contact Number'); ?></th>
					<td>
						<?php echo h($client['Client']['contact_number']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Corporate Email'); ?></th>
					<td>
						<?php echo h($client['Client']['corporate_email']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('No Of Users'); ?></th>
					<td>
						<?php echo h($client['Client']['no_of_users']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Start Date'); ?></th>
					<td>
						<?php echo h($client['Client']['start_date']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('End Date'); ?></th>
					<td>
						<?php echo h($client['Client']['end_date']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Status'); ?></th>
					<td>
						<?php echo (h($client['Client']['status']))?'Active':'Inactive'; ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Created'); ?></th>
					<td>
						<?php echo h($client['Client']['created']); ?>
						&nbsp;
					</td>
				</tr>
			</table>
		</div>
		
		<div class="related">
		<?php if (!empty($client['ClientUsers'])): ?>
			<h3><?php echo __('Related Users'); ?></h3>
			<table cellpadding = "0" cellspacing = "0" class="table table-striped table-bordered table-condensed">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Username'); ?></th>
				<th><?php echo __('Full Name'); ?></th>
				<th><?php echo __('Designation'); ?></th>
				<th><?php echo __('Company Id'); ?></th>
				<th><?php echo __('Contact Email'); ?></th>
				<th><?php echo __('Role Id'); ?></th>
				<th><?php echo __('Is Admin'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php
				$i = 0;
				foreach ($client['ClientUsers'] as $clientUsers): ?>
				<tr>
					<td><?php echo $clientUsers['id']; ?></td>
					<td><?php echo $clientUsers['username']; ?></td>
					<td><?php echo $clientUsers['full_name']; ?></td>
					<td><?php echo $clientUsers['designation']; ?></td>
					<td><?php echo $clientUsers['company_id']; ?></td>
					<td><?php echo $clientUsers['contact_email']; ?></td>
					<td><?php echo $clientUsers['role_id']; ?></td>
					<td><?php echo $clientUsers['is_admin']; ?></td>
					<td><?php echo $clientUsers['status']; ?></td>
					<td><?php echo $clientUsers['created']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $clientUsers['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $clientUsers['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $clientUsers['id']), null, __('Are you sure you want to delete # %s?', $clientUsers['id'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>
		</div>
	</div>