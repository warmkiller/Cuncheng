<style>
           *{ margin:0;padding:0;}
           #zd{width: 1100px;height: 300px;overflow: hidden;position: relative;margin:0 auto;}
           #zd ul{position: absolute;left:0;top:0;}
           #zd ul li{width: 1100px;height: 300px;float: left; }
</style>
        <div id="zd">
            <ul>
    <li style='background:' ><a href='#' title='食品安全' target='_blank'><img alt='食品安全' src='http://www.cuncin.com/zb_users/upload/2015/10/201510201445303473922377.jpg' /></a></li>
<li style='background:#f79646' ><a href='#' title='食品' target='_blank'><img alt='食品' src='http://www.cuncin.com/zb_users/upload/2015/10/201510201445303580699090.jpg' /></a></li>

            </ul>
        </div>

        <script>
        var oul=$("zd").getElementsByTagName("ul")[0],
            oli=oul.getElementsByTagName("li"),
            timers=null,
            timer=null,
            i=0,
            oliW=oli[0].offsetWidth;
            oul.style.width=oli.length*oliW+"px";
            function $(id){
                 return document.getElementById(id);
            }
            function getClass(obj,name){
                if(obj.currentStyle){
                    return obj.currentStyle[name]
                }else{
                     return getComputedStyle(obj,false)[name]
                }
            }
            function Stratmove(obj,json,funEnd,callback){
               clearInterval(obj.timer);
               obj.timer=setInterval(function(){
                   for(var attr in json){
                       var bStop=true,
                           cuur=parseFloat(getClass(obj,attr)),
                           speed=0;
                       if(attr=="opacity"){
                          cuur=Math.round(parseFloat(getClass(obj,attr))*100);
                       }else{
                          cuur=parseFloat(getClass(obj,attr));
                       }
                       speed=(json[attr]-cuur)/8;
                       speed=speed>0?Math.ceil(speed):Math.floor(speed);
                       if(cuur!=json[attr]){
                            bStop=false;
                       }
                       if(attr=="opacity"){
                            obj.style["opacity"]=(cuur+speed)/100;
                                   obj.style["filter"]="alpha(opacity="+cuur+speed+")";

                       }else{
                            obj.style[attr]=Math.round(cuur+speed)+"px";
                       }
                       if(bStop){
                          clearInterval(obj.timer);
                                                  callback();
                       }
                       if(funEnd)funEnd();
                   }
               },30)
            }
            var arr=[];
                        timers=setInterval(function(){
                                Stratmove(oul,{"left":-oliW},null,calls); 
                                               
               },3000);     
                    function calls(){
                                arr.push(oli[0]);
                                oul.removeChild(oli[0]);
                                oul.appendChild(arr[0]);
                                arr.splice(0,arr.length);
                                oul.style.left=0;
                      }
        </script>
    