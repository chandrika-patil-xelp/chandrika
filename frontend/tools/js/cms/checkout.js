
var gblcheckodata; 
var totalprice=0; 
var shipngdata={}; 
var validationFlag=1;
var corrctotp=0;
var mobileno;
var contnu_enble=0;
var inp_data;
var shipng_id;

$(document).ready(function(){ 
  
  var userid=common.readFromStorage('jzeva_uid'); 
  if(userid !== null){
//   dfltscndopn();
  openfst();
   displayaddrs(userid);
  }
  else{
   // openfst(); 
   
  closeThrd();
  }
  
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

function checkotp(inptmob,otp)
{
 // var otptxt=$('#otp_txt').val();
  var URL= APIDOMAIN + "index.php/?action=checkopt&mobile="+inptmob+"&otpval="+otp;  
	     $.ajax({  url: URL,  type: "GET",  datatype: "JSON",  success: function(results)   {
		      var obj=JSON.parse(results); 
		      var data=obj.result;
		      if(data !== undefined){
		      if(data.otp==null){
			alert('time is over plz try it again');
		      }
		      else{
		      if(otp==data.otp){
			corrctotp=1;
			$('.matchIcn').removeClass('dn');
			$('.unmatchIcn').addClass('dn');
			$('#paswrd1id').removeClass('dn');
			$('#paswrd2id').removeClass('dn');	
			$('#resend_otp').addClass('dn');
			alert('otp is correct');  
		      }
		      else{
			$('.matchIcn').addClass('dn');
			$('.unmatchIcn').removeClass('dn');
			alert('you entered otp is wrong');
		      }
		    }
		    }
		  }
	     });
}
 
 $('#otp_countn').click(function(){
   if(contnu_enble == 1){
     openfst1();
   }
   else{
     alert('Please Enter Password');
   } 
 });
 
 $('#shpng_sub').click(function(){
   validationFlag=1;
   var name;
    if($('.neadHide').hasClass('dn')){
     // alert('hi');
    }
    else{
    name=$('#shpdname').val();  
    if(name ===''|| name === null){ 
     // common.toast(0, 'Please Enter Name');
        alert('Please enter your Name');
        validationFlag=0; 
    }
    else if(!isNaN(name)){
       //common.toast(0, 'Name should be alphanumeric');
        alert('Name should be alphanumeric');
         validationFlag=0; 
    }
      shipngdata['name']=name;
     shipngdata['email']=$('#shpdemail').val();
     shipngdata['mobile']=$('#shpdmobile').val();
    }
    var addrs=$('#shpdaddrs').val();
    var city=$('#shpdcity').val(); 
    var state=$('#shpdstate').val();
    var pincode=$('#shpdpincode').val(); 
    
    if(addrs ===''|| addrs === null){
      //  common.toast(0, 'Please enter your street name');
        alert('Please enter your address');
        validationFlag=0; 
    }
    else if(pincode ===''|| pincode === null){
      //  common.toast(0, 'Please enter your Zip code');
        alert('Please enter your Zip code');
        validationFlag=0; 
    }
    
    if (validationFlag == 1){
      
    // storeorderdata();
     if(inp_data !== undefined ){
    if($.isNumeric(inp_data)){
    
    var URLreg= APIDOMAIN + "index.php/?action=addnewUser&name="+name+"&mobile="+inp_data+"&pass="+passwrd+"&address="+addrs+"&city="+city; 
    }
    else{
      shipngdata['email']=mail;
      var URLreg= APIDOMAIN + "index.php/?action=addnewUser&name="+name+"&email="+email+"&pass="+passwrd+"&address="+addrs+"&city="+city; 
    }
    $.ajax({  type:'POST', url:URLreg,  success:function(res){
			  var data1 = JSON.parse(res); 
			  if(data1['error']['err_code']==0){
			    alert('Registered Successfully');
			    var uid=data1['error']['userid'];
			    common.addToStorage('jzeva_uid',uid);
			  }   
			  else if(data1['error']['err_code']==1)   alert(data1['error']['err_msg']); 
		  }
	    });
  }
  else{
    var name=common.readFromStorage('jzeva_name'); 
    var email=common.readFromStorage('jzeva_email'); 
    var moblno=common.readFromStorage('jzeva_mob'); 
    shipngdata['name']=name;
    shipngdata['email']=email;
    shipngdata['mobile']=moblno;
  }
  
   shipngdata['city']=city;
   shipngdata['address']=addrs;	    shipngdata['state']=state;
   shipngdata['pincode']=pincode;
   setTimeout(function(){
     var usrid=common.readFromStorage('jzeva_uid');
   if(usrid == null || usrid == ""){
     shipngdata['user_id']=1111;
   }
   else{
     shipngdata['user_id']=usrid;
   }
   storeshippingdata();
   },1000);
   
   
    
   }
 });
 

$('#mob_mailsub').click(function(){
    inp_data=$('#entereml').val(); 
    var validationflg=1;
  //console.log(inp_data);
  if($.isNumeric(inp_data)){
    if(inp_data===''|| inp_data=== null){
      // common.toast(0, 'Please enter your Mobile no.');
        alert('Please enter your Mobile no.');
        validationflg=0; 
    }
    else if(isNaN(inp_data) || (inp_data.length < 10) || (inp_data.length > 11) ){
      // common.toast(0, 'Mobile no. Invalid');
        alert('Mobile no. Invalid');
        validationflg=0; 
    }
    
    if(validationflg == 1){
      openThrd();
       $('#paswrd1id').addClass('dn');
       $('#paswrd2id').addClass('dn');
     //  sendnewuserotp(); 
    }
  }
  else{
    var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    if(inp_data===''|| inp_data=== null){
     //   common.toast(0, 'Please enter your Email.id');
        alert('Please enter your Email.id');
        validationflg=0; 
    }
    else if (!reg.test(inp_data)){
      // common.toast(0, 'Invalid Email.id');
      alert('Invalid Email.id');
        validationflg=0; 
    }
     if(validationflg == 1){
      openThrd();
       sendotpmail(); 
      }  
  } 
});

 $('#otp1').keyup(function(){
       var otp=$(this).val();  
         checkotp(inp_data,otp); 
    });

$('#resend_otp').click(function(){ 
  //  sendnewuserotp();
});

function sendnewuserotp()
{
  var URL= APIDOMAIN + "index.php/?action=sendnewuserotp&mobile="+inp_data; 
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
 
function sendotpmail()
{
  var URL= APIDOMAIN + "index.php/?action=sendnewuserotp&mobile="+inp_data; 
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

function storeshippingdata()
{
  if (validationFlag == 1){
   var URL= APIDOMAIN + "index.php?action=addshippingdetail";
    var data=shipngdata;
    var  dt = JSON.stringify(data); 
	$.ajax({ type:"post",  url:URL,  data: {dt: dt}, success:function(res){  
		      //   console.log(res); 
			 var data=JSON.parse(res);
			 shipng_id=data['error']['shipping_id'];
			 storeorderdata();
        }
        });
  }
}

function displayaddrs(userid)
{
   var URL= APIDOMAIN + "index.php/?action=getshippingdatabyid&userid="+userid; 
      $.ajax({  url: URL,  type: "GET",   datatype: "JSON",   success: function(results)   { 
		     var data=JSON.parse(results);
		     
		     var res=data['results'];
		     if(res !== null){
		       $('addr_main').html('');
		     $(res).each(function(r,v){
	var addstr="";
		       
		      
    addstr+="  <div class='col100 fLeft'>";
    addstr+="<div class='w50r fLeft'> ";
    addstr+="  <div class='text fLeft' id='spnd_name'>"+v.name+" </div>";
    addstr+=" <div class='text fLeft' id='spnd_email'>"+v.email+"  </div>";
    addstr+="  <div class='text fLeft' id='spnd_city_pin'>"+v.city+"-"+v.pincode+"</div>";
    addstr+="  </div>";
    addstr+=" <div class='w50l fRight'> ";
    addstr+="  <div class='text fLeft'><span id='addr_id'>"+v.address+"</span></div>";
    addstr+="  </div>";
    addstr+="  <div class='btncnt fLeft bolder'>";
    addstr+="  <center>  <div class='dlvrBtn' id='"+v.shipping_id+"' onclick='checkicon(this)'>DELIVER TO THIS ADDRESS</div>";
    addstr+="   </center>  </div>";
    addstr+="  </div>";
    $('#intscrl').append(addstr);
     });
     $('#diff_adr').html('Add New Address');
		    }
		    else{
		      opnscnd(); 
		    }
		   }
		 });
}

$('#shpdpincode').blur(function(){
   var zipcode= $(this).val();
   if(zipcode.length == 6){
      var URL = APIDOMAIN + "index.php?action=viewbyPincode&code="+zipcode;  
	       $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    {
		      var obj=JSON.parse(results);  
		      $('#shpdstate').focus();
		      $('#shpdstate').val(obj.results[0].state);
		      $('#shpdcity').focus();
		      $('#shpdcity').val(obj.results[0].city); 
		    }
		  }); 
   }
   else{
    alert('Please Enter correct Zip Code');
   }
}); 
 
function  storeorderdata()
{
  if (validationFlag == 1){
  var userid=common.readFromStorage('jzeva_uid'); 
  var cartid=common.readFromStorage('jzeva_cartid');
  var data=[],ordobj={};
  if(cartid !== null || userid !== null){
  var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id="+cartid+"&userid="+userid+"";  
  $.ajax({  url: URL, type: "GET",  datatype: "JSON", success: function(results) {
    var obj=JSON.parse(results); 
    $(obj.result).each(function(r,v){
	var ordrdata={};  
	if(userid !== null || userid !== 0){
	  ordrdata['userid']=userid;}
	else{
	  ordrdata['userid']=v.userid;}
	ordrdata['orderid']=v.cart_id;	 ordrdata['pid']=v.product_id;
		 ordrdata['col_car_qty']=v.col_car_qty;
	ordrdata['pqty']=v.pqty;	 ordrdata['prodpri']=v.price;  
	ordrdata['order_status']="" ;	 ordrdata['updatedby']="" ;
	ordrdata['payment']="";		 ordrdata['payment_type']=""; 
	ordrdata['shipping_id']=shipng_id;
	data[r]=ordrdata; r++;
    });
    ordobj['data']=data;
       setordrdata(ordobj);
    }
  }); 
  }
   }
 }
	 
 function checkicon(ths)
 {
   
                                var i=$(ths);
				if($('.dlvrBtn').length>1){
                               $('.dlvrBtn').each(function(){
                                   setTimeout(function(){
                                         $('.dlvrBtn').removeClass('afterTick');
                                   },250);
                                   $('.dlvrBtn').animate({
                                 paddingLeft:'10px',
                                 paddingRight:'10px'
                                },50);
                                });
			      }
			      
                                i.animate({
                                 paddingLeft:'12px',
                                 paddingRight:'32px'
                                },50);
                               setTimeout(function(){
                                    if(i.hasClass('afterTick')){
				      i.removeClass('afterTick');
				         $('.dlvrBtn').animate({
                                 paddingLeft:'10px',
                                 paddingRight:'10px'
                                },50);
				    }
				    else{
				      
				      i.addClass('afterTick');
				    }
                               },250); 
	    shipng_id=$(ths).attr('id');
 }
 
 $('#all_submt').click(function(){
   if(shipng_id == undefined){
     alert('Please select Your shipping Address');
   }
   else{
    storeorderdata();
   }
 });
 
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