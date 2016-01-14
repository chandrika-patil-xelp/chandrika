<?php

include_once APICLUDE.'common/db.class.php';

class product extends DB
{
    function __construct($db) {
        parent::DB($db);
    }
    
}


?>