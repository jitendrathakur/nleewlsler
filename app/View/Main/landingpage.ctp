<?php if($this->Session->read('User')) { ?>
	<div class="col-sm-4">
		<?php echo $this->element('leftnav'); ?>
	</div>
	<div class="maincontent">
        <div class="maintitle"></div>
        <div class="contentarea">
        	<p style="padding: 15px;">DIGGYは休眠顧客を丁寧に掘り起こすWEBサービスです。使い方はとても簡単。以下の順番に従って、以下の設定項目を行えば、自動的にメールが送信されます。</p>
        	<div style="display: block;width: 98%;text-align: center;height: 110px;background: #eeeeee;margin:10px;">
        		<img src="img/user_03.jpg" style="padding: 10px;float: left;"/>
        		<div style="float: left;"><h3>顧客リストを作る。</h3>
        			<span style="padding-left: 25px;">まず、掘り起こしたい顧客リストを設定してください。</span>
        		</div>
        		<div style="float: right;padding: 10px;">
        			<img src="img/user_05.jpg" /><span style="padding-left: 2px;">未対応</span>
        		</div>
        	</div>
        	
        	<div style="display: block;width: 98%;text-align: center;height: 110px;background: #eeeeee;margin:10px;">
        		<img src="img/user_09.jpg" style="padding: 10px;float: left;"/>
        		<div style="float: left;"><h3>送信メール内容を確認する。</h3>
        			<span style="padding-left: 25px;">まず、掘り起こしたい顧客リストを設定してください。</span>
        		</div>
        		<div style="float: right;padding: 10px;">
        			<img src="img/user_05.jpg" /><span style="padding-left: 2px;">未対応</span>
        		</div>
        	</div>
        	
        	<div style="display: block;width: 98%;text-align: center;height: 110px;background: #eeeeee;margin:10px;">
        		<img src="img/user_11.jpg" style="padding: 10px;float: left;"/>
        		<div style="float: left;"><h3>配信開始する。</h3>
        			<span style="padding-left: 25px;">まず、掘り起こしたい顧客リストを設定してください。</span>
        		</div>
        		<div style="float: right;padding: 10px;">
        			<img src="img/user_05.jpg" /><span style="padding-left: 2px;">未対応</span>
        		</div>
        	</div>
        	
        	<div style="display: block;width: 98%;text-align: center;height: 110px;background: #eeeeee;margin:10px;">
        		<img src="img/user_13.jpg" style="padding: 10px;float: left;"/>
        		<div style="float: left;"><h3>効果測定する。</h3>
        			<span style="padding-left: 25px;">まず、掘り起こしたい顧客リストを設定してください。</span>
        		</div>
        		<div style="float: right;padding: 10px;">
        			<img src="img/user_05.jpg" /><span style="padding-left: 2px;">未対応</span>
        		</div>
        	</div>
        	
        </div></div>
<?php } ?>
<?php if(!$this->Session->read('User')) { ?>
	
	<div style="width:100%;height:710px;">
		
	</div>
	

<?php } ?>

<!--<div class="col-md-3">
	<?php if(!$this->Session->read('User')) { ?>
	<div id="content">
		<h2 class="form-signin-heading">Login</h2>
		<?php echo $this->Form->create('User', array('id' => 'userLoginForm' , 'class' => 'form-signin')); ?>		
			<?php echo $this->Session->flash(); ?>
			<fieldset>
			<?php echo $this->Form->input('username', array('label' => "Username <b>*</b>", 'class' => 'form-control'));?>

			<?php echo $this->Form->input('password', array('label' => "Password <b>*</b>", 'class' => 'form-control'));?>
			</fieldset>
			
			<?php echo $this->Form->submit('Login', array('name' => 'Login', 'class' => 'btn btn-lg btn-primary'));?>
	<?php echo $this->Form->end();		?>
	</div>
	<?php } ?>
</div>-->

<?php if(!$this->Session->read('User')) { ?>
<!----- footer code here ---------------------------------->
		<footer>
			<div style="display:block;width:100%;height:200px;background:#cc571f;bottom:0px;text-align:center">
				<div id="content" style="display:block;width:600px;float:left;">
		<!--<h2 class="form-signin-heading">Login</h2>-->
		<?php echo $this->Form->create('User', array('id' => 'userLoginForm' , 'class' => 'form-signin')); ?>		
			<?php echo $this->Session->flash(); ?>
			<fieldset>
			<?php echo $this->Form->input('username', array('label' => "Username <b>*</b>", 'class' => 'form-control'));?>
<div style="height: 5px;width: 100%;"></div>
			<?php echo $this->Form->input('password', array('label' => "Password <b>*</b>", 'class' => 'form-control'));?>
			</fieldset>
			<?php echo $this->Html->link(__('Forgot password'), array('controller' => 'Inquries', 'action' => 'index'), array('class' => 'fgtpwd')); ?>
			<div style="clear: both;"></div>
			<?php echo $this->Form->submit('../img/login-btn.png');?>
	<?php echo $this->Form->end();		?>
	</div>
	<div style="display:block;border-left: thin solid #fff;margin-left:5 px;margin-right: 5px;width: 20px;float: left;height: 100px;margin-top: 10px;">
								
			</div>
			<div style="display:block;width:300px;float: left;margin-top: 20px;">
				<p align="center" style="color:#FFF">click here to Register</p>
				<p align="center"><img src="img/line.png"/></p>
				<p align="center"><img src="img/arrow.png"/></p>
				<p align="center"><a href="#"><img src="img/reg-btn.png" /></a></p>
				</div>
			</div>
			
		</footer>
	  <!----- footer code ends here ---------------------------------->
	  <?php } ?>
<!--<div class="col-sm-4">
  <div class="list-group">
	<a class="list-group-item active" href="#">
	  <h4 class="list-group-item-heading">About Service</h4>
	  <!--p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p
	</a>
	<a class="list-group-item" href="#">
	  <h4 class="list-group-item-heading">How to Use System</h4>
	  <!--p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p
	</a>
	<a class="list-group-item" href="#">
	  <h4 class="list-group-item-heading">Management Team</h4>
	  <!--p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p
	</a>
	<a class="list-group-item" href="#">
	  <h4 class="list-group-item-heading">Contact Us</h4>
	  <!--p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p
	</a>
  </div>
</div>-->