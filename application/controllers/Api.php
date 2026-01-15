<?php
class Api extends CI_Controller {
//----->

    //--->
    public function __construct()
    {
        parent::__construct();
    }
    //--->

    //--->
    public function index()
    {   
        //-----------------------------------
        //  Api Time x
        //-----------------------------------
        //----->
            $url = 'http://worldtimeapi.org/api/timezone/America/Mexico_City';

            // Contexto con timeout
            $context = stream_context_create([
                'http' => [
                    'method'  => 'GET',
                    'timeout' => 5
                ]
            ]);

            $json = @file_get_contents($url, false, $context);

            // ❌ Error de conexión
            if ($json === FALSE) {

                log_message('error', 'WorldTimeAPI no respondió');

                $xr8_data['Api Time x'] = [
                    'error'   => true,
                    'message' => 'No se pudo conectar a la API'
                ];

                // Ejemplo: enviar a la vista            
                return;
            }

            // Decodificar JSON
            $decoded = json_decode($json, true);

            // ❌ JSON inválido
            if (json_last_error() !== JSON_ERROR_NONE) {

                log_message('error', 'JSON inválido desde WorldTimeAPI');

                $xr8_data['Api Time x'] = [
                    'error'   => true,
                    'message' => 'Respuesta inválida de la API'
                ];
                return;
            }
        //----->

        //-----------------------------------
        //  Api Time y
        //-----------------------------------
        //----->
            $ip = $this->input->ip_address();
            $url = 'http://ip-api.com/json/'.$ip.'?fields=66322431&lang=es';

            // Contexto con timeout
            $context = stream_context_create([
                'http' => [
                    'method'  => 'GET',
                    'timeout' => 5
                ]
            ]);

            $json = @file_get_contents($url, false, $context);

            // ❌ Error de conexión
            if ($json === FALSE) {

                log_message('error', 'WorldTimeAPI no respondió');

                $xr8_data['Api Time y'] = [
                    'error'   => true,
                    'message' => 'No se pudo conectar a la API'
                ];

                // Ejemplo: enviar a la vista            
                return;
            }

            // Decodificar JSON
            $decoded2 = json_decode($json, true);

            // ❌ JSON inválido
            if (json_last_error() !== JSON_ERROR_NONE) {

                log_message('error', 'JSON inválido desde WorldTimeAPI');

                $xr8_data['Api Time y'] = [
                    'error'   => true,
                    'message' => 'Respuesta inválida de la API'
                ];
                return;
            }
        //----->

        // ✅ Respuesta OK
        $xr8_data['Api Time x']     = $decoded;
        $xr8_data['Api Time y']     = $decoded2;

        $xr8_data['Api Connection'] = random_string('alpha', 20);
        $xr8_data['Api Time']       = date("Y-m-d H:i:s.u");
        $xr8_data['Api V']          = "1.0";
        
        $this->output->set_content_type('application/json')->set_output(json_encode($xr8_data));
    }
    //--->

    //----->
}
