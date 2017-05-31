function DropDown(el) {
    this.dd = el;
    this.initEvents();
}
DropDown.prototype = {
    initEvents : function() {
        var obj = this;

        obj.dd.on('click', function(event){
            $(this).toggleClass('active');
            event.stopPropagation();
        }); 
    }
}
$(function(){
    $(".box").hover(function(){
      $(this).find(".overlay").fadeIn();
    }
                    ,function(){
                        $(this).find(".overlay").fadeOut();
                    }
                   );        
});
