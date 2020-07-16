<php?
sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'Logado';
} else {
    $logged = 'Não logado';
}
?>
<div class="col-md-12 heading-section ftco-animate text-center">
       <form action="includes/process_login.php" method="post" name="login_form"> 			
            Email: <input type="text" name="email" />
            Senha: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
        <p>Não tens login? <strong><a href="register.php">Registre-se</a></strong></p>
        <p>Realize o log out <strong><a href="includes/logout.php">Desfazer login</a></strong></p>
        <p>Você está logado <strong><?php echo $logged ?></strong></p>
</div>
   