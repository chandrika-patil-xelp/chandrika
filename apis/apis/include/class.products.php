<?php
	include APICLUDE.'common/db.class.php';
	class products extends DB
    {
		function __construct($db) {
			parent::DB($db);
		}
		
		public function pByType($ptype)
		{
			if($ptype)
				$part = ' AND ptype = "'.$ptype.'" ';
			$sql = "SELECT 
						pname, 
						pcode 
					FROM 
						product 
					WHERE 
						pstatus=1 
					".$part."
					ORDER BY pcode";
			$res = $this->query($sql);
			if($res)
			{
				while($row = $this->fetchData($res))
				{
					$arr[] = $row;
				}
			}
			return $arr;
                                
                
                }
                 
                public function pByCode($pcode)
		{
			$sql = "SELECT * FROM product LEFT JOIN diamond_cat ON product.diamond_id=diamond_cat.did
                                LEFT JOIN gold_cat on product.gold_id=gold_cat.gid
                                WHERE product.pcode=".$pcode." order by product.pcode";
			$res = $this->query($sql);
			if($res)
			{
				while($row = $this->numRows($res))
				{
					$arr = $this->fetchData($res);
				}
			}
			//echo "<pre>";print_r($arr);die;
			return $arr;
		}
                
                public function pByName($nm)
		{
                        $sql = "SELECT *,IF(pname LIKE '%".$nm."%',1,0) as startwith FROM product
                                WHERE pname LIKE '%$nm%' ORDER BY startwith DESC";
                        $res = $this->query($sql);
			if($res)
			{
				while($row = $this->numRows($res))
				{
					$arr = $this->fetchData($res);
				}
			}
			return $arr;
		}
                
                public function pInsert($val)
                {
                        
                }
                
                
    }
    
?>