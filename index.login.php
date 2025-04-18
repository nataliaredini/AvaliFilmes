<?php session_start(); ?>

<html>
<head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login do Sistema</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            background-color: #B0C4DE; 
            color: #333; 
            font-family: 'Arial', sans-serif; 
        }

        .title-box {
            background-color: #9932CC; 
            color: white; 
            padding: 20px;
            text-align: center;
            border-radius: 5px; 
            margin-bottom: 20px; 
        }

        .alert {
            color: red; 
        }

        .login-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: white; 
    border-radius: 5px; 
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
}

body {
    font-family: 'Poetsen One', cursive;
}

h1, h2, h3 {
    font-family: 'Poetsen One', cursive;
}

p, input, label {
    font-family: Arial, sans-serif;
}

        input[type="submit"] {
            background-color: #9932CC; 
            color: white; 
        }

        input[type="submit"]:hover {
            background-color: #DDDDDD; 
            color: #9932CC; 
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="title-box">
            <h1>AvaliFilme</h1>
        </div>
        <form action="index.php" method="POST">
            <fieldset>
                <legend>Dados de Usuário</legend>
                <table class="table">
                    <tbody>
                        <?php if (isset($_SESSION['msg'])) { ?>
                            <tr>
                                <td colspan="2" class="alert">
                                    <?php echo $_SESSION['msg']; ?>
                                </td>
                            </tr>
                            <?php session_destroy(); ?>
                        <?php } ?>
                        <tr>
                            <td>Usuário:</td>
                            <td><input type="text" name="usuario" class="form-control" required /></td>
                        </tr>
                        <tr>
                            <td>Senha:</td>
                            <td><input type="password" name="senha" class="form-control" required /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" class="btn btn-primary" value="Entrar" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </form>
    </div>
</body>
</html>