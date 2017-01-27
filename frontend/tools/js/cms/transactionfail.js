 
 var shipid,gblcheckodata,totalprice;
 
  $(document).ready(function(){
   
 
      shipid=common.readFromStorage('jzeva_shpid');
      displayprddetail();
       getname();  
     
     if(status.trim()== "Failure")
     {
       var str="TRANSACTION Failure";
       str+='<div class="cbrdr"></div>';
       $('#trn_msg').html(str);
      
     }
     if(status.trim()== "Aborted")
     { 
       var str="TRANSACTION ABORTED";
       str+='<div class="cbrdr"></div>';
       $('#trn_msg').html(str);
        $('#msg_detail').html('We will keep you posted regarding the status of your order through e-mail.');
     }
     
 });
 
 $('#tryagn').click(function(){
 
    window.location.href=DOMAIN+"transaction/payment.php?ordid="+ordid+"&shipid="+shipid;
 });
 
 function displayprddetail()
{
  
  var cartid =ordid;
  $('#scroll').html("");
  totalprice = 0;
  $('#totprz_trnst').html(""); 
  $('#totprz_trnst').removeClass('cartRupee');
    var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id=" + cartid + "&userid=";  
      
    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
      var obj = JSON.parse(results);
      gblcheckodata = obj.result;  
      if(gblcheckodata == null){
	setTimeout(function(){
	    $('#submt').addClass('dn');
	    $('#urords').addClass('dn');
	    $("#noprdtrnfail").removeClass("dn");
	    $('#totitm_trnstn').addClass('dn');
	    $('#totprz_trnst').html(""); 
	    $('#totprz_trnst').removeClass('cartRupee');
	},1000);
      }
      else{ 
	setTimeout(function(){
	    $('#submt').removeClass('dn'); 
	    $("#noprdtrnfail").addClass("dn");  
	    $('#urords').removeClass('dn');
	    $('#totitm_trnstn').removeClass('dn'); 
	},1000);
      $(obj.result).each(function (r, v) {
	if (v.default_img !== null) {
	  abc = IMGDOMAIN + v.default_img;
	} else {
	   if(v.prdimage !== null){
	    var abc = v.prdimage;
	    abc = abc.split(',');
	    abc = IMGDOMAIN + abc[0];
	  }
	  else
	    abc=BACKDOMAIN +'tools/img/noimage.svg'
	}
	totalprice += parseInt(v.price);
	var bprize = parseInt(v.price / v.pqty);
	var wht;
	if (v.ccatname !== null) {
	  wht = getweight(v.size, v.ccatname, v.metal_weight);
	} else {
	  wht = parseFloat(v.metal_weight).toFixed(3);
	}
 
	var chckoutstr = "<div class='cart_item'>";
	chckoutstr += "<div class='cart_image'><img src='" + abc + "' onerror='this.style.display=\"none\"'>";
	chckoutstr += " </div>";
	chckoutstr += "<div class='cart_name'>" + (v.prdname).toUpperCase() + "</div>";
         if(v.dmdcarat === null )
                          
        chckoutstr += "<div class='cart_desc  fLeft' id='nwwt'>" + v.jewelleryType + " : " + wht + " gms &nbsp|&nbsp Solitaire : " + v.Solicarat + " Ct &nbsp|&nbsp Quality : " + v.Soliclarity + " ";
        else
        chckoutstr += "<div class='cart_desc  fLeft' id='nwwt'>" + v.jewelleryType + " : " + wht + " gms &nbsp|&nbsp Diamond : " + v.dmdcarat + " Ct &nbsp|&nbsp Quality : " + v.quality + " ";    
	chckoutstr += "<div class='cart_desc  fLeft' >";
	chckoutstr += "Purity : " + v.carat + " &nbsp|&nbsp ";
	if (v.ccatname !== null)
	chckoutstr += "Size : " + v.size + " &nbsp|&nbsp ";
	chckoutstr += "Color : " + v.color + "";
	chckoutstr += "</div>";
	chckoutstr += "<div class='cart_price cartRup15 fLeft'><span class='price_gen'> " + indianMoney(bprize) + "</span></div>";
	chckoutstr += "<div class='amt_selector' id='" + v.cart_id + "'>";
	chckoutstr += "<a href='#' onclick='decrqnty(this)'  id='sub_" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "'><div class='cart_btn fLeft sub_noW'></div></a>";
	chckoutstr += "<div class='item_amt fLeft '>" + v.pqty + "</div>";
	chckoutstr += " <a href='#' id='add_" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "' onclick='incrqnty(this)'><div class='cart_btn fLeft add_noW' ></div></a>";
	chckoutstr += "</div>";
	chckoutstr += "<div class='cart_removew addrCommon' id='" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "_" + v.size + "' onclick='removeprd(this)' >";
	chckoutstr += "</div>";
	chckoutstr += "</div>";
	$('#scroll').append(chckoutstr);

      });
      setTimeout(function(){
	  $('#totprz_trnst').addClass('cartRupee');
	  $('#totprz_trnst').html(indianMoney(totalprice));
      },1000);
     }
    }
  });
}

