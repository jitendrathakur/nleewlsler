<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/* $cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework'); */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php /* echo $cakeDescription */ ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		/* echo $this->Html->css('cake.generic'); */
		//echo $this->Html->css('bootstrap');
		//echo $this->Html->css('jumbotron');
		echo $this->Html->css('custom');
		echo $this->Html->css('responsive-tabs');
		echo $this->Html->css('style');
		echo $this->Html->css(array('bootstrap-wysihtml5', 'bootstrap.min'));
		echo $this->Html->script(array('wysihtml5-0.3.0', 'jquery-2.1.0.min', 'bootstrap.min', 'bootstrap-wysihtml5', 'jquery.responsiveTabs'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?php
	$siteURL =  ROUTER::URL('/', true);
	?>
	<!-- Fixed navbar -->
	<?php echo $this->element('header'); ?>

<?php if($this->Session->read('User')) { ?>
	<div class="container">
		<?php } else {?>
	<div class="container1">		
			<?php } ?>
			
            
			
		<div class="row">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
        
		
	</div>
	<?php if($this->Session->read('User')) { ?>
		<!----- footer code here ---------------------------------->
		<footer>
			<div style="display:block;width:100%;height:150px;background:#cc571f;bottom:0px;text-align:center">			
				<?php echo $this->Html->image('footer-logo.jpg'); ?>
				<!--<p class="pull-right"><a href="#">Back to top</a></p>
				<p>&copy; <?php echo date('Y'); ?> Company, Inc.<a href="#">Privacy</a> | <a href="#">Terms</a></p>-->
				
			</div>
		</footer>
	  <!----- footer code ends here ---------------------------------->
	<?php } ?>	
	
	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <!--<![endif]-->

    <!-- Responsive Tabs JS -->

    <script type="text/javascript">
        $(document).ready(function () {
            $('#horizontalTab').responsiveTabs({
                rotate: false,
                startCollapsed: 'accordion',
                collapsible: 'accordion',
                setHash: true,
                /*disabled: [3,4]*/
            });

            $('#start-rotation').on('click', function() {
                $('#horizontalTab').responsiveTabs('active');
            });
            $('#stop-rotation').on('click', function() {
                $('#horizontalTab').responsiveTabs('stopRotation');
            });
            $('#start-rotation').on('click', function() {
                $('#horizontalTab').responsiveTabs('active');
            });
            $('.select-tab').on('click', function() {
                $('#horizontalTab').responsiveTabs('activate', $(this).val());
            });

        });
    </script>
    <!--<![endif]-->
</body>
</html>
