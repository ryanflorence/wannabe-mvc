
<?php echo "<?php" ?> foreach($this-><?php echo $singular ?>->properties as $key => $data){ ?>
	<?php echo "<?php" ?> if ($key != 'id' && $key != 'created_at' && $key != 'updated_at'){ ?>
		<p>
			<?php echo "<?php" ?> echo $key ?><br>
			<?php echo "<?php" ?> form_field_for('<?php echo $singular ?>', $key, $data) ?>
		</p>
	<?php echo "<?php" ?> } ?>
<?php echo "<?php" ?> } ?>
