<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller 
{
    var $em = null;
    var $user = null;
    
    public function __construct() 
    {
        parent::__construct();
        $this->em = $this->doctrine->em;
        
        // Get user object
        $repo = $this->em->getRepository('Entity\User');
        $this->user = $repo->findOneByEmail("mona@gmail.com");
    }
    
    public function index()
    {
        // $this->insertFakeData();
        // $this->submitReport();
        // $this->retrieveReportsTitlesandIds();
        // $this->retrieveReport(1, true);
        // $this->generatePDF(1);
        $this->load->view('report_view.html');
    }
    
    
    /**
     * Insert fake data to database
     */
    public function insertFakeData()
    {
        // Create user: mona@gmail.com; 123; 1
        $userData = array(
            'email'=> 'mona@gmail.com',
            'password'=> '123',
            'roleType'=> 1,
        );
        $user = $this->createUser($userData);

        // Create report
        $data1 = array(
            'name'=>"The is my first report",
            'projectNumber'=>"001",
            'projectName'=>"project name A",
            'projectAddress'=>"100 king street, Waterloo, ON",
            'issuedToCompany'=>"Global Construction Inc",
            'issuedToPerson'=>"Deno Godin",
            'inspector'=>"Allen",
            'companyName'=>'C&H Fire Suppression Inc',
            'companyAddress'=>'274 Shirley Ave, Kitchener, ON',
            'companyEmail'=>'contactus@chfireinc.com',
            'companyPhone'=>'226-345-8751',
            'dateReviewed'=> '12/12/2014',
            'dateIssued'=>'12/12/2014'
        );
        $report1 = new Entity\Report;
        $report1->setReportInfo($data1);

        $report1->setUser($user);
        
        // Create report entities and them add to report
        $e1 = array(
            'type' => 1,
            'value'=>'Basement Floor',
            'level'=>0,
            'entity_order'=>0,
        ); 
        $level1Entity = new Entity\Report_entity; // 1
        $level1Entity->setReportEntityInfo($e1);
        $report1->addReportEntity($level1Entity);
        
        $e2 = array(
            'type' => 1,
            'value' => 'Corridor',
            'level' => 1,
            'entity_order' => 1,
        ); 
        $level2Entity = new Entity\Report_entity; // 2
        $level2Entity->setReportEntityInfo($e2);
        $report1->addReportEntity($level2Entity);
        
        $e3 = array(
            'type' => 1,
            'value'=>'Extend sheet flooring to electrical room entrance',
            'level' => 2,
            'entity_order' => 2,
        ); 
        $level3Entity1 = new Entity\Report_entity; // 3
        $level3Entity1->setReportEntityInfo($e3);
        $report1->addReportEntity($level3Entity1);
        
        $e4 = array(
            'type' => 1,
            'value'=>'Fill around electrical outlet with black cover',
            'level' => 2,
            'entity_order' => 3,
        ); 
        $level3Entity2 = new Entity\Report_entity; // 3
        $level3Entity2->setReportEntityInfo($e4);
        $report1->addReportEntity($level3Entity2);
        
        $e5 = array(
            'type' => 2,
            'value'=> base64_encode(file_get_contents('image/f.png')),
            'level' => 2,
            'entity_order' => 4,
        ); 
        $level3Entity3 = new Entity\Report_entity; // 3
        $level3Entity3->setReportEntityInfo($e5);
        $report1->addReportEntity($level3Entity3);
        
        $e6 = array(
            'type' => 2,
            'value'=> base64_encode(file_get_contents('image/f.png')),
            'level' => 2,
            'entity_order' => 5,
        ); 
        $level3Entity4 = new Entity\Report_entity; // 3
        $level3Entity4->setReportEntityInfo($e6);
        $report1->addReportEntity($level3Entity4);
        
        $e7 = array(
            'type' => 2,
            'value'=> base64_encode(file_get_contents('image/f.png')),
            'level' => 2,
            'entity_order' => 6,
        ); 
        $level3Entity5 = new Entity\Report_entity; // 3
        $level3Entity5->setReportEntityInfo($e7);
        $report1->addReportEntity($level3Entity5);

        $e8 = array(
            'type' => 1,
            'value' => 'Elevator lobby',
            'level' => 1,
            'entity_order' => 7,
        ); 
        $level2Entity2 = new Entity\Report_entity; // 2
        $level2Entity2->setReportEntityInfo($e8);
        $report1->addReportEntity($level2Entity2);
        
        $e9 = array(
            'type' => 2,
            'value'=> base64_encode(file_get_contents('image/f.png')),
            'level' => 2,
            'entity_order' => 8,
        ); 
        $level3Entity6 = new Entity\Report_entity; // 3
        $level3Entity6->setReportEntityInfo($e9);
        $report1->addReportEntity($level3Entity6);
        
        $e10 = array(
            'type' => 2,
            'value'=> base64_encode(file_get_contents('image/f.png')),
            'level' => 2,
            'entity_order' => 9,
        ); 
        $level3Entity7 = new Entity\Report_entity; // 3
        $level3Entity7->setReportEntityInfo($e10);
        $report1->addReportEntity($level3Entity7);
        
        $this->em->persist($report1);
        $this->em->flush();
    }
    
    /**
     * Create a new user and add it to database
     * @param type $data
     * @throws Exception
     */
    public function createUser($data)
    {
        if(!isset($data['email']) || !isset($data['password']) || !isset($data['roleType']))
        {
            throw new Exception('Invalid argument to create user.');
        }
        
        $user = $this->em->getRepository('Entity\User')->findOneByEmail($data['email']);
        if(!isset($user))
        {
            $user = new Entity\User();

            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setRole($data['roleType']);

            $this->em->persist($user);
            $this->em->flush();
        }
        return $user;
    }
    
    /**
     * Convert json file from browser to report object and persist to database
     */
    public function submitReport()
    {
        $postData = file_get_contents('php://input');
        $objReport = json_decode($postData);

        // Create report object
        $report = new Entity\Report;
        $report->setReportInfo($objReport);
        
        // Assign report to user
        $report->setUser($this->user);
        
        // Add report entities
        $entities = $objReport->entities;
        if(isset($entities))
        {
            foreach($entities as $reportEntityData)
            {
                $reportEntity = new Entity\Report_entity;
                $reportEntity->setReportEntityInfo($reportEntityData);
                $report->addReportEntity($reportEntity);
            }
        }

        // persist report to database 
        $this->em->persist($report);
        $this->em->flush();
    }
    
    /**
     * Get all reports belong to curent login user and retrieve report name and id.
     */
    public function retrieveReportsTitlesandIds()
    {
        // Get all reports belong to current user 
        $reports = $this->user->getReports();
        
        // Get all report name and id and send to report_view
        if(isset($reports))
        {
            foreach($reports as $report)
            {
                $reportIds[] = $report->getId();
                $reportName = $report->getName();
                $reportNames[] = $reportName == NULL? "Null" : $reportName;
            }
        }
        
        $data = array(
            'reportIds'=>$reportIds, 
            'reportNames'=>$reportNames
        );
        
        $jsonString = json_encode($data);
        
        return $jsonString;
    }
    
    /**
     * Retrieve report from database and convert it to json string and send json string to browser
     */
    public function retrieveReport($reportId, $order)
    {
        if($order)
        {
            $dql = "SELECT r, e FROM Entity\Report r JOIN r.report_entities e WHERE r.id =".$reportId." ORDER BY e.entity_order ASC";
        }
        else
        {
            $dql = "SELECT r, e FROM Entity\Report r JOIN r.report_entities e WHERE r.id =".$reportId;
        }
        
        $query = $this->em->createQuery($dql);
        $reports = $query->getResult();
        
        $report = isset($reports) ? $reports[0] : null;
        
        return $report;
    }
    
    /**
     * Delete report from database 
     */
    public function deleteReport()
    {
        $postData = file_get_contents('php://input');
        $delReportId = json_decode($postData);
        
        $repository = $this->em->getRepository("Entity\Report");
        $delReport = $repository->findOneById($delReportId);
        
        if(isset($delReport))
        {
            $this->em->remove($delReport);
            $this->em->flush();
        }
    }
    
    /**
     * Generate pdf report
     */
    public function generatePDF($reportId)
    {
        $report = $this->retrieveReport($reportId, true);
        
        if($report == NULL)
        {
            throw new Exception('Can not find report in database. Report id: '.$reportId);
        }
        
        // Set header data
        $companyName = $report->getCompanyName();
        if(isset($companyName))
        {
            $headerData[] = $companyName;
        }
        
        // Set footer data
        $companyAddress = $report->getCompanyAddress();
        $companyPhone = $report->getCompanyPhone();
        $companyEmail = $report->getCompanyEmail();
        if(isset($companyAddress))
        {
            $footerData[] = $companyAddress;
        }
        if(isset($companyPhone))
        {
            $footerData[] = $companyPhone;
        }
        if(isset($companyEmail))
        {
            $footerData[] = $companyEmail;
        }

        // Start write pdf
        $this->load->library('Pdf');
        
        // Create new pdf document
        $pdf = new Pdf('P', 'in', 'A4', true, 'UTF-8', false, false);
        
        // Set margins
        $pdf->setTopMargin(35);
        $pdf->SetLeftMargin(25);
        $pdf->SetRightMargin(25);
        $pdf->setHeaderMargin(10);
        $pdf->setFooterMargin(10);
        
        // Page setting 
        $pdf->SetAutoPageBreak(TRUE, $pdf->getMargins()['top']);
        $pdf->SetTitle('My Title');
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        
        // set image scale factor
        // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
               
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
   
        // Assign report data to header and footer
        $pdf->setHeaderContent($headerData);
        $pdf->setFooterContent($footerData);

        // Create first page
        $pdf->AddPage();
        
        // Write report name
        $reportName = $report->getName();
        if(isset($reportName))
        {
            $pdf->Cell(0, 15, $reportName, 0, 1, 'L', false, '', 0, false, 'T', 'M' );
        }
        
        // Write project info (multicell)
        $projectInfo['PROJECT NAME'] = $report->getProjectName();
        $projectInfo['PROJECT ADDRESS'] = $report->getProjectAddress();
        $projectInfo['PROJECT NUMBER'] = $report->getProjectNumber();
        $projectInfo['DATE REVIEWED'] = $report->getDateReviewed()->format('Y-m-d');
        $projectInfo['DATE ISSUED'] = $report->getDateIssued()->format('Y-m-d');
        $projectInfo['ISSUED TO'] = $report->getIssuedToCompany()."-".$report->getIssuedToPerson();
        
        foreach($projectInfo as $key => $value)
        {
            if(isset($value))
            {
                $pdf->MultiCell(50, 0, $key.":", 0, "L", false, 0, '', '', true);
                $pdf->MultiCell(0, 0, $value, 0, 'L', false, 1, '', '', true);
                $pdf->Ln(1);
            }
        }
        
        $pdf->Ln(4);
        
        // Write pdf content
        $imageWidth = 50;
        $imageHeight = 50;
        $indent = 10;
        $entities = $report->getReportEntities();
        
        if(isset($entities))
        {
            $currNumberArray = array(0=>0);
            
            for($i = 0; $i <count($entities); $i++)
            {
                $entity = $entities[$i];
                
                $type = $entity->getType();
                $value = stream_get_contents($entity->getValue());
                $level = $entity->getLevel();
                
                if($type == 1) // title
                {
                    // set start position x
                    $x = $pdf->getMargins()['left'] + ($level)*$indent;
                    
                    // set number array
                    if(!isset($currNumberArray[$level]))
                    {
                        $currNumberArray[$level] = 0;
                    }
                    $currNumberArray[$level] += 1;
                    for($j = $level+1; $j < count($currNumberArray); $j++)
                    {
                        $currNumberArray[$j] = 0;
                    }
                    
                    // get number string
                    $numberString = null;
                    for($k = 0; $k <= $level; $k++)
                    {
                        $numberString = $numberString == null ? $currNumberArray[$k]."." : $numberString.$currNumberArray[$k].".";
                    }
                    $pdf->MultiCell(0, 0, $numberString." ".$value, 0, 'L', false, 1, $x, '', true);
                }
                else if($type == 2) // image
                {   
                    $imgdata = base64_decode($value);
                    
                    // set start position x
                    $minX = $pdf->getMargins()['left'] + ($level)*$indent;
                    $maxX = $pdf->getPageWidth() - $pdf->getMargins()['right'];
                    
                    $minX = $imageWidth + $minX > $maxX ? $minX = $maxX - $imageWidth : $minX; 
                    
                    $align = 'N'; // next line
                    if($pdf->GetX() < $minX)
                    {
                        $pdf->SetX($minX);
                    }
                    
                    if($i+1 < count($entities) && isset($entities[$i+1]) && $entities[$i+1]->getType() == 2 && $pdf->GetX() + 2 * $imageWidth < $maxX)
                    {
                        $align = 'T'; // next line
                    }
                    
                    $pdf->Image('@'.$imgdata, $pdf->GetX(), '', $imageWidth, $imageHeight, '', '', $align, true, 150, 'T', false, false, 0, false, false, true, false, '');
                }
                else if($type == 3) // summary 
                {
                    // set start position x
                    $x = $pdf->getMargins()['left'] + ($level)*$indent;
                    
                    $pdf->MultiCell(0, 0, $value, 0, 'L', false, 1, $x, '', true);
                }
            }
        }
        
        $pdf->Output('My-File-Name.pdf', 'I');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}

