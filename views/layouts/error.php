<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h1 {
            font-size: 50px;
            margin-bottom: 20px;
        }
        p {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .spinner-border {
            width: 3rem;
            height: 3rem;
            margin-bottom: 20px;
        }
        .error-container {
            max-width: 500px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="error-container">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <h1>Error 404</h1>
    <p>Сторінка, до якої ви намагались отримати доступ - не існує</p>
    <p>Протягом 10 секунд, Вас перенесе на головну сторінку, у випадку помилки - натисніть на кнопку нижче</p>
    <a href="/site/index" class="btn btn-primary">Повернутись на головну сторінку</a>
</div>

<script>
    setTimeout(function() {
        window.location.href = "/site/index";
    }, 10000);
</script>

</body>
</html>
