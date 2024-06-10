<?php
$this->Title = 'Головна сторінка';

function generatePagination($currentPage, $totalPages)
{
    $pagination = '';
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = ($currentPage == $i) ? 'active' : '';
        $pagination .= "<li class='page-item {$activeClass}'><a class='page-link' href='oss/site/index/{$i}'>{$i}</a></li>";
    }
    return $pagination;
}

$page = \core\Core::get()->additionalParam ? max(1, intval(\core\Core::get()->additionalParam)) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$totalNews = \core\Core::get()->db->count('news', ['isVisible' => 1]);

$totalPages = ceil($totalNews / $limit);


$news = \models\News::getAllNews($limit, $offset);

?>

<div class="container mt-5">
    <h1 class="mb-4">Site Index</h1>
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
                <?php echo generatePagination($page, $totalPages); ?>
            </ul>
        </nav>
    </div>
<?php endif; ?>
