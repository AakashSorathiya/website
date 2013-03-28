<?php
/**
 * Create a Type Model
 */
class TypeModel extends SEO_Model {
	// Create a table reference
	private $TABLE = 'types';

	// Localized Schema of Table
	var $ID = NULL;
	var $label = NULL;

	/**
	 *	Get all instances from the table
	 */
	function get( $where = NULL ) {
		// Construct an initial query
		$query = NULL;

		// Check for a defined attribute
		if( $where != NULL ) {
			// Create a query based on the passed in attributes
			$query = $this->db->get_where( $this->TABLE, $where );
		} else {
			// Create a query based on all entries
			$query = $this->db->get( $this->TABLE );
		}

		// Return the result of the query
		return $query->result();
	}

	/**
	 *	Get a single instance from the table
	 */
	function getOne( $where = NULL ) {
		// Get all instances
		$all = $this->get( $where );

		// Return the first
		return $all[0];
	}

	/**
	 *  Insert an instance into the database
	 */
	function insert( $obj ) {
		$this->db->insert( $this->TABLE, $obj );
		return $this->db->insert_id();
	}

	/**
	 *  Update an instance in the database
	 */
	function update( $obj ) {
		$this->db->update( $this->TABLE, $obj, array( 'ID' => $obj->ID ) );
	}

	/**
	 *  Delete an instance in the database
	 */
	function delete( $obj ) {
		$this->db->delete( $this->TABLE, array( 'ID' => $obj->ID ) );
	}
}

/**
 * Create a Type Enum
 */
class TypeEnum {
	// Create constant values for the enumerator
	const ACADEMIC = 1;
	const ATHLETIC = 2;
	const CLERICAL = 3;
	const COMMUNITY_SERVICE = 4;
	const COMPUTER_TECHNICAL = 5;
	const FOOD_SERVICE = 6;
	const MAINTENANCE = 7;
	const MISCELLANEOUS = 8;
	const SERVICES = 9;
	const PERSONAL_SERVICES = 10;
	const SALES = 11;
	const SUMMER = 12;
	const TELEMARKETING = 13;
}