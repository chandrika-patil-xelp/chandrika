<?php
include APICLUDE.'common/db.class.php';
class custDes extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }
                
    public function showCDes()
    {   
        $sql="SELECT
                            title,
                            customer_name,
                            customer_mobile,
                            design_image,
                            customer_email,
                            design_image
               FROM 
                            tbl_custom_design
                
               WHERE 
                            active_flag=1 
               ORDER BY 
                            date_time ASC";
        
        $res =$this->query($sql);            
        $chkres=$this->numRows($res);
        if($chkres>0)
        {
            while( $row =$this->fetchData($res))
            { 
                $arr[]=$row;
            }
            $err = array('errCode' => 0, 'errMsg' => 'Values shown successfully!');            
        }
       else
       {
            $arr=array();
            $err=array('code'=>1,'msg'=>'No record found');
       }
        $result = array('results' =>$arr,'error'=>$err);
        return $result;
    }
    
    public function addCDes($params)
    {   
        $dt= json_decode($params['dt'],1);
       $detls  = $dt['result'];
       $proErr  = $dt['error'];
       if($proErr['errCode']== 0)
       { 
        $vsql="INSERT 
                                INTO
                                tbl_custom_design
                                (customer_name,
                                 customer_mobile,
                                 customer_email,
                                 title,
                                 design_image,
                                 active_flag,
                                 date_time)
               VALUES
                             (\"".$detls['cname']."\",
                              \"".$detls['cmob']."\",
                              \"".$detls['cemail']."\",
                              \"".$detls['title']."\",
                              \"".$detls['desimg']."\",
                                  1,
                                  now())";
        
        $vres=$this->query($vsql);
            if($vres)
            {
                $arr="The custom design is submited by customer";
                $err=array('Code'=>0,'Msg'=>'Data is Inserted successfully');
            }
            else
            {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Insert operation is not done');
            }
       }
       else
       {
           $arr=array();
           $err=array('Code'=>1,'Msg'=>'Insert operation is not done');
       }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
        
   }
?>       
        