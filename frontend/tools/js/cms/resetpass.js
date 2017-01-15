 var key;

 $(document).ready(function(){
   GetURLParameter();
   $('#respsssub').click(function(){
     storenewpass();
   });
 });

 function GetURLParameter()
 {

	  var PageURL = window.location.pathname;

 	  var URLVariables = PageURL.split('-');
	  key=URLVariables[1];
}


 function storenewpass()
 {
   var pass = $("#pass").val();
   var cpass = $("#cpass").val();
   var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var validationFlag=1;
   if(pass ===''|| pass === null){
      //  common.toast(0, 'Please enter your Password');
        alert('Please enter your Password');
        validationFlag=0;
        return false;
    }
    else if(cpass===''|| cpass=== null){
       // common.toast(0, 'Please enter the confirm password');
        alert('Please enter the confirm password');
        validationFlag=0;
        return false;
    }
    if(pass !== cpass){
      alert('please enter correct password');
    }
    else{
      alert('correct passw');
      getuserdetail(pass);
    }

 }

 function getuserdetail(pass)
 {

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
                            alert('Password updated successfully');
			  }
			});

		   }
    });


 }
