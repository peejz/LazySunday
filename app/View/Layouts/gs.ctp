<!DOCTYPE HTML>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('game_sheet');
    ?>
</head>
<body>

<div class='sheet'>

<div class='assistencias'></div>
<div class='golos'></div>

<div class='gameSheet'>

<table>
    <tr class='header'>
        <td></td>
        <td>sem assist.</td>
        <?php foreach($generatedTeams['team_1'] as $player){ ?>
        <td class='playerAssists'><?php echo $player['name']; }?></td>
    </tr>

    <?php $i=1 ?>
    <?php foreach($generatedTeams['team_1'] as $player){ ?>
    <tr>
        <td class='playerGoals'><?php echo $player['name']; ?></td>
        <td></td>
        <td><?php if($i==1){ echo "------"; } ?></td>
        <td><?php if($i==2){ echo "------"; } ?></td>
        <td><?php if($i==3){ echo "------"; } ?></td>
        <td><?php if($i==4){ echo "------"; } ?></td>
        <td><?php if($i==5){ echo "------"; } ?></td>
    </tr>
    <?php $i++; }?>

</table>
</div>

</div>
<div class='sheet'>

    <div class='assistencias'></div>
    <div class='golos'></div>
<div class='gameSheet'>

    <table>
        <tr class='header'>
            <td></td>
            <td>sem assist.</td>
            <?php foreach($generatedTeams['team_2'] as $player){ ?>
        <td class='playerAssists'><?php echo $player['name']; }?></td>
        </tr>

        <?php $i=1 ?>
        <?php foreach($generatedTeams['team_2'] as $player){ ?>
        <tr>
            <td class='playerGoals'><?php echo $player['name']; ?></td>
            <td></td>
            <td><?php if($i==1){ echo "------"; } ?></td>
            <td><?php if($i==2){ echo "------"; } ?></td>
            <td><?php if($i==3){ echo "------"; } ?></td>
            <td><?php if($i==4){ echo "------"; } ?></td>
            <td><?php if($i==5){ echo "------"; } ?></td>
        </tr>
        <?php $i++; }?>

    </table>
</div>
</div>

</body>
</html>