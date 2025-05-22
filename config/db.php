<?
return [
    'host'=>'MySQL-8.2',
    'db_name' => 'ToDoListDB',
    'username'=>'root',
    'pass' =>'',
    'charset'=>'utf8',
    'options' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];