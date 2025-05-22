<?
global $db;

$title='update';

if (!isset($_SESSION['user_id'])) {
    redirect('/login');
}

require_once CLASSES . "/Validater.php";

$id = (int)($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $sql = "SELECT * FROM tasks WHERE id = :id AND user_id = :user_id";
    $task = $db->query($sql, ['id' => $id, 'user_id' => $_SESSION['user_id']])->findOrAbort();
    $title = "Редактирование задачи";
    require_once VIEWS . "/tasks/update.tmpl.php";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
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
    
    $data['id'] = $id;
    $task = $data;
    if(!isset($task['priority'])){
        $task['priority'] = '';
    }
   
    if ($validated->hasErrors()) {
        $title = "Редактирование задачи";
        require_once VIEWS . "/tasks/update.tmpl.php";
        return;
    }

    try {
        $sql = "UPDATE tasks SET title = :title, description = :description, priority = :priority, due_date = :due_date WHERE id = :id AND user_id = :user_id";
        if ($db->query($sql,  $data)) {
            $_SESSION['success'] = "Задача успешно обновлена";     
        } 
        else {
            throw new Exception("Failed to update task");
        }

        redirect("/");
    } catch (Exception $e) {

        $_SESSION['error'] = "Ошибка при обновлении задачи: " . $e->getMessage();
        require_once VIEWS."/tasks/update.tmpl.php";
    }
}
