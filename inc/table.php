<?php

// make the state table in database 
    function mh_state_table(){
        global $wpdb;

        $table_name = $wpdb->prefix . "mh_states";  

        $charset_collate = $wpdb->get_charset_collate();

    // Check firstly id=f the table of this name is not exists then its make the table in database

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        state_name varchar(55) NOT NULL,
        state_code varchar(55) NOT NULL,
        PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }


    // its only make when my plugin is activate

    register_deactivation_hook(__FILE__ , 'mh_state_table');
?>