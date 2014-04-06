<?php
/* Copyright (C) 2013-     Santiago Garcia      <babelsistemas@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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



require_once '../../main.inc.php';
require_once "../class/desdehasta.php";

// Seguridad
//if ($state =='create'           && !$user->rights->evenxusreports->peliculas->create) accessforbidden(); 

$actualizar_report_auto=1;

$c =    '<link rel=stylesheet href="../css/estilos.css" type="text/css">'.
        '<script src="../js/evenxusreports.js" type="text/javascript"></script>'.
        '<script src="../js/comunes.js" type="text/javascript"></script>';

$langs->load("evenxusreports@evenxus");

llxHeader($c,"",$langs->trans("")); 

$DH = new desdehasta();

// *****************************************************************************************************************************

print $DH->CodigoPostal();

// *****************************************************************************************************************************


print '</br></br></br>';

print '<center>';
print '<button id="print" onclick="ProcesarReporte(\'print|-N|Brother PC-FAX v.2.2\')">Imprimir</button>';
print '<button onclick="ProcesarReporte(\'print|-d\')">Imprimir(Con pantalla)</button>';
print '<button onclick="ProcesarReporte(\'view\')">Vista previa</button>';
print '<button id="pdf" onclick="ProcesarReporte(\'pdf|-o|c://temporal\')">Exportar PDF</button>';
print '<button onclick="ProcesarReporte(\'xls\')">Exportar Excel</button>';
print '<button onclick="ProcesarReporte(\'odt\')">Exportar Opentext</button>';
print '<button onclick="ProcesarReporte(\'ods\')">Exportar Openspreadsheet</button>';
print '<button onclick="ProcesarReporte(\'csv\')">Exportar a CSV</button>';
print '<button onclick="ProcesarReporte(\'pptx|-o|c://temporal\')">Exportar a PPTX</button>';


print '</br></br></br></br><button onclick="DescargarPlugin(\''.$dolibarr_main_url_root.'/evenxusreports/xpi/evenxusreports@evenxus.xpi\')">Descargar Plugin</button>';
print '</center>';


llxFooter();

print "<script type='text/javascript'>
    function ProcesarReporte(Modo)
    {
            // Nombre reporte
            var jasper='clientes.jasper';
            
            // Preparo parametros comunes
            var params = new Array()
            params=ParametrosComunesReporte(jasper,Modo);
            
            // Añado parametros solo del propio reporte, como filtros y ordenes
            
            // Filtro parametro CP
            var cp_desde = document.getElementById('cp_desde').value;
            if (cp_desde == '')  { cp_desde='0'; }
            var cp_hasta=document.getElementById('cp_hasta').value;
            if (cp_hasta == '')  { cp_hasta='ZZZZZZZZZZZZ'; }
            
            var i=params.length;
            params[i++]  =  '-P';
            params[i++]  =  'NOMBRE_EMPRESA=CARACOLO';
            params[i++]  =  'CP_DESDE='+cp_desde;
            params[i++]  =  'CP_HASTA='+cp_hasta;
            
            // Lanzo reporte 
            err = EvenxusLanzarReport(params,$actualizar_report_auto,'$dolibarr_main_url_root/evenxusreports/reports/'+jasper,jasper);

            if (err!==null) { alert(err);   return err; }
    }
    </script>";
