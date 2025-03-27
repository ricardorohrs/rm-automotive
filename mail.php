<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r", "\n"), array(" ", " "), $name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);
    $setor = trim($_POST["setor"]);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor complete o formulário e tente novamente.";
        exit;
    }

//        $recipient = "rh@rmautomotive.com.br";
    $recipient = "rerohrs@inf.ufsm.br";

    $subject = "Novo Envio do Formulário de Contato";

    if ($setor) {
        $subject .= " - Contato";
    } else {
        $subject .= " - Home";
    }

    $email_content = "Nome: $name  \r\n\n";
    $email_content .= "Email: $email \r\n\n";
    $email_content .= "Celular: $phone \r\n\n";
    if ($setor) {
        $email_content .= "Setor: $setor \r\n\n";
    }
    $email_content .= "Mensagem: $message \r\n\n";

    $email_headers = "From: $name <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        echo '<script>';
        echo 'alert("Obrigado! Sua mensagem foi enviada.");';
        if ($setor) {
            echo 'window.location.href = "contact-us.html";';
        } else {
            echo 'window.location.href = "index.html";';
        }
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Oops! Algo deu errado e não conseguimos enviar a sua mensagem.");';
        if ($setor) {
            echo 'window.location.href = "contact-us.html";';
        } else {
            echo 'window.location.href = "index.html";';
        }
        echo '</script>';
    }
} else {
    http_response_code(403);
    echo "Ocorreu um erro no envio da mensagem, por favor tente novamente.";
}
?>
