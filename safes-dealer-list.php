<?php /* Template Name: State Safes Dealer List */ ?>

<?php get_header(); ?>
 <script src='http://maps.googleapis.com/maps/api/js?v=3&sensor=false&amp;libraries=places&key=AIzaSyC4VnwVcwAXzHOrNkUPBBIaCRYenI-sjXk'></script>


<section class="wherToBuy may-80">

			<div class="container">

				<div class="row justify-content-center">

					<div class="col-12">

						<div class="hometitle text-center">

							<h1 class="sectitle text-black mat-0 mab-25"><?php echo get_field('heading',1265);?></h1>

							<h4 class="secSmallTitle font-even-24 line-height-28 font-weight-500 mab-25"><?php echo get_field('sub_heading',1265);?></h4>

						</div>

					</div>

					<div class="col-lg-8 col-xl-6 col-sm-10">

						<div class="sectionFormGroup withoutBg">

							<form action="<?php echo home_url( '/' );?>safes-dealer-list/" method="get">

								<div class="input-group">

									<input type="text" class="form-control" list="postcodesuburb" placeholder="Please enter your postcode or suburb" id="pscode" name="pscode" autocomplete="off" value="<?php echo $_GET["pscode"];?>">

								   <datalist id="postcodesuburb">
									<?php 
									$ps=$wpdb->get_results("SELECT * FROM suburbspostcode WHERE action ='Y'");
									?>
									<?php
									foreach($ps as $showdealer){
									?>
								    <option value="<?php echo $showdealer->name;?>, <?php echo $showdealer->state_code;?>, <?php echo $showdealer->postcode;?>">
								    <?php } ?>
									</datalist>

									<button type="submit" class="btn" onclick="doValidate();">Send</button>

								</div>

							</form>

						</div>

					</div>
				</div>

			</div>



		</section>

<?php

if (isset($_GET["pscode"])) {

$pscode=$_GET["pscode"];

global $wpdb;

$table = $wpdb->prefix."dealer"; 
//Get Lat Long
//$latlon = $wpdb->get_row("SELECT * FROM $table WHERE postcode='$pscode' OR suburb='$pscode' AND action ='Y'");

//$caddresslat=$latlon->lat;
//$caddresslon=$latlon->lon;
//Post code to lat long
$apiKey="AIzaSyC4VnwVcwAXzHOrNkUPBBIaCRYenI-sjXk";
$daddress = $pscode;
$url = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($daddress).'&sensor=false&key='.$apiKey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$responseJson = curl_exec($ch);
curl_close($ch);

$response = json_decode($responseJson);

if ($response->status == 'OK') {
  $tlatitude = $response->results[0]->geometry->location->lat;
  $tlongitude = $response->results[0]->geometry->location->lng;
}
$caddresslat= $tlatitude;
$caddresslon=$tlongitude;
//Post code to lat long
//echo "SELECT * FROM $table WHERE postcode='$pscode' OR suburb='$pscode' AND action ='Y'";

//$result = $wpdb->get_results("SELECT * FROM $table WHERE postcode='$pscode' OR suburb='$pscode' AND action ='Y'");
//$result = $wpdb->get_results("SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN(( $caddresslat - lat) * pi()/180 / 2), 2) +COS( $caddresslat * pi()/180) * COS(lat * pi()/180) * POWER(SIN(( $caddresslon - lon) * pi()/180 / 2), 2) ))) as distance from wp_dominat_dealer having distance <= 50 order by distance");
//echo "SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN(( $caddresslat - lat) * pi()/180 / 2), 2) +COS( $caddresslat * pi()/180) * COS(lat * pi()/180) * POWER(SIN(( $caddresslon - lon) * pi()/180 / 2), 2) ))) as distance from wp_dominat_dealer having distance <= 50 order by rand()";
$result = $wpdb->get_results("SELECT * , (3956 * 2 * ASIN(SQRT( POWER(SIN(( $caddresslat - lat) * pi()/180 / 2), 2) +COS( $caddresslat * pi()/180) * COS(lat * pi()/180) * POWER(SIN(( $caddresslon - lon) * pi()/180 / 2), 2) ))) as distance from wp_dominat_dealer having distance <= 50 AND action ='Y' order by distance ASC");

}else{

$statename=$_GET['statename'];

global $wpdb;

$table = $wpdb->prefix."dealer"; 

//echo "SELECT * FROM $table WHERE state='$statename' AND action ='Y'";

$result = $wpdb->get_results("SELECT * FROM $table WHERE state='$statename' AND action ='Y' order by rand()");

}

