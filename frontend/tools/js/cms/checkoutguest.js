  
 var gndrflg, mobile, shpngusrflg, shipngzpcodflg=1, glbcartdeatil, gndrflg, mobile, otpflg=0, userdata=[], newuserid, actn;
 var mailflag=1, mobflag=1;
 $(document).ready(function(){
   
   actn= GetURLParameter('actn'); 
 });
 
 function GetURLParameter(Param)
{

    var PageURL = window.location.search;
    var URLVariables = PageURL.split('&');
    for (var i = 0; i < URLVariables.length; i++)
    {
        var ParameterName = URLVariables[i].split('=');
        if (ParameterName[0] == Param) {
            return ParameterName[1];
        }

    }
}
 
 $('#cnt_guest').click(function(){
      
  var validationFlag = 1, shipngdata = {};
 
  var usrid = common.readFromStorage('jzeva_uid');
 
    var name = $('#g_name').val();
    var email = $('#g_mail').val();
    mobile = $('#g_mobl').val(); 
    var addrs = $('#g_addr').val();
    var city = $('#shpdcity').val();
    var state = $('#shpdstate').val();
    var pincode = $('#shpdpincode').val();
    var addchk=/^[a-zA-Z0-9-#-'-, ]*$/;
    var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    
    var filter = /^[0-9-+]+$/;
    if(gndrflg == undefined || gndrflg == null){
      validationFlag=0;  
      common.msg(0,'Please Select Title');  
    }
    else if (name === '' || name === null) {
      validationFlag = 0;
      common.msg(0, 'Please enter your Name');
    }  
    else if (mobile === '' || mobile === null) {
      validationFlag = 0;
      common.msg(0, 'Please enter your Mobile no');
    } 
    else if (isNaN(mobile) || (mobile.length !== 10)) {
      validationFlag = 0;
      common.msg(0, 'Please Enter 10 Digit Mobile No.');
    } 
    else if(!filter.test(mobile)){ 
	    validationFlag=0;  
	    common.msg(0,'Mobile number is Invalid');  
    }
    else if (email === '' || email === null) {
      validationFlag = 0;
      common.msg(0, 'Please enter your Email id');
    } 
    else if (!reg.test(email)) {
      validationFlag = 0;
      common.msg(0, 'Invalid Email.id');
    }
    else if (addrs === '' || addrs === null) {
      validationFlag = 0;
      common.msg(0, 'Please enter your address');
    } 
    else if (!addchk.test(addrs)) {
        validationFlag = 0;
        common.msg(0, 'Please remove special characters from address');
    } 
    else if (pincode === '' || pincode.length === 0) {
      validationFlag = 0;
      common.msg(0, 'Please enter your Zip code');
    } 
    else if (pincode.length > 6 || pincode.length < 6) {
      validationFlag = 0;
      common.msg(0, 'Please enter Correct Zip code');
    } 
    else if (state === '' || state === null) {
      validationFlag = 0;
      common.msg(0, 'Please enter your state name');
    } 
    else if (city === '' || city === null) {
      validationFlag = 0;
      common.msg(0, 'Please enter your city name');
    }
      
    if(shipngzpcodflg !== 1 && validationFlag == 1){
      validationFlag = 0;
      common.msg(0, 'Please enter Valid Zip code');
    }
    
    shipngdata['name'] = name;
    shipngdata['email'] = email;
    shipngdata['mobile'] = mobile;
    shipngdata['address'] = addrs;
    shipngdata['pincode'] = pincode;
    shipngdata['state'] = state;
    shipngdata['city'] = city; 

  if (validationFlag == 1)
  { 
     
    setTimeout(function () {
      var usrid = common.readFromStorage('jzeva_uid'); 
	shipngdata['user_id'] = usrid; 
      storeshippingdata(shipngdata);
    }, 1000);

  } 
 });

 

$('#shpdpincode').on('keyup',function () {
  
  var zipcode = $(this).val();
  $('#shpdcity').val('');   $('#shpdcity').blur();
  $('#shpdstate').val('');  $('#shpdstate').blur();
  if($.isNumeric(zipcode)){
    if (zipcode.length == 6)
      checkshpdpincode(zipcode);
  }
  else
  {
    if(zipcode.length == 6 || zipcode.length == 1)
	common.msg(0, 'Please Enter Numeric Value'); 
     
  }
});


function checkshpdpincode(zipcode)
{

  if (zipcode.length == 6) {
    var URL = APIDOMAIN + "index.php?action=viewbyPincode&code=" + zipcode;
    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results)
      {
	var obj = JSON.parse(results);
 
	if(obj['error']['code'] == 0)
	{
	  $('#shpdstate').val(obj.results[0].state);
	  $('#shpdcity').val(obj.results[0].city);
	  shipngzpcodflg = 1;
	  $('#shpdcity').focus();
	  $('#shpdstate').focus(); 
	} 
	else if(obj['error']['code'] == 1){
	  shipngzpcodflg = 0;
	  common.msg(0, obj['error']['msg']);
	}
      }
    });
  } 
  else if (zipcode.length == 0) {
  } 
  else {
    shipngzpcodflg=0;
    common.msg(0, 'Please Enter correct Zip Code');
  }
}


