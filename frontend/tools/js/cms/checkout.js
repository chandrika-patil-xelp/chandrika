
var gblcheckodata, bakflag = 0, totalprice = 0, shipngdata = {}, validationFlag = 1, logotpflag = 0, contnu_enble = 0;
var inp_data, shipng_id = 0, chkouttentrflag = 0, shipngzpcodflg = 1, shpngusrflg, gndrflg, actn;

$(document).ready(function () {
    actn = GetURLParameter('actn');
    var userid = common.readFromStorage('jzeva_uid');
    if (userid !== null) {
        openfst();
        displayaddrs(userid);
    } else {
        window.location.href=DOMAIN + 'index.php?action=checkoutGuest';
    }

    displaycartdetail();

    $(document).keypress(function (e) {
        if (e.which == 13) {
            if (chkouttentrflag == 1)
                mob_mailsubmt();
            else if (chkouttentrflag == 2)
                suboldusrpass();
            else if (chkouttentrflag == 3) {
                if (contnu_enble == 1)
                    otpcontn();
            } else if (chkouttentrflag == 4)
                sublogwthotp();
            else if (chkouttentrflag == 5)
                shpngsubmt();
        }
    });
});

function GetURLParameter(Param)
{

    var PageURL = window.location.search;
    var URLVariables = PageURL.split('&');
    for (var i = 0; i < URLVariables.length; i++)
    {
        var ParameterName = URLVariables[i].split('=');
        if (ParameterName[0] == Param) {
            return ParameterName[1];
        }

    }
}

function displaycartdetail()
{
    var userid = common.readFromStorage('jzeva_uid');
    var cartid = common.readFromStorage('jzeva_cartid');
    $('#scroll').html("");
    totalprice = 0;
    $('#totprz_chkout').html("");
    $('#totprz_chkout').removeClass('cartRupee');
    if (actn == 'buy')
    {
        var buyid = common.readFromStorage('jzeva_buyid');
        var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id=" + buyid;
    }
    else
    {
        var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id=" + cartid + "&userid=" + userid + "";
    }

    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {

	    var obj = JSON.parse(results);
            gblcheckodata = obj.result;
            if (gblcheckodata == null)
	    {
	      setTimeout(function(){
                $('#all_submt,#all_submtNew').addClass('dn');
                $("#noprdcrd").removeClass("dn");
                $('#totlitem_chkout,#scroll').addClass('dn');
		$('#totprz_chkout').removeClass('cartRupee');
	      },1000);
            }
	    else
	    {
		setTimeout(function(){
		  $('#all_submt,#all_submtNew').removeClass('dn');
		  $("#noprdcrd").addClass("dn");
		  $('#totlitem_chkout,#scroll').removeClass('dn');
		},1000);

                $(obj.result).each(function (r, v) {

		    if (v.default_img !== null)
		    {
                        abc = IMGDOMAIN + v.default_img;
                    }
		    else
		    {
		      if(v.prdimage !== null)
		      {
                        var abc = v.prdimage;
                        abc = abc.split(',');
                        abc = IMGDOMAIN + abc[0];
		      }
		      else{
			//abc=BACKDOMAIN +'tools/img/noimage.svg'
		      }

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

                    chckoutstr += "</div>";
                    chckoutstr += "<div class='cart_name'>" + (v.prdname).toUpperCase() + "</div>";
                     if(v.dmdcarat === null )
                          
                    chckoutstr += "<div class='cart_desc  fLeft' id='nwwt'>" + v.jewelleryType + " : " + wht + " gms &nbsp|&nbsp Solitaire : " + v.Solicarat + " Ct &nbsp|&nbsp Quality : " + v.Soliclarity + " ";
                         else
                    chckoutstr += "<div class='cart_desc  fLeft' id='nwwt'>" + v.jewelleryType + " : " + wht + " gms &nbsp|&nbsp Diamond : " + v.dmdcarat + " Ct &nbsp|&nbsp Quality : " + v.quality + " ";
                    //chckoutstr += "Quality : " + v.quality + "  ";
                    chckoutstr += "<div class='cart_desc  fLeft' >";
                    chckoutstr += "Purity : " + v.carat + " &nbsp|&nbsp ";
                    if (v.ccatname !== null)
                        chckoutstr += "Size : " + v.size + " &nbsp|&nbsp ";
                    chckoutstr += "Color : " + v.color + "";
                    chckoutstr += "</div>";
                    chckoutstr += "<div class='cart_price cartRup15 fLeft'><span class='price_gen'> " + indianMoney(bprize) + "</span>";
                    chckoutstr += "<div class='amt_selector' id='" + v.cart_id + "'>";
                    chckoutstr += "<a href='#' onclick='subqnty(this)'  id='sub_" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "'><div class='cart_btn fLeft sub_noW'></div></a>";
                    chckoutstr += "<div class='item_amt fLeft'>" + v.pqty + "</div>";
                    chckoutstr += " <a href='#' id='add_" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "' onclick='addqnty(this)'><div class='cart_btn fLeft add_noW' ></div></a>";
                    chckoutstr += "</div>";
                    chckoutstr +="</div>";
                   
                    
                    chckoutstr += "<div class='cart_removew addrCommon' id='" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "_" + v.size + "' onclick='remove(this)' >";
                    chckoutstr += "</div>";
                    chckoutstr += "</div>";

		      $('#scroll').append(chckoutstr);

                });
		setTimeout(function(){
		    $('#totprz_chkout').addClass('cartRupee');
		    $('#totprz_chkout').html(indianMoney(totalprice));
		},300);
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
            $('#totprz_chkout').html(indianMoney(totalprice));
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
                $('#totprz_chkout').html(indianMoney(totalprice));
            }
        });
    }
}

