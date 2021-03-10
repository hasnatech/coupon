<html>

<head>
	<meta charset="utf-8">
	<title>Danfoss</title>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, 
     user-scalable=0'>

	<link rel="stylesheet" href="<?php echo base_url('/assets/css/style.css') ?>">
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


			<?php echo form_open('df/verify') ?>
			<div class="enter">
				<div class="lable">
					<!-- Enter Coupon Code -->
					ENTRER LE CODE PROMOTIONNEL
				</div>
				<input type="text" name='coupon' class="form-feild">
			</div>
			<div class="terms">
				<div class="terms-content">
					<h3>REGLEMENT JEUX – CONCOURS</h3>


					<p class="subtitle"><b>ARTICLE 1 :</b></p>
					<p>DANFOSS SARL, Parc d’affaires Val Saint Quentin, 2 rue René Caudron, 78960 Voisins Le Bretonneux,
						N° SIREN 542 030 812 désignée ci-après sous le vocable l’organisateur, organise un jeu avec une
						possibilité de gagner des polos Danfoss d’une valeur de 15€ TTC en grattant une carte et une
						autre possibilité de gagner une polaire Danfoss d’une valeur de 60 €TTC dans le cadre de
						l’opération « Avril 2021 ». Cette participation est soumise à l’achat de produits Danfoss hors
						unités de condensation et compresseurs.
						Les règles de ce jeu sont fixées dans le présent règlement comportant 11 articles.</p>


					<p class="subtitle"><b>ARTICLE 2 :</b></p>
					<p>Le jeu se déroulera du 25/03/2021 - 07h30 au 25/04/2021 – 24h00.</p>


					<p class="subtitle"><b>ARTICLE 3 :</b></p>
					<p>Ce jeu est organisé par l’organisateur.</p>

					<p>Ce jeu est réservé à tout Installateur ayant un compte client professionnel chez un point de
						vente, FRITEC, GFF ou LEFROID, désignés ci-après sous le vocable distributeurs de produits
						DANFOSS, à l’exclusion du personnel de l’organisateur et de leurs familles. Si la personne
						physique recevant la dotation est un salarié, la dotation lui est attribuée selon les modalités
						entendues avec son employeur.</p>


					<p class="subtitle"><b>ARTICLE 4 :</b></p>
					<p>La participation à ce jeu se fait en 2 volets :</p>

					<p>1- Au niveau local dans les points de vente participants :</p>
					<p>Une carte à gratter est remise par tranche de 100 € HT d’achat composé d’un ou plusieurs
						composants de ligne (produits de régulation mécanique) Danfoss, dans la limite de 3 cartes à
						gratter par passage en caisse et par semaine.</p>
					<p>Gain potentiel au grattage : 15 € TTC en Polo Danfoss</p>
					<p>2- Au niveau national : tirage au sort.</p>
					<p>Pour participer, le client doit s’inscrire à la newsletter Danfoss. </p>
					<p>Gain au tirage au sort par Distributeur : une polaire Danfoss d’une valeur de 60 € TTC.</p>
					<p>Le tirage au sort est limité à une participation par personne (même nom, même prénom) et est
						réservé aux personnes majeures.</p>


					<p class="subtitle"><b>ARTICLE 5 :</b></p>
					<p>Les lots distribués à l’occasion de ce jeu sont détaillés ci-dessous.</p>

					<p>Au niveau local : Polo Danfoss</p>
					<p>Valeur : 15 €TTC</p>

					<p>Au niveau national : Polaire Danfoss</p>
					<p>Valeur : 60 €TTC</p>

					<p>Les lots gagnés sont incessibles, intransmissibles et ne peuvent donner lieu à aucun échange
						ou remise de leur contre-valeur, totale ou partielle, en nature ou en numéraire.</p>


					<p class="subtitle"><b>ARTICLE 7 :</b></p>
					<p>Au niveau local, les dotations sont à retirer jusqu’au 25 avril 2021 à 16 heures 00 dans le
						magasin ayant distribué la carte à gratter gagnante.</p>

					<p>Au niveau national, chaque gagnant du tirage au sort sera averti par l’organisateur soit par
						téléphone, soit par courriel.</p>

					<p>Le tirage au sort aura lieu le 5 avril 2021 à 14 heures par l’organisateur du jeu.</p>


					<p class="subtitle"><b>ARTICLE 8 :</b></p>
					<p>L’organisateur décline toute responsabilité pour tous les incidents et/ou accidents qui
						pourraient survenir pendant la jouissance du prix attribué et/ou du fait de son utilisation.
					</p>


					<p class="subtitle"><b>ARTICLE 9 :</b></p>
					<p>La participation au présent jeu implique l’acceptation sans réserve du présent règlement.</p>

					<p>Toute modification fera l’objet d’un dépôt en l’étude de la SELARL JURIKALIS – Huissiers de
						Justice Associés à la Résidence de VILLEFRANCHE SUR SAONE (Rhône- 69400), 194 Rue Charles
						Germain.</p>


					<p class="subtitle"><b>ARTICLE 10 :</b></p>
					<p>Les informations recueillies sont nécessaires au traitement du présent jeu.</p>

					<p>Conformément à la loi informatique et Libertés du 6 janvier 1978 modifiée par la loi du 6 août
					2004, les participants au jeu, disposent d’un droit d’accès, de rectification et d’opposition
					sur les données à caractère personnel les concernant, qu’ils peuvent exercer auprès de
					l’organisateur du jeu concours.</p>

					<p>Les gagnants autorisent expressément les organisateurs à utiliser leurs noms et prénoms dans le
					cadre de tout message ou manifestation publicitaire ou promotionnel, sur tout support sans que
					cette autorisation ouvre droit à d’autre contrepartie que celle du lot offert.</p>


					<p class="subtitle"><b>ARTICLE 11 :</b></p>
					<p>Le règlement complet de ce jeu est déposé en l’Etude de la SELARL JURIKALIS – Huissiers de
					Justice Associés à la Résidence de VILLEFRANCHE SUR SAONE (Rhône- 69400), 194 Rue Charles
					Germain.</p>


				</div>
				<div class="mt-10">
					<input type="checkbox" name="checked" id="checked">
					<!-- I have read and accept the terms and conditions -->
					J'ai lu et j'accepte les termes et conditions
				</div>
			</div>

			<div class="submit">
				<button class="red-button">Nous faire parvenir</button>
			</div>
			</form>
			<!-- <a href="<?php echo base_url('index.php/welcome/check') ?>">Check</a> -->
		</div>
	</div>
</body>

</html>
