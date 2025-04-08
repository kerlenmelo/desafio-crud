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
                this.value = this.value.replace(/\D/g, "").substring(0, 11);
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