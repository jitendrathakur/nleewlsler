	<div class="col-sm-4">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="col-md-7">
		<div class="contents view">
		<h2><?php  echo __('Content'); ?></h2>
			<dl>
				<dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($content['Content']['id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Content Type'); ?></dt>
				<dd>
					<?php echo h($content['Content']['content_type']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Content Data'); ?></dt>
				<dd>
					<?php echo h($content['Content']['content_data']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Created On'); ?></dt>
				<dd>
					<?php echo h($content['Content']['created_on']); ?>
					&nbsp;
				</dd>
			</dl>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('Edit Content'), array('action' => 'edit', $content['Content']['id'])); ?> </li>
				<li><?php echo $this->Form->postLink(__('Delete Content'), array('action' => 'delete', $content['Content']['id']), null, __('Are you sure you want to delete # %s?', $content['Content']['id'])); ?> </li>
			</ul>
		</div>
	</div>