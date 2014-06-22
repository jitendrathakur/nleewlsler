<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="maincontent">
        <div class="maintitle"><h3>配信履歴</h3></div>
        <div class="contentarea">
        	<h3 style="margin-left: 10px;">DIGGYの活動報告です。細かくチェックして、仮説検証をしてください。</h3>
        	
        	<div style="display: block;width: 96%;margin-left: auto;margin-right: auto;background: #eeeee;padding-left: 10px;">
        		
        		<?php echo $this->Form->create('History', array('class' => 'form-signin')); ?>
			<!-- send date - dropdown --> 
			<span>配信日</span>
			<?php echo $this->Form->input('senddate', array('class' => 'form-control'));	?>
			<!-- mail type - radio group--> 
			<span>メルマガの種類</span>
			<?php echo $this->Form->radio('type', array('class' => 'form-control'));	?>
			<!-- incharge name - drop down--> 
			<span>担当者名</span>
			<?php echo $this->Form->input('type', array('class' => 'form-control'));	?>
			<!-- list name - drop down--> 
			<span>リスト名</span>
			<?php echo $this->Form->input('type', array('class' => 'form-control'));	?>
			
					<?php echo $this->Form->submit('Add', array('class' => 'btn btn-lg btn-primary'));?>
		<?php echo $this->Form->end(); ?>
        	</div>
        	
        	</div>
        	</div>