<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
	CakePhp
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-theme')
;
//		echo $this->Html->css('chatDisplay');
		//echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery-2.0.3.min');
	?>
	
</head>
<body>
	<div id="container">
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<?php #echo $this->element('sql_dump'); ?>
</body>
</html>
