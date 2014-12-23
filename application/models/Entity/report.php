<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

/** @Entity **/
class Report implements JsonSerializable
{
    public function _construct() {
        $this->report_entities = new ArrayCollection();
    }
    
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $name;
    
    /**
     * @Column(type="string", length=255) 
     */
    protected $project_number;
    
    /**
     * @Column(type="string", length=255) 
     */
    protected $project_name;
    
    /**
     * @Column(type="string", length=255) 
     */
    protected $project_address;
    
    /**
     * @Column(type="string", length=255) 
     */
    protected $issued_to_company;
    
    /**
     * @Column(type="string", length=255) 
     */
    protected $issued_to_person;
    
    /**
     * @Column(type="string", length=255) 
     */
    protected $inspector;
    
    /**
     * @Column(type="string", length=255) 
     */
    protected $company_name;
    
    /**
     * @Column(type="string", length=255) 
     */
    protected $company_address;
    
    /**
     * @Column(type="string", length=255) 
     */
    protected $company_email;
    
    /**
     * @Column(type="string", length=255) 
     */
    protected $company_phone;
    
    /**
     * @Column(type="datetime") 
     */
    protected $date_reviewed;
    
    /**
     * @Column(type="datetime") 
     */
    protected $date_issued;
    
    /**
     * @ManyToOne(targetEntity="User", inversedBy = "reports") 
     */
    protected $user;

    /**
     * @ManyToMany(targetEntity="Report_entity", cascade = {"persist","remove"})
     * @JoinTable(name="report_report_entity",
     *      joinColumns={@JoinColumn(name="report_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="report_entity_id", referencedColumnName="id", unique=true)}
     *      )
     */
    protected $report_entities;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getProjectNumber()
    {
        return $this->project_number;
    }
    public function setProjectNumber($projectNumber)
    {
        $this->project_number = $projectNumber;
    }
    
    public function getProjectName()
    {
        return $this->project_name;
    }
    public function setProjectName($projectName)
    {
        $this->project_name = $projectName;
    }
    
    public function getProjectAddress()
    {
        return $this->project_address;
    }
    public function setProjectAddress($projectAddress)
    {
        $this->project_address = $projectAddress;
    }
    
    public function getIssuedToCompany()
    {
        return $this->issued_to_company;
    }
    public function setIssuedToCompany($companyName)
    {
        $this->issued_to_company = $companyName;
    }
    
    public function getIssuedToPerson()
    {
        return $this->issued_to_person;
    }
    public function setIssuedToPerson($personName)
    {
        $this->issued_to_person = $personName;
    }
    
    public function getInspector()
    {
        return $this->inspector;
    }
    public function setInspector($inspector)
    {
        $this->inspector = $inspector;
    }

    public function getCompanyName()
    {
        return $this->company_name;
    }
    public function setCompanyName($name)
    {
        $this->company_name = $name;
    }
    
    public function getCompanyAddress()
    {
        return $this->company_address;
    }
    public function setCompanyAddress($address)
    {
        $this->company_address = $address;
    }
    
    public function getCompanyEmail()
    {
        return $this->company_email;
    }
    public function setCompanyEmail($email)
    {
        $this->company_email = $email;
    }
    
    public function getCompanyPhone()
    {
        return $this->company_phone;
    }
    public function setCompanyPhone($phone)
    {
        $this->company_phone = $phone;
    }
    
    public function getDateReviewed()
    {
        return $this->date_reviewed;
    }
    public function setDateReviewed($dateReviewed)
    {
        $this->date_reviewed = $dateReviewed;
    }
    
    public function getDateIssued()
    {
        return $this->date_issued;
    }
    public function setDateIssued($dateIssued)
    {
        $this->date_issued = $dateIssued;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Assign report to user
     * @param \Entity\User $user
     * @return void
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        // The association must be defined in both direction
        $user->addReport($this);
    }
    
    public function getReportEntities()
    {
        return $this->report_entities;
    }
    
    /**
     * Add report_entity to report
     * @param Entity\Report_entity
     */
    public function addReportEntity(Report_entity $entity)
    {
        $this->report_entities[] = $entity;
    }
    
    public function setReportEntities($report_entities)
    {
        $this->report_entities = $report_entities;
    }
    
    /**
     * Set report infomation
     * @param type $info
     * @return void
     */
    public function setReportInfo($info)
    {
        foreach($info as $key => $value)
        {
            if($key == 'name')
            {
                $this->setName($value);
            }
            else if($key == 'projectNumber')
            {
                $this->setProjectNumber($value);
            }
            else if($key == 'projectName')
            {
                $this->setProjectName($value);
            }
            else if($key == 'projectAddress')
            {
                $this->setProjectAddress($value);
            }
            else if($key == 'issuedToCompany')
            {
                $this->setIssuedToCompany($value);
            }
            else if($key == 'issuedToPerson')
            {
                $this->setIssuedToPerson($value);
            }
            else if($key == 'inspector')
            {
                $this->setInspector($value);
            }
            else if($key == 'companyName')
            {
                $this->setCompanyName($value);
            }
            else if($key == 'companyAddress')
            {
                $this->setCompanyAddress($value);
            }
            else if($key =='companyEmail')
            {
                $this->setCompanyEmail($value);
            }
            else if($key == 'companyPhone')
            {
                $this->setCompanyPhone($value);
            }
            else if($key == 'dateReviewed')
            {
                $this->setDateReviewed(new \DateTime($value));
            }
            else if($key == 'dateIssued')
            {
                $this->setDateIssued(new \DateTime($value));
            }
        }
    }
    
    public function jsonSerialize()
    {
        return array(
            'id' => $this->id, 
            'name' => $this->name,
            'projectNumber' => $this->project_number,
            'projectName' => $this->project_name,
            'projectAddress' =>  $this->project_address,
            'issuedToCompany' => $this->issued_to_company,
            'issuedToPerson' => $this->issued_to_person,
            'inspector' => $this->inspector,
            'companyName' =>  $this->company_name,
            'companyAddress' =>  $this->company_address,
            'companyEmail' =>  $this->company_email,
            'companyPhone' =>  $this->company_phone,
            'dateReviewed' => $this->date_reviewed,
            'dateIssued' => $this->date_issued,
            'reportEntities' => $this->report_entities,
        );
    }
}