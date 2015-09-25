<?php global $application ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Actyplex Micro</title>
        <meta name="description" content="A health platform">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="cleartype" content="on">
        <!-- Stylesheets -->
            <link rel="stylesheet" href="<?php echo ASSETS_URL ?>vendor/jquery-ui/themes/base/jquery-ui.css" />
            <link rel="stylesheet" href="<?php echo ASSETS_URL ?>vendor/jquery-ui.timepicker/jquery-ui.timepicker.css" />
            <link rel="stylesheet" href="<?php echo ASSETS_URL ?>vendor/foundation/css/foundation.css" />
            <link rel="stylesheet" href="<?php echo ASSETS_URL ?>vendor/foundation/icons/foundation_icons_general/stylesheets/general_foundicons.css" />
            <link rel="stylesheet" href="<?php echo ASSETS_URL ?>vendor/foundation/plugins/responsive-tables/responsive-tables.css" />
            <link rel="stylesheet" href="<?php echo ASSETS_URL ?>vendor/jquery.toastr/toastr.css" />
            <link rel="stylesheet" href="<?php echo ASSETS_URL ?>css/application.css?rev=<?php echo APPLICATION_REVISION ?>" />
            <style>
				/* http://css-tricks.com/responsive-data-tables/ */
				@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
					/********** Entries table **********/
					#entries-table td:nth-of-type(1):before { content: "<?php echo __('Time') ?>"; }
					#entries-table td:nth-of-type(2):before { content: "<?php echo __('Type') ?>"; }
					#entries-table td:nth-of-type(3):before { content: "<?php echo __('Data') ?>"; }
					#entries-table td:nth-of-type(4):before { content: "<?php echo __('Mood') . '\a & ' . __('Note') ?>"; }
					#entries-table td:nth-of-type(5):before { content: "<?php echo __('Actions') ?>"; }
					
					#entries-table td:nth-of-type(4) { min-height: 45px } /* Fix for Mood & Note column, since it's in two lines */
					
					#entries-table td.no-entries-added { text-align: center; padding: 10px; }
					#entries-table td.no-entries-added:nth-of-type(1):before { content: ""; }
					
					/********** Children table **********/
					#children-table td:nth-of-type(1):before { content: "<?php echo __('First name') ?>"; }
					#children-table td:nth-of-type(2):before { content: "<?php echo __('Last name') ?>"; }
					#children-table td:nth-of-type(3):before { content: "<?php echo __('Gender') ?>"; }
					#children-table td:nth-of-type(4):before { content: "<?php echo __('Birthday') ?>"; }
					#children-table td:nth-of-type(5):before { content: "<?php echo __('Actions') ?>"; }
					
					#children-table td.no-children-added { text-align: center; padding: 10px; }
					#children-table td.no-children-added:nth-of-type(1):before { content: ""; }
				}
        	</style>
        <!-- Stylesheets /END -->
        <!-- Head Javascripts -->
            <script src="<?php echo ASSETS_URL ?>vendor/foundation/js/vendor/custom.modernizr.js"></script>
            <script src="<?php echo ASSETS_URL ?>js/helper.js"></script>
			<?php include 'parts/config-script.php' ?>
			<!-- UserVoice JavaScript SDK (only needed once on a page) -->
			<script>(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/LmCPeca07LdQG3nS6jFQ.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()</script>
			
			<!-- A tab to launch the Classic Widget -->
			<script>
			UserVoice = window.UserVoice || [];
			UserVoice.push(['showTab', 'classic_widget', {
			  mode: 'feedback',
			  primary_color: '#cc6d00',
			  link_color: '#007dbf',
			  forum_id: 213112,
			  tab_label: 'Ideje',
			  tab_color: '#cc6d00',
			  tab_position: 'middle-right',
			  tab_inverted: false
			}]);
			</script>
        <!-- Head Javascripts /END -->
    </head>
    <body style="padding-top: 45px;">
    	<div id="wrapper">
	        <?php include 'parts/header.php' ?>
	        <div id="content">
	        	<?php echo $application->showPage() ?>
	    	</div>
			<?php include 'parts/footer.php' ?>
		</div>
        <!-- Modals -->
        		<?php include 'parts/add-new-entry-modal.php' ?>
        		<?php include 'parts/edit-entry-modal.php' ?>
        		<?php include 'parts/sign-in-modal.php' ?>
        		<?php include 'parts/sign-up-modal.php' ?>
        		<?php include 'parts/add-a-child-modal.php' ?>
        		<?php include 'parts/edit-child-modal.php' ?>
        <!-- Modal /END -->
        <!-- Body Javascripts -->
            <script src="<?php echo ASSETS_URL ?>vendor/jquery/jquery-1.10.1.min.js"></script>
            <script src="<?php echo ASSETS_URL ?>vendor/jquery-ui/ui/minified/jquery-ui.min.js"></script>
            <script src="<?php echo ASSETS_URL ?>vendor/jquery-ui.timepicker/jquery-ui.timepicker.js"></script>
            <script src="<?php echo ASSETS_URL ?>vendor/foundation/js/foundation.min.js"></script>
            <script>$(document).foundation();</script>
            <script src="<?php echo ASSETS_URL ?>vendor/foundation/plugins/responsive-tables/responsive-tables.js"></script>
            <script src="<?php echo ASSETS_URL ?>vendor/jquery.validation/dist/jquery.validate.min.js"></script>
            <?php if( getLanguage() != 'en' ): ?>
            	<script src="<?php echo ASSETS_URL ?>vendor/jquery.validation/localization/messages_<?php echo $application->language ?>.js"></script>
            <?php endif; ?>
            <script src="<?php echo ASSETS_URL ?>vendor/jquery.toastr/toastr.js"></script>
            <script src="<?php echo ASSETS_URL ?>js/datetimepicker-translations.js"></script>
            <script src="<?php echo ASSETS_URL ?>js/application.js?rev=<?php echo APPLICATION_REVISION ?>"></script>
        <!-- Body Javascript /END -->
    </body>
</html>
