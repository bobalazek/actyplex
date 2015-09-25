<?php global $application ?>
<?php if( $application->userId != 0 ): ?>
	<div class="row">
		<div class="large-12 columns">
			<h3><?php echo __('Profile') ?></h3>
			<h4><?php echo $application->userProfile->name ?></h4>
			<div class="panel">
				<div class="row">
					<div class="large-6 columns">
						<p>
							<b><?php echo __('ID') ?>:</b>
							<?php echo $application->userProfile->id ?>
						</p>
						<p>
							<b><?php echo __('First name') ?>:</b>
							<?php echo $application->userProfile->first_name ?>
						</p>
						<p>
							<b><?php echo __('Last name') ?>:</b>
							<?php echo $application->userProfile->last_name ?>
						</p>
					</div>
					<div class="large-6 columns">
						<p>
							<b><?php echo __('Type') ?>:</b>
							<?php echo __( ucfirst($application->userProfile->type) ) ?>
						</p>
						<p>
							<b><?php echo __('Doctor') ?>:</b>
							<?php echo $application->userProfile->doctor_user_id == 0 ? __('No doctor assigned') : 'Dr. Placeholder' ?>
						</p>
						<p>
							<b><?php echo __('Signed up') ?>:</b>
							<?php echo $application->userProfile->time_created ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>
	<script>
		window.location.href="<?php echo BASE_URL ?>404";
	</script>
<?php endif; ?>