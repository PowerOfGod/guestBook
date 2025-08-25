<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Гостевая книга</title>
    <style>
        body {
            font-size: 16px;
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
    
        .message-container {
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <h1 class="text-white text-center mb-4">Гостевая книга</h1>
                    
                    <?php include 'foo.php'; ?>

                    
                    <?php if ($stmt && $stmt->rowCount() > 0): ?>
                        <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="message-container">
                                <div class="user-badge">
                                    <span class="badge bg-warning bg-pill"><?php echo htmlspecialchars($user['name']); ?></span>
                                    <small class="text-light ms-2"><?php echo date('d.m.Y H:i', strtotime($user['created_at'])); ?></small>
                                </div>
                                <div class="alert alert-success mt-3 p-1"><?php echo nl2br(htmlspecialchars($user['text'])); ?></div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="alert alert-info text-center">Пока нет сообщений. Будьте первым!</div>
                    <?php endif; ?>

                    
                    <?php if (isset($totalPages) && $totalPages > 1): ?>
                        <div style="text-align: center; margin: 20px 0;">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?>" class="btn btn-primary btn-sm">← Назад</a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled>← Назад</button>
                            <?php endif; ?>
                            
                            <span style="margin: 0 15px; color: white;">
                                Страница <?php echo $page; ?> из <?php echo $totalPages; ?>
                            </span>
                            
                            <?php if ($page < $totalPages): ?>
                                <a href="?page=<?php echo $page + 1; ?>" class="btn btn-primary btn-sm">Вперед →</a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled>Вперед →</button>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    
                    <div style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 10px;">
                        <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
                            <div class="form-group mb-3">
                                <label class="text-dark"><small>Введите имя</small></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-dark"><small>Введите сообщение</small></label>
                                <textarea class="form-control" rows="3" name="txt" id="form" required></textarea>
                            </div>
                            <button class="btn btn-success mt-3" type="submit">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>