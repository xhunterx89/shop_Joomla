<?php
/**
* @version      2.5.0 05.11.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

class JTableAvto extends JTable{
    
    var $_list_fields = array();
    
    function _getListTableField(){        
        if (!count($this->_list_fields)){            
            $db =& $this->getDBO();
            $query = 'SHOW FIELDS FROM `'.$this->_tbl.'`';   
            $db->setQuery( $query );
            $fields = $db->loadObjectList();            
            foreach($fields as $field){
                $this->_list_fields[] = $field->Field;
            }            
        }
        return $this->_list_fields;
    }
    
    function bind( $from, $ignore=array() )
    {
        $fromArray    = is_array( $from );
        $fromObject    = is_object( $from );

        if (!$fromArray && !$fromObject)
        {
            $this->setError( get_class( $this ).'::bind failed. Invalid from argument' );
            return false;
        }
        if (!is_array( $ignore )) {
            $ignore = explode(' ', $ignore );
        }        
        
        $tableField = $this->_getListTableField();        
        if (!count($tableField)){     
            $this->setError("Error list field table ");
            return false;
        }
        
        foreach ($tableField as $k)
        {
            // internal attributes of an object are ignored
            if (!in_array( $k, $ignore ))
            {                
                if ($fromArray && isset( $from[$k] )) {
                    $this->$k = $from[$k];
                } else if ($fromObject && isset( $from->$k )) {
                    $this->$k = $from->$k;
                }
            }
        }
        return true;
    }
    
}

?>