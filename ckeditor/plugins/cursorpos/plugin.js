var cursorPos = {x:0, y:0, z:0, keydown:false};


// plugin to get the cursor position

CKEDITOR.plugins.add( 'cursorpos',
{
    beforeInit : function( editor )
    {
        init();		

        editor.on( 'contentDom', function(ev)
        { 
			// keyup
            this.document.on( 'keyup', function(ev) 
            {
				if (!ev)
					return;
					            
				var dummyElement = editor.document.createElement( 'img',
				{
				    attributes :
				    {
				        src : 'null',
				        width : 0,
				        height : 0
				    }
				});

				editor.insertElement( dummyElement );

				var obj = dummyElement.$;

				cursorPos.x  = 0;
				cursorPos.y  = 0;
				cursorPos.keydown = false;
				
				while (obj.offsetParent)
				{
				    cursorPos.x += obj.offsetLeft;
				    cursorPos.y += obj.offsetTop;
				    obj = obj.offsetParent;
				}
				
				cursorPos.x += obj.offsetLeft;
				cursorPos.y += obj.offsetTop;
				cursorPos.keydown = true;
				cursorPos.z  = getCursorPosition(editor);
				
				keyHandler(ev.data.getKeystroke(), editor);
				
				window.parent.document.title = "top: " + cursorPos.y + ", left: " + cursorPos.x + ", ZZ :"+cursorPos.z + " "+ getCharFromPos(cursorPos.z-1);
				dummyElement.remove();				
            });
       });	
    }
});

// Returns cursor caret Position  the editor
function getCursorPosition(editor)
{
   if (editor.document)
      return Math.abs(editor.document.$.selection.createRange().moveStart('character',-1000000));
	  				
   return -1;
}
