<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <input type="search" class="search-field"
            placeholder="<?php echo esc_attr__( 'Search …', 'fotografo' ) ?>"
            value="<?php echo get_search_query() ?>" 
			name="s"
            title="<?php echo esc_attr__( 'Search for:', 'fotografo' ) ?>" />
    <button class="search-submit"><?php echo esc_html__( 'Search', 'fotografo' ) ?></button>
</form>