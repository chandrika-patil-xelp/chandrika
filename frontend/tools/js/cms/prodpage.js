
var data = new Array();
var glbquality;
var glbcolor;
var glbcarat;
var makchrg = 0;


var storedWt;
var storedMkCharge = 0;
var storedDmdCarat = 0;
var newWeight;

var metalwgt = 0;
var dmdValue = metalValue = soliValue = gemsValue = uncutValue = basicValue = 0;
var gIndex = 0;
var total = 0;
var metalprc = 0;
var wshlstflag = 0;

var dmdsoli = "";
var jweltype = "";

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
function IND_money_format(money)
{
    var m = '';
    money = money.toString().split("").reverse();
    var len = money.length;
    for (var i = 0; i < len; i++)
    {
        if ((i == 3 || (i > 3 && (i - 1) % 2 == 0)) && i !== len)
        {
            m += ',';
        }
        m += money[i];
    }

    return m.split("").reverse().join("");
}


var pid, psize;
var arrdata = {};
var dt;
function getarraydata() {
 
    arrdata['pid']=pid;

    if (dt['dimond']['results'] !== null) {
      //var quality =$('#qual').attr('qual_id');
        var xx = $('#qual').attr('qual_id').split('_');
           var xx = $('#mqual').attr('qual_id').split('_');
        var quality = xx[xx.length - 1];
    }
    if (dt['metalColor']['results'] !== null) {
        var yy = $('#clr').attr('clr_id').split('_');
        var yy = $('#mclr').attr('clr_id').split('_');
        var color = yy[yy.length - 1];
    }
    if (dt['metalPurity']['results'] !== null) {
        var zz = $('#carat').attr('carat_id').split('_');
        var zz = $('#mobcarat').attr('carat_id').split('_');
        var metal = zz[zz.length - 1];
    }

    var sz = parseFloat("0.00");
    if (catname == 'Rings') {
        if (sz == " None")
            sz = parseFloat(14);
        sz = $('.ringCircle').text();
    } else if (catname == 'Bangles') {
        if (sz == " None")
            sz = parseFloat(2.4);
        sz = $('.ringCircleB').text();
    }
    arrdata['color']=color;
    arrdata['quality']=quality;
    arrdata['metal']=metal;
    arrdata['sz']=sz;
   
}

$('#add_to_cart').on('click', function () {

    getarraydata();
    var size=$('#size').text();
    if(size == 'Select')
       common.msg(0,'Please select size');
    else
    {
      $(this).addClass('pointNone');
      var userid, cartdata = {};
      cartdata['pid'] = arrdata['pid'];
      cartdata['price'] =totalNewPrice;
      cartdata['qty'] = 1;

      if(arrdata['quality']=== null || arrdata['quality']=== undefined){
          arrdata['quality']= 0;

      }
      var chr = "" + arrdata['color'] + "|@|" + arrdata['metal'] + "|@|" + arrdata['quality'];

      cartdata['col_car_qty'] = chr;
      cartdata['RBsize'] = arrdata['sz'];

      var userid = common.readFromStorage('jzeva_uid');
      var cartid = common.readFromStorage('jzeva_cartid');

      if (userid == "" || userid == null) {
	  userid = common.readFromStorage('jzeva_uid');
	  if (cartid == "" || cartid == null) {
	    cartdata['cartid'] = '';
	  }
	  else{
	     cartdata['cartid'] = cartid;
	  }
      } else {
	  cartdata['userid'] = userid;
	  cartdata['cartid'] = cartid;
      }

        var flag = 0;
        if (gblcartdata == null || gblcartdata == "") {
	    flag = 1;
	}
	else
	{
	  $(gblcartdata).each(function (r, v) {
             
            if ((cartdata.col_car_qty == v.col_car_qty && cartdata.pid == v.product_id) && parseFloat(cartdata.RBsize) == parseFloat(v.size)) {

		  cartdata['qty'] = parseInt(v.pqty) + 1;
		  cartdata['price'] = parseInt(cartdata['price']) * cartdata.qty;
		  flag = 2;
            } else if ((cartdata.col_car_qty == v.col_car_qty && cartdata.pid == v.product_id) && (parseFloat(cartdata.RBsize) == parseFloat(v.size))) {
		  cartdata['qty'] = parseInt(v.pqty) + 1;
		  cartdata['price'] = parseInt(cartdata['price']) * cartdata.qty;
		  flag = 2;
            }
	  });
	}

    setTimeout(function(){
	if( flag == 2)
	{
	    $('#rmvpoptxt').html('This Product is already in your cart do want to add one more');
	    cartpopUp();
	    $('#cYes').unbind();
	    $('#cYes').click(function () {
	        storecartdata(cartdata, 1);
	       cartpopUpClose();
	       $('#add_to_cart').removeClass('pointNone');

	        var wd = $('.rota').outerWidth();
                var ht = $('.rota').outerHeight();
                var cart = $('.cartIcon');
                var imgtodrag;
                $('.rota .imgHolder').each(function (i) {
                    if (!$(this).hasClass("dn")) {
                        imgtodrag = $(this);
                    }
                });
                if (imgtodrag) {
                    var imgclone = imgtodrag.clone()
                            .offset({
                                top: imgtodrag.offset().top,
                                left: imgtodrag.offset().left
                            })
                            .css({
                                'opacity': '0.7',
                                'position': 'absolute',
                                'height': ht,
                                'width': wd,
                                'z-index': '900',
                                'display': 'block'
                            })
                            .appendTo($('body'))
                            .velocity({top: cart.offset().top + 20, left: cart.offset().left + 30, width: 0, height: 0, opacity: [0.1]}, {duration: 1000, easing: 'easeInOutExpo',
                                complete: function () {
                                    $(this).detach();
                                }});
                }

	    });
	    $('#cNo').click(function () {
		cartpopUpClose();
		$('#add_to_cart').removeClass('pointNone');
		$('#cNo').unbind();
	    });
	}
	else
	{
	    storecartdata(cartdata, 1);
	    $('#add_to_cart').removeClass('pointNone');
	     var wd = $('.rota').outerWidth();
                var ht = $('.rota').outerHeight();
                var cart = $('.cartIcon');
                var imgtodrag;
                $('.rota .imgHolder').each(function (i) {
                    if (!$(this).hasClass("dn")) {
                        imgtodrag = $(this);
                    }
                });
                if (imgtodrag) {
                    var imgclone = imgtodrag.clone()
                            .offset({
                                top: imgtodrag.offset().top,
                                left: imgtodrag.offset().left
                            })
                            .css({
                                'opacity': '0.7',
                                'position': 'absolute',
                                'height': ht,
                                'width': wd,
                                'z-index': '900',
                                'display': 'block'
                            })
                            .appendTo($('body'))
                            .velocity({top: cart.offset().top + 20, left: cart.offset().left + 30, width: 0, height: 0, opacity: [0.1]}, {duration: 1000, easing: 'easeInOutExpo',
                                complete: function () {
                                    $(this).detach();
                                }});
                }
	}
    },500);
    }
});


