<?php
$post_content = '<a href="http://www.test.com" title="test">test.com</a> there is another example <a href="http://www.test1.com">test1.com</a>
one more here too <a href="http://www.test2.com" title="test2">test2.com</a>';
preg_match_all('/<a href="(.*?)"/s', $post_content, $matches);
print_r($matches);



?>