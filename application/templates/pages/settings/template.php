<?php global $application ?>
<?php if( $application->userId != 0 ): ?>
	<div class="row">
		<div class="large-12 columns">
			<h3><?php echo __('Settings') ?></h3>
			<h4><?php echo __('General settings') ?></h4>
		    <form id="settings-form" autocomplete="off" class="custom">
		        <div class="row">
		            <div class="large-6 columns">
		                <label for="settings-first-name-input"><?php echo __('First name') ?>:</label>
		                <input id="settings-first-name-input" name="first_name" type="text" value="<?php echo $application->userProfile->first_name ?>" />
		            </div>
					<div class="large-6 columns">
		                <label for="settings-last-name-input"><?php echo __('Last name') ?>:</label>
		                <input id="settings-last-name-input" name="last_name" type="text" value="<?php echo $application->userProfile->last_name ?>" />
		            </div>
		        </div>
		        <div class="row">
		        	<div class="large-12 columns">
			            <label for="settings-gender-select"><?php echo __('Gender') ?>:</label>
			            <select id="settings-gender-select" name="gender">
			                <option value="">-- <?php echo __('select') ?> --</option>
			                <option value="male" <?php echo $application->userProfile->gender == 'male' ? 'selected="selected"' : '' ?>>
			                	<?php echo __('Male') ?>
			                </option>
			                <option value="female" <?php echo $application->userProfile->gender == 'female' ? 'selected="selected"' : '' ?>>
			                	<?php echo __('Female') ?>
			                </option>
			            </select>
			        </div>
		        </div>
		        <div class="row">
		        	<div class="large-12 columns">
		                <label for="settings-birthday-input"><?php echo __('Birthday') ?> <small>(YYYY-MM-DD)</small>:</label>
		                <input id="settings-birthday-input" name="birthday" type="text" />
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="large-12 columns">
		        		<button id="settings-button" class="large button expand"><?php echo __('Save profile') ?></button>
		        	</div>
		        </div>
		    </form>
		</div>
	</div>
<?php else: ?>
	<script>
		window.location.href="<?php echo BASE_URL ?>404";
	</script>
<?php endif; ?>