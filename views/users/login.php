<?php
$this->Title = 'Вхід на сайт';

?>


<h1>LoginPage</h1>
<div style="margin-top: 3%; margin-left: 30%; margin-right: 30%">
    <form method="post" action="">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Логін чи email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Увійти</button>
    </form>
</div>