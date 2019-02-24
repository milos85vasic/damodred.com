<?php
defined( 'ABSPATH' ) or die();
?>
<hr>
<div>
	<h3><?php _e('To Exclude the page(s) from Pin Button On Image Hover. Please add page(s) name below:', WEBLIZAR_PINIT_TD); ?></h3>
	<input id="no-pin-image-page" name="no-pin-image-page" type="text" value="" placeholder="<?php _e('Provide Page Name', WEBLIZAR_PINIT_TD); ?>">
	<?php wp_nonce_field( 'pinit_exclude_page_nonce_action', 'pinit_exclude_page_nonce_field' ); ?>
	<button id="add-pin-page-name" name="add-pin-page-name" class="button button-primary" type="button" onclick="return SaveNoPinPage(this.value);"><strong><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php _e('Add', WEBLIZAR_PINIT_TD); ?></strong></button>
	<i id="loading-2" name="loading-2" style="display: none;" class="fa fa-cog fa-spin fa-2x"></i>
	<p class="alert"><strong><?php _e('Note', WEBLIZAR_PINIT_TD); ?>:</strong> <?php _e('Refresh the page to see new added Pages.', WEBLIZAR_PINIT_TD); ?> <button id="refersh-page" name="refersh-page" class="button button-primary" type="button" onclick="return location.reload();"><strong><span class="dashicons dashicons-update"></span><?php _e('Refesh', WEBLIZAR_PINIT_TD); ?></strong></button></p>
</div>
<?php
$all_excluded_pages = NULL;
$all_excluded_pages = get_option('excluded_pint_it_pages');
?>
<table class="table">
	<thead class="thead-dark">
	<tr>
		<th scope="col">#</th>
		<th scope="col">Page</th>
		<th scope="col" class="text-center"><input type="checkbox" id="select-page-all" name="select-page-all[]" value="1" /></th>
	</tr>
	</thead>
	<tbody>
		<?php 
			if ( is_array( $all_excluded_pages ) && count( $all_excluded_pages ) ) { 
				$count = 0;
				foreach ($all_excluded_pages as $exclude_key => $exclude_page) {
					if( $exclude_page ) {
						?>
						<tr id="<?php echo "page-".$exclude_key; ?>">
							<th scope="row"><?php echo $count; ?></i></th>
							<td><?php echo $exclude_page; ?></td>
							<th scope="col" class="text-center"><input type="checkbox" id="select-page-all" name="select-page-all[]" value="<?php echo $exclude_key; ?>" /></th>
						</tr>
						<?php
						$count++;
					}
				}
			}
			else {
				echo '<tr><td colspan="3">No Page(s) Added Yet.</td></tr>';
			}
		?>
	</tbody>
	<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Page</th>
			<th scope="col" class="text-center"><input type="checkbox" id="select-page-all" name="select-page-all[]" value="-1" /></th>
		</tr>
	</thead>
	<tr>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th class="text-center"><button type="button" id="delete-page-all" name="delete-page-all" title="Delte All" onclick="return DeleteAll();"><i class="fa fa-trash"></i></button></th>
	</tr>
</table>
<script type="text/javascript">
	// select all check box
	jQuery("#select-page-all").click(function(){
	    jQuery('input:checkbox').not(this).prop('checked', this.checked);
	});

	function SaveNoPinPage() { 
		var page_name = jQuery("#no-pin-image-page").val();
		if( !page_name ) { 
			jQuery("#no-pin-image-page").focus();
		}

		jQuery('button#add-pin-page-name').hide();
		jQuery('#loading-2').show();
		jQuery.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
				action: "exclude_page", 
				page_name: page_name,
				pinit_exclude_page_nonce_field: jQuery("input#pinit_exclude_page_nonce_field").val(),
			},
			dataType: 'html',
			complete : function() {  },
			success: function(data) {
				jQuery('#loading-2').hide();
				jQuery('button#add-pin-page-name').show();
				jQuery("#no-pin-image-page").val("");
				jQuery("#no-pin-image-page").focus();
			}
		});
	}

	// delete checked urls
	function DeleteAll(){
		var page_ids = [];
		jQuery(':checkbox:checked').each(function(i){
		  page_ids[i] = jQuery(this).val();
		});
		console.log(page_ids);
		console.log(page_ids.length);
		if(page_ids.length){
			
			// remove deleted row from table
			jQuery.each( page_ids, function( key, value ) {
				//alert( value );
				jQuery("#page-"+value).fadeOut(1500);
			});
			
			jQuery.ajax({
				type: "POST",
				url: ajaxurl,
				data: {
					action: "delete_exclude_pages", 
					page_ids: page_ids,
					pinit_exclude_page_nonce_field: jQuery("input#pinit_exclude_page_nonce_field").val(),
				},
				dataType: 'html',
				complete : function() {  },
				success: function(data) {

				}
			});
		}
	}
</script>