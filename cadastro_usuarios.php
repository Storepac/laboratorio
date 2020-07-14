  <html lang="Pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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
                <div class="col">
                    <form id="formularioCadastro">
                    <h2 class="title">Crie um usuário</h2>
                    
                        <div id="linha">
                    <label for="nomeCadastro">Nome</label>
                    <input type="text" class="form-control" name="nomeCadastro" id="nomeCadastro" />
                </div>

                <div id="linha">
                    <label for="emailCadastro">Email</label>
                    <input type="text" class="form-control" name="emailCadastro" id="emailCadastro" />
                </div>

                <div id="linha">
                    <label for="senhaCadastro">Senha</label>
                    <input type="password" class="form-control" name="senhaCadastro" id="senhaCadastro" />
                </div>

                <div class="form-group py-5">
                <div id="button">
                <div class="form-group">
                        <button id="btnCadastrar" class="btn btn-block btn-danger ">Cadastro</button>
                    </div>
                </div>
                </div>
                    </div>


                    </form>
                </div>
            </div>
        </div>
            </div>
        </div>


        
    </body>
    
</html>