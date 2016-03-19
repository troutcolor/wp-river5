var thefeedHTML = function(feedjson, tgt) {

	var thefeeds = "";
	jQuery.ajax({
		url: feedjson,
		type: 'GET',
		jsonpCallback: 'onGetRiverStream',
		contentType: "application/json",
		dataType: 'jsonp',
		complete: function(xhr, textStatus) {},
		success: function(data, textStatus, xhr) {

			for (var i = 0; i < data.updatedFeeds['updatedFeed'].length; i++) {

				var thisfeed = data.updatedFeeds['updatedFeed'][i];
				thefeeds = thefeeds + "<h4><a href='" + thisfeed['websiteUrl'] + "'><img src='http://www.google.com/s2/favicons?domain=" + thisfeed['websiteUrl'] + "'> " + thisfeed['feedTitle'] + "</a><span>" + thisfeed['whenLastUpdate'] + "</span></h4>";

				jQuery.each(thisfeed['item'], function(i, item) {
					var itemtitle = item['title'];
					var itemlink = item['link'];
					var itembody = item['body'];
					thefeeds = thefeeds + "<h5><a target='new' href='" + itemlink + "'>" + itemtitle + "</a></h5><p>" + itembody + "</p>";

				});
			}
			tgt.html(thefeeds);
		},
		error: function(xhr, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	});
	return (thefeeds);
}

jQuery(document).ready(function() {
	// Stuff to do as soon as the DOM is ready;

	jQuery('.river5feed').each(function(index) {

		var thejsonurl = jQuery(this).attr('data-river5');
		var d = thefeedHTML(thejsonurl, jQuery(this));


	});
});
