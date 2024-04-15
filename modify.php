<?php
// Connessione al database e recupero dei dati del libro
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

// Connessione al database
$pdo = new PDO($dsn, $user, $pass, $options);

$id = $_GET['id'];

$errors = [];
// Verifica se il modulo è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Esegui la validazione dei dati
    $titolo = $_POST['titolo'];
    $autore = $_POST['autore'];
    $pubblicazione = $_POST['anno_pubblicazione'];
    $genere = $_POST['genere'];

    // Validazione dei dati
    if (empty($titolo)) {
        $errors['titolo'] = 'Inserisci un titolo';
    }

    if (empty($autore)) {
        $errors['autore'] = 'Inserisci un autore';
    }
    
    if (empty($pubblicazione)) {
        $errors['anno_pubblicazione'] = 'Inserisci un anno di pubblicazione';
    }

    if (empty($genere)) {
        $errors['genere'] = 'Inserisci un genere';
    }

    // Se ci sono errori, visualizza il form con gli errori
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
    } else {
        // Se non ci sono errori, esegui l'aggiornamento dei dati del libro nel database
        $stmt = $pdo->prepare('UPDATE libri SET titolo = :titolo, autore = :autore, anno_pubblicazione = :anno_pubblicazione, genere = :genere  WHERE id = :id');
        $stmt->execute([
            'id' => $id,
            'titolo' => $titolo,
            'autore' => $autore,
            'anno_pubblicazione' => $pubblicazione,
            'genere' => $genere
        ]);

        // Reindirizza il libro al backoffice dopo l'aggiornamento
        header("Location: index.php");
        exit;
    }
}

// Esegui la query per ottenere i dati del libro con l'ID specificato
$stmt = $pdo->prepare('SELECT * FROM libri WHERE id = :id');
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();

// Verifica se il libro è stato trovato
if (!$user) {
    echo "Libro non trovato";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ModifyBooks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Modify User</h2>
            <form action="" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="mb-3">
    <label for="titolo" class="form-label">Titolo</label>
    <input type="text" class="form-control" id="titolo" name="titolo" value="<?= $user['titolo'] ?>" required>
</div>
<div class="mb-3">
    <label for="autore" class="form-label">Autore</label>
    <input type="autore" class="form-control" id="autore" name="autore" value="<?= $user['autore'] ?>" required>
</div>
<div class="mb-3">
    <label for="anno_pubblicazione" class="form-label">Anno di pubblicazione</label>
    <input class="mt-2 w-100" type="date" name="anno_pubblicazione" id="anno_pubblicazione" value="<?= $user['anno_pubblicazione'] ?>" required>
</div>
<div class="mb-3">
    <label for="genere" class="form-label">Genere</label>
    <input type="genere" class="form-control" id="genere" name="genere" value="<?= $user['genere'] ?>" required>
</div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>