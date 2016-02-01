function addAttribute()
{
    var flag = validateData();
    if (!flag)
        return;
    var tmpvals = new Array();
    values = {};

    values['attributeid'] = attributeid;
    values['attr_type'] = $('#attr_type').val();
    values['attr_name'] = encodeURIComponent($('#name').val());
    values['attr_unit'] = $('#unit').val();
    values['attr_unit_pos'] = $('#upos').val();
    values['attr_pos'] = $('#apos').val();
    values['userid'] = 1;

    $(tagArray).each(function(i) {
        var vl = tagArray[i].split('attr_val_');
        tmpvals.push(vl[1].replace("_", ' '));

    });


    values['attr_values'] = encodeURIComponent(tmpvals.toString());
    var data = values;
    var dt = JSON.stringify(data);

    var URL = APIDOMAIN + "index.php?action=addAttribute";
    $.ajax({
        url: URL,
        type: 'POST',
        data: {dt: dt},
        success: function(res) {
            res = JSON.parse(res);
            addAttrCallBack(res);
        }
    });

}


function addAttrCallBack(data)
{

    if (data['error']['err_code'] == '0')
    {
        common.toast(1, 'Attribute added successfully');

        setTimeout(function() {
            location.href=DOMAIN+"backend/?action=attributes";
        }, 300);

    }
    else
    {
        common.toast(0, 'Error in adding attribute');

    }

}

function validateData()
{

    if ($('#attr_type').val() == "")
    {

        common.toast(0, "Select attribute type from dropdown");
        return false;

    }
    if ($('#name').val() == "")
    {

        common.toast(0, "Enter attribute name");
        return false;

    }

    if ($('#upos').val() == "")
    {

        common.toast(0, "Select attribute unit position");
        return false;

    }

    if (tagArray.length == 0)
    {

        common.toast(0, "Provide possible values for this attribute");
        return false;

    }

    return true;
}

var tagArray = new Array();
$(document).ready(function() {
    $('#attrinpVal').on('keypress', function(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 13 || charCode == 44)
            addAttrValues();

    });
});

function addAttrValues() {
    var vals = $('#attrinpVal').val();
    var avals = vals.split(" ").join("_");
    var txtid = "attr_val_" + avals
    if (tagArray.indexOf(txtid) == -1) {
        var str = "<div id='" + txtid + "' class='tagcloud fLeft'>" + vals + "</div>";
        $('#attrValues').append(str);
        tagArray.push(txtid);
        bindTags();
        setTimeout(function() {
            $('#attrinpVal').val('');
        }, 100);
    } else {
        setTimeout(function() {
            $('#attrinpVal').val('');
        }, 100);
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



var dts;
if(edit==1)
{
    
    dts=JSON.parse(data);
    console.log(dts);
    setTimeout(function(){
        attributeid=dts.attrid;
        $('#name').val(dts.name);
        $('#unit').val(dts.unit);
        $('#apos').val(dts.apos);
        
        $('#attr_type option').each(function() {
            if ($(this).val() == dts.type)
            {
                $(this).attr('selected', 'selected');
            }
        });

        $('#upos option').each(function() {
            if ($(this).val() == dts.upos)
            {
                $(this).attr('selected', 'selected');
            }
        });
        
        console.log(dts['values']);
        var tagValues=dts['values'].split(',');
        
        var str="";
        $(tagValues).each(function(i){
            var aval = tagValues[i].split("_").join(" ");
            var avals = tagValues[i].split(" ").join("_");
            var txtid = "attr_val_" + avals;
            str += "<div id='" + txtid + "' class='tagcloud fLeft'>" + aval + "</div>";
            tagArray.push(txtid);
        });
        $('#attrValues').append(str);      
        bindTags();
    },50);
}

