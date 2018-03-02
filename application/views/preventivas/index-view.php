
<?php

/**
 * Tela que exibirá a listagem de preventivas
 *
 * @category Preventiva
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<!-- Modal para colocar a data de execução -->
<form id="exec" action="" method="POST">
	<div class="modal fade" id="data_exec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<div class='row'>
	      		<div class="col-md-12">
	      			<p><b> Data da execução: </b></p>
	      		</div>
	      	</div>
	      	<div class='row'>
	      		<div class="col-md-12">
	      			<input type="date" class="cadastro" name="data_execucao" value="<?php echo date('Y-m-d'); ?>">
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn-red" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn-green salvar_exec">Salvar</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<div class="row">
	<div class="col-md-12">
		<div class="area">

			<div class="title-filter">
				
				<h1 class="title-area">Preventivas</h1>
				
				<?php if( check_permission('cadastrar_preventivas')): ?>
					<a href="<?php echo base_url('/preventivas/cadastrar'); ?>" >
						<button class="btn-green" data-toggle="tooltip" data-placement="bottom" title="Cadastrar uma preventiva">Nova preventiva</button>
					</a>
				<?php endif; ?>

			</div>

			<?php echo form_open( "", array('method' => 'GET', 'class'=>'container-fluid filtros' ) ); ?>

				<div class="row">

					<div class="col-md-1">
						<?php echo form_label("Buscar: ", "search"); ?>
					</div>

					<div class="col-md-7">
						<?php 

							echo form_input( array(
												'name' => 'search',
												'id' => 'search',
												'class' => 'cadastro',
												'placeholder' => 'Digite aqui para buscar...',
												'value' => $search_string
												)
											);
						?>
					</div>

					<div class="col-md-1 right">
						<?php echo form_label( "Segmento: ", "search_tipo"); ?>
					</div>

					<div class="col-md-3">
						<?php 

							$tipos = tipos_preventivas();

							array_unshift( $tipos, "Todos os segmentos");

							echo form_dropdown('search_tipo', $tipos, (String) $search_tipo, array( "class" => "cadastro"));
						
						?>
					</div>

				</div>

				<div class="row">

					<?php

						echo '<div class="col-md-1" >';

						echo form_label( "Status: ", "search_situacao");

						echo '</div>';

						echo '<div class="col-md-3">';

						$situacoes = situacoes_preventivas();

						array_unshift( $situacoes, "Todos os status");

						echo form_dropdown('search_situacao', $situacoes, $search_situacao, array( "class" => "cadastro" ));

						echo '</div>';

						echo '<div class="col-md-1 right" >';

						echo form_label( "CM: ", "search_cm");

						echo '</div>';

						echo '<div class="col-md-2">';

						echo form_dropdown('search_cm', $cms, (String) $search_cm, array( "class" => "cadastro" ));

						echo '</div>';

						echo '<div class="col-md-1 right">';

						echo form_label( "Mês: ", "search_mes");

						echo '</div>';

						echo '<div class="col-md-2">';

						echo form_input( array("type" => "month", "name" => "search_mes", "class" => "cadastro", "value" => $search_mes ) );

						echo '</div>';

						echo '<div class="col-md-2 right">';

							echo form_input( array(
												'type' => 'submit',
												'class' => 'btn-green',
												'style' => 'margin-left: 5px;',
												'value' => 'Buscar'
												)
											);


						echo '</div>';
					?>
				</div>

			<?php 

				echo form_close(); 

				$string_get = '?';
				foreach ( $this->input->get() as $key => $value )
					$string_get .= $string_get != '?' ? '&' . $key . '=' . $value : $key . '=' . $value;

			?>

			<table class="table listar">
				<thead>
					<tr>
						<th> Site </th>
						<th> Tipo TOP </th>
						<th> End ID </th>
						<th> Supervisor </th>
						<th> Segmento </th>
						<th> Status </th>
						<th> Ações </th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ( $preventivas as $preventiva ): ?>
						<tr>
							<td><?php echo $preventiva['ne_id']; ?></td>
							<td><?php echo $preventiva['tipo_top']; ?></td>
							<td><?php echo $preventiva['end_id']; ?></td>
							<td><?php echo $preventiva['supervisor']; ?></td>
							<td><?php echo tipos_preventivas( $preventiva['tipo'] ); ?></td>
							<td><?php echo situacoes_preventivas( $preventiva['status'] ); ?></td>
							<td>
								<a href="<?php echo base_url('/preventivas/visualizar/') . encrypt( $preventiva['id'] ); ?>">
									<button class="visualizar btn-table" data-toggle="tooltip"  data-placement="bottom" title="Ver todos os dados">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</button>
								</a>

								<?php if( check_permission('editar_preventivas_admin') || ( check_permission('editar_preventivas') && $preventiva['status'] == "1" ) ): ?>
									<a href="<?php echo base_url('/preventivas/editar/') . encrypt( $preventiva['id'] ); ?>">
										<button class="editar btn-table" data-toggle="tooltip"  data-placement="bottom" title="Alterar dados">
											<i class="fa fa-pencil" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>

								<?php if( check_permission('visualizar_relatorios_preventivas')  && $preventiva['status'] != "1" ): ?>
									<a href="<?php echo base_url('/arquivos/preventivas/') . encrypt( $preventiva['id'] ); ?>">
										<button class="editar btn-table" data-toggle="tooltip"  data-placement="bottom" title="Ver relatórios enviados">
											<i class="fa fa-file-text-o" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>

								<?php if( check_permission('remover_preventivas') && $preventiva['status'] == "1" ): ?>
									<a href="<?php echo base_url('/preventivas/remover/') . encrypt( $preventiva['id'] ) . $string_get; ?>">
										<button class="excluir btn-table" data-toggle="tooltip" data-placement="bottom" title="Remover preventiva">
											<i class="fa fa-times" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>

								<?php if( check_permission('executar_preventivas') && $preventiva['status'] == "1" ): ?>
									<a href="<?php echo base_url('/preventivas/executar/') . encrypt( $preventiva['id'] ) . $string_get; ?>">
										<button class="executar btn-table" data-toggle="tooltip"  data-placement="bottom" title="Marcar como executada">
											<i class="fa fa-check" aria-hidden="true"></i>
										</button>
									</a>
								<?php endif; ?>

								<?php if( check_permission('cancelar_exec_preventivas') && $preventiva['status'] == "2" ): ?>
									<a href="<?php echo base_url('/preventivas/executar/') . encrypt( $preventiva['id'] ) . $string_get; ?>">
										<button class="cancelar_exec btn-table" data-toggle="tooltip"  data-placement="bottom" title="Cancelar execução">
											<i class="fa fa-ban" aria-hidden="true"></i>
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