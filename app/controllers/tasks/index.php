<?
global $db;
require_once CLASSES.'/Pagination.php';

$title = "Список задач";
$header="Задачи";

if (!isset($_SESSION['user_id'])) {
    redirect('/login');
}

$custom_date = $_GET['custom_date'] ?? '';
$user_id = $_SESSION['user_id'];
$filter = $_GET['filter'] ?? '';
$sort_order = $_GET['sort_order'] ?? '';

if($custom_date != '')
{
    $_GET['filter'] = '';
    $where = "AND due_date = '".$custom_date."'";
}
else
{
    switch ($filter) {
        case 'day': 
            $where = "AND due_date = CURDATE()"; 
            break;
        case 'week': 
            $where = "AND due_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
            break;
        case 'month': 
            $where = "AND YEAR(due_date) = YEAR(CURDATE()) AND MONTH(due_date) = MONTH(CURDATE())"; 
            break;
        case 'year': 
            $where = "AND YEAR(due_date) = YEAR(CURDATE())"; 
            break;
        default: 
            $where = '';
            break;
    }
}

switch ($sort_order) 
{
    case 'priority_desc':
        $orderBy= " ORDER BY priority DESC";
        break;

    case 'priority_asc':
        $orderBy = " ORDER BY priority ASC";
        break;

    case 'due_date_asc':
        $orderBy = " ORDER BY due_date ASC";
        break;

    case 'due_date_desc':
        $orderBy = " ORDER BY due_date DESC";
        break;

    default:
        $orderBy = " ORDER BY due_date ASC";
        break;
}


$sql = "SELECT COUNT(*) FROM tasks WHERE user_id = $user_id $where $orderBy";

$total = (int)$db->query($sql, )->getColumn();

$per_page = 5;

$page = $_GET['page'] ?? 1;

$pagination = new Pagination($page,$per_page,$total);

$pages_count = $pagination->getPagesCount();

$start_elem = ($page - 1) * $per_page;

$sql ="SELECT * FROM tasks WHERE user_id = $user_id $where $orderBy LIMIT $start_elem, $per_page";
$tasks = $db->query($sql)->findAll();

require_once(VIEWS.'/tasks/index.tmpl.php')
?>