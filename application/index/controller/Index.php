<?php
namespace app\index\controller;

class Index extends Base
{
    public function index()
    {
    	return $this->fetch();
    }
    public function online()
    {
        return $this->fetch();
    }
    public function drag()
    {
        return $this->fetch();
    }
    public function clock()
    {
        return $this->fetch();
    }
    public function edit(){
        if(!input('?param.id')){
            $css="body { \\n  font-family:\'微软雅黑\'; \\n  padding: 10px; \\n  font-size: 13px; \\n}\\n ";
            $html="<div>Hello World!</div>\\n<p>大家好</p>";       
           
            $this->assign('css',$css);           
            $this->assign('html',$html);
            return $this->fetch();
        }
          

        if(input('param.id')==1)//展示学生作品-有毛病
        {
             $css="body{\\n    background-color:#009}\\n .wrapper{\\n    width:800px;\\n    margin:0px auto;\\n    padding:50px;\\n    }\\n#title{\\n    font-size: 24pt;\\n    height:30px;\\n    text-align:center;}\\n
.bt{    font-size: 18pt;\\n    }\\n .bt1{\\n    color:#F00;\\n    font-size: 18pt;}\\n    .bt2{\\n    color:#F00;\\n    font-size: 18pt;}\\n    .bt3{\\n    color:#F00;\\n    font-size: 18pt;}\\n    .bt4{\\n    color:#F00;\\n    font-size: 18pt;}\\n p {\\n    font-size: 12pt;\\n    line-height: 28px;\\n    text-indent: 2em;\\n    margin-bottom: 20px;\\n }\\n #p1{\\n    background-color:#069;\\n    color:#FFF;\\n    padding:20px}\\n .p2{\\n   
    font-size: 13pt;\\n    line-height: 34px;\\n    padding: 0 38px;\\n    color:#1F4A76;\\n }\\n span{    font-weight: bold;\\n margin:10px 30px;}\\n .detail{\\n    color:#F00;\\n    text-decoration:none;}\\n hr{\\n    border-bottom:1px solid #069;}";

            $html="<div class=\"wrapper\">\\n  <h1 id=\"title\">学会这几招 你也能预报天气</h1>\\n  <hr>\\n  <p id=\"p1\">在遥远的古代，我们通过“观云”来“识天”。甲骨文中云字是这样写的： 学会这三招 你也能预报天气，表示气流在天空流动。先人们已经充分认识到了云是大气活动在天空的投影。不过，从“天气小白”到“观云识天”大拿，还有几步要走。 <a href=\"#\" class=\"detail\">【详情】</a> </p>\\n  <h3 class=\"bt1\">Step1：睁开眼，抬头看！</h3>\\n  <hr>\\n  <p>看云这个动作说来简单，却也内藏乾坤。3族10属29类的云，数据帝数一半估计你就“扑街”了。不过呢，我还是愿意奉上一张高清无码彩图，供你自行研习，短则一日，长则半月，10种云到底孰高孰低、相貌如何，相信你定能如数家珍。</p>\\n  <h3 class=\"bt2\">\\ntep2：山人自有秒诀</h3>\\n  <hr>\\n  <p>光记住了云的种类以及它们的特征，似乎还不够，观云还未能“识天”。在了解背后的原理之前，不妨先来记些提升B格的口（yan）诀（yu）好了。</p>\\n  <p><strong>“日晕三更雨，月晕午时风”</strong></p>\\n  <p>抬头看天，在太阳和月亮的周围，有时会出现一种七彩光圈，里层是红色的，外层是紫色的。我们把这种光圈叫做晕，相反的就是华。古有“日晕三更雨，月晕午时风”的说法。不过呢，日晕和月晕常常产生在卷层云上，往往预示着天气系统正在移入或移出，所以，日晕、月晕的出现意味着天气将出现变化，但不一定是风雨到来。</p>\\n  <P><STRONG>“有雨山戴帽，无雨云拦腰”</STRONG></P>\\n  <P>出门爬山时，总觉得多带一片羽毛都是负担。那么到底要不要带雨衣呢？</P>\\n  <P>抬头看山，如果云层灰暗且低，那就是“山雨欲来”的前兆。但如果山戴帽后云层不再下降变低，有可能不会下雨。而“云拦腰”的现象，多半是由于夜间辐射冷却而形成的层云，而且很可能只是雾，所以“云拦腰”一般是好天气到来的象征。</P>\\n  <P><STRONG>“朝霞不出门，晚霞行千里”</STRONG></P>\\n  <P>出现朝霞往往意味着水汽增多，流向本地，随着白天气温上升，对流增强，容易产生降雨。</P>\\n  <P>而晚霞的出现则表示气温下降，对流减弱，水汽正在移出本地，不容易造成降雨或降雨将很快停止。</P>\\n  <h3 class=\"bt3\">Step3：好云坏云来站队</h3>\\n  <hr>\\n  <P>其实，关于云的样子和对应天气，对症下药是关键。“好云”“坏云”其实还真是有区别。数据帝细心地整理了下，不同颜值下的云和好坏天气的关系如下：</P>\\n  <P>中立的云表示当前天气是好的，但未来会有变化。我们把对应好天气的云的样子给记住，以此区分，倒也不失为一种好办法。</P>\\n  <h3 class=\"bt4\">Step4：透过现象看本质</h3>\\n  <hr>\\n  <P>究竟云是如何与天气变化联系起来的呢？</P>\\n  <P>以暖锋为例，如果在地面观测的时候，先看到了卷云，接着又看到了卷层云和高层云，云量越来越多，云的高度也越来越低，这就意味着雨雪马上就要来了，暖气团正步步紧逼，带来雨雪和雾天。</P>\\n  <P>如果冷暖交汇对流不剧烈，或者锋面比较平缓，暖湿气流缓慢在冷空气上爬升，在冷锋后部产生雨层云，会导致相对平缓但连绵不断的降雨。夏季梅雨期间，南方有时会出现积层云和积雨云共存的情况，这时就会呈现降雨持续不断，有时降雨很强很激烈的特点。</P>\\n  <P>3月以来，南方经常是暖湿气流在冷空气上缓慢爬升，导致了大范围连续阴雨，天空灰灰的，一副死样的主要就是雨层云和层云。好消息是26-27日，降雨将自西北向东南陆续结束，湖南和江西等地26日在天空中有望看到飘逸的卷云，27日南方全面大晴天！</P>\\n  <hr>\\n  <h3 class=\"bt1\">结语</h3>\\n  <p class=\"p2\">当然，观云识天气不可能百发百中。云自身演变时的偶发因素、地域差异、地形条件都会使这种经验预报法失灵，需要结合当地的气候特征，再进行判断。而且，观云只能预测短时天气状况，加上有时候云与云之间的形状比较相似，判断起来比较困难，云的发展演变又快，对晴雨的预测很难达到令人满意的程度。所以，大家出行最好还是查天气预报。</p>\\n  <p><span>审核：信欣 刘文静</span><span >编辑：刘晓丹</span> <span>美工：任成英</span><span>技术：李强</span>   </p>\\n</div>";       
           
            $this->assign('css',$css);           
            $this->assign('html',$html);
            return $this->fetch();
        }
        if(input('param.id')=='1001')//第一关
        {
             $css="";
            $html="<div>第一关</div>\\n<p>大家好</p>";       
             $task="第一关的任务是"; 
             $this->assign('task',$task);
            $this->assign('css',$css);           
            $this->assign('html',$html);
             $this->assign('id','1002');
            return $this->fetch();
        }
        if(input('param.id')=='1002')//第二关
        {
             $css="";
            $html="<div>第2关</div>\\n<p>大家好</p>";       
             $task="第2关的任务是"; 
             $this->assign('task',$task);
            $this->assign('css',$css);           
            $this->assign('html',$html);
             $this->assign('id','1003');
            return $this->fetch();
        }
        if(input('param.id')=='1003')//第三关
        {
             $css="";
             $html="<div>第3关</div>\\n<p>大家好</p>";       
             $task="第3关的任务是"; 
             $this->assign('task',$task);
            $this->assign('css',$css);           
            $this->assign('html',$html);
             $this->assign('id','1004');
            return $this->fetch();
        }
        if(input('param.id')=='1004'){
             $css="body { \\n  font-family:\'微软雅黑\'; \\n  padding: 10px; \\n  font-size: 20px; \\n color:red;\\ntext-align:center;\\n}\\n ";
            $html="<h1>恭喜您！</h1>\\n<h1>完成通关任务！</h1>";        
           
            $this->assign('css',$css);           
            $this->assign('html',$html);
              return $this->fetch();
        }
    }
}