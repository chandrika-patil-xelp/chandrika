<?php
        include APICLUDE.'common/db.class.php';
	class designer extends DB
    {
            public function pByDesigner()
            {
                $sql = "SELECT 
                                    product.pcode,
                                    product.pname,
                                    designer.desname 
                        from 
                                    product,
                                    designer 
                        ORDER BY 
                                    designer.desname desc";
                $res = $this->query($sql);
                if($res)
                {
                    while($row=$this->fetchData($res))
                    {
                        $arr[] = $row; 
                    }
                } return $arr;
            }
        
            public function desInfo()
            {
                $sql = "SELECT * 
                        FROM 
                                    designer";
                $res = $this->query($sql);
                
                if($res)
                {
                    while($row = $this->fetchData($res))
                    {
                        $arr[]=$row;
                    }
                }
                return $arr;
            }
            
            public function pListByDes()
            {
                $sql = "SELECT * 
                        FROM 
                                    designer";
                $res = $this->query($sql);
                
                if($res)
                {
                    while($row = $this->fetchData($res))
                    {
                        $arr[]=$row;
                    }
                }
                return $arr;
            }
    }