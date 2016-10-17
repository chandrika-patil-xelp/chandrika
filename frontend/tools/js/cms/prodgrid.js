var dmdValue = metalValue = soliValue = gemsValue = uncutValue = basicValue = 0;


var grandtotal = 0;
var grandtot = 0;
var getProdDtl = new Array();
var stock = new Array();
var aid;
var stSearch = new Array();

$(document).ready(function () {  
   // var URL = APIDOMAIN + "index.php/?action=getProGrid"; 
    var URL = APIDOMAIN + "index.php/?action=getProductdetailbycatid&id="+id;
    $.ajax({
        type: 'POST',
        url: URL,
        success: function (res) {


            res = JSON.parse(res);
	     
            if (res['error']['err_code'] == 0) {
                getProdDtl = res["result"];
                   var total = res["total"];
                $('#total_Product').html( total + " Products");
                var obj = res["result"];
		if(total<12)
		  $('#gr_foot').remove();
		var parnt=obj[0]['parntcatname'];
		if(parnt=='High Jewellery'){
		parnt=parnt.split(' ');
		parnt=parnt[1];
		}
		var chld=obj[0]['chldcatname'];
		var dplstr='<div class="breadP fLeft">'+ parnt +'</div>';
		dplstr+='<div class="breadP fLeft">'+ chld +'</div>';
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
                                          setTimeout(function(){
                                          $('#gridDetail').find('.grid3').addClass('fadeInup');
                                              bindhover();
                                            },100);

                                            bindhover();


                    }
                    //$('#gridDetail').append(str);
                  //  var $(we)= str;


                }
            }
        }
    });
});

