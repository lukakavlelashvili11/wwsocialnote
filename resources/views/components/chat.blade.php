<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
    <meta name="user-id" content="{{ Auth::user()->id }}">
    <link rel="stylesheet"href="{{asset('css/chat.css')}}">
</head>
<body>
    <div id="app">
        <div id="multchats">
            <div id="chat">
                <div id="chathead">
                    <img src="{{asset('img/cancel1.svg')}}"width="12px"style="cursor:pointer;"id="close">
                    <chathead-item :friend="this.userName" style="margin-top:15px;"/>
                </div>
                <div id="chatbody">
            <div id="over">    
        <ul style="display:block;list-style:none;">
            <chat-items 
            id="vueli"
            v-for="(val,index) in chat.message"
            :key="index"
            :you="{{json_encode(auth()->user()->name)}}"
            :user="chat.user[index]"
            >
            @{{val}}
            </chat-items>
    
        </ul>
    </div>
    <div id="textsend">
    <input type="text"name="text"id="textinput"placeholder="write something" v-model="message" @keyup.enter="send"autocomplete="off">
    <div id="messagesend" @click="send"><img src="{{asset('img/sendmes.png')}}"></div>
    </div>
</div>
</div>
        </div>
        <div id="friendspos" class="hide" v-if="phonechat">
            <div id="act">contacts<div id="iqs" @click="phonechat=false"><img src="{{asset('img/cancel1.svg')}}"></div></div>
            <div id="friends">
            <div id="users">
                <joined-users v-for="(user,index) in this.here" :key="index" v-on:click.native="chankey(user.id)" :username="user.name"/>
            </div>
            <div id="frienddiv">
                <div id="friend" v-for="(friend,index) in this.friends[0]" @click="chankey(friend[1])" :key="index">@{{friend[0]}}</div>
            </div>
            </div>
            </div>
            <div id="mess" @click="phonechat=true" v-if="!phonechat"><img id="messageicon"src="{{asset('img/messenger.svg')}}"/></div>
</div>
<script>

</script>
</body>
</html>