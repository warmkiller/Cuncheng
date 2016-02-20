
<li><h2><span><?php  echo $article->Time('Y-m-d');  ?></span><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Title;  ?></a></h2>
<?php $description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),100)).'...'); ?>
<p><?php  echo $description;  ?></p>
</li>