	<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="col-md-9">
		<div class="maildomains index">
			<h2><?php echo __('Mail Domains'); ?></h2>
			<?php echo $this->element('subtopnav'); ?>
			<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('mail_server_ip'); ?></th>
					<th><?php echo $this->Paginator->sort('pop3_address'); ?></th>
					<th><?php echo $this->Paginator->sort('pop3_port'); ?></th>
					<th><?php echo $this->Paginator->sort('smtp_address'); ?></th>
					<th><?php echo $this->Paginator->sort('smtp_port'); ?></th>
					<th><?php echo $this->Paginator->sort('newsletter_mail_id'); ?></th>
					<th><?php echo $this->Paginator->sort('mail_password'); ?></th>
					<th><?php echo $this->Paginator->sort('webmail_url'); ?></th>
					<th><?php echo $this->Paginator->sort('email_footer'); ?></th>
					<th><?php echo $this->Paginator->sort('user_id'); ?></th>
					<th><?php echo $this->Paginator->sort('status'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php
			foreach ($maildomains as $maildomain): ?>
			<tr>
				<td><?php echo h($maildomain['Maildomain']['id']); ?>&nbsp;</td>
				<td><?php echo h($maildomain['Maildomain']['mail_server_ip']); ?>&nbsp;</td>
				<td><?php echo h($maildomain['Maildomain']['pop3_address']); ?>&nbsp;</td>
				<td><?php echo h($maildomain['Maildomain']['pop3_port']); ?>&nbsp;</td>
				<td><?php echo h($maildomain['Maildomain']['smtp_address']); ?>&nbsp;</td>
				<td><?php echo h($maildomain['Maildomain']['smtp_port']); ?>&nbsp;</td>
				<td><?php echo h($maildomain['Maildomain']['newsletter_mail_id']); ?>&nbsp;</td>
				<td><?php echo h($maildomain['Maildomain']['mail_password']); ?>&nbsp;</td>
				<td><?php echo h($maildomain['Maildomain']['webmail_url']); ?>&nbsp;</td>
				<td><?php echo h($maildomain['Maildomain']['email_footer']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($maildomain['User']['id'], array('controller' => 'users', 'action' => 'view', $maildomain['User']['id'])); ?>
				</td>
				<td><?php echo h($maildomain['Maildomain']['status']); ?>&nbsp;</td>
				<td><?php echo h($maildomain['Maildomain']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $maildomain['Maildomain']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $maildomain['Maildomain']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $maildomain['Maildomain']['id']), null, __('Are you sure you want to delete # %s?', $maildomain['Maildomain']['id'])); ?>
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