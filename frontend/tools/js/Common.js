var common = new Common();
function Common() {
    var _this = this;

    var input_selector = 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=number], input[type=search], textarea, input[type=radio]';
    $(input_selector).bind('keyup input focus', function (e) {
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 13) {
            if ($(this).next('input').length != 0) {
                var flag = $(this).next('input').attr('readonly');
                if (!flag) {
                    $(this).next('input').focus();
                }
            } else {
                if ($(this).parent().next().find('input:first').length != 0) {

                    var flag = $(this).parent().next().find('input:first').attr('disabled');
                    if (!flag) {
                        $(this).parent().next().find('input:first').focus();
                    } else {
                        $(this).parent().next().find('input:nth-child(2)').focus();
                    }

                } else {
                    var flag = $(this).parent().next('input').attr('readonly');
                    if (!flag) {
                        $(this).parent().next('input').focus();
                    } else {
                        $(this).parent().next('input:nth-child(2)').focus();
                    }
                }
            }
        }

    });

    $(input_selector).on('focus', function () {
        var id = $(this).attr('id');
//        setTimeout(function () {
//            var scr = $('#' + id).offset().top - 100;
////            $('body').animate({scrollTop: scr}, 500, 'swing');
//        }, 200);
    });

    this.addToStorage = function (id, val)
    {
        if (val)
        {
            if (typeof (Storage) !== "undefined") {
                localStorage.setItem(id, val);
            } else {
                date = new Date();
                date.setYear(date.getFullYear() + 1);
                document.cookie = id + '=' + val + ';' + date + ';path=/;'
            }
        }
    }

    this.readFromStorage = function (id)
    {
        if (typeof (Storage) !== "undefined")
            return localStorage.getItem(id);
        else
            return _this.getCookie(id);
    }

    this.removeFromStorage = function (id)
    {
        if (typeof (Storage) !== "undefined")
            localStorage.removeItem(id);
        else
            document.cookie = id + '=;' + date + ';path=/;'
    }

    this.getCookie = function (cn) {
        if (document.cookie.length > 0) {
            var c_start = document.cookie.indexOf(cn + "=");
            if (c_start != -1) {
                c_start = c_start + cn.length + 1;
                var c_end = document.cookie.indexOf(";", c_start);
                if (c_end == -1)
                    c_end = document.cookie.length;
                var cvalue = _this.cookie_unescape(document.cookie.substring(c_start, c_end));
                return unescape(cvalue);
            }
        }
        return "";
    }

    this.cookie_unescape = function (str)
    {
        str = "" + str;
        while (true)
        {
            var i = str.indexOf('+');
            if (i < 0)
                break;
            str = str.substring(0, i) + '%20' +
                    str.substring(i + 1, str.length);
        }
        return unescape(str);
    }

    this.validate_mobile = function (mobno) {
        var mobExp = /^[7,8,9]{1}[0-9]{9}$/;
        var flag = true;
        if (mobno == '' || mobno == null || mobno == undefined) {
            flag = false;
        } else if (mobExp.test(mobno) == false) {
            flag = false;
        }

        return flag;
    }

    this.validateMobile = function (mobno) {
        var mobExp = /^[7,8,9]{1}[0-9]{9}$/;
        if(mobno.length==11)
             mobExp = /^[0,7,8,9]{1}[0-9]{10}$/;
        var flag = true;
        if (mobno == '' || mobno == null || mobno == undefined) {
            flag = false;
        } else if (mobExp.test(mobno) == false) {
            flag = false;
        }

        return flag;
    }

    this.validate_email = function (email, isFortigo) {
        var flag = true;
        if (email == '' || email == null || email == undefined) {
            flag = false;
        } else {
            flag = _this.isValidEmail(email);
        }
        return flag;
    }

    this.isValidEmail = function (email) {
        var flag = true;
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        var isSpace = email.indexOf(" ");

        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length || isSpace != -1) {
            flag = false;
        }

        return flag;
    }
//
//     this.toast = function (mType, msg) {
// //        $('.close').click();
// //        $.toast.config.width = 450;
// //        $.toast.config.closeForStickyOnly = false;
// //        if (mType == 0) {
// //            $.toast(msg, {duration: 5000, type: "danger"});
// //        } else if (mType == 1) {
// //            $.toast(msg, {duration: 5000, type: "success"});
// //        }
// //        $('.toast').css('display', 'block');
// //        setTimeout(function () {
// //            $('.close').click();
// //        }, 5000);
// //
//         if (mType == 1)
//             mType = 2;
//         Message.msg(mType, msg);
//
//
//     }

