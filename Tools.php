<?php
//======================================================================================================================
//                                                          //Informacion y metodos basica de la base de datos
class FilantropiaDB
{
    public static $DB_SERVER = 'filantropiadb.c8sdfecsnkao.us-east-2.rds.amazonaws.com';
    public static $DB_USERNAME = 'Jolum';
    public static $DB_PASSWORD = 'FilantropiaDB1234';
    public static $DB_DATABASE = 'Botzilla';
}

//======================================================================================================================

class Tools
{
  //--------------------------------------------------------------------------------------------------------------------
	function CallStoredProcedure($strProcedure,$paramtypes, $params)
	{

		$res = null;
		if ( $params != null )
		{
			//                                                    //Se crea la conexion a la base de datos
			$mysqli = new mysqli(FilantropiaDB::$DB_SERVER, FilantropiaDB::$DB_USERNAME, FilantropiaDB::$DB_PASSWORD,
				FilantropiaDB::$DB_DATABASE );

			if($mysqli->connect_error) {
				$this->last_error = 'Cannot connect to database. ' . $mysqli->connect_error;
			}
			
			$placeholders = array_fill( 0, count( $params ), '?' );
			$sql = "Call $strProcedure" . '(' . implode( ', ', $placeholders ) . ');';
			
			$param_type = $paramtypes;
			$a_params[] = &$param_type;
			for($i = 0; $i < count($params); $i++) {
				/* with call_user_func_array, array params must be passed by reference */
				$a_params[] = &$params[$i];
			}

		
			/* Prepare statement */
			$stmt = $mysqli->prepare($sql);
			if($stmt === false) {
			   trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->errno . ' ' . $conn->error, E_USER_ERROR);
			}

			/* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
		
			call_user_func_array(array($stmt, 'bind_param'), $a_params);
			
			/* Execute statement */
			$stmt->execute();
		
			/* Fetch result to array */
			$res = $stmt->get_result();
			
			$rows = array();
			while($row = $res->fetch_array(MYSQLI_NUM)) 
			{
				foreach ($row as $colum ) 
				{
					array_push($rows, $colum);
				}
			}
			
			preg_match_all ('/(\S[^:]+): (\d+)/', $mysqli->info, $matches); 
    		$mod = array_combine ($matches[1], $matches[2]);
			
			$mysqli->close();
			return $rows;

		}
		else
		{
			
			//                                                    //Se crea la conexion a la base de datos
			$connection = mysqli_connect(FilantropiaDB::$DB_SERVER, FilantropiaDB::$DB_USERNAME, FilantropiaDB::$DB_PASSWORD,
				FilantropiaDB::$DB_DATABASE);
			
			mysqli_set_charset($connection, "utf8");
			$sql = "CALL $strProcedure();";
			$result = mysqli_query($connection, $sql);
			

			$posts = array();
			$rows = array();
			while($row = mysqli_fetch_array($result, MYSQLI_NUM))
			{
				
				$rows[] = $row;
			}

			foreach ($rows as $row ) {
				foreach ($row as $colum ) {

					
					array_push($posts, $colum);
				}
			}
			
			$mod = mysqli_affected_rows($connection);
			@mysqli_close($connection);
			
			return $posts;
		}
	}
	
	

}
//======================================================================================================================
?>
