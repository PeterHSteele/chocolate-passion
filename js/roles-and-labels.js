( function( $ ){

	class chocolatePassionRolesAndLabels {

		constructor(){
			this.lisWithSubmenus = $('.menu-item-has-children');
		}

		run(){
			this.addPopUpLabels();
		}

		addPopUpLabels(){
			this.lisWithSubmenus.each(function(){
				$( this ).attr( 'aria-haspopup', true );
			})
		}
	
	}

	const cpRolesAndLabels = new chocolatePassionRolesAndLabels();
	cpRolesAndLabels.run();

} (jQuery) )