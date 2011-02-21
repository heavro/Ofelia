<?php

class Application_Model_Users
{
    protected $_id;
    protected $_username;
    protected $_password;
    protected $_email;
    protected $_name;
    protected $_authenticated;
    protected $_disabled;
    protected $_modified;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid users property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid users property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
    
    public function setUsername($username)
    {
        $this->_username = (string) $username;
        return $this;
    }
    
    public function getUsername()
    {
        return $this->_username;
    }
    
    public function setPassword($password)
    {
        $this->_password = sha1($password);
        return $this;
    }
    
    public function getPassword()
    {
        return $this->_password;
    }

    public function setEmail($email)
    {
        $this->_email = (string) $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }
    
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }
    
    public function setAuthenticated($boolean)
    {
        $this->_authenticated = (bool) $boolean;
        return $this;
    }
    
    public function getAuthenticated()
    {
        return $this->_authenticated;
    }
    
    public function setDisabled($boolean)
    {
        $this->_disabled = (bool) $boolean;
        return $this;
    }
    
    public function getDisabled()
    {
        return $this->_disabled;
    }
    
    public function setModified($boolean)
    {
        $this->_modified = (bool) $boolean;
        return $this;
    }
    
    public function getModified()
    {
        return $this->_modified;
    }
}
