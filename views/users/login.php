<?php
$this->Title = 'Вхід на сайт';

?>


<div class="mt-3 mx-auto p-3 border border-dark rounded shadow-sm" style="width: 40%;">
    <h1>LoginPage</h1>
    <?php if(!empty($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?=$errorMessage?>
        </div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="mb-3">
            <label for="emailInput" class="form-label">Логін чи email</label>
            <input type="text" name="login" class="form-control" id="emailInput" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="passwordInput" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" id="passwordInput">
        </div>
        <button type="submit" class="btn btn-primary">Увійти</button>
    </form>
</div>