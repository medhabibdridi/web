<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class reponseReclamationsController {

    public function add() {
        if (isset($_POST['valider'])) {


            if (reponseReclamation::findInClients($_POST['recipient']) == NULL) {
                $subject = $_POST['subject'];
                $recipient = $_POST['recipient'];
                $msg = $_POST['descri'];

                $header = "MIME-Version: 1.0\r\n";
                $header .= 'From:"Sayderma"<wacel.benaraar@esprit.tn>' . "\n";
                $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
                $header .= 'Content-Transfer-Encoding: 8bit';
                $message = '
<html>
	<body>
		<div align="center">
			<br />
			' . $msg . '
                        <br><br><br><br><br><hr>
                        <img height="100" src="http://i.imgur.com/v1rHjRg.jpg"/>
		</div>
	</body>
</html>
';

                mail($recipient, $subject, $message, $header);
                 echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-fire bigger-140'></i>
               The Client you are replying to is not registred !
               A mail has been sent to his mail account with
                <strong class='green'>succès</strong>
                </div>";
                ReclamationAdminController::inbox();
            } else {
                $r = new reponseReclamation($_POST['subject'], $_POST['descri'], $_POST['recipient']);
// $r = new reponseReclamation("hjh","jkj","mahdi.gouider@gmail.com");
                $r->addRepRec();
                $rec = Reclamation::removeReclamationByMail($_POST['recipient']);
                ReclamationAdminController::inbox();
            }
            return array($_POST['subject'], $_POST['descri'], $_POST['recipient']);
        }
    }

    public function reSend() {
        if (isset($_POST['yes'])) {
            $tab = [];
            $tab = $this->add();
            var_dump($tab);
        }
    }

}
