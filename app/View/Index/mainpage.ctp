<!--<div class="actions">
	<h3><?php echo __('Menu'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Clients'), array('controller' => 'users', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Mail Domains'), array('controller' => 'maildomains', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Content'), array('controller' => 'contents', 'action' => 'index')); ?> </li>
	</ul>
</div>-->
<div style="display:block;margin-top:20px;margin-left:90px;width:230px;float:left;" class="actions">
    
        <div style="display:block;width:100%;height:100px;background:#d2b022;">
        	<h3><?php echo __('Menu'); ?></h3>
        </div>
        <div style="display:block;width:100%;height:45px;background:#cc571f;">
        	<?php echo $this->Html->link(__('Clients'), array('controller' => 'users', 'action' => 'index')); ?>
        </div>
        <div style="display:block;width:100%;height:45px;background:#ffffff;">
        	<?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index')); ?> 
        </div>
        <div style="display:block;width:100%;height:45px;background:#ffffff;">
        	<?php echo $this->Html->link(__('Mail Domains'), array('controller' => 'maildomains', 'action' => 'index')); ?>
        </div>
        <div style="display:block;width:100%;height:45px;background:#ffffff;">
        	<?php echo $this->Html->link(__('Content'), array('controller' => 'contents', 'action' => 'index')); ?> 
        </div>
    </div>