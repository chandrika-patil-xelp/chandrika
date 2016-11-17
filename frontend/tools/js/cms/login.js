 
var glbcartdeatil, inptval, newuserid, otpflg=0, userdata=[];

$('#rsubId').on('click',function(){
 
    var name = $("#name").val();
   var email = $("#signupemail").val();
   var  mobile = $("#mobile").val();
   var pass = $("#signuppass").val(); 
   var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var validationFlag=1;
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
    else if(pass ===''|| pass === null){
       validationFlag=0;  
         common.msg(0,'Please enter your Password'); 
    }
    if (validationFlag == 1)
    {
      
      var URL= APIDOMAIN + "index.php/?action=getUserDetailsbyinpt&email="+email+"&mobile="+mobile; 
      $.ajax({  url: URL, type: "GET", datatype: "JSON",  success: function(res)  {
		       var data=JSON.parse(res); 
                       
		       $(data['results']).each(function(r,v){ 
		       if(v.logmobile == mobile ){
			 common.msg(0,'You Entered mobile number is already registered');
		       }
		       else if( v.email == email){
			 common.msg(0,'You Entered email id is already registered');
		       } 
	  });
	 if(data['results'] == null)  {
	    inptval=mobile;
	    signupSubmit(); 
            $('#otpCont').velocity({opacity: [1, 0], translateY: [0, 20]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
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
});
 

$('#log').click(function(){ 
  var email = $("#email").val();
  var pass = $("#pass").val();
  var validationFlag=1;
  var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
 if(email===''|| email=== null){ 
         common.msg(0,'Please enter your Email.id');
        validationFlag=0;
        return false;
    }
   else if (!reg.test(email)){
       common.msg(0,'Invalid Email.id');
        validationFlag=0;
        return false;
    }
  else if(pass===''|| pass=== null){
         common.msg(0,'Please enter Password');
        validationFlag=0;
        return false;
    }
    
    
    if (validationFlag == 1){
    var URL = APIDOMAIN + "index.php/?action=login&email="+email+"&pass="+pass;
   
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
				  common.addToStorage("jzeva_cartid", gencartId()); }
		      }
		      else{
			   hasitem(oldcartid,olduserid);
		      }
		    common.msg(0,'signed in successfully'); 
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
      
	$(hasoldcartid).each(function(m,n){
	      if(prdid==n.product_id && col_car_qty==n.col_car_qty){
		  var price=parseInt(v.price);  
		  var j=parseInt(v.pqty); var l=parseInt(n.pqty);
		  price=price/j;
		  j=j+l;
		  price=price*j;

		  var dat={};
		  dat['cartid']=v.cart_id;    dat['pid']=v.product_id;
		  dat['userid']=v.userid;     dat['col_car_qty']=v.col_car_qty;
		  dat['qty']=j;		  dat['price']=price; 
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

	var URL = APIDOMAIN+"index.php?action=removeItemFromCart&col_car_qty="+col_car_qty+"&pid="+prdid+"&cartid="+n.cart_id;
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

function gencartId(){
    var d = new Date();
    var ti = d.getTime();
  return ti;
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
  
      inptval=$('#femail').val();
    var validationflg=1;
    if($.isNumeric(inptval)){
      
      if(inptval===''|| inptval=== null){
	 validationflg=0;  
        common.msg(0,'Please enter your Mobile no.'); 
      }
      else if(isNaN(inptval) || (inptval.length < 10) || (inptval.length > 11) ){
	 validationflg=0;  
	  common.msg(0,'Invalid Mobile no.'); 
      } 
    }
    else{
      
       var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
	   if(inptval===''|| inptval=== null){
	     validationflg=0;  
	       common.msg(0,'Please enter your Email.id'); 
	   }
	   else if (!reg.test(inptval)){
	     validationflg=0; 
	    common.msg(0,'Invalid Email.id'); 
	   } 
    }
    
	  
    if(validationflg == 1)
    {
  	   otpflg=2;
  	   checkuser(); 
	 
  }
}); 

function  sendotp()
{
  		  
       var URL= APIDOMAIN + "index.php/?action=sendnewuserotp&mobile="+inptval; 
      $.ajax({
	       type:'POST',
	       url:URL,
	       success:function(res){
	       
	       var data1 = JSON.parse(res);  
	       if(data1['error']['err_code']==0)
	       {
		    common.msg(0,data1['error']['err_msg']);  
	       }
	       else if(data1['error']['err_code']==1){
		   common.msg(0,data1['error']['err_msg']);
	       } 
	   }
       }); 
}  
 
$('#signup_submt').click(function(){
   
   var otpval=$('#signup_otp').val();
   if($.isNumeric(inptval)){
     if(otpval.length == 6) {
        
	  checkotp(otpval);
         
     }
     else if(otpval.length == '' || otpval.length == 0){
			  common.msg(0,'Please Enter OTP');
		      }
     else{
       common.msg(0,'you entered otp is wrong')
     }
   }
   else{
     // mail
   }
     
 });
 
 function checkuser()
 {
    if($.isNumeric(inptval))
    var URL= APIDOMAIN + "index.php/?action=getUserdetailbymob&mob="+inptval; 
     else
      var URL= APIDOMAIN + "index.php/?action=getUserdetailbymob&email="+inptval; 
   
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
			// sendmail(inptval);
		       }
		       else{
			 if($.isNumeric(inptval))  
                             common.msg(0,'Mob No not exist');
			 else		
                             common.msg(0,'email id not exist');
		       } 
		    }
      });
 }
 
 $('#respsssub').click(function(){
   
    var pass = $("#resetpass").val();
   var cpass = $("#resetcpass").val();
   var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var validationFlag=1;
   if(pass ===''|| pass === null){ 
       common.msg(0,'Please enter your Password');
        validationFlag=0; 
    }
    else if(cpass===''|| cpass=== null){ 
        common.msg(0,'Please enter the confirm password');
        validationFlag=0; 
    }
    if(pass !== cpass){
      common.msg(0,'please enter correct password');
    }
    else{
       var URL= APIDOMAIN + "index.php/?action=updateuserpass&user_id="+newuserid+"&pass="+pass+"&mobile="+inptval; 
      $.ajax({  type:'POST',  
                url:URL, 
                success:function(res){
	      // console.log(res);
	        common.msg(1,'Password Changed Successfully');  
		resetSubmit();
	   }
       }); 
    }
 });
 
  
   function checkotp(otpval)
  {
    var URL= APIDOMAIN + "index.php/?action=checkopt&mobile="+inptval+"&otpval="+otpval; 
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
   var URLreg= APIDOMAIN + "index.php/?action=addUser&name="+userdata[0]+"&email="+userdata[1]+"&mobile="+userdata[2]+"&pass="+userdata[3]; 
   $.ajax({  type:'POST', 
             url:URLreg,  
             success:function(res){
	    var data1 = JSON.parse(res); 
            if(data1['error']['err_code']==0)  {
                common.msg(0,'Registered Successfullllly');
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
	  $('#resetId').removeClass("dn");
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
     
      $('.signupTxt span').click(function () {
            signup();
        }); 
	
    $('#otpsubId').click(function(){
      var otp=$('#otp_inpt').val();
      if(otp.length == 6)
	checkotp(otp);
      else
	 common.msg(0,'Please Enter correct OTP');
    });
    
    $('#resnd_otp').click(function(){ 
      sendotp();
    });
    
    $('#forId').click(function () {
            forgot();
    });
    
    $('.closeLogin').click(function () {
           closelogpg();
    }); 
    
    function closelogpg()
   {
      $('.overlay').stop(true, true).fadeTo(200, 0);
      $('.tabWrap').removeClass("addPointer");
      $('.ftabB').removeClass("addPointer");
      $('.fade').fadeOut("slow");
      $('.outerContr').css("z-index", "203", "opacity", "0");
      $('.outerContr').velocity({translateY: ['150%', 0]}, {duration: 150, delay: 100, easing: ''});
      $('.fade').fadeIn();
 }
 
  $(document).on('click', '#userProfId', function () {
	  var uid=common.readFromStorage('jzeva_uid');
	  if(uid == null || uid == "")
            openPopUp();
  });