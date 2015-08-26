<?php
        include APICLUDE.'common/db.class.php';
	class users extends DB
    {
		function __construct($db) 
                {
			parent::DB($db);
		}
		
		public function usLogin($un,$pass) // USER LOGIN CHECK
		 {
			if((!empty($un))&&(!empty($pass)))
                        $part = ' AND username="'.$un.'" AND password="'.$pass.'"';
			$sql  = "SELECT
						log_id,
                                                user_id,
                                                user_type,
                                                uname,
                                                email,
                                                username,
                                                password,
                                                facility,
					FROM 
						users 
					WHERE 
						status=1  ".$part." ";
			$res = $this->query($sql);
			if($res)
			{ while($row = $this->fetchData($res))
			{ $arr[] = $row; }
			} return $arr;
		}
		
		public function uPass($un,$npass,$utype) //Update Password
		{
                    if($utype==2)        // For Customers
                    {
                        $sql = "UPDATE
                                                customer,
                                                users
                                        SET     user.password=MD5(\"$npass\"),
                                                customer.last_updated=now()
                                        WHERE   
                                                users.username = $un";
			$res = $this->query($sql);
			if($res)
			{
				if($this->numRows($res))
				{
					$arr = $this->fetchData($res);
				}
			}
			return $arr;
                    }
                    if($utype==1)
                    {
                        $sql = "UPDATE
                                                users,
                                                vendor
                                        SET     user.password=MD5(\"$newpass\"),
                                                vendor.last_updated=now()
                                        WHERE   
                                                users.username = $username";
			$res = $this->query($sql);
			if($res)
			{
				if($this->numRows($res))
				{
					$arr = $this->fetchData($res);
				}
			}

			return $arr;            
                    }      // For Vendors
                }
		
		public function usDetail($un,$upass,$utype) //User Details regarding usertype 
		{   
                    if($utype==2)       // For Customers
                    {
			$sql = "SELECT * FROM 	users,customer 
					 WHERE   users.username=customer.username 
                                         AND     users.password=customer.password
                                         AND     users.user_type=customer.user_type     
                                         AND     users.username = \"".$un."\" 
					 AND     users.password = \"".$upass."\" 
					 AND     status=1 
				Group by users.username";
			$res = $this->query($sql);
			if($res)
			{
				if($this->numRows($res))
				{
					$arr = $this->fetchData($res);
					
                                }
			}
			return $arr;
                    }
                    if($utype==3)       // For Vendors
                    {
			$sql = "SELECT * FROM 	users,vendor 
					 WHERE   users.username=vendor.username 
                                         AND     users.password=vendor.password
                                         AND     users.user_type=vendor.user_type     
                                         AND     users.username = \"".$un."\" 
					 AND     users.password = \"".$upass."\" 
					 AND     status=1 
				Group by users.username";
			$res = $this->query($sql);
			if($res)
			{
				if($this->numRows($res))
				{
					$arr = $this->fetchData($res);
					$arr['country_hist'] = mb_convert_encoding($arr['country_hist'], "UTF-8", "HTML-ENTITIES");
				}
			}
			return $arr;
                    }
                }
    }
?>