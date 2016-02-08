$(document).ready(function() {
    bindToggle();
});



function bindToggle()
{
    $('.toggle-button').click(function() {
        $(this).toggleClass('toggle-button-selected');
    });
}


var attributes = new Array();
function getAttributeList()
{
    var URL = APIDOMAIN + "index.php?action=getAttributeList";
    $.ajax({
        url: URL,
        type: "POST",
        success: function(res) {
            res = JSON.parse(res);
            attributes = res['result'];
            console.log(attributes);
            attributeListCallBack();
        }
    });
}

getAttributeList();

function attributeListCallBack()
{

    var attcnt=0;
    if (attributes.length > 0)
    {
        
        var str = "";
        $(attributes).each(function(i, v) {
            if (attributes[i]['active'] !="2")
            {

                str += "<li>";
                str += "<div class='attrName fLeft'>" + v.name + "</div>";
                var type = attrType(v.type);
                str += "<div class='attrType fLeft'>" + type + "</div>";

                if (v.unit == "")
                {
                    str += "<div class='attrUnit fLeft'>NA</div>";
                }
                else
                {
                    str += "<div class='attrUnit fLeft'>" + v.unit + "</div>";
                }
                if (v.catg == "")
                {
                    str += "<div class='attrMapp fLeft'>NA</div>";
                }
                else
                {
                    str += "<div class='attrMapp fLeft'>" + v.catg + "</div>";
                }



                str += "<div class='cattrAct fLeft'>";
                str += "<div class='deltBtn fRight transition300'  onclick=\"changeStatus('" + v.id + "',this,3)\"></div>";
                str += "<a href='" + DOMAIN + "backend/?action=editAttribute&aid=" + v.id + "'><div class='editBtn fRight transition300'></div></a>";
                if (v.active == "1")
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
                attcnt++;
            }  
        });
        $('#attrCount').html(attcnt);
        $('.commonList').html(str);
        bindToggle();
    }

}




function changeStatus(aid, obj, dst) {
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

        var URL = APIDOMAIN + "index.php?action=changeAttributeStatus";
        values = {};
        values['active_flag'] = st;
        values['userid'] = 1;
        values['attributeid'] = aid;
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
        getAttributeList();
    }
    else
    {
        common.toast(0, 'Error in updating status');
        getAttributeList();
    }
}

function attrType(t)
{
    switch (t)
    {
        case 0:
            return 'Textbox';
            break;

        case 1:
            return 'Checkbox';
            break;

        case 2:
            return 'Radio Button';
            break;

        case 3:
            return 'Dropdown';
            break;

        case 4:
            return 'Range';
            break;

        case 5:
            return 'Autosuggest';
            break;

    }

}