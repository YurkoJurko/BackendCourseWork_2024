<?php
/** @var string $Title */
/** @var string $Content */
/** @var string $picture */

$user = \core\Core::get()->session->get('user') ?? null;

if (empty($Title)) {
    $Title = '';
}
if (empty($Content)) {
    $Content = "";
}
if (!isset($user->username))
    $Username = "Гість";
else
    $Username = $user->username;

$loginState = \models\Users::isUserLogged();


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title><?= $Title ?></title>
</head>
<body>
<div>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/site/index" class="nav-link px-2 link-secondary">Головна сторінка</a></li>
                </ul>

                <?php if (!empty($user->role)): ?>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="/news/add" class="nav-link px-2 link-secondary">Додати новину</a></li>
                    </ul>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="/news/moderationList" class="nav-link px-2 link-secondary">Черга новин</a></li>
                    </ul>
                <?php endif; ?>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <div class="d-flex">
                        <input type="search" class="form-control me-2" placeholder="Пошук..." aria-label="Search">
                        <button type="submit" class="btn btn-primary">Пошук</button>
                    </div>
                </form>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle d-flex flex-column align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= \models\Users::outputProfilePicture($user) . " class='additional-class rounded-circle' style='width: 50px; height: 50px;'" ?>
                    <p><?= $Username ?></p>
                    </a>
                    <ul class="dropdown-menu text-small" style="">
                        <?php if ($loginState): ?>
                            <li><a class="dropdown-item" href="/users/view">Сторінка профілю</a></li>
                        <?php endif; ?>

                        <?php if (!$loginState): ?>
                            <li><a class="dropdown-item" href="/users/login">Увійти</a></li>
                            <li><a class="dropdown-item" href="/users/register">Зареєструватись</a></li>
                        <?php endif; ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php if ($loginState): ?>
                            <li><a class="dropdown-item" href="/users/logout">Вийти з акаунту</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</div>

<div>
    <?= $Content ?>
</div>

<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <span class="mb-3 mb-md-0 text-body-secondary">© 2024 Ihnatyuck Yurii</span>
        </div>
    </footer>
</div>
</body>
</html>
