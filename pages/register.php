<?php
    include_once '../global-structure/header-protected.php';
    include_once '../controller/register-function.php';
    include_once '../controller/functions.php';
    include_once '../global-structure/top-protected.php';
?>
<!DOCTYPE html>
<body>
    <div class="row text-center">
        <div class="col-md-3">
            <?php
                if (!empty($error_msg)) {
                echo $error_msg;
                }
            ?>
            <a href="../index.php" class="nav-link" title="Início">
                <button type="button" class="btn btn-outline-dark">Voltar para a tela inicial</button>
            </a>
        </div>

        <div class="col-md-6">
            <h1>Registro de novo usuario</h1></br>
            <form  method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">                                        
                <input type="text" class="form-control" placeholder="Nome de usuário" name='username' id='username'>
                </br>                    
                <input type="email" class="form-control" placeholder="E-mail" name="email" id="email" >
                </br>
                <input type="password" class="form-control" placeholder="Senha" name="password" id="password" >
                </br>                
                <input type="password" class="form-control" placeholder="Confirmação de senha" name="confirmpwd" id="confirmpwd" >
                </br>                                                        
                <button type="button" class="btn btn-dark"
                    onclick="return regformhash(this.form,
                    this.form.username,
                    this.form.email,
                    this.form.password,
                    this.form.confirmpwd);">
                    Registre-se</button>                    
            </form>                
        </div>
        <div class="col-md-3">
            <h1>Regras para registros:</h1></br> 
            <p>Nome de usuário: letras maiúsculas, letras minúsculas ou underscores</p>
            <p>E-mails: devem conter formato válido </p>
            <p>Senhas: devem conter ao menos seis caracteres, ao menos uma letra maiúscula
            e uma maiúscula. Pode conter underline.</p'>
            <p>Confirmação de senha: a senha e sua confirmação devem ser identicas</p>
        </div>
    </div>
</body>
<?php include_once '../global-structure/footer-protected.php'; ?>
</html>
