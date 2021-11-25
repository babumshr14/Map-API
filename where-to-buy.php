<?php /* Template Name: Where To Buy */ ?>
<?php get_header(); ?>
<section class="wherToBuy may-80">

			<div class="container">

				<div class="row justify-content-center">

					<div class="col-12">

						<div class="hometitle text-center">

							<h1 class="sectitle text-black mat-0 mab-25"><?php echo get_field('heading');?></h1>

							<h4 class="secSmallTitle font-even-24 line-height-28 font-weight-500 mab-25"><?php echo get_field('sub_heading');?></h4>

						</div>

					</div>

					<div class="col-lg-8 col-xl-6 col-sm-10">

						<div class="sectionFormGroup withoutBg">

							<form action="<?php echo home_url( '/' );?>safes-dealer-list/" method="get" onsubmit="return false" id="theForm">

								<div class="input-group">

									<input type="text" class="form-control" list="postcodesuburb" placeholder="Please enter your postcode or suburb" id="pscode" name="pscode" autocomplete="off">

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
								<div class="alert alert-danger d-flex align-items-center mt-3" role="alert" id="alertmessage" style="display: none !important;">
									<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
									  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
									    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
									  </symbol>
									  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
									    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
									  </symbol>
									  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
									    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
									  </symbol>
									</svg>
									  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
									  <div>
									    Please enter a <strong>valid postcode </strong> or <strong>suburb</strong>
									  </div>
									</div>
							</form>

						</div>

					</div>

					<div class="col-12">

						<div class="hometitle text-center mat-50">

							<h4 class="secSmallTitle font-even-24 line-height-28 font-weight-500 mab-25">Or choose your state</h4>

						</div>

						<div class="stateListTab">

							<ul class="stLisTabs">

								<?php if( have_rows('state') ): ?>

						        <?php while( have_rows('state') ): the_row();?>
						        	<!-- <?php //echo home_url( '/' );?>safes-dealer-list/?statename=<?php //echo strtolower(get_sub_field('state'));?> -->

						        	<?php //echo get_sub_field('url');?>

								<li><a href="<?php echo get_sub_field('url');?>" title=""><?php echo get_sub_field('state');?></a></li>

								<?php endwhile; ?>

        						<?php endif; ?>

							</ul>	

						</div>

					</div>

				</div>

			</div>

		</section>



		<?php include 'consultation.php';?>

<?php get_footer(); ?>
<script type="text/javascript">
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