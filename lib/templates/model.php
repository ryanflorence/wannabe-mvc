<?php echo "<?php"; ?>

class <?php echo $model_singular ?> extends ModelBase {
	
	
	
	// Have to have this since PHP < 5.3 is weak sauce
	public $table = '<?php echo $plural ?>';
	public static function find($arg){ return parent::find('<?php echo $plural ?>', $arg);	}
	public static function find_all_by($field, $value, $extra = ''){ return parent::find_all_by('<?php echo $plural ?>', $field, $value, $extra); }

}
