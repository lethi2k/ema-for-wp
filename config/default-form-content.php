<?php

$email_label       = esc_html__( 'Email address', 'zozoema-for-wp' );
$email_placeholder = esc_html__( 'Your email address', 'zozoema-for-wp' );
$signup_button     = esc_html__( 'Sign up', 'zozoema-for-wp' );

$content  = "<p>\n\t<label>{$email_label}: \n";
$content .= "\t\t<input type=\"email\" name=\"EMAIL\" placeholder=\"{$email_placeholder}\" required />\n</label>\n</p>\n\n";
$content .= "<p>\n\t<input type=\"submit\" value=\"{$signup_button}\" />\n</p>";

return $content;
