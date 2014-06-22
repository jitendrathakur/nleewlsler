<div class="col-sm-3">
	<?php echo $this->element('leftnav'); ?>
</div>
<div class="col-md-9">
	<div class="inquries view">
	<h2><?php  echo __('Inqury'); ?></h2>
	<?php echo $this->element('subtopnav'); ?>
		<table class="table table-striped table-bordered table-condensed">
			<tr>
				<th><?php echo __('Name'); ?></th>
				<td>
					<?php echo h($inqury['Inqury']['name']); ?>
					&nbsp;
				</td>
			</tr>
			<tr>
				<th><?php echo __('Company'); ?></th>
				<td>
					<?php echo h($inqury['Inqury']['company']); ?>
					&nbsp;
				</td>
			</tr>
			<tr>
				<th><?php echo __('Email'); ?></th>
				<td>
					<?php echo h($inqury['Inqury']['email']); ?>
					&nbsp;
				</td>
			</tr>
			<tr>
				<th><?php echo __('Phone'); ?></th>
				<td>
					<?php echo h($inqury['Inqury']['phone']); ?>
					&nbsp;
				</td>
			</tr>
			<tr>
				<th><?php echo __('Inquiry Type'); ?></th>
				<td>
					<?php echo h($inqury['Inqury']['inquiry_type']); ?>
					&nbsp;
				</td>
			</tr>
			<tr>
				<th><?php echo __('Details'); ?></th>
				<td>
					<?php echo h($inqury['Inqury']['details']); ?>
					&nbsp;
				</td>
			</tr>
			<tr>
				<th><?php echo __('Ip Address'); ?></th>
				<td>
					<?php echo h($inqury['Inqury']['ip_address']); ?>
					&nbsp;
				</td>
			</tr>
			<tr>
				<th><?php echo __('Created On'); ?></th>
				<td>
					<?php echo h($inqury['Inqury']['created']); ?>
					&nbsp;
				</td>
			</tr>
		</table>
	</div>
</div>