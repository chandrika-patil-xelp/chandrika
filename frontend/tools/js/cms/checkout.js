
var gblcheckodata,bakflag=0,totalprice=0,shipngdata={},validationFlag=1,logotpflag=0, mobileno,contnu_enble=0,inp_data,shipng_id; 
 
$(document).ready(function(){ 
 
  var userid=common.readFromStorage('jzeva_uid'); 
  if(userid !== null){ 
  openfst();
   displayaddrs(userid);
  }
  else{ 
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
  $.ajax({ url: URL, type: "GET",  datatype: "JSON", success: function(results)  {
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
		      var wht;
		      if(v.ccatname !== null){
                        wht=getweight(v.size,v.ccatname,v.metal_weight);     
		      }
		      else{
                        wht=v.metal_weight; 
		      }
		
var chckoutstr=" <div class='jwlCntdtls fLeft regular'>";
    chckoutstr+="  <div class='clsePrdct' id='"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"_"+v.size+"'";
    chckoutstr+="  onclick='remove(this)'></div>";
    chckoutstr+=" <div class='ordrJwl' style='background-image:url("+abc+")'> </div>";
    chckoutstr+=" <div class='jwlryDtls fLeft'> <div class='w60 fLeft'>" ;
    chckoutstr+=" <div class='cart_name fLeft'>"+v.prdname+"</div>";
    chckoutstr+="<div class='text fLeft'>"+v.color+" "+v.jewelleryType+" "+wht+" gms &nbsp|&nbsp Diamond "+v.dmdcarat+"</div>";
    chckoutstr+=" <div class='text fLeft'>";
    chckoutstr+="<span>Quality : "+v.quality+"</span>";
    chckoutstr+="<span class='spanl'>Purity : "+v.carat+"</span>";
    chckoutstr+="</div>";
    chckoutstr+=" <div class='text fLeft'>";
    chckoutstr+="<span>Color : "+v.color+"</span>";
     if(v.ccatname !== null)
    chckoutstr+="<span class='spanl'>Size : "+v.size+"</span>";
    chckoutstr+="</div> </div>";
    chckoutstr+="  <div class='w40 fLeft'>";
    chckoutstr+="  <div class='text fLeft cartRup15' id='item_amt'>"+indianMoney(parseInt(v.price))+"</div>";
    chckoutstr+=" <div class='pCount fLeft'> ";
    chckoutstr+="<div class='col100 fLeft'> <div class='incr icnMns fLeft'  onclick='subqnty(this)'  id='sub_"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"'></div>";
    chckoutstr+=" <div class='pNumber light fLeft'>"+v.pqty+"</div>";
       chckoutstr+="  <div class='incr  icnPls fLeft' id='add_"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"' onclick='addqnty(this)'></div>"; 
    chckoutstr+=" </div></div>  </div> </div></div>";
    r++;
     $('.jwlCnt').append(chckoutstr);
		      });  
		      $('.prcTxt').html("₹ "+indianMoney(totalprice));
		    }
		  }); 
}
  
