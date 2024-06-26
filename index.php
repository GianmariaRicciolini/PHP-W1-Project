<?php
include __DIR__ . '/includes/dbconnect.php';
$errors = [];

$stmt = $pdo->prepare('SELECT * FROM libri');
$stmt->execute();
$books = $stmt->fetchAll();

$search = isset($_GET['search']) ? $_GET['search'] : ''; 

$stmt_search = $pdo->prepare('SELECT * FROM libri WHERE titolo LIKE ? OR autore LIKE ? OR genere LIKE ?');
$stmt_search->execute(["%$search%", "%$search%", "%$search%"]);
$books_search = $stmt_search->fetchAll();

include __DIR__ . '/includes/head.php';
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-6">
            <h1 class="text-center pt-5">Inserisci qui il tuo Libro</h1>
        <form action="" method="post" class="pt-2 d-flex flex-column" novalidate>

                <div class="row mb-3">
                    <label class="col-4 pt-3" for="titolo">Titolo</label>
                    <div class="col-8">
                        <input class="form-control mt-2 w-100" type="text" name="titolo" id="titolo" placeholder="Inserisci il titolo">
                    </div>
                </div>
        
                <div class="row mb-3">
                    <label class="col-4 pt-3" for="autore">Autore</label>
                    <div class="col-8">
                        <input class="form-control mt-2 w-100" type="text" name="autore" id="autore" placeholder="Inserisci l'autore">
                    </div>
                </div>
        
                <div class="row mb-3">
                    <label class="col-4 pt-3" for="anno_pubblicazione">Data pubblicazione</label>
                    <div class="col-8">
                        <input class="form-control mt-2 w-100" type="date" name="anno_pubblicazione" id="anno_pubblicazione">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-4 pt-3" for="genere">Genere</label>
                    <div class="col-8">
                        <input type="text" name="genere" id="genere" placeholder="Inserisci il genere" class="form-control mt-2 w-100">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-4 pt-3" for="immagine">URL Immagine</label>
                    <div class="col-8">
                        <input type="url" name="immagine" id="immagine" placeholder="Inserisci l'URL immagine" class="form-control mt-2 w-100">
                    </div>
                </div>
        
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success w-25 mt-4">Add Book</button>
                </div>
            </form>
        </div>
        <div class="col-6">
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            
                if (!empty($errors)) {
                    echo '<div class="container mt-4 pt-5">';
                    echo '<div class="alert alert-danger mt-5" role="alert">';
                    echo '<h4 class="alert-heading">Ci sono errori nel modulo:</h4>';
                    echo '<ul>';
                    foreach ($errors as $error) {
                        echo '<li>' . $error . '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                } 
                else {
                    $stmt = $pdo->prepare("INSERT INTO libri (titolo, autore, anno_pubblicazione, genere, immagine) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$titolo, $autore, $pubblicazione, $genere, $immagine]);
            
                    header('Location: index.php');
                    exit;
                }
            }
        ?>
</div>
<div class="container mt-4 pt-5">
<form action="" method="GET" class="mb-3">
        <div class="input-group w-50">
            <input type="text" class="form-control w-25" placeholder="Cerca per titolo, autore o genere" name="search" value="<?= $search ?>">
            <button type="submit" class="btn btn-warning">Search</button>
        </div>
    </form>
    <div class="row mt-5">
        <?php foreach ($books_search as $book): ?>
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card">
                <div style="height: 400px;">
                    <img src="<?= $book['immagine'] ?>" class="card-img-top" alt="Immagine di copertina" style="height: 100%; object-fit: contain;">
                </div>
                    <div class="card-body">
                        <h5 class="card-title">Titolo: <?= $book['titolo'] ?></h5>
                        <p class="card-text">Autore: <?= $book['autore'] ?></p>
                        <p class="card-text">Pubblicazione: <?= $book['anno_pubblicazione'] ?></p>
                        <p class="card-text">Genere: <?= $book['genere'] ?></p>
                        <div class="text-end">
                            <a class="btn btn-danger" href="./delete.php?id=<?= $book['id'] ?>">Delete</a>
                            <a class="btn btn-primary" href="./modify.php?id=<?= $book['id'] ?>">Modify</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>