$('.opt1').click(function(){
    var id=$(this).attr('id');
    id=id.split('_');
    gndrflg=id[1];  
  });
  
 
function storeshippingdata(shipngdata)
{ 
    var URL = APIDOMAIN + "index.php?action=addshippingdetail";
    var data = shipngdata;
    var dt = JSON.stringify(data);
    $.ajax({type: "post", url: URL, data: {dt: dt}, success: function (res) {

	var data = JSON.parse(res); 
	 var shipid=data.shipid;
	 common.addToStorage('jzeva_shpid');  
	 
	  if(actn == 'buy')
	  { 
	      window.location.href = DOMAIN + "index.php?action=checkoutBefore&shpid="+shipid+"&actn=buy";
	  }
	  else
	      window.location.href = DOMAIN + "index.php?action=checkoutBefore&shpid="+shipid;
    }
    }); 
}

$('#sign_in').click(function(){
  
  var email = $("#inp_mob_mail").val();
  var pass = $("#paswrd").val();
  var validationFlag=1,URL;
  var filter = /^[0-9-+]+$/;
  var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
  if($.isNumeric(email)){
      if(email===''|| email=== null){ 
                 validationFlag=0;
                  $('#email').focus();
                 common.msg(0,'Please enter your Email.id or Mobile No');
           }
      else if(isNaN(email) || (email.length !== 10) ){
	 validationFlag=0;  
          $('#email ').focus();
	  common.msg(0,'Please Enter 10 Digit Mobile No.'); 
        } 
      else if(!filter.test(email)){ 
	    validationFlag=0;  
	    common.msg(0,'Mobile number is Invalid'); 
	    return false;
	}
         URL = APIDOMAIN + "index.php?action=login&mobile="+email+"&pass="+pass;
  }
  else{
        if(email===''|| email=== null){ 
                 validationFlag=0;
                 $('#email ').focus();
                 common.msg(0,'Please enter your Email.id or Mobile No');
           }
          else if (!reg.test(email)){ 
                 validationFlag=0; 
                 $('#email').focus();
                 common.msg(0,'Invalid Email.id');
           }
            URL = APIDOMAIN + "index.php?action=login&email="+email+"&pass="+pass;
  } 
  if(validationFlag == 1){
  if(pass===''|| pass=== null){
	  validationFlag=0; 
	  $('#pass').focus();
	  common.msg(0,'Please enter Password'); 
    }
  }
    
    if (validationFlag == 1){
     
    var data;
    $.ajax({
            type:'POST',
            url:URL,
            success:function(res){
                
	      data = JSON.parse(res);
	      var logDetails = data['result'];
            if(data['error']['err_code']==0)
            {  
	      $("#inp_mob_mail").val('');
	      $("#paswrd").val('');
              common.addToStorage("jzeva_email", logDetails['0']['email']);
              common.addToStorage("jzeva_name", logDetails['0']['name']);
              common.addToStorage("jzeva_uid", logDetails['0']['uid']);
	       common.addToStorage("jzeva_mob", logDetails['0']['mobile']);
	      var oldcartid=common.readFromStorage('jzeva_cartid'); 
	      var olduserid=common.readFromStorage('jzeva_uid');
	     
	       var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id="+oldcartid+"&userid="+olduserid+"";   
	       $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    {
		      var obj=JSON.parse(results); 
		      glbcartdeatil=obj.result;
		      if(oldcartid=="" || oldcartid==null){
			  if(glbcartdeatil!= null){
			       var cartid=glbcartdeatil[0].cart_id;  
			  }
			      if(cartid){
				  common.addToStorage("jzeva_cartid", cartid);}
			      else{
				//  common.addToStorage("jzeva_cartid", gencartId());  
			      }
		      }
		      else{
			    hasitem(oldcartid,olduserid);
		      }
		      if(actn == 'buy'){ 
			    window.location.href = DOMAIN + "index.php?action=checkOutNew&actn=buy";
		      }
		      else
			    window.location.href=DOMAIN + 'index.php?action=checkOutNew';
		    }
		});  
            }
            else if(data['error']['err_code']==1){
                common.msg(0,data['error']['err_msg']);
            }
        }
    });
    } 

});

 
 
