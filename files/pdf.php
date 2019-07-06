<?php
//https://florida-trip-david-gracias.c9users.io/scripts/connection.php?../files/pdf.php
//https://htmlpreview.github.io/?https://github.com/mpdf/mpdf-examples/blob/development/example09_forms.php
$filepath=substr(replaceLastUnderScore(key($_GET)), 0, strrpos(key($_GET), "/")+1);
require($filepath."../fpdf181/fpdf.php");

if(isset($_GET["studID"]))
    $studID=$_GET["studID"];
else if( isset($_POST["studID"]) )
    $studID=$_POST["studID"];
else if( isset($_SESSION["id"]) )
    $studID=$_SESSION["id"];
else{ ?>
    <script>
        alert("Sorry there was problem connecting you this page\nReturning you to the home page now");
        document.location.replace('../index.php');
    </script>
<?php }
class PDF extends FPDF{
    private $_VARIABLES;
    //default keys: header_image, header_title, font
    
    //Sets PDF classs & Sets Variables
    function __construct(){
        parent::__construct();
        
        if(!isset($this->_VARIABLES["header_image"]))
            $this->_VARIABLES["header_image"]="";
            
        if(!isset($this->_VARIABLES["header_title"]))
            $this->_VARIABLES["header_title"]="";
            
        if(!isset($this->_VARIABLES["font"]))
            $this->_VARIABLES["font"]="Arial";
        
        $frac=11;
        $this->SetLeftMargin($this->w /$frac);
        $this->SetRightMargin($this->w /$frac);
    }
    
    function SetVariable($key, $value){
        if($key == null)
            $this->_VARIABLES=$value;
        // else if( isset($this->_VARIABLES[$key]) && is_array($this->_VARIABLES[$key]) )
        //     $this->_VARIABLES[$key]=array_merge($this->_VARIABLES[$key], $value);
        else
            $this->_VARIABLES[$key]=$value;
    }
    
    //Overloading Page Header
    function Header(){
        //Logo
        if(strlen($this->_VARIABLES["header_image"]) > 0)
            $this->Image($this->_VARIABLES["header_image"], 10, 6, 30);
        
        //Title
        if(strlen($this->_VARIABLES["header_title"]) > 0){
            //Font bold 15
            $this->SetFont($this->_VARIABLES["font"], 'B', 15);
            
            //Move to the right
            // $this->Cell(80);
            
            // $this->Cell(30, 10, ucwords($this->_VARIABLES["header_title"]), 1, 0, 'C');
            
            //Line break
            $this->Ln(20);
        }
    }
    //Overloading Page Footer
    function Footer(){
        $y0=$this->GetY();
        
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        
        //Arial italic 8
        $this->SetFont($this->_VARIABLES["font"], 'I', 8);
        
        //Page number
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
        
        $this->SetY($y0);
    }
    
    
    function PrintStudent(){
        $cols=array();
        $data=$this->_VARIABLES["student_data"];
        $form=$this->_VARIABLES["form_data"];
        $name=$data["fName"];
        if($data["mName"] !="")
            $name.=" ".$data["mName"];
        $name.=" ".$data["lName"];
        
        array_push($cols, array("Contact",
            "Given Name", ucwords($name),
            "Primary Email", $data["email"],
            "Alternate Email(s)", formatEmail($data["altEmail"]),
            "Cell Phone", formatPhone($form["phone"]),
        ) );
        
        array_push($cols, array("Address",
            "Street", $form["address1"],
            "City", formatCity($form["address2"]),
            "ZIP Code", formatZIP($form["address2"]),
            "State", "Pennsylvania",
        ) );
        
        array_push($cols, array("Other",
            "Student ID", $data["studID"],
            "Graduation Year", $data["gradYear"],
            "Birthday", formatDate($form["birthday"]),
        ) );
        
        $this->PrintTabledCols("Student Information", $cols);
    }
    function PrintGuardian(){
        $cols=array();
        $data=$this->_VARIABLES["form_data"];
        
        if( !($data["parent1"] == "" && $data["homePhone"] == "") )
            array_push($cols,
                array("Parent 1", "Full Name", $data["parent1"], "Phone Number", formatPhone($data["homePhone"]))
            );
        if( !($data["parent2"] == "" && $data["altPhone"] == "") )
            array_push($cols,
                array("Parent 2", "Full Name", $data["parent2"], "Phone Number", formatPhone($data["altPhone"]))
            );
        if( !($data["contact"] == "" && $data["contactPhone"] == "") )
            array_push($cols,
                array("Emergency Contact", "Full Name", $data["contact"], "Phone Number", formatPhone($data["contactPhone"]))
            );
        
        $this->PrintTabledCols("Parent Information", $cols);
    }
    function PrintMedical(){
        $cols=array();
        $data=$this->_VARIABLES["form_data"];
        
        array_push($cols, array("Medication",
            "Medication Needed", formatNA(ucwords($data["medication"])),
            "Over the Counter Drugs", formatBoolean($data["counterDrugs"]),
            "Last Tetanus", formatDate($data["tetanus"]),
            "Chronic Injuries", formatNA($data["chronic"]),
        ) );
        
        array_push($cols, array("Insurance",
            "Insurance Company", $data["insurance"],
            "Policy Number", strtoupper($data["insurancePolicy"]),
        ) );
        
        array_push($cols, array("Conact", 
            "Family Doctor", ucwords($data["doctor"]),
            "Doctor's Phone", formatPhone($data["doctorPhone"]),
            "Family Dentist", ucwords($data["dentist"]),
            "Dentist's Phone", formatPhone($data["dentistPhone"]),
        ));
        
        
        $this->PrintTabledCols("Medical Information", $cols);
    }
    
