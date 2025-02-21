
<?php 
use Core\Router;
const BASE_PATH = __DIR__. '/../';
require BASE_PATH. "Core/functions.php";


spl_autoload_register(function ($class){
    
    // replace required to make usage of namespace  properly
    $class = str_replace('\\','/',$class);
    require base_path("{$class}.php");
});









// make object for router class:
$router = new Router();

//now call routes.php to define routes array within router: 

require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI']);
$path = rtrim($uri['path'], '/');
$path = $path ?: '/';

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];


// calling route method from Router class
$router->route($path,$method);
// dd($try);
?>