function hasitem(oldcartid,olduserid)
{

   var newcartid,hasusrid=[],ccnt=0,hasoldcartid=[],ocnt=0; 
   
  $(glbcartdeatil).each(function(r,v){
     if(v.userid!=0){
       hasusrid[ccnt]=v;ccnt++;
         newcartid=v.cart_id;  
     }
     else{
       hasoldcartid[ocnt]=v;ocnt++; 
     } 
  });
    if(hasusrid=="" || hasusrid==null){
     updatecartiddetail(oldcartid,olduserid,newcartid);  
    }
    else{
       
   var start=1,last=hasusrid.length;
   $(hasusrid).each(function(r,v){  
      var prdid=v.product_id; 
      var col_car_qty=v.col_car_qty;   
      var size=v.size;
	$(hasoldcartid).each(function(m,n){
	      if(prdid==n.product_id && col_car_qty==n.col_car_qty && size==n.size){
		  var price=parseInt(v.price);  
		  var j=parseInt(v.pqty); var l=parseInt(n.pqty);
		  price=price/j;
		  j=j+l;
		  price=price*j;

		  var dat={};
		  dat['cartid']=v.cart_id;    dat['pid']=v.product_id;
		  dat['userid']=v.userid;     dat['col_car_qty']=v.col_car_qty;
		  dat['qty']=j;		  dat['price']=price; 
		  dat['RBsize']=size;
		   var URL= APIDOMAIN + "index.php?action=addTocart";
		  var data=dat; 
		  var  dt = JSON.stringify(data); 
		  $.ajax({
			type:"post",
			url:URL,
			data: {dt: dt},
			success:function(data){
			    
			}
		  });

	var URL = APIDOMAIN+"index.php?action=removeItemFromCart&col_car_qty="+col_car_qty+"&pid="+prdid+"&cartid="+n.cart_id+"&size="+size;
		    $.ajax({
			    type:'POST',
			    url:URL,
			    success:function(res){
			    
			    }
		    });  
	      }
	});
    
      if(last==start){  
	updatecartiddetail(oldcartid,olduserid,newcartid);   
      }
      start++;
   });
   } 
}

 
function updatecartiddetail(oldcartid,olduserid,newcartid)
{
  if(newcartid=="" || newcartid==null){
    var URL = APIDOMAIN + "index.php?action=updatecartdata&cartid="+oldcartid+"&userid="+olduserid+"&newcartid="+oldcartid;
  }
  else{
    var URL = APIDOMAIN + "index.php?action=updatecartdata&cartid="+oldcartid+"&userid="+olduserid+"&newcartid="+newcartid;
  } 
   
 	       $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    { 
		   //   console.log(results);
		    }
		  });   
 
}


