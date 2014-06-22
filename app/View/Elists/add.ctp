
<div class="col-sm-3">
	<?php echo $this->element('leftnav'); ?>
</div>
<div class="maincontent">
    <div class="maintitle"></div>
    <div class="contentarea">


	<div class="users form">
	<h2><?php echo __('Add User'); ?></h2>

	<?php echo $this->Form->create('Elist'); ?>
	<fieldset>
		<legend><?php echo __('Add Elist'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('published', array('type' => 'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
	</fieldset>
	</div>
</div>
</div>
