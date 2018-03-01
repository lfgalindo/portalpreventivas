
<?php

/**
 * Tela que exibirá o formulário para edição de sites
 *
 * @category Site
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<?php echo form_open( null, array("id" => "form_cadastro") ); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="area">

				<h1 class="title-area">Editar site</h1>

				<div class="row cadastro">
					<div class="col-md-3">ID TIM:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('id_tim') ? set_value('id_tim') : $site->getIDTim(),
								"name" 	=> "id_tim",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">NE ID:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('ne_id') ? set_value('ne_id') : $site->getNeID(),
								"name" 	=> "ne_id",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Co-Site:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('co_site') ? set_value('co_site') : $site->getCoSite(),
								"name" 	=> "co_site",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Operadora:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('operadora') ? set_value('operadora') : $site->getOperadora(),
								"name" 	=> "operadora",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Rede:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('rede') ? set_value('rede') : $site->getRede(),
								"name" 	=> "rede",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Tipo:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('tipo_ne') ? set_value('tipo_ne') : $site->getTipoNe(),
								"name" 	=> "tipo_ne",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Tipo TOP:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('tipo_top') ? set_value('tipo_top') : $site->getTipoTop(),
								"name" 	=> "tipo_top",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Co-Site Empresa:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('co_site_empresa') ? set_value('co_site_empresa') : $site->getCoSiteEmpresa(),
								"name" 	=> "co_site_empresa",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Co-Site UMTS:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('co_site_umts') ? set_value('co_site_umts') : $site->getCoSiteUmts(),
								"name" 	=> "co_site_umts",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">End ID:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('end_id') ? set_value('end_id') : $site->getEndId(),
								"name" 	=> "end_id",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>


				<div class="row cadastro">
					<div class="col-md-3">Fornecedor:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('fornecedor') ? set_value('fornecedor') : $site->getFornecedor(),
								"name" 	=> "fornecedor",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Operadora MSC BSC:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('oper_msc_bsc') ? set_value('oper_msc_bsc') : $site->getOperMscBsc(),
								"name" 	=> "oper_msc_bsc",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Restrição de acesso:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('restricao_acesso') ? set_value('restricao_acesso') : $site->getRestricaoAcesso(),
								"name" 	=> "restricao_acesso",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Observações:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('observacoes') ? set_value('observacoes') : $site->getObservacoes(),
								"name" 	=> "observacoes",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Tipo BTS:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('tipo_bts') ? set_value('tipo_bts') : $site->getTipoBts(),
								"name" 	=> "tipo_bts",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">DDD:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('ddd') ? set_value('ddd') : $site->getDDD(),
								"name" 	=> "ddd",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Endereço:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('endereco') ? set_value('endereco') : $site->getEndereco(),
								"name" 	=> "endereco",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Bairro:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('bairro') ? set_value('bairro') : $site->getBairro(),
								"name" 	=> "bairro",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Cidade:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('cidade') ? set_value('cidade') : $site->getCidade(),
								"name" 	=> "cidade",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Estado:</div>

					<div class="col-md-9">
						<?php 

							$selected = set_value('estado') ? set_value('estado') : $site->getEstado();

							echo form_dropdown( "estado", nomes_estados(), $selected, array('class' => 'cadastro') );
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">CM:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('cm') ? set_value('cm') : $site->getCm(),
								"name" 	=> "cm",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Latitude:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('latitude') ? set_value('latitude') : $site->getLatitude(),
								"name" 	=> "latitude",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Longitude:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('longitude') ? set_value('longitude') : $site->getLongitude(),
								"name" 	=> "longitude",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>
				
				<input type="submit" class="btn-green" id="alterar" value="Salvar" data-toggle="tooltip" data-placement="bottom" title="Salvar alterações" />
			</div>
		</div>
	</div>

<?php echo form_close(); ?>

<script type="text/javascript">
	
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