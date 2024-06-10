<?php
if (\core\Core::get()->session->get('user')->role === 'moderator') {
    $news = \models\News::updateNewsFields(\core\Core::get()->additionalParam, ['isVisible' => 1]);
    if (!empty($news)) {
        echo "<div class='alert alert-success' role='alert'>";
        echo "<strong>Новину успішно узгоджено!</strong><br>Скоро Вас напрявлять на головну сторінку.";
        echo "</div>";
        echo "<div class='d-flex justify-content-center my-3'>";
        echo "<div class='spinner-border' role='status'>";
        echo "</div>";
        echo "</div>";
    }
}
?>

<script>
    setTimeout(function () {
        window.location.href = "/site/index";
    }, 5000);
</script>
