<?php session_start();
include_once './conexao.php';
include_once './usuario.php';


if(isset($_POST['usuario'])){
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    
    $consulta = mysqli_query($conn, "select idUsuario, nome, login, senha from usuario where login ='". $usuario ."'");
    $dados = mysqli_fetch_assoc($consulta);
    $user = null;
    if ($dados != null) {
        $user = new Usuario ($dados ['idUsuario'], $dados["nome"], $dados["login"], $dados["senha"]);
    }
    if ($user != null && $user->validaUsuarioSenha($usuario, $senha)){
      $_SESSION['user']= $user;
           
            

    } else{
        $_SESSION ['msg']= "Usuário ou senha incorretos!!";
        header ("Location:index.login.php");
        exit;
    }
    } else if (!isset($_SESSION['user'])){
        $_SESSION['msg'] = "É necessário logar antes de acessar a página de menu!";
     header("Location: index.login.php");
        exit;
    }   
    $classe = isset($_GET["classe"]) ? $_GET["classe"] : "Filme"; 
    ?>



<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="javascript<?php echo $classe; ?>.js"></script>

    <style>

        .navbar-brand {
            font-family: 'Poetsen One', sans-serif !important;
            color: #9932CC !important; 
            font-size: 24px; 
        }

        body {
            background-color: #B0C4DE;
        }
        .navbar-inverse {
            background-color: #222;
            border-color: #080808;
        }
        .navbar-inverse .navbar-header,
        .navbar-inverse .navbar-nav > li > a {
            color: white;
        }
        .page-title-box {
            background-color: #9932CC;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .page-title-box h2 {
            color: white;
            margin: 0;
        }
        .btn-success,
        .btn-primary {
            background-color: #9932CC;
            border-color: #7a29a4;
        }
        .btn-success:hover,
        .btn-primary:hover {
            background-color: #7a29a4;
        }
        .modal-header {
            background-color: #9932CC;
            color: white;
        }
        .table-bordered > thead > tr {
            background-color: #9932CC;
            color: white;
        }
        .pagination-sm > li > a,
        .pagination-sm > li > span {
            color: #9932CC;
        }
        .pagination-sm > .active > a {
            background-color: #9932CC;
            border-color: #9932CC;
            color: white;
        }
        .input-group-addon {
            background-color: #9932CC;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">AvaliFilmes</a>
        </div>
       
    <div class="navbar-header">
        </div>
        <div class="collapse navbar-collapse" style="text-align: center;">
            <ul class="nav navbar-nav" style="display: inline-block;">
                <li><a href="index.php?classe=Filme">Filmes</a></li>
                <li><a href="listar.php?classe=Usuário">Usuários</a></li>
                <li><a href="cadastrar.php">Cadastrar</a></li>
                <li><a href="logout.php?classe=logout">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="input-group" style="margin-bottom: 20px; width: 33.33%; max-width: 400px;">
    <input type="text" class="form-control" id="filtro" placeholder="Entre com o filtro" name="filtro" style="margin-right: 0;">
    <div class="input-group-btn">
        <button type="button" class="btn btn-primary" id="btFiltro" style="margin-left: -1px;">Procurar por Filme</button>
    </div>
</div>


<?php if (!empty($classe)) { ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="page-title-box">
                <h2>Filmes Cadastrados</h2>
            </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Diretor</th>
                <th>Ano de Lançamento</th>
                <th>Gênero</th>
                <th>Nota</th>
                <th>Comentários</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="filmes-tbody"></tbody>
    </table>

    <ul id="pagination" class="pagination-sm"></ul>

    <div class="text-right" style="margin-bottom: 20px;">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
        Criar Filme
    </button>
</div>



    <div class="modal fade" id="create-item" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h4 class="modal-title">Criar Filme</h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" action="insertFilme.php" method="POST">
                        <div class="form-group"><label for="titulo">Título:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required></div>
                        <div class="form-group"><label for="diretor">Diretor:</label>
                            <input type="text" class="form-control" id="diretor" name="diretor" required></div>
                        <div class="form-group"><label for="anoLancamento">Ano de Lançamento:</label>
                            <input type="number" class="form-control" id="anoLancamento" name="anoLancamento" required></div>
                        <div class="form-group"><label for="genero">Gênero:</label>
                            <input type="text" class="form-control" id="genero" name="genero" required></div>
                        <div class="form-group"><label for="nota">Nota:</label>
                            <input type="number" class="form-control" id="nota" name="nota" step="0.1" min="0" max="10" required></div>
                            <div class="form-group"><label for="comentario">Comentário:</label>
                            <input type="text" class="form-control" id="comentario" name="comentario" required></div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="edit-item" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h4 class="modal-title">Editar <?php echo $classe; ?></h4>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" action="updateFilme.php" method="POST">
                        <input type="hidden" id="editidFilme" name="idFilme">
                        <div class="form-group"><label for="editTitulo">Título:</label>
                            <input type="text" class="form-control" id="editTitulo" name="titulo" required></div>
                        <div class="form-group"><label for="editDiretor">Diretor:</label>
                            <input type="text" class="form-control" id="editDiretor" name="diretor" required></div>
                        <div class="form-group"><label for="editAnoLancamento">Ano de Lançamento:</label>
                            <input type="number" class="form-control" id="editAnoLancamento" name="anoLancamento" required></div>
                        <div class="form-group"><label for="editGenero">Gênero:</label>
                            <input type="text" class="form-control" id="editGenero" name="genero" required></div>
                        <div class="form-group"><label for="editNota">Nota:</label>
                            <input type="number" class="form-control" id="editNota" name="nota" step="0.1" min="0" max="10" required></div>
                        <div class="form-group"><label for="editcomentario">Comentário:</label>
                            <input type="text" class="form-control" id="editcomentario" name="comentario" required></div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

</body>
</html>