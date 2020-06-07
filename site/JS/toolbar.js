var clicked = false;
$(document).ready(function(){
    //Hide and Show
	$("#close_bar").click(function(){
	    closeOptionsBar();
	});
	$("#show_bar").click(function(){
	    showOptionsBar();
	});
	//Options
	$("#option_mainItem").click(function(){
	    if(!clicked)
		{
		    $("#option_main").fadeIn('slow');
		    clicked = true;
		}
		else
		{
		    $("#option_main").fadeOut('slow');
		    clicked = false;
		}
	});
	$("#saveChanges").click(function(){
		var item1 = document.getElementById('toolbar_item1');
		var item2 = document.getElementById('toolbar_item2');
		var item3 = document.getElementById('toolbar_item3');
		var item4 = document.getElementById('toolbar_item4');

		if(item1.checked)
		{
		   $.get("toolbarItems.php?DirectWatch=true", function(data){
			       
		   });
		}
		else
		{
		   $.get("toolbarItems.php?DirectWatch=false", function(data){
			       
		   });
		}
		if(item2.checked)
		{
		   $.get("toolbarItems.php?CPanel=true", function(data){
			       
		   });
		}
		else
		{
		   $.get("toolbarItems.php?CPanel=false", function(data){
			       
		   });
		}
		if(item3.checked)
		{
		   $.get("toolbarItems.php?comments=true", function(data){
			       
		   });
		}
		else
		{
		   $.get("toolbarItems.php?comments=false", function(data){
			       
		   });
		}
		if(item4.checked)
		{
		   $.get("toolbarItems.php?quiz=true", function(data){
			       
		   });
		}
		else
		{
		   $.get("toolbarItems.php?quiz=false", function(data){
			       
		   });
		}
		window.location.reload();
	});
});

function closeOptionsBar()
{
    $("#option_main").fadeOut('slow');
	clicked = false;
	$("#options_bar_list").hide();
	$("#close_bar").hide();
	$("#options_main_toolbar").css("width","3%");
	$("#show_bar").show();
}

function showOptionsBar()
{
    $("#options_bar_list").show();
	$("#close_bar").show();
	$("#options_main_toolbar").css("width","90%");
	$("#show_bar").hide();
}