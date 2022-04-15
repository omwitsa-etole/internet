Instructions

Run the app with apache server (latest version)
Create a database called class.

Create tables
users, messages, jobs, post, comments, jobs_taken, friends

users table has :
    id int auto_increment primary key not null;
    username varchar(100) not null ;
    name varchar(100) not null;
    email varchar(100) not null;
    phone varchar(100) not null;
    password varchar(100) not null;
    activated tiny int ;
    gender varchar(50)
    background varchar(100)
    mode tiny int
    
messages table has :
    no int auto_increment primary key not null;
    id not null;
    fromusername varchar(100);
    tousername varchar(100);
    message text(500);
    is_read tiny int ;
    time datetime current time stamp;
    
posts table has:
    no int auto_increment primary key;
    id int not null;
    username varchar(100);
    name varchar(100);
    filename varchar(100);
    posts text(500);
    likes int ;
    dislikes int;
    dislikes int;
    time current time stamp;
    
jobs has:
    no auto_increment primary key;
    taken tiny int
    time current time stamp
	id int username varchar
	name varchar
	title text
	major text
	minor text
	sub text
	files varchar
	description text
	amount int
	
jobs_taken table has:
    no int auto_increment primary key;
    job_id int
    id int ;
    title text(300);
	time datetime current timestamp;
    
friends table has:
    id iny;
    id_friend int
    username varchar
    name varchar
    is_confirmed tiny int;
 
 comments table has:
     no int
     id int
     username varchar
     comment text