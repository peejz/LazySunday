<div class="players index">
	<h2><?php echo __('Jogadores');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><h2><?php echo $this->Paginator->sort('nome', 'Nome');?></h2></th>
			<th><h2><?php echo $this->Paginator->sort('presencas', 'Pre');?></h2></th>
			<th><h2><?php echo $this->Paginator->sort('rating', 'R');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('ratingElo','R Elo');?></h2></th>
			<th><h2><?php echo $this->Paginator->sort('vitorias','V');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('vit_pre','V/P');?></h2></th>
			<th><h2><?php echo $this->Paginator->sort('golos', 'G');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('golos_p_jogo','G/J');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('equipa_m','EM');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('equipa_s','ES');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('equipa_m_p_jogo','EM/J');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('equipa_s_p_jogo','ES/J');?></h2></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($players as $player): ?>
	<tr>
		<td><?php echo h($player['Player']['nome']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['presencas']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['rating']); ?>&nbsp;</td>
        <td><?php echo h($player['Player']['ratingElo']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['vitorias']); ?>&nbsp;</td>
        <td><?php echo h($player['Player']['vit_pre']); ?>&nbsp;</td>
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
