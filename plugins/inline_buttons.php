<?php
##################################################################################
/////////////////////////////////////START////////////////////////////////////////
##################################################################################

$home['inline_keyboard'] =
[
	[
		[
			'text' => 'โAggiungimi ad un gruppoโ',
			'url' => 'http://telegram.me/AlexanderProjectBLBot?startgroup=start'
		]
	],
	[
		[
			'text'          => '๐ฃ Canale',
			'url' => 'https://t.me/YourChannel'
		],
		[
			'text'          => '๐ฅ Gruppo',
			'url' => 'https://t.me/YourGroup'
		]
	],
	[
		[
			'text'          => '๐ฎโโ๏ธ Supporters',
			'url' => 'https://t.me/YourChannel/34'
		]
	],
	[
		[
			'text'          => '๐ Guida',
			'callback_data' => 'info'
		]
	]
];

$info['inline_keyboard'] =
[
	[
		[
			'text'          => 'โ๏ธ FAQ',
			'callback_data' => 'faq'
		],
		[
			'text'          => '๐ Comandi',
			'callback_data' => 'listacomandi'
		]
	],
	[
		[
			'text'          => 'โ๏ธ Piรน Informazioni',
			'callback_data' => 'moreinfo'
		],
	],
	[
		[
			'text'          => '๐ Indietro',
			'callback_data' => 'home'
		],
	]
];

$faq['inline_keyboard'] =
[
	[
		[
			'text'          => '๐ Indietro',
			'callback_data' => 'info'
		]
	]
];

$listacomandi['inline_keyboard'] =
[
	[
		[
			'text'          => '๐ Indietro',
			'callback_data' => 'info'
		]
	]
];

##################################################################################
/////////////////////////////////////PREF/////////////////////////////////////////
##################################################################################


$pref['inline_keyboard'] =
[
	[
		[
			'text' => 'Ban',
			'callback_data' => 'ban'
		],
		[
			'text' => 'Avverti',
			'callback_data' => 'avverti'
		],
		[
			'text' => 'Muta',
			'callback_data' => 'muta'
		]
	],
	[
		[
			'text' => 'โ Chiudi โ',
			'callback_data' => 'close'
		]
	]
];

##################################################################################
//////////////////////////////////MAINTENANCE/////////////////////////////////////
##################################################################################

$mnt_config['inline_keyboard'] =
[
	[
		[
			'text' => 'ATTIVA',
			'callback_data' => 'mnt_enb'
		],
		[
			'text' => 'DISATTIVA',
			'callback_data' => 'mnt_disb'
		]
	],
	[
		[
			'text' => 'โ Chiudi โ',
			'callback_data' => 'close'
		]
	]
];

$mnt['inline_keyboard'] =
[
	[
		[
			'text'          => '๐  Indietro',
			'callback_data' => 'mnt_btt'
		]
	]
];
