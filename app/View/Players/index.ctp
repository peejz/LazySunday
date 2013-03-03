<div class="players index">
<!--	<h2>--><?php //echo __('Jogadores');?><!--</h2>-->
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><h2><?php echo $this->Paginator->sort('nome', 'Nome');?></h2></th>
			<th><h2><?php echo $this->Paginator->sort('presencas', 'Pre');?></h2></th>
			<th><h2><?php echo $this->Paginator->sort('rating', 'R');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('ratingLouie','R Louie');?></h2></th>
			<th><h2><?php echo $this->Paginator->sort('vitorias','V');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('vit_pre','V/P');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('golos_p_jogo','G/J (Total)');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('assist_p_jogo','A/J (Total)');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('equipa_m_p_jogo','EM/J (Total)');?></h2></th>
            <th><h2><?php echo $this->Paginator->sort('equipa_s_p_jogo','ES/J (Total)');?></h2></th>
	</tr>
	<?php
	foreach ($players as $player): ?>
	<tr>
		<td><?php echo $this->Html->link(__($player['Player']['nome']), array('action' => 'view', $player['Player']['id'])); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['presencas']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['rating']); ?>&nbsp;</td>
        <td><?php echo h($player['Player']['ratingLouie']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['vitorias']); ?>&nbsp;</td>
        <td><?php echo h($player['Player']['vit_pre']); ?>&nbsp;</td>
        <td><?php echo h($player['Player']['golos_p_jogo']); ?> (<?php echo h($player['Player']['golos']); ?>)&nbsp;</td>
        <td><?php echo h($player['Player']['assist_p_jogo']); ?> (<?php echo h($player['Player']['assist']); ?>)&nbsp;</td>
        <td><?php echo h($player['Player']['equipa_m_p_jogo']); ?> (<?php echo h($player['Player']['equipa_m']); ?>)&nbsp;</td>
        <td><?php echo h($player['Player']['equipa_s_p_jogo']); ?> (<?php echo h($player['Player']['equipa_s']); ?>)&nbsp;</td>

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
