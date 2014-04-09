<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text">Search for:</span>
        <input type="search" placeholder="Search..." value="<?php echo esc_attr( get_search_query() ); ?>"  name="s" title="Search for:" />
    </label>
    <input type="submit" class="search-submit" value="Search">
</form>