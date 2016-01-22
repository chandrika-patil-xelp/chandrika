var categories= new Array();
var vendorList= new Array();
var dqulaity= new Array();
var gemstonelist= new Array();
var catLen=0;

function getCategories()
{
    var URL =APIDOMAIN+"index.php?action=getCatgoryList";
    $.ajax({
        url:URL,
        type:"POST",
        success:function(res){
            res=JSON.parse(res);
            categories=res['result'];
            var vstr = getChildCat(res,0);
           //console.log(vstr);
            $('#parentCatg').html(vstr);
            getAllChilds(res);
        }
    });
}
function getChildCat(res,id)
{
    var str = generateHtml(res,id);
    return str;
}
function generateHtml(res,id)
{
//    console.log(res);
    var str = '';
    $.each(res.result, function(i,v) {
        if(v.pid == id)
        {
            str+="<div class='checkDiv txtCap'>";
            str+="<input type='checkbox' name='prtcateg' class='filled-in isparent' value='"+v.cid+"' id='cat_"+v.cid+"'>";
            str+="<label for='cat_"+v.cid+"''>"+v.name+"</label>";
            str+="</div>";
        }
    });
    return str;
}
function getAllChilds(res)
{
    $("input[name='prtcateg']").unbind();
    var str = "<div class='breakLine'></div>";
    str += "<div class='divCon  fLeft fmOpenR mTop0'>";
    $("input[name='prtcateg']").bind('click', function(event) {
        stopPropGate();
        if($(this).is(":checked"))
        {
            var vstr = generateHtml(res,$(this).attr("id").replace('cat_',''));
        }
        str += vstr;
        str += "</div>";
        if(vstr)
            $('#parentCatg').append(str);
        getAllChilds(res);
        bindRemove();
    });
}



function bindRemove(){
    $("input[name='prtcateg']").bind('click', function(event) {
        stopPropGate();
        if(!$(this).is(":checked"))
        {
            console.log($(this).attr("id")+" to be removed");
            removeChilds($(this).attr("id").replace('cat_',''));
        }
    });
}


function removeChilds(catid)
{
    catLen=categories.length;
    var i =0;
    while(i<catLen)
    {
        //console.log( $('#cat_'+categories[i]['cid']));
        if(categories[i]['pid']==catid){
            $('#cat_'+categories[i]['cid']).parent().remove();
        }
        i++;
    }
    
}



function getVendorList()
{  
    var URL =APIDOMAIN+"index.php?action=getVendorList";
    $.ajax({
        url:URL,
        type:"POST",
        success:function(res){
            res=JSON.parse(res);
            vendorList=res['result'];
            vendorListCalllBack(res);
        }
    });
    
}


function vendorListCalllBack(data)
{
    
    if(data['error']['err_code']=='0')
    {
        var str = "<option value='-1'>Select Vendor</option>";
        $.each(data.result, function(i,v) {
            str+="<option value='"+v.vid+"'>"+v.name+"</option>";
        });
 
        $('#vendorList').html(str);
        
    }
    
}


function getDiamondQuality()
{
    
    var URL = APIDOMAIN+"index.php?action=getDiamondQualityList";
    $.ajax({
        url:URL,
        type:"POST",
        success:function(res){
            res=JSON.parse(res);
            dqulaity=res['result'];
            diamondQltyCalllBack(res);
        }
    });
    
}


function diamondQltyCalllBack(data)
{
    
    if(data['error']['err_code']=='0')
    {
        var str1= "";
        var str2= "";
        
        $.each(data.result, function(i,v) {
            str1+="<div class='dQuality fLeft'>";
            str1+="<div class='checkDiv fLeft minwidth100'>";
            str1+="<input type='checkbox' name='dmdquality_cust' class='filled-in' value='"+v.id+"' id='dql_"+v.id+"'>";
            str1+="<label for='dql_"+v.id+"'>"+v.name+"</label>";
            str1+="</div>";
            str1+="<div class='intInp fLeft'>&#8377; "+v.price+"</div>";
            str1+="</div>";
            
                str2+="<div class='dQuality fLeft'>";
                str2+="<div class='checkDiv fLeft minwidth100'>";
                str2+="<input type='radio' name='dmdquality_notCust' class='filled-in' value='"+v.id+"' id='dqRadio_"+v.id+"'>";
                str2+="<label for='dqRadio_"+v.id+"'>"+v.name+"</label>";
                str2+="</div>";
                str2+="<div class='intInp fLeft'>&#8377; "+v.price+"</div>";
                str2+="</div>";
            
        });
        
        $('#custQuality').html(str1);
        $('#notcustQuality').html(str2);

    }
    
}

