<?php echo "<?php" ?> include 'app/views/layouts/_header.php' ?>

<h2>New <?php echo $humanized_singular ?></h2>
<form action="/?controller=<?php echo $plural ?>&amp;action=create" method="post">
	<?php echo "<?php" ?> include 'app/views/<?php echo $plural ?>/_form.php'; ?>
	<input type="submit" value="Create">
</form>

<?php echo "<?php" ?> include 'app/views/layouts/_footer.php' ?>