<?php 
defined('_KUHUG') or die('Restricted Access.');

callInnerLayoutHeader();
?>
<div id="viewads" class="container">
	<div class="sectionhead wow bounceInUp" data-wow-duration="2s">
		<span class="bigicon icon-rocket"></span>
		<h3>View Ads</h3>
		<h4>Talent wins games, but teamwork and intelligence win championships.</h4>
		<hr class="separetor">
	</div>
	
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<!--<div class="panel-heading">Panel heading</div>
			<div class="panel-body">
				<p>...</p>
			</div>-->
			
			<!-- Table -->
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th width="30%">Title</th>
						<th width="22%">Category</th>
						<th width="15%">Created By</th>
						<th width="10%" align="center">Published</th>
						<th width="10%" align="center">Activated</th>
						<th width="10%" align="center">Modified On</th>
					</tr>
				</thead>
				<?php if($viewAds->num_rows > 0) { $inc = 1; ?>
				<tbody>
					<?php while($row = $viewAds->fetch_object()) { $jdate = new DateTime($row->modified_on); ?>
					<tr>
						<th scope="row"><?php echo $inc; ?></th>
						<td><a href="#"><?php echo $row->ad_title; ?></a></td>
						<td><?php echo $all_category[$row->category_id]; ?></td>
						<td><?php echo $row->firstname.' '.$row->lastname;?></td>
						<td align="center"><?php echo ($row->published)? '<span class="label label-success">Yes</span>':'<span class="label label-danger">No</span>';?></td>
						<td align="center"><?php echo ($row->status)? '<span class="label label-success">Yes</span>':'<span class="label label-danger">No</span>';?></td>
						<td align="center"><?php echo $jdate->format(DB_DATE_DSPLY_FRMT); ?></td>
					</tr>
					<?php $inc++; } ?>
				</tbody>
				<?php } ?>
			</table>
		</div>
	
</div>