<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= PATH?>">
    <link rel="stylesheet" href="Assets/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title><?=$title?></title>
</head>
<body class="bg-color">
    <div class="wrapper">
        <header class="header">
            <nav class="navbar navbar-expand-lg bg-light transparent-header">
                <div class="container-fluid container">
                    <a class="navbar-brand mb-0 h1" href="#">Планировщик задач</a>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Задачи</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="tasks/create">Добавить задачу</a>
                                </li>
                            </ul>
                        <?php endif; ?>

                        <ul class="navbar-nav ms-auto">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle me-1"></i>
                                        <?= $_SESSION['username'] ?? 'Пользователь' ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li>
                                            <a class="dropdown-item" href="user"><i class="bi bi-person me-2"></i>Мой профиль</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-right me-2"></i>Выйти</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="login">Войти</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="register">Регистрация</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class = "container">
            <? get_alerts(); ?>
        </div>