$('#gSgnUpsbmt').click(function(){
   
    var name = $("#shpdname").val();
   var email = $("#shpdemail").val();
     mobile = $("#shpdmobile").val();
   var pass = $("#shpdpaswrd").val(); 
   var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    
   var filter = /^[0-9-+]+$/;
    var validationFlag=1;
    if(gndrflg == undefined || gndrflg == null){
      validationFlag=0;  
     common.msg(0,'Please Select Title');  
     return false;
    }
    else if(name ===''|| name === null){
      validationFlag=0;  
     common.msg(0,'Please enter your Name'); 
      return false;
    }   
    else if(email===''|| email=== null){
       validationFlag=0;  
         common.msg(0,'Please enter your Email-id'); 
          return false;
    }
   else if (!reg.test(email)){
      validationFlag=0;  
       common.msg(0,'Invalid Email-id'); 
        return false;
    }
    else if(mobile===''|| mobile=== null){
       validationFlag=0;  
        common.msg(0,'Please enter your Mobile no.'); 
         return false;
    }
    else if(isNaN(mobile) || (mobile.length !== 10) ){
       validationFlag=0;  
        common.msg(0,'Please Enter 10 Digit Mobile No.'); 
         return false;
    }
    else if(!filter.test(mobile)){ 
	    validationFlag=0;  
	    common.msg(0,'Mobile number is Invalid'); 
	    return false;
    }
    else if(pass ===''|| pass === null){
       validationFlag=0;  
         common.msg(0,'Please enter your Password'); 
          return false;
    }
    if(mailflag == 0 && validationFlag == 1)
    {
        validationFlag=0;  
        common.msg(0,'Please enter New Email Id'); 
        return false;
    }
    if(mobflag == 0 && validationFlag == 1)
    {
        validationFlag=0;  
        common.msg(0,'Please enter New Mobile No'); 
        return false;
    }
    
    if (validationFlag == 1)
    {
       
      var URL= APIDOMAIN + "index.php/?action=getUserDetailsbyinpt&email="+email+"&mobile="+mobile; 
      $.ajax({  url: URL, type: "GET", datatype: "JSON",  success: function(res)  {
		       var data=JSON.parse(res); 
                       
		       $(data['results']).each(function(r,v){ 
		       if(v.logmobile == mobile ){
			 common.msg(0,'Your entered mobile number is already registered');
		       }
		       else if( v.email == email){
			 common.msg(0,'Your entered email id is already registered');
		       } 
	  });
	 if(data['results'] == null)  {
	   
	  otpflg=1; 
	  gSgnUpsbmt(); 
	  $('#signupotp').val('');	  $('#signupotp').blur();  
	  sendotp(mobile); 
	  userdata[0]=name;
	  userdata[1]=email;
	  userdata[2]=mobile;
	  userdata[3]=pass; 
	  }
	  
	        }
});
     }
 
});

function  sendotp(mobile)
{ 	  
      var URL= APIDOMAIN + "index.php?action=sendnewuserotp&mobile="+mobile; 
      $.ajax({  type:'POST',  url:URL,  success:function(res){
	       
	       var data1 = JSON.parse(res);  
	       if(data1['error']['err_code']==0)
	       {
		    common.msg(1,data1['error']['err_msg']);  
	       }
	       else if(data1['error']['err_code']==1){
		   common.msg(0,data1['error']['err_msg']);
	       } 
	   }
       }); 
}  

$('#signupOtpSubmit').click(function(){
 
   var otpval=$('#signupotp').val(); 
     if(otpval.length == 6) { 
	  checkotp(otpval); 
     }
     else if(otpval.length == '' || otpval.length == 0){
			  common.msg(0,'Please Enter OTP');
		      }
     else{
       common.msg(0,'your entered otp is wrong');
     }
   
});

