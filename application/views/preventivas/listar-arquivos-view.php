
<?php

/**
 * Tela que exibirá a listagem de arquivos de preventivas
 *
 * @category arquivo
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<div class="row">
	<div class="col-md-12">
		<div class="area">

			<h1 class="title-area">Relatórios da preventiva</h1>

			<div class="botao_add">
				<div>
					<?php if( check_permission('enviar_relatorios_preventivas')): ?>
						<a href="<?php echo base_url('arquivos/enviar/preventivas/' . $id_reg_tabela_encrypt ); ?>" >
							<button class="btn-green" data-toggle="tooltip" data-placement="bottom" title="Enviar um relatório">Enviar relatório</button>
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
					<?php foreach ( $arquivos as $arquivo ): ?>
						<tr>
							<td><?php echo $arquivo['nome']; ?></td>
							<td><?php echo date('d/m/Y', strtotime( $arquivo['data_envio'] ) ); ?>
							</td>
							<td>
								<?php 

									$situação = "Em aprovação";

									if ( $arquivo['aprovado'] == 1 )
										$situação = "Aprovado";

									if ( $arquivo['recusado'] == 1 )
										$situação = "Recusado";

									echo $situação; 

								?>		
							</td>
							<td>
								<button class="motivo_recusado btn-table" data-toggle="tooltip"  data-placement="bottom" title="Ver dados da recusa">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</button>

								<?php if( check_permission('editar_preventivas') ): ?>
									<a href="<?php echo base_url('/preventivas/editar/') . encrypt( $arquivo['id'] ); ?>">
										<button class="editar btn-table" data-toggle="tooltip"  data-placement="bottom" title="Alterar dados">
											<i class="fa fa-pencil" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>

								<?php if( check_permission('remover_preventivas') ): ?>
									<a href="<?php echo base_url('/preventivas/remover/') . encrypt( $arquivo['id'] ); ?>">
										<button class="excluir btn-table" data-toggle="tooltip" data-placement="bottom" title="Remover preventiva">
											<i class="fa fa-times" aria-hidden="true"></i>
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
		  text: 'Deseja realmente remover essa preventiva?',
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

	$(document).on('click', '.executar' , function( e ){

		e.preventDefault();

		var link = $(this).parent().attr('href');

		$("form#exec").attr('action', link);

		$('#data_exec').modal('show');
		
	});

	$(document).on('click', '.salvar_exec' , function( e ){

		e.preventDefault();

		swal({
		  title: 'Atenção!',
		  text: 'Deseja realmente marcar essa preventiva como executada?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#9fd037',
		  cancelButtonColor: '#e65858',
		  cancelButtonText: "Cancelar",
		  confirmButtonText: 'Sim',
  		  reverseButtons: true
		}).then((result) => {
 
		  if (result) {

		    $("form#exec").submit();

		  }

		});
		
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


</script>