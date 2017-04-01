
var ordid;

$(document).ready(function(){
  
});

 
  
  $('#submit').click(function(){
	  var gendrflag;
	  var gender=$('#vendorList').val();
	  if(gender == "Mr"){
	    gendrflag=2;
	  }
	  else if(gender == "Ms"){
	    gendrflag=1;
	  }
	  else if(gender == "Mrs"){
	    gendrflag=3;
	  }
	  var name=$('#name').val();
	  var telno=$('#mobile').val();
	  var email=$('#email').val();
	  var addr=$('#address').val();
	  var pincode=$('#pincode').val();
	  var city=$('#city').val();
	  var state=$('#state').val();
	  var letters = /^[a-zA-Z\s]+$/;
	 
	  var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
	  var validationFlag=1;
	  
	  if(name == null || name == "")
	  {
	    validationFlag=0;
	    common.toast(0, 'Please Enter name');
	  }
	  else if (!letters.test(name)) {
	    validationFlag = 0;
	    common.toast(0, 'Name should be in Character');
	  } 
	  else if (telno === '' || telno === null) {
	    validationFlag = 0;
	    common.toast(0, 'Please enter your Mobile no');
	  } 
	  else if (isNaN(telno) || (telno.length < 10)) {
	    validationFlag = 0;
	    common.toast(0, 'Mobile no. Invalid');
	  } 
	  else if (email === '' || email === null) {
	    validationFlag = 0;
	    common.toast(0, 'Please enter your Email id');
	  } 
	  else if (!reg.test(email)) {
	    validationFlag = 0;
	    common.toast(0, 'Invalid Email.id');
	  }
	  else if (addr === '' || addr === null) {
	    validationFlag = 0;
	    common.toast(0,'Please enter your address'); 
	  } 
	  else if (pincode === '' || pincode.length === 0) {
	    validationFlag = 0;
	     common.toast(0,'Please enter your Zip code'); 
	  } 
	  else if (pincode.length > 6 || pincode.length < 6) {
	    validationFlag = 0;
	     common.toast(0,'Please enter Correct Zip code'); 
	  }  
	  else if (city === '' || city === null) {
	    validationFlag = 0;
	     common.toast(0,'Please enter your city name'); 
	  }
	   else if (state === '' || state === null) {
	    validationFlag = 0;
	     common.toast(0,'Please enter your state name'); 
	  } 
	  
	 
	  var shipngdata={};
	  if(validationFlag == 1)
	  {
	      shipngdata['name'] = name;
	      shipngdata['email'] = email;
	      shipngdata['mobile'] = telno;
	      shipngdata['address'] = addr;
	      shipngdata['pincode'] = pincode;
	      shipngdata['state'] = state;
	      shipngdata['city'] = city;
	      shipngdata['gender'] = gendrflag;
	      
	      var URL = APIDOMAIN + "index.php?action=getUserdetailbymob&mob="+telno+"&email="+email; 
	      $.ajax({type: "GET", url: URL, success: function (res) { 
		  var data = JSON.parse(res);
		  if(data['result']['user_id'] == null || data['result']['user_id'] == undefined){
		    
		    var URLreg= APIDOMAIN + "index.php?action=addUser&name="+name+"&email="+email+"&mobile="+telno+"&pass=''&gender="+gendrflag;
		    $.ajax({  type:'POST', url:URLreg,success:function(res){
			     var data1 = JSON.parse(res);
			     if(data1['error']['err_code']==0){
			       cust_userid=data1['result']['user_id'];
			     }
			     else if(data1['error']['err_code']==1){
				 common.toast(0,data1['error']['err_msg']);
			     }
		    }
		    });	   
		  } 
		  else if(data['result']['user_id'] !== null || data['result']['user_id'] !== undefined){
		    cust_userid=data['result']['user_id'];
		  }
		  setTimeout(function(){
		      shipngdata['user_id'] = cust_userid;
		      var URL = APIDOMAIN + "index.php?action=addshippingdetail";
		      var data = shipngdata;
		      var dt = JSON.stringify(data);
		      $.ajax({type: "post", url: URL, data: {dt: dt}, success: function (res) {

			  var data = JSON.parse(res); 
			  var shipid=data['shipid'];
			  orderdata(shipid); 
			}
		      });	
		  },1000);
		}
	      }); 
	}
	});


   function orderdata(shp)
   {
       var shipid=shp;
    
    var ordrdata = {};
    
 
                                    ordrdata['pid'] = pid; 
                                    ordrdata['size'] = sz; 
                                    ordrdata['shipping_id'] = shipid;
                                    ordrdata['order_status'] = "";
				    ordrdata['updatedby'] = "";
				    ordrdata['payment'] = "";
				    ordrdata['payment_type'] = "";
                                    ordrdata['userid'] = cust_userid;
                                    ordrdata['prodpri'] = price;
                                    ordrdata['col_car_qty'] = col_car_qty;
				    ordrdata['pqty'] = 1;
                                    ordrdata['dmd_carat'] = $('#dmn_car').text();
                                     ordrdata['weight']=$('#newWt').text();
                                   ordrdata['gend']= $('#vendorList').val();
                                   
//                                   ordrdata['orderid'] = ''; 
//                                   data[0] = ordrdata;
//                                   var ordobj={};
//                                    ordobj['data'] = data; 
                                     setordrdata(ordrdata);
                           
				    
   }
   
    function setordrdata(ordrdata)
    {
	var data = ordrdata;
	var dt = JSON.stringify(data);
	var URL = APIDOMAIN + "index.php?action=addOrderbackend";
 
	$.ajax({  type: "post",  url: URL, data: {dt: dt},  success: function (res) {
	    
	     var data = JSON.parse(res);
	     if(data['error']['err_code'] == 0)
	     {
		common.toast(1, 'Order Placed successfully');
		ordid=data['ordid'];
                addtransactiondata();
	     } 
	    }
	});
                
    }
 
    function addtransactiondata()
    {
      
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1;  
      var yyyy = today.getFullYear();
      if(dd<10){
	  dd='0'+dd;
      } 
      if(mm<10){
	  mm='0'+mm;
      } 
      var today = dd+'/'+mm+'/'+yyyy;
      var dt = new Date();
      var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
      var toda=today+' '+time;
      var pymntmode="",transid;
      var inptval=$("input[name='cash']:checked").val()
       if(inptval == 1)
	 pymntmode="Cash"; 
       else if(inptval == 2){
	 pymntmode="Cheque";
	  transid=$('#check_no').val();
	 var chkdate=$('#check_date').val();
       }
       else if(inptval == 3){
	 pymntmode="NEFT";
	   transid=$('#trans_id').val();
       }
       else if(inptval == 4){
	   transid=$('#trans_id').val();
	 pymntmode="RTGS";
       }
       else if(inptval == 5){
	 pymntmode="DD";
	  transid=$('#dd_trnsid').val();
       }
	 
    
      var URL = APIDOMAIN + "index.php?action=addtransactiondata&order_id="+encodeURIComponent(ordid)+"&bank_ref_no="+transid+"&order_status=Success&payment_mode="+encodeURIComponent(pymntmode)+"&amount="+encodeURIComponent(price)+"&trans_date="+encodeURIComponent(toda)+"&Cheque_Date="+encodeURIComponent(chkdate)+"&transactionflag=1";
		$.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results)
		{
		  setTimeout(function(){
		   window.location.href=DOMAIN+"backend/index.php?action=orders";
		  },1000);
		}
	      });
      
    }
    
    
    $('#pincode').keyup(function(){
      
	    var zipcode=$('#pincode').val();
	    if(zipcode.length == 6)
	    {
		var URL = APIDOMAIN + "index.php?action=viewbyPincode&code=" + zipcode;
		$.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results)
		{
		    var obj = JSON.parse(results);

		    if(obj['error']['code'] == 0)
		    {
		      $('#state').val(obj.results[0].state);
		      $('#city').val(obj.results[0].city); 
		      $('#city').focus();
		      $('#state').focus(); 
		    } 
		    else if(obj['error']['code'] == 1){ 
		      common.msg(0, obj['error']['msg']);
		    }
		  }
	    });
	  }
	  else
	  {
	      $('#city').val('');
	      $('#state').val('');
	  } 
    });