<?php 
use Core\Database;

$config  = require base_path('config.php');
$db = new Database($config['database']);



// fetch groups:
$db = new Database($config['database']);
$groups = $db->query("SELECT * FROM expense_categories")->get();

// fetching expenses:
$expenses = $db->query("
    SELECT expense.id, expense.expense_name, expense.amount, expense.created_at, expense_categories.name AS group_name
    FROM expense
    JOIN expense_categories ON expense.group_id = expense_categories.id
    ORDER BY expense.created_at DESC
")->get();


// find() returns associative array over here
// calculate expense amount using aggregate functions.
$totalExpense=$db->query("SELECT SUM(amount) AS total_expense FROM expense")->find();

$maxExpense=$db->query("SELECT MAX(amount) AS max_expense FROM expense
where MONTH(date) = MONTH(CURRENT_DATE());")->find();

$thisMonth=$db->query("SELECT SUM(amount) AS total_this_month 
FROM expense
WHERE MONTH(date) = MONTH(CURRENT_DATE()) 
AND YEAR(date) = YEAR(CURRENT_DATE());")->find();

// print_r($totalExpense);
// print_r($maxExpense);
// print_r($thisMonth);
// die();


views("index.view.php",[
    'groups'=>$groups,
    'expenses'=>$expenses,
    'totalExpense' => $totalExpense['total_expense'] ?? 0,
    'maxExpense' => $maxExpense['max_expense'] ?? 0,
    'thisMonth' => $thisMonth['total_this_month'] ?? 0,

]);


?>