<?php
include APICLUDE.'common/db.class.php';
class speak extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }
                
    public function viewCom()
    {   
        $sql="SELECT 
                                name,
                                city,
                                email,
                                mobile,
                                product_image,
                                opinion,
                                final_opinion
               FROM 
                                tbl_speak_master
               WHERE 
                                active_flag=1
               ORDER BY 
                                updated_on DESC";
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
    
    public function addCom($params)
    {   
        $dt= json_decode($params['dt'],1);
       $detls  = $dt['result'];       
       $vsql="INSERT
              INTO 
                                tbl_speak_master
                               (user_id,
                                name,
                                city,
                                mobile,
                                email,
                                product_image,
                                opinion,
                                final_opinion,
                                active_flag,
                                date_time)
               VALUES
                             (\"".$detls['uid']."\",
                             \"".$detls['name']."\",
                             \"".$detls['city']."\",
                             \"".$detls['mobile']."\",
                             \"".$detls['email']."\",
                             \"".$detls['pimage']."\",
                             \"".$detls['opinion']."\",
                             \"".$detls['fop']."\",
                                 1,
                                 now(),
                                 now())";
        $vres=$this->query($vsql);
            if($vres)
            {
                $arr="User Comment is submited";
                $err=array('Code'=>0,'Msg'=>'Data is Inserted successfully');
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
        