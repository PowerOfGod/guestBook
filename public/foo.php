<?php
$host = 'MySQL-8.4';
$dbname = 'gbook';
$username = 'root';
$password = '';

$messagesPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Обработка формы
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name']) && !empty($_POST['txt'])) {
        $name = trim($_POST['name']);
        $text = trim($_POST['txt']);

        $sql = "INSERT INTO messages (name, text) VALUES (:name, :text)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name, 'text' => $text]);

        header("Location: " . $_SERVER['SCRIPT_NAME'] . "?page=1");
        exit;
    }

    // Получаем общее количество сообщений
    $countSql = "SELECT COUNT(*) as total FROM messages";
    $countStmt = $pdo->query($countSql);
    $totalMessages = $countStmt->fetch()['total'];
    
    $totalPages = ceil($totalMessages / $messagesPerPage);

    // Получаем сообщения 
    $startFrom = ($page - 1) * $messagesPerPage;
    $sql = "SELECT * FROM messages ORDER BY created_at DESC LIMIT $startFrom, $messagesPerPage";
    $stmt = $pdo->query($sql);

} catch (PDOException $exceptions) {
    echo "Ошибка подключения к базе данных: " . $exceptions->getMessage();
    return null;
}