<?php

class dbclass 
{
var $initdebug = false;
var $starttime;
var $no_of_exe_queries;
var $last_obtain_result;
var $connector;
var $database;
    
    function dbclass($con)
        { 
        $this->database = $con; //assign mysql connection
        $this->starttime = $this->getMicroTime(); // Return current Unix timestamp with microseconds
        $this->no_of_exe_queries = 0; //initially none query executed.
        $this->last_obtain_result = NULL; //starting fresh
        $this->connector = @mysql_connect($con[0], $con[1], $con[2], true); 
        
        //@ - to suppress error
        //mysql connection in a variable.
    }
    
    function __destruct() //Destructor. 
    {
         if($this->database)
         mysql_close($this->database); 
    }
    
    function firequery($query, $debug = -1) //every mysql Query = $query   debug - $debug set to false.
    {
        @mysql_select_db($this->database[3],$this->connector); //4th element of database array
     
        $this->no_of_exe_queries++; //counter starts with increment here
        $this->last_obtain_result = mysql_query($query,$this->connector) or $this->debugordie($query); 
        $this->debug($debug, $query, $this->last_obtain_result); 
        return $this->last_obtain_result; 
    }
    /* Should be used for INSERT, UPDATE, DELETE...
     @param $query The query.
     @param $debug If true, it output the query and the resulting table.
    */
    
    function execute($query, $debug = -1) 
    {
        $this->no_of_exe_queries++;
        mysql_query($query) or $this->debugordie($query); //perform or show error
        $this->debug($debug, $query);
    }
    
    
    // @param $result -- The output returned by query(). 
    // If $result is NULL, then last output returned by query() will be used. 
    
    function bringdata($result = NULL) 
    { 
        if ($result == NULL) //if nothing is there.
            $result = $this->last_obtain_result;

        if ($result == NULL || mysql_num_rows($result) < 1) // if table empty table or no returned values
            return NULL;
        else
            
            return mysql_fetch_assoc($result); //if output has values then this
    }
    
    /*
     * @ Function Name	: mysql_bring_ary
     * @ Purpose			: To bring o/p in the associative array form of selected mysql query 
     * @ Input			: Resource Id 
     * @ Return Value	: Array - Associative array of selected mysql query 
     */

    public function mysql_bring_ary($resid) //fetching data 
    {
        $return_ary = array(); //declared an array
        if ($resid) 
        {
            $i = 0;
            while ($row = mysql_fetch_assoc($resid)) 
            {
                $return_ary[$i] = $row; //every array element is fetched one by one.
                $i++;
            }
        }
        unset($resid, $i); // flushing the variables.
        return $return_ary; //returns the result
    }
    
    function num_of_rows($result = NULL) //counting num of rows
    {
        if ($result == NULL) 
            return @mysql_num_rows($this->last_obtain_result);
        else
            return @mysql_num_rows($result);
    }
    
    
    
    ## Get the result of the query as an object. The query should return a unique row.\n
    ## Note: no need to add "LIMIT 1" at the end of your query because
    ## the method will add that (for optimisation purpose).
    ## @param $query The query.
    ## @param $debug If true, it output the query and the resulting row.
    ## @return An object representing a data row (or NULL if result is empty).
    
    function queryuniqueobject($query, $debug = -1) 
    {
        $query = "$query LIMIT 1";
        $this->no_of_exe_queries++;
        $result = mysql_query($query) or $this->debugordie($query);
        $this->debug($debug, $query, $result);
        return mysql_fetch_object($result);
    }
    ## Get the result of the query as value. The query should return a unique cell.\n
    ## Note: no need to add "LIMIT 1" at the end of your query because
    ## the method will add that (for optimisation purpose).
    ## @param $query The query.
    ## @param $debug If true, it output the query and the resulting value.
    ## @return A value representing a data cell (or NULL if result is empty).

    function queryuniquevalue($query, $debug = -1)
    {
        $query = "$query LIMIT 1";
        $this->no_of_exe_queries++;
        $result = mysql_query($query) or $this->debugordie($query);
        $line = mysql_fetch_row($result);
        $this->debug($debug, $query, $result);
        return $line[0];
    }

    ## Get the maximum value of a column in a table, with a condition.
    ## @param $column The column where to compute the maximum.
    ## @param $table The table where to compute the maximum.
    ## @param $where The condition before to compute the maximum.
    ## @return The maximum value (or NULL if result is empty).

    function maxwithcondition($column, $table, $where) 
    {
        return $this->queryuniquevalue("SELECT MAX(`$column`) FROM `$table` WHERE $where");
    }

    ## Get the maximum value of a column in a table.
    ## @param $column The column where to compute the maximum.
    ## @param $table The table where to compute the maximum.
    ## @return The maximum value (or NULL if result is empty).

    function maxall($column, $table) 
    {
        return $this->queryuniquevalue("SELECT MAX(`$column`) FROM `$table`");
    }

 function countof($table, $where) 
    {
        return $this->queryuniquevalue("SELECT COUNT(*) FROM `$table` WHERE $where");
    }

    ## Get the count of rows in a table.
    ## @param $table The table where to compute the number of rows.
    ## @return The number of rows (0 or more).

    function countofall($table) 
    {
        return $this->queryuniquevalue("SELECT COUNT(*) FROM `$table`");
    }

    ## Internal function to debug when MySQL encountered an error,
    ## even if debug is set to Off.
    ## @param $query The SQL query to echo before diying.

    function debugordie($query) 
    {
        //$this->debugQuery($query, "Error");
        return false;
    }
    
