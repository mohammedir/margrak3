{{--{{dd(session()->get('event'))}}--}}
<script src="//js.pusher.com/4.0/pusher.min.js"></script>
<script>
    $(document).ready(function () {
        var pusher = new Pusher('{{env('PUSHER_APP_ID')}}');
        var channel = pusher.subscribe('{{call_user_func_array('array_merge',array(explode(',',env('CHANNELS'))))[0]}}');
        channel.bind('{{env('PUBLIC_EVENT')}}', function (data) {
            alert('');
            console.log(data);
            cloneNewNotification(data);

        });
        notificationPress();
    });

    function cloneNewNotification(content) {
//        content =  jQuery.parseJSON(content.data);
        var notification = $('.notificationPanelClone').clone();
        if (jQuery.parseJSON(content.data.content).img != undefined) {
            notification.find('.image').attr('src', jQuery.parseJSON(content.data.content).img);
            notification.find('.image').removeClass('hidden');
            notification.find('span.time').attr('style', 'margin-top:10px !important;');
        }

        if (jQuery.parseJSON(content.data.content).link != undefined) {
            notification.find('a').attr('href', jQuery.parseJSON(content.data.content).link);

        }
        notification.find('.content').html(jQuery.parseJSON(content.data.content).content);
        notification.find('.time').html(content.data.date.replace('ago', '').replace('منذ', ''));
        notification.removeClass('notificationPanelClone');
        notification.insertAfter('.notificationPanelClone');
        notification.find('a').css('background-color', '{{env('NOTIFICATION_UNSEEN_COLOR')}}');
        notification.find('.notificationId').val(content.data.id);
        var notificationcount = $('.notificationCounter').html();
        $('.notificationCounter').html(parseInt(notificationcount) + 1);
        $('.notificationCounter').removeClass('hidden');
    }

    function notificationPress() {
        $('body').on('click', 'li.notification', function () {
            $id = $(this).find('input').val();
            alert($id);
            makeItSeen($id, $(this));


        });
    }
    function makeItSeen($id, object) {
        $.ajax({
            url: '{{route('ajax/makeItSeen')}}',
            type: 'GET',
            data: {body: $id, postId: '', token: '{{csrf_token()}}'}
        }).success(function (message) {
            if (message.status == 200) {
                updatePanelStatus(object);
            }else{
                $('.alert-danger').html(message.message);
                $('.alert-danger').fadeIn(1000).delay(5000).fadeOut(1000);
            }

        });
    }


    function updatePanelStatus(object) {
        object.find('a').css('background-color', '{{env('NOTIFICATION_SEEN_COLOR')}}');
        object.find('a').css('color', '{{env('NOTIFICATION_UNSEEN_COLOR')}}');
        object.find('.time').css('color', '{{env('NOTIFICATION_UNSEEN_COLOR')}}');
        object.find('.time').css('background-color', '{{env('NOTIFICATION_SEEN_COLOR')}}');
        var notificationcount = $('.notificationCounter').html();
        if (parseInt(notificationcount) != 0) {
            $('.notificationCounter').html(parseInt(notificationcount) == 0 ? 0 : parseInt(notificationcount) - 1);
            notificationcount = $('.notificationCounter').html();
            if (parseInt(notificationcount) != 0)
                $('.notificationCounter').removeClass('hidden');
            else {
                $('.notificationCounter').addClass('hidden');

            }

        }
    }
</script>