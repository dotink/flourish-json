# JSON
## A basic JSON manipulation class.

_Copyright (c) 2007-2015 Will Bond, Matthew J. Sahagian, others_.
_Please reference the LICENSE.md file at the root of this distribution_

### Details

This class will reduce any subject to a publically accessible standard class object which
can be manipulated with ease and then encoded.  You can also use it to decode JSON simply
by passing it a JSON string.

#### Namespace

`Dotink\Flourish`

#### Authors

<table>
	<thead>
		<th>Name</th>
		<th>Handle</th>
		<th>Email</th>
	</thead>
	<tbody>
	
		<tr>
			<td>
				Will Bond
			</td>
			<td>
				wb
			</td>
			<td>
				will@flourishlib.com
			</td>
		</tr>
	
		<tr>
			<td>
				Matthew J. Sahagian
			</td>
			<td>
				mjs
			</td>
			<td>
				msahagian@dotink.org
			</td>
		</tr>
	
	</tbody>
</table>

## Properties

### Instance Properties
#### <span style="color:#6a6e3d;">$data</span>

The internal data for the JSON object

#### <span style="color:#6a6e3d;">$isArray</span>

Whether or not the original subject was an array




## Methods
### Static Methods
<hr />

#### <span style="color:#3e6a6e;">normalize()</span>




### Instance Methods
<hr />

#### <span style="color:#3e6a6e;">__construct()</span>

Create a new JSON object

##### Details

You can create a JSON object from a string of JSON by simply passing the JSON to the
constructor.  Alternatively you can pass objects or arrays to the constructor to begin
manipulating them.

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">__get()</span>

Allows for getting the value of a property

###### Returns

<dl>
	
		<dt>
			mixed
		</dt>
		<dd>
			The value of the property
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">__isset()</span>

Allows for checking whether a property is set

###### Returns

<dl>
	
		<dt>
			boolean
		</dt>
		<dd>
			Whether or not the property is set
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">__unset()</span>

Allows for unsetting of a property

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">__set()</span>

Allows for setting of a property

###### Returns

<dl>
	
		<dt>
			void
		</dt>
		<dd>
			Provides no return value.
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">append()</span>

Appends a new JSON object to the data

##### Details

This method can be used to merge various JSON strings rather easily to create a single
composite object for encoding.

###### Returns

<dl>
	
		<dt>
			JSON
		</dt>
		<dd>
			The object for method chaining
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">asArray()</span>

Get the JSON object back as arrays.

##### Details

This method will convert all nested objects to arrays as well.  Please be aware that
this will not change the internal data store, but will create a new array from the
object by copying properties and values.

###### Returns

<dl>
	
		<dt>
			array
		</dt>
		<dd>
			The object converted to an array
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">compose()</span>

Encode the data as a JSON string

###### Returns

<dl>
	
		<dt>
			string
		</dt>
		<dd>
			The JSON encoded data
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">jsonSerialize()</span>

Reveal the proper data if the object is being JSON encoded

###### Returns

<dl>
	
		<dt>
			object
		</dt>
		<dd>
			The data as an object for encoding
		</dd>
		
		<dt>
			array
		</dt>
		<dd>
			If the data was originally an array, the data as an array for encoding
		</dd>
	
</dl>


<hr />

#### <span style="color:#3e6a6e;">remove()</span>

Remove a property from the object

###### Returns

<dl>
	
		<dt>
			JSON
		</dt>
		<dd>
			The object for method chaining
		</dd>
	
</dl>




