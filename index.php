
<?php
session_start();

if(isset($_SESSION["usuario"]) && is_array($_SESSION["usuario"])){
    echo "<script>window.location = 'dashboard.php'</script>";
}
?>
<html lang="Pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style/acesso.css">
    <script type="text/javascript" src="script/jquery.js"></script>
    <script type="text/javascript" src="script/acesso.js"></script>
</head>
	<!-- Header -->
    <header>
        
    </header>
    <body class="py-5">


        <div id="mensagem"></div>
        
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="card col-5">
                    <div class="card-body">
                <div class="col"  id="formulario">
                    <form id="formularioLogin">

                        <div id="linha" class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="text" name="email" class="form-control" id="email" />
                        </div>

                        <div id="linha" class="form-group senha">
                        <label for="exampleInputEmail1">Senha</label>
                        <input type="password" name="senha" class="form-control" id="senha" />
                        </div>

                    <div id="button" class="form-group">
                        <button id="btnEntrar" class="btn btn-block btn-danger ">Entrar</button>
                        <a href="javascript:void(0)" id="esqueciSenha">Esqueci minha senha</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
            </div>
        </div>


        
    </body>
    
</html>