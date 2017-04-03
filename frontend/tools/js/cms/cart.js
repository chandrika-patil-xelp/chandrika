

var gblcartdata;
 
function storecartdata(cartdata, chk)
{

    var URL = APIDOMAIN + "index.php?action=addTocart";

    var data = cartdata;
    var dt = JSON.stringify(data);
    $.ajax({
        type: "post",
        url: URL,
        data: {dt: dt},
        success: function (results) {
	  var data=JSON.parse(results);
	  common.addToStorage('jzeva_cartid', data.cartid);
        
             getglobaldata();
            if (chk == 1) {
                $("#niceCart").html("");
                displaycartdata();
            }
        }
    });
}

function displaycartdata()
{
    $("#niceCart").html("");
    var cartstr = "";
    var userid = common.readFromStorage('jzeva_uid');
    var cartid = common.readFromStorage('jzeva_cartid');
    if (cartid !== null || userid !== null) {
        var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id=" + cartid + "&userid=" + userid + "";

        $.ajax({
            url: URL,
            type: "GET",
            datatype: "JSON",
            success: function (results)
            {
                var obj = JSON.parse(results);
		gblcartdata = obj.result;
		displaycartempty();
                if (obj.result !== null)
                {

		
                    $(obj.result).each(function (r, v) {
			
                        if (v.default_img !== null) {
                            abc = IMGDOMAIN + v.default_img;
                        }
			else {
			  if(v.prdimage !== null){
			    var abc =""; abc = v.prdimage;
                            abc = abc.split(',');
                            abc = IMGDOMAIN + abc[0];
			  }
			  else{
			   //  abc=BACKDOMAIN +'tools/img/noimage.svg';
			  }
			   
                        }
                        var bprize = parseInt(v.price / v.pqty);
                        var wht;
                        if (v.ccatname !== null) {
                            wht = getweight(v.size, v.ccatname, v.metal_weight);
                        } else {
                            wht = v.metal_weight;
                        }

                        cartstr = "<div class='cart_item'>";
			cartstr += "<div class='opn_prdcart' id='" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "_" + v.size + "'>";
			if(abc !== undefined)
			  cartstr += "<div class='cart_image' onclick='prdopen(this)'><img src='"+ abc +"' onerror='this.style.display=\"none\"'>";
			else
			  cartstr += "<div class='cart_image' onclick='prdopen(this)'><img src='' onerror='this.style.display=\"none\"'>";
                        cartstr += "</div>";
                        cartstr += "<div class='cart_name' onclick='prdopen(this)'>" + v.prdname + "</div>";
                       cartstr += "<div class='cart_desc  fLeft' id='nwwt'>" + v.color + " " + v.jewelleryType + " | "+ v.carat + " | " + wht + "  grams";
//                      cartstr += "Quality : " + v.quality + "  ";
                       cartstr += "<div class='cart_desc  fLeft' id='nwwt'>";
                       if(v.dmdcarat === null )
                             cartstr += "Solitaire " +v.Solicarat+"Ct |"+v.Soliclarity ;
                         else
                       cartstr += "Diamonds " + v.dmdcarat + " Ct | " + v.quality ;
		       if(parseInt(v.size) !== 0 )
		       cartstr += " | Size " + v.size + "";
//                        cartstr += "<div class='cart_desc  fLeft' id='nwwt'>" + v.jewelleryType + " : " + wht + " gms &nbsp|&nbsp Diamond : " + v.dmdcarat + " &nbsp|&nbsp ";
//                        cartstr += "Quality : " + v.quality + "  ";
//                        cartstr += "<div class='cart_desc  fLeft' id='nwwt'>";
//                        cartstr += "Purity : " + v.carat + " &nbsp|&nbsp ";
//                        if (v.ccatname !== null)
//                        cartstr += "Size : " + v.size + " &nbsp|&nbsp ";
//                        cartstr += "Color : " + v.color + "";
//                        cartstr += "</div>";
                        cartstr += "</div>";
                        cartstr += "<div class='cart_price cartRup15 fLeft'><span class='price_gen'> " + indianMoney(bprize) + "</span>";
                        cartstr += "<div class='amt_selector' id='" + v.cart_id + "'>";
                        cartstr += "<a href='#' onclick='subqnty(this)'  id='sub_" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "_" + v.size + "'><div class='cart_btn fLeft sub_no'></div></a>";
                        cartstr += "<div class='item_amt fLeft '>" + v.pqty + "</div>";
                        cartstr += " <a href='#' onclick='addqnty(this)'  id='add_" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "_" + v.size + "'><div class='cart_btn fLeft add_no' ></div></a>"
                        cartstr += "</div>";       
                        cartstr += "</div>";
			cartstr += "</div>";
			 cartstr += "</div>";
                        
         cartstr += "<div class='cart_removew addrCommon' id='" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "_" + v.size + "'onclick='cremove(this)'>";
			cartstr += "</div>";

                        $("#niceCart").append(cartstr);

                        r++;
                    });
                    gettotal();

                }
            }
        });
    }
}

function prdopen(ths)
{
  var ids=$(ths).closest('.cart_item').find('.opn_prdcart').attr('id'); 
  ids=ids.split('_');
  var pid=ids[0];   var combn=ids[2];
  var size=ids[4];
   window.open(DOMAIN +"index.php?action=product_page&pid="+pid+"&comb="+combn+"&sz="+size+"");
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
        else if (catName !== 'Rings' && catName !== 'Bangles') {
            currentSize = 0;
        }
    }


    var changeInWeight = (currentSize - bseSize) * mtlWgDav;
    var newWeight = parseFloat(storedWt) + parseFloat(changeInWeight);
    newWeight=newWeight.toFixed(3);

    return newWeight;

}

