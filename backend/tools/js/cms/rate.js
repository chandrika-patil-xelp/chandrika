$(document).ready(function() {
    $('#24crtRate').change(function() {
        setGoldRates();
    });
});

function setGoldRates() {
    var val = parseFloat($('#24crtRate').val());

    if (val !== "") {
        var crtR22 = (val * 91.6) / 100;
        var crtR18 = (val * 75.1) / 100;
        var crtR14 = (val * 58.3) / 100;
        var crtR9 = (val * 37.5) / 100;

        $('#22crtRate').html('&#8377;' + crtR22);
        $('#18crtRate').html('&#8377;' + crtR18);
        $('#14crtRate').html('&#8377;' + crtR14);
        $('#9crtRate').html('&#8377;' + crtR9);
    }

}

GetRates();
function GetRates() {
    var URL = APIDOMAIN + "index.php?action=getAllRates";

    $.ajax({
        url: URL,
        type: 'POST',
        success: function(res) {
            res = JSON.parse(res);
            getRatesCallBack(res);
        }
    });
}


function getRatesCallBack(data)
{

    var dlen = data['result']['diamondRates'].length;
    var grt = data['result']['goldRates'][4].price;

    $('#24crtRate').val(grt);
    setGoldRates();
    var i = 0;

    while (i < dlen)
    {
        var j = i + 1;
        $('#rate' + j).val(data['result']['diamondRates'][i].price);
        i++;
    }

}

var userid = 1;
function updateRates()
{
    values = new Array();
    var i = 0;
    while (i < 10)
    {
        var j = i + 1;
        values[i] = parseFloat(($('#rate' + j).val()));
        i++;
    }
    var datas = {};
    datas['grate'] = $('#24crtRate').val();
    datas['diamondrates'] = values;
    datas['userid'] = userid;


    var dt = JSON.stringify(datas);
    var URL = APIDOMAIN + "index.php?action=addRates"

    $.ajax({
        url: URL,
        type: 'POST',
        data: {dt: dt},
        success: function(res) {
            res = JSON.parse(res);
            updateRatesCallBack(res);
        }
    });
}

function updateRatesCallBack(data)
{
    if (data['error']['err_code'] == '0')
    {
        common.toast(1, 'Rates Updated successfully');
        GetRates();

    }
    else
    {
        common.toast(0, 'Error in updating rates');
    }

}      