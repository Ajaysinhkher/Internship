<?php 
$router->get('/','controller/index.php');
$router->post('/addGroup','controller/storeGroup.php');
$router->delete('/deleteGroup','controller/deleteGroup.php');

$router->post('/addExpense','controller/storeExpense.php');
$router->delete('/deleteExpense','controller/deleteExpense.php');
$router->patch('/editGroup','controller/editGroup.php');
$router->patch('/editExpense','controller/editExpense.php');

?>