function getweight(currentSize,catName,storedWt)
{   
    var mtlWgDav=0;  
    var bseSize=0;  
    if(catName.toLowerCase() == 'rings'){
         bseSize = parseFloat(14);
         mtlWgDav = 0.05;}
    else if(catName.toLowerCase() == 'bangles'){
         bseSize = parseFloat(2.4);
          mtlWgDav = 7;
    } 
    if(isNaN(currentSize))
    { 
        if(catName == 'Rings')
        currentSize = parseFloat(14); 
        else if(catName == 'Bangles')
            currentSize = parseFloat(2.4);
        else if(catName !== 'Rings' && catName !== 'Bangles')
            currentSize =0; 
    } 
    var changeInWeight=(currentSize-bseSize)*mtlWgDav;  
    var newWeight=(parseFloat(storedWt)+parseFloat(changeInWeight)).toFixed(3);  
    return newWeight; 
} 
  
  function remove(el){
     var yesno=confirm('Are u sure Do you want to remove This item');
     if(yesno== true)
     {
	var id=$(el).attr('id');
	var a=id.split('_');
        var col_car_qty=a[2],product_id=a[0],cartid=a[3];var size=id=a[4];
        var URL = APIDOMAIN+"index.php?action=removeItemFromCart&col_car_qty="+col_car_qty+"&pid="+product_id+"&cartid="+cartid+"&size="+size; 
	$.ajax({ type:'POST',  url:URL, success:function(res){
	          displaycartdetail(); 
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
	$(e2).html("₹ "+indianMoney(price));
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
	dat['RBsize']=v.size;
	   storecartdata(dat);  
	   $('.prcTxt').html("₹ "+indianMoney(totalprice));
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
	    $(e2).html("₹ "+indianMoney(price));
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
	dat['RBsize']=v.size;
	  storecartdata(dat); 
	 $('.prcTxt').html("₹ "+indianMoney(totalprice));
      }
     }); 
  }
  
  function storecartdata(cartdata)
{ 
    var URL= APIDOMAIN + "index.php?action=addTocart";
    var data=cartdata; 
    var  dt = JSON.stringify(data);
    $.ajax({  type:"post", url:URL, data: {dt: dt},  success:function(data){
		 // console.log(data); 
            }
        });	 
}

function checkotp(inptmob,otp)
{
 
  var URL= APIDOMAIN + "index.php/?action=checkopt&mobile="+inptmob+"&otpval="+otp;  
  $.ajax({  url: URL,  type: "GET",  datatype: "JSON",  success: function(results)   {
		      var obj=JSON.parse(results); 
		      var data=obj.result;
		      if(data !== undefined){
			if(data.otp==null){
			  common.msg(0,'time is over plz try it again');
			  $('.matchIcn').addClass('dn');
			  $('.unmatchIcn').removeClass('dn');
			}
			else{
			if(otp==data.otp){
			    if(logotpflag ==2){
			      getuserdetail(inptmob);
			     
			  }
			  else{
			  $('#resend_otp').removeClass('dn');
			  $('.matchIcn').removeClass('dn');
			  $('.unmatchIcn').addClass('dn');
			  $('#paswrd1id').removeClass('dn');
			  $('#paswrd2id').removeClass('dn');	
			  $('#resend_otp').addClass('dn');
			  $('#otp_countn').removeClass('dn');
			  //common.msg(0,'otp is correct');  
			}
		      }
		      else{
			$('.matchIcn').addClass('dn');
			$('.unmatchIcn').removeClass('dn');
			common.msg(0,'your entered otp is wrong');
		      }
		    }
		    }
		  }
	     });
}
 
 $('#otp_countn').click(function(){
   bakflag=1;
   if(contnu_enble == 1){
     openfst1();
   }
   else{
     common.msg(0,'Please Enter Correct Password ');
   } 
 });
 
 
 $('#shpng_sub').click(function(){
   validationFlag=1;
   var name,email,mobile;
   
    if($('.neadHide').hasClass('dn')){
     // common.msg(0,'hi');
    }
    else{
    name=$('#shpdname').val();  
    email=$('#shpdemail').val();
    mobile=$('#shpdmobile').val(); 
     var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    if(name ===''|| name === null){
       validationFlag=0;  
        common.msg(0,'Please enter your Name'); 
    }
    else if(!isNaN(name)){
       validationFlag=0;  
        common.msg(0,'Name should be alphanumeric'); 
    }
    else if(email===''|| email=== null){
      validationFlag=0;  
        common.msg(0,'Please enter your Email.id'); 
    }
   else if (!reg.test(email)){
     validationFlag=0; 
      common.msg(0,'Invalid Email.id'); 
    }
    else if(mobile===''|| mobile=== null){
       validationFlag=0;  
        common.msg(0,'Please enter your Mobile no.'); 
    }
    else if(isNaN(mobile) || (mobile.length < 10) ){
       validationFlag=0;  
        common.msg(0,'Mobile no. Invalid'); 
    }
     shipngdata['name']=name;
     shipngdata['email']=email;
     shipngdata['mobile']=mobile;
    }
    var addrs=$('#shpdaddrs').val();
    var city=$('#shpdcity').val(); 
    var state=$('#shpdstate').val();
    var pincode=$('#shpdpincode').val(); 
    
    if(addrs ===''|| addrs === null){
       validationFlag=0;  
        common.msg(0,'Please enter your address'); 
    }
    else if(pincode ===''|| pincode === null){
       validationFlag=0;  
        common.msg(0,'Please enter your Zip code'); 
    }
    
    if (validationFlag == 1){
      
     var usrid=common.readFromStorage('jzeva_uid'); 
     if(inp_data !== undefined && usrid == null){
      
    if($.isNumeric(inp_data)){
      
    var URLreg= APIDOMAIN + "index.php/?action=addnewUser&name="+name+"&mobile="+inp_data+"&pass="+passwrd+"&email="+email+"&city="+city+"&address="+addrs; 
    }
    else{
      shipngdata['email']=mail;
      var URLreg= APIDOMAIN + "index.php/?action=addnewUser&name="+name+"&email="+email+"&pass="+passwrd+"&mobile="+mobile+"&city="+city+"&address="+addrs; 
    } 
    $.ajax({  type:'POST', url:URLreg,  success:function(res){
			  var data1 = JSON.parse(res); 
			  if(data1['error']['err_code']==0){
			  
			  var uid=data1['error']['userid'];
			  common.addToStorage('jzeva_uid',uid);
			  common.addToStorage("jzeva_email", email);
			  common.addToStorage("jzeva_name",name);
			  if($.isNumeric(inp_data))   common.addToStorage("jzeva_mob", inp_data);
			  else   common.addToStorage("jzeva_mob", mobile);
			  }   
			  else if(data1['error']['err_code']==1)   common.msg(0,data1['error']['err_msg']); 
		  }
	    });
     }
  else{
    var name=common.readFromStorage('jzeva_name'); 
    email=common.readFromStorage('jzeva_email'); 
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
  if($.isNumeric(inp_data)){
    if(inp_data===''|| inp_data=== null){
      validationflg=0;  
        common.msg(0,'Please enter your Mobile no.'); 
    }
    else if(isNaN(inp_data) || (inp_data.length < 10) || (inp_data.length > 11) ){
      validationflg=0;  
        common.msg(0,'Invalid Mobile no '); 
    }
      
    if(validationflg == 1){
      checkuser(inp_data);
     
    }
  }
  else{
    var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    if(inp_data===''|| inp_data=== null){ 
        common.msg(0,'Please enter your Email.id or mobile no');
        validationflg=0; 
    }
    else if (!reg.test(inp_data)){ 
      common.msg(0,'Invalid Email.id');
        validationflg=0; 
    }
     if(validationflg == 1){
       checkuser(inp_data);
      openThrd();
     //  sendotpmail(); 
      }  
  } 
});

 $('#otp1').on('keyup',function(){
       var otp=$(this).val();  
       if(otp.length == 6)
         checkotp(inp_data,otp);   
  }); 

$('#resend_otp').click(function(){ 
     sendnewuserotp();
});

function sendnewuserotp()
{
  var URL= APIDOMAIN + "index.php/?action=sendnewuserotp&mobile="+inp_data; 
	$.ajax({ type:'POST', url:URL, success:function(res){
		  var data1 = JSON.parse(res);  
		  if(data1['error']['err_code']==0) { 
		    common.msg(0,data1['error']['err_msg']);
		  }
		  else if(data1['error']['err_code']==1){
		   common.msg(0,data1['error']['err_msg']);
		  }
		  else if(data1['error']['err_code']==2){
		   common.msg(0,data1['error']['err_msg']);
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
		    common.msg(0,data1['error']['err_msg']);
		  }
		  else if(data1['error']['err_code']==1){
		   common.msg(0,data1['error']['err_msg']);
		  }
		  else if(data1['error']['err_code']==2){
		   common.msg(0,data1['error']['err_msg']);
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
		           
			 var data=JSON.parse(res);
			  var usrid=common.readFromStorage('jzeva_uid'); 
			 openfst();
			 displayaddrs(usrid);
			 
        }
        });
  }
}

function displayaddrs(userid)
{ 
  var addstr='';
   $('#intscrl').html('');
   var URL= APIDOMAIN + "index.php/?action=getshippingdatabyid&userid="+userid; 
      $.ajax({  url: URL,  type: "GET",   datatype: "JSON",   success: function(results)   { 
		     var data=JSON.parse(results);
		
		     var res=data['results'];
		     if(res !== null){
		       $('addr_main').html('');
		     $(res).each(function(r,v){
	 
    addstr+='<div class="col100 fLeft radTor">';
    addstr+='  <div class="w50r fLeft">';
    addstr+=' <div class="text fLeft" id="spnd_name">'+v.name+'</div>';
    addstr+=' <div class="text fLeft" id="spnd_email">'+v.email+'</div>';
    addstr+=' <div class="text fLeft" id="spnd_city_pin">'+v.city+"-"+v.pincode+'</div>';
    addstr+='  </div>   <div class="w50l fRight"> ';
    addstr+=' <div class="text fLeft"><span>'+v.address+'</span></div>';
    addstr+=' </div>';
    addstr+=' <input type="radio" name="selectM" onclick="addrsel(this)" class="filled-in dn" id="'+v.shipping_id+'">';
    addstr+='  <label for="'+v.shipping_id+'"></label> ';
    addstr+=' <div class="btncnt fLeft bolder">';
    addstr+='  <center> ';
    addstr+=' <div class="dlvrBtn transition300">DELIVER TO THIS ADDRESS</div> ';
    addstr+=' </center> ';
    addstr+=' </div>';
    addstr+='  </div> ';
       
   
     });
      $('#intscrl').append(addstr);
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
      validationFlag=0; 
    common.msg(0,'Please Enter correct Zip Code');
   }
}); 
 
function  storeorderdata()
{
  
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
 
 $('#all_submt').click(function(){
   if(shipng_id == undefined){
     common.msg(0,'Please select Your shipping Address');
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
				common.msg(0,'Your Order Placed successfully'); 
				}
		  }); 
		
            }
        });
}
 
function checkuser(inpt)
{
  if($.isNumeric(inpt)){
     var URL = APIDOMAIN + "index.php?action=getUserDetailsbyinpt&mobile="+inpt;  
  }
  else{
    var URL = APIDOMAIN + "index.php?action=getUserDetailsbyinpt&email="+inpt;  
  } 
   $.ajax({  url: URL,  type: "GET",   datatype: "JSON", success: function(results)  {
	var obj=JSON.parse(results);  
	if(obj['error']['Code'] == 0){ 
	    if(obj['results'] == null || obj['results'] == undefined){
		openThrd();
		$('#paswrd1id').addClass('dn');
		$('#paswrd2id').addClass('dn');
		$('.matchIcn').addClass('dn');
		$('.unmatchIcn').removeClass('dn');
		$('#otp_countn').addClass('dn');
		    sendnewuserotp(); 
	    }
	    else{
	       openFifth();
	    }
	}
		    }
		  });
}

$('#suboldusrpasw').click(function(){
 
  var pass=$('#pswrd8').val();
  if(pass ===''|| pass === null){  
        common.msg(0,'Please enter your Password'); 
    }
    else{
      var URL = APIDOMAIN + "index.php?action=checkpassw&pass="+pass+"&mob="+inp_data; 
       
       $.ajax({  url: URL,  type: "GET",   datatype: "JSON", success: function(results)  {
	var obj=JSON.parse(results);  
	if(obj['error']['err_code'] == 0){
	    
	   common.addToStorage('jzeva_uid', obj['result']['uid']);
	   common.addToStorage('jzeva_cartid',obj['result']['cart_id']);
	   common.addToStorage("jzeva_email", obj['result']['email']);
           common.addToStorage("jzeva_name", obj['result']['uname']); 
	   common.addToStorage("jzeva_mob",obj['result']['mob']);
	   mtrmklm();
	   displayaddrs(obj['result']['uid']);
	 //  common.msg(0,obj['error']['err_msg']);
	}
	else if(obj['error']['err_code'] == 1)
	   common.msg(0,obj['error']['err_msg']);
	else if(obj['error']['err_code'] == 2)
	   common.msg(0,obj['error']['err_msg']);
      }
    }); 
    } 
});

function addrsel(ths)
{ 
  var id=$(ths).attr('id'); 
  shipng_id=id;
}

function getuserdetail(inpt)
{
  if($.isNumeric(inpt)){
     var URL = APIDOMAIN + "index.php?action=getUserDetailsbyinpt&mobile="+inpt;  
  }
  else{
    var URL = APIDOMAIN + "index.php?action=getUserDetailsbyinpt&email="+inpt;  
  } 
   $.ajax({  url: URL,  type: "GET",   datatype: "JSON", success: function(results)  {
	var obj=JSON.parse(results);  
	console.log(obj['results']['0']);
	   common.addToStorage('jzeva_uid', obj['results']['0'].user_id);
	   common.addToStorage('jzeva_cartid',obj['results']['0'].cart_id);
	   common.addToStorage("jzeva_email", obj['results']['0'].email);
           common.addToStorage("jzeva_name", obj['results']['0'].user_name); 
	   common.addToStorage("jzeva_mob",obj['results']['0'].logmobile);
	   lmtmkm();
	   displayaddrs(obj['results']['0'].user_id);
      }
    });
   var userid=common.readFromStorage('jzeva_uid');
			 
}

$('#shpd_bak').click(function(){
    if(bakflag ==1){
     openThrd();
    }
    else if(bakflag == 2){
      var userid=common.readFromStorage('jzeva_uid'); 
      openfst(); 
      displayaddrs(userid);
    }
});

$('#log_otp').click(function(){
   if($.isNumeric(inp_data)){
        sendnewuserotp(); 
   }
   else{
     //mail
   }
});

$('#sub_lototp').click(function(){
  var otp=$('#shpdemail3').val();
   if($.isNumeric(inp_data)){
      logotpflag=2;
     checkotp(inp_data,otp);
   } 
 
});

$('#resend_lotp').click(function(){
    sendnewuserotp();
});

function indianMoney(x){
          x=x.toString();
          var afterPoint = '';
          if(x.indexOf('.') > 0)
             afterPoint = x.substring(x.indexOf('.'),x.length);
          x = Math.floor(x); 
          x=x.toString();
          var lastThree = x.substring(x.length-3);
          var otherNumbers = x.substring(0,x.length-3);
          if(otherNumbers != '')
              lastThree = ',' + lastThree;
          var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
          
          return res;
     }