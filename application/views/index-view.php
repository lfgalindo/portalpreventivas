
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
						echo '<div class="col-md-1">';

						echo form_label( "Supervisor: ", "search_supervisor");

						echo '</div>';

						echo '<div class="col-md-4">';

						echo form_dropdown( "search_supervisor", $select_supervisores, $search_supervisor, array( "class" => "cadastro" ));

						echo '</div>';

						echo '<div class="col-md-1 col-md-offset-2">';

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

				<?php if ( $search_supervisor == "0" ): ?>

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

					<?php 
						
						foreach ( tipos_preventivas() as $tipo => $nome ){

							if ( count( $nomes_supervisores_tipo[$tipo] ) > 0 ){

								echo '<div class="row">';
								echo '<div class="col-md-12">';
								echo '<div id="supervisor-' . $tipo . '" style="min-width: 310px; height: 400px; margin: 0 auto"></div>';
								echo '</div>';
								echo '</div>';
								
							}

						}

					else:

						foreach ( tipos_preventivas() as $tipo => $nome ){

							if ( count( $nomes_tecnicos_tipo[$tipo] ) > 0 ){

								echo '<div class="row">';
								echo '<div class="col-md-12">';
								echo '<div id="tecnico-' . $tipo . '" style="min-width: 310px; height: 400px; margin: 0 auto"></div>';
								echo '</div>';
								echo '</div>';
								
							}

						}

					endif;
				?>

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

	var mes_ano = "<?php echo nome_mes( (int) $mes ) . " de " . $ano; ?>";

	<?php 

		if ( $search_supervisor == "0" ):

			echo "var supervisores = JSON.parse('" . json_encode( $nomes_supervisores ) . "');";
			echo "var qtd_geral = JSON.parse('" . json_encode( $qtd_geral ) . "');";
			echo "var qtd_por_situacao = JSON.parse('" . json_encode( $qtd_por_situacao ) . "');";
					
			foreach ( tipos_preventivas() as $tipo => $nome ){

				echo "var supervisores_" . $tipo . " = JSON.parse('" . json_encode( $nomes_supervisores_tipo[$tipo] ) . "');";
				echo "var qtd_por_situacao_" . $tipo . " = JSON.parse('" . json_encode( $qtd_por_situacao_tipo[$tipo] ) . "');";

			}

		?>

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
		    series: qtd_geral,
		    colors: ['#7cb5ec', '#434348', '#f7a35c', '#90ed7d']
		});

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
		    series: qtd_por_situacao,
		    colors: ['#7cb5ec', '#434348', '#f7a35c', '#90ed7d']
		});

		<?php 
						
			foreach ( tipos_preventivas() as $tipo => $nome ){

				if ( count( $nomes_supervisores_tipo[$tipo] ) > 0 ){

				?>

				Highcharts.chart(<?php echo "'supervisor-" . $tipo . "'"; ?>, {
				    chart: {
				        type: 'column'
				    },
				    title: {
				        text: <?php echo "'Preventivas " . $nome . "'"; ?>
				    },
				    subtitle: {
				        text: mes_ano
				    },
				    xAxis: {
				        categories: <?php echo "supervisores_" . $tipo . ""; ?>,
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
				    series: <?php echo "qtd_por_situacao_" . $tipo . ""; ?>,
		    		colors: ['#7cb5ec', '#434348', '#f7a35c', '#90ed7d']
				});

				<?php

				}

			}

		else:

			foreach ( tipos_preventivas() as $tipo => $nome ){

				echo "var tecnicos_" . $tipo . " = JSON.parse('" . json_encode( $nomes_tecnicos_tipo[$tipo] ) . "');";
				echo "var qtd_por_situacao_" . $tipo . " = JSON.parse('" . json_encode( $qtd_por_situacao_tipo[$tipo] ) . "');";

				echo "console.log(qtd_por_situacao_bts);";

				if ( count( $nomes_tecnicos_tipo[$tipo] ) > 0 ){

				?>

				Highcharts.chart(<?php echo "'tecnico-" . $tipo . "'"; ?>, {
				    chart: {
				        type: 'column'
				    },
				    title: {
				        text: <?php echo "'Preventivas " . $nome . "'"; ?>
				    },
				    subtitle: {
				        text: mes_ano
				    },
				    xAxis: {
				        categories: <?php echo "tecnicos_" . $tipo . ""; ?>,
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
				    series: <?php echo "qtd_por_situacao_" . $tipo . ""; ?>,
		    		colors: ['#7cb5ec', '#434348', '#f7a35c', '#90ed7d']
				});

				<?php

				}

			}

		endif;

	?>

</script>

