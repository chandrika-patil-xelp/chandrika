$(document).ready(function () {
    common.addToStorage('jzeva_shpid', shpid);
    displaycartdetail();
    getshippingdata();
});


function displaycartdetail()
{
    var userid = common.readFromStorage('jzeva_uid');
    var cartid = common.readFromStorage('jzeva_cartid');
    $('#scroll').html("");
    totalprice = 0;
    $('.total_prc').html("");
    if (actn == 'buy') {
        var buyid = common.readFromStorage('jzeva_buyid');
        cartid = buyid;
        var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id=" + cartid;
    } else
        var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id=" + cartid + "&userid=" + userid + "";
    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
            var obj = JSON.parse(results);
            gblcheckodata = obj.result;

            if (gblcheckodata == null) {
                $('#submt').addClass('dn');
                $('#urords').addClass('dn');
                $("#noprdinchkot").removeClass("dn");
                $('.totalItem').addClass('dn');
            } else {
                $('#submt').removeClass('dn');
                $("#noprdinchkot").addClass("dn");

                $('#urords').removeClass('dn');
                $(obj.result).each(function (r, v) {
                    if (v.default_img !== null) {
                        abc = IMGDOMAIN + v.default_img;
                    } else {
                        var abc = v.prdimage;
                        abc = abc.split(',');
                        abc = IMGDOMAIN + abc[0];
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
                    chckoutstr += "<div class='cart_image'><img src='" + abc + "'";
                    chckoutstr += " alt='Image not found'></div>";
                    chckoutstr += "<div class='cart_name'>" + (v.prdname).toUpperCase() + "</div>";
                    chckoutstr += "<div class='cart_desc  fLeft' id='nwwt'>" + v.jewelleryType + " : " + wht + " gms &nbsp|&nbsp Diamond : " + v.dmdcarat + " Ct &nbsp|&nbsp ";
                    chckoutstr += "Quality : " + v.quality + "  ";
                    chckoutstr += "<div class='cart_desc  fLeft' >";
                    chckoutstr += "Purity : " + v.carat + " &nbsp|&nbsp ";
                    if (v.ccatname !== null)
                    chckoutstr += "Size : " + v.size + " &nbsp|&nbsp ";
                    chckoutstr += "Color : " + v.color + "";
                    chckoutstr += "</div>";
                    chckoutstr += "<div class='cart_price cartRup15 fLeft'><span class='price_gen'> " + indianMoney(bprize) + "</span></div>";
                    chckoutstr += "<div class='amt_selector' id='" + v.cart_id + "'>";
//                    chckoutstr += "<a href='#' onclick='subqnty(this)'  id='sub_" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "'><div class='cart_btn fLeft sub_noW'></div></a>";
                    chckoutstr += "<div class='item_amt fLeft '>" + v.pqty + "</div>";
//                    chckoutstr += " <a href='#' id='add_" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "' onclick='addqnty(this)'><div class='cart_btn fLeft add_noW' ></div></a>";
                    chckoutstr += "</div>";
//                    chckoutstr += "<div class='cart_removew addrCommon' id='" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "_" + v.size + "' onclick='remove(this)' >";
//                    chckoutstr += "</div>";
                    chckoutstr += "</div>";
                    $('#scroll').append(chckoutstr);
                });
                $('.total_prc').html(indianMoney(totalprice));
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
            $('.total_prc').html(indianMoney(totalprice));
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
                $('.total_prc').html(indianMoney(totalprice));
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
            $('#cust_name').html(data.name);
            $('#cust_mobl').html(data.mobile+" | "+data.email);
	 
            $('#addr').html(data.address);
            $('#adcity').html(data.city + " " + data.pincode);
        }
    });
}

$('#submt').click(function () {

    if (actn == 'buy') {
        var buyid = common.readFromStorage('jzeva_buyid');
        var cartid = buyid;
    } else {
        var cartid = common.readFromStorage('jzeva_cartid');
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
        }
    });
}

$('#chck_bak').click(function(){
  
   if (actn == 'buy') { 
        window.location.href=DOMAIN +"index.php?action=checkOutNew&actn="+actn;
    } 
    else {
      window.location.href=DOMAIN +"index.php?action=checkOutNew";
    }
   
});

 