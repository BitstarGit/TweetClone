<?php 
# @*************************************************************************@
# @ @author Mansur Altamirov (Mansur_TL)									@
# @ @author_url 1: https://www.instagram.com/mansur_tl                      @
# @ @author_url 2: http://codecanyon.net/user/mansur_tl                     @
# @ @author_email: highexpresstore@gmail.com                                @
# @*************************************************************************@
# @ ColibriSM - The Ultimate Modern Social Media Sharing Platform           @
# @ Copyright (c) 21.03.2020 ColibriSM. All rights reserved.                @
# @*************************************************************************@

$cl                 = array();
$applications       = array(
	"main"          => true,
    "home"          => true,
	"guest"         => true,
	"404"           => true,
	"auth"          => true,
	"logout"        => true,
	"settings"      => true,
    "profile"       => true,
    "connections"   => true,
    "suggested"     => true,
    "trending"      => true,
    "search"        => true,
    "chats"         => true,
    "conversation"  => true,
    "thread"        => true,
    "bookmarks"     => true,
    "stat_pages"    => true,
    "notifications" => true,
    "affiliates"    => true,
    "ads"           => true,
    "cpanel"        => true,
    "oauth"         => true,
    "err404"        => true,
    "confirm_reg"   => true,
);

$cl["media_mime_types"] = array(
    'image/png',
    'image/jpeg',
    'image/gif',
    'video/mp4',
    'video/quicktime',
    'video/3gpp',
    'video/x-flv',
    'video/mpeg',
    'video/ogg',
    'video/webm',
    'video/x-ms-wmv',
    'video/3gpp2',
);

