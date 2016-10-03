$('#reg').on('click',function(){
   var name = $("#name").val();
   var email = $("#email").val();
   var mobile = $("#mobile").val();
   var pass = $("#pass").val();
   var cpass = $("#cpass").val();
   var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var validationFlag=1;
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
    else if(email===''|| email=== null){
      // common.toast(0, 'Please enter your Email.id');
        alert('Please enter your Email.id');
        validationFlag=0;
        return false;
    }
   else if (!reg.test(email)){
      // common.toast(0, 'Invalid Email.id');
      alert('Invalid Email.id');
        validationFlag=0;
        return false;
    }
    else if(mobile===''|| mobile=== null){
      // common.toast(0, 'Please enter your Mobile no.');
        alert('Please enter your Mobile no.');
        validationFlag=0;
        return false;
    }
    else if(isNaN(mobile) || (mobile.length < 10) ){
      // common.toast(0, 'Mobile no. Invalid');
        alert('Mobile no. Invalid');
        validationFlag=0;
        return false;
    }
    else if(pass ===''|| pass === null){
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
    if (validationFlag = 1){
    var URLreg= APIDOMAIN + "index.php/?action=addUser&name="+name+"&email="+email+"&mobile="+mobile+"&pass="+pass+"&cpass="+cpass;
    var data1;
    
   $.ajax({
            type:'POST',
            url:URLreg,
            success:function(res){
           data1 = JSON.parse(res);
           
            if(data1['error']['err_code']==0)
            {
                alert('Registered successfully');
             window.location.href = DOMAIN + "index.php?action=login";
            }
            else if(data1['error']['err_code']==1){
                alert(data1['error']['err_msg']);
            }
           
        }
    });
    }
});

var logDetails = new Array();
$('#log').click(function(){
   
  var email = $("#email").val();
  var pass = $("#pass").val();
  var validationFlag=1;
  var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
 if(email===''|| email=== null){
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
    
    
    if (validationFlag = 1){
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
               
              common.addToStorage("email", logDetails['0']['email']);
              common.addToStorage("name", logDetails['0']['name']);
              common.addToStorage("uid", logDetails['0']['uid']);
              
              alert('signed in successfully');
             window.location.href = DOMAIN + "index.php?action=product_grid";
            }
            else if(data['error']['err_code']==1){
                alert(data['error']['err_msg']);
            }
           
        }
    });
    }
  
});