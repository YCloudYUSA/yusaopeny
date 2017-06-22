/**
 * @file
 * Faq paragraph behaviour.
 */
(function ($) {
  Drupal.behaviors.ymacaliFaqParagraph = {
    attach: function( context, settings ) {
      $( context ).find( '.paragraph--type--faq-item' ).once( 'paragraphFaq' ).each( function () {
        // Q/A wrapper.
        var wrapper = $( this );

        // Question click event.
        $( '.field-question', wrapper ).on( 'click', function() {
          var answer = $( '.field-answer', wrapper );

          if ( answer.is( ':hidden') ) {
            answer.slideDown( 200 );
          }
          else {
            answer.slideUp( 200 );
          }
        });

      });
    }
  };

})(jQuery);
