<?php
	global $application;
	$childId = $application->router->fragment(1);
	$childProfile = $application->parentsChild( $childId );
?>
<?php if( $application->userId != 0 ): ?>
	<script>
		var childId = <?php echo $childId != false ? $childId : 0 ?>;
		var childProfile = <?php echo json_encode( $childProfile ) ?>;
	</script>
	<div class="row">
		<div class="large-6 columns">
	        <h3>
	        	<?php echo __('Entries') ?> 
	        	<?php if( $childProfile != false ): ?>
	        		<?php echo __('for') ?>  
	        		<kbd><?php echo $childProfile->first_name . ' ' . $childProfile->last_name ?></kbd>
	        	<?php endif; ?>
	        </h3>
	    </div>
	    <div class="large-6 columns">
	        <form class="custom row">
	            <div class="large-12 columns">
	                <label for="filter-by-type-select"><?php echo __('Filter by type') ?>:</label>
	                <select id="filter-by-type-select">
	                        <option value="all"><?php echo __('Show all') ?></option>
	                        <option value="measurement"><?php echo __('Measurement') ?></option>
	                        <option value="symptom"><?php echo __('Symptom') ?></option>
	                        <option value="medication"><?php echo __('Medication') ?></option>
	                        <option value="activity"><?php echo __('Activity') ?></option>
	                        <option value="food"><?php echo __('Food') ?></option>
	                        <option value="disease"><?php echo __('Disease') ?></option>
	                        <option value="event"><?php echo __('Event') ?></option>
	                        <option value="other"><?php echo __('Other') ?></option>
	                </select>
	            </div>
	        </form>
	    </div>
	</div>
	<div class="row">
	    <div class="large-12 columns">
	        <button id="add-new-entry-open-modal-button" data-reveal-id="add-new-entry-modal" class="large button expand"><?php echo __('Add new entry') ?></button>
	        <table id="entries-table" style="width: 100%;">
	            <thead>
	                <tr>
	                    <th width="180"><?php echo __('Time') ?></th>
	                    <th><?php echo __('Type') ?></th>
	                    <th><?php echo __('Data') ?></th>
	                    <th><?php echo __('Mood') ?> & <?php echo __('Note') ?></th>
	                    <th width="200"><?php echo __('Actions') ?></th>
	                </tr>
	            </thead>
	            <tbody id="entries-table-body">
	            	<tr>
	            		<td colspan="5" style="text-align: center;">
	            			<img src="<?php echo BASE_URL ?>assets/img/ajax-loader.gif" alt="Ajax loader" />
	            		</td>
	            	</tr>
	            </tbody>
	        </table>
	    </div>
	</div>
<?php else: ?>
	<script>
		window.location.href="<?php echo BASE_URL ?>404";
	</script>
<?php endif; ?>