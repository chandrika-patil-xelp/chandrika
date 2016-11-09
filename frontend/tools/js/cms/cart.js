

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
   cartdata['price']= paramtr[1];
   cartdata['qty']=1;
   var chr=""+paramtr[2]+"|@|"+paramtr[4]+"|@|"+paramtr[3];
   cartdata['col_car_qty']=chr;
 
   var userid=common.readFromStorage('jzeva_uid');  
   var cartid=common.readFromStorage('jzeva_cartid');   

   if(userid=="" || userid==null){
       common.addToStorage('jzeva_uid','0');
	userid=common.readFromStorage('jzeva_uid');  
      if(cartid=="" || cartid==null){
	common.addToStorage('jzeva_cartid',genOrdId());
	cartid=common.readFromStorage('jzeva_cartid');  
      }
     cartdata['cartid']= cartid;
     
    }
    else{ 
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
          cartdata.price=(cartdata.price).replace(/,/g,"");
          cartdata['price']=parseInt(cartdata.price)*cartdata.qty;
         
	  flag=2;
	}
      });
    }

    if(flag==1 || flag==0){
           storecartdata(cartdata,1);
    }
    else{
          storecartdata(cartdata,1);
    }
}

 
function storecartdata(cartdata,chk)
{ 
    
    if(cartdata['qty']==1 && chk==1)
   {
   cartdata['price']=cartdata['price'].replace(/,/g,"");
   }
     var URL= APIDOMAIN + "index.php?action=addTocart";
    
    var data=cartdata; 
    var  dt = JSON.stringify(data);    
	$.ajax({
	    type:"post",
	    url:URL,
	    data: {dt: dt}, 
          
	    success:function(results){
		
		getglobaldata(); 
		if(chk==1){
		  $(".cart_gen").html("");
		  displaycartdata();
		} 
            }
        });
}
  
