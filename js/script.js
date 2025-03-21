// filter

$(document).ready(function(){

  filter_data();

  function filter_data()
  {
      var action = 'fetch_data';
      var min_price = $('#min_price').val();
      var max_price = $('#max_price').val();
      var style = get_filter('style');
      var type = get_filter('type');
      var rating = get_filter('filter-rating');
      var reviews = get_filter('filter-reviews');
      var discount = get_filter('filter-discount');
      $.ajax({
          url:"../php/fetch_data.php",
          method:"POST",
          data:{action:action, min_price:min_price, max_price:max_price, style:style, type:type, category:category, rating:rating, reviews:reviews, discount:discount},
          success:function(data){
              $('#searchResults').html(data);
          }
      });
  }

  function get_filter(class_name)
  {
      var filter = [];
      $('.'+class_name+':checked').each(function(){
          filter.push($(this).val());
      });
      return filter;
  }

  $('.selector').click(function(){
      filter_data();
  });

  $("#slider-range").slider({
        
        range: true,
        orientation: "horizontal",
        min: 5,
        max: 50,
        values: [5, 50],
        step: 5,
        slide: function (event, ui) {
          if (ui.values[0] == ui.values[1]) {
              return false;
          }
          
          $("#min_price").val(ui.values[0]);
          $("#max_price").val(ui.values[1]);

          filter_data();
        }
      });

});
