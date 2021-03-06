<?php

namespace DoctrineProxies\__CG__\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Report extends \Entity\Report implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function _construct()
    {
        $this->__load();
        return parent::_construct();
    }

    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function getName()
    {
        $this->__load();
        return parent::getName();
    }

    public function setName($name)
    {
        $this->__load();
        return parent::setName($name);
    }

    public function getProjectNumber()
    {
        $this->__load();
        return parent::getProjectNumber();
    }

    public function setProjectNumber($projectNumber)
    {
        $this->__load();
        return parent::setProjectNumber($projectNumber);
    }

    public function getProjectName()
    {
        $this->__load();
        return parent::getProjectName();
    }

    public function setProjectName($projectName)
    {
        $this->__load();
        return parent::setProjectName($projectName);
    }

    public function getProjectAddress()
    {
        $this->__load();
        return parent::getProjectAddress();
    }

    public function setProjectAddress($projectAddress)
    {
        $this->__load();
        return parent::setProjectAddress($projectAddress);
    }

    public function getIssuedTo()
    {
        $this->__load();
        return parent::getIssuedTo();
    }

    public function setIssuedTo($issuedTo)
    {
        $this->__load();
        return parent::setIssuedTo($issuedTo);
    }

    public function getContractorName()
    {
        $this->__load();
        return parent::getContractorName();
    }

    public function setContractorName($contractorName)
    {
        $this->__load();
        return parent::setContractorName($contractorName);
    }

    public function getInspector()
    {
        $this->__load();
        return parent::getInspector();
    }

    public function setInspector($inspector)
    {
        $this->__load();
        return parent::setInspector($inspector);
    }

    public function getCompanyName()
    {
        $this->__load();
        return parent::getCompanyName();
    }

    public function setCompanyName($name)
    {
        $this->__load();
        return parent::setCompanyName($name);
    }

    public function getCompanyAddress()
    {
        $this->__load();
        return parent::getCompanyAddress();
    }

    public function setCompanyAddress($address)
    {
        $this->__load();
        return parent::setCompanyAddress($address);
    }

    public function getCompanyEmail()
    {
        $this->__load();
        return parent::getCompanyEmail();
    }

    public function setCompanyEmail($email)
    {
        $this->__load();
        return parent::setCompanyEmail($email);
    }

    public function getCompanyPhone()
    {
        $this->__load();
        return parent::getCompanyPhone();
    }

    public function setCompanyPhone($phone)
    {
        $this->__load();
        return parent::setCompanyPhone($phone);
    }

    public function getDateReviewed()
    {
        $this->__load();
        return parent::getDateReviewed();
    }

    public function setDateReviewed($dateReviewed)
    {
        $this->__load();
        return parent::setDateReviewed($dateReviewed);
    }

    public function getDateIssued()
    {
        $this->__load();
        return parent::getDateIssued();
    }

    public function setDateIssued($dateIssued)
    {
        $this->__load();
        return parent::setDateIssued($dateIssued);
    }

    public function getUser()
    {
        $this->__load();
        return parent::getUser();
    }

    public function setUser(\Entity\User $user)
    {
        $this->__load();
        return parent::setUser($user);
    }

    public function getSections()
    {
        $this->__load();
        return parent::getSections();
    }

    public function addSection(\Entity\Section $section)
    {
        $this->__load();
        return parent::addSection($section);
    }

    public function setSections($sections)
    {
        $this->__load();
        return parent::setSections($sections);
    }

    public function setReportInfo($info)
    {
        $this->__load();
        return parent::setReportInfo($info);
    }

    public function jsonSerialize()
    {
        $this->__load();
        return parent::jsonSerialize();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'name', 'project_number', 'project_name', 'project_address', 'issued_to', 'contractor_name', 'inspector', 'company_name', 'company_address', 'company_email', 'company_phone', 'date_reviewed', 'date_issued', 'user', 'sections');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}