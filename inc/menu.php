<?php

// make the menu in dashboard
function mh_fuel_page_html(){
    if(! is_admin()){
        return ;
    }
    ?>
        <h3 class="text-muted ">USA FUEL PRICE</h3>
        <form action="">
            <div class="col-md-12">
                <label for="state" class="mb-2">States : </label><br><br>
                <select id="state" name="state" class="js-states form-control">
                    <option>Laravel</option>
                    <option>Javascript</option>
                    <option>PHP</option>
                    <option>Visual Basic</option>
                </select>
            </div><br>
            <div class="col-md-12">
                <label for="city" class="mb-2">Cities : </label><br><br>
                <select id="city" name="city" class="js-states form-control">
                    <option>Java</option>
                    <option>Javascript</option>
                    <option>PHP</option>
                    <option>Visual Basic</option>
                </select>
            </div>
            <?php
                submit_button('Filter')
            ?>
        </form>
    <?php
}


//register the top menu here

function mh_register_menu_page(){
    add_menu_page('MH Fuel Price' , 'Fuel Price' , 'manage_options' , 'mh-fuel-price' , 'mh_fuel_page_html' ,'dashicons-car' ,30);
}
add_action('admin_menu','mh_register_menu_page');

?>