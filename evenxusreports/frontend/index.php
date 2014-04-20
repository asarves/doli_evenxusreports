<?php
/* Copyright (C) 2013-     Santiago Garcia      <babelsistemas@gmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */  

require_once('../../main.inc.php');		
require_once DOL_DOCUMENT_ROOT . '/evenxusreports/class/comunes.php';

// Carga idiomas de todos los reportes
$idiomas=CargarIdiomas();
foreach ($idiomas as &$idioma) {
    $langs->load($idioma);
}

$c="<link rel=stylesheet href='../css/estilos.css' type='text/css'>
    <link rel='stylesheet' href='../css/portfolio.css' type='text/css' media='screen'>
    <script src='../js/comunes.js' type='text/javascript'></script>
    <script src='../js/filterable.pack.js' type='text/javascript' charset='utf-8'></script>";
    
llxHeader($c,'','');    
    
print "   
<!-- Content -->
<div class='wrapper' id='contentWrapper'>
    <div class='boundingBox' id='content'>
        <ul id='portfolio-filter'>
            <li><a href='#todos' title=''>".$langs->trans('Todos')."</a></li>";
print CargarTags();               
print "</u1>
        <ul id='portfolio-list'>";
print CargarTilesReportes();
print "</u1>
    </div>
</div>
</div>
</div>
</div>
";
print "<center>";
print '<input class="botonconfig" id="descargarplugin" type="button" name="descargarplugin"  value="'.$langs->trans("DescargarPlugin").'" onclick="DescargarPlugin(\''.$dolibarr_main_url_root.'/evenxusreports/xpi/evenxusreports@evenxus.xpi\')">';
print "<div id='buttongapconfig'>&nbsp;</div>";
print "<input class='botonconfig' id='acercade' type='button' name='acercade'  value='".$langs->trans('AcercaDe')."' onclick='AcercaDe()'>";
print "</center>";
print "<br>";
print PiePagina();   
llxFooter();

print "<script type='text/javascript'>

    function AcercaDe()  {
        location.href='$dolibarr_main_url_root/evenxusreports/frontend/evenxusreports.php';
    }
    </script>";


/*
 * 
 * Genera cadena de tags segun tipo de reportes instalados
 * 
 */
function CargarTags() {
    global $db;
    global $langs;
    $tags="";
    $sql = "SELECT * FROM ".MAIN_DB_PREFIX."evr_reports WHERE activo=1 GROUP BY modulo";
    $res = $db->query($sql);
    if ($res > 0) {
        $fila = $res->fetch_array();
        while ($fila) {
            $modulo = $fila[modulo];
            $tags=$tags."<li><a href='#".$langs->trans($modulo)."' title=''>".$langs->trans($modulo)."</a></li>";
            $fila = $res->fetch_array();
        }
    }            
    return $tags;       
}
/**
 * 
 * Carga tiles de los reportes
 * 
 */
function CargarTilesReportes() {
    global $db;
    global $langs;
    $tags="";
    $sql = "SELECT * FROM ".MAIN_DB_PREFIX."evr_reports WHERE activo=1 GROUP BY modulo ORDER BY nombre";
    $res = $db->query($sql);
    if ($res > 0) {
        $fila = $res->fetch_array();
        while ($fila) {
            $modulo = $fila[modulo];
            $nombre = $fila[nombre];
            $nombrephp = strtolower($nombre.".php");
            $tags=$tags ." <li style='display: block;' class='todos ".$langs->trans($modulo)."'> <a href='".$nombrephp."' title=''><img src='../img/tiles/".strtolower($nombre).".png' alt=''></a>
                           <p> ".$nombre. " </p>
                           </li>";
            $fila = $res->fetch_array();
        }
    }            
    return $tags;    
}