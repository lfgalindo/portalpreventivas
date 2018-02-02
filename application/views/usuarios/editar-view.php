
<?php

/**
 * Tela que exibirá o formalário para edição de usuários
 *
 * @category Usuario
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<?php echo form_open( null, array("id" => "form_cadastro") ); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="area">

				<h1 class="title-area">Editar usuário</h1>

				<div class="row cadastro">
					<div class="col-md-3">Nome:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('nome') ? set_value('nome') : $usuario->getNome(),
								"name" 	=> "nome",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Matrícula:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('matricula') ? set_value('matricula') : $usuario->getMatricula(),
								"name" 	=> "matricula",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Telefone:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('telefone') ? set_value('telefone') : $usuario->getTelefone(),
								"name" 	=> "telefone",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">CPF:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('cpf') ? set_value('cpf') : str_pad($usuario->getCPF(), 11, "0", STR_PAD_LEFT),
								"name" 	=> "cpf",
								"class" => "cadastro cpf"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Login:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('login') ? set_value('login') : $usuario->getLogin(),
								"name" 	=> "login",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Senha:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "password",
								"value" => set_value('senha'),
								"name" 	=> "senha",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro">
					<div class="col-md-3">Confirmar senha:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "password",
								"value" => set_value('confirmar_senha'),
								"name" 	=> "confirmar_senha",
								"class" => "cadastro"
								)
							);
						?>
					</div>
				</div>

				<div class="row cadastro" style="margin-top: 25px;">
					<div class="col-md-3">Permissões:</div>

					<div class="col-md-9">
						<?php 

							$cont = 0;

							foreach ( $permissoes as $permissao ): 

								$cont++;

								if ( $cont == "1" )
									echo '<div class="row cadastro">';

								echo '<div class="col-md-4">';
								echo '<h6 class="title-area permissao">' . $permissao['nome'] . '</h1>';

								foreach ( $permissao['permissoes'] as $name => $text ) {
									echo '<div class="row">';
									echo '<div class="col-md-12">';
									echo '<label class="permissoes">';
									echo form_checkbox( 'permissoes[]', $name, in_array( $name, $select_permissoes ) ? TRUE : FALSE);
									echo $text;
									echo '</label>';
									echo '</div>';
									echo '</div>';
								}

								echo '</div>';

								if ( $cont == "3" ){

									echo '</div>';
									$cont = 0;

								}

							endforeach; 

							if ( $cont != "0" )
								echo '</div>';

						?>
					</div>
				</div>
				
				<input type="submit" class="btn-green" id="alterar" value="Salvar" data-toggle="tooltip" data-placement="bottom" title="Salvar alterações" />
			</div>
		</div>
	</div>

<?php echo form_close(); ?>

<script type="text/javascript">

	$(document).ready( function(){

		$('.cpf').mask('000.000.000-00', {reverse: true});

	});
	
	$(document).on("click", "#alterar", function( e ){

		e.preventDefault();

		swal({
		  title: 'Atenção!',
		  text: 'Deseja realmente salvar as alterações para esse usuário?',
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