<?php 

use Core\Database;
$config = require base_path('config.php');

$db=new Database($config['database']);

$group_name = $_POST['name'];
$group_id = $_POST['id'];
// print_r($group_name);
// die();

$db->query('UPDATE expense_categories set name = :groupName where id= :id',[
    'groupName'=> $group_name,
    'id'=>$group_id,
]);

header('location: /');
exit();

?>