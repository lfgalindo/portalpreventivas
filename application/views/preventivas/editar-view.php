
<?php

/**
 * Tela que exibirá o formulário para edição de preventivas
 *
 * @category Preventiva
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<?php echo form_open( null, array("id" => "form_cadastro") ); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="area">

				<h1 class="title-area">Editar preventiva</h1>

				<div class="row cadastro">
					<div class="col-md-3">Tipo:</div>

					<div class="col-md-9">
						<?php echo form_dropdown( 'tipo', tipos_preventivas(), set_value('tipo') ? set_value('tipo') : $preventiva->getTipo(), array( 'class' => 'cadastro' ) ); ?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Site:</div>

					<div class="col-md-9">
						<?php echo form_dropdown( 'site', $selected_site, $preventiva->getIDSite(), array( 'class' => 'cadastro select_site' ) ); ?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Micro areas:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('micro_areas') ? set_value('micro_areas') : $preventiva->getMicroAreas(),
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
								"value" => set_value('area') ? set_value('area') : $preventiva->getArea(),
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

							$time = $preventiva->getProgramada() != "0000-00-00" ? $preventiva->getProgramada() : date("Y-m-d");

							echo form_input( array(
								"type" 	=> "month",
								"value" => set_value('programada') ? set_value('programada') : date('Y-m', strtotime( $time ) ),
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
						<?php echo form_dropdown( 'tecnico', $usuarios, set_value('tecnico') ? set_value('tecnico') : $preventiva->getIDTecnico(), array( 'class' => 'cadastro' ) ); ?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Supervisor:</div>

					<div class="col-md-9">
						<?php echo form_dropdown( 'supervisor', $usuarios, set_value('supervisor') ? set_value('supervisor') : $preventiva->getIDSupervisor(), array( 'class' => 'cadastro' ) ); ?>
					</div>
				</div>
				
				<input type="submit" class="btn-green" id="alterar" value="Salvar" data-toggle="tooltip" data-placement="bottom" title="Salvar alterações" />
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


	$(document).on("click", "#alterar", function( e ){

		e.preventDefault();

		swal({
		  title: 'Atenção!',
		  text: 'Deseja realmente salvar as alterações para esse site?',
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