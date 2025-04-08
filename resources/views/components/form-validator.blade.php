@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cpfInput = document.getElementById("cpf");
        const telefoneInput = document.getElementById("telefone");
        const dataNascimentoInput = document.getElementById("data_nascimento");

        if (cpfInput) {
            cpfInput.addEventListener("input", function() {
                this.value = this.value.replace(/\D/g, "").substring(0, 11);
            });
        }

        if (telefoneInput) {
            telefoneInput.addEventListener("input", function() {
                const cleaned = this.value.replace(/\D/g, "").substring(0, 11);
                this.value = cleaned;

                if (cleaned.length > 0 && !/^\d{10,11}$/.test(cleaned)) {
                    this.setCustomValidity("Telefone inválido. Use 10 ou 11 dígitos.");
                } else {
                    this.setCustomValidity("");
                }
            });
        }

        if (dataNascimentoInput) {
            dataNascimentoInput.addEventListener("input", function() {
                const regex = /^\d{4}-\d{2}-\d{2}$/;
                if (!regex.test(this.value)) {
                    this.setCustomValidity("Data inválida");
                } else {
                    this.setCustomValidity("");
                }
            });
        }
    });
</script>
@endpush