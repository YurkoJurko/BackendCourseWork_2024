<?php
if (!is_null(\core\Core::get()->additionalParam)) {
    $commentID = \core\Core::get()->additionalParam;
    if (!is_null(\models\Comments::findByID($commentID))) {
        \models\Comments::deleteById($commentID);
        echo "<div class='alert alert-success' role='alert'>";
        echo "<strong>Коментар успішно видалено!</strong>";
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
    }, 2500);
</script>


