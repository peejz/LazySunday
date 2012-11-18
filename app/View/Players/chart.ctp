<?php //debug($players); ?>
<script>
    var chart1; // globally available
    $(document).ready(function() {
        chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'pgraph',
                type: 'line',
                height: '650',
                width: '730'
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
                min: 100,
                max: 1000,
                tickInterval: 100
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
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [
                <?php foreach($players as $id => $player):?>
                {
                name: '<?php  echo $id; ?>',
                data: [<?php foreach($player as $game) { echo($game); echo ', '; } ?>]
            },
            <?php endforeach; ?>
            ]
        });
    });
</script>

<!--<div class="players view">
<h2><?php /* echo __($player['Player']['nome']);*/?></h2>-->

<div id="pgraph" class="playerGraph">
    <?php echo $this->Html->script('highcharts'); ?>
</div>