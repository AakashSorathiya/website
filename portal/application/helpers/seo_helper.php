<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Form Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/form_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Create an option array for a drop down dialog
 */
if ( !( function_exists('to_options_array') ) ) {
	//
	//	Create a select array
	function to_options_array( $obj_arr, $key_key, $value_key, $only_unique = true ) {
		// Create an options array
		$options = array();
		$unique = array();

		// Loop through each object
		foreach( $obj_arr as $val => $obj ) {
			// Check for only unique entries
			if( $only_unique && !( in_array( $obj->$value_key, $unique ) ) ) {
				// Push the unique key onto the array
				array_push( $unique, $obj->$value_key );

				// Store the object
				$options[rawurldecode($obj->$key_key)] = rawurldecode( $obj->$value_key );
			} else if( !( $only_unique ) ) {
				// Store the object
				$options[rawurldecode($obj->$key_key)] = rawurldecode( $obj->$value_key );
			}
		}

		// Return the options
		return $options;
	}
}

/**
 *	Parse a shortened day string
 */
if ( !( function_exists('parse_day_string') ) ) {
	//
	//	Create a select array
	function parse_day_string( $day_str ) {
		// Create a lookup
		$lookup = array(
			'Sun' => 'Sunday',
			'Mon' => 'Monday',
			'Tue' => 'Tuesday',
			'Wed' => 'Wednesday',
			'Thu' => 'Thursday',
			'Fri' => 'Friday',
			'Sat' => 'Saturday',
			'MonTueWedThuFri' => 'Weekdays',
			'SatSun' => 'Weekends'
		);

		// Create a value to return
		$value = ( isset( $lookup[$day_str] ) ? $lookup[$day_str] : "" );

		// Check the value string
		if( $value == "" ) {
			// Create a starting point
			$start = 0;

			while( $start < strlen( $day_str ) ) {
				// Append a separator if further in the string
				if( $value != "" ) $value .= ", ";

				// Get the day
				$day = substr( $day_str, $start, 3 );

				// Append the day
				$value .= $lookup[$day];

				// Increment the start
				$start += 3;
			}
		}

		// Return the new string
		return $value;
	}
}