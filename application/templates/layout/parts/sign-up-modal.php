<div id="sign-up-modal" class="reveal-modal">
    <a class="close-reveal-modal">&#215;</a>
    <h2><?php echo __('Sign up') ?></h2>
    <form id="sign-up-form" autocomplete="off" class="custom">
        <div class="row">
            <div class="large-6 columns">
                <label for="sign-up-first-name-input"><?php echo __('First name') ?>:</label>
                <input id="sign-up-first-name-input" name="first_name" type="text" />
            </div>
			<div class="large-6 columns">
                <label for="sign-up-last-name-input"><?php echo __('Last name') ?>:</label>
                <input id="sign-up-last-name-input" name="last_name" type="text" />
            </div>
        </div>
        <div class="row">
        	<div class="large-12 columns">
                <label for="sign-up-email-input"><?php echo __('Email') ?>:</label>
                <input id="sign-up-email-input" name="email" type="text" />
        	</div>
        </div>
        <div class="row">
        	<div class="large-6 columns">
                <label for="sign-up-password-input"><?php echo __('Password') ?>:</label>
                <input id="sign-up-password-input" name="password" type="password" />
        	</div>
        	<div class="large-6 columns">
                <label for="sign-up-repeat-password-input"><?php echo __('Repeat password') ?>:</label>
                <input id="sign-up-repeat-password-input" name="repeat_password" type="password" />
        	</div>
        </div>
        <div class="row">
        	<div class="large-12 columns">
	            <label for="sign-up-gender-select"><?php echo __('Gender') ?>:</label>
	            <select id="sign-up-gender-select" name="gender">
	                <option value="">-- <?php echo __('select') ?> --</option>
	                <option value="male"><?php echo __('Male') ?></option>
	                <option value="female"><?php echo __('Female') ?></option>
	            </select>
	        </div>
        </div>
        <div class="row">
        	<div class="large-12 columns">
                <label for="sign-up-birthday-input"><?php echo __('Birthday') ?> <small>(YYYY-MM-DD)</small>:</label>
                <input id="sign-up-birthday-input" name="birthday" type="text" />
        	</div>
        </div>
        <div class="row">
        	<div class="large-12 columns">
        		<button id="sign-up-button" class="large button expand"><?php echo __('Sign up') ?></button>
        	</div>
        </div>
    </form>
    <div id="sign-up-success-alert" data-alert class="alert-box success" style="display: none;">
    	<?php echo __('You have successfully signed up. Close this box and sign in') ?>!
    </div>
    <div id="sign-up-error-alert" data-alert class="alert-box alert" style="display: none;">
    	<?php echo __('Whoops! Something went wrong. Please contact the administrator') ?>!
    </div>
</div>