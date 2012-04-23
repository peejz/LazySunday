<div class="games form">
<?php echo $this->Form->create('Game');?>
	<fieldset>
		<legend><?php echo __('Add Game'); ?></legend>
	<?php
        echo $date = $this->Time->format('Y-m-d', time());
		echo $this->Form->input('data', array('selected' => $date.' 18:30:00'));
        ?>
        <?php echo 'Jogadores a convidar:'; ?>
		<table>
            <?php $i=1; ?>
            <?php foreach($players as $key => $player): ?>
            <tr>
                <td><?php echo $i; ?></td>
                    <?php
                        if($i <= 10){$value = true;}
                        else {$value = false;}
                    ?>
                <td width="20"><?php echo $this->Form->checkbox('jogador'.$key, array('checked' => $value)); ?></td>
                <td><?php echo $player; ?></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </table>

	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
