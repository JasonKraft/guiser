<?php
include "functionsv1.php";



if(createUser("ToastyToes","HackRPI","encarc@rpi.edu")){
	echo "You done did good with create user funct\n";
}
else{
	echo "You done fucked up mate. This create user \n";
}

if(createUser("ToastyToes","HackRPI", "magic_cardmaster@yahoo.com")){
	echo "same username, should not work\n";
}
else{
	echo "it worked, same name did not create user\n";
}

if(createUser("swood","HackRPI", "encarc@rpi.edu")){
	echo "same email, should not work";
}
else{
	echo "it worked, same email did not create user\n";
}

createUser("swood","HackRPI", "magic_cardmaster@yahoo.com");



echo "finding user:\n";
echo findUser("ToastyToes");


if(createPost(1,0,"yikyak","i does tests")){
	echo "Post created";
}
else{
	echo "Done messed up posting\n";
}

createPost(1,0,"yikyak","test 2 for you!");
createPost(2,0,"hackRPI", "started at the bottom now i hv no clue where i am");

echo "getPost:";
echo getPost(0);

echo "findPost:";
echo findPost(1);

echo "getPostsByUser";
echo getPostsByUser(1);

echo "getCategories";
echo getCategories(0);

if(erasePost(1)){
	echo "erase post successful";
}
else{
	echo "get this off the internet\n";
}

echo "getPostByCategory\n";
echo getPostByCategory(0);