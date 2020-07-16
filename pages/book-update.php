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
}

if (!empty($_POST)) {

    $tituloErro = null;
    $autorErro = null;
    $emprestadoErro = null;

    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $emprestado = $_POST['emprestado'];
    $usuarioemprestado = $_SESSION['username'];
    $resumo = $_POST['resumo'];
    //Validação

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT *
    FROM book b
     left join resume r
     on b.id_resume = r.id where b.id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $titulo = $data['title'];
    $autor = $data['author'];
    $emprestado = $data['borrowed'];
    $emprestadoUsuario = $data['user_borrowed'];
    $resumo = $data['resume'];
    Banco::desconectar();

    $validacao = true;
    if (empty($titulo)) {
        $tituloErro = 'Por favor digite o titulo!';
        $validacao = false;
    }

    if (empty($autor)) {
        $autorErro = 'Por favor digite o autor!';
        $validacao = false;
    }

    if (!empty($_POST['emprestado'])) {
        $emprestado = $_POST['emprestado'];
        if ($emprestado == "S") {
            $emprestadoUsuario = $_SESSION['username'];
        } else {
            $emprestadoUsuario = '';
        }
    } else {
        $emprestadoErro = 'Por favor seleccione um campo!';
        $validacao = False;
    }

    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($resumo != null) {
            $sql = "UPDATE book as b,resume as r
            SET 
                b.title = ?,
                b.author = ?,
                b.borrowed = ?,
                b.user_borrowed = ?,
                r.resume = ?,   
                b.id_resume = r.id     
            WHERE 
                b.id = ?
            and b.id_resume = r.id
                ";
            $q = $pdo->prepare($sql);
            $q->execute(array($titulo, $autor, $emprestado, $emprestadoUsuario, $resumo,$id));
        } else {
            $sql = "UPDATE book  set title = ?, author = ?, borrowed = ?, user_borrowed = ?WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($titulo, $autor, $emprestado, $emprestadoUsuario, $id));
        }
        Banco::desconectar();
        header("Location: book-list.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT *
    FROM book b
     left join resume r
     on b.id_resume = r.id where b.id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $titulo = $data['title'];
    $autor = $data['author'];
    $emprestado = $data['borrowed'];
    $emprestadoUsuario = $data['user_borrowed'];
    $resumo = $data['resume'];
    Banco::desconectar();
}
?>

<!DOCTYPE html>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card">
                <div class="text-center">
                    <?php if (login_check($mysqli) == true) : ?>
                        <p>Usuário(a) <?php echo htmlentities($_SESSION['username']); ?>!</p>
                        <h1> Atualizar Livro </h1>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="book-update.php?id=<?php echo $id ?>" method="post">
                        <div class="control-group <?php echo !empty($tituloErro) ? 'error' : ''; ?>">
                            <label class="control-label">Titulo</label>
                            <div class="controls">
                                <input name="titulo" class="form-control" size="50" type="text" placeholder="titulo" value="<?php echo !empty($titulo) ? $titulo : ''; ?>">
                                <?php if (!empty($tituloErro)) : ?>
                                    <span class="text-danger"><?php echo $tituloErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="control-group <?php echo !empty($autorErro) ? 'error' : ''; ?>">
                            <label class="control-label">Autor</label>
                            <div class="controls">
                                <input name="autor" class="form-control" size="80" type="text" placeholder="Autor" value="<?php echo !empty($autor) ? $autor : ''; ?>">
                                <?php if (!empty($autorErro)) : ?>
                                    <span class="text-danger"><?php echo $autorErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="control-group <?php echo !empty($emprestadoErro) ? 'error' : ''; ?>">
                            <label class="control-label">Emprestado</label>
                            <div class="controls">
                                <div class="form-check">
                                    <p class="form-check-label">
                                        <input class="form-check-input" type="radio" name="emprestado" id="emprestado" value="S" <?php echo ($emprestado == "S") ? "checked" : null; ?> /> Sim
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="emprestado" id="emprestado" value="N" <?php echo ($emprestado == "N") ? "checked" : null; ?> /> Não
                                </div>
                                </p>
                                <?php if (!empty($emprestadoErro)) : ?>
                                    <span class="text-danger"><?php echo $emprestadoErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <label class="control-label">Resumo</label>
                        <div class="controls">
                            <input name="resumo" class="form-control" size="80" type="text" placeholder="Resumo" value="<?php echo !empty($resumo) ? $resumo : ''; ?>">
                            
                        </div>

                        <br />
                        <div class="form-actions">
                            <button type="submit" class="btn btn-outline-primary">Atualizar</button>

                            <a href="book-list.php" type="btn" class="btn btn-default"><button type="button" class="btn btn-outline-dark">Voltar</button></a>
                        </div>
                    </form>
                </div>
            <?php else : ?>
                <p>
                    <span class="error">Você não possui permissão para acessar a página.</span> Por favor <a href="../index.php">faça login</a>.
                </p>
            <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>