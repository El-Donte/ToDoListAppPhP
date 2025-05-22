<div class="modal fade" id="taskDetails" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Детали задачи</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                        </div>
                        
                        <div class="modal-body">
                            <h4 id="title" class="mb-3"></h4>
                            <p><strong>Описание:</strong></p>
                            <p id="description" class="mb-3"></p>
                            <p><strong>Приоритет:</strong> <span id="priority"></span></p>
                            <p><strong>Крайний срок:</strong> <span id="due_date"></span></p>
                        </div>

                        <div class="modal-footer">
                            <a href="" id="editBtn" class="btn btn-outline-primary">Редактировать задачу</a>
                            
                            <form action="tasks" method="POST" style="display:inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" id="deleteId" value="">
                                <button type="submit" class="btn btn-outline-danger">Удалить задачу</button>
                            </form>
                            
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>