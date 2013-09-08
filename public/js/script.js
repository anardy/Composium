$(function () {

	$("#menu").find('a').on('click', function (event) {
		var $this = $(this),
			$htmlBody = $('html, body'),
			linkTarget = $this.attr('href'),
			offSetTop;

		// If not start with #, stop here!
		if (linkTarget[0] !== '#') {
			return false;
		}

		event.preventDefault();

		offSetTop = $(linkTarget).offset().top;

		$htmlBody.stop().animate({ scrollTop: offSetTop }, function () {
			location.hash = linkTarget;
        });
	});
});

function initialize() {
	var mapProp = {
		center:new google.maps.LatLng(-22.413979,-45.45037),
		zoom:15,
		scrollwheel: false,
        streetViewControl: true,
        labels: true,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var marker=new google.maps.Marker({
		position:mapProp.center
	});
	marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);