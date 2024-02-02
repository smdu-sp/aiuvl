<?php
/*
Template Name: Instruções
*/

session_start();

// $hora_atual = time();
// $hora_desejada =  mktime(2, 59, 58, 8, 18, 2023);
// $hora_fechamento = $hora_desejada - $hora_atual;

if ($hora_fechamento < 0) {
    // header('Location: https://www.eleicaocmpu2023.prefeitura.sp.gov.br/inscricoes-encerradas/');
    // exit;
}

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php
    the_content();
    ?>

    <link rel="stylesheet" href="/wp-content/themes/lc-blank-master/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <div class="container" id="app">
      <div class="topo">
        <div class="logo">
            <img src="/wp-content/assets/img/capa.png" alt="logo da eleição do CMPU 2023">
        </div>
      </div>
      <div class="header header-instrucoes">
        <h2>Instruções para o envio da documentação</h2>
        <p>A documentação da candidatura deve ser enviada em arquivo único, com tamanho máximo de 250 MB. Para incluir mais de um arquivo, recomendamos utilizar o formato pasta compactada (Arquivo ZIP).</p>
        <p>Caso o tamanho do arquivo ultrapasse 250 MB, será necessário separar os arquivos em mais de uma pasta compactada e enviar quantas inscrições sejam necessárias para o envio completo da documentação.</p>
        <h3>Compactar arquivos no Windows 11</h3>
        <div>
          <img src="\assets\assets\img\pasta-compactada-zip-win11.png" alt="Instruções de upload Windows 11"  aria-hidden="true">
        </div>
        <ol>
          <li>Selecionar os arquivos a serem compactados;</li>
          <li>Com os itens selecionados, clique com o botão direito do mouse em qualquer um dos itens selecionados;</li>
          <li>Selecionar a opção "Compactar para arquivo ZIP".</li>
        </ol>
        <h3>Compactar arquivos no Windows 10 e versões anteriores</h3>
        <div>
          <img src="\assets\assets\img\pasta-compactada-zip-win10.png" alt="Instruções de upload Windows 10"  aria-hidden="true">
        </div>
        <ol>
          <li>Selecionar os arquivos a serem compactados;</li>
          <li>Com os itens selecionados, clique com o botão direito do mouse em qualquer um dos itens selecionados;</li>
          <li>Selecionar a opção "Enviar para";</li>
          <li>Selecionar a opção "Pasta compactada".</li>
        </ol>
        <h3>Compactar arquivos no Mac OS e Linux</h3>
        <div>
          <img src="\assets\assets\img\pasta-compactada-zip-macos.jpg" alt="Instruções de upload Mac OS"  aria-hidden="true">
        </div>
        <ol>
          <li>Selecionar os arquivos a serem compactados;</li>
          <li>Com os itens selecionados, clique com o botão direito do mouse em qualquer um dos itens selecionados;</li>
          <li>Selecionar a opção "Comprimir itens"</li>
        </ol>
      </div>
    </div>
    <style>
      .logo{
       margin: auto;
       padding: 0 2px;
      }

      #app .header.header-instrucoes {
      margin: auto;
      display: flex;
      flex-direction: column;
      font-family: 'Open Sans', arial, sans-serif;
}

      #app .header.header-instrucoes p {
        font-size: 18px;
      }

      #app .header.header-instrucoes h3, #app .header.header-instrucoes ol {
        font-family: 'Open Sans', arial, sans-serif;
        margin-top: 30px;
      }

      #app .header.header-instrucoes h3 {
        font-size: 18px;
        font-weight: 700;
      }

      #app .header.header-instrucoes ol {
        list-style: decimal;
        margin-bottom: 30px;
      }

      #app .header.header-instrucoes li {
        margin-bottom: 10px;
      }
    </style>

  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>