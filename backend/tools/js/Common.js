var common = new Common();
function Common() {
    var _this = this;

    this.eSubmit = function (evt, btnId) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode === 13) {
            $('#' + btnId).click();
        }
    };
    this.isNumberKey = function (evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
		else if (charCode == 13) {
            return false;
        }
        return true;
    };
	this.avoidEnter = function (evt) {
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 13) {
            return false;
        }
	};
    this.isDecimalKey = function (evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46) {
            return true;
        }
		else if (charCode == 13) {
            return false;
        }
        else if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    };

    this.onlyAlphabets = function (evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode < 47) {
            return true;
        } else
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return true;
        }
        return false;
    };
    
    String.prototype.ucwords = function () {
        str = this.toLowerCase();
        return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
                function ($1) {
                    return $1.toUpperCase();
                });
    };
        
    this.validateEmail= function(email){
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!email.match(mailformat)) {
            alert("You have entered an invalid email address!");
            return false;
        }
        return true;
    };

    this.validateMobile = function(mobile) {
        var flag = true;
        var mobExp = /^[7,8,9]{1}[0-9]{9}$/;

        if(!mobile.match(mobExp))
        {
            flag = false;
        }

        return flag;
    };
    
    this.applyTabClass = function(){
        setTimeout(function(){
            $('.tabsComm').each(function(i){
                var obj=this;
            var txt=$(this).text();
            if(tab==txt.toLowerCase()){
                $('.tabsComm').removeClass('tabActive');
                $(obj).addClass('tabActive');
                
                return;
            }
        });
        },50);
    };
    
    
}