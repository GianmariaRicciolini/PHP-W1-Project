<?php
$host = 'localhost';
$db   = 'gestione_libreria';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);

// Query per selezionare tutti i record dalla tabella listautenti
$stmt = $pdo->prepare('SELECT * FROM libri');
$stmt->execute();
// Estrai i risultati come array associativo
$books = $stmt->fetchAll();
$errors = [];
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <div class="col-6">
        <form action="" method="post" class="pt-5 d-flex flex-column" novalidate>
                <div class="row mb-3">
                    <label class="col-4 pt-3" for="titolo">Titolo</label>
                    <div class="col-8">
                        <input class="mt-2 w-100" type="text" name="titolo" id="titolo" placeholder="titolo">
                    </div>
                </div>
        
                <div class="row mb-3">
                    <label class="col-4 pt-3" for="autore">autore</label>
                    <div class="col-8">
                        <input class="mt-2 w-100" type="text" name="autore" id="autore" placeholder="autore">
                    </div>
                </div>
        
                <div class="row mb-3">
                    <label class="col-4 pt-3" for="anno_pubblicazione">Pubblicazione</label>
                    <div class="col-8">
                        <input class="mt-2 w-100" type="date" name="anno_pubblicazione" id="anno_pubblicazione">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 pt-3" for="genere">genere</label>
                    <div class="col-8">
                        <input type="text" name="genere" id="genere" placeholder="genere" class="form-control mt-2 w-100">
                    </div>
                </div>
        
                <button type="submit" class="btn btn-primary w-25 mt-4">Invia</button>
            </form>
        </div>
        <div class="col-6">
        <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['titolo'];
    $autore = $_POST['autore'];
    $anno_pubblicazione = $_POST['anno_pubblicazione'];
    $genere = $_POST['genere'];

    if (empty($name)) {
        $errors['titolo'] = 'Inserisci un titolo';
    }

    if (empty($autore)) {
        $errors['autore'] = 'Inserisci un autore';
    }
    
    if (empty($anno_pubblicazione)) {
        $errors['anno_pubblicazione'] = 'Inserisci un anno di pubblicazione';
    }

    if (empty($genere)) {
        $errors['genere'] = 'Inserisci un genere';
    }

    if (!empty($errors)) {
        echo '<div class="container mt-4 pt-5">';
        echo '<div class="alert alert-danger" role="alert">';
        echo '<h4 class="alert-heading">Ci sono errori nel modulo:</h4>';
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
        echo '</div>';
        echo '</div>';
    }  else {

        $stmt = $pdo->prepare("INSERT INTO libri (titolo, autore, anno_pubblicazione, genere) VALUES (?, ?, ?, ?)");
    

        $stmt->execute([$name, $autore, $anno_pubblicazione, $genere]);

        header('Location: index.php');
        exit;
    }
}
?>
</div>
<div class="container mt-4 pt-5">
    <div class="row">
        <?php foreach ($books as $book): ?>
            <div class="col-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Titolo: <?= $book['titolo'] ?></h5>
                        <p class="card-text">Autore: <?= $book['autore'] ?></p>
                        <p class="card-text">Pubblicazione: <?= $book['anno_pubblicazione'] ?></p>
                        <p class="card-text">Genere: <?= $book['genere'] ?></p>
                        <a class="btn btn-danger" href="./delete.php?id=<?= $book['id'] ?>">Delete</a>
                        <a class="btn btn-primary" href="./modify.php?id=<?= $book['id'] ?>">Modify</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>