$('#add_to_cart_mob').on('click', function () {

    getarraydata();
    var size=$('#size').text();
    if(size == 'Select')
       common.msg(0,'Please select size');
    else
    {
      $(this).addClass('pointNone');
      var userid, cartdata = {};
      cartdata['pid'] = arrdata['pid'];
      cartdata['price'] =totalNewPrice;
      cartdata['qty'] = 1;

      if(arrdata['quality']=== null || arrdata['quality']=== undefined){
          arrdata['quality']= 0;

      }
      var chr = "" + arrdata['color'] + "|@|" + arrdata['metal'] + "|@|" + arrdata['quality'];

      cartdata['col_car_qty'] = chr;
      cartdata['RBsize'] = arrdata['sz'];

      var userid = common.readFromStorage('jzeva_uid');
      var cartid = common.readFromStorage('jzeva_cartid');

      if (userid == "" || userid == null) {
	  userid = common.readFromStorage('jzeva_uid');
	  if (cartid == "" || cartid == null) {
	    cartdata['cartid'] = '';
	  }
	  else{
	     cartdata['cartid'] = cartid;
	  }
      } else {
	  cartdata['userid'] = userid;
	  cartdata['cartid'] = cartid;
      }

        var flag = 0;
        if (gblcartdata == null || gblcartdata == "") {
	    flag = 1;
	}
	else
	{
	  $(gblcartdata).each(function (r, v) {

            if ((cartdata.col_car_qty == v.col_car_qty && cartdata.pid == v.product_id) && parseFloat(cartdata.RBsize) == parseFloat(v.size)) {

		  cartdata['qty'] = parseInt(v.pqty) + 1;
		  cartdata['price'] = parseInt(cartdata['price']) * cartdata.qty;
		  flag = 2;
            } else if ((cartdata.col_car_qty == v.col_car_qty && cartdata.pid == v.product_id) && (parseFloat(cartdata.RBsize) == parseFloat(v.size))) {
		  cartdata['qty'] = parseInt(v.pqty) + 1;
		  cartdata['price'] = parseInt(cartdata['price']) * cartdata.qty;
		  flag = 2;
            }
	  });
	}

    setTimeout(function(){
	if( flag == 2)
	{
	    $('#rmvpoptxt').html('This Product is already in your cart do want to add one more');
	    cartpopUp();
	    $('#cYes').unbind();
	    $('#cYes').click(function () {
	        storecartdata(cartdata, 1);
	       cartpopUpClose();
	       $('#add_to_cart_mob').removeClass('pointNone');

	        var wd = $('.rota').outerWidth();
                var ht = $('.rota').outerHeight();
                var cart = $('.cartIcon');
                var imgtodrag;
                $('.rota .imgHolder').each(function (i) {
                    if (!$(this).hasClass("dn")) {
                        imgtodrag = $(this);
                    }
                });
                if (imgtodrag) {
                    var imgclone = imgtodrag.clone()
                            .offset({
                                top: imgtodrag.offset().top,
                                left: imgtodrag.offset().left
                            })
                            .css({
                                'opacity': '0.7',
                                'position': 'absolute',
                                'height': ht,
                                'width': wd,
                                'z-index': '900',
                                'display': 'block'
                            })
                            .appendTo($('body'))
                            .velocity({top: cart.offset().top + 20, left: cart.offset().left + 30, width: 0, height: 0, opacity: [0.1]}, {duration: 1000, easing: 'easeInOutExpo',
                                complete: function () {
                                    $(this).detach();
                                }});
                }

	    });
	    $('#cNo').click(function () {
		cartpopUpClose();
		$('#add_to_cart_mob').removeClass('pointNone');
		$('#cNo').unbind();
	    });
	}
	else
	{
	    storecartdata(cartdata, 1);
	    $('#add_to_cart_mob').removeClass('pointNone');
	     var wd = $('.rota').outerWidth();
                var ht = $('.rota').outerHeight();
                var cart = $('.cartIcon');
                var imgtodrag;
                $('.rota .imgHolder').each(function (i) {
                    if (!$(this).hasClass("dn")) {
                        imgtodrag = $(this);
                    }
                });
                if (imgtodrag) {
                    var imgclone = imgtodrag.clone()
                            .offset({
                                top: imgtodrag.offset().top,
                                left: imgtodrag.offset().left
                            })
                            .css({
                                'opacity': '0.7',
                                'position': 'absolute',
                                'height': ht,
                                'width': wd,
                                'z-index': '900',
                                'display': 'block'
                            })
                            .appendTo($('body'))
                            .velocity({top: cart.offset().top + 20, left: cart.offset().left + 30, width: 0, height: 0, opacity: [0.1]}, {duration: 1000, easing: 'easeInOutExpo',
                                complete: function () {
                                    $(this).detach();
                                }});
                }
	}
    },500);
    }
});

$('#buynow').on('click',function(){

    var size=$('#size').text();
    if(size == 'Select')
       common.msg(0,'Please select size');
    else
    {
      getarraydata();
      var userid, buydata = {};
      buydata['pid'] = arrdata['pid'];
      buydata['price'] = totalNewPrice;
      buydata['qty'] = 1;
      var chr ="" + arrdata['color'] + "|@|" + arrdata['metal'] + "|@|" + arrdata['quality'];

      buydata['col_car_qty'] = chr;
      buydata['RBsize'] =arrdata['sz'];
      buydata['buyid'] = '';
      buydata['cartid'] = '';
      buydata['userid'] = '';
      var URL = APIDOMAIN + "index.php?action=addTocart";

      var data = buydata;
      var dt = JSON.stringify(data);
     $.ajax({
	  type: "post",
	  url: URL,
	  data: {dt: dt},
	  success: function (results) {
     
	    var data=JSON.parse(results);
	    var cururl = window.location.search;
	    var date = new Date();
	    var minutes = 40;
	    date.setTime(date.getTime() + (minutes * 60 * 1000));
	    $.cookie("jzeva_currurl", null);
	    $.cookie("jzeva_currurl", cururl, {expires: date});
	    common.addToStorage('jzeva_buyid', data.cartid);
	    userid=common.readFromStorage('jzeva_uid');
	    if(userid == null || userid == undefined)
	    {
	      window.location.href=DOMAIN + 'index.php?action=checkoutGuest&actn=buy';
	    }
	    else
	    {
	       window.location.assign(DOMAIN + 'index.php?action=checkOutNew&actn=buy');
	    }

	  }
      });
    }

});

   jQuery('#buynow_mob').on('click',function(){
    var size=$('#size').text();
    if(size == 'Select')
       common.msg(0,'Please select size');
    else
    {
      getarraydata();
      var userid, buydata = {};
      buydata['pid'] = arrdata['pid'];
      buydata['price'] = totalNewPrice;
      buydata['qty'] = 1;
      var chr ="" + arrdata['color'] + "|@|" + arrdata['metal'] + "|@|" + arrdata['quality'];

      buydata['col_car_qty'] = chr;
      buydata['RBsize'] =arrdata['sz'];
      buydata['buyid'] = '';
      buydata['cartid'] = '';
      buydata['userid'] = '';
      var URL = APIDOMAIN + "index.php?action=addTocart";

      var data = buydata;
      var dt = JSON.stringify(data);
      $.ajax({
	  type: "post",
	  url: URL,
	  data: {dt: dt},
	  success: function (results) {

	    var data=JSON.parse(results);
	    var cururl = window.location.search;
	    var date = new Date();
	    var minutes = 40;
	    date.setTime(date.getTime() + (minutes * 60 * 1000));
	    $.cookie("jzeva_currurl", null);
	    $.cookie("jzeva_currurl", cururl, {expires: date});
	    common.addToStorage('jzeva_buyid', data.cartid);
	    userid=common.readFromStorage('jzeva_uid');
	    if(userid == null || userid == undefined)
	    {
	      window.location.href=DOMAIN + 'index.php?action=checkoutGuest&actn=buy';
	    }
	    else
	    {
	       window.location.assign(DOMAIN + 'index.php?action=checkOutNew&actn=buy');
	    }

	  }
      });
    }

});

function makeAwish(th, e)
{
  var pid=$(th).attr('id').split('_');
  var prz=$(th).attr('data-price');
  var comb= $(th).attr('data-comb');
  var size=$(th).attr('data-size');

  e.stopPropagation();
    //e.preventDefault();
  if ($(th).hasClass('beat')) {
      // $(th).removeClass('beat');
      //Remove from wishlist
      common.msg(0,'This product is already in your wishlist');
  }
  else
  {
      var userid = common.readFromStorage('jzeva_uid');
      if (userid == undefined || userid == null)
      {
	  openPopUp();
      }
      else
      {
	   $(th).addClass('beat');
	   var userid, wishdata = {};
	   wishdata['pid'] = pid[1];
	   wishdata['col_car_qty'] = comb;
	   wishdata['price'] = prz;
	   wishdata['user_id'] = userid;
	   wishdata['wish_id'] = '';
	   wishdata['size'] = size;
	   var URL = APIDOMAIN + "index.php?action=addtowishlist";
	   var data = wishdata;
	   var dt = JSON.stringify(data);
	   $.ajax({type: "post", url: URL, data: {dt: dt}, success: function (results) {
		  var res=JSON.parse(results);
		  if(res['error']['err_code'] == 0){
		    wshlstflag = 1;
                    common.msg(1, 'This Product Added To Your Wishlist Successfully');
                    $('.soc_wish2').addClass("beat");
		  }
		  else if(res['error']['err_code'] == 2){
		     common.msg(0,res['error']['err_msg']);
		  }
                  else{
		    common.msg(0,res['error']['err_msg']);
		  }
	       }
	   });
      }
    }
 }

