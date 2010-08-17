<?php 

$view_path = "app/views/$plural";
if(!is_dir($view_path)) mkdir($view_path);
if(!is_dir("app/views/layouts")) mkdir("app/views/layouts");
// layouts
write_file('app/views/layouts/_header.php', template('framework/lib/templates/scaffold/views/layouts/_header.php', $names));
write_file('app/views/layouts/_footer.php', "</body>\n</html>");
write_file('app/views/layouts/_nav.php', file_get_contents('framework/lib/templates/scaffold/views/layouts/_nav.php'));

// model scaffold;
write_file("$view_path/_form.php",   template('framework/lib/templates/scaffold/views/model/_form.php', $names));
write_file("$view_path/add.php",     template('framework/lib/templates/scaffold/views/model/add.php', $names));
write_file("$view_path/deleted.php", template('framework/lib/templates/scaffold/views/model/deleted.php', $names));
write_file("$view_path/edit.php",    template('framework/lib/templates/scaffold/views/model/edit.php', $names));
write_file("$view_path/index.php",   template('framework/lib/templates/scaffold/views/model/index.php', $names));
write_file("$view_path/show.php",    template('framework/lib/templates/scaffold/views/model/show.php', $names));
