create table if not exists users
(
    user_id
    int
    auto_increment
    primary
    key,
    email
    varchar
(
    100
) not null,
    full_name varchar
(
    100
) not null,
    gender varchar
(
    10
) not null,
    status varchar
(
    10
) not null,
    constraint unique_email unique
(
    email
)
    );

