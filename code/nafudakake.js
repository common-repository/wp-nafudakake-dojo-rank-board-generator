/* super thanks to Ali Farhadi for creating a great, minimal drag-and-drop library! http://farhadi.ir/projects/html5sortable/
	*/
		$(function() {
			$('.sortable').sortable();
			$('.connected').sortable({
				connectWith: '.connected'
			});
		});
		   /*
jQuery.fn.addBack = jQuery.fn.andSelf;*/
			
		/* ------------------------------------------------------- */
		/* Add Slat */
		/* ------------------------------------------------------- */
		function nafu_addSlat(newsize, newwidth, newspacing, newfontsize) {
			var sname = document.getElementById("newslat").value;
			var stype = document.getElementById("slattype").value;
			
			sname=sname.replace(/ /g, "&nbsp;");
			
			$("#slatrow1").append('<li draggable="true" class="'+stype+' nafu_orientation" style="display: inline-block">'+sname+'</li>');
			
			// force all ULs and their children to be connected again
				/*$('.sortable').sortable(); */
				$('.sortable').sortable('enable');
				$('#slatrow1, #slatrow2, #slatrow3, #slatrow4, #slatrow5').sortable({
					connectWith: '.connected'
				});
			document.getElementById("newslat").value = "";
			nafu_reApplySettingsEditor(newsize, newwidth, newspacing, newfontsize);
		}
	
		  
		function nafu_emptyBin() {
			var sbin = document.getElementById("slatbin");
			sbin.innerHTML="";
		}
		
		function nafu_reRow() {
			var rcount = document.getElementById("rowcount").value;
			
			// for 5 down to rcount, check if empty, alert if not
			for (i = 5; i>rcount; i--) {
					mylen= $("#slatrow"+i+" li").length;
					if (mylen>0) {
						alert("Error - Row "+i+" is not empty.  Please remove all slats from that row before removing the row.");
						break;
					}
					else {
						// hide this row
						var rowid="#nrow"+i;
						$(rowid).hide();
					}
			}
			
			for (i=rcount; i>1; i--) {
				// show this row
						var rowid="#nrow"+i;
						$(rowid).show();
			} 
				nafu_reHeight();
		}
		
		/* ------------------------------------------------------- */
		/* Reapply Settings */
		/* ------------------------------------------------------- */

		function nafu_reApplySettingsEditor(newsize, newwidth, newspacing, newfontsize)  {
			$('.nameslat').height(newsize); 	
			$('.mudansha').height(newsize); 	
			$('.yudansha').height(newsize); 	
			
			newsize=newsize+34;
			$('#nrow1').height(newsize); 	
			$('#nrow2').height(newsize); 	
			$('#nrow3').height(newsize); 	
			$('#nrow4').height(newsize); 	
			$('#nrow5').height(newsize); 	
			
			$('.nameslat').width(newwidth); 	
			$('.mudansha').width(newwidth); 	
			$('.yudansha').width(newwidth); 	
						 
			var mar = newspacing+"px";
			//$('.nameslat').css('margin-right', mar); 
			//$('.mudansha').css('margin-right', mar); 
			//$('.yudansha').css('margin-right', mar); 
			
			if (newfontsize >0)
			{
				$('.nameslat').css('font-size', newfontsize+"em");
				$('.mudansha').css('font-size', newfontsize+"em");
				$('.yudansha').css('font-size', newfontsize+"em");
			}
		}	 
		 
		 
		function nafu_reApplySettingsLive(newsize, newwidth, newspacing, newfontsize, orientation) { 
			
			if (orientation!="Vertical") {
				$('.nafu_orientation').height(newsize); 
				$('.nafu_orientation').width(newwidth); 	
				//$('.rank_board_slat').css('margin-right', "-1px"); 
			}
			else
			{
				$('.nafu_orientation').height(newwidth); 
				$('.nafu_orientation').width(newsize); 	
				//$('.rank_board_slat').css('margin-top', "-1px"); 
			}
			
			
			if (newfontsize >0)
			{
				$('.nafu_orientation').css('font-size', (newfontsize*.9)+"em");
				$('.nafu_orientation').css('line-height', (newfontsize*.8)+"em");
			}
		}
		
		
		/* ------------------------------------------------------- */
		/* Save settings */
		/* ------------------------------------------------------- */
		
		function nafu_hasClass(element, cls) {
			return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
		}
 
	 