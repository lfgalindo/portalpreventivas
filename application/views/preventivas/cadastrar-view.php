
<?php

/**
 * Tela que exibirá o formalário para cadastro de preventivas
 *
 * @category Preventiva
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<?php echo form_open( null, array("id" => "form_cadastro") ); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="area">

				<h1 class="title-area">Nova preventiva</h1>

				<div class="row cadastro">
					<div class="col-md-3">Tipo:</div>

					<div class="col-md-9">
						<?php echo form_dropdown( 'tipo', tipos_preventivas(), set_value('tipo'), array( 'class' => 'cadastro' ) ); ?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Site:</div>

					<div class="col-md-9">
						<?php echo form_dropdown( 'site', $sites, set_value('site'), array( 'class' => 'cadastro select_site' ) ); ?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Micro areas:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('micro_areas'),
								"name" 	=> "micro_areas",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Área:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('area'),
								"name" 	=> "area",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Programada:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('programada'),
								"name" 	=> "programada",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Técnico:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('tecnico'),
								"name" 	=> "tecnico",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Supervisor:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('supervisor'),
								"name" 	=> "supervisor",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>
				
				<input type="submit" class="btn-green" id="cadastrar" value="Cadastrar" data-toggle="tooltip" data-placement="bottom" title="Finalizar o cadastro" />
			</div>
		</div>
	</div>

<?php echo form_close(); ?>

<script type="text/javascript">

	$(".select_site").select2({
	  ajax: {
	    url: "https://api.github.com/search/repositories",
	    dataType: 'json',
	    delay: 250,
	    data: function (params) {
	      return {
	        q: params.term, // search term
	        page: params.page
	      };
	    },
	    processResults: function (data, params) {
	      // parse the results into the format expected by Select2
	      // since we are using custom formatting functions we do not need to
	      // alter the remote JSON data, except to indicate that infinite
	      // scrolling can be used
	      params.page = params.page || 1;

	      return {
	        results: data.items,
	        pagination: {
	          more: (params.page * 30) < data.total_count
	        }
	      };
	    },
	    cache: true
	  },
	  placeholder: 'Pesquise por um site...',
	  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
	  minimumInputLength: 1,
	  templateResult: formatRepo,
	  templateSelection: formatRepoSelection
	});

	function formatRepo (repo) {
	  if (repo.loading) {
	    return repo.text;
	  }

	  var markup = "<div class='select2-result-repository clearfix'>" +
	    "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
	    "<div class='select2-result-repository__meta'>" +
	      "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

	  if (repo.description) {
	    markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
	  }

	  markup += "<div class='select2-result-repository__statistics'>" +
	    "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" +
	    "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
	    "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
	  "</div>" +
	  "</div></div>";

	  return markup;
	}

	function formatRepoSelection (repo) {
	  return repo.full_name || repo.text;
	}

	$(document).on("click", "#cadastrar", function( e ){

		e.preventDefault();

		swal({
		  title: 'Atenção!',
		  text: 'Deseja realmente cadastrar essa preventiva?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#9fd037',
		  cancelButtonColor: '#e65858',
		  cancelButtonText: "Cancelar",
		  confirmButtonText: 'Sim',
  		  reverseButtons: true
		}).then((result) => {
 
		  if (result) {

		    $("#form_cadastro").submit();

		  }

		});

	});

</script>