function indianMoney(x) {
    x = x.toString();
    var afterPoint = '';
    if (x.indexOf('.') > 0)
        afterPoint = x.substring(x.indexOf('.'), x.length);
    x = Math.floor(x);
    x = x.toString();
    var lastThree = x.substring(x.length - 3);
    var otherNumbers = x.substring(0, x.length - 3);
    if (otherNumbers != '')
        lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
    return res;
}

function cremove(el) {
    $('#rmvpoptxt').html('Do you want to delete this Cart');
    cartpopUp();
    $('#cYes').unbind();
    $('#cYes').click(function () {

        var id = $(el).closest('div.cart_removew').attr('id');
        var a = id.split('_');
        var col_car_qty = a[2], product_id = a[0], cartid = a[3];
        var size = a[4];
        var URL = APIDOMAIN + "index.php?action=removeItemFromCart&col_car_qty=" + col_car_qty + "&pid=" + product_id + "&cartid=" + cartid + "&size=" + size + "";

        $.ajax({type: 'POST', url: URL, success: function (res) {
		displaycartdata();
		setTimeout(function(){
		   displaycartempty();
		    gettotal();
		},500);
		cartpopUpClose();
            }
        });
    });

     $('#cNo').click(function () {
           cartpopUpClose();
        $('#cNo').unbind();
     });
}

function addqnty(ths)
{

    var e = $(ths).siblings('.item_amt');
    var j = $(ths).siblings('.item_amt').text();
    var e2 = $(ths).closest('.cart_item').find('.price_gen ')
    var price = $(ths).closest('.cart_item').find('.price_gen ').text();
    price = price.replace(/\,/g, '');
    price = price.replace('₹', '');
    price = parseInt(price, 10);
    var totprice = price * j;
    totprice = totprice + price;
    j++;
    $(e).html(j);
    var ids = $(ths).attr('id');
    ids = ids.split('_');
    var pid = ids[1];
    var col_car_qty = ids[3];
    var cart_id = ids[4];
    var size = ids[5];
    $(gblcartdata).each(function (r, v) {
        if (v.product_id == pid && v.col_car_qty == col_car_qty && v.cart_id == cart_id && v.size == size)
        {
            var dat = {};
            dat['cartid'] = v.cart_id;
            dat['pid'] = v.product_id;
            dat['userid'] = v.userid;
            dat['col_car_qty'] = v.col_car_qty;
            dat['qty'] = j;
            dat['price'] = totprice;
            dat['RBsize'] = v.size;
            storecartdata(dat, 2);

        }
    });

}

function subqnty(evnt)
{
    var e = $(evnt).siblings('.item_amt');
    var j = $(evnt).siblings('.item_amt').text();
    var e2 = $(evnt).closest('.cart_item').find('.price_gen');
    var price = $(evnt).closest('.cart_item').find('.price_gen ').text();
    price = price.replace(/\,/g, '');
    price = price.replace('₹', '');
    price = parseInt(price, 10);
    if (j > 1) {
        var totprice = price * j;
        totprice = totprice - price;
        j--;
        $(e).html(j);

        var ids = $(evnt).attr('id');
        ids = ids.split('_');
        var pid = ids[1];
        var col_car_qty = ids[3];
        var cart_id = ids[4];
        var size = ids[5];
        $(gblcartdata).each(function (r, v) {
            if (v.product_id == pid && v.col_car_qty == col_car_qty && v.cart_id == cart_id && v.size == size)
            {
                var dat = {};
                dat['cartid'] = v.cart_id;
                dat['pid'] = v.product_id;
                dat['userid'] = v.userid;
                dat['col_car_qty'] = v.col_car_qty;
                dat['qty'] = j;
                dat['price'] = totprice;
                dat['RBsize'] = v.size;
                storecartdata(dat, 2);

            }
        });
    }
}

function gettotal()
{

    var itemcnt = 0, total = 0; 
    $(gblcartdata).each(function (r, v) {

        total = parseInt(v.price) + total;
        itemcnt = parseInt(v.pqty) + itemcnt;
    });
    $("#totprz_cart").html(indianMoney(total));
    $(".lnHt30").html("Total Items: " + itemcnt);
    $(".cartCount").html(itemcnt);
}

function getglobaldata()
{
    var userid = common.readFromStorage('jzeva_uid');
    var cartid = common.readFromStorage('jzeva_cartid');
    if (cartid !== null || userid !== null) {
        var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id=" + cartid + "&userid=" + userid + "";
        $.ajax({
            url: URL,
            type: "GET",
            datatype: "JSON",
            success: function (results)
            {

                var obj = JSON.parse(results);
                gblcartdata = obj.result;
                gettotal();
                displaycartempty();
            }
        });
    }
}


$(document).ready(function () {
     displaycartdata();
     setTimeout(function(){
	 displaycartempty();
     },1000);
});

function displaycartempty()
{
	if(gblcartdata == null)
	{
	    $('#totitm_cart').addClass('dn');
	    $('.cart_gen2').addClass('dn');
	    $("#nocart").removeClass("dn");
	    $('.cart_gen').addClass('dn');
	    $('.cartBox').addClass('dn');
	    $('.twoBtn').addClass('dn');
	    setTimeout(function(){
		closeCart();
	    },500);
	}
	else
	{
	    $('.cart_gen').removeClass('dn');
	    $('.cart_gen2').removeClass('dn');
	    $("#nocart").addClass("dn");
	    $('#totitm_cart').removeClass('dn');
	    $('.cartBox').removeClass('dn');
	    $('.twoBtn').removeClass('dn');
	}
}
