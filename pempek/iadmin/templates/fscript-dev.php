<?php
global $fscript;
$fscript[]='
/*
notification message
*/
$(".description p").hide();
$(".notification, .description span").hover(function() {
 	$(this).css("cursor","pointer");
}, function() {
 	$(this).css("cursor","auto");
});	
$(".notification span").click(function() {
    $(".notification-wrap").fadeOut(800);
});
$(".notification").click(function() {
    $(".notification-wrap").fadeOut(800);
});
$(".description span").click(function(){
	$(".description p").slideToggle("slow");
	$(this).toggleClass("note_close");
})

/*
uniform
*/
$("select").uniform();
$("textarea.grow").ata();
$("input:checkbox").uniform();
$("input:radio").uniform();
$("input:file").uniform();
$("input.datepicker").datepicker({
	inline: true
});

/*
paging sort table
*/
$("#tablesort").dataTable();

/*
paging
use $(".idnya").paginate({navLabels:"begin|back|forward|end"});
*/
//$(".jpaginate1").paginate();
//$(".jpaginate2").paginate();

/*
tabs
*/
$(".tab_view_post").hide();
$(".tab_view_post:first").show();
$("ul.view_post li:first").addClass("active").show();
$("ul.view_post li").click(function() {
	$("ul.view_post li").removeClass("active");
	$(this).addClass("active");
	$(".tab_view_post").hide();
	var activeTab = $(this).find("a").attr("href");
	$(activeTab).fadeIn();
	return false;
});
$(".tab_referr_urls").hide();
$(".tab_referr_urls:first").show();
$("ul.referr_urls li:first").addClass("active").show();
$("ul.referr_urls li").click(function() {
	$("ul.referr_urls li").removeClass("active");
	$(this).addClass("active");
	$(".tab_referr_urls").hide();
	var activeTab = $(this).find("a").attr("href");
	$(activeTab).fadeIn();
	return false;
});
$(".tab_stat").hide();
$(".tab_stat:first").show();
$("ul.stat li:first").addClass("active").show();
$("ul.stat li").click(function() {
	$("ul.stat li").removeClass("active");
	$(this).addClass("active");
	$(".tab_stat").hide();
	var activeTab = $(this).find("a").attr("href");
	$(activeTab).fadeIn();
	return false;
});
$(".tab_recent_reg").hide();
$(".tab_recent_reg:first").show();
$("ul.recent_reg li:first").addClass("active").show();
$("ul.recent_reg li").click(function() {
	$("ul.recent_reg li").removeClass("active");
	$(this).addClass("active");
	$(".tab_recent_reg").hide();
	var activeTab = $(this).find("a").attr("href");
	$(activeTab).fadeIn();
	return false;
});

/*
drag and drob
*/

	$(".dragbox")
	.each(function(){
		$(this).hover(function(){
			$(this).find("h3").addClass("collapse");
		}, function(){
		$(this).find("h3").removeClass("collapse");
		})
		.find("h3").hover(function(){
			$(this).find(".configure").css("visibility", "visible");
		}, function(){
			$(this).find(".configure").css("visibility", "hidden");
		})
		.click(function(){
			/*$(this).siblings(".dragbox-content").toggle();*/
			updateWidgetData();
		})
		.end()
		.find(".configure").css("visibility", "hidden");
	});
	
	$(".column").sortable({
		connectWith: ".column",
		handle: "h3",
		cursor: "move",
		placeholder: "placeholder",
		forcePlaceholderSize: true,
		opacity: 0.8,
		stop: function(event, ui){
			$(ui.item).find("h3").click();
			updateWidgetData();
		}
	})
		
	.disableSelection();


//textcode
    var delay;
	var editor = CodeMirror.fromTextArea(
	document.getElementById("textcode"), {
		mode: "text/html", 
		lineNumbers: true,
        tabMode: "indent",
        onChange: function() {
          clearTimeout(delay);
          delay = setTimeout(updatePreview, 300);
        }
	});
	
    function updatePreview() {
        var preview = document.getElementById("textcode_preview").contentDocument;
        preview.open();
        preview.write(editor.getValue());
        preview.close();
    }
    setTimeout(updatePreview, 300);
';
?>