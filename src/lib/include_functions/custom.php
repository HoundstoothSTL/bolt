<?php

// Put project specific functions here:

//*** Pull in Custom Post Types
//require_once('libs/custom_post_types/example.php');

//*** Pull in Custom Taxonomies
//require_once('libs/custom_taxonomies/example.php');

//*** Register the Gravity Forms ACF Field : Requires Advnaced Custom Fields & Gravity Forms Plugins
if(function_exists('register_field')) { 
  register_field('Gravity_Forms_field', get_template_directory() . '/lib/gravity-forms-acf/gravity_forms.php');
}