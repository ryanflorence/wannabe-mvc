<?php echo "<?php" ?>


class <?php echo $classname; ?>Controller extends ControllerBase {

	public $controller_name = '<?php echo $name ?>';

<?php foreach($actions as $action){ ?>
	public function <?php echo strtolower($action) ?>() {
		
	}

<?php } ?>
	
}