    function PrintTabledCols($header="", $cols, $labels=true, $columns=false){
        // $cols=array( "Title", "label", "value", "label", "value", ...);
            $colors=array(
                "header"=> array(0, 0, 0),
                "title"=> array(92, 90, 97),
                "label"=> array(0, 0, 0),//(255, 119, 95),
                "text"=> array(0, 0, 0),//(16,39,66),
            );
        //Header
        if(strlen($header) > 0){
            $x=$this->GetX();
            $this->SetX($x-5);
            $this->SetTextColor($colors["header"][0], $colors["header"][1], $colors["header"][2]);
            $this->SetFont($this->_VARIABLES["font"], 'U', 24);
            $this->Cell(0, 6, ucwords($header), 0, 1);
            $this->Ln(3);
            $this->SetX($x);
        }
        
        //setting up columns
        $width=$this->w - ($this->lMargin + $this->rMargin);
        
        $colWidth=($columns)? $width/count($cols) : $width;
        $y0=$this->GetY();
        for($i=0; $i < count($cols); $i++){
            if($columns)
                $this->SetY($y0);
            $x0=$this->lMargin + $i*$width/count($cols);
            if($columns)
                $this->SetX($x0);
            
            $length=array();
            foreach($cols as $col){
                $int=0;
                foreach($col as $row)
                    $int+=count(explode("\n", $row));
                array_push($length, (count($col)%2==0)? $int : $int-1 );
            }
            
            $border="R";
            if($i==0 || !$columns) $border.="L";
            
            //Title
            $title="";
            if(count($cols[$i]) %2== 1){
                //---------title-----------
                $title="| ".ucwords(array_splice($cols[$i], 0, 1)[0])." |";
                $title_font_size=18+1;
                do{
                    $this->SetFont($this->_VARIABLES["font"], 'I', $title_font_size--);
                }while($this->GetStringWidth($title) +2 > $colWidth);
                while($this->GetStringWidth($title) +2 < $colWidth)
                    $title="-".$title."-";
            }
            $this->SetTextColor($colors["title"][0], $colors["title"][1], $colors["title"][2]);
            $this->MultiCell($colWidth, 8, substr($title, 1, -1), $border."T", "C");
            
            
            //Body
            $maxLength=max($length);
            for($row=0; $row < $maxLength; $row++){
                if( ($columns && $row== $maxLength-1) || (!$columns && $row== count($cols[$i])-1) )
                    $border.="B";
                if($columns)
                    $this->SetX($x0);
                $body="";
                //sizing columns to equal heights
                if($row < count($cols[$i])){
                    $body.=($cols[$i][$row]);
                    if($labels && $row%2== 0) $body.=":";
                    
                    $x=$this->GetX();
                    $maxLength++;
                    $txt=explode("\n", $body);
                    //new lines within a row
                    for($a=0; $a < count($txt); $a++){
                        $maxLength--;
                        $txt[$a]=" ".$txt[$a];
                        if($row%2 !=0)
                            $txt[$a]="    ".$txt[$a];
                        $body_font_size=14+1;
                        do{
                            $this->SetFont($this->_VARIABLES["font"], ($row%2== 0)? 'B' : '', $body_font_size--);
                        }while($this->GetStringWidth($txt[$a]) +2 > $colWidth);
                        
                        if($row%2 !=0){
                            $this->SetY($this->GetY()-1);
                            $this->SetX($x);
                            $this->SetTextColor($colors["text"][0], $colors["text"][1], $colors["text"][2]);
                        }
                        else
                            $this->SetTextColor($colors["label"][0], $colors["label"][1], $colors["label"][2]);
                        $hasBorderBottom=strpos($border, "B") !==false;
                        if($a < count($txt)-1 && count($txt)>1 && strpos($border, "B"))
                            $border=substr($border, 0, strlen($border)-1);
                        
                        $notInput=true;
                        if($notInput)
                            $this->MultiCell($colWidth, 8, $txt[$a], $border);
                        //else for inputs hereeeeeee
                        
                        if($hasBorderBottom) $border.="B";
                    }
                }
                else if($columns)
                    $this->MultiCell($colWidth, 6, $body, $border);
            }
        }
        $this->Ln();
        $this->Ln();
    }
    
