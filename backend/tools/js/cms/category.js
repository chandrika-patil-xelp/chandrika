$(document).ready(function() {
    bindToggle();
});


function bindToggle()
{
    $('.toggle-button').click(function() {
        $(this).toggleClass('toggle-button-selected');
    });
}


var categories = new Array();
function getCategories()
{
    categories = [];
    var URL = APIDOMAIN + "index.php?action=getCatgoryList";
    $.ajax({
        url: URL,
        type: "POST",
        success: function(res) {
            res = JSON.parse(res);
            categories = res['result'];
            //console.log(categories);
            categoryCallBack(res);
        }
    });
}

getCategories();


function categoryCallBack(data)
{
    var catcnt=0;
    var str = "";
    $(categories).each(function(i) {
        if (categories[i]['active'] !="2")
        {
            str += "<li id='cat_" + categories[i]['cid'] + "' class='searchRow'>";
            str += "<div class='catName fLeft txtCap'>" + categories[i]['name'] + "</div>";

            var pidsArray=categories[i]['pid'].split(",");
            //console.log(pidsArray);
            var nameStr="";
            $(pidsArray).each(function(j,vl){
                var name = getCatName(vl);
                nameStr+=name +", ";
            });
            
            str += "<div class='parentName fLeft txtCap'>" + (nameStr.substr(0,nameStr.length-2) !== 'undefined' ? nameStr.substr(0,nameStr.length-2) : 'Master') + "</div>";
            str += "<div class='dPos fLeft op0'>0</div>";
            str += "<div class='cactt fLeft'>";
            str += "<div class='deltBtn fRight transition300'  onclick=\"setClick('" + categories[i]['cid'] + "',2);showConfirmBox();\"></div>";
            str += "<a href='"+DOMAIN+"backend/index.php?action=editCategory&cid=" + categories[i]['cid'] + "'><div class='editBtn fRight transition300'></div></a>";

            if (categories[i]['active'] == "1")
            {
                str += "<div class='toggle-button toggle-button-selected  fLeft' onclick=\"changeStatus('" + categories[i]['cid'] + "')\">";
            }
            else
            {
                str += "<div class='toggle-button  fLeft' onclick=\"changeStatus('" + categories[i]['cid'] + "')\">";
            }

            str += "<span class='fActive'>On</span>";
            str += "<button class='button'></button>";
            str += "<span class='fDactive'>Off</span>";
            str += "</div>";
            str += "</div>";
            str += "</li>";
            catcnt++;
        }
    });
    
    
    if (catcnt == 0)
    {
        $('#noresults').removeClass('dn');
    }
    else
    {
        $('#noresults').addClass('dn');
    }
    $('#catCount').html(catcnt);
    $('.commonList').html(str);
    bindToggle();
}


function changeStatus(cid,dst) {
    setTimeout(function() {

        var st = 0;
        if (dst != undefined)
        {
            st = 2;
            $('#cat_'+cid).find('div.toggle-button').removeClass('toggle-button-selected');

        }
        else
        {
            var pLeft = $('#cat_'+cid).find(".button").position().left;
            if (pLeft == 0)
            {
                st = 0;
            }
            else
            {
                st = 1;
            }

        }



        var URL = APIDOMAIN + "index.php?action=changeCategoryStatus";
        values = {};
        values['active_flag'] = st;
        values['userid'] = 1;
        values['catid'] = cid;
        var data = values;

console.log(data);

        var dt = JSON.stringify(data);

        $.ajax({
            url: URL,
            type: 'POST',
            data: {dt: dt},
            success: function(res) {
                res = JSON.parse(res);
                changeStatusCallBack(res);
                hideConfirmBox();
                
            }
        });
    }, 350);
}


function changeStatusCallBack(data)
{

    if (data['error']['err_code'] == '0')
    {
        common.toast(1, 'Status updated successfully');
        getCategories();
    }
    else
    {
        common.toast(0, 'Error in updating status');
        
    }
}


function getCatName(cid) {
    if(cid==0 || cid == '99999')
        return "Master";
    var name;
    $(categories).each(function(i) {
        if (categories[i]['cid'] == cid) {
            name = categories[i]['name'];
            return name;
        }
    });
    return name;
}



function editCat(cid)
{
    var URL =APIDOMAIN + "index.php?action=getCategoryDetails&catid="+cid;
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