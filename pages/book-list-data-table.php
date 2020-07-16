<?php
include '../dao/banco.php';
$pdo = Banco::conectar();
$sql = 'SELECT * FROM book ORDER BY id DESC';



foreach ($pdo->query($sql) as $row) {
    echo '<tr>';
    echo '<th scope="row">' . $row['id'] . '</th>';
    echo '<td name="titulo">' . $row['title'] . '</td>';
    echo '<td name="autor">' . $row['author'] . '</td>';
    echo '<td name="emprestado">' . $row['borrowed'] . '</td>';
    echo '<td name="emprestadoUsuario">' . $row['user_borrowed'] . '</td>';
    echo '<td width=250>';
    echo '<a class="btn btn-outline-primary" href="book-read.php?id=' . $row['id'] . '">Info</a>';
    echo ' ';
    if ($row['user_borrowed'] == null || $row['user_borrowed'] == $_SESSION['username'] || $_SESSION['username'] == "master") {
        echo '<a class="btn btn-outline-warning" href="book-update.php?id=' . $row['id'] . '">Retirar</a>';
        echo ' ';
    }
    if ($_SESSION['username'] == "master") {
        echo '<a class="btn btn-outline-danger" href="book-delete.php?id=' . $row['id'] . '">Excluir</a>';
    }
    echo '</td>';
    echo '</tr>';
}
Banco::desconectar();
