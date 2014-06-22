	<div class="col-sm-3">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="maincontent">
        <div class="maintitle"></div>
        <div class="contentarea">
	<!--- tab code-->
         <div id="horizontalTab">
        <ul>
            <li><a href="#tab-1">CSV</a></li>
            <li><a href="#tab-2">API</a></li>
            <li><a href="#tab-3">Search list</a></li>
            
            
        </ul>
        
        <div id="tab-1">
            <p>CSV Upload</p>
<!--            <?php
echo $this->Form->create('upload', array( 'type' => 'file'));
echo $this->Form->input('file', array('type' => 'file','label' => 'Pdf'));
echo $this->Form->end('Upload file');
$image_src = $this->webroot.'files/'.$image;
?>
 to display uploaded file ( considering uploaded file is a image) 
<img src="<? //echo $image_src?>" />-->
<?php
/* display message saved in session if any */
echo $this->Session->flash();
?>
<div> 
<div class="images-form">
<?php echo $this->Form->create('Post', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Add CSV File'); ?></legend>
        <?php
       
        //echo $this->Form->input('csv', array('type' => 'file'));
		
			if(!empty($this->data['Post']['filepath'])): ?>
        
    	<div>
        	<label>Upload File</label>
            <?php
				echo $this->Form->input('filepath', array('type'=>'hidden'));
				echo $this->HTML->link(basename($this->data['Post']['filepath']), $this->data['Post']['filepath']);
			?>
        </div>
        	<?php
				else:
					echo $this->Form->input('filename', array('type' => 'file'));
				endif;
			?>		
    </fieldset>
    
<?php echo $this->Form->end(__('Submit')); ?>

</div>
<div class="image-display">
<?php echo $this->Html->link(__('Next'), array('controller' => 'User', 'action' => 'import'), array('class' => 'list-group-item link')); ?>
</div>
</div>
            
        </div>
        <div id="tab-2">
            <p>tab 2</p>
        </div>
        <div id="tab-3">
            <p>content</p>
		<div class="users index">
			<h2><?php echo __('Users'); ?></h2>
			<?php echo $this->element('subtopnav'); ?>
			<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('username'); ?></th>
					<th><?php echo $this->Paginator->sort('full_name'); ?></th>
					<th><?php echo $this->Paginator->sort('designation'); ?></th>
					<th><?php echo $this->Paginator->sort('company_id'); ?></th>
					<th><?php echo $this->Paginator->sort('contact_email'); ?></th>
					<th><?php echo $this->Paginator->sort('role_id'); ?></th>
					<th><?php echo $this->Paginator->sort('is_admin'); ?></th>
					<th><?php echo $this->Paginator->sort('status'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php 
			foreach ($users as $user): ?>
			<tr>
				<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['full_name']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['designation']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($user['Client']['company_name'], array('controller' => 'clients', 'action' => 'view', $user['Client']['id'])); ?>
				</td>
				<td><?php echo h($user['User']['contact_email']); ?>&nbsp;</td>
				<td><?php echo h($user['Role']['role_name']); ?>&nbsp;</td>
				<td><?php echo (h($user['User']['is_admin']))?'Yes':'No'; ?>&nbsp;</td>
				<td><?php echo (h($user['User']['status']))?'Active':'Inactive'; ?>&nbsp;</td>
				<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
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
</div></div>