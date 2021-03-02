<template>
<div :class="style" v-if="click">
  <div v-if="notiftype=='like'" @click="showpost(post_id)">
      {{notif}}
  </div>
  <div class="notalert" v-if="notiftype=='friend'">
      <div>
        {{notif}}
      </div>
      <div class="buttons">
       <div>
          <button class="btn btn-outline-success" @click.prevent="confirm(userid)">confirm</button>
      </div>
      <div>
          <button class="btn btn-outline-danger" @click.prevent="unconfirm(userid)">reject</button>
      </div>
      </div>
  <h6 v-if="clickendonconftext=='add'">The friend have been added successfully!</h6>
  <h6 class="sech6"v-if="clickendonconftext=='delete'">The friend request have been deleted successfully!</h6>
  </div>
  <div id="date"><small>{{createddate}}</small></div>
      </div>
</template>

<script>
export default {
    data(){
        return{
            click:true,
            clickendonconftext:'click'
        }
    },
    props:{
        notif:{
            type:String,
            required:true
        },
        notiftype:{
            type:String,
            required:true
        },
        createddate:{
            type:String,
            required:true
        },
        post_id:{
            type:Number,
            required:true
        },
        userid:{
            type:Number,
            required:true
        },
        clicked:{
            type:Boolean,
            required:true
        }
    },
    methods:{
        showpost(post_id){
            this.$emit('browsep',post_id);
            console.log('xaa');
        },
        confirm(userid){
            this.clickendonconftext='add';
            setTimeout(()=>{this.$emit('sendid',userid)},3000);
            this.click=false;
        },
        unconfirm(userid){
            this.clickendonconftext='delete';
            setTimeout(()=>{this.$emit('delete',userid)},3000);
            this.click=false;
        }
    },
    computed:{
        style(){
            if(this.notiftype==="like"){
                return "like"
            }else if(this.notiftype=="friend"){
                return "friend"
            }
        },
    }
}
</script>

<style scoped>
.like{
    display:flex;
    justify-content: center;
    width:290px;
    height:40px;
    text-align: center;
    position: relative;
    font-weight: bold;
    border-bottom:0.5px solid gray;
    background:white;
    cursor: pointer;
}
.friend{
    display:flex;
    justify-content: center;
    width:290px;
    height:70px;
    text-align: center;
    position: relative;
    font-weight: bold;
    border-bottom:0.5px solid gray;
    background:white;
}
.buttons{
    display:flex;
    justify-content: space-around;
    padding:5px;
}
.btn{
    padding: 0px;
    text-align: center;
    height:30px;
    width:60px;
}
#date{
    position: absolute;
    bottom:1px;
    right:1px;
}
small{
    font-size: 10px;
}
</style>