function generatelist(obj) {

    var proStr = "";


    var images=[];
    if (obj['images'] !== null && obj['images'] !== undefined  && obj['images'] !== '' && obj['images'] !== 'undefined')
    {
        images = obj['images'].split(',');

    }
    else
    {
       images[0] ='uploads/noimg2.svg';
    }


   if(images.length==0)
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
filter(pid,gender,jType,Mclr,gemsName,Dshape);

    if(obj['totalgems'] !== null && obj['totalgems'] !== undefined && obj['gemstoneName'] !== null && obj['gemstoneName'] !== undefined && obj['gemscarat'] !== null && obj['gemscarat'] !== undefined ){

      var t = obj['totalgems'].split(',');
      var g = obj['gemstoneName'].split(',');
      var c= obj['gemscarat'].split(',');
     var i;

     }

    if(obj['totalSolitaire'] !== null && obj['totalSolitaire'] !== undefined && obj['Solicarat'] !== null && obj['Solicarat'] !== undefined){

      var t = obj['totalSolitaire'].split(',');
      var c= obj['Solicarat'].split(',');
     var j;

     }
     if(obj['totalUncut'] !== null && obj['totalUncut'] !== undefined && obj['Uncutcarat'] !== null && obj['Uncutcarat'] !== undefined){

      var t = obj['totalUncut'].split(',');
      var c= obj['Uncutcarat'].split(',');
     var k;

     }

     if(obj['totaldmd'] !== null && obj['totaldmd'] !== undefined && obj['dmdcarat'] !== null && obj['dmdcarat'] !== undefined){

      var p = obj['totaldmd'].split(',');
      var q= obj['dmdcarat'].split(',');
      var d;

     }



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
    if (diamond == '1' && diamond !== 'null')
    {
        var Diacarat = obj['dmdcarat'];
        var Diaprc = obj['dmdQPricepercarat'];
        price = price + getdmdprice(Diacarat, Diaprc);
    }

    price = price + getPurPrice(Mprc, Metalwgt);
    price = price + getbasicprice(Makchrg, Metalwgt);

    var vat = (1.20 / 100) * price;
    gtotal = price + vat;

    grandtot = gtotal.toFixed();
   grandtotal = common.IND_money_format(grandtot,0);
 // grandtotal = Number(grandtot).toLocaleString('en');

    proStr += '<div class="grid3 transition400" id="'+ obj['prdId'] +'"  >';
    proStr += '<div class="facet_front">';
    proStr += '<div class="grid_item" onclick=\"getProId(\''+ obj['prdId'] + '\')\" >';
    proStr += '<div class="grid_img"  onmousemove="bindrota(this , event)" lcor="0">';


     if(obj['default_image']!= null ){

       proStr += '<div style="background:url(\'' + IMGDOMAIN + obj['default_image'] + '\')no-repeat ; background-size: contain ; background-position: center"  class=""></div>';
     }
      else if( images[0] == "uploads/noimg2.svg")
        proStr += '<div style="background:url(\'' + IMGDOMAIN + images[0] + '\')no-repeat ; background-size: auto 50% ; background-position: center"  class=""></div>';
    else
        proStr += '<div style="background:url(\'' + IMGDOMAIN + images[0] + '\')no-repeat ; background-size: contain ; background-position: center"  class=""></div>';



    proStr += '</div>';
    proStr += '<div class="hovTr">';
    proStr += '<div class="hovTrans">';
    proStr += '<div class="plusCont">';
    proStr += '</div>';
    proStr += '</div>';
    proStr += '</div>';
    proStr += '<div class="grid_dets">';
    proStr += '<div class="grid_name txtOver transition300">' + obj['prdNm'] + '</div>';
    //proStr += '<div class="col100 color666">';
    //proStr += '<div class="col100  font11 transition300 txtOver">' + obj['jwelType'] + ' ' + obj['metal_weight'] + ' gms, Diamond ' + obj['dmdcarat'] + ' Carats</div>';
    proStr += '<div class="col100  font11 transition300 txtOver">' + obj['jwelType'] + '  Φ  Diamond </div>';
    proStr += '<div class="grid_price txtOver transition300">&#8377 ' + grandtotal + '</div>';
    proStr += '<div class="fmSansB smBtnDiv fLeft transition300">';
//    proStr += '<span class="u_line point lettSpace fLeft"  onclick=\"getProId(\''+ obj['prdId'] + '\')\">View Product</span>';
    proStr += '<div class="v360Btn" onclick=\"imgLoad(' + obj['prdId'] + ', event)\"></div>';
//    proStr += '<span class="u_line point lettSpace v_dets fRight" onclick="flipCard(this)">Quick View</span>';
    //proStr += '</div>';
    proStr += '</div>';
    proStr += '</div>';
    proStr += '<div class="soc_icons">';
    proStr += '<div class="soc_elem soc_wish2 transition300"></div>';
    // proStr += '<div class="soc_elem soc_comment transition300"></div>';
    proStr += '<div class="soc_elem soc_share transition300"></div>';
    proStr += '</div>';
    proStr += '</div>';
    proStr += '</div>';
    proStr += '<div class="facet_back" >';
    proStr += '<div class="facet_cont">';
    proStr += '<div class="light_header fLeft fmSansL"><span class="u_lineW">' + obj['prdNm'] + '</span></div>';
    proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + obj['jwelType'] + '</span><span class="fRight fmSansR"> ' + obj['metal_weight'] + ' gms</span> </div>';
    if (diamond == '1' && diamond !== 'null') {
        for(var d = 0; d < (p.length); d++){

        proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + p[d] + ' Diamonds</span><span class="fRight fmSansR"> ' + q[d] + ' Carats</span></div>';
    }
    }

    if (gems == '1' && gems !== 'null')
    {
       for(var i = 0; i < (c.length); i++){

       proStr +='<div class="desc_row fLeft font12 fmSansB " ><span class="txt_left fLeft">' + t[i]+ ' ' + g[i]+ '</span><span class="fRight fmSansR"> ' + c[i]+ ' Carats</span></div>';

    }
    }
    if (solitaire == '1' && solitaire !== 'null' && uncut !== '0') {
        for(var j = 0; j < (c.length); ++j){
        proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + t[j] + ' Solitaire </span> <span class="fRight fmSansR">' + c[j] + ' Carats</span></div>';
    }
   }
    if (uncut == '1' && uncut !== 'null' && uncut !== '0') {
         for(var u = 0; u < (c.length); ++u ){
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
        for(var d = 0; d < (p.length); d++){

        proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + p[d] + ' Diamonds</span><span class="fRight fmSansR"> ' + q[d] + ' Carats</span></div>';
    }
    }

    if (gems == '1' && gems !== 'null')
    {
       for(var i = 0; i < (c.length); i++){

       proStr +='<div class="desc_row fLeft font12 fmSansB " ><span class="txt_left fLeft">' + t[i]+ ' ' + g[i]+ '</span><span class="fRight fmSansR"> ' + c[i]+ ' Carats</span></div>';

    }
    }
    if (solitaire == '1' && solitaire !== 'null') {
        for(var j = 0; j < (c.length); ++j){
        proStr += '<div class="desc_row fLeft font12 fmSansB "><span class="txt_left fLeft">' + t[j] + ' Solitaire </span> <span class="fRight fmSansR">' + c[j] + ' Carats</span></div>';
    }
   }
    if (uncut == '1' && uncut !== 'null') {
         for(var u = 0; u < (c.length); ++u ){
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
    proStr += '</div>';
    return proStr;

}

function getProId(pid) {

    window.location.href = DOMAIN + "index.php?action=product_page&pid="+ pid;

}

function imgLoad(p,event){
    event.stopPropagation();

 if(!$('#'+p).hasClass('has360')){
     $('#'+p).addClass('has360');
  var URL = APIDOMAIN + "index.php/?action=getImagesByPid&pid=" +p;

  var dataI;
    $.ajax({
            type:'POST',
            url:URL,
            success:function(res){
               dataI = JSON.parse(res);

                  var imgstr = "";
                   $(dataI['images']).each(function(i, v) {

                imgstr = '<div style="background:url(\'' + v + '\')no-repeat ; background-size: contain ; background-position: center"  class=""></div>';
                       $('#'+p).find('.grid_img').append(imgstr);
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

var count=0;
  var page2=2;
  var limcount=12;
    $('#gr_foot').on('click' , function(){
      var page3=page2 + count++;

      var limit=12;
      var limitend = limit*page3;
     //$('#gr_foot').addClass('transdown');


    var URL1 = APIDOMAIN + "index.php/?action=getProductdetailbycatid&id="+id+"&page="+page3+"&limit="+limit+"";
  var tot_len = 0;
    $.ajax({
        type: 'POST',
        url: URL1,
        success: function (res) {

            res = JSON.parse(res);
	    
            if (res['error']['err_code'] == 0) {
            var total = res['total'];
            $('#total_Product').html("<strong>" + total + "</strong> Products");
                var obj1 = res["result"];
		if(obj1 !== null){
                var len = obj1.length;

                var i = 0;
                if (len > 0)
                {
                    var str = '';
                    while (i < len)
                    {
                        //  console.log(obj[i]);
                        str = generatelist(obj1[i]);
                        i++;
                        var k = i* 200;
                          //$(str).velocity({opacity:[1,0] , translateY:[0,40]} , {duration:600 , easing:'ease-out' , delay:k }).appendTo('#gridDetail');
                          $(str).appendTo('#gridDetail');
                          setTimeout(function(){
                          $('#gridDetail').find('.grid3').addClass('fadeInup');
                              bindhover();
                            },100);
                          }
                    }
                  //  $('#gridDetail').append(str);
              //  var $we= str;
	    } 
               if(limitend >= total){

                        $('#gr_foot').remove();
                    }
            }

        }

    });

    });


// $('#filter').click(function(){
//      window.location.href = DOMAIN + "index.php?action=filterPage";
// });



function filter(a,b,c,d,e,f){
 var proid = a;
 var gender = b;
 if(gender == '0'){
     var g = f;
 }
 var jweltype = c;
 var color = d;
 var gemstone_name = e;
 var diam_shape = f;


 /* $('.gemstone21').click(function(){
        $('#proid').addClass('dn');
       $('#pgrid').click(function(){

           if(gemstone_name == 'Ruby'){
            //   var len = stSearch.length;
          var selectedpid = proid;
           $('#proid').removeClass('dn');




           }
       });
   });*/
}
