<?php

// return the desgin on website
function mh_fuel_websit_page_html() {
    // Start output buffering
    ob_start(); 
    ?>
        <div class="container">
            <div class="card rounded-0 mt-2">
                <div class="card-header rounded-0">
                    <h3 class="text-uppercase">USA FUEL PRICE FilTER</h3>
                </div>
                <div class="card-body rounded-0">
                    <form action="">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="state" class="mb-2">States</label>
                                <select id="state" name="state" class="form-control  rounded-0">
                                    <option value="">Select a State</option>
                                    <?php
                                        global $wpdb;
                                        $results = $wpdb->get_results("SELECT state_name, state_code FROM wp_mh_states", ARRAY_A); 
                                        foreach ($results as $result) : 
                                    ?>
                                        <option value="<?php echo $result['state_code']; ?>"><?php echo $result['state_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- <div class="col-md-5">
                                <label for="city" class="mb-2">Cities</label>
                                <select id="city" name="city" class="js-states form-control  rounded-0">
                                    <option>Java</option>
                                    <option>Javascript</option>
                                    <option>PHP</option>
                                    <option>Visual Basic</option>
                                </select>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive mt-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>State</th>
                            <th>State Diesel Price</th>
                            <th>City</th>
                            <th>State City Price</th>
                        </tr>
                    </thead>
                    <tbody id="FuelPrice">
                        <tr>
                            <td class="text-center" colspan="5">No Record Found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    // Get the buffered content and store it in a variable
    $html = ob_get_clean(); 
    return $html;
}

// make shortcode that we we according to our need
function mh_fuel_price_shortcode() {
    global $wpdb;

    // get table count

    $record_count = $wpdb->get_var("SELECT COUNT(*) FROM wp_mh_states");

    // check if record count greather than one then  API not Hit
    if($record_count < 0){
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.collectapi.com/gasPrice/usaStateCode",
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

        if (!$err) {
            $data = json_decode($response, true);

            if (is_array($data)) {

                foreach ($data['result'] as $item) {
                    
                    if (isset($item['name']) && isset($item['code'])) {
                        $state_name = $item['name'];
                        $state_code = $item['code'];

                        if (!empty($state_name) && !empty($state_code)) {
                            $wpdb->insert(
                                'wp_mh_states',
                                array(
                                    'state_name' => $state_name,
                                    'state_code' => $state_code,
                                )
                            );
                        }
                    }
                }
            }
        }

    }
    return mh_fuel_websit_page_html();
}
add_shortcode('fuel_price', 'mh_fuel_price_shortcode');


//Filters file here
require plugin_dir_path(__FILE__). 'filter.php';
?>