function getGemstoneList()
{
    
    var URL = APIDOMAIN+"index.php?action=getGemstoneList";
    $.ajax({
        url:URL,
        type:"POST",
        success:function(res){
            res=JSON.parse(res);
            gemstonelist = res;
            gemstoneListCalllBack(res);
        }
    });
    
}



function gemstoneListCalllBack(data)
{
    if(data['error']['err_code']=='0')
    {
        
        var str = "<option value='-1'>Select A Gemstone</option>";
        $.each(data.result, function(i,v) {
            str+="<option value='"+v.id+"'>"+v.name+"</option>";
        });
 
        $('#gemstone_type').html(str);
        
    }
}




function getMetalPurity()
{
    
    var URL = APIDOMAIN+"index.php?action=getGoldRates";
    $.ajax({
        url:URL,
        type:"POST",
        success:function(res){
            res=JSON.parse(res);
            metalpurityCalllBack(res);
        }
    });
    
}


function metalpurityCalllBack(data)
{
    
    if(data['error']['err_code']=='0')
    {
        var str1= "<div class='titleDiv txtCap fLeft'>Metal Purity Customizable*</div>";
        var str2= "<div class='titleDiv txtCap fLeft'>Metal Purity Not Customizable*</div>";
        
        $.each(data.result, function(i,v) {
            str1+="<div class='dQuality fLeft'>";
            str1+="<div class='checkDiv fLeft minwidth100'>";
            str1+="<input type='checkbox' name='gpurityCustomize' class='filled-in' value='"+v.id+"' id='mpurity_"+v.id+"'>";
            str1+="<label for='mpurity_"+v.id+"'>"+v.name+"</label>";
            str1+="</div>";
            str1+="<div class='intInp fLeft'>&#8377; "+v.price+"</div>";
            str1+="</div>";
            
                str2+="<div class='dQuality fLeft'>";
                str2+="<div class='checkDiv fLeft minwidth100'>";
                str2+="<input type='radio' name='gpurityNotCustomize' class='filled-in' value='"+v.id+"' id='mpurity_Radio_"+v.id+"'>";
                str2+="<label for='mpurity_Radio_"+v.id+"'>"+v.name+"</label>";
                str2+="</div>";
                str2+="<div class='intInp fLeft'>&#8377; "+v.price+"</div>";
                str2+="</div>";
            
        });
        
        $('#ifpurityCustomiz').html(str1);
        $('#ifpurityNotCustomiz').html(str2);

    }
    
}


function getMetalColors()
{
    
    var URL = APIDOMAIN+"index.php?action=getMetalColorList";
    $.ajax({
        url:URL,
        type:"POST",
        success:function(res){
            res=JSON.parse(res);
            metalcolorCalllBack(res);
        }
    });
    
}

function metalcolorCalllBack(data)
{
    
    if(data['error']['err_code']=='0')
    {
        var str1= "";
        var str2= "";
        
        $.each(data.result, function(i,v) {
            str1+="<div class='checkDiv fLeft'>";
            str1+="<input type='checkbox' name='gcolorCustomize' class='filled-in' value='"+v.id+"' id='mcolor_"+v.id+"'>";
            str1+="<label for='mcolor_"+v.id+"'>"+v.name+"</label>";
            str1+="</div>";
                
            str2+="<div class='checkDiv fLeft'>";
            str2+="<input type='radio' name='gcolorNotCustomize' class='filled-in' value='"+v.id+"' id='mcolor_Radio_"+v.id+"'>";
            str2+="<label for='mcolor_Radio_"+v.id+"'>"+v.name+"</label>";
            str2+="</div>";
            
        });
        
        $('#ifcolorCustomiz').html(str1);
        $('#ifcolorNotCustomiz').html(str2);

    }
    
}

