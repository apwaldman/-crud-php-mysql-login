<?php
require '../dao/banco.php';
include_once '../global-structure/menu-protected.php';
include_once '../global-structure/header-protected.php';
include_once '../dao/db_connect.php';
include_once '../controller/functions.php';
sec_session_start();

$id = 0;

if(!empty($_GET['id']))
{
    $id = $_REQUEST['id'];    
    
}

if(!empty($_POST))
{
    $id = $_POST['id'];
    
    //Delete do banco:
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM book where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Banco::desconectar();
    header("Location: book-list.php");
}
?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <body>
        <div class="container">            
            <div >                
                <div class="text-center">
                    <?php if (login_check($mysqli) == true) : ?>
                    <p>Usuário(a) <?php echo htmlentities($_SESSION['username']); ?></p>
                    <h1 class="well">Exclusão do livro</h1>
                </div></br>
                <form class="form-horizontal" action="book-delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                    <div class="alert alert-danger"> Deseja excluir o livro?</div>
                    <div class="form actions">
                        <button type="submit" class="btn btn-outline-danger">Sim</button>
                        <a href="book-list.php" type="btn" class="btn btn-outline-dark">Não</a>
                    </div>
                </form>
                
                <?php else : ?>
                    <p>
                        <span class="error">Você não possui permissão para acessar a página.</span> Por favor <a href="../index.php">faça login</a>.
                    </p>
                <?php endif; ?>
            </div>
        </div>        
    </body>
</html>
