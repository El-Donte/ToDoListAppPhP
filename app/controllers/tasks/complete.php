<?php

global $db;
$title='complete';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['task_id'] ?? null;
    $task = $db->query("SELECT * FROM tasks WHERE id = :id", ['id' => $id])->find();

    if (!$task) {
        $_SESSION['error'] = 'задача не найдена';
        redirect("/");
    }

    $completed = $task['completed'] ? 0 : 1;
    $db->query("UPDATE tasks SET completed = :completed WHERE id = :id", ['completed'=>$completed,'id'=>$id]);

    redirect("/");
    exit();
}