$(document).ready(function () {    
    $('html, body').animate({scrollTop: '0px'}, 300);
    $('.prodCarousel').addClass('dn');
    showwishbtn();

    var comb = GetURLParameter('comb');
    psize = GetURLParameter('sz');
    if (comb !== undefined) {
        comb = comb.split('|@|');
        var p_qlty = comb[2];
        var p_purity = comb[1];
        var p_color = comb[0];
    }


    var URL = APIDOMAIN + "index.php?action=getProductById&pid=" + pid;


    $.ajax({
        type: 'POST',
        url: URL,
        success: function (res) {

            data = JSON.parse(res);
            
            dt = data['results']; 
          
            var basic = dt['basicDetails'];
            var catAttr = dt['catAttr'];
            var vendor = dt['vendor'];
            var metalPurity = dt['metalPurity'];
            var metalColor = dt['metalColor'];
            var solitaire = dt['solitaire'];
            var diamonds = dt['dimond'];
            var uncut = dt['uncut'];
            var catid=basic['sngcatid'];
            var catname=basic['sngcatname'];

            if (dt['catAttr']['results'][1]['name'] == 'Pendants') {
                $('#Ifpendant').html('Chain Is Not Available With This Pendant');
            }
            var catgry = dt['catAttr']['results'][1]['name'];
            catgry = catgry.slice(0, -1);

            $('#custm').html('Customise Your ' + catgry);
            $('#Mob_custm').html('Customise Your ' + catgry);
            storedWt = parseFloat(dt['basicDetails']['mtlWgt']);
            storedMkCharge = parseFloat(dt['basicDetails']['mkngCrg']);

            metalwgt = dt['basicDetails']['mtlWgt'];
            makchrg = dt['basicDetails']['mkngCrg'];
            //  metalprcprgm =  dt['metalPurity']['results']['prc'];
            var gemstone = dt['gamestone'];
            var images = dt['images'];
	    var othrimgs=dt['othimgs'];
   
            getcatsize(catid,catname, metalwgt);
            if (data['error']['err_code'] == '0')
            {
                var othrimgstr = "";
                var dn = '';
                   
                $(images['images']).each(function (i, v) {

                    var vdef = IMGDOMAIN + dt['basicDetails']['default_image'];

                    if (vdef == v) {
                        dn = '';
                    } else if (dt['basicDetails']['default_image'] == null) {
                        dn = '';
                    } else {
                        dn = 'dn';
                    }
                    imgstr = '<div class="imgHolder ' + dn + '" style="background:  url(\'' + v + '\')no-repeat;background-size:contain;background-position:center"></div>';
                    $('#img-view').append(imgstr);


                });

		if(othrimgs['images'] !== null)
		{
		$('.prodCarousel').removeClass('dn');
		var  othrimgstr = "";
		othrimgstr +='<div class="prevArrow" onclick="movePrImg(true)"></div>';
                othrimgstr +=' <div class="nextArrow" onclick="movePrImg(false)"></div>';
		$(othrimgs['images']).each(function (i, v) {

                    othrimgstr += '<div class="carouselBox" style="background:  url(\'' + v + '\')no-repeat ; background-position:center ; background-size:contain" id="'+v+'"></div>'; 

                });
		 othrimgstr +=' </div>';
		 $('.prodCarousel').append(othrimgstr);
		}

                $(basic).each(function (i, vl) {

                    var proname = vl.prdNm;
                    $('#vpro').text(vl.prdCod);
                    $('#proname').text(vl.prdNm);
                    $('#descrp').text(vl.productDescription);
                    $('#Mdescrp').text(vl.productDescription);
                    var metalwght = vl.mtlWgt;

                    var makingchrg = vl.mkngCrg;

                    var proccost = vl.procmtCst;


                    getbasicprice(makingchrg, metalwght);

                    if (basic.jewelleryType == 1) {
                    //    jweltype = "Gold";
                        $('#stn').html('Gold');
                    } else if (basic.jewelleryType == 2) {
                     //   jweltype = "Plain Gold";
                        $('#stn').html('Plain-Gold');
                    } else if (basic.jewelleryType == 3) {
                        jweltype = "Platinum";
                        $('#stn').html('Platinum');
                    }

                    var dmdlowp = vl.dmdlowp;
                    var dmdhighp = vl.dmdhighp;
                    var caratlowp = vl.caratlowp;
                    var carathighp = vl.carathighp;


                    var lstr = "";
                    lstr += '<span class="semibold">' + vl.leadTime + ' Days or less</span>';
                    $('#leadtime').append(lstr);

                    var bstr = "";

//                    bstr+= '<div class="para fLeft">The <span class="semibold">'+vl.prdNm+'</span> is casted in <span class="semibold">'+vl.mtlWgt+'</span> grams of gold set with brilliant cut <span class="semibold">36</span> Round Diamonds (Approx. 0.33 Carat) and <span class="semibold">2</span> Carats of Ruby. </div>';

//                    bstr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span> Gold </span></span><span class="fRight" id="newWt"><span> ' + metalwght + '  <span class="fRight">gms</span></span></span></div>';
//                    bstr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span> Certification </span></span><span class="fRight fmSansR" ><span> ' + vl.crtficte + '</span> </span></div>';


                    var type = 0;
                    if (basic.hasSol == 1) {
                        
                        type = 1;
                    }
                    if (basic.hasDmd == 1) {
                        type = 2;
                    }
                    if (basic.hasSol == 1 && basic.hasDmd == 1) {

                        type = 3;
                    }
                    if (basic.hasDmd == 1 && basic.hasUnct == 1) {
                        type = 4;
                    }
                    if (basic.hasGem == 1) {

                        if (gemstone.count == 1) {

                            type = 5
                        }
                        if (gemstone.count > 1) {

                            type = 6;
                        }
                    }
                    if (basic.hasDmd == 1 && basic.hasGem == 1) {
                        if (gemstone.count == 1) {
                            // var gemstn = gemstone.results[0].gemNm;
                            type = 7;
                        }
                        if (gemstone.count > 1) {

                            type = 8;
                        }

                    }
                    var Nstr = "";

                    switch (type) {

                        case 1:
                        {

                            Nstr += '<span>Solitaire</span>';
                             jweltype = "Diamond";
                            bstr += '<div class="para fLeft">The <span class="semibold">' + vl.prdNm + '</span>';
			    if(catname == 'Earrings')
			      bstr += ' are ';
			    else
			      bstr += ' is ';
                           bstr += ' cast in <span class="semibold mobWgt" >' + vl.mtlWgt + '</span> <span class="semibold">grams</span> of gold set with <span class="semibold">' + dt['solitaire']['results'][0].nofs + '</span> brilliant cut <span class="semibold">' + dt['solitaire']['results'][0].shape + '</span> Solitaire (Approx. <span class="semibold">' + dt['solitaire']['results'][0].carat + ' Carat</span>) and <span class="semibold"> '+dt['solitaire']['results'][0].clrty+' </span> quality <span class="semibold"> '+dt['solitaire']['results'][0].colr+' </span> color certified by <span class="semibold">' + dt['basicDetails'].crtficte + '</span></div>';

			  //  bstr += 'cast in <span class="semibold" id="newWt">' + vl.mtlWgt + '</span> <span class="semibold">grams </span>of gold set with <span class="semibold">' + data['results']['solitaire']['results'][0].nofs + '</span> brilliant cut  <span class="semibold">' + dt['solitaire']['results'][0].shape + '</span> Solitaire (Approx. <span class="semibold">' + dt['solitaire']['results'][0].carat + ' Carat</span>) certified by <span class="semibold">' + dt['basicDetails'].crtficte + '</span> </div>';
                            break;
                        }
                        case 2:
                        {
                            Nstr += '<span>Diamond</span>';
                            jweltype = "Diamond";
                            bstr += '<div class="para fLeft">The <span class="semibold">' + vl.prdNm + '</span>';
			    if(catname == 'Earrings')
			      bstr += ' are ';
			    else
			      bstr += ' is ';
			    bstr += ' cast in <span class="semibold mobWgt" id="newWt">' + vl.mtlWgt + '</span> <span class="semibold">grams</span> of gold set with <span class="semibold">' + dt['dimond']['results'][0].totNo + '</span> brilliant cut <span class="semibold">' + dt['dimond']['results'][0].shape + '</span> Diamonds (Approx. <span class="semibold">' + dt['dimond']['results'][0].crat + ' Carat</span>) certified by <span class="semibold">' + dt['basicDetails'].crtficte + '</span></div>';
                            break;
                        }
                        case 3:
                        {
                            Nstr += '<span>Solitaire</span>';
                            jweltype = "Diamond";

                            bstr += '<div class="para fLeft">The <span class="semibold">' + vl.prdNm + '</span>';
			    if(catname == 'Earrings')
			      bstr += ' are ';
			    else
			      bstr += ' is ';
			    bstr += 'cast in <span class="semibold mobWgt" id="newWt">' + vl.mtlWgt + '</span> <span class="semibold">grams</span> of gold set with <span class="semibold">' + dt['dimond']['results'][0].totNo + '</span> brilliant cut <span class="semibold">' + dt['dimond']['results'][0].shape + '</span> Diamonds (Approx. <span class="semibold">' + dt['dimond']['results'][0].crat + ' Carat</span>)  and <span class="semibold">'+dt['solitaire']['results'][0].nofs +'</span>';
			  if(dt['solitaire'].count > 1)
			    bstr += ' Solitaires of <span class="semibold">' + dt['solitaire']['results'][0].carat + ' Carats</span> ';
			  else
			    bstr += ' Solitaire of <span class="semibold">' + dt['solitaire']['results'][0].carat + ' Carat</span> ';
			  bstr += ' and <span class="semibold">'+ dt['solitaire']['results'][0].clrty +'</span> quality and <span class="semibold">' + dt['solitaire']['results'][0].colr + '</span> color certified by <span class="semibold">' + dt['basicDetails'].crtficte + '</span></div>';
                            break;
                        }
                        case 4:
                        {
                            Nstr += '<span>Diamond</span>';
                            jweltype = "Diamond";
                            break;
                        }
                        case 5:
                        {
                            var gemstn = gemstone.results[0].gemNm;
                            Nstr += '<span> ' + gemstn + ' /span>';
                            jweltype = "Diamond";

                            break;
                        }
                        case 6:
                        {
                            Nstr += '<span> Gemstones </span>';
                            jweltype = "Diamond";
                            break;
                        }
                        case 7:
                        {
                            gemstn = gemstone.results[0].gemNm;
                            Nstr += '<span>Diamond</span><span>' + gemstn + '</span>';
                            jweltype = "Diamond";
                            bstr += '<div class="para fLeft">The <span class="semibold">' + vl.prdNm + '</span>';
			    if(catname == 'Earrings')
			      bstr += ' are ';
			    else
			      bstr += ' is ';
			    bstr += 'cast in <span class="semibold mobWgt" id="newWt">' + vl.mtlWgt + '</span> <span class="semibold">grams</span> of gold set with <span class="semibold">' + dt['dimond']['results'][0].totNo + '</span> brilliant cut <span class="semibold">' + dt['dimond']['results'][0].shape + '</span> Diamonds (Approx. <span class="semibold">' + dt['dimond']['results'][0].crat + ' Carat</span>) certified by <span class="semibold">' + dt['basicDetails'].crtficte + '</span> and  <span class="semibold">' + dt['gamestone']['results'][0].crat + ' Carat</span> ' + dt['gamestone']['results'][0].gemNm + ' </div>';

                            break;
                        }

                        case 8:
                        {
                            Nstr += '<span>Diamond</span><span>Gemstones</span>';
                            jweltype = "Diamond";
                            bstr += '<div class="para fLeft">The <span class="semibold">' + vl.prdNm + '</span> ';
			    if(catname == 'Earrings')
			      bstr += ' are ';
			    else
			      bstr += ' is ';
			    bstr += 'cast in <span class="semibold mobWgt"  id="newWt" >' + vl.mtlWgt + ' </span><span class="semibold">grams</span> of gold set with <span class="semibold">' + dt['dimond']['results'][0].totNo + '</span> brilliant cut <span class="semibold">' + dt['dimond']['results'][0].shape + '</span> Diamonds (Approx. <span class="semibold">' + dt['dimond']['results'][0].crat + ' Carat</span>) certified by <span class="semibold">' + dt['basicDetails'].crtficte + '</span>, <span class="semibold">' + dt['gamestone']['results'][0].crat + ' Carat</span> ' + dt['gamestone']['results'][0].gemNm + ' and  <span class="semibold">' + dt['gamestone']['results'][1].crat + ' Carat</span> ' + dt['gamestone']['results'][1].gemNm + '  </div>';

                            break;
                        }

                    }
                    $('#stn').append(Nstr);
                    $('#shortdesc').html(bstr);
                    $('#Mshortdesc').html(bstr);


                    if (basic.hasSol == 1)
                    {
                        //  $('#stn').html('Solitaire');
                        var solistr = "";
                        $(solitaire['results']).each(function (i, vl) {
                            
                            var carat = vl.carat;
                            var price_per_carat = vl.prcPrCrat;
                            var tot_soli=vl.nofs;
                             var wgtcarat =parseFloat(carat)*parseFloat(tot_soli);
                            //solistr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>' + vl.nofs + '</span><span> Solitaire</span></span><span class="fRight fmSansR"><span> ' + vl.carat + '</span> Carat</span></div>';

//                            solistr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>Solitaire</span></span><span class="fRight fmSansR"><span>' + vl.nofs + '</span></span></div>';
//                            solistr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>Solitaire Carat</span></span><span class="fRight fmSansR"><span>' + vl.carat + '</span></span></div>';
//                            solistr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>Solitaire Clarity</span></span><span class="fRight fmSansR"><span>' + vl.clrty + '</span></span></div>';
//                            solistr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>Solitaire Color</span></span><span class="fRight fmSansR"><span>' + vl.colr + '</span></span></div>';
                            getSoliPrice(wgtcarat, price_per_carat);
                        });
//                        $('#desc').append(solistr);
                    }



                    if (basic.hasDmd == 1)
                    {

                        var diamstr = "";
                        var dQstr = "";

                        $('#clar').removeClass('dn');
                        $('#mclar').removeClass('dn'); 
                        $(diamonds['results']).each(function (i, vl) {

                            var dcarat = vl.crat;
                            storedDmdCarat = parseFloat(vl.crat);

                             dQstr += '<div class="radParent fLeft">';
                            var dval;
                            $.each(vl.QMast.results, function (x, y) {

                                if (p_qlty !== undefined) {
                                    if (p_qlty == y.id) {
                                        dval = y.dVal;
                                        $('#qual').text(y.dVal);
                                        $('#qual').attr('qual_id', y.id);
                                        
                                         $('#mqual').text(y.dVal);
                                        $('#mqual').attr('qual_id', y.id);
                                    }
                                } else if (y.id == "9") {
                                    $('#qual').text(y.dVal);
                                    $('#qual').attr('qual_id', y.id);
                                    
                                     $('#mqual').text(y.dVal);
                                    $('#mqual').attr('qual_id', y.id);
                                } else {
                                    $('#qual').text(y.dVal);
                                    $('#qual').attr('qual_id', y.id);
                                    
                                     $('#mqual').text(y.dVal);
                                    $('#mqual').attr('qual_id', y.id);
                                }


                                var dvdia = y.dVal;
                                var dvprc = y.prcPrCrat;
                                var dvdiaid = y.id;

                                var dClass = dvdia.replace(/-|\s/g, "");
                                dClass = dClass.toLowerCase();



                                dQstr += '<div class="rad_wrap" id="r' + y.id + '">';
                                dQstr += '<div class="clarityInfo c2">';
                                dQstr += '<span class="semibold">VVS (Very, Very Slightly Included) :</span> diamonds have minute inclusions that are difficult for a skilled grader to see under 10x magnification.';
                                dQstr += 'Pinpoints and needles set the grade at VVS.<br>';
                                dQstr += '<span class="semibold">EF :</span> E, F Colour is an Absolutely Great Colour to have! E and F is considered ‘Pure White’ and Looks Exceptional! Very Bright, Very White, Very Sparkly!';
                                dQstr += '</div>';
                                dQstr += '<div class="clarityInfo c3">';
                                dQstr += '<span class="semibold">VVS (Very, Very Slightly Included):</span> diamonds have minute inclusions that are difficult for a skilled grader to see under 10x magnification. Pinpoints and needles set the grade at VVS<br>';
                                dQstr += '<span class="semibold">GH:</span> G, H colour is the border line that segregates diamonds in colours. A GH colour diamond is considered a white diamond. Beyond the GH colour the diamonds start showing a glint of yellow fluorescence';
                                dQstr += '</div>';
                                dQstr += '<div class="clarityInfo c4">';
                                dQstr += '<span class="semibold">VS (Very Slightly Included):</span> Diamonds have minor inclusions that are difficult to somewhat easy for a trained grader to see when viewed under 10x magnification<br>';
                                dQstr += '<span class="semibold">EF :</span> E, F Colour is an Absolutely Great Colour to have! E and F is considered ‘Pure White’ and Looks Exceptional! Very Bright, Very White, Very Sparkly!';
                                dQstr += '</div>';
                                dQstr += '<div class="clarityInfo c7">';
                                dQstr += '<span class="semibold">SI (Very Slightly Included): </span>Diamonds have noticeable inclusions that are easy to very easy for a trained grader to see when viewed under 10x magnification<br>';
                                dQstr += '<span class="semibold">EF :</span> E, F Colour is an Absolutely Great Colour to have! E and F is considered ‘Pure White’ and Looks Exceptional! Very Bright, Very White, Very Sparkly!';
                                dQstr += '</div>';
                                dQstr += '<div class="clarityInfo c8">';
                                dQstr += '<span class="semibold">SI (Very Slightly Included): </span>Diamonds have noticeable inclusions that are easy to very easy for a trained grader to see when viewed under 10x magnification<br>';
                                dQstr += '<span class="semibold">GH:</span> G, H colour is the border line that segregates diamonds in colours. A GH colour diamond is considered a white diamond. Beyond the GH colour the diamonds start showing a glint of yellow fluorescence';
                                dQstr += '</div>';
                                dQstr += '<div class="clarityInfo c6">';
                                dQstr += '<span class="semibold">VS (Very Slightly Included):</span> Diamonds have minor inclusions that are difficult to somewhat easy for a trained grader to see when viewed under 10x magnification<br>';
                                dQstr += '<span class="semibold">IJ:</span> I, J colour is the diamonds under careful and trained observation reveal a glint of yellow radiance, they are considered nearly colourless and are the most frequently bought colour of diamonds.';
                                dQstr += '</div>';
                                dQstr += '<div class="clarityInfo c5">';
                                dQstr += '<span class="semibold">VS (Very Slightly Included):</span> Diamonds have minor inclusions that are difficult to somewhat easy for a trained grader to see when viewed under 10x magnification<br>';
                                dQstr += '<span class="semibold">GH:</span> G, H colour is the border line that segregates diamonds in colours. A GH colour diamond is considered a white diamond. Beyond the GH colour the diamonds start showing a glint of yellow fluorescence';
                                dQstr += '</div>';
                                dQstr +='<div class="clarityInfo c9">';
                                dQstr +='<span class="semibold">SI (Very Slightly Included):</span> Diamonds have noticeable inclusions that are easy to very easy for a trained grader to see when viewed under 10x magnification<br>';
                                dQstr +='<span class="semibold">IJ:</span> I, J colour is the diamonds under careful and trained observation reveal a glint of yellow radiance, they are considered nearly colourless and are the most frequently bought colour of diamonds.';
                                dQstr +='</div>';
                                //dQstr+= '<input type="radio" name="selectM" id="dQuality_'+x+'_'+y.id+'" checked  onchange=\"diamondPrice('+y.prcPrCrat+vl.crat+')\" class="filled-in dn">';
                                dQstr += '<input type="radio"  name="selectM" id="dQuality_' + x + '_' + y.id + '" value="' + y.dVal + '" data-value="' + y.prcPrCrat + '" onclick="setdmd(this)" class="filled-in dn">';
                                dQstr += '<label for="dQuality_' + x + '_' + y.id + '"></label>';
                                dQstr += '<div class="check2 ' + dClass + '"></div>';
                                dQstr += '<div class=" selector_label" >';
                                dQstr += '<div class="labBuffer">' + y.dVal + '</div>';
                                dQstr += '</div>';
                                dQstr += '</div>';

                                getdmdprice(dvprc, dcarat);

                            });
                            dQstr += '</div>';
                            dQstr += '<center><div class="options_back"></div></center>';
                            $('#diQ').append(dQstr);
                            $('#mdiQ').append(dQstr);

                            if (p_qlty !== undefined) {
                                $("input[name='selectM']").each(function () {
                                    var val = $(this).val();
                                    if (dval == val)
                                        $(this).attr('checked', true);
                                });
                            } else
                                $('.filled-in:last').prop('checked', true);

                        });

                        $('#desc').append(diamstr);

                    }



                    if (basic.hasUnct == 1)
                    {

                        var uncutstr = "";

                        $(uncut['results']).each(function (i, vl) {

                            var ids = vl.unctId
                            var carat = vl.crat;
                            var price = vl.prcPrCrat;

//                          uncutstr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>' + vl.totNo + '</span><span> Uncut-Diamond</span></span><span class="fRight fmSansR"><span> ' + vl.crat + '</span> Carat</span></div>';
                            getUncutPrice(price, carat);
                        });
                        $('#desc').append(uncutstr);
                    }
                    if (basic.hasGem == 1)
                    {
                        var gemstr = "";
                        var gemNstr = "";
                        $(gemstone['results']).each(function (i, vl) {

                            var ids = vl.gemId;
                            var gvalue = vl.gemNm;
                            var carat = vl.crat;
                            var price = vl.prcPrCrat;
                             var gemstn_no = vl.totNo;

                            // gemstr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>' + vl.totNo + '</span><span> ' + vl.gemNm + ' </span></span><span class="fRight fmSansR"><span> ' + vl.crat + '</span> Carat</span></div>';

//                            gemstr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>Gemstone</span></span><span class="fRight fmSansR"><span>' + vl.gemNm + '</span></span></div>';
//                            gemstr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>Gemstone Carat</span></span><span class="fRight fmSansR"><span>' + vl.crat + '</span></span></div>';
                            getGemsPrice(carat, price);

                        });
                        $('#desc').append(gemstr);

                    }


                    var purstr = "", pval;
                     purstr += '<div class="radParent fLeft">';
                    $.each(metalPurity.results, function (k, val) {

                        if (p_purity !== undefined) {
                            if (p_purity == val.id) {
                                pval = val.dVal;
                                $('#carat').text(val.dNm);
                                $('#carat').attr('carat_id', val.id);
                                
                                  $('#mobcarat').text(val.dNm);
                                $('#mobcarat').attr('carat_id', val.id);
                            }
                        } else {
                            if (k == 0) {

                                $('#carat').text(val.dNm);
                                $('#carat').attr('carat_id', val.id);
                                
                                  $('#mobcarat').text(val.dNm);
                                $('#mobcarat').attr('carat_id', val.id);
                            }
                        }
                        metalprc = val.prc;
                        var mcarat = val.dVal;

                        var kar = mcarat;
                        var re = /^(\w+)\s(\w+)$/;
                        var kar = kar.replace(re, "$2_$1").toLowerCase();
                        var karstr = "";
                        karstr = kar;
                        karstr = karstr.split('_');

                        //  purstr += '<center>';
                        purstr += '<div class="rad_wrap">';
                        //" id="purity_'+k+'_'+val.id+'"   onchange=\"GoldPrice('+val.prc+')\"  class="filled-in dn">';
                        purstr += '<input type="radio" name="purity" id="purity_' + k + '_' + val.id + '" value="' + val.dVal + '" data-price="' + val.prc + '" onclick="setmetal(this)" class="filled-in dn">';
                        purstr += '<label for="purity_' + k + '_' + val.id + '"></label>';
                        purstr += '<div class="check2">' + karstr[1] + '</div>';
                        purstr += '<span class=" selector_label">';
                        purstr += '<div class="labBuffer">' + val.dVal + '</div>';
                        purstr += '</span>';
                        purstr += '</div>';
                        //    purstr += '</center>';

                        getPurPrice(metalprc, metalwght);
                        //  something(metalprc);
                    });

                    purstr += '</div>';
                      purstr += '<center><div class="options_back"></div></center>';
                    $('#pur').append(purstr);
                    $('#mpure').append(purstr);
                    
                    if (p_qlty !== undefined) {
                        $("input[name='purity']").each(function () {
                            var val = $(this).val();
                            if (pval == val)
                                $(this).attr('checked', true);
                        });
                    } else
                        $('input[name="purity"]').eq(0).prop('checked', true);



                    var clrstr = "", colrval,defltcolor=vl.defaultcolor, defltcolval;
                        clrstr += '<div class="radParent fLeft">';
                    $.each(metalColor.results, function (j, vl) {
                        var apcol = vl.dVal.toLowerCase();
                        if (p_color !== undefined) {
                            if (p_color == vl.id) {
                                $('#clr').text(vl.dNm);
                                $('#clr').attr('clr_id', vl.id);
                                
                                 $('#mclr').text(vl.dNm);
                                $('#mclr').attr('clr_id', vl.id);
                                colrval = vl.dVal;
                            }
                        }
			else if(defltcolor == vl.id){
			      $('#clr').text(vl.dNm);
			      $('#clr').attr('clr_id', vl.id);
                              
                                  $('#mclr').text(vl.dNm);
			      $('#mclr').attr('clr_id', vl.id);
			      defltcolval = vl.dVal;
			} else {
                            if (j == 0) {
                                $('#clr').text(vl.dNm);
                                $('#clr').attr('clr_id', vl.id);
                                
                                $('#mclr').text(vl.dNm);
                                $('#mclr').attr('clr_id', vl.id);
                            }
                        }
                        clrstr += '<div class="rad_wrap">';
                        clrstr += '<input type="radio" name="metal" id="color_' + j + '_' + vl.id + '" value= "' + vl.dVal + '" onclick="setclr(this)" class="filled-in dn">';
                        clrstr += '<label for="color_' + j + '_' + vl.id + '"></label>';
                        clrstr += '<div class="check2 ' + apcol + '"></div>';
                        clrstr += '<div class="fmSansB selector_label">';
                        clrstr += '<div class="labBuffer">' + vl.dVal + '</div>';
                        clrstr += '</div>';
                        clrstr += '</div>';
                    });

                  clrstr += '</div>';
                   clrstr +='<center><div class="options_back"></div></center>';

                    $('#colr').append(clrstr);
                    $('#mcolr').append(clrstr);
                    if (p_color !== undefined) {
                        $("input[name='metal']").each(function () {
                            var val = $(this).val();
                            if (colrval == val){
			       dmdsoli=val;
			       $(this).attr('checked', true);
			    }

                        });
                    }
		    else if(defltcolval !== undefined){
		      $("input[name='metal']").each(function () {
                            var val = $(this).val();
                            if (defltcolval == val){
			       dmdsoli=val;
			       $(this).attr('checked', true);
			    }
                        });
		    }
		    else{
		        $('input[name="metal"]').eq(0).attr('checked', true);
			var val=$('input[name="metal"]').eq(0).val();
			dmdsoli=val;
		    }



                    defaultPrice(dmdlowp, dmdhighp, caratlowp, carathighp);

		     getDesc(dmdsoli, jweltype);
                     
                });


            }
            setTimeout(function () {
                calculatePrice();
            }, 500);
        }




    });





});




