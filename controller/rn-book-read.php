<?php
require '../dao/banco.php';
include_once '../global-structure/menu-protected.php';
include_once '../global-structure/header-protected.php';
include_once '../dao/db_connect.php';
include_once '../controller/functions.php';
sec_session_start();

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: ../index.php");
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT book.title, book.author, book.borrowed, book.user_borrowed, resume.resume
    FROM book as book
    left join resume as resume
     on book.id_resume = resume.id where book.id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Banco::desconectar();
}
?>
