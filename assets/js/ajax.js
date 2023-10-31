jQuery(document).ready(function() {


    // run on change the value of state select list
    
    jQuery('#state').change(function() {
        var selectedValue = jQuery(this).val();

        console.log("On Change Value : " + selectedValue);
        // Send the selected value to a PHP function using AJAX
        jQuery.ajax({
            type: 'POST',
            url: mh_ajax_url.ajax_url   , // Replace with the actual URL of your AJAX handler
            data: {
                action: 'mh_filter_ajax_action',
                state_code: selectedValue,
            },
            success: function(response) {
                
                // Handle the response from the server
                var stateData = response.result.state;
                var citiesData = response.result.cities;

                // Clear previous table data
                var fuelPriceTable = jQuery('#FuelPrice');
                fuelPriceTable.empty();

                // Append a row for the state
                // var stateRow = "<tr><td>1</td><td>" + stateData.name + "</td><td>" + stateData.diesel + "</td></tr>";
                // fuelPriceTable.append(stateRow);

                // Append rows for cities
                if (citiesData.length > 0) {
                    jQuery.each(citiesData, function(index, city) {
                        var cityRow = "<tr><td>" + (index + 1) + "</td><td>" + stateData.name + "</td><td>" + stateData.diesel + "</td><td>" + city.name + "</td><td>" + city.diesel + "</td></tr>";
                        fuelPriceTable.append(cityRow);
                    });
                } else {
                    fuelPriceTable.append("<tr><td colspan='5'>No cities found for this state.</td></tr>");
                }
            },
        });
    });
});