<div id="txtHint">
	<table class="gen-table">
		<thead>
			<tr>
				<th>Title</th>
				<th>Naat Khawan / Title</th>
				<th>Preview</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="4">Table Footer</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($naat as $catnat) { ?>
			<tr>
				<td><?php echo $catnat['nat_title']; ?></td>
				<td><?php echo $catnat['nat_person']; ?></td>
				<td><!-- <audio src="<?php echo base_url(); ?>img/naat/<?php echo $catnat['naat_file']; ?>" controls preload></audio> -->
				<a href="<?php echo base_url(); ?>img/naat/<?php echo $catnat['naat_file'] ?>">Download</a>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>