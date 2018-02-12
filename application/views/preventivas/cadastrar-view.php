
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
					<div class="col-md-3">Segmento:</div>

					<div class="col-md-9">
						<?php echo form_dropdown( 'tipo', tipos_preventivas(), set_value('tipo'), array( 'class' => 'cadastro' ) ); ?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Site:</div>

					<div class="col-md-9">
						<?php echo form_dropdown( 'site', null, set_value('site'), array( 'class' => 'cadastro select_site' ) ); ?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">CM:</div>

					<div class="col-md-9" id="site_cm">-</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Cidade:</div>

					<div class="col-md-9" id="site_cidade">-</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Programada:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "month",
								"value" => set_value('programada') ? set_value('programada') : date('Y-m'),
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
						<?php echo form_dropdown( 'tecnico', $usuarios, set_value('tecnico'), array( 'class' => 'cadastro' ) ); ?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Supervisor:</div>

					<div class="col-md-9">
						<?php echo form_dropdown( 'supervisor', $usuarios, set_value('supervisor'), array( 'class' => 'cadastro' ) ); ?>
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
	    url: "/ajax/listar_sites",
	    dataType: 'json',
	    delay: 250,
	    data: function (params) {
	      return {
	        q: params.term,
	        page: params.page
	      };
	    },
	    processResults: function (data, params) {
		    params.page = params.page || 1;

		    return {
		        results: data.results,
		        pagination: {
		            more: (params.page * 10) < data.count_filtered
		        }
		    };
		},
	    cache: true
	  },
	  placeholder: 'Pesquise por um site...',
	  minimumInputLength: 3
	});

	$(document).on("change", ".select_site", function(){

		var id_site = $(this).val();

		$.ajax({
			url: "/ajax/selecionar_site",
			type: 'POST',
			data: {
				id: id_site
			},
			success: function(response) {

				$("div#site_cm").html(response.cm);
				$("div#site_cidade").html(response.cidade + "/" + response.estado );
				
			}

		});

	});

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