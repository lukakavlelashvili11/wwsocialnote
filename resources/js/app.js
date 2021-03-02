require('./bootstrap');

window.Vue = require('vue').default;
import axios from 'axios';
import Echo from 'laravel-echo';

Vue.component('chat-items', require('./components/chat.vue').default);
Vue.component('chathead-item', require('./components/chathead.vue').default);
Vue.component('joined-users', require('./components/joinedUsers.vue').default);
Vue.component('friendnotif-item', require('./components/friendnotification.vue').default);
Vue.component('notifs-item', require('./components/notifications.vue').default);
Vue.component('likedpost-item', require('./components/likedpost.vue').default);
window.onload = function () {
  Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
    const vm = new Vue({
        el: '#app',
        data:{
          message:'',
          messageforsend:'',
          key:'',
          userName:'',
          phonechat:false,
          fr:false,
          here:[],
          friends:[],
          deletedfriends:[],
          chat:{
            message:[],
            user:[]
          }
        },
        methods:{
          chankey(userid){
            this.key=userid;
            this.chat.message=[];
            this.chat.user=[];
            $('#multchats').show('fast');
            axios.post('/getmessages',{
              key:this.key
            }).then(response=>{
              this.userName=Object.values(response)[0][0][0].name;
              Object.values(response)[0][1].forEach(element => this.chat.message.push(element.message));
              Object.values(response)[0][1].forEach(element => this.chat.user.push(element.user.name));
            });
          },
          send(){
            if(this.message.length!=''){
              this.chat.message.push(this.message);
              this.chat.user.push('you');
              this.messageforsend=this.message;
              this.message='';
              var container = this.$el.querySelector("#over");
              container.scrollTop = container.scrollHeight;
              axios.post('/send',{
                message:this.messageforsend,
                key:this.key
              });
            }
          },
        },
        mounted(){
          window.Echo.private(`chat.${this.$userId}`)
          .listen('chatevent',(e)=>{
            if(this.chat.message.length<1){
            axios.post('/getmessages',{
              key:e.user.id
            }).then(response=>{
              Object.values(response)[0][1].forEach(element => this.chat.message.push(element.message));
              Object.values(response)[0][1].forEach(element => this.chat.user.push(element.user.name));
            });
            }
            this.chat.message.push(e.message);
              this.chat.user.push(e.user.name);
              this.userName=e.user.name;
              this.key=e.user.id;
              $('#multchats').show('fast');
          });
          window.Echo.join('joinedUsers')
          .here((users) => {
            if(this.fr){
            for(var a=0;a<users.length;a++){
              for(var i=0;i<this.friends[0].length;i++){
                if(users[a].name==this.friends[0][i][0]){
                  this.here.push(users[a]);
                  this.deletedfriends.push(this.friends[0][i]);
                  const index = this.friends[0].indexOf(this.friends[0][i]);
                  if (index > -1) {
                    this.friends[0].splice(index, 1);
                  }
                }
              }
            }
          }
        })
          .joining((user) => {
            if(this.fr){
            for(var i=0;i<this.friends[0].length;i++){
              if(user.name==this.friends[0][i][0]){
                if(this.here)
                this.here.unshift(user);
                this.deletedfriends.push(this.friends[0][i]);
                const index = this.friends[0].indexOf(this.friends[0][i]);
                if (index > -1) {
                  this.friends[0].splice(index, 1);
                }
              }
            }
          }
        })
          .leaving((user) => {
            const index = this.here.indexOf(user);
            if (index > -1) {
              this.here.splice(index, 1);
            } 
            for(var i=0;i<this.deletedfriends.length;i++){
              if(user.name==this.deletedfriends[i][0]){
                this.friends[0].push(this.deletedfriends[i]);
                const index = this.deletedfriends.indexOf(this.deletedfriends[i]);
                if (index > -1) {
                  this.deletedfriends.splice(index, 1);
                } 
              }
            }
          });
          axios.post('/getfriends')
            .then(response=>{
              this.fr=true;
              nt.notificationcount=response.data[1];
              this.friends.push(response.data[0]);
            });
          $(document).on('click','#close',()=>{
            $('#multchats').hide('fast');
          });
          if($(window).width()<500)
          $('#over').height($(window).height()-62);
          else
          this.phonechat=true;
        },
    });
    const nt=new Vue({
      el:'#nt',
      data:{
        notificationcount:0,
        scrollpos:'',
        notiftype:'',
        typeval:'',
        state:'',
        clickedonfriend:false,
        clickedonbut:true,
        clickedonnotif:'',
        post:[],
        dispnotifs:[],
        notifs:[],
      },
      methods:{
        getnotifs(){
          this.notificationcount=0;
          axios.post('/getnotifs')
          .then(response=>{
            this.notifs.push(response.data.reverse());
          })
        },
        showpost(post_id){
          if(post_id>0){
          this.scrollpos=document.body.scrollTop;
          $(".post"+post_id).css('border','2px solid red');
          $('html, body').animate({
            scrollTop:$(".post"+post_id).offset().top-66
        }, 1000);
      }
        },
        byepost(post_id){
          $('html, body').animate({
            scrollTop:this.scrollpos
        }, 1000);
        $(".post"+post_id).css('border','1px solid gray');
        },
        addfriend(user_id){
          axios.post('/addrequest',{to:user_id});
        },
        send(userid){
            this.clickedonbut=false;
            axios.post('/addfriend',{friend:userid});
            $('#notifications').hide();
            if(this.notifs[0]){
            this.clickedonfriend=true;
            this.notifs[0].splice(0, 1);
            }
        },
        deleterequest(userid){
          this.clickedonbut=false;
          $.get('/addfriend',{user:userid});
          $('#notifications').hide();
          if(this.notifs[0]){
          this.clickedonfriend=true;
          this.notifs[0].splice(0, 1);
          }
        },
        browsepost(post_id){
          axios.post('/browsepost',{postId:post_id})
          .then(response=>{
            if(this.post.length>0){
              this.post=[];
              this.post.push(response.data);
            }
            else{
            this.post.push(response.data);
            }
            this.clickedonnotif=this.post[0][0];
          })
          $('#notifications').hide();
          $('.postbrowse').show();
          $('html, body').animate({
            scrollTop:0
        }, 70);

        },
        cancel(){
          $('.postbrowse').hide();
        }
      },
      mounted(){
        window.Echo.private(`post-like.${this.$userId}`)
            .listen('likeevent',(e)=>{
              this.notificationcount++;
              axios.post('/notification',{
                from:e.from,
                to:e.to,
                post:e.post.id
              })
              .then(response=>{
                this.notiftype='';
                this.dispnotifs=[];
                this.notiftype=response.data[2];
                if(this.notifs[0])
                this.notifs[0].unshift(response.data);
                this.dispnotifs.push(response.data);
              });
            });
              $('#menu').on('click',function(){
                  $('#menulist').toggle('slow');
              });
              if($(window).width()<500){
                $('#togli').on('click',function(){
                $('.nav').css('zIndex','-40');
                $('.phonesearcher').css('zIndex','40');
                $('.phonesearcher').removeAttr('id');
              });
            }else{
                $('#togli').on('click',function(){
                $('#lum .comp').toggle('slow');
              });
              }
              $('#phonename').on('click',()=>{this.state=1;$('#phoneemail').show('slow');$('#phonename').hide('slow');});
              $('#phoneemail').on('click',()=>{this.state=0;$('#phonename').show('slow');$('#phoneemail').hide('slow');});
              $('#name').on('click',()=>{this.state=1;$('#email').show('slow');$('#name').hide('slow');});
              $('#email').on('click',()=>{this.state=0;$('#name').show('slow');$('#email').hide('slow');});
              $('#arrow').on('click',()=>{
                $('.phonesearcher').attr('id','none');
                $('.nav').css('zIndex','40');
                $('.phonesearcher').css('zIndex','-40');
              });
              $('#notification').on('click',()=>{$('#notifications').toggle('slow');});

              $(document).on('click','#addfriend>img',(e)=>{
                if(e.target.id.split('.')[1]=='fordelete'){
                  this.deleterequest(e.target.id.split('.')[2]);
                }
                if(e.target.id.split('.')[1]=='foradd'){
                  this.send(e.target.id.split('.')[2]);
                }
                if(e.target.id.split('.')[1]=='requested'){
                  this.deleterequest(e.target.id.split('.')[2]);
                }
                if(e.target.id.split('.')[1]=='unknown'){
                  this.addfriend(e.target.id.split('.')[2]);
                }
                if(e.target.id.split('.')[1]=='friend'){
                  vm.chankey(e.target.id.split('.')[2]);
                }
              });
              window.Echo.private(`addfriend.${this.$userId}`)
              .listen('friendRequestEvent',(e)=>{
              this.notificationcount++;
              axios.post('/friendnotification',{
                from:e.from,
                to:e.to,
              })
              .then(response=>{
                this.clickedonbut=true;
                this.dispnotifs=[];
                this.notiftype=response.data[2];
                if(this.notifs[0])
                this.notifs[0].unshift(response.data);
                this.dispnotifs.push(response.data);
              });
            });
      },
      watch:{
        typeval(){
          axios.post('/autocomplete',{term:this.typeval,state:this.state})
          .then(response=>{
            if($(window).width()<500){
              $('.phonesearcher #comp').fadeIn();
              $('.phonesearcher #comp').html(response.data);
            }else{
              $('#lum .comp #comp').fadeIn();
              $('#lum .comp #comp').html(response.data);
            }
          });
        }
      }
    })
};
