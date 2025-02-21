<?php
use Core\Database;
require base_path('Core/Database.php');
$config = require base_path('config.php');
$db = new Database($config['database']);

// Ensure 'id' is set before using it
if (!isset($_POST['id'])) {
    die("Error: ID not provided");
}

// Delete the group
$db->query('DELETE FROM expense_categories WHERE id = :id', ['id' => $_POST['id']]);

// Redirect back to home
header('Location: /');
exit();