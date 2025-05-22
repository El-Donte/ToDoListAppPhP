<? if(isset($_SESSION['success'])): ?>
    <div class='alert alert-success alert-dismissible fade show'>
        <?= $_SESSION['success']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<? endif;?>
