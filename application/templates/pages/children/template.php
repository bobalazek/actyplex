<?php global $application ?>
<?php if( $application->userId != 0 ): ?>
	<div class="row">
		<div class="large-12 columns">
			<h3><?php echo __('Children') ?></h3>
			<div>
		        <table id="children-table" style="width: 100%;">
		            <thead>
		                <tr>
		                    <th><?php echo __('First name') ?></th>
		                    <th><?php echo __('Last name') ?></th>
		                    <th><?php echo __('Gender') ?></th>
		                    <th><?php echo __('Birthday') ?></th>
		                    <th width="280"><?php echo __('Actions') ?></th>
		                </tr>
		            </thead>
		            <tbody id="children-table-body">
		            	<tr>
		            		<td colspan="5" style="text-align: center;">
		            			<img src="<?php echo BASE_URL ?>assets/img/ajax-loader.gif" alt="Ajax loader" />
		            		</td>
		            	</tr>
		            </tbody>
		        </table>
				<button id="add-a-child-open-modal-button" data-reveal-id="add-a-child-modal" class="large button expand"><?php echo __('Add a child') ?></button>
			</div>
		</div>
	</div>
<?php else: ?>
	<script>
		window.location.href="<?php echo BASE_URL ?>404";
	</script>
<?php endif; ?>