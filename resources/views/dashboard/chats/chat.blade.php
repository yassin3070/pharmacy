@extends('dashboard.layouts.app')
@section('pageTitle' , __('dashboard.chat'))

@section('content')


<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Category-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
               
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="dropdown">
                    <button  onclick="initFirebaseMessagingRegistration()" class="btn btn-primary tx-13 tx-medium tx-white-force">@lang('input.allaw_notification')</a>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row">
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
                            <!--begin::Contacts-->
                            <div class="card card-flush">
                                <!--begin::Card header-->
                                <div class="card-header pt-7" id="kt_chat_contacts_header">
                                    <!--begin::Form-->
                                    <form class="w-100 position-relative" autocomplete="off">
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid px-15" name="search" value="" placeholder="Search by username or email...">
                                        <!--end::Input-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0" id="kt_chat_contacts_body">
                                    <!--begin::List-->
                                    <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px" style="">
                                        @foreach ($rooms as  $room)
                                           
                                       <!--begin::User-->
                                       <div class="d-flex flex-stack py-4">
                                           <!--begin::Details-->
                                           <div class="d-flex align-items-center">
                                               <!--begin::Avatar-->
                                               <div class="symbol symbol-45px symbol-circle">
                                                   <span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">M</span>
                                                   <div class="symbol-badge bg-success start-100 top-100 border-4 h-15px w-15px ms-n2 mt-n2"></div>
                                               </div>
                                               <!--end::Avatar-->
                                               <!--begin::Details-->
                                               <div class="ms-5">
                                                   <a href="{{route('conversation' , $room->id)}}" class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Melody Macy</a>
                                                   <div class="fw-semibold text-muted">melody@altbox.com</div>
                                               </div>
                                               <!--end::Details-->
                                           </div>
                                           <!--end::Details-->
                                           <!--begin::Lat seen-->
                                           <div class="d-flex flex-column align-items-end ms-2">
                                               <span class="text-muted fs-7 mb-1">{{ $room->updated_at->diffForHumans() }}</span>
                                               <span class="badge badge-sm badge-circle badge-light-danger">5</span>
                                           </div>
                                           <!--end::Lat seen-->
                                       </div>
                                       <!--end::User-->
                                       <!--begin::Separator-->
                                       <div class="separator separator-dashed d-none"></div>
                                       <!--end::Separator-->
                                       @endforeach
                                    </div>
                                    <!--end::List-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Contacts-->
                        </div>
                        <!--end::Sidebar-->

                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                            <!--begin::Messenger-->
                            <div class="card" id="kt_chat_messenger">
                                <!--begin::Card header-->
                                <div class="card-header" id="kt_chat_messenger_header">
                                    <!--begin::Title-->
                                    <div class="card-title">
                                        <!--begin::User-->
                                        <div class="d-flex justify-content-center flex-column me-3">
                                            <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Brian Cox</a>
                                            <!--begin::Info-->
                                            <div class="mb-0 lh-1">
                                                <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                                                <span class="fs-7 fw-semibold text-muted">Active</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->
                                        <div class="me-n3">
                                            <button class="btn btn-sm btn-icon btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <i class="bi bi-three-dots fs-2"></i>
                                            </button>
                                            <!--begin::Menu 3-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                                                <!--begin::Heading-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Contacts</div>
                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">Add Contact</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link flex-stack px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">Invite Contacts
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" aria-label="Specify a contact email to send an invitation" data-kt-initialized="1"></i></a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                                    <a href="#" class="menu-link px-3">
                                                        <span class="menu-title">Groups</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <!--begin::Menu sub-->
                                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" data-kt-initialized="1">Create Group</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" data-kt-initialized="1">Invite Members</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" data-kt-initialized="1">Settings</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu sub-->
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3 my-1">
                                                    <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" data-kt-initialized="1">Settings</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu 3-->
                                        </div>
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body" id="kt_chat_messenger_body">
                                    <!--begin::Messages-->
                                    <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto msgs" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px" style="">
                
                                      @foreach ($messages as $message)
                                           
                                       <!--begin::Message(out)-->
                                       <div class="d-flex justify-content-{{ $message->is_sender ? "end" : "start"}} mb-10">
                                           <!--begin::Wrapper-->
                                           <div class="d-flex flex-column align-items-{{ $message->is_sender ? "end" : "start"}}">
                                               <!--begin::User-->
                                               <div class="d-flex align-items-center mb-2">
                                                   <!--begin::Details-->
                                                   <div class="me-3">
                                                       <span class="text-muted fs-7 mb-1">{{$message->originalMessage->created_at->diffForHumans()}}</span>
                                                       {{-- <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a> --}}
                                                   </div>
                                                   <!--end::Details-->
                                                   <!--begin::Avatar-->
                                                   <div class="symbol symbol-35px symbol-circle">
                                                       <img alt="Pic" src="{{$message->originalMessage->senderable->image}}">
                                                   </div>
                                                   <!--end::Avatar-->
                                               </div>
                                               <!--end::User-->
                                               @if($message->originalMessage->type == "text")
                                               <!--begin::Text-->
                                               <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px {{ $message->is_sender ? "text-end" : "text-start"}}" data-kt-element="message-text">
                                                {{$message->originalMessage->body}}
                                               </div>
                                               <!--end::Text-->
                                               @else
                                               <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px {{ $message->is_sender ? "text-end" : "text-start"}}">
                                                <img alt="Pic" src="{{asset('storage/'.$message->originalMessage->body)}}">
                                                </div>
                                                <!--end::Avatar-->
                                               @endif
                                           </div>
                                           <!--end::Wrapper-->
                                       </div>
                                       <!--end::Message(out)-->

                                       {{-- <!--begin::Message(in)-->
                                       <div class="d-flex justify-content-start mb-10">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column align-items-start">
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center mb-2">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="assets/media/avatars/300-25.jpg">
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-3">
                                                    <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                                                    <span class="text-muted fs-7 mb-1">2 mins</span>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::User-->
                                            <!--begin::Text-->
                                            <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">How likely are you to recommend our company to your friends and family ?</div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Wrapper-->
                                       </div>
                                       <!--end::Message(in)--> --}}
                                       @endforeach

                                    
                                 
                                     
                                        {{-- <!--begin::Message(template for out)-->
                                        <div class="d-flex justify-content-end mb-10 d-none" data-kt-element="template-out">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column align-items-end">
                                                <!--begin::User-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <!--begin::Details-->
                                                    <div class="me-3">
                                                        <span class="text-muted fs-7 mb-1">Just now</span>
                                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle">
                                                        <img alt="Pic" src="assets/media/avatars/300-1.jpg">
                                                    </div>
                                                    <!--end::Avatar-->
                                                </div>
                                                <!--end::User-->
                                                <!--begin::Text-->
                                                <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text"></div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Message(template for out)-->
                                        <!--begin::Message(template for in)-->
                                        <div class="d-flex justify-content-start mb-10 d-none" data-kt-element="template-in">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column align-items-start">
                                                <!--begin::User-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle">
                                                        <img alt="Pic" src="assets/media/avatars/300-25.jpg">
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Details-->
                                                    <div class="ms-3">
                                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                                                        <span class="text-muted fs-7 mb-1">Just now</span>
                                                    </div>
                                                    <!--end::Details-->
                                                </div>
                                                <!--end::User-->
                                                <!--begin::Text-->
                                                <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">Right before vacation season we have the next Big Deal for you.</div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Message(template for in)--> --}}
                                    </div>
                                    <!--end::Messages-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-flush mb-3" rows="1" data-kt-element="input" placeholder="Type a message" id="msg">
                                    <!--end::Input-->
                                    <!--begin:Toolbar-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Actions-->
                                        <div class="d-flex align-items-center me-2">
                                            <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" data-kt-initialized="1">
                                                <i class="bi bi-paperclip fs-3"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" data-kt-initialized="1">
                                                <i class="bi bi-upload fs-3"></i>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                        <!--begin::Send-->
                                        <button class="btn btn-primary"  id="send-message" onclick="button_send_msg()" data-kt-element="send">Send</button>
                                        <!--end::Send-->
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Card footer-->
                            </div>
                            <!--end::Messenger-->
                        </div>
                        <!--end::Content-->

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
				
@endsection
@section('scripts')

<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-auth.js"></script>


<script>

$(document).ready(function() {
     initFirebaseMessagingRegistration();
});
    // Initialize Firebase
    var firebaseConfig = {
        apiKey: "AIzaSyAYbzMkoAvkCuT42xJpBlADfJh562tiHn0",
        authDomain: "base-dashboard-ffb72.firebaseapp.com",
        projectId: "base-dashboard-ffb72",
        storageBucket: "base-dashboard-ffb72.appspot.com",
        messagingSenderId: "831275297504",
        appId: "1:831275297504:web:4cc300a744e4fe3ad0be85",
        measurementId: "G-MF62PT87RZ"
    };
    firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
   

    function initFirebaseMessagingRegistration() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{route('notifications.storeToken')}}",
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token stored.');
                    },
                    error: function (error) {
                    },
                });

            }).catch(function (error) {
            });
    }

       messaging.onMessage(function(payload) {
           console.log(payload);
        const noteTitle = payload.data.sender_name;
        const noteOptions = {
            body: payload.data.body_ar,
            // icon: payload.notification.icon,
            requireInteraction: true,
        };
    
        new Notification(noteTitle, noteOptions);
     
    });
   

