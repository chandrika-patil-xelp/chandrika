
var gblcheckodata; 
var totalprice=0; 
var shipngdata={}; 
var validationFlag=1;
var corrctotp=0;
var mobileno;
$(document).ready(function(){ 
  
  $('#sbmtshpdata').click(function(){  
     if(corrctotp == 1){
    //  storeshippingdata();
     //  storeorderdata();
     }
     else{
      // alert('Please Enter OTP')
     }
  });
    
  $('#nxt').click(function(){
  //  getshippingdata();
  }); 
  displaycartdetail();
});

function displaycartdetail()
{
  var userid=common.readFromStorage('jzeva_uid'); 
  var cartid=common.readFromStorage('jzeva_cartid');  
  $('.jwlCnt').html("");
  totalprice=0;
  var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id="+cartid+"&userid="+userid+"";  
	       $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    {
		      var obj=JSON.parse(results); 
	       	      gblcheckodata=obj.result;    
		      $(obj.result).each(function(r,v){
			if(v.default_img!== null){
			   abc=IMGDOMAIN + v.default_img;
			}
			else{
			   var abc=v.prdimage; abc=abc.split(','); 
			    abc=IMGDOMAIN+abc[5];
			}
			totalprice+=parseInt(v.price); 
			 
var chckoutstr=" <div class='jwlCntdtls fLeft regular'>";
    chckoutstr+="  <div class='clsePrdct' id='"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"'";
    chckoutstr+="  onclick='remove(this)'></div>";
    chckoutstr+=" <div class='ordrJwl' style='background-image:url("+abc+")'> </div>";
    chckoutstr+=" <div class='jwlryDtls fLeft'> <div class='w60 fLeft'>" ;
    chckoutstr+=" <div class='text fLeft bolder'>"+v.prdname+"</div>";
    chckoutstr+="<div class='text fLeft'>"+v.color+" "+v.jewelleryType+" "+v.carat+",Diamond "+v.dmdcarat+"</div>";
    chckoutstr+=" <div class='text fLeft'>";
    chckoutstr+="<span>Quality :"+v.quality+"</span>";
    chckoutstr+="<span class='spanl'>Purity -"+v.carat+"</span>";
    chckoutstr+="</div>";
    chckoutstr+=" <div class='text fLeft'>";
    chckoutstr+="<span>Color :"+v.color+"</span>";
    chckoutstr+="<span class='spanl'>Size - 28</span></div>";
    chckoutstr+=" </div>";
    chckoutstr+="  <div class='w40 fLeft'>";
    chckoutstr+="  <div class='text fLeft' id='item_amt'>₹ "+parseInt(v.price)+"</div>";
    chckoutstr+=" <div class='pCount fLeft'> ";
    chckoutstr+="<center><a href='#' onclick='subqnty(this)'  id='sub_"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"'> <div class='incr icnMns'></div></a> ";
    chckoutstr+=" <div class='pNumber light'>"+v.pqty+"</div>";
    chckoutstr+=" <a href='#' id='add_"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"' onclick='addqnty(this)'> <div class='incr  icnPls'></div></a>";
    chckoutstr+=" </center></div>  </div> </div></div>";
    r++;
     $('.jwlCnt').append(chckoutstr);
		      });  
		      $('.prcTxt').html("₹ "+totalprice);
		    }
		  }); 
}
  
  
  function remove(el){
     var yesno=confirm('Are u sure Do you want to remove This item');
     if(yesno== true)
     {
	var id=$(el).attr('id');
	var a=id.split('_');
        var col_car_qty=a[2],product_id=a[0],cartid=a[3];
        var URL = APIDOMAIN+"index.php?action=removeItemFromCart&col_car_qty="+col_car_qty+"&pid="+product_id+"&cartid="+cartid; 
	$.ajax({
	      type:'POST',
	      url:URL,
	      success:function(res){
	          displaycartdetail();
		//$(".cart_gen").show();  
	      }
          });
      }
  }
  
   function addqnty(ths)
  {
	var e=$(ths).siblings('.pNumber'); 
	var j=$(ths).siblings('.pNumber').text();
	var e2=  $(ths).parent().closest('.w40').find('#item_amt'); 
	var price=$(ths).parent().closest('.w40').find('#item_amt').text(); 
	price=price.replace(/\,/g,'');
	price=price.replace('₹','');
        price=parseInt(price,10); 
        price=price/j; 
	 totalprice+=price;
        j++;
        price=price*j; 
	$(e2).html("₹ "+price);
        $(e2).digits();
        $(e).html(j);
    var ids=$(ths).attr('id'); ids=ids.split('_'); var pid=ids[1]; var col_car_qty=ids[3];var cart_id=ids[4]; 
    $(gblcheckodata).each(function(r,v){
      if(v.product_id==pid && v.col_car_qty==col_car_qty && v.cart_id==cart_id)
      { 
	var dat={};
	dat['cartid']=v.cart_id;    dat['pid']=v.product_id;
	dat['userid']=v.userid;     dat['col_car_qty']=v.col_car_qty;
	dat['qty']=j;		       dat['price']=price;  
	   storecartdata(dat);  
	   $('.prcTxt').html("₹ "+totalprice);
      }
     }); 
   }
   
   function subqnty(evnt)
  {
    var e=$(evnt).siblings('.pNumber'); 
    var j=$(evnt).siblings('.pNumber').text();
    var e2=  $(evnt).parent().closest('.w40').find('#item_amt'); 
    var price=$(evnt).parent().closest('.w40').find('#item_amt').text();
    price=price.replace(/\,/g,'');
    price=price.replace('₹','');
    var price=parseInt(price,10); 
      if(j>1){
            price=price/j;
	     totalprice-=price;
	    j--;
	    price=price*j;
	    $(e2).html("₹ "+price);
            $(e2).digits();
	    $(e).html(j);
      } 
    var ids=$(evnt).attr('id'); ids=ids.split('_'); var pid=ids[1]; var col_car_qty=ids[3];var cart_id=ids[4]; 
    $(gblcheckodata).each(function(r,v){
      if(v.product_id==pid && v.col_car_qty==col_car_qty && v.cart_id==cart_id)
      { 
	var dat={};
	dat['cartid']=v.cart_id;    dat['pid']=v.product_id;
	dat['userid']=v.userid;     dat['col_car_qty']=v.col_car_qty;
	dat['qty']=j;		       dat['price']=price;  
	  storecartdata(dat); 
	 $('.prcTxt').html("₹ "+totalprice);
      }
     }); 
  }
  
  function storecartdata(cartdata)
{ 
    var URL= APIDOMAIN + "index.php?action=addTocart";
    var data=cartdata; 
    var  dt = JSON.stringify(data);
	$.ajax({
	    type:"post",
	    url:URL,
	    data: {dt: dt},
	    success:function(data){
		 //   console.log(data);  
		//    displaycartdetail(); 
            }
        });	 
}

