
<?php

/**
 * Tela que exibirá o formalário para cadastro de usuários
 *
 * @category Usuario
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<?php echo form_open( null, array("id" => "form_cadastro") ); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="area">

				<h1 class="title-area">Novo usuário</h1>

				<div class="row cadastro">
					<div class="col-md-3">Nome:</div>

					<div class="col-md-9">
						<?php 
							echo form_input( array(
								"type" 	=> "text",
								"value" => set_value('nome'),
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
								"value" => set_value('matricula'),
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
								"value" => set_value('telefone'),
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
								"value" => set_value('cpf'),
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
								"value" => set_value('login'),
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
				
				<input type="submit" class="btn-novo" value="Cadastrar" data-toggle="tooltip" data-placement="bottom" title="Finalizar o cadastro" />
			</div>
		</div>
	</div>

<?php echo form_close(); ?>

<script type="text/javascript">

	$(document).ready( function(){

		$('.cpf').mask('000.000.000-00', {reverse: true});

	});
	
	$(document).on("click", ".btn-novo", function( e ){

		e.preventDefault();

		swal({
		  title: 'Atenção!',
		  text: 'Deseja realmente cadastrar esse usuário?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#2ac87d',
		  cancelButtonColor: '#d33',
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