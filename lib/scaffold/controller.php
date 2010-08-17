<?php 

$contents = template('framework/lib/templates/scaffold/controller.php', $names);
write_file("app/controllers/$plural"."_controller.php", $contents);