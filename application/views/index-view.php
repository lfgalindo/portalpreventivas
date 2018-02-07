
<script src="<?php echo base_url(); ?>assets/highcharts/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/highcharts/modules/exporting.js"></script>

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
						<div id="supervisor-performance" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					</div>

				</div>

			<?php echo form_close(); ?>

		</div>

	</div>

</div>

<script type="text/javascript">

	var supervisores = JSON.parse('<?php echo json_encode( $supervisores ); ?>');

	Highcharts.chart('supervisor-performance', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Supervisor Performance'
	    },
	    subtitle: {
	        text: 'Fevereiro 2018'
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
	    series: [{
	        name: 'Preventivas programadas',
	        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

	    }, {
	        name: 'Preventivas executadas',
	        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

	    }, {
	        name: 'Relatórios entregues',
	        data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

	    }]
	});

</script>

