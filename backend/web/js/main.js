$(function(){

    for(var i = 0; i < $('#products tr[data-key]').length; i++){
        // add '$' to price
        var old_price = $($('#products tr[data-key]')[i]).children('.price').html();
        $($('#products tr[data-key]')[i]).children('.price').html('$'+old_price);

        // add href to email
        var old_email = $($('#products tr[data-key]')[i]).children('.email').html();
        $($('#products tr[data-key]')[i]).children('.email').html('<a href="mailto:'+old_email+'" target="_top">'+old_email+'</a>');
    }

    // confirm window
    yii.allowAction = function ($e) {
        var message = $e.data('confirm');
        return message === undefined || yii.confirm(message, $e);
    }

    yii.confirm = function (message, ok, cancel) {
        var id = '';
        var name = '';

        if($('.del_url').html() != ''){
            if(typeof $('.del_url').html() !== 'undefined'){
                id = $('.del_url').html().split('id=')[1];
                name = $('#products tr[data-key="'+id+'"] .name').html();
            }
        }

        message = 'Действительно удалить товар '+name+ '?';
        bootbox.confirm(message, function (confirmed) {
            if (confirmed) {
                var url = $('.del_url').html();
                url = url.replace(/&amp;/g,"&")

                $.ajax({
                    url: url,
                    type: 'post',
                    success: function (data) {
                        if(data && typeof data.data !== 'undefined' && data.action == 'delete'){
                            $('#products tbody tr[data-key="'+data.data.id+'"]').hide();
                        }
                    }
                });
            }
            else {
                !cancel || cancel();
            }
        });
        return false;
    }

    // modal window
    $('#modal').on('hidden.bs.modal', function(){
        $('#modalContent').html('');
    })

    // action update
    $('body').on('click', 'a[title="Update"]', function(e){

        var href = $(this).attr('href');
        var self = this;

        $.post(href, function(data){
            var pjax_id = $(self).closest('.pjax-wraper').attr('id');

            $('#modal').modal('show')
                .find('#modalContent')
                .load(href);
        });

        return false;
    })

    // actions create, update
    $('body').on('click', '#product_form button', function(e){
        e.preventDefault();

        $('#ajax_product input').focus();

        var url = $('#product_form').attr('action');
        $.ajax({
            url: url,
            type: 'post',
            data: $('#product_form').serialize(),
            success: function (data) {
                console.log(data);
                if(data && typeof data.data !== 'undefined'){
                    $('#modal').modal('hide');
                    var update_url = url.split('create')[0].concat('update?id='+data.data.id);
                    var delete_url = url.split('create')[0].concat('delete?id='+data.data.id);

                    var table_fields = '<td class="id text-center">'+data.data.id+'</td>'+
                        '<td class="name text-center">'+data.data.name+'</td><td class="price text-center">$'+data.data.price+'</td>'+
                        '<td class="quantity text-center">'+data.data.quantity+'</td><td class="created_at text-center">'+data.data.created_at+'</td>'+
                        '<td class="user_id text-center">'+$('.cur_user_id').html()+'</td><td class="actions text-center">'+
                        '<a href="'+update_url+'" title="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a> '+
                        '<a href="'+delete_url+'" title="Delete" data-confirm="Действительно удалить товар?" data-method="post" data-pjax="0">'+
                        '<span class="glyphicon glyphicon-trash"></span></a></td>';

                    if(data.action == 'create'){
                        $('#products tbody').append('<tr data-key="'+data.data.id+'">'+table_fields+'</tr>')

                        if($('#products .empty').length > 0) $('#products .empty').parents('tr').hide();
                    }
                    else if(data.action == 'update'){
                        $('tr[data-key="'+data.data.id+'"]').html(table_fields);
                    }
                }
            }
        });
    })

    // action delete
    $('body').on('click', 'a[title="Delete"]', function(e){
        e.preventDefault();

        var del_url = $(this).attr('href');

        if($('.del_url').length == 0){
            $('body').append('<div class="del_url">'+del_url+'</div>');
        }
        else{
            $('.del_url').html(del_url);
        }
    })

    // listen click, open modal and .load content
    $('#modalButton').click(function (){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    })
})