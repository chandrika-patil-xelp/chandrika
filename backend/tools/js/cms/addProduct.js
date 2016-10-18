var userid = '1';
var categories = new Array();
var vendorList = new Array();
var dqulaity = new Array();
var gemstonelist = new Array();
var catLen = 0;

var has_solitaire = false;
var has_diamond = false;
var has_uncut = false;
var has_gemstone = false;

var solitaireCnt = 1;
var diamondCnt = 1;
var unctCnt = 1;
var gemstoneCnt = 1;
var mpurity = new Array();
var mcolor = new Array();
var allrates = new Array();
var prdid="";
var previewData;
var isPlatinumJewellery = false;

var sflag = true;
var dflag = true;
var uflag = true;
var gflag = true;
var msgLabel = 500;



function getCategories()
{
    var URL = APIDOMAIN + "index.php?action=getCatgoryList";
    $.ajax({
        url: URL,
        type: "POST",
        async: false,
        success: function(res) {
            res = JSON.parse(res);

//            if(res['result']==null)
//            {
//                return;
//            }
            categories = res['result'];
            var active=0;


            $(categories).each(function(i,v){
                if(v.active==1){
                    active++;
                }
            });

            if(active<1){
                $('#noresults').removeClass('dn');
                $('#category_Section,#general_Section,#price_Section,.btnCont').addClass('dn');
            }else{
                $('#noresults').addClass('dn');
                $('#category_Section,#general_Section,#price_Section,.btnCont').removeClass('dn');
            }

            generateCats(res,0);
            //generateCatTree();

        }
    });
}

function generateCats(res,id)
{
    var result = res.result;

    if(res['result']==null)
    {
        return;
    }
    var html = '';
    $.each(result, function(i, vl) {
        if(vl.pid == id)
        {
            html += "<div class='checkDiv txtCap' id='parent_"+id+"_"+vl.cid+"'>";
                html += "<input type='checkbox' name='prtcateg' class='filled-in isparent' value='" + vl.cid + "' id='cat_" + vl.cid + "'>";
                html += "<label for='cat_" + vl.cid + "''>" + vl.name + "</label>";
            html += "</div>";

        }
    });
    //html += '<div class="breakLine"></div>';
//    if(id == 0)
//        $('#parentCatg').html(html);
//    else {
//        $('#parentCatg').append(html);
//    }
    bindCheckBox(res);
}
function removeCats(id)
{
    $("[id^=parent_"+id+"_]").each( function() {
        var rcatid=$(this).attr('id').split("_");
        removeCats($(this).find("input:checkbox").attr('id').replace('cat_',''));
        $(this).remove();
        removeSizes('cat_'+rcatid[2]);
    });
}


function bindCheckBox(res)
{
    $("input[type=checkbox]").each( function() {
        if($(this).attr('id').indexOf("cat_") != -1)
        {

            $(this).unbind();
            var id = $(this).attr('id');
            $('#'+id).bind('click', function() {
                if($(this).is(':checked'))
                {
                    generateCats(res,id.replace('cat_',''));
                    getSizeList(id.replace('cat_',''));
                }
                else
                {
                    removeCats(id.replace('cat_',''));
                    removeSizes(id);

                }
            });
        }
    });
}

function getChildCat(res, id)
{
    var str = generateHtml(res, id);
    return str;
}

function generateHtml(res, id)
{
    var str = '';
    $.each(res.result, function(i, v) {
        if (v.pid == id && v.active=="1")
        {
            str += "<div class='checkDiv txtCap'>";
            str += "<input type='checkbox' name='prtcateg' class='filled-in isparent' value='" + v.cid + "' id='cat_" + v.cid + "'>";
            str += "<label for='cat_" + v.cid + "''>" + v.name + "</label>";
            str += "</div>";
        }
    });
    return str;
}

//function getAllChilds(res)
//{
//    $("input[name='prtcateg']").unbind();
//    var str = "<div class='breakLine'></div>";
//    str += "<div class='divCon  fLeft fmOpenR mTop0'>";
//    $("input[name='prtcateg']").bind('click', function(event) {
//        stopPropGate(event);
//        if ($(this).is(":checked"))
//        {
//
//            var vstr = generateHtml(res, $(this).attr("id").replace('cat_', ''));
//        }
//        str += vstr;
//        str += "</div>";
//        if (vstr)
//            $('#parentCatg').append(str);
//        getAllChilds(res);
//        bindRemove();
//
//    });
//}


function bindRemove()
{
    $("input[name='prtcateg']").bind('click', function(event) {
        stopPropGate(event);
        if (!$(this).is(":checked"))
        {

            removeChilds($(this).attr("id").replace('cat_', ''));
        }
    });
}


function removeChilds(catid)
{
    catLen = categories.length;
    var i = 0;
    while (i < catLen)
    {
        if (categories[i]['pid'] == catid) {
            $('#cat_' + categories[i]['cid']).parent().remove();
        }
        i++;
    }

}



function getVendorList()
{
    var URL = APIDOMAIN + "index.php?action=getVendorList";
    $.ajax({
        url: URL,
        type: "POST",
        success: function(res) {
            res = JSON.parse(res);
            vendorList = res['result'];
            vendorListCalllBack(res);
        }
    });

}


function vendorListCalllBack(data)
{

    if (data['error']['err_code'] == '0')
    {
        var str = "<option value='-1'>Select Vendor</option>";
        $.each(data.result, function(i, v) {
            str += "<option value='" + v.vid + "'>" + v.name + "</option>";
        });

        $('#vendorList').html(str);
        bindAllForPrice();
    }

}


function getDiamondQuality()
{

    var URL = APIDOMAIN + "index.php?action=getDiamondQualityList";
    $.ajax({
        url: URL,
        type: "POST",
        success: function(res) {
            res = JSON.parse(res);
            dqulaity = res['result'];
            diamondQltyCalllBack(res);
        }
    });

}


function diamondQltyCalllBack(data)
{

    if (data['error']['err_code'] == '0')
    {
        var str1 = "";
        var str2 = "";

        $.each(data.result, function(i, v) {
          
            str1 += "<div class='dQuality fLeft'>";
            str1 += "<div class='checkDiv fLeft minwidth100'>";
            str1 += "<input type='checkbox' name='dmdquality_cust' class='filled-in' value='" + v.id + "' id='dql_" + v.id + "'>";
            str1 += "<label for='dql_" + v.id + "'>" + v.name + "</label>";
            str1 += "</div>";
            str1 += "<div class='intInp fLeft'>&#8377; " + v.price + "</div>";
            str1 += "</div>";

            str2 += "<div class='dQuality fLeft'>";
            str2 += "<div class='checkDiv fLeft minwidth100'>";
            str2 += "<input type='radio' name='dmdquality_notCust' class='filled-in'  value='" + v.id + "' id='dqRadio_" + v.id + "'>";
            str2 += "<label for='dqRadio_" + v.id + "' >" + v.name + "</label>";
            str2 += "</div>";
            str2 += "<div class='intInp fLeft'>&#8377; " + v.price + "</div>";
            str2 += "</div>";

        });
       
        $('#custQuality').html(str1);
        $('#notcustQuality').html(str2);

    }
    bindElementChange();

}

function getGemstoneList()
{

    var URL = APIDOMAIN + "index.php?action=getGemstoneList";
    $.ajax({
        url: URL,
        type: "POST",
        success: function(res) {
            res = JSON.parse(res);
            gemstonelist = res.result;
            gemstoneListCalllBack(res);
        }
    });

}



function gemstoneListCalllBack(data)
{
    if (data['error']['err_code'] == '0')
    {

        var str = "<option value='-1'>Select A Gemstone*</option>";
        $.each(data.result, function(i, v) {
            str += "<option value='" + v.id + "'>" + v.name + "</option>";
        });

        $('#gemstone_type').html(str);
        bindElementChange();
    }
}


function getMetalPurity()
{
    var URL = APIDOMAIN + "index.php?action=getGoldRates&case=2";
    $.ajax({
        url: URL,
        type: "POST",
        success: function(res) {
            res = JSON.parse(res);
            
            metalpurityCalllBack(res);
        }
    });

}


function metalpurityCalllBack(data)
{
    if (data['error']['err_code'] == '0')
    {
        var str1 = "<div class='titleDiv txtCap fLeft'>Metal Purity Customizable*</div>";
        var str2 = "<div class='titleDiv txtCap fLeft'>Metal Purity Not Customizable*</div>";
      
        $.each(data.result, function(i, v) {
           
            str1 += "<div class='dQuality fLeft'>";
                str1 += "<div class='checkDiv fLeft minwidth100'>";
                    str1 += "<input type='checkbox' name='gpurityCustomize' class='filled-in' value='" + v.id + "' id='mpurity_" + v.id + "'>";
                    str1 += "<label for='mpurity_" + v.id + "'>" + v.name + "</label>";
                str1 += "</div>";
                str1 += "<div class='intInp fLeft'>&#8377; " + v.price + "</div>";
            str1 += "</div>";

            str2 += "<div class='dQuality fLeft'>";
                str2 += "<div class='checkDiv fLeft minwidth100'>";
                    str2 += "<input type='radio' name='gpurityNotCustomize' class='filled-in' value='" + v.id + "' id='mpurity_Radio_" + v.id + "'>";
                    str2 += "<label for='mpurity_Radio_" + v.id + "'>" + v.name + "</label>";
                str2 += "</div>";
                str2 += "<div class='intInp fLeft'>&#8377; " + v.price + "</div>";
            str2 += "</div>";

        });

        $('#ifpurityCustomiz').html(str1);
        $('#ifpurityNotCustomiz').html(str2);
          //$('input[name="gpurityCustomize"]').eq(0).attr('checked',true);
          // $('input[name="gpurityNotCustomize"]').eq(0).attr('checked',true);
        bindElementChange();
    }

}


function getMetalColors()
{

    var URL = APIDOMAIN + "index.php?action=getMetalColorList";
    $.ajax({
        url: URL,
        type: "POST",
        success: function(res) {
            res = JSON.parse(res);
            metalcolorCalllBack(res);
        }
    });

}


function metalcolorCalllBack(data)
{

    if (data['error']['err_code'] == '0')
    {
        var str1 = "";
        var str2 = "";

        $.each(data.result, function(i, v) {
            str1 += "<div class='checkDiv fLeft'>";
            str1 += "<input type='checkbox' name='gcolorCustomize' class='filled-in' value='" + v.id + "' id='mcolor_" + v.id + "'>";
            str1 += "<label for='mcolor_" + v.id + "'>" + v.value + "</label>";
            str1 += "</div>";

            str2 += "<div class='checkDiv fLeft'>";
            str2 += "<input type='radio' name='gcolorNotCustomize' class='filled-in' value='" + v.id + "' id='mcolor_Radio_" + v.id + "'>";
            str2 += "<label for='mcolor_Radio_" + v.id + "'>" + v.value + "</label>";
            str2 += "</div>";

        });

        $('#ifcolorCustomiz').html(str1);
        $('#ifcolorNotCustomiz').html(str2);
        bindElementChange();
    }

}

function removeSizes(id){
    $('#cat_sizes .dQuality').each(function(){
        var sizefor=$(this).attr('size-for');
        if(sizefor==id)
            $(this).remove();

    });
}


function getSizeList(catid)
{

    var URL = APIDOMAIN+"index.php?action=getSizeListByCat&catid="+catid;
    //var URL = APIDOMAIN + "index.php?action=getSizeList";
    $.ajax({
        url: URL,
        type: "POST",
        success: function(res) {
            res = JSON.parse(res);
            sizeListCalllBack(res,catid);
        }
    });

}


function sizeListCalllBack(data,catid)
{
    if(data['result'])
    {
        if (data['error']['err_code'] == '0')
        {
            $('#cat_sizes .dQuality').remove();
            var str = "";

            $.each(data.result, function(i, v) {

                str += "<div class='dQuality fLeft' size-for='cat_"+catid+"'>";
                str += "<div class='checkDiv fLeft minwidth60'>";
                str += "<input type='radio' name='size' class='filled-in' value='" + v.id + "' id='size_" + v.id + "'>";
                str += "<label for='size_" + v.id + "'>" + v.sval + "</label>";
                str += "</div>";
                str += "<div class='intInp2 fLeft dn'>";
                str += "<input name='sizeQty' type='text' id='size_" + v.id + "_qty' autocomplete='false' placeholder=' Enter quantity ' class='txtInput fRight fmOpenR font14 c666 dn' value='1' onkeypress='return common.isDecimalKey(event, this.value);' maxlength='3'>";
                str += "</div>";
                str += "</div>";

            });
        }

        $('#cat_sizes').append(str);
        $('#cat_sizes').removeClass('dn');
    }

}


function stopPropGate(event)
{
    if (event && $.isFunction(event.stopImmediatePropagation))
        event.stopImmediatePropagation();
    else
        window.event.cancelBubble = true;
}


function bindShapes()
{
    $('.shapeComm').unbind();
    $('.shapeComm').bind('click', function() {
        var id = $(this).attr('id');
        $(this).toggleClass('shapeSelected');
        $(this).siblings().removeClass('shapeSelected');
    });

}

var metalPurityCust = true;
var metalColorCust = true;

var txt_selector = ['input[type=text],textarea'];
var radioCh_selector = ['input[type=radio],input[type=checkbox],label'];


function bindAllForPrice(){
    $(txt_selector).bind('blur',function(){
      //  genPriceSection();
    });
    $('label').bind('click',function(){
        //genPriceSection();
    });

}

