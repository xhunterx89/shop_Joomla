/**
 * @version		$Id$
 * @author		Pham Minh Tuan (admin@vnskyline.com)
 * @subpakage	Skyline.ScrollToTop
 * @copyright	Copyright (c) 2012 Skyline Software (http://www.vnskyline.com). All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

var Skyline_ScrollToTop	= new Class({
	Implements: [Options],

	options: {
		'id':			'scrollToTop',
		'className':	'scrollToTop',
		'text':			'^ Scroll to Top',
		'title':		'Scroll to Top',
		'transition':	Fx.Transitions.linear,
		'duration':		500
	},

	initialize:	function(options) {
		this.setOptions(options);

		// Create scroll FX
		this.scrollFx	= new Fx.Scroll(window, {
			transition:	this.options.transition,
			duration:	this.options.duration
		});
		
		// Create 'Scroll to Top' link and insert it to body
		this.scrollLink	= new Element('a', {
			'id':		this.options.id,
			'html':		this.options.text,
			'title':	this.options.title,
			'class':	this.options.className,
			'events': {
				mouseover: function() {
					this.scrollLink.fade(1);
				}.bind(this),
				
				mouseout: function() {
					if (this.scrollLink.getStyle('visibility') == 'visible') {
						this.scrollLink.fade(0.7);
					}
				}.bind(this),

				// Scroll to top on click
				click: function() {
					this.scrollFx.toTop();
				}.bind(this)
			}
		}).inject(document.id(document.body));

		// Show/Hide 'Scroll to Top' link
		if (window.getScrollTop() != 0) {
			this.scrollLink.fade(0.7);
		}

		window.addEvent('scroll', function() {
			var flag = this.scrollLink.getStyle('visibility') == 'visible';
			
			if (window.getScrollTop() != 0 && !flag) {
				this.scrollLink.fade(0.7);
			} else if (window.getScrollTop() == 0 && flag) {
				this.scrollLink.fade(0);
			}
		}.bind(this));
	}
});