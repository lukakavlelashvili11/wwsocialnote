<head>
    <link rel="stylesheet"href="{{asset('css/posts.css')}}">
    <link rel="stylesheet"href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<div id="nt">
    <div class="phonesearcher"id="none">
        <img id="arrow" src="{{asset('img/cancel1.svg')}}">
        <div class="comp">
            <div id="choosen"><small id="phoneemail"style="display:none;">email</small></div>
            <div id="choosen"><small id="phonename">name</small></div>    
            <input type="text"class="form-control"id="input" v-model="typeval" autocomplete="off"placeholder="search a user with ...">
                <div id="comp">
                </div>
        </div>
    </div>
<div class="nav">
    <div>
    <ul class="d-flex list-unstyled">
        @auth
        <li>
            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </li>
        <li>
            <div id="menulist">
                <form method="post"action="{{route('logout')}}">
                    @csrf
                    <label for="but"role="button"style="cursor:pointer;">logout</label>
                    <button id="but" class="d-none">logout</button>
                </form>
            </div>
        </li>
        @endauth
        @if(Route::currentRouteName()!='post' && Route::currentRouteName()!='login' && Route::currentRouteName()!='register')
        <li>
            <a href="{{route('post')}}">posts</a>
        </li>
        @endif
    </ul>
    </div>
    <div>
    <ul class="d-flex list-unstyled">
        @if(Route::currentRouteName()=='post')
        @auth
        <li id="lum">
        <div class="comp">
        <div id="choosen"><small id="email"style="display:none;">email</small></div>
        <div id="choosen"><small id="name">name</small></div>    
        <input type="text"class="form-control"id="input" v-model="typeval" autocomplete="off"placeholder="search a user with ...">
            <div id="comp">
            </div>
        </div>
        </li>
        <li id="comli">
            <i class="fa fa-search"id="togli"></i>
        </li>
        <li>
            <div id="notification" @click="getnotifs">
                <div id="notcount" :class="{show:notificationcount}">@{{this.notificationcount}}</div>
                <img src="{{url('img/notification.svg')}}"id="notif">
            </div>
        </li>
        @endif

        <li>
            <a href="{{route('account',auth()->user()->id)}}">{{auth()->user()->name}}</a>
        </li>
        @endauth
    </ul>
    </div>
</div>
<div id="notifications">
    <notifs-item v-if="notifs.length>0"
        v-for="(notif,index) in notifs[0]" 
        :clicked="clickedonfriend" 
        :userid="notif[0]" 
        :post_id="notif[3]" 
        @sendid="send" 
        @delete="deleterequest" 
        @browsep="browsepost"  
        :key="index" 
        :notif="notif[1]" 
        :notiftype="notif[2]" 
        :createddate="notif[4]"/>
</div>
<div id="notpos"style="z-index: 0;">
<div id="notalert" :class="{show:notiftype=='like'}" v-for="notif in dispnotifs" @click="browsepost(notif[3])" @mouseenter="showpost(notif[3])" @mouseout="byepost(notif[3])">
   <div id="notclose"onclick="$('#notpos').hide('slow')">X</div>
    <div id="notcontent">
    <span style="z-index: 0;">@{{notif[1]}}</span>
    <div>
    <small>touch this to browse the post.</small>
    </div>
</div>
</div>
<friendnotif-item v-if="notiftype=='friend' && clickedonbut"
     v-for="(notif,index) in dispnotifs"
     :key="index"
     :userid="notif[0]"
     :notification="notif[1]"
     @sendid="send"
     @delete="deleterequest"
     />
</div>
<div>
    <div :class="{show:clickedonnotif==undefined}"id="undefinedpost">
    <center><h3>Post does not exist!</h3></center>
    </div>
    <div id="likedpost"class="postbrowse">
        <likedpost-item
        v-for="(postdata,index) in post[0]"
        :key="index"
        :post="postdata"
        @cancelpost="cancel"+
        />
    </div>
    </div>
</div>
@yield('nav')
