@auth

    <div class="chat-bubble" id="chat-bubble" style="display: none">
        <img class="w-100" src="http://leadinglight.dev91.website/frontend/assets/images/chat-bubble.png">
    </div>

    <div class="chat chat-hidden" id="chat">
        <div class="chat-title d-flex align-items-center">
            <i class="fas fa-angle-left" id="chat-back"></i>
            <figure class="avatar">
                <img id="chatUserAvater" src=""/>
            </figure>
            <div>
                <h1 id="chatUserName">Hello</h1>
                <h2 id="chatUserLoginStatus">Online</h2>
            </div>
        </div>
        <div class="messages">
            <div class="messages-content px-3 py-4" id="userChatTobeAppendHere"></div>
        </div>
        <form method="post" id="conversationMessagePostForm">
            <div class="message-box">
                <input type="text" id="messageInboxForSend" class="message-input" placeholder="Type message...">
                <input type="hidden" name="conversationId" value="">
                <input type="hidden" name="receiverId" value="">
                <button type="submit" class="message-submit" id="submitMessage">Send</button>
            </div>
        </form>
        <i class="fas fa-minus close-chat"></i>
    </div>


    <div class="chat chat-hidden chat-list" id="chat-list">
        <div class="contact-chat-list d-flex justify-content-center align-items-center">
            <h1 class="0">Your Contact</h1>
        </div>
        <div class="form-group m-0">
            <input type="search" class="form-control contact-search" placeholder="Search...">
        </div>
        <div class="messages">
            <ul class="messages-content px-3 py-4" id="userChatContact"></ul>
        </div>
        <i class="fas fa-minus close-chat-list"></i>
    </div>

    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
    <script>
        var contactWithMessageList = [];
        var loggedInUserId = parseInt("{{Auth::guard('web')->user()->id }}}}");

        function gettingContactOrFewList(userId) {
            $.ajax({
                url: "{{ route('api.contact.message.list') }}",
                type: 'GET',
                dataType: 'JSON',
                data: {
                    userId: userId
                },
                success: function(response) {
                    if (response.error == false) {
                        if (response.data.length > 0) {
                            contactWithMessageList = response.data;
                            appendUpdatedContactList();
                            $('#chat-bubble').show();
                        }
                    }
                }
            });
        }

        function appendUpdatedContactList(){
            var toAppendContact = '';
            $.each(contactWithMessageList, function(key, value) {
                toAppendContact += '<li class="d-flex align-items-center justify-content-start py-2 contact-li" data-conversation="'+value?.conversation?.id+'"><div class="chat-img mr-3"><img class="w-100" src="{{ asset('') }}' + value.image + '" alt=""></div><div class="chat-list-content"><h5>' + value.first_name + ' ' + value.last_name + '</h5><p>';
                let newMessage = 0;
                $.each(value?.conversation?.message, function (messageKey,messageValue){
                    if(messageKey == 0){
                        toAppendContact += messageValue?.message;
                    }
                    if((messageValue?.senderId != loggedInUserId) && (messageValue?.read == 0)){newMessage++}
                });
                toAppendContact +='</p></div><div class="badge msg-count">';
                if(newMessage > 0){
                    toAppendContact += newMessage;
                }
                toAppendContact += '</div></li>';
            });
            $('#userChatContact').empty().append(toAppendContact);
        }

        function updateOrSetUserDeviceToken(token){
            $.ajax({
                url: "{{ route('api.set.user_device_token') }}",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    userId: loggedInUserId,
                    deviceToken : token,
                },
                // success: function(response) { console.log(response);}
            });
        }

        function getMessageDetailsOfTheCoversation(conversationId) {
            $.each(contactWithMessageList, function(convKey, convValue) {
                if(parseInt(convValue?.conversation?.id) === parseInt(conversationId)){
                    $('#chatUserAvater').attr('src','{{asset('')}}'+convValue?.image);
                    $('#chatUserName').text(convValue?.first_name +' '+convValue?.last_name);
                    $('#chatUserLoginStatus').text('Offline');
                    var toChatAppend = '';
                    $.each(convValue?.conversation?.message, function(messageKey, messageValue) {
                        let listClass = 'float-left r-chat';
                        if(messageValue?.senderId == loggedInUserId){
                            listClass = 'float-right l-chat';
                        }
                        toChatAppend += '<p class="'+listClass+'">'+messageValue?.message+'</p>';
                    });
                    $('#userChatTobeAppendHere').empty().append(toChatAppend);
                    reverseTheChattings();
                    $('#conversationMessagePostForm input[name=conversationId]').val(convValue?.conversation?.id);
                    $('#conversationMessagePostForm input[name=receiverId]').val(convValue?.id);
                }
            });
        }

        function reverseTheChattings(){
            // Grab the list of paragraphs.
            var target = document.getElementById("userChatTobeAppendHere");
            var pars   = target.getElementsByTagName("p");

            // Remove and push.
            var stack = new Array();
            var count = pars.length - 1;
            while (count > 0) {
                stack.push(pars[0]);
                target.removeChild(pars[0]);
                count--;
            }

            // Pop and append.
            while (stack.length > 0)
                target.appendChild(stack.pop());
        }

        $(document).on('click','#submitMessage',function(e){
            e.preventDefault();
            dataTobeSendIntoBackend = {
                senderId : loggedInUserId,
                receiverId : parseInt($('#conversationMessagePostForm input[name=receiverId]').val()),
                message : $('#conversationMessagePostForm #messageInboxForSend').val()
            }
            if(dataTobeSendIntoBackend?.message != ''){
                sendUserMessage(dataTobeSendIntoBackend);
            }
        });

        function sendUserMessage(data){
            $.ajax({
                url: "{{route('api.contact.message.post')}}",
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success:function(response){
                    if(response.error == false){
                        addPositiontoFirst(response?.data);
                        $('#userChatTobeAppendHere').append('<p class="float-right l-chat">'+response?.data?.message+'</p>');
                        $('#conversationMessagePostForm #messageInboxForSend').val('');
                    }
                }
            });
        }

        function addPositiontoFirst(data){
            $.each(contactWithMessageList, function(convKey, convValue) {
                if(parseInt(convValue?.conversation?.id) === parseInt(data?.conversationId)){
                    contactWithMessageList[convKey]?.conversation?.message.unshift(data);
                }
            });
            appendUpdatedContactList();
        }

        // Chatbot toggle jQuery code
        $(document).ready(function() {
            gettingContactOrFewList(loggedInUserId);
            // Getting Web Token
            var firebaseConfig = {
                apiKey: "AIzaSyAYJjqz2ZIqdGMFO5SoWVJXkOaFNZ9eQ1U",
                authDomain: "rajeevpushnotification.firebaseapp.com",
                projectId: "rajeevpushnotification",
                storageBucket: "rajeevpushnotification.appspot.com",
                messagingSenderId: "22286065452",
                appId: "1:22286065452:web:cfa73197b76a279d111689",
                measurementId: "G-SEC697RZE8"
            };

            firebase.initializeApp(firebaseConfig);
            const messaging = firebase.messaging();

            initFirebaseMessagingRegistration(); // calling for Getting the Device Token
            
            function initFirebaseMessagingRegistration() {
                messaging.requestPermission().then(function () {
                    return messaging.getToken();
                }).then(function(token) {
                    console.log('Device Token',token);
                    updateOrSetUserDeviceToken(token);
                }).catch(function (err) {
                    // console.log('User Chat Token Error'+ err);
                });
            }

            messaging.onMessage(function(payload) {
                console.log('Incoming Data',payload);
                // alert(payload.data['gcm.notification.data']);
                let data = JSON.parse(payload.data['gcm.notification.data']);
                addPositiontoFirst(data);
                let listClass = 'float-left r-chat';
                if(data?.senderId == loggedInUserId){
                    listClass = 'float-right l-chat';
                }
                $('#userChatTobeAppendHere').append('<p class="'+listClass+'">'+data?.message+'</p>');
            });

            // Click on any contact to open its chat window
            $(document).on('click','.messages .contact-li',function(){
                var conversationId = $(this).attr('data-conversation');
                getMessageDetailsOfTheCoversation(conversationId);
                var chat = $('#chat');
                var chatListClose = $('#chat-list');
                if (chat.hasClass('chat-hidden')) {
                    chat.animate({
                        "bottom": "15px"
                    }, "slow").removeClass('chat-hidden');
                    chatListClose.animate({
                        "bottom": "-100%"
                    }, "slow").addClass('chat-hidden');
                } else {
                    chat.animate({
                        "bottom": "-100%"
                    }, "slow").addClass('chat-hidden');
                }
            });
            
            // Open the chat list window by clicking on the chat bubble
            $(document).on('click','#chat-bubble',function(){
                var chatlist = $('#chat-list');
                if (chatlist.hasClass('chat-hidden')) {
                    chatlist.animate({
                        "bottom": "15px"
                    }, "slow").removeClass('chat-hidden');
                } else {
                    chatlist.animate({
                        "bottom": "-100%"
                    }, "slow").addClass('chat-hidden');
                }
            });

            // Close the chat window by clicking on the close button
            // at the top right corner of the chat list window
            $(document).on('click','.close-chat-list',function(){
                var chatListClose = $('#chat-list');
                if (chatListClose.hasClass('chat-hidden')) {
                    chatListClose.animate({
                        "bottom": "15px"
                    }, "slow").removeClass('chat-hidden');
                } else {
                    chatListClose.animate({
                        "bottom": "-100%"
                    }, "slow").addClass('chat-hidden');
                }
            });

            // Close the chat window by clicking on the close button
            // at the top right corner of the chat list window
            $(document).on('click','.close-chat',function(){
                var chatClose = $('#chat');
                if (chatClose.hasClass('chat-hidden')) {
                    chatClose.animate({
                        "bottom": "15px"
                    }, "slow").removeClass('chat-hidden');
                } else {
                    chatClose.animate({
                        "bottom": "-100%"
                    }, "slow").addClass('chat-hidden');
                }
            });

            $(document).on('click','#chat-back',function(){
                var chatClose = $('#chat');
                var chatlist = $('#chat-list');
                chatClose.animate({
                    "bottom": "-100%"
                }, "slow").addClass('chat-hidden');
                chatlist.animate({
                    "bottom": "15px"
                }, "slow").removeClass('chat-hidden');
            });
        });
    </script>
@endauth
