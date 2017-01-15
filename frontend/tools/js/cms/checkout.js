
var gblcheckodata, bakflag = 0, totalprice = 0, shipngdata = {}, validationFlag = 1, logotpflag = 0, contnu_enble = 0;
var inp_data, shipng_id = 0, chkouttentrflag = 0, shipngzpcodflg = 1, shpngusrflg, gndrflg, actn;

$(document).ready(function () {
    actn = GetURLParameter('actn');
    var userid = common.readFromStorage('jzeva_uid');
    if (userid !== null) {
        openfst();
        displayaddrs(userid);
    } else {
        closeThrd();
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
    $('.total_price').html("");
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
                $('#all_submt').addClass('dn');
                $("#noprdcrd").removeClass("dn");
                $('.totalItem').addClass('dn');
            } else {
                $('#all_submt').removeClass('dn');
                $("#noprdcrd").addClass("dn");
                $('.totalItem').removeClass('dn');

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
                    chckoutstr += "<a href='#' onclick='subqnty(this)'  id='sub_" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "'><div class='cart_btn fLeft sub_noW'></div></a>";
                    chckoutstr += "<div class='item_amt fLeft'>" + v.pqty + "</div>";
                    chckoutstr += " <a href='#' id='add_" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "' onclick='addqnty(this)'><div class='cart_btn fLeft add_noW' ></div></a>";
                    chckoutstr += "</div>";
                    chckoutstr += "<div class='cart_removew addrCommon' id='" + v.product_id + "_" + r + "_" + v.col_car_qty + "_" + v.cart_id + "_" + v.size + "' onclick='remove(this)' >";
                    chckoutstr += "</div>";
                    chckoutstr += "</div>";
                    $('#scroll').append(chckoutstr);

                });
                $('.total_price').html(indianMoney(totalprice));
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
            $('.total_price').html(indianMoney(totalprice));
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
                $('.total_price').html(indianMoney(totalprice));
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

function checkotp(inptmob, otp)
{

    var URL = APIDOMAIN + "index.php/?action=checkopt&mobile=" + inptmob + "&otpval=" + otp;
    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
            var obj = JSON.parse(results);
            var data = obj.result;
            if (data !== undefined) {
                if (data.otp == null) {
                    common.msg(0, 'time is over plz try it again');
                    $('.matchIcn').addClass('dn');
                    $('.unmatchIcn').removeClass('dn');
                } else {
                    if (otp == data.otp) {
                        if (logotpflag == 2) {
                            getuserdetail(inptmob);

                        } else {
                            $('#resend_otp').addClass('dn');
                            $('.matchIcn').removeClass('dn');
                            $('.unmatchIcn').addClass('dn');
                            $('#paswrd1id').removeClass('dn');
                            $('#paswrd2id').removeClass('dn');
                            $('.centerDvHldr').addClass('dn');
                            $('#otp_countn').removeClass('dn');
                            //common.msg(0,'otp is correct');
                        }
                    } else {
                        $('.matchIcn').addClass('dn');
                        $('.unmatchIcn').removeClass('dn');
                        common.msg(0, 'your entered otp is wrong');
                    }
                }
            }
        }
    });
}

$('#otp_countn').click(function () {
    otpcontn();
});

function otpcontn()
{
    bakflag = 1;
    if (contnu_enble == 1) {
        $('#shpdmobile').val(inp_data);
        openfst1();
    } else {
        common.msg(0, 'Please Enter Correct Password ');
    }
}