function displaycartdata()
{
     $(".cart_gen").html("");
     var userid=common.readFromStorage('jzeva_uid'); 
     var cartid=common.readFromStorage('jzeva_cartid');
     if(cartid !== null || userid !== null){
   var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id="+cartid+"&userid="+userid+"";
   
	       $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    {  
		      var obj=JSON.parse(results); 
		      if(obj.result !== null)
		      {
	       	      gblcartdata=obj.result;
		      $(obj.result).each(function(r,v){
                    
			if(v.default_img!== null){
			   abc=IMGDOMAIN + v.default_img;
			}
			else{
			   var abc=v.prdimage; abc=abc.split(',');
			    abc=IMGDOMAIN+abc[5];
			}
			 
	var cartstr="<div class='cart_item'>";
	cartstr+="<div class='cart_image'><img src='"+abc+"'";
        cartstr+=" alt='Image not found'></div>";
	cartstr+="<div class='cart_name'>"+v.prdname+"</div>";
  	cartstr+="<div class='cart_desc  fLeft'>"+v.jewelleryType+" "+ v.metal_weight+" gms , "+v.carat+" </div>";
	cartstr+="<div class='cart_price  fLeft'><span class='price_gen'>₹ "+indianMoney(parseInt(v.price))+"</span></div>";
        cartstr+="<div class='amt_selector' id='"+v.cart_id+"'>";
	cartstr+="<a href='#' onclick='subqnty(this)'  id='sub_"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"'><div class='cart_btn fLeft sub_no'></div></a>";
        cartstr+="<div class='item_amt fLeft '>"+v.pqty+"</div>";
	cartstr+=" <a href='#' onclick='addqnty(this)'  id='add_"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"'><div class='cart_btn fLeft add_no' ></div></a>";
	cartstr+="</div>"; 
        cartstr+="<div class='cart_remove' id='"+v.product_id+"_"+r+"_"+v.col_car_qty+"_"+v.cart_id+"'onclick='cremove(this)'>";
	 cartstr+="</div>";  
	cartstr+="</div>";    
          
	$(".cart_gen").append(cartstr);
	r++;
		    });
		    gettotal();
		  }
		  }
	      });   
	    }
}

 function indianMoney(x){
          x=x.toString();
          var afterPoint = '';
          if(x.indexOf('.') > 0)
             afterPoint = x.substring(x.indexOf('.'),x.length);
          x = Math.floor(x);
          //alert(x);
          x=x.toString();
          var lastThree = x.substring(x.length-3);
          var otherNumbers = x.substring(0,x.length-3);
          if(otherNumbers != '')
              lastThree = ',' + lastThree;
          var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
          //res = res.parseInt();
          //res = res.toFixed(2);
          return res;
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
               gettotal();
	        displaycartdata(); 
                
	      }
          });
      }
  }

  function addqnty(ths)
  {
      
	var e=$(ths).siblings('.item_amt');
        var j =$(ths).siblings('.item_amt').text(); 
        var e2=  $(ths).closest('.cart_item').find('.price_gen ')
        var price= $(ths).closest('.cart_item').find('.price_gen ').text(); 
        price=price.replace(/\,/g,'');
	price=price.replace('₹','');
        price=parseInt(price,10);
        price=price/j;
          j++;
          price=price*j; 
          $(e2).html('₹ '+price);
          $(e2).digits();
          $(e).html(j); 
    var ids=$(ths).attr('id'); ids=ids.split('_'); var pid=ids[1]; var col_car_qty=ids[3];var cart_id=ids[4];  
    $(gblcartdata).each(function(r,v){
      if(v.product_id==pid && v.col_car_qty==col_car_qty && v.cart_id==cart_id)
      { 
	var dat={};
	dat['cartid']=v.cart_id;    dat['pid']=v.product_id;
	dat['userid']=v.userid;     dat['col_car_qty']=v.col_car_qty;
	dat['qty']=j;		       dat['price']=price;
	storecartdata(dat,2); 
       // gettotal();
      }
     });
      
   }

  function subqnty(evnt)
  {
     var e=$(evnt).siblings('.item_amt');
        var j =$(evnt).siblings('.item_amt').text();
        var e2=  $(evnt).closest('.cart_item').find('.price_gen');
        var price= $(evnt).closest('.cart_item').find('.price_gen ').text();
        price=price.replace(/\,/g,'');
	price=price.replace('₹','');
        price=parseInt(price,10);
         if(j>1){
            price=price/j;
          j--;
          price=price*j;
          $(e2).html('₹ '+price);
            $(e2).digits();
          $(e).html(j);
        }
    var ids=$(evnt).attr('id'); ids=ids.split('_'); var pid=ids[1]; var col_car_qty=ids[3]; var cart_id=ids[4];
    $(gblcartdata).each(function(r,v){
    if(v.product_id==pid && v.col_car_qty==col_car_qty  && v.cart_id==cart_id)
    { 
      var dat={};
      dat['cartid']=v.cart_id;    dat['pid']=v.product_id;
      dat['userid']=v.userid;     dat['col_car_qty']=v.col_car_qty;
      dat['qty']=j;		       dat['price']=price;
      storecartdata(dat,2); 
     // gettotal();
    }
    });
 }
 
 function gettotal()
 {
     getglobaldata();
    var itemcnt=0,total=0;
    $(gblcartdata).each(function(r,v){
        
	  total=parseInt(v.price)+total;  
	  itemcnt=parseInt(v.pqty)+itemcnt;  
    });
     $(".total_price_gen").html(indianMoney(total));
    $(".lnHt30").html("Total Items: "+itemcnt);
    $(".cartCount").html(itemcnt);
 }

function getglobaldata()
{
  var userid=common.readFromStorage('jzeva_uid'); 
  var cartid=common.readFromStorage('jzeva_cartid'); 
  if(cartid !== null || userid !== null){
  var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id="+cartid+"&userid="+userid+"";   
	       $.ajax({
	 	    url: URL,
	 	    type: "GET",
	 	    datatype: "JSON",
	 	    success: function(results)
	 	    {
		   
		      var obj=JSON.parse(results);
		      gblcartdata=obj.result;
		      gettotal();
		    
		    }
	       }); 
  }
}

 $(document).ready(function(){
    
      displaycartdata(); 
      getglobaldata();
 });
