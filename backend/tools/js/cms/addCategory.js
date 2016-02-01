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
getCategories();
getAttributeList();
var dts;
if(edit==1)
{
    
    dts=JSON.parse(data);
    $('#catname').val(dts['category'].name);
    
    
    setTimeout(function(){
        $('#catSelect option').each(function(){

            if($(this).val()==dts['category'].pid)
            {
                $(this).attr('selected','selected');
            }
        });
        
        catid=dts['category'].id;
        
        
       // bindAttrCheck();
    },50);
        
}




function bindAttrCheck()
{
    
    $(dts['mapping']).each(function(i, v) {        
        $('[name=subcat_type]').each(function(i) {
            var id = $(this).attr('id');
            
            console.log(id);
            if(id==('attr_'+v.attrid))
            {
                $(this).attr('checked',true);

            }

        });

    });
        
}


function attributeListCallBack()
{
    if (attributes.length > 0)
    {
        var str = "<div class='commTitle1 fLeft fmOpenL mBot20'>Map attributes</div>";
        $(attributes).each(function(i, v) {

            if (v.active == "1")
            {
                str += "<div class='checkDiv fLeft'>";
                str += "<input type='checkbox' name='subcat_type' class='filled-in' value='" + v.id + "' id='attr_" + v.id + "'>";
                str += "<label for='attr_" + v.id + "' class='txtCap'>" + v.name + "</label>";
                str += "</div>";
            }

        });

        $('#attrCont').html(str);
        bindAttrCheck();
    }
    
}


var categories = new Array();
function getCategories()
{
    var URL = APIDOMAIN + "index.php?action=getCatgoryList";
    $.ajax({
        url: URL,
        type: "POST",
        success: function(res) {
            res = JSON.parse(res);
            categories = res['result'];
            categoryCallBack();
        }
    });
}



function categoryCallBack()
{
    if (categories.length > 0)
    {
        var str = "<option value='0'>None</option>";
        $(categories).each(function(i, v) {
            str += "<option class='txtCap'  value='" + v.cid + "' >" + v.name + "</option>";
        });
        str += "</select>";
    }
    $('#catSelect').append(str);

}

var mapattrs = new Array();
var catid = "";
function addCategory()
{

    values = {};
    values['catid'] = encodeURIComponent(catid);
    values['cat_name'] = encodeURIComponent($('#catname').val());
    values['pcatid'] = $('#catSelect').val();
    values['pcatid'] = $('#catSelect').val();
    values['userid'] = 1;
    mapattrs = [];
    $('[name=subcat_type]:CHECKED').each(function(i) {
        mapattrs.push($(this).val());

    });
    values['attrs'] = encodeURIComponent(mapattrs.toString());
    var data = values;
    var dt = JSON.stringify(data);
    console.log(dt);

    var URL = APIDOMAIN + "index.php?action=addCategory";
    $.ajax({
        url: URL,
        type: 'POST',
        data: {dt: dt},
        success: function(res) {
            res = JSON.parse(res);
            console.log(res);
            addCatCallBack(res);
        }
    });

}

function addCatCallBack(data)
{
    if (data['error']['err_code'] == '0')
    {
        common.toast(1, 'Category added successfully');

        setTimeout(function() {
            location.href=DOMAIN+"backend/?action=category";
        }, 300);

    }
    else
    {
        common.toast(0, 'Error in adding category');

    }

}