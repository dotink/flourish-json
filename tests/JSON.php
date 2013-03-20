<?php namespace Dotink\Lab
{
	use Dotink\Flourish\JSON;
	use stdClass;

	return [
		'setup' => function($data, $shared) {
			needs($data['root'] . '/src/JSON.php');
		},

		'tests' => [

			//
			//
			//

			'Instantiation' => function($data, $shared) {
				$json1 = new JSON();
				$json2 = new JSON('{}');
				$json3 = new JSON('{"property":"value"}');
				$json4 = new JSON(['property' => 'value']);
				$json5 = new JSON($json3);

				$std_object = new stdClass();
				$std_object->property = 'value';

				assert('Dotink\Flourish\JSON::$data')
					-> using($json1)
					-> equals(new stdClass())

					-> using($json2)
					-> equals(new stdClass())

					-> using($json3)
					-> equals($std_object)

					-> using($json4)
					-> equals($std_object)

					-> using($json5)
					-> equals($std_object)
				;

				assert('Dotink\Flourish\JSON::$isArray')
					-> using($json4)
					-> equals(TRUE)
				;
			},

			//
			//
			//

			'Set / Get' => function($data) {
				$json = new JSON();

				$json->name          = 'Matthew J. Sahagian';
				$json->dob           = '04/28/1984';
				$json->favoriteColor = 'blue';

				assert($json->name)->equals('Matthew J. Sahagian');
				assert($json->dob)->equals('04/28/1984');
				assert($json->favoriteColor)->equals('blue');
			},

			//
			//
			//

			'Append' => function($data) {
				$json = new JSON();

				$json->name          = 'Matthew J. Sahagian';
				$json->dob           = '04/28/1984';
				$json->favoriteColor = 'blue';
				$json->append('contacts', '{
					"cat": "Marx DaCat",
					"pm": "Patrick McPhail",
					"hero": "Linux Torvalds"
				}');

				assert($json->contacts->cat)->equals('Marx DaCat');
			},

			//
			//
			//

			'Remove' => function($data) {
				$json = new JSON();

				$json->name = 'Matthew J. Sahagian';
				$json->job  = 'Web Developer';
				$json->append('contacts', '{
					"cat": "Marx DaCat",
					"hero": "Linux Torvalds"
				}');

				$json->remove('job');
				$json->contacts->remove('cat');

				assert($json->contacts->cat)->equals(NULL);
				assert($json->job)->equals(NULL);
			},

			//
			//
			//

			'Compose' => function($data) {
				$json = new JSON('{
					"menu": {
						"id": "file",
						"value": "File",
						"popup": {
							"menuitem": [
								{"value": "New", "onclick": "CreateNewDoc()"},
								{"value": "Open", "onclick": "OpenDoc()"},
								{"value": "Close", "onclick": "CloseDoc()"}
							]
						}
					}
				}');

				$json->menu->remove('popup');
				$json->menu->remove('value');

				assert($json->compose())->equals('{"menu":{"id":"file"}}');
			},

			//
			//
			//

			'JSONSerializable' => function($data) {
				$json = new JSON('{
					"menu": {
						"id": "file",
						"value": "File",
						"popup": {
							"menuitem": [
								{"value": "New", "onclick": "CreateNewDoc()"},
								{"value": "Open", "onclick": "OpenDoc()"},
								{"value": "Close", "onclick": "CloseDoc()"}
							]
						}
					}
				}');

				assert($json->compose())->equals(json_encode($json));
			}
		]
	];
}