<? if(isset($_SESSION['error'])): ?>
    <div class='alert alert-danger alert-dismissible fade show'>
        <?= $_SESSION['error']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<? endif;?>