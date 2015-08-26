<?php

	include APICLUDE.'common/db.class.php';
	class auto extends DB
    {
		function __construct($db) {
			parent::DB($db);
		}
		
		public function cAuto($str)
		{
			if(!empty($str))
			{
				$sql = "SELECT 
					id,
					title, 
					MATCH(title) AGAINST('".str_replace(' ','+ ',$str)."*' IN BOOLEAN MODE) AS score 
				FROM 
					tbl_currency_data 
				WHERE 
					MATCH(title) AGAINST('".str_replace(' ','+ ',$str)."*' IN BOOLEAN MODE) 
				AND
					display_flag = 1
				GROUP BY 
					title 
				ORDER BY 
					score DESC
				LIMIT 5";
			}
			else
			{
				$sql = "SELECT 
					id,
					title, 
					0 AS score 
				FROM 
					tbl_currency_data 
				WHERE 
					display_flag = 1
				GROUP BY 
					title 
				ORDER BY 
					title ASC
				LIMIT 5";
			}
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
		
		public function aAuto($str)
		{
			$sql = "SELECT 
						pcode, 
						ROUND(lat,6) as lat, 
						ROUND(lng,6) as lng, 
						type, 
						typeid, 
						name, 
						id 
					FROM 
						location 
					WHERE 
						type=1 
					AND 
						status = 1 
					AND 
						name LIKE '".$str."%' 
					LIMIT 3";
			$res = $this->query($sql);
			if($res)
			{
				while($row = $this->fetchData($res))
				{
					$idarr[] = $row['typeid'];
					$arr[] = $row;
				}
				if(count($idarr))
				{
					$idarr = array_unique($idarr);
					$idin = implode(',',$idarr);
					if($idin)
					{
						$sql = "SELECT 
									id,
									name 
								FROM 
									location 
								WHERE 
									id IN (".$idin.")";
						$res = $this->query($sql);
						if($res)
						{
							while($row = $this->fetchData($res))
							{
								$prnt[$row['id']] = $row['name'];
							}
						}
					}
				}
				if(count($arr))
				{
					foreach($arr as $key => $val)
					{
						$arr[$key]['city'] = $prnt[$val['typeid']];
					}
				}
			}
			return $arr;
		}
	}

?>