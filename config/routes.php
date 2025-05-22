<?
$router->get("/",'/tasks/index.php');

$router->get("/tasks/create",'/tasks/create.php');
$router->post("/tasks",'/tasks/store.php');
$router->get("/tasks",'/tasks/show.php');
$router->delete("/tasks",'/tasks/destroy.php');
$router->get("/tasks/update","/tasks/update.php");
$router->post("/tasks/update","/tasks/update.php");
$router->post("/tasks/complete","/tasks/complete.php");

$router->get("/user",'user/user.php');
$router->get('/login', 'user/login.php');
$router->post('/login', 'user/login.php');
$router->get('/register', 'user/register.php');
$router->post('/register', 'user/register.php');
$router->get('/logout', 'user/logout.php');