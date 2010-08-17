<?php echo "<?php"; ?>

class Create<?php echo $model_plural ?> extends Migration {

	public static function up(){
		return self::create_table('<?php echo $plural ?>', array(
			<?php echo $columns; ?>
			
		));
	}
	
	public static function down(){
		return self::drop_table('<?php echo $plural ?>');
	}
	
}