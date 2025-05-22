document.querySelectorAll('.show-task-details').forEach(btn => {
    btn.addEventListener('click', function () {
            
            document.getElementById('title').textContent =this.getAttribute('title');
            document.getElementById('description').textContent = this.getAttribute('description');
            document.getElementById('priority').textContent = this.getAttribute('priority');
            document.getElementById('due_date').textContent = this.getAttribute('due-date');
            
            const taskId = this.getAttribute('id');
            const editBtn = document.getElementById('editBtn');
            editBtn.href = `tasks/update?id=${taskId}`;
            document.getElementById('deleteId').value = taskId;
        });
});