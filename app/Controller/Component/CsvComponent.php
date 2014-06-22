<?php
/**
  *		File: app/Controller/Component/CsvComponent.php
  *		<p>Component for importing and exporting Csv files in cakephp.</p>
  *
  *     Copyright (c) 2012 Eyesore, Inc.
  *
  *     See the file license.txt for copying permission.
  *
  *		@author Trey Jones <trey@eyesoreinc.com>
  *
  **/

class CsvComponent extends Component
{
	/**
	*	Array of fields in the proper order to be parsed.
	*	By default the header of the csv is read.  If this value is not empty,
	*	the header will be ignored.  The header is defined as the first line of the csv,
	*	regardless of whether it contains anything or not.
	**/
	public $fields = array();

	/**
	*	CSV delimiter, defaults to comma
	**/
	public $delimiter = ',';

	/**
	*	String enclosure
	**/
	public $enclosure = '"';

	/**
	*	Escape character
	*/
	public $escape = '\\';

	/**
	*	Parse a csv file into an indexed array of "records", where keys
	*	are values from the header or $this->fields, and values are the values for
	*	each row.
	*
	*	@param {string} $filename Path to the csv file being imported.
	*	@param {bool} $parseFirstLine If true, will parse the first line as a record, unless $this->fields is not set. By default skips the first line if fields is already set.
	*	@returns {array} Indexed array of records.  Each record is an array of key => value pairs.
	**/
	public function import($filename, $parseFirstLine = false)
	{
            $handle = fopen($filename, 'r');
            $count = 0;
            $records = array();

            while($line = fgetcsv($handle, null, $this->delimiter, $this->enclosure, $this->escape))
            {
                if($count == 0 && empty($this->fields))
                        $this->fields = $line;

                if(empty($this->fields))
                        throw new Exception('You must provide fields for parsing, or a header for the csv.');

                if($count == 0 and $parseFirstLine === false)
                {
                        $count++;
                        continue;
                }

                $currentRecord = array();

                foreach($this->fields as $index => $field)
                {
                	if($line[$index] == 'n' || $line[$index] == 'N') { // Change Y/N to 1/0
                		$line[$index] = 0;
                	} elseif($line[$index] == 'y' ||$line[$index] == 'Y') {
                		$line[$index] = 1;
                	}

                    $currentRecord[$field] = $line[$index];
                }

                $records[] = $currentRecord;
                $count++;


            }

            fclose($handle);
            return $records;
	}

	public function export($filename, $forceDownload = true)
	{
	}
}
