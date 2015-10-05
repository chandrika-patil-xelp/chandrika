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
        $sql="select title,cname,cmob,des_img,cemail,des_img from tbl_custom_des where dflag=1 order by cdt DESC";
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
            $arr='There is no pending request available';
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
        $vsql="INSERT INTO tbl_custom_des(cname,cmob,cemail,title,des_img,dflag,udt,cdt)
               VALUES('".$detls['cname']."',".$detls['cmob'].",'".$detls['cemail']."','".$detls['title']."','".$detls['desimg']."',1,now(),now())";
        $vres=$this->query($vsql);
            if($vres)
            {
                $arr="The custom design is submited by customer";
                $err=array('Code'=>0,'Msg'=>'Data is Inserted successfully');
            }
            else
            {
                $arr='Design is not submited';
                $err=array('Code'=>1,'Msg'=>'Insert operation is not done');
            }
       }
       else
       {
           $arr='parameters are not passed properly';
           $err=array('Code'=>1,'Msg'=>'Insert operation is not done');
       }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
        
   }
?>       
        