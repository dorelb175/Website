$(document).ready(function(){
   var $_GET = parseGET();
   var manageMode = $_GET['manageMode'];
   (manageMode == 1) ? showPagesDiv() : (manageMode == 2) ? showFilesDiv() : (manageMode == 3) ? showDbDiv() : "";
   
   $("#go_manage_page").click(function(){
       location.href = "manage.php";
   });
   
   $("#go_manage_files").click(function(){
       location.href = "manage.php?manageMode=2";
   });
   
   $("#go_manage_db").click(function(){
	   location.href = "manage.php?manageMode=3";
   });
   
   $("#load_file").click(function(){
       $.post("manage.php", function(data){
	       
	   });
   });
   
   $("#del_file").click(function(){
	   if(checkFile())
	   {
	      var file = $("#filename").val() + "." + $("#extension").val();
		  var c = confirm("האם אתה בטוח שברצונך למחוק את הקובץ " + file + " ?");
	      if(c == true)
	      {
             $.get("del_file.php?filename="+file, function(file_data){
	             $("#manage_file_error").html(file_data);
	         });
	      }
	   }
   });
   
   
});

function cancel()
{
   var $_GET = parseGET();
   var mm = $_GET['manageMode'];
   var href = (!mm) ? "manage.php" : "manage.php?manageMode="+mm;
   location.href = href;
}

function prev()
{
   var val = document.getElementById('page_content').value;
   document.getElementById('pre').innerHTML = val; 
   document.forms.p.submit();
}

function checkFile()
{
    var filename = $("#filename").val();
	var ext = $("#extension").val();
	
	if(filename != null && filename != "" && filename != " " && checkExtension(ext))
	{
	   return true;
	}
	else if(filename == null || filename == "" || filename == " ")
	{
	   alert("אנא הכנס שם לקובץ");
	   return false;
	}
	else if(!checkExtension(ext))
	{
	   alert("סיומת לא חוקית.\nהסיומת חייבת להיות בפורמט txt,html,php,js");
	   return false;
	}
}

function checkExtension(filename)
{
    var ext = /[^.]+$/.exec(filename);
	var arr = new Array("txt", "html", "php", "js");
	var ok = false;
	
	for(var i = 0; i < arr.length; i++)
	{
	   if(ext == arr[i])
	   {
	      ok = true;
	   }
	}
	
	return ok;
}

//Show and Hide

function showPagesDiv()
{
   $("#file_manage").hide();
   $("#db_manage").hide();
   $("#page_manage").show();
}

function showFilesDiv()
{
   $("#db_manage").hide();
   $("#page_manage").hide();
   $("#file_manage").show();
}

function showDbDiv()
{
   $("#file_manage").hide();
   $("#page_manage").hide();
   $("#db_manage").show();
}

function deleteTable(table)
{
   var c = confirm("האם אתה בטוח שברצונך למחוק את הטבלה " + table + " ?");
   if(c == true)
   {
	  $.get("showTable.php?name="+table+"&act=delete", function(data){
	      $("#table_message").html(data);
	  });
	  setTimeout(refresh(), 2800);
   }
}

function refresh()
{
   location.reload(true);
}

//Edit

function edit(tag)
{
    var val = document.edit_page_form.content;
	
	if(tag == 'option')
	{
	   var op = prompt("Enter a tag:");
	   if(op != null && op != "")
	      insertAtCaret(val, '<'+op+'>'+'</'+op+'>');
	}
	else if(tag == 'img')
	{
	   var src = prompt("Image Source:");
	   if(src != null)
	      insertAtCaret(val, '<img src="' + src + '" alt="image" />');
	}
	else if(tag == 'form')
	{
	   var met = prompt("Method:");
	   if(met == 'post' || met == 'get')
	   {
	      var act = prompt("Action: ");
		  if(act != null)
		     insertAtCaret(val, '\n<form method="' + met + '" action="' + act + '">\n\n<input type="submit" />\n\n</form>\n');
	   }
	}
	else if(tag == 'input')
	{
	   var type = prompt("Type: ");
	   if(type != null)
	      insertAtCaret(val, '<input type="' + type + '" id="" name="" />');
	}
	else if(tag == 'a')
	{
	   var h = prompt("Href: ");
	   if(h != null)
	   {
	      if(h == "")
	         insertAtCaret(val, '<a href="javascript:void(0);"></a>');
	      else
	         insertAtCaret(val, '<a href="' + h + '"></a>');
	   }
	}
	else if(tag == 'table')
	{
	   insertAtCaret(val, '\n<table>\n  <tr>\n    <td></td>\n    <td></td>\n  </tr>\n  <tr>\n    <td></td>\n    <td></td>\n  </tr>\n</table>\n');
	}
	else if(tag == 'title')
	{
	   var n = prompt("Size(1-7): ");
	   if(n >= 1 && n <= 7)
	      insertAtCaret(val, "<h" + n + "></h" + n + ">");
	}
	else
	{
	   insertAtCaret(val, '<'+tag+'></'+tag+'>');
	}
}

