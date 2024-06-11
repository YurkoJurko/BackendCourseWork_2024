<?php
if (\core\Core::get()->session->get('user')->role === 'moderator') {
    $news = \models\News::updateNewsFields(\core\Core::get()->additionalParam, ['isVisible' => 1, 'date' => date('Y-m-d H:i:s')]);
    if (!empty($news)) {
        echo "<div class='alert alert-success' role='alert'>";
        echo "<strong>Новину успішно узгоджено!</strong>";
        echo "</div>";
    }
} else echo "виникла помилка у видаленні коментаря";

echo "<div class='alert alert-success' role='alert'> <br>Скоро Вас напрявлять на головну сторінку.";
echo "</div>";
echo "<div class='d-flex justify-content-center my-3'>";
echo "<div class='spinner-border' role='status'>";
echo "</div>";
?>

<script>
    setTimeout(function () {
        window.location.href = "/site/index";
    }, 5000);
</script>
