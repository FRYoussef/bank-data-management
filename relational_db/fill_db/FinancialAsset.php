
<?php 
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "Bank-data-management"; 
  
// Create connection 
$conn = mysqli_connect( $servername, $username, $password, $dbname ); 
  
// Check connection 
if ( !$conn ) { 
    die("Connection failed: " . mysqli_connect_error()); 
} 

$sql="INSERT INTO `FinancialAsset` VALUES ('101','10','investmentFund','1',now()),
('102','4','investmentFund','2',now()),
('103','1','backDeposit','3',now()),
('104','1','investmentFund','4',now()),
('105','2','backDeposit','5',now()),
('106','8','investmentFund','6',now()),
('107','6','pensionFund','7',now()),
('108','3','investmentFund','8',now()),
('109','2','pensionFund','9',now()),
('110','7','stockExchange','10',now()),
('111','4','stockExchange','11',now()),
('112','5','stockExchange','12',now()),
('113','9','pensionFund','13',now()),
('114','2','backDeposit','15',now()),
('115','4','stockExchange','16',now()),
('116','6','stockExchange','17',now()),
('117','6','pensionFund','18',now()),
('118','7','stockExchange','19',now()),
('119','3','stockExchange','20',now()),
('120','2','investmentFund','21',now()),
('121','8','stockExchange','22',now()),
('122','9','pensionFund','23',now()),
('123','5','pensionFund','24',now()),
('124','1','pensionFund','25',now()),
('125','10','pensionFund','26',now()),
('126','4','backDeposit','27',now()),
('127','3','backDeposit','28',now()),
('128','4','investmentFund','29',now()),
('129','8','investmentFund','30',now()),
('130','7','stockExchange','31',now()),
('131','5','pensionFund','32',now()),
('132','2','backDeposit','33',now()),
('133','6','pensionFund','34',now()),
('134','5','pensionFund','35',now()),
('135','2','pensionFund','36',now()),
('136','1','stockExchange','37',now()),
('137','6','investmentFund','38',now()),
('138','9','pensionFund','39',now()),
('139','4','investmentFund','41',now()),
('140','3','pensionFund','42',now()),
('141','10','investmentFund','43',now()),
('142','9','stockExchange','44',now()),
('143','3','investmentFund','45',now()),
('144','9','investmentFund','47',now()),
('145','10','investmentFund','48',now()),
('146','8','stockExchange','49',now()),
('147','5','investmentFund','50',now()),
('148','3','backDeposit','51',now()),
('149','7','investmentFund','52',now()),
('150','7','investmentFund','53',now()),
('151','5','pensionFund','54',now()),
('152','3','backDeposit','55',now()),
('153','7','stockExchange','56',now()),
('154','1','investmentFund','57',now()),
('155','10','pensionFund','59',now()),
('156','6','investmentFund','60',now()),
('157','1','stockExchange','61',now()),
('158','7','investmentFund','62',now()),
('159','1','investmentFund','63',now()),
('160','9','backDeposit','64',now()),
('161','7','stockExchange','65',now()),
('162','1','investmentFund','66',now()),
('163','6','backDeposit','67',now()),
('164','1','backDeposit','68',now()),
('165','7','backDeposit','69',now()),
('166','4','stockExchange','70',now()),
('167','5','pensionFund','71',now()),
('168','7','investmentFund','73',now()),
('169','6','stockExchange','74',now()),
('170','1','pensionFund','75',now()),
('171','9','backDeposit','76',now()),
('172','7','backDeposit','77',now()),
('173','9','backDeposit','78',now()),
('174','3','investmentFund','79',now()),
('175','3','pensionFund','82',now()),
('176','4','investmentFund','83',now()),
('177','4','stockExchange','84',now()),
('178','7','pensionFund','85',now()),
('179','7','backDeposit','86',now()),
('180','5','pensionFund','87',now()),
('181','10','pensionFund','88',now()),
('182','8','investmentFund','89',now()),
('183','2','stockExchange','91',now()),
('184','8','backDeposit','93',now()),
('185','3','investmentFund','94',now()),
('186','2','stockExchange','95',now()),
('187','4','pensionFund','96',now()),
('188','1','investmentFund','97',now()),
('189','10','investmentFund','98',now()),
('190','9','investmentFund','99',now()),
('191','2','backDeposit','100',now()),
('292','6','pensionFund','101',now()),
('293','4','investmentFund','102',now()),
('294','4','pensionFund','103',now()),
('295','8','pensionFund','105',now()),
('296','7','investmentFund','106',now()),
('297','5','stockExchange','107',now()),
('298','6','investmentFund','108',now()),
('299','3','investmentFund','109',now()),
('300','8','pensionFund','110',now()),
('301','5','stockExchange','111',now()),
('302','7','backDeposit','113',now()),
('303','6','stockExchange','114',now()),
('304','1','pensionFund','115',now()),
('305','2','pensionFund','116',now()),
('306','4','stockExchange','117',now()),
('307','6','investmentFund','120',now()),
('308','9','investmentFund','121',now()),
('309','8','backDeposit','122',now()),
('310','10','investmentFund','123',now()),
('311','4','investmentFund','124',now()),
('312','5','investmentFund','125',now()),
('313','1','backDeposit','126',now()),
('314','4','investmentFund','127',now()),
('315','9','pensionFund','128',now()),
('316','6','investmentFund','129',now()),
('317','4','pensionFund','130',now()),
('318','6','investmentFund','131',now()),
('319','1','investmentFund','132',now()),
('320','10','pensionFund','133',now()),
('321','5','investmentFund','135',now()),
('322','1','stockExchange','136',now()),
('323','9','backDeposit','137',now()),
('324','8','backDeposit','138',now()),
('325','3','investmentFund','139',now()),
('326','8','investmentFund','140',now()),
('327','6','pensionFund','141',now()),
('328','5','investmentFund','142',now()),
('329','9','backDeposit','143',now()),
('330','4','stockExchange','144',now()),
('331','5','investmentFund','145',now()),
('332','10','pensionFund','146',now()),
('333','6','backDeposit','147',now()),
('334','8','backDeposit','148',now()),
('335','2','pensionFund','149',now()),
('336','4','investmentFund','150',now()),
('337','3','stockExchange','151',now()),
('338','4','backDeposit','152',now()),
('339','4','backDeposit','153',now()),
('340','3','backDeposit','154',now()),
('341','6','backDeposit','155',now()),
('342','5','investmentFund','156',now()),
('343','2','investmentFund','157',now()),
('344','7','investmentFund','158',now()),
('345','6','stockExchange','159',now()),
('346','6','pensionFund','160',now()),
('347','1','investmentFund','161',now()),
('348','1','pensionFund','162',now()),
('349','4','stockExchange','163',now()),
('350','8','stockExchange','164',now()),
('351','4','investmentFund','165',now()),
('352','1','pensionFund','167',now()),
('353','2','investmentFund','169',now()),
('354','7','pensionFund','171',now()),
('355','5','backDeposit','172',now()),
('356','5','stockExchange','173',now()),
('357','10','backDeposit','174',now()),
('358','2','stockExchange','175',now()),
('359','4','investmentFund','176',now()),
('360','4','stockExchange','177',now()),
('361','8','stockExchange','178',now()),
('362','4','investmentFund','179',now()),
('363','10','backDeposit','180',now()),
('364','7','backDeposit','181',now()),
('365','3','pensionFund','182',now()),
('366','6','investmentFund','183',now()),
('367','1','stockExchange','184',now()),
('368','2','stockExchange','186',now()),
('369','5','stockExchange','187',now()),
('370','5','investmentFund','188',now()),
('371','3','investmentFund','189',now()),
('372','6','backDeposit','191',now()),
('373','10','pensionFund','192',now()),
('374','10','pensionFund','193',now()),
('375','2','stockExchange','194',now()),
('376','6','backDeposit','195',now()),
('377','1','investmentFund','196',now()),
('378','10','stockExchange','197',now()),
('379','8','stockExchange','198',now()),
('380','6','investmentFund','199',now()),
('381','2','backDeposit','200',now()),
('482','4','pensionFund','201',now()),
('483','2','investmentFund','202',now()),
('484','1','backDeposit','203',now()),
('485','3','backDeposit','204',now()),
('486','7','pensionFund','205',now()),
('487','7','stockExchange','206',now()),
('488','3','backDeposit','207',now()),
('489','8','investmentFund','208',now()),
('490','9','backDeposit','209',now()),
('491','2','investmentFund','210',now()),
('492','3','pensionFund','211',now()),
('493','6','backDeposit','212',now()),
('494','6','backDeposit','213',now()),
('495','6','pensionFund','214',now()),
('496','3','pensionFund','215',now()),
('497','3','pensionFund','216',now()),
('498','5','stockExchange','217',now()),
('499','1','backDeposit','218',now()),
('500','9','backDeposit','219',now()),
('501','10','stockExchange','220',now()),
('502','4','investmentFund','221',now()),
('503','10','backDeposit','222',now()),
('504','10','investmentFund','223',now()),
('505','5','stockExchange','225',now()),
('506','9','investmentFund','227',now()),
('507','7','investmentFund','228',now()),
('508','1','pensionFund','229',now()),
('509','1','pensionFund','230',now()),
('510','3','investmentFund','232',now()),
('511','8','backDeposit','233',now()),
('512','4','stockExchange','234',now()),
('513','6','stockExchange','235',now()),
('514','8','backDeposit','236',now()),
('515','2','pensionFund','237',now()),
('516','8','pensionFund','238',now()),
('517','1','stockExchange','239',now()),
('518','10','investmentFund','240',now()),
('519','3','pensionFund','241',now()),
('520','1','backDeposit','242',now()),
('521','3','investmentFund','243',now()),
('522','7','pensionFund','245',now()),
('523','2','pensionFund','246',now()),
('524','2','stockExchange','247',now()),
('525','5','pensionFund','248',now()),
('526','1','investmentFund','249',now()),
('527','1','pensionFund','250',now()),
('528','10','backDeposit','251',now()),
('529','1','investmentFund','252',now()),
('530','10','pensionFund','253',now()),
('531','1','investmentFund','254',now()),
('532','1','stockExchange','255',now()),
('533','10','pensionFund','256',now()),
('534','9','stockExchange','257',now()),
('535','7','stockExchange','258',now()),
('536','2','investmentFund','259',now()),
('537','2','investmentFund','260',now()),
('538','5','stockExchange','261',now()),
('539','7','backDeposit','263',now()),
('540','7','pensionFund','264',now()),
('541','5','pensionFund','265',now()),
('542','5','backDeposit','267',now()),
('543','9','pensionFund','268',now()),
('544','5','investmentFund','269',now()),
('545','7','stockExchange','270',now()),
('546','4','stockExchange','271',now()),
('547','1','investmentFund','272',now()),
('548','4','pensionFund','273',now()),
('549','6','pensionFund','274',now()),
('550','6','pensionFund','275',now()),
('551','10','investmentFund','276',now()),
('552','2','backDeposit','277',now()),
('553','8','backDeposit','278',now()),
('554','8','investmentFund','279',now()),
('555','9','investmentFund','280',now()),
('556','5','investmentFund','281',now()),
('557','5','investmentFund','283',now()),
('558','2','backDeposit','284',now()),
('559','4','stockExchange','285',now()),
('560','10','investmentFund','286',now()),
('561','2','stockExchange','287',now()),
('562','9','investmentFund','288',now()),
('563','6','stockExchange','289',now()),
('564','7','backDeposit','290',now()),
('565','6','pensionFund','291',now()),
('566','2','backDeposit','292',now()),
('567','10','stockExchange','293',now()),
('568','2','pensionFund','294',now()),
('569','7','pensionFund','295',now()),
('570','5','stockExchange','296',now()),
('571','6','pensionFund','297',now()),
('572','5','stockExchange','298',now()),
('573','8','stockExchange','299',now()),
('574','8','stockExchange','300',now()),
('675','4','pensionFund','301',now()),
('676','10','investmentFund','302',now()),
('677','1','backDeposit','303',now()),
('678','2','investmentFund','304',now()),
('679','3','pensionFund','305',now()),
('680','6','backDeposit','306',now()),
('681','8','stockExchange','307',now()),
('682','5','stockExchange','308',now()),
('683','9','stockExchange','309',now()),
('684','4','stockExchange','310',now()),
('685','2','stockExchange','311',now()),
('686','5','investmentFund','314',now()),
('687','3','stockExchange','315',now()),
('688','2','pensionFund','316',now()),
('689','4','pensionFund','317',now()),
('690','8','backDeposit','318',now()),
('691','8','backDeposit','319',now()),
('692','6','pensionFund','320',now()),
('693','6','backDeposit','321',now()),
('694','9','investmentFund','322',now()),
('695','1','investmentFund','323',now()),
('696','7','stockExchange','324',now()),
('697','7','stockExchange','325',now()),
('698','6','pensionFund','326',now()),
('699','3','backDeposit','327',now()),
('700','4','stockExchange','328',now()),
('701','3','stockExchange','330',now()),
('702','6','backDeposit','331',now()),
('703','6','investmentFund','332',now()),
('704','5','investmentFund','333',now()),
('705','5','backDeposit','334',now()),
('706','9','pensionFund','335',now()),
('707','1','stockExchange','337',now()),
('708','2','pensionFund','338',now()),
('709','1','stockExchange','340',now()),
('710','7','pensionFund','341',now()),
('711','6','pensionFund','342',now()),
('712','4','stockExchange','344',now()),
('713','8','investmentFund','345',now()),
('714','3','backDeposit','346',now()),
('715','8','stockExchange','348',now()),
('716','1','backDeposit','349',now()),
('717','4','pensionFund','350',now()),
('718','4','pensionFund','351',now()),
('719','7','stockExchange','352',now()),
('720','3','pensionFund','353',now()),
('721','4','backDeposit','354',now()),
('722','6','backDeposit','355',now()),
('723','6','stockExchange','358',now()),
('724','1','investmentFund','359',now()),
('725','4','investmentFund','360',now()),
('726','10','backDeposit','361',now()),
('727','5','pensionFund','362',now()),
('728','3','investmentFund','363',now()),
('729','3','investmentFund','364',now()),
('730','6','pensionFund','365',now()),
('731','8','stockExchange','366',now()),
('732','3','pensionFund','367',now()),
('733','7','investmentFund','369',now()),
('734','9','investmentFund','370',now()),
('735','8','stockExchange','371',now()),
('736','7','stockExchange','372',now()),
('737','3','backDeposit','373',now()),
('738','7','pensionFund','374',now()),
('739','8','stockExchange','375',now()),
('740','2','pensionFund','376',now()),
('741','9','investmentFund','377',now()),
('742','8','stockExchange','378',now()),
('743','3','investmentFund','379',now()),
('744','10','pensionFund','380',now()),
('745','1','backDeposit','382',now()),
('746','2','investmentFund','383',now()),
('747','7','stockExchange','384',now()),
('748','9','investmentFund','385',now()),
('749','4','backDeposit','386',now()),
('750','4','pensionFund','387',now()),
('751','3','backDeposit','389',now()),
('752','8','stockExchange','390',now()),
('753','10','backDeposit','391',now()),
('754','2','pensionFund','392',now()),
('755','10','backDeposit','393',now()),
('756','3','investmentFund','394',now()),
('757','8','investmentFund','395',now()),
('758','5','investmentFund','396',now()),
('759','5','investmentFund','397',now()),
('760','9','stockExchange','398',now()),
('761','6','investmentFund','399',now()),
('762','2','investmentFund','400',now()),
('863','10','pensionFund','401',now()),
('864','1','stockExchange','402',now()),
('865','10','backDeposit','403',now()),
('866','1','investmentFund','404',now()),
('867','5','investmentFund','405',now()),
('868','10','investmentFund','406',now()),
('869','5','pensionFund','407',now()),
('870','9','stockExchange','408',now()),
('871','2','backDeposit','409',now()),
('872','10','backDeposit','410',now()),
('873','1','pensionFund','411',now()),
('874','9','investmentFund','412',now()),
('875','3','pensionFund','413',now()),
('876','8','backDeposit','414',now()),
('877','8','stockExchange','416',now()),
('878','6','backDeposit','417',now()),
('879','2','investmentFund','419',now()),
('880','7','stockExchange','420',now()),
('881','5','pensionFund','422',now()),
('882','10','pensionFund','423',now()),
('883','7','investmentFund','425',now()),
('884','7','pensionFund','426',now()),
('885','9','investmentFund','427',now()),
('886','8','pensionFund','428',now()),
('887','5','pensionFund','429',now()),
('888','5','stockExchange','430',now()),
('889','7','backDeposit','431',now()),
('890','5','backDeposit','432',now()),
('891','8','investmentFund','433',now()),
('892','8','investmentFund','434',now()),
('893','2','backDeposit','435',now()),
('894','4','pensionFund','437',now()),
('895','4','backDeposit','438',now()),
('896','7','backDeposit','440',now()),
('897','3','backDeposit','441',now()),
('898','7','stockExchange','442',now()),
('899','6','stockExchange','443',now()),
('900','6','stockExchange','444',now()),
('901','1','stockExchange','445',now()),
('902','8','backDeposit','446',now()),
('903','4','investmentFund','447',now()),
('904','1','backDeposit','451',now()),
('905','8','backDeposit','452',now()),
('906','6','stockExchange','453',now()),
('907','3','stockExchange','454',now()),
('908','9','backDeposit','455',now()),
('909','10','backDeposit','456',now()),
('910','3','pensionFund','457',now()),
('911','2','backDeposit','458',now()),
('912','2','stockExchange','460',now()),
('913','5','backDeposit','461',now()),
('914','8','backDeposit','462',now()),
('915','5','stockExchange','464',now()),
('916','9','stockExchange','466',now()),
('917','4','backDeposit','467',now()),
('918','9','pensionFund','468',now()),
('919','5','stockExchange','469',now()),
('920','5','investmentFund','470',now()),
('921','10','stockExchange','471',now()),
('922','3','pensionFund','473',now()),
('923','5','pensionFund','474',now()),
('924','9','stockExchange','475',now()),
('925','3','stockExchange','476',now()),
('926','4','pensionFund','477',now()),
('927','1','investmentFund','478',now()),
('928','6','stockExchange','479',now()),
('929','3','pensionFund','480',now()),
('930','2','pensionFund','481',now()),
('931','8','stockExchange','482',now()),
('932','3','pensionFund','483',now()),
('933','10','investmentFund','484',now()),
('934','5','pensionFund','485',now()),
('935','1','investmentFund','486',now()),
('936','8','investmentFund','487',now()),
('937','4','backDeposit','488',now()),
('938','5','stockExchange','489',now()),
('939','8','investmentFund','490',now()),
('940','2','backDeposit','491',now()),
('941','9','backDeposit','492',now()),
('942','4','pensionFund','494',now()),
('943','8','pensionFund','495',now()),
('944','9','stockExchange','496',now()),
('945','10','stockExchange','497',now()),
('946','6','investmentFund','498',now()),
('947','3','stockExchange','499',now()),
('948','6','stockExchange','500',now()),
('1049','10','backDeposit','501',now()),
('1050','2','pensionFund','502',now()),
('1051','8','investmentFund','503',now()),
('1052','3','pensionFund','504',now()),
('1053','6','investmentFund','505',now()),
('1054','8','pensionFund','506',now()),
('1055','8','pensionFund','507',now()),
('1056','3','investmentFund','508',now()),
('1057','4','investmentFund','509',now()),
('1058','10','stockExchange','510',now()),
('1059','2','backDeposit','511',now()),
('1060','9','stockExchange','512',now()),
('1061','3','stockExchange','513',now()),
('1062','8','pensionFund','514',now()),
('1063','5','pensionFund','515',now()),
('1064','1','stockExchange','517',now()),
('1065','5','investmentFund','518',now()),
('1066','1','investmentFund','519',now()),
('1067','9','pensionFund','520',now()),
('1068','9','pensionFund','521',now()),
('1069','7','stockExchange','522',now()),
('1070','1','investmentFund','523',now()),
('1071','9','investmentFund','524',now()),
('1072','3','backDeposit','526',now()),
('1073','9','pensionFund','527',now()),
('1074','9','backDeposit','528',now()),
('1075','4','backDeposit','529',now()),
('1076','8','backDeposit','530',now()),
('1077','3','pensionFund','531',now()),
('1078','6','stockExchange','532',now()),
('1079','6','backDeposit','533',now()),
('1080','10','backDeposit','534',now()),
('1081','5','stockExchange','536',now()),
('1082','3','stockExchange','537',now()),
('1083','7','pensionFund','538',now()),
('1084','2','stockExchange','539',now()),
('1085','1','investmentFund','540',now()),
('1086','7','backDeposit','541',now()),
('1087','2','stockExchange','542',now()),
('1088','6','backDeposit','543',now()),
('1089','9','stockExchange','545',now()),
('1090','5','pensionFund','546',now()),
('1091','1','pensionFund','547',now()),
('1092','2','stockExchange','548',now()),
('1093','9','backDeposit','549',now()),
('1094','9','pensionFund','550',now()),
('1095','8','pensionFund','551',now()),
('1096','2','pensionFund','552',now()),
('1097','2','pensionFund','553',now()),
('1098','3','investmentFund','554',now()),
('1099','4','stockExchange','555',now()),
('1100','5','pensionFund','556',now()),
('1101','6','stockExchange','557',now()),
('1102','10','investmentFund','558',now()),
('1103','5','pensionFund','559',now()),
('1104','8','stockExchange','561',now()),
('1105','3','pensionFund','562',now()),
('1106','6','stockExchange','563',now()),
('1107','10','backDeposit','564',now()),
('1108','9','pensionFund','565',now()),
('1109','1','pensionFund','568',now()),
('1110','6','investmentFund','569',now()),
('1111','4','stockExchange','570',now()),
('1112','4','stockExchange','571',now()),
('1113','9','pensionFund','572',now()),
('1114','4','stockExchange','573',now()),
('1115','6','pensionFund','574',now()),
('1116','2','stockExchange','575',now()),
('1117','4','investmentFund','576',now()),
('1118','7','investmentFund','577',now()),
('1119','5','pensionFund','578',now()),
('1120','5','stockExchange','579',now()),
('1121','2','backDeposit','580',now()),
('1122','2','stockExchange','581',now()),
('1123','7','backDeposit','582',now()),
('1124','5','pensionFund','583',now()),
('1125','3','pensionFund','585',now()),
('1126','9','backDeposit','586',now()),
('1127','8','investmentFund','587',now()),
('1128','5','stockExchange','588',now()),
('1129','2','pensionFund','589',now()),
('1130','2','investmentFund','590',now()),
('1131','9','stockExchange','591',now()),
('1132','10','pensionFund','592',now()),
('1133','7','backDeposit','593',now()),
('1134','9','pensionFund','594',now()),
('1135','3','stockExchange','595',now()),
('1136','5','stockExchange','597',now()),
('1137','9','investmentFund','598',now()),
('1138','1','backDeposit','600',now()),
('1239','3','investmentFund','601',now()),
('1240','10','backDeposit','602',now()),
('1241','6','stockExchange','604',now()),
('1242','3','investmentFund','605',now()),
('1243','4','backDeposit','606',now()),
('1244','3','stockExchange','607',now()),
('1245','7','investmentFund','608',now()),
('1246','1','stockExchange','609',now()),
('1247','5','investmentFund','610',now()),
('1248','3','backDeposit','611',now()),
('1249','7','pensionFund','613',now()),
('1250','6','backDeposit','614',now()),
('1251','6','investmentFund','616',now()),
('1252','3','stockExchange','617',now()),
('1253','8','backDeposit','618',now()),
('1254','10','pensionFund','619',now()),
('1255','3','investmentFund','620',now()),
('1256','10','backDeposit','621',now()),
('1257','1','investmentFund','623',now()),
('1258','6','investmentFund','626',now()),
('1259','6','investmentFund','627',now()),
('1260','3','backDeposit','628',now()),
('1261','5','pensionFund','629',now()),
('1262','1','investmentFund','630',now()),
('1263','7','stockExchange','631',now()),
('1264','8','investmentFund','632',now()),
('1265','2','pensionFund','633',now()),
('1266','2','investmentFund','634',now()),
('1267','1','investmentFund','635',now()),
('1268','9','pensionFund','636',now()),
('1269','5','backDeposit','637',now()),
('1270','7','stockExchange','638',now()),
('1271','6','investmentFund','639',now()),
('1272','5','pensionFund','640',now()),
('1273','3','stockExchange','641',now()),
('1274','1','backDeposit','642',now()),
('1275','5','pensionFund','643',now()),
('1276','7','investmentFund','644',now()),
('1277','10','stockExchange','645',now()),
('1278','10','investmentFund','646',now()),
('1279','1','stockExchange','647',now()),
('1280','1','backDeposit','648',now()),
('1281','3','stockExchange','650',now()),
('1282','8','backDeposit','651',now()),
('1283','8','pensionFund','652',now()),
('1284','2','stockExchange','653',now()),
('1285','5','pensionFund','654',now()),
('1286','10','investmentFund','655',now()),
('1287','10','stockExchange','656',now()),
('1288','1','pensionFund','657',now()),
('1289','6','investmentFund','659',now()),
('1290','10','investmentFund','660',now()),
('1291','1','pensionFund','661',now()),
('1292','9','stockExchange','662',now()),
('1293','10','investmentFund','663',now()),
('1294','8','pensionFund','664',now()),
('1295','2','stockExchange','666',now()),
('1296','6','investmentFund','667',now()),
('1297','7','backDeposit','668',now()),
('1298','2','backDeposit','669',now()),
('1299','2','investmentFund','670',now()),
('1300','8','stockExchange','671',now()),
('1301','2','investmentFund','672',now()),
('1302','8','stockExchange','673',now()),
('1303','5','pensionFund','674',now()),
('1304','5','backDeposit','675',now()),
('1305','2','pensionFund','676',now()),
('1306','4','investmentFund','677',now()),
('1307','1','pensionFund','678',now()),
('1308','10','investmentFund','679',now()),
('1309','10','stockExchange','680',now()),
('1310','8','backDeposit','681',now()),
('1311','9','stockExchange','682',now()),
('1312','10','investmentFund','683',now()),
('1313','5','backDeposit','684',now()),
('1314','1','investmentFund','685',now()),
('1315','4','stockExchange','687',now()),
('1316','5','pensionFund','688',now()),
('1317','8','investmentFund','689',now()),
('1318','4','stockExchange','690',now()),
('1319','4','backDeposit','691',now()),
('1320','5','stockExchange','692',now()),
('1321','7','backDeposit','693',now()),
('1322','8','investmentFund','695',now()),
('1323','6','stockExchange','697',now()),
('1324','8','stockExchange','698',now()),
('1325','10','pensionFund','700',now()),
('1426','5','stockExchange','701',now()),
('1427','1','investmentFund','702',now()),
('1428','9','backDeposit','703',now()),
('1429','9','stockExchange','704',now()),
('1430','2','backDeposit','705',now()),
('1431','9','investmentFund','706',now()),
('1432','10','backDeposit','707',now()),
('1433','7','pensionFund','708',now()),
('1434','5','pensionFund','709',now()),
('1435','8','backDeposit','710',now()),
('1436','4','pensionFund','711',now()),
('1437','5','stockExchange','712',now()),
('1438','4','investmentFund','713',now()),
('1439','8','backDeposit','714',now()),
('1440','5','backDeposit','715',now()),
('1441','7','pensionFund','716',now()),
('1442','2','pensionFund','717',now()),
('1443','10','backDeposit','718',now()),
('1444','3','pensionFund','719',now()),
('1445','10','investmentFund','720',now()),
('1446','10','pensionFund','721',now()),
('1447','2','pensionFund','722',now()),
('1448','9','pensionFund','723',now()),
('1449','6','stockExchange','724',now()),
('1450','10','backDeposit','725',now()),
('1451','7','pensionFund','726',now()),
('1452','3','pensionFund','727',now()),
('1453','9','investmentFund','728',now()),
('1454','10','pensionFund','729',now()),
('1455','8','pensionFund','730',now()),
('1456','7','pensionFund','731',now()),
('1457','7','investmentFund','732',now()),
('1458','8','stockExchange','733',now()),
('1459','1','pensionFund','734',now()),
('1460','5','pensionFund','735',now()),
('1461','3','stockExchange','736',now()),
('1462','10','backDeposit','737',now()),
('1463','2','pensionFund','738',now()),
('1464','7','backDeposit','739',now()),
('1465','5','backDeposit','740',now()),
('1466','10','stockExchange','741',now()),
('1467','10','stockExchange','742',now()),
('1468','5','stockExchange','743',now()),
('1469','10','stockExchange','744',now()),
('1470','10','stockExchange','745',now()),
('1471','8','backDeposit','746',now()),
('1472','5','backDeposit','747',now()),
('1473','2','investmentFund','748',now()),
('1474','9','pensionFund','749',now()),
('1475','2','pensionFund','750',now()),
('1476','2','stockExchange','751',now()),
('1477','6','backDeposit','752',now()),
('1478','3','backDeposit','754',now()),
('1479','9','backDeposit','755',now()),
('1480','3','pensionFund','757',now()),
('1481','1','investmentFund','758',now()),
('1482','8','pensionFund','760',now()),
('1483','1','pensionFund','761',now()),
('1484','10','stockExchange','762',now()),
('1485','1','stockExchange','765',now()),
('1486','4','investmentFund','766',now()),
('1487','4','investmentFund','767',now()),
('1488','3','stockExchange','768',now()),
('1489','2','pensionFund','769',now()),
('1490','8','pensionFund','770',now()),
('1491','5','backDeposit','771',now()),
('1492','3','backDeposit','772',now()),
('1493','2','investmentFund','773',now()),
('1494','4','backDeposit','774',now()),
('1495','3','stockExchange','775',now()),
('1496','7','pensionFund','776',now()),
('1497','7','backDeposit','777',now()),
('1498','5','stockExchange','778',now()),
('1499','7','pensionFund','779',now()),
('1500','8','pensionFund','780',now()),
('1501','3','stockExchange','781',now()),
('1502','4','stockExchange','782',now()),
('1503','1','pensionFund','783',now()),
('1504','8','stockExchange','784',now()),
('1505','10','pensionFund','786',now()),
('1506','5','stockExchange','787',now()),
('1507','5','investmentFund','788',now()),
('1508','9','pensionFund','790',now()),
('1509','8','pensionFund','791',now()),
('1510','3','backDeposit','792',now()),
('1511','3','pensionFund','793',now()),
('1512','4','backDeposit','794',now()),
('1513','1','stockExchange','795',now()),
('1514','5','investmentFund','796',now()),
('1515','4','stockExchange','799',now()),
('1616','8','investmentFund','801',now()),
('1617','5','backDeposit','803',now()),
('1618','6','stockExchange','805',now()),
('1619','5','stockExchange','806',now()),
('1620','3','stockExchange','807',now()),
('1621','3','stockExchange','808',now()),
('1622','1','investmentFund','809',now()),
('1623','7','stockExchange','810',now()),
('1624','5','backDeposit','811',now()),
('1625','5','stockExchange','812',now()),
('1626','8','pensionFund','813',now()),
('1627','8','pensionFund','814',now()),
('1628','6','backDeposit','815',now()),
('1629','8','investmentFund','816',now()),
('1630','2','pensionFund','817',now()),
('1631','4','investmentFund','818',now()),
('1632','2','pensionFund','819',now()),
('1633','1','stockExchange','820',now()),
('1634','9','pensionFund','821',now()),
('1635','1','investmentFund','822',now()),
('1636','1','pensionFund','823',now()),
('1637','7','stockExchange','824',now()),
('1638','6','backDeposit','825',now()),
('1639','10','pensionFund','827',now()),
('1640','1','backDeposit','828',now()),
('1641','3','investmentFund','829',now()),
('1642','4','investmentFund','831',now()),
('1643','10','backDeposit','832',now()),
('1644','9','pensionFund','833',now()),
('1645','9','stockExchange','834',now()),
('1646','5','investmentFund','836',now()),
('1647','7','backDeposit','838',now()),
('1648','4','pensionFund','839',now()),
('1649','4','pensionFund','841',now()),
('1650','2','pensionFund','842',now()),
('1651','4','backDeposit','844',now()),
('1652','9','pensionFund','845',now()),
('1653','2','pensionFund','846',now()),
('1654','9','investmentFund','847',now()),
('1655','1','stockExchange','848',now()),
('1656','8','investmentFund','849',now()),
('1657','6','stockExchange','850',now()),
('1658','2','investmentFund','851',now()),
('1659','5','backDeposit','852',now()),
('1660','3','investmentFund','853',now()),
('1661','5','investmentFund','854',now()),
('1662','1','backDeposit','855',now()),
('1663','9','stockExchange','856',now()),
('1664','6','investmentFund','857',now()),
('1665','2','stockExchange','858',now()),
('1666','4','backDeposit','859',now()),
('1667','9','investmentFund','860',now()),
('1668','10','backDeposit','861',now()),
('1669','4','investmentFund','862',now()),
('1670','5','investmentFund','863',now()),
('1671','9','investmentFund','865',now()),
('1672','9','pensionFund','867',now()),
('1673','2','investmentFund','868',now()),
('1674','7','stockExchange','869',now()),
('1675','5','stockExchange','870',now()),
('1676','5','investmentFund','871',now()),
('1677','10','stockExchange','872',now()),
('1678','9','pensionFund','873',now()),
('1679','3','backDeposit','874',now()),
('1680','8','pensionFund','875',now()),
('1681','10','pensionFund','876',now()),
('1682','7','stockExchange','878',now()),
('1683','9','backDeposit','879',now()),
('1684','9','backDeposit','880',now()),
('1685','4','backDeposit','881',now()),
('1686','4','backDeposit','882',now()),
('1687','3','stockExchange','883',now()),
('1688','7','backDeposit','884',now()),
('1689','8','investmentFund','885',now()),
('1690','6','backDeposit','886',now()),
('1691','4','stockExchange','887',now()),
('1692','10','pensionFund','888',now()),
('1693','8','investmentFund','889',now()),
('1694','4','backDeposit','890',now()),
('1695','1','pensionFund','891',now()),
('1696','8','backDeposit','892',now()),
('1697','4','stockExchange','893',now()),
('1698','10','investmentFund','894',now()),
('1699','9','pensionFund','895',now()),
('1700','9','pensionFund','896',now()),
('1701','7','pensionFund','897',now()),
('1702','5','investmentFund','898',now()),
('1703','2','pensionFund','899',now()),
('1704','2','backDeposit','900',now()),
('1805','6','investmentFund','901',now()),
('1806','5','stockExchange','902',now()),
('1807','1','pensionFund','903',now()),
('1808','8','backDeposit','904',now()),
('1809','3','investmentFund','906',now()),
('1810','7','investmentFund','907',now()),
('1811','10','investmentFund','908',now()),
('1812','2','stockExchange','909',now()),
('1813','8','pensionFund','910',now()),
('1814','5','pensionFund','911',now()),
('1815','8','stockExchange','912',now()),
('1816','10','stockExchange','913',now()),
('1817','4','backDeposit','914',now()),
('1818','9','backDeposit','915',now()),
('1819','5','pensionFund','916',now()),
('1820','5','stockExchange','917',now()),
('1821','7','stockExchange','918',now()),
('1822','4','stockExchange','919',now()),
('1823','5','investmentFund','920',now()),
('1824','10','stockExchange','921',now()),
('1825','5','pensionFund','922',now()),
('1826','4','stockExchange','925',now()),
('1827','2','stockExchange','926',now()),
('1828','6','backDeposit','927',now()),
('1829','8','pensionFund','928',now()),
('1830','7','investmentFund','929',now()),
('1831','5','investmentFund','930',now()),
('1832','1','backDeposit','932',now()),
('1833','1','backDeposit','933',now()),
('1834','6','backDeposit','934',now()),
('1835','10','backDeposit','935',now()),
('1836','10','pensionFund','936',now()),
('1837','1','pensionFund','937',now()),
('1838','3','pensionFund','938',now()),
('1839','8','backDeposit','939',now()),
('1840','1','investmentFund','940',now()),
('1841','6','investmentFund','941',now()),
('1842','7','stockExchange','943',now()),
('1843','9','backDeposit','944',now()),
('1844','1','pensionFund','945',now()),
('1845','8','stockExchange','947',now()),
('1846','4','pensionFund','948',now()),
('1847','7','stockExchange','950',now()),
('1848','9','pensionFund','951',now()),
('1849','10','pensionFund','952',now()),
('1850','1','stockExchange','953',now()),
('1851','4','pensionFund','954',now()),
('1852','2','investmentFund','957',now()),
('1853','5','investmentFund','958',now()),
('1854','8','investmentFund','959',now()),
('1855','4','backDeposit','960',now()),
('1856','5','investmentFund','962',now()),
('1857','7','stockExchange','963',now()),
('1858','1','backDeposit','964',now()),
('1859','4','pensionFund','965',now()),
('1860','4','backDeposit','967',now()),
('1861','1','stockExchange','969',now()),
('1862','6','backDeposit','970',now()),
('1863','9','investmentFund','972',now()),
('1864','2','investmentFund','973',now()),
('1865','3','backDeposit','974',now()),
('1866','3','stockExchange','975',now()),
('1867','8','investmentFund','976',now()),
('1868','6','investmentFund','977',now()),
('1869','9','pensionFund','978',now()),
('1870','7','backDeposit','979',now()),
('1871','6','stockExchange','981',now()),
('1872','1','investmentFund','982',now()),
('1873','4','investmentFund','983',now()),
('1874','1','pensionFund','984',now()),
('1875','9','investmentFund','985',now()),
('1876','1','stockExchange','986',now()),
('1877','7','investmentFund','987',now()),
('1878','2','backDeposit','988',now()),
('1879','8','investmentFund','989',now()),
('1880','1','stockExchange','990',now()),
('1881','10','stockExchange','991',now()),
('1882','8','backDeposit','992',now()),
('1883','3','investmentFund','993',now()),
('1884','1','backDeposit','994',now()),
('1885','10','pensionFund','995',now()),
('1886','9','pensionFund','996',now()),
('1887','3','stockExchange','998',now()),
('1888','9','stockExchange','999',now()); 
";


if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>