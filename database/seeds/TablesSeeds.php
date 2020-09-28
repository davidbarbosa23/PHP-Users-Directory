<?php

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirname(dirname(__DIR__)) . DS);

// Composer Autoload
require BASE_PATH . 'vendor' . DS . 'autoload.php';

// Load Envirinment Variables
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

// Database Connection
require BASE_PATH . 'config' . DS . 'database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$countriesQuery = "INSERT INTO `countries` 
    VALUES (1,'Afghanistan',1),(2,'Albania',1),(3,'Algeria',1),(4,'American Samoa',1),(5,'Andorra',1),(6,'Angola',1),(7,'Anguilla',1),
           (8,'Antarctica',1),(9,'Antigua and Barbuda',1),(10,'Argentina',1),(11,'Armenia',1),(12,'Aruba',1),(13,'Australia',1),
           (14,'Austria',1),(15,'Azerbaijan',1),(16,'Bahamas',1),(17,'Bahrain',1),(18,'Bangladesh',1),(19,'Barbados',1),(20,'Belarus',1),
           (21,'Belgium',1),(22,'Belize',1),(23,'Benin',1),(24,'Bermuda',1),(25,'Bhutan',1),(26,'Bolivia',1),(27,'Bosnia and Herzegovina',1),
           (28,'Botswana',1),(29,'Bouvet Island',1),(30,'Brazil',1),(31,'British Indian Ocean Territory',1),(32,'Brunei Darussalam',1),
           (33,'Bulgaria',1),(34,'Burkina Faso',1),(35,'Burundi',1),(36,'Cambodia',1),(37,'Cameroon',1),(38,'Canada',1),(39,'Cape Verde',1),
           (40,'Cayman Islands',1),(41,'Central African Republic',1),(42,'Chad',1),(43,'Chile',1),(44,'China',1),(45,'Christmas Island',1),
           (46,'Cocos (Keeling) Islands',1),(47,'Colombia',1),(48,'Comoros',1),(49,'Congo',1),(50,'Cook Islands',1),(51,'Costa Rica',1),
           (52,'Croatia (Hrvatska)',1),(53,'Cuba',1),(54,'Cyprus',1),(55,'Czech Republic',1),(56,'Denmark',1),(57,'Djibouti',1),(58,'Dominica',1),
           (59,'Dominican Republic',1),(60,'East Timor',1),(61,'Ecuador',1),(62,'Egypt',1),(63,'El Salvador',1),(64,'Equatorial Guinea',1),
           (65,'Eritrea',1),(66,'Estonia',1),(67,'Ethiopia',1),(68,'Falkland Islands (Malvinas)',1),(69,'Faroe Islands',1),(70,'Fiji',1),
           (71,'Finland',1),(72,'France',1),(73,'France, Metropolitan',1),(74,'French Guiana',1),(75,'French Polynesia',1),
           (76,'French Southern Territories',1),(77,'Gabon',1),(78,'Gambia',1),(79,'Georgia',1),(80,'Germany',1),(81,'Ghana',1),(82,'Gibraltar',1),
           (83,'Guernsey',1),(84,'Greece',1),(85,'Greenland',1),(86,'Grenada',1),(87,'Guadeloupe',1),(88,'Guam',1),(89,'Guatemala',1),
           (90,'Guinea',1),(91,'Guinea-Bissau',1),(92,'Guyana',1),(93,'Haiti',1),(94,'Heard and Mc Donald Islands',1),(95,'Honduras',1),
           (96,'Hong Kong',1),(97,'Hungary',1),(98,'Iceland',1),(99,'India',1),(100,'Isle of Man',1),(101,'Indonesia',1),
           (102,'Iran (Islamic Republic of)',1),(103,'Iraq',1),(104,'Ireland',1),(105,'Israel',1),(106,'Italy',1),(107,'Ivory Coast',1),
           (108,'Jersey',1),(109,'Jamaica',1),(110,'Japan',1),(111,'Jordan',1),(112,'Kazakhstan',1),(113,'Kenya',1),(114,'Kiribati',1),
           (115,'Korea, Democratic People\'s Republic of',1),(116,'Korea, Republic of',1),(117,'Kosovo',1),(118,'Kuwait',1),(119,'Kyrgyzstan',1),
           (120,'Lao People\'s Democratic Republic',1),(121,'Latvia',1),(122,'Lebanon',1),(123,'Lesotho',1),(124,'Liberia',1),
           (125,'Libyan Arab Jamahiriya',1),(126,'Liechtenstein',1),(127,'Lithuania',1),(128,'Luxembourg',1),(129,'Macau',1),
           (130,'North Macedonia',1),(131,'Madagascar',1),(132,'Malawi',1),(133,'Malaysia',1),(134,'Maldives',1),(135,'Mali',1),(136,'Malta',1),
           (137,'Marshall Islands',1),(138,'Martinique',1),(139,'Mauritania',1),(140,'Mauritius',1),(141,'Mayotte',1),(142,'Mexico',1),
           (143,'Micronesia, Federated States of',1),(144,'Moldova, Republic of',1),(145,'Monaco',1),(146,'Mongolia',1),(147,'Montenegro',1),
           (148,'Montserrat',1),(149,'Morocco',1),(150,'Mozambique',1),(151,'Myanmar',1),(152,'Namibia',1),(153,'Nauru',1),(154,'Nepal',1),
           (155,'Netherlands',1),(156,'Netherlands Antilles',1),(157,'New Caledonia',1),(158,'New Zealand',1),(159,'Nicaragua',1),(160,'Niger',1),
           (161,'Nigeria',1),(162,'Niue',1),(163,'Norfolk Island',1),(164,'Northern Mariana Islands',1),(165,'Norway',1),(166,'Oman',1),
           (167,'Pakistan',1),(168,'Palau',1),(169,'Palestine',1),(170,'Panama',1),(171,'Papua New Guinea',1),(172,'Paraguay',1),(173,'Peru',1),
           (174,'Philippines',1),(175,'Pitcairn',1),(176,'Poland',1),(177,'Portugal',1),(178,'Puerto Rico',1),(179,'Qatar',1),(180,'Reunion',1),
           (181,'Romania',1),(182,'Russian Federation',1),(183,'Rwanda',1),(184,'Saint Kitts and Nevis',1),(185,'Saint Lucia',1),
           (186,'Saint Vincent and the Grenadines',1),(187,'Samoa',1),(188,'San Marino',1),(189,'Sao Tome and Principe',1),(190,'Saudi Arabia',1),
           (191,'Senegal',1),(192,'Serbia',1),(193,'Seychelles',1),(194,'Sierra Leone',1),(195,'Singapore',1),(196,'Slovakia',1),(197,'Slovenia',1),
           (198,'Solomon Islands',1),(199,'Somalia',1),(200,'South Africa',1),(201,'South Georgia South Sandwich Islands',1),(202,'South Sudan',1),
           (203,'Spain',1),(204,'Sri Lanka',1),(205,'St. Helena',1),(206,'St. Pierre and Miquelon',1),(207,'Sudan',1),(208,'Suriname',1),
           (209,'Svalbard and Jan Mayen Islands',1),(210,'Swaziland',1),(211,'Sweden',1),(212,'Switzerland',1),(213,'Syrian Arab Republic',1),
           (214,'Taiwan',1),(215,'Tajikistan',1),(216,'Tanzania, United Republic of',1),(217,'Thailand',1),(218,'Togo',1),(219,'Tokelau',1),
           (220,'Tonga',1),(221,'Trinidad and Tobago',1),(222,'Tunisia',1),(223,'Turkey',1),(224,'Turkmenistan',1),(225,'Turks and Caicos Islands',1),
           (226,'Tuvalu',1),(227,'Uganda',1),(228,'Ukraine',1),(229,'United Arab Emirates',1),(230,'United Kingdom',1),(231,'United States',1),
           (232,'United States minor outlying islands',1),(233,'Uruguay',1),(234,'Uzbekistan',1),(235,'Vanuatu',1),(236,'Vatican City State',1),
           (237,'Venezuela',1),(238,'Vietnam',1),(239,'Virgin Islands (British)',1),(240,'Virgin Islands (U.S.)',1),(241,'Wallis and Futuna Islands',1),
           (242,'Western Sahara',1),(243,'Yemen',1),(244,'Zaire',1),(245,'Zambia',1),(246,'Zimbabwe',1);";

Capsule::unprepared($countriesQuery);

echo "Seeds applyed\n";
