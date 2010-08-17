<?php echo "<?php" ?> include 'app/views/layouts/_header.php' ?>

<h2>Edit <?php echo $humanized_singular ?></h2>
<form action="/?controller=<?php echo $plural ?>&amp;action=update&amp;id=<?php echo "<?php" ?> echo $this-><?php echo $singular ?>->id ?>" method="post">
	<?php echo "<?php" ?> include 'app/views/<?php echo $plural ?>/_form.php'; ?>
	<input type="submit" value="Update">
</form>

<?php echo "<?php" ?> include 'app/views/layouts/_footer.php' ?>
