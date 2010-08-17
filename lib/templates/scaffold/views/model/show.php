<?php echo "<?php" ?> include 'app/views/layouts/_header.php' ?>

<h2>Showing <?php echo $humanized_singular ?></h2>

<?php echo "<?php" ?> foreach($this-><?php echo $singular ?>->properties as $key => $data){ ?>	
	<p>
		<b><?php echo "<?php" ?> echo $key ?></b>: <?php echo "<?php" ?> echo_html($data['value']); ?>
	</p>
<?php echo "<?php" ?> } ?>

[ <a href="<?php echo "<?php" ?> echo $_SERVER['HTTP_REFERER'] ?>">« Back</a> | 
<?php echo "<?php" ?> link_to('Index', index_path('<?php echo $plural ?>')); ?> |
<?php echo "<?php" ?> link_to('Edit', edit_path($this-><?php echo $singular ?>)); ?> ]
&nbsp; &nbsp; [ <?php echo "<?php" ?> link_to('Delete', delete_path($this-><?php echo $singular ?>)); ?> ]

<?php echo "<?php" ?> include 'app/views/layouts/_footer.php' ?>
