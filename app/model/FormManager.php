<?php
//namespace Rilcy\Blog\App\Model;
//require_once("../app/Model/Model.php");
namespace App\Model;


// Requêtes pour le formulaire de contact
class FormManager extends Model{


    public function contacter()
    {
        $db = $this->dbConnect();

        //$post_nom = htmlspecialchars($_POST['post_nom']);
        //$post_prenom = htmlspecialchars($_POST['post_prenom']);
        //$post_mail = htmlspecialchars($_POST['post_mail']);
        //$post_message = htmlspecialchars($_POST['post_message']);

        if(isset($_POST['mailform']))
        {
            if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message']))
           {
                $header="MIME-Version: 1.0\r\n";
                $header.='From:"Tati.com"<tisikacoco971@hotmail.com>'."\n";
                $header.='Content-Type:text/html; charset="uft-8"'."\n";
                $header.='Content-Transfer-Encoding: 8bit';
        
                $message='
                <html>
                    <body>
                        <div align="center">
                            <u>Prénom de l\'expéditeur :</u>'.$_POST['prenom'].'<br />
                            <u>Nom de l\'expéditeur :</u>'.$_POST['nom'].'<br />
                            <u>Mail de l\'expéditeur :</u>'.$_POST['mail'].'<br />
                            <br />
                            '.nl2br($_POST['message']).'
                        </div>
                    </body>
                </html>
                ';
        
                mail("tatiana.rilcy@gmail.com", "CONTACT - Monsite.com", $message, $header);
                $msg="Votre message a bien été envoyé !";
            }
            else
            {
                $msg="<span style='color:red'>Tous les champs doivent être complétés !</span>";
            } 
        }

        return ;
    }
}