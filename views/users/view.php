<?php
$userID = \core\Core::get()->additionalParam;

$user = \models\Users::findByID($userID);
$commentCount = \core\Core::get()->db->count('comments', ['userID' => $userID]);
$newsCount = \core\Core::get()->db->count('news', ['postedBy' => $userID]);
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .gradient-custom-2 {
            background: #fbc2eb;
            background: -webkit-linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));
            background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1))
        }
    </style>
</head>

<body>

<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center">
            <div class="col col-lg-9 col-xl-8">
                <div class="card">
                    <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                        <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                            <?= \models\Users::outputProfilePicture($user) . " class='additional-class' style='width: 100px; height: 100px;'" ?>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-dark text-body" data-mdb-ripple-color="dark" style="z-index: 1;">
                                Edit profile
                            </button>
                        </div>
                        <div class="ms-3" style="margin-top: 130px;">
                            <h5> <?= $user['username'] ?></h5>
                        </div>
                    </div>
                    <div class="p-4 text-black bg-body-tertiary">
                        <div class="d-flex justify-content-end text-center py-1 text-body">
                            <div>
                                <p class="mb-1 h5"><?= $commentCount ?></p>
                                <p class="small text-muted mb-0">Коментарів</p>
                            </div>
                            <div class="px-3">
                                <p class="mb-1 h5"><?= $newsCount ?></p>
                                <p class="small text-muted mb-0">Новин викладено</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 text-black">
                        <div class="mb-5 text-body">
                            <p class="lead fw-normal mb-1">Recent comments</p>
                            <!-- Add your recent comments section content here -->
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4 text-body">
                            <p class="lead fw-normal mb-0">Recent news</p>
                            <!-- Add your recent news section content here -->
                            <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>

</html>
