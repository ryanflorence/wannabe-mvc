<?php echo "<?php" ?>

class <?php echo $model_plural; ?>Controller extends ControllerBase {

	public $controller_name = '<?php echo $plural ?>';

	function index(){
		$this->headers = YAML::decode_file('db/schemas/<?php echo $plural ?>.yml');
		$this-><?php echo $plural ?> = <?php echo $model_singular ?>::find_all_by('active', 1);
		$this->render();
	}
	
	function show(){
		$this-><?php echo $singular ?> = <?php echo $model_singular ?>::find($_GET['id']);
		$this->render();
	}
	
	function add(){
		$this-><?php echo $singular ?> = new <?php echo $model_singular ?>();
		$this->render();
	}
	
	function create(){
		$<?php echo $singular ?> = new <?php echo $model_singular ?>($_POST['<?php echo $singular ?>']);
		if ($<?php echo $singular ?>->save()) flash('notice', '<?php echo $humanized_singular ?> successfully added');
		$this->redirect_to($<?php echo $singular ?>);
	}
	
	function edit(){
		$this-><?php echo $singular ?> = <?php echo $model_singular ?>::find($_GET['id']);
		$this->render();
	}
	
	function update(){
		$<?php echo $singular ?> = <?php echo $model_singular ?>::find($_GET['id']);
		$<?php echo $singular ?>->set_properties($_POST['<?php echo $singular ?>']);
		if ($<?php echo $singular ?>->save()) flash('notice', '<?php echo $humanized_singular ?> successfully updated');
		$this->redirect_to($<?php echo $singular ?>);
	}
	
	function deleted(){
		$this->headers = YAML::decode_file('db/schemas/<?php echo $plural ?>.yml');
		$this-><?php echo $plural ?> = <?php echo $model_singular ?>::find_all_by('active', 0);
		$this->render();
	}
	
	function delete(){
		$<?php echo $singular ?> = <?php echo $model_singular ?>::find($_GET['id']);
		if ($<?php echo $singular ?>->delete()) flash('notice', '<?php echo $humanized_singular ?> successfully hidden, find it ' . link_to('here', deleted_path('<?php echo $plural ?>'), false) . '.');
		$this->redirect_to(index_path('<?php echo $plural ?>'));
	}
	
	function restore(){
		$<?php echo $singular ?> = <?php echo $model_singular ?>::find($_GET['id']);
		if ($<?php echo $singular ?>->restore()) flash('notice', '<?php echo $humanized_singular ?> successfully restored');
		$this->redirect_to(deleted_path('<?php echo $plural ?>'));
	}

	function destroy(){
		$<?php echo $singular ?> = <?php echo $model_singular ?>::find($_GET['id']);
		if ($<?php echo $singular ?>->destroy()) flash('notice', '<?php echo $humanized_singular ?> successfully destroyed');
		$this->redirect_to(deleted_path('<?php echo $plural ?>'));
	}
	
}