//     global $wpdb;

//             $table = $wpdb->prefix."dealer"; 

// $result = $wpdb->get_results("SELECT * FROM $table WHERE action ='Y'");

// foreach($result as $showdealer){

?>

		<section class="locationMap may-80" id="loadContent">

			<!-- <div id="map-canvas" style="width: 100%; height: 450px; margin-top: 40px; display: none;"></div>
			<div id="map" style="width: 100%; height: 450px; margin-top: 40px;"></div> -->
			<?php 	if(!empty($result)) { ?>
					<div class="lomMap">
						<div class="mapLoader animated-background Conloader">
							<img src="<?php echo get_bloginfo('template_directory'); ?>/images/map-loader.svg" alt="">
						</div>
						<?php
							if(!empty($result)) {
							?>
						<div id="map-canvas" style="width: 100%; height: 820px;"></div>
						<?php } ?>
					</div>
		<?php } ?>
			<div class="dealerList">
				<div class="container">
					<div class="row justify-content-end">
						<?php 	if(!empty($result)) { ?>
						<div class="col-sm-6 col-lg-5 col-xl-5 position-relative">
							<div class="carcontentLoader Conloader">
								<div class="animated-background imagestyle mab-30">
									<img src="<?php echo get_bloginfo('template_directory'); ?>/images/content-loader.svg" class="img-fluid" alt="" />
								</div>
								<div class="animated-background imagestyle mab-30">
									<img src="<?php echo get_bloginfo('template_directory'); ?>/images/content-loader.svg" class="img-fluid" alt="" />
								</div>
								<div class="animated-background imagestyle">
									<img src="<?php echo get_bloginfo('template_directory'); ?>/images/content-loader.svg" class="img-fluid" alt="" />
								</div>
							</div>
							<div class="locationpost-vertical" id="dealerCarousel12">
								<?php
								// Search Address to lat long Find
 										$apiKey="AIzaSyC4VnwVcwAXzHOrNkUPBBIaCRYenI-sjXk";
 										//Address to lat long
										$saddress = $_GET['pscode'];
										$surl = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($saddress).'&sensor=false&key='.$apiKey;
										$ch = curl_init();
										curl_setopt($ch, CURLOPT_URL, $surl);
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
										$sresponseJson = curl_exec($ch);
										curl_close($ch);

										$sresponse = json_decode($sresponseJson);
										//print_r($sresponse);
										if ($sresponse->status == 'OK') {
										    $flatitude = $sresponse->results[0]->geometry->location->lat.'<br>';
										    $flongitude = $sresponse->results[0]->geometry->location->lng.'<br>';
										}
										$latitudeFrom = $flatitude;
										$longitudeFrom = $flongitude;
										//Search address to lat long
								foreach($result as $showdealer){
								?>
								<div class="items">
									<div class="dealerDtls">
										<h4 class="dealerShopTitle font-even-24 font-weight-700 mab-15"><a href="<?php echo home_url( '/' );?>state-safes-dealer/?id=<?php echo $showdealer->id ; ?>" class="text-themecolor"><?php echo $showdealer->title ; ?></a></h4>
										<div class="delearDtlsInner">

											<div class="dealershopImg">

												<img src="<?php echo plugins_url();?>/dealerlist/delarimage/<?php echo $showdealer->image ; ?>" class="img-fluid" alt="" />

											</div>

											<div class="dealerShopConten">

												<p class="delearadd"><?php echo $showdealer->streetname ; ?></p>

												<p class="delearadd"><?php echo $showdealer->suburb ; ?> <?php echo $showdealer->state ; ?> <?php echo $showdealer->postcode ; ?></p>

												<p class="contactNo">P: <a href="tel:<?php echo $showdealer->phone ; ?>"><?php echo $showdealer->phone ; ?></a></p>

												<p><a href="mailto:<?php echo $showdealer->email ; ?>"><?php echo $showdealer->email ; ?></a></p>

												<div class="dealerIconCarousel">

													<?php

													$icon1=$showdealer->frs;

													$icon2=$showdealer->ifs;

													$icon3=$showdealer->hs;

													$icon4=$showdealer->ds;

													$icon5=$showdealer->cs;

													$icon6=$showdealer->fs;

													$icon7=$showdealer->des;

													$icon7=$showdealer->slop;

													?>

													<?php if($icon1 !=""){ ?>

													<span><a href="<?php echo home_url( '/' );?>product-category/?category=NDc=" title="" class="toolinfoBtn"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/shopstore/shop-icon1.svg" class="img-fluid" alt=""><span class="tooltipTxt">Fire resistant safes</span></a></span>

													<?php } ?>

													<?php if($icon2 !=""){ ?>

													<span><a href="<?php echo home_url( '/' );?>product-category/?category=NDk=" title="" class="toolinfoBtn"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/shopstore/shop-icon2.svg" class="img-fluid" alt=""><span class="tooltipTxt">Home safes</span></a></span>

													<?php } ?>

													<?php if($icon3 !=""){ ?>

													<span><a href="<?php echo home_url( '/' );?>product-category/?category=NTM=" title="" class="toolinfoBtn"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/shopstore/shop-icon3.svg" class="img-fluid" alt=""><span class="tooltipTxt">Deposit safes</span></a></span>

													<?php } ?>

													<?php if($icon4 !=""){ ?>

													<span><a href="<?php echo home_url( '/' );?>product-category/?category=NTI=" title="" class="toolinfoBtn"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/shopstore/shop-icon4.svg" class="img-fluid" alt=""><span class="tooltipTxt">Firearm safes</span></a></span>

													<?php } ?>

													<?php if($icon5 !=""){ ?>

													<span><a href="<?php echo home_url( '/' );?>product-category/?category=NTQ=" title="" class="toolinfoBtn"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/shopstore/shop-icon5.svg" class="img-fluid" alt=""><span class="tooltipTxt">Safe locks and other products</span></a></span>

													<?php } ?>

													<?php if($icon6 !=""){ ?>

													<span><a href="<?php echo home_url( '/' );?>product-category/?category=NDg=" title="" class="toolinfoBtn"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/shopstore/shop-icon6.svg" class="img-fluid" alt=""><span class="tooltipTxt">In floor safes</span></a></span>

													<?php } ?>

													<?php if($icon7 !=""){ ?>

													<span><a href="<?php echo home_url( '/' );?>product-category/?category=NTA=" title="" class="toolinfoBtn"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/shopstore/shop-icon7.svg" class="img-fluid" alt=""><span class="tooltipTxt">Drug/Pharmacy safes</span></a></span>

													<?php } ?>

													<?php if($icon8 !=""){ ?>

													<span><a href="<?php echo home_url( '/' );?>product-category/?category=NTE=" title="" class="toolinfoBtn"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/shopstore/shop-icon8.svg" class="img-fluid" alt=""><span class="tooltipTxt">Commercial safes</span></a></span>

													<?php } ?>

												</div>

											</div>

										</div>
										<?php
										$latitudeTo = $showdealer->lat;
										$longitudeTo = $showdealer->lon;

										//Calculate distance from latitude and longitude
										$theta = $longitudeFrom - $longitudeTo;
										$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
										$dist = acos($dist);
										$dist = rad2deg($dist);
										$miles = $dist * 60 * 1.1515;

										$distance = ($miles * 1.609345);
										$distance1 = round($distance).' km';
										?>
										 <span class="locationDistance"><?php echo $distance1; ?> away from you</span>

									</div>

								</div>

							<?php }  ?>

							</div>

						</div>
					<?php }else{ ?>
						<div class="hometitle text-center">

							<h1 class="sectitle mat-0 mab-25" style="color: #D6D6D9;">No Data found...</h1>

						</div>
					<?php } ?>
					</div>

				</div>
			</div>
		</section>

