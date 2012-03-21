<div class="games index">
    <table>
        <?php foreach ($games as $game): ?>
            <tr>
                <td><?php echo $this->Html->link(__('View'), array('action' => 'view', $game['Game']['id'])); ?>&nbsp;</td>
                <td><?php echo $this->Time->format('d M, Y', $game['Game']['data']); ?>&nbsp;</td>
                <td><?php echo $game['Game']['resultado']; ?>&nbsp;</td>
                <td>
                    <?php
                        if($game['Game']['estado'] == 0) {
                            echo "Convocatória";
                        }
                        elseif ($game['Game']['estado'] == 1) {
                            echo "A decorrer...";
                        }
                        else {
                            echo "Terminado";
                        }

                    ?>
                    &nbsp;</td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
