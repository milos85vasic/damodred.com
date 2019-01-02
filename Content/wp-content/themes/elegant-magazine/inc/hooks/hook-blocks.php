<?php
if (!function_exists('elegant_magazine_page_layout_blocks')) :
    /**
     *
     * @since Elegant Magazine 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function elegant_magazine_page_layout_blocks($archive_layout='full') {

        if(empty($archive_layou))
        $archive_layout = elegant_magazine_get_option('archive_layout');

        switch ($archive_layout) {
            case "archive-layout-list":
                elegant_magazine_get_block('lists');
                break;
            case "archive-layout-full":
                elegant_magazine_get_block('full');
                break;
            default:
                elegant_magazine_get_block('full');
        }
    }
endif;