</script>		


<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
<script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
    <script>
        var socket = io.connect('https://h.hwzn.sa:3308');
        // var socket = io('http://127.0.0.1:8000:3031' ,{
        //     transports: ['websocket', 'polling', 'flashsocket']
        // });
        socket.on("connect", function(data) {
            console.log('connected to socket from web')
        });

        socket.on('sendNotification', function (data) {
            console.log("sendNotification",data)
            console.log("{{Auth::user()->id}}");
            if(data.receiver_id == "{{Auth::user()->id}}"){
                    console.log(true);
                    alert('لديك رسالة جديدة');
                }
        });
        socket.emit('enterChat', {'user_id':"{{Auth::user()->id}}",'room_id':"{{$room->id}}"});

        socket.emit('join', { room_id: "{{$room->id}}" });


        socket.on('sendMessageRes', function (data) {
                           console.log("res data ====> "+data);

                if(data.is_sender){
                    var classtype =  'text-end';
                }else{
                    var classtype =  'text-start';
                }
              
                var messageval =`<div class="d-flex justify-content-${data.is_sender ? "end" : "start"} mb-10">
                            <div class="d-flex flex-column align-items-${data.is_sender ? "end" : "start"}">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="me-3">
                                        <span class="text-muted fs-7 mb-1">{{ \Carbon\Carbon::now()->diffForHumans()  }}</span>
                                    </div>
                                    
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="https://h.hwzn.sa/storage/.${data.originalMessage.senderable.image}">
                                    </div>
                                </div>
                                if(${data.originalMessage.type == "text"})
                                {

                                    <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px ${data.is_sender ? "text-end" : "text-start"}" data-kt-element="message-text">
                                    ${data.originalMessage.body}
                                    </div>
                                }
                                else{

                                    <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px  ${data.is_sender ? "text-end" : "text-start"}">
                                    <img alt="Pic" src="https://h.hwzn.sa/storage/.${data.originalMessage.body}">
                                    </div>
                                }
                            </div>
                        </div>`;

                $('.msgs').append(messageval);
                                             
     
            scrollToEnd();

        });

        socket.on("unjoin", () => {
            console.log(socket.id); // undefined
        });
   



    </script>
    <script>
        $(document).ready(function(){
            scrollToEnd();

            $(document).keypress(function(e) {
                if(e.which == 13) {
                    var msg = $('#msg').val();
                    $('#msg').val('');//reset
                    send_msg(msg);
                }
            });
        });

        function button_send_msg(){
            var msg = $('#msg').val();
            $('#msg').val('');//reset
            send_msg(msg);
        }

        function send_msg(msg){
            "<?php $receiver_id = $members->memberable->id ?>"

            // socket.emit('sendMessage',
            //     {
            //         'sender_id':"{{Auth::user()->id}}",
            //         'receiver_id':"{{$receiver_id}}",
            //         'room_id':"{{$room->id}}",
            //         'body':msg,
            //         'type':'text',
            //         'sender_type':'User',
            //         'receiver_type':'User',
            //         'is_sender':'1',
            //         'sender_name' : "{{Auth::user()->name}}"
            //     });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: 'https://h.hwzn.sa/' + 'send-message',
                data:{'sender_id' : "{{Auth::user()->id}}" , 'receiver_id' : "{{$receiver_id }}", 'room_id' : "{{$room->id}}",
                     'message' : msg , 'type' : 'text' ,'sender_type':'User',
                     'receiver_type':'User' , 'is_sender' : '1' ,  'sender_name' : "{{Auth::user()->name}}"

                 },
                success: function (data) {
                    if(data.fail){
                        toastr['error'](data.fail, {
                            closeButton: false,
                            tapToDismiss: false,
                        });
                    }else{
                        if(data.success){
                            $('.msgs').append(
                                `<div class="d-flex justify-content-${data.data.is_sender ? "end" : "start"} mb-10">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column align-items-${data.data.is_sender ? "end" : "start"}">
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center mb-2">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{auth()->user()->image}}">
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-3">
                                                    <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">you</a>
                                                    <span class="text-muted fs-7 mb-1">{{ \Carbon\Carbon::now()->diffForHumans()  }}</span>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::User-->
                                            <!--begin::Text-->
                                            <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px ${data.data.is_sender  ? "text-end" : "text-start" }" data-kt-element="message-text">
                                            ${data.message}</div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Wrapper-->
                                       </div>`
                                
                                
                                );

                           
                           
                           
                                scrollToEnd();
                        }else{

                        }

                    }
                }
            });

        }

        function scrollToEnd(){
            var d = $('.msgs');
            d.scrollTop(d.prop("scrollHeight"));
        }

    </script>





