<?php

	include APICLUDE.'common/db.class.php';
	class functions extends DB
    {
		function __construct($db) {
			parent::DB($db);
		}
		
		public function fCurList($vl = '')
		{
			if($vl)
				$part = ' AND name <> "'.$vl.'" ';
			$sql = "SELECT 
						name, 
						title 
					FROM 
						tbl_currency_data 
					WHERE 
						display_flag=1 
					".$part."
					GROUP BY title";
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
		
		public function cUrlPar($par)
		{
			$ex = explode(' ',$par);
			$res = $this->cVal($ex[0]);
			if(!empty($res))
			{
				$arr['template'] = 'cPage';
				$arr['results'] = $res;
			}
			else
			{
				$res = $this->cCon($par);
				if(!empty($res))
				{
					$arr['template'] = 'uPage';
					$arr['results'] = $res;
				}
				else
				{
					$arr['template'] = 'hPage';
				}
			}
			//echo "<pre>";print_r($arr);die;
			return $arr;
		}
		
		public function cVal($nm)
		{
			$sql = "SELECT
						name, 
						title, 
						history, 
						cprofile, 
						keywords 
					FROM 
						tbl_currency_data 
					WHERE 
						name = \"".$nm."\" 
					AND 
						display_flag=1 
					LIMIT 1";
			$res = $this->query($sql);
			if($res)
			{
				if($this->numRows($res))
				{
					$arr = $this->fetchData($res);
					$arr['history'] = mb_convert_encoding($arr['history'], "UTF-8", "HTML-ENTITIES");
					$arr['cprofile'] = mb_convert_encoding($arr['cprofile'], "UTF-8", "HTML-ENTITIES");
					$arr['list'] = $this->tCur();
				}
			}
			//echo "<pre>";print_r($arr);die;
			return $arr;
		}
		
		public function cCon($nm)
		{
			$sql = "SELECT 
						country, 
						country_hist, 
						title, 
						name 
					FROM 
						tbl_currency_data 
					WHERE 
						country = \"".$nm."\" 
					AND 
						display_flag=1 
					LIMIT 1";
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
		
		public function tCur()
		{
			$sql = "SELECT 
						name, 
						title 
					FROM 
						tbl_currency_data
					WHERE
						display_flag = 1
					GROUP BY
						title
					ORDER BY 
						rand()
					LIMIT 20";
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
	}
	
?>