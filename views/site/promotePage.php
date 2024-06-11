<?php
$this->Title = 'Керування користувачами';

use models\Users;

$users = Users::findByCondition([]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json');

    $requestData = json_decode(file_get_contents('php://input'), true);

    if (isset($requestData["deleteUser"])) {
        $userId = $requestData["deleteUser"];
        Users::deleteById($userId);
        echo json_encode(['status' => 'success', 'message' => 'Користувача успішно видалено!']);
        exit();
    }

    elseif (isset($requestData["saveUser"])) {
        $userId = $requestData["saveUser"];
        $role = $requestData["role"];
        $user = Users::findByID($userId);
        $user['role'] = $role;
        Users::updateUser($user);
        echo json_encode(['status' => 'success', 'message' => 'Роль користувача успішно оновлено!']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Керування користувачами</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <h1>Керування користувачами</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ім'я користувача</th>
            <th>Логін</th>
            <th>Пошта</th>
            <th>Роль</th>
            <th>Видалити</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['login'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <form id="form_<?= $user['id'] ?>" class="role-form" method="POST" action="">
                        <select class="form-select role-select" name="role">
                            <option value="" <?= $user['role'] === '' ? '' : 'selected' ?>>Без ролі</option>
                            <option value="moderator" <?= $user['role'] === 'moderator' ? 'selected' : '' ?>>Moderator</option>
                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                        <input type="hidden" name="saveUser" value="<?= $user['id'] ?>">
                        <button type="submit" class="btn btn-success m-2">Зберегти</button>
                    </form>
                </td>
                <td>
                    <form class="delete-form" method="POST" action="">
                        <input type="hidden" name="deleteUser" value="<?= $user['id'] ?>">
                        <button type="submit" class="btn btn-danger">Видалити</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('.role-form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let userId = form.find('input[name="saveUser"]').val();
            let role = form.find('.role-select').val();

            $.ajax({
                type: 'POST',
                url: '',
                contentType: 'application/json',
                data: JSON.stringify({
                    saveUser: userId,
                    role: role
                }),
                success: function (response) {
                    alert(response.message);
                }
            });
        });

        $('.delete-form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let userId = form.find('input[name="deleteUser"]').val();

            $.ajax({
                type: 'POST',
                url: '',
                contentType: 'application/json',
                data: JSON.stringify({
                    deleteUser: userId
                }),
                success: function (response) {
                    alert(response.message);
                    form.closest('tr').remove();
                }
            });
        });
    });
</script>

</body>

</html>
