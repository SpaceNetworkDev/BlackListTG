<?php
##################################################################################
/////////////////////////////////////START////////////////////////////////////////
##################################################################################

$home['inline_keyboard'] =
[
	[
		[
			'text' => '➕Aggiungimi ad un gruppo➕',
			'url' => 'http://telegram.me/AlexanderProjectBLBot?startgroup=start'
		]
	],
	[
		[
			'text'          => '📣 Canale',
			'url' => 'https://t.me/YourChannel'
		],
		[
			'text'          => '👥 Gruppo',
			'url' => 'https://t.me/YourGroup'
		]
	],
	[
		[
			'text'          => '👮‍♂️ Supporters',
			'url' => 'https://t.me/YourChannel/34'
		]
	],
	[
		[
			'text'          => '📖 Guida',
			'callback_data' => 'info'
		]
	]
];

$info['inline_keyboard'] =
[
	[
		[
			'text'          => '⁉️ FAQ',
			'callback_data' => 'faq'
		],
		[
			'text'          => '📓 Comandi',
			'callback_data' => 'listacomandi'
		]
	],
	[
		[
			'text'          => '⚜️ Più Informazioni',
			'callback_data' => 'moreinfo'
		],
	],
	[
		[
			'text'          => '🔙 Indietro',
			'callback_data' => 'home'
		],
	]
];

$faq['inline_keyboard'] =
[
	[
		[
			'text'          => '🔙 Indietro',
			'callback_data' => 'info'
		]
	]
];

$listacomandi['inline_keyboard'] =
[
	[
		[
			'text'          => '🔙 Indietro',
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
			'text' => '✅ Chiudi ✅',
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
			'text' => '✅ Chiudi ✅',
			'callback_data' => 'close'
		]
	]
];

$mnt['inline_keyboard'] =
[
	[
		[
			'text'          => '🔙  Indietro',
			'callback_data' => 'mnt_btt'
		]
	]
];
