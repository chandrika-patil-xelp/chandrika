var logDetails = new Array();
var glbcartdeatil; 
var inptval;
var newuserid; 
var userdata=[];

$('#rsubId').on('click',function(){
 
    var name = $("#name").val();
   var email = $("#signupemail").val();
   var  mobile = $("#mobile").val();
   var pass = $("#signuppass").val(); 
   var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var validationFlag=1;
    if(name ===''|| name === null){
      validationFlag=0; 
   //  common.toast(1, 'Please Enter Name');
     alert('Please enter your Name'); 
    }  
    else if(!isNaN(name)){
       validationFlag=0; 
       //common.toast(0, 'Name should be alphanumeric');
        alert('Name should be alphanumeric'); 
    }
    else if(email===''|| email=== null){
       validationFlag=0; 
     //   common.toast(0, 'Please enter your Email.id');
        alert('Please enter your Email.id'); 
    }
   else if (!reg.test(email)){
      validationFlag=0; 
      // common.toast(0, 'Invalid Email.id');
      alert('Invalid Email.id'); 
    }
    else if(mobile===''|| mobile=== null){
       validationFlag=0; 
      // common.toast(0, 'Please enter your Mobile no.');
        alert('Please enter your Mobile no.'); 
    }
    else if(isNaN(mobile) || (mobile.length < 10) ){
       validationFlag=0; 
      // common.toast(0, 'Mobile no. Invalid');
        alert('Mobile no. Invalid'); 
    }
    else if(pass ===''|| pass === null){
       validationFlag=0; 
      //  common.toast(0, 'Please enter your Password');
        alert('Please enter your Password'); 
    }
    if (validationFlag == 1)
    {
      inptval=mobile;
    $('#otpOuter2').removeClass("dn");
    $('#signCont').velocity({opacity: [0, 1], translateY: [20, 0]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
    $('#otpCont2').velocity({opacity: [1, 0], translateY: [0, 20]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
          
	  sendotp();
	  userdata[0]=name;
	  userdata[1]=email;
	  userdata[2]=mobile;
	  userdata[3]=pass; 
	  } 
});
 
 

$('#log').click(function(){ 
  var email = $("#email").val();
  var pass = $("#pass").val();
  var validationFlag=1;
  var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
 if(email===''|| email=== null){
       // common.toast(1, 'Please Enter Name');
        alert('Please enter your Email.id');
        validationFlag=0;
        return false;
    }
   else if (!reg.test(email)){
      alert('Invalid Email.id');
        validationFlag=0;
        return false;
    }
  else if(pass===''|| pass=== null){
        alert('Please enter Password');
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
	      logDetails = data['result'];
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
		    alert('signed in successfully'); 
		            window.location.href = DOMAIN + "index.php?action=product_grid";
		    }
		});  
            }
            else if(data['error']['err_code']==1){
                alert(data['error']['err_msg']);
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
			     //   console.log(data);  
			}
		  });

	var URL = APIDOMAIN+"index.php?action=removeItemFromCart&col_car_qty="+col_car_qty+"&pid="+prdid+"&cartid="+n.cart_id;
		    $.ajax({
			    type:'POST',
			    url:URL,
			    success:function(res){
			     //console.log(res);
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
      // common.toast(0, 'Please enter your Mobile no.');
        alert('Please enter your Mobile no.');
        validationflg=0; 
      }
      else if(isNaN(inptval) || (inptval.length < 10) || (inptval.length > 11) ){
	// common.toast(0, 'Mobile no. Invalid');
	  alert('Invalid Mobile no.');
	  validationflg=0; 
      } 
    }
    else{
      
       var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
	   if(inptval===''|| inptval=== null){
	     validationflg=0; 
	       // common.toast(1, 'Please Enter Name');
	       alert('Please enter your Email.id'); 
	   }
	   else if (!reg.test(inptval)){
	     validationflg=0; 
	     alert('Invalid Email.id'); 
	   } 
    }
    
	  
    if(validationflg == 1)
    {
  	   checkuser(inptval); 
	 
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
		    alert(data1['error']['err_msg']);  
	       }
	       else if(data1['error']['err_code']==1){
		   alert(data1['error']['err_msg']);
	       } 
	   }
       }); 
}  
 
 $('#otpsubId').click(function(){
   var otpval=$('#otp_inpt').val();
   if($.isNumeric(inptval)){
      var URL= APIDOMAIN + "index.php/?action=checkopt&mobile="+inptval+"&otpval="+otpval; 
      $.ajax({  url: URL, type: "GET",  datatype: "JSON", success: function(results) {
		      var obj=JSON.parse(results); 
		      var data=obj.result;
		      if(data.otp==null){
			alert('time is over plz try it again');
		      }
		      else{
		      if(otpval==data.otp){
			alert('otp is correct'); 
			  $('#resetId').removeClass("dn");
  $('#otpCont').velocity({opacity: [0, 1], translateY: [20, 0]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
  $('#inresetId').velocity({opacity: [1, 0], translateY: [0, 20]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
     
		      }
		      else{
			alert('you entered otp is wrong');
		      }
		    }
		    }
	     });
   }
   else{
     // mail
   }
     
 });
 
 function checkuser()
 {
    var URL= APIDOMAIN + "index.php/?action=getUserdetailbymob&mob="+inptval; 
      $.ajax({  url: URL,  type: "GET", datatype: "JSON", success: function(res)  {
		       var data=JSON.parse(res); 
		       if(data['result']['mob'] == inptval){
		      
		       newuserid=data['result']['user_id'];
		        sendotp();
 $('#otpOuter').removeClass("dn");
 $('#loginId1').velocity({opacity: [0, 1], translateY: [20, 0]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
 $('#otpCont').velocity({opacity: [1, 0], translateY: [0, 20]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
 	
		       }
		       else if(data['result']['email'] == inptval){ 
			 newuserid=data['result']['user_id'];
			// sendmail(inptval);
		       }
		       else{
			 if($.isNumeric(inptval))   alert('Mob No not exist');
			 else		alert('email id not exist');
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
      //  common.toast(0, 'Please enter your Password');
        alert('Please enter your Password');
        validationFlag=0; 
    }
    else if(cpass===''|| cpass=== null){
       // common.toast(0, 'Please enter the confirm password');
        alert('Please enter the confirm password');
        validationFlag=0; 
    }
    if(pass !== cpass){
      alert('please enter correct password');
    }
    else{
       var URL= APIDOMAIN + "index.php/?action=updateuserpass&user_id="+newuserid+"&pass="+pass+"&mobile="+inptval; 
      $.ajax({  type:'POST',   url:URL,  success:function(res){
	      // console.log(res);
	       alert('Password Changed Successfully'); 
	   }
       }); 
    }
 });
 
 $('#signup_submt').click(function(){
   
   var otpval=$('#signup_otp').val();
   var URL= APIDOMAIN + "index.php/?action=checkopt&mobile="+inptval+"&otpval="+otpval; 
      $.ajax({  url: URL, type: "GET",  datatype: "JSON", success: function(results) {
		      var obj=JSON.parse(results); 
		      var data=obj.result;
		      if(data.otp==null){
			alert('time is over plz try it again');
		      }
		      else{
		      if(otpval==data.otp){
			 
   var URLreg= APIDOMAIN + "index.php/?action=addUser&name="+userdata[0]+"&email="+userdata[1]+"&mobile="+userdata[2]+"&pass="+userdata[3]; 
   $.ajax({  type:'POST',  url:URLreg,  success:function(res){
	    var data1 = JSON.parse(res); 
            if(data1['error']['err_code']==0)  
                alert('Registered Successfully');   
            else if(data1['error']['err_code']==1)
                alert(data1['error']['err_msg']); 
    }
    });
		      }
		      else{
			alert('you entered otp is wrong');
		      }
		    }
    }
    }); 
 });
   