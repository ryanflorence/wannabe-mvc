<?php 

$contents = template('framework/lib/templates/model.php', $names);
write_file("app/models/$singular.php", $contents);
