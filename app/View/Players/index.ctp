<div class="players index">
	<h2><?php echo __('Jogadores');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('nome');?></th>
			<th><?php echo $this->Paginator->sort('presencas');?></th>
			<th><?php echo $this->Paginator->sort('ranking');?></th>
			<th><?php echo $this->Paginator->sort('vitorias');?></th>
			<th><?php echo $this->Paginator->sort('golos');?></th>
            <th><?php echo $this->Paginator->sort('golos_p_jogo');?></th>
            <th><?php echo $this->Paginator->sort('equipa_m');?></th>
            <th><?php echo $this->Paginator->sort('equipa_s');?></th>
            <th><?php echo $this->Paginator->sort('equipa_m_p_jogo');?></th>
            <th><?php echo $this->Paginator->sort('equipa_s_p_jogo');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($players as $player): ?>
	<tr>
		<td><?php echo h($player['Player']['nome']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['presencas']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['ranking']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['vitorias']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['golos']); ?>&nbsp;</td>
        <td><?php echo h($player['Player']['golos_p_jogo']); ?>&nbsp;</td>
        <td><?php echo h($player['Player']['equipa_m']); ?>&nbsp;</td>
        <td><?php echo h($player['Player']['equipa_s']); ?>&nbsp;</td>
        <td><?php echo h($player['Player']['equipa_m_p_jogo']); ?>&nbsp;</td>
        <td><?php echo h($player['Player']['equipa_s_p_jogo']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $player['Player']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
