
var data = new Array();
var glbquality;
var glbcolor;
var glbcarat;
var catsize;
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
;

var pid;
 var arrdata = new Array();
function getarraydata() {

     arrdata=[];
    arrdata.push(pid);
     var pprice=$('#price').html();
	  arrdata.push(pprice);
  

    var xx = $('#qual').attr('qual_id').split('_');
    var quality = xx[xx.length - 1];

    var yy = $('#clr').attr('clr_id').split('_');
    var color = yy[yy.length - 1];

    var zz = $('#carat').attr('carat_id').split('_');
    var metal = zz[zz.length - 1];
    
   var sz = ($('#size').text().replace('Size',''));
   
    
    arrdata.push(color);
    arrdata.push(quality);
    arrdata.push(metal);
    arrdata.push(sz);
   
    
}
 
$('#add_to_cart').on('click', function () {
    
    getarraydata();
	
       newaddToCart(arrdata);
    
});
$(document).ready(function () {
   
    pid = GetURLParameter('pid');

    var URL = APIDOMAIN + "index.php/?action=getProductById&pid=" + pid;


    $.ajax({
        type: 'POST',
        url: URL,
        success: function (res) {

            data = JSON.parse(res);
            
            var dt = data['results'];
            var basic = dt['basicDetails'];
            var catAttr = dt['catAttr'];
            var vendor = dt['vendor'];
            var metalPurity = dt['metalPurity'];
            var metalColor = dt['metalColor'];
            var solitaire = dt['solitaire'];
            var diamonds = dt['dimond'];
            var uncut = dt['uncut'];

            storedWt  = parseFloat(dt['basicDetails']['mtlWgt']);
            storedMkCharge = parseFloat(dt['basicDetails']['mkngCrg']);



           // metalwgt = dt['basicDetails']['mtlWgt'];
            makchrg = dt['basicDetails']['mkngCrg'];
            //  metalprcprgm =  dt['metalPurity']['results']['prc']; console.log( dt['metalPurity']);
            var gemstone = dt['gamestone'];
            var images = dt['images'];


            catsize = dt['catAttr']['results'][1]['cid'];
            getcatsize(catAttr, metalwgt);
            if (data['error']['err_code'] == '0')
            {
                var imgstr = "";
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



                $(basic).each(function (i, vl) {
                    
                    var proname = vl.prdNm;
                    $('#vpro').text(vl.prdCod);
                    $('#proname').text(vl.prdNm);
                    $('#descrp').text(vl.productDescription);
                    var metalwght = vl.mtlWgt;
                   
                    var makingchrg = vl.mkngCrg;

                    var proccost = vl.procmtCst;

                    getbasicprice(makingchrg, metalwght);

                    if (basic.jewelleryType == 1) {
                        $('#stn').html('Gold');
                    } else if (basic.jewelleryType == 2) {
                        $('#stn').html('Plain-Gold');
                    } else if (basic.jewelleryType == 3) {
                        $('#stn').html('Platinum');
                    }
                    
                    var lstr = "";
                    lstr += '<span class="semibold">' + vl.leadTime + ' Days or less</span>';
                    $('#leadtime').append(lstr);
                    
                    
                 var bstr = "";
                 
               bstr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span> Gold </span></span><span class="fRight fmSansR" id="newWt"><span> ' + metalwght + '</span> Gms </span></div>';
               $('#desc').append(bstr);   

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
                            break;
                        }
                        case 2:
                        {
                            Nstr += '<span>Diamond</span>';
                            break;
                        }
                        case 3:
                        {
                            Nstr += '<span>Solitaire</span>';
                            break;
                        }
                        case 4:
                        {
                            Nstr += '<span>Diamond</span>';
                            break;
                        }
                        case 5:
                        {
                            var gemstn = gemstone.results[0].gemNm;
                            Nstr += '<span> ' + gemstn + ' /span>';
                            break;
                        }
                        case 6:
                        {
                            Nstr += '<span> Gemstones </span>';
                            break;
                        }
                        case 7:
                        {
                            gemstn = gemstone.results[0].gemNm;
                            Nstr += '<span>Diamond</span><span>' + gemstn + '</span>';
                            break;
                        }

                        case 8:
                        {
                            Nstr += '<span>Diamond</span><span>Gemstones</span>';
                            break;
                        }

                    }
                    $('#stn').append(Nstr);


                    if (basic.hasSol == 1)
                    {
                        //  $('#stn').html('Solitaire');
                        var solistr = "";
                        $(solitaire['results']).each(function (i, vl) {
                            var carat = vl.carat;
                            var price_per_carat = vl.prcPrCrat;

                            solistr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>' + vl.nofs + '</span><span> Solitaire</span></span><span class="fRight fmSansR"><span> ' + vl.carat + '</span> Carat</span></div>';
                            getSoliPrice(carat, price_per_carat);
                        });
                        $('#desc').append(solistr);

                    }



                    if (basic.hasDmd == 1)
                    {
                       
                        var diamstr = "";
                        var dQstr = "";
                       
                      
                        $(diamonds['results']).each(function (i, vl) {
                        
//                         
                            var dcarat = vl.crat;
                            storedDmdCarat = parseFloat(vl.crat);
                            
                            
                           
                            $.each(vl.QMast.results, function (x, y) {
                               
                                if (x == 0) {
                                    $('#qual').text(y.dVal="SI - IJ");
                                    $('#qual').attr('qual_id', y.id="9");
                                }
                                
                                
                                var dvdia = y.dVal;
                                var dvprc = y.prcPrCrat;
                                var dvdiaid = y.id;
                                
                                var dClass = dvdia.replace(/-|\s/g, "");
                                dClass = dClass.toLowerCase();
                                
                             
                                dQstr += '<div class="rad_wrap ">';
                                //dQstr+= '<input type="radio" name="selectM" id="dQuality_'+x+'_'+y.id+'" checked  onchange=\"diamondPrice('+y.prcPrCrat+vl.crat+')\" class="filled-in dn">';
                                dQstr += '<input type="radio" name="selectM" id="dQuality_' + x + '_' + y.id + '" value="' + y.dVal + '" data-value="' + y.prcPrCrat + '" onchange="setdmd(this)" class="filled-in dn">';
                                dQstr += '<label for="dQuality_' + x + '_' + y.id + '"></label>';
                                dQstr += '<div class="check2 ' + dClass + '"></div>';
                                dQstr += '<div class=" selector_label" >';
                                dQstr += '<div class="labBuffer">' + y.dVal + '</div>';
                                dQstr += '</div>';
                                dQstr += '</div>';

                                getdmdprice(dvprc,dcarat);

                            });
                          
                            $('#diQ').append(dQstr);
                            
                             diamstr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>' + vl.totNo + '</span><span> Diamonds</span></span><span class="fRight fmSansR"><span> ' + vl.crat + '</span> Carat</span></div>';
                             $('input[name="selectM"]').prop('checked', true);

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

                            uncutstr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>' + vl.totNo + '</span><span> Uncut-Diamond</span></span><span class="fRight fmSansR"><span> ' + vl.crat + '</span> Carat</span></div>';
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

                            gemstr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>' + vl.totNo + '</span><span> ' + vl.gemNm + ' </span></span><span class="fRight fmSansR"><span> ' + vl.crat + '</span> Carat</span></div>';
                            getGemsPrice(carat, price);

                        });
                        $('#desc').append(gemstr);

                    }


                    var purstr = "";
                    $.each(metalPurity.results, function (k, val) {
                       
                        if (k == 0) {
                            $('#carat').text(val.dNm);
                            $('#carat').attr('carat_id', val.id);
                        }
                        metalprc = val.prc;
                        var mcarat = val.dVal;

                        var kar = mcarat;
                        var re = /^(\w+)\s(\w+)$/;
                        var kar = kar.replace(re, "$2_$1").toLowerCase();

                        purstr += '<div class="rad_wrap fLeft">';

                        //" id="purity_'+k+'_'+val.id+'"   onchange=\"GoldPrice('+val.prc+')\"  class="filled-in dn">';
                        purstr += '<input type="radio" name="purity" id="purity_' + k + '_' + val.id + '" value="' + val.dVal + '" data-price="' + val.prc + '" onchange="setmetal(this)" class="filled-in dn">';
                        purstr += '<label for="purity_' + k + '_' + val.id + '"></label>';
                        purstr += '<div class="check2 ' + kar + '"></div>';
                        purstr += '<span class=" selector_label">';
                        purstr += '<div class="labBuffer">' + val.dVal + '</div>';
                        purstr += '</span>';
                        purstr += '</div>';

                        getPurPrice(metalprc, metalwght);
                        //  something(metalprc);
                    });
                    $('#pur').append(purstr);
                    $('input[name="purity"]').eq(0).prop('checked', true);



                    var clrstr = "";

                    $.each(metalColor.results, function (j, vl) {
                        var apcol = vl.dVal.toLowerCase();
                        if (j == 0) {
                            $('#clr').text(vl.dNm);
                            $('#clr').attr('clr_id', vl.id);
                        }
                        clrstr += '<div class="rad_wrap fLeft">';
                        clrstr += '<input type="radio" name="metal" id="color_' + j + '_' + vl.id + '" value= "' + vl.dVal + '" onchange="setclr(this)" class="filled-in dn">';
                        clrstr += '<label for="color_' + j + '_' + vl.id + '"></label>';
                        clrstr += '<div class="check2 ' + apcol + '"></div>';
                        clrstr += '<div class="fmSansB selector_label">';
                        clrstr += '<div class="labBuffer">' + vl.dVal + '</div>';
                        clrstr += '</div>';
                        clrstr += '</div>';
                    });
                    $('#colr').append(clrstr);
                    $('input[name="metal"]').eq(0).attr('checked', true);


                   // getTotal(catAttr);
                    
                    

                });


            }

                calculatePrice();
        }




    });
    
    
                 


});
   /*function metalwtt(a){
      var mtw=a;
      var bstr = "";
                 
               bstr += '<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span> Gold </span></span><span class="fRight fmSansR"><span> ' + mtw + '</span> Gms </span></div>';
               $('#desc').append(bstr);                  
 
   }*/
      


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
    mpurprc = mprc * metalwght; //console.log(mpurprc);
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
    var a = $(e).attr("id"); //changes
    // var s=t;
    var t = t - 2;
    dmdValue = pr[t];
    $('#qual').attr("qual_id", a); //changes
    $('#qual').html(va);

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
    }, 3000);
}