$('#shpng_sub').click(function () {
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
    var addchk=/^[a-zA-Z0-9-#-'-, ]*$/;
    if (name === '' || name === null) {
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

$('#mob_mailsub').click(function () {
    mob_mailsubmt();
});

function mob_mailsubmt()
{
    inp_data = $('#entereml').val();
    var validationflg = 1;
    if ($.isNumeric(inp_data)) {
        if (inp_data === '' || inp_data === null) {
            validationflg = 0;
            common.msg(0, 'Please enter your Mobile no.');
        } else if (isNaN(inp_data) || (inp_data.length < 10) || (inp_data.length > 11)) {
            validationflg = 0;
            common.msg(0, 'Invalid Mobile no ');
        }

        if (validationflg == 1) {
            checkuser(inp_data);

        }
    } else {
        var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
        if (inp_data === '' || inp_data === null) {
            common.msg(0, 'Please enter your Email.id or mobile no');
            validationflg = 0;
        } else if (!reg.test(inp_data)) {
            common.msg(0, 'Invalid Email.id');
            validationflg = 0;
        }
        if (validationflg == 1) {
            checkuser(inp_data);
            openThrd();
            //  sendotpmail();
        }
    }
}

$('#otp1').on('keyup', function () {
    var otp = $(this).val();
    if (otp.length == 6)
        checkotp(inp_data, otp);
    else {
        $('#paswrd1id').addClass('dn');
        $('#paswrd2id').addClass('dn');
        $('#otp_countn').addClass('dn');
        $('#resend_otp').removeClass('dn');
        $('.matchIcn1').addClass('dn');
        $('.unmatchIcn1').addClass('dn');
        $('#pswrd1').val('');
        $('#pswrd1').blur();
        $('#pswrd2').val('');
        $('#pswrd2').blur();
    }
});

$('#resend_otp').click(function () {
    sendnewuserotp();
});

function sendnewuserotp()
{
    var URL = APIDOMAIN + "index.php/?action=sendnewuserotp&mobile=" + inp_data;
    $.ajax({type: 'POST', url: URL, success: function (res) {
            var data1 = JSON.parse(res);
            if (data1['error']['err_code'] == 0) {
                common.msg(1, data1['error']['err_msg']);
            } else if (data1['error']['err_code'] == 1) {
                common.msg(0, data1['error']['err_msg']);
            } else if (data1['error']['err_code'] == 2) {
                common.msg(0, data1['error']['err_msg']);
            }
        }
    });
}

function sendotpmail()
{
    var URL = APIDOMAIN + "index.php/?action=sendnewuserotp&mobile=" + inp_data;
    $.ajax({type: 'POST', url: URL, success: function (res) {
            var data1 = JSON.parse(res);
            if (data1['error']['err_code'] == 0) {
                common.msg(0, data1['error']['err_msg']);
            } else if (data1['error']['err_code'] == 1) {
                common.msg(0, data1['error']['err_msg']);
            } else if (data1['error']['err_code'] == 2) {
                common.msg(0, data1['error']['err_msg']);
            }
        }
    });
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

                    addstr += ' <div class="col100 fLeft radTor poR">';
                    addstr += ' <div class="w50r fLeft">';

                    addstr += ' <div class="checkName fLeft semibold" title=' + v.name + '  id="spnd_name">' + v.name + '</div>';
//	  addstr += ' <div class="text fLeft txtOver">8123128747</div>';
                    addstr += ' <div class="text fLeft  semibold" title=' + v.email + '  id="spnd_email">'+v.mobile+' | ' + v.email + '</div>';
                


                    addstr += ' <div class="text fLeft pad0"><span>' + v.address + '</span></div>';
                    addstr += ' <div class="text fLeft  pad0" title=' + v.city + '  id="spnd_city_pin">' + v.city + "-" + v.pincode + '</div>';

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
    if (actn == 'buy') {
        var buyid = common.readFromStorage('jzeva_buyid');
        cartid = buyid;
        window.location.href = DOMAIN + "index.php?action=checkoutBefore&shpid=" + shipng_id + "&actn=buy";
    } else
        window.location.href = DOMAIN + "index.php?action=checkoutBefore&shpid=" + shipng_id;
}

$('#all_submt').click(function () {
    if (shipng_id == 0) {
        common.msg(0, 'Please select Your shipping Address');
    } else {
        storeorderdata();
    }

});

function checkuser(inpt)
{
    if ($.isNumeric(inpt)) {
        var URL = APIDOMAIN + "index.php?action=getUserDetailsbyinpt&mobile=" + inpt;
    } else {
        var URL = APIDOMAIN + "index.php?action=getUserDetailsbyinpt&email=" + inpt;
    }
    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
            var obj = JSON.parse(results);
            if (obj['error']['Code'] == 0) {
                if (obj['results'] == null || obj['results'] == undefined) {
                    openThrd();
                    $('#paswrd1id').addClass('dn');
                    $('#paswrd2id').addClass('dn');
                    $('.matchIcn').addClass('dn');
                    $('.unmatchIcn1').addClass('dn');
                    $('#otp_countn').addClass('dn');
                    sendnewuserotp();
                } else {
                    openFifth();
                }
            }
        }
    });
}

$('#suboldusrpasw').click(function () {
    suboldusrpass();
});


function suboldusrpass()
{
    var pass = $('#pswrd8').val();
    var glbcartdeatil;
    if (pass === '' || pass === null) {
        common.msg(0, 'Please enter your Password');
    } else {
        var URL = APIDOMAIN + "index.php?action=checkpassw&pass=" + pass + "&mob=" + inp_data;

        $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
                var obj = JSON.parse(results);
                if (obj['error']['err_code'] == 0) {

                    common.addToStorage('jzeva_uid', obj['result']['uid']);
                    common.addToStorage("jzeva_email", obj['result']['email']);
                    common.addToStorage("jzeva_name", obj['result']['uname']);
                    common.addToStorage("jzeva_mob", obj['result']['mob']);

                    if (obj['result']['cart_id'] !== null) {
                        var oldcartid = common.readFromStorage('jzeva_cartid');
                        var olduserid = common.readFromStorage('jzeva_uid');

                        var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id=" + oldcartid + "&userid=" + olduserid + "";
                        $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
                                var obj = JSON.parse(results);
                                glbcartdeatil = obj.result;
                            }
                        });
                    }
                    setTimeout(function () {
                        if (oldcartid !== "" || oldcartid !== null)
                            hasitem(oldcartid, olduserid, glbcartdeatil);
                    }, 1000);
                    mtrmklm();
                    displayaddrs(obj['result']['uid']);
                    //  common.msg(0,obj['error']['err_msg']);
                } else if (obj['error']['err_code'] == 1)
                    common.msg(0, obj['error']['err_msg']);
                else if (obj['error']['err_code'] == 2)
                    common.msg(0, obj['error']['err_msg']);
            }
        });
    }
}


