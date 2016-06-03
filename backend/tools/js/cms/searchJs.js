$('.lsearchTxt').bind('keyup', function() 
        {
            var _this = $(this);
            var obj=$(this).parent().siblings('.searchDiv');
            var resultCount = 0;
            $(".searchRow").each(function()
            {
                if ($(this).html().toLowerCase().search(_this.val().toLowerCase()) < 0)
                {
                    $(this).addClass('dn');
                    $('#noresults').removeClass('dn');
                }
                else
                {
                    resultCount++;
                    $(this).removeClass('dn');
                }
            });
            if(resultCount==0) {
                $('#noresults').remove('dn');
            } else {
                $('.searchDiv').next().addClass('dn');
            }
});