var onGetRiverStream =function(x){
 	
}

var refresh=function(){
	var thefeeds="";
$.ajax({
  url: 'http://pi.johnj.info/rivers/Edublogs.js',
  type: 'GET',
  jsonpCallback: 'onGetRiverStream',
contentType: "application/json",
dataType: 'jsonp',
complete: function(xhr, textStatus) {
   },
success: function(data, textStatus, xhr) {

for (var i = 0; i < data.updatedFeeds['updatedFeed'].length; i++) {

	var thisfeed=data.updatedFeeds['updatedFeed'][i];
	thefeeds=thefeeds+  "<h3><a href='"+thisfeed['websiteUrl']+"'><img src='http://www.google.com/s2/favicons?domain="+ thisfeed['websiteUrl'] +"'> "+thisfeed['feedTitle']+"</a><span>"+ thisfeed['whenLastUpdate']+"</span></h3>" ;
	
	$.each(thisfeed['item'], function(i, item) {
		var itemtitle= item['title'];
		var itemlink=item['link'];
	 var itembody=item['body'];
			thefeeds=thefeeds+"<h4><a target='new' href='"+itemlink+ "'>"+itemtitle +"</a></h4><p>"+itembody+"</p>";
			 
	 
	    
	});
	 
	
}
 $('#feeds').html(thefeeds);

  },
error: function(xhr, textStatus, errorThrown) {
	console.log(errorThrown);
  }
});


}

refresh();