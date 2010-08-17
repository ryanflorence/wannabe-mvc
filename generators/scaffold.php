<?php

// keep argv around
$argvc = $argv;

// inflect the model for the templates
$singular       = array_shift($argvc);
$plural         = Inflector::pluralize($singular);
$model_singular = Inflector::classify($singular);
$model_plural   = Inflector::pluralize($model_singular);


$names = array(
	'singular'           => $singular,
	'plural'             => $plural,
	'model_singular'     => $model_singular,
	'model_plural'       => $model_plural,
	'humanized_singular' => Inflector::humanize($singular),
	'humanized_plural'   => Inflector::humanize($plural)
);


require_once('framework/lib/scaffold/migration.php');
require_once('framework/lib/scaffold/controller.php');
require_once('framework/lib/scaffold/views.php');
require_once('framework/lib/scaffold/model.php');

write_file("app/helpers/$plural" . "_helper.php", "<?php\n\n// Add helper methods here for your views");
