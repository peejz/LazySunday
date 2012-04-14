<?php //debug($gameList); ?>
<? foreach ($gameList as $game) : ?>
<table class="ratingstable">
    <thead>
        <tr>
            <td>Jog</td>
            <td>Rating</td>
        </tr>
    </thead>

<?php foreach($game as $team): ?>
<?php foreach($team as $nome => $rating): ?>
    <tr>
        <?php //debug ($team); ?>
        <td><?php echo $nome; ?><td>
        <td><?php echo $rating; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php endforeach; ?>

</table>

<?php endforeach; ?>