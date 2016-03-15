var prdCnt = 0;
$(document).ready(function() {
    getProducs();
});

function inStock(obj, pid)
{
    var val = $(obj).val();

    if (val == 1)
        $(obj).addClass('inStockPrd').removeClass('outStockPrd');
    else
        $(obj).addClass('outStockPrd').removeClass('inStockPrd');

    changePrdStatus(val, pid);

}

function changePrdStatus(val, pid)
{

    values = {};
    values['active_flag'] = val;
    values['pid'] = pid;
    var data = values;
    var dt = JSON.stringify(data);

    var URL = APIDOMAIN + "?action=changeProductStatus";
    $.ajax({
        url: URL,
        type: 'POST',
        data: {dt: dt},
        success: function(res) {
            res = JSON.parse(res);
            changeStatusCallBack(res);
        }
    });

}



function changeStatusCallBack(data)
{

    if (data['error']['err_code'] == '0')
    {
        common.toast(1, 'Status updated successfully');
        getProducs();
        hideConfirmBox();
    }
    else
    {
        common.toast(0, 'Error in updating status');
        //getProducs();
    }
}




function getProducs()
{
    prdCnt = 0;
    var URL = APIDOMAIN + "?action=pageList&page1&limit=1000";
    $.ajax({
        url: URL,
        type: 'POST',
        success: function(res) {
            res = JSON.parse(res);
            getProducsCallback(res);
        }
    });
}

function getProducsCallback(data)
{

    if (data['error']['err_code'] == '0')
    {
        var str = "";
        $(data['results']).each(function(i, v) {


            if (v.isActive != 2)
            {

                prdCnt++;
                var cdat = v.creDate.split("|");
                str += "<li>";
                str += "<div class='date fLeft'>";
                str += "<span class='upSpan'>" + cdat[0] + "</span>";
                str += "<span class='lwSpan'>" + cdat[1] + "</span>";
                str += "</div>";
                str += "<div class='stockCode fLeft'>";
                str += "<span class='upSpan fmOpenB'>" + v.prdCode + "</span>";
                str += "<span class='lwSpan'><a href='" + APIDOMAIN + "?action=getProductById&pid=" + v.pid + "'>View Details</a></span>";
                str += "</div>";
                str += "<div class='prdName fLeft'>" + v.prdName + "</div>";
                str += "<div class='dmdWt fLeft'>" + v.diaWgt + " ct</div>";
                str += "<div class='metalWt fLeft'>" + v.mtlWgt + " gms</div>";
                str += "<div class='acct fLeft'>";
                //str += "<div class='deltBtn fRight transition300'  onclick=\"changePrdStatus(2,'" + v.pid + "')\"></div>";
                str += "<div class='deltBtn fRight transition300'  onclick=\"setClick('" + v.pid + "');showConfirmBox();\"></div>";
                str += "<div class='editBtn fRight transition300' onclick=\"editProduct('"+v.pid+"')\"></div>";
                str += "<a href='" + DOMAIN + "backend/?action=upload&pid=" + v.pid + "' target='+blank'><div class='uploadBtn fRight transition300'></div></a>";
                if (v.isActive == 1)
                {
                    str += "<select class='backtxtSelect fmOpenR fRight inStockPrd' onchange=\"inStock(this,'" + v.pid + "')\" title='Product Status'>";
                    str += "<option value='1' selected='selected'>Active</option>";
                    str += "<option value='0'>Deactive</option>";
                }
                if (v.isActive == 0)
                {
                    str += "<select class='backtxtSelect fmOpenR fRight outStockPrd' onchange=\"inStock(this,'" + v.pid + "')\" title='Product Status'>";
                    str += "<option value='1'>Active</option>";
                    str += "<option value='0' selected='selected'>Deactive</option>";
                }
                str += "</select>";
                str += "</div>";
                str += "</li>";
            }
        });

        if (prdCnt == 0)
        {
            $('#noresults').removeClass('dn');
        }
        else
        {
            $('#noresults').addClass('dn');
        }

        $('#productList').html(str);
        $('#productCnt').html(prdCnt);

    }
    else
    {
        common.toast(0, 'Error in fetching products');
    }

}
function editProduct(pid)
{
    window.location.href=DOMAIN+"backend/?action=editProduct&pid="+pid;
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


function setClick(data)
{
    var str="changePrdStatus(2,'"+data+"')";
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