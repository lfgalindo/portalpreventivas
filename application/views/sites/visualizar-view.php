
<?php

/**
 * Tela que exibirá os dados de sites
 *
 * @category Visualizar
 * @author Luiz Felipe <lfgalindo@live.com>
 */

?>

<div class="row">
	<div class="col-md-12">
		<div class="area">

			<h1 class="title-area">Visualizar dados do site</h1>

			<div class="botao_add">
				<div>
					<?php if( check_permission('editar_sites')): ?>
						<a href="<?php echo base_url('/sites/editar/') . encrypt( $site->getID() ); ?>" >
							<button class="btn-green" data-toggle="tooltip" data-placement="bottom" title="Editar esse site">Editar dados</button>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="row cadastro" style="margin-top: 20px;">
				<div class="col-md-3">ID TIM:</div>
				<div class="col-md-9"><?php echo $site->getIDTim(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">NE ID:</div>
				<div class="col-md-9"><?php echo $site->getNeID(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Co-Site</div>
				<div class="col-md-9"><?php echo $site->getCoSite(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Operadora:</div>
				<div class="col-md-9"><?php echo $site->getOperadora(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Rede:</div>
				<div class="col-md-9"><?php echo $site->getRede(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Tipo:</div>
				<div class="col-md-9"><?php echo $site->getTipoNe(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Tipo TOP:</div>
				<div class="col-md-9"><?php echo $site->getTipoTop(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Co-Site Empresa</div>
				<div class="col-md-9"><?php echo $site->getCoSiteEmpresa(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Co-Site UMTS</div>
				<div class="col-md-9"><?php echo $site->getCoSiteUmts(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">End ID:</div>
				<div class="col-md-9"><?php echo $site->getEndId(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Fornecedor:</div>
				<div class="col-md-9"><?php echo $site->getFornecedor(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Operadora MSC BSC:</div>
				<div class="col-md-9"><?php echo $site->getOperMscBsc(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Restrição de acesso:</div>
				<div class="col-md-9"><?php echo $site->getRestricaoAcesso(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Observações:</div>
				<div class="col-md-9"><?php echo $site->getObservacoes(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Tipo BTS</div>
				<div class="col-md-9"><?php echo $site->getTipoBts(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">DDD:</div>
				<div class="col-md-9"><?php echo $site->getDDD(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Endereço:</div>
				<div class="col-md-9"><?php echo $site->getEndereco() . " - " . $site->getBairro(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Cidade:</div>
				<div class="col-md-9"><?php echo $site->getCidade() . "/" . $site->getEstado(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">CM:</div>
				<div class="col-md-9"><?php echo $site->getCm(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Latitude</div>
				<div class="col-md-9"><?php echo $site->getLatitude(); ?></div>
			</div>

			<div class="row cadastro">
				<div class="col-md-3">Longitude</div>
				<div class="col-md-9"><?php echo $site->getLongitude(); ?></div>
			</div>
		</div>
	</div>
</div>