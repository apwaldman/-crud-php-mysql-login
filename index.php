<?php
include_once 'global-structure/index-header.php';
include_once 'dao/db_connect.php';
include_once 'controller/login-functions.php';

    sec_session_start();

    if (login_check($mysqli) == true) {
        $logged = 'Logado';
    } else {
        $logged = 'Não logado';
    }
?>

<body>
    <div class="row">
        <div class="col-md-2 text-center"><?php
                                            if (isset($_GET['error'])) {
                                                echo '<p class="error">Erro no login!</p>';
                                            }
                                            ?> </div>
        <div class="col-md-8 text-center">
            </br>
            </br>
            <h1>Sistema de empréstimo de livros</h1></br></br>
            <form action="controller/process_login.php" method="post" name="login_form">
                Email: <input type="text" name="email" />
                Senha: <input type="password" name="password" id="password" />
                <input type="button" class="btn btn-outline-dark" value="Login" onclick="formhash(this.form, this.form.password);" />
            </form>
            <p>Não tem uma conta? <strong><a href="pages/register.php">registre-se</a></strong></br>
                Desfaça o login<strong><a href="pages/logout.php">Desfazer login</a></strong></br>
                Você está logado? <?php echo $logged ?>.</p>
        </div>
    </div>
    <div class="col-md-2"></div>
    </div>
    <div class="row text-center">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h1>Usuário Master:</h1></br>
                    <p>Somente o usuario “master” tem permissão de excluir os
                        livros -> solicite a senha do usuário para visualizar.
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h1>Retirada de livros:</h1></br>
                    <p>É possível alugar um livro que não tenha usuário vinculado.
                        Se o livro possui usuário, somente este ou o 'master' podem
                        alterar o status do livro.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h1>Dados técnicos:</h1>
                    <p>Para este trabalho utilizei PHP, MySQL e Bootstrap</br>
                        Este portofólio é periódicamente atualizado, volte mais vezes.</p>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div></br></div>
</body>

<?php include_once 'global-structure/index-footer.php'; ?>