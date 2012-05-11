<?php
foreach($playerEvo as $evo) {
    //debug($evo);
}
?>
<script>
    var chart1; // globally available
    $(document).ready(function() {
        chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'pgraph',
                type: 'line'
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Evolução do Ranking'
            },
            yAxis: {
                title: {
                    text: 'Ranking'
                },
                min: 0,
                max: 1,
                tickInterval: 0.2
            },
            xAxis: {
                categories: []
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: false
                    }
                }
            },
            series: [{
                name: '<?php  echo __($player['Player']['nome']);?>',
                data: [<?php foreach($playerEvo as $evo) { echo($evo['Player']['rating']); echo ', '; } ?>]
            }]
        });
    });
</script>
<?php echo $this->Html->script('highcharts'); ?>
<div class="players view">
<h2><?php  echo __($player['Player']['nome']);?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($player['Player']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($player['Player']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Presencas'); ?></dt>
		<dd>
			<?php echo h($player['Player']['presencas']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rating'); ?></dt>
		<dd>
			<?php echo h($player['Player']['rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vitorias'); ?></dt>
		<dd>
			<?php echo h($player['Player']['vitorias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Golos'); ?></dt>
		<dd>
			<?php echo h($player['Player']['golos']); ?>
			&nbsp;
		</dd>
	</dl>
    <div id="pgraph" class="playerGraph">

    </div>
</div>

</div>