var bs = [];
var basicchrg = 0;
function getbasicprice(makingchrg, mtalwt) {
    var mkngchrg = parseFloat(makingchrg);
    var metalwgt = parseFloat(mtalwt);

    basicchr = mkngchrg * metalwgt;
    basicchrg += basicchr;
    bs.push(basicchrg);
    basicValue = bs[gIndex];

}


var pr = [];
var diaprice = 0;
function getdmdprice(dvprc, dcarat) {

    var prc = parseFloat(dvprc);
    var car = parseFloat(dcarat);

    diaprice = prc * car;
    //  diaprice += diapri;
    pr.push(diaprice);
    dmdValue = pr[gIndex];

}

var mp = [];
var mpurprc = 0;

function getPurPrice(metalprc, metalwght) {

    var mprc = parseFloat(metalprc);
    var metalwght = parseFloat(metalwght);
    mpurprc = mprc * metalwght;
    // mpurprc += mpurp;
    mp.push(mpurprc);
    metalValue = mp[gIndex];

}

var sol = [];
var soliprc = 0;
function getSoliPrice(carat, price_per_carat) {

    var solcarat = parseFloat(carat);
    var solprc = parseFloat(price_per_carat); 
    solipr = solprc * solcarat;
    soliprc += solipr;  
    sol.push(soliprc);
    soliValue = sol[gIndex]; 
}

