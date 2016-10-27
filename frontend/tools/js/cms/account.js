
$(document).ready(function(){
   
   displayorders();
   wishlist();
   persnlInfo();
   storenewpass();
});

function displayorders()
{
    var titod="";
    var orderstr="";
   
    
    var userid=localStorage.getItem('jzeva_uid'); 
     var URL = APIDOMAIN + "index.php?action=getOrderDetailsByUserId&userid="+userid;
	       $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    {
		      var obj=JSON.parse(results);
                    
                      $(obj['result']).each(function(r,v){
                          
                       var ordrId = $('#ordId').html(v.oid);
                       var ordDate = $('#ordDate').html(v.order_date);
                       var ordrprc = $('#ordPrice').html(v.price);
                       var abc=v.prdimage; abc=abc.split(',');
			    abc=IMGDOMAIN+abc[5];
 //orderstr+='<div class="fLeft orderImg bgCommon"></div>';
 orderstr+='<div class="fLeft orderImg bgCommon" style="background-image: url('+abc+');"></div>';
 orderstr+='<div class="fLeft orderName">';
 orderstr+='<div class="fLeft col100 semibold">'+v.prdname+'</div>';
                                  
 orderstr+='<div class="fLeft  col10">';
 orderstr+='<span class="fLeft">Diamond Qty: '+v.quality+'</span>';
 orderstr+='<span class="fLeft"></span>';
 orderstr+='</div>';
 orderstr+='<div class="fLeft  col100">';
 orderstr+='<span class="fLeft">Metal purity: '+v.Metalcarat+'</span>';
 orderstr+='<span class="fLeft"></span>';
 orderstr+='</div>';
 orderstr+='<div class="fLeft  col100">';
 orderstr+='<span class="fLeft">Metal colour: '+v.color+'</span>';
 orderstr+='<span class="fLeft"></span>';
 orderstr+='</div>';
 orderstr+='<div class="fLeft  shipTo">';
 orderstr+='<span class="fLeft">Qty:</span>';
 orderstr+='<span class="fLeft">'+v.pqty+'</span>';
 orderstr+='</div>';

 orderstr+='<div class="fLeft  shipTo">';
 orderstr+='<span class="fLeft">Size:</span>';
 orderstr+='<span class="fLeft">4</span>';
 orderstr+='</div>';
 orderstr+='</div>';
 orderstr+='<div class="fLeft rsCont">';
 orderstr+='<span class="fLeft">&#8377 '+v.price+'</span>';
 orderstr+='<div class="fLeft vatTxt dn">';
 orderstr+='<div class="fLeft col100">MRP<span>&#8377 50,000</span></div>';
 orderstr+='<div class="fLeft col100">VAT:<span>7487384</span></div>';
orderstr+='<div class="fLeft col100">tax:<span>675675</span></div>';
 orderstr+='</div>';
 orderstr+='</div>';
 orderstr+='<div class="fLeft note">';
 orderstr+='<div class="fLeft col100 semibold pBtm5">Code:<span class="regular">'+v.product_code+'</span></div>';
 orderstr+='<div class="fLeft col100 semibold">Shipping address</div>';
 orderstr+='<div class="fLeft col100 ">'+v.customername+'</div>';
 orderstr+='<div class="fLeft col100 shipAddr">'+v.customerAddrs+' '+v.customerCity+' '+v.customerState+' '+v.customerPincode+'</div>';
 
 orderstr+='<div class="filterSec fLeft">';
 orderstr+='<center>';
 orderstr+='<div class="button actBtn transition300 fRight mar0" id="trackId1">track</div>';
orderstr+= '</center>';
 orderstr+= '</div>';
orderstr+='</div>';
orderstr+= '<div class="fLeft trackOuter poR dn">';
orderstr+= '<center>';
orderstr+='<div class="trackDivs">';
orderstr+= '<div class="fLeft placedTxt">Confirmed</div>';
orderstr+= '<div class="fLeft dateTxt">07 Oct</div>';
orderstr+= '<div class="fLeft proStep tickIcon"></div>';
orderstr+= '</div>';
orderstr+='<div class="trackDivs">';
orderstr+= '<div class="fLeft placedTxt">quality check and certification</div>';
orderstr+= '<div class="fLeft dateTxt">10 Oct</div>';
orderstr+= '<div class="fLeft proStep tickIcon"></div>';
orderstr+= '</div>';
orderstr+='<div class="trackDivs">';
orderstr+= '<div class="fLeft placedTxt">out for delivery</div>';
orderstr+='<div class="fLeft dateTxt">14 Oct</div>';
orderstr+='<div class="fLeft proStep tickIcon"></div>';
orderstr+='</div>';
orderstr+='<div class="trackDivs">';
orderstr+= '<div class="fLeft placedTxt">Delivered</div>';
orderstr+= '<div class="fLeft dateTxt">16 Oct</div>';
orderstr+= '<div class="fLeft proStep tickIcon"></div>';
orderstr+= '</div>';
orderstr+='</center>';
orderstr+= '<div class="fLeft tOuter poR">';
orderstr+= '<div class="fLeft date semibold font15">07 oct</div>';
orderstr+= '<div class="fLeft shipTo">shipped to third party</div>';
orderstr+= '</div>';
orderstr+= '</div>';
                        
//                        
//orderstr+='<div class="fLeft orderImg bgCommon" style="background-image: url('+abc+');"></div>';
//orderstr+=' <div class="fLeft orderName">';
//orderstr+=' <div class="fLeft pName semibold">'+v.prdname+'</div>';
// orderstr+='  <div class="fLeft pPrice pName">';
// orderstr+=' <span class="fLeft">Code:</span>';
//orderstr+='<span class="fLeft">'+v.product_code+'</span>';
//orderstr+='  </div>';
//orderstr+='<div class="fLeft pPrice pName">';
//orderstr+='  <span class="fLeft">Qty:</span>';
//orderstr+='  <span class="fLeft">'+parseInt(v.pqty)+'</span> </div> </div>';
// orderstr+=' <div class="fLeft rsCont">';
//orderstr+=' <span class="fLeft">&#8377 '+v.price+'</span>';
//orderstr+=' <span class="plusBox plusHolder fLeft"></span>';
//orderstr+=' <div class="fLeft vatTxt dn">';
//orderstr+=' <div class="fLeft col100">MRP<span>&#8377 50,000</span></div>';
//orderstr+='  <div class="fLeft col100">VAT:<span>7487384</span></div>';
//orderstr+=' <div class="fLeft col100">tax:<span>675675</span></div>';
//orderstr+=' </div>   </div>  <div class="fLeft note">';
//orderstr+=' <div class="">Please Note</div>';
//orderstr+=' <div class="">The item has not been delivered yet</div>';
//orderstr+=' </div>';
//
//titod+='<div class="fLeft Morder bolder">&#8377 '+v.price+' </div>';
//titod+='<div class="fLeft Morder bolder">'+v.pqty+'</div>';
//titod+='<div class="fLeft Morder bolder">'+v.order_status+'</div>';
//
//orderShp+='<div class="inCourier fLeft">';
//orderShp+='<div class="fLeft inShip">';  
//orderShp+='<span class="font13 regular">Order No:</span>';
//orderShp+='<span class="font13 semibold">123456789</span>';
//orderShp+='</div>';
//orderShp+='<div class="fLeft inShip">';
//orderShp+= '<span class="font13 regular">Order Placed:</span>';
//orderShp+= '<span class="font13 semibold">0123456788</span>';
//orderShp+='</div>';
//orderShp+='</div>';
//orderShp+= '<div class="inCourier fLeft">';
//orderShp+='<div class="fLeft inShip font13 regular">Total Amount</div>';
//orderShp+= '<div class="fLeft inShip font13 semibold">&#8377 '+v.price+'</div>';    
//orderShp+='</div>';
//orderShp+= '<div class="inCourier fLeft">';
//orderShp+= '<div class="fLeft inShip font13 regular ">Shipping Address </div>';
//orderShp+= '<div class="fLeft inShipfont13 semibold ">'+v.customerAddrs+','+v.customerCity+''+v.customerPincode+'</div>';
//orderShp+='</div>';
//orderShp+='<div class="inCourier fLeft pad0">';
//orderShp+= '<div class="fLeft inShip font13 regular ">Payment Mode</div>';
//orderShp+='<div class="fLeft inShipfont13 semibold ">'+v.payment_type+'</div>';
//orderShp+='</div>';
      
      });
      $('#ordDetail').append(orderstr);
      //$('#titleod').append(titod);
    //  $('#ordShipng').append(orderShp);
                    }
                    });
                
   }
   
