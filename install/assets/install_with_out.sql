-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2016 at 06:45 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crunch5without`
--

-- --------------------------------------------------------

--
-- Table structure for table `dn_addons`
--

CREATE TABLE IF NOT EXISTS `dn_addons` (
`addon_id` int(11) NOT NULL,
  `addon_name` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `addon_image` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_calendar_timezones`
--

CREATE TABLE IF NOT EXISTS `dn_calendar_timezones` (
  `CountryCode` char(2) NOT NULL,
  `Coordinates` char(15) NOT NULL,
  `TimeZone` char(32) NOT NULL,
  `Comments` varchar(85) NOT NULL,
  `UTC_offset` char(8) NOT NULL,
  `UTC_DST_offset` char(8) NOT NULL,
  `Notes` varchar(79) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dn_calendar_timezones`
--

INSERT INTO `dn_calendar_timezones` (`CountryCode`, `Coordinates`, `TimeZone`, `Comments`, `UTC_offset`, `UTC_DST_offset`, `Notes`) VALUES
('CI', '+0519-00402', 'Africa/Abidjan', '', '+00:00', '+00:00', ''),
('GH', '+0533-00013', 'Africa/Accra', '', '+00:00', '+00:00', ''),
('ET', '+0902+03842', 'Africa/Addis_Ababa', '', '+03:00', '+03:00', ''),
('DZ', '+3647+00303', 'Africa/Algiers', '', '+01:00', '+01:00', ''),
('ER', '+1520+03853', 'Africa/Asmara', '', '+03:00', '+03:00', ''),
('', '', 'Africa/Asmera', '', '+03:00', '+03:00', 'Link to Africa/Asmara'),
('ML', '+1239-00800', 'Africa/Bamako', '', '+00:00', '+00:00', ''),
('CF', '+0422+01835', 'Africa/Bangui', '', '+01:00', '+01:00', ''),
('GM', '+1328-01639', 'Africa/Banjul', '', '+00:00', '+00:00', ''),
('GW', '+1151-01535', 'Africa/Bissau', '', '+00:00', '+00:00', ''),
('MW', '-1547+03500', 'Africa/Blantyre', '', '+02:00', '+02:00', ''),
('CG', '-0416+01517', 'Africa/Brazzaville', '', '+01:00', '+01:00', ''),
('BI', '-0323+02922', 'Africa/Bujumbura', '', '+02:00', '+02:00', ''),
('EG', '+3003+03115', 'Africa/Cairo', '', '+02:00', '+02:00', 'DST has been canceled since 2011'),
('MA', '+3339-00735', 'Africa/Casablanca', '', '+00:00', '+01:00', ''),
('ES', '+3553-00519', 'Africa/Ceuta', 'Ceuta & Melilla', '+01:00', '+02:00', ''),
('GN', '+0931-01343', 'Africa/Conakry', '', '+00:00', '+00:00', ''),
('SN', '+1440-01726', 'Africa/Dakar', '', '+00:00', '+00:00', ''),
('TZ', '-0648+03917', 'Africa/Dar_es_Salaam', '', '+03:00', '+03:00', ''),
('DJ', '+1136+04309', 'Africa/Djibouti', '', '+03:00', '+03:00', ''),
('CM', '+0403+00942', 'Africa/Douala', '', '+01:00', '+01:00', ''),
('EH', '+2709-01312', 'Africa/El_Aaiun', '', '+00:00', '+00:00', ''),
('SL', '+0830-01315', 'Africa/Freetown', '', '+00:00', '+00:00', ''),
('BW', '-2439+02555', 'Africa/Gaborone', '', '+02:00', '+02:00', ''),
('ZW', '-1750+03103', 'Africa/Harare', '', '+02:00', '+02:00', ''),
('ZA', '-2615+02800', 'Africa/Johannesburg', '', '+02:00', '+02:00', ''),
('SS', '+0451+03136', 'Africa/Juba', '', '+03:00', '+03:00', ''),
('UG', '+0019+03225', 'Africa/Kampala', '', '+03:00', '+03:00', ''),
('SD', '+1536+03232', 'Africa/Khartoum', '', '+03:00', '+03:00', ''),
('RW', '-0157+03004', 'Africa/Kigali', '', '+02:00', '+02:00', ''),
('CD', '-0418+01518', 'Africa/Kinshasa', 'west Dem. Rep. of Congo', '+01:00', '+01:00', ''),
('NG', '+0627+00324', 'Africa/Lagos', '', '+01:00', '+01:00', ''),
('GA', '+0023+00927', 'Africa/Libreville', '', '+01:00', '+01:00', ''),
('TG', '+0608+00113', 'Africa/Lome', '', '+00:00', '+00:00', ''),
('AO', '-0848+01314', 'Africa/Luanda', '', '+01:00', '+01:00', ''),
('CD', '-1140+02728', 'Africa/Lubumbashi', 'east Dem. Rep. of Congo', '+02:00', '+02:00', ''),
('ZM', '-1525+02817', 'Africa/Lusaka', '', '+02:00', '+02:00', ''),
('GQ', '+0345+00847', 'Africa/Malabo', '', '+01:00', '+01:00', ''),
('MZ', '-2558+03235', 'Africa/Maputo', '', '+02:00', '+02:00', ''),
('LS', '-2928+02730', 'Africa/Maseru', '', '+02:00', '+02:00', ''),
('SZ', '-2618+03106', 'Africa/Mbabane', '', '+02:00', '+02:00', ''),
('SO', '+0204+04522', 'Africa/Mogadishu', '', '+03:00', '+03:00', ''),
('LR', '+0618-01047', 'Africa/Monrovia', '', '+00:00', '+00:00', ''),
('KE', '-0117+03649', 'Africa/Nairobi', '', '+03:00', '+03:00', ''),
('TD', '+1207+01503', 'Africa/Ndjamena', '', '+01:00', '+01:00', ''),
('NE', '+1331+00207', 'Africa/Niamey', '', '+01:00', '+01:00', ''),
('MR', '+1806-01557', 'Africa/Nouakchott', '', '+00:00', '+00:00', ''),
('BF', '+1222-00131', 'Africa/Ouagadougou', '', '+00:00', '+00:00', ''),
('BJ', '+0629+00237', 'Africa/Porto-Novo', '', '+01:00', '+01:00', ''),
('ST', '+0020+00644', 'Africa/Sao_Tome', '', '+00:00', '+00:00', ''),
('', '', 'Africa/Timbuktu', '', '+00:00', '+00:00', 'Link to Africa/Bamako'),
('LY', '+3254+01311', 'Africa/Tripoli', '', '+01:00', '+02:00', ''),
('TN', '+3648+01011', 'Africa/Tunis', '', '+01:00', '+01:00', ''),
('NA', '-2234+01706', 'Africa/Windhoek', '', '+01:00', '+02:00', ''),
('', '', 'AKST9AKDT', '', '−09:00', '−08:00', 'Link to America/Anchorage'),
('US', '+515248-1763929', 'America/Adak', 'Aleutian Islands', '−10:00', '−09:00', ''),
('US', '+611305-1495401', 'America/Anchorage', 'Alaska Time', '−09:00', '−08:00', ''),
('AI', '+1812-06304', 'America/Anguilla', '', '−04:00', '−04:00', ''),
('AG', '+1703-06148', 'America/Antigua', '', '−04:00', '−04:00', ''),
('BR', '-0712-04812', 'America/Araguaina', 'Tocantins', '−03:00', '−03:00', ''),
('AR', '-3436-05827', 'America/Argentina/Buenos_Aires', 'Buenos Aires (BA, CF)', '−03:00', '−03:00', ''),
('AR', '-2828-06547', 'America/Argentina/Catamarca', 'Catamarca (CT), Chubut (CH)', '−03:00', '−03:00', ''),
('', '', 'America/Argentina/ComodRivadavia', '', '−03:00', '−03:00', 'Link to America/Argentina/Catamarca'),
('AR', '-3124-06411', 'America/Argentina/Cordoba', 'most locations (CB, CC, CN, ER, FM, MN, SE, SF)', '−03:00', '−03:00', ''),
('AR', '-2411-06518', 'America/Argentina/Jujuy', 'Jujuy (JY)', '−03:00', '−03:00', ''),
('AR', '-2926-06651', 'America/Argentina/La_Rioja', 'La Rioja (LR)', '−03:00', '−03:00', ''),
('AR', '-3253-06849', 'America/Argentina/Mendoza', 'Mendoza (MZ)', '−03:00', '−03:00', ''),
('AR', '-5138-06913', 'America/Argentina/Rio_Gallegos', 'Santa Cruz (SC)', '−03:00', '−03:00', ''),
('AR', '-2447-06525', 'America/Argentina/Salta', '(SA, LP, NQ, RN)', '−03:00', '−03:00', ''),
('AR', '-3132-06831', 'America/Argentina/San_Juan', 'San Juan (SJ)', '−03:00', '−03:00', ''),
('AR', '-3319-06621', 'America/Argentina/San_Luis', 'San Luis (SL)', '−03:00', '−03:00', ''),
('AR', '-2649-06513', 'America/Argentina/Tucuman', 'Tucuman (TM)', '−03:00', '−03:00', ''),
('AR', '-5448-06818', 'America/Argentina/Ushuaia', 'Tierra del Fuego (TF)', '−03:00', '−03:00', ''),
('AW', '+1230-06958', 'America/Aruba', '', '−04:00', '−04:00', ''),
('PY', '-2516-05740', 'America/Asuncion', '', '−04:00', '−03:00', ''),
('CA', '+484531-0913718', 'America/Atikokan', 'Eastern Standard Time - Atikokan, Ontario and Southampton I, Nunavut', '−05:00', '−05:00', ''),
('', '', 'America/Atka', '', '−10:00', '−09:00', 'Link to America/Adak'),
('BR', '-1259-03831', 'America/Bahia', 'Bahia', '−03:00', '−03:00', ''),
('MX', '+2048-10515', 'America/Bahia_Banderas', 'Mexican Central Time - Bahia de Banderas', '−06:00', '−05:00', ''),
('BB', '+1306-05937', 'America/Barbados', '', '−04:00', '−04:00', ''),
('BR', '-0127-04829', 'America/Belem', 'Amapa, E Para', '−03:00', '−03:00', ''),
('BZ', '+1730-08812', 'America/Belize', '', '−06:00', '−06:00', ''),
('CA', '+5125-05707', 'America/Blanc-Sablon', 'Atlantic Standard Time - Quebec - Lower North Shore', '−04:00', '−04:00', ''),
('BR', '+0249-06040', 'America/Boa_Vista', 'Roraima', '−04:00', '−04:00', ''),
('CO', '+0436-07405', 'America/Bogota', '', '−05:00', '−05:00', ''),
('US', '+433649-1161209', 'America/Boise', 'Mountain Time - south Idaho & east Oregon', '−07:00', '−06:00', ''),
('', '', 'America/Buenos_Aires', '', '−03:00', '−03:00', 'Link to America/Argentina/Buenos_Aires'),
('CA', '+690650-1050310', 'America/Cambridge_Bay', 'Mountain Time - west Nunavut', '−07:00', '−06:00', ''),
('BR', '-2027-05437', 'America/Campo_Grande', 'Mato Grosso do Sul', '−04:00', '−03:00', ''),
('MX', '+2105-08646', 'America/Cancun', 'Central Time - Quintana Roo', '−06:00', '−05:00', ''),
('VE', '+1030-06656', 'America/Caracas', '', '−04:30', '−04:30', ''),
('', '', 'America/Catamarca', '', '−03:00', '−03:00', 'Link to America/Argentina/Catamarca'),
('GF', '+0456-05220', 'America/Cayenne', '', '−03:00', '−03:00', ''),
('KY', '+1918-08123', 'America/Cayman', '', '−05:00', '−05:00', ''),
('US', '+415100-0873900', 'America/Chicago', 'Central Time', '−06:00', '−05:00', ''),
('MX', '+2838-10605', 'America/Chihuahua', 'Mexican Mountain Time - Chihuahua away from US border', '−07:00', '−06:00', ''),
('', '', 'America/Coral_Harbour', '', '−05:00', '−05:00', 'Link to America/Atikokan'),
('', '', 'America/Cordoba', '', '−03:00', '−03:00', 'Link to America/Argentina/Cordoba'),
('CR', '+0956-08405', 'America/Costa_Rica', '', '−06:00', '−06:00', ''),
('CA', '+4906-11631', 'America/Creston', 'Mountain Standard Time - Creston, British Columbia', '−07:00', '−07:00', ''),
('BR', '-1535-05605', 'America/Cuiaba', 'Mato Grosso', '−04:00', '−03:00', ''),
('CW', '+1211-06900', 'America/Curacao', '', '−04:00', '−04:00', ''),
('GL', '+7646-01840', 'America/Danmarkshavn', 'east coast, north of Scoresbysund', '+00:00', '+00:00', ''),
('CA', '+6404-13925', 'America/Dawson', 'Pacific Time - north Yukon', '−08:00', '−07:00', ''),
('CA', '+5946-12014', 'America/Dawson_Creek', 'Mountain Standard Time - Dawson Creek & Fort Saint John, British Columbia', '−07:00', '−07:00', ''),
('US', '+394421-1045903', 'America/Denver', 'Mountain Time', '−07:00', '−06:00', ''),
('US', '+421953-0830245', 'America/Detroit', 'Eastern Time - Michigan - most locations', '−05:00', '−04:00', ''),
('DM', '+1518-06124', 'America/Dominica', '', '−04:00', '−04:00', ''),
('CA', '+5333-11328', 'America/Edmonton', 'Mountain Time - Alberta, east British Columbia & west Saskatchewan', '−07:00', '−06:00', ''),
('BR', '-0640-06952', 'America/Eirunepe', 'W Amazonas', '−04:00', '−04:00', ''),
('SV', '+1342-08912', 'America/El_Salvador', '', '−06:00', '−06:00', ''),
('', '', 'America/Ensenada', '', '−08:00', '−07:00', 'Link to America/Tijuana'),
('BR', '-0343-03830', 'America/Fortaleza', 'NE Brazil (MA, PI, CE, RN, PB)', '−03:00', '−03:00', ''),
('', '', 'America/Fort_Wayne', '', '−05:00', '−04:00', 'Link to America/Indiana/Indianapolis'),
('CA', '+4612-05957', 'America/Glace_Bay', 'Atlantic Time - Nova Scotia - places that did not observe DST 1966-1971', '−04:00', '−03:00', ''),
('GL', '+6411-05144', 'America/Godthab', 'most locations', '−03:00', '−02:00', ''),
('CA', '+5320-06025', 'America/Goose_Bay', 'Atlantic Time - Labrador - most locations', '−04:00', '−03:00', ''),
('TC', '+2128-07108', 'America/Grand_Turk', '', '−05:00', '−04:00', ''),
('GD', '+1203-06145', 'America/Grenada', '', '−04:00', '−04:00', ''),
('GP', '+1614-06132', 'America/Guadeloupe', '', '−04:00', '−04:00', ''),
('GT', '+1438-09031', 'America/Guatemala', '', '−06:00', '−06:00', ''),
('EC', '-0210-07950', 'America/Guayaquil', 'mainland', '−05:00', '−05:00', ''),
('GY', '+0648-05810', 'America/Guyana', '', '−04:00', '−04:00', ''),
('CA', '+4439-06336', 'America/Halifax', 'Atlantic Time - Nova Scotia (most places), PEI', '−04:00', '−03:00', ''),
('CU', '+2308-08222', 'America/Havana', '', '−05:00', '−04:00', ''),
('MX', '+2904-11058', 'America/Hermosillo', 'Mountain Standard Time - Sonora', '−07:00', '−07:00', ''),
('US', '+394606-0860929', 'America/Indiana/Indianapolis', 'Eastern Time - Indiana - most locations', '−05:00', '−04:00', ''),
('US', '+411745-0863730', 'America/Indiana/Knox', 'Central Time - Indiana - Starke County', '−06:00', '−05:00', ''),
('US', '+382232-0862041', 'America/Indiana/Marengo', 'Eastern Time - Indiana - Crawford County', '−05:00', '−04:00', ''),
('US', '+382931-0871643', 'America/Indiana/Petersburg', 'Eastern Time - Indiana - Pike County', '−05:00', '−04:00', ''),
('US', '+375711-0864541', 'America/Indiana/Tell_City', 'Central Time - Indiana - Perry County', '−06:00', '−05:00', ''),
('US', '+384452-0850402', 'America/Indiana/Vevay', 'Eastern Time - Indiana - Switzerland County', '−05:00', '−04:00', ''),
('US', '+384038-0873143', 'America/Indiana/Vincennes', 'Eastern Time - Indiana - Daviess, Dubois, Knox & Martin Counties', '−05:00', '−04:00', ''),
('US', '+410305-0863611', 'America/Indiana/Winamac', 'Eastern Time - Indiana - Pulaski County', '−05:00', '−04:00', ''),
('', '', 'America/Indianapolis', '', '−05:00', '−04:00', 'Link to America/Indiana/Indianapolis'),
('CA', '+682059-1334300', 'America/Inuvik', 'Mountain Time - west Northwest Territories', '−07:00', '−06:00', ''),
('CA', '+6344-06828', 'America/Iqaluit', 'Eastern Time - east Nunavut - most locations', '−05:00', '−04:00', ''),
('JM', '+1800-07648', 'America/Jamaica', '', '−05:00', '−05:00', ''),
('', '', 'America/Jujuy', '', '−03:00', '−03:00', 'Link to America/Argentina/Jujuy'),
('US', '+581807-1342511', 'America/Juneau', 'Alaska Time - Alaska panhandle', '−09:00', '−08:00', ''),
('US', '+381515-0854534', 'America/Kentucky/Louisville', 'Eastern Time - Kentucky - Louisville area', '−05:00', '−04:00', ''),
('US', '+364947-0845057', 'America/Kentucky/Monticello', 'Eastern Time - Kentucky - Wayne County', '−05:00', '−04:00', ''),
('', '', 'America/Knox_IN', '', '−06:00', '−05:00', 'Link to America/Indiana/Knox'),
('BQ', '+120903-0681636', 'America/Kralendijk', '', '−04:00', '−04:00', 'Link to America/Curacao'),
('BO', '-1630-06809', 'America/La_Paz', '', '−04:00', '−04:00', ''),
('PE', '-1203-07703', 'America/Lima', '', '−05:00', '−05:00', ''),
('US', '+340308-1181434', 'America/Los_Angeles', 'Pacific Time', '−08:00', '−07:00', ''),
('', '', 'America/Louisville', '', '−05:00', '−04:00', 'Link to America/Kentucky/Louisville'),
('SX', '+180305-0630250', 'America/Lower_Princes', '', '−04:00', '−04:00', 'Link to America/Curacao'),
('BR', '-0940-03543', 'America/Maceio', 'Alagoas, Sergipe', '−03:00', '−03:00', ''),
('NI', '+1209-08617', 'America/Managua', '', '−06:00', '−06:00', ''),
('BR', '-0308-06001', 'America/Manaus', 'E Amazonas', '−04:00', '−04:00', ''),
('MF', '+1804-06305', 'America/Marigot', '', '−04:00', '−04:00', 'Link to America/Guadeloupe'),
('MQ', '+1436-06105', 'America/Martinique', '', '−04:00', '−04:00', ''),
('MX', '+2550-09730', 'America/Matamoros', 'US Central Time - Coahuila, Durango, Nuevo León, Tamaulipas near US border', '−06:00', '−05:00', ''),
('MX', '+2313-10625', 'America/Mazatlan', 'Mountain Time - S Baja, Nayarit, Sinaloa', '−07:00', '−06:00', ''),
('', '', 'America/Mendoza', '', '−03:00', '−03:00', 'Link to America/Argentina/Mendoza'),
('US', '+450628-0873651', 'America/Menominee', 'Central Time - Michigan - Dickinson, Gogebic, Iron & Menominee Counties', '−06:00', '−05:00', ''),
('MX', '+2058-08937', 'America/Merida', 'Central Time - Campeche, Yucatán', '−06:00', '−05:00', ''),
('US', '+550737-1313435', 'America/Metlakatla', 'Metlakatla Time - Annette Island', '−08:00', '−08:00', ''),
('MX', '+1924-09909', 'America/Mexico_City', 'Central Time - most locations', '−06:00', '−05:00', ''),
('PM', '+4703-05620', 'America/Miquelon', '', '−03:00', '−02:00', ''),
('CA', '+4606-06447', 'America/Moncton', 'Atlantic Time - New Brunswick', '−04:00', '−03:00', ''),
('MX', '+2540-10019', 'America/Monterrey', 'Mexican Central Time - Coahuila, Durango, Nuevo León, Tamaulipas away from US border', '−06:00', '−05:00', ''),
('UY', '-3453-05611', 'America/Montevideo', '', '−03:00', '−02:00', ''),
('CA', '+4531-07334', 'America/Montreal', 'Eastern Time - Quebec - most locations', '−05:00', '−04:00', ''),
('MS', '+1643-06213', 'America/Montserrat', '', '−04:00', '−04:00', ''),
('BS', '+2505-07721', 'America/Nassau', '', '−05:00', '−04:00', ''),
('US', '+404251-0740023', 'America/New_York', 'Eastern Time', '−05:00', '−04:00', ''),
('CA', '+4901-08816', 'America/Nipigon', 'Eastern Time - Ontario & Quebec - places that did not observe DST 1967-1973', '−05:00', '−04:00', ''),
('US', '+643004-1652423', 'America/Nome', 'Alaska Time - west Alaska', '−09:00', '−08:00', ''),
('BR', '-0351-03225', 'America/Noronha', 'Atlantic islands', '−02:00', '−02:00', ''),
('US', '+471551-1014640', 'America/North_Dakota/Beulah', 'Central Time - North Dakota - Mercer County', '−06:00', '−05:00', ''),
('US', '+470659-1011757', 'America/North_Dakota/Center', 'Central Time - North Dakota - Oliver County', '−06:00', '−05:00', ''),
('US', '+465042-1012439', 'America/North_Dakota/New_Salem', 'Central Time - North Dakota - Morton County (except Mandan area)', '−06:00', '−05:00', ''),
('MX', '+2934-10425', 'America/Ojinaga', 'US Mountain Time - Chihuahua near US border', '−07:00', '−06:00', ''),
('PA', '+0858-07932', 'America/Panama', '', '−05:00', '−05:00', ''),
('CA', '+6608-06544', 'America/Pangnirtung', 'Eastern Time - Pangnirtung, Nunavut', '−05:00', '−04:00', ''),
('SR', '+0550-05510', 'America/Paramaribo', '', '−03:00', '−03:00', ''),
('US', '+332654-1120424', 'America/Phoenix', 'Mountain Standard Time - Arizona', '−07:00', '−07:00', ''),
('HT', '+1832-07220', 'America/Port-au-Prince', '', '−05:00', '−04:00', ''),
('', '', 'America/Porto_Acre', '', '−04:00', '−04:00', 'Link to America/Rio_Branco'),
('BR', '-0846-06354', 'America/Porto_Velho', 'Rondonia', '−04:00', '−04:00', ''),
('TT', '+1039-06131', 'America/Port_of_Spain', '', '−04:00', '−04:00', ''),
('PR', '+182806-0660622', 'America/Puerto_Rico', '', '−04:00', '−04:00', ''),
('CA', '+4843-09434', 'America/Rainy_River', 'Central Time - Rainy River & Fort Frances, Ontario', '−06:00', '−05:00', ''),
('CA', '+624900-0920459', 'America/Rankin_Inlet', 'Central Time - central Nunavut', '−06:00', '−05:00', ''),
('BR', '-0803-03454', 'America/Recife', 'Pernambuco', '−03:00', '−03:00', ''),
('CA', '+5024-10439', 'America/Regina', 'Central Standard Time - Saskatchewan - most locations', '−06:00', '−06:00', ''),
('CA', '+744144-0944945', 'America/Resolute', 'Central Standard Time - Resolute, Nunavut', '−06:00', '−05:00', ''),
('BR', '-0958-06748', 'America/Rio_Branco', 'Acre', '−04:00', '−04:00', ''),
('', '', 'America/Rosario', '', '−03:00', '−03:00', 'Link to America/Argentina/Cordoba'),
('BR', '-0226-05452', 'America/Santarem', 'W Para', '−03:00', '−03:00', ''),
('MX', '+3018-11452', 'America/Santa_Isabel', 'Mexican Pacific Time - Baja California away from US border', '−08:00', '−07:00', ''),
('CL', '-3327-07040', 'America/Santiago', 'most locations', '−04:00', '−03:00', ''),
('DO', '+1828-06954', 'America/Santo_Domingo', '', '−04:00', '−04:00', ''),
('BR', '-2332-04637', 'America/Sao_Paulo', 'S & SE Brazil (GO, DF, MG, ES, RJ, SP, PR, SC, RS)', '−03:00', '−02:00', ''),
('GL', '+7029-02158', 'America/Scoresbysund', 'Scoresbysund / Ittoqqortoormiit', '−01:00', '+00:00', ''),
('US', '+364708-1084111', 'America/Shiprock', 'Mountain Time - Navajo', '−07:00', '−06:00', 'Link to America/Denver'),
('US', '+571035-1351807', 'America/Sitka', 'Alaska Time - southeast Alaska panhandle', '−09:00', '−08:00', ''),
('BL', '+1753-06251', 'America/St_Barthelemy', '', '−04:00', '−04:00', 'Link to America/Guadeloupe'),
('CA', '+4734-05243', 'America/St_Johns', 'Newfoundland Time, including SE Labrador', '−03:30', '−02:30', ''),
('KN', '+1718-06243', 'America/St_Kitts', '', '−04:00', '−04:00', ''),
('LC', '+1401-06100', 'America/St_Lucia', '', '−04:00', '−04:00', ''),
('VI', '+1821-06456', 'America/St_Thomas', '', '−04:00', '−04:00', ''),
('VC', '+1309-06114', 'America/St_Vincent', '', '−04:00', '−04:00', ''),
('CA', '+5017-10750', 'America/Swift_Current', 'Central Standard Time - Saskatchewan - midwest', '−06:00', '−06:00', ''),
('HN', '+1406-08713', 'America/Tegucigalpa', '', '−06:00', '−06:00', ''),
('GL', '+7634-06847', 'America/Thule', 'Thule / Pituffik', '−04:00', '−03:00', ''),
('CA', '+4823-08915', 'America/Thunder_Bay', 'Eastern Time - Thunder Bay, Ontario', '−05:00', '−04:00', ''),
('MX', '+3232-11701', 'America/Tijuana', 'US Pacific Time - Baja California near US border', '−08:00', '−07:00', ''),
('CA', '+4339-07923', 'America/Toronto', 'Eastern Time - Ontario - most locations', '−05:00', '−04:00', ''),
('VG', '+1827-06437', 'America/Tortola', '', '−04:00', '−04:00', ''),
('CA', '+4916-12307', 'America/Vancouver', 'Pacific Time - west British Columbia', '−08:00', '−07:00', ''),
('', '', 'America/Virgin', '', '−04:00', '−04:00', 'Link to America/St_Thomas'),
('CA', '+6043-13503', 'America/Whitehorse', 'Pacific Time - south Yukon', '−08:00', '−07:00', ''),
('CA', '+4953-09709', 'America/Winnipeg', 'Central Time - Manitoba & west Ontario', '−06:00', '−05:00', ''),
('US', '+593249-1394338', 'America/Yakutat', 'Alaska Time - Alaska panhandle neck', '−09:00', '−08:00', ''),
('CA', '+6227-11421', 'America/Yellowknife', 'Mountain Time - central Northwest Territories', '−07:00', '−06:00', ''),
('AQ', '-6617+11031', 'Antarctica/Casey', 'Casey Station, Bailey Peninsula', '+11:00', '+08:00', ''),
('AQ', '-6835+07758', 'Antarctica/Davis', 'Davis Station, Vestfold Hills', '+05:00', '+07:00', ''),
('AQ', '-6640+14001', 'Antarctica/DumontDUrville', 'Dumont-d''Urville Station, Terre Adelie', '+10:00', '+10:00', ''),
('AQ', '-5430+15857', 'Antarctica/Macquarie', 'Macquarie Island Station, Macquarie Island', '+11:00', '+11:00', ''),
('AQ', '-6736+06253', 'Antarctica/Mawson', 'Mawson Station, Holme Bay', '+05:00', '+05:00', ''),
('AQ', '-7750+16636', 'Antarctica/McMurdo', 'McMurdo Station, Ross Island', '+12:00', '+13:00', ''),
('AQ', '-6448-06406', 'Antarctica/Palmer', 'Palmer Station, Anvers Island', '−04:00', '−03:00', ''),
('AQ', '-6734-06808', 'Antarctica/Rothera', 'Rothera Station, Adelaide Island', '−03:00', '−03:00', ''),
('AQ', '-9000+00000', 'Antarctica/South_Pole', 'Amundsen-Scott Station, South Pole', '+12:00', '+13:00', 'Link to Antarctica/McMurdo'),
('AQ', '-690022+0393524', 'Antarctica/Syowa', 'Syowa Station, E Ongul I', '+03:00', '+03:00', ''),
('AQ', '-7824+10654', 'Antarctica/Vostok', 'Vostok Station, Lake Vostok', '+06:00', '+06:00', ''),
('SJ', '+7800+01600', 'Arctic/Longyearbyen', '', '+01:00', '+02:00', 'Link to Europe/Oslo'),
('YE', '+1245+04512', 'Asia/Aden', '', '+03:00', '+03:00', ''),
('KZ', '+4315+07657', 'Asia/Almaty', 'most locations', '+06:00', '+06:00', ''),
('JO', '+3157+03556', 'Asia/Amman', '', '+03:00', '+03:00', ''),
('RU', '+6445+17729', 'Asia/Anadyr', 'Moscow+08 - Bering Sea', '+12:00', '+12:00', ''),
('KZ', '+4431+05016', 'Asia/Aqtau', 'Atyrau (Atirau, Gur''yev), Mangghystau (Mankistau)', '+05:00', '+05:00', ''),
('KZ', '+5017+05710', 'Asia/Aqtobe', 'Aqtobe (Aktobe)', '+05:00', '+05:00', ''),
('TM', '+3757+05823', 'Asia/Ashgabat', '', '+05:00', '+05:00', ''),
('', '', 'Asia/Ashkhabad', '', '+05:00', '+05:00', 'Link to Asia/Ashgabat'),
('IQ', '+3321+04425', 'Asia/Baghdad', '', '+03:00', '+03:00', ''),
('BH', '+2623+05035', 'Asia/Bahrain', '', '+03:00', '+03:00', ''),
('AZ', '+4023+04951', 'Asia/Baku', '', '+04:00', '+05:00', ''),
('TH', '+1345+10031', 'Asia/Bangkok', '', '+07:00', '+07:00', ''),
('LB', '+3353+03530', 'Asia/Beirut', '', '+02:00', '+03:00', ''),
('KG', '+4254+07436', 'Asia/Bishkek', '', '+06:00', '+06:00', ''),
('BN', '+0456+11455', 'Asia/Brunei', '', '+08:00', '+08:00', ''),
('', '', 'Asia/Calcutta', '', '+05:30', '+05:30', 'Link to Asia/Kolkata'),
('MN', '+4804+11430', 'Asia/Choibalsan', 'Dornod, Sukhbaatar', '+08:00', '+08:00', ''),
('CN', '+2934+10635', 'Asia/Chongqing', 'central China - Sichuan, Yunnan, Guangxi, Shaanxi, Guizhou, etc.', '+08:00', '+08:00', 'Covering historic Kansu-Szechuan time zone.'),
('', '', 'Asia/Chungking', '', '+08:00', '+08:00', 'Link to Asia/Chongqing'),
('LK', '+0656+07951', 'Asia/Colombo', '', '+05:30', '+05:30', ''),
('', '', 'Asia/Dacca', '', '+06:00', '+06:00', 'Link to Asia/Dhaka'),
('SY', '+3330+03618', 'Asia/Damascus', '', '+02:00', '+03:00', ''),
('BD', '+2343+09025', 'Asia/Dhaka', '', '+06:00', '+06:00', ''),
('TL', '-0833+12535', 'Asia/Dili', '', '+09:00', '+09:00', ''),
('AE', '+2518+05518', 'Asia/Dubai', '', '+04:00', '+04:00', ''),
('TJ', '+3835+06848', 'Asia/Dushanbe', '', '+05:00', '+05:00', ''),
('PS', '+3130+03428', 'Asia/Gaza', 'Gaza Strip', '+02:00', '+03:00', ''),
('CN', '+4545+12641', 'Asia/Harbin', 'Heilongjiang (except Mohe), Jilin', '+08:00', '+08:00', 'Covering historic Changpai time zone.'),
('PS', '+313200+0350542', 'Asia/Hebron', 'West Bank', '+02:00', '+03:00', ''),
('HK', '+2217+11409', 'Asia/Hong_Kong', '', '+08:00', '+08:00', ''),
('MN', '+4801+09139', 'Asia/Hovd', 'Bayan-Olgiy, Govi-Altai, Hovd, Uvs, Zavkhan', '+07:00', '+07:00', ''),
('VN', '+1045+10640', 'Asia/Ho_Chi_Minh', '', '+07:00', '+07:00', ''),
('RU', '+5216+10420', 'Asia/Irkutsk', 'Moscow+05 - Lake Baikal', '+09:00', '+09:00', ''),
('', '', 'Asia/Istanbul', '', '+02:00', '+03:00', 'Link to Europe/Istanbul'),
('ID', '-0610+10648', 'Asia/Jakarta', 'Java & Sumatra', '+07:00', '+07:00', ''),
('ID', '-0232+14042', 'Asia/Jayapura', 'west New Guinea (Irian Jaya) & Malukus (Moluccas)', '+09:00', '+09:00', ''),
('IL', '+3146+03514', 'Asia/Jerusalem', '', '+02:00', '+03:00', ''),
('AF', '+3431+06912', 'Asia/Kabul', '', '+04:30', '+04:30', ''),
('RU', '+5301+15839', 'Asia/Kamchatka', 'Moscow+08 - Kamchatka', '+12:00', '+12:00', ''),
('PK', '+2452+06703', 'Asia/Karachi', '', '+05:00', '+05:00', ''),
('CN', '+3929+07559', 'Asia/Kashgar', 'west Tibet & Xinjiang', '+08:00', '+08:00', 'Covering historic Kunlun time zone.'),
('NP', '+2743+08519', 'Asia/Kathmandu', '', '+05:45', '+05:45', ''),
('', '', 'Asia/Katmandu', '', '+05:45', '+05:45', 'Link to Asia/Kathmandu'),
('IN', '+2232+08822', 'Asia/Kolkata', '', '+05:30', '+05:30', 'Note: Different zones in history, see Time in India.'),
('RU', '+5601+09250', 'Asia/Krasnoyarsk', 'Moscow+04 - Yenisei River', '+08:00', '+08:00', ''),
('MY', '+0310+10142', 'Asia/Kuala_Lumpur', 'peninsular Malaysia', '+08:00', '+08:00', ''),
('MY', '+0133+11020', 'Asia/Kuching', 'Sabah & Sarawak', '+08:00', '+08:00', ''),
('KW', '+2920+04759', 'Asia/Kuwait', '', '+03:00', '+03:00', ''),
('', '', 'Asia/Macao', '', '+08:00', '+08:00', 'Link to Asia/Macau'),
('MO', '+2214+11335', 'Asia/Macau', '', '+08:00', '+08:00', ''),
('RU', '+5934+15048', 'Asia/Magadan', 'Moscow+08 - Magadan', '+12:00', '+12:00', ''),
('ID', '-0507+11924', 'Asia/Makassar', 'east & south Borneo, Sulawesi (Celebes), Bali, Nusa Tenggara, west Timor', '+08:00', '+08:00', ''),
('PH', '+1435+12100', 'Asia/Manila', '', '+08:00', '+08:00', ''),
('OM', '+2336+05835', 'Asia/Muscat', '', '+04:00', '+04:00', ''),
('CY', '+3510+03322', 'Asia/Nicosia', '', '+02:00', '+03:00', ''),
('RU', '+5345+08707', 'Asia/Novokuznetsk', 'Moscow+03 - Novokuznetsk', '+07:00', '+07:00', ''),
('RU', '+5502+08255', 'Asia/Novosibirsk', 'Moscow+03 - Novosibirsk', '+07:00', '+07:00', ''),
('RU', '+5500+07324', 'Asia/Omsk', 'Moscow+03 - west Siberia', '+07:00', '+07:00', ''),
('KZ', '+5113+05121', 'Asia/Oral', 'West Kazakhstan', '+05:00', '+05:00', ''),
('KH', '+1133+10455', 'Asia/Phnom_Penh', '', '+07:00', '+07:00', ''),
('ID', '-0002+10920', 'Asia/Pontianak', 'west & central Borneo', '+07:00', '+07:00', ''),
('KP', '+3901+12545', 'Asia/Pyongyang', '', '+09:00', '+09:00', ''),
('QA', '+2517+05132', 'Asia/Qatar', '', '+03:00', '+03:00', ''),
('KZ', '+4448+06528', 'Asia/Qyzylorda', 'Qyzylorda (Kyzylorda, Kzyl-Orda)', '+06:00', '+06:00', ''),
('MM', '+1647+09610', 'Asia/Rangoon', '', '+06:30', '+06:30', ''),
('SA', '+2438+04643', 'Asia/Riyadh', '', '+03:00', '+03:00', ''),
('', '', 'Asia/Saigon', '', '+07:00', '+07:00', 'Link to Asia/Ho_Chi_Minh'),
('RU', '+4658+14242', 'Asia/Sakhalin', 'Moscow+07 - Sakhalin Island', '+11:00', '+11:00', ''),
('UZ', '+3940+06648', 'Asia/Samarkand', 'west Uzbekistan', '+05:00', '+05:00', ''),
('KR', '+3733+12658', 'Asia/Seoul', '', '+09:00', '+09:00', ''),
('CN', '+3114+12128', 'Asia/Shanghai', 'east China - Beijing, Guangdong, Shanghai, etc.', '+08:00', '+08:00', 'Covering historic Chungyuan time zone.'),
('SG', '+0117+10351', 'Asia/Singapore', '', '+08:00', '+08:00', ''),
('TW', '+2503+12130', 'Asia/Taipei', '', '+08:00', '+08:00', ''),
('UZ', '+4120+06918', 'Asia/Tashkent', 'east Uzbekistan', '+05:00', '+05:00', ''),
('GE', '+4143+04449', 'Asia/Tbilisi', '', '+04:00', '+04:00', ''),
('IR', '+3540+05126', 'Asia/Tehran', '', '+03:30', '+04:30', ''),
('', '', 'Asia/Tel_Aviv', '', '+02:00', '+03:00', 'Link to Asia/Jerusalem'),
('', '', 'Asia/Thimbu', '', '+06:00', '+06:00', 'Link to Asia/Thimphu'),
('BT', '+2728+08939', 'Asia/Thimphu', '', '+06:00', '+06:00', ''),
('JP', '+353916+1394441', 'Asia/Tokyo', '', '+09:00', '+09:00', ''),
('', '', 'Asia/Ujung_Pandang', '', '+08:00', '+08:00', 'Link to Asia/Makassar'),
('MN', '+4755+10653', 'Asia/Ulaanbaatar', 'most locations', '+08:00', '+08:00', ''),
('', '', 'Asia/Ulan_Bator', '', '+08:00', '+08:00', 'Link to Asia/Ulaanbaatar'),
('CN', '+4348+08735', 'Asia/Urumqi', 'most of Tibet & Xinjiang', '+08:00', '+08:00', 'Covering historic Sinkiang-Tibet time zone.'),
('LA', '+1758+10236', 'Asia/Vientiane', '', '+07:00', '+07:00', ''),
('RU', '+4310+13156', 'Asia/Vladivostok', 'Moscow+07 - Amur River', '+11:00', '+11:00', ''),
('RU', '+6200+12940', 'Asia/Yakutsk', 'Moscow+06 - Lena River', '+10:00', '+10:00', ''),
('RU', '+5651+06036', 'Asia/Yekaterinburg', 'Moscow+02 - Urals', '+06:00', '+06:00', ''),
('AM', '+4011+04430', 'Asia/Yerevan', '', '+04:00', '+04:00', ''),
('PT', '+3744-02540', 'Atlantic/Azores', 'Azores', '−01:00', '+00:00', ''),
('BM', '+3217-06446', 'Atlantic/Bermuda', '', '−04:00', '−03:00', ''),
('ES', '+2806-01524', 'Atlantic/Canary', 'Canary Islands', '+00:00', '+01:00', ''),
('CV', '+1455-02331', 'Atlantic/Cape_Verde', '', '−01:00', '−01:00', ''),
('', '', 'Atlantic/Faeroe', '', '+00:00', '+01:00', 'Link to Atlantic/Faroe'),
('FO', '+6201-00646', 'Atlantic/Faroe', '', '+00:00', '+01:00', ''),
('', '', 'Atlantic/Jan_Mayen', '', '+01:00', '+02:00', 'Link to Europe/Oslo'),
('PT', '+3238-01654', 'Atlantic/Madeira', 'Madeira Islands', '+00:00', '+01:00', ''),
('IS', '+6409-02151', 'Atlantic/Reykjavik', '', '+00:00', '+00:00', ''),
('GS', '-5416-03632', 'Atlantic/South_Georgia', '', '−02:00', '−02:00', ''),
('FK', '-5142-05751', 'Atlantic/Stanley', '', '−03:00', '−03:00', ''),
('SH', '-1555-00542', 'Atlantic/St_Helena', '', '+00:00', '+00:00', ''),
('', '', 'Australia/ACT', '', '+10:00', '+11:00', 'Link to Australia/Sydney'),
('AU', '-3455+13835', 'Australia/Adelaide', 'South Australia', '+09:30', '+10:30', ''),
('AU', '-2728+15302', 'Australia/Brisbane', 'Queensland - most locations', '+10:00', '+10:00', ''),
('AU', '-3157+14127', 'Australia/Broken_Hill', 'New South Wales - Yancowinna', '+09:30', '+10:30', ''),
('', '', 'Australia/Canberra', '', '+10:00', '+11:00', 'Link to Australia/Sydney'),
('AU', '-3956+14352', 'Australia/Currie', 'Tasmania - King Island', '+10:00', '+11:00', ''),
('AU', '-1228+13050', 'Australia/Darwin', 'Northern Territory', '+09:30', '+09:30', ''),
('AU', '-3143+12852', 'Australia/Eucla', 'Western Australia - Eucla area', '+08:45', '+08:45', ''),
('AU', '-4253+14719', 'Australia/Hobart', 'Tasmania - most locations', '+10:00', '+11:00', ''),
('', '', 'Australia/LHI', '', '+10:30', '+11:00', 'Link to Australia/Lord_Howe'),
('AU', '-2016+14900', 'Australia/Lindeman', 'Queensland - Holiday Islands', '+10:00', '+10:00', ''),
('AU', '-3133+15905', 'Australia/Lord_Howe', 'Lord Howe Island', '+10:30', '+11:00', ''),
('AU', '-3749+14458', 'Australia/Melbourne', 'Victoria', '+10:00', '+11:00', ''),
('', '', 'Australia/North', '', '+09:30', '+09:30', 'Link to Australia/Darwin'),
('', '', 'Australia/NSW', '', '+10:00', '+11:00', 'Link to Australia/Sydney'),
('AU', '-3157+11551', 'Australia/Perth', 'Western Australia - most locations', '+08:00', '+08:00', ''),
('', '', 'Australia/Queensland', '', '+10:00', '+10:00', 'Link to Australia/Brisbane'),
('', '', 'Australia/South', '', '+09:30', '+10:30', 'Link to Australia/Adelaide'),
('AU', '-3352+15113', 'Australia/Sydney', 'New South Wales - most locations', '+10:00', '+11:00', ''),
('', '', 'Australia/Tasmania', '', '+10:00', '+11:00', 'Link to Australia/Hobart'),
('', '', 'Australia/Victoria', '', '+10:00', '+11:00', 'Link to Australia/Melbourne'),
('', '', 'Australia/West', '', '+08:00', '+08:00', 'Link to Australia/Perth'),
('', '', 'Australia/Yancowinna', '', '+09:30', '+10:30', 'Link to Australia/Broken_Hill'),
('', '', 'Brazil/Acre', '', '−04:00', '−04:00', 'Link to America/Rio_Branco'),
('', '', 'Brazil/DeNoronha', '', '−02:00', '−02:00', 'Link to America/Noronha'),
('', '', 'Brazil/East', '', '−03:00', '−02:00', 'Link to America/Sao_Paulo'),
('', '', 'Brazil/West', '', '−04:00', '−04:00', 'Link to America/Manaus'),
('', '', 'Canada/Atlantic', '', '−04:00', '−03:00', 'Link to America/Halifax'),
('', '', 'Canada/Central', '', '−06:00', '−05:00', 'Link to America/Winnipeg'),
('', '', 'Canada/East-Saskatchewan', '', '−06:00', '−06:00', 'Link to America/Regina'),
('', '', 'Canada/Eastern', '', '−05:00', '−04:00', 'Link to America/Toronto'),
('', '', 'Canada/Mountain', '', '−07:00', '−06:00', 'Link to America/Edmonton'),
('', '', 'Canada/Newfoundland', '', '−03:30', '−02:30', 'Link to America/St_Johns'),
('', '', 'Canada/Pacific', '', '−08:00', '−07:00', 'Link to America/Vancouver'),
('', '', 'Canada/Saskatchewan', '', '−06:00', '−06:00', 'Link to America/Regina'),
('', '', 'Canada/Yukon', '', '−08:00', '−07:00', 'Link to America/Whitehorse'),
('', '', 'CET', '', '+01:00', '+02:00', ''),
('', '', 'Chile/Continental', '', '−04:00', '−03:00', 'Link to America/Santiago'),
('', '', 'Chile/EasterIsland', '', '−06:00', '−05:00', 'Link to Pacific/Easter'),
('', '', 'CST6CDT', '', '−06:00', '−05:00', ''),
('', '', 'Cuba', '', '−05:00', '−04:00', 'Link to America/Havana'),
('', '', 'EET', '', '+02:00', '+03:00', ''),
('', '', 'Egypt', '', '+02:00', '+02:00', 'Link to Africa/Cairo'),
('', '', 'Eire', '', '+00:00', '+01:00', 'Link to Europe/Dublin'),
('', '', 'EST', '', '−05:00', '−05:00', ''),
('', '', 'EST5EDT', '', '−05:00', '−04:00', ''),
('', '', 'Etc./GMT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./GMT+0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./UCT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./Universal', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./UTC', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Etc./Zulu', '', '+00:00', '+00:00', 'Link to UTC'),
('NL', '+5222+00454', 'Europe/Amsterdam', '', '+01:00', '+02:00', ''),
('AD', '+4230+00131', 'Europe/Andorra', '', '+01:00', '+02:00', ''),
('GR', '+3758+02343', 'Europe/Athens', '', '+02:00', '+03:00', ''),
('', '', 'Europe/Belfast', '', '+00:00', '+01:00', 'Link to Europe/London'),
('RS', '+4450+02030', 'Europe/Belgrade', '', '+01:00', '+02:00', ''),
('DE', '+5230+01322', 'Europe/Berlin', '', '+01:00', '+02:00', 'In 1945, the Trizone did not follow Berlin''s switch to DST, see Time in Germany'),
('SK', '+4809+01707', 'Europe/Bratislava', '', '+01:00', '+02:00', 'Link to Europe/Prague'),
('BE', '+5050+00420', 'Europe/Brussels', '', '+01:00', '+02:00', ''),
('RO', '+4426+02606', 'Europe/Bucharest', '', '+02:00', '+03:00', ''),
('HU', '+4730+01905', 'Europe/Budapest', '', '+01:00', '+02:00', ''),
('MD', '+4700+02850', 'Europe/Chisinau', '', '+02:00', '+03:00', ''),
('DK', '+5540+01235', 'Europe/Copenhagen', '', '+01:00', '+02:00', ''),
('IE', '+5320-00615', 'Europe/Dublin', '', '+00:00', '+01:00', ''),
('GI', '+3608-00521', 'Europe/Gibraltar', '', '+01:00', '+02:00', ''),
('GG', '+4927-00232', 'Europe/Guernsey', '', '+00:00', '+01:00', 'Link to Europe/London'),
('FI', '+6010+02458', 'Europe/Helsinki', '', '+02:00', '+03:00', ''),
('IM', '+5409-00428', 'Europe/Isle_of_Man', '', '+00:00', '+01:00', 'Link to Europe/London'),
('TR', '+4101+02858', 'Europe/Istanbul', '', '+02:00', '+03:00', ''),
('JE', '+4912-00207', 'Europe/Jersey', '', '+00:00', '+01:00', 'Link to Europe/London'),
('RU', '+5443+02030', 'Europe/Kaliningrad', 'Moscow-01 - Kaliningrad', '+03:00', '+03:00', ''),
('UA', '+5026+03031', 'Europe/Kiev', 'most locations', '+02:00', '+03:00', ''),
('PT', '+3843-00908', 'Europe/Lisbon', 'mainland', '+00:00', '+01:00', ''),
('SI', '+4603+01431', 'Europe/Ljubljana', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('GB', '+513030-0000731', 'Europe/London', '', '+00:00', '+01:00', ''),
('LU', '+4936+00609', 'Europe/Luxembourg', '', '+01:00', '+02:00', ''),
('ES', '+4024-00341', 'Europe/Madrid', 'mainland', '+01:00', '+02:00', ''),
('MT', '+3554+01431', 'Europe/Malta', '', '+01:00', '+02:00', ''),
('AX', '+6006+01957', 'Europe/Mariehamn', '', '+02:00', '+03:00', 'Link to Europe/Helsinki'),
('BY', '+5354+02734', 'Europe/Minsk', '', '+03:00', '+03:00', ''),
('MC', '+4342+00723', 'Europe/Monaco', '', '+01:00', '+02:00', ''),
('RU', '+5545+03735', 'Europe/Moscow', 'Moscow+00 - west Russia', '+04:00', '+04:00', ''),
('', '', 'Europe/Nicosia', '', '+02:00', '+03:00', 'Link to Asia/Nicosia'),
('NO', '+5955+01045', 'Europe/Oslo', '', '+01:00', '+02:00', ''),
('FR', '+4852+00220', 'Europe/Paris', '', '+01:00', '+02:00', ''),
('ME', '+4226+01916', 'Europe/Podgorica', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('CZ', '+5005+01426', 'Europe/Prague', '', '+01:00', '+02:00', ''),
('LV', '+5657+02406', 'Europe/Riga', '', '+02:00', '+03:00', ''),
('IT', '+4154+01229', 'Europe/Rome', '', '+01:00', '+02:00', ''),
('RU', '+5312+05009', 'Europe/Samara', 'Moscow+00 - Samara, Udmurtia', '+04:00', '+04:00', ''),
('SM', '+4355+01228', 'Europe/San_Marino', '', '+01:00', '+02:00', 'Link to Europe/Rome'),
('BA', '+4352+01825', 'Europe/Sarajevo', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('UA', '+4457+03406', 'Europe/Simferopol', 'central Crimea', '+02:00', '+03:00', ''),
('MK', '+4159+02126', 'Europe/Skopje', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('BG', '+4241+02319', 'Europe/Sofia', '', '+02:00', '+03:00', ''),
('SE', '+5920+01803', 'Europe/Stockholm', '', '+01:00', '+02:00', ''),
('EE', '+5925+02445', 'Europe/Tallinn', '', '+02:00', '+03:00', ''),
('AL', '+4120+01950', 'Europe/Tirane', '', '+01:00', '+02:00', ''),
('', '', 'Europe/Tiraspol', '', '+02:00', '+03:00', 'Link to Europe/Chisinau'),
('UA', '+4837+02218', 'Europe/Uzhgorod', 'Ruthenia', '+02:00', '+03:00', ''),
('LI', '+4709+00931', 'Europe/Vaduz', '', '+01:00', '+02:00', ''),
('VA', '+415408+0122711', 'Europe/Vatican', '', '+01:00', '+02:00', 'Link to Europe/Rome'),
('AT', '+4813+01620', 'Europe/Vienna', '', '+01:00', '+02:00', ''),
('LT', '+5441+02519', 'Europe/Vilnius', '', '+02:00', '+03:00', ''),
('RU', '+4844+04425', 'Europe/Volgograd', 'Moscow+00 - Caspian Sea', '+04:00', '+04:00', ''),
('PL', '+5215+02100', 'Europe/Warsaw', '', '+01:00', '+02:00', ''),
('HR', '+4548+01558', 'Europe/Zagreb', '', '+01:00', '+02:00', 'Link to Europe/Belgrade'),
('UA', '+4750+03510', 'Europe/Zaporozhye', 'Zaporozh''ye, E Lugansk / Zaporizhia, E Luhansk', '+02:00', '+03:00', ''),
('CH', '+4723+00832', 'Europe/Zurich', '', '+01:00', '+02:00', ''),
('', '', 'GB', '', '+00:00', '+01:00', 'Link to Europe/London'),
('', '', 'GB-Eire', '', '+00:00', '+01:00', 'Link to Europe/London'),
('', '', 'GMT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'GMT+0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'GMT-0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'GMT0', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Greenwich', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Hong Kong', '', '+08:00', '+08:00', 'Link to Asia/Hong_Kong'),
('', '', 'HST', '', '−10:00', '−10:00', ''),
('', '', 'Iceland', '', '+00:00', '+00:00', 'Link to Atlantic/Reykjavik'),
('MG', '-1855+04731', 'Indian/Antananarivo', '', '+03:00', '+03:00', ''),
('IO', '-0720+07225', 'Indian/Chagos', '', '+06:00', '+06:00', ''),
('CX', '-1025+10543', 'Indian/Christmas', '', '+07:00', '+07:00', ''),
('CC', '-1210+09655', 'Indian/Cocos', '', '+06:30', '+06:30', ''),
('KM', '-1141+04316', 'Indian/Comoro', '', '+03:00', '+03:00', ''),
('TF', '-492110+0701303', 'Indian/Kerguelen', '', '+05:00', '+05:00', ''),
('SC', '-0440+05528', 'Indian/Mahe', '', '+04:00', '+04:00', ''),
('MV', '+0410+07330', 'Indian/Maldives', '', '+05:00', '+05:00', ''),
('MU', '-2010+05730', 'Indian/Mauritius', '', '+04:00', '+04:00', ''),
('YT', '-1247+04514', 'Indian/Mayotte', '', '+03:00', '+03:00', ''),
('RE', '-2052+05528', 'Indian/Reunion', '', '+04:00', '+04:00', ''),
('', '', 'Iran', '', '+03:30', '+04:30', 'Link to Asia/Tehran'),
('', '', 'Israel', '', '+02:00', '+03:00', 'Link to Asia/Jerusalem'),
('', '', 'Jamaica', '', '−05:00', '−05:00', 'Link to America/Jamaica'),
('', '', 'Japan', '', '+09:00', '+09:00', 'Link to Asia/Tokyo'),
('', '', 'JST-9', '', '+09:00', '+09:00', 'Link to Asia/Tokyo'),
('', '', 'Kwajalein', '', '+12:00', '+12:00', 'Link to Pacific/Kwajalein'),
('', '', 'Libya', '', '+02:00', '+02:00', 'Link to Africa/Tripoli'),
('', '', 'MET', '', '+01:00', '+02:00', ''),
('', '', 'Mexico/BajaNorte', '', '−08:00', '−07:00', 'Link to America/Tijuana'),
('', '', 'Mexico/BajaSur', '', '−07:00', '−06:00', 'Link to America/Mazatlan'),
('', '', 'Mexico/General', '', '−06:00', '−05:00', 'Link to America/Mexico_City'),
('', '', 'MST', '', '−07:00', '−07:00', ''),
('', '', 'MST7MDT', '', '−07:00', '−06:00', ''),
('', '', 'Navajo', '', '−07:00', '−06:00', 'Link to America/Denver'),
('', '', 'NZ', '', '+12:00', '+13:00', 'Link to Pacific/Auckland'),
('', '', 'NZ-CHAT', '', '+12:45', '+13:45', 'Link to Pacific/Chatham'),
('WS', '-1350-17144', 'Pacific/Apia', '', '+13:00', '+14:00', ''),
('NZ', '-3652+17446', 'Pacific/Auckland', 'most locations', '+12:00', '+13:00', ''),
('NZ', '-4357-17633', 'Pacific/Chatham', 'Chatham Islands', '+12:45', '+13:45', ''),
('FM', '+0725+15147', 'Pacific/Chuuk', 'Chuuk (Truk) and Yap', '+10:00', '+10:00', ''),
('CL', '-2709-10926', 'Pacific/Easter', 'Easter Island & Sala y Gomez', '−06:00', '−05:00', ''),
('VU', '-1740+16825', 'Pacific/Efate', '', '+11:00', '+11:00', ''),
('KI', '-0308-17105', 'Pacific/Enderbury', 'Phoenix Islands', '+13:00', '+13:00', ''),
('TK', '-0922-17114', 'Pacific/Fakaofo', '', '+13:00', '+13:00', ''),
('FJ', '-1808+17825', 'Pacific/Fiji', '', '+12:00', '+13:00', ''),
('TV', '-0831+17913', 'Pacific/Funafuti', '', '+12:00', '+12:00', ''),
('EC', '-0054-08936', 'Pacific/Galapagos', 'Galapagos Islands', '−06:00', '−06:00', ''),
('PF', '-2308-13457', 'Pacific/Gambier', 'Gambier Islands', '−09:00', '−09:00', ''),
('SB', '-0932+16012', 'Pacific/Guadalcanal', '', '+11:00', '+11:00', ''),
('GU', '+1328+14445', 'Pacific/Guam', '', '+10:00', '+10:00', ''),
('US', '+211825-1575130', 'Pacific/Honolulu', 'Hawaii', '−10:00', '−10:00', ''),
('UM', '+1645-16931', 'Pacific/Johnston', 'Johnston Atoll', '−10:00', '−10:00', ''),
('KI', '+0152-15720', 'Pacific/Kiritimati', 'Line Islands', '+14:00', '+14:00', ''),
('FM', '+0519+16259', 'Pacific/Kosrae', 'Kosrae', '+11:00', '+11:00', ''),
('MH', '+0905+16720', 'Pacific/Kwajalein', 'Kwajalein', '+12:00', '+12:00', ''),
('MH', '+0709+17112', 'Pacific/Majuro', 'most locations', '+12:00', '+12:00', ''),
('PF', '-0900-13930', 'Pacific/Marquesas', 'Marquesas Islands', '−09:30', '−09:30', ''),
('UM', '+2813-17722', 'Pacific/Midway', 'Midway Islands', '−11:00', '−11:00', ''),
('NR', '-0031+16655', 'Pacific/Nauru', '', '+12:00', '+12:00', ''),
('NU', '-1901-16955', 'Pacific/Niue', '', '−11:00', '−11:00', ''),
('NF', '-2903+16758', 'Pacific/Norfolk', '', '+11:30', '+11:30', ''),
('NC', '-2216+16627', 'Pacific/Noumea', '', '+11:00', '+11:00', ''),
('AS', '-1416-17042', 'Pacific/Pago_Pago', '', '−11:00', '−11:00', ''),
('PW', '+0720+13429', 'Pacific/Palau', '', '+09:00', '+09:00', ''),
('PN', '-2504-13005', 'Pacific/Pitcairn', '', '−08:00', '−08:00', ''),
('FM', '+0658+15813', 'Pacific/Pohnpei', 'Pohnpei (Ponape)', '+11:00', '+11:00', ''),
('', '', 'Pacific/Ponape', '', '+11:00', '+11:00', 'Link to Pacific/Pohnpei'),
('PG', '-0930+14710', 'Pacific/Port_Moresby', '', '+10:00', '+10:00', ''),
('CK', '-2114-15946', 'Pacific/Rarotonga', '', '−10:00', '−10:00', ''),
('MP', '+1512+14545', 'Pacific/Saipan', '', '+10:00', '+10:00', ''),
('', '', 'Pacific/Samoa', '', '−11:00', '−11:00', 'Link to Pacific/Pago_Pago'),
('PF', '-1732-14934', 'Pacific/Tahiti', 'Society Islands', '−10:00', '−10:00', ''),
('KI', '+0125+17300', 'Pacific/Tarawa', 'Gilbert Islands', '+12:00', '+12:00', ''),
('TO', '-2110-17510', 'Pacific/Tongatapu', '', '+13:00', '+13:00', ''),
('', '', 'Pacific/Truk', '', '+10:00', '+10:00', 'Link to Pacific/Chuuk'),
('UM', '+1917+16637', 'Pacific/Wake', 'Wake Island', '+12:00', '+12:00', ''),
('WF', '-1318-17610', 'Pacific/Wallis', '', '+12:00', '+12:00', ''),
('', '', 'Pacific/Yap', '', '+10:00', '+10:00', 'Link to Pacific/Chuuk'),
('', '', 'Poland', '', '+01:00', '+02:00', 'Link to Europe/Warsaw'),
('', '', 'Portugal', '', '+00:00', '+01:00', 'Link to Europe/Lisbon'),
('', '', 'PRC', '', '+08:00', '+08:00', 'Link to Asia/Shanghai'),
('', '', 'PST8PDT', '', '−08:00', '−07:00', ''),
('', '', 'ROC', '', '+08:00', '+08:00', 'Link to Asia/Taipei'),
('', '', 'ROK', '', '+09:00', '+09:00', 'Link to Asia/Seoul'),
('', '', 'Singapore', '', '+08:00', '+08:00', 'Link to Asia/Singapore'),
('', '', 'Turkey', '', '+02:00', '+03:00', 'Link to Europe/Istanbul'),
('', '', 'UCT', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'Universal', '', '+00:00', '+00:00', 'Link to UTC'),
('', '', 'US/Alaska', '', '−09:00', '−08:00', 'Link to America/Anchorage'),
('', '', 'US/Aleutian', '', '−10:00', '−09:00', 'Link to America/Adak'),
('', '', 'US/Arizona', '', '−07:00', '−07:00', 'Link to America/Phoenix'),
('', '', 'US/Central', '', '−06:00', '−05:00', 'Link to America/Chicago'),
('', '', 'US/East-Indiana', '', '−05:00', '−04:00', 'Link to America/Indiana/Indianapolis'),
('', '', 'US/Eastern', '', '−05:00', '−04:00', 'Link to America/New_York'),
('', '', 'US/Hawaii', '', '−10:00', '−10:00', 'Link to Pacific/Honolulu'),
('', '', 'US/Indiana-Starke', '', '−06:00', '−05:00', 'Link to America/Indiana/Knox'),
('', '', 'US/Michigan', '', '−05:00', '−04:00', 'Link to America/Detroit'),
('', '', 'US/Mountain', '', '−07:00', '−06:00', 'Link to America/Denver'),
('', '', 'US/Pacific', '', '−08:00', '−07:00', 'Link to America/Los_Angeles'),
('', '', 'US/Pacific-New', '', '−08:00', '−07:00', 'Link to America/Los_Angeles'),
('', '', 'US/Samoa', '', '−11:00', '−11:00', 'Link to Pacific/Pago_Pago'),
('', '', 'UTC', '', '+00:00', '+00:00', ''),
('', '', 'W-SU', '', '+04:00', '+04:00', 'Link to Europe/Moscow'),
('', '', 'WET', '', '+00:00', '+01:00', ''),
('', '', 'Zulu', '', '+00:00', '+00:00', 'Link to UTC');

-- --------------------------------------------------------

--
-- Table structure for table `dn_currency`
--

CREATE TABLE IF NOT EXISTS `dn_currency` (
  `currency_code_alpha` char(3) NOT NULL,
  `currency_code_numeric` varchar(3) DEFAULT NULL,
  `currency_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `dn_currency`
--

INSERT INTO `dn_currency` (`currency_code_alpha`, `currency_code_numeric`, `currency_name`) VALUES
('AFN', '971', 'Afghani'),
('DZD', '12', 'Algerian Dinar'),
('ARS', '32', 'Argentine Peso'),
('AMD', '51', 'Armenian Dram'),
('AWG', '533', 'Aruban Guilder'),
('AUD', '36', 'Australian Dollar'),
('AZN', '944', 'Azerbaijanian Manat'),
('BSD', '44', 'Bahamian Dollar'),
('BHD', '48', 'Bahraini Dinar'),
('THB', '764', 'Baht'),
('PAB', '590', 'Balboa'),
('BBD', '52', 'Barbados Dollar'),
('BYR', '974', 'Belarussian Ruble'),
('BZD', '84', 'Belize Dollar'),
('BMD', '60', 'Bermudian Dollar (customarily known as Bermuda Dollar)'),
('VEF', '937', 'Bolivar Fuerte'),
('BOB', '68', 'Boliviano'),
('XBA', '955', 'Bond Markets Units European Composite Unit (EURCO)'),
('BRL', '986', 'Brazilian Real'),
('BND', '96', 'Brunei Dollar'),
('BGN', '975', 'Bulgarian Lev'),
('BIF', '108', 'Burundi Franc'),
('CAD', '124', 'Canadian Dollar'),
('CVE', '132', 'Cape Verde Escudo'),
('KYD', '136', 'Cayman Islands Dollar'),
('GHS', '936', 'Cedi'),
('XOF', '952', 'CFA Franc BCEAO'),
('XAF', '950', 'CFA Franc BEAC'),
('XPF', '953', 'CFP Franc'),
('CLP', '152', 'Chilean Peso'),
('XTS', '963', 'Codes specifically reserved for testing purposes'),
('COP', '170', 'Colombian Peso'),
('KMF', '174', 'Comoro Franc'),
('CDF', '976', 'Congolese Franc'),
('BAM', '977', 'Convertible Marks'),
('NIO', '558', 'Cordoba Oro'),
('CRC', '188', 'Costa Rican Colon'),
('HRK', '191', 'Croatian Kuna'),
('CUP', '192', 'Cuban Peso'),
('CZK', '203', 'Czech Koruna'),
('GMD', '270', 'Dalasi'),
('DKK', '208', 'Danish Krone'),
('MKD', '807', 'Denar'),
('DJF', '262', 'Djibouti Franc'),
('STD', '678', 'Dobra'),
('DOP', '214', 'Dominican Peso'),
('VND', '704', 'Dong'),
('XCD', '951', 'East Caribbean Dollar'),
('EGP', '818', 'Egyptian Pound'),
('SVC', '222', 'El Salvador Colon'),
('ETB', '230', 'Ethiopian Birr'),
('EUR', '978', 'Euro'),
('XBB', '956', 'European Monetary Unit (E.M.U.-6)'),
('XBD', '958', 'European Unit of Account 17 (E.U.A.-17)'),
('XBC', '957', 'European Unit of Account 9 (E.U.A.-9)'),
('FKP', '238', 'Falkland Islands Pound'),
('FJD', '242', 'Fiji Dollar'),
('HUF', '348', 'Forint'),
('GIP', '292', 'Gibraltar Pound'),
('XAU', '959', 'Gold'),
('HTG', '332', 'Gourde'),
('PYG', '600', 'Guarani'),
('GNF', '324', 'Guinea Franc'),
('GWP', '624', 'Guinea-Bissau Peso'),
('GYD', '328', 'Guyana Dollar'),
('HKD', '344', 'Hong Kong Dollar'),
('UAH', '980', 'Hryvnia'),
('ISK', '352', 'Iceland Krona'),
('INR', '356', 'Indian Rupee'),
('IRR', '364', 'Iranian Rial'),
('IQD', '368', 'Iraqi Dinar'),
('JMD', '388', 'Jamaican Dollar'),
('JOD', '400', 'Jordanian Dinar'),
('KES', '404', 'Kenyan Shilling'),
('PGK', '598', 'Kina'),
('LAK', '418', 'Kip'),
('EEK', '233', 'Kroon'),
('KWD', '414', 'Kuwaiti Dinar'),
('MWK', '454', 'Kwacha'),
('AOA', '973', 'Kwanza'),
('MMK', '104', 'Kyat'),
('GEL', '981', 'Lari'),
('LVL', '428', 'Latvian Lats'),
('LBP', '422', 'Lebanese Pound'),
('ALL', '8', 'Lek'),
('HNL', '340', 'Lempira'),
('SLL', '694', 'Leone'),
('LRD', '430', 'Liberian Dollar'),
('LYD', '434', 'Libyan Dinar'),
('SZL', '748', 'Lilangeni'),
('LTL', '440', 'Lithuanian Litas'),
('LSL', '426', 'Loti'),
('MGA', '969', 'Malagasy Ariary'),
('MYR', '458', 'Malaysian Ringgit'),
('TMT', '934', 'Manat'),
('MUR', '480', 'Mauritius Rupee'),
('MZN', '943', 'Metical'),
('MXN', '484', 'Mexican Peso'),
('MXV', '979', 'Mexican Unidad de Inversion (UDI)'),
('MDL', '498', 'Moldovan Leu'),
('MAD', '504', 'Moroccan Dirham'),
('BOV', '984', 'Mvdol'),
('NGN', '566', 'Naira'),
('ERN', '232', 'Nakfa'),
('NAD', '516', 'Namibia Dollar'),
('NPR', '524', 'Nepalese Rupee'),
('ANG', '532', 'Netherlands Antillian Guilder'),
('ILS', '376', 'New Israeli Sheqel'),
('RON', '946', 'New Leu'),
('TWD', '901', 'New Taiwan Dollar'),
('NZD', '554', 'New Zealand Dollar'),
('BTN', '64', 'Ngultrum'),
('KPW', '408', 'North Korean Won'),
('NOK', '578', 'Norwegian Krone'),
('PEN', '604', 'Nuevo Sol'),
('MRO', '478', 'Ouguiya'),
('TOP', '776', 'Pa''anga'),
('PKR', '586', 'Pakistan Rupee'),
('XPD', '964', 'Palladium'),
('MOP', '446', 'Pataca'),
('CUC', '931', 'Peso Convertible'),
('UYU', '858', 'Peso Uruguayo'),
('PHP', '608', 'Philippine Peso'),
('XPT', '962', 'Platinum'),
('GBP', '826', 'Pound Sterling'),
('BWP', '72', 'Pula'),
('QAR', '634', 'Qatari Rial'),
('GTQ', '320', 'Quetzal'),
('ZAR', '710', 'Rand'),
('OMR', '512', 'Rial Omani'),
('KHR', '116', 'Riel'),
('MVR', '462', 'Rufiyaa'),
('IDR', '360', 'Rupiah'),
('RUB', '643', 'Russian Ruble'),
('RWF', '646', 'Rwanda Franc'),
('SHP', '654', 'Saint Helena Pound'),
('SAR', '682', 'Saudi Riyal'),
('XDR', '960', 'SDR'),
('RSD', '941', 'Serbian Dinar'),
('SCR', '690', 'Seychelles Rupee'),
('XAG', '961', 'Silver'),
('SGD', '702', 'Singapore Dollar'),
('SBD', '90', 'Solomon Islands Dollar'),
('KGS', '417', 'Som'),
('SOS', '706', 'Somali Shilling'),
('TJS', '972', 'Somoni'),
('LKR', '144', 'Sri Lanka Rupee'),
('SDG', '938', 'Sudanese Pound'),
('SRD', '968', 'Surinam Dollar'),
('SEK', '752', 'Swedish Krona'),
('CHF', '756', 'Swiss Franc'),
('SYP', '760', 'Syrian Pound'),
('BDT', '50', 'Taka'),
('WST', '882', 'Tala'),
('TZS', '834', 'Tanzanian Shilling'),
('KZT', '398', 'Tenge'),
('XXX', '999', 'Codes assigned for transactions where no currency is involved'),
('TTD', '780', 'Trinidad and Tobago Dollar'),
('MNT', '496', 'Tugrik'),
('TND', '788', 'Tunisian Dinar'),
('TRY', '949', 'Turkish Lira'),
('AED', '784', 'UAE Dirham'),
('UGX', '800', 'Uganda Shilling'),
('XFU', NULL, 'UIC-Franc'),
('COU', '970', 'Unidad de Valor Real'),
('CLF', '990', 'Unidades de fomento'),
('UYI', '940', 'Uruguay Peso en Unidades Indexadas'),
('USD', '840', 'US Dollar'),
('USN', '997', 'US Dollar (Next day)'),
('USS', '998', 'US Dollar (Same day)'),
('UZS', '860', 'Uzbekistan Sum'),
('VUV', '548', 'Vatu'),
('CHE', '947', 'WIR Euro'),
('CHW', '948', 'WIR Franc'),
('KRW', '410', 'Won'),
('YER', '886', 'Yemeni Rial'),
('JPY', '392', 'Yen'),
('CNY', '156', 'Yuan Renminbi'),
('ZMK', '894', 'Zambian Kwacha'),
('ZWL', '932', 'Zimbabwe Dollar'),
('PLN', '985', 'Zloty');

-- --------------------------------------------------------

--
-- Table structure for table `dn_email_settings`
--

CREATE TABLE IF NOT EXISTS `dn_email_settings` (
`id` int(11) NOT NULL,
  `smtp_host` varchar(512) NOT NULL,
  `smtp_port` int(10) NOT NULL,
  `smtp_user` varchar(512) NOT NULL,
  `smtp_password` varchar(512) NOT NULL,
  `api_key` varchar(512) NOT NULL,
  `mail_config` enum('webmail','mandrill') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dn_email_settings`
--

INSERT INTO `dn_email_settings` (`id`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_password`, `api_key`, `mail_config`) VALUES
(1, 'mail.mindsworthy.com', 587, 'admin@admin.com', 'adminadmin', '', 'webmail');

-- --------------------------------------------------------

--
-- Table structure for table `dn_email_templates`
--

CREATE TABLE IF NOT EXISTS `dn_email_templates` (
`id` int(11) unsigned NOT NULL,
  `subject` varchar(512) NOT NULL,
  `email_template` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `dn_email_templates`
--

INSERT INTO `dn_email_templates` (`id`, `subject`, `email_template`, `status`) VALUES
(7, 'registration_template', '<p><img alt="SITE LOGO" src="http://conquerorslabs.com/crunchy/uploads/site_logo/site_logo.png" />&nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h2><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Welcome to __SITE_TITLE__ </strong></h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dear <strong>__USER__NAME__</strong>,&nbsp;</p>\r\n\r\n<p>You have successfully Registered in&nbsp;<strong>__SITE_TITLE__</strong></p>\r\n\r\n<p><strong>Your credentials</strong></p>\r\n\r\n<p>Email<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; __EMAIL__</strong></p>\r\n\r\n<p>Password<strong>&nbsp; __PASSWORD__</strong></p>\r\n\r\n<p>We are really excited that you decide to try our services,welcome and thank you for the trust!!</p>\r\n\r\n<p>Please click this link for <strong>__ACCOUNT_ACTIVATOIN_LINK__</strong></p>\r\n\r\n<p>For any assistance or questions&nbsp;feel free to contact us at <strong>__CONTACT_US__</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=""><img src="http://conquerorslabs.com/crunchy/assets/images/android.png" /></a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<a href=""><img src="http://conquerorslabs.com/crunchy/assets/images/appleios.png" /></a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Regards,</strong>&nbsp;<br />\r\nCustomer Support<br />\r\n<strong>__SITE_TITLE__</strong> | Restaurent System</p>\r\n\r\n<p><strong>__COPY_RIGHTS__</strong></p>\r\n', 'Active'),
(8, 'fb_google_registration_template', '<p><img src="http://conquerorslabs.com/crunchy/uploads/site_logo/site_logo.png" />&nbsp; &nbsp; &nbsp;</p>\n\n<h2><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Welcome&nbsp;to&nbsp;__SITE_TITLE__</strong></h2>\n\n<p>&nbsp;</p>\n\n<p><strong>Dear __USER_NAME__&nbsp;,</strong></p>\n\n<p>&nbsp;</p>\n\n<p>Email &nbsp; &nbsp; &nbsp;: &nbsp;<strong>__EMAIL__</strong></p>\n\n<p>Password : <strong>__PASSWORD__</strong></p>\n\n<p>For any assistance or questions, feel free to contact us at&nbsp;<strong>__CONTACT_US__&nbsp;</strong>or call us at&nbsp;<strong>__CONTACT__NO__</strong></p>\n\n<p><img src="http://conquerorslabs.com/crunchy/assets/images/android.png" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img src="http://conquerorslabs.com/crunchy/assets/images/appleios.png" /></p>\n\n<p>&nbsp;</p>\n\n<p><strong>Regards,</strong>&nbsp;<br />\nCustomer Support</p>\n\n<p><strong>__SITE_TITLE__</strong>&nbsp;| Restaurent System</p>\n\n<p><strong>__COPY_RIGHTS__</strong></p>\n', 'Active'),
(57, 'when_user_order_booked_template_mail_to_user', '<p><img alt="SITE LOGO" src="http://conquerorslabs.com/crunchy/uploads/site_logo/site_logo.png" />&nbsp; &nbsp; &nbsp;</p>\n\n<h2><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Welcome&nbsp;to&nbsp;__SITE_TITLE__ </strong></h2>\n\n<p>&nbsp;</p>\n\n<p>Dear <strong>__USER_NAME__</strong>,&nbsp;</p>\n\n<p>You have successfully Booked an order in&nbsp;<strong>__SITE_TITLE__</strong></p>\n\n<p><strong>ORDER DETAILS</strong></p>\n\n<p>Order Type &nbsp; &nbsp; &nbsp; &nbsp;<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;__ORDER_TYPE__</strong></p>\n\n<p>No of Items Booked &nbsp; &nbsp;&nbsp;<strong>__NO_OF_ITEMS__</strong></p>\n\n<p>Order Delivered Time &nbsp; &nbsp;&nbsp;<strong>__ORDER_TIME__</strong></p>\n\n<p>Total Cost &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>__TOTAL_COST__</strong></p>\n\n<p>Payment Mode &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>__PAYMENT_MODE__</strong></p>\n\n<p>Message &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>__CUSTOMER_MESSAGE__</strong></p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>We are really excited that you decide to try our services,welcome and thank you for the trust!!</p>\n\n<p>For any assistance or questions&nbsp;feel free to contact us at <strong>__CONTACT_US__</strong></p>\n\n<p>&nbsp;</p>\n\n<p><a href=""><img src="http://conquerorslabs.com/crunchy/assets/images/android.png" /></a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<a href=""><img src="http://conquerorslabs.com/crunchy/assets/images/appleios.png" /></a></p>\n\n<p>&nbsp;</p>\n\n<p><strong>Regards,</strong>&nbsp;<br />\nCustomer Support<br />\n<strong>__SITE_TITLE__</strong> | Restaurent System</p>\n\n<p><strong>__COPY_RIGHTS__</strong></p>\n', 'Active'),
(58, 'when_user_order_booked_template_mail_to_admin', '<p><img alt="SITE LOGO" src="http://conquerorslabs.com/crunchy/uploads/site_logo/site_logo.png" />&nbsp; &nbsp; &nbsp;</p>\n\n<h2><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Welcome&nbsp;to __SITE_TITLE__ </strong></h2>\n\n<p>&nbsp;</p>\n\n<p>Hello Dear Admin,&nbsp;</p>\n\n<p><strong>__USER_NAME__&nbsp;</strong>has&nbsp;successfully Booked an order</p>\n\n<p>&nbsp;</p>\n\n<p><strong>USER DETAILS</strong></p>\n\n<p>Name &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>__USER_NAME__</strong></p>\n\n<p>Email &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>__EMAIL__</strong></p>\n\n<p>Phone &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>__PHONE__</strong></p>\n\n<p>Address &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>__ADDRESS__</strong></p>\n\n<p>Landmark &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>__LAND_MARK__</strong></p>\n\n<p>City &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>__CITY__</strong></p>\n\n<p>PINCode &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>__PIN_CODE__</strong></p>\n\n<p>&nbsp;</p>\n\n<p><strong>ORDER DETAILS</strong></p>\n\n<p>Order Type &nbsp; &nbsp; &nbsp; &nbsp;<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;__ORDER_TYPE__</strong></p>\n\n<p>No of Items Booked &nbsp; &nbsp;&nbsp;<strong>__NO_OF_ITEMS__</strong></p>\n\n<p>Order Booked Time &nbsp; &nbsp;&nbsp;<strong>__ORDER_TIME__</strong></p>\n\n<p>Total Cost &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>__TOTAL_COST__</strong></p>\n\n<p>Payment Mode &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>__PAYMENT_MODE__</strong></p>\n\n<p>Customer Message &nbsp; &nbsp;<strong>__CUSTOMER_MESSAGE__</strong></p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>We are really excited that you decide to try our services,welcome and thank you for the trust!!</p>\n\n<p>For any assistance or questions&nbsp;feel free to contact us at <strong>__CONTACT_US__</strong></p>\n\n<p>&nbsp;</p>\n\n<p><a href=""><img src="http://conquerorslabs.com/crunchy/assets/images/android.png" /></a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<a href=""><img src="http://conquerorslabs.com/crunchy/assets/images/appleios.png" /></a></p>\n\n<p>&nbsp;</p>\n\n<p><strong>Regards,</strong>&nbsp;<br />\nCustomer Support<br />\n<strong>__SITE_TITLE__</strong> | Restaurent System</p>\n\n<p><strong>__COPY_RIGHTS__</strong></p>\n', 'Active'),
(59, 'order_status_changed', '<p><img src="http://conquerorslabs.com/crunchy/uploads/site_logo/site_logo.png" />&nbsp; &nbsp; &nbsp;</p>\n\n<h2><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Welcome&nbsp;to&nbsp;__SITE_TITLE__</strong></h2>\n\n<p>&nbsp;</p>\n\n<p><strong>Dear __NAME__</strong><strong> </strong><strong>,</strong></p>\n\n<p>Your Order No <strong>__ORDER__NO__ &nbsp;</strong>status has changed</p>\n\n<p><strong>ORDER DETAILS</strong></p>\n\n<p>No of Items Booked &nbsp; &nbsp;&nbsp;<strong>__NO_OF_ITEMS__</strong></p>\n\n<p>Order Booked Time &nbsp; &nbsp;&nbsp;<strong>__ORDER_TIME__</strong></p>\n\n<p>Total Cost &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>__TOTAL_COST__</strong></p>\n\n<p>Payment Mode &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>__PAYMENT_MODE__</strong></p>\n\n<p>Message<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;__MESSAGE__</strong></p>\n\n<p>Status &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>__STATUS__</strong></p>\n\n<p>&nbsp;</p>\n\n<p>For any assistance or questions, feel free to contact us at <strong>__CONTACT__EMAIL__</strong>&nbsp; or call us at <strong>__CONTACT__NO__</strong></p>\n\n<p>&nbsp;</p>\n\n<p><a href="&lt;?php echo base_url();?&gt;" target="_blank"><img src="http://conquerorslabs.com/crunchy/assets/images/android.png" /></a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<a href=""><img src="http://conquerorslabs.com/crunchy/assets/images/appleios.png" /></a></p>\n\n<p>&nbsp;</p>\n\n<p><strong>Regards,</strong>&nbsp;<br />\nCustomer Support</p>\n\n<p><strong>__SITE_TITLE__</strong></p>\n\n<p><strong>__COPY_RIGHTS__</strong></p>\n', 'Active'),
(60, 'order_cancelled', '<p><img src="http://conquerorslabs.com/crunchy/uploads/site_logo/site_logo.png" />&nbsp; &nbsp; &nbsp;</p>\n\n<h2><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Welcome to __SITE_TITLE__</strong></h2>\n\n<p>&nbsp;</p>\n\n<p><strong>Dear __NAME__</strong><strong> </strong><strong>,</strong></p>\n\n<p>Your Order No <strong>__ORDER__NO__ &nbsp;</strong>status has changed</p>\n\n<p><strong>ITEM DELETED FROM&nbsp;ORDER</strong></p>\n\n<p><strong>__ITEM_NAME__&nbsp;</strong>is deleted form Order, for details please login to Mobile app and check the order history</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>For any assistance or questions, feel free to contact us at <strong>__CONTACT__EMAIL__</strong>&nbsp; or call us at <strong>__CONTACT__NO__</strong></p>\n\n<p>&nbsp;</p>\n\n<p><a href="&lt;?php echo base_url();?&gt;" target="_blank"><img src="http://conquerorslabs.com/crunchy/assets/images/android.png" /></a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<a href=""><img src="http://conquerorslabs.com/crunchy/assets/images/appleios.png" /></a></p>\n\n<p>&nbsp;</p>\n\n<p><strong>Regards,</strong>&nbsp;<br />\nCustomer Support</p>\n\n<p><strong>__SITE_TITLE__</strong></p>\n\n<p><strong>__COPY_RIGHTS__</strong></p>\n', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `dn_gallery`
--

CREATE TABLE IF NOT EXISTS `dn_gallery` (
`gallery_id` int(11) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  `alt_text` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_groups`
--

CREATE TABLE IF NOT EXISTS `dn_groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dn_groups`
--

INSERT INTO `dn_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `dn_items`
--

CREATE TABLE IF NOT EXISTS `dn_items` (
`item_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_cost` decimal(10,2) NOT NULL,
  `item_type` enum('Veg','Non-Veg','Other') NOT NULL DEFAULT 'Other',
  `item_image_name` varchar(50) NOT NULL,
  `item_description` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET latin1 NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=150 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_item_addons`
--

CREATE TABLE IF NOT EXISTS `dn_item_addons` (
`item_addon_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `addon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_item_options`
--

CREATE TABLE IF NOT EXISTS `dn_item_options` (
`item_option_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_languages`
--

CREATE TABLE IF NOT EXISTS `dn_languages` (
`id` int(11) NOT NULL,
  `lang_name` varchar(512) NOT NULL,
  `lang_code` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `dn_languages`
--

INSERT INTO `dn_languages` (`id`, `lang_name`, `lang_code`, `status`) VALUES
(1, 'English', 'en', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `dn_login_attempts`
--

CREATE TABLE IF NOT EXISTS `dn_login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_menu`
--

CREATE TABLE IF NOT EXISTS `dn_menu` (
`menu_id` int(11) NOT NULL,
  `menu_name` varchar(256) NOT NULL,
  `punch_line` varchar(256) NOT NULL,
  `description` varchar(512) NOT NULL,
  `menu_image_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET latin1 NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_multi_lang`
--

CREATE TABLE IF NOT EXISTS `dn_multi_lang` (
`id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `phrase_id` int(11) NOT NULL,
  `phrase_type` enum('web','app') NOT NULL DEFAULT 'web',
  `text` varchar(512) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38226 ;

--
-- Dumping data for table `dn_multi_lang`
--

INSERT INTO `dn_multi_lang` (`id`, `lang_id`, `phrase_id`, `phrase_type`, `text`) VALUES
(37624, 1, 5, 'web', 'Master Settings'),
(37625, 1, 6, 'web', 'Dashboard'),
(37626, 1, 12, 'web', 'Home'),
(37627, 1, 14, 'web', 'Pages'),
(37628, 1, 15, 'web', 'Sample'),
(37629, 1, 17, 'web', 'Name'),
(37630, 1, 18, 'web', 'Description'),
(37631, 1, 19, 'web', 'Status'),
(37632, 1, 20, 'web', 'Action'),
(37633, 1, 21, 'web', 'Add'),
(37634, 1, 23, 'web', 'Update'),
(37635, 1, 24, 'web', 'Edit'),
(37636, 1, 26, 'web', 'Text'),
(37637, 1, 27, 'web', 'Select'),
(37638, 1, 29, 'web', 'Title'),
(37639, 1, 30, 'web', 'Start Date'),
(37640, 1, 31, 'web', 'Expiry Date'),
(37641, 1, 32, 'web', 'Date Created'),
(37642, 1, 33, 'web', 'Photo'),
(37643, 1, 35, 'web', 'Language'),
(37644, 1, 36, 'web', 'Close'),
(37645, 1, 37, 'web', 'Delete'),
(37646, 1, 38, 'web', 'Are you sure you want to delete '),
(37647, 1, 39, 'web', 'Yes'),
(37648, 1, 40, 'web', 'No'),
(37649, 1, 41, 'web', 'Phrase'),
(37650, 1, 44, 'web', 'Keywords'),
(37651, 1, 45, 'web', 'Dynamic Pages'),
(37652, 1, 46, 'web', 'Is Bottom'),
(37653, 1, 47, 'web', 'Sort Order'),
(37654, 1, 49, 'web', 'Faqs'),
(37655, 1, 52, 'web', 'Settings'),
(37656, 1, 53, 'web', 'Site'),
(37657, 1, 55, 'web', 'Social Network Settings'),
(37658, 1, 56, 'web', 'Email settings'),
(37659, 1, 58, 'web', 'Host'),
(37660, 1, 59, 'web', 'Email'),
(37661, 1, 60, 'web', 'Password'),
(37662, 1, 61, 'web', 'Port'),
(37663, 1, 63, 'web', 'Address'),
(37664, 1, 64, 'web', 'City'),
(37665, 1, 65, 'web', 'State'),
(37666, 1, 67, 'web', 'PIN Code'),
(37667, 1, 68, 'web', 'Phone'),
(37668, 1, 69, 'web', 'Land line'),
(37669, 1, 70, 'web', 'Fax'),
(37670, 1, 71, 'web', 'Contact Email'),
(37671, 1, 72, 'web', 'Select Language'),
(37672, 1, 74, 'web', 'Design By'),
(37673, 1, 75, 'web', 'Rights Reserved'),
(37674, 1, 76, 'web', ' Site logo'),
(37675, 1, 78, 'web', 'App Settings'),
(37676, 1, 80, 'web', 'Contact us'),
(37677, 1, 81, 'web', 'Mobile'),
(37678, 1, 82, 'web', 'Message'),
(37679, 1, 83, 'web', 'Submit'),
(37680, 1, 84, 'web', 'About us'),
(37681, 1, 86, 'web', 'Digi'),
(37682, 1, 89, 'web', 'Previous'),
(37683, 1, 90, 'web', 'Next'),
(37684, 1, 93, 'web', 'Language Settings'),
(37685, 1, 98, 'web', 'List Languages'),
(37686, 1, 99, 'web', 'Add Phrase'),
(37687, 1, 100, 'web', 'Add Language'),
(37688, 1, 101, 'web', 'How it works'),
(37689, 1, 102, 'web', 'Terms and Conditions'),
(37690, 1, 103, 'web', 'Privacy and Policy'),
(37691, 1, 105, 'web', 'Email Settings'),
(37692, 1, 109, 'web', 'Powered By'),
(37693, 1, 110, 'web', 'No Data Available'),
(37694, 1, 112, 'web', 'Active'),
(37695, 1, 113, 'web', 'Inactive'),
(37696, 1, 123, 'web', 'Phrase Required'),
(37697, 1, 124, 'web', 'Languages'),
(37698, 1, 125, 'web', 'Phrases'),
(37699, 1, 126, 'web', 'Update Phrases'),
(37700, 1, 127, 'web', 'Select validity for new'),
(37701, 1, 140, 'web', 'App settings'),
(37702, 1, 141, 'web', 'Enable'),
(37703, 1, 142, 'web', 'Disable'),
(37704, 1, 152, 'web', 'Validate for new required'),
(37705, 1, 177, 'web', 'Bottom'),
(37706, 1, 180, 'web', 'Cancel'),
(37707, 1, 182, 'web', 'Change Password'),
(37708, 1, 183, 'web', 'Logout'),
(37709, 1, 184, 'web', 'Old Password'),
(37710, 1, 185, 'web', 'New Password'),
(37711, 1, 186, 'web', 'Confirm New Password'),
(37712, 1, 187, 'web', 'Old'),
(37713, 1, 191, 'web', 'Profile'),
(37714, 1, 192, 'web', 'Password and Confirm Password Does Not Match'),
(37715, 1, 193, 'web', 'Personal Details'),
(37716, 1, 194, 'web', 'First name'),
(37717, 1, 195, 'web', 'Last name'),
(37718, 1, 196, 'web', 'Please Enter Letters Only'),
(37719, 1, 197, 'web', 'Please Enter Numbers Only'),
(37720, 1, 201, 'web', 'Toggle Navigation'),
(37721, 1, 202, 'web', 'Prev'),
(37722, 1, 210, 'web', 'Contact Us'),
(37723, 1, 212, 'web', 'All'),
(37724, 1, 213, 'web', 'Will be updated soon'),
(37725, 1, 214, 'web', 'Contact No'),
(37726, 1, 215, 'web', 'New'),
(37727, 1, 216, 'web', 'End Date'),
(37728, 1, 217, 'web', 'Start Date'),
(37729, 1, 218, 'web', 'Showing'),
(37730, 1, 225, 'web', 'Edit Language'),
(37731, 1, 226, 'web', 'Language Name'),
(37732, 1, 227, 'web', 'Edit Phrase'),
(37733, 1, 228, 'web', 'Edit Phrases'),
(37734, 1, 231, 'web', 'How it works'),
(37735, 1, 235, 'web', 'Site Title'),
(37736, 1, 238, 'web', 'Edit Faq'),
(37737, 1, 239, 'web', 'Add Faq'),
(37738, 1, 241, 'web', 'Showing 1 - 10 Of'),
(37739, 1, 242, 'web', 'Remember me'),
(37740, 1, 243, 'web', 'Login'),
(37741, 1, 244, 'web', 'Email Template Settings'),
(37742, 1, 245, 'web', 'Edit Email Template'),
(37743, 1, 246, 'web', 'Email Template'),
(37744, 1, 247, 'web', 'Subject'),
(37745, 1, 251, 'web', 'Site logo'),
(37746, 1, 254, 'web', 'Android url'),
(37747, 1, 255, 'web', 'IOS URL'),
(37748, 1, 256, 'web', 'Invalid file format'),
(37749, 1, 257, 'web', 'Updated Successfully'),
(37750, 1, 258, 'web', 'Posted on'),
(37751, 1, 261, 'web', 'View More'),
(37752, 1, 262, 'web', 'Change Language'),
(37753, 1, 263, 'web', 'Language Changed Successfully'),
(37754, 1, 265, 'web', 'Posted'),
(37755, 1, 266, 'web', 'Ago'),
(37756, 1, 267, 'web', 'Mandrill Key'),
(37757, 1, 268, 'web', 'Api Key'),
(37758, 1, 269, 'web', 'Web mail'),
(37759, 1, 270, 'web', ' Mandrill'),
(37760, 1, 271, 'web', 'Mandrill'),
(37761, 1, 272, 'web', 'View All'),
(37762, 1, 276, 'web', 'Reset'),
(37763, 1, 279, 'web', 'Items'),
(37764, 1, 280, 'web', 'Add Item'),
(37765, 1, 281, 'web', 'Edit Item'),
(37766, 1, 282, 'web', 'View Items'),
(37767, 1, 283, 'web', 'Item Name'),
(37768, 1, 284, 'web', 'Item Cost'),
(37769, 1, 285, 'web', 'Item Image'),
(37770, 1, 286, 'web', 'Change Image'),
(37771, 1, 287, 'web', 'Offers'),
(37772, 1, 288, 'web', 'Create Offer'),
(37773, 1, 289, 'web', 'View Offer'),
(37774, 1, 290, 'web', 'View Offers'),
(37775, 1, 291, 'web', 'Offer Name'),
(37776, 1, 292, 'web', 'Offer Cost'),
(37777, 1, 293, 'web', 'Offer Start Date'),
(37778, 1, 294, 'web', 'Offer End Date'),
(37779, 1, 295, 'web', 'Edit Offer'),
(37780, 1, 296, 'web', 'Offer Valid Date'),
(37781, 1, 297, 'web', 'Offer Condition'),
(37782, 1, 298, 'web', 'Offer Image'),
(37783, 1, 299, 'web', 'Offer Conditions'),
(37784, 1, 300, 'web', 'Quantity'),
(37785, 1, 301, 'web', 'Add/Remove'),
(37786, 1, 302, 'web', 'Add/ Remove'),
(37787, 1, 303, 'web', 'No of Items'),
(37788, 1, 304, 'web', 'Latest Offers'),
(37789, 1, 305, 'web', 'Serve No Of People'),
(37790, 1, 312, 'web', 'Gallery'),
(37791, 1, 313, 'web', 'Alt Text'),
(37792, 1, 314, 'web', 'Image'),
(37793, 1, 315, 'web', 'Add Gallery'),
(37794, 1, 316, 'web', 'Alt Text Required'),
(37795, 1, 318, 'web', 'Paypal Settings'),
(37796, 1, 319, 'web', 'PayPal Environment Production'),
(37797, 1, 320, 'web', 'PayPal Environment Sandbox'),
(37798, 1, 321, 'web', 'Merchant Name'),
(37799, 1, 322, 'web', 'Merchant Privacy Policy URL'),
(37800, 1, 323, 'web', 'Merchant User Agreement URL'),
(37801, 1, 324, 'web', 'Currency'),
(37802, 1, 325, 'web', 'Account type'),
(37803, 1, 326, 'web', 'Logo Image'),
(37804, 1, 327, 'web', 'Paypal Environment Production'),
(37805, 1, 328, 'web', 'Paypal Environment Sandbox'),
(37806, 1, 329, 'web', 'Merchant Name'),
(37807, 1, 330, 'web', 'Merchant Privacy Policy URL'),
(37808, 1, 331, 'web', 'Merchant User Agreement URL'),
(37809, 1, 332, 'web', 'Currency Symbol'),
(37810, 1, 339, 'web', 'Invalid file'),
(37811, 1, 340, 'web', 'Added Sucessfully'),
(37812, 1, 341, 'web', 'Unable to Add'),
(37813, 1, 342, 'web', 'Unable to Update'),
(37814, 1, 343, 'web', 'Could Not Found The Record'),
(37815, 1, 344, 'web', 'Deleted Successfully'),
(37816, 1, 345, 'web', 'Unable to Delete'),
(37817, 1, 354, 'web', 'Product count'),
(37818, 1, 355, 'web', 'Valid Date Must Be Greater Than Start Date'),
(37819, 1, 356, 'web', 'Invalid Operation'),
(37820, 1, 365, 'web', 'Select Item'),
(37821, 1, 366, 'web', 'No Items Available'),
(37822, 1, 367, 'web', 'Orders'),
(37823, 1, 368, 'web', 'New Orders'),
(37824, 1, 369, 'web', 'Under Process Orders'),
(37825, 1, 370, 'web', 'Delivered Orders'),
(37826, 1, 371, 'web', 'Cancelled Orders'),
(37827, 1, 372, 'web', 'Order No'),
(37828, 1, 373, 'web', 'Order Date'),
(37829, 1, 374, 'web', 'Order Time'),
(37830, 1, 375, 'web', 'Order Cost'),
(37831, 1, 376, 'web', 'Customer Name'),
(37832, 1, 378, 'web', 'Order Details'),
(37833, 1, 379, 'web', 'Booked Date'),
(37834, 1, 380, 'web', 'Land Mark'),
(37835, 1, 381, 'web', 'Pincode'),
(37836, 1, 382, 'web', 'Order Update'),
(37837, 1, 383, 'web', 'Update Order Status'),
(37838, 1, 384, 'web', 'Details Not Found'),
(37839, 1, 385, 'web', 'Process'),
(37840, 1, 386, 'web', 'Delivered'),
(37841, 1, 387, 'web', 'Cancelled'),
(37842, 1, 388, 'web', 'No Products Available'),
(37843, 1, 389, 'web', 'Item quantity'),
(37844, 1, 391, 'web', 'Added Successfully'),
(37845, 1, 392, 'web', 'Invalid Credentials'),
(37846, 1, 393, 'web', 'Site Name'),
(37847, 1, 394, 'web', 'Users'),
(37848, 1, 395, 'web', 'Logout Successfully'),
(37849, 1, 396, 'web', 'Latest Orders'),
(37850, 1, 397, 'web', 'User Details'),
(37851, 1, 398, 'web', 'Add Atleast One Item'),
(37852, 1, 400, 'web', 'Party Size'),
(37853, 1, 401, 'web', 'Session'),
(37854, 1, 402, 'web', 'Date Of Booking'),
(37855, 1, 404, 'web', 'Uploaded Successfully'),
(37856, 1, 405, 'web', 'Upload App files'),
(37857, 1, 408, 'web', 'Select Currency'),
(37858, 1, 409, 'web', 'Welcome'),
(37859, 1, 410, 'web', 'Admin'),
(37860, 1, 411, 'web', 'Menu'),
(37861, 1, 412, 'web', 'Add Menu'),
(37862, 1, 413, 'web', 'View Menu'),
(37863, 1, 414, 'web', 'Menu Name'),
(37864, 1, 415, 'web', 'Punch Line'),
(37865, 1, 416, 'web', 'Required'),
(37866, 1, 417, 'web', 'Menu Image'),
(37867, 1, 418, 'web', 'Edit Menu'),
(37868, 1, 419, 'web', 'Item Type'),
(37869, 1, 420, 'web', 'Location Master'),
(37870, 1, 422, 'web', 'States'),
(37871, 1, 423, 'web', 'Cities'),
(37872, 1, 424, 'web', 'Service Delivery Locations'),
(37873, 1, 425, 'web', 'State Name'),
(37874, 1, 426, 'web', 'Upload Excel'),
(37875, 1, 427, 'web', 'City Name'),
(37876, 1, 428, 'web', 'Locality Name'),
(37877, 1, 429, 'web', 'Click here to Download sample file'),
(37878, 1, 430, 'web', 'Upload Excel File'),
(37879, 1, 431, 'web', 'File'),
(37880, 1, 432, 'web', 'Email Templates'),
(37881, 1, 433, 'web', 'Registration'),
(37882, 1, 434, 'web', 'Registration Completed Successfully Activation Email Sent'),
(37883, 1, 435, 'web', 'Login Success'),
(37884, 1, 436, 'web', 'Country'),
(37885, 1, 437, 'web', 'Reset Password'),
(37886, 1, 438, 'web', 'Longitude'),
(37887, 1, 439, 'web', 'Latitude'),
(37888, 1, 440, 'web', 'Please Login'),
(37889, 1, 441, 'web', 'Unauthorised User'),
(37890, 1, 442, 'web', 'Already Existed'),
(37891, 1, 443, 'web', 'Add Service Delivery Location'),
(37892, 1, 444, 'web', 'Edit Service Delivery Locations'),
(37893, 1, 445, 'web', 'Add State'),
(37894, 1, 446, 'web', 'Edit State'),
(37895, 1, 447, 'web', 'Upload States'),
(37896, 1, 448, 'web', 'Add City'),
(37897, 1, 449, 'web', 'Edit City'),
(37898, 1, 450, 'web', 'Upload Cities'),
(37899, 1, 453, 'web', 'Language Code'),
(37900, 1, 454, 'web', 'Phrase Type'),
(37901, 1, 458, 'web', 'Change Password'),
(37902, 1, 459, 'web', 'List Phrases'),
(37903, 1, 461, 'web', 'Update App Phrases'),
(37904, 1, 462, 'web', 'Update Web Phrases'),
(37905, 1, 467, 'web', 'New Password'),
(37906, 1, 568, 'web', 'Please Enter Email and Password'),
(37907, 1, 571, 'web', 'Test Web Phrase'),
(37908, 1, 572, 'web', 'Edit Web Phrases'),
(37909, 1, 573, 'web', 'Edit App Phrases'),
(37910, 1, 574, 'web', 'State Id'),
(37911, 1, 575, 'web', 'Please Upload Only jpg|jpeg|png'),
(37912, 1, 577, 'web', 'Veg'),
(37913, 1, 578, 'web', 'Non Veg'),
(37914, 1, 579, 'web', 'Other'),
(37915, 1, 584, 'web', 'Offer Details'),
(37916, 1, 585, 'web', 'You Cannot Delete This State Cause Cities Exist Under It'),
(37917, 1, 586, 'web', 'You Cannot Delete Cities Cause Delivered Location Exist Under It '),
(37918, 1, 587, 'web', 'Edit Gallery'),
(37919, 1, 588, 'web', 'Test  Web Phrase'),
(37920, 1, 589, 'web', 'Transaction id'),
(37921, 1, 590, 'web', 'Payment Type'),
(37922, 1, 591, 'web', 'Payment Status'),
(37923, 1, 592, 'web', 'Facebook API'),
(37924, 1, 593, 'web', 'Google API'),
(37925, 1, 613, 'web', 'Paid Amount'),
(37926, 1, 614, 'web', 'Is Deleted'),
(37927, 1, 615, 'web', 'Reason'),
(37928, 1, 616, 'web', 'Deleted Item From Order'),
(37929, 1, 617, 'web', 'Addon'),
(37930, 1, 618, 'web', 'Addons'),
(37931, 1, 619, 'web', 'View Addons'),
(37932, 1, 620, 'web', 'Add Addon'),
(37933, 1, 621, 'web', 'Edit Addon'),
(37934, 1, 622, 'web', 'Options'),
(37935, 1, 623, 'web', 'Add Option'),
(37936, 1, 624, 'web', 'View Options'),
(37937, 1, 625, 'web', 'Edit Option'),
(37938, 1, 626, 'web', 'Price Prefix'),
(37939, 1, 627, 'web', 'Price'),
(37940, 1, 628, 'web', 'Order Items'),
(37941, 1, 629, 'web', 'Order Addons'),
(37942, 1, 630, 'web', 'Total'),
(37943, 1, 631, 'web', 'Deleted Addon From Order'),
(37944, 1, 633, 'web', 'Restaurant Timings'),
(37945, 1, 634, 'web', 'From'),
(37946, 1, 635, 'web', 'To'),
(37947, 1, 636, 'web', 'From Time'),
(37948, 1, 637, 'web', 'To Time'),
(37949, 1, 638, 'web', 'Normal'),
(37950, 1, 639, 'web', 'User Activated'),
(37951, 1, 640, 'web', 'User Deactivated'),
(37952, 1, 641, 'web', 'Wrong Operation'),
(37953, 1, 676, 'web', 'sms gateways'),
(37954, 1, 677, 'web', 'sms gateway name'),
(37955, 1, 678, 'web', 'is default'),
(37956, 1, 679, 'web', 'add sms gateway'),
(37957, 1, 680, 'web', 'fields'),
(37958, 1, 681, 'web', 'add field'),
(37959, 1, 682, 'web', 'field name'),
(37960, 1, 683, 'web', 'value'),
(37961, 1, 684, 'web', 'is required'),
(37962, 1, 685, 'web', 'Push Notifications'),
(37963, 1, 686, 'web', 'gcm app id'),
(37964, 1, 687, 'web', 'FCM server api key'),
(37965, 1, 688, 'web', 'gcm status'),
(37966, 1, 689, 'web', 'restaurant timings'),
(37967, 1, 690, 'web', 'notifications'),
(37968, 1, 691, 'web', 'sms notifications'),
(37969, 1, 692, 'web', 'push notifications'),
(37970, 1, 693, 'web', 'country code'),
(37971, 1, 694, 'web', 'list notifications'),
(37972, 1, 695, 'web', 'send notification'),
(37973, 1, 696, 'web', 'created on'),
(37974, 1, 697, 'web', 'save & send'),
(37975, 1, 698, 'web', 'resend'),
(37976, 1, 699, 'web', 'are you sure to resend'),
(37977, 1, 700, 'web', 'no of success'),
(37978, 1, 701, 'web', 'no of failures'),
(37979, 1, 702, 'web', 'last sent'),
(37980, 1, 703, 'web', 'no of times sent'),
(37981, 1, 704, 'web', 'sms templates'),
(37982, 1, 705, 'web', 'sms template'),
(37983, 1, 706, 'web', 'item deleted and sms sent successfully'),
(37984, 1, 707, 'web', 'item deleted but sms sent failed'),
(37985, 1, 708, 'web', 'updated and sms sent successfully'),
(37986, 1, 709, 'web', 'updated but sms sent failed'),
(37987, 1, 715, 'web', 'Update Version'),
(37988, 1, 718, 'web', 'no devices found'),
(37989, 1, 719, 'web', 'option name'),
(37990, 1, 720, 'web', 'customers'),
(37991, 1, 721, 'web', 'one signal server api key'),
(37992, 1, 722, 'web', 'one signal app id'),
(37993, 1, 723, 'web', 'loyality points'),
(37994, 1, 724, 'web', 'point settings'),
(37995, 1, 725, 'web', 'user reward points'),
(37996, 1, 726, 'web', 'points logs'),
(37997, 1, 727, 'web', 'points label redeem placeholder'),
(37998, 1, 728, 'web', 'points label earn'),
(37999, 1, 729, 'web', 'points label template'),
(38000, 1, 730, 'web', 'maximum earning points for customer'),
(38001, 1, 731, 'web', 'points earn apply only on the following payment option'),
(38002, 1, 732, 'web', 'cash on delivery'),
(38003, 1, 733, 'web', 'paypal'),
(38004, 1, 734, 'web', 'stripe'),
(38005, 1, 735, 'web', 'earning points conversion settings'),
(38006, 1, 736, 'web', 'earning point'),
(38007, 1, 737, 'web', 'earning point value in R$'),
(38008, 1, 738, 'web', 'redeeming points conversion settings'),
(38009, 1, 739, 'web', 'redeeming point'),
(38010, 1, 740, 'web', 'redeeming point value in R$'),
(38011, 1, 741, 'web', 'disabled redeeming'),
(38012, 1, 742, 'web', 'points earned for actions'),
(38013, 1, 743, 'web', 'reward points for account signup'),
(38014, 1, 744, 'web', 'reward points for restaurant review'),
(38015, 1, 745, 'web', 'reward points for first order'),
(38016, 1, 746, 'web', 'reward points for sharing app'),
(38017, 1, 747, 'web', 'points expiry'),
(38018, 1, 748, 'web', 'points expire at the end of the next year after you earned them'),
(38019, 1, 749, 'web', 'points never expire'),
(38020, 1, 750, 'web', 'minimum points can be used'),
(38021, 1, 751, 'web', 'maximum points can be used'),
(38022, 1, 752, 'web', 'enabled points system?'),
(38023, 1, 753, 'web', 'coupons'),
(38024, 1, 754, 'web', 'create coupon'),
(38025, 1, 755, 'web', 'edit coupon'),
(38026, 1, 756, 'web', 'coupon code'),
(38027, 1, 757, 'web', 'minimum purchased amount'),
(38028, 1, 758, 'web', 'discount type'),
(38029, 1, 759, 'web', 'discount value'),
(38030, 1, 760, 'web', 'valid start date'),
(38031, 1, 761, 'web', 'valid end date'),
(38032, 1, 762, 'web', 'max no of times usage per user'),
(38033, 1, 763, 'web', 'please select at least one record'),
(38034, 1, 764, 'web', 'merchant key'),
(38035, 1, 765, 'web', 'salt'),
(38036, 1, 766, 'web', 'live URL'),
(38037, 1, 767, 'web', 'test URL'),
(38038, 1, 768, 'web', 'payu settings'),
(38039, 1, 769, 'web', 'MSG DEACTIVATED'),
(38040, 1, 770, 'web', 'MSG ACTIVATED'),
(38041, 1, 771, 'web', 'MSG WRONG OPERATION'),
(38042, 1, 772, 'web', 'duplicate'),
(38043, 1, 773, 'web', 'activate'),
(38044, 1, 774, 'web', 'de activate'),
(38045, 1, 775, 'web', 'Customer Details'),
(38050, 1, 463, 'app', 'Change Password'),
(38051, 1, 464, 'app', 'Menu'),
(38052, 1, 465, 'app', 'Login'),
(38053, 1, 468, 'app', 'Confirm New Password'),
(38054, 1, 469, 'app', 'Forgot Password'),
(38055, 1, 470, 'app', 'Email Address'),
(38056, 1, 471, 'app', 'Send'),
(38057, 1, 472, 'app', 'Don''t worry ! Just fill in your email and we will help you reset your password'),
(38058, 1, 473, 'app', 'Enter Email'),
(38059, 1, 474, 'app', 'Password'),
(38060, 1, 475, 'app', 'Sign in'),
(38061, 1, 476, 'app', 'OR'),
(38062, 1, 477, 'app', 'New User?'),
(38063, 1, 478, 'app', 'Sign Up Here'),
(38064, 1, 479, 'app', 'Sign Up'),
(38065, 1, 480, 'app', 'I Accept'),
(38066, 1, 481, 'app', 'Register'),
(38067, 1, 482, 'app', 'First Name'),
(38068, 1, 483, 'app', 'Last Name'),
(38069, 1, 484, 'app', 'Email'),
(38070, 1, 485, 'app', 'Phone Number'),
(38071, 1, 486, 'app', 'Terms and Conditions'),
(38072, 1, 487, 'app', 'Reset Password'),
(38073, 1, 488, 'app', 'Confirm Password'),
(38074, 1, 489, 'app', 'Submit'),
(38075, 1, 490, 'app', 'About Us'),
(38076, 1, 491, 'app', 'Version'),
(38077, 1, 492, 'app', 'Address'),
(38078, 1, 493, 'app', 'Cart List'),
(38079, 1, 494, 'app', 'Cost'),
(38080, 1, 495, 'app', 'Add Items'),
(38081, 1, 496, 'app', 'Total Cost '),
(38082, 1, 497, 'app', 'Order'),
(38083, 1, 498, 'app', 'Change Language'),
(38084, 1, 499, 'app', 'Select Language'),
(38085, 1, 500, 'app', 'English'),
(38086, 1, 501, 'app', 'Chinese'),
(38087, 1, 502, 'app', 'By Your Mood Or Preference'),
(38088, 1, 503, 'app', 'Edit Profile'),
(38089, 1, 504, 'app', 'City'),
(38090, 1, 505, 'app', 'State'),
(38091, 1, 506, 'app', 'Pincode'),
(38092, 1, 507, 'app', 'Land Mark'),
(38093, 1, 508, 'app', 'Update'),
(38094, 1, 509, 'app', 'Place Order'),
(38095, 1, 510, 'app', 'Mobile Number'),
(38096, 1, 511, 'app', 'Location'),
(38097, 1, 512, 'app', 'House number / name'),
(38098, 1, 513, 'app', 'Apartment/LocalityName'),
(38099, 1, 514, 'app', 'Address other(optional)'),
(38100, 1, 515, 'app', 'Select Date'),
(38101, 1, 516, 'app', 'Date'),
(38102, 1, 517, 'app', 'Time'),
(38103, 1, 518, 'app', 'Select Title'),
(38104, 1, 519, 'app', 'Online Payment'),
(38105, 1, 520, 'app', 'Cash On Deliver'),
(38106, 1, 521, 'app', 'Proceed'),
(38107, 1, 522, 'app', 'All Time Favourites'),
(38108, 1, 523, 'app', 'Welcome'),
(38109, 1, 524, 'app', 'Offers'),
(38110, 1, 525, 'app', 'Order History'),
(38111, 1, 526, 'app', 'Share To Friends'),
(38112, 1, 527, 'app', 'Rate Us On The Play Store'),
(38113, 1, 528, 'app', 'Sign Out'),
(38114, 1, 529, 'app', 'Offers Available'),
(38115, 1, 530, 'app', 'Valid From'),
(38116, 1, 531, 'app', 'Valid To'),
(38117, 1, 532, 'app', 'No Of Persons'),
(38118, 1, 533, 'app', 'No Of Products'),
(38119, 1, 534, 'app', 'Discount'),
(38120, 1, 535, 'app', 'Order Items'),
(38121, 1, 536, 'app', 'Your Orders'),
(38122, 1, 537, 'app', 'Current Password'),
(38123, 1, 538, 'app', 'No Of Items'),
(38124, 1, 539, 'app', 'No Orders Found'),
(38125, 1, 540, 'app', 'Payment Status'),
(38126, 1, 541, 'app', 'Your Payment Status Is'),
(38127, 1, 542, 'app', 'Successful'),
(38128, 1, 543, 'app', 'Your Payment Of Amount'),
(38129, 1, 544, 'app', 'Has Been Successfully Processed'),
(38130, 1, 545, 'app', 'Select City'),
(38131, 1, 546, 'app', 'Search'),
(38132, 1, 547, 'app', 'Select Location'),
(38133, 1, 548, 'app', 'Description'),
(38134, 1, 549, 'app', 'View Cart'),
(38135, 1, 550, 'app', 'Terms'),
(38136, 1, 551, 'app', 'My Account'),
(38137, 1, 552, 'app', 'Timed Out Error'),
(38138, 1, 553, 'app', 'Check Network Connection'),
(38139, 1, 554, 'app', 'Validating User...'),
(38140, 1, 555, 'app', 'Password Not Match'),
(38141, 1, 556, 'app', 'Sign out successfully'),
(38142, 1, 557, 'app', 'Specify Date'),
(38143, 1, 558, 'app', 'Specify Time'),
(38144, 1, 559, 'app', 'Incorrect Login'),
(38145, 1, 560, 'app', 'No'),
(38146, 1, 561, 'app', 'Available Now'),
(38147, 1, 562, 'app', 'Already Added To Cart'),
(38148, 1, 563, 'app', 'Email Already Used Or Invalid UnableToCreateAccount'),
(38149, 1, 564, 'app', 'No Items In Your Cart'),
(38150, 1, 565, 'app', 'Guest'),
(38151, 1, 566, 'app', 'User'),
(38152, 1, 567, 'app', 'Payment'),
(38153, 1, 569, 'app', 'Peter Srinivas'),
(38154, 1, 570, 'app', 'New Password'),
(38155, 1, 576, 'app', 'Ordered on'),
(38156, 1, 580, 'app', 'Offer Items'),
(38157, 1, 581, 'app', 'No items available'),
(38158, 1, 582, 'app', 'Make Payment'),
(38159, 1, 583, 'app', 'Payment Method'),
(38160, 1, 594, 'app', 'Facebook Api'),
(38161, 1, 595, 'app', 'Google Api'),
(38162, 1, 596, 'app', 'Payment Type'),
(38163, 1, 597, 'app', 'Stripe'),
(38164, 1, 598, 'app', 'Card Number'),
(38165, 1, 599, 'app', 'Expiration Date'),
(38166, 1, 600, 'app', 'Month'),
(38167, 1, 601, 'app', 'Year'),
(38168, 1, 602, 'app', 'CVC'),
(38169, 1, 603, 'app', 'Proceed To Pay'),
(38170, 1, 604, 'app', 'All'),
(38171, 1, 605, 'app', 'Veg'),
(38172, 1, 606, 'app', 'Non-Veg'),
(38173, 1, 607, 'app', 'Other'),
(38174, 1, 608, 'app', 'Password Successfully Changed'),
(38175, 1, 609, 'app', 'Registration Completed Successfully Activation Mail Sent'),
(38176, 1, 610, 'app', 'Account is inactive'),
(38177, 1, 611, 'app', 'Item Added to Cart'),
(38178, 1, 612, 'app', 'Quantity'),
(38179, 1, 632, 'app', 'Registration Completed Successfully Password Sent To Email'),
(38180, 1, 642, 'app', ' Save'),
(38181, 1, 643, 'app', 'Item Addons'),
(38182, 1, 644, 'app', 'No Addons Available'),
(38183, 1, 645, 'app', 'Item Sizes'),
(38184, 1, 646, 'app', 'Customize Your Item'),
(38185, 1, 647, 'app', 'No Item Sizes Available'),
(38186, 1, 648, 'app', 'Contact Information'),
(38187, 1, 649, 'app', 'Add New'),
(38188, 1, 650, 'app', 'Saved Addresses'),
(38189, 1, 651, 'app', 'Opening Hours'),
(38190, 1, 652, 'app', 'Closing Hours'),
(38191, 1, 653, 'app', 'Sizes'),
(38192, 1, 654, 'app', 'Addons'),
(38193, 1, 655, 'app', 'Deleted'),
(38194, 1, 656, 'app', 'Select Minimum One Item Then Only Addons Will Apply'),
(38195, 1, 657, 'app', 'Items'),
(38196, 1, 658, 'app', 'Add Address'),
(38197, 1, 659, 'app', 'Edit Address'),
(38198, 1, 660, 'app', 'Crunchy Restaurant Not Available On Selected Time'),
(38199, 1, 661, 'app', 'Select Address'),
(38200, 1, 662, 'app', 'Invalid Card'),
(38201, 1, 663, 'app', 'Cancel'),
(38202, 1, 664, 'app', 'Done'),
(38203, 1, 665, 'app', 'Crunchy'),
(38204, 1, 666, 'app', 'Crunchy App For Restaurant'),
(38205, 1, 667, 'app', 'Restaruant Timings'),
(38206, 1, 668, 'app', 'Ok'),
(38207, 1, 669, 'app', 'Debited Through Crunchy Account'),
(38208, 1, 670, 'app', 'Crunchy Account'),
(38209, 1, 671, 'app', 'My Profile'),
(38210, 1, 672, 'app', 'Add New Address'),
(38211, 1, 673, 'app', 'Crunchy Restaurant Is Currently Closed'),
(38212, 1, 674, 'app', 'Select Landmark'),
(38213, 1, 675, 'app', 'Street Name'),
(38214, 1, 710, 'app', 'registration completed successfully OTP sent to mobile'),
(38215, 1, 711, 'app', 'SMS notification template is not active,please contact admin'),
(38216, 1, 712, 'app', 'SMS notification is not enable,please contact admin'),
(38217, 1, 713, 'app', 'mobile no does not exists'),
(38218, 1, 714, 'app', 'forgot password email not found'),
(38219, 1, 716, 'app', 'Login success'),
(38220, 1, 717, 'app', 'Firstly,  add item to cart'),
(38221, 1, 776, 'app', 'New'),
(38222, 1, 777, 'app', 'Process'),
(38223, 1, 778, 'app', 'Delivered'),
(38224, 1, 779, 'app', 'Cancelled'),
(38225, 1, 780, 'web', 'payment through');

-- --------------------------------------------------------

--
-- Table structure for table `dn_offers`
--

CREATE TABLE IF NOT EXISTS `dn_offers` (
`offer_id` int(11) NOT NULL,
  `offer_name` varchar(50) NOT NULL,
  `offer_cost` decimal(10,2) NOT NULL,
  `offer_start_date` date NOT NULL,
  `offer_valid_date` date NOT NULL,
  `offer_conditions` varchar(100) NOT NULL,
  `serve_no_of_people` int(11) NOT NULL,
  `no_of_products` int(11) NOT NULL,
  `offer_image_name` varchar(50) NOT NULL,
  `date_of_offer_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_offer_products`
--

CREATE TABLE IF NOT EXISTS `dn_offer_products` (
`offer_product_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=487 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_options`
--

CREATE TABLE IF NOT EXISTS `dn_options` (
`option_id` int(11) NOT NULL,
  `option_name` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_orders`
--

CREATE TABLE IF NOT EXISTS `dn_orders` (
`order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` varchar(20) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `house_no` varchar(50) CHARACTER SET utf8 NOT NULL,
  `apartment_name` varchar(50) NOT NULL,
  `other` varchar(50) NOT NULL,
  `landmark` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `order_type` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('delivered','process','cancelled','new') NOT NULL DEFAULT 'new',
  `payment_type` enum('online','cash') NOT NULL DEFAULT 'cash',
  `payment_gateway` enum('PayPal','Stripe','PayU','Cash') NOT NULL,
  `no_of_items` int(11) NOT NULL,
  `paid_date` varchar(50) DEFAULT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `payer_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payer_email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payer_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_status` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_updated` date NOT NULL,
  `device_id` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=249 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_order_addons`
--

CREATE TABLE IF NOT EXISTS `dn_order_addons` (
`oa_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `addon_name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `final_cost` decimal(10,2) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_order_products`
--

CREATE TABLE IF NOT EXISTS `dn_order_products` (
`op_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `size_id` varchar(20) NOT NULL,
  `size_name` varchar(20) NOT NULL,
  `item_size_id` varchar(20) NOT NULL,
  `size_price` decimal(10,2) NOT NULL,
  `final_cost` decimal(10,2) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=463 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_pages`
--

CREATE TABLE IF NOT EXISTS `dn_pages` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(512) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dn_pages`
--

INSERT INTO `dn_pages` (`id`, `name`, `description`, `status`) VALUES
(1, 'About Us', '<p>This is Sampel About Us Page</p>\r\n', 'Active'),
(2, 'How It Works', '<p dir="rtl">&nbsp;</p>\r\n\r\n<div class="container">\r\n<div class="col-lg-12 col-md-12 col-sm-12 padding-0">\r\n<div class="col-md-7 padding-l">\r\n<div class="jumbotron">\r\n<h1>&nbsp;</h1>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<h3>Website Disclaimer</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<ol>\r\n	<li>\r\n	<h3>Acceptance of our Terms</h3>\r\n	</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Active'),
(3, 'Terms and Conditions', '<p><strong>Terms and Conditions</strong></p>\r\n\r\n<p>Terms and conditions template for website usage <u><strong>Test Change</strong></u></p>\r\n\r\n<p>Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our privacy policy govern [business name]&#39;s relationship with you in relation to this website. If you disagree with any part of these terms and conditions, please do not use our website.</p>\r\n\r\n<p>The term &#39;[business name]&#39; or &#39;us&#39; or &#39;we&#39; refers to the owner of the website whose registered office is [address]. Our company registration number is [company registration number and place of registration]. The term &#39;you&#39; refers to the user or viewer of our website.</p>\r\n\r\n<p>The use of this website is subject to the following terms of use:</p>\r\n\r\n<ul>\r\n	<li>The content of the pages of this website is for your general information and use only. It is subject to change without notice.</li>\r\n	<li>This website uses cookies to monitor browsing preferences. If you do allow cookies to be used, the following personal information may be stored by us for use by third parties: [insert list of information].</li>\r\n	<li>Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.</li>\r\n	<li>Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.</li>\r\n	<li>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</li>\r\n	<li>All trade marks reproduced in this website which are not the property of, or licensed to, the operator are acknowledged on the website.</li>\r\n	<li>Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.</li>\r\n	<li>From time to time this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).</li>\r\n	<li>Your use of this website and any dispute arising out of such use of the website is subject to the laws of England, Northern Ireland, Scotland and Wales.</li>\r\n</ul>\r\n', 'Active'),
(4, 'Privacy and Policys', '<p><span class="marker"><strong>Terms and conditions template for website usage</strong></span></p>\r\n\r\n<p><span style="color:red">Welcome to our website. If you continue to browse and use this website, you are agreeing to comply wi</span>th and be bound by the following terms and conditions of use, which together with our privacy policy govern [business name]&#39;s relationship with you in relation to this website. If you disagree with any part of these terms and conditions, please do not use our website.</p>\r\n\r\n<p>The term &#39;[business name]&#39; or &#39;us&#39; or &#39;we&#39; refers to the owner of the website whose registered office is [address]. Our company registration number is [company registration number and place of registration]. The term &#39;you&#39; refers to the user or viewer of our website.</p>\r\n\r\n<p>The use of this website is subject to the following terms of use:</p>\r\n\r\n<ul>\r\n	<li>The content of the pages of this website is for your general information and use only. It is subject to change without notice.</li>\r\n	<li>This website uses cookies to monitor browsing preferences. If you do allow cookies to be used, the following personal information may be stored by us for use by third parties: [insert list of information].</li>\r\n	<li>Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.</li>\r\n	<li>Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.</li>\r\n	<li>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</li>\r\n	<li>All trade marks reproduced in this website which are not the property of, or licensed to, the operator are acknowledged on the website.</li>\r\n	<li>Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.</li>\r\n	<li>From time to time this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).</li>\r\n	<li>Your use of this website and any dispute arising out of such use of the website is subject to the laws of England, Northern Ireland, Scotland and Wales.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `dn_paypal_settings`
--

CREATE TABLE IF NOT EXISTS `dn_paypal_settings` (
  `id` int(11) NOT NULL,
  `PayPalEnvironmentProduction` varchar(512) NOT NULL,
  `PayPalEnvironmentSandbox` varchar(512) NOT NULL,
  `merchantName` varchar(512) NOT NULL,
  `merchantPrivacyPolicyURL` varchar(512) NOT NULL,
  `merchantUserAgreementURL` varchar(512) NOT NULL,
  `currency` varchar(512) NOT NULL,
  `account_type` enum('sandbox','production') NOT NULL DEFAULT 'sandbox',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dn_paypal_settings`
--

INSERT INTO `dn_paypal_settings` (`id`, `PayPalEnvironmentProduction`, `PayPalEnvironmentSandbox`, `merchantName`, `merchantPrivacyPolicyURL`, `merchantUserAgreementURL`, `currency`, `account_type`, `status`) VALUES
(1, 'AWTel-Z6oQbqFJAfyM4rs0OZgC73TbiG9oVnrhSDOcbytcc0YP6EOrAL_NSP0H8os717iCCgXWJ1fHRK', 'Abv9MCw1PGwbmUqjItLAojI8zGc80lYzZEXGa26soQnt3-x3XYNZB2jfRhxNeMXpnjPsqRxhlvl76riT', 'DP Mobile', 'https://dpmobile.systems/pages/privacy', 'https://dpmobile.systems/pages/agreement', 'USD', 'sandbox', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `dn_payu_settings`
--

CREATE TABLE IF NOT EXISTS `dn_payu_settings` (
`payu_id` int(11) NOT NULL,
  `merchant_key` varchar(50) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `live_url` varchar(50) NOT NULL,
  `test_url` varchar(50) NOT NULL,
  `account_type` enum('test','live') NOT NULL DEFAULT 'test',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dn_payu_settings`
--

INSERT INTO `dn_payu_settings` (`payu_id`, `merchant_key`, `salt`, `live_url`, `test_url`, `account_type`, `status`) VALUES
(1, 'do3vAdBt', 'O0nqoiMiY7', 'https://secure.payu.in', 'https://test.payu.in', 'test', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `dn_phrases`
--

CREATE TABLE IF NOT EXISTS `dn_phrases` (
`id` int(11) NOT NULL,
  `text` varchar(512) NOT NULL,
  `phrase_type` enum('web','app') NOT NULL DEFAULT 'web'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=781 ;

--
-- Dumping data for table `dn_phrases`
--

INSERT INTO `dn_phrases` (`id`, `text`, `phrase_type`) VALUES
(5, 'master settings', 'web'),
(6, 'dashboard', 'web'),
(12, 'home', 'web'),
(14, 'pages', 'web'),
(15, 'sample', 'web'),
(17, 'name', 'web'),
(18, 'description', 'web'),
(19, 'status', 'web'),
(20, 'action', 'web'),
(21, 'add', 'web'),
(23, 'update', 'web'),
(24, 'edit', 'web'),
(26, 'text', 'web'),
(27, 'select', 'web'),
(29, 'title', 'web'),
(30, 'start date', 'web'),
(31, 'expiry date', 'web'),
(32, 'date created', 'web'),
(33, 'photo', 'web'),
(35, 'language', 'web'),
(36, 'close', 'web'),
(37, 'delete', 'web'),
(38, 'are you sure to delete', 'web'),
(39, 'yes', 'web'),
(40, 'no', 'web'),
(41, 'phrase', 'web'),
(44, 'keywords', 'web'),
(45, 'dynamic pages', 'web'),
(46, 'is bottom', 'web'),
(47, 'sort order', 'web'),
(49, 'faqs', 'web'),
(52, 'settings', 'web'),
(53, 'site', 'web'),
(55, 'social network settings', 'web'),
(56, 'email settings', 'web'),
(58, 'host', 'web'),
(59, 'email', 'web'),
(60, 'password', 'web'),
(61, 'port', 'web'),
(63, 'address', 'web'),
(64, 'city', 'web'),
(65, 'state', 'web'),
(67, 'zip code', 'web'),
(68, 'phone', 'web'),
(69, 'land line', 'web'),
(70, 'fax', 'web'),
(71, 'contact email', 'web'),
(72, 'select language', 'web'),
(74, 'design by', 'web'),
(75, 'rights reserved', 'web'),
(76, ' site logo', 'web'),
(78, 'app settings', 'web'),
(80, 'contact us', 'web'),
(81, 'mobile', 'web'),
(82, 'message', 'web'),
(83, 'submit', 'web'),
(84, 'about us', 'web'),
(86, 'digi', 'web'),
(89, 'previous', 'web'),
(90, 'next', 'web'),
(93, 'language settings', 'web'),
(98, 'list languages', 'web'),
(99, 'add phrase', 'web'),
(100, 'add language', 'web'),
(101, 'how it works', 'web'),
(102, 'terms and conditions', 'web'),
(103, 'privacy and policy', 'web'),
(105, 'email settings', 'web'),
(109, 'powered by', 'web'),
(110, 'no data available', 'web'),
(112, 'active', 'web'),
(113, 'inactive', 'web'),
(123, 'phrase required', 'web'),
(124, 'languages', 'web'),
(125, 'phrases', 'web'),
(126, 'update phrases', 'web'),
(127, 'select validity for new', 'web'),
(140, 'app settings', 'web'),
(141, 'enable', 'web'),
(142, 'disable', 'web'),
(152, 'validate for new required', 'web'),
(177, 'bottom', 'web'),
(180, 'cancel', 'web'),
(182, 'change password', 'web'),
(183, 'logout', 'web'),
(184, 'old password', 'web'),
(185, 'new password', 'web'),
(186, 'confirm new password', 'web'),
(187, 'old', 'web'),
(191, 'profile', 'web'),
(192, 'password and confirm password does not match', 'web'),
(193, 'personal details', 'web'),
(194, 'first name', 'web'),
(195, 'last name', 'web'),
(196, 'please enter letters only', 'web'),
(197, 'please enter numbers only', 'web'),
(201, 'toggle navigation', 'web'),
(202, 'prev', 'web'),
(210, 'contact us', 'web'),
(212, 'all', 'web'),
(213, 'will be updated soon', 'web'),
(214, 'contact no', 'web'),
(215, 'new', 'web'),
(216, 'end date', 'web'),
(217, 'start date', 'web'),
(218, 'showing', 'web'),
(225, 'edit language', 'web'),
(226, 'language name', 'web'),
(227, 'edit phrase', 'web'),
(228, 'edit phrases', 'web'),
(231, 'how it works', 'web'),
(235, 'site title', 'web'),
(238, 'edit faq', 'web'),
(239, 'add faq', 'web'),
(241, 'showing 1 - 10 of', 'web'),
(242, 'remember me', 'web'),
(243, 'login', 'web'),
(244, 'email template settings', 'web'),
(245, 'edit email template', 'web'),
(246, 'email template', 'web'),
(247, 'subject', 'web'),
(251, 'site logo', 'web'),
(254, 'android url', 'web'),
(255, 'ios url', 'web'),
(256, 'invalid file format', 'web'),
(257, 'updated successfully', 'web'),
(258, 'posted on', 'web'),
(261, 'view more', 'web'),
(262, 'change language', 'web'),
(263, 'language changed successfully', 'web'),
(265, 'posted', 'web'),
(266, 'ago', 'web'),
(267, 'mandrill key', 'web'),
(268, 'api key', 'web'),
(269, 'web mail', 'web'),
(270, ' mandrill', 'web'),
(271, 'mandrill', 'web'),
(272, 'view all', 'web'),
(276, 'reset', 'web'),
(279, 'items', 'web'),
(280, 'add item', 'web'),
(281, 'edit item', 'web'),
(282, 'view items', 'web'),
(283, 'item name', 'web'),
(284, 'item cost', 'web'),
(285, 'item image', 'web'),
(286, 'change image', 'web'),
(287, 'offers', 'web'),
(288, 'create offer', 'web'),
(289, 'view offer', 'web'),
(290, 'view offers', 'web'),
(291, 'offer name', 'web'),
(292, 'offer cost', 'web'),
(293, 'offer start date', 'web'),
(294, 'offer end date', 'web'),
(295, 'edit offer', 'web'),
(296, 'offer valid date', 'web'),
(297, 'offer condition', 'web'),
(298, 'offer image', 'web'),
(299, 'offer conditions', 'web'),
(300, 'quantity', 'web'),
(301, 'add/remove', 'web'),
(302, 'add/ remove', 'web'),
(303, 'no of items', 'web'),
(304, 'latest offers', 'web'),
(305, 'serve no of people', 'web'),
(312, 'gallery', 'web'),
(313, 'alt text', 'web'),
(314, 'image', 'web'),
(315, 'add gallery', 'web'),
(316, 'alt text required', 'web'),
(318, 'paypal settings', 'web'),
(319, 'PayPalEnvironmentProduction', 'web'),
(320, 'PayPalEnvironmentSandbox', 'web'),
(321, 'merchantName', 'web'),
(322, 'merchantPrivacyPolicyURL', 'web'),
(323, 'merchantUserAgreementURL', 'web'),
(324, 'currency', 'web'),
(325, 'account_type', 'web'),
(326, 'logo_image', 'web'),
(327, 'paypal environment production', 'web'),
(328, 'paypal environment sandbox', 'web'),
(329, 'merchant name', 'web'),
(330, 'merchant privacy policy URL', 'web'),
(331, 'merchant user agreement URL', 'web'),
(332, 'currency symbol', 'web'),
(339, 'invalid file', 'web'),
(340, 'added sucessfully', 'web'),
(341, 'unable to add', 'web'),
(342, 'unable to update', 'web'),
(343, 'could not found the record', 'web'),
(344, 'deleted successfully', 'web'),
(345, 'unable to delete', 'web'),
(354, 'product count', 'web'),
(355, 'valid date must be greater than start date', 'web'),
(356, 'invalid operation', 'web'),
(365, 'select item', 'web'),
(366, 'no items available', 'web'),
(367, 'orders', 'web'),
(368, 'new orders', 'web'),
(369, 'under process orders', 'web'),
(370, 'delivered orders', 'web'),
(371, 'cancelled orders', 'web'),
(372, 'order no', 'web'),
(373, 'order date', 'web'),
(374, 'order time', 'web'),
(375, 'order cost', 'web'),
(376, 'customer name', 'web'),
(378, 'order details', 'web'),
(379, 'booked date', 'web'),
(380, 'land mark', 'web'),
(381, 'PINCode', 'web'),
(382, 'order update', 'web'),
(383, 'update order status', 'web'),
(384, 'details not found', 'web'),
(385, 'process', 'web'),
(386, 'delivered', 'web'),
(387, 'cancelled', 'web'),
(388, 'no products available', 'web'),
(389, 'item quantity', 'web'),
(391, 'added successfully', 'web'),
(392, 'invalid credentials', 'web'),
(393, 'site name', 'web'),
(394, 'users', 'web'),
(395, 'logout successfully', 'web'),
(396, 'latest orders', 'web'),
(397, 'user details', 'web'),
(398, 'add atleast one item', 'web'),
(400, 'party size', 'web'),
(401, 'session', 'web'),
(402, 'date of booking', 'web'),
(404, 'uploaded successfully', 'web'),
(405, 'upload app files', 'web'),
(408, 'select currency', 'web'),
(409, 'welcome', 'web'),
(410, 'admin', 'web'),
(411, 'menu', 'web'),
(412, 'add menu', 'web'),
(413, 'view menu', 'web'),
(414, 'menu name', 'web'),
(415, 'punch line', 'web'),
(416, 'required', 'web'),
(417, 'menu image', 'web'),
(418, 'edit menu', 'web'),
(419, 'item type', 'web'),
(420, 'location master', 'web'),
(422, 'states', 'web'),
(423, 'cities', 'web'),
(424, 'service delivery locations', 'web'),
(425, 'state name', 'web'),
(426, 'upload excel', 'web'),
(427, 'city name', 'web'),
(428, 'locality name', 'web'),
(429, 'click here to download sample file', 'web'),
(430, 'upload excel file', 'web'),
(431, 'file', 'web'),
(432, 'email templates', 'web'),
(433, 'registration', 'web'),
(434, 'registration completed successfully activation email sent', 'web'),
(435, 'login success', 'web'),
(436, 'country', 'web'),
(437, 'reset password', 'web'),
(438, 'longitude', 'web'),
(439, 'latitude', 'web'),
(440, 'please login', 'web'),
(441, 'unauthorised user', 'web'),
(442, 'already existed', 'web'),
(443, 'add service delivery location', 'web'),
(444, 'edit service delivery locations', 'web'),
(445, 'add state', 'web'),
(446, 'edit state', 'web'),
(447, 'upload states', 'web'),
(448, 'add city', 'web'),
(449, 'edit city', 'web'),
(450, 'upload cities', 'web'),
(453, 'language code', 'web'),
(454, 'phrase type', 'web'),
(458, 'change password', 'web'),
(459, 'list phrases', 'web'),
(461, 'update app phrases', 'web'),
(462, 'update web phrases', 'web'),
(463, 'changePassword', 'app'),
(464, 'menu', 'app'),
(465, 'login', 'app'),
(467, 'newPassword', 'web'),
(468, 'confirmNewPassword', 'app'),
(469, 'forgotPassword', 'app'),
(470, 'emailAddress', 'app'),
(471, 'send', 'app'),
(472, 'dontWorryJustFillInYourEmailAndWeWillHelpYouResetYourPassword', 'app'),
(473, 'enterEmail', 'app'),
(474, 'password', 'app'),
(475, 'signIn', 'app'),
(476, 'or', 'app'),
(477, 'newUser', 'app'),
(478, 'signUpHere', 'app'),
(479, 'signUp', 'app'),
(480, 'iAccept', 'app'),
(481, 'register', 'app'),
(482, 'firstName', 'app'),
(483, 'lastName', 'app'),
(484, 'email', 'app'),
(485, 'phoneNumber', 'app'),
(486, 'termsAndConditions', 'app'),
(487, 'resetPassword', 'app'),
(488, 'confirmPassword', 'app'),
(489, 'submit', 'app'),
(490, 'aboutUs', 'app'),
(491, 'version', 'app'),
(492, 'address', 'app'),
(493, 'cartList', 'app'),
(494, 'cost', 'app'),
(495, 'addItems', 'app'),
(496, 'totalCost', 'app'),
(497, 'order', 'app'),
(498, 'changeLanguage', 'app'),
(499, 'selectLanguage', 'app'),
(500, 'english', 'app'),
(501, 'chinese', 'app'),
(502, 'byYourMoodOrPreference', 'app'),
(503, 'editProfile', 'app'),
(504, 'city', 'app'),
(505, 'state', 'app'),
(506, 'pincode', 'app'),
(507, 'landmark', 'app'),
(508, 'update', 'app'),
(509, 'placeOrder', 'app'),
(510, 'mobileNumber', 'app'),
(511, 'location', 'app'),
(512, 'flatNoHouseNo', 'app'),
(513, 'apartmentLocalityName', 'app'),
(514, 'addressOtherOptional', 'app'),
(515, 'selectDate', 'app'),
(516, 'date', 'app'),
(517, 'time', 'app'),
(518, 'selectTitle', 'app'),
(519, 'onlinePayment', 'app'),
(520, 'cashOnDeliver', 'app'),
(521, 'proceed', 'app'),
(522, 'allTimeFavourites', 'app'),
(523, 'welcome', 'app'),
(524, 'offers', 'app'),
(525, 'orderHistory', 'app'),
(526, 'shareToFriends', 'app'),
(527, 'rateUsOnThePlaystore', 'app'),
(528, 'signOut', 'app'),
(529, 'offersAvailable', 'app'),
(530, 'validFrom', 'app'),
(531, 'validTo', 'app'),
(532, 'noOfPersons', 'app'),
(533, 'noOfProducts', 'app'),
(534, 'discount', 'app'),
(535, 'orderItems', 'app'),
(536, 'yourOrders', 'app'),
(537, 'currentPassword', 'app'),
(538, 'noOfItems', 'app'),
(539, 'noOrdersFound', 'app'),
(540, 'paymentStatus', 'app'),
(541, 'yourPaymentStatusIs', 'app'),
(542, 'successful', 'app'),
(543, 'yourPaymentOfAmount', 'app'),
(544, 'hasBeenSuccessfullyProcessed', 'app'),
(545, 'selectCity', 'app'),
(546, 'search', 'app'),
(547, 'selectLocation', 'app'),
(548, 'description', 'app'),
(549, 'viewCart', 'app'),
(550, 'terms', 'app'),
(551, 'myAccount', 'app'),
(552, 'timedOutError', 'app'),
(553, 'checkNetworkConnection', 'app'),
(554, 'validatingUser', 'app'),
(555, 'passwordNotMatch', 'app'),
(556, 'signoutSuccessfully', 'app'),
(557, 'specifyDate', 'app'),
(558, 'specifyTime', 'app'),
(559, 'incorrectLogin', 'app'),
(560, 'no', 'app'),
(561, 'availableNow', 'app'),
(562, 'alreadyAddedToCart', 'app'),
(563, 'emailAlreadyUsedOrInvalidUnableToCreateAccount', 'app'),
(564, 'noItemsInYourCart', 'app'),
(565, 'guest', 'app'),
(566, 'user', 'app'),
(567, 'payment', 'app'),
(568, 'please enter email and password', 'web'),
(569, 'peterSrinivas', 'app'),
(570, 'newPassword', 'app'),
(571, 'test Web Phrase', 'web'),
(572, 'edit web phrases', 'web'),
(573, 'edit app phrases', 'web'),
(574, 'state id', 'web'),
(575, 'please upload only jpg|jpeg|png', 'web'),
(576, 'orderedOn', 'app'),
(577, 'veg', 'web'),
(578, 'non veg', 'web'),
(579, 'other', 'web'),
(580, 'offerItems', 'app'),
(581, 'noItemsAvailable', 'app'),
(582, 'makePayment', 'app'),
(583, 'paymentMethod', 'app'),
(584, 'offer details', 'web'),
(585, 'you cannot delete this state cause cities exist under it', 'web'),
(586, 'you cannot delete cities cause delivered location exist under it', 'web'),
(587, 'edit gallery', 'web'),
(588, 'Test  Web Phrase', 'web'),
(589, 'transaction id', 'web'),
(590, 'payment type', 'web'),
(591, 'payment status', 'web'),
(592, 'facebook api', 'web'),
(593, 'google api', 'web'),
(594, 'facebookApi', 'app'),
(595, 'googleApi', 'app'),
(596, 'paymenttype', 'app'),
(597, 'stripe', 'app'),
(598, 'cardNumber', 'app'),
(599, 'expirationDate', 'app'),
(600, 'month', 'app'),
(601, 'year', 'app'),
(602, 'cvc', 'app'),
(603, 'proceedToPay', 'app'),
(604, 'all', 'app'),
(605, 'veg', 'app'),
(606, 'non-veg', 'app'),
(607, 'other', 'app'),
(608, 'passwordsuccessfullychanged', 'app'),
(609, 'registrationcompletedsuccessfullyactivationmailsent', 'app'),
(610, 'accountisinactive', 'app'),
(611, 'itemAddedToCart', 'app'),
(612, 'quantity', 'app'),
(613, 'paid amount', 'web'),
(614, 'is deleted', 'web'),
(615, 'reason', 'web'),
(616, 'deleted item from order', 'web'),
(617, 'addon', 'web'),
(618, 'addons', 'web'),
(619, 'view addons', 'web'),
(620, 'add addon', 'web'),
(621, 'edit addon', 'web'),
(622, 'options', 'web'),
(623, 'add option', 'web'),
(624, 'view options', 'web'),
(625, 'edit option', 'web'),
(626, 'price prefix', 'web'),
(627, 'price', 'web'),
(628, 'order items', 'web'),
(629, 'order addons', 'web'),
(630, 'total', 'web'),
(631, 'deleted addon from order', 'web'),
(632, 'registrationCompletedSuccessfullyPasswordSentToEmail', 'app'),
(633, 'restaurant timings', 'web'),
(634, 'from', 'web'),
(635, 'to', 'web'),
(636, 'from time', 'web'),
(637, 'to time', 'web'),
(638, 'normal', 'web'),
(639, 'user activated', 'web'),
(640, 'user deactivated', 'web'),
(641, 'wrong operation', 'web'),
(642, 'save', 'app'),
(643, 'itemAddons', 'app'),
(644, 'noAddonsAvailable', 'app'),
(645, 'itemSizes', 'app'),
(646, 'customizeYourItem', 'app'),
(647, 'noItemSizesAvailable', 'app'),
(648, 'contactInformation', 'app'),
(649, 'addNew', 'app'),
(650, 'savedAddresses', 'app'),
(651, 'openingHours', 'app'),
(652, 'closingHours', 'app'),
(653, 'sizes', 'app'),
(654, 'addons', 'app'),
(655, 'deleted', 'app'),
(656, 'selectMinimumOneItemThenOnlyAddonsWillApply', 'app'),
(657, 'items', 'app'),
(658, 'addAddress', 'app'),
(659, 'editAddress', 'app'),
(660, 'crunchyRestaurantNotAvailableOnSelectedTime', 'app'),
(661, 'selectAddress', 'app'),
(662, 'invalidCard', 'app'),
(663, 'cancel', 'app'),
(664, 'done', 'app'),
(665, 'crunchy', 'app'),
(666, 'crunchyAppForRestaurant', 'app'),
(667, 'restaruentTimings', 'app'),
(668, 'ok', 'app'),
(669, 'debitedThroughCrunchyAccount', 'app'),
(670, 'crunchyAccount', 'app'),
(671, 'myProfile', 'app'),
(672, 'addNewAddress', 'app'),
(673, 'crunchyRestaurantIsCurrentlyClosed', 'app'),
(674, 'selectLandmark', 'app'),
(675, 'streetname', 'app'),
(676, 'sms gateways', 'web'),
(677, 'sms gateway name', 'web'),
(678, 'is default', 'web'),
(679, 'add sms gateway', 'web'),
(680, 'fields', 'web'),
(681, 'add field', 'web'),
(682, 'field name', 'web'),
(683, 'value', 'web'),
(684, 'is required', 'web'),
(685, 'Push Notifications', 'web'),
(686, 'GCM APP ID', 'web'),
(687, 'FCM server api key', 'web'),
(688, 'gcm status', 'web'),
(689, 'restaurent timings', 'web'),
(690, 'notifications', 'web'),
(691, 'sms notifications', 'web'),
(692, 'push notifications', 'web'),
(693, 'country code', 'web'),
(694, 'list notifications', 'web'),
(695, 'new notification', 'web'),
(696, 'created on', 'web'),
(697, 'save & send', 'web'),
(698, 'resend', 'web'),
(699, 'are you sure to resend', 'web'),
(700, 'no of success', 'web'),
(701, 'no of failures', 'web'),
(702, 'last sent', 'web'),
(703, 'no of times sent', 'web'),
(704, 'sms templates', 'web'),
(705, 'sms template', 'web'),
(706, 'item deleted and sms sent successfully', 'web'),
(707, 'item deleted but sms sent failed', 'web'),
(708, 'updated and sms sent successfully', 'web'),
(709, 'updated but sms sent failed', 'web'),
(710, 'registrationCompletedSuccessfullyOtpSentToMobile', 'app'),
(711, 'smsnotificationtemplateisnotactivepleasecontactadmin', 'app'),
(712, 'smsnotificationisnotenablepleasecontactadmin', 'app'),
(713, 'mobileNoDoesNotExists', 'app'),
(714, 'forgotPasswordEmailNotFound', 'app'),
(715, 'Update Version', 'web'),
(716, 'loginSuccess', 'app'),
(717, 'firstAddItemToCart', 'app'),
(718, 'no devices found', 'web'),
(719, 'option name', 'web'),
(720, 'customers', 'web'),
(721, 'one signal server api key', 'web'),
(722, 'one signal app id', 'web'),
(723, 'loyality points', 'web'),
(724, 'point settings', 'web'),
(725, 'user reward points', 'web'),
(726, 'points logs', 'web'),
(727, 'points label redeem placeholder', 'web'),
(728, 'points label earn', 'web'),
(729, 'points label template', 'web'),
(730, 'maximum earning points for customer', 'web'),
(731, 'points earn apply only on the following payment option', 'web'),
(732, 'cash on delivery', 'web'),
(733, 'paypal', 'web'),
(734, 'stripe', 'web'),
(735, 'earning points conversion settings', 'web'),
(736, 'earning point', 'web'),
(737, 'earning point value in R$', 'web'),
(738, 'redeeming points conversion settings', 'web'),
(739, 'redeeming point', 'web'),
(740, 'redeeming point value in R$', 'web'),
(741, 'disabled redeeming', 'web'),
(742, 'points earned for actions', 'web'),
(743, 'reward points for account signup', 'web'),
(744, 'reward points for restaurant review', 'web'),
(745, 'reward points for first order', 'web'),
(746, 'reward points for sharing app', 'web'),
(747, 'points expiry', 'web'),
(748, 'points expire at the end of the next year after you earned them', 'web'),
(749, 'points never expire', 'web'),
(750, 'minimum points can be used', 'web'),
(751, 'maximum points can be used', 'web'),
(752, 'enabled points system?', 'web'),
(753, 'coupons', 'web'),
(754, 'create coupon', 'web'),
(755, 'edit coupon', 'web'),
(756, 'coupon code', 'web'),
(757, 'minimum purchased amount', 'web'),
(758, 'discount type', 'web'),
(759, 'discount value', 'web'),
(760, 'valid start date', 'web'),
(761, 'valid end date', 'web'),
(762, 'max no of times usage per user', 'web'),
(763, 'please select at least one record', 'web'),
(764, 'merchant key', 'web'),
(765, 'salt', 'web'),
(766, 'live URL', 'web'),
(767, 'test URL', 'web'),
(768, 'payu settings', 'web'),
(769, 'MSG DEACTIVATED', 'web'),
(770, 'MSG ACTIVATED', 'web'),
(771, 'MSG WRONG OPERATION', 'web'),
(772, 'duplicate', 'web'),
(773, 'activate', 'web'),
(774, 'de activate', 'web'),
(775, 'customer details', 'web'),
(776, 'new', 'app'),
(777, 'process', 'app'),
(778, 'delivered', 'app'),
(779, 'cancelled', 'app'),
(780, 'payment through', 'web');

-- --------------------------------------------------------

--
-- Table structure for table `dn_pl_cities`
--

CREATE TABLE IF NOT EXISTS `dn_pl_cities` (
`city_id` int(11) NOT NULL,
  `city_name` varchar(512) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=523 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_service_provide_locations`
--

CREATE TABLE IF NOT EXISTS `dn_service_provide_locations` (
`service_provide_location_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `locality` varchar(600) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `dn_sessions`
--

CREATE TABLE IF NOT EXISTS `dn_sessions` (
	`id` varchar(128) NOT NULL,
	`ip_address` varchar(45) NOT NULL,
	`timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
	`data` blob NOT NULL,
	KEY `ci_sessions_timestamp` (`timestamp`)
);

-- --------------------------------------------------------

--
-- Table structure for table `dn_site_settings`
--

CREATE TABLE IF NOT EXISTS `dn_site_settings` (
`id` int(11) NOT NULL,
  `site_title` varchar(512) NOT NULL,
  `site_name` varchar(512) NOT NULL,
  `address` varchar(512) NOT NULL,
  `city` varchar(512) NOT NULL,
  `state` varchar(512) NOT NULL,
  `country` varchar(512) NOT NULL,
  `zip` varchar(512) NOT NULL,
  `phone` varchar(512) NOT NULL,
  `land_line` varchar(512) NOT NULL,
  `fax` varchar(512) NOT NULL,
  `portal_email` varchar(512) NOT NULL,
  `site_country` varchar(512) NOT NULL,
  `from_time` varchar(50) NOT NULL,
  `to_time` varchar(50) NOT NULL,
  `language_id` int(11) NOT NULL,
  `design_by` varchar(512) NOT NULL,
  `rights_reserved_content` varchar(512) NOT NULL,
  `site_logo` varchar(512) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `currency_symbol` varchar(20) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `ios_url` varchar(50) NOT NULL,
  `android_url` varchar(50) NOT NULL,
  `facebook_api` varchar(200) NOT NULL,
  `google_api` varchar(200) NOT NULL,
  `one_signal_server_api_key` varchar(100) NOT NULL,
  `one_signal_app_id` varchar(50) NOT NULL,
  `sms_notifications` enum('Yes','No') NOT NULL DEFAULT 'No',
  `fcm_push_notifications` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dn_site_settings`
--

INSERT INTO `dn_site_settings` (`id`, `site_title`, `site_name`, `address`, `city`, `state`, `country`, `zip`, `phone`, `land_line`, `fax`, `portal_email`, `site_country`, `from_time`, `to_time`, `language_id`, `design_by`, `rights_reserved_content`, `site_logo`, `currency`, `currency_symbol`, `country_code`, `latitude`, `longitude`, `ios_url`, `android_url`, `facebook_api`, `google_api`, `one_signal_server_api_key`, `one_signal_app_id`, `sms_notifications`, `fcm_push_notifications`) VALUES
(1, 'Crunchy V5', 'Crunchy App For Restaurent ', 'Hitech City', 'Hyderabad', 'Telangana', 'India', '500081', '9876543210', '123456789', '123456789', 'your@gmail.com', 'in', '08:00', '22:30', 1, 'Digital Samaritan', '© Digi Restaurant 2016. All rights reserved.', 'site_logo.png', 'USD', '$', '91', '48.651636', '-123.398947', 'http://www.apple.com/retail/', 'https://play.google.com/store?hl=en', '172320483163959', '707332932771-9lkp1jtigdtedtek9i6cegv7p0cq13jr.apps.googleusercontent.com', 'M2VmZDBjOGItYWJjYS00NjdhLWExMzktYWEwZjM4ZjZhNjE2', 'da39217b-0184-4b26-8ef2-e5704cda9eb1', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `dn_sms_gate_ways`
--

CREATE TABLE IF NOT EXISTS `dn_sms_gate_ways` (
`sms_gateway_id` int(11) NOT NULL,
  `sms_gateway_name` varchar(50) NOT NULL,
  `is_default` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `dn_sms_gate_ways`
--

INSERT INTO `dn_sms_gate_ways` (`sms_gateway_id`, `sms_gateway_name`, `is_default`, `status`) VALUES
(1, 'Cliakatell', 'No', 'Active'),
(2, 'Nexmo', 'No', 'Active'),
(3, 'Plivo', 'Yes', 'Active'),
(4, 'Solutionsinfini', 'No', 'Active'),
(5, 'Twilio', 'No', 'Active'),
(7, 'MSG91', 'No', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `dn_sms_templates`
--

CREATE TABLE IF NOT EXISTS `dn_sms_templates` (
`sms_template_id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `sms_template` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dn_sms_templates`
--

INSERT INTO `dn_sms_templates` (`sms_template_id`, `subject`, `sms_template`, `status`) VALUES
(1, 'registration_otp', '<p>Your Registration OTP is <strong>__OTP__</strong></p>\r\n', 'Active'),
(2, 'forgot_password_otp', '<p>Your Forgot Password OTP is <strong>__OTP__</strong></p>\n', 'Active'),
(3, 'order_saved', '<p>Thanks for using <strong>__SITE__TITLE__</strong></p>\r\n\r\n<p>Order No <strong>__ORDER__NO__</strong></p>\r\n\r\n<p>Total Cost <strong>__TOTAL__COST__</strong></p>\r\n', 'Active'),
(4, 'order_update', '<p>Your Order No <strong>__ORDER__ID__</strong> Status <strong>__STATUS__</strong> Message <strong>__MESSAGE__</strong></p>\n', 'Active'),
(5, 'item_deleted', '<p>Item Deleted from Order Order No <strong>__ORDER__ID__</strong> Item Name <strong>__ITEM__NAME__</strong></p>\n', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `dn_system_settings_fields`
--

CREATE TABLE IF NOT EXISTS `dn_system_settings_fields` (
`field_id` int(11) NOT NULL,
  `sms_gateway_id` int(11) DEFAULT NULL,
  `field_name` varchar(256) CHARACTER SET latin1 DEFAULT NULL,
  `field_key` varchar(50) NOT NULL,
  `is_required` char(5) CHARACTER SET latin1 DEFAULT 'No',
  `field_output_value` text,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=144 ;

--
-- Dumping data for table `dn_system_settings_fields`
--

INSERT INTO `dn_system_settings_fields` (`field_id`, `sms_gateway_id`, `field_name`, `field_key`, `is_required`, `field_output_value`, `created`, `updated`) VALUES
(125, 1, 'User Name', 'User_Name', 'Yes', 'johnpeter', '2016-07-25 11:20:38', '2016-11-14 06:33:08'),
(126, 1, 'Password', 'Password', 'Yes', 'aYBSNZAOYPdUab', '2016-07-25 12:29:11', '2016-11-14 06:33:08'),
(127, 1, 'From No', 'From_No', 'Yes', '7569861197', '2016-07-25 12:29:47', '2016-11-14 06:33:08'),
(128, 1, 'API Id', 'API_Id', 'Yes', '3614745', '2016-07-25 12:30:10', '2016-11-14 06:33:08'),
(129, 2, 'API KEY', 'API_KEY', 'Yes', 'd0e587bc', '2016-07-26 05:51:28', '2016-10-21 12:43:30'),
(130, 2, 'API SECRET', 'API_SECRET', 'Yes', '66d2cc36a62ab814', '2016-07-26 06:00:50', '2016-10-21 12:43:30'),
(131, 3, 'AUTH ID', 'AUTH_ID', 'Yes', 'MANZU4OTU5YJCZMJIYZM', '2016-07-26 09:26:52', '2016-07-28 05:58:48'),
(132, 3, 'AUTH TOKEN', 'AUTH_TOKEN', 'Yes', 'MGMxMzhmMzM2OGFlZjJkZDNhNWJjMGI4ZTg4OGJk', '2016-07-26 09:27:16', '2016-07-28 05:58:48'),
(133, 3, 'API VERSION', 'API_VERSION', 'Yes', 'v1', '2016-07-26 09:27:49', '2016-07-28 05:58:48'),
(134, 3, 'END POINT', 'END_POINT', 'Yes', 'https://api.plivo.com', '2016-07-26 09:28:14', '2016-07-28 05:58:48'),
(135, 4, 'Working Key', 'working_key', 'Yes', 'A03b780b9662f5cc19f5541a6e3858478', '2016-07-26 09:29:30', NULL),
(136, 4, 'Sender Id', 'sender_id', 'Yes', 'SIDEMO', '2016-07-26 09:29:53', NULL),
(137, 4, 'API URL', 'api', 'Yes', 'http://alerts.solutionsinfini.com/', '2016-07-26 09:30:15', NULL),
(138, 5, 'Account SID', 'account_sid', 'Yes', 'ACd36d992497f42532824a07ec3a9337fd', '2016-07-26 09:31:21', NULL),
(139, 5, 'Auth Token', 'auth_token', 'Yes', 'afa33e8e1241f421278567db3a04ee30', '2016-07-26 09:31:54', NULL),
(140, 5, 'API Version', 'api_version', 'Yes', '2010-04-01', '2016-07-26 09:32:20', NULL),
(141, 5, 'Twilio Phone Number', 'Twilio_Phone_Number', 'Yes', '+15005550006', '2016-07-26 09:32:57', NULL),
(142, 7, 'AUTH', 'AUTH', 'Yes', '129908A4YfZq1kO581745f5', '2016-11-17 08:03:11', '2016-11-17 08:04:17'),
(143, 7, 'SENDER_ID', 'SENDER_ID', 'Yes', '102234', '2016-11-17 08:03:11', '2016-11-17 08:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `dn_users`
--

CREATE TABLE IF NOT EXISTS `dn_users` (
`id` int(11) unsigned NOT NULL,
  `updated_on` date NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(512) NOT NULL,
  `city` varchar(512) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `device_id` varchar(200) NOT NULL,
  `platform` varchar(50) NOT NULL,
  `registered_by` enum('mobile','google','facebook') NOT NULL,
  `record_user_id` int(11) NOT NULL,
  `user_points` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=182 ;

--
-- Dumping data for table `dn_users`
--

INSERT INTO `dn_users` (`id`, `updated_on`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `address`, `city`, `pincode`, `landmark`, `device_id`, `platform`, `registered_by`, `record_user_id`, `user_points`) VALUES
(1, '2016-06-07', '127.0.0.1', 'Admin istrator', '$2y$08$rwkwWS1FdK9EFvuB0IJZY.U9Cdjn2Cm7L17oPjXBn3eIbE0Q0//Ca', '', 'admin@admin.com', NULL, 'GngTkxRwrVNBZR43hcGYnu70b46e2de38c4cd47e', 1469086847, NULL, 1268889823, 1480397327, 1, 'Admin', 'istrator', '123456789', '2009-12-24', '', '123456', '', '', '', 'mobile', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dn_users_groups`
--

CREATE TABLE IF NOT EXISTS `dn_users_groups` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=203 ;

--
-- Dumping data for table `dn_users_groups`
--

INSERT INTO `dn_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dn_user_address`
--

CREATE TABLE IF NOT EXISTS `dn_user_address` (
`ua_id` int(11) NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `house_no` varchar(50) DEFAULT NULL,
  `apartment_name` varchar(50) DEFAULT NULL,
  `other` varchar(50) DEFAULT NULL,
  `landmark` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `is_default` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `dn_user_address`
--

INSERT INTO `dn_user_address` (`ua_id`, `user_id`, `house_no`, `apartment_name`, `other`, `landmark`, `city`, `is_default`) VALUES
(66, 1, '12', 'tete', 'tetet', 'Begumpet', 'Hyderabad', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dn_addons`
--
ALTER TABLE `dn_addons`
 ADD PRIMARY KEY (`addon_id`);

--
-- Indexes for table `dn_email_settings`
--
ALTER TABLE `dn_email_settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dn_email_templates`
--
ALTER TABLE `dn_email_templates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dn_gallery`
--
ALTER TABLE `dn_gallery`
 ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `dn_groups`
--
ALTER TABLE `dn_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dn_items`
--
ALTER TABLE `dn_items`
 ADD PRIMARY KEY (`item_id`), ADD KEY `fk_menu` (`menu_id`);

--
-- Indexes for table `dn_item_addons`
--
ALTER TABLE `dn_item_addons`
 ADD PRIMARY KEY (`item_addon_id`), ADD KEY `fk_item_addon_id` (`addon_id`), ADD KEY `fk_item_item_id` (`item_id`);

--
-- Indexes for table `dn_item_options`
--
ALTER TABLE `dn_item_options`
 ADD PRIMARY KEY (`item_option_id`), ADD KEY `fk_item_size_id` (`option_id`);

--
-- Indexes for table `dn_languages`
--
ALTER TABLE `dn_languages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dn_login_attempts`
--
ALTER TABLE `dn_login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dn_menu`
--
ALTER TABLE `dn_menu`
 ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `dn_multi_lang`
--
ALTER TABLE `dn_multi_lang`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_language_id` (`lang_id`), ADD KEY `fk_phrase_id` (`phrase_id`);

--
-- Indexes for table `dn_offers`
--
ALTER TABLE `dn_offers`
 ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `dn_offer_products`
--
ALTER TABLE `dn_offer_products`
 ADD PRIMARY KEY (`offer_product_id`), ADD KEY `fk_offers` (`offer_id`);

--
-- Indexes for table `dn_options`
--
ALTER TABLE `dn_options`
 ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `dn_orders`
--
ALTER TABLE `dn_orders`
 ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `dn_order_addons`
--
ALTER TABLE `dn_order_addons`
 ADD PRIMARY KEY (`oa_id`);

--
-- Indexes for table `dn_order_products`
--
ALTER TABLE `dn_order_products`
 ADD PRIMARY KEY (`op_id`), ADD KEY `fk_order_id` (`order_id`);

--
-- Indexes for table `dn_pages`
--
ALTER TABLE `dn_pages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dn_payu_settings`
--
ALTER TABLE `dn_payu_settings`
 ADD PRIMARY KEY (`payu_id`);

--
-- Indexes for table `dn_phrases`
--
ALTER TABLE `dn_phrases`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dn_pl_cities`
--
ALTER TABLE `dn_pl_cities`
 ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `dn_service_provide_locations`
--
ALTER TABLE `dn_service_provide_locations`
 ADD PRIMARY KEY (`service_provide_location_id`), ADD KEY `fk_city_id` (`city_id`);

--
-- Indexes for table `dn_sessions`
--
ALTER TABLE `dn_sessions`
 ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `dn_site_settings`
--
ALTER TABLE `dn_site_settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dn_sms_gate_ways`
--
ALTER TABLE `dn_sms_gate_ways`
 ADD PRIMARY KEY (`sms_gateway_id`);

--
-- Indexes for table `dn_sms_templates`
--
ALTER TABLE `dn_sms_templates`
 ADD PRIMARY KEY (`sms_template_id`);

--
-- Indexes for table `dn_system_settings_fields`
--
ALTER TABLE `dn_system_settings_fields`
 ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `dn_users`
--
ALTER TABLE `dn_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dn_users_groups`
--
ALTER TABLE `dn_users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `dn_user_address`
--
ALTER TABLE `dn_user_address`
 ADD KEY `ua_id` (`ua_id`), ADD KEY `fk_ua_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dn_addons`
--
ALTER TABLE `dn_addons`
MODIFY `addon_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `dn_email_settings`
--
ALTER TABLE `dn_email_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dn_email_templates`
--
ALTER TABLE `dn_email_templates`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `dn_gallery`
--
ALTER TABLE `dn_gallery`
MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `dn_groups`
--
ALTER TABLE `dn_groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dn_items`
--
ALTER TABLE `dn_items`
MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT for table `dn_item_addons`
--
ALTER TABLE `dn_item_addons`
MODIFY `item_addon_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `dn_item_options`
--
ALTER TABLE `dn_item_options`
MODIFY `item_option_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `dn_languages`
--
ALTER TABLE `dn_languages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `dn_login_attempts`
--
ALTER TABLE `dn_login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dn_menu`
--
ALTER TABLE `dn_menu`
MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `dn_multi_lang`
--
ALTER TABLE `dn_multi_lang`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38226;
--
-- AUTO_INCREMENT for table `dn_offers`
--
ALTER TABLE `dn_offers`
MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `dn_offer_products`
--
ALTER TABLE `dn_offer_products`
MODIFY `offer_product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=487;
--
-- AUTO_INCREMENT for table `dn_options`
--
ALTER TABLE `dn_options`
MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `dn_orders`
--
ALTER TABLE `dn_orders`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=249;
--
-- AUTO_INCREMENT for table `dn_order_addons`
--
ALTER TABLE `dn_order_addons`
MODIFY `oa_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `dn_order_products`
--
ALTER TABLE `dn_order_products`
MODIFY `op_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=463;
--
-- AUTO_INCREMENT for table `dn_pages`
--
ALTER TABLE `dn_pages`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dn_payu_settings`
--
ALTER TABLE `dn_payu_settings`
MODIFY `payu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dn_phrases`
--
ALTER TABLE `dn_phrases`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=781;
--
-- AUTO_INCREMENT for table `dn_pl_cities`
--
ALTER TABLE `dn_pl_cities`
MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=523;
--
-- AUTO_INCREMENT for table `dn_service_provide_locations`
--
ALTER TABLE `dn_service_provide_locations`
MODIFY `service_provide_location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `dn_site_settings`
--
ALTER TABLE `dn_site_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dn_sms_gate_ways`
--
ALTER TABLE `dn_sms_gate_ways`
MODIFY `sms_gateway_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `dn_sms_templates`
--
ALTER TABLE `dn_sms_templates`
MODIFY `sms_template_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dn_system_settings_fields`
--
ALTER TABLE `dn_system_settings_fields`
MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `dn_users`
--
ALTER TABLE `dn_users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=182;
--
-- AUTO_INCREMENT for table `dn_users_groups`
--
ALTER TABLE `dn_users_groups`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT for table `dn_user_address`
--
ALTER TABLE `dn_user_address`
MODIFY `ua_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dn_items`
--
ALTER TABLE `dn_items`
ADD CONSTRAINT `fk_menu` FOREIGN KEY (`menu_id`) REFERENCES `dn_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `dn_item_addons`
--
ALTER TABLE `dn_item_addons`
ADD CONSTRAINT `fk_item_addon_id` FOREIGN KEY (`addon_id`) REFERENCES `dn_addons` (`addon_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_item_item_id` FOREIGN KEY (`item_id`) REFERENCES `dn_items` (`item_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `dn_item_options`
--
ALTER TABLE `dn_item_options`
ADD CONSTRAINT `fk_item_size_id` FOREIGN KEY (`option_id`) REFERENCES `dn_options` (`option_id`) ON DELETE CASCADE;

--
-- Constraints for table `dn_offer_products`
--
ALTER TABLE `dn_offer_products`
ADD CONSTRAINT `fk_offers` FOREIGN KEY (`offer_id`) REFERENCES `dn_offers` (`offer_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `dn_order_products`
--
ALTER TABLE `dn_order_products`
ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `dn_orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `dn_service_provide_locations`
--
ALTER TABLE `dn_service_provide_locations`
ADD CONSTRAINT `fk_city_id` FOREIGN KEY (`city_id`) REFERENCES `dn_pl_cities` (`city_id`) ON DELETE CASCADE;

--
-- Constraints for table `dn_users_groups`
--
ALTER TABLE `dn_users_groups`
ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `dn_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `dn_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `dn_user_address`
--
ALTER TABLE `dn_user_address`
ADD CONSTRAINT `fk_ua_id` FOREIGN KEY (`user_id`) REFERENCES `dn_users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
