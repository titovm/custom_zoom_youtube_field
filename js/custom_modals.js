(function ($, Drupal) {
    Drupal.behaviors.customModalBehavior = {
      attach: function (context, settings) {
        $('.open-modal', context).each(function () {
          if (!$(this).data('initialized')) {
            $(this).data('initialized', true).click(function (e) {
              e.preventDefault();
              var target = $(this).attr('data-target');
              var youtubeId = $(this).attr('data-youtube-id');
              var iframeSrc = 'https://www.youtube.com/embed/' + youtubeId + '?autoplay=1&rel=0';
              
              $(target).find('iframe').attr('src', iframeSrc);
              $(target).show();
            });
          }
        });
  
        $('.close-modal', context).each(function () {
          if (!$(this).data('initialized')) {
            $(this).data('initialized', true).click(function () {
              $(this).closest('.custom-modal').find('iframe').attr('src', '');
              $(this).closest('.custom-modal').hide();
            });
          }
        });
  
        // Close modal if the user clicks anywhere outside of the modal content
        $('.custom-modal', context).each(function () {
          if (!$(this).data('click-initialized')) {
            $(this).data('click-initialized', true).click(function (e) {
              // Check if the clicked element is the modal itself and not its children
              if (e.target === this) {
                $(this).find('iframe').attr('src', '');
                $(this).hide();
              }
            });
          }
        });
      }
    };
  })(jQuery, Drupal);