function vendorPrdCode(val,pid)
{
    var checkState = true;
    if(pid !== '')
    {
        var URL = APIDOMAIN + "index.php?action=checkVproductCode&case=1&code="+val+"&pid="+pid;
    }
    else
    {
        var URL = APIDOMAIN + "index.php?action=checkVproductCode&case=2&code="+val;
    }
    $.ajax({
        url: URL,
        type: "POST",
        async:false,
        success: function(res)
        {
            obj = JSON.parse(res);
            errCode = obj.error.code;
            if(errCode == 1)
            {
                checkState = false;
            }
            else
            {
                checkState = true;
            }
        }
    });
    return checkState;
}

$(document).ready(function() {
    getCategories();
    getVendorList();
    getDiamondQuality();
    getMetalPurity();
    getMetalColors();
    getGemstoneList();
    //getSizeList();
    GetRates();

    $('#productDescription').bind('keyup',function()
    {
            var KeyID = event.keyCode;
            var textLen = parseInt($(this).val().length);
            var total = 500;
            if(KeyID == 8)
            {
                msgLabel  = msgLabel+1;
                $('.msgLabel').text(msgLabel+' character left');
            }

            if (this.value.length == total)
            {
                event.preventDefault();
            }

            if(textLen > total)
            {
                var finalData = $(this).val().substring(0, Math.min(textLen, total));
                $(this).val(finalData);
                common.toast(0,'Maximum limit of 500 characters is reached');
            }
            else
            {
                msgLabel = parseInt(total - textLen);
                $('.msgLabel').text(msgLabel+' character left');
            }

            if(textLen == 0)
            {
               msgLabel = parseInt(500);
               $('.msgLabel').text(msgLabel+' character max');
            }
    });

    if(edit==1)
    {
       
        oneditmode();
    }



    $('textarea').increaseAuto();

    bindShapes();
    bindAllForPrice();
    /*$("[name='isColorCustz']").change(function() {
        genPriceSection();
    });*/





//    $('#diamond_Section').addClass('dn');
//    $('#gemstone_Section').hide();
//    $('#uncut_Section').hide();
//    $('#solitaires_Section').hide();
//    $('#price_Section').hide();
//gpurityCustomize


    $("[name='isPurityCustz']").change(function() {
        $("[name='gpurityCustomize'],[name='gpurityNotCustomize']").prop('checked', false);
        mpurity = new Array();
        var val = $("[name='isPurityCustz']:checked").val();
        if (val == 1) {
            $('#ifpurityNotCustomiz').removeClass('dn');
            $('#ifpurityCustomiz').addClass('dn');
            metalPurityCust = false;
        }
        else {
            $('#ifpurityNotCustomiz').addClass('dn');
            $('#ifpurityCustomiz').removeClass('dn');
            metalPurityCust = true;

        }
    });


    $("[name='isColorCustz']").change(function() {
        $("[name='ifColorNotCustomiz'],[name='ifColorCustomiz']").prop('checked', false);
        $("[name='gcolorCustomize'],[name='gcolorNotCustomize']").prop('checked', false);

        mcolor = new Array();
        var val = $("[name='isColorCustz']:checked").val();
        if (val == 1) {
            $('#ifcolorNotCustomiz').removeClass('dn');
            $('#ifcolorCustomiz').addClass('dn');
            metalColorCust = false;
        }
        else {
            $('#ifcolorNotCustomiz').addClass('dn');
            $('#ifcolorCustomiz').removeClass('dn');
            metalColorCust = true;

        }
    });



    $("#stone1,#stone2,#stone3,#stone4").change(function() {
        var id = $(this).attr('id');
        var flag = $(this).is(':CHECKED');

        if (id == 'stone1' && flag == true)
        {
            if (sflag)
                addSolitaire();
            $('#solitaires_Section').removeClass('dn');
            sflag = false;
            has_solitaire = true;
        }
        if (id == 'stone1' && !flag)
        {
            $('#solitaires_Section').addClass('dn');
            has_solitaire = false;
        }
        if (id == 'stone2' && flag)
        {
            if (dflag)
                addDiamond();
            $('#diamond_Section').removeClass('dn');
            dflag = false;
            has_diamond = true;

        }
        if (id == 'stone2' && !flag)
        {
            $('#diamond_Section').addClass('dn');
            has_diamond = false;


        }
        if (id == 'stone3' && flag)
        {
            if (uflag)
                addUncut();
            $('#uncut_Section').removeClass('dn');
            uflag = false;
            has_uncut = true;
        }
        if (id == 'stone3' && !flag)
        {
            $('#uncut_Section').addClass('dn');
            has_uncut = false;
        }
        if (id == 'stone4' && flag)
        {
            if (gflag)
                addGemstone();
            $('#gemstone_Section').removeClass('dn');
            gflag = false;
            has_gemstone = true;
        }
        if (id == 'stone4' && !flag)
        {
            $('#gemstone_Section').addClass('dn');
            has_gemstone = false;
        }
    });


    $("[name='diamond_setting']").bind('click', function(e) {
        var id = $(this).attr('id');
        stopPropGate(e);
        if ($(this).is(":checked") && id !== 'ds8')
        {
            //$('#otherdsType').addClass('dn');
        }
        else if ($(this).is(":checked") && id == 'ds8') {

            $('#otherdsType').removeClass('op0');
        }
        else if (!$(this).is("checked") && id == 'ds8') {

            $('#otherdsType').addClass('op0');
        }
    });

    bindElementChange();
    changeJTypeFields();


});

function changeJTypeFields()
{
    $("input[name='jType']").bind('click', function()
    {
        if($(this).attr('id') == 'jType3')
        {
            $('.stonesSelect').removeClass('dn');
            $('.jewelCertificates').removeClass('dn');
            $('#mpurity_6').parent().parent().removeClass('dn');

            $('.metalPurityDiv').addClass('dn');
            $('.metalColorDiv').addClass('dn');
            $('.ifpurityCustomiz').addClass('dn');
            $('.ifpurityNotCustomiz').addClass('dn');
            isPlatinumJewellery = true;
        }
        if($(this).attr('id') == 'jType2')
        {
            $('.stonesSelect').addClass('dn');
            $('.jewelCertificates').addClass('dn');
            $('#mpurity_6').parent().parent().addClass('dn');

            $('.metalPurityDiv').removeClass('dn');
            $('.metalColorDiv').removeClass('dn');
            $('.ifpurityCustomiz').removeClass('dn');
            $('.ifpurityNotCustomiz').removeClass('dn');
            isPlainGold = true;
            isPlatinumJewellery = false;
        }
        if($(this).attr('id') == 'jType1')
        {
            $('.stonesSelect').removeClass('dn');
            $('.jewelCertificates').removeClass('dn');
            $('#mpurity_6').parent().parent().removeClass('dn');
            $('.metalPurityDiv').removeClass('dn');
            $('.metalColorDiv').removeClass('dn');
            $('.ifpurityCustomiz').removeClass('dn');
            $('.ifpurityNotCustomiz').removeClass('dn');
            isPlatinumJewellery = false;
            isPlainGold = false;
        }
    });
}


