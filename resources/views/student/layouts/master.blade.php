@include('student.layouts.head')
@include('student.layouts.header')
@include('student.layouts.sidebar')
<!-- <div class="sticky"> -->
    <div class="chat">
        <div class="chat-title">
            <h1>Hello</h1>
            <h2>Hi</h2>
            <figure class="avatar">
            <img src="https://www.pikpng.com/pngl/b/109-1099794_ios-emoji-emoji-iphone-ios-heart-hearts-spin.png" />
            </figure>
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
            </div>
        </div>
        <div class="message-box">
            <textarea type="text" class="message-input" placeholder="Type message..."></textarea>
            <button type="submit" class="message-submit">Send</button>
        </div>
    </div>

<!-- </div> -->
@yield('content')

@extends('student.layouts.footer')
