<?php
require_once 'helpers/class-autoloader.php';

$router = new Router(new HTTPRequest);

/*highlight_string("<?php\n\$data =\n" . var_export($router->route, true) . ";\n?>");
echo "<br><br><br>";
highlight_string("<?php\n\$data =\n" . var_export($_GET, true) . ";\n?>");*/
