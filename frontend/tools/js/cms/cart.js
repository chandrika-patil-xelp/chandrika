

var gblcartdata;
 function genOrdId(){
    var d = new Date();
    var ti = d.getTime();
  return ti;

}
 
function newaddToCart(paramtr)
{
   var userid,cartdata={};
   cartdata['pid']= paramtr[0];
   cartdata['price']=paramtr[1]; 
   cartdata['qty']=1; 
   var chr=""+paramtr[2]+"|@|"+paramtr[4]+"|@|"+paramtr[3];
   cartdata['col_car_qty']=chr;  
    
   var userid=localStorage.getItem('uid'); 
   var cartid=localStorage.getItem('cartid'); 
   
   if(userid=="" || userid==null){
   //   var userid=genOrdId(); 
   //   localStorage.setItem('uid',userid);
   //     cartdata['userid']=userid;
    //   cartdata['cartid']= cartid; 
      if(cartid=="" || cartid==null){
	localStorage.setItem('cartid',genOrdId());
	  cartid=localStorage.getItem('cartid'); 
      }
     cartdata['cartid']= cartid; 
    }
    else{
  //     $(gblcartdata).each(function(r,v){
//	 if(v.userid==userid){
//	   cartid=v.cart_id; 
//	   localStorage.setItem('cartid',cartid);
//	 }
  //     });
  //     if(cartid=="" || cartid==null){
//	localStorage.setItem('cartid',genOrdId());
//	  cartid=localStorage.getItem('cartid'); 
   //    }
      cartdata['userid']=userid;
      cartdata['cartid']= cartid; 
    }
    var flag=0;
    
    if(gblcartdata ==null || gblcartdata ==""){
       flag=1;
    }
    else{
      $(gblcartdata).each(function(r,v){ 
	if(cartdata.col_car_qty==v.col_car_qty && cartdata.pid==v.product_id){
	  cartdata['qty']=parseInt(v.pqty)+1;
	  cartdata['price']=parseInt(cartdata.price)*cartdata.qty; 
	  flag=2; 
	}
      });
    }
    
    if(flag==1 || flag==0){
           storecartdata(cartdata);
    }
    else{
          storecartdata(cartdata);
    } 
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
		$(".cart_gen").html(""); 
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
     var userid=localStorage.getItem('uid');   
     var cartid=localStorage.getItem('cartid');
   var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id="+cartid+"&userid="+userid+"";  
	       $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    {
		      var obj=JSON.parse(results);
                      
	       	      gblcartdata=obj.result;  
		      $(obj.result).each(function(r,v){
        var abc=v.prdimage; abc=abc.split(','); 
	abc=IMGDOMAIN+abc[5];
          
	var cartstr="<div class='cart_item'>";
	cartstr+="<div class='cart_image'><img src='"+abc+"'";
        cartstr+=" alt='Image not found'></div>";
	cartstr+="<div class='cart_name'>"+v.prdname+"</div>";
	cartstr+="<div class='cart_price  fLeft'><span class='price_gen'>"+parseInt(v.price)+"</span></div>";
        cartstr+="<div class='amt_selector' id='"+v.cart_id+"'>";
	cartstr+="<a href='#' onclick='subqnty(this)' style='color:#2d2d2d;' id='sub_"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"'><div class='cart_btn fLeft sub_no'></div></a>";  
        cartstr+="<div class='item_amt fLeft fmOsR'>"+v.pqty+"</div>";
	cartstr+=" <a href='#' onclick='addqnty(this)' style='color:#2d2d2d;' id='add_"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"'><div class='cart_btn fLeft add_no' ></div></a>";
	cartstr+="</div>";
        cartstr+="<div class='cart_remove' id='"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"' onclick=''>";
	 cartstr+="<a href='#' id='aaa"+v.col_car_qty+"' onclick='cremove(this)' style='color:#2d2d2d;text-decoration:none;' >Remove</div></a>";
//cartstr+="<div class='cart_remove' id='"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"' onclick='/'>Remove</div>";
	cartstr+="</div>";  
	$(".cart_gen").append(cartstr);
	r++;  
		    });
		    gettotal();
		  }
	      }); 
 //  $(".cart_gen").hide(); 
      
}

  function cremove(el){
     var yesno=confirm('Are u sure Do you want to remove This item');
     if(yesno== true)
     {
	var id=$(el).closest('div.cart_remove').attr('id'); 
	var a=id.split('_');
        var col_car_qty=a[2],product_id=a[0],cartid=a[3];
        var URL = APIDOMAIN+"index.php?action=removeItemFromCart&col_car_qty="+col_car_qty+"&pid="+product_id+"&cartid="+cartid; 
	$.ajax({
	      type:'POST',
	      url:URL,
	      success:function(res){
                  console.log(res);
	        displaycartdata();
		//$(".cart_gen").show();  
	      }
          });
      }
  }
  
  function addqnty(ths)
  {
    var ids=$(ths).attr('id'); ids=ids.split('_'); var pid=ids[1]; var col_car_qty=ids[3];var cart_id=ids[4]; 
    $(gblcartdata).each(function(r,v){
      if(v.product_id==pid && v.col_car_qty==col_car_qty && v.cart_id==cart_id)
      {
	var e=$(ths).siblings('.item_amt'); 
	var e2=  $(ths).closest('.cart_item').find('.price_gen '); 
	var price=parseInt(v.price,10);
	var j=v.pqty;
	price=price/j;
	j++;
	price=price*j;
	$(e2).html(price);
        $(e2).digits();
        $(e).html(j);
	var dat={};
	dat['cartid']=v.cart_id;    dat['pid']=v.product_id;
	dat['userid']=v.userid;     dat['col_car_qty']=v.col_car_qty;
	dat['qty']=j;		       dat['price']=price; 
	storecartdata(dat);
	setTimeout(function() {
       //     $(".cart_gen").show();  
	}, 90);
      }
     }); 
   }
   
  function subqnty(evnt)
  {
    var ids=$(evnt).attr('id'); ids=ids.split('_'); var pid=ids[1]; var col_car_qty=ids[3]; var cart_id=ids[4];
    $(gblcartdata).each(function(r,v){
    if(v.product_id==pid && v.col_car_qty==col_car_qty  && v.cart_id==cart_id)
    {
      var e=$(evnt).siblings('.item_amt'); 
      var e2=  $(evnt).closest('.cart_item').find('.price_gen '); 
      var price=parseInt(v.price,10);
      var j=v.pqty;
      if(j>1){
            price=price/j;
	    j--;
	    price=price*j;
	    $(e2).html(price);
            $(e2).digits();
	    $(e).html(j);
      } 
      var dat={};
      dat['cartid']=v.cart_id;    dat['pid']=v.product_id;
      dat['userid']=v.userid;     dat['col_car_qty']=v.col_car_qty;
      dat['qty']=j;		       dat['price']=price; 
      storecartdata(dat);  
      setTimeout(function() {
            $(".cart_gen").show();  
      }, 90);
    }
    }); 
 }
   
  
 function showcart()
 {   
      $(".cart_gen").show();   
 }
   
   
 function gettotal()
 {  
    var itemcnt=0,total=0; 
    $(gblcartdata).each(function(r,v){ 
  	 total=parseInt(v.price)+total;
	//console.log(v); 
      itemcnt=parseInt(v.pqty)+itemcnt; 
    });
    $(".total_price_gen").html(total);
    $(".lnHt30").html("Total Items: "+itemcnt); 
    $(".cartCount").html(itemcnt);
 }
 
 $(document).ready(function(){ 
     displaycartdata();
    var userid=localStorage.getItem('uid'); 
     var cartid=localStorage.getItem('cartid'); 
     var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id="+cartid+"&userid="+userid+"";  
	       $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    {
		      
		      var obj=JSON.parse(results);
		       gblcartdata=obj.result;
		    //    console.log(results);
		    }
	       });
 });
 
  