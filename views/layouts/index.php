<?php
/** @var string $Title */
/** @var string $Content */
/** @var string $Username */
/** @var string $picture */


if (empty($Title)) {
    $Title = '';
}
if (empty($Content)) {
    $Content = "";
}
if (empty($Username)) {
    $Username = "Гість";
}

$loginState = \models\Users::isUserLogged();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <title> <?= $Title ?>  </title>
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

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control" placeholder="Пошук..." aria-label="Search">
                </form>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="" alt="User Picture" width="32" height="32" class="rounded-circle">
                    </a>
                    <p> <?= $Username ?> </p>
                    <ul class="dropdown-menu text-small" style="">
                        <li><a class="dropdown-item" href="/users/view">Сторінка профілю</a></li>
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
