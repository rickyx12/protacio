/**************************************************************************
//  B E G G I N I N G      O F     A U T O     T E X T     L O G I C
**************************************************************************/

// Global Variable(s) declaration
var templateList = new Array("test","testing","tool","b","adico","kleenex","tea","ice","avaya","pain","bank","back","peter","hindu","huge","test","bums","cat","santiago",
                             "append","run","sad","silk","light","little","rate","orange","office","lucky","cable","monitor","narration","early","pick","put","hungry","gain",
                             "gift","java","junction","vegetable","fan","north","nest","winter","nation","carry","dance","danger","iteration","facile","yahoo","yolo", "quicksilver",
                             "arrangement","vechicle","urban","xerox","zeebra","xML","documentation","usability","portugal","ponderosa","portuguese","queenbee","kind");

var cssOutput;
var oldins;
var posi = -1;
var words = new Array();
var input;
var strLen = 0;

function init()
{
  setVisible("hidden");
  cssOutput = document.getElementById("output");
  window.setInterval("evaluateAt()", 100);
  
}

function setVisible(strVisi)
{	
	cssOutput = document.getElementById("output");
	var cssShadow = document.getElementById("shadow");
	if (cursorPos.keydown == true)
	{		
		cssShadow.style.top   = cursorPos.y + 180 + "px";		// TODO: still need some work
		cssShadow.style.left  = cursorPos.x + 40 + "px";		// TODO: still need some work
		cssShadow.style.width = strLen*8+"px";
		
		if (cssOutput)
			cssOutput.style.width = strLen*8+"px";
	}
	if (cssShadow)
		cssShadow.style.visibility = strVisi;	
}

function addWord(word)
{
	var sp = document.createElement("div");
	sp.appendChild(document.createTextNode(word));
	sp.onmouseover = mouseHandler;
	sp.onmouseout  = mouseHandlerOut;
	sp.onclick     = mouseClick;

	cssOutput.appendChild(sp);
	cssOutput.style.hideFocus = true;
}

function clearOutput()
{
	while (cssOutput.hasChildNodes())
		cssOutput.removeChild(cssOutput.firstChild);

	posi = -1;
}

function getWord(beginning)
{
	strLen = 0;
	var words = new Array();
	for (var i=0; i < templateList.length; ++i)
	{
		var j = -1;
		var correct = 1;

		while (correct == 1 && ++j < beginning.length)
		{
			if (templateList[i].charAt(j) != beginning.charAt(j))				
				correct = 0;
		}
		
		if (correct == 1)
		{
			str = templateList[i];
			if (str.length > strLen)
				strLen = str.length;

			words[words.length] = templateList[i];
		}	
	}
  
	return words;
}       


function evaluateAt()
{
	if (!editor || !editor.getSelection())
		return;

	//////////// OLD var userInput condition for IE / FF / MAC			
	/*
	if(CKEDITOR.env.gecko || CKEDITOR.env.opera || CKEDITOR.env.mac || CKEDITOR.env.webkit) {
		var userInput = editor.getSelection().getStartElement().$.textContent; 
	}else{
		var userInput = editor.getSelection().getStartElement().$.innerText; 
	}
	*/
	
	var userInput = trim(getCharFromPos(cursorPos.z-1));

	if (oldins == userInput)
      return;
	
	else if (posi > -1);
	
	else if (userInput.length > 0)
	{
		words = getWord(userInput);
		if (words.length > 0)
		{
			clearOutput();
			
			for (var i=0;i < words.length; ++i)
				addWord (words[i]);
      
			setVisible("visible");
			
			if(CKEDITOR.env.gecko || CKEDITOR.env.opera || CKEDITOR.env.mac || CKEDITOR.env.webkit) {
				input = editor.getSelection().getStartElement().$.textContent;
			}else{
				input = editor.getSelection().getStartElement().$.innerText;
			}
		}
		else
		{
	        setVisible("hidden");
		    posi = +1;
		}
	}
	else
	{
		setVisible("hidden");
		posi = -1;
	}
	oldins = userInput;

}

