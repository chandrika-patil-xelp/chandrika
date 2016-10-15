
 var data=new Array();
 var glbquality;
 var glbcolor;
 var glbcarat;
 
var dmdValue =metalValue=soliValue=gemsValue=uncutValue =basicValue= 0;
var gIndex=0;
var total=0;

function GetURLParameter(Param)
       {
        
 var PageURL = window.location.search;
 var URLVariables = PageURL.split('&');
for (var i = 0; i < URLVariables.length; i++)
{
 var ParameterName = URLVariables[i].split('=');
if (ParameterName[0] == Param){
return ParameterName[1];
   }

}
}
function IND_money_format(money)
   {
var m = '';
money = money.toString().split("").reverse();
var len = money.length;
for(var i=0;i<len;i++)
{
if(( i == 3 || (i > 3 && ( i - 1) % 2 == 0) ) && i !== len)
{
m += ',';
}
m += money[i];
}

return m.split("").reverse().join("");
   };

var pid;
  $('#add_to_cart').on('click', function () {
 
	   var arrdata=new Array();
	  arrdata.push(pid);
	  arrdata.push(grandtot);
	
	  var xx= $('#qual').attr('qual_id').split('_');
       var quality =xx[xx.length-1];
       
       var yy = $('#clr').attr('clr_id').split('_');
        var color =yy[yy.length-1];
        
       var zz = $('#carat').attr('carat_id').split('_');
        var metal =zz[zz.length-1];
	 
	  arrdata.push(color);
	   arrdata.push(quality); 
	    arrdata.push(metal);   
 
	   newaddToCart(arrdata);
	}); 
