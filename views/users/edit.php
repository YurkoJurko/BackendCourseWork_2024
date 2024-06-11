<?php
$user = \core\Core::get()->session->get('user');
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <style>
        .gradient-custom-2 {
            background: #fbc2eb;
            background: -webkit-linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));
            background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1))
        }
    </style>
</head>
<body>
<section class="gradient-custom-2">
    <div class="container mt-5 p-5">
        <?php if(!empty($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?=$errorMessage?>
            </div>
        <?php endif; ?>
        <h2>Edit User</h2>
        <div class="p-5">
            <form method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_profile">

                <div class="mb-3">
                    <label for="username" class="form-label">Ім'я користувача</label>
                    <input type="text" class="form-control" id="username" name="username"
                           value="<?= $user->username ?>" required>
                </div>

                <div class="mb-3">
                    <label for="login" class="form-label">Логін</label>
                    <input type="text" class="form-control" id="login" name="login"
                           value="<?= $user->login ?>" required>
                </div>

                <div class="mb-3">
                    <label for="profilePicture" class="form-label">Змінити фото профілю</label>
                    <input type="file" class="form-control" id="profilePicture" name="profilePicture">
                </div>

                <button type="submit" class="btn btn-primary">Зберегти зміни</button>
            </form>
        </div>

        <div class="p-5">
            <form method="post" action="">
                <input type="hidden" name="action" value="change_password">

                <div class="mb-3">
                    <label for="currentPas" class="form-label">Нинішній пароль</label>
                    <input type="password" class="form-control" id="currentPas" name="currentPas" required>
                </div>
                <div class="mb-3">
                    <label for="newPas1" class="form-label">Новий пароль</label>
                    <input type="password" class="form-control" id="newPas1" name="newPas1" required>
                </div>
                <div class="mb-3">
                    <label for="newPas2" class="form-label">Повторіть новий пароль</label>
                    <input type="password" class="form-control" id="newPas2" name="newPas2" required>
                </div>

                <button type="submit" class="btn btn-primary">Змінити пароль</button>
            </form>
        </div>
    </div>
</section>

