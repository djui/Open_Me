/* 
	Use with phantomjs 
*/

var page = require('webpage').create(),
    system = require('system');
	
	
//page.load-images = false;
	
page.onInitialized = function () {
	
	page.settings.userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0';
	window.navigator.language = 'en-US';
	window.navigator.buildID = "20130116073211";
	window.navigator.appVersion = '5.0 (Windows)';
	window.navigator.vendor = "";
	window.navigator.platform = "Win32";
};

//--load-images=false
//console.log( system.args[1] );
//phantom.exit();


page.viewportSize = {
	width:  1263,
	height: 634
};
	
page.onLoadFinished = function (status) {
		//page.render('re2.png');
};

page.onConsoleMessage = function (msg, line, source) {
     console.log( msg ) ;
};

page.open( 'https://maps.google.com/?q=' + system.args[1] + '&hl=en&lr=lang_en', function (status) {
		
		if (status == 'success') {
			page.injectJs('jquery.js');
			if(!phantom.state){
					initialize();
				} else {
				phantom.state();
			}
		}	

		//once page loaded, include jQuery from cdn
		page.includeJs("jquery.js")

});



function initialize() {	

	var asd = page.evaluate(function(){
				
			dsa = {};

			dsa['nazwa'] = $('#panel_A_2 #link_A_2 span span').text();
			dsa['adres'] = $('#panel_A_2 .pp-headline-address span').html();
			dsa['telefon'] = $('.telephone nobr').html();
			dsa['url'] = $('#panel_A_2 a span').html();
			dsa['rel_url'] = $('#panel_A_2 a').attr('href');

			console.log(JSON.stringify(dsa, null));
	
	});

	screen.pixelDepth = 24;
	
	//page.render('res.png');
	phantom.exit();


}






