
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
    apiKey: "AIzaSyAYbzMkoAvkCuT42xJpBlADfJh562tiHn0",
    authDomain: "base-dashboard-ffb72.firebaseapp.com",
    projectId: "base-dashboard-ffb72",
    storageBucket: "base-dashboard-ffb72.appspot.com",
    messagingSenderId: "831275297504",
    appId: "1:831275297504:web:4cc300a744e4fe3ad0be85",
    measurementId: "G-MF62PT87RZ"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    // Customize notification here
    const notificationTitle = payload.data.sender_name;
    const notificationOptions = {
        body:  payload.data.body_ar,
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});
