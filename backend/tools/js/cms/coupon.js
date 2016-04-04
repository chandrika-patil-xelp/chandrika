var userid = 1;
$(document).ready(function() {
    $("#dateEdit,#date2Edit,#dateAdd,#date2Add").datepicker();
    $('.toggle-button').click(function() {
        $(this).toggleClass('toggle-button-selected');
    });
});


function editCoupon(id) {
    var ccode = $.trim($('#' + id + " .ccode").text());
    var desc = $.trim($('#' + id + " .cdescrp").text());
    var stDate = $.trim($('#' + id + " .stDate").text());
    var enDate = $.trim($('#' + id + " .enDate").text());

    $('#ccodeEdit').text(ccode);
    $('#descEdit').val(desc);


    var cpid = id.split("coupon_Jzeva_");
    coupon_id = cpid[1];
    coupon_code = ccode;
    openEditBox(1);
}


function submitEditedDet() {
    $('#descAdd').val($('#descEdit').val());
    $('#dateAdd').val($('#dateEdit').val());
    $('#date2Add').val($('#date2Edit').val());
    var vflag=validateEditForm();
    if(vflag)
    {
        values = {};
        values['coupon_id'] = encodeURIComponent(coupon_id);
        values['coupon_code'] = encodeURIComponent(coupon_code);
        values['description'] = encodeURIComponent($('#descEdit').val());
        values['start_date'] = $('#dateEdit').val();
        values['end_date'] = $('#date2Edit').val();
        values['userid'] = userid;
        values['active_flag'] = 1;
        var data = values;
        var dt = JSON.stringify(data);
        console.log(dt);

        var URL = APIDOMAIN + "index.php?action=addCoupon";
        $.ajax({
            url: URL,
            type: 'POST',
            data: {dt: dt},
            success: function(res) {
                res = JSON.parse(res);
                console.log(res);
                addCouponCallBack(res);
            }
        });
    }
    
}


function validateEditForm(){
    if($('#descEdit').val()==""){
        common.toast(0, 'Enter coupon description');
        highlight('descEdit',0);
        return false;
    }
  
    if($('#dateEdit').val()==""){
        common.toast(0, 'Enter coupon start date');
        highlight('dateEdit',0);
        return false;        
    }
    if($('#date2Edit').val()==""){
        common.toast(0, 'Enter coupon end date');
        highlight('date2Edit',0);
        return false;        
    }
    
    var d1=$('#dateEdit').val();
    var d2=$('#date2Edit').val()
    if((new Date(d1).getTime() > new Date(d2).getTime())){
        common.toast(0, 'End date can not be less then start date');
        highlight('date2Edit',0);
        return false;        
    }
    
    return true;   
}






$('#overlay').velocity({opacity: 0}, {delay: 0, duration: 0});
$('#couponEditDiv,#couponAddDiv').velocity({scale: 0, borderRadius: "65%", opacity: 0}, {delay: 0, duration: 0});

function openEditBox(type) {
    var ids = "";
    if (type === 1)
        ids = 'couponEditDiv';
    else if (type === 2) {
        ids = 'couponAddDiv';
        $('#couponAddDiv input').val('');
    }

    $('#overlay').removeClass('dn');
    $('#' + ids).removeClass('dn');
    setTimeout(function() {
        $('#overlay').velocity({opacity: 1}, {delay: 0, duration: 300, ease: 'swing'});
        $('#' + ids).velocity({scale: 1, borderRadius: "0", opacity: 1}, {delay: 180, duration: 300, ease: 'swing'});
    }, 10);
}

function closeEditBox() {
    $('#couponEditDiv,#couponAddDiv').velocity({scale: 0, borderRadius: "65%", opacity: 0}, {duration: 200, delay: 0, ease: 'swing'});
    $('#overlay').velocity({opacity: 0}, {delay: 100, ease: 'swing'});
    setTimeout(function() {
        $('#overlay').addClass('dn');
    }, 400);
}

var coupon_id = "";
var coupon_code = "";

