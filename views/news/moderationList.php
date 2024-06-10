<?php
$this->Title = 'Сторінка модерації';

$page = \core\Core::get()->additionalParam ? max(1, intval(\core\Core::get()->additionalParam)) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$totalNews = \core\Core::get()->db->count('news', ['isVisible' => 0]);

$totalPages = ceil($totalNews / $limit);

$news = \models\News::getAllNews($limit, $offset, true, ['isVisible' => 0], 'date', \core\Core::get()->additionalParam);
?>

<style>
    .news-link {
        text-decoration: none;
        color: inherit;
    }
</style>

<div class="container mt-5">
    <h1 class="mb-4">Підтверження/Редактура новин</h1>
    <div>
        <div class="col-md-8 d-flex flex-row">
            <div class="mb-3">
                <a href="/news/moderationList/ASC" class="btn btn-primary m-1">Показувати запити від найстаріших</a>
            </div>
            <div>
                <a href="/news/moderationList/DESC" class="btn btn-primary m-1">Показувати запити від найшовіших</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8" id="newsList">
            <?php echo $news; ?>
        </div>
    </div>
</div>

<?php if ($totalPages > 1): ?>
    <div class="container mt-3">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="/news/moderationList/<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php echo \models\News::generatePagination($page, $totalPages, '/oss/news/moderationList/'); ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="/news/moderationList/<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
<?php endif; ?>
