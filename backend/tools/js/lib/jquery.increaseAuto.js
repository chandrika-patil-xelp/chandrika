jQuery.fn.increaseAuto = function() {
    return this.each(function() {
        var c = function(b) {
            a.innerHTML = b.value.replace(/\n/g, "<br/>") + ".<br/>.";
            jQuery(b).height() != jQuery(a).height() && jQuery(b).height(jQuery(a).height())
        }, a;
        jQuery(this).after('<div class="autogrow-textarea-mirror"></div>');
        a = jQuery(this).next(".autogrow-textarea-mirror")[0];
        a.style.display = "none";
        a.style.wordWrap = "break-word";
        a.style.padding = jQuery(this).css("padding");
        a.style.width = jQuery(this).css("width");
        a.style.fontFamily = jQuery(this).css("font-family");
        a.style.fontSize = jQuery(this).css("font-size");
        a.style.lineHeight = jQuery(this).css("line-height");
        this.style.overflow = "hidden";
        this.style.minHeight = 30 + "px";
        this.onkeyup = function() {
            c(this)
        };
        c(this)
    })
};