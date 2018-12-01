/**
 * File navigation.js.
 *
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * 
 * navigation support for dropdown menus.
 */

//Handles hover on main navigation
jQuery(document).ready(function($) {
	//check if subnav set to active
	console.log("Navigation active");
    var groupSubnavs = $(".mf-dropdown-subnav");
	
	groupSubnavs.each(function(key,item) {
        var groupItem = $(this).data("group");
		initNavMenu(groupItem);
		
    });

    function initNavMenu(groupName) {
        var subnavs = $("." + groupName);
        subnavs.each(function() {
            if($(this).hasClass("active")) {
                
                var subnav = $(this).data("container");
                $("#" + subnav).show();
            }
        });

        subnavs.on("mouseover",function() {
            subnavs.each(function(key,item) {

                if($(item).hasClass("active")) {
                    $(item).removeClass("active");
                    var subnav = $(item).data("container");
                    $("#" + subnav).hide();    
                }
            });

            //change
            if(!$(this).hasClass("active")) {

                $(this).addClass("active");
                var subnav = $(this).data("container");
                $("#" + subnav).show();
            }
        })
    }
});