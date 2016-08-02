/* @version 1.1 fixedMenu
 * @author Lucas Forchino
 * @webSite: http://www.jqueryload.com
 * jquery top fixed menu
 */
(function($){
    $.fn.fixedMenu=function(){
        return this.each(function(){
            var menu= $(this);
            menu.find('ul li > a').bind('click',function(){
            if ($(this).parent().hasClass('active')){
                $(this).parent().removeClass('active');
                console.log("1");
            }
            else{
                $(this).parent().parent().find('.active').removeClass('active');
                $(this).parent().addClass('active');
                console.log("2");
                
                $(".hide").click(function(){
                	
                	$("ul li > a").parent().removeClass('active');	
                	
                });
                
            }
            })
        });
    }
})(jQuery);
