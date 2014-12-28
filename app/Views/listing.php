<div class="wrap">

	<h2>
		<?php _e($this->post_type->labels->name); ?>
		
		<a href="<?php echo $this->post_type_repo->addNewPostLink($this->post_type->name); ?>" class="add-new-h2">
			<?php _e($this->post_type->labels->add_new); ?>
		</a>

		<?php if ( current_user_can('publish_pages') ) : ?>
		<a href="#" class="add-new-h2 open-bulk-modal" title="<?php _e('Add Multiple', 'nestedpages'); ?>" data-parentid="0">
			<?php _e('Add Multiple', 'nestedpages'); ?>
		</a>
		<?php endif; ?>
		
		<?php if ( current_user_can('publish_pages') && $this->post_type->name == 'page' ) : ?>
		<a href="#" class="add-new-h2 open-redirect-modal" title="<?php _e('Add Link', 'nestedpages'); ?>" data-parentid="0">
			<?php _e('Add Link', 'nestedpages'); ?>
		</a>
		<?php endif; ?>

	</h2>


	<?php if ( $this->confirmation->getMessage() ) : ?>
		<div id="message" class="updated below-h2"><p><?php echo $this->confirmation->getMessage(); ?></p></div>
	<?php endif; ?>


	<div class="np-page-tools">
		<?php if ( $this->post_type->hierarchical ) : ?>
		<ul class="nestedpages-toggleall" <?php if ( $this->confirmation->getMessage() ) echo 'style="margin-top:0"';?>>
			<li><a href="#" class="np-btn" data-toggle="closed"><?php _e('Expand All', 'nestedpages'); ?></a></li>
		</ul>
		<?php endif; ?>

		<?php if ( function_exists('icl_get_languages') ) : // WPML Language Selector ?>
			<div class="np-language-select">
				<form id="np-change-language" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
					<input type="hidden" name="action" value="npLanguageSelect">
					<input type="hidden" name="page" value="<?php echo $this->pageURL(); ?>">
					<?php echo $this->wpml_presenter->languageDropdown(); ?>
				</form>
			</div>
		<?php endif; ?>

		<?php if ( current_user_can('edit_theme_options') && $this->post_type->name == 'page' ) : ?>
		<div class="np-sync-menu-cont" <?php if ( $this->confirmation->getMessage() ) echo 'style="margin-top:2px;"';?>>
			<label>
				<input type="checkbox" name="np_sync_menu" class="np-sync-menu" value="sync" <?php if ( get_option('nestedpages_menusync') == 'sync' ) echo 'checked'; ?>/> <?php _e('Sync Menu', 'nestedpages'); ?>
			</label>
		</div>
		<?php endif; ?>

		<img src="<?php echo plugins_url(); ?>/wp-nested-pages/assets/images/loading.gif" alt="loading" id="nested-loading" />
	</div>


	<?php include(NestedPages\Helpers::view('partials/tool-list')); ?>


	<div id="np-error" class="updated error" style="clear:both;display:none;"></div>


	<div class="nestedpages">

		<?php $this->loopPosts(); ?>
		
		<div class="quick-edit quick-edit-form np-inline-modal" style="display:none;">
			<?php include( NestedPages\Helpers::view('forms/quickedit-post') ); ?>
		</div>

		<?php if ( current_user_can('publish_pages') ) : ?>
		<div class="quick-edit quick-edit-form-redirect np-inline-modal" style="display:none;">
			<?php include( NestedPages\Helpers::view('forms/quickedit-link') ); ?>
		</div>

		<div class="new-child new-child-form np-inline-modal" style="display:none;">
			<?php include( NestedPages\Helpers::view('forms/new-child') ); ?>
		</div>
		<?php endif; ?>
	</div>

</div><!-- .wrap -->

<?php include( NestedPages\Helpers::view('forms/link-form') ); ?>
<?php include( NestedPages\Helpers::view('forms/bulk-add') ); ?>