<?php
$this->Title = 'news view';

$newsId = \core\Core::get()->additionalParam;

$news = \models\News::findByID($newsId);
$author = \models\Users::findByID($news['postedBy']);
$pictures = \models\Pictures::findByCondition(['newsId' => $newsId]);

?>
<div class="container mt-5">
    <div class="news-details">
        <h1><?= $news['title'] ?></h1>
        <p><?= $news['shortText'] ?></p>
    </div>

    <div class="w-75 align-content-center mt-5">
        <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel" data-mdb-carousel-init>
            <div class="carousel-inner">
                <?php if (!empty($pictures)): ?>
                    <?php foreach ($pictures as $index => $picture): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <img src="data:image/jpeg;base64,<?= base64_encode($picture['picture']) ?>"
                                 class="d-block w-100" alt="Image <?= $index + 1 ?>"/>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="carousel-item active">
                        <h1>Тут могли бути картиночки, але відповідальний їх не виставив</h1>
                    </div>
                <?php endif; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleControls"
                    data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleControls"
                    data-mdb-slide="next">
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

    <div class="mt-5">
        <h3>Коментарі</h3>
        <form action="" method="post">
            <div class="mb-3">
                <label for="commentText" class="form-label">Залиш коментар:</label>
                <textarea class="form-control" id="commentText" name="commentText" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Надіслати коментар</button>
        </form>

        <div class="comments mt-4">
                <?php echo \models\Comments::getCommentHtmlByNewsId($newsId)?>
        </div>
    </div>
</div>
