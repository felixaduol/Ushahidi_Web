			<div class="bg">
				<h2><?php echo $title; ?></h2>
				<!-- column -->
				<div class="column">
					<!-- box -->
					<div class="box">
						<h3>Reports Timeline</h3>
						<ul class="inf">
							<li class="none-separator">View:<a href="#" onclick="graphSwitch('day')">Today</a></li>
							<li><a href="#" onclick="graphSwitch('month')">This Month</a></li>
							<li><a href="#" onclick="graphSwitch('year')">This Year</a></li>
						</ul>
						<div id="graph" class="graph-holder"></div>
					</div>
					<!-- info-container -->
					<div class="info-container">
						<div class="i-c-head">
							<h3>Recent Reports</h3>
							<ul>
								<li class="none-separator"><a href="<?php echo url::base() . 'admin/reports' ?>">View All</a></li>
								<li><a href="#" class="rss-icon">rss</a></li>
							</ul>
						</div>
						<?php
						if ($reports_total == 0)
						{
						?>
						<div class="post">
							<h3>No Results To Display!</h3>
						</div>
						<?php	
						}
						foreach ($incidents as $incident)
						{
							$incident_id = $incident->id;
							$incident_title = $incident->incident_title;
							$incident_description = substr($incident->incident_description, 0, 150);
							$incident_date = $incident->incident_date;
							$incident_date = date('g:i A', strtotime($incident->incident_date));
							$incident_mode = $incident->incident_mode;	// Mode of submission... WEB/SMS/EMAIL?
							
							if ($incident_mode == 1)
							{
								$submit_mode = "mail";
							}
							elseif ($incident_mode == 2)
							{
								$submit_mode = "sms";
							}
							elseif ($incident_mode == 3)
							{
								$submit_mode = "mail";
							}
							
							// Incident Status
							$incident_approved = $incident->incident_active;
							if ($incident_approved == '1')
							{
								$incident_approved = "ok";
							}
							else
							{
								$incident_approved = "none";
							}
							
							$incident_verified = $incident->incident_verified;
							if ($incident_verified == '1')
							{
								$incident_verified = "ok";
							}
							else
							{
								$incident_verified = "none";
							}
							?>
							<div class="post">
								<ul class="post-info">
									<li><a href="#" class="<?php echo $incident_approved; ?>">ACTIVE:</a></li>
									<li><a href="#" class="<?php echo $incident_verified ?>">VERIFIED:</a></li>
									<li class="last"><a href="#" class="<?php echo $submit_mode; ?>">SOURCE:</a></li>
								</ul>
								<h4><strong><?php echo $incident_date; ?></strong><a href="<?php echo url::base() . 'admin/reports/edit/' . $incident_id; ?>"><?php echo $incident_title; ?></a></h4>
								<p><?php echo $incident_description; ?>...</p>
							</div>
							<?php
						}
						?>
						<a href="<?php echo url::base() . 'admin/reports' ?>" class="view-all">View All Reports</a>
					</div>
				</div>
				<div class="column-1">
					<!-- box -->
					<div class="box">
						<h3>Quick Stats</h3>
						<ul class="nav-list">
							<li>
								<a href="<?php echo url::base() . 'admin/reports' ?>" class="reports">Reports</a>
								<strong><?php echo $reports_total; ?></strong>
								<ul>
									<li><a href="<?php echo url::base() . 'admin/reports?status=a' ?>">Unapproved</a><strong>(<?php echo $reports_unapproved; ?>)</strong></li>
									<li><a href="<?php echo url::base() . 'admin/reports?status=v' ?>"> Unverified</a><strong>(<?php echo $reports_unverified; ?>)</strong></li>
								</ul>
							</li>
							<li>
								<a href="<?php echo url::base() . 'admin/manage' ?>" class="categories">Categories</a>
								<strong><?php echo $categories; ?></strong>
							</li>
							<li>
								<a href="#" class="locations">Locations</a>
								<strong><?php echo $locations; ?></strong>
							</li>
							<li>
								<a href="<?php echo url::base() . 'admin/manage/feeds' ?>" class="media">Incoming Media</a>
								<strong><?php echo $incoming_media; ?></strong>
							</li>
						</ul>
					</div>
					<!-- info-container -->
					<div class="info-container">
						<div class="i-c-head">
							<h3>Incoming Media</h3>
							<ul>
								<li class="none-separator"><a href="<?php echo url::base() . 'admin/manage/feeds' ?>">View All</a></li>
								<li><a href="#" class="rss-icon">rss</a></li>
							</ul>
						</div>
						<?php
						foreach ($feeds as $feed)
						{
							$feed_id = $feed->id;
							$feed_title = $feed->item_title;
							$feed_description = text::limit_chars(strip_tags($feed->item_description), 100, '...', True);
							$feed_link = $feed->item_link;
							$feed_date = date('M j Y', strtotime($feed->item_date));
							$feed_source = "NEWS";
							?>
							<div class="post">
								<h4><a href="<?php echo $feed_link; ?>" target="_blank"><?php echo $feed_title ?></a></h4>
								<em class="date"><?php echo $feed_source; ?> - <?php echo $feed_date; ?></em>
								<p><?php echo $feed_description; ?></p>
							</div>
							<?php
						}
						?>
						<a href="<?php echo url::base() . 'admin/manage/feeds' ?>" class="view-all">View All Incoming Media</a>
					</div>
				</div>
			</div>

