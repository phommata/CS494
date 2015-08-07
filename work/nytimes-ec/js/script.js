
function loadData() {
    var $nytHeaderElem = $('#nytimes-header');
    var $nytElem = $('#nytimes-articles');

    // clear out old data before new request
    $nytElem.text("");

	var searchTerm  = $('#searchTerm').val();
	
	if ($('#datepicker1').val() == (null || "")) {
		var datepicker1 = "18510918"
	} else {
		var datepicker1 = $('#datepicker1').val();}

	if ($('#datepicker2').val() == (null || "")) {
		// Reference: http://www.sitepoint.com/jquery-todays-date-ddmmyyyy/
		
		var fullDate = new Date()
		console.log(fullDate);
		// Thu Dec 25 2014 10:23:48 GMT-0800 (PST)
		
		// +1m to fix -1m bug in getMonth()
		var currentDate = fullDate.getFullYear() + "" + (fullDate.getMonth() + 1) + "" + fullDate.getDate();
		console.log("currentDate " + currentDate);
		// 20110519
	
		var datepicker2 = currentDate;
		console.log("datepicker2 " + datepicker2);
	} else {
		var datepicker2 = $('#datepicker2').val();}
	
	// Your NYTimes AJAX request goes here	
	var nytimesUrl = 'http://api.nytimes.com/svc/search/v2/articlesearch.jsonp?q=' + searchTerm + '&begin_date='+ datepicker1 +'&end_date=' + datepicker2 +'&sort=newest&callback=svc_search_v2_articlesearch&api-key=325bbc4756a5a36f1b78ecf10e0cf06a:11:70556396';
	console.log("nytimesUrl" + nytimesUrl);
	
	// jsonp does not have a error handling built-in, because of the technical limitations of what's happening behind the scenes. So we create a workaround here. Timeout message executes in 8s on both error & success. Use clearTimeout() function to clear/stop this function on success.
	var nytRequestTimeout = setTimeout(function(){
		$nytHeaderElem.text("Failed to get NY Times resources");
	}, 8000);
	
	// Can submit URL as string before the settings object, instead of an URL parameter of the settings object
	// $.ajax(wikiUrl, {
	$.ajax({
		url: nytimesUrl,
		dataType: "jsonp",
		// jsonp: "callback", // redundant: by default jsonp sets callback function name (in this case jsonp) to callback 
		jsonpCallback: 'svc_search_v2_articlesearch',
		success: function( data ) {		
		  console.log(data);
		  
		  $nytHeaderElem.text('Articles on "' + searchTerm + '"');
		  
		  articles = data.response.docs;
		  for (var i = 0; i < articles.length; i++) {
			  var article = articles[i];
			  $nytElem.append('<li class="article">' + 
				  '<a href="' + article.web_url +'">' + article.headline.main + '</a>' + 
				  '<p>' + article.snippet + '</p>' + 
				  '</li>');
		  };
			
			// will clear/stop timeout from happening on success
			clearTimeout(nytRequestTimeout);
		}
	});
		
    return false;
};

$('#form-container').submit(loadData);

// loadData();
