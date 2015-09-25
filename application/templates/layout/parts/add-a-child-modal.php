<div id="add-a-child-modal" class="reveal-modal">
    <a class="close-reveal-modal">&#215;</a>
    <h2><?php echo __('Add a child') ?></h2>
    <form id="add-a-child-form" autocomplete="off" class="custom">
        <div class="row">
            <div class="large-6 columns">
                <label for="add-a-child-first-name-input"><?php echo __('First name') ?>:</label>
                <input id="add-a-child-first-name-input" name="first_name" type="text" />
            </div>
			<div class="large-6 columns">
                <label for="add-a-child-last-name-input"><?php echo __('Last name') ?>:</label>
                <input id="add-a-child-last-name-input" name="last_name" type="text" />
            </div>
        </div>
        <div class="row">
        	<div class="large-12 columns">
	            <label for="add-a-child-gender-select"><?php echo __('Gender') ?>:</label>
	            <select id="add-a-child-gender-select" name="gender">
	                <option value="">-- <?php echo __('select') ?> --</option>
	                <option value="male"><?php echo __('Male') ?></option>
	                <option value="female"><?php echo __('Female') ?></option>
	            </select>
	        </div>
        </div>
        <div class="row">
        	<div class="large-12 columns">
                <label for="add-a-child-birthday-input"><?php echo __('Birthday') ?> <small>(YYYY-MM-DD)</small>:</label>
                <input id="add-a-child-birthday-input" name="birthday" type="text" class="datepicker-input" />
        	</div>
        </div>
        <div class="row">
        	<div class="large-12 columns">
        		<button id="add-a-child-button" class="large button expand"><?php echo __('Add a child') ?></button>
        	</div>
        </div>
    </form>
    <div id="add-a-child-success-alert" data-alert class="alert-box success" style="display: none;">
    	<?php echo __('You have successfully added a child') ?>!
    </div>
    <div id="add-a-child-error-alert" data-alert class="alert-box alert" style="display: none;">
    	<?php echo __('Whoops! Something went wrong. Please contact the administrator') ?>!
    </div>
</div>