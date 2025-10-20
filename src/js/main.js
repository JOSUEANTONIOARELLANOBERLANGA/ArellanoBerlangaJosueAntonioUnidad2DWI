const tarjeta = document.querySelector('#tarjeta'),
	btnAbrirFormulario = document.querySelector('#btn-abrir-formulario'),
	formulario = document.querySelector('#formulario-tarjeta'),
	numeroTarjeta = document.querySelector('#tarjeta .numero'),
	nombreTarjeta = document.querySelector('#tarjeta .nombre'),
	logoMarca = document.querySelector('#logo-marca'),
	firma = document.querySelector('#tarjeta .firma p'),
	mesExpiracion = document.querySelector('#tarjeta .mes'),
	yearExpiracion = document.querySelector('#tarjeta .year'),
	ccv = document.querySelector('#tarjeta .ccv');

const inputNumero = document.getElementById('inputNumero');
const inputNombre = document.getElementById('inputNombre');
const selectMes = document.getElementById('selectMes');
const selectYear = document.getElementById('selectYear');
const inputCCV = document.getElementById('inputCCV');

// Mostrar frente
const mostrarFrente = () => {
	if (tarjeta.classList.contains('active')) {
		tarjeta.classList.remove('active');
	}
};

// Rotar tarjeta
tarjeta.addEventListener('click', () => {
	tarjeta.classList.toggle('active');
});

// Mostrar formulario
btnAbrirFormulario.addEventListener('click', () => {
	btnAbrirFormulario.classList.toggle('active');
	formulario.classList.toggle('active');
});

// Número de tarjeta
inputNumero.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
	valorInput = valorInput.replace(/\s/g, '').replace(/\D/g, '').replace(/([0-9]{4})/g, '$1 ').trim();
	inputNumero.value = valorInput;
	numeroTarjeta.textContent = valorInput || '#### #### #### ####';

	logoMarca.innerHTML = '';
	if (valorInput.startsWith('4')) {
		logoMarca.innerHTML = `<img src="img/logos/visa.png">`;
	} else if (valorInput.startsWith('5')) {
		logoMarca.innerHTML = `<img src="img/logos/mastercard.png">`;
	}

	mostrarFrente();
});

// Nombre
inputNombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value.replace(/[0-9]/g, '');
	inputNombre.value = valorInput;
	nombreTarjeta.textContent = valorInput || 'Jhon Doe';
	firma.textContent = valorInput;
	mostrarFrente();
});

// Expiración
selectMes.addEventListener('change', (e) => {
	mesExpiracion.textContent = e.target.value;
	mostrarFrente();
});

selectYear.addEventListener('change', (e) => {
	yearExpiracion.textContent = e.target.value.slice(2);
	mostrarFrente();
});

// CCV
inputCCV.addEventListener('keyup', () => {
	if (!tarjeta.classList.contains('active')) {
		tarjeta.classList.toggle('active');
	}
	inputCCV.value = inputCCV.value.replace(/\s/g, '').replace(/\D/g, '');
	ccv.textContent = inputCCV.value;
});
