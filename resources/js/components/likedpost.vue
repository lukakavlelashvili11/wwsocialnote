<template>
    <center>
<div id="post">
<div id="subpost">
<div>
<a class="font-weight-bold text-decoration-none":href="'account/'+post.user_id">{{post.user.name}}</a>
<div id="cancel" @click="cancelpost"><img src="img/cancel1.svg"/></div>
</div>
<div>
<p style="margin-top:0px;margin-bottom:0px;padding-top:4px;padding-bottom:4px;padding-right:4px;">{{post.body}}</p> 
    </div>
</div>

<div v-if="post.img_name">    
<img :src="'storage/'+post.img_name"style="width:100%;">
</div>

<div class="d-flex justify-content-between pl-1 text-info">
    <div style="display:flex;height:100%;align-items:center">
    <div :id="post.id"style="margin-left:2px;"v-if="post.likes.length==1">{{post.likes.length}} like</div>
    <div :id="post.id"style="margin-left:2px;"v-else>{{post.likes.length}} likes</div>
    </div>
    <div>
    </div>
</div>
</div>
</center>

  
</template>

<script>
export default {
    props:{
        post:{
            required:true
        },
    },
    methods:{
            cancelpost(){
                this.$emit('cancelpost');
            }
        }
}
</script>

<style scoped>
@media only screen and (max-width: 500px) {
    #post{
        margin-top: -40px;
        width:95%
    }
}
#post{
    position: relative;
    z-index: 3000;
}
#cancel{
        margin-left: 95%;
        margin-top:-17px;
        cursor: pointer;
    }
#cancel img{
        width:15px;
    }
</style>