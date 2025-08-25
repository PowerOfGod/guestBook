<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body {
            background: url('img/168232-battlefield_2042-battlefield_1-ekshn_igra-voda-podzemnye_vody-1920x1080.jpg');
            background-repeat: no-repeat;
            background-position: top center;
            background-size: cover;
            background-attachment: fixed;
        }

        .alert::before {
            content: '';
            position: absolute;
            border: 8px solid transparent;
            border-bottom: 12px solid #333;
            top: -20px;
            left: 10px;
        }

        .alert {
            display: inline-block;
        }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-5">
                  <?php
                        include 'foo.php';
                        
                        if ($stmt && $stmt->rowCount() > 0) {
                            while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
                                $date = date('d.m.Y H:i', strtotime($user['created_at']));
                                
                                echo '
                                <div class="message-container">
                                    <div class="user-badge">
                                        <span class="badge bg-warning bg-pill">' . htmlspecialchars($user['name']) . '</span>
                                        <small class="text-muted ms-2">' . $date . '</small>
                                    </div>
                                    <div class="alert alert-success mt-3 p-1">' . nl2br(htmlspecialchars($user['text'])) . '</div>
                                </div>';
                            }
                        } else {
                            echo '<div class="alert alert-info text-center">Пока нет сообщений. Будьте первым!</div>';
                        }
                        ?>
                    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
                        <div class="form-group">
                            <small>Введите имя</small>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <small>Введите сообщение</small>
                            <textarea class="form-control" rows="3" name="txt" id="form"></textarea>
                            <button class="btn btn-success mt-3" type="submit">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>