<script src="https://www.gstatic.com/firebasejs/9.21.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.21.0/firebase-analytics.js"></script>

		

    {{-- <script>

        document.getElementById("upload-image").onchange = function(e) {
                e.preventDefault();
            var files = e.target.files || e.dataTransfer.files;

            var file = new FormData();
            file.append( 'file', files[0] );
            file.append( 's_id', "{{Auth::user()->id}}" );
            file.append( 'r_id', "{{$receiver_id }}" );
            file.append( 'room_id', "{{$room->id}}" );
            file.append( 'type', 'file' );

                    "<?php $receiver_id = (Auth::user()->id == $room->s_id) ? $room->r_id : $room->s_id; ?>"
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });


                    
                        $.ajax({
                        type: 'post',
                        url: apiWebsiteURL + 'send-message',
                        data: file,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            if(data.fail){
                                toastr['error'](data.fail, {
                                    closeButton: false,
                                    tapToDismiss: false,
                                });
                            }else{
                                if(data.success){
                                    $('.msgs').append(`<div class="send-message">
                                        <div class="inner">
                                        <p class="text">
                                            <img style="width:150px; height:150px;" src="${apiWebsiteURL}public/storage/${data.message}">
                                            <span class="date">
                                                {{ \Carbon\Carbon::now()->diffForHumans()  }}
                                            </span>
                                        </p></div></div>`);


                                        socket.emit('send',
                                        {
                                            's_id':"{{Auth::user()->id}}",
                                            'r_id':"{{$receiver_id}}",
                                            'room_id':"{{$room->id}}",
                                            'content':data.message,
                                            'type':'file'
                                        });

                                    scrollToEnd();
                                }else{

                                }

                            }
                        }
                    });

        }
    </script> --}}
@endsection