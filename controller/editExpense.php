<?php
use Core\Database;
$config = require base_path('config.php');

$db = new Database($config['database']);

$expense_name = $_POST['name'];
$expense_id = $_POST['id'];
$expense_amount = $_POST['amount'];


// print_r($expense_name);
// print_r($expense_id);
// print_r($expense_amount);
// die();

$try = $db->query('UPDATE expense set expense_name = :name, amount = :amount where id =:id' ,[
    'name'=>$expense_name ,
    'id'=>$expense_id,
    'amount'=>$expense_amount,
]);

// dd($try);
header('location: /');
exit();
?>