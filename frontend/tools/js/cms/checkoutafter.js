$(document).ready(function () {

    var URL = APIDOMAIN + "index.php?action=getOrderDetailsByOrdIds&orderid=" + orderid;

    $.ajax({
        url: URL,
        type: "GET",
        datatype: "JSON",
        success: function (results)
        {

            var obj = JSON.parse(results);
            var cartStr = "";

            var dt = obj['result'];

            $(dt).each(function (i, v) {

                var uname = v.uname;
                uname = uname.toLowerCase();
                $('#uname').html('Hi ' + uname);
                $('#ordrID').html(v.oid);
                var orddate = v.orddt;
                var ordd = orddate.split(',').join(' ');
                var ordrdt = ordd.split('|');

                $('#ordate').html(ordrdt[0]);
                $('#addr').html(v.uaddres);
                $('#adcity').html('' + v.ucity + ' ' + v.upin + '');
                var price = v.ppri;

                var catname = v.ccatname;
                var mtlWgDav = 0;
                var bseSize = 0;


                var currentSize = v.size;
                var storedWt = v.pwgt;
                var storedMkCharge = v.mkngchrg;
                if (catname == 'Rings') {
                    bseSize = parseFloat(14);
                    mtlWgDav = 0.05;
                } else if (catname == 'bangles') {
                    bseSize = parseFloat(2.4);
                    mtlWgDav = 7;
                }

                if (isNaN(currentSize))
                {

                    if (catname == 'Rings')
                        currentSize = parseFloat(14);
                    else if (catname == 'bangles')
                        currentSize = parseFloat(2.4);
                    else if (catname !== 'Rings' && catname !== 'bangles') {
                        currentSize = 0;
                    }
                }
                if (catname == 'Rings') {
                    var size = currentSize.split('.');
                    size = size[0];
                } else if (catname == 'bangles') {
                    var size = currentSize;
                }

                var changeInWeight = (currentSize - bseSize) * mtlWgDav;
                var newWeight = (parseFloat(storedWt) + parseFloat(changeInWeight)).toFixed(3);

                var image = v.oimg;
                image = image.split(',');
                image = IMGDOMAIN + image[0];

                cartStr += '<div class="cart_item">';
                cartStr += '<div class="cart_image" style="background: #fff url(\'' + image + '\')no-repeat;background-size: contain;background-position:center; background-color:#FFF;"></div>';
                cartStr += '<div class="cart_name">' + v.pname + '</div>';
                cartStr += '<div class="cart_desc  fLeft" id="nwwt">Gold: ' + newWeight + ' gms | Diamond : ' + v.dmdcarat + ' Ct | Quality : "' + v.oqual + '"';
                if (currentSize !== '0.0')
                    cartStr += '<div class="cart_desc  fLeft">Purity : ' + v.ocarat + ' | Size : ' + size + '</div>';
                else
                    cartStr += '<div class="cart_desc  fLeft">Purity : ' + v.ocarat + '</div>';
                cartStr += '<div class="cart_price cartRup15 fLeft"><span class="price_gen">' + indianMoney(parseInt(price)) + '</span></div>';
                cartStr += ' </div>';
                cartStr += ' </div>';


            });


            $('#cartdet').html(cartStr);

        }
    });

});