function wishlist()
{
   var userid=localStorage.getItem('jzeva_uid');
 
  var wishURL = APIDOMAIN + "index.php?action=getwishdetail&userid="+userid;
   var wishstr = "";
    $.ajax({
	 	    url: wishURL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(res)
	 	    {
                        
		      var obj=JSON.parse(res);
                      var wishStr="";
                       $(obj['result']).each(function(s,j){
                           console.log(j);
                           var xyz=j.prdimage; xyz=xyz.split(',');
			    xyz=IMGDOMAIN+xyz[5];
                            
 wishStr+= '<div class="facet_front">';
 wishStr+= '<div class="grid_item">';
 wishStr+= '<div class="grid_img">';
 wishStr+= '<div style="background:url('+xyz+')no-repeat ; background-size: contain ; background-position: center" class=""></div></div>';
 wishStr+= '<div class="hovTr">';
 wishStr+= '<div class="hovTrans" style="display: none; transform: translateX(101%);">';
 wishStr+= '<div class="plusCont" style="transform: scale(0);"></div></div></div>';
 wishStr+= '<div class="grid_dets">';
 wishStr+= '<div class="grid_name txtOver transition300">'+j.prdname+'</div>';
 wishStr+= '<div class="col100  font11 transition300 txtOver">Gold  Φ  Diamond </div>';
 wishStr+= '<div class="grid_price txtOver transition300">₹ '+j.price+'</div>';
 wishStr+= '<div class="action_btns">';
 wishStr+= '<div class="col50 fLeft  padXr5">';
 wishStr+='<div class="actBtn fLeft bolder" id="add_to_cart" >Add To Cart</div>';
 wishStr+='</div>';
 wishStr+='<div class="col50 fLeft  padXl5">';
 wishStr+='<div class="actBtn fRight bolder">delete</div>';
 wishStr+='</div>';
 wishStr+='</div>';
 wishStr+='<div class="fmSansB smBtnDiv fLeft transition300">';
 wishStr+='<div class="v360Btn" onclick="imgLoad(1320160808054906, event)"></div></div></div>';
 wishStr+='<div class="soc_icons">';
 wishStr+='<div class="soc_elem soc_wish2 transition300"></div>';
 wishStr+='<div class="soc_elem soc_share transition300"></div>';
 wishStr+='</div>';
 wishStr+='</div>';
                       });
                        $('#wishid').append(wishStr);
                  }
                   
              });
              
  
    }
    
  
 function persnlInfo(){
     var userid=localStorage.getItem('jzeva_uid');
     var perStr ="";
      var perInfoURL = APIDOMAIN + "index.php?action=getUserDetailsById&userid="+userid;
     
      
       $.ajax({
	 	    url: perInfoURL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(res)
	 	    {
                        
		      var obj=JSON.parse(res);
                     
                        var profileStr="";
                       $(obj['result']).each(function(k,l){
                       console.log(l);
                          profileStr+= '<div class="proFields">'+l.uname+'</div>';
                          profileStr+= '<div class="proFields">'+l.mob+'</div>';   
                          profileStr+='<div class="proFields">'+l.email+'</div>';
                       });
                       $('#persnlDet').append(profileStr);
                   }
                  
                    });
      }
      
