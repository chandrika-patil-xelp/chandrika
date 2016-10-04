var total=0;
var prddata = {}; 
var cartdata={}; 
var cardcnt=0;
var cartarr=new Array();
function newaddToCart(paramtr)
{
 // console.log(paramtr[0]);
   cartdata['pid']= paramtr[0];
   cartdata['price']=paramtr[1];
   cartdata['color']=paramtr[2];
   cartdata['clarity']=paramtr[3];
   cartdata['carat']=paramtr[4];
   cartdata['qty']=1;
//   cartdata['orderId']=77777;
    cartdata['userid']=4444;
   var URL = APIDOMAIN+"index.php/?action=getProductById&pid="+paramtr[0]; 
   $.ajax({
            type:'POST',
            url:URL,
            success:function(res){
              
             data = JSON.parse(res); 
	     var dt = data['results'];
             var basic = dt['basicDetails']; 
	     var images = dt['images'];
	     
	     cartdata['image']=images['images'][1];
	     cartdata['prdname']=basic.prdNm; 
	     cartarr.push(cartdata);
	     storecartdata();
	     // console.log(cartdata['prdname']); 
		}
  }); 
  
}


function storecartdata()
{
  var data={};
    var URL= APIDOMAIN + "index.php?action=addTocart";
      data['prod']=cartarr;
    var  dt = JSON.stringify(data);
           // console.log(dt);
	$.ajax({
	    type:"post",
	    url:URL,
	    data: {dt: dt},
	    success:function(data){
		//  console.log(data);
		//alert('data inserted successfully');
		 displaycartdata(); 
            }
        });	
	 
	 
}
	    
          /* var prodCode = $("#prodcode").html();  //this is the product code
           var prodCost = $("#prodCost").html();  //this is the product cost 
           var prodQty = $(".prdQty").text();     //this is the product quantity
           var pidUrl = window.location.href;     // url 
           var prodId = pidUrl.substring(pidUrl.lastIndexOf('=') + 1); //this will give u the product id
           var prodMtl = $("#selMtl").text().split(",");  // select metal
           var prodStn = $("#pstn1").text();   // select stone
           var prodSize = $("#size1").text();   // select size
           
           var prodImg = $(".jwl1").css('background-image');  // product image
           
           var ordId = localStorage.getItem("ordId");  //ordId from localstroage
         
            if(ordId === "undefined" || ordId === null){
                genOrdId();
            }
          
            ordId = localStorage.getItem("ordId");
          
          // update Qty if product is already present
            for(i in cart){
               if(cart[i].name == prodName){  //checking if the product name exists
                   cart[i].qty = prodQty;     // if product name exists update quantity of the product
                   cart[i].metal = prodMtl;   // select metal
                   cart[i].stone = prodStn;   // select stone
                   cart[i].size = prodSize;   // select size 
                   
                   saveCart();                // save the cart details to the localstroage
                   sendCartDetails();         // send data to api using ajax request
                   return;
               }
            }
            
            items = {name: prodName, cost: prodCost, code: prodCode, qty: prodQty, pid: prodId, carat: prodMtl[0], metal: prodMtl[1], stone: prodStn, size: prodSize, image: prodImg, orderId: ordId};
            cart.push(items);
            showCart(); //show cart
            saveCart(); //save to localstroage
            sendCartDetails();
            */
  
function displaycartdata()
{ 
    $(".cart_gen").html("");
   var URL = APIDOMAIN + "index.php?action=getcartdetailbyid";
  
   $.ajax({
        url: URL,
        type: "GET",
	datatype: "JSON",
	success: function(results) 
	{
	 var obj=JSON.parse(results);  
	 $(obj.result).each(function(r,v){ //console.log(v);
	var cartstr="<div class='cart_item'>";
	cartstr+="<div class='cart_image'><img src="+v.image+" alt='Image not found'></div>";
	cartstr+="<div class='cart_name'>"+v.prdname+"</div>";
	cartstr+="<div class='cart_price  fLeft'><span class='price_gen'>"+parseInt(v.price)+"</span></div>";
        cartstr+="<div class='amt_selector' id='"+v.order_id+"'>";
	cartstr+="<div class='cart_btn fLeft sub_no'></div>";
        cartstr+="<div class='item_amt fLeft fmOsR'>"+v.pqty+"</div>";
	cartstr+="<div class='cart_btn fLeft add_no'></div>";
	cartstr+="</div>";
	cartstr+="<div class='cart_remove' onclick='removeproduct("+v.order_id+","+v.product_id+")'>Remove</div>";
	cartstr+="</div>"; 
	$(".cart_gen").append(cartstr);
		  
	 }); 
	 
       }
     });
       $(".cart_gen").hide();  
     
}
  
   
 function showcart()
 {  
     $(".cart_gen").show();  
    
   
    
    /*
    $('.sub_no').click(function(){    
        var e=$(this).siblings('.item_amt');
        var j =$(this).siblings('.item_amt').text();
        var e2=  $(this).closest('.cart_item').find('.price_gen');
        var price= $(this).closest('.cart_item').find('.price_gen ').text();
        price=price.replace(/\,/g,'');
        price=parseInt(price,10); 
        if(j>1){
            price=price/j;
          j--;
          price=price*j;
          $(e2).html(price);
            $(e2).digits();
          $(e).html(j);
        }
	var prd_id=$(this).parent().attr('id'); 
	   
	 
	 
	// gettotal();   
      });
       
      */
 
  
   // $('.add_no').click(function(){alert('add');  
 $(document).on('click','.add_no',function(){
        var e=$(this).siblings('.item_amt'); 
        var j =$(this).siblings('.item_amt').text();  
        var e2=  $(this).closest('.cart_item').find('.price_gen '); 
        var price= $(this).closest('.cart_item').find('.price_gen ').text();
        price=price.replace(/\,/g,'');
        price=parseInt(price,10);
        price=price/j; 
          j++;
          price=price*j;
          $(e2).html(price);
          $(e2).digits();
          $(e).html(j);  
	
   
         var order_id=$(this).parent().attr('id'); 
	 var data={};
	 
	 var URL = APIDOMAIN+"index.php?action=updatecartincrz&oid="+order_id+"&price="+price;  
	var  dt = JSON.stringify(data);
            
	$.ajax({
	    type:"post",
	    url:URL,
	    data: {dt: dt},
	    success:function(data){
		//    console.log(data); 
		  displaycartdata(); 
		  $(".cart_gen").show();
        
            }
        });	
	 
	//gettotal();
      }); 
       
  
 }
  
 
  
 function removeproduct(order_id,product_id)
 {
   var yesno=confirm('Are u sure Do you want to remove This item');
      if(yesno== true)
      {
	  var URL = APIDOMAIN+"index.php?action=removeItemFromCart&oid="+order_id+"&pid="+product_id; 
	  $.ajax({
	      type:'POST',
	      url:URL,
	      success:function(res){
		   console.log(res);
		 
	        displaycartdata();
		$(".cart_gen").show();  
	      }
	  });
	 
      }
 }
     
 function gettotal()
 { 
    $(".total_price_gen").html(total);
    $(".lnHt30").html("Total Items: "+itemcnt);
 }
 
 $(document).ready(function(){
         displaycartdata();
       
 });

 