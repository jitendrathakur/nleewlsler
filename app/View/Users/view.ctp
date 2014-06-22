	<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="col-md-9">
		<div class="users view">
		<h2><?php  echo __('User'); ?></h2>
			<?php echo $this->element('subtopnav'); ?>
			<table class="table table-striped table-bordered table-condensed">
				<tr>
					<th><?php echo __('Username'); ?></th>
					<td>
						<?php echo h($user['User']['username']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Full Name'); ?></th>
					<td>
						<?php echo h($user['User']['full_name']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Designation'); ?></th>
					<td>
						<?php echo h($user['User']['designation']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Client'); ?></th>
					<td>
						<?php echo $this->Html->link($user['Client']['company_name'], array('controller' => 'clients', 'action' => 'view', $user['Client']['id'])); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Contact Email'); ?></th>
					<td>
						<?php echo h($user['User']['contact_email']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Role Id'); ?></th>
					<td>
						<?php echo h($user['Role']['role_name']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Is Admin'); ?></th>
					<td>
						<?php echo (h($user['User']['is_admin']))?'Yes':'No'; ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Status'); ?></th>
					<td>
						<?php echo (h($user['User']['status']))?'Active':'Inactive'; ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Created On'); ?></th>
					<td>
						<?php echo h($user['User']['created']); ?>
						&nbsp;
					</td>
				</tr>
			</table>
		</div>
		
		
		<div class="related">
			<?php if (!empty($user['Maildomain'])): ?>
			<h3><?php echo __('Related Maildomains'); ?></h3>
			<table cellpadding = "0" cellspacing = "0" class="table table-striped table-bordered table-condensed">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Mail Server Ip'); ?></th>
				<th><?php echo __('Pop3 Address'); ?></th>
				<th><?php echo __('Pop3 Port'); ?></th>
				<th><?php echo __('Smtp Address'); ?></th>
				<th><?php echo __('Smtp Port'); ?></th>
				<th><?php echo __('Newsletter Mail Id'); ?></th>
				<th><?php echo __('Mail Password'); ?></th>
				<th><?php echo __('Webmail Url'); ?></th>
				<th><?php echo __('Email Footer'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th><?php echo __('Created On'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php
				$i = 0;
				foreach ($user['Maildomain'] as $maildomain): ?>
				<tr>
					<td><?php echo $maildomain['id']; ?></td>
					<td><?php echo $maildomain['mail_server_ip']; ?></td>
					<td><?php echo $maildomain['pop3_address']; ?></td>
					<td><?php echo $maildomain['pop3_port']; ?></td>
					<td><?php echo $maildomain['smtp_address']; ?></td>
					<td><?php echo $maildomain['smtp_port']; ?></td>
					<td><?php echo $maildomain['newsletter_mail_id']; ?></td>
					<td><?php echo $maildomain['mail_password']; ?></td>
					<td><?php echo $maildomain['webmail_url']; ?></td>
					<td><?php echo $maildomain['email_footer']; ?></td>
					<td><?php echo $maildomain['user_id']; ?></td>
					<td><?php echo ($maildomain['status'])?'Active':'Inactive'; ?></td>
					<td><?php echo $maildomain['created']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('controller' => 'maildomains', 'action' => 'view', $maildomain['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('controller' => 'maildomains', 'action' => 'edit', $maildomain['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'maildomains', 'action' => 'delete', $maildomain['id']), null, __('Are you sure you want to delete # %s?', $maildomain['id'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>

		</div>
	</div>