function getweight(currentSize, catName, storedWt)
{
  var mtlWgDav = 0;
  var bseSize = 0;
  if (catName.toLowerCase() == 'rings') {
    bseSize = parseFloat(14);
    mtlWgDav = 0.05;
  } else if (catName.toLowerCase() == 'bangles') {
    bseSize = parseFloat(2.4);
    mtlWgDav = 7;
  }
  if (isNaN(currentSize))
  {
    if (catName == 'Rings')
      currentSize = parseFloat(14);
    else if (catName == 'Bangles')
      currentSize = parseFloat(2.4);
    else if (catName !== 'Rings' && catName !== 'Bangles')
      currentSize = 0;
  }
  var changeInWeight = (currentSize - bseSize) * mtlWgDav;
  var newWeight = (parseFloat(storedWt) + parseFloat(changeInWeight)).toFixed(3);
  return newWeight;
}


function removeprd(el) {
  $('#rmvpoptxt').html('Do you want to delete this product');
  cartpopUp();
  $('#cYes').unbind();
  $('#cYes').click(function () {

    var id = $(el).attr('id');
    var a = id.split('_');
    var col_car_qty = a[2], product_id = a[0], cartid = a[3];
    var size = id = a[4];
    var URL = APIDOMAIN + "index.php?action=removeItemFromCart&col_car_qty=" + col_car_qty + "&pid=" + product_id + "&cartid=" + cartid + "&size=" + size;
    $.ajax({type: 'POST', url: URL, success: function (res) {
	displayprddetail();
	cartpopUpClose();
      }
    });
  });
    $('#cNo').click(function () {
           cartpopUpClose();
        $('#cNo').unbind();
     });
}

function incrqnty(ths)
{
  var e = $(ths).siblings('.item_amt');
  var j = $(ths).siblings('.item_amt').text();
  var e2 = $(ths).closest('.cart_item').find('.price_gen ')
  var price = $(ths).closest('.cart_item').find('.price_gen ').text();
  price = price.replace(/\,/g, '');
  price = parseInt(price, 10);
  var totprice = price * j;
  totprice = totprice + price;
  totalprice += price;
  j++;
  $(e).html(j);
  var ids = $(ths).attr('id');
  ids = ids.split('_');
  var pid = ids[1];
  var col_car_qty = ids[3];
  var cart_id = ids[4];
  $(gblcheckodata).each(function (r, v) {
    if (v.product_id == pid && v.col_car_qty == col_car_qty && v.cart_id == cart_id)
    {
      var dat = {};
      dat['cartid'] = v.cart_id;
      dat['pid'] = v.product_id;
      dat['userid'] = v.userid;
      dat['col_car_qty'] = v.col_car_qty;
      dat['qty'] = j;
      dat['price'] = totprice;
      dat['RBsize'] = v.size;
      storechangdata(dat);
      $('#totprz_trnst').html(indianMoney(totalprice));
    }
  });
}

function decrqnty(evnt)
{
  var e = $(evnt).siblings('.item_amt');
  var j = $(evnt).siblings('.item_amt').text();
  var e2 = $(evnt).closest('.cart_item').find('.price_gen');
  var price = $(evnt).closest('.cart_item').find('.price_gen ').text();
  price = price.replace(/\,/g, '');
  var price = parseInt(price, 10);
  if (j > 1) {

    totalprice -= price;
    var totprice = price * j;
    totprice = totprice - price;
    j--;
    $(e).html(j);

    var ids = $(evnt).attr('id');
    ids = ids.split('_');
    var pid = ids[1];
    var col_car_qty = ids[3];
    var cart_id = ids[4];
    $(gblcheckodata).each(function (r, v) {
      if (v.product_id == pid && v.col_car_qty == col_car_qty && v.cart_id == cart_id)
      {
	var dat = {};
	dat['cartid'] = v.cart_id;
	dat['pid'] = v.product_id;
	dat['userid'] = v.userid;
	dat['col_car_qty'] = v.col_car_qty;
	dat['qty'] = j;
	dat['price'] = totprice;
	dat['RBsize'] = v.size;
	storechangdata(dat);
	$('#totprz_trnst').html(indianMoney(totalprice));
      }
    });
  }
}

function getname()
{  
  var userid=common.readFromStorage('jzeva_uid');
  if(userid !== null)
  {
    var URL=APIDOMAIN + "index.php?action=getUserDetailsById&userid="+userid; 
    $.ajax({url:URL,type:"GET",datatype:"JSON",success:function(result){
	var data=JSON.parse(result);

	var name=data['result'][0]['uname'];
	var gendr=data['result'][0]['gender'];
	var gndr;
	if(gendr == 1)
	  gndr="Ms";
	else if(gendr == 2)
	  gndr="Mr";
	else if(gendr == 3)
	  gndr="Mrs";
	$('#uname').html(gndr +' '+ name);  
    }
    });
  }
  else{
    var URL=APIDOMAIN + "index.php?action=getshipdatabyshipid&shpid="+shipid; 
    $.ajax({url:URL,type:"GET",datatype:"JSON",success:function(result){
	var data=JSON.parse(result);
	 
	var name=data['results'].name;
	$('#uname').html('Dear '+name);
      }
    });
  }
}

$('.cntshptrnfail').click(function(){
   var lasturl=$.cookie('jzeva_currurl'); console.log(lasturl);
    window.location.href=DOMAIN +"index.php"+lasturl; 
});


function storechangdata(cartdata)
{
    var URL = APIDOMAIN + "index.php?action=addTocart";
    var data = cartdata;
    var dt = JSON.stringify(data);
    $.ajax({type: "post", url: URL, data: {dt: dt}, success: function (data) {
            // console.log(data);
	    
        }
    });
}