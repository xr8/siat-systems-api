<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	  CodeIgniter
 * @author  	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	  http://opensource.org/licenses/MIT	MIT License
 * @link    	http://codeigniter.com
 * @since	    Version 1.0.0
 * @filesource
 */

// Definir constantes globales***
define("NAME", "APP SYSTEMS");

// Establecer la zona horaria predeterminada
date_default_timezone_set('America/Mexico_City');

  // Verificar que la zona horaria se haya establecido correctamente
  if (date_default_timezone_get() !== 'America/Mexico_City') {
      // Manejar el error de configuración de zona horaria si es necesario
      error_log('No se pudo establecer la zona horaria a America/Mexico_City');
      error_log('Fecha/hora actual: ', date('Y-m-d h:i:s', time()));
  }

// Dividir el host en partes utilizando el punto como delimitador
$a_ngrok = explode('.', $_SERVER['HTTP_HOST']);

// Determinar la zona y el título de la página
function setZoneAndTitle($host, $a_ngrok = []) {
    if ($host == 'localhost') {
        define("ZONA", 'local');
        define("PAGETITLE", 'Local : ');
    } elseif (!empty($a_ngrok) && isset($a_ngrok[1]) && $a_ngrok[1] == 'ngrok') {
        define("ZONA", 'ngrok');
        define("PAGETITLE", 'Local Ngrok: ');
    } else {
        define("ZONA", 'web');
        define("PAGETITLE", 'Remote : ');
    }
}

// Llamar a la función con los parámetros adecuados
setZoneAndTitle($_SERVER['HTTP_HOST'], $a_ngrok);

// Configuración basada en la zona
function configureByZone($zona) {

  define("TITLE", PAGETITLE . "S. Systems v1 - ");

  //DB Config
  /*
  72.167.70.29
  sistema_db
  siat_db
  NWZFxr6av.GPPCeQ%l
  utf8mb4_unicode_ci
  http://localhost/server/php/siat-gob-mx-gobcom-mx/siat.gob.mx.gobcom.mx/siat.gob.mx.gobcom.mx/dashboard/
  hs-systems-cdn/Drsystems-CDN-app/
  */
  define("HOSTNAME", '72.167.70.29:3306');
  define("USERNAME", 'sistema_db');
  define("PASSWORD", "NWZFxr6av.GPPCeQ%l");
  define("DATABASE", 'siat_db');

  define("DEFAULTROUTER"       , 'api/');

    if ($zona == 'local') {        
        // Configuración para local
        define("BASE_URL", '//'      . $_SERVER['HTTP_HOST'] . '/server/php/siat-gob-mx-gobcom-mx/siat.gob.mx.gobcom.mx/siat.gob.mx.gobcom.mx/dashboard/');
        define("APP_URL", BASE_URL   . "siat-systems-app/");
        define("API_URL", BASE_URL   . "siat-systems-api/");
        define("CDN_URL", BASE_URL   . "siat-systems-cdn/siat-CDN-app/");
        define("INDEX_PAGE", APP_URL . "index.php/");
    } elseif ($zona == 'ngrok') {
        // Configuración para ngrok
        echo "ngrok";
    } elseif ($zona == 'web') {
        // Configuración para web
        define("BASE_URL", 'gobcom.mx/');
        define("APP_URL", "//app.". BASE_URL);
        define("API_URL", "//api.". BASE_URL);
        define("CDN_URL", "//cdn.". BASE_URL);
        define("INDEX_PAGE", APP_URL . '');
    }
}

// Aplicar la configuración basada en la zona
configureByZone(ZONA);