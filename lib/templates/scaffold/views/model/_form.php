
<?php echo "<?php" ?> foreach($this-><?php echo $singular ?>->properties as $key => $data){ ?>
	<?php echo "<?php" ?> if ($key != 'id' && $key != 'created_at' && $key != 'updated_at'){ ?>
		<p>
			<?php echo "<?php" ?> echo Inflector::humanize($key) ?><br>
			<?php echo "<?php" ?> form_field_for($key, $this-><?php echo $singular ?>) ?>
		</p>
	<?php echo "<?php" ?> } ?>
<?php echo "<?php" ?> } ?>
