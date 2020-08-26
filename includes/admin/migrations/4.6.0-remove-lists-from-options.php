<?php

global $wpdb;
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'ema4wp_zozoema_list_%'" );
