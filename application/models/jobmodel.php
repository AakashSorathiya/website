<?php
/**
 * Create a Job Model
 */
class JobModel extends SEO_Model {
	// Create a table reference
	private $TABLE = 'job';

	// Localized Schema of Table
	var $ID = NULL;
	var $information_id = NULL;
	var $department_id = NULL;
	var $timestamp = NULL;
	var $number = NULL;
	var $current_state = NULL;

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