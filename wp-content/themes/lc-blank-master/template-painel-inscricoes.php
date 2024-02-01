<?php
/*
Template Name: Painel de inscrições
*/

get_header();

global $row;
global $registrosGlobal;

?>

<?php



function preenche_tabela()
{

    include_once 'protocolo.php';
    include 'conexao.php';

    global $wpdb;
    $registros = $wpdb->get_results('SELECT
    nome as Nomes,
    email as Contato,
    CASE
        WHEN segmento = 1 THEN "Organização não governamental com atuação na região do PIU-VL"
        WHEN segmento = 2 THEN "Associação de bairro com atuação na região do PIU-VL"
        WHEN segmento = 3 THEN "Entidades acadêmicas ou de pesquisa com atuação em questões urbanas e ambientais"
        WHEN segmento = 4 THEN "Setor empresarial"
    END AS "Segmento",
    entidade as Entidade,
    created_at as "Data",
    id as Protocolo,
    CASE
        WHEN cancelado = 0 THEN "Não"
        WHEN cancelado = 1 THEN "Sim"
    END AS "Cancelado"
    FROM inscricoes_aiuvl');

    $registrosArray = array();

    foreach ($registros as $registro) {
        $dataFormatadaa = date('d/m/Y H:i:s', strtotime($registro->Data));
        $registro->Data = $dataFormatadaa;
        // $registrosArray[] = $registro;

        $protocolo = geraProtocolo($registro->Protocolo);
        $registro->Protocolo = $protocolo;

        $registrosArray[] = $registro;
    }

    echo "<script>const registros=" . json_encode($registrosArray) . ";</script>";

    $query_table = "SELECT * FROM colunas_tabela ";

    $result_table = mysqli_query($conn, $query_table);

    if ($result_table) {
        $titulos = [];
        $linhas = [];
        while ($rows = mysqli_fetch_array($result_table)) {
            array_push($titulos, $rows['titulos']);
            array_push($linhas, $rows['linhas']);
        }
    }
    $query = "SELECT id, " . implode(", ", $linhas) . ", 
    CASE
        WHEN segmento = 1 THEN 'Organização não governamental com atuação na região do PIU-VL'
        WHEN segmento = 2 THEN 'Associação de bairro com atuação na região do PIU-VL'
        WHEN segmento = 3 THEN 'Entidades acadêmicas ou de pesquisa com atuação em questões urbanas e ambientais'
        WHEN segmento = 4 THEN 'Setor empresarial'
    END AS 'segmento'
    FROM inscricoes_aiuvl";

    $result = mysqli_query($conn, $query);

    $i = 0;
    if ($result) {

        echo '<thead>';
        echo '<tr>';
        foreach ($titulos as $titulo) {
            echo '<th class="col_' . $i++ . '">' . $titulo . '</th>';
        }
        echo '<th>Protocolo</th>';
        echo '<th>Baixar</th>';
        echo '</tr>';
        echo '</thead>';

        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            foreach ($linhas as $dados) {
                if ($dados == 'created_at') {
                    $dataFormatada = date('d/m/Y H:i:s', strtotime($row[$dados]));
                    // Exibe a data formatada
                    echo '<td>' . $dataFormatada . '</td>';
                } else {
                    // Se não for a coluna de data, apenas exibe o valor da coluna
                    echo '<td>' . $row[$dados] . '</td>';
                }
            }

            echo '<td>' . geraProtocolo($row['id']) . '</td>';
            echo '<td><a href="/wp-content/downloads/arquivos/' . geraProtocolo($row['id']) . '.zip" download><img src="../../assets/img/download.png" alt="icone download"></a></td>';
            echo '</tr>';
        }
        echo '</tbody>';

        mysqli_free_result($result);
    } else {
        echo "Erro na consulta: " . mysqli_error($conn);
    }
}
?>

<?php if (have_posts()) :
    while (have_posts()) :
        the_post(); ?>

        <?php
        the_content();

        ?>
        <!doctype html>
        <html lang="pt-br">

        <head>
            <link rel="stylesheet" href="/wp-content/themes/lc-blank-master/painel.css">
            <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
            <meta charset="UTF-8">
            <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" />
            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.min.js"></script>
            <script src="../wp-content/themes/lc-blank-master/xlsx.js'"></script>
        </head>

        <body>
            <div class="fresh-table full-color-orange">
                <div class="toolbar">
                    <div class="form-botao bnt-esquerda">
                        <form method="get">
                            <input class="botao-filtro" type="button" onclick="exportarArquivo()" value="BAIXAR EXCEL">
                        </form>
                    </div>
                </div>
                <table id="fresh-table" class="table">
                    <?php
                    preenche_tabela();
                    ?>
                </table>
            </div>

        </body>

        <!-- Style -->

        <!-- Fonts and icons -->




        <script type="text/javascript">
            function exportarArquivo() {
                var worksheet = XLSX.utils.json_to_sheet(registros);
                var workbook = XLSX.utils.book_new(registros);
                console.log(worksheet);
                XLSX.utils.book_append_sheet(workbook, worksheet, 'Inscrições');

                var data_atual = new Date();

                var dia = data_atual.getDate();
                var mes = data_atual.getMonth() + 1;
                var ano = data_atual.getFullYear();
                var hora = data_atual.getHours();
                var min = data_atual.getMinutes();
                var seg = data_atual.getSeconds();

                var dataFormatada = `${dia}${mes}${ano}${hora}${min}${seg}`;

                XLSX.writeFile(workbook, dataFormatada + '.XLSX');
            }

            //
            $(document).ready(function() {
                var quantidadeTh = $("th").length;

                if (quantidadeTh < 8) {
                    $("th").removeClass("col_4");
                }


            });

            var $table = $('#fresh-table')
            var $alertBtn = $('#alertBtn')

            window.operateEvents = {
                'click .like': function(e, value, row, index) {
                    alert('You click like icon, row: ' + JSON.stringify(row))
                    console.log(value, row, index)
                },
                'click .edit': function(e, value, row, index) {
                    alert('You click edit icon, row: ' + JSON.stringify(row))
                    console.log(value, row, index)
                },
                'click .remove': function(e, value, row, index) {
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: [row.id]
                    })
                }
            }

            function operateFormatter(value, row, index) {
                return [
                    '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                    '<i class="fa fa-heart"></i>',
                    '</a>',
                    '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                    '<i class="fa fa-edit"></i>',
                    '</a>',
                    '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                    '<i class="fa fa-remove"></i>',
                    '</a>'
                ].join('')
            }

            $(function() {
                $table.bootstrapTable({

                    classes: 'table table-hover table-striped',
                    toolbar: '.toolbar',

                    search: true,
                    showToggle: true,
                    showColumns: true,
                    pagination: true,
                    striped: true,
                    sortable: true,
                    pageSize: 8,
                    pageList: [8, 16, 32],

                    formatShowingRows: function(pageFrom, pageTo) {
                        return ''
                    },
                    formatRecordsPerPage: function(pageNumber) {
                        return pageNumber + '  Linhas'
                    }
                })

            })
        </script>



        </html>



    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>