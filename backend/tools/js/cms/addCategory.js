var categories = new Array();
var attributes = new Array();
var tagArray = new Array();
var dts;

function getAttributeList()
{
    var URL = APIDOMAIN + "index.php?action=getAttributeList";
    $.ajax({
        url: URL,
        type: "POST",
        
        success: function(res) {
            res = JSON.parse(res);
            attributes = res['result'];
            attributeListCallBack();
        }
    });
}

$(document).ready(function(){

    getCategories();
    getAttributeList();
    
    
    
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
        
    },50);
    
    var tagValues=dts['category']['pid'].split(',');
    
    
    $(tagValues).each(function(i){  
    
        var name=getCatName(tagValues[i]);
        var str = "<div id='" + tagValues[i] + "' class='tagcloud fLeft'>" + name + "</div>";
        $('#attrValues').append(str);

        tagArray.push(tagValues[i]);
        bindTags();
    });
        
}

});





function bindAttrCheck()
{
    
    $(dts['mapping']).each(function(i, v) {        
        $('[name=subcat_type]').each(function(i) {
            var id = $(this).attr('id');
            
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
        
        
        
        if(edit==1)
        {
            bindAttrCheck();
        }
    }
    
}



function getCategories()
{
    var URL = APIDOMAIN + "index.php?action=getCatgoryList";
    $.ajax({
        url: URL,
        type: "POST",
        async: false,
        success: function(res) {
            res = JSON.parse(res);
            categories = res['result'];
            categoryCallBack();
        }
    });
}



function categoryCallBack()
{
    var str = "<option value='-1'>Select Category</option>";
    str += "<option value='0'>Master</option>";
    if (categories)
    {
        
        $(categories).each(function(i, v) {
            str += "<option class='txtCap'  value='" + v.cid + "' >" + v.name + "</option>";
        });
       
    }
    $('#catSelect').append(str);
    
    
    $('#catSelect').change(function(){
        addAttrValues();
    });
    

}

var mapattrs = new Array();
var catid = "";
function addCategory()
{
    var vFlag=validateForm();
    if(vFlag)
    {
        values = {};
        values['catid'] = encodeURIComponent(catid);
        values['cat_name'] = $('#catname').val();
        values['pcatid'] = encodeURIComponent(tagArray.toString());
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


function validateForm()
{
    if($('#catname').val()==""){
        common.toast(0, "Enter category name");
        return false;
        
    }
    var aLen=0;
    $('[name=subcat_type]:CHECKED').each(function(i) {
       aLen++; 
    });
    if(aLen<1){
        common.toast(0, "Please map attributes.");
        return false;
    }
    
    return true;
    
}


function addAttrValues() {
    var vals = $('#catSelect').val();
    if(vals!==-1)
    {    
        var avals = $('#catSelect option:selected').text();
        var txtid = vals;


        if (tagArray.indexOf(txtid) == -1) {
            var str = "<div id='" + txtid + "' class='tagcloud fLeft'>" + avals + "</div>";
            $('#attrValues').append(str);

            tagArray.push(txtid);
            bindTags();
            setTimeout(function() {
                $('#catSelect').val('-1');
            }, 10);
        } else {
            setTimeout(function() {
                $('#catSelect').val('-1');
            }, 10);
        }
    }
}

function bindTags() {
    $('.tagcloud').click(function() {
        var id = $(this).attr('id');
        var _th = this;
        setTimeout(function() {
            $(_th).remove();
            var removeItem = id;
            tagArray = jQuery.grep(tagArray, function(value) {
                return value !== removeItem;
            });
        }, 100);
    });
}   

function getCatName(cid) {
    if(cid==0)
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