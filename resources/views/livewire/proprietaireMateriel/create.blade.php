<div>
    <h1>Ajouter un Propriétaire de Matériel</h1>
    <form action="{{ route('proprietaireMateriel.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>

        <div class="form-group">
    <label for="contact">Contact</label>
    <input type="hidden" name="code_pays" id="code_pays" value="+226">
    <input type="tel" name="contact" id="contact" class="form-control" required>
</div>


        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>

<script>
    const input = document.querySelector("#contact");

    const iti = window.intlTelInput(input, {
        initialCountry: "bf", // Burkina Faso sélectionné par défaut
        preferredCountries: ["bf", "ci", "cm", "sn", "ml", "bj"],
        separateDialCode: true, // Séparer le code du numéro
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Script utilitaire
    });

    // Mettre à jour le champ "code_pays" caché pour l'envoyer au serveur
    input.addEventListener("countrychange", function() {
        document.querySelector("[name='code_pays']").value = iti.getSelectedCountryData().dialCode;
    });
</script>

