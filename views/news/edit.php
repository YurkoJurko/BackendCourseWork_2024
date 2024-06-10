<?php
$this->Title = 'Редагування новини';

$news = \models\News::findByID(\core\Core::get()->additionalParam);

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <title><?= $this->Title ?></title>
</head>
<body style="height: 100vh; background-color: #f8f9fa; font-family: Arial, sans-serif">
<div class="d-flex justify-content-center">
    <div class="form-container" style="width: 100%; max-width: 800px; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <?php if(!empty($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $errorMessage ?>
            </div>
        <?php endif; ?>
        <h1>Редагування новини</h1>
        <form action="" method="POST" enctype="multipart/form-data" id="newsForm">
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок новини</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $news['title'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Текст новини</label>
                <textarea class="form-control" id="text" name="text" rows="4" required><?= $news['text'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="shortText" class="form-label">Короткий текст для відображення в пошуку</label>
                <textarea class="form-control" id="shortText" name="shortText" rows="2"><?= $news['shortText'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Зберегти зміни</button>
        </form>
    </div>
</div>
</body>
</html>
