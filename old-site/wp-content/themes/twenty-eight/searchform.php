<?php
	$default_search_text = __( 'search here', 'twenty-eight' );
	$search_query = get_search_query();
?>
<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div>
		<input type="text" value="<?php echo esc_attr( !empty( $search_query ) ? $search_query : $default_search_text ); ?>" onfocus="if (this.value == '<?php echo esc_attr( $default_search_text ); ?>' ) { this.value = ''; }" onblur="if (this.value == '') { this.value = '<?php echo esc_attr( $default_search_text ); ?>';}" name="s" id="s" size="15" />
		<input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Go', 'twenty-eight' ); ?>" />
	</div>
</form>