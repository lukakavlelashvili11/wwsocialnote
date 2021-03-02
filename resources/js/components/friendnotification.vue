<template>
<div class="main">
  <div class="notalert" @mousemove="stopop" v-if="op>0 && clickendonconftext=='click'" :style="styleObject">
      <div>
        {{notification}}
      </div>
      <div class="buttons">
       <div>
          <button class="btn btn-outline-success" @click.prevent="confirm(userid)">confirm</button>
      </div>
      <div>
          <button class="btn btn-outline-danger" @click.prevent="unconfirm(userid)">refuse</button>
      </div>
      </div>
  </div>
  <h6 v-if="clickendonconftext=='add'">The friend have been added successfully!</h6>
  <h6 class="sech6"v-if="clickendonconftext=='delete'">The friend request have been deleted successfully!</h6>
</div>
</template>

<script>
window.axios = require('axios');
import axios from 'axios';
export default {
    name:'notalert',
    data(){
        return{
            op:10,
            interval:'',
            clickendonconftext:'click',
            styleObject: {
            opacity:'',
            }
        }
    },
    props:{
        notification:{
            type:String,
            required:true
        },
        userid:{
            type:Number,
            required:true
        }
    },
    methods:{
        style(){
            this.op--;
            this.styleObject.opacity='0.'+this.op;
            if(this.op==0){
                window.clearInterval(this.interval);
            }
        },
        stopop(){
            this.op=10;
        },
        confirm(userid){
            this.clickendonconftext='add';
            setTimeout(()=>{this.$emit('sendid',userid)},3000);
        },
        unconfirm(userid){
            this.clickendonconftext='delete';
            setTimeout(()=>{this.$emit('delete',userid)},3000);
        }

    },
    mounted(){
        this.interval=setInterval(this.style,2000);
    }


}
</script>

<style scoped>
.main{
    position: relative;
    width:250px;
    height: 70px;
}
.notalert{
    font-weight:bold;
    width:250px;
    height: 70px;
    border:1px solid red;
    box-shadow: 0px 0px 5px gray;
    text-align: center;
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
h6{
    color:green;
    position:absolute;
    top:10px;
    left:30px;
}
.sech6{
    color:red;
    position:absolute;
    top:10px;
    left:30px;
}
</style>