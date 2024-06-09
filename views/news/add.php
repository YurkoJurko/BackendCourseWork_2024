<?php
$this->Title = 'Додавання новини';
if(\core\Core::get()->session->get('user')->role !== "admin" && \core\Core::get()->session->get('user')->role !== "moderator")
    \core\Core::get()->controllerObject->redirect('/layouts/error');
?>

</head>
<body style="height: 100vh;        background-color: #f8f9fa;
        font-family: Arial, sans-serif">
<div class="d-flex justify-content-center">
    <div class="form-container" style="width: 100%;
        max-width: 800px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h1>Додавання новини</h1>
        <form action="" method="POST" enctype="multipart/form-data" id="newsForm">
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок новини</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Текст новини</label>
                <textarea class="form-control" id="text" name="text" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="shortText" class="form-label">Короткий текст для відображення в пошуку</label>
                <textarea class="form-control" id="shortText" name="shortText" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label for="pictures" class="form-label">Зображення</label>
                <div id="fileInputs">
                    <input type="file" class="form-control mb-2" name="pictures[]" accept="image/*"
                           onchange="addFileInput(this)">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<script>
    function addFileInput(input) {
        if (input.files.length > 0) {
            const fileInputsDiv = document.getElementById('fileInputs');
            const newFileInput = document.createElement('input');
            newFileInput.type = 'file';
            newFileInput.name = 'pictures[]';
            newFileInput.classList.add('form-control', 'mb-2');
            newFileInput.accept = 'image/*';
            newFileInput.onchange = function () {
                addFileInput(newFileInput);
            };
            fileInputsDiv.appendChild(newFileInput);
        }
    }
</script>