var un = [];
var uncPrice = 0;
function getUncutPrice(price, carat) {

    var uprice = parseFloat(price);
    var ucarat = parseFloat(carat);
    uncPri = uprice * ucarat;
    uncPrice += uncPri;
    un.push(uncPrice);
    uncutValue = un[gIndex];

}


var gems = [];
var gemsPrice = 0;
function getGemsPrice(price, carat) {

    var gprice = parseFloat(price);
    var gcarat = parseFloat(carat);
    gemsPri = gprice * gcarat;
    gemsPrice += gemsPri;

    gems.push(gemsPrice);
    gemsValue = gems[gIndex];

}

function setdmd(e) {
    var t = $(e).closest('.rad_wrap').index();
    var va = $(e).val();
    var a = $(e).attr("id");

    var t = t - 2;
    dmdValue = pr[t];

    $('#qual').attr("qual_id", a);
    $('#qual').html(va);
    
       $('#mqual').attr("qual_id", a);
    $('#mqual').html(va);

    // glbquality=s;
    setTimeout(function () {
        $(e).closest('.selector_cont ').find('.options_back').click();
        $('#ch_price').find('.labBuffer').empty();
        $('#ch_price').find('.labBuffer').append('Previous Price:');
        $('#ch_price').velocity({opacity: [1, 0]});
        
        calculatePrice();

    }, 400);
    setTimeout(function () {
        $('#ch_price').addClass('showCh');
    }, 800);
    setTimeout(function () {
        $('#ch_price').removeClass('showCh');
        $('#ch_price').velocity({opacity: [0, 1]});
    }, 8000);

    $("input[name='selectM']").each(function () {
        $(this).attr('disabled', true);
    });
    setTimeout(function () {
        $("input[name='selectM']").each(function () {
            $(this).attr('disabled', false);
        });
    }, 1000);
}