$cl['countries'] = array(
    '1' => 'United States',
    '2' => 'Canada',
    '3' => 'Afghanistan',
    '4' => 'Albania',
    '5' => 'Algeria',
    '6' => 'American Samoa',
    '7' => 'Andorra',
    '8' => 'Angola',
    '9' => 'Anguilla',
    '10' => 'Antarctica',
    '11' => 'Antigua and/or Barbuda',
    '12' => 'Argentina',
    '13' => 'Armenia',
    '14' => 'Aruba',
    '15' => 'Australia',
    '16' => 'Austria',
    '17' => 'Azerbaijan',
    '18' => 'Bahamas',
    '19' => 'Bahrain',
    '20' => 'Bangladesh',
    '21' => 'Barbados',
    '22' => 'Belarus',
    '23' => 'Belgium',
    '24' => 'Belize',
    '25' => 'Benin',
    '26' => 'Bermuda',
    '27' => 'Bhutan',
    '28' => 'Bolivia',
    '29' => 'Bosnia and Herzegovina',
    '30' => 'Botswana',
    '31' => 'Bouvet Island',
    '32' => 'Brazil',
    '34' => 'Brunei Darussalam',
    '35' => 'Bulgaria',
    '36' => 'Burkina Faso',
    '37' => 'Burundi',
    '38' => 'Cambodia',
    '39' => 'Cameroon',
    '40' => 'Cape Verde',
    '41' => 'Cayman Islands',
    '42' => 'Central African Republic',
    '43' => 'Chad',
    '44' => 'Chile',
    '45' => 'China',
    '46' => 'Christmas Island',
    '47' => 'Cocos (Keeling) Islands',
    '48' => 'Colombia',
    '49' => 'Comoros',
    '50' => 'Congo',
    '51' => 'Cook Islands',
    '52' => 'Costa Rica',
    '53' => 'Croatia (Hrvatska)',
    '54' => 'Cuba',
    '55' => 'Cyprus',
    '56' => 'Czech Republic',
    '57' => 'Denmark',
    '58' => 'Djibouti',
    '59' => 'Dominica',
    '60' => 'Dominican Republic',
    '61' => 'East Timor',
    '62' => 'Ecuador',
    '63' => 'Egypt',
    '64' => 'El Salvador',
    '65' => 'Equatorial Guinea',
    '66' => 'Eritrea',
    '67' => 'Estonia',
    '68' => 'Ethiopia',
    '69' => 'Falkland Islands (Malvinas)',
    '70' => 'Faroe Islands',
    '71' => 'Fiji',
    '72' => 'Finland',
    '73' => 'France',
    '74' => 'France, Metropolitan',
    '75' => 'French Guiana',
    '76' => 'French Polynesia',
    '77' => 'French Southern Territories',
    '78' => 'Gabon',
    '79' => 'Gambia',
    '80' => 'Georgia',
    '81' => 'Germany',
    '82' => 'Ghana',
    '83' => 'Gibraltar',
    '84' => 'Greece',
    '85' => 'Greenland',
    '86' => 'Grenada',
    '87' => 'Guadeloupe',
    '88' => 'Guam',
    '89' => 'Guatemala',
    '90' => 'Guinea',
    '91' => 'Guinea-Bissau',
    '92' => 'Guyana',
    '93' => 'Haiti',
    '94' => 'Heard and Mc Donald Islands',
    '95' => 'Honduras',
    '96' => 'Hong Kong',
    '97' => 'Hungary',
    '98' => 'Iceland',
    '99' => 'India',
    '100' => 'Indonesia',
    '101' => 'Iran (Islamic Republic of)',
    '102' => 'Iraq',
    '103' => 'Ireland',
    '104' => 'Israel',
    '105' => 'Italy',
    '106' => 'Ivory Coast',
    '107' => 'Jamaica',
    '108' => 'Japan',
    '109' => 'Jordan',
    '110' => 'Kazakhstan',
    '111' => 'Kenya',
    '112' => 'Kiribati',
    '113' => 'Korea, Democratic People\'s Republic of',
    '114' => 'Korea, Republic of',
    '115' => 'Kosovo',
    '116' => 'Kuwait',
    '117' => 'Kyrgyzstan',
    '118' => 'Lao People\'s Democratic Republic',
    '119' => 'Latvia',
    '120' => 'Lebanon',
    '121' => 'Lesotho',
    '122' => 'Liberia',
    '123' => 'Libyan Arab Jamahiriya',
    '124' => 'Liechtenstein',
    '125' => 'Lithuania',
    '126' => 'Luxembourg',
    '127' => 'Macau',
    '128' => 'Macedonia',
    '129' => 'Madagascar',
    '130' => 'Malawi',
    '131' => 'Malaysia',
    '132' => 'Maldives',
    '133' => 'Mali',
    '134' => 'Malta',
    '135' => 'Marshall Islands',
    '136' => 'Martinique',
    '137' => 'Mauritania',
    '138' => 'Mauritius',
    '139' => 'Mayotte',
    '140' => 'Mexico',
    '141' => 'Micronesia, Federated States of',
    '142' => 'Moldova, Republic of',
    '143' => 'Monaco',
    '144' => 'Mongolia',
    '145' => 'Montenegro',
    '146' => 'Montserrat',
    '147' => 'Morocco',
    '148' => 'Mozambique',
    '149' => 'Myanmar',
    '150' => 'Namibia',
    '151' => 'Nauru',
    '152' => 'Nepal',
    '153' => 'Netherlands',
    '154' => 'Netherlands Antilles',
    '155' => 'New Caledonia',
    '156' => 'New Zealand',
    '157' => 'Nicaragua',
    '158' => 'Niger',
    '159' => 'Nigeria',
    '160' => 'Niue',
    '161' => 'Norfork Island',
    '162' => 'Northern Mariana Islands',
    '163' => 'Norway',
    '164' => 'Oman',
    '165' => 'Pakistan',
    '166' => 'Palau',
    '167' => 'Panama',
    '168' => 'Papua New Guinea',
    '169' => 'Paraguay',
    '170' => 'Peru',
    '171' => 'Philippines',
    '172' => 'Pitcairn',
    '173' => 'Poland',
    '174' => 'Portugal',
    '175' => 'Puerto Rico',
    '176' => 'Qatar',
    '177' => 'Reunion',
    '178' => 'Romania',
    '179' => 'Russian Federation',
    '180' => 'Rwanda',
    '181' => 'Saint Kitts and Nevis',
    '182' => 'Saint Lucia',
    '183' => 'Saint Vincent and the Grenadines',
    '184' => 'Samoa',
    '185' => 'San Marino',
    '186' => 'Sao Tome and Principe',
    '187' => 'Saudi Arabia',
    '188' => 'Senegal',
    '189' => 'Serbia',
    '190' => 'Seychelles',
    '191' => 'Sierra Leone',
    '192' => 'Singapore',
    '193' => 'Slovakia',
    '194' => 'Slovenia',
    '195' => 'Solomon Islands',
    '196' => 'Somalia',
    '197' => 'South Africa',
    '198' => 'South Georgia South Sandwich Islands',
    '199' => 'Spain',
    '200' => 'Sri Lanka',
    '201' => 'St. Helena',
    '202' => 'St. Pierre and Miquelon',
    '203' => 'Sudan',
    '204' => 'Suriname',
    '205' => 'Svalbarn and Jan Mayen Islands',
    '206' => 'Swaziland',
    '207' => 'Sweden',
    '208' => 'Switzerland',
    '209' => 'Syrian Arab Republic',
    '210' => 'Taiwan',
    '211' => 'Tajikistan',
    '212' => 'Tanzania, United Republic of',
    '213' => 'Thailand',
    '214' => 'Togo',
    '215' => 'Tokelau',
    '216' => 'Tonga',
    '217' => 'Trinidad and Tobago',
    '218' => 'Tunisia',
    '219' => 'Turkey',
    '220' => 'Turkmenistan',
    '221' => 'Turks and Caicos Islands',
    '222' => 'Tuvalu',
    '223' => 'Uganda',
    '224' => 'Ukraine',
    '225' => 'United Arab Emirates',
    '226' => 'United Kingdom',
    '227' => 'United States minor outlying islands',
    '228' => 'Uruguay',
    '229' => 'Uzbekistan',
    '230' => 'Vanuatu',
    '231' => 'Vatican City State',
    '232' => 'Venezuela',
    '233' => 'Vietnam',
    '238' => 'Yemen',
    '239' => 'Yugoslavia',
    '241' => 'Zambia',
    '242' => 'Zimbabwe'
);

