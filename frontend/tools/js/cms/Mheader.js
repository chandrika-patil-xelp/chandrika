var headrentrflg = 0;

$(document).ready(function () {

    var winSiz = $(window).width();
    var htSize = $(window).height();
    if (winSiz <= 1024) {
        getmheader();
    }

    var faqTab = $('.sideNav_tab'),
            faqTabContainer = $('.div100');

    if (faqTab.length) {

        faqTab.off('.sideNav_tab').on('click', function () {
            var faqRow = $(this).parent(),
                    faqContent = $(this).parent().find('.collap');
            faqTabContainer.find('.collap').not(faqContent).stop().slideUp('slow');
            faqTabContainer.find('.asa').not(faqRow).removeClass('open');

            faqContent.stop().slideToggle('slow', function () {
                faqRow.toggleClass('open', faqContent.is(':visible'));
            });
        });

    }
    var actnp = GetURLParameter('actn');
    var usid = common.readFromStorage('jzeva_uid');
    if (actnp == "lognpopup") {
        setTimeout(function () {
            if (usid == null || usid == undefined)
                openPopUp();
        }, 3000);

    }
    $('#mediaUsr').click(function () {
           $('.closeLogin').removeClass('dn');
        if (!usid) {
            openPopUp();

        }

    });

    if (usid)
    {
        $('#Musrlogout').html('Logout');
        $('#mediaUsr').addClass('dn');

        $('#Musrlogout').click(function () {

            common.removeFromStorage('jzeva_email');
            common.removeFromStorage('jzeva_name');
            common.removeFromStorage('jzeva_uid');
            common.removeFromStorage('jzeva_mob');
            common.removeFromStorage('jzeva_cartid');
            common.removeFromStorage('jzeva_buyid');
            common.removeFromStorage('jzeva_shpid');


            var URLactn = window.location.href;
            var accnvar = '' + URLactn;
            accnvar = accnvar.replace(DOMAIN, '');
            var tmpaccnvar = accnvar.split('/');
            if (tmpaccnvar[0] == 'MyAccount')
            {
                window.location.href = DOMAIN + "index.php?action=landing_page";
            } else
                window.location.href = DOMAIN + accnvar;



        });
    } else {
        $('#Acc').remove();
    }



    $(document).keypress(function (e) {
        if (e.which == 13)
        {
            if (headrentrflg == 1)
            {
                track_ord();
            }
        }

    });

});

function getmheader()
{
    var mainheader = "";
    var subheader = "";
    var cnt = 0;
    var URL = APIDOMAIN + "index.php?action=getSubCat&catid=99999";
    $.ajax({url: URL, type: "GET", datatype: "JSON", success: function (results) {
            var obj = JSON.parse(results);

            $(obj['root']).each(function (r, v) {
                if (v.cat_name !== "Education" && v.cat_name !== "Bespoke")
                {
                    cnt = 0;
                    var mainmn = "";
                    var mainmn = v.cat_name;
                    mainmn = mainmn.trim(' ');
                    mainmn = mainmn.replace(/\b[a-z]/g, function (letter) {
                        return letter.toUpperCase();
                    });
                    mainmn = mainmn.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');

//          mainheader+='<div class="asa fLeft"> <a  style="text-decoration:none" href="'+DOMAIN+''+mainmn+'/pid-'+v.catid+'"><div class="sideNav_tab" data-catid="'+v.catid+'" >'+(v.cat_name).toUpperCase()+'</div></a></div>';
                    mainheader += '<div class="asa fLeft"> ';

                    if (v.catid == 3620161108090939) {
                        mainheader += '<a  style="text-decoration:none" href="' + DOMAIN + '' + mainmn + '/pid-' + v.catid + '"><div class="sideNav_tab" data-catid="' + v.catid + '" >' + (v.cat_name).toUpperCase() + '</div></a>';
                    } else {
                        mainheader += '<div class="sideNav_tab siden  inMheader" data-catid="' + v.catid + '" >' + (v.cat_name).toUpperCase() + '</div>';
                    }
                    if (v['subcat'] !== undefined)
                    {
                        mainheader += '<div class="collap fLeft">';
                        $(v['subcat']).each(function (p, t) {
                            var submn = "";
                            submn = t.cat_name;
                            submn = submn.trim(' ');
                            submn = submn.replace(/\b[a-z]/g, function (letter) {
                                return letter.toUpperCase();
                            });
                            submn = submn.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
                            mainheader += ' <a  style="text-decoration:none" href="' + DOMAIN + '' + submn + '/pid-' + t.catid + '"><div class="meucot fLeft ">' + submn + '</div></a>';
                        });
                        mainheader += '</div></div>';
                    }
                }
            });
            setTimeout(function () {
                $('#menudivCont').prepend(mainheader);
                bindHeader();
                var faqTab = $('.siden'),
                        faqTabContainer = $('.div100');

                if (faqTab.length) {

                    faqTab.off('.siden').on('click', function () {
                        var faqRow = $(this).parent(),
                                faqContent = $(this).parent().find('.collap');
                        faqTabContainer.find('.collap').not(faqContent).stop().slideUp('slow');
                        faqTabContainer.find('.asa').not(faqRow).removeClass('open');

                        faqContent.stop().slideToggle('slow', function () {
                            faqRow.toggleClass('open', faqContent.is(':visible'));
                        });
                    });

                }

            }, 500);

        }
    });
}


