<?php
    if (true) {
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone"]);
        $message = trim($_POST["message"]);

//        if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
//            http_response_code(400);
//            echo "Por favor complete o formulário e tente novamente.";
//            exit;
//        }

//        $recipient = "rh@rmautomotive.com.br";
        $recipient = "rerohrs@inf.ufsm.br";

        $subject = "Novo Envio do Formilário de Contato";

        $email_content = "Nome: $name  \r\n\n";
        $email_content .= "Email: $email \r\n\n";
        $email_content .= "Celular: $phone \r\n\n";
        $email_content .= "Mensagem: $message \r\n\n";

        $email_headers = "From: $name <$email>";

        if (mail($recipient, $subject, $email_content, $email_headers)) {
            http_response_code(200);
            echo "Obrigado! Sua mensagem foi enviada.";
        } else {
            http_response_code(500);
            echo "Oops! Algo deu errado e não conseguimos enviar a sua mensagem.";
        }
    } else {
        http_response_code(403);
        echo "Ocorreu um erro no envio da mensagem, por favor tente novamente.";
    }
?>