function setmetal(m) {
    var mt = $(m).closest('.rad_wrap').index();
    var wx = $(m).val();
    var b = $(m).attr("id"); //changes
    //  var t=mt-1;
    var mt = mt - 2;
    metalValue = mp[mt];

    $('#carat').attr("carat_id", b); //changes
    $('#carat').html(wx);
    
       $('#mobcarat').attr("carat_id", b); //changes
    $('#mobcarat').html(wx);
    // glbcarat=t;

    setTimeout(function () {
        $(m).closest('.selector_cont ').find('.options_back').click();
        $('#ch_price').find('.labBuffer').empty();
        $('#ch_price').find('.labBuffer').append('Previous Price:');
        $('#ch_price').velocity({opacity: [1, 0]});
        calculatePrice();

    }, 400);
    setTimeout(function () {
        $('#ch_price').addClass('showCh');
    }, 800);
    setTimeout(function () {
        $('#ch_price').removeClass('showCh');
        $('#ch_price').velocity({opacity: [0, 1]});
    }, 8000);
    $("input[name='purity']").each(function () {
        $(this).attr('disabled', true);
    });
    setTimeout(function () {
        $("input[name='purity']").each(function () {
            $(this).attr('disabled', false);
        });
    }, 1000);
}

function setclr(c) {
    var cl = $(c).closest('.rad_wrap').index();
    var cr = $(c).val();
    var cc = $(c).attr("id");

    var cl = cl - 2;
    $('#clr').html(cr);
    $('#clr').attr("clr_id", cc);
    
       $('#mclr').html(cr);
    $('#mclr').attr("clr_id", cc);

    setTimeout(function () {
        $(c).closest('.selector_cont').find('.options_back').click();

    }, 400);
    $("input[name='metal']").each(function () {
        $(this).attr('disabled', true);
    });
    setTimeout(function () {
        $("input[name='metal']").each(function () {
            $(this).attr('disabled', false);
        });
    }, 800);

    getDesc(cr, jweltype);
}

