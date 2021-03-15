<form method="post" id="personForm" action="https://wt98.fei.stuba.sk/olympic-winners/api/editApi.php">
    <input type="hidden" name="id" value="<?php echo isset($person) ? $person->getId() : null ?>" required>
    <div class="row">
        <div class="form-group col">
            <label for="name">Meno</label>
            <input type="text" name="name" value="<?php echo isset($person) ? $person->getName() : null ?>" id="name"
                   class="form-control" required>
        </div>
        <div class="form-group col">
            <label for="surname">Priezvisko</label>
            <input type="text" name="surname" value="<?php echo isset($person) ? $person->getSurname() : null ?>"
                   id="surname" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="form-group col">
            <label for="birthdate">Dátum narodenia</label>
            <input type="date" name="birthdate" value="<?php echo isset($person) ? $person->getHtmlBirthDate() : null ?>"
                   id="birthdate" class="form-control" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="birthplace">Miesto narodenia</label>
            <input type="text" name="birthplace" value="<?php echo isset($person) ? $person->getBirthPlace() : null ?>"
                   id="birthplace" class="form-control" required>
        </div>
        <div class="form-group col">

            <label for="birthcountry">Krajina narodenia</label>
            <input type="text" name="birthcountry"
                   value="<?php echo isset($person) ? $person->getBirthCountry() : null ?>"
                   id="birthcountry" class="form-control" required>
        </div>
    </div>
    <!--  DOLE LEN NEPOVINNE  -->
    <div class="row">
        <div class="form-group col">
            <label for="deathdate">Dátum úmrtia</label>
            <input type="date" name="deathdate" value="<?php echo isset($person) ? $person->getHtmlDeathDate() : null ?>"
                   id="deathdate" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="deathplace">Miesto úmrtia</label>
            <input type="text" name="deathplace" value="<?php echo isset($person) ? $person->getDeathPlace() : null ?>"
                   id="deathplace" class="form-control">
        </div>
        <div class="form-group col">
            <label for="deathcountry">Krajina úmrtia</label>
            <input type="text" name="deathcountry"
                   value="<?php echo isset($person) ? $person->getDeathCountry() : null ?>"
                   id="deathcountry" class="form-control">
        </div>
    </div>
    <button type="submit" class="btn btn-light mt-3">Potvrdiť</button>
</form>