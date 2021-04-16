
        function getCurrLocation()
		{
			//str_job_id = str;
			navigator.geolocation.getCurrentPosition(foundLocation, noLocation);

		}

		function foundLocation(position)
		{ 
			  var lat = position.coords.latitude;
			 var lang = position.coords.longitude; 
			$('#lat').val(lat);
			$('#lang').val(lang);
		}
		function noLocation() 
		{
			//swal('Location Mandatory' , 'Please enable your location into your device settings area.' , 'error');
			//document.getElementById("location").style.display = "block"; 
		}
		
//get address from lat and long
