var dmdValue = metalValue = soliValue = gemsValue = uncutValue = basicValue = 0;


var grandtotal = 0;
var grandtot = 0;
var grandtotallow = 0;
var grandtotalhigh=0;
var grandtotlow = 0;
var grandtothigh=0;
var getProdDtl = new Array();
var stock = new Array();
var aid;
var stSearch = new Array();
var hlist = "";

$(document).ready(function () {
    getmenu();
    // var URL = APIDOMAIN + "index.php/?action=getProGrid";
    getprodbyid();


});
var Metalwgt;
function generatelist(obj) {

    var proStr = "";
    var images = [];
    if (obj['images'] !== null && obj['images'] !== undefined && obj['images'] !== '' && obj['images'] !== 'undefined')
    {
        images = obj['images'].split(',');

    } else
    {
        images[0] = 'uploads/noimg2.svg';
    }


    if (images.length == 0)
    {
        var images = "uploads/noimg2.svg";
    }

    var gems = obj['hasGem'];
    var diamond = obj['hasDmd'];
    var solitaire = obj['hasSol'];
    var uncut = obj['hasUnct'];
    var Mprc = obj['purprice'];
    var Mcarat = obj['purity'];
    var Makchrg = obj['making_charges'];
   var Metalwgt = obj['metal_weight'];
    var gender = obj['gender'];
    var jType = obj['jwelType'];
    var Mclr = obj['allmetalcolor'];
    var gemsName = obj['gemstoneName'];
    var Dshape = obj['shape'];
    var pid = obj['prdId'];
    var dmdlowp = obj['dmdlowp'];
    var dmdhighp = obj['dmdhighp'];
    var caratlowp = obj['caratlowp'];
    var carathighp = obj['carathighp'];
    var pricelow=0;
    var pricehigh=0;

    if (obj['totalgems'] !== null && obj['totalgems'] !== undefined && obj['gemstoneName'] !== null && obj['gemstoneName'] !== undefined && obj['gemscarat'] !== null && obj['gemscarat'] !== undefined) {

        var t = obj['totalgems'].split(',');
        var g = obj['gemstoneName'].split(',');
        var c = obj['gemscarat'].split(',');
        var i;

    }

    if (obj['totalSolitaire'] !== null && obj['totalSolitaire'] !== undefined && obj['Solicarat'] !== null && obj['Solicarat'] !== undefined) {

        var t = obj['totalSolitaire'].split(',');
        var c = obj['Solicarat'].split(',');
        var j;

    }
    if (obj['totalUncut'] !== null && obj['totalUncut'] !== undefined && obj['Uncutcarat'] !== null && obj['Uncutcarat'] !== undefined) {

        var t = obj['totalUncut'].split(',');
        var c = obj['Uncutcarat'].split(',');
        var k;

    }

    if (obj['totaldmd'] !== null && obj['totaldmd'] !== undefined && obj['dmdcarat'] !== null && obj['dmdcarat'] !== undefined) {

        var p = obj['totaldmd'].split(',');
        var q = obj['dmdcarat'].split(',');
        var d;

    }

  var newWeightlow;
    var newWeighthigh;
    var mtlWgDav=0;
     var changeInWeightsizelow;
     var changeInWeightsizehigh;
     var bseSize = 0;
     var vatRate = (1 / 100);
   
    

    var price = 0;
    if (solitaire == '1' && solitaire !== 'null') {
        var Solicarat = obj['Solicarat'];
        var Soliprc = obj['SoliPricepercarat'];
        var Solitot = obj['totalSolitaire'];

        price = price + getSoliPrice(Solicarat, Soliprc); 

    }
    if (uncut == '1' && uncut !== 'null' && uncut !== '1')
    {
        var Uncutcarat = obj['Uncutcarat'];
        var Uncutprc = obj['UncutPricepercarat'];
        var Uncuttot = obj['totalUncut'];
        price = price + getUncutPrice(Uncutcarat, Uncutprc);

    }
    if (gems == '1' && gems !== 'null')
    {
        var Gemscarat = obj['gemscarat'];
        var Gemsprc = obj['gemsPricepercarat'];
        var Gemstot = obj['totalgems'];

        price = price + getGemsPrice(Gemscarat, Gemsprc);

    }
  
    var dmdPricelow=0;
    var dmdPricehigh=0;
    if (diamond == '1' && diamond !== 'null')
    {
        var Diacarat = obj['dmdcarat'];
   
       var Diaprcl = obj['dmdlowp'];
      var DiaprcH = obj['dmdhighp'];
     dmdPricelow  = (Diacarat * Diaprcl); 
     dmdPricehigh  = (Diacarat * DiaprcH); 
          
    }
    
     if (obj['chldcatname'] == 'Rings')
      bseSize = parseFloat(14);
 else if (obj['chldcatname'] == 'Bangles')
    bseSize = parseFloat(2.4);
    
    
     if (obj['chldcatname'] == 'Rings') 
        mtlWgDav = 0.05;
     else if (obj['chldcatname'] == 'Bangles') 
        mtlWgDav = 7;
    
    
     if (obj['chldcatname'] === 'Rings'){
       
   changeInWeightsizelow = (5 - bseSize) * mtlWgDav;   
   changeInWeightsizehigh = (25- bseSize) * mtlWgDav;
    newWeightlow = parseFloat(Metalwgt) +parseFloat(changeInWeightsizelow); 
    newWeighthigh = parseFloat(Metalwgt) +parseFloat(changeInWeightsizehigh); 
   }                                                                       
   else if(obj['chldcatname'] === 'Bangles'){
     changeInWeightsizelow = (2.2- bseSize) * mtlWgDav; 
    changeInWeightsizehigh = (2.9- bseSize) * mtlWgDav;
    newWeightlow = parseFloat(Metalwgt) + parseFloat(changeInWeightsizelow);
    newWeighthigh = parseFloat(Metalwgt) + parseFloat(changeInWeightsizehigh);
   }
   else if(obj['chldcatname'] !== 'Rings' || obj['chldcatname'] !== 'Bangles'){
        changeInWeightsizelow = (0- bseSize) * mtlWgDav;  
   changeInWeightsizehigh = (0- bseSize) * mtlWgDav;
    newWeightlow = parseFloat(Metalwgt) + parseFloat(changeInWeightsizelow);
    newWeighthigh = parseFloat(Metalwgt) + parseFloat(changeInWeightsizehigh); 
   }
   
    newWeightlow = newWeightlow.toFixed(3);
    newWeighthigh = newWeighthigh.toFixed(3);


//    price = price + getPurPrice(Mprc, Metalwgt); //console.log("goldPrice-> "+price +"");
//    price = price + getbasicprice(Makchrg, Metalwgt);//console.log("basicPrice-> "+price +"");
var goldPricelowp=0;
var goldPricehighp =0;
     goldPricelowp = parseFloat(newWeightlow * caratlowp);  
     goldPricehighp = parseFloat(newWeighthigh * carathighp); 
    
       var mkChargeslowp = parseFloat(Makchrg * newWeightlow);
    var mkChargeshighp = parseFloat(Makchrg * newWeighthigh);
    
    
    var ttllowp = parseFloat(goldPricelowp + dmdPricelow + mkChargeslowp + price);
     var ttlhighp = parseFloat(goldPricehighp + dmdPricehigh + mkChargeshighp + price);
     
      var totalNewPricelow = Math.round(ttllowp + (ttllowp * vatRate)); 
    var totalNewPricehigh = Math.round(ttlhighp + (ttlhighp * vatRate)); 
   
 

    grandtotlow = totalNewPricelow.toFixed();
     grandtothigh = totalNewPricehigh.toFixed();
    grandtotallow = common.IND_money_format(grandtotlow, 0); 
    grandtotalhigh = common.IND_money_format(grandtothigh, 0); 
    // grandtotal = Number(grandtot).toLocaleString('en');

   
    proStr += '<div class="grid3 transition400" id="' + obj['prdId'] + '"  >';
    // proStr += '<div class="noimgDiv"></div>';
    proStr += '<div class="facet_front">';
    proStr += '<div class="grid_item"  >';
    proStr += '<div class="grid_img"  onmousemove="bindrota(this , event)" lcor="0">';


    if (obj['default_image'] != null) {

        proStr += '<div style="background:url(\'' + IMGDOMAIN + obj['default_image'] + '\')no-repeat ; background-size: contain ; background-position: center"  class=""></div>';
    } else if (images[0] == "uploads/noimg2.svg")
        proStr += '<div style="background:url(\'' + IMGDOMAIN + images[0] + '\')no-repeat ; background-size: auto 50% ; background-position: center"  class=""></div>';
    else
        proStr += '<div style="background:url(\'' + IMGDOMAIN + images[0] + '\')no-repeat ; background-size: contain ; background-position: center"  class=""></div>';
    proStr += '</div>';
    proStr += '<div class="hovTr">';
    proStr += '<div class="hovTrans">';
//    proStr += '<div class="plusCont">';
//    proStr += '</div>';
    proStr += '</div>';
    proStr += '</div>';
    proStr += '<a  target="_blank" href="' + DOMAIN + 'index.php?action=product_page&pid=' + obj['prdId'] + '"></a>';
    proStr += '<div class="grid_dets">';
    proStr += '<div class="grid_name txtOver transition300">' + obj['prdNm'] + '</div>';
    //proStr += '<div class="col100 color666">';
    //proStr += '<div class="col100  font11 transition300 txtOver">' + obj['jwelType'] + ' ' + obj['metal_weight'] + ' gms, Diamond ' + obj['dmdcarat'] + ' Carats</div>';

    proStr += '<div class="col100  font11 transition300 txtOver" id="prdstonename">' + obj['jwelType'] + '';
    var type = 0;
    if (obj.hasSol == 1)
        type = 1;
    if (obj.hasDmd == 1)
        type = 2;
    if (obj.hasSol == 1 && obj.hasDmd == 1)
        type = 3;
    if (obj.hasDmd == 1 && obj.hasUnct == 1)
        type = 4;

    var gemcnt = obj.gemstoneName + "";
    gemcnt = gemcnt.split(',');
    if (obj.hasGem == 1) {
        if (gemcnt.length == 1) {
            type = 5;
            if (gemcnt.length > 1)
                type = 6;
        }
    }
    if (obj.hasDmd == 1 && obj.hasGem == 1) {
        if (gemcnt.length == 1)
            type = 7;
        if (gemcnt.length > 1)
            type = 8;
    }

    var Nstr = "";
    switch (type) {
        case 1:
        {
            Nstr += '<span> Φ Solitaire</span>';
            break;
        }
        case 2:
        {
            Nstr += '<span> Φ Diamond</span>';
            break;
        }
        case 3:
        {
            Nstr += '<span> Φ Solitaire </span>';
            break;
        }
        case 4:
        {
            Nstr += '<span> Φ Diamond</span>';
            break;
        }
        case 5:
        {
            var gemstn = obj.gemstoneName;
            Nstr += '<span> Φ ' + gemstn + ' /span>';
            break;
        }
        case 6:
        {
            Nstr += '<span> Φ Gemstones </span>';
            break;
        }
        case 7:
        {
            gemstn = obj.gemstoneName;
            Nstr += '<span> Φ Diamond</span><span> Φ ' + gemstn + '</span>';
            break;
        }
        case 8:
        {
            Nstr += '<span> Φ Diamond</span><span> Φ Gemstones</span>';
            break;
        }
    }
    proStr += ' ' + Nstr + '</div>';
    proStr += '<div class="grid_price txtOver transition300" onclick=\" custmz('+obj['prdId']+')\"><span class="cartRup15b">' + grandtotallow + '</span><span class="toTxt"> to  </span> <span  class="cartRup15b"> '+grandtotalhigh+'</span></div>';
    proStr += '<div class="fmSansB smBtnDiv fLeft transition300">';
//    proStr += '<span class="u_line point lettSpace fLeft"  onclick=\"getProId(\''+ obj['prdId'] + '\')\">View Product</span>';
    proStr += '<div class="v360Btn" onclick=\"imgLoad(' + obj['prdId'] + ', event)\"></div>';
//    proStr += '<span class="u_line point lettSpace v_dets fRight" onclick="flipCard(this)">Quick View</span>';
    //proStr += '</div>';
    proStr += '</div>';
    proStr += '</div>';
    //proStr += '<div class="soc_icons dn">';
    proStr += '<div class="soc_abs soc_wish2 transition300 fRight" onclick="makeAwish(this, event)"></div>';
    // proStr += '<div class="soc_elem soc_comment transition300"></div>';
    //proStr += '<div class="soc_elem soc_share transition300"></div>';
    //proStr += '</div>';
    proStr += '</div>';
    proStr += '</div>';
    proStr += '<div class="facet_back" >';
    proStr += '<div class="facet_cont">';
    proStr += '<div class="light_header fLeft fmSansL"><span class="u_lineW">' + obj['prdNm'] + '</span></div>';
    proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + obj['jwelType'] + '</span><span class="fRight fmSansR"> ' + obj['metal_weight'] + ' gms</span> </div>';
    if (diamond == '1' && diamond !== 'null') {
        for (var d = 0; d < (p.length); d++) {

            proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + p[d] + ' Diamonds</span><span class="fRight fmSansR"> ' + q[d] + ' Carats</span></div>';
        }
    }

    if (gems == '1' && gems !== 'null')
    {
        for (var i = 0; i < (c.length); i++) {

            proStr += '<div class="desc_row fLeft font12 fmSansB " ><span class="txt_left fLeft">' + t[i] + ' ' + g[i] + '</span><span class="fRight fmSansR"> ' + c[i] + ' Carats</span></div>';

        }
    }
    if (solitaire == '1' && solitaire !== 'null' && uncut !== '0') {
        for (var j = 0; j < (c.length); ++j) {
            proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + t[j] + ' Solitaire </span> <span class="fRight fmSansR">' + c[j] + ' Carats</span></div>';
        }
    }
    if (uncut == '1' && uncut !== 'null' && uncut !== '0') {
        for (var u = 0; u < (c.length); ++u) {
            proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + t[u] + ' Uncut-Diamond </span> <span class="fRight fmSansR">' + c[u] + ' Carats</span></div>';
        }
    }
    // proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">Size</span><span class="fRight fmSansR">S9</span></div>';

    proStr += '<div class="grid_icons">';
    proStr += '<center>';
    proStr += '<div class="soc_elem2 soc_commentW"></div>';
    proStr += '<div class="soc_elem2 soc_likeW"></div>';
    proStr += '<div class="soc_elem2 soc_shareW"></div>';
    proStr += '<div class="soc_elem2 soc_cartW"></div>';
    proStr += '</center>';
    proStr += '<div class="facet_back" >';
    proStr += '<div class="facet_cont">';
    proStr += '<div class="light_header fLeft fmSansL"><span class="u_lineW">' + obj['prdNm'] + '</span></div>';
    proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + obj['jwelType'] + '</span><span class="fRight fmSansR"> ' + obj['metal_weight'] + ' gms</span> </div>';
    if (diamond == '1' && diamond !== 'null') {
        for (var d = 0; d < (p.length); d++) {

            proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + p[d] + ' Diamonds</span><span class="fRight fmSansR"> ' + q[d] + ' Carats</span></div>';
        }
    }

    if (gems == '1' && gems !== 'null')
    {
        for (var i = 0; i < (c.length); i++) {

            proStr += '<div class="desc_row fLeft font12 fmSansB " ><span class="txt_left fLeft">' + t[i] + ' ' + g[i] + '</span><span class="fRight fmSansR"> ' + c[i] + ' Carats</span></div>';

        }
    }
    if (solitaire == '1' && solitaire !== 'null') {
        for (var j = 0; j < (c.length); ++j) {
            proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + t[j] + ' Solitaire </span> <span class="fRight fmSansR">' + c[j] + ' Carats</span></div>';
        }
    }
    if (uncut == '1' && uncut !== 'null') {
        for (var u = 0; u < (c.length); ++u) {
            proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + t[u] + ' Uncut-Diamond </span> <span class="fRight fmSansR">' + c[u] + ' Carats</span></div>';
        }
    }
    // proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">Size</span><span class="fRight fmSansR">S9</span></div>';

    proStr += '<div class="grid_icons">';
    proStr += '<center>';
    proStr += '<div class="soc_elem2 soc_commentW"></div>';
    proStr += '<div class="soc_elem2 soc_likeW"></div>';
    proStr += '<div class="soc_elem2 soc_shareW"></div>';
    proStr += '<div class="soc_elem2 soc_cartW"></div>';
    proStr += '</center>';
    //   proStr += '<div class="facet_back" >';
    //   proStr += '<div class="facet_cont">';
    //   proStr += '<div class="light_header fLeft fmSansL"><span class="u_lineW">' + obj['prdNm'] + '</span></div>';
    //   proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + obj['jwelType'] + '</span><span class="fRight fmSansR"> ' + obj['metal_weight'] + ' gms</span> </div>';
    //   if (diamond == '1' && diamond !== 'null') {
    //       for(var d = 0; d < (p.length); d++){
    //
    //       proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + p[d] + ' Diamonds</span><span class="fRight fmSansR"> ' + q[d] + ' Carats</span></div>';
    //   }
    //   }
    //
    //   if (gems == '1' && gems !== 'null')
    //   {
    //      for(var i = 0; i < (c.length); i++){
    //
    //      proStr +='<div class="desc_row fLeft font12 fmSansB " ><span class="txt_left fLeft">' + t[i]+ ' ' + g[i]+ '</span><span class="fRight fmSansR"> ' + c[i]+ ' Carats</span></div>';
    //
    //   }
    //   }
    //   if (solitaire == '1' && solitaire !== 'null') {
    //       for(var j = 0; j < (c.length); ++j){
    //       proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + t[j] + ' Solitaire </span> <span class="fRight fmSansR">' + c[j] + ' Carats</span></div>';
    //   }
    //  }
    //   if (uncut == '1' && uncut !== 'null') {
    //        for(var u = 0; u < (c.length); ++u ){
    //       proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + t[u] + ' Uncut-Diamond </span> <span class="fRight fmSansR">' + c[u] + ' Carats</span></div>';
    //   }
    //  }
    //  // proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">Size</span><span class="fRight fmSansR">S9</span></div>';
    //
    //   proStr += '<div class="grid_icons">';
    //   proStr += '<center>';
    //   proStr += '<div class="soc_elem2 soc_commentW"></div>';
    //   proStr += '<div class="soc_elem2 soc_likeW"></div>';
    //   proStr += '<div class="soc_elem2 soc_shareW"></div>';
    //   proStr += '<div class="soc_elem2 soc_cartW"></div>';
    //   proStr += '</center>';
    //   proStr += '</div>';
    //   proStr += '<div class="grid_back" onclick="flipBack(this)"></div>';
    //   proStr += '</div>';
    //   proStr += '</div>';
    proStr += '</div> ';
    return proStr;

}