function checkotp(otpval)
{ 
      var URL= APIDOMAIN + "index.php?action=checkopt&mobile="+mobile+"&otpval="+otpval; 
   
      $.ajax({  url: URL, type: "GET",  datatype: "JSON", success: function(results) {
	  
		      var obj=JSON.parse(results); 
		      var data=obj.result;
		      if(data.otp==null){
			common.msg(0,'time is over plz try it again');
		      }
		      else{
		      if(otpval==data.otp){
	if(otpflg == 1)	 
	{
		  
   var URLreg= APIDOMAIN + "index.php?action=addUser&name="+userdata[0]+"&email="+userdata[1]+"&mobile="+userdata[2]+"&pass="+userdata[3]+"&gender="+gndrflg; 
   
   $.ajax({  type:'POST', url:URLreg, success:function(res){
       
	    var data1 = JSON.parse(res); 
            if(data1['error']['err_code']==0)  
	    { 
                common.msg(1,'Registered Successfully'); 
		var URL = APIDOMAIN + "index.php?action=login&email="+userdata[1]+"&pass="+userdata[3]; 
		$.ajax({ type:'POST',  url:URL, success:function(res){ 
		    
		    var data = JSON.parse(res); 
		    var logDetails = data['result'];
		    if(data['error']['err_code']==0)
		    {   
		      common.addToStorage("jzeva_email", logDetails['0']['email']);
		      common.addToStorage("jzeva_name", logDetails['0']['name']);
		      common.addToStorage("jzeva_uid", logDetails['0']['uid']);
		      common.addToStorage("jzeva_mob", logDetails['0']['mobile']); 
		
		      var oldcartid=common.readFromStorage('jzeva_cartid'); 
		      var olduserid=common.readFromStorage('jzeva_uid'); 
	       var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id="+oldcartid+"&userid="+olduserid+""; 
	       
	       $.ajax({  url: URL,  type: "GET", datatype: "JSON", success: function(results) {
		   
		      var obj=JSON.parse(results); 
		      glbcartdeatil=obj.result; 
		      if(oldcartid=="" || oldcartid==null){
			  if(glbcartdeatil!= null){
			       var cartid=glbcartdeatil[0].cart_id;  
			  }
			  if(cartid){
			      common.addToStorage("jzeva_cartid", cartid);} 
		      }
		      else{
			   hasitem(oldcartid,olduserid);
		      } 
		      if(actn == 'buy'){
			  window.location.href = DOMAIN + "index.php?action=checkOutNew&actn=buy";
		      }
		      else
			  window.location.href=DOMAIN +'index.php?action=checkOutNew';
		 }
		});  
		      
		   }
		}
		}); 
		 
            }else if(data1['error']['err_code']==1){
                common.msg(0,data1['error']['err_msg']); 
            }
    }
    });
  }
   else if(otpflg == 2)
   {
       
	  $('#otptxt').val('');     $('#otptxt').blur();
	  $('#resetpass').val('');	$('#resetpass').blur();
	  $('#resetcpass').val('');	$('#resetcpass').blur();
	  gOtpSubmit(); 
   }
		      }
		      else{
			common.msg(0,'your entered otp is wrong');
		      }
		    }
    }
    });  
  
}

