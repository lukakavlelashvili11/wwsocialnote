<template>
  <div class="joined">{{username}}
      <div id="small"><small>active</small></div>
  </div>
</template>

<script>
export default {
    props:{
        username:{
            type:String,
            required:true
        }
    }

}
</script>

<style scoped>
small{
    color:rgb(78, 141, 78);
    text-shadow: 0px 0px 2px green;
}
#small{
    position: absolute;
    bottom:0px;
    right:1px;
}
.joined{
    width: 138px;
    height:30px;
    cursor:pointer;
    text-align: center;
    position: relative;
}
.joined:hover{
    background:rgb(233, 226, 226);;
}
@media only screen and (max-width:500px) {
    .joined{
        width:100%;
        border-bottom:1px solid black;
    }
}
</style>