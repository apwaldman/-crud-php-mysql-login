<?php
require '../controller/rn-book-create.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<body>
<div class="container">
    <div clas="span10 offset1">            
        <div class="card">
            <div class="text-center">
                <?php if (login_check($mysqli) == true) : ?>
                <p>Usuário(a) <?php echo htmlentities($_SESSION['username']); ?></p>
                <h1 class="well">Informações do livro</h1>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="../controller/rn-book-create.php" method="POST">
                    <div class="control-group  <?php echo !empty($tituloErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Título</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="titulo" id="titulo" type="text" placeholder="titulo"
                                   value="<?php echo !empty($titulo) ? $titulo : ''; ?>" required>
                            <?php if (!empty($tituloErro)): ?>
                                <span class="text-danger"><?php echo $tituloErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($autorErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Autor</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="autor" id="autor" type="text" placeholder="Autor"
                                   value="<?php echo !empty($autor) ? $autor : ''; ?>" required>
                                  
                            <?php if (!empty($emailErro)): ?>
                                <span class="text-danger"><?php echo $autorErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($emprestadoErro) ? 'echo($emprestadoErro)' : ''; ?>">
                    <label class="control-label">emprestado</label>
                        <div class="controls">
                            
                        <input  type="radio" name="emprestado" id="emprestadoSim" 
                                           value="S" <?php isset($_POST["emprestado"]) && $_POST["emprestado"] == "M" ? "checked" : null; ?>/> 
                            <label for="emprestadoSim">Sim</label>
                        <input  type="radio" name="emprestado" id="emprestadoNao"
                                           value="N" <?php isset($_POST["emprestado"]) && $_POST["emprestado"] == "F" ? "checked" : null; ?>/> 
                            <label for="emprestadoNao">Nao</label>
                            
                            <?php if (!empty($emprestadoErro)): ?>
                                <span class="help-inline text-danger"><?php echo $emprestadoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Resumo</label>
                        <div class="controls">
                            <textarea size="80" class="form-control" name="resume" id="resume" type="text" placeholder="resume"
                                   value="<?php echo !empty($resumo) ? $resumo : ''; ?>"> </textarea>
                        </div>
                    </div>

                    <label class="control-label">Usuário</label>
                    <div class="controls">
                        <input disabled size="80" class="form-control" name="emprestadoUsuario" id="emprestadoUsuario" type="text" placeholder=<?php echo ($_SESSION['username'])?>
                                value=<?php ($_SESSION['username'])?> >                        
                    </div>
                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-outline-success">Adicionar</button>
                        <a href="book-list.php"><button type="button" class="btn btn-outline-dark">Voltar</button></a>
                    </div>
                </form>
            </div>
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
<?php include_once '../global-structure/footer-protected.php'; ?>
