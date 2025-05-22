<?php

global $db;
$title='destroy';

if (!isset($_SESSION['user_id'])) {
    redirect('/login');
}

$id = (int)$_POST['id'] ?? 0;

$sql = "DELETE FROM tasks WHERE id = :id AND user_id = :user_id";
$db->query($sql, ['id' => $id, 'user_id' => $_SESSION['user_id']])->find();

if ($db->rowCount()) {
    $resp['answer'] = $_SESSION['success'] = "Задча удалена";
} 
else {
    $resp['answer'] = $_SESSION['error'] = "DB error";
}

redirect("/");
?>


