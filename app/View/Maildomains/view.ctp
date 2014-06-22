	<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="col-md-9">
		<div class="maildomains view">
		<h2><?php  echo __('Maildomain'); ?></h2>
		<?php echo $this->element('subtopnav'); ?>
			<table class="table table-striped table-bordered table-condensed">
				<tr>
					<th><?php echo __('Mail Server Ip'); ?></th>
					<td>
						<?php echo h($maildomain['Maildomain']['mail_server_ip']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Pop3 Address'); ?></th>
					<td>
						<?php echo h($maildomain['Maildomain']['pop3_address']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Pop3 Port'); ?></th>
					<td>
						<?php echo h($maildomain['Maildomain']['pop3_port']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Smtp Address'); ?></th>
					<td>
						<?php echo h($maildomain['Maildomain']['smtp_address']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Smtp Port'); ?></th>
					<td>
						<?php echo h($maildomain['Maildomain']['smtp_port']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Newsletter Mail Id'); ?></th>
					<td>
						<?php echo h($maildomain['Maildomain']['newsletter_mail_id']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Mail Password'); ?></th>
					<td>
						<?php echo h($maildomain['Maildomain']['mail_password']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Webmail Url'); ?></th>
					<td>
						<?php echo h($maildomain['Maildomain']['webmail_url']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Email Footer'); ?></th>
					<td>
						<?php echo h($maildomain['Maildomain']['email_footer']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('User'); ?></th>
					<td>
						<?php echo $this->Html->link($maildomain['User']['id'], array('controller' => 'users', 'action' => 'view', $maildomain['User']['id'])); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Status'); ?></th>
					<td>
						<?php echo h($maildomain['Maildomain']['status']); ?>
						&nbsp;
					</td>
				</tr>
				<tr>
					<th><?php echo __('Created On'); ?></th>
					<td>
						<?php echo h($maildomain['Maildomain']['created']); ?>
						&nbsp;
					</td>
				</tr>
			</table>
		</div>
	</div>