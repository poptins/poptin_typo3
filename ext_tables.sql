#
# Table structure for table 'poptin'
#

CREATE TABLE `poptin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `POPTIN_USER_ID` varchar(150) NOT NULL,
  `POPTIN_CLIENT_ID` varchar(150) NOT NULL,
  `POPTIN_TOKEN` varchar(150) NOT NULL,
  `POPTIN_LOGIN_URL` varchar(150) NOT NULL,
  `POPTIN_ACCOUNT_EMAIL` varchar(150) NOT NULL,
  `POPTIN_REGISTRATION_DATE` varchar(150) NOT NULL,
  `account_id` text NOT NULL,
  PRIMARY KEY (`id`)
);