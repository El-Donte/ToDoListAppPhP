<?php require_once VIEWS . '/components/header.php'; ?>
<style>
    .transparent-header {
        background-color: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(5px);
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
    body{
        background: url('https://images.unsplash.com/photo-1480497490787-505ec076689f?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D ') no-repeat center center fixed;
        background-size: cover; 
    }
</style>
<main class="py-3">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="col-md-5 login-form">
            <h3 class="text-center mb-4">Регистрация</h3>
            <form method="post">
                <div class="mb-3">
                    <label>Логин:</label>
                    <input type="text" name="username" class="form-control" value="<?=old("username")?>">
                    <?= isset($validated) ? $validated->listErrors("Логин"): "" ?>
                </div>

                <div class="mb-3">
                    <label>Пароль:</label>
                    <input type="password" name="password" class="form-control" value="<?=old("password")?>">
                    <?= isset($validated) ? $validated->listErrors("Пароль"): "" ?>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
            </form>
            <hr>
             <p class="mt-3">Уже есть аккаунт? <a href="login">Войти</a></p>
        </div>
    </div>
</main>
<?require_once VIEWS . '/components/footer.php'; 
?>