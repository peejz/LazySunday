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
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($player['Player']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($player['Player']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

</div>
