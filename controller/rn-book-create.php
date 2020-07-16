<?php
require '../dao/banco.php';
include_once '../global-structure/menu-protected.php';
include_once '../global-structure/header-protected.php';
include_once '../dao/db_connect.php';
include_once '../controller/functions.php';
sec_session_start();

//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tituloErro = null;
    $autorErro = null;   
    $emprestadoErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $resumo = false;
        $novoUsuario = False;
        if (!empty($_POST['titulo'])) {
            $titulo = $_POST['titulo'];
        } else {
            $tituloErro = 'Por favor digite o título!';
            $validacao = False;
        }


        if (!empty($_POST['autor'])) {
            $autor = $_POST['autor'];
        } else {
            $autorErro = 'Por favor digite o autor!';
            $validacao = False;
        }

        
        if (!empty($_POST['resume'])) {
            $resume = $_POST['resume'];
            $resumo = true;
        }

        if (!empty($_POST['emprestado'])) {
            $emprestado = $_POST['emprestado'];            
            if($emprestado=="S"){
                $emprestadoUsuario = $_SESSION['username'];
            }
        } else {
            $emprestadoErro = 'Por favor seleccione um campo!';
            $validacao = False;
        }
    }

//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($resumo){
            $sql = "INSERT INTO resume (resume) VALUES (?);
            INSERT INTO book (title, author, borrowed,user_borrowed, id_resume) VALUES(?,?,?,?,LAST_INSERT_ID())";
            $q = $pdo->prepare($sql);
            $q->execute(array($resume,$titulo, $autor, $emprestado, $emprestadoUsuario));
        } else{            
            $sql = "INSERT INTO book (title, author, borrowed,user_borrowed) VALUES(?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($titulo, $autor, $emprestado, $emprestadoUsuario));            
        }
        Banco::desconectar();
        header("Location: ../pages/book-list.php");
    }
    
}
?>