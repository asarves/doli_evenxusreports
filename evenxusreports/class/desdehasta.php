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

class desdehasta {
    
    // Codigo postal
    function CodigoPostal() {
        global $langs;
        $CodigoPostal = $langs->trans('CodigoPostal');
        $Desde = $langs->trans('Desde');
        $Hasta = $langs->trans('Hasta');       
        $cadena =   "<tr>
                    <td><div class='titulo'>$CodigoPostal : </div></td>
                    <td>$Desde : <input type='text' class ='cp' id='cp_desde'></td>
                    <td>$Hasta : <input type='text' class ='cp' id='cp_hasta'></td>    
                    </tr>
                    <script type='text/javascript'>
                    // Formatos
                    $(document).ready(function(){
                        $('.cp').attr('maxlength','5');
                        $('.cp').attr('width', '20');
                    });
                    </script>";
        return $cadena;
    }
}