function GetURLParameter(Param)
{
    var PageURL = window.location.search;
    var URLVariables = PageURL.split('&');
    for (var i = 0; i < URLVariables.length; i++)
    {
        var ParameterName = URLVariables[i].split('=');
        if (ParameterName[0] == Param) {
            return ParameterName[1];
        }
    }
}

//$('#Track_ord').click(function () {
//    track_ord();
//
//});

function track_ord()
{
    var ordno = $('#ord_no').val();
    var inptdata = $('#ord_email').val();
    var validationFlag = 1;
    var filter = /^[0-9-+]+$/;
    if (!filter.test(ordno)) {
        validationFlag = 0;
        common.msg(0, 'Order number is Invalid');
    } else
    {
        if ($.isNumeric(inptdata))
        {
            var filter = /^[0-9-+]+$/;
            if (inptdata === '' || inptdata === null) {
                validationFlag = 0;
                common.msg(0, 'Please enter your Mobile no');
            } else if (isNaN(inptdata) || (inptdata.length < 10)) {
                validationFlag = 0;
                common.msg(0, 'Mobile no. Invalid');
            } else if (!filter.test(inptdata)) {
                validationFlag = 0;
                common.msg(0, 'Mobile number is Invalid');
            }
            if (validationFlag == 1)
            {
                var URL = APIDOMAIN + "index.php?action=checktrackord&orderid=" + ordno + "&mobile=" + inptdata;

            }
        } else
        {
            var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
            if (inptdata === '' || inptdata === null) {
                validationFlag = 0;
                common.msg(0, 'Please enter your Email id');
            } else if (!reg.test(inptdata)) {
                validationFlag = 0;
                common.msg(0, 'Invalid Email.id');
            }
            if (validationFlag == 1)
            {
                var URL = APIDOMAIN + "index.php?action=checktrackord&orderid=" + ordno + "&email=" + inptdata;
            }
        }
    }
    if (validationFlag == 1)
    {
        $.ajax({url: URL, type: 'POST', success: function (res) {
                var data = JSON.parse(res);

                if (data['error']['err_code'] == 0) {
                    var ordid = data['result']['order_id'];
                    headrentrflg = 0;
                    window.location.href = DOMAIN + "index.php?action=guestaccount&trkid=" + ordid;
                } else if (data['error']['err_code'] == 1)
                    common.msg(0, data['error']['err_msg']);
            }
        });
    }
}

//function guestpopUp() {
//    $('.loginOverlay').velocity({opacity: [1, 0]});
////        $('.loginOverlay').stop(true, true).fadeTo(200, 0);
//
//    $('#guestPar').removeClass("dn");
//    $('#guestPar').velocity({translateY: [0, '150%']}, {duration: 150, delay: 100, easing: ''});
//    $('#guestChild').velocity({opacity: [1, 0], translateY: [0, 20]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
//}
//function guestpopUpClose() {
//    
//    $('.loginOverlay').velocity({opacity: [0, 1]});
////          $('.loginOverlay').stop(true, true).fadeTo(0, 200);
//    $('#guestPar').addClass("dn");
//    $('#guestPar').velocity({translateY: ['150%', 0]}, {duration: 150, delay: 100, easing: ''});
////                $('#guestPar').velocity({opacity: [0, 1]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
//    $('#guestChild').velocity({opacity: [0, 1], translateY: [20, 0]}, {duration: 400, delay: 100, easing: 'ease-in-out'});
//}