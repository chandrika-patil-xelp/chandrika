$(document).ready(function(){
  
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
		      if(v.cat_name !== "Education")
		      {  
			cnt=0;
			mainheader+=" <div class='tabB fLeft'>  <div class='tab fLeft taba'>"+(v.cat_name).toUpperCase()+"  </div>  </div>"; 
			
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
			       cnt++;
			       subheader+='<div class="col100 fLeft">';
			       subheader+='<div class="menu_list fLeft"  onclick="prdctlist(this)"';
			       subheader+='id="'+v.cat_name+'_'+t.catid+'">'+t.cat_name+'</div>';
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
		     });  
		     
	 	$('.tab_buffer').prepend(mainheader);
	 	$('.menuB').prepend(subheader);
		bindHeader();
		    }
	       }); 
}

function prdctlist(ths)
{ 
  var ids=$(ths).attr('id').split('_'); 
  var catid; 
  if(ids[0] == "Fine Jewellery"){
    catid=ids[1];
    window.location.href = DOMAIN + "index.php?action=product_grid&id=" + catid + "";
  } 
  
}

$('#jzeva_log').click(function () {
        window.location.href = DOMAIN + "index.php?action=landing_page";
});

$('#usrlogout').click(function () {
        common.removeFromStorage('jzeva_email');
        common.removeFromStorage('jzeva_name');
        common.removeFromStorage('jzeva_uid');
        common.removeFromStorage('jzeva_mob');
        common.removeFromStorage('jzeva_cartid');
        var URLactn = window.location.search;


        var accnvar = '';
        accnvar = URLactn;
        accnvar = accnvar.split('=');
        accnvar = accnvar[1].split('&');

        if (accnvar[0] == 'myaccount') {
            window.location.href = DOMAIN + "index.php?action=landing_page";
        } else {
            var url = DOMAIN + 'index.php' + URLactn;
            window.location.href = url;
        }
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
