$(document).ready(function() {	

			
			/*
				Default icon
			*/
			//defa = document.styleSheets[0].cssRules[0].style.content.replace(/"/g,'');
			//$('<link id="favit" type="image/x-icon" rel="shortcut icon" href="'+ defa +'" />').appendTo('head');
			
			/* Ajax indicator animation */
			gulu = document.styleSheets[0].cssRules[1].style.content.replace(/"/g,'');

			setTimeout(function() {

					$(document).ajaxStart(function() {
					  $('#favit').remove();
					  $('<link id="favit" type="image/x-icon" rel="shortcut icon" href="'+ gulu +'" />').appendTo('head');

					});
					
					$(document).ajaxComplete(function() {
						setTimeout(function() {
							$('#favit').remove();
							////$('<link id="favit" type="image/x-icon" rel="shortcut icon" href="'+ defa +'" />').appendTo('head');
						},500);	
					});
					
					
					$(document).ajaxError(function(){
						$('#favit').remove();
					});
					
					
					
			},400);	
			
			
			
	/* TEST */

	$('<link id="favit" type="image/x-icon" rel="shortcut icon" href="'+ gulu +'" />').appendTo('head');	
			

}); // End 