<?php
// Инициализируем массив
$arr = [];

// Имя файла
$file = 'book.txt';

// Создаем файл, если он не существует
if (!file_exists($file)) {
    file_put_contents($file, '');
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = date('d.m.y H:i');
    $name = strip_tags(trim($_POST['name'] ?? ''));
    $text = strip_tags(trim($_POST['txt'] ?? ''));
    
    if (!empty($name) && !empty($text)) {
        // Безопасная запись в файл
        $message = '<div class="badge bg-warning bg-pill">' . htmlspecialchars($name) . ' ' . $data . '</div><br>
                   <div class="alert alert-success mt-3 p-1">' . htmlspecialchars($text) . '</div>
                   <br>';
        
        $f = fopen($file, 'a');
        fputs($f, $message);
        fclose($f);
        
        // Правильный редирект
        header('Location: ' . $_SERVER['SCRIPT_NAME'] . '?r=' . time() . '#form');
        exit;
    }
}

// Чтение файла только если он существует и не пустой
if (file_exists($file) && filesize($file) > 0) {
    $arr = file($file);
} else {
    $arr = [];
}