var $toastlast='';
this.msg = function(t, e) {
       if ($toastlast !== '')
           toastr.clear();

       if (t == 0)
           t = 'danger';

       if (t == 1)
           t = 'info';

       if (t == 2)
           t = 'success';

       if (t == 3)
           t = 'warning';

       $("danger" === t ? function() {
           toastr.error(e)
       } : "info" === t ? function() {
           toastr.info(e)
       } : "success" === t ? function() {
           toastr.success(e)
       } : "warning" === t ? function() {
           toastr.warning(e)
       } : function() {

       });
       $toastlast = toastr;
   }, toastr.options = {
       closeButton: 0,
       debug: !1,
       newestOnTop: !0,
       progressBar: 1,
       positionClass: "toast-bottom-right",
       preventDuplicates: false,
       showDuration: "100",
       hideDuration: "1000",
       timeOut: "5000",
       extendedTimeOut: "1000",
       showEasing: "",
       hideEasing: "",
       showMethod: "slideDown",
       hideMethod: "slideUp"
   }, this.decodeMsg = function(t) {
       return decodeURIComponent(t.replace(/\+/g, " "))
   }, this.encodeMsg = function(t) {
       return encodeURIComponent(t)
   }, this.uid = function() {
       var t = webstore.get("uid");
       return t
   }, this.appendDiv = function(t, e, n) {
       if ("" != n) {
           var o = document.getElementById(t);
           o.innerHTML = e ? n : o.innerHTML + n
       }
   }, this.replaceURLWithHTMLLinks = function(t) {
       var e = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi;
       return t.replace(e, "<a href='$1' target='_blank'>$1</a>")
   }, this.getParameterByName = function(t) {
       t = t.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
       var e = new RegExp("[\\?&]" + t + "=([^&#]*)"),
               n = e.exec(location.search);
       return null == n ? "" : decodeURIComponent(n[1].replace(/\+/g, " "))
   }, this.redirect = function(t) {
       window.location = t
   }, this.capitaliseFirstLetter = function(t) {
       var e = t.value;
       "" != e && (t.value = e.charAt(0).toUpperCase() + e.slice(1))
   }, this.capitalize = function(t) {
       var e = t.value.toLowerCase();
       "" != e && (t.value = e.replace(/\w\S*/g, function(t) {
           return t.charAt(0).toUpperCase() + t.substr(1).toLowerCase()
       }))
   }, this.castLowerCase = function(t) {
       document.getElementById(t).value = document.getElementById(t).value.toLowerCase()
   };







    this.makeEmpty = function (val) {
        if (val == null || val == undefined || val == 'undefined') {
            return '';
        } else {
            return val;
        }
    }
    this.validateEmail = function (id) {
        var email = $('#' + id).val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };

    this.eSubmit = function (evt, btnId) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode === 13) {
            $('#' + btnId).click();
        }
    };

    this.allowedFnKeys = new Array(97,99,120);  // Key codes for CTRL + A, CTRL + C, CTRL + X

    /** isNumberKey function allows users to enter numbers onlt in input field */
    this.isNumberKey = function (event) {
        var key = window.event ? event.keyCode : event.which;
        if (event.keyCode === 9 || event.keyCode === 8 || event.keyCode === 46
                || event.keyCode === 37 || event.keyCode === 39) {
            return true;
        } else if (key < 48 || key > 57) {
            return false;
        } else
            return true;
    };

    /** isDecimalNumber function allows users to enter decimal numbers in input field */
    this.isDecimalNumber = function (event, val) {
        var key = window.event ? event.keyCode : event.which;
        if (event.keyCode === 9 || event.keyCode === 8 || event.keyCode === 46
                || event.keyCode === 39) {
            return true;
        } else if (key == 46) {
            if(val.split('.').length==2) {
                return false;
            }
        } else if (key < 48 || key > 57) {
            if(_this.allowedFnKeys.indexOf(key)!=-1 && event.ctrlKey==true) {
                return true;
            }
            return false;
        } else
            return true;
    };
    this.loadListViewAll = function ()
    {
        if (typeof loadListViewAll == 'function') {
            loadListViewAll();
        } else {
             window.open(TRANSPORTERDOMAIN+'index.php?action=transportermap', 'open');
        }
    };

    this.INR_format = function (val)
    {
        val = val.toString();
        var money = val;
        var len = money.length;
        var m = '';
        money = money.toString().split('').reverse().join('');

        for (i = 0; i < len; i++)
        {
            if ((i == 3 || (i > 3 && (i - 1) % 2 == 0)) && i != len)
            {
                m += ',';
            }
            m += money[i];
        }
        m = m.toString().split('').reverse().join('');
        return m;
    };

    this.IND_money_format = function(money)
   {
var m = '';
money = money.toString().split("").reverse();
var len = money.length;
for(var i=0;i<len;i++)
{
if(( i == 3 || (i > 3 && ( i - 1) % 2 == 0) ) && i !== len)
{
m += ',';
}
m += money[i];
}

return m.split("").reverse().join("");
   };
   
   this.isCharacterKey = function (event) {
        var key = window.event ? event.keyCode : event.which;console.log(key);
         if (key < 48 || key > 57) {
            return true;
        } else
            return false;
    };
 
}
