$(document).ready(function () { 
  storeorderdata(); 
});

  function storeorderdata()
  {
     
   var data = [], ordobj = {}, totprz=0, wht;
   var userid = common.readFromStorage('jzeva_uid');
   var shipng_id=common.readFromStorage('jzeva_shpid');
   var URL = APIDOMAIN + "index.php?action=getcartdetail&cart_id=" + orderid+"";
      $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
	      var obj = JSON.parse(results);

	      $(obj.result).each(function (r, v) {

		  if (v.ccatname !== null) {
		      wht = getweight(v.size, v.ccatname, v.metal_weight);
		  } else {
		      wht = v.metal_weight;
		  }

		  totprz=totprz+parseInt(v.price);
		  var ordrdata = {};
		  if (userid !== null || userid !== 0) {
		      ordrdata['userid'] = userid;
		  } else {
		      ordrdata['userid'] = v.userid;
		  }
		  ordrdata['orderid'] = v.cart_id;
		  ordrdata['pid'] = v.product_id;
		  ordrdata['col_car_qty'] = v.col_car_qty;
		  ordrdata['pqty'] = v.pqty;
		  ordrdata['prodpri'] = v.price;
		  ordrdata['order_status'] = "";
		  ordrdata['updatedby'] = "";
		  ordrdata['payment'] = "";
		  ordrdata['payment_type'] = "";
		  ordrdata['shipping_id'] = shipng_id;
		  ordrdata['size'] = v.size;
		  ordrdata['weight'] = wht;
		  ordrdata['dmdcarat'] = v.dmdcarat;
		  data[r] = ordrdata;
		  r++;
	      });
		var totwrd=convert_number(totprz); 
		ordobj['totprz'] =totprz;
		ordobj['totprzwrd'] =totwrd;
		ordobj['data'] = data;

		setordrdata(ordobj); 
	  }
      });  
  }


  function setordrdata(ordobj)
  {
      var URL = APIDOMAIN + "index.php?action=addOrdersdetail";
      var dt = JSON.stringify(ordobj);
      $.ajax({
	  type: "post",
	  url: URL,
	  data: {dt: dt},
	  success: function (data) {

	      common.msg(1, 'Your Order Placed successfully');
	      var URL = APIDOMAIN + "index.php?action=removCrtItemaftrcheckot&cartid=" + orderid;
	      $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
		       common.removeFromStorage('jzeva_cartid');
		       common.removeFromStorage('jzeva_shpid');
		       common.removeFromStorage('jzeva_buyid');
		       getorderdata();
		  }
	      });

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
	  else if (catName !== 'Rings' && catName !== 'Bangles') {
	      currentSize = 0;
	  }
      }


      var changeInWeight = (currentSize - bseSize) * mtlWgDav;
      var newWeight = parseFloat(storedWt) + parseFloat(changeInWeight);
      newWeight=newWeight.toFixed(3);

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
      var tn= Math.floor(number / 10);
      var one=Math.floor(number % 10);
      var res = "";

      if (Gn>0)
      {
	  res += (convert_number(Gn) + " Crore");
      }
      if (kn>0)
      {
	      res += (((res=="") ? "" : " ") +
	      convert_number(kn) + " Lakhs");
      }
      if (Hn>0)
      {
	  res += (((res=="") ? "" : " ") +
	      convert_number(Hn) + " Thousand");
      }

      if (Dn)
      {
	  res += (((res=="") ? "" : " ") +
	      convert_number(Dn) + " Hundred");
      }


      var ones = Array("", "One", "Two", "Three", "Four", "Five", "Six","Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen","Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen","Nineteen");
      var tens = Array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty","Seventy", "Eighty", "Ninety");

      if (tn>0 || one>0)
      {
	  if (!(res==""))
	  {
	      res += " And ";
	  }
	  if (tn < 2)
	  {
	      res += ones[tn * 10 + one];
	  }
	  else
	  {

	      res += tens[tn];
	      if (one>0)
	      {
		  res += ("-" + ones[one]);
	      }
	  }
      }

      if (res=="")
      {
	  res = "zero";
      }
      return res;
  }
	    
 function getorderdata()
 {
    var URL = APIDOMAIN + "index.php?action=getOrderDetailsByOrdIds&orderid=" + orderid;

    $.ajax({ url: URL, type: "GET", datatype: "JSON", success: function (results) {

            var obj = JSON.parse(results);
            var cartStr = "", gndr;
	    
            var dt = obj['result'];

            $(dt).each(function (i, v) {

                var uname = v.uname;
                uname = uname.toLowerCase();  
		if(v.gender == 1)
		  gndr="Ms";
		else if(v.gender == 2)
		  gndr="Mr";
		else if(v.gender == 3)
		  gndr="Mrs";
                $('#uname').html(gndr +' '+ uname); 
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
 }
 
 $('#cuntshpngchkaftr').click(function(){
      var lasturl=$.cookie('jzeva_currurl'); 
      window.location.href=DOMAIN +"index.php"+lasturl; 
 });