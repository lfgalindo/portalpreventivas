
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
					<div class="col-md-3">Segmento:</div>

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
					<div class="col-md-3">Tipo TOP:</div>

					<div class="col-md-9" id="site_tipo_top"><?php echo $site->getTipoTop(); ?></div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">End ID:</div>

					<div class="col-md-9" id="site_end_id"><?php echo $site->getEndId(); ?></div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Cidade:</div>

					<div class="col-md-9" id="site_cidade"><?php echo $site->getCidade() . "/" . $site->getEstado(); ?></div>
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

	$(document).on("change", ".select_site", function(){

		var id_site = $(this).val();

		$.ajax({
			url: "/ajax/selecionar_site",
			type: 'POST',
			data: {
				id: id_site
			},
			success: function(response) {

				$("div#site_tipo_top").html(response.tipo_top);
				$("div#site_end_id").html(response.end_id);
				$("div#site_cidade").html(response.cidade + "/" + response.estado );
				
			}

		});

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