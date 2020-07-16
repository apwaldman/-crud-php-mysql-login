<?php
require '../controller/rn-book-read.php';
?>
<!DOCTYPE html>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card ">
                <div class="text-center">
                    <?php if (login_check($mysqli) == true) : ?>
                        <p>Usuário(a) <?php echo htmlentities($_SESSION['username']); ?></p>
                        <h1 class="well">Informações do livro</h1>
                </div>
                <div class="container">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Título</label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $data['title']; ?>
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Autor</label>
                            <div class="controls form-control disabled">
                                <label class="carousel-inner">
                                    <?php echo $data['author']; ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Emprestado</label>
                            <div class="controls form-control ">
                                <label class="carousel-inner" disabled>
                                    <?php echo $data['borrowed']; ?>
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Resumo do livro</label>                    
                                <textarea disabled class="carousel-inner">
                                    <?php echo $data['resume'] ??= 'Não há resumo cadastrado para o livro';
                                    return $data['resume'];
                                    ?>
                                </textarea>
                     
                            
                        </div>
                        <br />
                        <div class="form-actions">
                            <a href="index.php" type="btn" class="btn btn-outline-dark">Voltar</a>
                        </div>
                    </div>
                </div></br>
            </div>
        <?php else : ?>
            <p>
                <span class="error">Você não possui permissão para acessar a página.</span> Por favor <a href="../index.php">faça login</a>.
            </p>
        <?php endif; ?>
        </div>
    </div>
</body>
<?php include_once '../global-structure/footer-protected.php'; ?>
</html>