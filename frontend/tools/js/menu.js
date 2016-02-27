$('.navLstDtls1').velocity({translateY:"-20px", borderRadius:"35%",opacity:"0"});
          $('.navLstDtls2').velocity({translateY:"-20px", borderRadius:"35%",opacity:"0"});
           $('.navLstDtls3').velocity({translateY:"-20px", borderRadius:"35%",opacity:"0"});
    var mInt;
    //var scnd;
    //var third;
    $('#jwl').bind('mouseenter', function() {
        clearTimeout(mInt);
        mInt=setTimeout(function() {
        $('.navLstDtls1').removeClass('dn');
            setTimeout(function() {
                $('.navLstDtls1').velocity({opacity:"1"},{delay:30,duration:100,easing:"swing"});
                $('.navLstDtls1').velocity({translateY:"0px",borderRadius:"0px"},{queue: false,delay:00,duration:200,easing:"swing"});

                },00);
        },100);
    });
    
    $('#jwl').bind('mouseleave', function() {
       $('.navLstDtls1').velocity({opacity:"0"},{delay:0,duration:0,easing:"swing"});
        $('.navLstDtls1').velocity({borderRadius:"35%",translateY:"-20px"},{queue: false,delay:0,duration:0,easing:"swing"});
        setTimeout(function() {
            $('.navLstDtls1').addClass('dn');
        },00);
    });
     $('#sol').bind('mouseenter', function() {
        clearTimeout(mInt);
        mInt=setTimeout(function() {
        $('.navLstDtls2').removeClass('dn');
            setTimeout(function() {
                $('.navLstDtls2').velocity({opacity:"1"},{delay:30,duration:100,easing:"swing"});
                $('.navLstDtls2').velocity({translateY:"0px",borderRadius:"0px"},{queue: false,delay:00,duration:200,easing:"swing"});

                },00);
        },100);
    });
    
    $('#sol').bind('mouseleave', function() {
       $('.navLstDtls2').velocity({opacity:"0"},{delay:0,duration:0,easing:"swing"});
        $('.navLstDtls2').velocity({borderRadius:"35%",translateY:"-20px"},{queue: false,delay:0,duration:0,easing:"swing"});
        setTimeout(function() {
            $('.navLstDtls2').addClass('dn');
        },00);
    });
    $('#fybn').bind('mouseenter', function() {
        clearTimeout(mInt);
        mInt=setTimeout(function() {
        $('.navLstDtls3').removeClass('dn');
            setTimeout(function() {
                $('.navLstDtls3').velocity({opacity:"1"},{delay:30,duration:100,easing:"swing"});
                $('.navLstDtls3').velocity({translateY:"0px",borderRadius:"0px"},{queue: false,delay:00,duration:200,easing:"swing"});

                },00);
        },100);
    });
    
    $('#fybn').bind('mouseleave', function() {
       $('.navLstDtls3').velocity({opacity:"0"},{delay:0,duration:0,easing:"swing"});
        $('.navLstDtls3').velocity({borderRadius:"35%",translateY:"-20px"},{queue: false,delay:0,duration:0,easing:"swing"});
        setTimeout(function() {
            $('.navLstDtls3').addClass('dn');
        },00);
    });
       

