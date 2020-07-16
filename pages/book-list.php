<?php
include_once '../global-structure/menu-protected.php';
include_once '../global-structure/header-protected.php';
include_once '../dao/db_connect.php';
include_once '../controller/functions.php';
sec_session_start();
?>



<body>
    <div>
        <div style="text-align:center">
            <?php if (login_check($mysqli) == true) : ?>
                <h1>Bem-vinda(o) <?php echo htmlentities($_SESSION['username']); ?>!</h1>
        </div>
        </br>
        <div class="container mt-3">
            <input class="form-control" id="myInput" type="text" placeholder="Buscar..">
            </br>
            <a href="book-create.php"><button type="button" class="btn btn-outline-success">Adicionar livro</button></a>
            </br>
            <br>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" name="id">Id</th>
                            <th scope="col" name="titulo">Título</th>
                            <th scope="col" name="autor">Autor</th>
                            <th scope="col" name="emprestado">Emprestado</th>
                            <th scope="col" name="emprestadoUsuario">Usuário</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <tr>
                            <?php
                            include 'book-list-data-table.php';
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--Mensagem que é exibida caso o usuario nao logado tente acessar a página-->
        <?php else : ?>
            <p>
                <span class="error">Você não possui permissão para acessar a página.</span> Por favor <a href="../index.php">faça login</a>.
            </p>
        <?php endif; ?>

        </div>
        <!--Script do campo de busca bootstrap 4-->
        <script>
            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
</body>

</html>
<?php include_once '../global-structure/footer-protected.php'; ?>