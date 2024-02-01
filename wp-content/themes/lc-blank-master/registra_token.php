<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se a solicitação HTTP é do tipo POST

    if (isset($_POST["imprime_token"])) {
        // Verifica se o campo "nome" foi enviado no formulário
        $token_gerado = $_POST["imprime_token"];


        include_once 'conexao.php';

        $novo_token = $token_gerado;

        $verificaExistencia = "SELECT * FROM token_registros WHERE token = '$novo_token'";

        $result = $conn->query($verificaExistencia);

        if ($result->num_rows > 0) {
            echo "O token já existe no banco de dados, gere outro.";
        } else {

            $sql = "INSERT INTO token_registros (token) VALUES ($novo_token)";

            if ($conn->query($sql) === TRUE) {
                echo "Inserção bem-sucedida!";
            } else {
                echo "Erro na inserção";
            }
        }

        $conn->close();
    }
} else {
    echo "O Token não foi enviado no formulário.";
}
?>