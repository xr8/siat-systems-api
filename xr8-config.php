<?php
// Establecer la zona horaria predeterminada
date_default_timezone_set('America/Mexico_City');

// Verificar que la zona horaria se haya establecido correctamente
if (date_default_timezone_get() !== 'America/Mexico_City') {
  // Manejar el error de configuración de zona horaria si es necesario
  error_log('No se pudo establecer la zona horaria a America/Mexico_City');
  error_log('Fecha/hora actual: ', date('Y-m-d h:i:s', time()));
}

// Determinar la zona y el título de la página
function setZoneAndTitle($host, $a_ngrok = [])
{
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
// Configuración basada en la zona
function configureByZone($zona)
{
  if ($zona == 'local') {

    //JM LOCALHOST
    define("HOSTNAME", 'localhost');
    define("USERNAME", 'root');
    define("PASSWORD", "aeiou12345");
    define("DATABASE", 'siat_db');

    define("BASE_URL",   '//'       . $_SERVER['HTTP_HOST'] . '/server/php/siat-gob-mx-gobcom-mx/siat.gob.mx.gobcom.mx/siat.gob.mx.gobcom.mx/dashboard/');
    define("APP_URL",    BASE_URL   . "siat-systems-app/");
    define("API_URL",    BASE_URL   . "siat-systems-api/");
    define("CDN_URL",    BASE_URL   . "siat-systems-cdn/siat-CDN-app/");
    define("INDEX_PAGE", APP_URL    . "index.php/");

  } elseif ($zona == 'ngrok') {
    // Configuración para ngrok
    echo "ngrok";
  } elseif ($zona == 'web') {
    
    //JM WEB
    define("HOSTNAME", '107.180.115.28');
    define("USERNAME", 'sistema_db');
    define("PASSWORD", "&);ud!.DGP^R5*v");
    define("DATABASE", 'jm_siat_db');

    define("BASE_URL", 'siatgobcom.mx/');
    define("APP_URL", "//app." . BASE_URL);
    define("API_URL", "//api." . BASE_URL);
    define("CDN_URL", "//cdn." . BASE_URL ."siat-CDN-app/");
    define("INDEX_PAGE", APP_URL . '');
  }
}

### Begin: setZoneAndTitle ###
  // Dividir el host en partes utilizando el punto como delimitador
  $a_ngrok = explode('.', $_SERVER['HTTP_HOST']);
  // Llamar a la función con los parámetros adecuados
  setZoneAndTitle($_SERVER['HTTP_HOST'], $a_ngrok);
### End: setZoneAndTitle ###

### Begin: configureByZone ###
// Aplicar la configuración basada en la zona
configureByZone(ZONA);
### End: configureByZone ###

// Definir constantes globales***
define("NAME",          "APP SYSTEMS");
define("DEFAULTROUTER", 'login/sign_in');
define("TITLE",         PAGETITLE . "JM SIAT Systems v1 - ");