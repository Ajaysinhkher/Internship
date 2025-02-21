<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$db->query('INSERT INTO expense (expense_name,amount,date,group_id) values (:expense_name, :amount, :date, :group_id)',[
    'expense_name' => $_POST['expense_name'],
    'amount'=>$_POST['amount'],
    'date'=>$_POST['date'],
    'group_id'=>$_POST['group_id'],
]);

header('location: /');
exit();

?>