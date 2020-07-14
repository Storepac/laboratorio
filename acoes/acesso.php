<?php
    require("conexao.php");
    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/SMTP.php");

    Class SendMail{
        private $mail = null;

        public function settingsMail(){
            $this->mail = new PHPMailer\PHPMailer();
            $this->mail->isSMTP();

            $this->mail->Port = "465";
            $this->mail->Host = "smtp.gmail.com";
            $this->mail->IsHTML(true);
            $this->mail->SMTPSecure = "ssl";
            $this->mail->Mailer = "smtp";
            $this->mail->CharSet = "UTF-8";

            $this->mail->SMTPAuth = true;
            $this->mail->Username = "clickideacontato@gmail.com";
            $this->mail->Password = "gettherefast1";
            $this->mail->SingleTo = true;

            $this->mail->From = "clickideacontato@gmail.com";
            $this->mail->FromName = "Equipe Sistema de Acesso";
        }

        public function sendMailCadastro($nome, $email, $token){
            $file = file_get_contents("templates/cadastro.html");
            $file = str_replace("[NOME_USUARIO]", $nome, $file);
            $file = str_replace("[TOKEN]", $token, $file);

            $this->mail->addAddress($email);
            $this->mail->Subject = "Confirmação do endereço de email";
            $this->mail->Body = $file;

            if(!$this->mail->send()){
                return false;
            }

            return true;
        }
    };

    Class Acesso extends SendMail{
        private $con  = null;

        public function __construct($conexao){
            $this->con = $conexao;
            $this->settingsMail();
        }

        public function send(){
            if(empty($_POST) || $this->con == null){
                echo json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro interno no servidor."));
                return;
            }

            switch(true){
                case (isset($_POST["type"]) && $_POST["type"] == "login" && isset($_POST["email"]) && isset($_POST["senha"])):
                    echo $this->login($_POST["email"], $_POST["senha"]);
                    break;

                case (isset($_POST["type"]) && $_POST["type"] == "cadastro" && isset($_POST["email"]) && isset($_POST["senha"]) && isset($_POST["nome"])):
                    echo $this->cadastro($_POST["email"], $_POST["senha"], $_POST["nome"]);
                    break;
            }
        }

        public function login($email, $senha){
            $conexao = $this->con;

            $query = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
            $query->execute(array($email, $senha));

            if($query->rowCount()){
                $user = $query->fetchAll(PDO::FETCH_ASSOC)[0];

                session_start();
                $_SESSION["usuario"] = array($user["nome"], $user["adm"]);

                return json_encode(array("erro" => 0));
            }else{
                return json_encode(array("erro" => 1, "mensagem" => "Email e/ou senha incorretos."));
            }
        }

        public function cadastro($email, $senha, $nome){
            $conexao = $this->con;
            $geraToken = function() use(&$geraToken, $conexao){
                $length = 16;
                $a = str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");
                $b = array();

                for($i = 0; $i < $length; $i++){
                    $r = rand(0, (sizeof($a) - 1));
                    $b[$i] = $a[$r];
                }

                $token = join("", $b);
                
                $query = $conexao->prepare("SELECT token FROM usuarios WHERE token = ?");
                $query->execute(array($token));

                if($query->rowCount() > 0){
                    return $geraToken();
                }else{
                    return $token;
                }
            };

            $token = $geraToken();
            $query = $conexao->prepare("INSERT INTO usuarios (email, senha, nome, adm, token, confirmado) VALUES (?, ?, ?, ?, ?, ?)");
            
            if($query->execute(array($email, $senha, $nome, 0, $token, 0))){
                if($this->sendMailCadastro($nome, $email, $token)){
                    return json_encode(array("erro" => 200));
                }
            }else{
                return json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro ao cadastrar usuario."));
            }
        }
    };

    $conexao = new Conexao();
    $classe  = new Acesso($conexao->conectar());
    $classe->send();
?>
