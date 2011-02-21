<?php

class Application_Model_UsersMapper
{
    protected $_dbTable;
 
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Users $users)
    {
        $data = array(
            'username'      => $users->getUsername(),
            'password'      => $users->getPassword(),
            'email'         => $users->getEmail(),
            'name'          => $users->getName(),
            'authenticated' => $users->getAuthenticated(),
            'disabled'      => $users->getDisabled(),
            'modified'      => $users->getModified()
        );
 
        if (null === ($id = $users->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id, Application_Model_Users $users)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $users->setId($row->id)
              ->setUsername($row->username)
              ->setPassword($row->password)
              ->setEmail($row->email)
              ->setName($row->name)
              ->setAuthenticated($row->authenticated)
              ->setDisabled($row->disabled)
              ->setModified($row->modified);
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Users();
            $entry->setId($row->id)
                  ->setUsername($row->username)
                  ->setPassword($row->password)
                  ->setEmail($row->email)
                  ->setName($row->name)
                  ->setAuthenticated($row->authenticated)
                  ->setDisabled($row->disabled);
            $entries[] = $entry;
        }
        return $entries;
    }
}
