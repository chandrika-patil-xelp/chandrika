<?php

	include APICLUDE.'common/db.class.php';
	class custDesgn extends DB
    {
		function __construct($db) 
                {
			parent::DB($db);
		}
		
		public function shwDesgn($uId) 
		 {
			if(!empty($uId))
                        $part = ' AND username="'.$un.'" AND password="'.$pass.'"';
			$sql  = "SELECT
                                            dp 
                                 FROM 
                                            customdesign 
                                 WHERE 
                                            user_id= '$user_id'
                                 AND 
                                            status=1 
                                 ORDER BY 
                                            cdid";
			$res = $this->query($sql);
			if($res)
			{ while($row = $this->fetchData($res))
			{ $arr[] = $row; }
			} return $arr;
		}
    }
?>