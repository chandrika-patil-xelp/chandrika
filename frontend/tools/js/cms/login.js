 
var glbcartdeatil, inptval, newuserid, otpflg=0, userdata=[], entrflg=0, mailmob, gndrflg, mailflag=1, mobflag=1;

$('#rsubId').on('click',function(){
  dosignup();
});
 
 function dosignup()
 {
    var name = $("#name").val();
   var email = $("#signupemail").val();
   var  mobile = $("#mobile").val();
   var pass = $("#signuppass").val(); 
   var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
   var letters = /^[a-zA-Z\s]+$/;
   
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
    else if(!letters.test(name)){
       validationFlag=0;  
        common.msg(0,'Name should be alphanumeric'); 
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
    else if(isNaN(mobile) || (mobile.length < 10) ){
       validationFlag=0;  
        common.msg(0,'Mobile number is Invalid'); 
         return false;
    }
    else if(pass ===''|| pass === null){
       validationFlag=0;  
         common.msg(0,'Please enter your Password'); 
          return false;
    }
    if(mailflag == 0)
    {
        validationFlag=0;  
        common.msg(0,'Please enter New Email Id'); 
        return false;
    }
    if(mobflag == 0)
    {
        validationFlag=0;  
        common.msg(0,'Please enter New Mobile No'); 
        return false;
    }
    if (validationFlag == 1)
    {
       
      var URL= APIDOMAIN + "index.php?action=getUserDetailsbyinpt&email="+email+"&mobile="+mobile; 
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
	    inptval=mobile;
	    signupSubmit(); 
            $('#otpCont').velocity({opacity: [1, 0], translateY: [0, 20]}, {duration: 400, delay: 100, easing: 'ease-in-out'});

	  $('#signup_otp').val('');	  $('#signup_otp').blur(); 
          otpflg=1; 
	  sendotp(); 
	  userdata[0]=name;
	  userdata[1]=email;
	  userdata[2]=mobile;
	  userdata[3]=pass; 
	  }
	  
	        }
});
     }
}
 

$('#log').click(function(){ 
  chklogin();
});

function chklogin()
{
  var email = $("#email").val();
  var pass = $("#pass").val();
  var validationFlag=1,URL;
  var filter = /^[0-9-+]+$/;
  var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
  if($.isNumeric(email)){
      if(email===''|| email=== null){ 
                 validationFlag=0;
                  $('#email').focus();
                 common.msg(0,'Please enter your Email.id or Mobile No');
           }
      else if(isNaN(email) || (email.length < 10) || (email.length > 11) ){
	 validationFlag=0;  
          $('#email ').focus();
	  common.msg(0,'Invalid Mobile no.'); 
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
		    common.msg(1,'Signed in successfully'); 
		        var URLactn = window.location.search; 
		      var url=DOMAIN + '/index.php' +URLactn;
		      setTimeout(function(){
			window.location.href = url; 
		      },3000)
		      
		    }
		});  
            }
            else if(data['error']['err_code']==1){
                common.msg(0,data['error']['err_msg']);
            }
        }
    });
    } 
}


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

$('#fsubId').on('click',function(){
  forgtpass();
});
  
  function forgtpass()
  {
    
    inptval=$('#femail').val();
    var validationflg=1;
    var filter = /^[0-9-+]+$/;
    if($.isNumeric(inptval)){
      
      if(inptval===''|| inptval=== null){
	 validationflg=0;  
        common.msg(0,'Please enter your Mobile no.'); 
         return false;
      }
      else if(isNaN(inptval) || (inptval.length < 10) || (inptval.length > 11) ){
	 validationflg=0;  
	  common.msg(0,'Invalid Mobile no.'); 
           return false;
      } 
      else if(!filter.test(inptval)){ 
	    validationflg=0;  
	    common.msg(0,'Mobile number is Invalid'); 
	    return false;
	}
    }
    else{
      
       var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
	   if(inptval===''|| inptval=== null){
	     validationflg=0;  
	       common.msg(0,'Please enter your Email.id or Mobile no.'); 
	   }
	   else if (!reg.test(inptval)){
	     validationflg=0; 
	    common.msg(0,'Invalid Email.id'); 
             return false;
	   } 
    }
    
	  
    if(validationflg == 1)
    {
  	   otpflg=2;
  	   checkuser(); 
	 
  }
}

