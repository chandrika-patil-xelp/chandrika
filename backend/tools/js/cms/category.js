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
            str += "<li>";
            str += "<div class='catName fLeft txtCap'>" + categories[i]['name'] + "</div>";

            if (categories[i]['pid'] == "0")
            {
                str += "<div class='parentName fLeft'>NA</div>";
            }
            else
            {
                var name = getCatName(categories[i]['pid']);
                str += "<div class='parentName fLeft txtCap'>" + name + "</div>";

            }
            str += "<div class='dPos fLeft op0'>0</div>";
            str += "<div class='cactt fLeft'>";
            str += "<div class='deltBtn fRight transition300' onclick=\"changeStatus('" + categories[i]['cid'] + "',this,3)\"></div>";
            str += "<a href='"+DOMAIN+"backend/?action=editCategory&cid=" + categories[i]['cid'] + "'><div class='editBtn fRight transition300'></div></a>";

            if (categories[i]['active'] == "1")
            {
                str += "<div class='toggle-button toggle-button-selected  fLeft' onclick=\"changeStatus('" + categories[i]['cid'] + "',this)\">";
            }
            else
            {
                str += "<div class='toggle-button  fLeft' onclick=\"changeStatus('" + categories[i]['cid'] + "',this)\">";
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



        var URL = APIDOMAIN + "index.php?action=changeCategoryStatus";
        values = {};
        values['active_flag'] = st;
        values['userid'] = 1;
        values['catid'] = cid;
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
        getCategories();
    }
    else
    {
        common.toast(0, 'Error in updating status');
        getCategories();
    }
}


function getCatName(cid) {
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
    //alert(cid);
    var URL =APIDOMAIN + "index.php?action=getCategoryDetails&catid="+cid;
    
    
    
}