var $ = jQuery;
$(document).ready(function() {
  $('#explore').click(function(e) {
    e.preventDefault();

    var type = $("#cat_type").val();
    document.querySelector('.post-cats').value = type;
    
    data = {
      'action' : 'load_filter',
      'cat_type' : type,
    },
    $.ajax({
      url : load_filter_params.ajax_url,
      data : data,
      type : 'POST',
      success(data) {
        if (data) {
          $('.resource-post').empty();
          $('.resource-post').append(data);
        } else {
          console.log('Does Not Works');
        }
      },
      error(error){
        console.log(error);
      }
    });
  });

  $('#load_more_resources').click(function(e) {
    e.preventDefault();
    var button = $(this);
    var category_post = document.querySelector('.post-cats').value;
    console.log(category_post);
    if (category_post ) {
      data = {
        'action' : 'load_more_filter',
        'page' : load_filter_params.current_page++,
        'cat_type' : category_post,
      };
    } else {
      data = {
        'action' : 'load_more_filter',
        'page' : load_filter_params.current_page,
      };
    }
    
    $.ajax({
        url : load_filter_params.ajax_url,
        data : data,
        type : 'POST',
        beforeSend() {
          button.text('Loading...')
        },
        success(data) {
        if (data) {
          button.text('Load More');
          $('.resource-post').append(data);
          load_filter_params.current_page++;
          console.log(load_filter_params.current_page);
          if (load_filter_params.current_page == load_filter_params.max_page ) {
            button.remove();
          }
        } else {
          button.remove();
        }
      },
      error(error){
        console.log(error)
      }
    });
  });
});