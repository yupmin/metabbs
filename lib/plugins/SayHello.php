<?php
function before_say_hello_handler() {
	echo "before";
}
function say_hello_handler() {
	echo "<h1>Hello, world!</h1>";
	echo "<p>This is MetaBBS Plugin API test.</p>";
}
add_handler('say', 'hello', 'before_say_hello_handler', 'before');
add_handler('say', 'hello', 'say_hello_handler');
?>
