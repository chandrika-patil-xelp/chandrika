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


    values = {};
    values['coupon_id'] = encodeURIComponent(coupon_id);
    values['coupon_code'] = encodeURIComponent(coupon_code);
    values['description'] = encodeURIComponent($('#descEdit').val())
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
    $('#couponCount').html(couponList.length);
    $(couponList).each(function(i, v) {
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
        str += "<div class='deltBtn fRight transition300' onclick=\"changeStatus('" + v.id + "',this,3)\"></div>";
        str += "<div class='editBtn fRight transition300' onclick=\"editCoupon('coupon_Jzeva_" + v.id + "');\"></div>";
        if (v.aflag == "1")
        {
            str += "<div class='toggle-button toggle-button-selected  fLeft' onclick=\"changeStatus('" + v.id + "',this)\">";
        }
        else
        {
            str += "<div class='toggle-button  fLeft' onclick=\"changeStatus('" + v.id + "',this)\">";
        }
        str += "<span class='fActive'>On</span>";
        str += "<button class='button'></button>";
        str += "<span class='fDactive'>Off</span>";
        str += "</div>";
        str += "</div>";
        str += "</li>";

    });

    $('.couponList').html(str);
    common.bindToggle();
}

getCoupounList();


function changeStatus(cid, obj, dst) {
    setTimeout(function() {

        var st = 0;
        if (dst != undefined)
        {
            st = 2;
            $(obj).parent().find('div.toggle-button').removeClass('toggle-button-selected');

        }
        else
        {
            var pLeft = $(obj).find(".button").position().left;
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
        values['coupon_id'] = cid;
        var data = values;

        var dt = JSON.stringify(data);

        console.log(dt);


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
    }
    else
    {
        common.toast(0, 'Error in updating status');
        getCategories();
    }
}