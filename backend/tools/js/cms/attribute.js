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
    if(attributes!=null)
    {
        
    
    var attcnt=0;
    if (attributes.length > 0)
    {
        $('#noresults').addClass('dn');
        
        var str = "";
        $(attributes).each(function(i, v) {
            if (attributes[i]['active'] !="2")
            {

                str += "<li id='attr_" + v.id + "'>";
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
                //str += "<div class='deltBtn fRight transition300'  onclick=\"changeStatus('" + v.id + "',this,3)\"></div>";
                str += "<div class='deltBtn fRight transition300'  onclick=\"setClick('" + v.id + "',2);showConfirmBox();\"></div>";
                str += "<a href='" + DOMAIN + "backend/?action=editAttribute&aid=" + v.id + "'><div class='editBtn fRight transition300'></div></a>";
                if (v.active == "1")
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
                attcnt++;
            }  
        });
        if (attcnt == 0)
        {
            $('#noresults').removeClass('dn');
        }
        else
        {
            $('#noresults').addClass('dn');
        }
        $('#attrCount').html(attcnt);
        $('.commonList').html(str);
        bindToggle();
    }
    }
    else{
        
        $('#noresults').removeClass('dn');
    }

}




function changeStatus(aid,dst) {
    setTimeout(function() {

        var st = 0;
        if (dst != undefined)
        {
            st = 2;
            $('#attr_'+aid).find('div.toggle-button').removeClass('toggle-button-selected');

        }
        else
        {
            var pLeft = $('#attr_'+aid).find(".button").position().left;
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