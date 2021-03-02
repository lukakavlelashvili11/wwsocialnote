<template>
    <li><div :id="style"><slot></slot>
    <div :id="side"><small>{{username}}</small></div>
    
    </div></li>
</template>

<script>
export default {
    data(){
        return{
            username:''
        }
    },
    props:{
        user:{
            type:String,
            required:false,
        },
        you:{
            type:String,
            required:false
        }
    },
    computed:{
        style(){
            if(this.user==="you" || this.user==this.you){
                this.username="you";
                return "you"
            }else{
                this.username=this.user;
                return "other"
            }
        },
        side(){
            if(this.user==="you" || this.user==this.you){
                this.username="you";
                return "right"
            }else{
                this.username=this.user;
                return "left"
            }
        }

    },

    }
    
</script>
<style scoped>
#you{
    max-width: 200px;
    word-wrap: break-word;
    text-align: left;
    padding:3px;
    margin-top:10px;
    line-height: 17px;
    margin-right: 10px;
    float: right;
    border:1px solid black;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    border-bottom-left-radius: 5px;
    box-shadow: 0px 0px 5px gray;
    border:1px solid red;
}
#other{
    max-width: 200px;
    word-wrap: break-word;
    text-align: left;
    padding:3px;
    margin-top:10px;
    line-height: 17px;
    margin-left: 10px;
    float: left;
    border:1px solid black;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    box-shadow: 0px 0px 5px gray;
    background:rgb(109, 109, 219);
    border:1px solid blue;
}
#right{
    text-align: right;
}
#left{
    text-align: left;
}
</style>
