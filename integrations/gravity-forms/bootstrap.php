<?php

defined( 'ABSPATH' ) or exit;

ema4wp_register_integration( 'gravity-forms', 'EMA4WP_Gravity_Forms_Integration', true );

if ( class_exists( 'GF_Fields' ) ) {
	GF_Fields::register( new EMA4WP_Gravity_Forms_Field() );
}
