<?php
include "functionsv1.php";


if(createUser("ToastyToes","HackRPI","encarc@rpi.edu")){
	echo "You done did good with create user funct";
}
else{
	echo "You done fucked up mate. This create user ";
}

echo "finding user:";
echo findUser("ToastyToes");


if(createPost(0,0,"yikyak","i does tests")){
	echo "Post created";
}
else{
	echo "Done messed up posting";
}

echo findPost(0); 

