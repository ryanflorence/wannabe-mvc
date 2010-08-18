<?php echo "<?php" ?> include 'app/views/layouts/_header.php' ?>

<h2>Edit <?php echo $humanized_singular ?></h2>

<form action="<?php echo "<?php" ?> echo update_path($this-><?php echo $singular ?>) ?>" method="post">
	<?php echo "<?php" ?> include 'app/views/<?php echo $plural ?>/_form.php'; ?>
	<input type="submit" value="Update">
</form>

<p class="actions">
	[ <a href="<?php echo "<?php" ?> echo $_SERVER['HTTP_REFERER'] ?>">« back</a> | 
	<?php echo "<?php" ?> link_to('index', index_path('<?php echo $plural ?>')); ?> ]
</p>

<?php echo "<?php" ?> include 'app/views/layouts/_footer.php' ?>