function editFile(tag)
{
    var val = document.edit_file_form.file_content;
	
	if(tag == 'option')
	{
	   var op = prompt("Enter a tag:");
	   if(op != null && op != "")
	      insertAtCaret(val, '<'+op+'>'+'</'+op+'>');
	}
	else if(tag == 'img')
	{
	   var src = prompt("Image Source:");
	   if(src != null)
	      insertAtCaret(val, '<img src="' + src + '" alt="image" />');
	}
	else if(tag == 'form')
	{
	   var met = prompt("Method:");
	   if(met == 'post' || met == 'get')
	   {
	      var act = prompt("Action: ");
		  if(act != null)
		     insertAtCaret(val, '\n<form method="' + met + '" action="' + act + '">\n\n<input type="submit" />\n\n</form>\n');
	   }
	}
	else if(tag == 'input')
	{
	   var type = prompt("Type: ");
	   if(type != null)
	      insertAtCaret(val, '<input type="' + type + '" id="" name="" />');
	}
	else if(tag == 'a')
	{
	   var h = prompt("Href: ");
	   if(h != null)
	   {
	      if(h == "")
	         insertAtCaret(val, '<a href="javascript:void(0);"></a>');
	      else
	         insertAtCaret(val, '<a href="' + h + '"></a>');
	   }
	}
	else if(tag == 'table')
	{
	   insertAtCaret(val, '\n<table>\n  <tr>\n    <td></td>\n    <td></td>\n  </tr>\n  <tr>\n    <td></td>\n    <td></td>\n  </tr>\n</table>\n');
	}
	else if(tag == 'title')
	{
	   var n = prompt("Size(1-7): ");
	   if(n >= 1 && n <= 7)
	      insertAtCaret(val, "<h" + n + "></h" + n + ">");
	}
	else
	{
	   insertAtCaret(val, '<'+tag+'></'+tag+'>');
	}
}

function setCaret(textObj) 
{
   if (textObj.createTextRange) 
   {
      textObj.caretPos = document.selection.createRange().duplicate();
   }
}

function insertAtCaret (textObj, textFeildValue) 
{
   if(document.all)
   { 
      if (textObj.createTextRange && textObj.caretPos) 
	  {
         var caretPos = textObj.caretPos;
         caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? textFeildValue + ' ' : textFeildValue;
      }
	  else
	  {
         textObj.value = textFeildValue;
      }
   }
   else
   {
      if(textObj.setSelectionRange)
	  {
         var rangeStart = textObj.selectionStart;
		 var rangeEnd = textObj.selectionEnd;
		 var tempStr1 = textObj.value.substring(0,rangeStart);
		 var tempStr2 = textObj.value.substring(rangeEnd);
		 textObj.value = tempStr1 + textFeildValue + tempStr2;

      }
	  else
	  {
         alert("This version of Mozilla based browser does not support setSelectionRange");
      }
   }
}

function parseGET(url)
{  
  if(!url || url == '') url = document.location.search;
  if(url.indexOf('?') < 0) return Array();

  url = url.split('?');
  url = url[1];
  
  var GET = [];
  var params = [];
  var keyval = [];

  if(url.indexOf('#') != -1)    
  {    
    anchor = url.substr(url.indexOf('#') + 1); 
    url = url.substr(0, url.indexOf('#'));
  }

  if(url.indexOf('&') > -1) params = url.split('&');
  else params[0] = url;

  for (i = 0; i < params.length; i++)
  {
    if(params[i].indexOf('=') > -1) keyval = params[i].split('=');
    else { keyval[0] = params[i]; keyval[1] = true; }
    GET[keyval[0]] = keyval[1];
  }
     
  return (GET); 
};