function addCoupon()
{
    
    var vflag=validateAddForm();
    if(vflag)
    {
        values = {};
        values['coupon_id'] = encodeURIComponent(coupon_id);
        values['coupon_code'] = encodeURIComponent(coupon_code);
        values['coupon_name'] = encodeURIComponent($('#coupName').val());
        values['discount_type'] = $('#discount_type').val();
        values['discount_amount'] = $('#amt').val();
        values['minimum_amount'] = $('#minimum_amount').val();
        values['description'] = encodeURIComponent($('#descAdd').val())
        values['start_date'] = $('#dateAdd').val();
        values['end_date'] = $('#date2Add').val();
        values['userid'] = userid;
        values['active_flag'] = 1;
        var data = values;
        var dt = JSON.stringify(data);
        console.log(dt);

        var URL = APIDOMAIN + "index.php?action=addCoupon";
        $.ajax({
            url: URL,
            type: 'POST',
            data: {dt: dt},
            success: function(res) {
                res = JSON.parse(res);
                console.log(res);
                addCouponCallBack(res);
            }
        });
    }
}

function addCouponCallBack(data)
{
    if (data['error']['err_code'] == '0')
    {
        common.toast(1, 'Coupon added successfully');

        setTimeout(function() {
            location.href = DOMAIN + "backend/?action=coupon";
        }, 300);

    }
    else
    {
        common.toast(0, 'Error in adding category');

    }

}


function validateAddForm()
{

    if($('#coupName').val()==""){
        common.toast(0, 'Enter coupon name');
        highlight('coupName',0);
        return false;
    }
    if($('#amt').val()==""){
        if($('#discount_type').val()==1)
        common.toast(0, 'Enter discount amount');
        else
        common.toast(0, 'Enter discount percentage');
        highlight('amt',0);
        return false;
    }
    if($('#minimum_amount').val()==""){
        common.toast(0, 'Enter minimum amount');
        highlight('minimum_amount',0);
        return false;
    }
    if($('#descAdd').val()==""){
        common.toast(0, 'Enter coupon description');
        highlight('descAdd',0);
        return false;
    }
    if($('#dateAdd').val()==""){
        common.toast(0, 'Enter coupon start date');
        highlight('dateAdd',0);
        return false;        
    }
    if($('#date2Add').val()==""){
        common.toast(0, 'Enter coupon end date');
        highlight('date2Add',0);
        return false;        
    }
    
    var d1=$('#dateAdd').val();
    var d2=$('#date2Add').val()
    if((new Date(d1).getTime() > new Date(d2).getTime())){
        common.toast(0, 'End date can not be less then start date');
        highlight('date2Add',0);
        return false;        
    }
    
    return true;
    
}




var couponList = new Array();


function getCoupounList()
{

    var URL = APIDOMAIN + "index.php?action=getCouponList";
    $.ajax({
        url: URL,
        type: "POST",
        success: function(res) {
            res = JSON.parse(res);
            couponList = res['result'];
            couponCallBack(res);
        }
    });

}


function couponCallBack(data)
{
    var str = "";
    var copcnt=0;
    $(couponList).each(function(i, v) {
        if (couponList[i]['aflag'] !="2")
        {
            var cdat = v.cdt.split("|");
            var stdate = v.stdate.split("|");
            var enddate = v.enddate.split("|");


            str += "<li id='coupon_Jzeva_" + v.id + "'>";
            str += "<div class='date fLeft txtCenter'>";
            str += "<span class='upSpan'>" + cdat[0] + "</span>";
            str += "<span class='lwSpan'>" + cdat[1] + "</span>";
            str += "</div>";
            str += "<div class='ccode fLeft fmOpenB'>" + v.code + "</div>";
            str += "<div class='cdescrp txtOver fLeft'>" + v.desc + "</div>";
            str += "<div class='stDate fLeft txtCenter'>";
            str += stdate[0];
            str += "</div>";
            str += "<div class='enDate fLeft txtCenter'>";
            str += enddate[0];
            str += "</div>";
            str += "<div class='actt fLeft'>";
            //str += "<div class='deltBtn fRight transition300' onclick=\"changeStatus('" + v.id + "',this,3)\"></div>";
            str += "<div class='deltBtn fRight transition300'  onclick=\"setClick('" + v.id + "',2);showConfirmBox();\"></div>";
            str += "<div class='editBtn fRight transition300' onclick=\"editCoupon('coupon_Jzeva_" + v.id + "');\"></div>";
            
            /*if (v.aflag == "1")
            {
                str += "<div class='toggle-button toggle-button-selected  fLeft' onclick=\"changeStatus('" + v.id + "',this)\">";
            }
            else
            {
                str += "<div class='toggle-button  fLeft' onclick=\"changeStatus('" + v.id + "',this)\">";
            }*/
            
            
            if (v.aflag == "1")
            {
                str += "<div class='toggle-button toggle-button-selected  fLeft' onclick=\"changeStatus('" + v.id + "')\">";
            }
            else
            {
                str += "<div class='toggle-button  fLeft' onclick=\"changeStatus('" + v.id + "')\">";
            }
            
            
            str += "<span class='fActive'>On</span>";
            str += "<button class='button'></button>";
            str += "<span class='fDactive'>Off</span>";
            str += "</div>";
            str += "</div>";
            str += "</li>";
            
            copcnt++;
        }

    });
    if (copcnt == 0)
    {
        $('#noresults').removeClass('dn');
    }
    else
    {
        $('#noresults').addClass('dn');
    }
    $('#couponCount').html(copcnt);
    $('.couponList').html(str);
    common.bindToggle();
}

