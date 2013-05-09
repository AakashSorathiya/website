<?php
	$remote = "\\\\fileshare.main.ad.rit.edu\\Student Employment";
	$path = "SEOdb\\SEOPrograms-backend.mdb";

	$database = "";

	$user = "seocoop";
	$password = "Tiger321";
/*
	$dsn = implode(
		array(
			"Driver={Microsoft Access Driver (*.mdb)}",
			"DBQ=$remote\\$path"
		),
		";"
	);
*/
	$dsn = implode(
		array(
			"Provider=Microsoft.Jet.OLEDB.4.0",
			"Data Source=$remote\\$path"
		),
		";"
	);

	try
	{
		$dbConnection = odbc_connect($dsn, $user, $password);
	}
	catch( Exception $e )
	{
		var_dump( $e );
	}
	

	//die( $dsn );

	//if( $dbConnection )
	//	echo( "Established Connection" );

	// Close the connection
	//odbc_close($dbConnection);
/**
 *
 */
class FileShareConnection {
	// Local variables
	private $dbConnection = null;

	/**
	 *
	 */
	private function connect( $database ) {
		// Open a connection to the file
		//$this->dbConnection = odbc_connect(dsn, user, password);
	}

	/**
	 *
	 */
	public function getOnCampus() {

	}

	/**
	 *
	 */
	public function getOffCampus() {

	}

	/**
	 *
	 */
	private function close() {
		// Close the connection to the file
		//odbc_close($this->dbConnection);
	}
}