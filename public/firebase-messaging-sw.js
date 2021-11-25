/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');
   
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/

firebase.initializeApp({
    apiKey: "AIzaSyAYJjqz2ZIqdGMFO5SoWVJXkOaFNZ9eQ1U",
    authDomain: "rajeevpushnotification.firebaseapp.com",
    projectId: "rajeevpushnotification",
    storageBucket: "rajeevpushnotification.appspot.com",
    messagingSenderId: "22286065452",
    appId: "1:22286065452:web:cfa73197b76a279d111689",
    measurementId: "G-SEC697RZE8"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Firebase Notification",payload);
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };
  
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});