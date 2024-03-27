<?php
// Verifica se os campos obrigatórios estão preenchidos e se o e-mail é válido
if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['mensagem']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "Por favor, preencha todos os campos obrigatórios corretamente.";
    exit;
}

// Variáveis
$nome = htmlspecialchars($_POST['nome']);
$email = htmlspecialchars($_POST['email']);
$telefone = isset($_POST['telefone']) ? htmlspecialchars($_POST['telefone']) : '';
$mensagem = htmlspecialchars($_POST['mensagem']);
$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');

// Corpo E-mail
$arquivo = "
<html>
<p><b>Nome: </b>$nome</p>
<p><b>E-mail: </b>$email</p>
<p><b>Telefone: </b>$telefone</p>
<p><b>Mensagem: </b>$mensagem</p>
<p>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></p>
</html>
";

// E-mails para quem será enviado o formulário
$destino = "dev.arthursobreira@gmail.com";
$assunto = "arthursobreiraweb.com - Fale Comigo";

// Cabeçalhos
$nome_codificado = mb_encode_mimeheader($nome);
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: $nome_codificado <$email>\r\n";

// Enviar e-mail
if (mail($destino, $assunto, $arquivo, $headers)) {
    echo "O e-mail foi enviado com sucesso!";
} else {
    echo "Erro ao enviar o e-mail. Por favor, tente novamente mais tarde ou entre em contato pelo whatsapp.";
}
?>