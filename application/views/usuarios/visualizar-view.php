
<?php

/**
 * Tela que exibirá os dados de usuários
 *
 * @category Usuario
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<div class="row">
	<div class="col-md-12">
		<div class="area">

			<h1 class="title-area">Visualizar dados do usuário</h1>

			<div class="botao_add">
				<div>
					<?php if( check_permission('editar_usuarios')): ?>
						<a href="<?php echo base_url('/usuarios/editar/') . encrypt( $usuario->getID() ); ?>" >
							<button class="btn-green" data-toggle="tooltip" data-placement="bottom" title="Editar esse usuário">Editar dados</button>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="row cadastro" style="margin-top: 20px;">
				<div class="col-md-3">Nome:</div>

				<div class="col-md-9"><?php echo $usuario->getNome(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Matrícula:</div>

				<div class="col-md-9"><?php echo $usuario->getMatricula(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Telefone:</div>

				<div class="col-md-9"><?php echo $usuario->getTelefone(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">CPF:</div>

				<div class="col-md-9"><?php echo mask( $usuario->getCPF(), "###.###.###-##" ); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Login:</div>

				<div class="col-md-9"><?php echo $usuario->getLogin(); ?></div>
			</div>

			<div class="row cadastro" style="margin-top: 25px;">
				<div class="col-md-3">Permissões:</div>

				<div class="col-md-9">
					<?php 

						$cont = 0;
						$com_permissao = '<i class="fa fa-check-circle-o com_permissao" aria-hidden="true"></i>';
						$sem_permissao = '<i class="fa fa-ban sem_permissao" aria-hidden="true"></i>';

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
								echo in_array($name, $permissoes_usuario_array) ? $com_permissao : $sem_permissao;
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
		</div>
	</div>
</div>