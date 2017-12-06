<?php

/**
 * Helper para exibir os erros personalizados quando não está em modo DEBUG.
 * @author Luciano Junior <luciano@lucianojunior.com.br>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('get_error') ) {

	/**
	 * Função para puxar o erro pelo o seu id.
	 * @param int 	$id
	 * @return string
	 */
	function get_error( $id ) {

		$array = array(
				1451 => 'Não é possível deletar esse registro pois existe algo dependente disso.'
			);

		if( is_numeric( $id ) && isset( $array[ $id ] ) ) {
			return $array[ $id ];
		}

		return 'Não foi possivel realizar essa ação.';

	}
}

if( ! function_exists('get_messages') ) {

	/**
	 * Função para resgatar mensagens de erro em todos os sistemas.
	 * @param string $message
	 * @return string
	 */

	function get_messages( $message ) {

		$array = array(

				// Mensagens de erro.
				'erro' 										=> 'Erro.',
				'erro_interno'								=> 'Erro interno. Por favor, entre em contato.',
				'erro_login' 								=> 'Autenticações inválidas. Tente novamente.',
				'erro_confirmar_senha'						=> 'As duas senhas não conferem. Tente novamente.',
				'erro_abrir_caixa'							=> 'Já existe um caixa aberto para este usuário.',
				'erro_excluir_caixa_valor'					=> 'Não é possível excluir este caixa, pois o mesmo contém movimentações.',
				'erro_caixa_fechado'						=> 'Não é possível cadastrar movimentações para um caixa fechado.',
				'erro_recebimento_fatura'					=> 'Ocorreu um erro ao tentar receber esta fatura.',
				'erro_gerar_movimentacao_caixa'				=> 'Ocorreu um erro ao gerar a movimentação de caixa.',
				'erro_gerar_faturas'						=> 'Ocorreu um erro ao gerar faturas.',
				'erro_nao_existe_caixa_aberto'				=> 'Não existe um caixa aberto no momento.',
				'erro_existe_subdespesa'					=> 'Existem sub-despesas cadastradas.',
				'erro_existe_mov_caixa'						=> 'Existem movimentações de caixa cadastradas.',
				'erro_fechar_caixa_valor_cheque'			=> 'Retire todo o valor em cheque do caixa antes de fecha-lo.',
				'erro_fechar_caixa_valor_cartao'			=> 'Retire todo o valor em cartão do caixa antes de fecha-lo.',
				'erro_excluir_caixa_movimentacao'			=> 'Este caixa possui movimentações.',

				// Mensagens de sucesso.
				'sucesso' 							=> 'Sucesso!',
				'sucesso_cadastro'					=> 'Cadastro realizado com sucesso!',
				'sucesso_login' 					=> 'Logado com sucesso!',
				'sucesso_remover' 					=> 'Registro removido com sucesso!',
				'sucesso_alterar' 					=> 'Registro alterado com sucesso!',
				'sucesso_concluir_tarefa' 			=> 'Tarefa finalizada com sucesso!',
				'sucesso_fechar_caixa'				=> 'Caixa fechado com sucesso!',
				'sucesso_recebimento_fatura'		=> 'Fatura recebida com sucesso!',
				'sucesso_geracao_fatura'			=> 'Fatura(s) gerada(s) com sucesso!',
				'sucesso_existe_geracao_fatura'		=> 'Uma ou mais faturas já existiam e não foram geradas.',
				'sucesso_abertura_caixa'			=> 'Caixa aberto com sucesso.',
				'sucesso_reabrir_caixa'				=> 'Caixa reaberto com sucesso.',
				'sucesso_cancelamento_recebimento'	=> 'Cancelamento de baixa realizado com sucesso!',

			);

		if( isset( $array[ $message ] ) ) {
			return $array[ $message ];
		}

		return false;
	}

}