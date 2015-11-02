<div class="container">
	<form id="campaign_edit" method="post" action="<?php echo site_url('campaign/process_edit_campaign'); ?>">
	<div class="row">
		<div class="col-sm-6">
			<h2 class="icon-label">
				<svg class="icon-svg icon-identificationRouge" width="50" height="32" viewBox="0 0 50 32" x="624">
					<path fill="#e41b13" d="M0 0l.113 5.814H30.64L30.617 0H0zm.15 18.945l49.358.03V13.06L.15 12.965v5.98zM.15 32h21.756v-5.93H.15V32z"/>
				</svg>
				<span>Identification</span>
			</h2>
			<div class="grayBox">
				<div class="row">
					<div class="col-sm-6">
						<label for="campaign_banner_id">Bannière</label>
						<div class="wrapper-select-top">
							<select name="campaign_banner_id" id="campaign_banner_id">
								<option value="">Metro</option>
								<option value="">Option 2</option>
								<option value="">Option 3</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<label for="campaign_type_id">Type de campagne</label>
						<div class="wrapper-select-top">
							<select name="campaign_type_id" id="campaign_type_id">
								<option value="">Réno. Mineures</option>
								<option value="">Option 2</option>
								<option value="">Option 3</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<label for="tcampaign_title">Titre de la campagne</label>
						<input  type="text" name="campaign_title" id="campaign_title" value="Arthur-Sauvé Réno. Mineures"/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="campaign_date_start">Date de début</label>
						<input class="datechooser" type="text" name="campaign_date_start" id="campaign_date_start" value="06 / 04 / 2015"/>
					</div>
					<div class="col-sm-6">
						<label for="campaign_date_end">Date de fin</label>
						<input class="datechooser" type="text" name="campaign_date_end" id="campaign_date_end" value="15 / 04 / 2015"/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="campaign_branch">Nom de la succursale</label>
						<input type="text" name="campaign_branch" id="campaign_branch" value="Arthur-Sauvé"/>
					</div>
					<div class="col-sm-6">
						<label for="adresse-succursale">Adresse de la succursale</label>
						<input type="text" name="campaign_address" id="campaign_address" value="6155, boulevard Arthur-Sauvé"/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="campaign_manager_tgi">Chargée de projet (Tonik Groupimage)</label>
						<div class="wrapper-select-top">
							<select name="campaign_manager_tgi" id="campaign_manager_tgi">
								<option value="">Anie Lépine</option>
								<option value="">Option 2</option>
								<option value="">Option 3</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<label for="campaign_manager_client">Coordonnateur (Metro)</label>
						<div class="wrapper-select-top">
							<select name="campaign_manager_client" id="campaign_manager_client">
								<option value="">Dominic Audry</option>
								<option value="">Option 2</option>
								<option value="">Option 3</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="campaign_project_number">Numéro de projet</label>
						<input type="text" name="campaign_project_number" id="campaign_project_number" value="91339"/>
					</div>
					<div class="col-sm-6">
						<label for="campaign_store_number">Numéro de magasin</label>
						<input type="text" name="campaign_store_number" id="campaign_store_number" value="123456"/>
					</div>
				</div>
				
			</div>
		</div>
		<div class="col-sm-6">
			<h2 class="icon-label">
				
				<svg class="icon-svg icon-etapesRouge" viewBox="0 0 29 32" x="576">
					<path fill="#e41b13" d="M0 10.24v19.17C0 30.84 1.148 32 2.564 32H25.64c1.416 0 2.564-1.16 2.564-2.59V10.24H0zm21.153 1.92h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12H8.34v-5.12zm-6.41 0H7.05v5.12H1.924v-5.12zm19.23 6.4h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12H8.34v-5.12zm-6.41 0H7.05v5.12H1.924v-5.12zm19.23 6.4h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12h-5.12v-5.12zm-6.41 0h5.128v5.12H8.34v-5.12zm-6.41 0H7.05v5.12H1.924v-5.12zM19.55.96v2.88H8.653V.96c0-.53-.43-.96-.96-.96-.532 0-.962.43-.962.96v2.88H2.57C1.15 3.84 0 5 0 6.43v2.53h28.204V6.43c0-1.43-1.148-2.59-2.564-2.59h-4.166V.96c0-.53-.43-.96-.96-.96-.532 0-.962.43-.962.96zm1.923 5.44V4.74c.574.33.96.95.96 1.66 0 1.06-.86 1.92-1.922 1.92-1.06 0-1.92-.86-1.92-1.92 0-.71.39-1.33.96-1.66V6.4c0 .53.43.96.96.96s.96-.43.96-.96zm-12.82.64V5.38c.574.33.96.95.96 1.66 0 1.06-.86 1.92-1.922 1.92-1.06 0-1.92-.86-1.92-1.92 0-.71.39-1.33.96-1.66v1.66c0 .53.43.96.96.96s.96-.43.96-.96z"/>
				</svg>
				<span>Étapes</span>
			</h2>
			<div class="grayBox">
				<div class="row">
					<div class="col-sm-12">
						<label for="strategie1">Stratégie</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<input class="datechooser" type="text" name="strategie1" id="strategie1" value="15 / 04 / 2015"/>
					</div>
					<div class="col-sm-6 etapes-au">
						<input class="datechooser" type="text" name="strategie2" id="strategie2" value="15 / 04 / 2015"/>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12">
						<label for="dev-plan-chiffre1">Développement du plan chiffré</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<input class="datechooser" type="text" name="dev-plan-chiffre1" id="dev-plan-chiffre1" value="15 / 04 / 2015"/>
					</div>
					<div class="col-sm-6 etapes-au">
						<input class="datechooser" type="text" name="dev-plan-chiffre2" id="dev-plan-chiffre2" value="15 / 04 / 2015"/>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12">
						<label for="creation1">Création</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<input class="datechooser" type="text" name="creation1" id="creation1" value="15 / 04 / 2015"/>
					</div>
					<div class="col-sm-6 etapes-au">
						<input class="datechooser" type="text" name="creation2" id="creation2" value="15 / 04 / 2015"/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<label for="production1">Production</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<input class="datechooser" type="text" name="production1" id="production1" value="15 / 04 / 2015"/>
					</div>
					<div class="col-sm-6 etapes-au">
						<input class="datechooser" type="text" name="production2" id="production2" value="15 / 04 / 2015"/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<label for="postproduction1">Postproduction</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<input class="datechooser" type="text" name="postproduction1" id="postproduction1" value="15 / 04 / 2015"/>
					</div>
					<div class="col-sm-6 etapes-au">
						<input class="datechooser" type="text" name="postproduction2" id="postproduction2" value="15 / 04 / 2015"/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<label for="campagne1">Campagne</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<input class="datechooser" type="text" name="campagne1" id="campagne1" value="15 / 04 / 2015"/>
					</div>
					<div class="col-sm-6 etapes-au">
						<input class="datechooser" type="text" name="campagne2" id="campagne2" value="15 / 04 / 2015"/>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label for="date-event">Date de l’événement</label>
						<input class="datechooser" type="text" name="date-event" id="date-event" value="15 / 04 / 2015"/>
					</div>
					<div class="col-sm-6">
						<label for="date-medias">Date médias</label>
						<input class="datechooser" type="text" name="date-medias" id="date-medias" value="15 / 04 / 2015"/>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
	<div class="btn-bottom-hr">
	<hr />
		<a style="cursor:pointer;" class="btn-icon-on-dark submit" data-value="campaign_edit">
		<svg class="icon-svg icon-sauvegarderBlanc" viewBox="0 0 31 32" x="1920">
			<path fill="#FFF" d="M22.652.35v8.792H6.1V.352H0V32h30.493V5.95l-4.68-5.6h-3.16zM4.356 13.54h20.91v13.187H4.356v-13.19z"/>
			<path fill="#FFF" d="M8.712 6.505h11.326V.35H8.712v6.155z"/>
		</svg>
		Sauvegarder
		</a>
	</div>
	</form>
</div>
