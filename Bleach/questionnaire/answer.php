<?php 
$name = $_POST['name'];
$lastname = $_POST['lastname'];

<?php
if (isset($_FILES['picture']) AND $_FILES['picture']['error'] == 0)
{
        if ($_FILES['picture']['size'] <= 1000000)
        {
                $infosfichier = pathinfo($_FILES['picture']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {
                
                        move_uploaded_file($_FILES['picture']['tmp_name'], '' . basename($_FILES['picture']['name']));
                        echo "L'envoi a bien été effectué !";
                }
        }
}

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}



$req = $bdd->prepare('INSERT INTO form (Id,name,lastname,picture) VALUES (NULL, :name, :lastname, NULL)');
$req->execute(array('name' => $name, 'lastname' => $lastname));
?>