function setmetal(m) {
    var mt = $(m).closest('.rad_wrap').index();
    var wx = $(m).val();
    var b = $(m).attr("id"); //changes
    //  var t=mt-1;
    var mt = mt - 2;
    metalValue = mp[mt];
    //console.log(metalValue);
    $('#carat').attr("carat_id", b); //changes
    $('#carat').html(wx);
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
    }, 3000);

}

function setclr(c) {
    var cl = $(c).closest('.rad_wrap').index();
    var cr = $(c).val();
    var cc = $(c).attr("id");

    var cl = cl - 2;
    $('#clr').html(cr);
    $('#clr').attr("clr_id", cc);


    setTimeout(function () {
        $(c).closest('.selector_cont').find('.options_back').click();

    }, 400);

}

//making grandtot as global
var grandtot = 0;
var gtotal = 0
var catname;
var catid = 0;

var sizdefault;
var sizdefaulval;
function getcatsize(s, m) {
    catid = s;
    metalwt = m;

    catname = catid['results'][1]['name'];

    if (catname == 'Rings' || catname == 'Bangles') {


        $('#sizes').removeClass('dn');
        var cid = catsize;
        var URL = APIDOMAIN + "index.php/?action=getSizeListByCat&catid=" + catsize;
        var dat = "";
        $.ajax({
            type: 'POST',
            url: URL,
            success: function (res) {
                dat = JSON.parse(res);
            
                var strd="";
                var str = "";
                if(catname== 'Rings'){
                 sizdefault = dat.result[9]['id'];
                 sizdefaulval = dat.result[9]['sval'];
            }else if(catname== 'Bangles'){
                
                 sizdefault = dat.result[2]['id']; 
                sizdefaulval = dat.result[2]['sval'];
            }
              
                if (dat['error']['err_code'] == '0')
                {   
                    
                    strd+=  '<div class="actBtn font12 bolder" id="size"  name="sizes" data-size="'+sizdefault+'">Size '+sizdefaulval+'</div>';
                
                    $(dat.result).each(function (x, y) {
                     
                            if(y.sval==0.0){
                                y.sval='None';}
                        
                      
                           str += '<div class="selectOptions" name="siz" size_id ="'+y.id+'" data-val="'+y.sval+'" >Size ' + y.sval + '</div>';
                            
                    });
                  
                  $('#size').html(strd);
                    $('#genSize').append(str);
                   
                  //$('input[name="sizes"]').eq(0).prop('checked', true);
            
                    bindDrop();
                 getarraydata();
                }
            }
        });

    }
}



