<?php
$newsId = \core\Core::get()->additionalParam;

$news = \models\News::findByID($newsId);
$this->Title = $news['title'];
$author = \models\Users::findByID($news['postedBy']);
$pictures = \models\Pictures::findByCondition(['newsId' => $newsId]);
$user = \core\Core::get()->session->get('user');
?>
<div class="container mt-5">
    <div class="news-details">
        <h1><?= $news['title'] ?></h1>
        <p><?= $news['shortText'] ?></p>
    </div>

    <div class="w-50 align-content-center mt-5">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php if (!empty($pictures)): ?>
                    <?php foreach ($pictures as $index => $picture): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <img src="data:image/jpeg;base64,<?= base64_encode($picture['picture']) ?>" class="d-block w-100" alt="Image <?= $index + 1 ?>"/>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="carousel-item active">
                        <h1>Тут могли бути картиночки, але відповідальний їх не виставив</h1>
                    </div>
                <?php endif; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="news-details">
        <p><h3><?= $news['text'] ?></h3></p>
        <p><strong>Новина від:</strong> <?= $news['date'] ?></p>
        <p><strong>Автор:</strong> <?= $author['username'] ?></p>
    </div>

    <?php if ($user && ($user->role === "admin" || $user->role === "moderator")) : ?>
        <a href='/news/edit/<?= $news['id'] ?>'>
            <button type='button' class='btn btn-primary edit-button m-1'>Змінити</button>
        </a>
        <br>
        <a href='/news/delete/<?= $news['id'] ?>'>
            <button type='button' class='btn btn-primary btn-danger m-1'>Видалити новину</button>
        </a>
        <br>
        <?php if ($news['isVisible'] === 0) : ?>
            <a href='/news/submit/<?= $news['id'] ?>'>
                <button type='button' class='btn btn-success submit-button m-1'>Узгодити</button>
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <div class="mt-5">
        <h3>Коментарі</h3>
        <?php if ($user): ?>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="commentText" class="form-label">Залиш коментар:</label>
                    <textarea class="form-control" id="commentText" name="commentText" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Надіслати коментар</button>
            </form>
        <?php else: ?>
            <p>Будь ласка, увійдіть, щоб залишити коментар.</p>
        <?php endif; ?>

        <div class="comments mt-4">
            <?= \models\Comments::getCommentHtmlByNewsId($newsId) ?>
        </div>
    </div>
</div>
