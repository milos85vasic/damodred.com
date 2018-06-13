( function( api ) {

	// Extends our custom "excellent" section.
	api.sectionConstructor['excellent'] = api.Section.extend( {

		// No excellents for this type of section.
		attachExcellents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
