@auth

    <div class="chat-bubble" id="chat-bubble" style="display: none">
        <img class="w-100" src="http://leadinglight.dev91.website/frontend/assets/images/chat-bubble.png">
    </div>

    <div class="chat chat-hidden" id="chat">
        <div class="chat-title d-flex align-items-center">
            <i class="fas fa-angle-left" id="chat-back"></i>
            <figure class="avatar">
                <img src="http://leadinglight.dev91.website/frontend/assets/images/avata1.jpg" />
            </figure>
            <div>
                <h1>Hello</h1>
                <h2>Online</h2>
            </div>
        </div>
        <div class="messages">
            <div class="messages-content px-3 py-4">
                <p class="float-left r-chat">
                    Hi, This is Md Aasim from Oneness Techs Solutions
                </p>
                <p class="float-right l-chat">
                    Hi this is aasim from
                </p>
                <p class="float-left r-chat">
                    Hi this is aasim from
                </p>
                <p class="float-right l-chat">
                    Hi, This is Md Aasim from Oneness Techs Solutions
                </p>
                <p class="float-left r-chat">
                    Hi, This is Md Aasim from Oneness Techs Solutions
                </p>
                <p class="float-right l-chat">
                    Hi this is aasim from
                </p>
                <p class="float-left r-chat">
                    Hi this is aasim from
                </p>
                <p class="float-right l-chat">
                    Hi, This is Md Aasim from Oneness Techs Solutions
                </p>
                <p class="float-left r-chat">
                    Hi, This is Md Aasim from Oneness Techs Solutions
                </p>
                <p class="float-right l-chat">
                    Hi this is aasim from
                </p>
                <p class="float-left r-chat">
                    Hi this is aasim from
                </p>
                <p class="float-right l-chat">
                    Last Chat
                </p>
            </div>
        </div>
        <div class="message-box">
            <input type="text" class="message-input" placeholder="Type message...">
            <button type="submit" class="message-submit">Send</button>
        </div>
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
    <script>
        function gettingContactList(userId) {
            $.ajax({
                url: "{{ route('api.chat.message.list') }}",
                type: 'GET',
                dataType: 'JSON',
                data: {
                    userId: userId
                },
                success: function(response) {
                    console.log('response', response);
                    if (response.error == false) {
                        if (response.data.length > 0) {
                            $('#chat-bubble').show();
                            var toAppendContact = '';
                            $.each(response.data, function(key, value) {
                                toAppendContact +=
                                    '<li class="d-flex align-items-center justify-content-start py-2 contact-li"><div class="chat-img mr-3"><img class="w-100" src="{{ asset('') }}' +
                                    value.image + '" alt=""></div><div class="chat-list-content"><h5>' +
                                    value.first_name + ' ' + value.last_name +
                                    '</h5><p>' + value?.lastChat +
                                    '</p></div><div class="badge msg-count">' + value?.newMessage +
                                    '</div></li>';
                            });
                            $('#userChatContact').empty().append(toAppendContact);
                        }
                    }
                }
            });
        }
        // Chatbot toggle jQuery code
        $(document).ready(function() {
            gettingContactList("{{ Auth::guard('web')->user()->id }}");
            // Open the chat list window by clicking on the chat bubble
            $('#chat-bubble').click(function() {
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
            $('.close-chat-list').click(function() {
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

            // Click on any contact to open its chat window
            $('.messages .contact-li').click(function() {
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

            // Close the chat window by clicking on the close button
            // at the top right corner of the chat list window
            $('.close-chat').click(function() {
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

            $('#chat-back').click(function() {
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