//making grandtot as global
var grandtot = 0;
var gtotal = 0
var catname;
var catid = 0;
var totalNewPrice=0;
var sizdefault;
var sizdefaulval;
function getcatsize(s,cn, m) {
    catid = s;
    metalwt = m;
   catname= cn;
    if (catname == 'Rings' || catname == 'Bangles') {
  
       $('#sizes').removeClass('dn');
       $('#mobdvsizes').removeClass('dn');
            var strd = "";
         var mobstrd = "";
          var w = $(window).width();
            if (w <= 1024) {
               
                mobstrd += '<div class="attTitle">Size</div>';
                     mobstrd += '<div class="actBtn font12 regular" id="mbsize"> Select</div>';
                     
                                                                
                      $('#mobdvsizes').html(mobstrd);
                    
            }else{
                   strd += '<div class="attTitle">Size</div>';
                    strd += '<div class="actBtn font12 regular" id="size">Select</div>';
              
                                                                                                                   
                     $('#sizes').html(strd);
                 }
                       
               
                      if (psize !== undefined){
                        $('#size').html('SIZE ' + psize);
                         $('#mbsize').html('SIZE ' + psize);
                      }
                    
                  if (catname == 'Rings') {
                   
                    if (psize !== undefined) {
                        psize = parseInt(psize);
                        $('.ringCircle').html(psize);
                        $('.mringCircle').html(psize);
                    }
                } 
                if (catname == 'Bangles') {
                 
                    if (psize !== undefined)
                    { 
                     
                        $('.ringCircleB').html(psize);
                         $('.mringCircleB').html(psize);
                    }
                }
                   

   }
  
   
}


function defaultPrice(a, b, c, d)
{

    var dmdlp = a;
    var dmdhp = b;
    var carlp = c; 
    var carhp = d;

    var vatRate = (1 / 100);
    var bseSize = 0;
    var currentSize = 0;
    var mtlWgDav = 0;
    var dmdPricelow = 0;
    var dmdPricehigh = 0;
    var goldPricelowp = 0;
    var goldPricehighp = 0;
    var newWeightlow;
    var newWeighthigh;

    var changeInWeightsizelow;
    var changeInWeightsizehigh
    if (catname == 'Rings')
        bseSize = parseFloat(14);
    else if (catname == 'Bangles')
        bseSize = parseFloat(2.4);


    if (catname == 'Rings') {
        mtlWgDav = 0.05;
    } else if (catname == 'Bangles') {
        mtlWgDav = 7;
    }



    dmdPricelow = storedDmdCarat * dmdlp;
    dmdPricehigh = storedDmdCarat * dmdhp;
    if (catname == 'Rings') {
      
        changeInWeightsizelow = (5 - bseSize) * mtlWgDav;
        changeInWeightsizehigh = (26 - bseSize) * mtlWgDav;
        newWeightlow = parseFloat(storedWt + (changeInWeightsizelow));
        newWeighthigh = parseFloat(storedWt + (changeInWeightsizehigh));
    } else if (catname == 'Bangles') {
        changeInWeightsizelow = (2.2 - bseSize) * mtlWgDav;
        changeInWeightsizehigh = (2.9 - bseSize) * mtlWgDav;
        newWeightlow = parseFloat(storedWt + (changeInWeightsizelow));
        newWeighthigh = parseFloat(storedWt + (changeInWeightsizehigh));
    } else if (catname !== 'Rings' || catname == 'Bangles') {
        changeInWeightsizelow = (0 - bseSize) * mtlWgDav;
        changeInWeightsizehigh = (0 - bseSize) * mtlWgDav;
        newWeightlow = parseFloat(storedWt + (changeInWeightsizelow));
        newWeighthigh = parseFloat(storedWt + (changeInWeightsizehigh));
    }

    newWeightlow = newWeightlow.toFixed(3);
    newWeighthigh = newWeighthigh.toFixed(3);


    goldPricelowp = parseFloat((carlp * newWeightlow).toFixed());
    goldPricehighp = parseFloat((carhp * newWeighthigh).toFixed());
    
    var mkChargeslowp = parseFloat((storedMkCharge * newWeightlow).toFixed());
    var mkChargeshighp = parseFloat((storedMkCharge * newWeighthigh).toFixed());
    var ttllowp = parseFloat(goldPricelowp + dmdPricelow + mkChargeslowp + uncPrice + soliprc + gemsPrice);
    var ttlhighp = parseFloat(goldPricehighp + dmdPricehigh + mkChargeshighp + uncPrice + soliprc + gemsPrice);
    var totalNewPricelow = Math.round(ttllowp + (ttllowp * vatRate));
    var totalNewPricehigh = Math.round(ttlhighp + (ttlhighp * vatRate));
  $('#pricel').html(indianMoney(totalNewPricelow));
  $('#priceh').html(indianMoney(totalNewPricehigh));
}
function calculatePrice()
{
    var vatRate = (1 / 100);
    var selDiamond = parseFloat($('input[name="selectM"]:checked').attr('data-value'));
    var selPurity = parseFloat($('input[name="purity"]:checked').attr('data-price'));

    var currentSize;
    var mtlWgDav = 0;
    var dmdPrice = 0;
    var goldPrice = 0;

    var dmdLength = $('input[name="selectM"]').length;
    var bseSize = 0;

    if (catname == 'Rings') {
         var w = $(window).width();
            if (w <= 1024) {
        currentSize = $('.mringCircle').text();
    }else{
            currentSize = $('.ringCircle').text(); 
        }
        bseSize = parseFloat(14);
    }
    if (catname == 'Bangles') {
      
          var w = $(window).width();
            if (w <= 1024) {
        currentSize = $('.mringCircleB').text();
            }else{
               currentSize = $('.ringCircleB').text();  
            }
          bseSize = parseFloat(2.4);
    }

    if (catname == 'Rings') {
        mtlWgDav = 0.05;
    } else if (catname == 'Bangles') {
        mtlWgDav = 7;
    }

    if (isNaN(currentSize))
    {

        if (catname == 'Rings')
            currentSize = parseFloat(14);

        else if (catname == 'Bangles')
            currentSize = parseFloat(2.4);

        else if (catname !== 'Rings' && catname !== 'Bangles') {
            currentSize = 0;
        }


    }

    if (dmdLength > 0)
    {
        dmdPrice = storedDmdCarat * selDiamond;
    }


    var changeInWeight = (currentSize - bseSize) * mtlWgDav;
    newWeight = parseFloat(storedWt + (changeInWeight));
    newWeight = newWeight.toFixed(3); 

   
    
      var w = $(window).width();
            if (w <= 1024) {
     $('.mobWgt').html(newWeight + "");
 }else{
      $('#newWt').html(newWeight + "");
 }

    goldPrice = parseFloat((selPurity * newWeight).toFixed());
    var mkCharges = parseFloat((storedMkCharge * newWeight).toFixed()); 
    var ttl = parseFloat(goldPrice + dmdPrice + mkCharges + uncPrice + soliprc + gemsPrice);

    totalNewPrice = Math.round(ttl + (ttl * vatRate));

    var abc = $('#price').html();
    $('#price').text(totalNewPrice);
    $('#m_price').text(totalNewPrice);
    
    $('#price,#m_price').numerator({
        toValue: totalNewPrice,
        delimiter: ',',
        onStart: function () {
            isStop = true;
        },
        onComplete: function () {
            $("#price").html(IND_money_format(totalNewPrice).toLocaleString('en'));
             $('#m_price').html(IND_money_format(totalNewPrice).toLocaleString('en'));
        }

        
    });
  //  $('#prevPrc').append(' @ ' + abc);
//var abc = IND_money_format(totalNewPrice).toLocaleString('en');
    $('#ch_price').find('.labBuffer').append(' @ ' + abc);
  var w = $(window).width();
            if (w <= 1024) {
 var comb = GetURLParameter('comb');
 var wish= '<div class="likeD soc_wish2" onclick="makeAwish(this, event)" id="prd_'+pid+'"  data-size="'+psize+'" data-price="'+totalNewPrice+'" data-comb ="'+comb+'"></div>';
       $('#wsh').append(wish);
            }

}

