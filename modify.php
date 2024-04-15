<?php

include __DIR__ . '/includes/dbconnect.php';

$id = $_GET['id'];

$errors = [];
// Verifica se il modulo è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Esegui la validazione dei dati
    $titolo = $_POST['titolo'];
    $autore = $_POST['autore'];
    $pubblicazione = $_POST['anno_pubblicazione'];
    $genere = $_POST['genere'];
    $immagine = $_POST['immagine'];

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

    if (empty($immagine)) {
        $errors['immagine'] = 'Inserisci una immagine';
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
        $stmt = $pdo->prepare('UPDATE libri SET titolo = :titolo, autore = :autore, anno_pubblicazione = :anno_pubblicazione, genere = :genere, immagine = :immagine  WHERE id = :id');
        $stmt->execute([
            'id' => $id,
            'titolo' => $titolo,
            'autore' => $autore,
            'anno_pubblicazione' => $pubblicazione,
            'genere' => $genere,
            'immagine' => $immagine
        ]);

        // Reindirizza il libro al backoffice dopo l'aggiornamento
        header("Location: index.php");
        exit;
    }
}

// Esegui la query per ottenere i dati del libro con l'ID specificato
$stmt = $pdo->prepare('SELECT * FROM libri WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

// Verifica se il libro è stato trovato
if (!$book) {
    echo "Libro non trovato";
    exit;
}



include __DIR__ . '/includes/head.php';
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Modify book</h2>
            <form action="" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="mb-3">
    <label for="titolo" class="form-label">Titolo</label>
    <input type="text" class="form-control" id="titolo" name="titolo" value="<?= $book['titolo'] ?>" required>
</div>
<div class="mb-3">
    <label for="autore" class="form-label">Autore</label>
    <input type="autore" class="form-control" id="autore" name="autore" value="<?= $book['autore'] ?>" required>
</div>
<div class="mb-3">
    <label for="anno_pubblicazione" class="form-label">Anno di pubblicazione</label>
    <input class="mt-2 w-100" type="date" name="anno_pubblicazione" id="anno_pubblicazione" value="<?= $book['anno_pubblicazione'] ?>" required>
</div>
<div class="mb-3">
    <label for="genere" class="form-label">Genere</label>
    <input type="genere" class="form-control" id="genere" name="genere" value="<?= $book['genere'] ?>" required>
</div>
<div class="mb-3">
    <label class="form-label" for="immagine">URL Immagine</label>
    <input type="text" name="immagine" id="immagine" placeholder="Inserisci l'URL immagine" class="form-control" value="<?= $book['immagine'] ?>" required>
</div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>