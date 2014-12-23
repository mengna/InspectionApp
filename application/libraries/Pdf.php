<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{           
    protected $headerData = null;
    protected $footerData = null;
    
    function __construct()
    {
        parent::__construct();
    }
    
    function setHeaderContent($header)
    {
        $this->headerData = $header;
    }
    function setFooterContent($footer)
    {
        $this->footerData = $footer;
    }
    
    //Page header
    public function Header() 
    {
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        
        // ending header line width
        $lineWidth = 0.5;
        
        // Write data to header
        if(isset($this->headerData))
        {
            $count = count($this->headerData);
            $cellHeight = ($this->getMargins()['top'] - $this->getHeaderMargin()- $lineWidth)/$count;
            foreach ($this->headerData as $line)
            {
                if(isset($line))
                {
                    $this->Cell(0, $cellHeight, $line, 0, false, 'C', 0, '', 0, false, 'T', 'B');
                    $this->SetY($this->y + $cellHeight);
                }
            }
        }
        // Print an ending header line
        $this->SetLineStyle(array('width' => $lineWidth, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0,0,0)));
        $this->Line($this->lMargin, $this->y, $this->getPageWidth()-$this->rMargin, $this->y, $this->linestyleCap);
    }
    
    // Page footer
    public function Footer() 
    {
        // Page number
        // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'C', 'C');
        
        $this->SetFont('helvetica', 'B', 15);
        
        $bottomMargin = $this->getMargins()['top']; 
        $this->SetY($this->getPageHeight()-$bottomMargin);
        
        // Print a starting footer line
        $lineWidth = 0.5;
        $this->SetLineStyle(array('width' => $lineWidth, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0,0,0)));
        $this->Line($this->lMargin, $this->y, $this->getPageWidth()-$this->rMargin, $this->y, $this->linestyleCap);
        
        // Add footer content
        if(isset($this->footerData))
        {
            $cellHeight = ($bottomMargin-$this->getFooterMargin()-$lineWidth)/count($this->footerData);     
            foreach($this->footerData as $line)
            {
                if(isset($line))
                {
                    $this->Cell(0, $cellHeight, $line, 0, false, 'C', 0, '', 0, false, 'T', 'T');
                    $this->SetY($this->y + $cellHeight);
                }
            }
        }
    }

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */

