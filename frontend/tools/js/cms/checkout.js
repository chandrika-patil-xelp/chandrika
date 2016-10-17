
var gblcheckodata;
var subtotalprice=0;
var totalprice=0; 
var shipngdata={}; 
var validationFlag=1;
$(document).ready(function(){
 
   $('#paymentbtn').click(function(){   
      storeshippingdata();
      storeorderdata(); 
   });
   
  $('input.filled-in').on('change', function() {
    $('input.filled-in').not(this).prop('checked', false);  
     shipngdata['delivery_option']=$(this).val();  
  });
  
  $('#nxt').click(function(){
    getshippingdata();
  }); 
  displaycartdetail();
});

function displaycartdetail()
{
  var userid=common.readFromStorage('jzeva_uid'); 
  var cartid=common.readFromStorage('jzeva_cartid'); 
  subtotalprice=0;
  $('.prdFinalCont').html("");
  var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id="+cartid+"&userid="+userid+"";  
	       $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    {
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
			subtotalprice+=parseInt(v.price);
			  
var chckoutstr="<div class='ckPrCont fLeft'>";
  chckoutstr+=" <div class='ckPrImg fLeft'><img src='"+abc+"'";
  chckoutstr+=" alt='Image not found'></div>";
  chckoutstr+="  <div class='incCont fLeft'>";
  chckoutstr+="  <div class='cCont fLeft '>";
  chckoutstr+="<a href='#' onclick='subqnty(this)' style='color:#2d2d2d;' id='sub_"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"'>";
  chckoutstr+=" <div class='cart_btn fLeft sub_no' id='drcmnt'></div></a>";
  chckoutstr+=" <div class='item_amt fLeft fmSansR'>"+v.pqty+"</div>";
  chckoutstr+="<a href='#' onclick='addqnty(this)' style='color:#2d2d2d;' id='add_"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"'>";
  chckoutstr+=" <div class='cart_btn fLeft add_no' id='incrmnt'></div></a>";
  chckoutstr+="</div>  </div>";
  chckoutstr+=" <div class='namCont fLeft fmSansR'>";
  chckoutstr+=" <div class='ckPrNam fmSansR'>"+v.prdname+"</div>";
  chckoutstr+=" <div class='col100 colorLg font11 fmSansR'>"+v.color+" "+v.jewelleryType+" "+v.carat+", Diamond "+v.dmdcarat+" Carat</div>";
  chckoutstr+=" <div class='rsContr fLeft'>";
  chckoutstr+="  <div class='col50 fLeft'>";
  chckoutstr+=" <div class='prTxt1 fmSansR fLeft '>₹ "+parseInt(v.price)+"</div>";
  chckoutstr+="  </div> </div> </div>";
  chckoutstr+=" <div class='clBtn transition200 fmSansB noselect' id='"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"'><a href='#'  onclick='remove(this)' style='color:#2d2d2d;text-decoration:none;' >REMOVE</div></a>";
  chckoutstr+=" </div>";
   $('.prdFinalCont').append(chckoutstr);
		      });
		      totalprice=subtotalprice+0;
		      $('#shpntotalprdprc').html("&#8377 "+subtotalprice);
		      $('#shpntotalprc').html("&#8377 "+subtotalprice);
		      $('.total').html(totalprice);
		    }
		  }); 
}
 

  function remove(el){
     var yesno=confirm('Are u sure Do you want to remove This item');
     if(yesno== true)
     {
	var id=$(el).closest('div.noselect').attr('id'); 
	var a=id.split('_');
        var col_car_qty=a[2],product_id=a[0],cartid=a[3];
        var URL = APIDOMAIN+"index.php?action=removeItemFromCart&col_car_qty="+col_car_qty+"&pid="+product_id+"&cartid="+cartid; 
	$.ajax({
	      type:'POST',
	      url:URL,
	      success:function(res){
	          displaycartdetail();
		//$(".cart_gen").show();  
	      }
          });
      }
  }
  
   function addqnty(ths)
  {
	var e=$(ths).siblings('.item_amt'); 
	var j=$(ths).siblings('.item_amt').text();
	var e2=  $(ths).closest('.ckPrCont').find('.prTxt1 '); 
	var price=$(ths).closest('.ckPrCont').find('.prTxt1 ').text(); 
	price=price.replace(/\,/g,'');
	price=price.replace('₹',''); 
        price=parseInt(price,10);
        price=price/j;
        j++;
        price=price*j; 
	$(e2).html(price);
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
	  storecartdata(dat); 
      }
     }); 
   }
   
   function subqnty(evnt)
  {
    var e=$(evnt).siblings('.item_amt'); 
    var j=$(evnt).siblings('.item_amt').text();
    var e2=  $(evnt).closest('.ckPrCont').find('.prTxt1 '); 
    var price=$(evnt).closest('.ckPrCont').find('.prTxt1 ').text(); 
    price=price.replace(/\,/g,'');
    price=price.replace('₹','');  
    var price=parseInt(price,10); 
      if(j>1){
            price=price/j;
	    j--;
	    price=price*j;
	    $(e2).html(price);
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
	 storecartdata(dat); 
      }
     }); 
  }
  
  function storecartdata(cartdata)
{ 
    var URL= APIDOMAIN + "index.php?action=addTocart";
    var data=cartdata; 
    var  dt = JSON.stringify(data); 
	$.ajax({
	    type:"post",
	    url:URL,
	    data: {dt: dt},
	    success:function(data){
		 //   console.log(data);  
		//    displaycartdetail(); 
            }
        });	 
}

