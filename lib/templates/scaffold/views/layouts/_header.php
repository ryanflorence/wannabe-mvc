<!DOCTYPE html>
<html>
<head>
	<meta http-equiv=Content-type content="text/html; charset=utf-8">
	<title><?php echo "<?php" ?> echo $this->controller_name ?>::<?php echo "<?php" ?> echo $this->action_name ?></title>
	<link rel="stylesheet" href="/css/scaffold.css" type="text/css" media="screen" title="no title" charset="utf-8">

</head>
<body>

<?php echo "<?php" ?> include 'app/views/layouts/_nav.php'; ?>

<?php echo "<?php" ?> if (check_flash('notice')){ ?>
	<p class="notice"><?php echo "<?php" ?> echo flash('notice'); ?></p>
<?php echo "<?php" ?> } ?>
