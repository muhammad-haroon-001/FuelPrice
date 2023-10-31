<?php

//get the state code and then fetch data from api against this record

function mh_filter_ajax_action(){
    $code = $_POST['state_code'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.collectapi.com/gasPrice/stateUsaPrice?state=".$code,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: apikey 70EcHFr4Q66FqNnxBMuaxS:0619UzNaJ86CdTNxRnEPrf",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $data = json_decode($response , true);

    // send the json request to ajax.js file
    wp_send_json($data);
}
add_action('wp_ajax_mh_filter_ajax_action','mh_filter_ajax_action');
add_action('wp_ajax_nopriv_mh_filter_ajax_action','mh_filter_ajax_action');
?>