$(document).ready(function(){ 
  
      pid = GetURLParameter('pid'); 
      
	
	
      var URL = APIDOMAIN+"index.php/?action=getProductById&pid="+pid;
            
                
        $.ajax({
            type:'POST',
            url:URL,
            success:function(res){
              
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
                var gemstone = dt['gamestone']; 
                var images = dt['images']; 
             
                  
                if (data['error']['err_code'] == '0')
            {  
                  var imgstr = "";  
		  if(dt['basicDetails']['default_image']!== null){
		       imgstr='<div class="imgHolder img1" style="background:  url(\''+ IMGDOMAIN + dt['basicDetails']['default_image']+'\')no-repeat;background-size:115%;background-position:center"></div>';
		        $('#img-view').prepend(imgstr);
		  }  
                   $(images['images']).each(function(i, v) {
                     
             imgstr='<div class="imgHolder " style="background:  url(\''+ v +'\')no-repeat;background-size:contain;background-position:center"></div>';
                   $('#img-view').append(imgstr);
                
                });  
                
 
             $(basic).each(function(i, vl) {
               
                             var proname = vl.prdNm;
                            $('#vpro').text(vl.prdCod);
                            $('#proname').text(vl.prdNm);
                            $('#descrp').text(vl.productDescription);
                           var metalwght = vl.mtlWgt;
                           var makingchrg = vl.mkngCrg;
                           var proccost = vl.procmtCst;
                   getbasicprice(makingchrg,metalwght);
                    
                    if(basic.jewelleryType == 1){
                        $('#stn').html('Gold');
                    }
                    else if (basic.jewelleryType == 2){
                         $('#stn').html('Plain-Gold');
                    }
                     else if (basic.jewelleryType == 3){
                         $('#stn').html('Platinum');
                    }
                  
                   var lstr ="";
                  lstr +='<span class="semibold">'+vl.leadTime+' Days or less</span>';
                  $('#leadtime').append(lstr);
                   
                   var bstr = "";
                   bstr+='<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span> Gold </span></span><span class="fRight fmSansR"><span> '+vl.mtlWgt+'</span> Gms </span></div>'; 
                   $('#desc').append(bstr);
                 
                 if (basic.hasSol == 1){
                       var soliNstr = "";
                        soliNstr+= '<span> , <span>Solitaire</span></span>';
                   }
                    $('#stn').append(soliNstr);
                    
                 if (basic.hasSol == 1)
                        {
                          //  $('#stn').html('Solitaire');
                            var solistr = "";
                            $(solitaire['results']).each(function(i, vl) {
                              var carat = vl.carat;
                              var price_per_carat = vl.prcPrCrat; 
	   
                                solistr+='<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>'+vl.totNo+'</span><span> Solitaire</span></span><span class="fRight fmSansR"><span> '+vl.crat+'</span> Carat</span></div>'; 
                             getSoliPrice(carat,price_per_carat);
                            });
                             $('#desc').append(solistr);
                          
                        }
                       
                  if(basic.hasDmd == 1){
                     var diaNstr = ""
                     
                      diaNstr+= '<span> , <span>Diamond</span></span>';
                 }
                  $('#stn').append(diaNstr);
                  
                   if (basic.hasDmd == 1)
                        {
                           
                            var diamstr = "";
                            var dQstr="";
                            $(diamonds['results']).each(function(i, vl) {
                                var dcarat =vl.crat;
                               var defaultDia;
                                $.each(vl.QMast.results, function(x, y) {
                                   if(x==0){
                                       $('#qual').text(y.dNm);
				       $('#qual').attr('qual_id',y.id); //changes
                                   }
                                  
                                    var dvdia = y.dVal;
                                    var dvprc= y.prcPrCrat;
                                    var dvdiaid = y.id;
                                    
                                  
                                   
                         dQstr+= '<div class="rad_wrap fLeft">';
                       //dQstr+= '<input type="radio" name="selectM" id="dQuality_'+x+'_'+y.id+'" checked  onchange=\"diamondPrice('+y.prcPrCrat+vl.crat+')\" class="filled-in dn">';
                        dQstr+= '<input type="radio" name="selectM" id="dQuality_'+x+'_'+y.id+'" value="'+y.dVal+'"  onchange="setdmd(this)" class="filled-in dn">';
                         dQstr+= '<label for="dQuality_'+x+'_'+y.id+'"></label>';
                         dQstr+= '<div class="check"></div>';
                         dQstr+= '<span class="fmSansB selector_label" >'+y.dVal+'</span>';
                         dQstr+= '</div>';
                                  
                                     getdmdprice(dvprc,dcarat);
                                      
                                });
                                 $('#diQ').append(dQstr);
                                 diamstr+='<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>'+vl.totNo+'</span><span> Diamonds</span></span><span class="fRight fmSansR"><span> '+vl.crat+'</span> Carat</span></div>';
                                $('input[name="selectM"]').eq(0).attr('checked',true);
                                
                            });
                            $('#desc').append(diamstr);
                          
                        }
                        
                   if (basic.hasUnct == 1){
                       var uncutNstr = "";
                        uncutNstr+= '<span> , <span>Uncut-Diamond</span></span>';
                   }
                    $('#stn').append(uncutNstr);
                   
                   if (basic.hasUnct == 1)
                        {
                           //  $('#stn').html('Uncut-Diamond');
                            var uncutstr = "";
                           
                            $(uncut['results']).each(function(i, vl) {
                                
                                 var ids = vl.unctId
                                 var carat = vl.crat;
                                var price = vl.prcPrCrat;
                              
                                uncutstr+='<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>'+vl.totNo+'</span><span> Uncut-Diamond</span></span><span class="fRight fmSansR"><span> '+vl.crat+'</span> Carat</span></div>';
                              getUncutPrice(price,carat);
                            });
                             $('#desc').append(uncutstr);
                        }
                    if (basic.hasGem == 1)
                        {
                            // $('#stn').html('Gemstone');
                            var gemstr = "";
                            var gemNstr ="";
                            $(gemstone['results']).each(function(i, vl) {
                                 var ids = vl.gemId;                
                                var gvalue = vl.gemNm;
                                 var carat = vl.crat;
                                var price = vl.prcPrCrat;
                       
                                gemstr+='<div class="desc_row fLeft font12 fmrobor "><span class="txt_left fLeft"><span>'+vl.totNo+'</span><span> '+vl.gemNm+' </span></span><span class="fRight fmSansR"><span> '+vl.crat+'</span> Carat</span></div>';
                             getGemsPrice(carat,price);
                               gemNstr+= '<span> , <span>'+vl.gemNm+'</span></span>';
                            });
                             $('#desc').append(gemstr);
                             $('#stn').append(gemNstr);
                        }
                      
                 
                         var purstr="";
                        $.each(metalPurity.results, function(k, val) {
                          
                              if(k==0){ 
                            $('#carat').text(val.dNm);
			      $('#carat').attr('carat_id',val.id); //changes
                        }
                           var metalprc = val.prc;
                           var mcarat = val.dVal;
                          
                            purstr+='<div class="rad_wrap fLeft">';
                            //purstr+='<input type="radio" name="size
                            //
                            //" id="purity_'+k+'_'+val.id+'"   onchange=\"GoldPrice('+val.prc+')\"  class="filled-in dn">';
                            purstr+='<input type="radio" name="size" id="purity_'+k+'_'+val.id+'" value="'+val.dVal+'" onchange="setmetal(this)" class="filled-in dn">';
                            purstr+='<label for="purity_'+k+'_'+val.id+'"></label>';
                            purstr+='<div class="check"></div>';
                            purstr+='<span class="fmSansB selector_label">'+val.dVal+'</span>'
                            purstr+='</div>';
                            
                            getPurPrice(metalprc,metalwght);
                        });
                        $('#pur').append(purstr);
                        $('input[name="size"]').eq(0).attr('checked',true);
                    
                        
                    
                        var clrstr="";
                        
                        $.each(metalColor.results, function(j, vl) {
                           if(j==0){
                                $('#clr').text(vl.dNm);
				$('#clr').attr('clr_id',vl.id); //changes
                            }
                        clrstr+='<div class="rad_wrap fLeft">';
                        clrstr+= '<input type="radio" name="metal" id="color_'+j+'_'+vl.id+'" value= "'+vl.dVal+'" onchange="setclr(this)" class="filled-in dn">';
                        clrstr+='<label for="color_'+j+'_'+vl.id+'"></label>';
                        clrstr+='<div class="check"></div>';
                        clrstr+='<span class="fmSansB selector_label">'+vl.dVal+'</span>';
                        clrstr+='</div>';
                        });
                        $('#colr').append(clrstr);
                    $('input[name="metal"]').eq(0).attr('checked',true);
                  
              
                   getTotal();
                 
                    });
                }
 
	   
    }
             
            
        

});

});


    
    
