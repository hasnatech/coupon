<html>

<head>
	<meta charset="utf-8">
	<title>Welcome to Coupon</title>
	<meta name='viewport' 
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0, 
     user-scalable=0' >
	<link rel="stylesheet" href="<?php echo base_url('/assets/css/style.css') ?>">
    <!-- <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo base_url('/assets/js/jquery-3.2.1.min.js') ?>"></script> -->
	<!-- <script src="<?php echo base_url('/assets/js/wScratchPad.min.js') ?>"></script> -->
</head>

<body>
	<div class="grid">
		<div class="panel">
			<div class="logo">
				<img src="<?php echo base_url('/assets/images/logo.png') ?>" alt="Danfoss Logo">
			</div>

			<?php if($this->session->flashdata('error')){ ?>
			<div class="alert-danger">
				<?php echo $this->session->flashdata('error'); ?>
			</div>
			<?php } ?>

			<div class="center">
				<h3 class="uppercase m-0 mt-20">Scratch to reveal your prize</h3>
                <p class='instr m-0'>Scratch it with touch or mouse</p>
                <p class="mt-20">Coupon: <?php echo $result->region . "-" . $result->code ;?>
			</div>
            <div>
                <div class="scratch-container">
                    <div id="promo" class="scratchpad"></div>
                </div>
                <div class="promo-container" style="display:none;">
                    <div class="promo-code"></div>
                    <a href="" target="_blank" class="btn">Register Now</a>
                </div>
            </div>
            <div>
                <p class="uppercase max-width screenshot">Please go to the counter of your distributor with 
                    this screen shot to receive your price*</p>
                                
                <p class="uppercase max-width subscribe">Subscribe to Danfoss Newsletter 
                for a second chance to win</p>

                <div class="center">
				    <button class="red-button">Subscribe</button>
                </div>
                
                <p class="max-width">Click <a href="https://www.danfoss.fr/fr-fr/service-and-support/fix-and-troubleshooting/cooling-support-for-wholesalers-and-installers/reddays-reglement/">here</a> to read game rules</p>
                <!-- <?php print_r($result->price_text[0]->name); ?> -->
            </div>
		</div>
	</div>
    
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://jennamolby.com/scratch-and-win/js/wScratchPad.min.js"></script>
	<script type="text/javascript">
		$().ready(function () {
			var promoCode = '';
			//var bg1 = "<?php echo base_url('/assets/images/400.png'); ?>";
			//var bg2 = "<?php echo base_url('/assets/images/sorry.png') ?>";
			//var bgArray = [bg1, bg2, bg3],
            var selectBG;
            var promoCode = '';

            <?php if($result->price_text[0]->name == "Polo T Shirt"){ ?> 
                selectBG ="<?php echo base_url('/assets/images/tshirt.png'); ?>";
                //promoCode = 'SCRATCH500';
            <?php } else { ?>
                selectBG ="<?php echo base_url('/assets/images/sorry.png'); ?>";
            <?php } ?>

            //selectBG = bgArray[Math.floor(Math.random() * bgArray.length)];
			// if (selectBG == bg1) {
			// 	promoCode = 'SCRATCH400';
			// } else if (selectBG == bg2) {
			// 	promoCode = 'SCRATCH500';
			// }
			// if (selectBG == bg3) {
			// 	var promoCode = '';
            // }
            
            var width = $(window).width();
			var height = $(window).height();

			$("#output").text(width +" - " + height);
            
			$('#promo').wScratchPad({
                
				// the size of the eraser
				size: 70,
				// the randomized scratch image   
				bg: selectBG,
				// give real-time updates
				realtime: true,
				// The overlay image
				fg: '<?php echo base_url('/assets/images/overlay.png'); ?>',
				// The cursor (cool) image
				'cursor': 'url("<?php echo base_url("/assets/images/cool.png") ?>") 5 5, default',

				scratchMove: function (e, percent) {
					// Show the plain-text promo code and call-to-action when the scratch area is 50% scratched
					/*if ((percent > 50) && (promoCode != '')) {
						$('.promo-container').show();
						$('body').removeClass('not-selectable');
						$('.promo-code').html('Your code is: ' + promoCode);
					}*/
				}
			});

		})

	</script>
  
</body>

</html>
