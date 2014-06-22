<header>
<div class="header">
	<div class="col-sm-3">	
  <?php echo $this->Html->image('logo.jpg'); ?>
	</div>
	<?php if($this->Session->read('User')) { ?>
	<div class="col-sm-9">
	<a href="#" class="registerbtn"><?php echo $this->Html->image('register.jpg'); ?></a>
<a href="#" class="loginbtn"><?php echo $this->Html->image('login.jpg'); ?></a>
</div>
<?php } ?>
</div>
</header>
<?php if($this->Session->read('User')) { ?>
<div class="navi">
	
</div>
<?php } ?>

	<!--<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="display:block;width:100%;height:25px;background:#734a47;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $siteURL; ?>">Newsletter</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo $siteURL; ?>">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li
          </ul>
		  <?php if($this->Session->read('User')) { ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo $siteURL; ?>Users/logout">Logout</a></li>
          </ul>
		<?php } ?>
      </div>/.nav-collapse 
      </div>
    </div>-->