getCoupounList();


function changeStatus(aid,dst) {
    setTimeout(function() {

//        var st = 0;
//        if (dst != undefined)
//        {
//            st = 2;
//            $(obj).parent().find('div.toggle-button').removeClass('toggle-button-selected');
//
//        }
//        else
//        {
//            var pLeft = $(obj).find(".button").position().left;
//            if (pLeft == 0)
//            {
//                st = 0;
//            }
//            else
//            {
//                st = 1;
//            }
//
//        }


        var st = 0;
        if (dst != undefined)
        {
            st = 2;
            $('#coupon_Jzeva_'+aid).find('div.toggle-button').removeClass('toggle-button-selected');

        }
        else
        {
            var pLeft = $('#coupon_Jzeva_'+aid).find(".button").position().left;
            if (pLeft == 0)
            {
                st = 0;
            }
            else
            {
                st = 1;
            }

        }

        console.log(st);

        var URL = APIDOMAIN + "index.php?action=updateCouponStatus";
        values = {};
        values['active_flag'] = st;
        values['userid'] = 1;
        values['coupon_id'] = aid;
        var data = values;

        var dt = JSON.stringify(data);

        $.ajax({
            url: URL,
            type: 'POST',
            data: {dt: dt},
            success: function(res) {
                res = JSON.parse(res);
                console.log(res);
                changeStatusCallBack(res);
            }
        });

    }, 350);
}


function changeStatusCallBack(data)
{

    if (data['error']['err_code'] == '0')
    {
        common.toast(1, 'Status updated successfully');
        getCoupounList();
    }
    else
    {
        common.toast(0, 'Error in updating status');
        getCoupounList();
    }
    hideConfirmBox();
}


function highlight(id,type)
{
        if(type==0)        
            $('#'+id).addClass('error');
        
        
        else if(type==1)
            $('#'+id).next('label').addClass('error');
        
        bindError();
    
}


function bindError()
{

    $('.txtSelect.error').bind('click',function(){
        $(this).removeClass('error');
        $(this).unbind();
    });
    
    $('.txtInput.error').bind('click',function(){
        $(this).removeClass('error');
        //$(this).unbind();
    });
    
}

$('#confirmBox').velocity({scale: 0, borderRadius: '50%'}, {delay: 0, duration: 0});
$('#delOverlay').velocity({opacity: 0}, {delay: 0, duration: 0});

function showConfirmBox() {
    $('#delOverlay,#confirmBox').removeClass('dn');
    setTimeout(function() {
        $('#delOverlay').velocity({opacity: 1}, {delay: 0, duration: 300, ease: 'swing'});
        $('#confirmBox').velocity({scale: 1, borderRadius: '2px', opacity: 1}, {delay: 80, duration: 300, ease: 'swing'});
    }, 10);
}


function setClick(data,st)
{   
    var str="changeStatus('"+data+"',"+st+")";
    $('#prddeleteBtn').attr('onclick',str);
}

function hideConfirmBox() 
{
    $('#delOverlay').velocity({opacity: 0}, {delay: 0, duration: 300, ease: 'swing'});
    $('#confirmBox').velocity({opacity: 0}, {delay: 0, duration: 300, ease: 'swing', queue: false});
    $('#confirmBox').velocity({scale: 0, borderRadius: '50%'}, {delay: 300, duration: 0, ease: 'swing'});
    setTimeout(function() {
        $('#delOverlay,#confirmBox').addClass('dn');
    }, 1010);
    $('#prddeleteBtn').removeAttr('onclick');
}