function custmz(i){
 var pid =i;
   window.open(DOMAIN + 'index.php?action=product_page&pid=' +pid);
}

function imgLoad(p, event) {
    event.stopPropagation();

    if (!$('#' + p).hasClass('has360')) {
        $('#' + p).addClass('has360');
        var URL = APIDOMAIN + "index.php/?action=getImagesByPid&pid=" + p;

        var dataI;
        $.ajax({
            type: 'POST',
            url: URL,
            success: function (res) {
                dataI = JSON.parse(res);

                var imgstr = "";
                $(dataI['images']).each(function (i, v) {

                    imgstr = '<div style="background:url(\'' + v + '\')no-repeat ; background-size: contain ; background-position: center"  class=""></div>';
                    $('#' + p).find('.grid_img').append(imgstr);
                });

                //  $('#'+p).find('.grid_img').empty().append(imgstr);
            }
        });
    }
}
function getbasicprice(Makchrg, Metalwgt) {

    var mkngchrg = parseFloat(Makchrg);
    var metalwgt = parseFloat(Metalwgt);

    var basicchrg = mkngchrg * metalwgt;

    basicValue = basicchrg;
    return basicValue;
}

var soliprc = 0;
function getSoliPrice(carat, price_per_carat) {

    var solcarat = parseFloat(carat);
    var solprc = parseFloat(price_per_carat);
    soliprc = solprc * solcarat;

    soliValue = soliprc;
    return soliValue;
}

