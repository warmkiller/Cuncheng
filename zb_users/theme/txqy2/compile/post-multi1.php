
<li><?php 
$temp=mt_rand(1,1);
$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
$content = $article->Content;
preg_match_all($pattern,$content,$matchContent);
if(isset($matchContent[1][0]))
$temp=$matchContent[1][0];
else
$temp=$zbp->host."zb_users/theme/$theme/include/pic.png";
 ?>
<a href="<?php  echo $article->Url;  ?>" title="<?php  echo $article->Title;  ?>" class="xian"><img src="<?php  echo $temp;  ?>"  alt="<?php  echo $article->Title;  ?>" /></a><p><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Title;  ?></a></p></li>
