


<div class="col-sm-3">
	<?php echo $this->element('leftnav'); ?>
</div>
<div class="maincontent">
    <div class="maintitle"></div>
    <div class="contentarea">


	<div class="users form">
	<h2><?php echo __('Add User'); ?></h2>

	<?php echo $this->Form->create('EmailForm'); ?>
	<fieldset>
		<legend><?php echo __('Add Email Form'); ?></legend>
	<?php
		echo $this->Form->input('elist_id');
		echo $this->Form->input('template_id');
		echo $this->Form->input('name');
		echo $this->Form->input('from_email');
		echo $this->Form->input('from_email_name');
		echo $this->Form->input('subject');
		echo $this->Form->input('sch_date');
		echo $this->Form->input('sch_time');
		echo $this->Form->input('time_zone');
		echo $this->Form->input('published');
		echo $this->Form->input('sent');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>
</div>

