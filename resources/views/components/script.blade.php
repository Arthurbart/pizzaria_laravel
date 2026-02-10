<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

<script>
document.addEventListener('change', function (e) {

    /* 🔹 MUDOU O TAMANHO */
    if (e.target.matches('input[type="radio"][data-qsabores]')) {

        const pizzaBloco = e.target.closest('.pizza-bloco');
        const limite = parseInt(e.target.dataset.qsabores);

        pizzaBloco.dataset.limite = limite;

        // limpa e reativa sabores dessa pizza
        pizzaBloco.querySelectorAll('.sabor-checkbox').forEach(cb => {
            cb.checked = false;
            cb.disabled = false;
        });
    }

    /* 🔹 MUDOU UM SABOR */
    if (e.target.matches('.sabor-checkbox')) {

        const pizzaBloco = e.target.closest('.pizza-bloco');
        const limite = parseInt(pizzaBloco.dataset.limite || 0);

        const selecionados = pizzaBloco.querySelectorAll('.sabor-checkbox:checked').length;

        pizzaBloco.querySelectorAll('.sabor-checkbox').forEach(cb => {
            cb.disabled = (selecionados >= limite && !cb.checked);
        });
    }

});
</script>