var uncPric = 0;
function getUncutPrice(price, carat) {

    var uprice = parseFloat(price);
    var ucarat = parseFloat(carat);
    uncPric = uprice * ucarat;

    uncutValue = uncPric;
    return uncutValue;
}

function getGemsPrice(gemc, gemp) {

    var gc = gemc.split(',');
    var gp = gemp.split(',');
    var gprc = 0;
    $(gp).each(function (i, v) {

    });
    $(gc).each(function (i, vl) {

        prc = parseFloat(vl) * parseFloat(gp[i]);
        gprc += prc;

    });
    gemsValue = gprc;

    return gemsValue;


}


function getdmdprice(dvprc, dcarat) {

    var prc = parseFloat(dvprc);
    var car = parseFloat(dcarat);

    var diaprice = prc * car;

    dmdValue = diaprice;
    return dmdValue;
}


function getPurPrice(Mprc, mwght) {

    var mprc = parseFloat(Mprc);
    var metalwght = parseFloat(mwght);
    var mpurprc = mprc * metalwght;

    metalValue = mpurprc;
    return metalValue;
}

var count = 0;
var page2 = 2;
var limcount = 12;
$('#gr_foot').on('click', function () {
    var page3 = page2 + count++;

    var limit = 12;
    var limitend = limit * page3;
    //$('#gr_foot').addClass('transdown');


    var URL1 = APIDOMAIN + "index.php/?action=getProductdetailbycatid&id=" + id + "&page=" + page3 + "&limit=" + limit + "";
    var tot_len = 0;
    $.ajax({
        type: 'POST',
        url: URL1,
        success: function (res) {

            res = JSON.parse(res);

            if (res['error']['err_code'] == 0) {
                var total = res['total'];
                if (total == 1)
                    $('#total_Product').html("<strong>" + total + "</strong> Product");
                else
                    $('#total_Product').html("<strong>" + total + "</strong> Products");
                var obj1 = res["result"];
                if (obj1 !== null) {
                    var len = obj1.length;

                    var i = 0;
                    if (len > 0)
                    {
                        var str = '';
                        while (i < len)
                        {
                            
                            str = generatelist(obj1[i]);
                            i++;
                            var k = i * 200;
                            //$(str).velocity({opacity:[1,0] , translateY:[0,40]} , {duration:600 , easing:'ease-out' , delay:k }).appendTo('#gridDetail');
                            $(str).appendTo('#gridDetail');
                            setTimeout(function () {
                                $('#gridDetail').find('.grid3').addClass('fadeInup');
//                              bindhover();
                            }, 100);
                        }
                    }
                    //  $('#gridDetail').append(str);
                    //  var $we= str;
                }
                if (limitend >= total) {

                    $('#gr_foot').remove();
                }
            }

        }

    });

});


