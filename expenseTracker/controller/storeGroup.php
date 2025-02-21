<?php
// dd($_POST);
use Core\Database;
use Core\Validator;

$config = require base_path('config.php');


// making a database object to start the coonection using database class:
$db = new Database($config['database']);

$group_name = $_POST['group_name'];

// validation:

// initaialize a error array 

// if(!Validator :: required($group_name));
// {
//     $errors[] = "Group name is required";
// }


// if(!empty($errors))
// {
//     $_SESSION['errors'] = $errors;
//     header("Location: /addGroup");
//     exit();
// }


$db->query("INSERT INTO expense_categories (name) values (:name)",[
    ':name'=> $group_name,

]);


// echo '<pre>';

// print_r($result);
// echo '</pre>';

header('location: /');
exit();
?>