$('#addwishlist').click(function () {
    var userid = localStorage.getItem('jzeva_uid');
    if (userid == undefined || userid == null) {

        openPopUp();

    } else {
        if (wshlstflag == 0)
        {
	  getarraydata();

            var userid, wishdata = {};
            wishdata['pid'] = arrdata['pid'];
            var chr ="" + arrdata['color'] + "|@|" + arrdata['metal'] + "|@|" + arrdata['quality'];
            wishdata['col_car_qty'] = chr;
            wishdata['price'] =totalNewPrice;
            wishdata['user_id'] = userid;
            var wishid = '';
            wishdata['wish_id'] = wishid;
            wishdata['size'] = arrdata['sz'];
            var URL = APIDOMAIN + "index.php?action=addtowishlist";
            var data = wishdata;
            var dt = JSON.stringify(data);
            $.ajax({type: "post", url: URL, data: {dt: dt}, success: function (results) {
		  var res=JSON.parse(results);
		  if(res['error']['err_code'] == 0){
		    wshlstflag = 1;
                    common.msg(1, 'This Product Added To Your Wishlist Successfully');
                    $('#addwishlist').html("In Wishlist").addClass("colorff5");
		  }
		  else if(res['error']['err_code'] == 2){
		     common.msg(0,res['error']['err_msg']);
		  }
                  else{
		    common.msg(0,res['error']['err_msg']);
		  }
                }
            });

        } else
            common.msg(0, 'This Product Already In Your Wishlist');
    }
});

function showwishbtn()
{
    var userid = common.readFromStorage('jzeva_uid');

    var URL = APIDOMAIN + "index.php?action=getwishdetail&userid=" + userid;
    $.ajax({type: 'POST', url: URL, success: function (res) {

            var data = JSON.parse(res);
            $(data['result']).each(function (r, v) {
                if (v.product_id == pid)
                    wshlstflag = 1;
            });

            setTimeout(function () {
                if (wshlstflag == 1) {
                    $('#addwishlist').html("In wishlist").addClass("colorff5");
                    $('.soc_wish2').addClass("beat");
                } else {
                    //   console.log('not in wishlist');
                }
            }, 1000);
        }
    });
}

function getDesc(dmdsol, jwlty) {

    var descStr = "";
    var URL = APIDOMAIN + "index.php?action=getprodDescrp&jweltype=" + jwlty + "&dmdsoli=" + dmdsol;
    $.ajax({type: 'POST',
        url: URL,
        success: function (res) {

            var data = JSON.parse(res);

            $(data['result']).each(function (r, v) {
                var descname = "";
                descname = v.name;
                descname = descname.replace(' ', '-');
                if (r === 0) {
                    descStr += ' <div class="colleCont ">';
                    descStr += '<div class="smUlineb">' + descname + '</div>';
                    descStr += '<div class="collCenterb">';
                    descStr += '' + v.desc + '';
                    descStr += ' </div> </div>';
                }
                else {
                    descStr += ' <div class="colleCont v2">';
                    descStr += ' <div class="smUline">' + descname + '</div>';
                    descStr += '<div class="collCenterb colorfff">';
                    descStr += '' + v.desc + '';
                    descStr += ' </div> </div>';
                }
            });
            $('.homeCollect').html(descStr);
        }
    });

}

function calweight()
{
    var currentSize;
    if (catname == 'Rings') {
        currentSize = $('.ringCircle').text();
        bseSize = parseFloat(14);

    } else if (catname == 'Bangles') {
        bseSize = parseFloat(2.4);
        currentSize = $('.ringCircleB').text();

    }

    if (catname == 'Rings') {
        mtlWgDav = 0.05;
    } else if (catname == 'Bangles') {
        mtlWgDav = 7;
    }

    if (isNaN(currentSize))
    {
        if (catname == 'Rings')
            currentSize = parseFloat(14);

        else if (catname == 'Bangles')
            currentSize = parseFloat(2.4);

        else if (catname !== 'Rings' && catname !== 'Bangles') {
            currentSize = 0;
        }
    }
    var changeInWeight = (currentSize - bseSize) * mtlWgDav;
    newWeight = parseFloat(storedWt + (changeInWeight));
    newWeight = newWeight.toFixed(3);

    $('#newWt').html(newWeight + "");
}

$('.dwnArrow').click(function(){
   var hight=$(document).height();
   hight=hight/3;
   $('html, body, dwnArrow').animate({ scrollTop: hight }, 800);
});
var e;

$('.sizbak ').click(function () {
    var size = $('#size').text();
  
//     calculatePrice();
    setTimeout(function () {
        $(e).closest('.selector_cont ').find('.options_back').click();
        $('#ch_price').find('.labBuffer').empty();
        $('#ch_price').find('.labBuffer').append('Previous Price:');
        $('#ch_price').velocity({opacity: [1, 0]});

        calculatePrice();

    }, 400);
    setTimeout(function () {
        $('#ch_price').addClass('showCh');
    }, 800);
    setTimeout(function () {
        $('#ch_price').removeClass('showCh');
        $('#ch_price').velocity({opacity: [0, 1]});
    }, 8000);

    if (catname == 'Rings') {
        if (size == 'Select')  {
            var rngval = $('.ringCircle').text();
            $('#size').html('SIZE ' + rngval);
        
              
        }
    } else if (catname == 'Bangles') {
        if (size == 'Select') {
            var bngval = $('#bangCircle').text();
            
            $('#size').html('SIZE ' + bngval);
        
            
        }
    }
});


$('#mobsz ').click(function () {
  
    var Msiz=$('#mbsize').text();
//     calculatePrice();
    setTimeout(function () {
        $(e).closest('.selector_cont ').find('.options_back').click();
        $('#ch_price').find('.labBuffer').empty();
        $('#ch_price').find('.labBuffer').append('Previous Price:');
        $('#ch_price').velocity({opacity: [1, 0]});

        calculatePrice();

    }, 400);
    setTimeout(function () {
        $('#ch_price').addClass('showCh');
    }, 800);
    setTimeout(function () {
        $('#ch_price').removeClass('showCh');
        $('#ch_price').velocity({opacity: [0, 1]});
    }, 8000);
  
     $('#newWt').html(newWeight + "");
    
});