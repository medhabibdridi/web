<?php


class ReclamationAdminController {

    public static function inbox() {
        $reclamations = Reclamation::all();
        require_once('views/reclamations/inbox.php');
    }

    public function older() {
        $reclamations = Reclamation::allByDateDesc();
        require_once('views/reclamations/inbox.php');
        $this->inbox();
    }

    public function attachement() {
        if (isset($_GET['fu'])) {
            echo "<script> window.open('http://localhost/bestmedical/" . $_GET['fu'] . "','_blank'); </script>";
        }
    }

    public function sendMail() {
        if (isset($_POST['envoyerMail'])) {
            $subject = $_POST['subject'];
            $recipient = $_POST['recipient'];
            $msg = $_POST['descri'];

            $header = "MIME-Version: 1.0\r\n";
            $header .= 'From:"Atelos' . "\n";
            $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
            $header .= 'Content-Transfer-Encoding: 8bit';
            $message = '
<html>
	<body>
		<div>
			<br />
			' . $msg . '<br><br>
                            <label style="color:grey; font-size:12px;">Ceci est un mail automatique généré par le site de bestmedical,<br>Merci de ne pas y répondre.</label>
                        <br><br><br><hr style="color:#abbd03"><br>
                        <center><img height="80" src="http://i.imgur.com/v1rHjRg.jpg"/></center>
                        <br><hr style="color:#abbd03">
		</div>
	</body>
</html>';
            
            
                echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Mail envoyé avec 
                <strong class='green'>succès</strong>
                </div>";
                $this->inbox();
           
        }
    }

    public function delete() {

        if (isset($_GET['ids'])) {
            $reclamations = Reclamation::removeReclamation($_GET['ids']);
            //require_once('views/back/inbox.php');
            $this->inbox();
        }
    }

    public function deleteAll() {

        if (isset($_POST['deleteAlls'])) {
            $reclamations = Reclamation::removeAllReclamations();
            //require_once('views/back/inbox.php');
            $this->inbox();
        }
    }

    public function add() {
        if (isset($_POST['envoyer'])) {
            $r = new Reclamation(NULL, $_POST['name'], $_POST['surname'], $_POST['email'], $_POST['sujet'], $_POST['text'], date("d/m/Y"), "en attente");
            $r->addReclamation();
            //$crudRec->envoyerMail();
            header("Location:../?controller=pages&action=contact");
        }
    }

    public function search() {

        if (isset($_POST['searchInbox'])) {
            $reclamations = Reclamation::findNavBar($_POST['searchInbox']);
            require_once('views/reclamations/inbox.php');
        }
         if (isset($_POST['Find'])) {
            $reclamations = Reclamation::findNavBar($_POST['Find']);
            require_once('views/reclamations/inbox.php');
        }
    }

    public static function respond() {
        if (isset($_GET['mrec'])) {
            $mails = $_GET['mrec'];
            require_once('views/reclamations/respond.php');
        }
    }

    public static function respond1() {
        $mails = $_GET['mrec'];
        require_once('views/reclamations/respond.php');
    }
    public function update(){
        if(isset($_GET['idm'])){
            $reclamations=Reclamation::updateState($_GET['idm']);
            $this->inbox();
        }
    }

//if (isset($_GET['ide'])){
//     $rec=new reclamationDAO();
//     $rec->updateState($_GET['ide']);
//     header("Location:../?controller=admin&action=inbox");
//  
// }
}

/* if (isset($_GET['ids'])) {
  $reclamations=Reclamation::removeReclamation($_GET['ids']);
  header('Location:../?controller=reclamation&action=inbox');
  } */
?>