function addTags(evt, val, id, tagCont)
{
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

function removeTag(obj)
{
    $(obj).parent().remove();
}


function showLoader()
{
    $('.overlay,.loader').removeClass('dn');
}

function hideLoader()
{
    $('.overlay,.loader').addClass('dn');
}

function deleteThis(id)
{
    $('#'+id).next('.breakLine').remove();
    $('#'+id).remove();

    if($("div[id^='solitaireComm_']").length==0)
    {
        $('#solitaires_Section').addClass('dn');
        $('#stone1').attr('checked',false);
        has_solitaire=false;
        changePrdPropertyStatus(1);
        sflag = true;

    }

    if($("div[id^='diamondComm_']").length==0)
    {
        $('#diamond_Section').addClass('dn');
        $('#stone2').attr('checked',false);
        has_diamond=false;
        changePrdPropertyStatus(2);
        dflag = true;

    }

    if($("div[id^='uncutComm_']").length==0)
    {
        $('#uncut_Section').addClass('dn');
        $('#stone3').attr('checked',false);
        has_uncut=false;
        changePrdPropertyStatus(3);
        uflag = true;

    }

    if($("div[id^='gemstoneComm_']").length==0)
    {
        $('#gemstone_Section').addClass('dn');
        $('#stone4').attr('checked',false);
        has_gemstone=false;
        changePrdPropertyStatus(4);
        gflag = true;
    }

}


function changePrdPropertyStatus(type)
{
        var URL= APIDOMAIN+"?action=changePrdPropertyStatus";
        values= {};
        values['type'] = type;
        values['pid'] = prdid;
        values['updatedby'] = userid;


        var dt = JSON.stringify(values);

        $.ajax({
            url:URL,
            type:'POST',
            data:{dt:dt},
            success:function(res){
                res=JSON.parse(res);
            }
        });

}




function addSolitaire()
{
    var soltColor = new Array('D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O');
    var soltClarity = new Array('IF', 'VVS1', 'VVS2', 'VS1', 'VS2', 'SI1', 'SI2', 'I1');
    var soltGeneral = new Array('Excellent', 'Very Good', 'Good', 'Fair');


    var str = "<div class='commCont fLeft' id='solitaireComm_" + solitaireCnt + "' db-id=''>";
//    if(solitaireCnt>1 || edit==1)
//    {
        str+="<div class='deleteElements fRight transition300' onclick=\"deleteThis('solitaireComm_" + solitaireCnt + "');deleteSolitaire(this)\"></div>";
    //}
    str += generateShapes('solitaire');
    str += generateColors('solitaire', soltColor);
    str += generateClarity(soltClarity);
    str += generateGeneral(soltGeneral);
    str += generateFluorescence();
    str += generateSoliTxtBox();

    str += "</div><div class='breakLine'></div>";
    $('#newSolitaires').append(str);
    bindShapes();
    solitaireCnt++;
    bindElementChange();
}


function generateShapes(type)
{
    var id = "";
    if (type == 'solitaire')
    {
        id = 'solitaire' + solitaireCnt + '_shape';
    }
    else if (type == 'diamond') {
        id = 'diamond' + diamondCnt + '_shape';
    }

    var str = "";
    str += "<div class='shapesContComm fLeft'>";
    str += "<div class='allShapes fLeft'>";
    str += "<center>";
    str += "<div id='" + id + "_Emerald' class='shapeComm transition300 Emerald'>";
    str += "</div><div id='" + id + "_Round' class='shapeComm transition300 Round'>";
    str += "</div><div id='" + id + "_Pear' class='shapeComm transition300 Pear'>";
    str += "</div><div id='" + id + "_Princess' class='shapeComm transition300 Princess'>";
    str += "</div><div id='" + id + "_Marquise' class='shapeComm transition300 Marquise'>";
    str += "</div><div id='" + id + "_Oval' class='shapeComm transition300 Oval'>";
    str += "</div><div id='" + id + "_Cushion' class='shapeComm transition300 Cushion'>";
    str += "</div><div id='" + id + "_Heart' class='shapeComm transition300 Heart'>";
    str += "</div><div id='" + id + "_Radiant' class='shapeComm transition300 Radiant'>";
    str += "</div><div id='" + id + "_Asscher' class='shapeComm transition300 Asscher'>";
    str += "</div>";
    str += "</center>";
    str += "</div>";
    str += "</div>";

    return str;

}


function generateColors(type, colors)
{

    var cLen = colors.length;

    var str = "<div class='divCon  fLeft' id='solitaireColors_" + solitaireCnt + "_Cont'><div class='titleDiv txtCap fLeft'>Color*</div><div class='radioCont fLeft'>";

    var i = 0;
    while (i < cLen) {
        str += "<div class='checkDiv fLeft'>";
        str += "<input type='radio' value='" + colors[i] + "' name='solitaireColors_" + solitaireCnt + "' class='filled-in' id='soliColors_" + solitaireCnt + "_Color_" + colors[i] + "'>";
        str += "<label for='soliColors_" + solitaireCnt + "_Color_" + colors[i] + "''>" + colors[i] + "</label>";
        str += "</div>";
        i++;
    }

    str += "</div></div><div class='breakLine'></div>";

    return str;

}


function generateClarity(clarity)
{
    var cLen = clarity.length;

    var str = "<div class='divCon  fLeft' id='solitaireClarity_" + solitaireCnt + "_Cont'><div class='titleDiv txtCap fLeft'>Clarity*</div><div class='radioCont fLeft'>";

    var i = 0;
    while (i < cLen) {
        str += "<div class='checkDiv fLeft'>";
        str += "<input type='radio' value='" + clarity[i] + "' name='solitaireclarity_" + solitaireCnt + "' class='filled-in' id='soliclarity_" + solitaireCnt + "_clarity_" + clarity[i] + "'>";
        str += "<label for='soliclarity_" + solitaireCnt + "_clarity_" + clarity[i] + "''>" + clarity[i] + "</label>";
        str += "</div>";
        i++;
    }
    str += "</div></div><div class='breakLine'></div>";
    return str;

}


function generateGeneral(general)
{
    var cLen = general.length;
    var ids = ['cut', 'symmetry', 'polish'];
    var str = "";
    for (var i = 0; i < 3; i++)
    {
        str += "<div class='divCon  fLeft' id='solitaire" + ids[i] + "_" + solitaireCnt + "_Cont'><div class='titleDiv txtCap fLeft'>" + ids[i] + "</div><div class='radioCont fLeft'>";
        var j = 0;
        while (j < cLen) {
            str += "<div class='checkDiv fLeft'>";
            str += "<input type='radio' value='" + general[j] + "' name='solitaire" + ids[i] + "_" + solitaireCnt + "' class='filled-in' id='soli" + ids[i] + "_" + solitaireCnt + "_" + ids[i] + "_" + general[j] + "'>";
            str += "<label for='soli" + ids[i] + "_" + solitaireCnt + "_" + ids[i] + "_" + general[j] + "''>" + general[j] + "</label>";
            str += "</div>";
            j++;
        }
        str += "</div></div>";

    }

    return str;

}



function generateFluorescence()
{

    var fvals = ['None', 'Faint', 'Medium', 'Strong', 'Very Strong'];
    var cLen = fvals.length;
    var str = "";
    str += "<div class='divCon  fLeft' id='solitairefluorescence_" + solitaireCnt + "_Cont'><div class='titleDiv txtCap fLeft'>Fluorescence</div><div class='radioCont fLeft'>";
    var j = 0;
    while (j < cLen) {
        str += "<div class='checkDiv fLeft'>";
        str += "<input type='radio' value='" + fvals[j] + "' name='solitaireFluorescence_" + solitaireCnt + "' class='filled-in' id='soliFluorescence_" + solitaireCnt + "_" + fvals[j] + "'>";
        str += "<label for='soliFluorescence_" + solitaireCnt + "_" + fvals[j] + "'>" + fvals[j] + "</label>";
        str += "</div>";
        j++;
    }
    str += "</div></div><div class='breakLine'></div>";



    return str;

}


function generateSoliTxtBox()
{
    var str = "";
    str += "<div class='divCon2  fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>Carat*</div>";
    str += "<input  name='solitaireCarat' id='solcaratweight" + solitaireCnt + "' type='text' placeholder='eg. 1.00' class='txtInput fLeft fmOpenR font14 c666' maxlength='5' onkeypress='return common.isDecimalKey(event, this.value);'>";
    str += "</div>";
    str += "<div class='divCon2  fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>Price / Carat*</div>";
    str += "<input name='solitairePriceCarat' id='solpricecarat" + solitaireCnt + "'' type='text' placeholder='eg. 1000' class='txtInput fLeft fmOpenR font14 c666' onkeypress='return common.isDecimalKey(event, this.value);'>";
    str += "</div>";
    str += "<div class='divCon2  fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>Table</div>";
    str += "<input name='solitaireTable' id='soltable" + solitaireCnt + "'' type='text' placeholder='eg. 1000' class='txtInput fLeft fmOpenR font14 c666'>";
    str += "</div>";
    str += "<div class='divCon2  fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>Crown Angle</div>";
    str += "<input name='solitaireCrownAngle' id='solCrownAngle" + solitaireCnt + "'' type='text' placeholder='eg. 52' class='txtInput fLeft fmOpenR font14 c666'>";
    str += "</div>";
    str += "<div class='divCon2  fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>Girdle</div>";
    str += "<input name='solitaireGirdle' id='solGirdle" + solitaireCnt + "'' type='text' placeholder='eg. 1.22' class='txtInput fLeft fmOpenR font14 c666'>";
    str += "</div>";
    str += "<div class='divCon2  fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>No of Solitaires*</div>";
    str += "<input name='solitaireNofs' id='solNofs" + solitaireCnt + "'' type='text' placeholder='eg. 1.22' class='txtInput fLeft fmOpenR font14 c666'>";
    str += "</div>";

    return str;
}


function addDiamond()
{

    var str = "<div class='commCont fLeft' id='diamondComm_" + diamondCnt + "' db-id=''>";
    //if(diamondCnt>1 || edit==1)
    //{
        str+="<div class='deleteElements fRight transition300' onclick=\"deleteThis('diamondComm_" + diamondCnt + "');deleteDiamond(this)\"></div>";
    //}
    str += generateShapes('diamond');
    str += "<div class='divCon fLeft fmOpenR'>";
    str += "<div class='titleDiv fLeft wAuto'>Is this diamond customizable?</div>";
    str += "<div class='checkDiv fLeft mTop0'>";
    str += "<input type='radio' name='isDiamondCustz_" + diamondCnt + "' class='filled-in' value='1' id='dcust_" + diamondCnt + "' checked>";
    str += "<label for='dcust_" + diamondCnt + "'>Yes</label>";
    str += "</div>";
    str += "<div class='checkDiv fLeft mTop0'>";
    str += "<input type='radio' name='isDiamondCustz_" + diamondCnt + "' class='filled-in' value='0' id='dNotcust_" + diamondCnt + "'>";
    str += "<label for='dNotcust_" + diamondCnt + "'>No</label>";
    str += "</div>";
    str += "</div>";
    str += "<div class='qltCLeft fLeft' id='dmdLeftPanael" + diamondCnt + "'>";
    str += generateDiamondQuality();
    str += "</div>";
    str += "<div class='qltCRight fLeft' id='dmdRightPanael" + diamondCnt + "'>";
    str += generateDiamondTxtBox();
    str += "</div>";
    str += "</div><div class='breakLine'></div>";
    $('#newDiamonds').append(str);
    bindShapes();
    bindDmdQuaity();
    diamondCnt++;
    bindElementChange();
}


function generateDiamondTxtBox()
{

    var str = "";
    str += "<div class='divCon  fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>Carat*</div>";
    str += "<input  name='diamondCarat' id='dmdcaratweight" + diamondCnt + "' type='text' placeholder='eg. 1.00' class='txtInput fLeft fmOpenR font14 c666' maxlength='5' onkeypress='return common.isDecimalKey(event, this.value);'>";
    str += "</div>";

    str += "<div class='divCon  fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>No. Of Pieces*</div>";
    str += "<input name='diamondPieces' id='dmdPieces" + diamondCnt + "'' type='text' placeholder='eg. 5' class='txtInput fLeft fmOpenR font14 c666'>";
    str += "</div>";

    return str;

}


function generateDiamondQuality()
{
    var tstr = "<div class='titleDiv txtCap fLeft'>Diamond Quality*</div>";
    var str1 = "";
    var str2 = "";
  
    str1 += "<div class='divCon  fLeft fmOpenR mTop0' id='custQuality" + diamondCnt + "''>";

    $.each(dqulaity, function(i, v) {
       
        str1 += "<div class='dQuality fLeft'>";
        str1 += "<div class='checkDiv fLeft minwidth100'>";
        str1 += "<input type='checkbox' name='dmdquality_cust" + diamondCnt + "' class='filled-in' value='" + v.id + "' id='dql_" + diamondCnt + "_" + v.id + "'>";
        str1 += "<label for='dql_" + diamondCnt + "_" + v.id + "'>" + v.name + "</label>";
        str1 += "</div>";
        str1 += "<div class='intInp fLeft'>&#8377; " + v.price + "</div>";
        str1 += "</div>";
    });

    str1 += "</div>";

    str2 += "<div class='divCon  fLeft fmOpenR mTop0 dn' id='notcustQuality" + diamondCnt + "'>";
    $.each(dqulaity, function(i, v) {
        
        str2 += "<div class='dQuality fLeft'>";
        str2 += "<div class='checkDiv fLeft minwidth100'>";
        str2 += "<input type='radio' name='dmdquality_notCust" + diamondCnt + "' class='filled-in' value='" + v.id + "' id='dqRadio_" + diamondCnt + "_" + v.id + "'>";
        str2 += "<label for='dqRadio_" + diamondCnt + "_" + v.id + "'>" + v.name + "</label>";
        str2 += "</div>";
        str2 += "<div class='intInp fLeft'>&#8377; " + v.price + "</div>";
        str2 += "</div>";
    });

    str2 += "</div>";
   
    var str = tstr + str1 + str2;

    return str;

}


function addUncut()
{

    var colors = new Array('D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O');
    var clarity = new Array('IF', 'VVS1', 'VVS2', 'VS1', 'VS2', 'SI1', 'SI2', 'I1');
    var cLen = colors.length;
    var cl="";
    if(unctCnt>1){
        cl='mTop0';
    }
    var str1 = "<div class='divCon "+cl+" fLeft' id='uncutColors_" + unctCnt + "_Cont'><div class='titleDiv txtCap fLeft'>Diamond Color*</div><div class='radioCont fLeft'>";

    var i = 0;
    while (i < cLen) {
        str1 += "<div class='checkDiv fLeft'>";
        str1 += "<input type='checkbox' value='" + colors[i] + "' name='uncutColors_" + unctCnt + "' class='filled-in' id='uncutColors_" + unctCnt + "_Color_" + colors[i] + "'>";
        str1 += "<label for='uncutColors_" + unctCnt + "_Color_" + colors[i] + "''>" + colors[i] + "</label>";
        str1 += "</div>";
        i++;
    }

    str1 += "</div></div>";

    var tstr = "<div class='divCon  fLeft' id='uncutQuality_" + unctCnt + "_Cont'><div class='titleDiv txtCap fLeft'>Diamond Quality*</div>";
    var str2 = "";
    str2 += "<div class='divCon  fLeft fmOpenR mTop0' id='custQuality" + diamondCnt + "''>";

    $.each(clarity, function(i, v) {
        str2 += "<div class='checkDiv fLeft minwidth100'>";
        str2 += "<input type='radio' name='uncutquality_" + unctCnt + "' class='filled-in' value='" + v + "' id='uncutQulRadio_" + unctCnt + "_" + v + "'>";
        str2 += "<label for='uncutQulRadio_" + unctCnt + "_" + v + "'>" + v + "</label>";
        str2 += "</div>";
    });

    str2 += "</div></div>";

    var str3 = "";
    str3 += "<div class='divCon2  fLeft'>";
    str3 += "<div class='titleDiv txtCap fLeft'>Carat*</div>";
    str3 += "<input  name='uncutCarat' id='uncutcaratweight" + unctCnt + "' type='text' placeholder='eg. 1.00' class='txtInput fLeft fmOpenR font14 c666' maxlength='5' onkeypress='return common.isDecimalKey(event, this.value);'>";
    str3 += "</div>";
    str3 += "<div class='divCon2  fLeft'>";
    str3 += "<div class='titleDiv txtCap fLeft'>Price / Carat*</div>";
    str3 += "<input name='uncutPriceCarat' id='uncutpricecarat" + unctCnt + "'' type='text' placeholder='eg. 1000' class='txtInput fLeft fmOpenR font14 c666' onkeypress='return common.isDecimalKey(event, this.value);'>";
    str3 += "</div>";
    str3 += "<div class='divCon2  fLeft'>";
    str3 += "<div class='titleDiv txtCap fLeft'>No. Of Pieces*</div>";
    str3 += "<input name='uncutPieces' id='uncutPieces" + unctCnt + "'' type='text' placeholder='eg. 5' class='txtInput fLeft fmOpenR font14 c666'>";
    str3 += "</div>";

    var delStr="<div class='deleteElements fRight transition300' onclick=\"deleteThis('uncutComm_" + unctCnt + "');deleteUncut(this)\"></div>";
    var str="";
    //if(unctCnt>1)
    //{
        str += "<div class='commCont fLeft' id='uncutComm_" + unctCnt + "' db-id=''>"+delStr + str1+ tstr + str2 + str3 + "<div class='breakLine'></div></div>";
    //}
//    else{
//        str += "<div class='commCont fLeft' id='uncutComm_" + unctCnt + "'>"+str1+tstr + str2 + str3 + "<div class='breakLine'></div></div>";
//    }

    $('#newUncutDiamonds').append(str);
    unctCnt++;
    bindElementChange();
}


function addGemstone()
{

    var str = "<div class='commCont fLeft' id='gemstoneComm_" + gemstoneCnt + "' db-id=''>";

    //if(gemstoneCnt>1)
    //{
        str+="<div class='divCon fLeft mTop0'><div class='deleteElements fRight transition300' onclick=\"deleteThis('gemstoneComm_" + gemstoneCnt + "');deleteGemstone(this)\"></div></div>";
    //}

    str += "<div class='divCon2 fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>Select a gemstone</div>";

    str += "<select id='gemstone_type" + gemstoneCnt + "' class='txtSelect fLeft fmOpenR font14 c666'>";

    str += "<option value='-1'>Select A Gemstone</option>";
    $.each(gemstonelist, function(i, v) {
        str += "<option value='" + v.id + "'>" + v.name + "</option>";
    });

    str += "</select></div>";
    str += "<div class='divCon2  fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>Carat*</div>";
    str += "<input  name='gemstoneCarat' id='gemstonecaratweight" + gemstoneCnt + "' type='text' placeholder='eg. 1.00' class='txtInput fLeft fmOpenR font14 c666' maxlength='5' onkeypress='return common.isDecimalKey(event, this.value);'>";
    str += "</div>";
    str += "<div class='divCon2  fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>Price / Carat*</div>";
    str += "<input name='gemstonePriceCarat' id='gemstonepricecarat" + gemstoneCnt + "'' type='text' placeholder='eg. 1000' class='txtInput fLeft fmOpenR font14 c666' onkeypress='return common.isDecimalKey(event, this.value);'>";
    str += "</div>";
    str += "<div class='divCon2  fLeft'>";
    str += "<div class='titleDiv txtCap fLeft'>No. Of Pieces*</div>";
    str += "<input name='gemstonePieces' id='gemstonePieces" + gemstoneCnt + "'' type='text' placeholder='eg. 5' class='txtInput fLeft fmOpenR font14 c666'>";
    str += "</div>";
    str += "</div><div class='breakLine'></div>";
    $('#newGemstone').append(str);

    gemstoneCnt++;
    bindElementChange();

}



function bindDmdQuaity()
{


    $('[name*=isDiamondCustz_]').bind('change', function() {
        var name = $(this).attr('name');
        var val = $(this).val();
        // 1 -> Customizabale   0 -> NOt Customizable
        var cnt = name.split("_");
        cnt = cnt[1];
        if (val == 1)
        {
            $('#notcustQuality' + cnt).addClass('dn');
            $('#custQuality' + cnt).removeClass('dn');

        }
        else {

            $('#custQuality' + cnt).addClass('dn');
            $('#notcustQuality' + cnt).removeClass('dn');
        }


        $('[name=dmdquality_notCust' + cnt + ']').prop('checked', false);
        $('[name=dmdquality_cust' + cnt + ']').prop('checked', false);
    });

}

function addProduct()
{
    previewData=new Array();
    showLoader();
    $('.forScrollBtn').removeClass('op0');
    var flag = validateForm();
    if(!flag)
        hideLoader();
    if (flag)
    {

        var catArray = new Array();
        var pcatArray = new Array();
        var dmdSetting = new Array();
        var sizesArray = new Array();
        var solitaires = new Array();
        var diamonds = new Array();
        var uncut = new Array();
        var gemstone = new Array();


        $('[name=prtcateg]').each(function() {
            if ($(this).is(':CHECKED'))
            {
                pcatArray.push($(this).val());
                catArray.push($(this).val());
            }

//            else if (!$(this).is(':CHECKED'))
//            {
//
//                var removeItem = $(this).val();
//                catArray = jQuery.grep(catArray, function(value)
//                {
//                    return value !== removeItem;
//                });
//            }
        });



        var vid = $('#vendorList').val();
        var vname = $('#vendorList option:selected').text();
        var vPCode = $('#vendorPrdCode').val();
        var jewelleryType = "";
        var product_name = encodeURIComponent($('#product_name').val());
        var product_seo_name = encodeURIComponent($('#product_seo_name').val());
        var product_weight = $('#product_weight').val();
        var leadTime = $('#leadTime').val();
        var gender = $('[name*=gender]:Checked').val();
        var certificate = "";
        var metal_weight = $('#metal_weight').val();
        var making_charges = $('#making_charges').val();
        var procurement_cost = $('#procurement_cost').val();
        var margin = $('#margin').val();
        var mt1 = $('#measure1').val();
        var mt2 = $('#measure2').val();
        var eligible = $('input[name="eligible"]:checked').val();
        var measurement = mt1 + "X" + mt2;
        var productDescription = encodeURIComponent($('#productDescription').val().replace(/<(?:.|\n)*?>/gm,''));
        $('[name=diamond_setting]').each(function()
        {
            if ($(this).is(':CHECKED'))
            {

                if ($(this).attr('id') == 'ds8') {
                    $('#ds8').val('other_'+$('#diamond_settingOth').val());
                }

                dmdSetting.push(encodeURIComponent($(this).val()));
            }
            else if (!$(this).is(':CHECKED'))
            {
                var removeItem = $(this).val();
                dmdSetting = jQuery.grep(dmdSetting, function(value) {
                    return value !== removeItem;
                });
            }
        });



        $('[name=certificate]').each(function() {
            if ($(this).is(':CHECKED'))
                certificate = $(this).val();
        });

        $('[name=jType]').each(function() {
            if ($(this).is(':CHECKED'))
                jewelleryType = $(this).val();
        });

        if (metalPurityCust)
        {
            mpurity = [];
            $('[name=gpurityCustomize]').each(function() {
                if ($(this).is(':CHECKED'))
                    mpurity.push($(this).val());
                else if (!$(this).is(':CHECKED')) {
                    var removeItem = $(this).val();
                    mpurity = jQuery.grep(mpurity, function(value) {
                        return value !== removeItem;
                    });
                }

            });
        }
        else if (!metalPurityCust)
        {
            mpurity.push($('[name=gpurityNotCustomize]:CHECKED').val());
        }

        if (metalColorCust)
        {
            mcolor = [];
            $('[name=gcolorCustomize]').each(function() {
                if ($(this).is(':CHECKED'))
                    mcolor.push($(this).val());

                else if (!$(this).is(':CHECKED')) {
                    var removeItem = $(this).val();
                    mcolor = jQuery.grep(mcolor, function(value) {
                        return value !== removeItem;
                    });
                }

            });
        }
        else if (!metalColorCust)
        {
            mcolor.push($('[name=gcolorNotCustomize]:CHECKED').val());
        }


        $('[name=size]').each(function() {
            if ($(this).is(':CHECKED'))
            {
                var ids = $(this).attr('id');
                var qty = $('#' + ids + "_qty").val();
                var id = ids.split("_");

                values = {};
//                values['id']=id[1];
//                values['qty']=qty;

                values[id[1]] = qty;
                sizesArray.push(values);

            }
            else if (!$(this).is(':CHECKED')) {
                var ids = $(this).attr('id');
                var id = ids.split("_");
                var removeItem = id[1];
                sizesArray = jQuery.grep(sizesArray, function(value) {
                    return value !== removeItem;
                });
            }

        });


        if (has_solitaire)
        {
            $('[id*=solitaireComm_]').each(function() {
                values = {};
                var id = $(this).attr('id');
                var ids = id.split("solitaireComm_");
                ids = ids[1];

                var sId=    $('#solitaireComm_' + ids).attr('db-id');
                var shape = $('#solitaireComm_' + ids + ' .shapeSelected').attr('id').split("shape_");
                var color = $('[name=solitaireColors_' + ids + ']:checked').val();
                var clarity = $('[name=solitaireclarity_' + ids + ']:checked').val();
                var cut = $('[name=solitairecut_' + ids + ']:checked').val();
                var symmetry = $('[name=solitairesymmetry_' + ids + ']:checked').val();
                var polish = $('[name=solitairepolish_' + ids + ']:checked').val();
                var fluorescence = $('[name=solitaireFluorescence_' + ids + ']:checked').val();
                var carat = $('#solcaratweight' + ids + '').val();
                var price_per_carat = $('#solpricecarat' + ids + '').val();
                var table = $('#soltable' + ids + '').val();
                var crown_angle = $('#solCrownAngle' + ids + '').val();
                var girdle = $('#solGirdle' + ids + '').val();
                var nofs = $('#solNofs' + ids + '').val();

                if(sId!=="")
                {
                    values['solitaire_id'] = sId;
                }
                values['shape'] = shape[1];
                values['color'] = color;
                values['clarity'] = clarity;
                values['cut'] = encodeURIComponent(cut);
                values['symmetry'] = encodeURIComponent(symmetry);
                values['polish'] = encodeURIComponent(polish);
                values['fluorescence'] = encodeURIComponent(fluorescence);
                values['carat'] = carat;
                values['price_per_carat'] = price_per_carat;
                values['table'] = table;
                values['crown_angle'] = crown_angle;
                values['girdle'] = girdle;
                values['nofs'] = nofs;

                solitaires.push(values);
            });

        }
        if (!has_solitaire)
        {
            solitaires = [];
        }

        if (has_diamond)
        {

            $('[id*=diamondComm_]').each(function() {
                var id = $(this).attr('id');
                var ids = id.split("diamondComm_");
                ids = ids[1];
                values = {};

                var shape = $('#diamondComm_' + ids + ' .shapeSelected').attr('id').split("shape_");
                var customiz = $('[name*=isDiamondCustz_' + ids + ']:checked').val();
                var dquality = new Array();
                if (customiz == 1)
                {

                    $('[name=dmdquality_cust' + ids + ']').each(function() {

                        if ($(this).is(':CHECKED'))
                        {
                            dquality.push($(this).val());

                        }
                        else if (!$(this).is(':CHECKED')) {
                            var removeItem = $(this).val();
                            dquality = jQuery.grep(dquality, function(value) {
                                return value !== removeItem;
                            });
                        }

                    });

                }
                else if (customiz == 0)
                {
                    dquality.push($('[name*=dmdquality_notCust' + ids + ']:checked').val());
                }


                var carat = $('#dmdcaratweight' + ids + '').val();
                var total_no = $('#dmdPieces' + ids + '').val();
                var dId=    $('#diamondComm_' + ids).attr('db-id');

                if(dId!=="")
                {
                    values['diamond_id'] = dId;
                }
                values['shape'] = shape[1];
                values['carat'] = carat;
                values['total_no'] = total_no;
                values['quality'] = dquality;

                diamonds.push(values);
            });

        }
        if (!has_diamond)
        {
            diamonds = [];
        }

        if (has_uncut)
        {

            $('[id*=uncutComm_]').each(function() {
                values = {};
                var id = $(this).attr('id');
                var ids = id.split("uncutComm_");
                ids = ids[1];
                var uncutColor = new Array();

                $('[name=uncutColors_' + ids + ']').each(function() {

                    if ($(this).is(':CHECKED'))
                    {
                        uncutColor.push($(this).val());

                    }
                    else if (!$(this).is(':CHECKED')) {
                        var removeItem = $(this).val();
                        uncutColor = jQuery.grep(uncutColor, function(value) {
                            return value !== removeItem;
                        });
                    }

                });


                var quality = $('[name=uncutquality_' + ids + ']:checked').val();
                var carat = $('#uncutcaratweight' + ids + '').val();
                var price = $('#uncutpricecarat' + ids + '').val();
                var total_no = $('#uncutPieces' + ids + '').val();
                var unid=    $('#uncutComm_' + ids).attr('db-id');

                if(unid!=="")
                {
                    values['uncut_id'] = unid;
                }
                values['color'] = uncutColor.toString();
                values['carat'] = carat;
                values['total_no'] = total_no;
                values['quality'] = quality;
                values['price_per_carat'] = price;

                uncut.push(values);

            });
        }

        if (!has_uncut)
        {
            uncut = [];
        }


        if (has_gemstone)
        {

            $('[id*=gemstoneComm_]').each(function() {
                values = {};
                var id = $(this).attr('id');
                var ids = id.split("gemstoneComm_");
                ids = ids[1];

                var gvalue = $('#gemstone_type' + ids + '').val();
                var carat = $('#gemstonecaratweight' + ids + '').val();
                var price = $('#gemstonepricecarat' + ids + '').val();
                var total_no = $('#gemstonePieces' + ids + '').val();


                values['gvalue'] = gvalue;
                values['carat'] = carat;
                values['total_no'] = total_no;
                values['price_per_carat'] = price;

                gemstone.push(values);

            });
        }
        if (!has_gemstone)
        {
            gemstone = [];
        }

        var general = {};
        general['vendorid'] = vid;
        general['product_name'] = product_name;
        general['vPCode'] = vPCode;
        general['product_seo_name'] = product_seo_name;
        general['productDescription'] = productDescription;
        general['leadTime'] = leadTime;
        general['eligible'] = eligible;
        general['gender'] = gender;
        general['product_weight'] = product_weight;
        general['certificate'] = certificate;
        general['jewelleryType'] = jewelleryType;
        general['metal_weight'] = metal_weight;
        general['making_charges'] = making_charges;
        general['procurement_cost'] = procurement_cost;
        general['margin'] = margin;
        general['measurement'] = measurement;
        general['dmdSetting'] = dmdSetting.toString();

        var prd = {};
        prd['mpurity'] = mpurity;
        prd['metalcolor'] = mcolor;
        prd['sizes'] = sizesArray;


        if (has_solitaire)
        {
            has_solitaire = 1;
            prd['solitaires'] = solitaires;
        }
        if (!has_solitaire)
        {
            has_solitaire = 0;
        }
        prd['has_solitaire'] = has_solitaire;


        if (has_diamond)
        {
            has_diamond = 1;
            prd['diamonds'] = diamonds;
        }
        if (!has_diamond)
        {
            has_diamond = 0;
        }
        prd['has_diamond'] = has_diamond;


        if (has_uncut)
        {
            has_uncut = 1;
            prd['uncut'] = uncut;
        }
        if (!has_uncut)
        {
            has_uncut = 0;
        }
        prd['has_uncut'] = has_uncut;

        if (has_gemstone)
        {
            has_gemstone = 1;
            prd['gemstone'] = gemstone;
        }
        if (!has_gemstone)
        {
            has_gemstone = 0;
        }
        prd['has_gemstone'] = has_gemstone;

        prd['details'] = general;
        if(prdid!=="")
        {
            prd['productid'] = prdid;
        }

        prd['userid'] = userid;
        prd['catid'] = catArray.toString();

        previewData=prd;


        showpreview(previewData);


/*
        var URL = APIDOMAIN + "index.php?action=addProduct";
        $.ajax({
            url: URL,
            type: 'POST',
            data: {dt: dt},
            success: function(res) {
                res = JSON.parse(res);
                addPrdCallBack(res);
            }
        });

*/

    }
}


function hidePreview()
{
    $('#previewDiv').addClass('dn');
    $('#prdForm').removeClass('dn');

}




function submitData()
{
    showLoader();
    previewData['filterAttrs']=setPrdMapping();
    
    var dt = JSON.stringify(previewData);
 
    var URL = APIDOMAIN + "index.php?action=addProduct";
 
    $.ajax({
        url: URL,
        type: 'POST',
        data: {dt: dt},
        success: function(res) {
           
            res = JSON.parse(res);
          //  addPrdCallBack(res);
             if (res['error']['err_code'] == '0')
    {
        common.toast(1, 'Product added successfully');
           
            window.location.href=DOMAIN+"backend/index.php?action=products";
           hideLoader();
        //redirect
    }
    else
    {
        common.toast(0, 'Error in adding product');
        hideLoader();
    }
            hideLoader();
        }
    });

}

function setPrdMapping()
{

    values = {};
    $('ul.superparent').each(function(i){
        var liobj=$(this).find('li ul');
        $(liobj).each(function(){
            var valarray=new Array();
            $(this).find('[name=attrVals]').each(function(){
                var dfor=$(this).attr('data-for');
                if ($(this).is(':CHECKED'))
                {
                    var val=$(this).val();
                    valarray.push(val);
                }
                if(valarray.length>0)
                    values['"'+dfor+'"']=encodeURIComponent(valarray.toString());

            });

        });

    });

    return values;

}




/*function addPrdCallBack(data)
{

    if (data['error']['err_code'] == '0')
    {
        common.toast(1, 'Product added successfully');
           
            window.location.href=DOMAIN+"backend/index.php?action=products";
             hideLoader();
        //redirect
    }
    else
    {
        common.toast(0, 'Error in adding product');
        hideLoader();
    }

}*/


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

var lsc=0;

function moveDown()
{
    if(lsc==0)
        lsc=$('.btnCont').position().top;
    $('body,html').animate({scrollTop:10000},300,"swing");
}

function moveUp()
{
    $('body,html').animate({scrollTop:0},300,"swing");
}


function validateForm()
{

    var isValid=true;
    if ($('[name=prtcateg]:checked').length === 0)
    {
        common.toast(0, "Select a category");
        var id=$('[name=prtcateg]').eq(0).attr('id');
        highlight(id,1);
        isValid=false;
        return false;
    }



    if ($('#vendorList').val() == -1)
    {
        common.toast(0, "Select vendor");
        highlight('vendorList',0);
        isValid=false;
            return false;
    }

    if ($('#vendorPrdCode').val() == "")
    {
        common.toast(0, "Enter Vendor Product Code");
        highlight('vendorPrdCode',0);
        isValid=false;
            return false;
    }

    if(vendorPrdCode($('#vendorPrdCode').val(),$('#prdCode').val()) == false)
    {
        common.toast(0, "Vendor product code is already used");
        highlight('vendorPrdCode',0);
        isValid=false;
          return false;
    }


    if ($('#product_name').val() == "")
    {
        common.toast(0, "Enter Product Name");
        highlight('product_name',0);
        isValid=false;
            return false;
    }

    if ($('#product_seo_name').val() == "")
    {
        common.toast(0, "Enter Product SEO Name");
        highlight('product_seo_name',0);
        isValid=false;
            return false;
    }

    if ($('#productDescription').val() == "")
    {
        common.toast(0, "Enter Product Description");
        highlight('productDescription',0);
        isValid=false;
            return false;
    }

    if ($('#product_weight').val() == "")
    {
        common.toast(0, "Enter Product Weight");
        highlight('product_weight',0);
        isValid=false;
            return false;
    }

    if ($('#leadTime').val() == "")
    {
        common.toast(0, "Enter Delivery Lead Time");
        highlight('leadTime',0);
        isValid=false;
            return false;
    }

    if (!checkForZero('product_weight'))
    {
        common.toast(0, "Product Weight can not be 0");
        highlight('product_weight',0);
        isValid=false;
            return false;
    }

    if (has_solitaire)
    {
        var isValid=validateSolAdd();
        if(!isValid)
            return isValid;
    }


    if (has_diamond)
    {
        var isValid=validateDiamondAdd();
        if(!isValid)
            return isValid;

    }

    if (has_uncut)
    {
        var isValid=validateUncutAdd();
        if(!isValid)
            return isValid;
    }


    if (has_gemstone)
    {
        var isValid =validateGemstoneAdd();
        if(!isValid)
            return isValid;
    }

////    if ($('[name=diamond_setting]:checked').length === 0)
////    {
////        common.toast(0, "Select diamond settings type");
////        $('[name=diamond_setting]').focus();
////        var id=$('[name=diamond_setting]').eq(0).attr('id');
////        highlight(id,1);
////
////        isValid=false;
////            return false;
////    }
//
//    if ($('#ds8').is(':checked'))
//    {
//        if ($('#diamond_settingOth').val() == "")
//        {
//            common.toast(0, "Enter value for other diamond settings type");
//            highlight('diamond_settingOth',0);
//        }
//        isValid=false;
//            return false;
//    }

    if($('#jType2').attr('checked') == false)
    {
        if ($('[name=certificate]:checked').length === 0)
        {
            common.toast(0, "Select product certificate type");
            var id=$('[name=certificate]').eq(0).attr('id');
            highlight(id,1);

            isValid=false;
                return false;
        }
    }

    if ($('#metal_weight').val() == "")
    {
        common.toast(0, "Enter Metal Weight");
        highlight('metal_weight',0);
       isValid=false;
            return false;
    }

    if (!checkForZero('metal_weight'))
    {
        common.toast(0, "Metal Weight can not be 0");
        highlight('metal_weight',0);
        isValid=false;
            return false;
    }


    if ($('#making_charges').val() == "")
    {
        common.toast(0, "Enter Making Charge");
        highlight('making_charges',0);
        isValid=false;
            return false;
    }
    if (!checkForZero('making_charges'))
    {
        common.toast(0, "Making Charges can not be 0");
        highlight('making_charges',0);
        isValid=false;
            return false;
    }



    if ($('#procurement_cost').val() == "")
    {
        common.toast(0, "Enter Procurement Cost");
        highlight('procurement_cost',0);
        isValid=false;
            return false;
    }


    if (!checkForZero('procurement_cost'))
    {
        common.toast(0, "Procurement cost can not be 0");
        highlight('procurement_cost',0);
        isValid=false;
            return false;
    }

    /*if ($('#margin').val() == "")
    {
        common.toast(0, "Enter Margin");
        highlight('margin',0);
        isValid=false;
            return false;
    }*/

    if ($('#measure1').val() == "")
    {
        common.toast(0, "Enter Height");
        highlight('measure1',0);
        isValid=false;
            return false;
    }

    if (!checkForZero('measure1'))
    {
        common.toast(0, "Height can not be 0");
        highlight('measure1',0);
        isValid=false;
            return false;
    }

    if ($('#measure2').val() == "")
    {
        common.toast(0, "Enter Width");
        highlight('measure2',0);
        isValid=false;
            return false;
    }

    if (!checkForZero('measure2'))
    {
        common.toast(0, "Width can not be 0");
        highlight('measure2',0);
        isValid=false;
            return false;
    }

    if(isPlatinumJewellery == false)
    {

        if ($('[name=isPurityCustz]:checked').length === 0)
        {
            common.toast(0, "Select Metal Purity Type");
            var id=$('[name=isPurityCustz]').eq(0).attr('id');
            highlight(id,1);
            isValid=false;
                return false;
        }

        if ($('[name=isPurityCustz]:checked').val() == 0)
        {

            if ($('[name=gpurityCustomize]:checked').length == 0)
            {
                common.toast(0, "Select Customizable Metal Purity Type");
                var id=$('[name=gpurityCustomize]').eq(0).attr('id');
                highlight(id,1);
                isValid=false;
                return false;
            }
        }

        if ($('[name=isPurityCustz]:checked').val() == 1)
        {

            if ($('[name=gpurityNotCustomize]:checked').length == 0)
            {
                common.toast(0, "Select Not Customizable Metal Purity Type");
                var id=$('[name=gpurityNotCustomize]').eq(0).attr('id');
                highlight(id,1);
               isValid=false;
                return false;
            }

        }

        if ($('[name=isColorCustz]:checked').length === 0)
        {
            common.toast(0, "Select Metal Color Type");
            var id=$('[name=isColorCustz]').eq(0).attr('id');
            highlight(id,1);
            isValid=false;
                return false;
        }

        if ($('[name=isColorCustz]:checked').val() == 0)
        {

            if ($('[name=gcolorCustomize]:checked').length == 0)
            {
                common.toast(0, "Select Customizable Metal Color");
                var id=$('[name=gcolorCustomize]').eq(0).attr('id');
                highlight(id,1);
                isValid=false;
                return false;
            }
        }

        if ($('[name=isColorCustz]:checked').val() == 1)
        {

            if ($('[name=gcolorNotCustomize]:checked').length == 0)
            {
                common.toast(0, "Select Not Customizable Metal Color");
                var id=$('[name=gcolorNotCustomize]').eq(0).attr('id');
                highlight(id,1);
                isValid=false;
                return false;
            }

        }
    }

    if($('[name=size]').length>0)
    {
        if ($('[name=size]:checked').length == 0)
        {
            common.toast(0, "Select Product Size");
            $('[name=size]').focus();
            var id=$('[name=size]').eq(0).attr('id');
            highlight(id,1);
            isValid=false;
            return false;
        }
    }

    /*if ($('[name=size]:checked').length > 0)
    {

        var sizeLen = $('[name=size]:checked').length;
        var sizeValCnt = 0;
        $('[name=sizeQty]').each(function() {

            if ($(this).val() !== "")
            {
                sizeValCnt++;
            }

        });

        if (sizeLen != sizeValCnt)
        {
            common.toast(0, "Selected Size & Quantity Count Dosen't Match");
            $('[name=size]:checked').each(function(){

                var txid=$(this).attr('id')+"_qty";
                var val=$('#'+txid).val();
                if(val=="")
                {
                    highlight(txid,0);
                    isValid = false;
                    return false;

                }


            });
            isValid=false;
            return false;
        }

    }  */
    return isValid;
}

function checkForZero(id)
{
    var val=$('#'+id).val();
    if(parseFloat(val)*1==0)
        return false;
    else
        return true;
}





function GetRates() {
    var URL = APIDOMAIN + "index.php?action=getAllRates";

    $.ajax({
        url: URL,
        type: 'POST',
        success: function(res) {
            res = JSON.parse(res);
            allrates = res['result'];
        }
    });
}



function genPriceSection()
{
    if(edit==0)
    {
        validateForm();
    }
    $('.priceOverlay').addClass('dn');
    var str = "";
    if (has_solitaire)
    {
        str += solitairePrice();
    }

    if (has_diamond)
    {
        str += diamondPrice();
    }

    if (has_uncut)
    {
        str += uncutPrice();
    }

    if (has_gemstone)
    {
        str += gemstonePrice();
    }
    if (isPlatinumJewellery == false)
    {
        var gldstr = goldPrice();
    }
    else
    {
        var pltstr = pltPrice();
    }




    var mkch = $('#making_charges').val(); 
    var totalwt = $('#metal_weight').val();
    var tot = parseFloat(mkch) * parseFloat(totalwt);
    var total = tot.toFixed();

    var mstr = "<li id='makingCharge'>";
    mstr += "<div class='forComponent fLeft pl15'>Making Charge</div>";
    mstr += "<div class='forRate fLeft'>" + mkch + "/grm</div>";
    mstr += "<div class='forWeight fLeft'></div>";
    mstr += "<div class='forPrice calc fLeft'>&#8377;" + total + "</div>";
    mstr += "</li>";


    $('.pricingul').html('');
    if (isPlatinumJewellery == false)
    {
        $('.pricingul').html(str + gldstr + mstr);
    }
    else
    {
        $('.pricingul').html(str + pltstr + mstr);
    }

    calcGrandTotal(1);

}

function solitairePrice()
{
    var solstr = "<li class='headLi' id='forSolitaire'><div class='forComponent fLeft'>Solitaire(s)</div></li>";
    $('[id*=solitaireComm_]').each(function() {
        var id = $(this).attr('id');
        var ids = id.split("solitaireComm_");
        ids = ids[1];

        var shape = $('#solitaireComm_' + ids + ' .shapeSelected').attr('id').split("shape_");
        var carat = $('#solcaratweight' + ids + '').val();
        var nofSolitaire = $('#solNofs' + ids + '').val();
        var totalCarats = parseFloat(carat) * parseFloat(nofSolitaire);
        var price_per_carat = $('#solpricecarat' + ids + '').val();
        var prc = parseFloat(price_per_carat) * parseFloat(totalCarats);
       var  price = prc.toFixed();
        solstr += "<li id='solitairePrice_" + ids + "'>";
        solstr += "<div class='forComponent fLeft pl15'>" + shape[1] + "</div>";
        solstr += "<div class='forRate fLeft'>&#8377; " + price_per_carat + "/ct</div>";
        solstr += "<div class='forWeight fLeft'>" + totalCarats + " ct</div>";
        solstr += "<div class='forPrice calc fLeft'>&#8377;" + price + "</div>";
        solstr += "</li>";
    });
    return solstr;
}

function diamondPrice()
{

    var str = "<li class='headLi' id='forDiamond'><div class='forComponent fLeft'>Diamond(s)</div></li>";
    $('[id*=diamondComm_]').each(function() {
        var id = $(this).attr('id');
        var ids = id.split("diamondComm_");
        ids = ids[1];

        var shape = $('#diamondComm_' + ids + ' .shapeSelected').attr('id').split("shape_");
        var carat = $('#dmdcaratweight' + ids + '').val();
        var customiz = $('[name*=isDiamondCustz_' + ids + ']:checked').val();
        var prc;
        var price;
        if (customiz == 1)
        {
            var typstr = "<select id='diamondPs" + ids + "'  onchange=\"setDmdPrice(this);\">";
            var flag = true;
            $('[name=dmdquality_cust' + ids + ']').each(function(i) {

                if ($(this).is(':CHECKED'))
                {
                    if (flag)
                    {
                        flag = false;
                        prc = $(this).parent().siblings().text();
                        price = parseFloat(prc.slice(1)) * parseFloat(carat);
                    }
                    var opt = $(this).next('label').text() + "&nbsp;" + shape[1];
                    var val = $(this).parent().siblings().text();
                    typstr += "<option value='" + val.slice(1) + "'>" + opt + "</option>";
                }


            });
            typstr += "</select>";
        }
        else if (customiz == 0)
        {
            typstr = $('[name*=dmdquality_notCust' + ids + ']:checked').next('label').text() + " - " + shape[1];
            prc = $('[name*=dmdquality_notCust' + ids + ']:checked').parent().siblings().text();
            price = parseFloat(prc.slice(1)) * parseFloat(carat);

        }
     
        str += "<li id='diamondPrice_" + ids + "'>";
        str += "<div class='forComponent fLeft pl15'>" + typstr + "</div>";
        str += "<div class='forRate fLeft' id='diamondRate_" + ids + "'  data-weight='" + carat + "'>" + prc + "/ct</div>";
        str += "<div class='forWeight fLeft'>" + carat + " ct</div>";
        str += "<div class='forPrice calc fLeft' id='diamondTotal_" + ids + "'>&#8377;" + price + "</div>";
        str += "</li>";
 
    });
    return str;
}

function uncutPrice()
{
    var str = "<li class='headLi' id='forUncut'><div class='forComponent fLeft'>Uncut Diamond(s)</div></li>";
    $('[id*=uncutComm_]').each(function() {
        var id = $(this).attr('id');
        var ids = id.split("uncutComm_");
        ids = ids[1];

        var carat = $('#uncutcaratweight' + ids + '').val();
        var price = $('#uncutpricecarat' + ids + '').val();
        var total = parseFloat(price) * parseFloat(carat);
        var quality = $('[name=uncutquality_' + ids + ']:checked').val();

        str += "<li id='uncutdiamondPrice_" + ids + "'>";
        str += "<div class='forComponent fLeft pl15'>" + quality + " - Uncut Diamond</div>";
        str += "<div class='forRate fLeft'>" + price + "/ct</div>";
        str += "<div class='forWeight fLeft'>" + carat + " ct</div>";
        str += "<div class='forPrice calc fLeft'>&#8377;" + total + "</div>";
        str += "</li>";

    });
    return str;

}


function gemstonePrice()
{

    var str = "<li class='headLi' id='forGemstone'><div class='forComponent fLeft'>Gemstone(s)</div></li>";
    $('[id*=gemstoneComm_]').each(function() {
        var id = $(this).attr('id');
        var ids = id.split("gemstoneComm_");
        ids = ids[1];


        var gvalue = $('#gemstone_type' + ids + ' option:selected').text();


        var carat = $('#gemstonecaratweight' + ids + '').val();
        var price = $('#gemstonepricecarat' + ids + '').val();
        var total = parseFloat(price) * parseFloat(carat);


        str += "<li id='gemstonePrice_" + ids + "'>";
        str += "<div class='forComponent fLeft pl15'>" + gvalue + "</div>";
        str += "<div class='forRate fLeft'>" + price + "/ct</div>";
        str += "<div class='forWeight fLeft'>" + carat + " ct</div>";
        str += "<div class='forPrice calc fLeft'>&#8377;" + total + "</div>";
        str += "</li>";


    });
    return str;
}

function goldPrice()
{

    var str = "<li class='headLi' id='forGold'><div class='forComponent fLeft'>Gold</div></li>";
    var val = $("[name='isPurityCustz']:checked").val();
    var carat = $('#metal_weight').val();
    var crPrice;

    var total;
    if (val == 0)
    {
        //mult

        var sstr = "<select>";
        var sstr = "<select id='goldPrice1'  onchange=\"setGoldPrice();\">";
        var flag = true;
        $('[name=gpurityCustomize]').each(function(i) {
            if ($(this).is(':CHECKED')) {
                var txt = "Gold -" + $(this).next('label').text();
                var val = $(this).parent().siblings().text();
                sstr += "<option value='" + val.slice(1) + "'>" + txt + "</option>";

                if (flag)
                {
                    flag = false;
                    crPrice = $(this).parent().siblings().text();
                    total = parseFloat(crPrice.slice(1)) * parseFloat(carat);

                }

            }
        });

        sstr += "</select>";

    }
    else
    {
        var gold = $('[name=gpurityNotCustomize]:checked').next('label').text();
        sstr = "<div>" + gold + "</div>";
        crPrice = $('[name=gpurityNotCustomize]:checked').parent().siblings().text();
        total = parseFloat(crPrice.slice(1)) * parseFloat(carat);
        
    }
    var goldTot = total.toFixed();

    str += "<li id='goldPrice'>";
    str += "<div class='forComponent fLeft pl15'>" + sstr + "</div>";
    str += "<div class='forRate fLeft' id='goldRate1'>" + crPrice + "/ct</div>";
    str += "<div class='forWeight fLeft' id='goldWeight1' data-weight='" + carat + "'>" + carat + " grm(s)</div>";
    str += "<div class='forPrice calc fLeft' id='totalgoldRate1'>&#8377;" + goldTot + "</div>";
    str += "</li>";

    return str;

}

function pltPrice()
{

    var str = "<li class='headLi' id='forGold'><div class='forComponent fLeft'>Platinum</div></li>";
    var metal_weight = parseFloat($('#metal_weight').val());
    var crPrice;
    var total;
    var URL = APIDOMAIN + "index.php?action=getGoldRates&case=2";
    $.ajax
    ({
        url: URL,
        type: "POST",
        async:false,
        success: function(res)
        {
            res = JSON.parse(res);
            var obj = res.result;

            $(obj).each(function(i,val)
            {

                if(val.name.indexOf('Platinum') !== -1)
                {
                    str += "<li id='pltPrice'>";
                    str += "<div class='forComponent fLeft pl15'>" + val.name + " Charge</div>";
                    str += "<div class='forRate fLeft'>&#8377; "+ val.price +"/grm</div>";
                    str += "<div class='forWeight fLeft'>" + metal_weight + " grm</div>";
                    str += "<div class='forPrice calc fLeft' id='totalpltRate1'>&#8377; " + parseFloat(parseFloat(val.price)*metal_weight) + "</div>";
                    str += "</li>";
                }

            });
        }
    });
    return str;
}


function setDmdPrice(obj)
{  
    var id = $(obj).attr('id');
    id = id.split('diamondPs');

    var val = parseFloat($(obj).val());
    var total = val * parseFloat($('#diamondRate_' + id[1]).attr('data-weight'));
   
    var rt = "&#8377; " + val + "/ct";
    $('#diamondRate_' + id[1]).html(rt);
    $('#diamondTotal_' + id[1]).html("&#8377;" + total);

    calcGrandTotal(2);

}


function setGoldPrice()
{

    var val = parseFloat($('#goldPrice1').val());
    var total = val * parseFloat($('#goldWeight1').attr('data-weight'));
        total =total.toFixed();
    var rt = "&#8377; " + val + "/ct";
    $('#goldRate1').html(rt);
    $('#totalgoldRate1').html("&#8377;" + total);

    setTimeout(function() {
        calcGrandTotal(2);
    }, 50);

}


function calcGrandTotal(type)
{  
    var total = 0;
    var vat =0;
    $('li .calc').each(function() {
        var val = $(this).text();
        val = parseFloat(val.slice(1));
        total += val;

    });

    vat = (1.20 / 100) * total;
    var vat1 = vat;
    if(!isNaN(vat)){
        var vat1 =  vat.toFixed();
    }

    var gtotal = total + vat;
    var gtotal1 = gtotal;
    if(!isNaN(gtotal)){
        var gtotal1 =  gtotal.toFixed();
    }

    if (type == 1)
    {
        var vstr = "<li id='vatCharges'>";
        vstr += "<div class='forComponent fLeft pl15'>VAT (1.20%)</div>";
        vstr += "<div class='forRate fLeft'></div>";
        vstr += "<div class='forWeight fLeft'></div>";
        vstr += "<div class='forPrice fLeft' id='tvat'>&#8377;" + vat1 + "</div>";
        vstr += "</li>";

        vstr += "<li class='gTotal'>";
        vstr += "<div class='forComponent fLeft'>Grand Total</div>";
        vstr += "<div class='forRate fLeft'></div>";
        vstr += "<div class='forWeight fLeft'></div>";
        vstr += "<div class='forPrice fLeft' id='grandTotal'>&#8377; " + gtotal1 + "</div>";
        vstr += "</li>";
        $('.pricingul').append(vstr);
    }
    else
    {
        $('#tvat').html("&#8377;" + vat1);
        $('#grandTotal').html("&#8377;" + gtotal1);

    }
}

function oneditmode()
{
    showLoader();
    var URL=APIDOMAIN+"?action=getProductById&pid="+pid;
   
    $.ajax({
        url:URL,
        type:'POST',
        success:function(res){
            res=JSON.parse(res);
            oneditmodeCallBack(res);
        }
    });
}
var attrVals=new Array();

function oneditmodeCallBack(data)
{
    if (data['error']['err_code'] == '0')
    {
        var dt=data['results'];
        var basic=dt['basicDetails'];
        var catAttr = dt['catAttr'];
        attrVals = dt['attrVals'];
        prdid =basic.prdId;

        $('#vendorList option').each(function(){
            var id=$(this).val();
            if(basic.vndId==id){
                $(this).attr('selected',true);
            }
        });
        $('#prdCode').val(basic.prdId);
        $('#product_name').val(basic.prdNm);
        $('#productDescription').val(basic.productDescription);
        maxlengthcheck();
        $('#vendorPrdCode').val(basic.vPCode);
        $('#product_seo_name').val(basic.prdSeo);
        $('#leadTime').val(basic.leadTime);
        $('input[name="eligible"]').each(function()
        {
            if($(this).val() == basic.returneligible)
            {
                $(this).prop('checked',true);
            }
        });
        $('#product_weight').val(basic.prdWgt);
        var dmdsetting=basic.dmdStng.split(",");
        $(dmdsetting).each(function(i){
            $('[name=diamond_setting]').each(function(){
                var val =$(this).val();
                var oth=dmdsetting[i].split("_");
                if(oth[0]=='other')
                {
                    $('#ds8').attr('checked',true);
                    $('#diamond_settingOth').val(oth[1]);
                    $('#otherdsType').removeClass('op0');
                }
                if(dmdsetting[i]==val)
                {
                    $(this).attr('checked',true);
                }
            });
        });
        $('[name=gender]').each(function()
        {
            var val =$(this).val();
            if(basic.gender==val)
            {
                $(this).attr('checked',true);
            }
        });
        $('[name=jType]').each(function()
        {
            var val =$(this).val();
            if(basic.jewelleryType == val)
            {
                $(this).attr('checked',true);
            }
        });
        changeJTypeFields();

        $('[name=certificate]').each(function()
        {
            var val =$(this).val();
            if(basic.crtficte==val)
            {
                $(this).attr('checked',true);
            }
        });

        $('#metal_weight').val(basic.mtlWgt);
        $('#making_charges').val(basic.mkngCrg);
        $('#procurement_cost').val(basic.procmtCst);
        $('#margin').val(basic.mrgn);

       var measure=basic.mesmnt.split("X");

       $('#measure1').val(measure[0]);
       $('#measure2').val(measure[1]);

        $('[name=isPurityCustz]').each(function(){
            var val =$(this).val();
            if(basic.custPurty==val){
                $(this).click();
            }
        });

        var murity=dt['metalPurity'];
    
        if(basic.custPurty==1)
        { 
          var mprid=murity['results'][0].id;
         
            $('[name=gpurityNotCustomize]').each(function(){
                var val =$(this).val();
                if(mprid==val){
                   
                    $(this).prop('checked',true);
                }
            });
        }

        if(basic.custPurty==0)
        {
            $(murity['results']).each(function(i){
               
                var mprid=murity['results'][i].id;
               
                $('[name=gpurityCustomize]').each(function(){
                    var val =$(this).val();
                    
                    if(mprid==val){
                        
                        $(this).prop('checked',true);
                        
                    }
                });
            });
        }

        $('[name=isColorCustz]').each(function(){
            var val =$(this).val();
            if(basic.custClor==val){
                $(this).click();
            }
        });


       var murity=dt['metalColor'];

        if(basic.custClor==1)
        {
            var mprid=murity['results'][0].id;
            $('[name=gcolorNotCustomize]').each(function(){
                var val =$(this).val();
                if(mprid==val){
                    $(this).prop('checked',true);
                }
            });
        }

        if(basic.custClor==0)
        {
            $(murity['results']).each(function(i){
                var mprid=murity['results'][i].id;
                $('[name=gcolorCustomize]').each(function(){
                    var val =$(this).val();
                    if(mprid==val){
                        $(this).prop('checked',true);
                    }
                });
            });
        }
        if(basic.hasSol==1)
        {
            has_solitaire=true;
            $('#stone1').attr('checked',true);
            var solts=dt['solitaire']['results'];

            $(solts).each(function(i){
                var ids=i+1;
                var solt=solts[i];
                addSolitaire();


                $('#solitaireComm_'+ids).find('.shapeComm.'+solt.shape).click();
                $('#solitaireComm_'+ids).attr('db-id',solt.soliId);

                $('[name=solitaireColors_'+ids+']').each(function(){
                    var val =$(this).val();
                    if(solt.colr==val)
                        $(this).attr('checked',true);
                });

                $('[name=solitaireclarity_'+ids+']').each(function(){
                    var val =$(this).val();
                    if(solt.clrty==val)
                        $(this).attr('checked',true);
                });


                $('[name=solitairecut_'+ids+']').each(function(){
                    var val =$(this).val();
                    if(solt.cut==val)
                        $(this).attr('checked',true);
                });

                $('[name=solitairesymmetry_'+ids+']').each(function(){
                    var val =$(this).val();
                    if(solt.symty==val)
                        $(this).attr('checked',true);
                });

                $('[name=solitairepolish_'+ids+']').each(function(){
                    var val =$(this).val();
                    if(solt.polish==val)
                        $(this).attr('checked',true);
                });

                $('[name=solitaireFluorescence_'+ids+']').each(function(){
                    var val =$(this).val();
                    if(solt.flresce==val)
                        $(this).attr('checked',true);
                });

                $('#solcaratweight'+ids).val(solt.carat);
                $('#solpricecarat'+ids).val(solt.prcPrCrat);
                $('#soltable'+ids).val(solt.tblNo);
                $('#solGirdle'+ids).val(solt.girdle);
                $('#solNofs'+ids).val(solt.nofs);
                $('#solCrownAngle'+ids).val(solt.crwnAngle);

            });
            $('#solitaires_Section').removeClass('dn');

        }

        if(basic.hasDmd==1)
        {
            has_diamond=true;
            $('#stone2').attr('checked',true);
            var dmd=dt['dimond']['results'];
            $(dmd).each(function(i){
                
                var ids=i+1;
                var dm=dmd[i];
                addDiamond();
                $('#diamondComm_'+ids).find('.shapeComm.'+dm.shape).click();
                $('#diamondComm_'+ids).attr('db-id',dm.dmdId);
                var cnt=   dm.QMast.count;
                var dqlty=dm.QMast.results;
                var isDCustz=0;
                var dqname='dmdquality_notCust';
                if(cnt>1){
                    isDCustz=1;
                    dqname='dmdquality_cust';
                }
                $('[name=isDiamondCustz_'+ids+']').each(function(){
                    var val =$(this).val();
                    if(val==isDCustz)
                        $(this).click();
                });

                $(dqlty).each(function(i){
                    $('[name='+dqname+ids+']').each(function(){
                        var val =$(this).val();
                        if(dqlty[i].id==val)
                            $(this).prop('checked',true);
                    });
                });

                $('#dmdcaratweight'+ids).val(dm.crat);
                $('#dmdPieces'+ids).val(dm.totNo);
            });
            $('#diamond_Section').removeClass('dn');

        }

        if(basic.hasUnct==1)
        {
            has_uncut=true;
            $('#stone3').attr('checked',true);
            var unct=dt['uncut']['results'];

            $(unct).each(function(i){
                var ids=i+1;
                var un=unct[i];
                addUncut();
                var colors=un.clor.split(",");


                $(colors).each(function(i){
                    $('[name=uncutColors_'+ids+']').each(function(){
                        var val =$(this).val();
                        if(colors[i]==val)
                            $(this).attr('checked',true);
                    });
                });


                $('[name=uncutquality_'+ids+']').each(function(){
                    var val =$(this).val();
                    if(un.qulty==val)
                        $(this).attr('checked',true);
                });

                $('#uncutComm_'+ids).attr('db-id',un.unctId);
                $('#uncutcaratweight'+ids).val(un.crat);
                $('#uncutpricecarat'+ids).val(un.prcPrCrat);
                $('#uncutPieces'+ids).val(un.totNo);


            });
            $('#uncut_Section').removeClass('dn');

        }


        if(basic.hasGem==1)
        {
            has_gemstone=true;
            $('#stone4').attr('checked',true);
            var gemst=dt['gamestone']['results'];

            $(gemst).each(function(i){
                var ids=i+1;
                var gem=gemst[i];
                addGemstone();

                $('#gemstone_type'+ids+' option').each(function(){
                    var val =$(this).val();
                    if(gem.gemId==val)
                        $(this).attr('selected',true);

                });

                $('#gemstoneComm_'+ids).attr('db-id',gem.gemId);
                $('#gemstonecaratweight'+ids).val(gem.crat);
                $('#gemstonepricecarat'+ids).val(gem.prcPrCrat);
                $('#gemstonePieces'+ids).val(gem.totNo);

            });
            $('#gemstone_Section').removeClass('dn');

        }

        genPriceSection();

        if(catAttr.count > 0)
        {
            displayChecked(catAttr);
//            $.each(catAttr.results, function(i,vl) {
//                setTimeout( function() {
//                    $('#cat_'+vl.cid).click();
//                    setTimeout( function() {
//                            var sizes =dt['size']['results'];
//                            $(sizes).each(function(i){
//                                var sid=sizes[i].sizId;
//                                var qty=sizes[i].qnty;
//                                $('[name=size]').each(function(){
//                                    var val =$(this).val();
//                                    if(sid==val){
//                                        $(this).attr('checked',true);
//                                        $('#size_'+sid+'_qty').val(qty);
//                                    }
//                                });
//                            });
//                        },350);
//                },150);
//            });
        }

    }
    hideLoader();

}

function deleteSolitaire(obj)
{
    var sid=$(obj).parent().attr('db-id');

    if(sid!=="")
    {
        var URL= APIDOMAIN+"?action=changeSolitaireStatus";

        values= {};
        values['solitaire_id'] = sid;
        values['productid'] = prdid;
        values['updatedby'] = userid;
        values['active_flag'] = 2;


        var dt = JSON.stringify(values);

        $.ajax({
            url:URL,
            type:'POST',
            data:{dt:dt},
            success:function(res){
                res=JSON.parse(res);
            }
        });

    }

}

function deleteDiamond(obj)
{
    var did=$(obj).parent().attr('db-id');

    if(did!=="")
    {
        var URL= APIDOMAIN+"?action=changeDiamondStatus";

        values= {};
        values['diamond_id'] = did;
        values['productid'] = prdid;
        values['updatedby'] = userid;
        values['active_flag'] = 2;


        var dt = JSON.stringify(values);

        $.ajax({
            url:URL,
            type:'POST',
            data:{dt:dt},
            success:function(res){
                res=JSON.parse(res);
            }
        });

    }

}

function deleteUncut(obj)
{
    var uid=$(obj).parent().attr('db-id');

    if(uid!=="")
    {
        var URL= APIDOMAIN+"?action=changeUncutStatus";

        values= {};
        values['uncut_id'] = uid;
        values['productid'] = prdid;
        values['updatedby'] = userid;
        values['active_flag'] = 2;


        var dt = JSON.stringify(values);

        $.ajax({
            url:URL,
            type:'POST',
            data:{dt:dt},
            success:function(res){
                res=JSON.parse(res);
            }
        });

    }

}

function deleteGemstone(obj)
{
    var gid=$(obj).parent().parent().attr('db-id');
    if(gid!=="")
    {
        var URL= APIDOMAIN+"?action=changeGemstoneStatus";

        values= {};
        values['gemstone_id'] = gid;
        values['productid'] = prdid;
        values['updatedby'] = userid;
        values['active_flag'] = 2;


        var dt = JSON.stringify(values);

        $.ajax({
            url:URL,
            type:'POST',
            data:{dt:dt},
            success:function(res){
                res=JSON.parse(res);
            }
        });

    }

}

function validateSolAdd()
{
    var isValid=true;
    $('[id*=solitaireComm_]').each(function() {

            var id = $(this).attr('id');
            var ids = id.split("solitaireComm_");
            ids = ids[1];

            if ($('#solitaireComm_' + ids + ' .shapeSelected').length == 0)
            {
                common.toast(0, "Select Shape For Solitaire ");
                highlight('solitaireComm_' + ids,2);
                isValid=false;
                return false;
            }

            if ($('[name=solitaireColors_' + ids + ']:checked').length == 0)
            {
                common.toast(0, "Select Color For Solitaire ");
                $('[name=solitaireColors_' + ids + ']').focus();
                var id=$('[name=solitaireColors_' + ids + ']').eq(0).attr('id');
                highlight(id,1);
                isValid=false;
                return false;
            }

            if ($('[name=solitaireclarity_' + ids + ']:checked').length == 0)
            {
                common.toast(0, "Select Clarity For Solitaire ");
                var id=$('[name=solitaireclarity_' + ids + ']').eq(0).attr('id');
                highlight(id,1);
                isValid=false;
                return false;

            }

            // if ($('[name=solitairecut_' + ids + ']:checked').length == 0)
            // {
            //     common.toast(0, "Select Cut For Solitaire " + ids);
            //     var id=$('[name=solitairecut_' + ids + ']').eq(0).attr('id');
            //     highlight(id,1);
            //     isValid=false;
            //     return false;
            //
            // }
            //
            // if ($('[name=solitairesymmetry_' + ids + ']:checked').length == 0)
            // {
            //     common.toast(0, "Select Symmetry For Solitaire " + ids);
            //     var id=$('[name=solitairesymmetry_' + ids + ']').eq(0).attr('id');
            //     highlight(id,1);
            //     isValid=false;
            //     return false;
            //
            // }
            //
            // if ($('[name=solitairepolish_' + ids + ']:checked').length == 0)
            // {
            //     common.toast(0, "Select Polish For Solitaire " + ids);
            //     var id=$('[name=solitairepolish_' + ids + ']').eq(0).attr('id');
            //     highlight(id,1);
            //     isValid=false;
            //     return false;
            //
            // }
            //
            // if ($('[name=solitaireFluorescence_' + ids + ']:checked').length == 0)
            // {
            //     common.toast(0, "Select Fluorescence For Solitaire " + ids);
            //     var id=$('[name=solitaireFluorescence_' + ids + ']').eq(0).attr('id');
            //     highlight(id,1);
            //     isValid=false;
            //     return false;
            //
            // }
            if ($('#solcaratweight' + ids + '').val() == "")
            {
                common.toast(0, "Enter Carat Weight For Solitaire ");
                highlight('solcaratweight' + ids,0);
                isValid=false;
                return false;
            }

            if (!checkForZero('solcaratweight' + ids))
            {
                common.toast(0, "Carat weight can not be 0");
                highlight('solcaratweight' + ids,0);
                isValid=false;
                return false;
            }



            if ($('#solpricecarat' + ids + '').val() == "")
            {
                common.toast(0, "Enter Price / Carat For Solitaire ");
                highlight('solpricecarat' + ids,0);
                isValid=false;
                return false;
            }

            if (!checkForZero('solpricecarat' + ids))
            {
                common.toast(0, "Price / carat can not be 0");
                highlight('solpricecarat' + ids,0);
                isValid=false;
                return false;
            }



            // if ($('#soltable' + ids + '').val() == "")
            // {
            //     common.toast(0, "Enter Table For Solitaire " + ids);
            //     highlight('soltable' + ids,0);
            //     isValid=false;
            //     return false;
            // }
            //
            // if ($('#solCrownAngle' + ids + '').val() == "")
            // {
            //     common.toast(0, "Enter Crown Angle For Solitaire " + ids);
            //     highlight('solCrownAngle' + ids,0);
            //     isValid=false;
            //     return false;
            // }
            //
            // if (!checkForZero('solCrownAngle' + ids))
            // {
            //     common.toast(0, "Crown Angle can not be 0");
            //     highlight('solCrownAngle' + ids,0);
            //     isValid=false;
            //     return false;
            // }
            //
            //
            // if ($('#solGirdle' + ids + '').val() == "")
            // {
            //     common.toast(0, "Enter Girdle For Solitaire " + ids);
            //     highlight('solGirdle' + ids,0);
            //     isValid=false;
            //     return false;
            // }
            //
            // if (!checkForZero('solGirdle' + ids))
            // {
            //     common.toast(0, "Girdle can not be 0");
            //     highlight('solGirdle'+ ids,0);
            //     isValid=false;
            //     return false;
            // }

            if ($('#solNofs1' + ids + '').val() == "")
            {
                common.toast(0, "Enter number of Solitaire ");
                highlight('solNofs' + ids,0);
                isValid=false;
                return false;
            }

            if (!checkForZero('Nofs' + ids))
            {
                common.toast(0, "Number of solitaire can not be 0");
                highlight('solNofs'+ ids,0);
                isValid=false;
                return false;
            }
        });
        return isValid;

}

function  validateDiamondAdd()
{
        var isValid=true;
        $('[id*=diamondComm_]').each(function() {
            var id = $(this).attr('id');
            var ids = id.split("diamondComm_");
            ids = ids[1];

            if ($('#diamondComm_' + ids + ' .shapeSelected').length == 0)
            {
                common.toast(0, "Select Shape For Diamond " + ids);
                highlight('diamondComm_' + ids,2);
                isValid=false;
                return false;
            }

            if ($('[name*=isDiamondCustz_' + ids + ']:checked').val() == 1)
            {

                if ($('[name=dmdquality_cust' + ids + ']:checked').length == 0)
                {
                    common.toast(0, "Select Customizable Diamond Quality For " + ids);
                    var id=$('[name=dmdquality_cust' + ids + ']').eq(0).attr('id');
                    highlight(id,1);
                    isValid=false;
                    return false;
                }
            }

            if ($('[name*=isDiamondCustz_' + ids + ']:checked').val() == 0)
            {

                if ($('[name=dmdquality_notCust' + ids + ']:checked').length == 0)
                {
                    common.toast(0, "Select Not Customizable Diamond Quality For " + ids);
                    var id=$('[name=dmdquality_notCust' + ids + ']').eq(0).attr('id');
                    highlight(id,1);
                    isValid=false;
                    return false;
                }

            }


            if ($('#dmdcaratweight' + ids + '').val() == "")
            {
                common.toast(0, "Enter Diamond Weight For " + ids);
                highlight('dmdcaratweight' + ids,0);
                isValid=false;
                return false;
            }

            if (!checkForZero('dmdcaratweight' + ids))
            {
                common.toast(0, "Carat weight can not be 0");
                highlight('dmdcaratweight' + ids,0);
                isValid=false;
                return false;
            }


            if ($('#dmdPieces' + ids + '').val() == "")
            {
                common.toast(0, "Enter Total Diamonds For " + ids);
                highlight('dmdPieces' + ids,0);
                isValid=false;
                return false;
            }


            if (!checkForZero('dmdPieces' + ids))
            {
                common.toast(0, "Pieces can not be 0");
                highlight('dmdPieces' + ids,0);
                isValid=false;
                return false;
            }

        });
        return isValid;
}

function validateUncutAdd()
{
    var isValid=true;
     $('[id*=uncutComm_]').each(function() {
            var id = $(this).attr('id');
            var ids = id.split("uncutComm_");
            ids = ids[1];

            if ($('[name=uncutColors_' + ids + ']:checked').length == 0)
            {

                common.toast(0, "Select Color For Uncut " + ids);
                var id=$('[name=uncutColors_' + ids + ']').eq(0).attr('id');
                highlight(id,1);
                isValid=false;
                return false;

            }

            if ($('[name=uncutquality_' + ids + ']:checked').length == 0)
            {

                common.toast(0, "Select Quality For Uncut " + ids);
                var id=$('[name=uncutquality_' + ids + ']').eq(0).attr('id');
                highlight(id,1);
                isValid=false;
                return false;

            }

            if ($('#uncutcaratweight' + ids + '').val() == "")
            {
                common.toast(0, "Enter Uncut Diamond Weight For " + ids);
                highlight('uncutcaratweight' + ids,0);
                isValid=false;
                return false;
            }

            if (!checkForZero('uncutcaratweight' + ids))
            {
                common.toast(0, "Uncut Carat weight can not be 0");
                highlight('uncutcaratweight' + ids,0);
                isValid=false;
                return false;
            }


            if ($('#uncutpricecarat' + ids + '').val() == "")
            {
                common.toast(0, "Enter Price For " + ids);
                highlight('uncutpricecarat' + ids,0);
                isValid=false;
                return false;
            }

            if (!checkForZero('uncutpricecarat' + ids))
            {
                common.toast(0, "Price / carat can not be 0");
                highlight('uncutpricecarat' + ids,0);
                isValid=false;
                return false;
            }


            if ($('#uncutPieces' + ids + '').val() == "")
            {
                common.toast(0, "Enter Total Uncut Diamonds For " + ids);
                highlight('uncutPieces' + ids,0);
                isValid=false;
                return false;

            }

            if (!checkForZero('uncutPieces' + ids))
            {
                common.toast(0, "Uncut Pieces can not be 0");
                highlight('uncutPieces' + ids,0);
                isValid=false;
                return false;
            }


        });
        return isValid;

}

function validateGemstoneAdd()
{
    var isValid=true;
    $('[id*=gemstoneComm_]').each(function() {
            var id = $(this).attr('id');
            var ids = id.split("gemstoneComm_");
            ids = ids[1];

            if ($('#gemstone_type' + ids + '').val() == -1)
            {
                common.toast(0, "Select Gemstone Type For " + ids);
                highlight('gemstone_type'+ids,0);
                isValid=false;
                return false;

            }

            if ($('#gemstonecaratweight' + ids + '').val() == "")
            {
                common.toast(0, "Enter Gemstone Weight For " + ids);
                highlight('gemstonecaratweight' + ids,0);
                isValid=false;
                return false;
            }

            if (!checkForZero('gemstonecaratweight' + ids))
            {
                common.toast(0, "Gemstone Carat weight can not be 0");
                highlight('gemstonecaratweight' + ids,0);
                isValid=false;
                return false;
            }

            if ($('#gemstonepricecarat' + ids + '').val() == "")
            {
                common.toast(0, "Enter Price For Gemstone " + ids);
                highlight('gemstonepricecarat' + ids,0);
                isValid=false;
                return false;

            }

            if (!checkForZero('gemstonepricecarat' + ids))
            {
                common.toast(0, "Price / Carat can not be 0");
                highlight('gemstonepricecarat' + ids,0);
                isValid=false;
                return false;
            }

            if ($('#gemstonePieces' + ids + '').val() == "")
            {
                common.toast(0, "Enter Total Gemstone Pieces For " + ids);
                highlight('gemstonePieces' + ids,0);
                isValid=false;
                return false;

            }

            if (!checkForZero('gemstonePieces' + ids))
            {
                common.toast(0, "Gemstone pieces can not be 0");
                highlight('gemstonePieces' + ids,0);
                isValid=false;
                return false;
            }

        });
        return isValid;

}



function checkSolAdd()
{
    if(validateSolAdd()){
        addSolitaire();
    }

}

function checkDmdAdd()
{
    if(validateDiamondAdd()){
        addDiamond();
    }

}

function checkUncutAdd()
{
    if(validateUncutAdd()){
        addUncut();
    }

}
function checkGemsAdd()
{
    if(validateGemstoneAdd()){
        addGemstone();
    }

}
var varr=new Array();
function setAtttrValues(data)
{
    if(data['error']['err_code']==0)
    {

        $(data['result']).each(function(i,v){
            $('#attr_'+v.attid+" a").click();
            var dval=decodeURIComponent(v.value);
            //varr=dval;
            var valArrays=dval.split(',');
            $(valArrays).each(function(i,vl){
                var val="attr_"+v.attid+"_"+vl.replace(/ /g,'_');
                $('[name=attrVals]').each(function(){
                    var id=$(this).attr('id');
                    if(id==val){
                        $(this).click();
                    }
                });
            });

        });
    }


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



function getCatid(name) {
    if(name==0)
        return "Master";
    var cid;
    $(categories).each(function(i) {
        if (categories[i]['name'] == name) {
            cid = categories[i]['cid'];
            return cid;
        }
    });
    return cid;
}

var allCh=new Array();

function getAllChild(cid)
{

    var allchild=new Array();
    var pids=new Array();
    $(categories).each(function(i,v){
        pids=v.pid.split(",");
        $(pids).each(function(z){
            if(cid==pids[z])
            {
                allchild.push(v.name);
            }
        });
    });

    values={};
    values['cat']=getCatName(cid);
    values['childs']=allchild;
    allCh.push(values);

 return allchild.toString();

}


function test()
{
    $(categories).each(function(i,v){
        getAllChild(v.cid);
    });

}

function getCh(k)
{
    var str="";
    $(allCh).each(function(l,m){
        if(allCh[l]['cat']==k)
        {

            var childs=allCh[l]['childs'];

            if(childs.length==0)
            {
                str+="<ul>";
                    str+="<li>";
                        str+="<a>";
                                str+="<div class='checkDiv fLeft'>";
                                        str+="<input type='checkbox' name='attrVals' class='filled-in' id='' value='"+k+"'>";
                                        str+="<label for=''>"+k+"</label>";
                                str+="</div>";
                        str+="</a>";
                    str+="</li>";
                str+="</ul>";
            }
            else
            {

                str+="<ul class='superparent'>";
                    str+="<li class='parent'><a>"+k+"</a>";
                    $(childs).each(function(j,vj){
                        str+="<ul>";
                            var cnt=allCh[j]['childs'].length;
                            if(cnt>0)
                            {
                                str+="<li class='parent'><a>"+vj+"</a>";
                                    str+= getCh(vj);
                                str+="</li>";
                            }
                        str+="</ul>";
                    });
                    str+="</li>";
                str+="</ul>";

            }




        }

        return str;

    });
    return str;
}



//
//function test1()
//{
//
//    var str="";
//    $(allCh).each(function(i,v){
//
//
//                str+= getCh(v.cat);
//
//    });
//
//    $('#parentCatg2').append(str);
//    bindTree2();
//}



//
//
//function bindTree2()
//{
//
//
//    $('.tree li.parent > a').bind('click',function( ) {
//            var id = $(this).parent().attr('id');
//            $(this).parent().toggleClass('active');
//            $(this).parent().children('ul').slideToggle('fast');
//                if($(this).parent().hasClass('active')){}
//                else
//                {
//                    $('#'+id+' :input[type=checkbox]').each(function() {
//                           // $(this).attr('checked',false);
//                    });
//                }
//
//        });
//
//
//
//
//}


function _getCategoryTree(xhtml, subcat) {

    if(subcat)
    {
        xhtml += '<ul>';
        $.each(subcat, function(i, vl) {
            xhtml += '<li>';
            xhtml += generateHtml(vl)
            if(vl.subcat) {
                xhtml += getCategoryTree(xhtml, vl.subcat);
            }
            xhtml += '</li>';
        });
        xhtml += '</ul>';
    }
    else {
        var URL = APIDOMAIN + "index.php?action=getCatgoryTree";
        $.ajax({
            url: URL,
            type: "POST",
            async: false,
            success: function(res) {
                res = JSON.parse(res);
                xhtml += '<ul>';
                $.each(res.root, function(i, vl) {

                    xhtml += '<li>';
                    xhtml += generateHtml(vl)
                    if(vl.subcat)
                    {
                        xhtml += getCategoryTree(xhtml, vl.subcat);
                    }
                    xhtml += '</li>';
                });
                xhtml += '</ul>';
            }
        });
    }
    return xhtml;
}

function bindCheckBoxClick() {
    $('#parentCatg ul li input[name="prtcateg"]').bind('click', function(evt) {
        stopPropGate(evt);
        checkParents($(this));
    });
}

function checkParents(obj)
{
    var id = obj.attr('id');
    var doit = new Array();
    var i = 0;

        $('#'+id).parents('li').each(function()
        {
            $(this).closest('li').siblings().find('input[name="prtcateg"]').each( function() {
                if($(this).is(':checked'))
                {
                    $(this).parents('li').each(function()
                    {
                        doit[i] = $(this).find('input[name="prtcateg"]').attr('id');
                        i++;
                    });
                }
            });

            if(obj.is(':checked'))
            {
                var chbox=$(this).find('input[name="prtcateg"]').attr('id');
                $('#'+chbox).prop('checked',true);
            }
            else
            {
                var chbox=$(this).find('input[name="prtcateg"]').attr('id');
                $('#'+chbox).prop('checked',false);
            }

            $.each(doit, function(i, vl) {
                $('#'+vl).prop('checked',true);
            });

        });
}

function getCategoryTree(xhtml, subcat) {
    var xhtml = '';
    var URL = APIDOMAIN + "index.php?action=getCatgoryTree";
    $.ajax({
        url: URL,
        type: "POST",
        async: false,
        success: function(res) {
            res = JSON.parse(res);
            xhtml = makeTree(res);

            $('#parentCatg').html(xhtml);
            bindCheckBoxClick();
        }
    });
}



//var uid = $(this).find('input[name="prtcateg"]').attr('id').split('-').pop(-1);
//$('#'+id).parents('li').each(function() {
//var _this = $(this).find('input[name="prtcateg"]');
//var uid = $(this).find('input[name="prtcateg"]').attr('id').split('-').pop(-1);

function displayChecked(catAttr)
{
    $('#parentCatg ul li input[type=checkbox]').each( function()
    {
        var _this = $(this);
        var id = $(this).attr('id');
        var uid = id.split('-').pop(-1);

        $.each(catAttr.results, function(i, vl) {
            if(_this.val() == vl.cid)
            {
                $('#'+id).prop('checked',true);
            }
        });
    });
}

var j = 0;
var prevCat = 0;

function makeTree(vls)
{
    var xhtml = '';

    if(vls.subcat)
        vlst = vls.subcat;
    else if(vls.root)
        vlst = vls.root;
    else
        vlst = vls;

    if(vls.subcat || vls.root)
    {
        xhtml += '<ul>';
    }

    $.each(vlst, function(i, vl) {
        if(vl.subcat)
        {
            xhtml += '<li>';
                //xhtml += '<a href="#" class="parent">'+vl.cat_name+'</a>';
                xhtml += '<div class="checkDiv fLeft">';
                    xhtml += '<input type="checkbox" name="prtcateg" value="'+vl.catid+'" class="filled-in " id="'+j+'-'+vl.catid+'">';
                    xhtml += '<label for="'+j+'-'+vl.catid+'">'+vl.cat_name+'</label>';
                xhtml += '</div>';
                xhtml += makeTree(vl);
            xhtml += '</li>';
            j++;
        }
        else {
            xhtml += '<li>';
                //xhtml += '<a href="#" class="parent">'+vl.cat_name+'</a>';
                xhtml += '<div class="checkDiv fLeft">';
                    xhtml += '<input type="checkbox" name="prtcateg" value="'+vl.catid+'" class="filled-in" id="'+j+'-'+vl.catid+'">';
                    xhtml += '<label for="'+j+'-'+vl.catid+'">'+vl.cat_name+'</label>';
                xhtml += '</div>';

            xhtml += '</li>';
            j++;
        }
        prevCat = vl.catid;
    });

    if(vls.subcat || vls.root)
    {
        xhtml += '</ul>';
    }
    return xhtml;
}

function getHtml(vls)
{
    var xhtml = '';
    if(typeof vls == 'object')
    {
        xhtml += '<ul>';
    }
    $.each(vls, function(i, vl){
        if(typeof vl == 'object')
        {
            xhtml += '<li>';
                xhtml += '<a href="#" class="parent">'+i+'</a>';
                xhtml += getHtml(vl);
            xhtml += '</li>';
        }
        else
        {
            xhtml += '<li>';
                xhtml += '<a href="#" class="parent">'+i+'</a>';
            xhtml += '</li>';
        }
    });
    if(typeof vls == 'object')
    {
        xhtml += '</ul>';
    }

    return xhtml;
}

function generateHtml(vl) {
    var xhtml = '';
        xhtml += '<a>';
            xhtml += '<div class="checkDiv fLeft">';
                xhtml += '<input type="checkbox" class="filled-in" id="'+vl.catid+'">';
                xhtml += '<label for="'+vl.catid+'">'+vl.cat_name+'</label>';
            xhtml += '</div>';
        xhtml += '</a>';
    return xhtml;
}

function createTree() {

    var xhtml = ''
    var str = getCategoryTree(xhtml);

}

createTree();

function maxlengthcheck()
{
    var values = $('#productDescription').val().length;
    $('.msgLabel').text(msgLabel-values+' Character Left');
}
