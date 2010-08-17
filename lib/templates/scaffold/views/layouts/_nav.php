<div class="nav">
	<?php foreach(all_controllers() as $controller){ ?>
		<?php link_to(
				Inflector::titleize(str_replace('Controller', '', $controller)), 
				index_path(Inflector::underscore(str_replace('Controller', '', $controller)))
			) 
		?>
	<?php }  ?>
</div>
