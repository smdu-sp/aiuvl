<?php 

$vue = 'vue.min.js';
$vueDev = 'vue.js';
$host = $_SERVER['HTTP_HOST'];
$jsPath = "/js/";
echo "<script type='text/javascript' src='" . $jsPath . ($host === "localhost" ? $vueDev : $vue) . "'></script>";
echo "<noscript><div class='noscript'><div>Este conteúdo não pode ser exibido pois seu navegador não tem suporte ao JavaScript.</div></div></noscript>";