function getshippingdata()
{
    var name=$('#shpdname').val();
   var mobile=$('#shpdmobile').val();
   var mail=$('#shpdemail').val();
   var city=$('#shpdcity').val();
   var addrs=$('#shpdaddrs').val();
   var state=$('#shpdstate').val();
   var pincode=$('#shpdpincode').val(); 
   var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
     
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
    else if(mail===''|| mail=== null){
     //   common.toast(0, 'Please enter your Email.id');
        alert('Please enter your Email.id');
        validationFlag=0;
        return false;
    }
   else if (!reg.test(mail)){
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
    else if(isNaN(mobile) || (mobile.length < 10) || (mobile.length > 11) ){
      // common.toast(0, 'Mobile no. Invalid');
        alert('Mobile no. Invalid');
        validationFlag=0;
        return false;
    }
    else if(pincode ===''|| pincode === null){
      //  common.toast(0, 'Please enter your Password');
        alert('Please enter your pincode');
        validationFlag=0;
        return false;
    }
    else if(city===''|| city=== null){
       // common.toast(0, 'Please enter the confirm password');
        alert('Please enter the city name');
        validationFlag=0;
        return false;
    }
    
   $('#spdnamedispl').html(name);
   $('#spdaddrdspl').html(addrs);
   $('#spdaddrdspl').append(", "+city);
   $('#spdaddrdspl').append(", "+state);
   $('#spdaddrdspl').append(" "+pincode+" India");
   shipngdata['name']=name;	    shipngdata['mobile']=mobile;
   shipngdata['email']=mail;	    shipngdata['city']=city;
   shipngdata['address']=addrs;	    shipngdata['state']=state;
   shipngdata['pincode']=pincode; 
   var usrid=localStorage.getItem('uid');
   if(usrid == null || usrid == ""){
     shipngdata['user_id']=1111;
   }
   else{
     shipngdata['user_id']=usrid;
   } 
}

function storeshippingdata()
{
 //  console.log(shipngdata);
  if (validationFlag == 1){ 
   var URL= APIDOMAIN + "index.php?action=addshippingdetail";
    var data=shipngdata;
    var  dt = JSON.stringify(data); 
	$.ajax({
	    type:"post",
	    url:URL,
	    data: {dt: dt}, 
	    success:function(data){  
		//      console.log(data);     
            }
        });
 }
}

function  storeorderdata()
{
  
  var data=[],ordobj={};
  $(gblcheckodata).each(function(r,v){
    var ordrdata={};
    ordrdata['orderid']=v.cart_id;	 ordrdata['pid']=v.product_id;
    ordrdata['userid']=v.userid;	 ordrdata['col_car_qty']=v.col_car_qty;
    ordrdata['pqty']=v.pqty;		 ordrdata['prodpri']=v.price;  
    ordrdata['order_status']="" ;	 ordrdata['updatedby']="" ;
    ordrdata['payment']="";		 ordrdata['payment_type']="";
    ordrdata['diloptn']=shipngdata.delivery_option;
    data[r]=ordrdata; r++;
  });
 
  ordobj['data']=data;
   var URL= APIDOMAIN + "index.php?action=addOrdersdetail"; 
  var  dt = JSON.stringify(ordobj); 
	$.ajax({
	    type:"post",
	    url:URL,
	    data: {dt: dt},
	    success:function(data){ 
		//console.log(data);  
		  var cartid=localStorage.getItem('cartid');
		  var URL = APIDOMAIN + "index.php?action=removCrtItemaftrcheckot&cartid="+cartid;  
		  $.ajax({  url: URL,   type: "GET",  datatype: "JSON",  success: function(results)  {
				//  console.log(results);
				}
		  }); 
		alert('Your Order Placed successfully'); 
            }
        });
}
