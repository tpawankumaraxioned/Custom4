var $ = jQuery;
$(document).ready(function() {
    $('#explore').click(function(e) {
        e.preventDefault();
    
        var type = $("#cat_type").val();
        
        data = {
          'action' : 'load_filter',
          // 'page' : load_filter_params.current_page,
          'resourcetype' : type,
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
        var button = $(this),
        data = {
            'action' : 'load_more_filter',
            'page' : load_filter_params.current_page,
        };
        console.log(load_filter_params);
        $.ajax({
            url : load_filter_params.ajax_url,
            data : data,
            type : 'POST',
            beforeSend() {
                button.text('Loading...')
            },
            success(data) {
            // console.log(data);
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