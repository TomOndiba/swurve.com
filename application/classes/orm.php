<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM {
    protected $_enum_field_values = array();
    
    public function enum_field_values($field, $default = NULL)
    {
        // Check if enum data has already been pulled as to avoid unnecessary database calls
        if (empty($this->_enum_field_values))
        {
            // Quote the table name
            $table = $this->_db->quote_table($this->_table_name);

            // Search for column names
            $result = $this->_db->query(Database::SELECT, 'SHOW COLUMNS FROM '.$table, FALSE);

            foreach ($result as $row)
            {
                // Get the column name from the results
                $enum = $row['Type'];
                $values = array();

                // Only parse columns of the type enum
                if (strpos($enum, 'enum') !== FALSE) {
                    $enum = str_replace("'", '', substr($enum, 6, strlen($enum) - 7));
                    $enum_array = split(',', $enum);

                    // Loop through list of enum values and reformat into a array we can work with
                    foreach ($enum_array as $value)
                    {
                        if ($row['Field'] == 'interested_in')
                        {
                            switch($value)
                            {
                                case 'Male':
                                    $values[$value] = 'Men';
                                    break;
                                    
                                case 'Female':
                                    $values[$value] = 'Women';
                                    break;

                                case 'Both':
                                    $values[$value] = $value;
                                    break;
                            }
                        }
                        else
                        {
                            $values[$value] = $value;
                        }
                    }

                    // Set protected variable with the enum array list for the column
                    $this->_enum_field_values[$row['Field']] = $values;
                }
            }
        }
        
        // Store enum array into temp variable for use in the step below (details below).
        // If using this function against the same field twice, the second call would contain the default value prepended
        // already and it would prepended it again, a temp variable fixes this as we don't modify the orignal array list.
        $enum_values = $this->_enum_field_values[$field];

        // If a default value is passed, prepend it the enum array list
        if ( ! is_null($default)) $enum_values = array('' => $default) + $enum_values;

        // Return the columns enum list as an array
        return $enum_values;
    }          
}