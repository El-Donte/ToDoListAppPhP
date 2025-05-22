<?
global $db;
$title ='Вход в аккаунт';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    $data = loadPOSTData(['username','password']);
    $rules = [
        'username' => ['required' => true, 'min' => 3, 'max' => 30],
        'password' => ['required' => true, 'min' => 3, 'max' => 50]
    ];

    $validater = new Validater();

    $validated = $validater->validate($data,$rules);
    if(!$validated->hasErrors()){
        $sql = "SELECT * FROM users WHERE username = :username";
        $db->query($sql,['username'=>$data['username']]);
        $user = $db->find();
        if ($user && password_verify($data['password'], $user['password'])) 
        { 
            $_SESSION['user_id'] = $user['id'];
            redirect('/');
            exit();
        } 
        else 
        {
            $_SESSION['error'] = "Неверное имя пользователя или пароль";
            require_once VIEWS . '/user/login.tmpl.php';
            exit();
        }
    }else{
        require_once VIEWS . '/user/login.tmpl.php';
        exit();
    }
}

require_once VIEWS . '/user/login.tmpl.php';
