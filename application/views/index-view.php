
<script src="<?php echo base_url(); ?>assets/highcharts/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/highcharts-more.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<div class="row">
	<div class="col-md-12">
		<div class="area">

			<div class="title-filter">
				
				<h1 class="title-area">Portal de preventivas</h1>
				
			</div>

			<?php echo form_open( "", array('method' => 'GET', 'class'=>'container-fluid filtros' ) ); ?>

				<div class="row">

					<?php

						echo '<div class="col-md-1 col-md-offset-7">';

						echo form_label( "Mês: ", "search_mes");

						echo '</div>';

						echo '<div class="col-md-3">';

						echo form_input( array("type" => "month", "name" => "search_mes", "class" => "cadastro", "value" => $search_mes ) );

						echo '</div>';

						echo '<div class="col-md-1">';

							echo form_input( array(
												'type' => 'submit',
												'class' => 'btn-green',
												'style' => 'margin-left: 5px;',
												'value' => 'Filtrar'
												)
											);


						echo '</div>';
					?>

				</div>


				<div class="row">

					<div class="col-md-12">
						<div id="status-preventiva" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					</div>

				</div>

				<div class="row">

					<div class="col-md-12">
						<div id="supervisor-performance" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					</div>

				</div>

			<?php echo form_close(); ?>

		</div>

	</div>

</div>

<?php 
	
	$mes_ano = explode( '-', $search_mes );
	$ano = $mes_ano[0];
	$mes = $mes_ano[1];

?>

<script type="text/javascript">

	var mes_ano = "<?php echo nome_mes( (int) $mes ) . " de " . $ano ?>"
	var supervisores = JSON.parse('<?php echo json_encode( $nomes_supervisores ); ?>');
	var qtd_por_situacao = JSON.parse('<?php echo json_encode( $qtd_por_situacao ); ?>');
	var qtd_geral = JSON.parse('<?php echo json_encode( $qtd_geral ); ?>');

	Highcharts.chart('status-preventiva', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Status de manutenção das preventivas'
	    },
	    subtitle: {
	        text: mes_ano
	    },
	    xAxis: {
	        categories: ['Preventivas cadastradas'],
	        crosshair: false
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: ''
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	            '<td style="padding:0"><b>{point.y}</b></td></tr>',
	        footerFormat: '</table>',
	        shared: true,
	        useHTML: true
	    },
	    plotOptions: {
	        column: {
	            pointPadding: 0.1,
	            borderWidth: 0,
	            dataLabels: {
	                enabled: true,
	                format: '{point.y}'
	            }
	        }
	    },
	    series: qtd_geral
	});

	console.log( qtd_por_situacao );


	Highcharts.chart('supervisor-performance', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Supervisor Performance'
	    },
	    subtitle: {
	        text: mes_ano
	    },
	    xAxis: {
	        categories: supervisores,
	        crosshair: true
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: ''
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	            '<td style="padding:0"><b>{point.y}</b></td></tr>',
	        footerFormat: '</table>',
	        shared: true,
	        useHTML: true
	    },
	    plotOptions: {
	        column: {
	            pointPadding: 0.1,
	            borderWidth: 0,
	            dataLabels: {
	                enabled: true,
	                format: '{point.y}'
	            }
	        }
	    },
	    series: qtd_por_situacao
	});

</script>

