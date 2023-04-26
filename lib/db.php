<?php
//for this we'll turn on error output so we can try to see any problems on the screen
//this will be active for any script that includes/requires this one
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function getDB(){
    global $db;
    //this function returns an existing connection or creates a new one if needed
    //and assigns it to the $db variable
    if(!isset($db)) {
        try{
            
            //using the PDO connector create a new connect to the DB
            //if no error occurs we're connected
            $db = new PDO("mysql:host=sql9.freemysqlhosting.net;port=3306;dbname=sql9613849", "sql9613849", "7mnWhuuwL9");
	    //the default fetch mode is FETCH_BOTH which returns the data as both an indexed array and associative array
	    //we'll override the default here so it's always fetched as an associative array
 	    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}
   	catch(Exception $e){
            error_log("getDB() error: " . var_export($e, true));
            $db = null;
        }
    }
    return $db;
}
?>
