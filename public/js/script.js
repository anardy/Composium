$('.dropdown-toggle').dropdown(); // botão dropdown do login


$(function () {
	$("#menu ul.nav").find('li a').on('click', function (event) {

		// If not start with #, stop here!
		if ($(this).attr('href')[0] !== '#') {
			return false;
		}

		$('html, body').stop().animate({ 
			scrollTop: $($(this).attr('href')).offset().top // fazer a animação com a scrool
		}, 700);
		event.preventDefault();
	});
	$("#timeline").timeline();

	$('#primeirodia').click(function(e) {
		e.preventDefault();
		carregapagina('primeirodia');
	});

	$('#segundodia').click(function(e) {
		e.preventDefault();
		carregapagina('segundodia');
	});
	$('#terceirodia').click(function(e) {
		e.preventDefault();
		carregapagina('terceirodia');
	});
});

function carregapagina(id) {
	$.ajax({
		url: BASE+'/'+id+'Programacao',
		type: 'GET',
		beforeSend: function() {
			$('#contentprogram').hide();
			$('#carregando').show();
	  	},
	  	complete: function() {
			$('#carregando').hide();
	  	},
	  	success: function(data) {
			$('#contentprogram').show();
			$('#contentprogram').html(data);
	  	}
	});
}

function initialize() {
	var mapProp = {
		center:new google.maps.LatLng(-22.413979,-45.45037),
		zoom:12,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var marker=new google.maps.Marker({
		position:mapProp.center
	});
	marker.setMap(map);

	google.maps.event.addListener(marker,'click',function() {
  		map.setZoom(16);
  		map.setCenter(marker.getPosition());
  	});
}

google.maps.event.addDomListener(window, 'load', initialize);

