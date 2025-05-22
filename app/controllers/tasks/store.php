<?
global $db;

if (!isset($_SESSION['user_id'])) {
    redirect('/login');
}


if($_SERVER['REQUEST_METHOD'] === "POST"){

    $fillable = ['title','description','priority','due_date'];

    $data = loadPOSTData($fillable);
    $data['user_id'] = $_SESSION['user_id'];

    $rules =[
        'title'=>[
            'required' => true,
            'min' => 5,
            'max' => 25
        ],
        'description'=>[
            'required' => true,
            'min' => 5,
            'max' => 500
        ],
        'priority'=>[
            'required' => true,
        ],
        'due_date'=>[
            'required' => true,
        ]
    ];

    $validater = new Validater();
    $validated = $validater->validate($data,$rules);
    if(!$validated->hasErrors()){
        $sql = "INSERT INTO tasks (user_id, title, description, priority, due_date) VALUES (:user_id,:title, :description, :priority, :due_date)";
        if($db->query($sql,$data)){
            $_SESSION['success'] = 'Задача создана';
        }
        else{
            $_SESSION['error'] = "DB error";
        }
        redirect('/');
    }
    else{
        $_SESSION['error'] = "Ошибка при создании задачи";
        require VIEWS . '/tasks/create.tmpl.php';
    }
}
