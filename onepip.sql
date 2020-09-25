create database onedaysys;

 use onedaysys;

 CREATE TABLE userdata (
  id 	VARCHAR(30) NOT NULL,
  fname VARCHAR(100)  NULL,
  email 	VARCHAR(30) NOT NULL,
  phone VARCHAR(30)  NULL,
  address VARCHAR(300)  NULL,
  addressbtc VARCHAR(300)  NULL,
  pwd 	VARCHAR(70) NOT NULL,
  akaun VARCHAR(10) NULL,
  aktif VARCHAR(2),
  verifymel VARCHAR(2)  default "N",
  akaunb VARCHAR(30) NULL,
  jenisb VARCHAR(100) NULL,
  penama VARCHAR(100) NULL,
  ipaddress VARCHAR(30),
  lastlogin TIMESTAMP NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  image LONGBLOB ,
  PRIMARY KEY (id)
);

 CREATE TABLE wallet (
  id 	VARCHAR(30) NOT NULL,
  walletb 	VARCHAR(30) NOT NULL  default "0",
  walletc 	VARCHAR(30) NOT NULL default "0",
  walletpo 	VARCHAR(30) NOT NULL default "0",
  earning 	VARCHAR(30) NULL,
  usdt 	VARCHAR(30) NOT NULL default "0",
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

 CREATE TABLE affiliate (
  upline 	VARCHAR(30) NOT NULL,
  userid 	VARCHAR(30) NOT NULL,
  leader VARCHAR(30) NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (upline,userid)
);

 CREATE TABLE master (
  sn  INT(10),
  planname VARCHAR(30) NULL,
  mininv INT(10) NOT NULL,
  minwd  INT(10) NOT NULL,
  planroi VARCHAR(30) NOT NULL,
  planday VARCHAR(30) NOT NULL,
  plantype VARCHAR(20) NOT NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (sn)
);

 CREATE TABLE investment (
  sn 	 INT(10) NOT NULL,
  id 	 VARCHAR(30) NOT NULL,
  amount VARCHAR(30) NOT NULL,
  planname VARCHAR(30) NOT NULL,
  planroi VARCHAR(30) NOT NULL,
  planday VARCHAR(30) NOT NULL,
  plantype VARCHAR(20) NOT NULL,
  counter VARCHAR(30) NOT NULL DEFAULT "0",
  stat VARCHAR(30) NOT NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (sn,id)
);


 CREATE TABLE withdrawal (
  sn 	 INT(10) NOT NULL,
  id 	 VARCHAR(30) NOT NULL,
  amount VARCHAR(30) NOT NULL,
  stat VARCHAR(30) NOT NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (sn,id)
);

CREATE TABLE depositlog (
  sn  INT(10),
  id VARCHAR(50) NULL,
  amount   VARCHAR(30) NULL,
  walletb  VARCHAR(30) NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (sn)
);


 CREATE TABLE investlog (
  sn  INT(10),
  memberid VARCHAR(50) NULL,
  amount   VARCHAR(30) NULL,
  income   VARCHAR(30) NULL,
  planname VARCHAR(30) NOT NULL,
  planroi VARCHAR(30) NOT NULL,
  planday VARCHAR(30) NOT NULL,
  walletb  VARCHAR(30) NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (sn)
);

 CREATE TABLE walletlog (
  sn  INT(10),
  memberid VARCHAR(50) NULL,
  amount   VARCHAR(30) NULL,
  walletb  VARCHAR(30) NULL,
  walletc  VARCHAR(30) NULL,
  sender  VARCHAR(30) NULL,
  trc  VARCHAR(10) NULL,
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (sn)
);

CREATE TABLE blockchain (
  sn  INT(10),
  memberid VARCHAR(50),
  amount   VARCHAR(30),
  stat VARCHAR(20),
  cointype VARCHAR(20),
  created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (sn,memberid)
);