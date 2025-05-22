<?

function dump($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function dd($data)
{
    dump($data);
    die;
}

function abort($err = 404)
{
    http_response_code($err);
    require_once VIEWS."/errors/{$err}.php";
}

function loadPOSTData($fillable = [])
{
    $data =[];

    foreach($_POST as $key => $value)
    {
        if(in_array($key, $fillable))
        {
            $data[$key] = trim($value);
        }
    }

    return $data;
}

function old($fillname)
{
    return isset($_POST[$fillname]) ? h($_POST[$fillname]) : '';
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function strl($str)
{
    return mb_strlen($str,'UTF-8');
}

function redirect($path='')
{
    if($path)
    {
        $redirect = $path;
    }
    else
    {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    
    header("Location: {$redirect}");
    die;
}

function get_alerts()
{
    if(isset($_SESSION['success']))
    {
        require_once VIEWS.'/components/alert-success.php';
        unset($_SESSION['success']);
    }
    if(isset($_SESSION['error']))
    {
        require_once VIEWS.'/components/alert-error.php';
        unset($_SESSION['error']);
    }
}