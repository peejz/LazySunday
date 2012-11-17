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
                type: 'line',
                height: '500',
                width: '600'
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
                min: 200,
                max: 800,
                tickInterval: 200
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

    <div id="pgraph" class="playerGraph">

    </div>
</div>

</div>