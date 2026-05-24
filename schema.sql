CREATE TABLE IF NOT EXISTS public.users (
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    accountnum VARCHAR(255),
    address TEXT,
    users_pnumber VARCHAR(255),
    is_verified SMALLINT DEFAULT 0,
    otp_code VARCHAR(255),
    otp_expiry TIMESTAMP
);

CREATE TABLE IF NOT EXISTS public.customer (
    cust_id SERIAL PRIMARY KEY,
    cust_name VARCHAR(255),
    cust_account VARCHAR(255),
    cust_address TEXT,
    amount NUMERIC,
    due_date DATE,
    billing_month VARCHAR(50),
    status VARCHAR(50) DEFAULT 'Unpaid',
    prreading NUMERIC DEFAULT 0,
    creading NUMERIC DEFAULT 0,
    treading NUMERIC DEFAULT 0
);

CREATE TABLE IF NOT EXISTS public.complaint (
    id SERIAL PRIMARY KEY,
    user_id INT,
    name VARCHAR(255),
    accountnumber VARCHAR(255),
    address TEXT,
    contact VARCHAR(255),
    complaint TEXT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'Pending',
    remarks TEXT,
    remarks_date TIMESTAMP
);

CREATE TABLE IF NOT EXISTS public.application (
    id SERIAL PRIMARY KEY,
    user_id INT,
    fname VARCHAR(255),
    lname VARCHAR(255),
    address TEXT,
    contact VARCHAR(255),
    occupation VARCHAR(255),
    bday DATE,
    class VARCHAR(255),
    conntype VARCHAR(255),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'Pending'
);

CREATE TABLE IF NOT EXISTS public.payments (
    payment_id SERIAL PRIMARY KEY,
    cust_id INT,
    cust_account VARCHAR(255),
    amount NUMERIC,
    payment_method VARCHAR(255),
    status VARCHAR(50),
    reference_no VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS public.admin (
    id SERIAL PRIMARY KEY,
    user VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS public.guest_users (
    id SERIAL PRIMARY KEY,
    google_id VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