function getshippingdata()
{
    var name=$('#shpdname').val();
   mobileno=$('#shpdmobile').val();
   var mail=$('#shpdemail').val();
   var addrs=$('#shpdstreet').val();
   var city=$('#shpdcity').val(); 
   var state=$('#shpdstate').val();
   var pincode=$('#shpdpincode').val(); 
   var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
     
    if(name ===''|| name === null){ 
     // common.toast(0, 'Please Enter Name');
        alert('Please enter your Name');
        validationFlag=0;
        return false;
    }
    else if(!isNaN(name)){
       //common.toast(0, 'Name should be alphanumeric');
        alert('Name should be alphanumeric');
         validationFlag=0;
        return false;
    }
    else if(mobileno===''|| mobileno=== null){
      // common.toast(0, 'Please enter your Mobile no.');
        alert('Please enter your Mobile no.');
        validationFlag=0;
        return false;
    }
    else if(isNaN(mobileno) || (mobileno.length < 10) || (mobileno.length > 11) ){
      // common.toast(0, 'Mobile no. Invalid');
        alert('Mobile no. Invalid');
        validationFlag=0;
        return false;
    }
    else if(mail===''|| mail=== null){
     //   common.toast(0, 'Please enter your Email.id');
        alert('Please enter your Email.id');
        validationFlag=0;
        return false;
    }
   else if (!reg.test(mail)){
      // common.toast(0, 'Invalid Email.id');
      alert('Invalid Email.id');
        validationFlag=0;
        return false;
    } 
    else if(addrs ===''|| addrs === null){
      //  common.toast(0, 'Please enter your street name');
        alert('Please enter your street name');
        validationFlag=0;
        return false;
    } 
    else if(pincode ===''|| pincode === null){
      //  common.toast(0, 'Please enter your Zip code');
        alert('Please enter your Zip code');
        validationFlag=0;
        return false;
    }
    else if(state ===''|| state === null){
      //  common.toast(0, 'Please enter your Zip code');
        alert('Please enter your state');
        validationFlag=0;
        return false;
    }
    else if(city===''|| city=== null){
       // common.toast(0, 'Please enter the confirm password');
        alert('Please enter the city name');
        validationFlag=0;
        return false;
    }
    else{
      validationFlag=2;
    }
    
   $('#spnd_name').html(name); 
   $('#spnd_email').html(mail);
   $('#spnd_city_pin').html(city+"-"+pincode);
   $('.w50l').html(addrs);  
  
   shipngdata['name']=name;	    shipngdata['mobile']=mobileno;
   shipngdata['email']=mail;	    shipngdata['city']=city;
   shipngdata['address']=addrs;	    shipngdata['state']=state;
   shipngdata['pincode']=pincode; 
   var usrid=common.readFromStorage('jzeva_uid'); 
   if(usrid == null || usrid == ""){
     shipngdata['user_id']=1111;
   }
   else{
     shipngdata['user_id']=usrid;
   }  
}