function hasitem(oldcartid, olduserid, glbcartdeatil)
{
    var newcartid, hasusrid = [], ccnt = 0, hasoldcartid = [], ocnt = 0;
    $(glbcartdeatil).each(function (r, v) {
        if (v.userid != 0) {
            hasusrid[ccnt] = v;
            ccnt++;
            newcartid = v.cart_id;
        } else {
            hasoldcartid[ocnt] = v;
            ocnt++;
        }
    });
    if (hasusrid == "" || hasusrid == null) {
        updatecartiddetail(oldcartid, olduserid, newcartid);
    } else
    {
        var start = 1, last = hasusrid.length;
        $(hasusrid).each(function (r, v) {
            var prdid = v.product_id;
            var col_car_qty = v.col_car_qty;

            $(hasoldcartid).each(function (m, n) {
                if (prdid == n.product_id && col_car_qty == n.col_car_qty) {
                    var price = parseInt(v.price);
                    var j = parseInt(v.pqty);
                    var l = parseInt(n.pqty);
                    price = price / j;
                    j = j + l;
                    price = price * j;

                    var dat = {};
                    dat['cartid'] = v.cart_id;
                    dat['pid'] = v.product_id;
                    dat['userid'] = v.userid;
                    dat['col_car_qty'] = v.col_car_qty;
                    dat['qty'] = j;
                    dat['price'] = price;
                    dat['RBsize'] = v.size;
                    var URL = APIDOMAIN + "index.php?action=addTocart";
                    var data = dat;
                    var dt = JSON.stringify(data);
                    $.ajax({type: "post", url: URL, data: {dt: dt}, success: function (data) {

                        }
                    });
                    var URL = APIDOMAIN + "index.php?action=removeItemFromCart&col_car_qty=" + col_car_qty + "&pid=" + prdid + "&cartid=" + n.cart_id + "&size=" + n.size;
                    $.ajax({type: 'POST', url: URL, success: function (res) {

                        }
                    });
                }
            });
            if (last == start) {
                updatecartiddetail(oldcartid, olduserid, newcartid);
            }
            start++;
        });
    }
}

function updatecartiddetail(oldcartid, olduserid, newcartid)
{
    if (newcartid == "" || newcartid == null) {
        var URL = APIDOMAIN + "index.php?action=updatecartdata&cartid=" + oldcartid + "&userid=" + olduserid + "&newcartid=" + oldcartid;
    } else {
        var URL = APIDOMAIN + "index.php?action=updatecartdata&cartid=" + oldcartid + "&userid=" + olduserid + "&newcartid=" + newcartid;
    }
    common.removeFromStorage('jzeva_cartid');
    common.addToStorage('jzeva_cartid', newcartid);
    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {

            displaycartdetail();
        }
    });
}