function getmenu()
{
    var menuURL = APIDOMAIN + "index.php/?action=getfiltrmenus&catid=" + id;
    $.ajax({type: 'POST', url: menuURL, success: function (res) {
            var data = JSON.parse(res);
            var mainmenustr = "";
            var submenulist = "", stoncnt = 1;

            if (data['result'] !== null) {

                var reslt = data['result']['atr_val'];
                $(reslt['result']).each(function (r, n) {

                    mainmenustr += "<div class='ftabB ' >";
                    mainmenustr += "  <div class='ftab fLeft taba' >";
                    mainmenustr += " " + n['attr_name'].toUpperCase() + " </div> </div>";

                    submenulist += "<div class='fmenu_elm fLeft' id='" + n.attributeid + "'>";
                    $(n['attr_values']).each(function (q, p) {
                        var v = parseInt(p);
                        var iconstr = "";
                        if ($.isNumeric(v)) {
                            if (v == 1)
                                iconstr = "one";
                            if (v == 2)
                                iconstr = "two";
                            if (v == 3)
                                iconstr = "three";
                            if (v == 4)
                                iconstr = "four";
                            var sr = "";
                            sr = p.toLowerCase();
                            sr = sr.split(' ');
                            iconstr += sr[1];
                        } else {
                            iconstr = p.toLowerCase();
                            iconstr = iconstr.replace(' ', '');
                        }
                        submenulist += "<div class='filterCommon " + iconstr + "Ic' onclick='submenu(this)' ";
                        submenulist += " id='" + p + "_" + n.attr_name + "' >";
                        submenulist += " <div class='filterLabel' >";
                        submenulist += " <div class='labBuffer'  >" + p + "</div>";
                        submenulist += " </div> </div>";
                    });
                    submenulist += "</div>";
                });
                submenulist += "<div class='fmenu_elm fLeft'>";
                submenulist += '<div class="rangeParent fLeft">';
                submenulist += '<div class="rngDv">';
                submenulist += '<input type="text" value="" id="range" onchange="subfltrng(this)">';
                submenulist += '</div>';
                submenulist += '</div>';
                submenulist += '</div>';
                submenulist += "<div class='fmenu_elm fLeft'>";
                submenulist += '<div class="rangeParent fLeft">';
                submenulist += '<div class="rngDv">';
                submenulist += '<input type="text" id="carat" value="" onchange="subfltrng(this)">';
                submenulist += '</div>';
                submenulist += '</div>';
                submenulist += '</div>';
                mainmenustr += " ";
            }


            setTimeout(function () {
                $('.ftab_buffer').prepend(mainmenustr);
                $('.fmenuB').html(submenulist);
                bindFilterUi();
                getHeight();
                chk();
            }, 1000);
        }
    });

}