function storecartdata(cartdata)
{
    var URL = APIDOMAIN + "index.php?action=addTocart";
    var data = cartdata;
    var dt = JSON.stringify(data);
    $.ajax({type: "post", url: URL, data: {dt: dt}, success: function (data) {
            // console.log(data);
        }
    });
}



$('#shpng_sub,#shpng_subMob').click(function () {
    shpngsubmt();
});

function shpngsubmt()
{
    validationFlag = 1;
  var name, email, mobile;
  var usrid = common.readFromStorage('jzeva_uid');
    email=common.readFromStorage('jzeva_email');
    name = $('#shpdname').val();
    mobile = $('#shpdmobile').val();
    var addrs = $('#shpdaddrs').val();
    var city = $('#shpdcity').val();
    var state = $('#shpdstate').val();
    var pincode = $('#shpdpincode').val();
    var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var letters = /^[a-zA-Z\s]+$/;
    var filter = /^[0-9-+]+$/;
    var addchk=/^[a-zA-Z0-9-#-'-,/ ]*$/;
    if(gndrflg == undefined || gndrflg == null){
      validationFlag=0;
      common.msg(0,'Please Select Title');
    }
    else if (name === '' || name === null) {
        validationFlag = 0;
        common.msg(0, 'Please enter your Name');
    } else if (!letters.test(name)) {
        validationFlag = 0;
        common.msg(0, 'Name should be Characters');
    } else if (mobile === '' || mobile === null) {
        validationFlag = 0;
        common.msg(0, 'Please enter your Mobile no');
    } else if (isNaN(mobile) || (mobile.length !== 10)) {
        validationFlag = 0;
        common.msg(0, 'Please enter 10 Digit Mobile No');
    } else if (!filter.test(mobile)) {
        validationFlag = 0;
        common.msg(0, 'Mobile number is Invalid');
    } else if (addrs === '' || addrs === null) {
        validationFlag = 0;
        common.msg(0, 'Please enter your address');
    } else if (!addchk.test(addrs)) {
        validationFlag = 0;
        common.msg(0, 'Please remove special characters from address');
    }
    else if (pincode === '' || pincode.length === 0) {
        validationFlag = 0;
        common.msg(0, 'Please enter your Zip code');
    } else if (pincode.length > 6 || pincode.length < 6) {
        validationFlag = 0;
        common.msg(0, 'Please enter Correct Zip code');
    } else if (state === '' || state === null) {
        validationFlag = 0;
        common.msg(0, 'Please enter your state name');
    } else if (city === '' || city === null) {
        validationFlag = 0;
        common.msg(0, 'Please enter your city name');
    }
    if (shipngzpcodflg !== 1 && validationFlag == 1) {
        validationFlag = 0;
        common.msg(0, 'Please enter Valid Zip code');
    }



    if (validationFlag == 1)
    {
        shipngdata['gender'] = gndrflg;
        shipngdata['name'] = name;
        shipngdata['email'] = email;
        shipngdata['mobile'] = mobile;
        shipngdata['address'] = addrs;
        shipngdata['pincode'] = pincode;
        shipngdata['state'] = state;
        shipngdata['city'] = city;
        shipngdata['user_id'] = usrid;

        openfst();

        setTimeout(function () {
            storeshippingdata();
        }, 300);

    }

}


function storeshippingdata()
{
    if (validationFlag == 1) {
        var URL = APIDOMAIN + "index.php?action=addshippingdetail";
        var data = shipngdata;
        var dt = JSON.stringify(data);
        $.ajax({type: "post", url: URL, data: {dt: dt}, success: function (res) {

                var data = JSON.parse(res);
                var usrid = common.readFromStorage('jzeva_uid');
                // openfst();
                displayaddrs(usrid);

            }
        });
    }
}

function displayaddrs(userid)
{
    var addstr = '';
    var diff_adr = "";
    $('#intscrl').html('');
    var URL = APIDOMAIN + "index.php/?action=getshippingdatabyid&userid=" + userid;
    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
            var data = JSON.parse(results);

            var res = data['results'];
            if (res !== null) {
                $('addr_main').html('');


                diff_adr += ' <div class="entrOtp fLeft semibold" onclick="opnscnd()" id="dd">Want to add different address ?</div>';
                $('#intscrl').append(diff_adr);
                $(res).each(function (r, v) {

		    var gender=v.gender;
		    var gndrstr=getgender(gender);
                    addstr += ' <div class="col100 fLeft radTor poR">';
                    addstr += ' <div class="w50r fLeft">';

                    addstr += ' <div class="checkName fLeft semibold" title=' + v.name + '  id="spnd_name"><span class="txt_Capital">'+gndrstr+'</span> ' + v.name + '</div>';
//	  addstr += ' <div class="text fLeft txtOver">8123128747</div>';
                    addstr += ' <div class="text fLeft  semibold" title=' + v.email + '  id="spnd_email">'+v.mobile+' | ' + v.email + '</div>';



                    addstr += ' <div class="text fLeft pad0"><span>' + v.address + '</span></div>';
                    addstr += ' <div class="text fLeft  pad0" title=' + v.city + '  id="spnd_city_pin">' + v.city + "-" + v.pincode + '</div>';
		    addstr += ' <div class="text fLeft  pad0" >' + v.state + '</div>';
                    addstr += ' </div>';
                    addstr += '  <input type="radio" name="selectM"  class="filled-in dn" id="' + v.shipping_id + '">';
                    addstr += ' <label for="' + v.shipping_id + '" id="' + v.shipping_id + '" onclick="addrsel(this)"></label> ';
                    addstr += ' <div class="matchIcn defaultIcn transition300" id="' + v.shipping_id + '">';
                    addstr += ' </div>';
//          addstr += '<div class="tabDaddrss semibold">DELIVERY ADDRESS</div>';
//	  addstr += ' <div class="btncnt fLeft bolder">';
//	  addstr += '  <center> ';
//	  addstr += ' <div class="dlvrBtn transition300">DELIVER TO THIS ADDRESS</div> ';
//	  addstr += ' </center> ';
//	  addstr += ' </div>';
                    addstr += ' </div>';

                });

		bakflag = 1;
                $('#intscrl').prepend(addstr);
                $('#diff_adr').html('Add New Address');

            } else {
                opnscnd();
            }
        }

    });
    setTimeout(function () {
//       diff_adr += ' <div class="entrOtp fLeft semibold" onclick="opnscnd()" id="dd">Different Address?</div>';
//  $('#intscrl').append(diff_adr);
    }, 500);

}

