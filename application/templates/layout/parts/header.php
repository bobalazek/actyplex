<header id="header">
    <div class="row">
        <div class="large-12 columns">
            <div id="ajax-loader">
                <img src="<?php echo BASE_URL ?>assets/img/ajax-loader-small.gif" alt="Ajax loader" />
            </div>
        </div>
    </div>
    <div class="row">
        <div id="top-bar" class="fixed contain-to-grid">
			<nav class="top-bar" data-options="custom_back_text:false">
				<ul class="title-area">
					<li class="name">
						<h1>
							<a href="<?php echo BASE_URL ?>">
								<span style="color: #6599FF;">Acty</span><span style="color: #64FF54;">Plex</span>
								<small style="color: #fff;">Micro</small>
								<small style="color: #c60f13;">*Pre-Alpha*</small>
							</a>
						</h1>
					</li>
					<li class="toggle-topbar menu-icon">
						<a href="#">
							<span><?php echo __('Menu') ?></span>
						</a>
					</li>
				</ul>
				<section class="top-bar-section">
					<ul class="left">
						<li class="divider"></li>
	            		<li class="<?php echo $application->router->fragment(0) == false ? 'active' : '' ?>">
			            	<a href="<?php echo BASE_URL ?>">
			            		<?php echo __('Home') ?>
			            	</a>
			            </li>
			            <?php if( $application->userId ): ?>
			            	<li class="divider"></li>
		            		<li class="<?php echo $application->router->fragment(0) == 'entries' ? 'active' : '' ?>">
				            	<a href="<?php echo BASE_URL ?>entries">
				            		<?php echo __('Entries') ?>
				            	</a>
				            </li>
			            <?php endif; ?>
			            <li class="divider"></li>
					</ul>
					<ul class="right">
						<li class="divider"></li>
		            	<?php if( ! $application->userId ): ?>
		            		<li>
				            	<a href="#" id="open-sign-in-button" data-reveal-id="sign-in-modal">
				            		<?php echo __('Sign in') ?>
				            	</a>
				            </li>
			            <?php else: ?>
			            	<li class="has-dropdown <?php echo ( $application->router->fragment(0) == 'profile' || $application->router->fragment(0) == 'patients' || $application->router->fragment(0) == 'administration' || $application->router->fragment(0) == 'children' ) ? 'active' : '' ?>">
	            				<a href="#" id="user-name">
	            					<?php echo $application->userProfile->name ?>
	            				</a>
	            				<ul class="dropdown">
	            					<li class="<?php echo $application->router->fragment(0) == 'profile' ? 'active' : '' ?>">
			            				<a href="<?php echo BASE_URL ?>profile">
			            					<?php echo __('Profile') ?>
			            				</a>
	            					</li>
	            					<li class="<?php echo $application->router->fragment(0) == 'children' ? 'active' : '' ?>">
			            				<a href="<?php echo BASE_URL ?>children">
			            					<?php echo __('Children') ?>
			            				</a>
	            					</li>
	            					<?php if( $application->userProfile->type == 'doctor' ): ?>
		            					<li class="<?php echo $application->router->fragment(0) == 'patients' ? 'active' : '' ?>">
				            				<a href="<?php echo BASE_URL ?>patients">
				            					<?php echo __('Patients') ?>
				            				</a>
		            					</li>
	            					<?php endif; ?>
	            					<?php if( $application->userProfile->type == 'administrator' ): ?>
		            					<li class="<?php echo $application->router->fragment(0) == 'administration' ? 'active' : '' ?>">
				            				<a href="<?php echo BASE_URL ?>administration">
				            					<?php echo __('Administration') ?>
				            				</a>
		            					</li>
	            					<?php endif; ?>
	            				</ul>
	            			</li>
	            			<li class="divider"></li>
				            <li class="<?php echo $application->router->fragment(0) == 'settings' ? 'active' : '' ?>">
				            	<a href="<?php echo BASE_URL ?>settings">
				            		<?php echo __('Settings') ?>
				            	</a>
				            </li>
				            <li class="divider"></li>
		            		<li>
				            	<a href="#" id="sign-out-button">
				            		<?php echo __('Sign out') ?>
				            	</a>
				            </li>
			      		<?php endif; ?>
					</ul>
				</section>
			</nav>
		</div>
	</div>
</header>