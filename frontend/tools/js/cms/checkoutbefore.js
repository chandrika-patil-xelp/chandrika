$(document).ready(function () {
    common.addToStorage('jzeva_shpid', shpid);
    displaycartdetail();
    getshippingdata();
});


function displaycartdetail()
{
    var userid = common.readFromStorage('jzeva_uid');
    var cartid = common.readFromStorage('jzeva_cartid');
    $('#scrollchckbfr').html("");
    totalprice = 0;
    $('#totprz_chkbfr').html("");
    if (actn == 'buy')
    {
        var buyid = common.readFromStorage('jzeva_buyid');
        var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id=" + buyid;
    }
    else
        var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id=" + cartid + "&userid=" + userid + "";

    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {

            var obj = JSON.parse(results);
            gblcheckodata = obj.result;

	        setTimeout(function(){

		  $('#submt').removeClass('dn');
		  $("#noprdinchkotbefr").addClass("dn");
		  $('#totitm_chckbefor').removeClass('dn');
		  $('#urords').removeClass('dn');
		},1000);

                $(obj.result).each(function (r, v) {
                    var  abc;
                    if (v.default_img !== null)
                         abc = IMGDOMAIN + v.default_img;
            		    else
            		    {
            		      if(v.prdimage !== null)
            		      {
                                    var abc = v.prdimage;
                                    abc = abc.split(',');
                                    abc = IMGDOMAIN + abc[0];
            		      }
            		      // else
            			    //      abc=BACKDOMAIN +'tools/img/noimage.svg'
                    }

                    totalprice += parseInt(v.price);
                    var bprize = parseInt(v.price / v.pqty);
                    var wht;
                    if (v.ccatname !== null)
                        wht = getweight(v.size, v.ccatname, v.metal_weight);
                    else
                        wht = parseFloat(v.metal_weight).toFixed(3);


                var chckoutstr = "<div class='cart_item'>";
                    if(abc !== undefined)
                        chckoutstr += "<div class='cart_image'><img src='" + abc + "' onerror='this.style.display=\"none\"'>";
                    else
                        chckoutstr += "<div class='cart_image'><img src='' onerror='this.style.display=\"none\"'>";
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
                    chckoutstr += "<div class='item_amt fLeft '>" + v.pqty + "</div>";
                    chckoutstr += "</div>";
                    chckoutstr += "</div>";

                    $('#scrollchckbfr').append(chckoutstr);
                });

		setTimeout(function(){
		  $('#totprz_chkbfr').addClass('cartRupee');
		  $('#totprz_chkbfr').html(indianMoney(totalprice));
		},300);

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


function remove(el) {
    $('#rmvpoptxt').html('Do you want to delete this product?');
    cartpopUp();
    $('#cYes').unbind();
    $('#cYes').click(function () {

        var id = $(el).attr('id');
        var a = id.split('_');
        var col_car_qty = a[2], product_id = a[0], cartid = a[3];
        var size = id = a[4];
        var URL = APIDOMAIN + "index.php?action=removeItemFromCart&col_car_qty=" + col_car_qty + "&pid=" + product_id + "&cartid=" + cartid + "&size=" + size;
        $.ajax({type: 'POST', url: URL, success: function (res) {
                displaycartdetail();
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
            storecartdata(dat);
            $('#totprz_chkbfr').html(indianMoney(totalprice));
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
                storecartdata(dat);
                $('#totprz_chkbfr').html(indianMoney(totalprice));
            }
        });
    }
}

function getshippingdata()
{
    var URL = APIDOMAIN + "index.php?action=getshipdatabyshipid&shpid=" + shpid + "";
    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
            var obj = JSON.parse(results);
            var data = obj['results'];
            var gndr=data.gender , gndrstr="";
            if(gndr == 1)
        		  gndrstr="Ms";
        		else if(gndr == 2)
        		  gndrstr="Mr";
        		else if(gndr == 3)
        		  gndrstr="Mrs";
        		
            $('#cust_name').html('<span class="txt_Capital">'+gndrstr+'</span> '+data.name);
            $('#cust_mobl').html(data.mobile+" | "+data.email);

            $('#addr').html(data.address);
            $('#adcity').html(data.city + " " + data.pincode);
            $('#state').html(data.state);
        }
    });
}

$('#submt').click(function () {
    var cartid ;
    if (actn == 'buy') {
        var buyid = common.readFromStorage('jzeva_buyid');
          cartid = buyid;
    } else {
          cartid = common.readFromStorage('jzeva_cartid');
        var buyid = common.readFromStorage('jzeva_buyid');
        if (buyid !== null)
            removebuyitem(buyid);
    }
    setTimeout(function () {
        window.location.href = DOMAIN + "transaction/payment.php?ordid=" + cartid + "&shipid=" + shpid;
    }, 400);
});


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
    newWeight = newWeight.toFixed(3);

    return newWeight;

}

function convert_number(number)
{
    if ((number < 0) || (number > 999999999))
    {
        return "NUMBER OUT OF RANGE!";
    }
    var Gn = Math.floor(number / 10000000);  /* Crore */
    number -= Gn * 10000000;
    var kn = Math.floor(number / 100000);     /* lakhs */
    number -= kn * 100000;
    var Hn = Math.floor(number / 1000);      /* thousand */
    number -= Hn * 1000;
    var Dn = Math.floor(number / 100);       /* Tens (deca) */
    number = number % 100;               /* Ones */
    var tn = Math.floor(number / 10);
    var one = Math.floor(number % 10);
    var res = "";

    if (Gn > 0)
    {
        res += (convert_number(Gn) + " Crore");
    }
    if (kn > 0)
    {
        res += (((res == "") ? "" : " ") +
                convert_number(kn) + " Lakhs");
    }
    if (Hn > 0)
    {
        res += (((res == "") ? "" : " ") +
                convert_number(Hn) + " Thousand");
    }

    if (Dn)
    {
        res += (((res == "") ? "" : " ") +
                convert_number(Dn) + " Hundred");
    }


    var ones = Array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen");
    var tens = Array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety");

    if (tn > 0 || one > 0)
    {
        if (!(res == ""))
        {
            res += " And ";
        }
        if (tn < 2)
        {
            res += ones[tn * 10 + one];
        } else
        {

            res += tens[tn];
            if (one > 0)
            {
                res += ("-" + ones[one]);
            }
        }
    }

    if (res == "")
    {
        res = "zero";
    }
    return res;
}

$('#cntshpng').click(function () {
    var lasturl = $.cookie('jzeva_currurl');
    window.location.href = DOMAIN + "index.php" + lasturl;
});

function removebuyitem(buyid)
{
    var URL = APIDOMAIN + "index.php?action=removCrtItemaftrcheckot&cartid=" + buyid + "&userid=NULL";
    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
            // console.log(results);
	    common.removeFromStorage('jzeva_buyid');
        }
    });
}

$('#chck_bak').click(function(){
   var userid=common.readFromStorage('jzeva_uid');
   if(userid == undefined || userid == null)
   {
      if (actn == 'buy') {
	    window.location.href=DOMAIN + 'index.php?action=checkoutGuest&actn='+actn;
       }
       else {
	    window.location.href=DOMAIN + 'index.php?action=checkoutGuest';
       }
   }
   else{
       if (actn == 'buy') {
	    window.location.href=DOMAIN +"index.php?action=checkOutNew&actn="+actn;
       }
       else {
	  window.location.href=DOMAIN +"index.php?action=checkOutNew";
       }
   }
});

$('#jzeva_log').click(function () {
        window.location.href = DOMAIN + "index.php?action=landing_page";
});