function storenewpass()
 {
   
    $('#resetpass').click(function(){
        var newpass = $("#newpass").val();
   var cpass = $("#cpass").val();
   var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var validationFlag=1;
   if(newpass ===''|| newpass === null){
      //  common.toast(0, 'Please enter your Password');
       alert('Please Enter Your New Password');
        validationFlag=0;
        return false;
    }
    else if(cpass===''|| cpass=== null){
       // common.toast(0, 'Please enter the confirm password');
        alert('Please Enter the Confirm password');
        validationFlag=0;
        return false;
    }
    if(newpass !== cpass){
      alert('Password Does Not Match');
    }
    else{
      alert('Password Match');
      getuserdetail(newpass);
    }
});
    
 }
 
 function getuserdetail(pass)
 {
    alert(pass);
    var URL= APIDOMAIN + "index.php/?action=getuserdatabyurl&key="+key; 
    $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(res)
	 	    { 
		     var data=JSON.parse(res);  console.log(data);
		     var email=data.result['email'];
		     var mobile=data.result['mobile'];
		     var user_id=data.result['user_id'];
 var URLreg= APIDOMAIN + "index.php/?action=updateuserpass&user_id="+user_id+"&email="+email+"&mobile="+mobile+"&pass="+pass;
		    $.ajax({
			     type:'POST',
			     url:URLreg,
			     success:function(res){
			    console.log(res);
                            alert('password reset successfully');
			  }
			});

		   }
    });
    
    
 }
 
  