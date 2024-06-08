<?php
$this->Title = 'Реєстрація на сайт';

$post = $this->controller->post->getAll();
?>


<div class="mt-3 mx-auto p-3 border border-dark rounded shadow-sm" style="width: 40%;">
    <h1>Реєстрація користувача</h1>
    <hr>
    <?php if(!empty($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?=$errorMessage?>
        </div>
    <?php endif; ?>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="usernameInput" class="form-label">Введіть ім'я користувача</label>
            <input value="<?= $this->controller->post->username ?>" type="text" name="username" class="form-control" placeholder="Ім'я яке відображатиметься на сайті" required id="usernameInput" aria-describedby="usernameHelp">
        </div>
        <div class="mb-3">
            <label for="emailInput" class="form-label">Email</label>
            <input value="<?= $this->controller->post->email ?>" type="email" name="email" class="form-control" placeholder="@ztu.edu.ua" required id="emailInput" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="loginInput" class="form-label">Логін</label>
            <input value="<?= $this->controller->post->login?>" type="text" name="login" class="form-control" required id="loginInput" aria-describedby="loginHelp">
        </div>
        <div class="mb-3">
            <label for="passwordInput1" class="form-label">Пароль</label>
            <input type="password" name="password1" class="form-control" required id="passwordInput1">
        </div>
        <div class="mb-3">
            <label for="passwordInput2" class="form-label">Повторіть пароль</label>
            <input type="password" name="password2" class="form-control" required id="passwordInput2">
        </div>
        Фото можна встановити на сторінці профілю
        <hr>
        <button type="submit" class="btn btn-primary">Створити акаунт</button>
    </form>
</div>