$('#gfSubmit').click(function(){
    mobile=$('#shpdemailid').val();
    
    var validationflg=1;
    if($.isNumeric(mobile)){
      var filter = /^[0-9-+]+$/;
      if(mobile===''|| mobile=== null){
	 validationflg=0;  
        common.msg(0,'Please enter your Mobile no.'); 
         return false;
      }
      else if(isNaN(mobile) || (mobile.length !== 10)  ){
	 validationflg=0;  
	  common.msg(0,'Invalid Mobile no.'); 
           return false;
      } 
      else if(!filter.test(mobile)){ 
	    validationflg=0;  
	    common.msg(0,'Mobile number is Invalid'); 
	    return false;
      }
    }
    else{
      
       var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
	   if(mobile===''|| mobile=== null){
	     validationflg=0;  
	       common.msg(0,'Please enter your Email.id or Mobile no.'); 
	   }
	   else if (!reg.test(mobile)){
	     validationflg=0; 
	    common.msg(0,'Invalid Email.id'); 
             return false;
	   } 
    }
    
	  
    if(validationflg == 1)
    {
  	   otpflg=2;
  	   checkuser(mobile);  
    }
 
});

 function checkuser(inptval)
 {
    if($.isNumeric(inptval))
    var URL= APIDOMAIN + "index.php?action=getUserdetailbymob&mob="+inptval; 
     else
      var URL= APIDOMAIN + "index.php?action=getUserdetailbymob&email="+inptval; 
   
      $.ajax({  url: URL,  type: "GET",  datatype: "JSON",  success: function(res)  {
	  
		       var data=JSON.parse(res);  
		       if(data['result']['mob'] == inptval){
		      
		       newuserid=data['result']['user_id'];
		        sendotp(inptval);
			gfSubmit();
		       }
		       else if(data['result']['email'] == inptval){ 
			 newuserid=data['result']['user_id'];
			  sendemailotp(inptval);
			  gfSubmit();
		       }
		       else{
			 if($.isNumeric(inptval))  
                             common.msg(0,'Mobile No not exist');
			 else		
                             common.msg(0,'email id not exist');
		       } 
		    }
      });
 }
 
 
  function sendemailotp(inptval)
  {
    var URL=APIDOMAIN + "index.php?action=newforgotPass&email="+inptval;
    $.ajax({type:"POST", url: URL, success:function(res){
	 common.msg(1,'OTP had sent to your email id');
	 var data=JSON.parse(res);
	 mailmob=data['mob'];
    }
    });
  }
  
  $('#gOtpSubmit').click(function(){
    var otp=$('#otptxt').val();
      if(otp.length == 6)
	checkotp(otp);
      else
	 common.msg(0,'Please Enter correct OTP');
  });
  
  
   $('#gResetSubmit').click(function () {
      
    var pass = $("#res_paswrd1").val();
   var cpass = $("#res_paswrd2").val();
   var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var validationFlag=1;
   if(pass ===''|| pass === null){ 
       common.msg(0,'Please enter your Password');
        validationFlag=0; 
         return false;
    }
    else if(cpass===''|| cpass=== null){ 
        common.msg(0,'Please enter the confirm password');
        validationFlag=0; 
        return false; 
    }
    if(validationFlag == 1){ 
    if(pass !== cpass){
      common.msg(0,'please enter same password');
    }
    else{
       var URL= APIDOMAIN + "index.php?action=updateuserpass&user_id="+newuserid+"&pass="+pass+"&mobile="+mobile+"&email="+mobile; 
      $.ajax({  type:'POST',  
                url:URL, 
                success:function(res){
	 
	        common.msg(1,'Password Changed Successfully');  
		 gResetSubmit();
	   }
       }); 
    }
    }
 
        
   });
   
    $('#shpdemail').blur(function(){
        var email=$('#shpdemail').val();
	if(email.length > 0)
	{
	    var validationFlag=1;
	    var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;

	    if(email===''|| email=== null){
		mailflag=0;
		validationFlag=0;  
		common.msg(0,'Please enter your Email-id'); 
		return false;
	    }
	    else if (!reg.test(email)){
		mailflag=0;
		validationFlag=0;  
		common.msg(0,'Invalid Email-id'); 
		return false;
	    }
	    if(validationFlag == 1)
	    {
		var URL= APIDOMAIN + "index.php?action=getUserDetailsbyinpt&email="+email+"&mobile="; 
		var vlflag=1;
		$.ajax({  url: URL, type: "GET", datatype: "JSON",  success: function(res)  {
			   var data=JSON.parse(res); 

			   $(data['results']).each(function(r,v){ 
			   if( v.email == email){
			     mailflag=0;
			     vlflag=0;
			     common.msg(0,'Your entered email id is already registered');
			   } 
			   });
			   if(vlflag == 1)
			     mailflag=1;
		}
		});
	    }
	}
   });
   
    $('#shpdmobile').blur(function(){
    
	var mobile=$('#shpdmobile').val();
	if(mobile.length > 0)
	{
	    var validationFlag=1; 
	    var filter = /^[0-9-+]+$/;
	    if(mobile===''|| mobile=== null){
		mobflag=0;
		validationFlag=0;  
		common.msg(0,'Please enter your Mobile no.'); 
		return false;
	    }
	    else if(isNaN(mobile) || (mobile.length !== 10) ){
		mobflag=0;
		validationFlag=0;  
		common.msg(0,'Please Enter 10 Digit Mobile No.'); 
		return false;
	    }
	    else if(!filter.test(mobile)){
		mobflag=0;
		validationFlag=0;  
		common.msg(0,'Mobile number is Invalid'); 
		return false;
	    }

	    if(validationFlag == 1)
	    {
		var URL= APIDOMAIN + "index.php?action=getUserDetailsbyinpt&email=&mobile="+mobile; 
		var valflag=1;
		$.ajax({  url: URL, type: "GET", datatype: "JSON",  success: function(res)  {
			   var data=JSON.parse(res); 

			   $(data['results']).each(function(r,v){ 
			   if(v.logmobile == mobile ){
			     mobflag=0;
			     valflag=0;
			     common.msg(0,'Your entered mobile number is already registered');
			   } 
			   });
			   if(valflag == 1)
			      mobflag=1;
		}
		});
	    }
	}
  });