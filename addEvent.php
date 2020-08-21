<?php
require 'views/header.php';
?>

<div class="container">
    <h1>Ajouter un évènement</h1>    
    <form action="" method="POST" class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Titre</label>
                    <input id="name" type="text" required class="form-control" name="name" value="Demo">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input id="date" type="date" required class="form-control" name="date" value="2020-07-05">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="start">Début</label>
                    <input id="start" type="time" required class="form-control" name="start" placeholder="HH:MM" value="14:40">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="end">Fin</label>
                    <input id="end" type="time" required class="form-control" name="end" placeholder="HH:MM" value="15:40">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Ajouter l'évenement</button>
        </div>
    </form>
</div>

<?php
debugging($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $validator = new EventValidator();
    $errors = $validator->validates($_POST);
    if (!empty($errors)) {
        debugging($errors); 
    }
}
?>

<?php require 'views/footer.php';