var fltrarray = {};

function submenu(ths)
{
    var tid = $(ths).attr('id');
    tid = tid.split('_');
    var pid = "";
    pid = tid[1];
    pid = pid.toString();
    tid = tid[0];
    pid = pid.replace(' ', '');
    pid = pid.toLowerCase();
    var menuid = $(ths).parent().attr('id');

    switch (pid)
    {
        case 'stone':
            if (fltrarray[pid] == undefined) {
                fltrarray[pid] = {};
                fltrarray[pid][menuid] = new Array();
                fltrarray[pid][menuid].push(tid);
            } else
            {
                var tmval = fltrarray[pid][menuid], tmpflag = 0;
                ;
                for (var l = 0; l < Object.keys(tmval).length; l++)
                {
                    if (fltrarray[pid][menuid][l] == tid) {
                        tmpflag = 1;
                        if (Object.keys(tmval).length == 1)
                            delete fltrarray[pid];
                        else
                            fltrarray[pid][menuid].splice(l, 1);
                    }
                }
                if (tmpflag == 0)
                    fltrarray[pid][menuid].push(tid);
            }
            break;

        case 'diamondcut':
            if (fltrarray[pid] == undefined) {
                fltrarray[pid] = {};
                fltrarray[pid][menuid] = new Array();
                fltrarray[pid][menuid].push(tid);
            } else
            {
                var tmval = fltrarray[pid][menuid], tmpflag = 0;
                ;
                for (var l = 0; l < Object.keys(tmval).length; l++)
                {
                    if (fltrarray[pid][menuid][l] == tid) {
                        tmpflag = 1;
                        if (Object.keys(tmval).length == 1)
                            delete fltrarray[pid];
                        else
                            fltrarray[pid][menuid].splice(l, 1);
                    }
                }
                if (tmpflag == 0)
                    fltrarray[pid][menuid].push(tid);
            }
            break;

        case 'ringtype':
            if (fltrarray[pid] == undefined) {
                fltrarray[pid] = {};
                fltrarray[pid][menuid] = new Array();
                fltrarray[pid][menuid].push(tid);
            } else
            {
                var tmval = fltrarray[pid][menuid], tmpflag = 0;
                ;
                for (var l = 0; l < Object.keys(tmval).length; l++)
                {
                    if (fltrarray[pid][menuid][l] == tid) {
                        tmpflag = 1;
                        if (Object.keys(tmval).length == 1)
                            delete fltrarray[pid];
                        else
                            fltrarray[pid][menuid].splice(l, 1);
                    }
                }
                if (tmpflag == 0)
                    fltrarray[pid][menuid].push(tid);
            }
            break;

        case 'for':
            if (fltrarray[pid] == undefined) {
                fltrarray[pid] = {};
                fltrarray[pid][menuid] = new Array();
                fltrarray[pid][menuid].push(tid);
            } else
            {
                var tmval = fltrarray[pid][menuid], tmpflag = 0;
                ;
                for (var l = 0; l < Object.keys(tmval).length; l++)
                {
                    if (fltrarray[pid][menuid][l] == tid) {
                        tmpflag = 1;
                        if (Object.keys(tmval).length == 1)
                            delete fltrarray[pid];
                        else
                            fltrarray[pid][menuid].splice(l, 1);
                    }
                }
                if (tmpflag == 0)
                    fltrarray[pid][menuid].push(tid);
            }
            break;

        case 'pendanttype':
            if (fltrarray[pid] == undefined) {
                fltrarray[pid] = {};
                fltrarray[pid][menuid] = new Array();
                fltrarray[pid][menuid].push(tid);
            } else
            {
                var tmval = fltrarray[pid][menuid], tmpflag = 0;
                ;
                for (var l = 0; l < Object.keys(tmval).length; l++)
                {
                    if (fltrarray[pid][menuid][l] == tid) {
                        tmpflag = 1;
                        if (Object.keys(tmval).length == 1)
                            delete fltrarray[pid];
                        else
                            fltrarray[pid][menuid].splice(l, 1);
                    }
                }
                if (tmpflag == 0)
                    fltrarray[pid][menuid].push(tid);
            }
            break;

        case 'bangletype':
            if (fltrarray[pid] == undefined) {
                fltrarray[pid] = {};
                fltrarray[pid][menuid] = new Array();
                fltrarray[pid][menuid].push(tid);
            } else
            {
                var tmval = fltrarray[pid][menuid], tmpflag = 0;
                ;
                for (var l = 0; l < Object.keys(tmval).length; l++)
                {
                    if (fltrarray[pid][menuid][l] == tid) {
                        tmpflag = 1;
                        if (Object.keys(tmval).length == 1)
                            delete fltrarray[pid];
                        else
                            fltrarray[pid][menuid].splice(l, 1);
                    }
                }
                if (tmpflag == 0)
                    fltrarray[pid][menuid].push(tid);
            }
            break;

        case 'earringtype':
            if (fltrarray[pid] == undefined) {
                fltrarray[pid] = {};
                fltrarray[pid][menuid] = new Array();
                fltrarray[pid][menuid].push(tid);
            } else
            {
                var tmval = fltrarray[pid][menuid], tmpflag = 0;
                ;
                for (var l = 0; l < Object.keys(tmval).length; l++)
                {
                    if (fltrarray[pid][menuid][l] == tid) {
                        tmpflag = 1;
                        if (Object.keys(tmval).length == 1)
                            delete fltrarray[pid];
                        else
                            fltrarray[pid][menuid].splice(l, 1);
                    }
                }
                if (tmpflag == 0)
                    fltrarray[pid][menuid].push(tid);
            }
            break;

        case 'necklacetype':
            if (fltrarray[pid] == undefined) {
                fltrarray[pid] = {};
                fltrarray[pid][menuid] = new Array();
                fltrarray[pid][menuid].push(tid);
            } else
            {
                var tmval = fltrarray[pid][menuid], tmpflag = 0;
                ;
                for (var l = 0; l < Object.keys(tmval).length; l++)
                {
                    if (fltrarray[pid][menuid][l] == tid) {
                        tmpflag = 1;
                        if (Object.keys(tmval).length == 1)
                            delete fltrarray[pid];
                        else
                            fltrarray[pid][menuid].splice(l, 1);
                    }
                }
                if (tmpflag == 0)
                    fltrarray[pid][menuid].push(tid);
            }
            break;

    }

    setTimeout(function () {

        if (Object.keys(fltrarray).length == 0) {
            getprodbyid();
        } else
            displayproduct();

    }, 500);

}

