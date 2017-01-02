var slider;
var rangeArr = new Array();
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
    
    if($('#attr_type').val() == 4)
    {
        tagArray = '';
        tmpvals.push(rangeArr[0]);
        tmpvals.push(rangeArr[1]);
    }
    else
    {
        $(tagArray).each(function(i) {
            var vl = tagArray[i].split('attr_val_');
            tmpvals.push(vl[1].replace("_", ' '));
        });
    }



    values['attr_values'] = encodeURIComponent(tmpvals.toString());
    var data = values;
    var dt = JSON.stringify(data);

    var URL = APIDOMAIN + "index.php?action=addAttribute";
    $.ajax({
        url: URL,
        type: 'POST',
        async: false,
        data: {dt: dt},
        success: function(res) {
            res = JSON.parse(res);
            addAttrCallBack(res);
        }
    });
}


function addAttrCallBack(data)
{
    if(data !== undefined && data !== null && data !== '')
    {
        if (data['error']['err_code'] == '0')
        {
            common.toast(1, 'Attribute added successfully');
           setTimeout(function() 
           {
                location.href=DOMAIN+"backend/index.php?action=attributes";
            }, 300);
        }
        else
        {
            common.toast(0, 'Error in adding attribute');
        }
    }
    else
    {
        common.toast(0, 'Data is not present');
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
    
    if($('#attr_type').val() == 4)
    {
        if ($('#rngVal1').val() == "")
        {
            common.toast(0, "Please enter minimum range value");
            highlight('rngVal1',0);
            return false;
        }
        if ($('#rngVal2').val() == "")
        {
            common.toast(0, "Please enter maximum range value");
            highlight('rngVal2',0);
            return false;
        }
        if($('#rngVal2').val() <= $('#rngVal1').val())
        {
            common.toast(0, "Please provide higher value for maximum range than minimum range");
            highlight('rngVal2',0);
            return false;
        }
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
$(document).ready(function()
{
    $('#attrinpVal').on('keypress', function(evt)
    {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 13 || charCode == 44)
            addAttrValues();

    });
    
    $('#rngVal1').bind('blur', function(evt)
    {
            addAttrValues();
    });
    
    $('#rngVal2').bind('blur', function(evt)
    {
            addAttrValues();
    });
});

var slider;
var rangeArr = new Array();
function addAttrValues()
{
    var vals    = $('#attrinpVal').val().trim();
    var unit    = $('#unit').val();
    var avals   = vals.split(" ").join("_");
    var txtid   = "attr_val_" + avals;
    var type    =  $('#attr_type').val();
    
    if(type==4)
    {
        
        var $range = $("#range_03");
        var val1 = $('#rngVal1').val();
        var val2 = $('#rngVal2').val();
        
        if(val1 !== '' && rangeArr.indexOf(val1) == -1)
        {
            rangeArr[0] = val1;
        }
        if(val2 !== '' && rangeArr.indexOf(val2) == -1)
        {
            rangeArr[1] = val2;
        }

        if(rangeArr.length==2 && rangeArr[0] !== '' && rangeArr[1] !== '')
        {
            console.log(rangeArr[0]+'------'+rangeArr[1]);
            $("#range_03").val('');
            var slider = $('#range_03').data("ionRangeSlider");
            slider.update({
                            min: Math.floor(rangeArr[0]),
                            max: Math.ceil(rangeArr[1]),
                            from: Math.ceil(rangeArr[0]),
                            to: Math.ceil(rangeArr[1]),
                          });
            
					
            slider = $range.data("ionRangeSlider");
        }
        else
        {
            slider && slider.destroy();
        }
    }
    else
    {
        rangeArr = '';
    }

    if (tagArray.indexOf(txtid) == -1 && vals !== '')
    {
        var str = "<div id='" + txtid + "' class='tagcloud fLeft'>" + vals + "</div>";
        $('#attrValues').append(str);
        

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
            var tstr="<option value='"+vals+"' class='new'>"+vals+"</option>";
            $('#demoSelect').append(tstr)
        }
        if(type==5)
        {
            var tstr="<li class='autoSuggstions new "+txtid+"i'>"+vals+"</li>";
            $('.demoautoSuggestOuter ul').append(tstr);
            $('#sugUnit').text(' ( '+unit+' )');
            bindAutosuggest();
        }
        tagArray.push(txtid);
        bindTags();
        setTimeout(function() 
        {
            $('#attrinpVal').val('');
        }, 100);
    }
    else 
    {
        setTimeout(function()
        {
            $('#attrinpVal').val('');
        }, 100);
    }
}

function changeUnit(unitValue)
{

    var typeSelect = $('#attr_type').val();
    console.log(typeSelect);
    if(typeSelect !== '-1')
    {
        switch(typeSelect)
        {
          case '0':
                  $('#textUnit').text(' ( '+unitValue+' )');
                  break;
          case '1':
                  $('#checkUnit').text(' ( '+unitValue+' )');

                  break;
          case '2':
                  $('#radioUnit').text(' ( '+unitValue+' )');
                  break;
          case '3':
                  $('#dropUnit').text(' ( '+unitValue+' )');
                  break;
          case '4':
                  $('#rangeUnit').text(' ( '+unitValue+' )');
                  break;
          case '5':
                  $('#sugUnit').text(' ( '+unitValue+' )');
                  break;
          default :
                  break;
        }
  }
}

function bindTags()
{
    $('.tagcloud').click(function()
    {
        var id = $(this).attr('id');
        var _th = this;
        var clearSample = id.replace('attr_val_','');
        setTimeout(function()
        {
            $(_th).remove();
            $('.demoAttrCont #Check_'+clearSample).parent().remove();
            slider && slider.destroy();
            if(rangeArr !== undefined && rangeArr !== null && rangeArr !== '')
            {
              rangeArr.pop();
            }

            var removeItem = id;

            if($('#demoSelect > option').length > 1)
            {
                $('#demoSelect > option[value='+clearSample+']').remove();
            }
            if(!$('#demo_2').hasClass('dn'))
            {
                $('#radio_'+clearSample).parent().remove();
            }
            if($('.demoautoSuggestOuter ul li').length > 0)
            {
                $('.'+id+'i').remove();
            }
            if(!$('#demo_1').hasClass('dn'))
            {
              $('.demoAttrCont #Check_'+clearSample).parent().remove();
            }

            tagArray = jQuery.grep(tagArray, function(value)
            {
                return value !== removeItem;
            });
        }, 100);
    });
}   


function showConfirmBox()
{
    $('#delOverlay,#confirmBox').removeClass('dn');
    setTimeout(function()
    {
        $('#delOverlay').velocity({opacity: 1}, {delay: 0, duration: 300, ease: 'swing'});
        $('#confirmBox').velocity({scale: 1, borderRadius: '2px', opacity: 1}, {delay: 80, duration: 300, ease: 'swing'});
    }, 10);
}

function hideConfirmBox() 
{
    $('#delOverlay').velocity({opacity: 0}, {delay: 0, duration: 300, ease: 'swing'});
    $('#confirmBox').velocity({opacity: 0}, {delay: 0, duration: 300, ease: 'swing', queue: false});
    $('#confirmBox').velocity({scale: 0, borderRadius: '50%'}, {delay: 300, duration: 0, ease: 'swing'});
    setTimeout(function()
    {
        $('#delOverlay,#confirmBox').addClass('dn');
    }, 1010);
    $('#prddeleteBtn').removeAttr('onclick');
}


var dts;
if(edit==1)
{
    dts=JSON.parse(data);
    setTimeout(function()
    {
        attributeid=dts.attrid;
        $('#name').val(dts.name);
        $('#unit').val(dts.unit);
        changeUnit(dts.unit);
        $('#apos').val(dts.apos);
        
        $('#attr_type option').each(function()
        {
            if ($(this).val() == dts.type)
            {
                $(this).attr('selected', 'selected');
            }
        });
        $('.demoAttrCont').removeClass('dn');
        
        var type = dts.type;
        var vals = $('#attrinpVal').val();
        
        
        $('#upos option').each(function()
        {
            if ($(this).val() == dts.upos)
            {
                $(this).attr('selected', 'selected');
            }
        });
        
        var tagValues=dts['values'].split(',');
        genAttrDisplay(tagValues,type);

        if(type == 4)
        {
            $('.valattr').addClass('dn');
            $('.Rngattr1').removeClass('dn');
            $('.Rngattr2').removeClass('dn');
            
            $('#rngVal1').val(tagValues[0]);
            $('#rngVal2').val(tagValues[1]);
            addAttrValues();
        }
        else
        {
            var str="";
            $(tagValues).each(function(i)
            {
                var aval = tagValues[i].split("_").join(" ");
                var avals = tagValues[i].split(" ").join("_");
                var txtid = "attr_val_" + avals;
                str += "<div id='" + txtid + "' class='tagcloud fLeft'>" + aval + "</div>";
                tagArray.push(txtid);
            });
            $('#attrValues').append(str);      
            bindTags();
        }
    },50);
}


function genAttrDisplay(data,type)
{
    
    $('#demo_'+type).removeClass('dn');
    
    if(type==4)
    {
        var $range = $("#range_03");
        var val1 = $('#rngVal1').val();
        var val2 = $('#rngVal2').val();
        
        if(val1 !== '' && rangeArr.indexOf(val1) == -1)
        {
            rangeArr[0] = val1;
        }
        if(val2 !== '' && rangeArr.indexOf(val2) == -1)
        {
            rangeArr[1] = val2;
        }

        if(rangeArr.length==2 && rangeArr[0] !== '' && rangeArr[1] !== '')
        {
            $("#range_03").val('');
            var slider = $('#range_03').data("ionRangeSlider");
            slider.update({
                            min: Math.floor(rangeArr[0]),
                            max: Math.ceil(rangeArr[1]),
                            from: Math.ceil(rangeArr[0]),
                            to: Math.ceil(rangeArr[1]),
                          });
            slider = $range.data("ionRangeSlider");
        }
        else
        {
            slider && slider.destroy();
        }
    }
    else
    {
        rangeArr = '';
    }
    
    $.each(data,function(i,val)
    {
        valsid = val.replace(' ','_');
        if(type==1)
        {
            var tstr = '';
            tstr+="<div class='checkDiv fLeft new'>";
                tstr+="<input type='checkbox' name='Check' class='filled-in' value='"+val+"' id='Check_"+valsid+"'>";
                tstr+="<label for='Check_"+valsid+"'>"+val+"</label>";
            tstr+="</div>";
            $('#demo_'+type).append(tstr);
        }
        
        if(type==2)
        {
            tstr+="<div class='checkDiv fLeft new'>";
                tstr+="<input type='radio' name='radios' class='filled-in' value='"+val+"' id='radio_"+valsid+"'>";
                tstr+="<label for='radio_"+valsid+"'>"+val+"</label>";
            tstr+="</div>";
            $('#demo_'+type).append(tstr);
        }
        
        if(type==3)
        {
            var tstr="<option value="+val+" class='new'>"+val+"</option>";
            $('#demoSelect').append(tstr);
        }
        
//        if(type==4)
//        {
//            var $range = $("#range_03");
//            rangeArr.push(val);
//            if(rangeArr.length==2)
//            {
//                $("#range_03").ionRangeSlider({type: "double",grid: true,min: rangeArr[0],max: rangeArr[1]}); 
//                slider = $range.data("ionRangeSlider");
//            }
//            else
//            {
//                slider && slider.destroy();
//            }
//        }
        
        if(type==5)
        {
            var tstr="<li class='autoSuggstions new'>"+val+"</li>";
            $('.demoautoSuggestOuter ul').append(tstr);
            bindAutosuggest();
        }
    });
}

$(document).ready(function()
{
    $("#range_03").ionRangeSlider({type: "double",grid: true,min: 100,max: 1000}); 
    $('#attr_type').change(function(){

        var val= $(this).val();
        $('div[id^="demo"]').addClass('dn');
        $('#demo_'+val).removeClass('dn');
        $('.tagcloud').remove();
        tagArray=[];
        rangeArr=[];
        if(val==4)
        {
            $('.valattr').addClass('dn');
            $('.Rngattr1').removeClass('dn');
            $('.Rngattr2').removeClass('dn');
        }
        else
        {
            $('.valattr').removeClass('dn');
            $('.Rngattr1').addClass('dn');
            $('.Rngattr2').addClass('dn');
            $('#attrinpVal').attr('placeholder','Add comma seperated values for filtering this attribute');
        }

        $('.new').remove();
        $('.demoAttrCont').removeClass('dn');
        if($('#unit').val() !== undefined)
        {
          changeUnit($('#unit').val());
        }
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