function keyHandler(keyPress, editor)
{	
	if (document.getElementById("shadow").style.visibility == "visible")
	{
		var text = editor.document.getBody().getText();
		
		if (keyPress == 40)		//key down
		{ 			
			if (words.length > 0 && posi <= words.length-1)
			{
				if (posi >=0)
					setColor(posi, "#fff", "black");
				else 
					input = text;
				
				posi++;
				if (posi <= words.length-1)
				{
					setColor(posi, "blue", "white");
					text = cssOutput.childNodes[posi].firstChild.nodeValue;
				}
			}
		}
		else if (keyPress == 38)	//Key up
		{ 
			if (words.length > 0 && posi >= 0)
			{
				if (posi >=1)
				{
					setColor(posi, "#fff", "black");
					setColor(--posi, "blue", "white");
					text = cssOutput.childNodes[posi].firstChild.nodeValue;
				}
				else
				{
					setColor(posi, "#fff", "black");
					text = input;
					editor.focus();
					posi--;
	           }
		    }
		}
		else if (keyPress == 27)	// Esc
		{ 
			text = input;
			setVisible("hidden");
			posi = -1;
			oldins = input;
		}
		else if (keyPress == 8)		// Backspace
		{ 
			posi = -1;
			oldins=-1;
		}
        else if (keyPress == 13)     // Enter
        {
			// If Enter pressed without selecting a suggested word
			if (posi <= -1 || posi >= words.length)
			{
				setVisible("hidden");
				return;
			}
				
			editor.focus();
			editor.fire( 'saveSnapshot' );
			oldins = words[posi];
	        
			if(CKEDITOR.env.gecko || CKEDITOR.env.opera || CKEDITOR.env.mac || CKEDITOR.env.webkit) {
				editor.getSelection().getStartElement().$.textContent = oldins;
			}else{
				editor.getSelection().getStartElement().$.innerText = oldins;
			}

			editor.fire( 'saveSnapshot' );  
			setVisible("hidden");
			posi = -1;
        }
	}
}

var mouseHandler=function()
{
	for (var i=0; i < words.length; ++i)
		setColor (i, "white", "black");
        
    this.style.background = "blue";
    this.style.color = "white";
}
     
var mouseHandlerOut=function()
{
    this.style.background = "white";
    this.style.color = "black";
}

var mouseClick=function()
{
	editor.focus();
	
    // Make undo snapshot.
    editor.fire( 'saveSnapshot' );
    oldins = this.firstChild.nodeValue;
    
	if(CKEDITOR.env.gecko || CKEDITOR.env.opera || CKEDITOR.env.mac || CKEDITOR.env.webkit) {
		editor.getSelection().getStartElement().$.textContent = oldins;
	}else{
		editor.getSelection().getStartElement().$.innerText = oldins;
	}

    editor.fire( 'saveSnapshot' );	   
    setVisible("hidden");
    posi = -1;
}

function setColor (_posi, _color, _forg)
{	
	if (_posi > -1 && _posi <= words.length-1)
	{
		cssOutput.childNodes[_posi].style.background = _color;
		cssOutput.childNodes[_posi].style.color      = _forg;
	}
}


/// ADD ADICO ADVICE
function getCharFromPos(position)
{
   var sWord = '';
   var endPos = setCursorPos(position);
   
   ///// CONDITION FOR IE/FF
   if(CKEDITOR.env.gecko || CKEDITOR.env.opera || CKEDITOR.env.mac || CKEDITOR.env.webkit) {
		var sText  = editor.document.$.body.textContent;
	}else{
		var sText  = editor.document.$.body.innerText;
	}
   
   while (endPos > 0)
   {
      var ch = sText.charAt( endPos );
      if (ch == ' ')
         break;
         
      sWord += ch;
      endPos--;
   }
         
   return sText.substring(endPos, 1+cursorPos.z);
}

function setCursorPos(position)
{
   if (!position)
      return;
    
	//alert(editor);
   var objRange  = editor.document.$.selection.createRange();
   
   var sOldRange = objRange.text;
   var sTempStr = '%$#'

   //insert the sTempStr where the cursorPos is at
   objRange.text = sOldRange + sTempStr; objRange.moveStart('character', (0 - sOldRange.length - sTempStr.length));

   //save off the new string with sTempStr
   var sNewText = editor.document.$.body.innerText;

   //set the actual text value back to how it was
   objRange.text = sOldRange;

   // locate sTempStr  and get its position
   for (var i=0; i <= sNewText.length; i++)
   {
      var sTemp = sNewText.substring(i, i + sTempStr.length);
      if (sTemp == sTempStr)
      {
         var curPos  = (i - sOldRange.length);
         return curPos-1;
      }   
   }
   return 0;
}

function trim(strText)  {   return strText.replace(/^\s+|\s+$/g,"");   }
function ltrim(strText) {   return strText.replace(/^\s+/,"");         }
function rtrim(strText) {   return strText.replace(/\s+$/,"");         }
