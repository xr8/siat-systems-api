<?php
class Api extends CI_Controller {
//----->

    //--->
    public function __construct(){
        parent::__construct();
        }
    //--->

    //--->
    public function index()
    {   
        //----->worldtimeapi
        /*
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
                */
        //----->worldtimeapi

        //----->ip-api
        /*
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
        */
        //----->ip-api

        //----->
            // Set IP address and API access key
            $ip = $_SERVER['REMOTE_ADDR'];
            
            $access_key = 'c2182ef5-2206-4e85-ae5d-aa17ef575d51';

            // Initialize CURL
            $ch = curl_init('https://apiip.net/api/check?ip='.$ip.'&accessKey='.$access_key.'');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Store the data
            $json_res = curl_exec($ch);
            curl_close($ch);
            
            // Decode JSON response
            $decoded3 = $api_result = json_decode($json_res, true);

            // Output the "code" value inside "currency" object
            //$decoded3 = $api_result['currency']['code'];
        //----->

        // ✅ Respuesta OK
        //$xr8_data['Api Time x']     = $decoded;
        //$xr8_data['Api Time y']     = $decoded2;
        $xr8_data['Api Time z']     = $decoded3;

        $xr8_data['Api Connection'] = random_string('alpha', 20);
        $xr8_data['Api Time']       = date("Y-m-d H:i:s.u");
        $xr8_data['Api V']          = "1.0";
        
        $this->output->set_content_type('application/json')->set_output(json_encode($xr8_data));
    }
    //--->

    //----->
}
