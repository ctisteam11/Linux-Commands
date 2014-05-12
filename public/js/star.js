$(document).ready(function(){
      $(".ratingStar").rating({'min' : 0, 'max' : 5, 'step' : 1, 'size' : 'xs'});

      $(".ratingStar").on('rating.change', function(event, value, caption) {
        console.log("Value: " + value);
        $.ajax({
          type: "POST",
          url: '/linuxcommands/index.php/social/save_rating',
          data: {ratingDegree: value, ratedScriptId: $(this).attr("data-id")},
          dataType: 'json',
          success: function(data){
            }
          });
      });
});