var bs = [];
var basicchrg=0;
function getbasicprice(makingchrg,mtalwt){
   var mkngchrg =  parseFloat(makingchrg);
   var metalwgt =  parseFloat(mtalwt);
  
    basicchr = mkngchrg * metalwgt;
        basicchrg += basicchr;
            bs.push(basicchrg);
            basicValue = bs[gIndex];
           
}


var pr=[];
var diaprice=0;
function getdmdprice(dvprc,dcarat){
     
    var prc = parseFloat(dvprc);   
    var car = parseFloat(dcarat);
            
         diaprice = prc * car;  
          //  diaprice += diapri;
           pr.push(diaprice); 
          dmdValue=pr[gIndex];  
        
}

var mp = [];
var mpurprc=0;
function getPurPrice(metalprc,metalwght){
 
  var mprc = parseFloat(metalprc);
  var metalwght = parseFloat(metalwght);
   mpurprc = mprc * metalwght;
           // mpurprc += mpurp;
  mp.push(mpurprc);
  metalValue = mp[gIndex];
  
}

var sol = [];
var soliprc=0;
function getSoliPrice(carat,price_per_carat){
    
    var solcarat = parseFloat(carat);
    var solprc = parseFloat(price_per_carat);
     solipr = solprc * solcarat;
        soliprc += solipr;
    sol.push(soliprc);
    soliValue = sol[gIndex];    
}

var un =[];
var uncPrice=0;
function getUncutPrice(price,carat){
    
    var uprice = parseFloat(price);
    var ucarat = parseFloat(carat);
     uncPri = uprice * ucarat;
            uncPrice += uncPri;
    un.push(uncPrice);
    uncutValue = un[gIndex];
    
}


var gems =[];
var gemsPrice = 0;
function getGemsPrice(price,carat){
   
    var gprice = parseFloat(price);
    var gcarat = parseFloat(carat);
     gemsPri = gprice * gcarat;
         gemsPrice += gemsPri;
 
    gems.push(gemsPrice);
    gemsValue = gems[gIndex];
   
}

function setdmd(e){
     var t =$(e).closest('.rad_wrap').index();
     var va=$(e).val();
      var a = $(e).attr("id"); //changes
   // var s=t;
     var t= t-2;
      dmdValue=pr[t]; 
      $('#qual').attr("qual_id",a); //changes
      $('#qual').html(va);
      
    // glbquality=s;
            getTotal(1);
       
 }
 
 function setmetal(m){
     var mt = $(m).closest('.rad_wrap').index();
     var wx=$(m).val();
     var b = $(m).attr("id"); //changes
   //  var t=mt-1;
     var mt = mt-2;
     metalValue  = mp[mt];
      $('#carat').attr("carat_id",b); //changes
      $('#carat').html(wx);
    // glbcarat=t;
     setTimeout(function() {
            getTotal(1);
        }, 50);
     
 }
 
 function setclr(c){
     var cl = $(c).closest('.rad_wrap').index();
     var cr=$(c).val();
     var cc = $(c).attr("id"); //chanages
  //   var n=cl-1;
     var cl = cl-2;
     $('#clr').html(cr);
      $('#clr').attr("clr_id",cc);//chnages
   //  glbcolor=cc;
     
 }

//making grandtot as global
var grandtot=0;
var gtotal=0
function getTotal(type){
  
       total=  parseFloat(basicValue)+ parseFloat(dmdValue) + parseFloat(metalValue) + uncPrice + soliprc + gemsPrice ;
    
    // total= parseFloat(dmdValue) + parseFloat(metalValue) + gemsPrice  + parseFloat(soliValue) + parseFloat(uncutValue)+ parseFloat(basicValue) ;
     
        var vat = (1.20 / 100) * total;
        
        gtotal = total + vat;
      
         grandtot = gtotal.toFixed();
   //  $("#price").html(Number(grandtot).toLocaleString('en'));
        $("#price").html(IND_money_format(grandtot).toLocaleString('en'));
     
        if (type == 1){
                   
           $("#price").html(IND_money_format(grandtot).toLocaleString('en'));
        }
}

 
 
   
   