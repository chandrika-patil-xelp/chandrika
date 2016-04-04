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

    if ($('#attr_type').val() == "-1")
    {

        common.toast(0, "Select attribute type from dropdown");
        highlight('attr_type',0)
        return false;

    }
    if ($('#name').val() == "")
    {

        common.toast(0, "Enter attribute name");
        highlight('name',0)
        return false;

    }

    if ($('#upos').val() == "")
    {

        common.toast(0, "Select attribute unit position");
        highlight('upos',0)
        return false;

    }

    if (tagArray.length == 0)
    {

        common.toast(0, "Provide possible values for this attribute");
        highlight('attrinpVal',0)
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
var rangeArr=new Array();
var slider;

function addAttrValues() {
    var vals = $('#attrinpVal').val();
    var avals = vals.split(" ").join("_");
    var txtid = "attr_val_" + avals
    if (tagArray.indexOf(txtid) == -1) {
        var str = "<div id='" + txtid + "' class='tagcloud fLeft'>" + vals + "</div>";
        $('#attrValues').append(str);
        
        var type=$('#attr_type').val();
        
        
        if(type==1)
        {
            var tstr="";
            tstr+="<div class='checkDiv fLeft new'>";
            tstr+="<input type='checkbox' name='Check' class='filled-in' value='"+vals+"' id='Check_"+vals+"'>";
            tstr+="<label for='Check_"+vals+"'>"+vals+"</label>";
            tstr+="</div>";
            $('#demo_'+type).append(tstr);
            
        }
        if(type==2)
        {
            var tstr="";
            tstr+="<div class='checkDiv fLeft new'>";
            tstr+="<input type='radio' name='radios' class='filled-in' value='"+vals+"' id='radio_"+vals+"'>";
            tstr+="<label for='radio_"+vals+"'>"+vals+"</label>";
            tstr+="</div>";
            $('#demo_'+type).append(tstr);
            
        }
        
        if(type==3)
        {
            var tstr="<option value='' class='new'>"+vals+"</option>";
            $('#demoSelect').append(tstr)
            
        }
        
        
        if(type==4)
        {
            var $range = $("#range_03");
            rangeArr.push(vals);
            if(rangeArr.length==2){
                $("#range_03").ionRangeSlider({type: "double",grid: true,min: rangeArr[0],max: rangeArr[1]}); 
                slider = $range.data("ionRangeSlider");
            }
            else
            {
                slider && slider.destroy();
            }
            
        }
        if(type==5)
        {
            
            var tstr="<li class='autoSuggstions new'>"+vals+"</li>";
            $('.demoautoSuggestOuter ul').append(tstr);
            bindAutosuggest();
        }
        
        
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
            slider && slider.destroy();
            rangeArr.pop();
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

$(document).ready(function(){
                
                
    $('#attr_type').change(function(){

        var val= $(this).val();
        $('div[id^="demo"]').addClass('dn');
        $('#demo_'+val).removeClass('dn');
        $('.tagcloud').remove();
        tagArray=[];
        rangeArr=[];
        if(val==4)
            $('#attrinpVal').attr('placeholder','Add comma seperated minimum and maximum value');
        else
            $('#attrinpVal').attr('placeholder','Add comma seperated values for filtering this attribute');


        $('.new').remove();
        $('.demoAttrCont').removeClass('dn');
    });


});


function bindAutosuggest(){

    $('.demoautoSuggestOuter li').click(function(){
        $('#demoeAutoST').val($(this).text());
        $('.demoautoSuggestOuter').addClass('dn');
    });

    $('#demoeAutoST').bind('focus',function(){
        $('.demoautoSuggestOuter').removeClass('dn');
    });
}


function highlight(id,type)
{
    var sc= $('#'+id).position().top-130;
    $('body,html').animate({scrollTop:sc},300,"swing");
    setTimeout(function(){

        if(type==0)
            $('#'+id).addClass('error');


        else if(type==1)
            $('#'+id).next('label').addClass('error');


        else if(type==2)
            $('#'+id+' center').addClass('error');

        bindError();
    },350);

}


function bindError()
{

    $('.txtSelect.error').bind('click',function(){
        $(this).removeClass('error');
        $(this).unbind();

    });

    $('label.error').bind('click',function(){
        $(this).removeClass('error');
        $(this).unbind();
    });

    $('label').bind('click',function(){
        var name=$(this).siblings('input').attr('name');
        if( $('[name='+name+']').siblings('label').hasClass('error'))
        {
            $('[name='+name+']').siblings('label').removeClass('error');
        }
    });

    $('.txtInput.error,.mtxtInput.error').bind('focus',function(){
        $(this).removeClass('error');
        $(this).unbind();
    });

    $('.shapeComm').bind('click',function(){
        var flag=$(this).parent('center').hasClass('error');
        if(flag)
            $(this).siblings('.shapeComm').parent('center').removeClass('error');
    });

}