function storeshippingdata()
{ 
  if (validationFlag == 2){
   var URL= APIDOMAIN + "index.php?action=addshippingdetail";
    var data=shipngdata;
    var  dt = JSON.stringify(data); 
	$.ajax({
	    type:"post",
	    url:URL,
	    data: {dt: dt}, 
	    success:function(data){  
		//      console.log(data);     
            }
        });
 }
}

function  storeorderdata()
{
  var userid=common.readFromStorage('jzeva_uid'); 
  var cartid=common.readFromStorage('jzeva_cartid');
  var data=[],ordobj={};
  var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id="+cartid+"&userid="+userid+"";  
  $.ajax({  url: URL, type: "GET",  datatype: "JSON", success: function(results) {
    var obj=JSON.parse(results); 
    $(obj.result).each(function(r,v){
	var ordrdata={}; 
	ordrdata['orderid']=v.cart_id;	 ordrdata['pid']=v.product_id;
	ordrdata['userid']=v.userid;	 ordrdata['col_car_qty']=v.col_car_qty;
	ordrdata['pqty']=v.pqty;	 ordrdata['prodpri']=v.price;  
	ordrdata['order_status']="" ;	 ordrdata['updatedby']="" ;
	ordrdata['payment']="";		 ordrdata['payment_type']=""; 
	data[r]=ordrdata; r++;
    });
    ordobj['data']=data;
    setordrdata(ordobj);
    }
  }); 
  }

  function setordrdata(ordobj)
  { 
    var URL= APIDOMAIN + "index.php?action=addOrdersdetail"; 
    var  dt = JSON.stringify(ordobj);
	$.ajax({
	    type:"post",
	    url:URL,
	    data: {dt: dt},
	    success:function(data){ 
		//console.log(data);  
		  var cartid=common.readFromStorage('jzeva_cartid');
		  var URL = APIDOMAIN + "index.php?action=removCrtItemaftrcheckot&cartid="+cartid;  
		  $.ajax({  url: URL,   type: "GET",  datatype: "JSON",  success: function(results)  {
				//  console.log(results);
				displaycartdetail(); 
				alert('Your Order Placed successfully'); 
				}
		  }); 
		
            }
        });
}

$('#confrm').click(function(){
 // checkotp();
});

$("#confrm").hover(function() {
    $(this).css('cursor','pointer');
}, function() {
    $(this).css('cursor','auto');
});

function checkotp()
{
  var otptxt=$('#otp_txt').val();
  var URL= APIDOMAIN + "index.php/?action=checkopt&mobile="+mobileno+"&otpval="+otptxt; 
	     $.ajax({  url: URL,  type: "GET",  datatype: "JSON",  success: function(results)   {
		      var obj=JSON.parse(results); 
		      var data=obj.result;
		      if(data.otp==null){
			alert('time is over plz try it again');
		      }
		      else{
		      if(otptxt==data.otp){
			corrctotp=1;
			alert('otp is correct');  
		      }
		      else{
			alert('you entered otp is wrong');
		      }
		    }
		    }
	     });
}

$('#resend_otp').click(function(){ 
  // sendotp();
});

function sendotp()
{
  var URL= APIDOMAIN + "index.php/?action=sendotp&mobile="+mobileno; 
  $.ajax({ type:'POST', url:URL, success:function(res){
		  var data1 = JSON.parse(res);  
		  if(data1['error']['err_code']==0) { 
		    alert(data1['error']['err_msg']);
		  }
		  else if(data1['error']['err_code']==1){
		   alert(data1['error']['err_msg']);
		  }
		  else if(data1['error']['err_code']==2){
		   alert(data1['error']['err_msg']);
		  }
		}
	      }); 
}

 