function subfltrng(ths)
{
    var rangval = $(ths).val();
    var type = $(ths).attr('id');

    switch (type) {

        case 'range':
            fltrarray.range = rangval;
            break;

        case 'carat':
            fltrarray.carat = rangval;
            break;
    }
    setTimeout(function () {
        displayproduct();
    }, 500);
}

function getprodbyid()
{
    var URL = APIDOMAIN + "index.php?action=getProductdetailbycatid&id=" + id;
    $.ajax({
        type: 'POST',
        url: URL,
        success: function (res) {


            res = JSON.parse(res);
            if (res['error']['err_code'] == 0) {
                getProdDtl = res["result"];
                var total = res["total"];
                if (total == 1)
                    $('#total_Product').html("<strong>" + total + "</strong> Product");
                else
                    $('#total_Product').html("<strong>" + total + "</strong> Products");
                var obj = res["result"];
                if (total < 12)
                    $('#gr_foot').remove();
                $('#parnttyp').html('');
                var parnt = obj[0]['parntcatname'];
                if (parnt == 'High Jewellery') {
                    parnt = parnt.split(' ');
                    parnt = parnt[1];
                }
                var chld = obj[0]['chldcatname'];
                var dplstr = '<div class="breadP fLeft">' + parnt + '</div>';
                dplstr += '<div class="breadP fLeft">' + chld + '</div>';
                $('#parnttyp').append(dplstr);
                var len = obj.length;

                var i = 0;
                if (len > 0)
                {
                    var str = '';
                    while (i < len)
                    {
                        str = generatelist(obj[i]);
                        //stock.push(obj[i]);
                        stSearch.push(obj[i]);
                        i++;
                        var k = i * 200;

                        //  $(str).velocity({opacity:[1,0] , translateY:[0,40]} , {duration:600 , easing:'linear', delay:k}).appendTo('#gridDetail');
                        $(str).appendTo('#gridDetail');
                        setTimeout(function () {
                            $('#gridDetail').find('.grid3').addClass('fadeInup');
//                                              bindhover();
                        }, 100);

//                                            bindhover();


                    }
                    //$('#gridDetail').append(str);
                    //  var $(we)= str;


                }
            }
        }
    });
}



