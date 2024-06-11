<?php
$this->Title = 'Видалення';

$id = \core\Core::get()->additionalParam;
var_dump($id);
\models\News::deleteById($id);
echo "<div class='alert alert-success' role='alert'>";
echo "<strong>Новину успішно видалено!</strong>";
echo "</div>";


echo "<div class='alert alert-success' role='alert'> <br>Скоро Вас направлять на головну сторінку.";
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
