<?php /* Template Name: State Safes Dealer */ ?>

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

									<input type="tel" class="form-control" placeholder="Please enter your postcode" id="pscode" name="pscode" value="<?php echo $_GET["pscode"];?>" autocomplete="off">
									<button type="submit" class="btn">Send</button>

								</div>

							</form>

						</div>

					</div>

					<!-- <div class="col-12">

						<div class="hometitle text-center mat-50">

							<h4 class="secSmallTitle font-even-24 line-height-28 font-weight-500 mab-25">Or choose your state</h4>

						</div>

						<div class="stateListTab">

							<ul class="stLisTabs">

								<?php if( have_rows('state',1265) ): ?>

						        <?php while( have_rows('state',1265) ): the_row();?>

								<li><a href="<?php echo get_sub_field('url',1265);?>" title=""><?php echo get_sub_field('state',1265);?></a></li>

								<?php endwhile; ?>

        						<?php endif; ?>

							</ul>	

						</div>

					</div> -->

				</div>

			</div>



		</section>

<?php

global $wpdb;

$id=$_GET["id"];

$table = $wpdb->prefix."dealer"; 

$result = $wpdb->get_row("SELECT * FROM $table WHERE id='$id' AND action ='Y'");

?>

		<section class="locationMap may-80">

		<div class="lomMap">
			<div id="map-canvas" style="width: 100%; height: 600px;"></div>
				<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6781.771464202434!2d115.839653!3d-31.800864!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2a32ad9007dd981b%3A0x3ada7cfeb1af8957!2s2%2F115%20Excellence%20Dr%2C%20Wangara%20WA%206065!5e0!3m2!1sen!2sau!4v1619005427023!5m2!1sen!2sau" width="100%" height="630" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->

			</div>

			<div class="dealerList">

				<div class="container">

					<div class="row justify-content-end">

						<div class="col-sm-6 col-lg-5 col-xl-5">

							<div class="SingledealerDtls">

								

								<div class="delearDtlsInner">

									<div class="dealershopImg">

										<img src="<?php echo plugins_url();?>/dealerlist/delarimage/<?php echo $result->image ; ?>" class="img-fluid" alt="" />

									</div>

									<div class="dealerShopConten">

										<h4 class="dealerShopTitle font-even-24 font-weight-700 may-20"><?php echo $result->title ; ?></h4>

										<p class="delearadd"><?php echo $result->streetname ; ?></p>

										<p class="delearadd"><?php echo $result->suburb ; ?> <?php echo $result->state ; ?> <?php echo $result->postcode ; ?></p>

										<p class="contactNo">P: <a href="tel:<?php echo $result->phone ; ?>"><?php echo $result->phone ; ?></a></p>

										<p><a href="mailto:<?php echo $result->email ; ?>"><?php echo $result->email ; ?></a></p>

									</div>

								</div>

								<?php

								$icon1=$result->frs;

								$icon2=$result->ifs;

								$icon3=$result->hs;

								$icon4=$result->ds;

								$icon5=$result->cs;

								$icon6=$result->fs;

								$icon7=$result->des;

								$icon7=$result->slop;

								?>

								<div class="dealerIcon mat-30">

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

						</div>

					</div>

				</div>

				

			</div>

		</section>

		<div class="clearfix"></div>

		<?php include 'consultation.php';?>

<?php get_footer(); ?>
<?php
// Address to lat long Find
$apiKey="AIzaSyC4VnwVcwAXzHOrNkUPBBIaCRYenI-sjXk";
$daddress = $result->streetname.' '.$result->suburb.' '.$result->state.' '.$result->postcode;
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
$latitudeFrom = $tlatitude;
$longitudeFrom = $tlongitude;
?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    var locations = [
    <?php 
     global $wpdb;

	$addresss=$result->address.' '.$result->suburb.' '.$result->state.' '.$result->postcode.' <br><b>P:</b>'.$result->phone.' <br>'.$result->email;
    ?>
      ['<b><?php echo $result->title;?></b>', '<?php echo $addresss ; ?>'],
    ];

    var map = new google.maps.Map(document.getElementById('map-canvas'), {
      zoom: 10,
      //center: new google.maps.LatLng(-33.8688, 151.2195),
      center: new google.maps.LatLng(<?php echo $latitudeFrom; ?>, <?php echo $longitudeFrom; ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();
    var geocoder = new google.maps.Geocoder();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
      geocodeAddress(locations[i]);
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

var searchInput = 'pscode';
    
        $(document).ready(function () {
            var autocomplete;
            autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
                types: ['geocode'],
                componentRestrictions: {country: 'au'}
               
            });
        
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var near_place = autocomplete.getPlace();
            });
        });
</script>