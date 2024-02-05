<?php

include_once 'header.php';

$nomeContato = $_POST['nome'];

$emailTo = $_POST['email'];

$segmento = $_POST['segmento'];
$segmentoArr = array(
  'Organização não governamental com atuação na região do PIU-VL',
  'Associação de bairro com atuação na região do PIU-VL',
  'Entidades acadêmicas ou de pesquisa com atuação em questões urbanas e ambientais',
  'Setor empresarial'
);

$data = date("d, m, Y");
$data_separada = explode(', ', $data);
$dataFinal = implode('/', $data_separada);


$html = <<<HTML
<div class="comprovante" id="comprovante" style="font-family: Tahoma, Arial, sans-serif; max-width: 600px; margin: auto; margin-top: 60px;">
  <div style="margin-bottom: 16px">
    <img style="width: 133px; height: 130px; display: block; margin: 0 auto;" src="https://cmpu.prefeitura.sp.gov.br//assets/img/comprovante-logo-smul.png" alt="Logo da Secretaria Municipal de Urbanismo e Licenciamento">
  </div>
  <div style="margin-bottom: 16px;">
    <h1 style="font-size: 18px; font-weight: bold; text-align: center;">COMPROVANTE DE RECEBIMENTO DE DOCUMENTAÇÃO</h1>
  </div>
  <div style="margin-bottom: 48px">
    <p style="font-size: 16px; text-align: center;">Protocolo nº $protocolo</p>
  </div>
  <p style="font-size: 16px; margin-bottom: 16px;">Recebemos do(a) Sr(a).</p>
  <p style="font-size: 16px; margin-bottom: 16px;">Nome: $nomeContato </p>
  <p style="font-size: 16px; margin-bottom: 16px;">E-mail: $emailTo</p>
  <p style="font-size: 16px; margin-bottom: 16px;">Segment: $segmentoArr[$segmento]</p>
  <p style="font-size: 16px; margin-bottom: 64px;">Inscrição para Eleição do Conselho Gestor AIU VL efetuada com sucesso.</p>
  <p style="font-size: 16px; margin-bottom: 40px;">São Paulo, $dataFinal.</span></p>
</div>
HTML;
?>

<link rel="stylesheet" href="/wp-content/themes/lc-blank-master/estilos.css">

<main id="textoComprovante">
  <div id="app">
    <div id="header-instrucoes" class="header header-instrucoes">
      <p>Inscrição realizada com sucesso!</p>
      <p>Uma cópia do comprovante foi enviado para o endereço de e-mail informado, caso não tenha recebido, verifique
        sua pasta de "spam".</p>
    </div>
  </div>
</main>

<?php
echo $html;

// Envio de email
$emailFrom = 'cmpu@prefeitura.sp.gov.br';
$params = "-f {$emailFrom}";
$assunto = "Indicação CMPU";
$headers = "From: CMPU<{$emailFrom}>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

@mail($emailTo, $assunto, $html, $headers, $params);

?>

<center>
  <button id="botaoImprimir" style="border-style: revert; -webkit-appearance: auto; appearance: auto" onClick="imprimir()">Imprimir Comprovante</button>
</center>


<script>
  window.onafterprint = function() {
    var impr = document.getElementById('botaoImprimir');
    var instrucoes = document.getElementById('header-instrucoes');
    impr.style.display = 'block';
    instrucoes.style.display = 'block';
  }

  function imprimir() {
    var impr = document.getElementById('botaoImprimir');
    impr.style.display = 'none';
    var instrucoes = document.getElementById('header-instrucoes');
    instrucoes.style.display = 'none';
    window.print();
  }
</script>