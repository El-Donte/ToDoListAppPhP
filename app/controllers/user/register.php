<?php

global $db;
$title ='Регистрация';

require_once CORE . '/classes/Validater.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $data = loadPOSTData(['username','password']);

    $validator = new Validater();
    
    $rules = [
        'username' => ['required' => true, 'min' => 3, 'max' => 30],
        'password' => ['required' => true, 'min' => 3, 'max' => 50]
    ];
    
    $validated = $validator->validate($data, $rules);

    if (!$validated->hasErrors()) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $db->query($sql, ['username'=>$data['username']]);

        if ($db->find()) 
        {
            $_SESSION['error'] = "Имя пользователя уже занято";
            require_once VIEWS . '/user/register.tmpl.php';
        }
        
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        if($db->query($sql, ['username'=>$data['username'],'password'=>$password])){
            $_SESSION['success'] = "Регистрация успешна";
            redirect("login");
            exit();
        }else{
            $_SESSION['error'] = "Db error";
            require_once VIEWS . '/user/register.tmpl.php';
            exit();
        }
    }else{
        require_once VIEWS . '/user/register.tmpl.php';
        exit();
    }
}
else{
    $validation_errors = $_SESSION['error'] ?? [];
    unset($_SESSION['error']);

    require_once VIEWS . '/user/register.tmpl.php';
}
