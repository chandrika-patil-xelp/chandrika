$(document).ready(function () { 
  storeorderdata(); 
});

  function storeorderdata()
  {
     
   var data = [], ordobj = {}, totprz=0, wht;
   var userid = common.readFromStorage('jzeva_uid');
   var shipng_id=common.readFromStorage('jzeva_shpid');
   var cartid = common.readFromStorage('jzeva_cartid');
   var buyid=common.readFromStorage('jzeva_buyid');
   if(cartid == orderid || buyid == orderid)
   {
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
   else
   {
     getorderdata();
   }
  }


  function setordrdata(ordobj)
  {
      var userid = common.readFromStorage('jzeva_uid');
      var buyid=common.readFromStorage('jzeva_buyid');
      var URL = APIDOMAIN + "index.php?action=addOrdersdetail";
      var dt = JSON.stringify(ordobj);
      $.ajax({
	  type: "post",
	  url: URL,
	  data: {dt: dt},
	  success: function (data) {
	    var reslt=JSON.parse(data);
	    if(reslt['error']['err_code'] == 0)
	    {
	      common.msg(1, 'Your Order Placed successfully');
	      if(buyid == orderid)
	      {
		var URL = APIDOMAIN + "index.php?action=removCrtItemaftrcheckot&cartid=" + buyid +"&userid=NULL";
		 common.removeFromStorage('jzeva_buyid');
	      }
	      else
	      {
		var URL = APIDOMAIN + "index.php?action=removCrtItemaftrcheckot&cartid=" + orderid +"&userid="+userid;
		common.removeFromStorage('jzeva_cartid');
	      } 
	      $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
		       common.removeFromStorage('jzeva_buyid');
		       common.removeFromStorage('jzeva_shpid'); 
		       getorderdata();
		  }
	      });
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
    var URL = APIDOMAIN + "index.php?action=OrderDetailsbyordid&orderid=" + orderid;

    $.ajax({ url: URL, type: "GET", datatype: "JSON", success: function (results) {

            var obj = JSON.parse(results);
     
	    var totprdcnt=0;
            var dt = obj['result'];
 
	    var orddate = obj['result'][0].orddt;
	    var ordd = orddate.split(',').join(' ');
	    var ordrdt = ordd.split('|');   
	    
	   
            $(dt).each(function (i, v) {
		
                var uname = v.uname;
                uname = uname.toLowerCase();  
		totprdcnt+=parseInt(v.pqty);
		var gndr=v.gender,gndrstr;
		if(gndr == 1)
		  gndrstr="Ms";
		else if(gndr == 2)
		  gndrstr="Mr";
		else if(gndr == 3)
		  gndrstr="Mrs";
		else
		  gndrstr="Dear";
                $('#uname').html(gndrstr+' '+ uname); 
                $('#ordrID').html(v.oid);
           

                $('#ordate').html(ordrdt[0]);
		$('#ordtime').html(ordrdt[1]);
                $('#addr').html(v.uaddres);
                $('#adcity').html('' + v.ucity + ' ' + v.upin + '');
                $('#trnsctnid').html(v.transactionid);
		$('#ordamnt').html(obj.totalprice);
		$('#trnstype').html(v.transactiontype);
            }); 
	    $('#ordtotprds').html(totprdcnt);
           
        }
    });
 }
 
 $('#cuntshpngchkaftr').click(function(){
      var lasturl=$.cookie('jzeva_currurl'); 
      window.location.href=DOMAIN +"index.php"+lasturl; 
 });