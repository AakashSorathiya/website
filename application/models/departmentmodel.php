<?php
/**
 * Create a Department Model
 */
class DepartmentModel extends SEO_Model {
	// Create a table reference
	private $TABLE = 'department';

	// Localized Schema of Table
	var $ID = NULL;
	var $days_open = NULL;
	var $opening_time = NULL;
	var $closing_time = NULL;
	var $name = NULL;

	/**
	 *	Get all instances from the table
	 */
	function get( $where = NULL ) {
		// Construct an initial query
		$query = NULL;

		// Always sort on the name
		$this->db->order_by('name');

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
	 *	Get similar instances
	 */
	function search( $where ) {
		// Set the search
		$this->db->like( $where );

		// Create a query
		$query = $this->db->get( $this->TABLE, 8 );

		// Return the results
		return $query->result();
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