$cl['country_codes'] = array(
    '1' => 'us',
    '2' => 'ca',
    '3' => 'af',
    '4' => 'al',
    '5' => 'dz',
    '6' => 'as',
    '7' => 'ad',
    '8' => 'ao',
    '9' => 'ai',
    '10' => 'aq',
    '11' => 'ag',
    '12' => 'ar',
    '13' => 'am',
    '14' => 'aw',
    '15' => 'au',
    '16' => 'at',
    '17' => 'az',
    '18' => 'bs',
    '19' => 'bh',
    '20' => 'bd',
    '21' => 'bb',
    '22' => 'by',
    '23' => 'be',
    '24' => 'bz',
    '25' => 'bj',
    '26' => 'bm',
    '27' => 'bt',
    '28' => 'bo',
    '29' => 'ba',
    '30' => 'bw',
    '31' => 'bv',
    '32' => 'br',
    '34' => 'bn',
    '35' => 'bg',
    '36' => 'bf',
    '37' => 'bi',
    '38' => 'kh',
    '39' => 'cm',
    '40' => 'cv',
    '41' => 'ky',
    '42' => 'cf',
    '43' => 'td',
    '44' => 'cl',
    '45' => 'cn',
    '46' => 'cx',
    '47' => 'cc',
    '48' => 'co',
    '49' => 'cm',
    '50' => 'cg',
    '51' => 'ck',
    '52' => 'cr',
    '53' => 'hr',
    '54' => 'cu',
    '55' => 'cy',
    '56' => 'cz',
    '57' => 'dk',
    '58' => 'dj',
    '59' => 'dm',
    '60' => 'do',
    '61' => 'tl',
    '62' => 'ec',
    '63' => 'eg',
    '64' => 'sv',
    '65' => 'gq',
    '66' => 'er',
    '67' => 'ee',
    '68' => 'et',
    '69' => 'fk',
    '70' => 'fo',
    '71' => 'fj',
    '72' => 'fi',
    '73' => 'fr',
    '74' => 'fr',
    '75' => 'gf',
    '76' => 'pf',
    '77' => 'tf',
    '78' => 'ga',
    '79' => 'gm',
    '80' => 'ge',
    '81' => 'de',
    '82' => 'gh',
    '83' => 'gi',
    '84' => 'gr',
    '85' => 'gl',
    '86' => 'gd',
    '87' => 'gp',
    '88' => 'gu',
    '89' => 'gt',
    '90' => 'gn',
    '91' => 'gw',
    '92' => 'gy',
    '93' => 'ht',
    '94' => 'hm',
    '95' => 'hn',
    '96' => 'hk',
    '97' => 'hu',
    '98' => 'is',
    '99' => 'in',
    '100' => 'id',
    '101' => 'ir',
    '102' => 'iq',
    '103' => 'ie',
    '104' => 'il',
    '105' => 'it',
    '106' => 'ci',
    '107' => 'jm',
    '108' => 'jp',
    '109' => 'jo',
    '110' => 'kz',
    '111' => 'ke',
    '112' => 'ki',
    '113' => 'kp',
    '114' => 'kr',
    '115' => 'al',
    '116' => 'kw',
    '117' => 'kg',
    '118' => 'la',
    '119' => 'lv',
    '120' => 'lb',
    '121' => 'ls',
    '122' => 'lr',
    '123' => 'ly',
    '124' => 'li',
    '125' => 'lt',
    '126' => 'lu',
    '127' => 'mo',
    '128' => 'mk',
    '129' => 'mg',
    '130' => 'mw',
    '131' => 'my',
    '132' => 'mv',
    '133' => 'ml',
    '134' => 'mt',
    '135' => 'mh',
    '136' => 'mq',
    '137' => 'mr',
    '138' => 'mu',
    '139' => 'yt',
    '140' => 'mx',
    '141' => 'fm',
    '142' => 'md',
    '143' => 'mk',
    '144' => 'mn',
    '145' => 'me',
    '146' => 'ms',
    '147' => 'ma',
    '148' => 'mz',
    '149' => 'mm',
    '150' => 'na',
    '151' => 'nr',
    '152' => 'np',
    '153' => 'nl',
    '154' => 'nl',
    '155' => 'nc',
    '156' => 'nz',
    '157' => 'ni',
    '158' => 'ne',
    '159' => 'ng',
    '160' => 'nu',
    '161' => 'nf',
    '162' => 'mp',
    '163' => 'no',
    '164' => 'om',
    '165' => 'pk',
    '166' => 'pw',
    '167' => 'pa',
    '168' => 'pg',
    '169' => 'py',
    '170' => 'cn',
    '171' => 'ph',
    '172' => 'pn',
    '173' => 'pl',
    '174' => 'pt',
    '175' => 'pr',
    '176' => 'qa',
    '177' => 're',
    '178' => 'ro',
    '179' => 'ru',
    '180' => 'rw',
    '181' => 'kn',
    '182' => 'lc',
    '183' => 'vc',
    '184' => 'ws',
    '185' => 'sm',
    '186' => 'st',
    '187' => 'sa',
    '188' => 'sn',
    '189' => 'rs',
    '190' => 'sc',
    '191' => 'sl',
    '192' => 'sg',
    '193' => 'sk',
    '194' => 'si',
    '195' => 'sb',
    '196' => 'so',
    '197' => 'za',
    '198' => 'gs',
    '199' => 'es',
    '200' => 'lk',
    '201' => 'sh',
    '202' => 'pm',
    '203' => 'sd',
    '204' => 'sr',
    '205' => 'sj',
    '206' => 'sz',
    '207' => 'se',
    '208' => 'ch',
    '209' => 'sy',
    '210' => 'tw',
    '211' => 'tj',
    '212' => 'tz',
    '213' => 'th',
    '214' => 'tg',
    '215' => 'tk',
    '216' => 'to',
    '217' => 'tt',
    '218' => 'tn',
    '219' => 'tr',
    '220' => 'tm',
    '221' => 'tc',
    '222' => 'tv',
    '223' => 'ug',
    '224' => 'ua',
    '225' => 'ae',
    '226' => 'gb',
    '227' => 'um',
    '228' => 'uy',
    '229' => 'uz',
    '230' => 'vu',
    '231' => 'va',
    '232' => 've',
    '233' => 'vn',
    '238' => 'ye',
    '239' => 'rs',
    '240' => 'zm',
    '242' => 'zw'
);