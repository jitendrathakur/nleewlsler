<div class="col-sm-3">
	<?php echo $this->element('leftnav'); ?>
</div>
<div class="maincontent">
    <div class="maintitle"></div>
    <div class="contentarea">


	<div class="users form">
	<h2><?php echo __('Add User'); ?></h2>

	<?php echo $this->Form->create('Template'); ?>
	<fieldset>
		<legend><?php echo __('Add Template'); ?></legend>
	<?php
		echo $this->Form->input('template_title');
		echo $this->Form->input('template_html', array('class' => 'editor'));
		echo $this->Form->input('footer_text', array('class' => 'editor'));
		echo $this->Form->input('published', array('type' => 'checkbox'));

	?>
	<?php echo $this->Form->submit('Add', array('class' => 'btn btn-lg btn-primary'));?>
		<?php echo $this->Form->end(); ?>
	</fieldset>
	</div>
</div>
</div>

<script type="text/javascript">
	
	$(function() {
		$('.editor').wysihtml5();
	});

</script>