<style>
	.locationpost-vertical {
		max-height: 820px;
		min-height: 820px;
		height: 100%;
		overflow-y: auto;
		overflow-x: hidden;
	}
</style>

		<div class="clearfix"></div>

		<?php include 'consultation.php';?>

<?php get_footer(); ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    var locations = [
    <?php 
     global $wpdb;
            //$table = $wpdb->prefix."dealer"; 
	//$result = $wpdb->get_results("SELECT * FROM $table WHERE action ='Y'");
	//foreach($result as $showdealer){
	foreach($result as $showdealer){
		$addresss=$showdealer->streetname.' '.$showdealer->suburb.' '.$showdealer->state.' '.$showdealer->postcode.' <br><b>P:</b>'.$showdealer->phone.' <br>'.$showdealer->email;
	    ?>
	      ['<b><?php echo $showdealer->title;?></b>', '<?php echo $addresss ; ?>'],
	      <?php } ?>
	    ];

	    var map = new google.maps.Map(document.getElementById('map-canvas'), {
	      zoom: 10,
	      center: new google.maps.LatLng(25.2744, 133.7751),
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    });

	    var infowindow = new google.maps.InfoWindow();
	    var geocoder = new google.maps.Geocoder();

	    var marker, i;
	    if (locations != '') {
		    for (i = 0; i < locations.length; i++) {
		      geocodeAddress(locations[i]);
		    }
	    }
	function geocodeAddress(location) {
	  geocoder.geocode( { 'address': location[1]}, function(results, status) {
	  //alert(status);
	    if (status == google.maps.GeocoderStatus.OK) {

	      //alert(results[0].geometry.location);
	      map.setCenter(results[0].geometry.location);
	      createMarker(results[0].geometry.location,location[0]+"<br>"+location[1]);
	    }
	    else
	    {
	     // alert("some problem in geocode" + status);
	    }
	  }); 
	}
	//For Distance

	//For Distance
	function createMarker(latlng,html){
		var iconBase = '<?php echo get_bloginfo('template_directory'); ?>/images/';
	  var marker = new google.maps.Marker({
	    position: latlng,
	    map: map,
	    icon: iconBase + 'марmarкuр.svg'
	  }); 

	  google.maps.event.addListener(marker, 'mouseover', function() { 
	    infowindow.setContent(html);
	    infowindow.open(map, marker);
	  });
			
	  google.maps.event.addListener(marker, 'mouseout', function() { 
	    infowindow.close();
	  });
	}
	//Address Auto Field from google
var input    = document.querySelector("#pscode"), // Selects the input.
    datalist = document.querySelector("datalist"); // Selects the datalist.

// Adds a keyup listener on the input.
input.addEventListener("keyup", (e) => {

    // If input value is larger or equal than 2 chars, adding "users" on ID attribute.
    if (e.target.value.length >= 2) {
        datalist.setAttribute("id", "postcodesuburb");
    } else {
        datalist.setAttribute("id", "");
    }
    $('#alertmessage').attr("style", "display: none !important");
});

// I had to include your doValidate() function otherwise I would get an error while validaing.
//function doValidate() {};

//Validation
function is_valid_datalist_value(idDataList, inputValue) {
  var option = document.querySelector("#" + idDataList + " option[value='" + inputValue + "']");
  if (option != null) {
    return option.value.length > 0;
  }
  return false;
}

function doValidate() {
  if (is_valid_datalist_value('postcodesuburb', document.getElementById('pscode').value)) {
    //alert("Valid");
    //form.submit();
    document.getElementById("theForm").submit();
  } else {
    //alert("Invalid");
    $("#alertmessage").show();
  }
}
</script>
