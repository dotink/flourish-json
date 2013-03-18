<?php namespace Dotink\Flourish {

	/**
	 * A basic JSON manipulation class.
	 *
	 * This class will reduce any subject to a publically accessible standard class object which
	 * can be manipulated with ease and then encoded.  You can also use it to decode JSON simply
	 * by passing it a JSON string.
	 *
	 * @copyright  Copyright (c) 2012 Will Bond, others
	 * @author     Matthew J. Sahagian [mjs] <msahagian@dotink.org>
	 *
	 * @license    http://flourishlib.com/license
	 *
	 * @package    Flourish
	 */
	class JSON implements \JSONSerializable
	{
		/**
		 * The internal data for the JSON object
		 *
		 * @access private
		 * @var object
		 */
		private $data = NULL;


		/**
		 * Whether or not the original subject was an array
		 *
		 * @access private
		 * @var boolean
		 */
		private $isArray = FALSE;


		/**
		 * Create a new JSON object
		 *
		 * You can create a JSON object from a string of JSON by simply passing the JSON to the
		 * constructor.  Alternatively you can pass objects or arrays to the constructor to begin
		 * manipulating them.
		 *
		 * @access public
		 * @var mixed $subject The subject to seed the object with.
		 * @return void
		 */
		public function __construct($subject = NULL)
		{
			if ($subject === NULL) {
				$this->data = new \stdClass();

			} elseif (is_object($subject)) {

				if (get_class($subject) == __CLASS__) {
					$this->data = $subject->data;

				} else {

					//
					// By encoding and decoding the subject immediately we reduce it to it's
					// official serialized structure.  Otherwise, we assume the object handles
					//

					$this->data = ($subject instanceof \JSONSerializable)
						? json_decode(json_encode($subject))
						: (object) get_object_vars($subject);
				}

			} elseif (!is_array($subject)) {
				$this->data = json_decode($subject);

				if (!$this->data) {
					throw new ProgrammerException(
						'Cannot parse JSON subject, invalid format.'
					);
				}

			} else {
				$this->data = $subject;
			}

			//
			// Since multiple operations could result in our data being an array, we want to check
			// this explicitly and cast it as an object to make it functional.
			//

			if (is_array($this->data)) {
				$this->isArray = TRUE;
				$this->data    = (object) $this->data;
			}
		}


		/**
		 * Allows for getting the value of a property
		 *
		 * @access public
		 * @var string $name The name of the property
		 * @return mixed The value of the property
		 */
		public function __get($name)
		{
			return isset($this->data->$name)
				? $this->data->$name
				: NULL;
		}


		/**
		 * Allows for checking whether a property is set
		 *
		 * @access public
		 * @var string $name The name of the property
		 * @return boolean Whether or not the property is set
		 */
		public function __isset($name)
		{
			return isset($this->data->$name);
		}


		/**
		 * Allows for unsetting of a property
		 *
		 * @access public
		 * @var string $name The name of the property
		 * @return void
		 */
		public function __unset($name)
		{
			unset($this->data->$name);
		}


		/**
		 * Allows for setting of a property
		 *
		 * @access public
		 * @var string $name The name of the property
		 * @var mixed $value The value for the property
		 * @return void
		 */
		public function __set($name, $value)
		{
			$this->data->$name = $value;
		}


		/**
		 * Appends a new JSON object to the data
		 *
		 * This method can be used to merge various JSON strings rather easily to create a single
		 * composite object for encoding.
		 *
		 * @access public
		 * @var string $name The name of the property to append
		 * @var mixed $subject A subject to seed the property with
		 * @return JSON The object for method chaining
		 */
		public function append($name, $subject = NULL)
		{
			$this->data->$name = new self($subject);
			return $this;
		}


		/**
		 * Get the JSON object back as arrays.
		 *
		 * This method will convert all nested objects to arrays as well.  Please be aware that
		 * this will not change the internal data store, but will create a new array from the
		 * object by copying properties and values.
		 *
		 * @access public
		 * @var object $data A data object to convert to an array
		 * @return array The object converted to an array
		 */
		public function asArray($data = NULL)
		{
			$output = array();

			if (!func_num_args()) {
				$data = $this->data;
			}

			foreach ($data as $property => $value) {
				$output[$property] = is_object($value)
					? $this->asArray($value)
					: $value;
			}

			return $output;
		}


		/**
		 * Encode the data as a JSON string
		 *
		 * @access public
		 * @var boolean $force_object Whether or not we should force arrays to be objects
		 * @return string The JSON encoded data
		 */
		public function compose($force_object = FALSE)
		{
			return json_encode($this, $force_object ? JSON_FORCE_OBJECT : 0);
		}


		/**
		 * Reveal the proper data if the object is being JSON encoded
		 *
		 * @access public
		 * @return object The data as an object for encoding
		 * @return array If the data was originally an array, the data as an array for encoding
		 */
		public function jsonSerialize()
		{
			return $this->isArray
				? (array) $this->data
				: $this->data;
		}


		/**
		 * Remove a property from the object
		 *
		 * @access public
		 * @var string $name The property name to remove
		 * @var ...
		 * @return JSON The object for method chaining
		 */
		public function remove($name)
		{
			$properties = func_get_args();

			foreach ($properties as $property) {
				unset($this->data->$property);
			}

			return $this;
		}
	}
}