function addrsel(ths)
{
    var id = $(ths).attr('id');
    shipng_id = id;
}

function getuserdetail(inpt)
{
    if ($.isNumeric(inpt)) {
        var URL = APIDOMAIN + "index.php?action=getUserDetailsbyinpt&mobile=" + inpt;
    } else {
        var URL = APIDOMAIN + "index.php?action=getUserDetailsbyinpt&email=" + inpt;
    }
    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
            var obj = JSON.parse(results);

            common.addToStorage('jzeva_uid', obj['results']['0'].user_id);
            common.addToStorage('jzeva_cartid', obj['results']['0'].cart_id);
            common.addToStorage("jzeva_email", obj['results']['0'].email);
            common.addToStorage("jzeva_name", obj['results']['0'].user_name);
            common.addToStorage("jzeva_mob", obj['results']['0'].logmobile);
            lmtmkm();
            displayaddrs(obj['results']['0'].user_id);
        }
    });
}

$('#shpd_bak').click(function () {
    if (bakflag == 1) {
        contnu_enble = 0;
        $('#dlabel').text('Title');
        gndrflg = undefined;
        $('#paswrd1id').addClass('dn');
        $('#paswrd2id').addClass('dn');
        $('#otp_countn').addClass('dn');
        $('.matchIcn1').addClass('dn');
        openThrd();
    } else if (bakflag == 2) {
        var userid = common.readFromStorage('jzeva_uid');
        $('#dlabel').text('Title');
        gndrflg = undefined;
        openfst();
        displayaddrs(userid);
    }
});

$('#log_otp').click(function () {
    if ($.isNumeric(inp_data)) {
        sendnewuserotp();
    } else {
        //mail
    }
});

$('#sub_lototp').click(function () {
    sublogwthotp();
});

function sublogwthotp()
{
    var otp = $('#shpdemail3').val();
    if (otp == "" || otp == null)
        common.msg(0, 'Please Enter OTP');
    if ($.isNumeric(inp_data)) {
        logotpflag = 2;
        checkotp(inp_data, otp);
    }

}

$('#resend_lotp').click(function () {
    sendnewuserotp();
});

$('#bak_oldusrpg').click(function () {
    bmtm();
});

$('#bak_nwursotppg').click(function () {
    bmtm1();
});

$('#bak_logwthotp').click(function () {
    bmtm2();
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




function createuser(name, email, city, addrs)
{
    if ($.isNumeric(inp_data)) {

        var URLreg = APIDOMAIN + "index.php/?action=addnewUser&name=" + name + "&mobile=" + inp_data + "&pass=" + passwrd + "&email=" + email + "&city=" + city + "&gender=" + gndrflg + "&address=" + addrs;
    } else {

        shipngdata['email'] = mail;
        var URLreg = APIDOMAIN + "index.php/?action=addnewUser&name=" + name + "&email=" + email + "&pass=" + passwrd + "&mobile=" + mobile + "&city=" + city + "&gender=" + gndrflg + "&address=" + addrs;
    }

    $.ajax({type: 'POST', url: URLreg, success: function (res) {

            var data1 = JSON.parse(res);
            if (data1['error']['err_code'] == 0)
            {
                var uid = data1['error']['userid'];
                common.addToStorage('jzeva_uid', uid);
                common.addToStorage("jzeva_email", email);
                common.addToStorage("jzeva_name", name);
                if ($.isNumeric(inp_data))
                    common.addToStorage("jzeva_mob", inp_data);
                else
                    common.addToStorage("jzeva_mob", mobile);
            } else if (data1['error']['err_code'] == 1)
                common.msg(0, data1['error']['err_msg']);
        }
    });
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

$('.opt1').click(function () {
    var id = $(this).attr('id');
    id = id.split('_');
    gndrflg = id[1];
});

$('#cntshpngchkout').click(function () {
    var lasturl = $.cookie('jzeva_currurl');
    window.location.href = DOMAIN + "index.php" + lasturl;
});