// Validação de Formulário
(() => {
  'use strict'
  
  const forms = document.querySelectorAll('.needs-validation')
  
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      
      form.classList.add('was-validated')
    }, false)
  })
})()

//Formatação do Input Valor

function formatBRL(valor) {
  var valorAlterado = valor.value;
	valorAlterado = valorAlterado.replace(/\D/g, ""); // Remove todos os não dígitos
	valorAlterado = valorAlterado.replace(/(\d+)(\d{2})$/, "$1,$2"); // Adiciona a parte de centavos
	valorAlterado = valorAlterado.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // Adiciona pontos a cada três dígitos
	valorAlterado = "R$ " + valorAlterado;
	valor.value = valorAlterado;
}

/* const tdValor = document.querySelector('.valor');
const valorNumerico = parseFloat(tdValor.textContent);
const valorFormatado = valorNumerico.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' });
tdValor.textContent = valorFormatado; */


const tdValores = document.querySelectorAll('.valor');
tdValores.forEach(tdValor => {
  const valorNumerico = parseFloat(tdValor.textContent);
  const valorFormatado = valorNumerico.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' });
  tdValor.textContent = valorFormatado;
})

const tdValorTotal = document.querySelector('.valorTotal');
const valorNumerico = parseFloat(tdValorTotal.textContent);
const valorFormatado = valorNumerico.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
tdValorTotal.textContent = valorFormatado;




