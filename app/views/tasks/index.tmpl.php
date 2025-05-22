<? require_once(COMPONENTS.'/header.php');?>

<main class="py-3">
    <div class="container mt-5">
        <form method="GET" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="custom_date" class="form-label">Дата</label>
                    <input type="date" name="custom_date" id="custom_date" class="form-control bg-light " value="<?= h($_GET['custom_date'] ?? '') ?>">
                </div>

                <div class="col-md-3">
                    <label for="filter" class="form-label">Период</label>
                    <select name="filter" id="filter" class="form-select bg-light ">
                        <option value="">Выберите период</option>
                        <option value="day" <?= ($_GET['filter'] ?? '') === 'day' ? 'selected' : '' ?>>Сегодня</option>
                        <option value="week" <?= ($_GET['filter'] ?? '') === 'week' ? 'selected' : '' ?>>Неделя</option>
                        <option value="month" <?= ($_GET['filter'] ?? '') === 'month' ? 'selected' : '' ?>>Месяц</option>
                        <option value="year" <?= ($_GET['filter'] ?? '') === 'year' ? 'selected' : '' ?>>Год</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="sort_order" class="form-label">Сортировка</label>
                    <select name="sort_order" id="sort_order" class="form-select bg-light ">
                        <option value="">По умолчанию</option>
                        <option value="priority_desc" <?= ($_GET['sort_order'] ?? '') === 'priority_desc' ? 'selected' : '' ?>>Сначала важные</option>
                        <option value="priority_asc" <?= ($_GET['sort_order'] ?? '') === 'priority_asc' ? 'selected' : '' ?>>Сначала обычные</option>
                        <option value="due_date_asc" <?= ($_GET['sort_order'] ?? '') === 'due_date_asc' ? 'selected' : '' ?>>По дате (ближайшие)</option>
                        <option value="due_date_desc" <?= ($_GET['sort_order'] ?? '') === 'due_date_desc' ? 'selected' : '' ?>>По дате (дальние)</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">Применить</button>
                    <a href="/" class="btn btn-secondary">Сбросить</a>
                </div>
            </div>
        </form>
        <?if($tasks):?>
            <?php foreach ($tasks as $task): ?>
                <div class="card mb-3 task-card <?= $task['completed'] ? 'task-completed' : '' ?>">
                    <div class="card-body ">
                        <h5 class="card-title"><?= h($task['title']) ?></h5>
                        <p><strong>Приоритет:</strong> <?= ucfirst(h($task['priority'])) ?></p>
                        <p><strong>Крайний срок:</strong> <?= h($task['due_date']) ?></p>

                        <form method="POST" action="/tasks/complete" class="mb-2">
                            <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="complete-<?= $task['id'] ?>"
                                    onchange="this.form.submit()" <?= $task['completed'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="complete-<?= $task['id'] ?>">
                                    Выполнено
                                </label>
                            </div>
                        </form>
                        
                        <button type="button" class="btn btn-info btn-sm show-task-details"
                                data-bs-toggle="modal"
                                data-bs-target="#taskDetails"
                                id="<?= $task['id'] ?>"
                                title="<?= h($task['title']) ?>"
                                description="<?= h($task['description']) ?>"
                                priority="<?= h($task['priority']) ?>"
                                due-date="<?= h($task['due_date']) ?>">
                            Подробнее
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?require_once(VIEWS.'/tasks/show.tmpl.php')?>

        <?else:?>
            <p>Задач пока нет.</p>
        <?endif;?>
        <?=$pagination->getPageList()?>
</main>
<? require_once(COMPONENTS.'/footer.php');?>