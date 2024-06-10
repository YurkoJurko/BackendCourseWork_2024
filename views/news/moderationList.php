<?php
$this->Title = 'Сторінка модерації';

$page = \core\Core::get()->additionalParam ? max(1, intval(\core\Core::get()->additionalParam)) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$unapprovedNews = \models\News::getAllNews($limit, $offset, ['isVisible' => 0]);
?>

<div class="container mt-5">
    <h1 class="mb-4">Модерація новин</h1>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($unapprovedNews as $news): ?>
                    <tr>
                        <td><?php echo $news['title']; ?></td>
                        <td>
                            <form action="oss/news/approve/<?php echo $news['id']; ?>" method="post" style="display: inline;">
                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
                            </form>
                            <a href="oss/news/edit/<?php echo $news['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
