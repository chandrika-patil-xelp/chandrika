 $(document).ready(function(){
  
 });

   var mobileno=GetURLParameter('mobile');
 
	  
	  
function GetURLParameter(Param)
       {
        
	  var PageURL = window.location.search; 
	  var URLVariables = PageURL.split('&');
	 for (var i = 0; i < URLVariables.length; i++)
	 {
	  var ParameterName = URLVariables[i].split('=');
	 if (ParameterName[0] == Param){
	 return ParameterName[1];
	    } 
	 }
	 }
	  
 $('.button2').click(function(){ 
	 // var mobileno=9766802316;
	  var otpval=$('.inp_box').val(); 
	    var URL= APIDOMAIN + "index.php/?action=checkopt&mobile="+mobileno+"&otpval="+otpval; 
	     $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    {
		      var obj=JSON.parse(results); 
		      var data=obj.result;
		      if(data.otp==null){
			alert('time is over plz try it again');
		      }
		      else{
		      if(otpval==data.otp){
			alert('otp is correct'); 
			sendmail(data.email);  
		      }
		      else{
			alert('you entered otp is wrong');
		      }
		    }
		    }
	     });
	});
	
function sendmail(email)
{
  
   var URL = APIDOMAIN+"index.php?action=newforgotPass&email="+email;
		    $.ajax({
			    type:'POST',
			    url:URL,
			    success:function(res){
			      console.log(res);
			    }
		    });  
}