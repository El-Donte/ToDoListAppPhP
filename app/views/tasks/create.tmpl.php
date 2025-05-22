<? require_once(COMPONENTS.'/header.php');?>
<main class="py-3">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4>Добавить новую задачу</h4>
                    </div>
                    <div class="card-body">
                        <form action="/tasks" method="post">
                            <div class="form-group mb-3">
                                <label class="form-label">Название:</label>
                                <input type="text" name="title" class="form-control"  value="<?=old("title")?>">
                                <?= isset($validated)? $validated->listErrors("Название"): "" ?>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="form-label">Описание:</label>
                                <textarea name="description" class="form-control"><?=old("description")?></textarea>
                                <?= isset($validated) ? $validated->listErrors("Описание") : "" ?>
                            </div>

                            <div class="form-group mb-3">
                                <label>Приоритет:</label>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-danger <?= old('priority') === 'Важный' ? 'active' : '' ?>">
                                        <input type="radio" name="priority" value="Важный" <?= old('priority') === 'Важный' ? 'checked' : '' ?>> Важный
                                    </label>
                                    <label class="btn btn-warning <?= old('priority') === 'Обычный' ? 'active' : '' ?>">
                                        <input type="radio" name="priority" value="Обычный"<?= old('priority') === 'Обычный' ? 'checked' : '' ?>> Обычный
                                    </label>
                                    <label class="btn btn-success <?= old('priority') === 'Повседневный' ? 'active' : '' ?>">
                                        <input type="radio" name="priority" value="Повседневный" <?= old('priority') === 'Повседневный' ? 'checked' : '' ?>> Повседневный
                                    </label>
                                </div>
                                <?= isset($validationResult) ? $validationResult->listErrors("priority") : "" ?>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Дата завершения:</label>
                                <input type="date" name="due_date" class="form-control" value="<?=old("due_date")?>">
                                <?= isset($validated) ? $validated->listErrors("Дата завершения") : "" ?>
                            </div>

                            <button type="submit" class="btn btn-success">Создать</button>
                            <a href="/" class="btn btn-secondary">Отмена</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<? require_once(COMPONENTS.'/footer.php');?>