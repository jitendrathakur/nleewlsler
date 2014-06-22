	<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="maincontent">
        <div class="maintitle"></div>
        <div class="contentarea">
	<!--- tab code-->
         <div id="horizontalTab">
        <ul>
            <li><a href="#tab-1">Content</a></li>
            <li><a href="#tab-2">API</a></li>
            <li><a href="#tab-3">Search list</a></li>
            
            
        </ul>
        
        <div id="tab-1">
            <p>content tab 1 </p>
            <div style="float: left;"><img src="img/page1_03.png" /></div>
            <div>
            	<span>左図のような形で自動的にメールを送り、顧客を掘り起こします。</span>
            	<!-- link to tab change -->
            	<?php echo $this->Html->image("page1_06.png", array(
    "alt" => "Next",
    'url' => array('controller' => 'History', 'action' => 'index'), 
    'class'=> 'list-group-item link'
));?>
            </div>
        </div>
        <div id="tab-2">
            <div style="float: left;width: 292px;background: url('page2_03.png') no-repeat;text-align: center;height: 23px;">STEP 1</div>
            <div style="float: left;width: 292px;background: url('page2_03.png') no-repeat;text-align: center;height: 23px;">STEP 2</div>
            <div style="clear: both;"></div>
            <div style="float: left;width: 292px;text-align: center;background: #fff;text-align: center;">
            	<span>転職意思確認メール</span>
            	<hr style="border-color: #cb561e"/>
            	<img src="img/pag2_07.png"/>
            	<?php echo $this->Html->image("page2_14.png", array(
    "alt" => "Next",
    'url' => array('controller' => 'History', 'action' => 'index'), 
    'class'=> 'list-group-item link'
));?>
            </div>
            <div style="float: left;width: 292px;text-align: center;background: #fff;text-align: center;">
            	<span>タイミング確認メール</span>
            	<hr style="border-color: #cb561e"/>
            	<img src="img/pag2_09.png"/>
            	<?php echo $this->Html->image("page2_16.png", array(
    "alt" => "Next",
    'url' => array('controller' => 'History', 'action' => 'index'), 
    'class'=> 'list-group-item link'
));?>
            </div>
            <div style="clear: both;"></div>
            <div style="float: right;"><?php echo $this->Html->image("page2_21.png", array(
    "alt" => "Next",
    'url' => array('controller' => 'History', 'action' => 'index'), 
    'class'=> 'list-group-item link'
));?></div>
        </div>
        <div id="tab-3">
            <p>content</p>
            <div class="contents index">
			<h2><?php echo __('Contents'); ?></h2>
			<?php echo $this->element('subtopnav'); ?>
			<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('content_type'); ?></th>
					<th><?php echo $this->Paginator->sort('content_data'); ?></th>
					<th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php
			foreach ($contents as $content): ?>
			<tr>
				<td><?php echo h($content['Content']['id']); ?>&nbsp;</td>
				<td><?php echo ucwords(str_replace('_', ' ', h($content['Content']['content_type']))); ?>&nbsp;</td>
				<td><?php echo h($content['Content']['content_data']); ?>&nbsp;</td>
				<td><?php echo h($content['Content']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $content['Content']['id'])); ?>
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
            
	</div>
</div></div>