    ## Internal function to debug a MySQL query.\n
    ## Show the query and output the resulting table if not NULL.
    ## @param $debug The parameter passed to query() functions. Can be boolean or -1 (default).
    ## @param $query The SQL query to debug.
    ## @param $result The resulting table of the query, if available.
    
    function debug($debug, $query, $result = NULL) 
    {
        if ($debug === -1 && $this->initdebug === false)
            return;
        if ($debug === false)
            return;

        $reason = ($debug === -1 ? 'Initial Debugging ' : 'Debug');
        $this->debugquery($query, $reason);
        if ($result == NULL)
            echo '<br /><p style="border-top:1px solid #e2e2e2;font:15px verdana;margin:2px;">Number of affected rows: ' . mysql_affected_rows() . '</p></div>';
        else
            $this->debugresult($result);

        exit;
    }
    
    ## Internal function to output a query for debug purpose.\n
    ## Should be followed by a call to debugResult() or an echo of "</div>".
    ## @param $query The SQL query to debug.
    ## @param $reason The reason why this function is called: "Default Debug", "Debug" or "Error".

    function debugquery($query, $reason = "Debug") {
        $color = ($reason == "Error" ? "red" : "green");
        echo '<div style="font:16px verdana;border:solid ' . $color . ' 1px;margin:2px;">' .
        '<p style="margin:0px 0px 2px 0px;padding:0;background-color:#D6EACC;">' .
        '<strong style="padding:0px 31px 1px 0px;background-color:' . $color . ';color:white;"> ' . $reason . ':</strong>' .
        '<span style="font-family:monospace;">&nbsp;' . htmlentities($query) . '</span></p>' .
        '<strong style="padding:0px 31px 1px 0px;background-color:' . $color . ';color:white;"> Server:</strong>' .
        '<span style="font-family:monospace;">&nbsp;' . $this->db[0] . ", " . $this->db[1] . ", " . $this->db[2] . ", " . $this->db[3] . '</span></p>' .
        '<p style="margin:5px 0px 2px 0px;padding:0;background-color:#FFECF1;">' .
        '<strong style="padding:0px 40px 2px 2px;background-color:red;color:white;">Error:</strong>' .
        '<span style="font-family:monospace;">&nbsp;<b>' . htmlentities(mysql_error()) . '</b></span></p>';
    }

    ## Internal function to output a table representing the result of a query, for debug purpose.\n
    ## Should be preceded by a call to debugQuery().
    ## @param $result The resulting table of the query.

    function debugresult($result) 
    {
        echo '<table border="0" style="border:0px solid gray;margin:2px;font-family:georgia;color:#330066;"><thead style="font-size:80%">';
        $numFields = mysql_num_fields($result); //used in counting the number of fields for 
        // BEGIN HEADER
        $tables = array();
        $no_of_tables = -1;
        $last_table_result = "";
        $fields = array();
        $no_of_fields = -1;

        while ($column = mysql_fetch_field($result)) 
        {
            if ($column->table != $last_table_result) 
            {
                $no_of_tables++;
                $tables[$no_of_tables] = array("name" => $column->table, "count" => 1);
            }
            else
                $tables[$no_of_tables]["count"]++;

            $last_table_result = $column->table;
            $no_of_fields++;
            $fields[$no_of_fields] = $column->name;
        }
        
        for ($i = 0; $i <= $no_of_tables; $i++)
            echo '<th colspan="' . $tables[$i]['count'] . '" style="background-color:#606060;color:#FFFF00;">Table &raquo; ' . $tables[$i]['name'] . '</th>';
        echo '</thead>';
        echo '<thead style="font-size:80%;background-color:#e2e2e2;color:#0066FF;">';

        for ($i = 0; $i <= $no_of_fields; $i++)
            echo '<th>' . $fields[$i] . '</th>';
        echo '</thead>';

        // END HEADER
        while ($row = mysql_fetch_array($result)) 
        {
            echo '<tr>';
            for ($i = 0; $i < $numFields; $i++)
                echo '<td align="center" style="background-color:#e2e2e2;color:#0042A4;">' . htmlentities($row[$i]) . '</td>';
            echo '</tr>';
        }
        echo '</table></div>';
        $this->resetFetch($result);
    }

    ## Get how many time the script took from the begin of this object.
    ## @return The script execution time in seconds since the
    ## creation of this object.

    function get_execute_time() 
    {
        return round(($this->getMicroTime() - $this->starttime) * 1000) / 1000;
    }

    ## Get the number of queries executed from the begin of this object.
    ## @return The number of queries executed on the database server since the
    ## creation of this object.

    function getQueriesCount() 
    {
        return $this->no_of_queries;
    }

    ## Go back to the first element of the result line.
    ## @param $result The resssource returned by a query() function.

    function resetFetch($result) 
    {
        if (mysql_num_rows($result) > 0)
            mysql_data_seek($result, 0);
    }

    ## Get the id of the very last inserted row.
    ## @return The id of the very last inserted row (in any table).

    function lastInsertedId() 
    {
        return mysql_insert_id();
    }

    ## Close the connexion with the database server.\n
    ## It's usually unneeded since PHP do it automatically at script end.

    function close() 
    {
        /* return;
          if($this->links)
          mysql_close($this->links); */
        unset($this->db);
        if ($this->connector) {
            mysql_close($this->connector);
        }
        return;
    }

    ## Internal method to get the current time.
    ## @return The current time in seconds with microseconds (in float format).

    function getMicroTime()
    {
        list($msec, $sec) = explode(' ', microtime());
        return floor($sec / 1000) + $msec;
    }
}
## END OF CLASS DB
?>
