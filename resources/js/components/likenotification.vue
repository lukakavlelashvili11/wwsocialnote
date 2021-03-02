<template>
  <div id="notalert" v-if="notiftype=='like'" v-for="notif in dispnotifs" @mouseenter="showpost(notif[0])" @mouseout="byepost(notif[0])">
   <div id="notclose" @click.prevent="$('#notpos').hide('slow')">X</div>
    <div id="notcontent">
    <span style="z-index: 0;">@{{notif[1]}}</span>
    <div>
    <small>touch this to browse the post.</small>
    </div>
</div>
</div>
</template>

<script>
export default {

}
</script>

<style>
#notalert{
        display:flex;
        justify-content: center;
        width:190px;
        height: 50px;
        border:1px solid red;
        text-align: center;
        position: relative;
        font-weight: bold;
        margin-top:10px;
        display: none;
        background:white;
    }
    #notcontent{
        position: absolute;
        z-index: -1;
        left:10px;
        background:white;
    }
    #notclose{
        position: absolute;
        top:-5px;
        right:0px;
        width:10px;
        height:10px;
        z-index:10;
        cursor: pointer;
        font-size:15px;
    }
</style>