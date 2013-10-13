create table users(
    username varchar(10),
    password varchar(255) not null,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(100) not null,
    type varchar(10) not null,
    reputation int(5),
    primary key(username)
);

create table cookies(
    username varchar(10),
    cookhash varchar(50),
    primary key(cookhash)
);

create table faculties(
    faculty_name varchar(100),
    primary key(faculty_name)
);

create table departments(
    dept_name varchar(100),
    faculty_name varchar(100),
    primary key(dept_name),
    foreign key(faculty_name) references faculties(faculty_name)
);

create table rooms (
    room_id int(6) NOT NULL AUTO_INCREMENT,
    room_name   varchar(100) not null,
    dept_name   varchar(100),
    capacity    int(5) check(capacity>0),
    aircondition    ENUM('Y','N'),
    com_lab    ENUM('Y','N'),
    primary key(room_id),
    foreign key(dept_name) references departments(dept_name) on delete set null    
);

create table requests (
    request_id int(10) NOT NULL AUTO_INCREMENT,
    room_id   int(6) not null,
    username varchar(10) not null,
    request_date    DATE not null,
    begin_time      TIME not null,
    end_time        TIME not null,
    reason  TEXT not null,
    req_items    TEXT,
    primary key(request_id),
    foreign key(room_id) references rooms(room_id) on delete cascade,
    foreign key(username) references users(username) on delete cascade
);

create table reservations (
    reserve_id int(10) NOT NULL AUTO_INCREMENT,
    room_id   int(6) not null,
    username varchar(10) not null,
    reserve_date    DATE not null,
    begin_time      TIME not null,
    end_time        TIME not null,
    reason  TEXT not null,
    req_items    TEXT,
    auth_by varchar(10) not null,
    feebback int(2),
    primary key(reserve_id),
    foreign key(room_id) references rooms(room_id) on delete cascade,
    foreign key(username) references users(username) on delete cascade,
    foreign key(auth_by) references users(username) on delete cascade
);

create table admins(
    username varchar(10),
    room_id int(6),
    primary key(username,room_id),
    foreign key(room_id) references rooms(room_id) on delete cascade,
    foreign key(username) references users(username) on delete cascade
);

create table staff(
    username varchar(10),
    room_id int(6),
    primary key(username,room_id),
    foreign key(room_id) references rooms(room_id) on delete cascade,
    foreign key(username) references users(username) on delete cascade
);

create table complaints(
    complaint_id int(10) NOT NULL AUTO_INCREMENT, 
    reserve_id int(10),
    complaint  TEXT NOT NULL,
    made_by varchar(10),
    reviewed ENUM('Y','N'),    
    primary key(complaint_id),
    foreign key(reserve_id) references reservations(reserve_id) on delete cascade,
    foreign key(made_by) references users(username) on delete set null    
);