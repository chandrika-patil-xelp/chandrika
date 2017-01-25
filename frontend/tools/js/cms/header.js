$(document).ready(function(){
  $(window).scroll(function () {
                   if ($(this).scrollTop() > 100) {
                       $('.backTop').removeClass("dn");
                   } else {
                       $('.backTop').addClass("dn");
                   }
               });
                $('.backTop').click(function () {
                       $('html,body').animate({scrollTop: 0});
                                        });
  getheader();
});

function getheader()
{
  var mainheader="";
  var subheader="";
  var cnt=0;
  var URL = APIDOMAIN + "index.php?action=getSubCat&catid=99999";
  $.ajax({ url: URL, type: "GET",datatype: "JSON",success: function(results) {
      
		     var obj=JSON.parse(results);
		     $(obj['root']).each(function(r,v){
		      if(v.cat_name !== "Education" && v.cat_name !== "Bespoke")
		      {
			cnt=0;
			var mainmn="";
			var mainmn=v.cat_name; mainmn=mainmn.trim(' ');
			mainmn=mainmn.toLowerCase().replace(' ','-');
			mainheader+=" <div class='tabB fLeft'> <a href='"+DOMAIN+""+mainmn+"/pid-"+v.catid+"'> <div class='tab fLeft taba' >"+(v.cat_name).toUpperCase()+"  </div> </a> </div>"; 
			 
			 if(v['subcat'] == undefined)
			 {
			    subheader+= '<div class="menu_elm ">';
			    subheader+= '<div class="menu_banner"></div>';
			    subheader+= '</div>'; 
			   
			 }
			 else
			 {
			    subheader+='<div class="menu_elm ">';
			    subheader+='<div class="col33 fLeft">'; 
			    $(v['subcat']).each(function(p,t)
			    {
			       var submn="";
			       submn=t.cat_name;   submn=submn.trim(' ');
			       submn=submn.toLowerCase().replace(' ','-'); 
			       cnt++;
			       subheader+='<div class="col100 fLeft">';
			       subheader+='<a href="'+DOMAIN+''+submn+'/pid-'+t.catid+'"><div class="menu_list fLeft"  ';
			       subheader+='id="'+v.cat_name+'_'+t.catid+'">'+t.cat_name+'</div></a>';
			       subheader+='</div>';
			       if(cnt % 2 == 0)
			       {
				 subheader+='</div><div class="col33 fLeft">';
			       }
			       
			    });
			    if(cnt % 2 == 1) 
				 subheader+='</div>'; 
			    subheader+='</div>';
			 }
		       }
		       if($.trim(v.cat_name) == "Bespoke"){ 
			  var mainmn="";
			var mainmn=v.cat_name; mainmn=mainmn.trim(' ');
			mainmn=mainmn.toLowerCase().replace(' ','-');
			mainheader+=" <div class='tabB fLeft'> <a href='"+DOMAIN+"index.php?action=bespoke'> <div class='tab fLeft taba' >"+(v.cat_name).toUpperCase()+"  </div> </a> </div>"; 
			
			if(v['subcat'] == undefined)
			 {
			    subheader+= '<div class="menu_elm ">';
			    subheader+= '<div class="menu_banner"></div>';
			    subheader+= '</div>'; 
			   
			 }
		       }
		     });  
		     
	 	$('.tab_buffer').prepend(mainheader);
	 	$('.menuB').prepend(subheader);
		bindHeader();
		    }
	       }); 
}
 
 

$('#usrlogout').click(function () {
        common.removeFromStorage('jzeva_email');
        common.removeFromStorage('jzeva_name');
        common.removeFromStorage('jzeva_uid');
        common.removeFromStorage('jzeva_mob');
        common.removeFromStorage('jzeva_cartid');
	common.removeFromStorage('jzeva_buyid');
	common.removeFromStorage('jzeva_shpid');

        var URLactn = window.location.href; 
        var accnvar = ''+URLactn; 
        accnvar = accnvar.replace(DOMAIN,'');
	 
	if (accnvar.indexOf('?') > -1)
	{ 
	  var linkarr = accnvar.split('?');  
	  if(linkarr[1].indexOf('&') > -1){
	     var tmplinkarr=""+linkarr[1];
	     tmplinkarr=tmplinkarr.split('&');
	     var tmpaccnstr=""+tmplinkarr[0];
	     tmpaccnstr=tmpaccnstr.split('='); 
	     if (tmpaccnstr[1] == 'myaccount')
	       window.location.href = DOMAIN + "index.php?action=landing_page";
	     else 
		window.location.href =DOMAIN +accnvar;   
	  }
	  else
	    window.location.href =DOMAIN +accnvar;    
	}
	else
	   window.location.href =DOMAIN +accnvar;   
	 
    });


$(document).ready(function () {
        var actnp = GetURLParameter('actn');
        var usid = common.readFromStorage('jzeva_uid');
        if (actnp == "lognpopup") {
            setTimeout(function () {
                if (usid == null || usid == undefined)
                    openPopUp();
            }, 3000);

        }
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

 $('#Track_ord').click(function () {
        var ordno = $('#ord_no').val();
        var inptdata = $('#ord_email').val();
        var validationFlag = 1;
        var filter = /^[0-9-+]+$/;
        if (!filter.test(ordno)) {
            validationFlag = 0;
            common.msg(0, 'Order number is Invalid');
        } else
        {
            if ($.isNumeric(inptdata))
            {
                var filter = /^[0-9-+]+$/;
                if (inptdata === '' || inptdata === null) {
                    validationFlag = 0;
                    common.msg(0, 'Please enter your Mobile no');
                } else if (isNaN(inptdata) || (inptdata.length < 10)) {
                    validationFlag = 0;
                    common.msg(0, 'Mobile no. Invalid');
                } else if (!filter.test(inptdata)) {
                    validationFlag = 0;
                    common.msg(0, 'Mobile number is Invalid');
                }
                if (validationFlag == 1)
                {
                    var URL = APIDOMAIN + "index.php?action=checktrackord&orderid=" + ordno + "&mobile=" + inptdata;

                }
            } else
            {
                var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
                if (inptdata === '' || inptdata === null) {
                    validationFlag = 0;
                    common.msg(0, 'Please enter your Email id');
                } else if (!reg.test(inptdata)) {
                    validationFlag = 0;
                    common.msg(0, 'Invalid Email.id');
                }
                if (validationFlag == 1)
                {
                    var URL = APIDOMAIN + "index.php?action=checktrackord&orderid=" + ordno + "&email=" + inptdata;
                }
            }
        }
        if (validationFlag == 1)
        {
            $.ajax({url: URL, type: 'POST', success: function (res) {
                    var data = JSON.parse(res);

                    if (data['error']['err_code'] == 0) {
                        var ordid = data['result']['order_id'];
                        window.location.href = DOMAIN + "index.php?action=guestaccount&trkid=" + ordid;
                    } else if (data['error']['err_code'] == 1)
                        common.msg(0, data['error']['err_msg']);
                }
            });
        }

    });
 