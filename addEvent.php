<?php
require 'views/header.php';
$data = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $errors = [];
    $validator = new EventValidator();
    $errors = $validator->validates($_POST);
    if (!empty($errors)) {
        debugging($errors); 
    
        echo "<div class='container alert alert-danger'>Please correct the required fields</div>";
    }else {
        $event = new TheEvent;
        $event->setName($data['name']);
        $event->setDescription($data['description']);
        $event->setStart(DateTime::createFromFormat('Y-m-d H:i', $data['date'].' '.$data['start'])->format('Y-m-d H:i:s'));
        $event->setEnd(DateTime::createFromFormat('Y-m-d H:i', $data['date'].' '.$data['end'])->format('Y-m-d H:i:s'));

        debugging($event);
        $events = new Events;
        $events->create($event);
        header('Location: /index?sucess');
        exit();
    }
}   
?>

<div class="container">
    <h1>Ajouter un évènement</h1>    
    <form action="" method="POST" class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Titre</label>
                    <input id="name" type="text" required class="form-control" name="name" value="<?= isset($data['name'])?h($data['name']):'' ?>">
                    <div class='text-muted'>
                    <?php if(isset($errors['name'])): ?>
                        <?php echo $errors['name']; ?>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input id="date" type="date" required class="form-control" name="date" value="<?= isset($data['date'])?h($data['date']):'' ?>">
                    <div class='text-muted'>
                    <?php if(isset($errors['date'])): ?>
                        <?php echo $errors['date']; ?>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="start">Début</label>
                    <input id="start" type="time" required class="form-control" name="start" placeholder="HH:MM" value="<?= isset($data['start'])?h($data['start']):'' ?>">
                    <div class='text-muted'>
                    <?php if(isset($errors['start'])): ?>
                        <?php echo $errors['start']; ?>
                    <?php endif; ?>
            </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="end">Fin</label>
                    <input id="end" type="time" required class="form-control" name="end" placeholder="HH:MM" value="<?= isset($data['end'])?h($data['end']):'' ?>">
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

?>

<?php require 'views/footer.php';