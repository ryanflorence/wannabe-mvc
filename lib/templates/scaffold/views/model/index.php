<?php echo "<?php" ?> include 'app/views/layouts/_header.php' ?>
	
	<h2>Listing <?php echo $humanized_plural ?></h2>
	<p>
		<?php echo "<?php" ?> link_to('Add New <?php echo $singular ?>', add_path('<?php echo $plural ?>')) ?>
		<?php echo "<?php" ?> link_to('Deleted <?php echo $humanized_plural ?>', deleted_path('<?php echo $plural ?>')) ?>
	</p>
	<table>
		<thead>
			<tr>
				<?php echo "<?php" ?> foreach($this->headers as $k => $v){ if ($k != 'id' && $k != 'created_at' && $k != 'active' && $k!= 'updated_at'){ ?>
				<th><?php echo "<?php" ?> echo $k ?></th>
				<?php echo "<?php" ?> }} ?>
				<th class="table-th-nosort">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php echo "<?php" ?> foreach($this-><?php echo $plural ?> as $<?php echo $singular ?>){ ?>
			<tr>
				<?php echo "<?php" ?> foreach($<?php echo $singular ?>->properties as $k => $field){ if ($k != 'id' && $k != 'created_at' && $k != 'active' && $k!= 'updated_at'){ ?>
				<td><?php echo "<?php" ?> echo_html(substr($field['value'], 0, 50)); ?></td>
				<?php echo "<?php" ?> }} ?>
				<td class="actions">
					[ <?php echo "<?php" ?> link_to('Show', show_path($<?php echo $singular ?>)) ?> |
					<?php echo "<?php" ?> link_to('Edit', edit_path($<?php echo $singular ?>)) ?> |
					<?php echo "<?php" ?> link_to('delete', delete_path($<?php echo $singular ?>)) ?> ]
				</td>
			</tr>
			<?php echo "<?php" ?> } ?>
		</tbody>
	</table>
	
<?php echo "<?php" ?> include 'app/views/layouts/_footer.php' ?>