function  sendotp()
{
  		  
       var URL= APIDOMAIN + "index.php?action=sendnewuserotp&mobile="+inptval; 
      $.ajax({
	       type:'POST',
	       url:URL,
	       success:function(res){
	       
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
 
$('#signup_submt').click(function(){
  sugnupsubmt();
});
   

function sugnupsubmt()
{
   var otpval=$('#signup_otp').val();
   if($.isNumeric(inptval)){
     if(otpval.length == 6) {
        
	  checkotp(otpval);
         
     }
     else if(otpval.length == '' || otpval.length == 0){
			  common.msg(0,'Please Enter OTP');
		      }
     else{
       common.msg(0,'your entered otp is wrong');
     }
   }
   else{
     // mail
   }
     
 }
 
 function checkuser()
 {
    if($.isNumeric(inptval))
    var URL= APIDOMAIN + "index.php?action=getUserdetailbymob&mob="+inptval; 
     else
      var URL= APIDOMAIN + "index.php?action=getUserdetailbymob&email="+inptval; 
   
      $.ajax({  url: URL, 
                type: "GET",
                datatype: "JSON", 
                success: function(res)  {
		       var data=JSON.parse(res); 
                       
		       if(data['result']['mob'] == inptval){
		      
		       newuserid=data['result']['user_id'];
		        sendotp();
			 fSubmit(); 
		       }
		       else if(data['result']['email'] == inptval){ 
			 newuserid=data['result']['user_id'];
			  sendemailotp(inptval);
			  fSubmit();  
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
 
 $('#respsssub').click(function(){
   restpasssubmt();
 });
   
 function restpasssubmt()
 {
    var pass = $("#resetpass").val();
   var cpass = $("#resetcpass").val();
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
       var URL= APIDOMAIN + "index.php/?action=updateuserpass&user_id="+newuserid+"&pass="+pass+"&mobile="+inptval+"&email="+inptval; 
      $.ajax({  type:'POST',  
                url:URL, 
                success:function(res){
	      // console.log(res);
	        common.msg(1,'Password Changed Successfully');  
		resetSubmit();
	   }
       }); 
    }
    }
 }
 
  
   function checkotp(otpval)
  {
    if($.isNumeric(inptval))
	var URL= APIDOMAIN + "index.php/?action=checkopt&mobile="+inptval+"&otpval="+otpval; 
    else
	var URL= APIDOMAIN + "index.php/?action=checkopt&mobile="+mailmob+"&otpval="+otpval; 
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
   var URLreg= APIDOMAIN + "index.php/?action=addUser&name="+userdata[0]+"&email="+userdata[1]+"&mobile="+userdata[2]+"&pass="+userdata[3]+"&gender="+gndrflg; 
   $.ajax({  type:'POST', 
             url:URLreg,  
             success:function(res){
	    var data1 = JSON.parse(res); 
            if(data1['error']['err_code']==0)  {
                common.msg(1,'Registered Successfully'); 
		var URL = APIDOMAIN + "index.php/?action=login&email="+userdata[1]+"&pass="+userdata[3]; 
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
		    }
		});  
		      closelogpg();
		    }
		}
		}); 
		 
            }else if(data1['error']['err_code']==1){
                common.msg(0,data1['error']['err_msg']); 
            }
    }
    });
  }
   else if(otpflg == 2){
	  entrflg=5;
	  $('#resetId').removeClass("dn");
	  $('#otp_inpt').val('');     $('#otp_inpt').blur();
	  $('#resetpass').val('');	$('#resetpass').blur();
	  $('#resetcpass').val('');	$('#resetcpass').blur();
  $('#otpCont').velocity({opacity: [0, 1], translateY: [20, 0]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
  $('#inresetId').velocity({opacity: [1, 0], translateY: [0, 20]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
     
       }
		      }
		      else{
			common.msg(0,'your entered otp is wrong');
		      }
		    }
    }
    });  
  } 
    
    
    $('#sig_pgbak').click(function(){ 
	signupBack();
	$('#name').val('');	    $('#name').blur();
	$('#signupemail').val('');  $('#signupemail').blur();
	$('#mobile').val('');	    $('#mobile').blur();
	$('#signuppass').val('');   $('#signuppass').blur();
    });
    
    $('#otp2pg_bak').click(function(){ 
	 otp2Back();
    });
    
    $('#frgpw_bak').click(function () {
        forgotBack();
    });
    
    $('#otppg_bak').click(function () {
        otpBack();
    });
	
    $('#resetpg_bak').click(function () { 
         resetBack();
    });
     
      $('#signinbtn').click(function () {
            signup();
        }); 
	
    $('#otpsubId').click(function(){
       frgpassotpsub();
    });
    
    function frgpassotpsub(){
      var otp=$('#otp_inpt').val();
      if(otp.length == 6)
	checkotp(otp);
      else
	 common.msg(0,'Please Enter correct OTP');
    }
    
    $('#resnd_otp').click(function(){ 
      sendotp();
      $('#signup_otp').val('');	    $('#signup_otp').blur();
    });
    
    $('#forId').click(function () {
            forgot();
    });
    
    $('.closeLogin').click(function () {
           closelogpg();
    }); 
    
    function closelogpg()
   {
      entrflg = 11; 
      $('.overlay').stop(true, true).fadeTo(200, 0);
      $('.tabWrap').removeClass("addPointer");
      $('.ftabB').removeClass("addPointer");
      $('.wrapper_max').removeClass("addPointer");
      $('.fade').fadeOut("slow");
      $('.outerContr').css("z-index", "203", "opacity", "0");
      $('.outerContr').velocity({translateY: ['150%', 0]}, {duration: 150, delay: 100, easing: ''});
      $('.fade').fadeIn();
      $('#dlabel').text('Title');
      $('#name').val('');	  $('#name').blur();
      $('#signupemail').val('');  $('#signupemail').blur();
      $('#mobile').val('');	  $('#mobile').blur();
      $('#signuppass').val('');	  $('#signuppass').blur();
      gndrflg=undefined;
 }
 
  $(document).on('click', '#userProfId', function () {
	  var uid=common.readFromStorage('jzeva_uid');
	  if(uid == null || uid == "")
            openPopUp(); 
  });
  
  function sendemailotp()
  {
    var URL=APIDOMAIN + "index.php?action=newforgotPass&email="+inptval;
    $.ajax({type:"POST", url: URL, success:function(res){
	 common.msg(1,'OTP had sent to your email id');
	 var data=JSON.parse(res);
	 mailmob=data['mob'];
    }
    });
  }
  
  $('#resendotp').click(function(){
    if($.isNumeric(inptval))
      sendotp();
    else
      sendemailotp();
  });
  
  $('.opt1').click(function(){
    var id=$(this).attr('id');
    id=id.split('_');
    gndrflg=id[1]; 
  });
  
  $('#signupemail').blur(function(){
    
    var email=$('#signupemail').val();
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
  
  
  $('#mobile').blur(function(){
    
    var mobile=$('#mobile').val();
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
	else if(isNaN(mobile) || (mobile.length < 10) ){
	    mobflag=0;
	    validationFlag=0;  
	    common.msg(0,'Mobile number is Invalid'); 
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