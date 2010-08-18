<?php echo "<?php" ?> include 'app/views/layouts/_header.php' ?>

<h2>Showing <?php echo $humanized_singular ?></h2>

<?php echo "<?php" ?> foreach($this-><?php echo $singular ?>->properties as $key => $data){ ?>	
	<p>
		<b><?php echo "<?php" ?> echo $key ?></b>: <?php echo "<?php" ?> h($data['value']); ?>
	</p>
<?php echo "<?php" ?> } ?>

<p class="actions">
	[ <a href="<?php echo "<?php" ?> echo $_SERVER['HTTP_REFERER'] ?>">« back</a> | 
	<?php echo "<?php" ?> link_to('index', index_path('<?php echo $plural ?>')); ?> |
	<?php echo "<?php" ?> link_to('edit', edit_path($this-><?php echo $singular ?>)); ?> ]
	&nbsp; &nbsp; [ <?php echo "<?php" ?> ($this-><?php echo $singular ?>->active == '1') ? link_to('delete', delete_path($this-><?php echo $singular ?>)) : link_to('destroy', destroy_path($this-><?php echo $singular ?>), array('class' => 'destroy')); ?> ]
</p>

<?php echo "<?php" ?> include 'app/views/layouts/_footer.php' ?>
