<? require_once(COMPONENTS.'/header.php');?>
<main class="main py-3">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4><?= 'Редактировать задачу'?></h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="tasks/update?id=<?= h($task['id']) ?>" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="title">Название:</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= h($task['title']) ?>">
                                <?= isset($validated)? $validated->listErrors("Название"): "" ?>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">Описание:</label>
                                <textarea class="form-control" id="description"name="description">
                                    <?= h($task['description']) ?>
                                </textarea>
                                <?= isset($validated) ? $validated->listErrors("Описание") : "" ?>
                            </div>

                            <div class="form-group mb-3">
                                <label>Приоритет:</label>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-danger">
                                        <input type="radio" name="priority" value="Важный" <?= $task['priority'] === 'важный' ? 'checked' : '' ?>> Важный
                                    </label>
                                    <label class="btn btn-warning">
                                        <input type="radio" name="priority" value="Обычный" <?= $task['priority'] === 'обычный' ? 'checked' : '' ?>> Обычный
                                    </label>
                                    <label class="btn btn-success">
                                        <input type="radio" name="priority" value="Повседневный" <?= $task['priority'] === 'повседневный' ? 'checked' : '' ?>> Повседневный
                                    </label>
                                </div>
                                <?= isset($validationResult) ? $validationResult->listErrors("priority") : "" ?>
                            </div>

                            <div class="form-group mb-3">
                                <label for="due_date">Дата окончания:</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" value="<?= h($task['due_date']) ?>">
                                <?= isset($validated) ? $validated->listErrors("Дата завершения") : "" ?>
                            </div>

                            <button type="submit" class="btn btn-success">Сохранить</button>
                            <a href="/" class="btn btn-secondary">Отмена</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<? require_once(COMPONENTS.'/footer.php');?>