<?php
include_once './conexao.php';
include_once './usuario.php';

session_start();

if (!isset($_SESSION ['user'])){
    $_SESSION['msg'] = "É necessário logar antes de acessar a página de menu!!";
    header("Location: index.php");
    exit;   
}

if (isset($_POST['nome'])){
    $conn = mysqli_query($conn,
            "insert into usuario (nome, login, senha) values('".$_POST['nome']."','".$_POST['login']."','".$_POST['senha']."')"); 
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Página de Menu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #B0C4DE;
        }
        .navbar .navbar-text {
            color: #fff !important;
        }
        .card-header {
            background-color: #9932CC !important;
            color: #fff !important;
        }
        .btn-custom {
            background-color: #9932CC;
            color: white;
        }
        .btn-custom:hover {
            background-color: #9932CC;
            color: white;
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
                    <li class="nav-item"><a class="nav-link" href="cadastrar.php">Cadastrar</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
                </ul>
                <span class="navbar-text">
                    Usuário logado: <?php echo $_SESSION['user']->nome; ?>
                </span>
            </div>
        </div>
    </nav>

    <!-- Formulário -->
    <div class="container">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-header">
                <h5 class="mb-0">Cadastrar Usuário</h5>
            </div>
            <div class="card-body">
                <form action="cadastrar.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="login" class="form-label">Login:</label>
                        <input type="text" class="form-control" id="login" name="login" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</html>
