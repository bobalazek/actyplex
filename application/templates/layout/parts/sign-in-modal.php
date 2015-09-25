<div id="sign-in-modal" class="reveal-modal">
    <a class="close-reveal-modal">&#215;</a>
    <h2><?php echo __('Sign in') ?></h2>
    <form id="sign-in-form" autocomplete="off">
        <div class="row">
            <div class="large-6 columns">
                <label for="sign-in-email-input"><?php echo __('Email') ?>:</label>
                <input id="sign-up-email-input" name="email" type="text" />
            </div>
			<div class="large-6 columns">
                <label for="sign-in-password-input"><?php echo __('Password') ?>:</label>
                <input id="sign-in-last-name-input" name="password" type="password" />
            </div>
        </div>
        <div class="row">
        	<div class="large-12 columns">
				<button id="sign-in-button" class="large button expand">
		    		<?php echo __('Sign in') ?>
		    	</button>
			    <div id="sign-in-error-alert" data-alert class="alert-box alert" style="display: none;">
			    	<?php echo __('Wrong credentials') ?>!
			    </div>
        	</div>
        </div>
    </form>
    <div class="row">
    	<div class="large-12 columns">
		    <div id="sign-in-success-alert" data-alert class="alert-box success" style="display: none;">
		    	<?php echo __('Your credentials are right! Please wait for the redirect') ?>!
		    </div>
		</div>
	</div>
    <h3 class="center"><?php echo __('or') ?></h3>
    <div class="row">
    	<div class="large-12 columns">
		    <button id="sign-yourself-up-form-button" data-reveal-id="sign-up-modal" class="large button expand">
		    	<?php echo __('Sign yourself up') ?>
		    </button>
		</div>
	</div>
</div>