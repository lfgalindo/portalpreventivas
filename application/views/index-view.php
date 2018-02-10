
<script src="<?php echo base_url(); ?>assets/highcharts/highcharts.js"></script>
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

	Highcharts.chart('status-preventiva', {
	    chart: {
	        type: 'pie'
	    },
	    title: {
	        text: 'Status de manutenção das preventivas'
	    },
	    subtitle: {
	        text: mes_ano
	    },
	    plotOptions: {
	        series: {
	            dataLabels: {
	                enabled: true,
	                format: '{point.name}: {point.y}'
	            }
	        }
	    },

	    tooltip: {
	        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
	    },
	    series: [{
	        name: 'Status',
	        colorByPoint: true,
	        data: [{
	            name: 'IE',
	            y: 56.33,
	            drilldown: 'IE'
	        }, {
	            name: 'Chrome',
	            y: 24.03,
	            drilldown: 'Chrome'
	        }, {
	            name: 'Firefox',
	            y: 10.38,
	            drilldown: 'Firefox'
	        }, {
	            name: 'Safari',
	            y: 4.77,
	            drilldown: 'Safari'
	        }, {
	            name: 'Opera',
	            y: 0.91,
	            drilldown: 'Opera'
	        }, {
	            name: 'Proprietary or Undetectable',
	            y: 0.2,
	            drilldown: null
	        }]
	    }],
	    drilldown: {
	        series: [{
	            name: 'IE',
	            id: 'IE',
	            data: [
	                ['v11.0', 24.13],
	                ['v8.0', 17.2],
	                ['v9.0', 8.11],
	                ['v10.0', 5.33],
	                ['v6.0', 1.06],
	                ['v7.0', 0.5]
	            ]
	        }, {
	            name: 'Chrome',
	            id: 'Chrome',
	            data: [
	                ['v40.0', 5],
	                ['v41.0', 4.32],
	                ['v42.0', 3.68],
	                ['v39.0', 2.96],
	                ['v36.0', 2.53],
	                ['v43.0', 1.45],
	                ['v31.0', 1.24],
	                ['v35.0', 0.85],
	                ['v38.0', 0.6],
	                ['v32.0', 0.55],
	                ['v37.0', 0.38],
	                ['v33.0', 0.19],
	                ['v34.0', 0.14],
	                ['v30.0', 0.14]
	            ]
	        }, {
	            name: 'Firefox',
	            id: 'Firefox',
	            data: [
	                ['v35', 2.76],
	                ['v36', 2.32],
	                ['v37', 2.31],
	                ['v34', 1.27],
	                ['v38', 1.02],
	                ['v31', 0.33],
	                ['v33', 0.22],
	                ['v32', 0.15]
	            ]
	        }, {
	            name: 'Safari',
	            id: 'Safari',
	            data: [
	                ['v8.0', 2.56],
	                ['v7.1', 0.77],
	                ['v5.1', 0.42],
	                ['v5.0', 0.3],
	                ['v6.1', 0.29],
	                ['v7.0', 0.26],
	                ['v6.2', 0.17]
	            ]
	        }, {
	            name: 'Opera',
	            id: 'Opera',
	            data: [
	                ['v12.x', 0.34],
	                ['v28', 0.24],
	                ['v27', 0.17],
	                ['v29', 0.16]
	            ]
	        }]
	    }
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
	            borderWidth: 0
	        }
	    },
	    series: qtd_por_situacao
	});

</script>