    function Output(){
        $this->SetFont($this->_VARIABLES["font"],'',12);
        $this->AliasNbPages();
        $this->AddPage();
        $this->PrintStudent();
        $this->AddPage();
        $this->PrintGuardian();
        $this->AddPage();
        $this->PrintMedical();
        parent:: Output();
    }
}

    //Instanciation of inherited class
    $pdf=new PDF();
    $pdf->SetVariable(null, [
        "header_image"=> "",
        "header_title"=> "Default",
        "font"=> "Times",
    ]);
    $result=mysqli_query($conn, "SELECT * FROM `form` WHERE `studID`=".$studID);
    if(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result))
        $pdf->SetVariable("form_data", $row);
    $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`=".$studID);
    if(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result))
        $pdf->SetVariable("student_data", $row);
    
    $pdf->Output();
    
    function formatPhone($tel){
        $tel.="";
        if(strlen($tel) == 0)
            return "";
        return "(".substr($tel, 0, 3).") ".substr($tel, 3, 3)." - ".substr($tel, 6, 4);
    }
    function formatEmail($email){
        if(strlen($email) == 0)
            return "";
        $arr=explode(($_DELIMITER !==null)? $_DELIMITER : ":::", $email);
        $output=$arr[0];
        for($i=1; $i<count($arr); $i++)
            $output.="\n".$arr[$i];
        return $output;
    }
    function formatCity($address){
        $address=strtolower($address);
        $arr=explode(",", $address);
        if(strpos($arr[0]." ", " pa ") > 0)
            $arr[0]=substr($arr[0], 0, strpos($arr[0]." ", " pa "));
            
        return ucwords($arr[0]);
    }
    function formatZIP($address){
        $address=explode(",", $address);
        return preg_match('/\d{5}/', end($address), $matches) ? $matches[0] : '';
    }
    function formatDate($date){
        if($date == "")
            return "";
        //YYYY/MM/DD
        return date("m/d/Y", strtotime($date))."\n".date("F d, Y", strtotime($date));
    }
    function formatBoolean($bool){
        if(!in_array($bool, array(0, 1, true, false)))
            return formatNA($bool);
        return ($bool)? "Yes" : "No";
    }
    function formatNA($txt){
        if(strlen($txt) == 0)
            return "N/A";
        return $txt;
    }
?>