function displayproduct() {

    fltrarray.catid = id;
    var dt = JSON.stringify(fltrarray);
    var URL = APIDOMAIN + "index.php/?action=getprodByfiltr";
    $.ajax({type: 'POST', url: URL, data: {dt: dt}, success: function (result) {

            var res = JSON.parse(result);
            if (res['error']['err_code'] == 0) {
                $('#gr_foot').remove();
                getProdDtl = res["result"];
                var total = res["total"];
                $('#total_Product').html(total + " Products");
                var obj = res["result"];

                if (obj !== null) {
                    var len = obj.length;
                    $('#gridDetail').html('');
                    var i = 0;
                    if (len > 0)
                    {

                        var str = '';
                        while (i < len)
                        {
                            str = generatelist(obj[i]);

                            stSearch.push(obj[i]);
                            i++;
                            var k = i * 200;
                            $(str).appendTo('#gridDetail');
                            setTimeout(function () {
                                $('#gridDetail').find('.grid3').addClass('fadeInup');
//                                              bindhover();
                            }, 100);

//                                            bindhover();


                        }
                    }
                } else {

                    $('#gridDetail').html('');
                }
            }
        }
    });
}

function makeAwish(th, e) {
    e.stopPropagation();
    //e.preventDefault();
    if ($(th).hasClass('beat')) {
        $(th).removeClass('beat');
        //Remove from wishlist
    } else {
        $(th).addClass('beat');
        //Add to wishlist
    }


}
