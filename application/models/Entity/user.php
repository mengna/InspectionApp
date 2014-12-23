<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

/** @Entity **/
class User implements JsonSerializable
{
    public function _construct()
    {
        $this->reports = new ArrayCollection();
    }
    
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string", length=255, unique=true, nullable=false)
     **/
    protected $email;
    
    /**
     * @Column(type="string", length=255, nullable=false) 
     */
    protected $password;
    
    /**
     * @Column(type="integer", nullable=false) 
     */
    protected $role;
    
    /**
     * @OneToMany(targetEntity="Report", mappedBy="user", cascade = {"persist","remove"})
     * @var Report[]
     */
    protected $reports;
    
    
    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = md5($password);
    }
    
    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getReports()
    {
        return $this->reports;
    }

    /**
     * Assign report to user 
     * @param Entity\Report $report
     * @return User
     */
    public function addReport(Report $report)
    {
        $this->reports[] = $report;
    }
    
    public function setReports($reports)
    {
        $this->reports = $reports;
    }
    
    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
        );
    }
}