$('#shpdpincode').on('keyup', function () {
    var zipcode = $(this).val();
    var filter = /^[0-9-+]+$/;
    if (zipcode.length > 0) {
        if (!filter.test(zipcode)) {
            common.msg(0, 'Invalid Zip Code');
            return false;
        }
    }
    if ($.isNumeric(zipcode)) {
        if (zipcode.length == 6)
            checkshpdpincode(zipcode);
        else {
            $('#shpdcity').val('');
            $('#shpdcity').blur();
            $('#shpdstate').val('');
            $('#shpdstate').blur();
        }
    } else {
        if (zipcode.length == 6 || zipcode.length == 1)
            common.msg(0, 'Please Enter Numeric Value');
        $('#shpdcity').val('');
        $('#shpdcity').blur();
        $('#shpdstate').val('');
        $('#shpdstate').blur();
    }
});

function  storeorderdata()
{
    common.addToStorage('jzeva_shpid',shipng_id);
    if (actn == 'buy') {
        var buyid = common.readFromStorage('jzeva_buyid');
        cartid = buyid;
        window.location.href = DOMAIN + "index.php?action=checkoutBefore&actn=buy";
    } else
        window.location.href = DOMAIN + "index.php?action=checkoutBefore";
}

$('#all_submt,#all_submtNew').click(function () {
    if (shipng_id == 0) {
        common.msg(0, 'Please select Your shipping Address');
    } else {
        storeorderdata();
    }

});