function getSizeList()
{
    
    //var URL = APIDOMAIN+"index.php?action=getSizeListByCat&catid=2";
    var URL = APIDOMAIN+"index.php?action=getSizeList";
    $.ajax({
        url:URL,
        type:"POST",
        success:function(res){
            res=JSON.parse(res);
            sizeListCalllBack(res);
        }
    });
    
}


function sizeListCalllBack(data)
{
    if(data['error']['err_code']=='0')
    {
        var str= "";
        
        $.each(data.result, function(i,v) {
        

            str+="<div class='dQuality fLeft'>";
            str+="<div class='checkDiv fLeft minwidth60'>";
            str+="<input type='checkbox' name='size' class='filled-in' value='"+v.id+"' id='size_"+v.id+"'>";
            str+="<label for='size_"+v.id+"'>"+v.sval+"</label>";
            str+="</div>";
            str+="<div class='intInp2 fLeft'>";
            str+="<input name='' type='text' id='sizeVal_"+v.id+"' autocomplete='false' placeholder=' Enter quantity ' class='txtInput fRight fmOpenR font14 c666'>";
            str+="</div>";
            str+="</div>";
        
        });
    }
    
    $('#cat_sizes').html(str);
    
}

getCategories();
getVendorList();
getDiamondQuality();
getMetalPurity();
getMetalColors();
getGemstoneList();
getSizeList();

function stopPropGate(event){
    if (event && $.isFunction(event.stopImmediatePropagation))
        event.stopImmediatePropagation();
    else 
        window.event.cancelBubble=true;
}


$(document).ready(function() {
    
    
    
    
    $('textarea').increaseAuto();
    $('.shapeComm').click(function() {
        $(this).toggleClass('shapeSelected');
        $(this).siblings().removeClass('shapeSelected');
    });



//    $('#diamond_Section').hide();
//    $('#gemstone_Section').hide();
//    $('#uncut_Section').hide();
//    $('#solitaires_Section').hide();
//    $('#price_Section').hide();





    $("[name='isPurityCustz']").change(function() {
        $("[name='ifpurityNotCustomiz'],[name='ifpurityCustomiz']").prop('checked', false);
        var val = $("[name='isPurityCustz']:checked").val();
        if (val == 1) {
            $('#ifpurityNotCustomiz').removeClass('dn');
            $('#ifpurityCustomiz').addClass('dn');
        }
        else {
            $('#ifpurityNotCustomiz').addClass('dn');
            $('#ifpurityCustomiz').removeClass('dn');

        }
    });


    $("[name='isColorCustz']").change(function() {
        $("[name='ifColorNotCustomiz'],[name='ifColorCustomiz']").prop('checked', false);

        var val = $("[name='isColorCustz']:checked").val();
        if (val == 1) {
            $('#ifcolorNotCustomiz').removeClass('dn');
            $('#ifcolorCustomiz').addClass('dn');
        }
        else {
            $('#ifcolorNotCustomiz').addClass('dn');
            $('#ifcolorCustomiz').removeClass('dn');

        }
    });
});

function addTags(evt, val, id, tagCont) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 44 || charCode == 13) {
        var str = "<div id='" + id + '_' + val + "' class='tagCommon transition300 fLeft'>";
        str += "<div class='fLeft txtCap'>" + val + "</div>";
        str += "<div class='removeTag fRight pointer' onclick=\"removeTag(this)\"></div>";
        str += "</div>";
        $('#' + tagCont).append(str);
        $('#' + tagCont).removeClass('dn');
        setTimeout(function() {
            $('#' + id).val('');
        }, 50);
    }

}

function removeTag(obj) {
    $(obj).parent().remove();
}



function showLoader(){
    $('.overlay,.loader').removeClass('dn');
}

function hideLoader(){
    $('.overlay,.loader').addClass('dn');
}