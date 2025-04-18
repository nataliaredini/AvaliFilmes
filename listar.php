<?php
include_once './conexao.php';
include_once './usuario.php';
session_start();

if (!isset($_SESSION['user'])){
    $_SESSION['msg'] = "É necessário logar antes de acessar a página de menu!!";
    header("Location: index.login.php");
    exit;   
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Página de Menu</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #B0C4DE;
        }
        .navbar .navbar-text {
            color:rgb(255, 255, 255) !important;
        }
        .table-header-custom {
            background-color: #B0C4DE;
            color: #9932CC;
        }
        .user-list-container {
            background-color: transparent;
            padding: 20px;
        }
        .title-box {
            background-color: #9932CC;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }
        .title-box h2 {
            color: white;
            margin: 0;
        }
        .table td, .table th {
            color: black;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">AvaliFilmes</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Filmes</a></li>
                    <li class="nav-item"><a class="nav-link" href="listar.php">Usuários</a></li>
                    <li class="nav-item"><a class="nav-link" href="Cadastrar.php">Cadastrar</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
                </ul>
                <span class="navbar-text">
                    Usuário logado: <?php echo $_SESSION['user']->nome; ?>
                </span>
            </div>
        </div>
    </nav>

    <div class="container user-list-container">
        <div class="title-box">
            <h2>Lista de Usuários</h2>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-header-custom">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Login</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $consulta = mysqli_query($conn, "SELECT idUsuario, nome, login, senha FROM usuario");
                while ($dados = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $dados['idUsuario']; ?></td>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['login']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


