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
     //   common.toast(0, 'Please enter your Email.id');
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
var glbcartdeatil;
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
	      var oldcartid=common.readFromStorage('cartid'); 
	      var olduserid=common.readFromStorage('uid');
	      var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id="+oldcartid+"&userid="+olduserid+"";   
	       $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    {
		      var obj=JSON.parse(results); 
		      glbcartdeatil=obj.result;
//		      $(obj.result).each(function(r,v){ 
 //		      });  
		      if(oldcartid=="" || oldcartid==null){
			  if(glbcartdeatil!= null){
			       var cartid=glbcartdeatil[0].cart_id;  
			  }
			      if(cartid){
				  common.addToStorage("cartid", cartid);}
			      else{
				  common.addToStorage("cartid", gencartId()); }
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
//       nthr=v.col_car_qty;
//       nprid=v.product_id;
      // common.addToStorage("cartid", newcartid);
     }
     else{
       hasoldcartid[ocnt]=v;ocnt++;
//       othr=v.col_car_qty;
//       oprid=v.product_id;
     }
//     if(nthr==othr && nprid==oprid){
//        var cont=ccnt-1;
//       var j=hasusrid[cont].pqty;
//       var price=hasusrid[cont].price;
//       incrzqnty(j,price); 
//     }
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