function calculatePrice()
{  
    var vatRate =(1/100);
    var selDiamond= parseFloat($('input[name="selectM"]:checked').attr('data-value')); 
    var selPurity= parseFloat($('input[name="purity"]:checked').attr('data-price'));
 
    var currentSize=parseFloat($('#size').text().replace('Size ',''));

    var mtlWgDav=0;
    var dmdPrice=0;
    var goldPrice=0;
   
    var dmdLength=$('input[name="selectM"]').length; 
    var bseSize=0;
    
    if(catname == 'Rings')
        bseSize = parseFloat(14);
      
     else if(catname == 'Bangles')
        bseSize = parseFloat(2.4);
       
    
    if(catname == 'Rings'){
          mtlWgDav = 0.05;}
    else if(catname == 'Bangles'){
         mtlWgDav = 7;
     }
   
    if(isNaN(currentSize))
    {
    
        if(catname == 'Rings')
        currentSize = parseFloat(14);
           
        else if(catname == 'Bangles')
            currentSize = parseFloat(2.4);
        
        else if(catname !== 'Rings' && catname !== 'Bangles'){
            currentSize =0;
        }
        
        
    }

    if(dmdLength>0)
    {
        dmdPrice=storedDmdCarat*selDiamond;
    }
  
   //console.log(currentSize +" 1")
    var changeInWeight=(currentSize-bseSize)*mtlWgDav; 
     newWeight=parseFloat(storedWt+(changeInWeight));
        newWeight= newWeight.toFixed(3);
       
  $('#newWt').html(newWeight);
  
    goldPrice=parseFloat(selPurity*newWeight);//console.log(selPurity * newWeight);
    var mkCharges=parseFloat(storedMkCharge*newWeight);
    var ttl=parseFloat(goldPrice+dmdPrice+mkCharges+ uncPrice + soliprc + gemsPrice);
    

//console.log("dmdPrice-> "+dmdPrice +" --- " + "changeInWeight -> "+changeInWeight+"  ---- "+"newWeight -> "+newWeight+ " goldPrice ->" +goldPrice +" mkCharges ->" +mkCharges);
    
    
    var totalNewPrice= Math.round(ttl+(ttl*vatRate));
  
     
    var abc =$('#price').html();
  //  $('#price').text(totalNewPrice);
     $('#price').numerator({
        toValue: totalNewPrice,
        delimiter: ',',
        onStart: function () {
            isStop = true;
        },
        onComplete: function () {
            $("#price").html(IND_money_format(totalNewPrice).toLocaleString('en'));
        }


    });
//var abc = IND_money_format(totalNewPrice).toLocaleString('en');
    $('#ch_price').find('.labBuffer').append(' @ ' + abc);
    
 
}

$('#addwishlist').click(function(){
    var userid=localStorage.getItem('jzeva_uid');  
    if(userid == undefined){
        alert('Please Do login for adding to Your wishlist');
    }
    else{ 
    getarraydata();
  
    var userid,wishdata={};
   wishdata['pid']= arrdata[0]; 
   var chr=""+arrdata[2]+"|@|"+arrdata[4]+"|@|"+arrdata[3];
   wishdata['col_car_qty']=chr; 
   wishdata['price']=arrdata[1];
   wishdata['user_id']=userid;
   var wishid=genOrdId();
   wishdata['wish_id']=wishid;
  
     var URL= APIDOMAIN + "index.php?action=addtowishlist";
    var data=wishdata; 
    var  dt = JSON.stringify(data);   
	$.ajax({  type:"post",  url:URL,  data: {dt: dt},   success:function(results){
		      console.log(results); 
		 
		} 
            });
      
    } 
});
  