function addrsel(ths)
{
    var id = $(ths).attr('id');
    shipng_id = id;
}

$('#shpd_bak,#shpd_bakMob').click(function () {
      if(bakflag == 0)
      {
	var lasturl = $.cookie('jzeva_currurl');
	window.location.href = DOMAIN + "index.php" + lasturl;
      }
      else
      {
         $('#'+shipng_id+'').prop('checked', false);
	        shipng_id=0;
         gndrflg = undefined;
	       openfst();
      }
      $('#diff_addr').addClass('mbloff');
});


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


function checkshpdpincode(zipcode)
{

    if (zipcode.length == 6) {
        var URL = APIDOMAIN + "index.php?action=viewbyPincode&code=" + zipcode;
        $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results)
            {
                var obj = JSON.parse(results);

                if (obj['error']['code'] == 0)
                {
                    $('#shpdstate').val(obj.results[0].state);
                    $('#shpdcity').val(obj.results[0].city);
                    shipngzpcodflg = 1;
                    $('#shpdcity').focus();
                    $('#shpdstate').focus();
                } else if (obj['error']['code'] == 1) {
                    shipngzpcodflg = 0;
                    common.msg(0, obj['error']['msg']);
                }
            }
        });
    } else if (zipcode.length == 0) {
    } else {
        shipngzpcodflg = 0;
        common.msg(0, 'Please Enter correct Zip Code');
    }
}

$('#cntshpngchkout').click(function () {
    var lasturl = $.cookie('jzeva_currurl');
    window.location.href = DOMAIN + "index.php" + lasturl;
});

$('.opt1').click(function(){
    var id=$(this).attr('id');
    id=id.split('_');
    gndrflg=id[1];
  });

function getgender(gndr)
{
  var gndrstr="";
  if(gndr == 1)
    gndrstr="Ms";
  else if(gndr == 2)
    gndrstr="Mr";
  else if(gndr == 3)
    gndrstr="Mrs";
    
  return gndrstr;
}
