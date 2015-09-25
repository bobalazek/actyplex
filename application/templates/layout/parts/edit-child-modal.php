<div id="edit-child-modal" class="reveal-modal">
    <a class="close-reveal-modal">&#215;</a>
    <h2><?php echo __('Edit a child') ?></h2>
    <form id="edit-child-form" autocomplete="off" class="custom">
    	<input id="edit-child-id-input" type="hidden" name="id" value="0" />
        <div class="row">
            <div class="large-6 columns">
                <label for="edit-child-first-name-input"><?php echo __('First name') ?>:</label>
                <input id="edit-child-first-name-input" name="first_name" type="text" />
            </div>
			<div class="large-6 columns">
                <label for="edit-child-last-name-input"><?php echo __('Last name') ?>:</label>
                <input id="edit-child-last-name-input" name="last_name" type="text" />
            </div>
        </div>
        <div class="row">
        	<div class="large-12 columns">
	            <label for="edit-child-gender-select"><?php echo __('Gender') ?>:</label>
	            <select id="edit-child-gender-select" name="gender">
	                <option value="">-- <?php echo __('select') ?> --</option>
	                <option value="male"><?php echo __('Male') ?></option>
	                <option value="female"><?php echo __('Female') ?></option>
	            </select>
	        </div>
        </div>
        <div class="row">
        	<div class="large-12 columns">
                <label for="edit-child-birthday-input"><?php echo __('Birthday') ?> <small>(YYYY-MM-DD)</small>:</label>
                <input id="edit-child-birthday-input" name="birthday" type="text" class="datepicker-input" />
        	</div>
        </div>
        <div class="row">
        	<div class="large-12 columns">
        		<button id="edit-child-save-child-button" class="large button expand"><?php echo __('Save child') ?></button>
        	</div>
        </div>
    </form>
</div>