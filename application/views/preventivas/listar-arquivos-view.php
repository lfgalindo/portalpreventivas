
<?php

/**
 * Tela que exibirá a listagem de arquivos de preventivas
 *
 * @category arquivo
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<!-- Modal para envio de relatórios -->
<?php echo form_open_multipart( '/arquivos/enviar/preventivas/' . $id_reg_tabela_encrypt ); ?>
	<div class="modal fade" id="enviar_relatorio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<div class='row'>
	      		<div class="col-md-12">
	      			<p><b> Enviar relatório: </b></p>
	      		</div>
	      	</div>
	      	<div class='row'>
	      		<div class="col-md-12">
	      			<input type="file" class="cadastro" name="arquivo"/>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn-red" data-dismiss="modal">Cancelar</button>
	        <input type="submit" class="btn-green" value="Enviar"/>
	      </div>
	    </div>
	  </div>
	</div>
<?php echo form_close(); ?>

<!-- Modal para recusar relatórios a data de execução -->
<form id="recusar" action="" method="POST">
	<div class="modal fade" id="data_recusar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<div class='row'>
	      		<div class="col-md-12">
	      			<p><b> Motivo: </b></p>
	      		</div>
	      	</div>
	      	<div class='row'>
	      		<div class="col-md-12">
	      			<input type="text" class="cadastro" name="motivo">
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn-red" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn-green recusar_relatorio">Recusar</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<div class="row">
	<div class="col-md-12">
		<div class="area">

			<h1 class="title-area">Relatórios da preventiva</h1>

			<div class="botao_add">
				<div>
					<?php if( check_permission('enviar_relatorios_preventivas') && ( $preventiva->getStatus() == "2" || $preventiva->getStatus() == "4" ) ): ?>
						<a href="<?php echo base_url('arquivos/enviar/preventivas/' . $id_reg_tabela_encrypt ); ?>" >
							<button class="btn-green enviar_relatorio" data-toggle="tooltip" data-placement="bottom" title="Enviar um relatório">Enviar relatório</button>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<table class="table listar">
				<thead>
					<tr>
						<th> Nome do relatório </th>
						<th> Enviado </th>
						<th> Situação </th>
						<th> Ações </th>
					</tr>
				</thead>

				<tbody>
					<?php 

						$cont = 0;

						foreach ( $arquivos as $arquivo ): ?>

						<tr>
							<td><?php echo $arquivo['nome']; ?></td>
							<td><?php echo date('d/m/Y', strtotime( $arquivo['data_envio'] ) ); ?>
							</td>
							<td>
								<?php 

									$situacao = "Em aprovação";

									if ( $arquivo['aprovado'] == "1" )
										$situacao = "Aprovado";

									if ( $arquivo['recusado'] == "1" )
										$situacao = "Recusado";

									echo $situacao; 

								?>		
							</td>
							<td>
								<a href="<?php echo base_url('/arquivos/visualizar/' . $id_reg_tabela_encrypt . '/') . encrypt( $arquivo['id'] ); ?>">
									<button class="dados_arquivo btn-table" data-toggle="tooltip"  data-placement="bottom" title="Ver dados do arquivo">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</button>
								</a>

								<?php if ( $arquivo['recusado'] != "1" ) : ?>
									<a href="<?php echo base_url( '/arquivos/baixar/' . $id_reg_tabela_encrypt . '/') . encrypt( $arquivo['id'] ); ?>">
										<button class="download btn-table" id="<?php echo $arquivo['id']; ?>" data-toggle="tooltip"  data-placement="bottom" title="Baixar relatório">
											<i class="fa fa-download" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>

								<?php if( check_permission('aprovar_relatorios_preventivas') && $arquivo['aprovado'] != "1" && $arquivo['recusado'] != "1" ): ?>
									<a href="<?php echo base_url('/arquivos/aprovar/' . $id_reg_tabela_encrypt . '/') . encrypt( $arquivo['id'] ); ?>">
										<button class="aprovar btn-table" data-toggle="tooltip" data-placement="bottom" title="Aprovar relatório">
											<i class="fa fa-check" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>

								<?php if( check_permission('recusar_relatorios_preventivas') && $arquivo['aprovado'] != "1" && $arquivo['recusado'] != "1" ): ?>
									<a href="<?php echo base_url('/arquivos/recusar/' . $id_reg_tabela_encrypt . '/') . encrypt( $arquivo['id'] ); ?>">
										<button class="recusar btn-table" data-toggle="tooltip" data-placement="bottom" title="Recusar relatório">
											<i class="fa fa-ban" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>

								<?php if( check_permission('remover_relatorios_preventivas') && $arquivo['aprovado'] != "1" && $arquivo['recusado'] != "1" ): ?>
									<a href="<?php echo base_url('/arquivos/remover/' . $id_reg_tabela_encrypt . '/') . encrypt( $arquivo['id'] ); ?>">
										<button class="excluir btn-table" data-toggle="tooltip" data-placement="bottom" title="Remover arquivo">
											<i class="fa fa-times" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>

								<?php 

									$cont++;

									if( ( check_permission('cancelar_aprov_rec_relatorios_preventivas') && $cont == '1' ) && ( $arquivo['aprovado'] == "1" || $arquivo['recusado'] == "1" ) ): ?>
									<a href="<?php echo base_url('/arquivos/cancelar_aprov_rec/' . $id_reg_tabela_encrypt . '/') . encrypt( $arquivo['id'] ); ?>">
										<button class="cancelar btn-table" data-toggle="tooltip" data-placement="bottom" title="Cancelar aprovação / recusa">
											<i class="fa fa-retweet" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<div class="pagination">
				<?php echo $paginacao; ?>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	
	$(document).on('click', '.excluir' , function( e ){

		e.preventDefault();

		var link = $(this).parent().attr('href');

		swal({
		  title: 'Atenção!',
		  text: 'Deseja realmente remover esse arquivo?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#9fd037',
		  cancelButtonColor: '#e65858',
		  cancelButtonText: "Cancelar",
		  confirmButtonText: 'Sim',
  		  reverseButtons: true
		}).then((result) => {
 
		  if (result) {

		    window.location.href = link;

		  }

		});

	});

	$(document).on('click', '.aprovar' , function( e ){

		e.preventDefault();

		var link = $(this).parent().attr('href');

		swal({
		  title: 'Atenção!',
		  text: 'Deseja realmente aprovar esse relatório?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#9fd037',
		  cancelButtonColor: '#e65858',
		  cancelButtonText: "Cancelar",
		  confirmButtonText: 'Sim',
  		  reverseButtons: true
		}).then((result) => {
 
		  if (result) {

		    window.location.href = link;

		  }

		});

	});

	$(document).on('click', '.recusar' , function( e ){

		e.preventDefault();

		var link = $(this).parent().attr('href');

		$("form#recusar").attr('action', link);

		$('#data_recusar').modal('show');
		
	});

	$(document).on('click', '.recusar_relatorio' , function( e ){

		e.preventDefault();

		swal({
		  title: 'Atenção!',
		  text: 'Deseja realmente recusar esse relatório?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#9fd037',
		  cancelButtonColor: '#e65858',
		  cancelButtonText: "Cancelar",
		  confirmButtonText: 'Sim',
  		  reverseButtons: true
		}).then((result) => {
 
		  if (result) {

		    $("form#recusar").submit();

		  }

		});
		
	});

	$(document).on('click', '.enviar_relatorio' , function( e ){

		e.preventDefault();

		$('#enviar_relatorio').modal('show');
		
	});

	$(document).on('click', '.cancelar_exec' , function( e ){

		e.preventDefault();

		var link = $(this).parent().attr('href');

		swal({
		  title: 'Atenção!',
		  text: 'Deseja realmente cancelar a execução dessa preventiva?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#9fd037',
		  cancelButtonColor: '#e65858',
		  cancelButtonText: "Cancelar",
		  confirmButtonText: 'Sim',
  		  reverseButtons: true
		}).then((result) => {
 
		  if (result) {

		    window.location.href = link;

		  }

		});
		
	});

	$(document).on('click', 'button.download', function( e ){

		e.preventDefault();

		var id_arquivo = $(this).attr('id');
		var link = $(this).parent().attr('href');

		$.ajax({
			url: "/ajax/existe_arquivo",
			type: 'POST',
			data: {
				id: id_arquivo
			},
			success: function( response ) {

				if ( response.ajax ){

					if ( response.existe ) { 

						swal('Pronto!', 'O download será iniciado!', 'success')
						window.location.href = link;
					}
					else {

						swal('Oops!', 'Esse arquivo não se encontra mais no servidor!', 'error');

					}

				}
				else{

					swal('Oops!', response.message, 'error');

				}

			}

		});

	});

</script>