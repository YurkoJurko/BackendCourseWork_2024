<?php
$this->Title = 'Керування користувачами';

use models\Users;

$users = Users::findByCondition([]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["deleteUser"])) {
        $userId = $_POST["deleteUser"];
        Users::deleteById($userId);
    } elseif (isset($_POST["saveUser"])) {
        $userId = $_POST["saveUser"];
        $role = $_POST["role"];
        $user = Users::findByID($userId);
        $user['role'] = $role;
        Users::updateUser($user);
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
                    <form method="POST" action="">
                        <select class="form-select role-select" name="role">
                            <option value="selected" <?= $user['role'] === '' ? 'selected' : '' ?>>Empty Role</option>
                            <option value="moderator" <?= $user['role'] === 'moderator' ? 'selected' : '' ?>>Moderator</option>
                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                        <input type="hidden" name="saveUser" value="<?= $user['id'] ?>">
                        <button type="submit" class="btn btn-success m-2">Зберегти</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="deleteUser" value="<?= $user['id'] ?>">
                        <button type="submit" class="btn btn-danger">Видалити</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.save-btn').click(function () {
            let row = $(this).closest('tr');
            let userId = row.find('td:first').text();
            let role = row.find('.role-select').val();

            $.post('update_user_role.php', {
                user_id: userId,
                role: role
            }, function (response) {
                console.log(response);
            });
        });
    });
</script>
</body>
</html>
