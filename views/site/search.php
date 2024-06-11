<?php
$this->Title = 'Пошук';
$searchQuery = \core\Core::get()->controllerObject->post->searchQuery;

?>

<style>
    .news-link {
        text-decoration: none;
        color: inherit;
    }
</style>

<div class="container mt-5">
    <h1 class="mb-4">Результати пошуку</h1>

    <div class="row">
        <div class="col-md-8" id="newsList">
                <?= \models\News::searchNewsByTitle($searchQuery); ?>
        </div>
    </div>
</div>

