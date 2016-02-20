<?php foreach($nbseo_batch->categories as $category) {
?>
	<table class="table_border table_border_cells table_stripes" style="width:95%">
		<thead>
			<tr>
				<th colspan="2" align="left"><?php echo $category['chs'];?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($category['modules'] as $module_name) {
				$module = $nbseo_batch->modules[$module_name];
			?>
				<?php foreach($module['question'] as $question) {?>
			<tr>
				<td width="80%"><a href="nbseo_batch_main.php?module=<?php echo $module_name?>"><?php echo $question;?></a></td>
				<td><?php echo $module['id'];?></td>
			</tr>
			<?php }}?>
		</tbody>
	</table>
<?php 
}
?>